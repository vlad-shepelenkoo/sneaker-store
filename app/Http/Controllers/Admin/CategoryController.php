<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Services\Admin\CategoryService;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService)
    {}

    public function categories(){
        $categories = Category::sortBy('id', 'DESC')->paginate(10);
        return view('admin.categories', compact('categories'));
    }

    public function category_add(){
        return view('admin.category-add');
    }

    public function category_store(StoreCategoryRequest $request){
        $this->categoryService->store($request->validated());
        return redirect()->route('admin.categories')->with('status', "Category has been added succesfully");
    }

    public function category_edit($id){
        $category = Category::find($id);
        return view('admin.category-edit', compact('category'));
    }

    public function category_update(UpdateCategoryRequest $request){
        $category = Category::find($request->id);
        $this->categoryService->update($request->validated(), $category);
        return redirect()->route('admin.categories')->with('status', "Category has been updated succesfully");
    }

    public function category_delete($id){
        $this->categoryService->delete($id);
        return redirect()->route('admin.categories')->with('status', 'Category has been deleted successfully');
    }
}