<?php

namespace App\Http\Controllers;

use App\AutomationApp;
use App\CustomTemplate;
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
     * @param int $customTemplateID
     * @param string $fileName
     * @param int|null $width
     * @param int|null $height
     * @return Response
     */
    public function retrieveCustomTemplateThumbnail(int $customTemplateID, string $fileName, int $width = null, int $height = null)
    {
        $customTemplate = CustomTemplate::find($customTemplateID);
        if(is_null($customTemplate))
            abort(404);

        // Check if already exists on the public disk
        $thumbnailPath = AutomationApp::TEMPLATES_DIRECTORY_NAME . DIRECTORY_SEPARATOR . $customTemplateID . DIRECTORY_SEPARATOR . strtolower($fileName);
        $exists = Storage::disk('public')->exists($thumbnailPath);
        if(!$exists)
            return response()->json(['message' => "The requested file does not exists!"], 404);

        // Resize the thumbnail
        if(!is_null($width) && !is_null($height)){
            $resizedThumbPath = $this->resizeImage($thumbnailPath, $width, $height);
            
            if(!is_null($resizedThumbPath))
                return response()->redirectToRoute('cdn.thumbnail', ['customTemplateID' => $customTemplateID, 'fileName' => $fileName]);
        }

        // Get the image mime type also the content
        $thumbnail = Storage::disk('public')->get($thumbnailPath);
        $thumbnailPath = Storage::disk('public')->path($thumbnailPath);
        $thumbnailSize = getimagesize($thumbnailPath);

        // Show the thumbnail image
        return response($thumbnail)->header('Content-Type', $thumbnailSize['mime']);
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
        $bestFitImgPath = $resizedImgPath;
        if(!is_null($width) && !is_null($height))
            $resizedImgPath .= '_' . $width . 'x' . $height . '.' . pathinfo($originalImagePath, PATHINFO_EXTENSION);

        // Resize image
        $img = new ImageResize(Storage::disk('public')->path($originalImagePath));
        $img->resizeToBestFit($width, $height);

        // Save image
        $img->save(Storage::disk('public')->path($resizedImgPath));

        // Set the image new name for this fit
        $bestFitImgPath .= '_' . $img->dest_w . 'x' . $img->dest_h . '.' . pathinfo($originalImagePath, PATHINFO_EXTENSION);

        // Delete the temp resized thumb
        Storage::disk('public')->delete($resizedImgPath);

        // Check if already exists thumb with this fit
        if(!Storage::disk('public')->exists($bestFitImgPath))
            $img->save(Storage::disk('public')->path($bestFitImgPath)); // Save the image with this fit size name

        return $bestFitImgPath;
    }
}
