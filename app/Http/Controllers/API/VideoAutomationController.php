<?php

namespace App\Http\Controllers\API;

use App\RenderJob;
use App\AutomationApp;
use App\CustomTemplate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TemplateMedia;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Exception\BadResponseException;

class VideoAutomationController extends Controller
{
    /**
     * Retrieve all the custom templates
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['data' => CustomTemplate::all()]);
    }

    /**
     * Submit new custom template
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            // Get the request data
            $data = $request->all();

            // Custom template rules
            $rules = [
                'vau_id'        =>  'required|integer',
                'name'          =>  'required|string|between:1,100',
                'rotation'      =>  'required|in:' . implode(',', CustomTemplate::ROTAIONS),
                'package'       =>  'nullable|string',
                'version'       =>  'nullable',
                'preview_path'  =>  'nullable|string',
                'enabled'       =>  'nullable|in:0,1',
                'medias'        =>  'required|min:1',
                'medias.*.placeholder'  =>  'required',
                'medias.*.type'         =>  'required|in:' . implode(',', TemplateMedia::ALLOWED_TYPES),
                'medias.*.color'        =>  'nullable|string',
                'medias.*.default_value'=>  'nullable|string',
                'medias.*.preview_path' =>  'nullable|string',
                'medias.*.position'     =>  'nullable|integer',
                // 'updated_at'    =>  'datetime:Y-m-d H:i:s',
                // 'created_at'    =>  'datetime:Y-m-d H:i:s',
            ];

            // Validate data
            $validator = Validator::make($data, $rules);
            if($validator->fails())
                return response()->json(['message' => $validator->getMessageBag()->all()], 400);

            // Verify if this template already exists
            $existsCustomTemplate = CustomTemplate::where('name', $data['name'])->orWhere('vau_id', $data['vau_id'])->get();
            if($existsCustomTemplate->count() > 0)
                return response()->json(['message' => "The template '" . $data['name'] . "' is already exists!"], 400);

            // Init custom template obj
            $customTemplate = new CustomTemplate();
            
            // Copy the preview
            if(isset($data['preview_path'])){
                $fileName = str_replace(' ', '_', $data['name']);
                $fileExtension = pathinfo($data['preview_path'], PATHINFO_EXTENSION);
                $demoFileName = pathinfo($data['preview_path'], PATHINFO_FILENAME) . '.' . $fileExtension;
                $tempFile = tempnam(sys_get_temp_dir(), $demoFileName);

                // Copy from online ressource
                if(filter_var($data['preview_path'], FILTER_VALIDATE_URL))
                    copy($data['preview_path'], $tempFile);

                $customTemplate->preview_path = $demoFileName;
            }

            // Store the template info
            $customTemplate->name = $data['name'];
            $customTemplate->vau_id = $data['vau_id'];
            if(isset($data['package']))
                $customTemplate->package = $data['package'];
            if(isset($data['version']))
                $customTemplate->version = $data['version'];
            $customTemplate->enabled = (isset($data['enabled']) && in_array($data['enabled'], [0, 1])) ? $data['enabled'] : 1;
            // $customTemplate->created_at = (isset($data['created_at'])) ? $data['created_at'] : date('Y-m-d H:i:s');
            $customTemplate->save();

            // Move the temp file to the server
            if(isset($data['preview_path']))
                Storage::disk('public')->put('/templates/' . $customTemplate->id . '/' . $demoFileName, $tempFile);

            // Adjust the template medias
            foreach($data['medias'] as $key => $media){
                $templateMedia = new TemplateMedia();
                $templateMedia->template_id = $customTemplate->id;
                $templateMedia->placeholder = str_replace(' ', '_', $media['placeholder']);
                $templateMedia->type = $media['type'];
                if(isset($media['default_value']) && isset($media['type']) && $media['type'] != TemplateMedia::DEFAULT_TYPE)
                    $templateMedia->default_value = $media['default_value'];
                if(!isset($media['position']))
                    $templateMedia->position = $key + 1;

                // Copy the media preview
                if(isset($media['preview_path'])){
                    $mediaFileName = str_replace(' ', '_', pathinfo($media['preview_path'], PATHINFO_FILENAME));
                    $mediaPath = '/templates/' . $customTemplate->id . '/medias/' . $mediaFileName . '.' . PATHINFO($media['preview_path'], PATHINFO_EXTENSION);

                    $tempMedia = tempnam(sys_get_temp_dir(), $mediaFileName);

                    // Copy from online ressource
                    if(filter_var($media['preview_path'], FILTER_VALIDATE_URL))
                        copy($media['preview_path'], $tempMedia);

                    Storage::disk('public')->put($mediaFileName, $tempMedia);

                    $templateMedia->preview_path = $mediaPath;
                }

                $customTemplate->medias()->save($templateMedia);
            }

            // Return the inserted template id
            return response()->json(['template_id' => $customTemplate->id, 'message' => "The template '" . $data['name'] . "' added successfully."]);
        }catch(\Exception $ex){
            return response()->json(['message' => AutomationApp::INTERNAL_SERVER_ERROR], 500);
        }
    }

    /**
     * Exec render job
     *
     * @param Request $request
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
                return response()->json(['message' => "You must upload the medias!"], 400);
            elseif($customTemplate->enabled != 1 || sizeof($customTemplateMedias) == 0)
                return response()->json(['message' => "This template not enabled or not for use!"], 400);
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

                // Check if the queued render job is already exists
                // $existsRenderJob = RenderJob::where('vau_job_id', $content['id'])->get();

                if(is_null($renderJob->vau_job_id)){
                    // Add generated render job info
                    $renderJob->vau_job_id = $content['id'];
                    $renderJob->status = $content['renderStatus']['state'];
                    $renderJob->message = $content['renderStatus']['message'];
                    $renderJob->progress = $content['renderStatus']['progressPercent'];
                    $renderJob->left_seconds = $content['renderStatus']['etlSec'];
                    $renderJob->output_name = $fileName;
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
                    return response(['message' => AutomationApp::INTERNAL_SERVER_ERROR], 500);
                break;
            }
        }
    }

    /**
     * Get status of render job
     *
     * @param int $renderID
     * @param string $action
     * @return \Illuminate\Http\Response
     */
    public function status($renderID, $action = null)
    {
        try{
            // Fetch if this render job exists
            $renderJob = RenderJob::find($renderID);
            if(is_null($renderJob))
                return response()->json(['message' => "Job does not exists!"], 404);
            elseif(is_null($renderJob->vau_job_id)) 
                return response()->json(['message' => "Job requested not created yet!"], 400);

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
                    return response()->json(['message' => AutomationApp::INTERNAL_SERVER_ERROR], 500);
                break;
            }
        }
    }
}