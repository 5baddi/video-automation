<?php

namespace App\Http\Controllers\API;

use App\AutomationApp;
use App\TemplateMedia;
use App\CustomTemplate;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

// TODO: Update add template && medias	
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
     * Retrieve all the custom templates thumbnails
     *
     * @param string $rotation
     * @return JsonResponse
     */
    public function templatesThumbnails(string $rotation = "square") : JsonResponse
    {
        // Retrieve all custom templates
        $customTemplates = CustomTemplate::withCount('medias')
            ->where(['rotation' => $rotation, 'enabled' => 1])
            ->orderBy('created_at', 'desc')
            ->get();

        if($customTemplates->count() > 0)
            return response()->json(['status' => 'success', 'data' => $customTemplates]);

        // Return no content if no data
        return response()->json(['status' => 'no data', 'data' => null], 204);
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
            return response()->json(['status' => 'success', 'data' => $customTemplate->toArray()]);

        return response()->json(['status' => 'not found', 'message' => "The requested template does not exists!"], 404);
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
            'version'       =>  'nullable|string|between:1,25',
            'demo'          =>  'nullable|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime',
            'thumbnail'     =>  'nullable|mimes:jpg,jpeg,bmp,png',
            'gif'           =>  'nullable|mimes:gif',
            'enabled'       =>  'nullable|in:0,1'
        ];

        // Validate data
        $validator = Validator::make($data, $rules);
        if($validator->fails())
            return response()->json(['status' => 'bad request', 'message' => $validator->getMessageBag()->all()], 400);

        // Verify if this template already exists
        $existsCustomTemplate = CustomTemplate::where('name', $data['name'])->orWhere('vau_id', $data['vau_id'])->get();
        if($existsCustomTemplate->count() > 0)
            return response()->json(['status' => 'bad request', 'message' => "The template '" . $data['name'] . "' is already exists!"], 400);

        // Init custom template obj
        $customTemplate = new CustomTemplate();
        
        // Store the template info
        $customTemplate->name = $data['name'];
        $customTemplate->vau_id = $data['vau_id'];
        if(isset($data['package']))
            $customTemplate->package = $data['package'];
        if(isset($data['version']))
            $customTemplate->version = $data['version'];
        $customTemplate->rotation = (isset($data['rotation'])) ? $data['rotation'] : AutomationApp::DEFAULT_ROTATION;
        $customTemplate->enabled = (isset($data['enabled']) && in_array($data['enabled'], [0, 1])) ? $data['enabled'] : 1;
        $customTemplate->created_at = (isset($data['created_at'])) ? $data['created_at'] : date('Y-m-d H:i:s');
        $customTemplate->save();

        // Upload the attached preview and thumbnail
        if($request->hasfile('demo') || $request->hasFile('thumbnail') || $request->hasFile('gif')){
            try{
                // Parse the target path and file names
                $targetTemplatePath = AutomationApp::TEMPLATES_DIRECTORY_NAME . DIRECTORY_SEPARATOR . $customTemplate->id;
                
                // Upload the demo video
                if($request->hasFile('demo')){
                    $demoFileName = strtolower(str_replace(' ', '_', $customTemplate->name)) . '.' . $request->file('demo')->getClientOriginalExtension();
                    $request->file('demo')->storeAs($targetTemplatePath, $demoFileName, 'public');
                    $customTemplate->preview_url = route('cdn.cutomTemplate.files', ['collection' =>  'demos', 'customTemplateID' => $customTemplate->id, 'fileName' => $demoFileName]);
                }
                
                // Upload the thumbnail
                if($request->hasFile('thumbnail')){
                    $thumbnailFileName = strtolower(str_replace(' ', '_', $customTemplate->name)) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
                    $customTemplate->thumbnail_url = route('cdn.cutomTemplate.files', ['collection' =>  'thumbnails', 'customTemplateID' => $customTemplate->id, 'fileName' => $thumbnailFileName]);
                    $request->file('thumbnail')->storeAs($targetTemplatePath, $thumbnailFileName, 'public');
                }
                
                // Upload the gif
                if($request->hasFile('gif')){
                    $gifFileName = strtolower(str_replace(' ', '_', $customTemplate->name)) . '.' . $request->file('gif')->getClientOriginalExtension();
                    $customTemplate->gif_url = route('cdn.cutomTemplate.files', ['collection' =>  'thumbnails', 'customTemplateID' => $customTemplate->id, 'fileName' => $gifFileName]);
                    $request->file('gif')->storeAs($targetTemplatePath, $gifFileName, 'public');
                }
    
                $customTemplate->update();
            }catch(\Exception $ex){
                throw new \Exception("Demo video and thumbnail attached are not allowed or damaged!");
            }
        }

        // Return the inserted template id
        return response()->json([
            'status'      => 'success',
            'template_id' => $customTemplate->id, 
            'demo'        => $customTemplate->preview_url,
            'thumbnail'   => $customTemplate->thumbnail_url,
            'message' => "The template '" . $data['name'] . "' has been added successfully."
        ]);
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
            // 'medias'        =>  'nullable',
            // 'medias.*.id'           =>  'nullable|integer',
            // 'medias.*.placeholder'  =>  'required|string',
            // 'medias.*.type'         =>  'nullable|in:' . implode(',', TemplateMedia::ALLOWED_TYPES),
            // 'medias.*.color'        =>  'nullable|string',
            // 'medias.*.default_value'=>  'nullable|string',
            // 'medias.*.preview_path' =>  'nullable|string',
            // 'medias.*.position'     =>  'nullable|integer',
            // 'updated_at'    =>  'datetime:Y-m-d H:i:s',
            // 'created_at'    =>  'datetime:Y-m-d H:i:s',
        ];

        // Validate data
        $validator = Validator::make($data, $rules);
        if($validator->fails())
            return response()->json(['status' => 'bad request', 'message' => $validator->getMessageBag()->all()], 400);

        // Verify if this template already exists
        $customTemplate = CustomTemplate::find($templateID);
        if(is_null($customTemplate))
            return response()->json(['status' => 'not found', 'message' => "The requested template does not exists!"], 404);
        
        // Copy the preview
        // if(isset($data['preview_path']))
        //     $customTemplate->preview_path = $this->copyFileToPublicDisk($data['preview_path'], AutomationApp::TEMPLATES_DIRECTORY_NAME, $customTemplate->id);

        // TODO: Upload files to resources

        // Store the template info
        $customTemplate->name = $data['name'];
        $customTemplate->vau_id = $data['vau_id'];
        if(isset($data['package']))
            $customTemplate->package = $data['package'];
        if(isset($data['version']))
            $customTemplate->version = $data['version'];
        if(isset($data['rotation']))
            $customTemplate->rotation = $data['rotation'];
        $customTemplate->enabled = (isset($data['enabled']) && in_array($data['enabled'], [0, 1])) ? $data['enabled'] : 1;
        $customTemplate->updated_at = date('Y-m-d H:i:s');
        // $customTemplate->created_at = (isset($data['created_at'])) ? $data['created_at'] : date('Y-m-d H:i:s');
        $customTemplate->update();

        // Adjust the template medias
        // foreach($data['medias'] as $key => $media){
        //     // Init template media obj
        //     $templateMedia = new TemplateMedia();

        //     // Retrieve the template media obj if already exists
        //     if(isset($media['id'])){
        //         $existsMedia = TemplateMedia::find($media['id']);

        //         if(!is_null($existsMedia))
        //             $templateMedia = $existsMedia;
        //     }

        //     $templateMedia->template_id = $customTemplate->id;
        //     $templateMedia->placeholder = str_replace(' ', '_', $media['placeholder']);
        //     $templateMedia->type = isset($media['type']) ? $media['type'] : TemplateMedia::SCENE_TYPE;
        //     if(isset($media['default_value']) && isset($media['type']) && $media['type'] != TemplateMedia::SCENE_TYPE)
        //         $templateMedia->default_value = $media['default_value'];
        //     if(isset($media['position']))
        //         $customTemplate->position = $media['position'];

        //     // Copy the media preview
        //     // if(isset($media['preview_path'])){
        //     //     $mediaDirectory = AutomationApp::TEMPLATES_DIRECTORY_NAME . DIRECTORY_SEPARATOR . $customTemplate->id . DIRECTORY_SEPARATOR . 'medias' . DIRECTORY_SEPARATOR;
        //     //     $templateMedia->preview_path = $this->copyFileToPublicDisk($media['preview_path'], $mediaDirectory);
        //     // }

        //     // TODO: Upload files to resources

        //     // Add as a new media
        //     if(!isset($media['id'])){
        //         $customTemplate->medias()->save($templateMedia);
        //     }
        //     // Update an exists template media
        //     elseif(isset($existsMedia->id)){
        //         $templateMedia->updated_at = date('Y-m-d H:i:s');

        //         $templateMedia->update();
        //     }
                
        // }

        // Return the inserted template id
        return response()->json(['status' => 'success', 'template_id' => $customTemplate->id, 'message' => "The template '" . $data['name'] . "' has been updated successfully."]);
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
            return response()->json(['status' => 'not found', 'message' => 'The requested template does not exists!'], 404);
            
        // Delete the custom template model also the relations
        $customTemplate->delete();

        // Remove the template preview & medias
        $templateDirectory = AutomationApp::TEMPLATES_DIRECTORY_NAME . DIRECTORY_SEPARATOR . $customTemplate->id;
        if(is_dir($templateDirectory))
            rmdir($templateDirectory);

        // Force delete the directory
        if(is_dir($templateDirectory))
            shell_exec("rm -rf ${templateDirectory}");

        return response()->json(['status' => 'success', 'message' => "The " . $customTemplate->name . " has been deleted successfully."], 200);
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
            'scene'        =>  'required|integer',
            'placeholder'  =>  'required|string',
            'type'         =>  'required|in:' . implode(',', TemplateMedia::ALLOWED_TYPES),
            'color'        =>  'nullable|string',
            'default_value'=>  'nullable|string',
            'position'     =>  'nullable|integer',
            'thumbnail_url'=>  'nullable|mimes:jpg,jpeg,bmp,png,gif',
            'default'      =>  'nullable|mimes:jpg,jpeg,bmp,png,gif',
            // 'updated_at'    =>  'datetime:Y-m-d H:i:s',
            // 'created_at'    =>  'datetime:Y-m-d H:i:s',
        ];

        // Validate the data
        $validator = Validator::make($media, $rules);
        if($validator->fails())
            return response()->json(['status' => 'bad request', 'message' => $validator->getMessageBag()->all()], 400);

        // Verify if this template already exists
        $customTemplate = CustomTemplate::find($templateID);
        if(is_null($customTemplate))
            return response()->json(['status' => 'not found', 'message' => "The requested template does not exists!"], 404);

        // Add the template medias
        $templateMedia = new TemplateMedia();
        $templateMedia->template_id = $customTemplate->id;
        $templateMedia->scene = $media['scene'];
        $templateMedia->placeholder = str_replace(' ', '_', $media['placeholder']);
        $templateMedia->type = isset($media['type']) ? $media['type'] : TemplateMedia::SCENE_TYPE;
        
        // Text color
        if(isset($media['color']) && $media['type'] != TemplateMedia::SCENE_TYPE)
            $templateMedia->color = $media['color'];

        // Item position
        if(isset($media['position'])){
            $templateMedia->position = $media['position'];
        }else{
            $lastRow = TemplateMedia::latest('position')->first();
            if(!is_null($lastRow))
                $templateMedia->position = $lastRow->position + 1;
        }

        // Text default value
        if(isset($media['default_value']) && $templateMedia->type != TemplateMedia::SCENE_TYPE){
            $templateMedia->default_value = $media['default_value'];
        }
        // Copy the remote default value to local
        elseif(isset($media['default_value']) && filter_var($media['default_value'], FILTER_VALIDATE_URL)){
            $fileName = strtolower(str_replace(' ', '_', pathinfo($media['default_value'], PATHINFO_BASENAME)));
            $temp = tempnam(sys_get_temp_dir(), $fileName);
            $directory = AutomationApp::TEMPLATES_DIRECTORY_NAME . DIRECTORY_SEPARATOR . $customTemplate->id . DIRECTORY_SEPARATOR . 'defaults';

            // Check if file exists
            $path = $directory . DIRECTORY_SEPARATOR . $fileName;
            // $fullPath = Storage::disk('public')->path($path);
            if(!Storage::disk('public')->exists($path)){
                copy($media['default_value'], $temp);
                Storage::disk('public')->put($path, file_get_contents($temp));
            }

            // Set the default value url
            $templateMedia->default_value = route('cdn.cutomTemplate.files', ['collection' =>  'defaults', 'customTemplateID' => $customTemplate->id, 'fileName' => $fileName]);
        }
        // Upload default value
        elseif($request->hasFile('default')){
            try{
                // Parse the target path and file names
                $targetTemplatePath = AutomationApp::TEMPLATES_DIRECTORY_NAME . DIRECTORY_SEPARATOR . $customTemplate->id . DIRECTORY_SEPARATOR . 'defaults';
                $defaultFileName = uniqid() . '_' . $request->file('default')->getClientOriginalName();
                
                // Upload the demo video
                $request->file('default')->storeAs($targetTemplatePath, $defaultFileName, 'public');
                $templateMedia->default_value = route('cdn.cutomTemplate.files', ['collection' =>  'defaults', 'customTemplateID' => $customTemplate->id, 'fileName' => $defaultFileName]);
            }catch(\Exception $ex){
                throw new \Exception("Media thumbnail are not allowed or damaged!");
            }
        }

        // Upload media preview
        if($request->hasFile('thumbnail')){
            try{
                // Parse the target path and file names
                $targetTemplatePath = AutomationApp::TEMPLATES_DIRECTORY_NAME . DIRECTORY_SEPARATOR . $customTemplate->id . DIRECTORY_SEPARATOR . 'medias';
                $mediaFileName = uniqid() . '_' . $request->file('thumbnail')->getClientOriginalName();
                
                // Upload the demo video
                $request->file('thumbnail')->storeAs($targetTemplatePath, $mediaFileName, 'public');
                $templateMedia->thumbnail_url = route('cdn.cutomTemplate.files', ['collection' =>  'medias', 'customTemplateID' => $customTemplate->id, 'fileName' => $mediaFileName]);
            }catch(\Exception $ex){
                throw new \Exception("Media thumbnail are not allowed or damaged!");
            }
        }

        $templateMedia->save();

        // Return the done response
        return response()->json(['status' => 'success', 'media_id' => $templateMedia->id, 'message' => "The medias has been added successfully."]);
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
            'position'     =>  'nullable|integer',
            'preview'      =>  'nullable|mimes:jpg,jpeg,bmp,png,gif',
        ];

        // Validate the submitted data
        $validator = Validator::make($media, $rules);
        if($validator->fails())
            return response()->json(['status' => 'bad request', 'message' => $validator->getMessageBag()->all()], 400);

        // Verify if this template media already exists
        $templateMedia = TemplateMedia::width('template')->find($mediaID);
        if(is_null($templateMedia))
            return response()->json(['status' => 'not found', 'message' => "The requested media does not exists!"], 404);

        // Update the template media
        if(isset($media['placeholder']))
            $templateMedia->placeholder = str_replace(' ', '_', $media['placeholder']);
        $templateMedia->type = isset($media['type']) ? $media['type'] : TemplateMedia::SCENE_TYPE;
        if(isset($media['position']))
            $templateMedia->position = $media['position'];

        if(isset($media['default_value']) && isset($media['type']) && $media['type'] != TemplateMedia::SCENE_TYPE){
            $templateMedia->default_value = $media['default_value'];
        }
        // Copy the remote default value to local
        elseif(filter_var($templateMedia->default_value, FILTER_VALIDATE_URL)){
            $fileName = strtolower(str_replace(' ', '_', pathinfo($templateMedia->default_value, PATHINFO_BASENAME)));
            $temp = tempnam(sys_get_temp_dir(), $fileName);
            $directory = AutomationApp::TEMPLATES_DIRECTORY_NAME . DIRECTORY_SEPARATOR . $templateMedia->template()->id . DIRECTORY_SEPARATOR . 'defaults';

            // Check if file exists
            $path = $directory . DIRECTORY_SEPARATOR . $fileName;
            $fullPath = Storage::disk('public')->path($path);
            if(!Storage::disk('public')->exists($path))
                copy($temp, $fullPath);

            // Set the default value url
            $templateMedia->default_value = route('cdn.cutomTemplate.files', ['collection' =>  'defaults', 'customTemplateID' => $templateMedia->template()->id, 'fileName' => $fileName]);
        }

        // Upload media preview
        if($request->hasFile('preview') && $templateMedia->type == TemplateMedia::SCENE_TYPE){
            try{
                // Parse the target path and file names
                $targetTemplatePath = AutomationApp::TEMPLATES_DIRECTORY_NAME . DIRECTORY_SEPARATOR . $templateMedia->template()->id . DIRECTORY_SEPARATOR . 'medias';
                $mediaFileName = 'preview' . uniqid() . $request->file('preview')->getClientOriginalExtension();
                
                // Upload the demo video
                $request->file('preview')->storeAs($targetTemplatePath, $mediaFileName, 'public');
                $templateMedia->preview_url = route('cdn.cutomTemplate.files', ['collection' =>  'medias', 'customTemplateID' => $templateMedia->template()->id, 'fileName' => $mediaFileName]);
            }catch(\Exception $ex){
                throw new \Exception("Media preview are not allowed or damaged!");
            }
        }

        $templateMedia->update();

        // Return the done response
        return response()->json(['status' => 'success', 'media_id' => $templateMedia->id, 'message' => "The media has been updated successfully."]);
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
            return response()->json(['status' => 'success', 'message' => 'The requested media does not exists!'], 404);
            
        // Delete the custom template model also the relations
        $templateMedia->delete();

        // Delete the media preview
        // if(!is_null($templateMedia->preview_path) && file_exists($templateMedia->preview_path))
        //     unlink($templateMedia->preview_path);

        return response()->json(['status' => 'success', 'message' => "The media has been deleted successfully."], 200);
    }
}