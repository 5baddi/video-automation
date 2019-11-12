<?php

namespace App\Http\Controllers\API;

use App\RenderJob;
use App\AutomationApp;
use App\TemplateMedia;
use App\CustomTemplate;
use Illuminate\Http\Request;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\CronController;
use App\RenderJobMedia;
use GuzzleHttp\Exception\BadResponseException;

class RenderController extends Controller
{
    /**
     * Get rendered jobs list
     *
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        $renderedJobs = RenderJob::orderBy('created_at', 'desc')->get();
        if(sizeof($renderedJobs) > 0)
            return response()->json(['data' => $renderedJobs], 200);

        // No content
        return response()->json(null, 204);
    }


    /**
     * Delete an exists render job
     *
     * @param integer $renderJobID
     * @return JsonResponse
     */
    public function delete(int $renderJobID) : JsonResponse
    {
        // Get the exists render job
        $renderJob = RenderJob::find($renderJobID);
        if(is_null($renderJob))
            return response()->json(['message' => "Video render job doesn't exists!"], 404);

        // Delete the render job also the outputs
        $renderJob->delete();
        Storage::deleteDirectory(AutomationApp::OUTPUT_DIRECTORY_NAME . DIRECTORY_SEPARATOR . $renderJob->template_id . DIRECTORY_SEPARATOR);
        // TODO: delete video output assets from the render job medias history

        return response()->json(['message' => "The video render job has deleted successfully."], 200);
    }

