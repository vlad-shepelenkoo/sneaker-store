<?php

namespace App\Services\Admin;

use App\Constants;
use App\Helpers\CheckFileForExistsHelper;
use App\Helpers\GenerateThumbnailsImageHelper;
use App\Models\Category;

class CategoryService
{
    public function __construct(private CheckFileForExistsHelper $checkFileForExists){}

    public function store(array $categoryData) : Category
    {
        $image = $categoryData['image'];
        $categoryData['image'] = GenerateThumbnailsImageHelper::generateThumbnail(Constants::CATEGORY_IMAGE_FOLDER, Constants::CATEGORY_IMAGE_SIZE, $image);
        $category = Category::create($categoryData);

        return $category;
    }

    public function update(array $categoryData, Category $category) : Category
    {
        if(isset($categoryData['image']))
        {
            $this->checkFileForExists->checkFile(Constants::CATEGORY_IMAGE_FOLDER, $category->image);
            $image = $categoryData['image'];
            $categoryData['image'] = GenerateThumbnailsImageHelper::generateThumbnail(Constants::CATEGORY_IMAGE_FOLDER, Constants::CATEGORY_IMAGE_SIZE, $image);
        }
        $category->update($categoryData);

        return $category;
    }

    public function delete($categoryId) : void
    {
        $category = Category::find($categoryId);
        $this->checkFileForExists->checkFile(Constants::CATEGORY_IMAGE_FOLDER, $category->image);
        $category->delete();
    }
}
