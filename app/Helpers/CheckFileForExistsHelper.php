<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;

class CheckFileForExistsHelper
{
    public static function checkFile($folder, $image)
    {
        if(File::exists(public_path($folder).'/'.$image)){
            File::delete(public_path($folder).'/'.$image);
        }
    }
}
