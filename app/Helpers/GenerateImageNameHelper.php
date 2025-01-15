<?php

namespace App\Helpers;

use Carbon\Carbon;

class GenerateImageNameHelper
{
    public static function generateImageName($image, $numImage = '') : string
    {
        $file_extension = $image->extension();
        $file_name = Carbon::now()->timestamp.$numImage.'.'.$file_extension;
        return $file_name;
    }
}