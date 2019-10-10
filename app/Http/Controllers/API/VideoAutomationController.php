<?php

namespace App\Http\Controllers\API;

use App\RenderJob;
use App\AutomationApp;
use App\CustomTemplate;
use Illuminate\Http\Request;
use App\Entities\VAU\TemplateEntity;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\BadResponseException;

class VideoAutomationController extends Controller
{
    // public function test(){
    //     $tempFile = tempnam(sys_get_temp_dir(), 'super_social_media.mp4');
    //     copy('https://s3-eu-west-1.amazonaws.com/vauvideo/assets/vauvideo/vau-public/super_social_media/super_social_media_THUMB.mp4', $tempFile);
    //     Storage::disk('public')->put('templates/super_social_media.mp4', $tempFile);
    // }

    /**
     * Render job
     *
     * @return \Illuminate\Http\Response
     */
    public function render(Request $request)
    {
        try{
            // Init the render job
            $renderJob = new RenderJob();

            // Handle requested template from body json to object
            $body = $request->all();

            if(!isset($body['template']['id']))
                return response()->json(['message' => "You need to choice a template!"], 400);

            // Set the template id
            $vauTemplateID = $body['template']['id'];

            // Fetch the custom template
            $customTemplate = CustomTemplate::where('vau_id', $vauTemplateID)->first();
            if(is_null($customTemplate))
                return response()->json(['message' => "Template does not exists!"], 400);

            // Check the inputs are valid
            $customTemplateMedias = $customTemplate->medias();
            if(!isset($body['inputs']))
                return response()->json(['message' => "You must upload the medias"], 400);
            elseif(sizeof($body['inputs']) < $customTemplateMedias->count())
                return response()->json(['message' => "Submitted medias are not correct!"], 400);

            // File name
            $fileName = $customTemplate->name;
            if(isset($body['name']))
                $fileName = $body['name'];

            // Prepare the callback/notification url
            $renderJob->template_id = $vauTemplateID;
            $renderJob->status = RenderJob::DEFAULT_STATUS;
            $renderJob->save();

            // Re-form the body
            $videoData = [];
            $videoData['template'] = $body['template'];
            $videoData['input'] = $body['inputs'];
            $videoData['name'] = $fileName;
            $videoData['notificationUrl'] = route('cron.notify', ['jobID' => $renderJob->id]);

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

                // Check if the queued render job is already exists
                // $existsRenderJob = RenderJob::where('vau_job_id', $content['id'])->get();

                if(is_null($renderJob->vau_job_id)){
                    // Add generated render job info
                    $renderJob->vau_job_id = $content['id'];
                    $renderJob->status = $content['renderStatus']['state'];
                    $renderJob->message = $content['renderStatus']['message'];
                    $renderJob->progress = $content['renderStatus']['progressPercent'];
                    $renderJob->left_seconds = $content['renderStatus']['etlSec'];
                    $renderJob->output_url = $content['outputUrls']['mainFile'];
                    $renderJob->created_at = date('Y-m-d H:i:s', strtotime($content['created']));
                    $renderJob->finished_at = !is_null($content['finished']) ? date('Y-m-d H:i:s', strtotime($content['finished'])) : null;
                    
                    $renderJob->update();
                }else{
                    // Update render job info
                    $renderJob->status = $content['renderStatus']['state'];
                    $renderJob->message = $content['renderStatus']['message'];
                    $renderJob->progress = $content['renderStatus']['progressPercent'];
                    $renderJob->left_seconds = $content['renderStatus']['etlSec'];
                    $renderJob->finished_at = !is_null($content['finished']) ? date('Y-m-d H:i:s', strtotime($content['finished'])) : null;
                    
                    $renderJob->update();
                }

                return response()->json($renderJob->toArray());
            }
        }catch(BadResponseException $ex){
            switch($ex->getResponse()->getStatusCode()){
                case 400:
                    return response()->json(['message' => "Please verify that the template entries are correct!"], 400);
                break;
                case 404:
                    //return response()->json("Incorrect video render job identity! please try again or contact support", 404);
                break;
                default:
                    return response(['message' => "Internal server error to create the video! please try again or contact support"], 500);
                break;
            }
        }
    }

    /**
     * Get status of job progress
     *
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request, $renderID, $action = null)
    {
        try{
            // Fetch if this render job exists
            $renderJob = RenderJob::find($renderID);
            if(is_null($renderJob))
                return response()->json(['message' => "Job does not exists!"], 404);
            elseif(is_null($renderJob->vau_job_id)) 
                return response()->json(['message' => "Job requested not started yet!"], 400);

            // Init Guzzle client
            $headers = [
                'X-AUTH-TOKEN'  =>  AutomationApp::ACCESS_TOKEN
            ];
            $client = new GuzzleClient(['headers' => $headers]);

            // Send the requet to vau API
            $response = $client->request(
                'GET',
                AutomationApp::API_URL . '/v1/jobs/' . $renderJob->vau_job_id, 
                [
                    // TODO: enable the verification on prod
                    'verify'    =>  false
                ]
            );

            // Handle the response
            if($response->getStatusCode() === 200){
                // Content of response
                $content = json_decode($response->getBody()->getContents(), true);
                $result = [
                    'job'       =>  $content['id'],
                    'createdAt' =>  $content['created'],
                    'status'    =>  $content['renderStatus']['state'],
                    'progress'  =>  $content['renderStatus']['progressPercent'],
                    'left'      =>  $content['renderStatus']['etlSec'],
                    'message'   =>  $content['renderStatus']['message'],
                    'file'      =>  $content['outputUrls']['mainFile'],
                    'finishedAt'=>  $content['finished']
                    //'name'      =>  $content['name']
                ];

                // If status is done and action equal download file
                if($result['status'] == 'done' && !is_null($action) && $action == 'download' && strpos($result['message'], "Output files uploaded to storage") !== false){
                    // Copy online generated file to temp file
                    $fileName = "test.mp4";
                    $tempFile = tempnam(sys_get_temp_dir(), $fileName);
                    copy($result['file'], $tempFile);

                    return response()->download($tempFile, $fileName)->deleteFileAfterSend();
                }

                return response()->json($result);
            }
        }catch(BadResponseException $ex){
            switch($ex->getResponse()->getStatusCode()){
                case 404:
                    return response()->json(['message' => "The video render job does not exist! please try again or contact support"], 404);
                break;
                case 400:
                    return response()->json(['message' => "Incorrect video render job identity! please try again or contact support"], 400);
                break;
                default:
                    return response()->json(['message' => "Internal server error to create the video! please try again or contact support"], 500);
                break;
            }
        }
    }
}