<?php

namespace App\Helpers;

use App\Constants;
use Intervention\Image\Laravel\Facades\Image;

class GenerateThumbnailsImageHelper
{
    public static function generateThumbnail($path, $size, $image, $numImage = '')
    {
        $destinationPathThumbnail = public_path(Constants::PRODUCT_IMAGE_THUMBNAILS_FOLDER);
        $imageName = GenerateImageNameHelper::generateImageName($image, $numImage);
        $destinationPath = public_path($path);
        $img = Image::read($image->path());
        $img->cover($size['width'], $size['height'], "top");
        $img->resize($size['width'], $size['height'], function($constraint){
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$imageName);
        if($numImage){
            $img->resize(104,104, function($constraint){
                $constraint->aspectRatio();
            })->save($destinationPathThumbnail.'/'.$imageName);
        }
        return $imageName;
    }
}