<?php

namespace App\Http\Controllers\API;

use App\RenderJob;
use App\AutomationApp;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CronController extends Controller
{    
    /**
     * Notify the user about the render job directly after done
     *
     * @param Request $request
     * @param int $renderID
     * @return JsonResponse
     */
    public function vauNotify(Request $request, int $renderID) : JsonResponse
    {
        // Fetch if this render job exists
        $renderJob = RenderJob::find($renderID);
        if(is_null($renderJob))
            return response()->json(['message' => "Job does not exists!"], 404);

        // Get the render job status and update the db
        $content = $request->all();
        if(!is_null($content) && isset($content['renderStatus']) && sizeof($content['renderStatus']) > 0){
            // Update the render job info
            $renderJob->status = $content['renderStatus']['state'];
            $renderJob->message = $content['renderStatus']['message'];
            $renderJob->progress = $content['renderStatus']['progressPercent'];
            $renderJob->left_seconds = $content['renderStatus']['etlSec'];
            $renderJob->finished_at = !isset($content['finished']) ? date('Y-m-d H:i:s', strtotime($content['finished'])) : null;
            
            // Save the generated video to the private local resources
            if($renderJob->status == 'done' && strpos($renderJob->message, "Output files uploaded to storage") !== false){
                $outputName = uniqid() . '_' . pathinfo($content['outputUrls']['mainFile'], PATHINFO_BASENAME);
                if(!is_null($renderJob->output_name))
                    $outputName = $renderJob->output_name . '.' . pathinfo($content['outputUrls']['mainFile'], PATHINFO_EXTENSION);
                $targetOutputPath = AutomationApp::OUTPUT_DIRECTORY_NAME . DIRECTORY_SEPARATOR . $renderJob->template_id . DIRECTORY_SEPARATOR . $outputName;
                Storage::disk('local')->copy($content['outputUrls']['mainFile'], $targetOutputPath);
                $renderJob->output_url = route('cdn.cutomTemplate.files', ['collection' =>  'outputs', 'customTemplateID' => $renderJob->template_id, 'fileName' => $outputName]);
            }

            // Save the new values
            $renderJob->update();

            // TODO: send notif to user

            return response()->json(['data' => $renderJob->toArray()]);
        }

        return response()->json(['message' => "Bad request! please try again or contact support"], 400);
    }
}