    /**
     * Exec render job
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function render(Request $request) : JsonResponse
    {
        try{
            // Init the render job
            $renderJob = new RenderJob();

            // Handle requested template from body json to object
            $body = $request->all();

            // Validation rules
            $rules = [
                'template'                  =>  'required|integer',
                'name'                      =>  'nullable|string'
            ];
            // Validate the main body template
            $validator = Validator::make($body, $rules);
            if($validator->fails())
                return response()->json(['message' => $validator->getMessageBag()->all()], 400);

            // Set the template id
            $selectedTemplateID = $body['template'];

            // Fetch the custom template
            $customTemplate = CustomTemplate::find($selectedTemplateID);
            if(is_null($customTemplate))
                return response()->json(['message' => "Template does not exists!"], 400);

            // Check the inputs are valid
            $customTemplateMedias = $customTemplate->medias();
            $notIncludedCount = $customTemplateMedias->whereNotIn('type', ['text', 'color'])->count();
            if($customTemplate->enabled != 1)
                return response()->json(['message' => "This template not enabled or not for use!"], 400);
            elseif(sizeof($request->file()) < $notIncludedCount)
                return response()->json(['message' => "The submitted images are not the same as those required by the video template!"], 400);

            // Init inputs
            $inputs = [];

            // File name
            $videoTitle = isset($body['name']) ? $body['name'] : strtolower(str_replace(' ', '_', $customTemplate->name));

            // Set user ID
            if(isset($body['user']))
                $renderJob->user_id = $body['user'];

            // Prepare the callback/notification url
            $renderJob->template_id = $customTemplate->id;
            $renderJob->status = RenderJob::DEFAULT_STATUS;
            $renderJob->created_at = date('Y-m-d H:i:s');
            $renderJob->updated_at = null;
            $renderJob->finished_at = null;
            $renderJob->save();

            // Upload the attached files
            try{
                // Render job unique name id
                $uniqueID = uniqid(date('dmy')) . '_';

                // Handle the request media by template
                foreach($customTemplate->medias()->get() as $media){
                    // Ignore not images placeholder
                    if($media->type != TemplateMedia::SCENE_TYPE){
                        if(isset($body[$media->placeholder]))
                            $inputs[$media->placeholder] = $body[$media->placeholder];
                        else
                            $inputs[$media->placeholder] = $media->default_value;
                    }else{
                        // Attached image
                        if($request->hasFile($media->palceholder)){
                            $fileName = $uniqueID . strtolower($request->file($media->placeholder)->getClientOriginalName());
                            $targetPath = AutomationApp::OUTPUT_DIRECTORY_NAME . DIRECTORY_SEPARATOR . $customTemplate->id;

                            if(!Storage::disk('local')->exists($targetPath . DIRECTORY_SEPARATOR . $fileName))
                                $request->file($media->placeholder)->storeAs($targetPath, $fileName, 'local');

                            // Relative url
                            $inputs[$media->placeholder] = route('cdn.cutomTemplate.files', ['collection' =>  'outputs', 'customTemplateID' => $media->template_id, 'fileName' => $fileName]);
                        }
                        // It's image & not attached
                        else{
                            $inputs[$media->placeholder] = $media->default_value;
                        }
                    }

                    // Store media to render job history
                    $renderJobMedia = new RenderJobMedia();
                    $renderJobMedia->media_id = $media->id;
                    $renderJobMedia->value = $inputs[$media->placeholder];

                    // Add render job medias history
                    $renderJob->mediasHistory()->save($renderJobMedia);
                }
            }catch(\Exception $ex){
                return response()->json(['message' => 'Attached images are not allowed or damaged!'], 400);
            }

            // Re-form the body
            $videoData = [];
            // $videoData['template'] = $body['template'];
            $videoData['template']['id'] = $customTemplate->vau_id;
            $videoData['input'] = $inputs;
            $videoData['name'] = $videoTitle;
            $videoData['notificationUrl'] = route('vau.notify', ['jobID' => $renderJob->id]);

            // Init Guzzle client
            $headers = [
                // 'Content-Type'  =>  'application/json',
                'X-AUTH-TOKEN'  =>  AutomationApp::ACCESS_TOKEN
            ];
            $client = new GuzzleClient(['headers' => $headers]);

            // Send the requet to vau API
            $response = $client->post(
                AutomationApp::API_URL . '/v1/render',
                [RequestOptions::JSON => $videoData]
            );

            // Handle the response
            if($response->getStatusCode() === 200){
                // Content of response
                $content = json_decode($response->getBody()->getContents(), true);

                // Set the VAU API render job id
                if(is_null($renderJob->vau_job_id))
                    $renderJob->vau_job_id = $content['id'];

                // Update the render job infos
                $renderJob->status = $content['renderStatus']['state'];
                $renderJob->message = $content['renderStatus']['message'];
                $renderJob->output_name = strtolower(str_replace(' ', '_', $videoTitle));
                $renderJob->progress = $content['renderStatus']['progressPercent'];
                $renderJob->left_seconds = $content['renderStatus']['etlSec'];
                $renderJob->created_at = date('Y-m-d H:i:s', strtotime($content['created']));
                $renderJob->finished_at = date('Y-m-d H:i:s');
                $renderJob->finished_at = isset($content['finished']) ? date('Y-m-d H:i:s', strtotime($content['finished'])) : null;


                // Generate target output path
                $targetOutputPath = AutomationApp::generateOutputPath($renderJob, $content['outputUrls']['mainFile']);
                // Set the render job local output url
                $renderJob->output_url = route('cdn.cutomTemplate.files', ['collection' =>  'outputs', 'customTemplateID' => $renderJob->template_id, 'fileName' => pathinfo($targetOutputPath, PATHINFO_BASENAME)]);

                // Update render job
                $renderJob->update();

                return response()->json([
                    'job_id'        => $renderJob->id,
                    'output_name'   => $renderJob->output_name,
                    'output_url'    => $renderJob->output_url,
                    'message'       => "The rendering job was successfully created. please wait until finished..."
                ]);
            }
        }catch(BadResponseException $ex){
            switch($ex->getResponse()->getStatusCode()){
                case 400:
                    return response()->json(['message' => "Please verify that the template entries are correct!"], 400);
                break;
                case 401:
                case 404:
                    return response()->json(['message' => "Incorrect video render job identity! please try again or contact support"], 404);
                break;
                default:
                    return response()->json(['message' => AutomationApp::INTERNAL_SERVER_ERROR], 500);
                break;
            }
        }
    }

    /**
     * Get status of render job
     *
     * @param int $renderID
     * @param string $action
     * @return JsonResponse|BinaryFileResponse
     */
    public function status(int $renderID)
    {
        // Fetch if this render job exists
        $renderJob = RenderJob::find($renderID);
        if(is_null($renderJob))
            return response()->json(['message' => "Job does not exists!"], 404);
        elseif(is_null($renderJob->vau_job_id))
            return response()->json(['message' => "Job requested not created yet!"], 400);

        // Refresh the render job details
        if($renderJob->status != 'done')
            return app(CronController::class)->notify($renderJob->id);

        return response()->json(['data' => $renderJob]);
    }
}
