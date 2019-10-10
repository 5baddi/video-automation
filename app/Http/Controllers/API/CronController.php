<?php

namespace App\Http\Controllers\API;

use App\RenderJob;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CronController extends Controller
{
    /**
     * Notify the user when the job is done
     *
     * @return \Illuminate\Http\Response
     */
    public function notify(Request $request, $renderID)
    {
        try{
            // Fetch if this render job exists
            $renderJob = RenderJob::find($renderID);
            if(is_null($renderJob))
                return response()->json(['message' => "Job does not exists!"], 404);

            // Get the render job status and update the db
            $renderJobStatusResponse = app(VideoAutomationController::class)->status($request, $renderJob->vau_job_id);
            if($renderJobStatusResponse->getStatusCode() == 200){
                $renderJobStatus = json_decode($renderJobStatusResponse->getContent(), true);
                
                // Update the render job info
                $renderJob->status = $renderJobStatus['status'];
                $renderJob->message = $renderJobStatus['message'];
                $renderJob->progress = $renderJobStatus['progress'];
                $renderJob->left_seconds = $renderJobStatus['left_seconds'];
                $renderJob->finished_at = !is_null($renderJobStatus['finished']) ? date('Y-m-d H:i:s', strtotime($renderJobStatus['finished'])) : null;
                $renderJob->update();

                // TODO: send notif to user

                return response()->json(['message' => $renderJob->toArray()]);
            }

            return response()->json(['message' => "Bad request! please try again or contact support"], 400);
        }catch(\Exception $ex){
            return response(['message' => "Internal server error! please try again or contact support"], 500);
        }
    }
}
