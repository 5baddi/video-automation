<?php

namespace App\Http\Controllers\API;

use App\RenderJob;
use App\AutomationApp;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class CronController extends Controller
{
    /**
     * Notify the user about the render job
     *
     * @param int $renderID
     * @return JsonResponse
     */
    public function notify(int $renderID) : JsonResponse
    {
        try{
            // Clear the exists & not started render jobs
            // $this->ClearDieRenderJobs();

            // Fetch if this render job exists
            $renderJob = RenderJob::find($renderID);
            if(is_null($renderJob))
                return response()->json(['message' => "Job does not exists!"], 404);

            // Get the render job status and update the db
            $renderJobStatusResponse = app(VideoAutomationController::class)->status($renderJob->id);
            if($renderJobStatusResponse->getStatusCode() == 200){
                $renderJobStatus = json_decode($renderJobStatusResponse->getContent(), true);
                
                // Update the render job info
                $renderJob->status = $renderJobStatus['status'];
                $renderJob->message = $renderJobStatus['message'];
                $renderJob->progress = $renderJobStatus['progress'];
                $renderJob->left_seconds = $renderJobStatus['left'];
                $renderJob->finished_at = !is_null($renderJobStatus['finishedAt']) ? date('Y-m-d H:i:s', strtotime($renderJobStatus['finishedAt'])) : null;
                $renderJob->update();

                // Move output file from VAU API to the server storage
                $outputFile = uniqid() . DIRECTORY_SEPARATOR . str_replace(' ', '_', pathinfo($renderJobStatus['file'], PATHINFO_FILENAME)) . '.' . pathinfo($renderJobStatus['file'], PATHINFO_EXTENSION);
                $tempFile = tempnam(sys_get_temp_dir(), $outputFile);
                if(filter_var($renderJobStatus['file'], FILTER_VALIDATE_URL))
                    copy($renderJobStatus['file'], $outputFile);

                Storage::disk('private')->put(AutomationApp::OUTPUT_DIRECTORY_NAME . '/' . date('Ymd'), file_get_contents($tempFile));

                // TODO: send notif to user

                return response()->json(['data' => $renderJob->toArray()]);
            }

            return response()->json(['message' => "Bad request! please try again or contact support"], 400);
        }catch(\Exception $ex){
            return response(['message' => AutomationApp::INTERNAL_SERVER_ERROR], 500);
        }
    }
    
    /**
     * Notify the user about the render job directly after done
     *
     * @param Request $request
     * @param int $renderID
     * @return JsonResponse
     */
    public function vauNotify(Request $request, int $renderID) : JsonResponse
    {
        try{
            // Clear the exists & not started render jobs
            // $this->ClearDieRenderJobs();

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
                $renderJob->update();

                // Move output file from VAU API to the server storage
                $outputFile = uniqid() . DIRECTORY_SEPARATOR . str_replace(' ', '_', pathinfo($content['outputUrls']['mainFile'], PATHINFO_FILENAME)) . '.' . pathinfo($content['outputUrls']['mainFile'], PATHINFO_EXTENSION);
                $tempFile = tempnam(sys_get_temp_dir(), $outputFile);
                if(filter_var($content['outputUrls']['mainFile'], FILTER_VALIDATE_URL))
                    copy($content['outputUrls']['mainFile'], $outputFile);

                Storage::disk('private')->put(AutomationApp::OUTPUT_DIRECTORY_NAME . '/' . date('Ymd'), file_get_contents($tempFile));

                // TODO: send notif to user

                return response()->json(['data' => $renderJob->toArray()]);
            }

            return response()->json(['message' => "Bad request! please try again or contact support"], 400);
        }catch(\Exception $ex){
            return response(['message' => AutomationApp::INTERNAL_SERVER_ERROR], 500);
        }
    }
}
