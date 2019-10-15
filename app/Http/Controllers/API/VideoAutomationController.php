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

class VideoAutomationController extends Controller
{
    /**
     * Retrieve all the custom templates
     *
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        // Retrieve all custom templates
        $customTemplates = CustomTemplate::all();

        if($customTemplates->count() > 0)
            return response()->json(['data' => $customTemplates]);

        // Return no content if no data
        return response()->json([], 204);
    }

    /**
     * Retrieve custom template by ID
     *
     * @param int $templateID
     * @return JsonResponse
     */
    public function show(int $templateID) : JsonResponse
    {
        $customTemplate = CustomTemplate::with('medias')->find($templateID);
        if(!is_null($customTemplate))
            return response()->json(['data' => $customTemplate->toArray()]);

        return response()->json(['message' => "The requested template does not exists!"], 404);
    }

    /**
     * Submit new custom template
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request) : JsonResponse
    {
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
            'medias.*.placeholder'  =>  'required|string',
            'medias.*.type'         =>  'nullable|in:' . implode(',', TemplateMedia::ALLOWED_TYPES),
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
        if(isset($data['preview_path']))
            $customTemplate->preview_path = $this->copyFileToLocalDisk($data['preview_path'], AutomationApp::TEMPLATES_DIRECTORY_NAME, $customTemplate->id);

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

        // Adjust the template medias
        foreach($data['medias'] as $key => $media){
            $templateMedia = new TemplateMedia();
            $templateMedia->template_id = $customTemplate->id;
            $templateMedia->placeholder = str_replace(' ', '_', $media['placeholder']);
            $templateMedia->type = isset($media['type']) ? $media['type'] : TemplateMedia::DEFAULT_TYPE;
            if(isset($media['default_value']) && isset($media['type']) && $media['type'] != TemplateMedia::DEFAULT_TYPE)
                $templateMedia->default_value = $media['default_value'];
            (!isset($media['position'])) ? $key + 1 : $media['position'];

            // Copy the media preview
            if(isset($media['preview_path'])){
                $mediaDirectory = AutomationApp::TEMPLATES_DIRECTORY_NAME . DIRECTORY_SEPARATOR . $customTemplate->id . DIRECTORY_SEPARATOR . 'medias' . DIRECTORY_SEPARATOR;
                $templateMedia->preview_path = $this->copyFileToLocalDisk($media['preview_path'], $mediaDirectory);
            }

            $customTemplate->medias()->save($templateMedia);
        }

        // Return the inserted template id
        return response()->json(['template_id' => $customTemplate->id, 'message' => "The template '" . $data['name'] . "' has been added successfully."]);
    }
    
    /**
     * Update a custom template
     *
     * @param Request $request
     * @param int $templateID
     * @return JsonResponse
     */
    public function update(Request $request, int $templateID) : JsonResponse
    {
        // Get the request data
        $data = $request->all();

        // Custom template rules
        $rules = [
            'vau_id'        =>  'nullable|integer',
            'name'          =>  'nullable|string|between:1,100',
            'rotation'      =>  'nullable|in:' . implode(',', CustomTemplate::ROTAIONS),
            'package'       =>  'nullable|string',
            'version'       =>  'nullable',
            'preview_path'  =>  'nullable|string',
            'enabled'       =>  'nullable|in:0,1',
            'medias'        =>  'nullable',
            'medias.*.id'           =>  'nullable|integer',
            'medias.*.placeholder'  =>  'required|string',
            'medias.*.type'         =>  'nullable|in:' . implode(',', TemplateMedia::ALLOWED_TYPES),
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
        $customTemplate = CustomTemplate::find($templateID);
        if(is_null($customTemplate))
            return response()->json(['message' => "The requested template does not exists!"], 404);
        
        // Copy the preview
        if(isset($data['preview_path']))
            $customTemplate->preview_path = $this->copyFileToLocalDisk($data['preview_path'], AutomationApp::TEMPLATES_DIRECTORY_NAME, $customTemplate->id);

        // Store the template info
        $customTemplate->name = $data['name'];
        $customTemplate->vau_id = $data['vau_id'];
        if(isset($data['package']))
            $customTemplate->package = $data['package'];
        if(isset($data['version']))
            $customTemplate->version = $data['version'];
        $customTemplate->enabled = (isset($data['enabled']) && in_array($data['enabled'], [0, 1])) ? $data['enabled'] : 1;
        $customTemplate->updated_at = date('Y-m-d H:i:s');
        // $customTemplate->created_at = (isset($data['created_at'])) ? $data['created_at'] : date('Y-m-d H:i:s');
        $customTemplate->update();

        // Adjust the template medias
        foreach($data['medias'] as $key => $media){
            // Init template media obj
            $templateMedia = new TemplateMedia();

            // Retrieve the template media obj if already exists
            if(isset($media['id'])){
                $existsMedia = TemplateMedia::find($media['id']);

                if(!is_null($existsMedia))
                    $templateMedia = $existsMedia;
            }

            $templateMedia->template_id = $customTemplate->id;
            $templateMedia->placeholder = str_replace(' ', '_', $media['placeholder']);
            $templateMedia->type = isset($media['type']) ? $media['type'] : TemplateMedia::DEFAULT_TYPE;
            if(isset($media['default_value']) && isset($media['type']) && $media['type'] != TemplateMedia::DEFAULT_TYPE)
                $templateMedia->default_value = $media['default_value'];
            if(isset($media['position']))
                $customTemplate->position = $media['position'];

            // Copy the media preview
            if(isset($media['preview_path'])){
                $mediaDirectory = AutomationApp::TEMPLATES_DIRECTORY_NAME . DIRECTORY_SEPARATOR . $customTemplate->id . DIRECTORY_SEPARATOR . 'medias' . DIRECTORY_SEPARATOR;
                $templateMedia->preview_path = $this->copyFileToLocalDisk($media['preview_path'], $mediaDirectory);
            }

            // Add as a new media
            if(!isset($media['id'])){
                $customTemplate->medias()->save($templateMedia);
            }
            // Update an exists template media
            elseif(isset($existsMedia->id)){
                $templateMedia->updated_at = date('Y-m-d H:i:s');

                $templateMedia->update();
            }
                
        }

        // Return the inserted template id
        return response()->json(['template_id' => $customTemplate->id, 'message' => "The template '" . $data['name'] . "' has been updated successfully."]);
    }

    /**
     * Delete a custom template
     *
     * @param int $templateID
     * @return JsonResponse
     */
    public function delete(int $templateID) : JsonResponse
    {
        $customTemplate = CustomTemplate::with(['medias', 'jobs'])->find($templateID);
        if(is_null($customTemplate))
            return response()->json(['message' => 'The requested template does not exists!'], 404);
            
        // Delete the custom template model also the relations
        $customTemplate->delete();

        return response()->json(['message' => "The " . $customTemplate->name . " has been deleted successfully."], 200);
    }

    /**
     * Add new media to an exists custom template
     *
     * @param Request $request
     * @param int $templateID
     * @return JsonResponse
     */
    public function addMedia(Request $request, int $templateID) : JsonResponse
    {
        // Get all the submitted data
        $media = $request->all();

        // Set the validation rules
        $rules = [
            // 'medias'        =>  'required|min:1',
            // 'medias.*.id'           =>  'nullable|integer',
            'placeholder'  =>  'required|string',
            'type'         =>  'required|in:' . implode(',', TemplateMedia::ALLOWED_TYPES),
            'color'        =>  'nullable|string',
            'default_value'=>  'nullable|string',
            'preview_path' =>  'nullable|string',
            'position'     =>  'nullable|integer',
            // 'updated_at'    =>  'datetime:Y-m-d H:i:s',
            // 'created_at'    =>  'datetime:Y-m-d H:i:s',
        ];

        // Validate the data
        $validator = Validator::make($media, $rules);
        if($validator->fails())
            return response()->json(['message' => $validator->getMessageBag()->all()], 400);

        // Verify if this template already exists
        $customTemplate = CustomTemplate::find($templateID);
        if(is_null($customTemplate))
            return response()->json(['message' => "The requested template does not exists!"], 404);

        // Add the template medias
        $templateMedia = new TemplateMedia();
        $templateMedia->template_id = $customTemplate->id;
        $templateMedia->placeholder = str_replace(' ', '_', $media['placeholder']);
        $templateMedia->type = isset($media['type']) ? $media['type'] : TemplateMedia::DEFAULT_TYPE;
        if(isset($media['default_value']) && isset($media['type']) && $media['type'] != TemplateMedia::DEFAULT_TYPE)
            $templateMedia->default_value = $media['default_value'];
        
        if(isset($media['position'])){
            $templateMedia->position = $media['position'];
        }else{
            $lastRow = TemplateMedia::latest('position')->first();
            if(!is_null($lastRow))
                $templateMedia->position = $lastRow->position;
        }

        // Copy the media preview
        if(isset($media['preview_path'])){
            $mediaDirectory = AutomationApp::TEMPLATES_DIRECTORY_NAME . DIRECTORY_SEPARATOR . $customTemplate->id . DIRECTORY_SEPARATOR . 'medias' . DIRECTORY_SEPARATOR;
            $templateMedia->preview_path = $this->copyFileToLocalDisk($media['preview_path'], $mediaDirectory);
        }

        $templateMedia->save();

        // Return the done response
        return response()->json(['template_id' => $customTemplate->id, 'message' => "The medias has been added successfully."]);
    }

    /**
     * Update an exists media for a custom template
     *
     * @param Request $request
     * @param int $mediaID
     * @return JsonResponse
     */
    public function updateMedia(Request $request, int $mediaID) : JsonResponse
    {
        // Get all the submitted data
        $media = $request->all();

        // Set the validation rules
        $rules = [
            'placeholder'  =>  'nullable|string',
            'type'         =>  'nullable|in:' . implode(',', TemplateMedia::ALLOWED_TYPES),
            'color'        =>  'nullable|string',
            'default_value'=>  'nullable|string',
            'preview_path' =>  'nullable|string',
            'position'     =>  'nullable|integer'
        ];

        // Validate the submitted data
        $validator = Validator::make($media, $rules);
        if($validator->fails())
            return response()->json(['message' => $validator->getMessageBag()->all()], 400);

        // Verify if this template media already exists
        $templateMedia = TemplateMedia::find($mediaID);
        if(is_null($templateMedia))
            return response()->json(['message' => "The requested media does not exists!"], 404);

        // Update the template media
        if(isset($media['placeholder']))
            $templateMedia->placeholder = str_replace(' ', '_', $media['placeholder']);
        $templateMedia->type = isset($media['type']) ? $media['type'] : TemplateMedia::DEFAULT_TYPE;
        if(isset($media['default_value']) && isset($media['type']) && $media['type'] != TemplateMedia::DEFAULT_TYPE)
            $templateMedia->default_value = $media['default_value'];
        if(isset($media['position']))
            $templateMedia->position = $media['position'];

        // Copy the media preview
        if(isset($media['preview_path'])){
            $mediaDirectory = AutomationApp::TEMPLATES_DIRECTORY_NAME . DIRECTORY_SEPARATOR . $templateMedia->template_id . DIRECTORY_SEPARATOR . 'medias' . DIRECTORY_SEPARATOR;
            $templateMedia->preview_path = $this->copyFileToLocalDisk($media['preview_path'], $mediaDirectory);
        }

        $templateMedia->update();

        // Return the done response
        return response()->json(['media_id' => $templateMedia->id, 'message' => "The media has been updated successfully."]);
    }

    /**
     * Delete an exists template media
     *
     * @param int $mediaID
     * @return JsonResponse
     */
    public function deleteMedia(int $mediaID) : JsonResponse
    {
        $templateMedia = TemplateMedia::find($mediaID);
        if(is_null($templateMedia))
            return response()->json(['message' => 'The requested media does not exists!'], 404);
            
        // Delete the custom template model also the relations
        $templateMedia->delete();

        return response()->json(['message' => "The media has been deleted successfully."], 200);
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

            if(!isset($body['template']['id']))
                return response()->json(['message' => "You need to choice a template!"], 400);

            // Set the template id
            $selectedTemplateID = $body['template']['id'];

            // Fetch the custom template
            $customTemplate = CustomTemplate::find($selectedTemplateID);
            if(is_null($customTemplate))
                return response()->json(['message' => "Template does not exists!"], 400);

            // Check the inputs are valid
            $customTemplateMedias = $customTemplate->medias();
            if(!isset($body['inputs']))
                return response()->json(['message' => "You must upload the medias!"], 400);
            elseif($customTemplate->enabled != 1)
                return response()->json(['message' => "This template not enabled or not for use!"], 400);
            elseif(sizeof($body['inputs']) < $customTemplateMedias->whereNotIn('type', ['text', 'color'])->count())
                return response()->json(['message' => "The submitted media are not the same as those required by the video template!"], 400);

            // Validation rules
            $rules = [
                'template.id'               =>  'required|integer',
                'inputs'                    =>  'required|min:1',
                'name'                      =>  'nullable|string'
            ];
            // Validate the main body template
            $validator = Validator::make($body, $rules);
            if($validator->fails())
                return response()->json(['message' => $validator->getMessageBag()->all()], 400);

            // Verify if some render job already started
            $this->ClearDieRenderJobs();

            // File name
            $fileName = $customTemplate->name;
            if(isset($body['name']))
                $fileName = $body['name'];

            // Prepare the callback/notification url
            $renderJob->template_id = $customTemplate->id;
            $renderJob->status = RenderJob::DEFAULT_STATUS;
            $renderJob->save();

            // Re-form the body
            $videoData = [];
            $videoData['template'] = $body['template'];
            $videoData['template']['id'] = $customTemplate->vau_id;
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

                return response()->json(['data' => $renderJob->toArray()]);
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
     * @return JsonResponse
     */
    public function status(int $renderID, string $action = null) : JsonResponse
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

                return response()->json(['data' => $result]);
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

    /**
     * Copy file to the local disk
     *
     * @param string $path
     * @return string|null
     */
    private function copyFileToLocalDisk(string $path, string $directory = null, string $uniqueID = null) : ?string
    {
        if(!is_null($path)){
            $fileExtension = pathinfo($path, PATHINFO_EXTENSION);
            $demoFileName = pathinfo($path, PATHINFO_FILENAME) . '.' . $fileExtension;
            $tempFile = tempnam(sys_get_temp_dir(), $demoFileName);

            // Copy from online ressource
            if(filter_var($path, FILTER_VALIDATE_URL))
                copy($path, $tempFile);
            // TODO: handle the uploaded preview

            // Save file to local disk
            if(!is_null($directory) && !is_null($uniqueID)){
                $targetDirectory = $directory . DIRECTORY_SEPARATOR . $uniqueID . DIRECTORY_SEPARATOR;
                Storage::disk('public')->put($targetDirectory . $demoFileName, file_get_contents($tempFile));
            }

            return $demoFileName;
        }

        // If not success return a null path
        return null;
    }

    /**
     * Clear dies render jobs
     *
     * @return void
     */
    private function ClearDieRenderJobs() : void
    {
        // Fetch only created jobs without running
        $renderJobs = RenderJob::where('status', RenderJob::DEFAULT_STATUS)->get();

        foreach($renderJobs as $renderJob){
            // Creating time plus thirty minutes
            $plusThirtyMinutes = strtotime('+30 minutes', strtotime($renderJob->createdAt));
            // Remove the older jobs
            if($plusThirtyMinutes < date('Y-m-d H:i:s') || is_null($renderJob->created_at))
                $renderJob->delete();
        }
    }
}