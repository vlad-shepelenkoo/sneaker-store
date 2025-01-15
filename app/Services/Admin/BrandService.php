<?php

namespace App\Services\Admin;

use App\Constants;
use App\Helpers\CheckFileForExistsHelper;
use App\Helpers\GenerateThumbnailsImageHelper;
use App\Models\Brand;

class BrandService
{
    public function __construct(private CheckFileForExistsHelper $checkFileForExists){}

    public function store(array $brandData) : Brand
    {   
        $image = $brandData['image'];
        $brandData['image'] = GenerateThumbnailsImageHelper::generateThumbnail(Constants::BRAND_IMAGE_FOLDER, Constants::BRAND_IMAGE_SIZE, $image);
        $brand = Brand::create($brandData);

        return $brand;
    }

    public function update(array $brandData, Brand $brand) : Brand
    {
        if(isset($brandData['image']))
        {
            $this->checkFileForExists->checkFile(Constants::BRAND_IMAGE_FOLDER, $brand->image);

            $image = $brandData['image'];
            $brandData['image'] = GenerateThumbnailsImageHelper::generateThumbnail(Constants::BRAND_IMAGE_FOLDER, Constants::BRAND_IMAGE_SIZE, $image);
        }
        $brand->update($brandData);

        return $brand;
    }

    public function delete($brandId) : void
    {
        $brand = Brand::find($brandId);
        $this->checkFileForExists->checkFile(Constants::BRAND_IMAGE_FOLDER, $brand->image);
        $brand->delete();
    }
}
