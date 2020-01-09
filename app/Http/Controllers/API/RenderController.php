<?php

namespace App\Http\Controllers\API;

use App\RenderJob;
use App\AutomationApp;
use App\TemplateMedia;
use App\CustomTemplate;
use App\RenderJobMedia;
use Illuminate\Http\Request;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\CronController;
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
            return response()->json(['status' => 'success', 'data' => $renderedJobs], 200);

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
            return response()->json(['status' => 'not found', 'message' => "Video render job doesn't exists!"], 404);

        // Delete the render job also the outputs
        $renderJob->delete();
        Storage::deleteDirectory(AutomationApp::OUTPUT_DIRECTORY_NAME . DIRECTORY_SEPARATOR . $renderJob->template_id . DIRECTORY_SEPARATOR);
        // TODO: delete video output assets from the render job medias history

        return response()->json(['status' => 'success', 'message' => "The video render job has deleted successfully."], 200);
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
                return response()->json(['status' => 'bad request', 'message' => $validator->getMessageBag()->all()], 400);

            // Set the template id
            $selectedTemplateID = $body['template'];

            // Fetch the custom template
            $customTemplate = CustomTemplate::find($selectedTemplateID);
            if(is_null($customTemplate))
                return response()->json(['status' => 'bad request', 'message' => "Template does not exists!"], 400);

            // Check the inputs are valid
            $customTemplateMedias = $customTemplate->medias();
            $notIncludedCount = $customTemplateMedias->whereNotIn('type', ['text', 'color'])->count();
            if($customTemplate->enabled != 1)
                return response()->json(['status' => 'bad request', 'message' => "This template not enabled or not for use!"], 400);
            elseif(sizeof($request->file()) < $notIncludedCount)
                return response()->json(['status' => 'bad request', 'message' => "The submitted images are not the same as those required by the video template!"], 400);

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
                return response()->json(['status' => 'bad request', 'message' => 'Attached images are not allowed or damaged!'], 400);
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
                    return response()->json(['status' => 'bad request', 'message' => "Please verify that the template entries are correct!"], 400);
                break;
                case 401:
                case 404:
                    return response()->json(['status' => 'not found', 'message' => "Incorrect video render job identity! please try again or contact support"], 404);
                break;
                default:
                    return response()->json(['status' => 'error', 'message' => AutomationApp::INTERNAL_SERVER_ERROR], 500);
                break;
            }
        }
    }

    /**
     * Exec render job
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function renderV2(Request $request) : JsonResponse
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
                return response()->json(['status' => 'bad request', 'message' => $validator->getMessageBag()->all()], 400);

            // Set the template id
            $selectedTemplateID = $body['template'];

            // Fetch the custom template
            $customTemplate = CustomTemplate::find($selectedTemplateID);
            if(is_null($customTemplate))
                return response()->json(['status' => 'bad request', 'message' => "Template does not exists!"], 400);

            // Check the inputs are valid
            // $customTemplateMedias = $customTemplate->medias();
            // $notIncludedCount = $customTemplateMedias->whereNotIn('type', ['text', 'color', 'audio'])->count();
            if($customTemplate->enabled != 1)
                return response()->json(['status' => 'bad request', 'message' => "This template not enabled or not for use!"], 400);
            //elseif(sizeof($request->file()) < $notIncludedCount)
              //  return response()->json(['status' => 'bad request', 'message' => "The submitted images are not the same as those required by the video template!"], 400);

            // Init footage
            $footage = [];

            // File name
            $videoTitle = isset($body['name']) ? $body['name'] : strtolower(str_replace(' ', '_', $customTemplate->name));

            // Set user ID
            // if(isset($body['user']))
            //     $renderJob->user_id = $body['user'];

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
                $uniqueID =  uniqid(date('dmy')) . '_';

                // Handle the request media by template
                foreach($customTemplate->medias()->get() as $media){
                    // Init current value
                    $value = null;
                    
                    // Handle Text footage
                    if($media->type == TemplateMedia::TEXT_TYPE){
                        // Add Text to Footage
                        $footage[] = [
                            'type'      =>  'data',
                            'value'     => ($value = $request->input($media->placeholder)),
                            'property'  =>  'Source Text',
                            'layerName' =>  $media->placeholder
                        ];
                    }

                    // Handle Image footage
                    if($media->type == TemplateMedia::SCENE_TYPE && $request->hasFile($placeholder = str_replace('.', '_', $media->placeholder))){
                        // Attached image
                        $fileName = strtolower($request->file($placeholder)->getClientOriginalName());
                        $targetPath = AutomationApp::OUTPUT_DIRECTORY_NAME . DIRECTORY_SEPARATOR . $uniqueID;

                        if(!Storage::disk('local')->exists($targetPath . DIRECTORY_SEPARATOR . $fileName))
                            $request->file($placeholder)->storeAs($targetPath, $fileName, 'local');

                        // Relative url TODO: load default image if not exists
                        $imageUrl = route('cdn.cutomTemplate.footage', ['uid' => $uniqueID, 'fileName' => $fileName]);

                        // Add Image to Footage
                        $footage[] = [
                            'type'      =>  TemplateMedia::SCENE_TYPE,
                            'src'       =>  ($value = $imageUrl),
                            'layerName' =>  $media->placeholder
                        ];
                    }

                    // Save render job media
                    if(!is_null($value)){
                        // Store media to render job history
                        $renderJobMedia = new RenderJobMedia();
                        $renderJobMedia->media_id = $media->id;
                        $renderJobMedia->value = $value;

                        // Add render job medias history
                        $renderJob->mediasHistory()->save($renderJobMedia);
                    }
                }
            }catch(\Exception $ex){
                return response()->json(['status' => 'bad request', 'message' => 'Attached images are not allowed or damaged!'], 400);
            }

            // Final output name
            $finalOutputName = strtolower(str_replace(' ', '_', $videoTitle)) . '_' . uniqid(date('dmy')) . ".mp4";

            // TODO: Upload to render job directory
            // Create the render job output folder
            // $targetPath = AutomationApp::OUTPUT_DIRECTORY_NAME . DIRECTORY_SEPARATOR . $customTemplate->id . DIRECTORY_SEPARATOR . $renderJob->id;
            // if(!Storage::disk('local')->exists($targetPath))
            //     Storage::disk('local')->makeDirectory($targetPath);

            // Re-form the body
            $videoData = [
                'template'  =>  [
                    'src'           =>  \App\AutomationApp::DEFAULT_TEMPLATES_DIRECTORY . $customTemplate->id . '/' . $customTemplate->id . '.aep',
                    'composition'   =>  'LANDSCAPE'
                ],
                'assets'    =>  $footage,
                'actions'   =>  [
                    'postrender'    =>  [
                        [
                            "module"    => "@nexrender/action-encode", 
                            "preset"    => "mp4", 
                            "output"    => $finalOutputName
                        ], 
                        [
                            "module"    =>  "@nexrender/action-upload", 
                            "input"     =>  $finalOutputName,
                            "provider"  =>  "ftp",
                            "params"    =>  [
                                "host"      =>  $_ENV['FTP_HOST'],
                                "port"      =>  $_ENV['FTP_PORT'],
                                "user"      =>  $_ENV['FTP_USER'],
                                "password"  =>  $_ENV['FTP_PASSWORD']
                            ]
                        ] 
                    ]
                    // TODO: upload video via FTP to V12 servers
                ]
            ];

            // Init Guzzle client
            $headers = [
                // 'Content-Type'  =>  'application/json',
                // 'X-AUTH-TOKEN'  =>  AutomationApp::ACCESS_TOKEN
                "nexrender-secret"  =>  $_ENV['SERVER_SECRET']
            ];
            $client = new GuzzleClient(['headers' => $headers]);

            // Send the requet to vau API
            $response = $client->post(
                $_ENV['SERVER_ADDRESS'] . 'jobs',
                [RequestOptions::JSON => $videoData]
            );

            // Handle the response
            if($response->getStatusCode() === 200){
                // Content of response
                $content = json_decode($response->getBody()->getContents(), true);

                // Update the render job infos
                $renderJob->uid = $content['uid'];
                $renderJob->status = $content['state'];
                $renderJob->message = "The rendering job has been queued";
                $renderJob->output_name = pathinfo($finalOutputName, PATHINFO_FILENAME);
                $renderJob->progress = 0;
                $renderJob->left_seconds = null;
                $renderJob->created_at = date('Y-m-d H:i:s');
                $renderJob->finished_at = isset($content['finished']) ? date('Y-m-d H:i:s', strtotime($content['finished'])) : null;


                // Generate target output path
                // $targetOutputPath = AutomationApp::generateOutputPath($renderJob, $finalOutputName);
                // Set the render job local output url
                $renderJob->output_url = route('cdn.cutomTemplate.files', ['collection' =>  'outputs', 'renderJobID' => $renderJob->id, 'fileName' => pathinfo($finalOutputName, PATHINFO_BASENAME)]);

                // Update render job
                $renderJob->update();

                return response()->json([
                    'job_id'        => $renderJob->id,
                    'output_name'   => $renderJob->output_name,
                    'output_url'    => $renderJob->output_url,
                    'message'       => "The rendering job was successfully created. please wait until finished..."
                ]);
            }elseif($response->getStatusCode() === 204){
                // Update render job status
                $renderJob->finished_at = date('Y-m-d H:i:s');
                $renderJob->status = "failed";
                $renderJob->message = "Rendering job failed! Please try again or contact the support..";
                $renderJob->update();

                // Render job not started
                return response()->json(['status' => 'bad request', 'message' => "Please verify that the template entries are correct!"], 400);
            }
        }catch(BadResponseException $ex){
            // Update render job status
            $renderJob->finished_at = date('Y-m-d H:i:s');
            $renderJob->status = "failed";
            $renderJob->message = "Rendering job failed! Please try again or contact the support..";
            $renderJob->update();

            // Return error status
            switch($ex->getResponse()->getStatusCode()){
                case 400:
                    return response()->json(['status' => 'bad request', 'message' => "Please verify that the template entries are correct!"], 400);
                break;
                case 401:
                case 404:
                    return response()->json(['status' => 'not found', 'message' => "Incorrect video render job identity! please try again or contact support"], 404);
                break;
                default:
                    return response()->json(['status' => 'error', 'message' => AutomationApp::INTERNAL_SERVER_ERROR], 500);
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
            return response()->json(['status' => 'not found', 'message' => "Job does not exists!"], 404);
        elseif(is_null($renderJob->vau_job_id))
            return response()->json(['status' => 'bad request', 'message' => "Job requested not created yet!"], 400);

        // Refresh the render job details
        if($renderJob->status != 'done')
            return app(CronController::class)->notify($renderJob->id);

        return response()->json(['status' => 'success', 'data' => $renderJob]);
    }
    
    /**
     * Get status of render job
     *
     * @param int $renderID
     * @param string $action
     * @return JsonResponse|BinaryFileResponse
     */
    public function statusV2(int $renderID)
    {
        // Fetch if this render job exists
        $renderJob = RenderJob::find($renderID);
        if(is_null($renderJob))
            return response()->json(['status' => 'not found', 'message' => "Job does not exists!"], 404);
        elseif(is_null($renderJob->uid))
            return response()->json(['status' => 'bad request', 'message' => "Job requested not created yet!"], 400);

        // Refresh the render job details
        if($renderJob->status != 'done')
            return app(CronController::class)->notifyV2($renderJob->id);

        return response()->json(['status' => 'success', 'data' => $renderJob]);
    }
}
