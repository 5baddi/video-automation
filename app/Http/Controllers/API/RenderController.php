<?php

namespace App\Http\Controllers\API;

use App\RenderJob;
use App\AutomationApp;
use App\TemplateMedia;
use App\CustomTemplate;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Exception\BadResponseException;

class RenderController extends Controller
{
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

            // Upload the attached files
            try{
                // Handle the request media by template
                foreach($customTemplateMedias->get() as $media){
                    // Attached image
                    if($request->hasFile($media->palceholder)){
                        $fileName = $request->file($media->placeholder)->getClientOriginalName();
                        $targetPath = AutomationApp::OUTPUT_DIRECTORY_NAME . DIRECTORY_SEPARATOR . $customTemplate->id;
                        
                        if(!Storage::disk('local')->exists($targetPath . DIRECTORY_SEPARATOR . $fileName))
                            $request->file($media->placeholder)->storeAs($targetPath, $fileName, 'local');

                        // Relative url
                        $inputs[$media->placeholder] = route('cdn.cutomTemplate.files', ['collection' =>  'outputs', 'customTemplateID' => $media->template_id, 'fileName' => $fileName, 'action' => 'download']);
                    }
                    // Ignore not images placeholder
                    elseif($media->type != TemplateMedia::SCENE_TYPE){
                        if(isset($body[$media->placeholder]))
                            $inputs[$media->placeholder] = $body[$media->placeholder];
                        else
                            $inputs[$media->placeholder] = $media->default_value;
 
                        continue;
                    }
                    // It's image & not attached
                    elseif(!$request->hasFile($media->palceholder)){
                        $inputs[$media->placeholder] = $media->default_value . '?action=download';
                    }
                }
            }catch(\Exception $ex){
                return response()->json(['message' => 'Attached images are not allowed or damaged!'], 400);
            }

            // File name
            $fileName = $body['name'];

            // Prepare the callback/notification url
            $renderJob->template_id = $customTemplate->id;
            $renderJob->status = RenderJob::DEFAULT_STATUS;
            $renderJob->created_at = date('Y-m-d H:i:s');
            $renderJob->updated_at = null;
            $renderJob->finished_at = null;
            $renderJob->save();

            // Re-form the body
            $videoData = [];
            // $videoData['template'] = $body['template'];
            $videoData['template']['id'] = $customTemplate->vau_id;
            $videoData['input'] = $inputs;
            $videoData['name'] = $fileName;
            $videoData['notificationUrl'] = route('vau.notify', ['jobID' => $renderJob->id]);

            // Init Guzzle client
            $headers = [
                'Content-Type'  =>  'application/json',
                'X-AUTH-TOKEN'  =>  AutomationApp::ACCESS_TOKEN
            ];
            $client = new GuzzleClient(['headers' => $headers]);

            // Send the requet to vau API
            $response = $client->request(
                'POST',
                AutomationApp::API_URL . '/v1/render', 
                [
                    // TODO: enable the verification on prod
                    'verify'    =>  false,
                    'body'      =>  json_encode($videoData),
                ]
            );

            // Handle the response
            if($response->getStatusCode() === 200){
                // Content of response
                $content = json_decode($response->getBody()->getContents(), true);

                if(is_null($renderJob->vau_job_id)){
                    // Add generated render job info
                    $renderJob->vau_job_id = $content['id'];
                    $renderJob->status = $content['renderStatus']['state'];
                    $renderJob->message = $content['renderStatus']['message'];
                    $renderJob->progress = $content['renderStatus']['progressPercent'];
                    $renderJob->left_seconds = $content['renderStatus']['etlSec'];
                    $renderJob->created_at = date('Y-m-d H:i:s', strtotime($content['created']));
                    $renderJob->finished_at = date('Y-m-d H:i:s');
                    $renderJob->finished_at = isset($content['finished']) ? date('Y-m-d H:i:s', strtotime($content['finished'])) : null;
                    
                    $renderJob->update();
                }else{
                    // Update render job info
                    $renderJob->status = $content['renderStatus']['state'];
                    $renderJob->message = $content['renderStatus']['message'];
                    $renderJob->progress = $content['renderStatus']['progressPercent'];
                    $renderJob->left_seconds = $content['renderStatus']['etlSec'];
                    $renderJob->finished_at = date('Y-m-d H:i:s');
                    $renderJob->finished_at = isset($content['finished']) ? date('Y-m-d H:i:s', strtotime($content['finished'])) : null;
                    
                    $renderJob->update();
                }

                return response()->json(['job_id' => $renderJob->id, 'message' => "The rendering job was successfully created. please wait until finished..."]);
            }
        }catch(BadResponseException $ex){
            die($ex->getMessage());
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
}