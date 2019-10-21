<?php

namespace App\Http\Controllers\API;

use App\RenderJob;
use App\AutomationApp;
use App\CustomTemplate;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Storage;

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
        // Fetch if this render job exists
        $renderJob = RenderJob::find($renderID);
        if(is_null($renderJob))
            return response()->json(['message' => "Job does not exists!"], 404);
        elseif(is_null($renderJob->vau_job_id)) 
            return response()->json(['message' => "Job requested not created yet!"], 400);

        // Get the render job status and update the db
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

            // Save the generated video to the private local resources
            if($renderJob->status == 'done' && strpos($renderJob->message, "Output files uploaded to storage") !== false){
                $outputName = uniqid() . '_' . pathinfo($content['outputUrls']['mainFile'], PATHINFO_BASENAME);
                $targetOutputPath = AutomationApp::OUTPUT_DIRECTORY_NAME . DIRECTORY_SEPARATOR . $outputName;
                Storage::disk('local')->put($targetOutputPath, file_get_contents($content['outputUrls']['mainFile']));
                $renderJob->output_url = route('cdn.cutomTemplate.files', ['collection' =>  'outputs', 'customTemplateID' => $renderJob->template_id, 'fileName' => $outputName]);
            }
            
            // Update the render job info
            $renderJob->status = $content['renderStatus']['state'];
            $renderJob->message = $content['renderStatus']['message'];
            $renderJob->progress = $content['renderStatus']['progressPercent'];
            $renderJob->left_seconds = $content['renderStatus']['etlSec'];
            $renderJob->finished_at = isset($content['finished']) ? date('Y-m-d H:i:s', strtotime($content['finished'])) : null;
            $renderJob->update();

            // TODO: send notif to user

            return response()->json(['data' => $renderJob->toArray()]);
        }

        return response()->json(['message' => "Bad request! please try again or contact support"], 400);
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
        // Fetch if this render job exists
        $renderJob = RenderJob::find($renderID);
        if(is_null($renderJob))
            return response()->json(['message' => "Job does not exists!"], 404);

        // Get the render job status and update the db
        $content = $request->all();
        if(!is_null($content) && isset($content['renderStatus']) && sizeof($content['renderStatus']) > 0){
            // Save the generated video to the private local resources
            if($renderJob->status == 'done' && strpos($renderJob->message, "Output files uploaded to storage") !== false){
                $outputName = uniqid() . '_' . pathinfo($content['outputUrls']['mainFile'], PATHINFO_BASENAME);
                if(!is_null($renderJob->output_name))
                    $outputName = $renderJob->output_name . '.' . pathinfo($content['outputUrls']['mainFile'], PATHINFO_EXTENSION);
                $targetOutputPath = AutomationApp::OUTPUT_DIRECTORY_NAME . DIRECTORY_SEPARATOR . $outputName;
                Storage::disk('local')->put($targetOutputPath, file_get_contents($content['outputUrls']['mainFile']));
                $renderJob->output_url = route('cdn.cutomTemplate.files', ['collection' =>  'outputs', 'customTemplateID' => $renderJob->template_id, 'fileName' => $outputName]);
            }

            // Update the render job info
            $renderJob->status = $content['renderStatus']['state'];
            $renderJob->message = $content['renderStatus']['message'];
            $renderJob->progress = $content['renderStatus']['progressPercent'];
            $renderJob->left_seconds = $content['renderStatus']['etlSec'];
            $renderJob->finished_at = !isset($content['finished']) ? date('Y-m-d H:i:s', strtotime($content['finished'])) : null;
            $renderJob->update();

            // TODO: send notif to user

            return response()->json(['data' => $renderJob->toArray()]);
        }

        return response()->json(['message' => "Bad request! please try again or contact support"], 400);
    }

    /**
     * Copy the generated video from Online VAU resources to our private local resources
     *
     * @param string $outputFilePath
     * @param string $vauOutputUrl
     * @return void
     */
    private function copyVAUOutputFile($outputFilePath, $vauOutputUrl) : void
    {
        // If the doesn't exists on the local resources
        if(!file_exists(strtolower($outputFilePath)) && isset($vauOutputUrl)){
            // Copy file from online VAU API resources
            $tempFile = tempnam(sys_get_temp_dir(), $outputFilePath);
            if(filter_var($vauOutputUrl, FILTER_VALIDATE_URL))
                copy($vauOutputUrl, $tempFile);
        }

        // Save the output file to the private local storage
        Storage::disk('local')->put(strtolower($outputFilePath), file_get_contents($tempFile), 'private');
    }
}
