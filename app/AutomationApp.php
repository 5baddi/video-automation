<?php

namespace App;

use App\RenderJob;
use Illuminate\Support\Facades\Storage;

class AutomationApp
{
    const COMPANY_NAME = "V12 Software";

    const API_URL = "https://api.vau.company";
    const ACCESS_TOKEN = "e61c55a57183d2fe29a3729de280b6e8076fe02c4c7f2e93924855b3fb2c64859db5fc6974e81b00390029b507b761b087ff4a5f93d6029cf8f2a511b6c97fac56baade3ef3328730c3056f99dac7952";

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
     * Generate the render job output URL
     *
     * @param RenderJob $renderJob
     * @param string $onlineOutputURL
     * @return string
     */
    public static function generateOutputURL(RenderJob $renderJob, string $onlineOutputURL) : string
    {
        // Init target path
        $targetOutputURL = AutomationApp::OUTPUT_DIRECTORY_NAME . DIRECTORY_SEPARATOR . $renderJob->template_id . DIRECTORY_SEPARATOR;
                
        // Update the output url
        if(is_null($renderJob->output_url)){
            // Generate the filename
            $outputName = uniqid(date('dmY')) . '_' . pathinfo($onlineOutputURL, PATHINFO_BASENAME);
            if(!is_null($renderJob->output_name))
                $outputName = $renderJob->output_name . '_' . uniqid(date('dmY')) . '.' . pathinfo($onlineOutputURL, PATHINFO_EXTENSION);
            
            // Update target path
            $targetOutputURL .= $outputName;
            $targetOutputURL = Storage::disk('local')->path($targetOutputURL);
        }else{
            // Get the filename from the output url
            $targetOutputURL .= pathinfo($renderJob->output_url, PATHINFO_BASENAME);
        }

        return $targetOutputURL;
    }
}