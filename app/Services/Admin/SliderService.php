<?php

namespace App\Services\Admin;

use App\Constants;
use App\Helpers\CheckFileForExistsHelper;
use App\Helpers\GenerateThumbnailsImageHelper;
use App\Models\Slide;

class SliderService
{
    public function __construct(private CheckFileForExistsHelper $checkFileForExists){}

    public function store(array $sliderData) : Slide
    {
        $image = $sliderData['image'];
        $sliderData['image'] = GenerateThumbnailsImageHelper::generateThumbnail(Constants::SLIDE_IMAGE_FOLDER, Constants::SLIDE_IMAGE_SIZE, $image);
        $slide = Slide::create($sliderData);

        return $slide;
    }

    public function update(array $sliderData, Slide $slide) : Slide
    {
        if(isset($sliderData['image']))
        {
            $this->checkFileForExists->checkFile(Constants::SLIDE_IMAGE_FOLDER, $slide->image);
            $image = $sliderData['image'];
            $sliderData['image'] = GenerateThumbnailsImageHelper::generateThumbnail(Constants::SLIDE_IMAGE_FOLDER, Constants::SLIDE_IMAGE_SIZE, $image);
        }
        $slide->update($sliderData);

        return $slide;
    }

    public function delete($slideId) : void
    {
        $slide = Slide::find($slideId);
        $this->checkFileForExists->checkFile(Constants::SLIDE_IMAGE_FOLDER, $slide->image);
        $slide->delete();
    }
}
