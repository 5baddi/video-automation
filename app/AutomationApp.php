<?php

namespace App;

use App\RenderJob;
use Illuminate\Support\Facades\Storage;

class AutomationApp
{
    const COMPANY_NAME = "V12 Software";

    const API_URL = "https://api.vau.company";
    const ACCESS_TOKEN = "";

    const TEMPLATES_DIRECTORY_NAME = "va_templates";
    const OUTPUT_DIRECTORY_NAME = "va_outputs";

    const DEFAULT_ROTATION = "sqaure";
    
    const INTERNAL_SERVER_ERROR = "Internal server error! please try again or contact support";

    const DIMENSIONS = [
        'landscape'     => ['width' => 1280, 'height' => 720],
        'portrait'      => ['width' => 1280, 'height' => 2275.56],
        'square'        => ['width' => 1280, 'height' => 1280]
    ];

    /**
     * Generate the render job output Path
     *
     * @param RenderJob $renderJob
     * @param string $onlineOutputURL
     * @return string
     */
    public static function generateOutputPath(RenderJob $renderJob, string $onlineOutputURL) : string
    {
        // Init target path
        $onlineOutputPath = AutomationApp::OUTPUT_DIRECTORY_NAME . DIRECTORY_SEPARATOR . $renderJob->template_id . DIRECTORY_SEPARATOR . $renderJob->id . DIRECTORY_SEPARATOR;
                
        // Parse the output url
        if(is_null($renderJob->output_url)){
            // Generate the filename
            $outputName = uniqid(date('dmY')) . '_' . pathinfo($onlineOutputURL, PATHINFO_BASENAME);
            if(!is_null($renderJob->output_name))
                $outputName = $renderJob->output_name . '_' . uniqid(date('dmY')) . '.' . pathinfo($onlineOutputURL, PATHINFO_EXTENSION);
            
            // Update target path
            $onlineOutputPath .= $outputName;
            $onlineOutputPath = Storage::disk('local')->path($onlineOutputPath);
        }else{
            // Get the filename from the output url
            $onlineOutputPath .= pathinfo($renderJob->output_url, PATHINFO_BASENAME);
        }

        return $onlineOutputPath;
    }
}
