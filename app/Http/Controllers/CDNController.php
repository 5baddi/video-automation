<?php

namespace App\Http\Controllers;

use App\AutomationApp;
use Gumlet\ImageResize;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CDNController extends Controller
{
    /**
     * Download the generated video
     *
     * @param int $createdAt
     * @param string $fileName
     * @return Response
     */
    public function downloadOutputVideo(int $createdAt, string $fileName)
    {
        // Check if already exists on the public disk
        $outputPath = AutomationApp::OUTPUT_DIRECTORY_NAME . DIRECTORY_SEPARATOR . $createdAt . DIRECTORY_SEPARATOR . strtolower($fileName);
        $exists = Storage::disk('local')->exists($outputPath);
        if(!$exists)
            return response()->json(['message' => "The requested file does not exists!"], 404);
        
        // Force downloading the file
        return Storage::download($outputPath, strtolower($fileName));
    }

    /**
     * Retrieve the custom template thumbnail
     *
     * @param int $id
     * @param string $fileName
     * @param int|null $width
     * @param int|null $height
     * @return Response
     */
    public function retrieveCustomTemplateThumbnail(int $id, string $fileName, int $width = null, int $height = null)
    {
        // Check if already exists on the public disk
        $thumbnailPath = AutomationApp::TEMPLATES_DIRECTORY_NAME . DIRECTORY_SEPARATOR . $id . DIRECTORY_SEPARATOR . strtolower($fileName);
        $exists = Storage::disk('public')->exists($thumbnailPath);
        if(!$exists)
            return response()->json(['message' => "The requested file does not exists!"], 404);

        // Resize the thumbnail
        if(!is_null($width) && !is_null($height)){
            $resizedThumbPath = $this->resizeImage($thumbnailPath, $width, $height);
            
            if(!is_null($resizedThumbPath))
                $thumbnailPath = $resizedThumbPath;
        }

        // Get the thumbnail file
        $thumbnail = Storage::disk('public')->get($thumbnailPath);
        return response($thumbnail)->header('Content-Type', 'image/jpeg');
    }

    /**
     * Create resized image
     *
     * @param string $originalImagePath
     * @param int $width
     * @param int $height
     * @return string|null
     */
    private function resizeImage(string $originalImagePath, int $width, int $height) : ?string
    {
        // Check if exists the original thumbnail
        if(!Storage::disk('public')->exists($originalImagePath))
            return null;

        // Check if exists the resized image
        $resizedImgPath = pathinfo($originalImagePath, PATHINFO_DIRNAME) . DIRECTORY_SEPARATOR . pathinfo($originalImagePath, PATHINFO_FILENAME);
        if(!is_null($width) && !is_null($height))
            $resizedImgPath .= '_' . $width . 'x' . $height . '.' . pathinfo($originalImagePath, PATHINFO_EXTENSION);

        // Check if the image exists
        if(!Storage::disk('public')->exists($resizedImgPath)){
            // Resize image
            $img = new ImageResize(Storage::disk('public')->path($originalImagePath));
            $img->resizeToBestFit($width, $height);

            // Save image
            $img->save(Storage::disk('public')->path($resizedImgPath));

            return $resizedImgPath;
        }

        return $originalImagePath;
    }
}
