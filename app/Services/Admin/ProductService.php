<?php

namespace App\Services\Admin;

use App\Constants;
use App\Helpers\CheckFileForExistsHelper;
use App\Helpers\GenerateThumbnailsImageHelper;
use App\Models\Product;

class ProductService
{
    public function __construct(private CheckFileForExistsHelper $checkFileForExists){}

    public function store(array $productData) : Product
    {
        $image = $productData['image'];
        $productData['image'] = GenerateThumbnailsImageHelper::generateThumbnail(Constants::PRODUCT_IMAGE_FOLDER, Constants::PRODUCT_IMAGE_SIZE, $image, 1);
        
        $galleryImageFiles = $productData['images'];
        $gallery_arr = $this->createGalleryImages($galleryImageFiles);
        
        $gallery_images = implode(',', $gallery_arr);
        $productData['images'] = $gallery_images;
        $product = Product::create($productData);
        return $product;
    }

    public function update(array $productData, Product $product) : Product
    {
        if(isset($productData['image']))
        {
            $this->checkFileForExists->checkFile(Constants::PRODUCT_IMAGE_FOLDER, $product->image);
            $this->checkFileForExists->checkFile(Constants::PRODUCT_IMAGE_THUMBNAILS_FOLDER, $product->image);

            $image = $productData['image'];
            $productData['image'] = GenerateThumbnailsImageHelper::generateThumbnail(Constants::PRODUCT_IMAGE_FOLDER, Constants::PRODUCT_IMAGE_SIZE, $image, 1);
        }

        foreach(explode(',', $product->images) as $file)
        {
            $this->checkFileForExists->checkFile(Constants::PRODUCT_IMAGE_FOLDER, $file);
            $this->checkFileForExists->checkFile(Constants::PRODUCT_IMAGE_THUMBNAILS_FOLDER, $file);
        }

        if(isset($productData['images']))
        {
            $galleryImageFiles = $productData['images'];
            $gallery_arr = $this->createGalleryImages($galleryImageFiles);
            $gallery_images = implode(',', $gallery_arr);
            $productData['images'] = $gallery_images;
        }

        $product->update($productData);

        return $product;
    }

    public function delete($productId) : void 
    {
        $product = Product::find($productId);
        
        $this->checkFileForExists->checkFile(Constants::PRODUCT_IMAGE_FOLDER, $product->image);
        $this->checkFileForExists->checkFile(Constants::PRODUCT_IMAGE_THUMBNAILS_FOLDER, $product->image);

        foreach(explode(',', $product->images) as $file)
        { 
            $this->checkFileForExists->checkFile(Constants::PRODUCT_IMAGE_FOLDER, $file);
            $this->checkFileForExists->checkFile(Constants::PRODUCT_IMAGE_THUMBNAILS_FOLDER, $file);
        }
        $product->delete();
    }

    private function createGalleryImages($files)
    {
        $gallery_arr = array();
        $counter = 2;
        foreach($files as $file){
            $extension = $file->getClientOriginalExtension();
            $gcheck = in_array($extension, Constants::ALLOWED_FILES_EXTENSIONS);
            if($gcheck){
                $fileImage = GenerateThumbnailsImageHelper::generateThumbnail(Constants::PRODUCT_IMAGE_FOLDER, Constants::PRODUCT_IMAGE_SIZE, $file, $counter);
                array_push($gallery_arr, $fileImage);
                $counter += 1;
            }
        }

        return $gallery_arr;
    }
}
