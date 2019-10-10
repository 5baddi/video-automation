<?php

namespace App\Http\Controllers\API;

use App\RenderJob;
use App\Http\Controllers\Controller;

class CronController extends Controller
{
    /**
     * Notify the user when the job is done
     *
     * @return \Illuminate\Http\Response
     */
    public function notify($renderID)
    {
        try{
            // Clear the exists & not started render jobs
            $this->ClearDieRenderJobs();

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

                // TODO: send notif to user

                return response()->json(['data' => $renderJob->toArray()]);
            }

            return response()->json(['message' => "Bad request! please try again or contact support"], 400);
        }catch(\Exception $ex){
            return response(['message' => "Internal server error! please try again or contact support"], 500);
        }
    }

    /**
     * Clear dies render jobs
     *
     * @return void
     */
    private function ClearDieRenderJobs()
    {
        try{
            // Fetch only created jobs without running
            $renderJobs = RenderJob::where('status', RenderJob::DEFAULT_STATUS)->get();

            foreach($renderJobs as $renderJob){
                // Creating time plus thirty minutes
                $plusThirtyMinutes = strtotime('+30 minutes', strtotime($renderJob->createdAt));
                // Remove the older jobs
                if($plusThirtyMinutes < date('Y-m-d H:i:s') || is_null($renderJob->created_at))
                    $renderJob->delete();
            }
        }catch(\Exception $ex){
            // TODO: hanlde the exception log
        }
    }
}
