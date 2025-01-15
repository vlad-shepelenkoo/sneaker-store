<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBrandRequest;
use App\Http\Requests\Admin\UpdateBrandRequest;
use App\Services\Admin\BrandService;

class BrandController extends Controller
{
    public function __construct(private BrandService $brandService)
    {
    }

    public function brands(){
        $brands = Brand::sortBy('id', 'DESC')->paginate(10);
        return view('admin.brands', compact('brands'));
    }

    public function addBrand(){
        return view('admin.brand-add');
    }

    public function brand_store(StoreBrandRequest $request){
        $this->brandService->store($request->validated());
        return redirect()->route('admin.brands')->with('status', "Brand has been added succesfully");
    }

    public function brand_edit($id){
        $brand = Brand::find($id);
        return view('admin.brand-edit', compact('brand'));
    }

    public function brand_update(UpdateBrandRequest $request){
        $brand = Brand::find($request->id);
        $this->brandService->update($request->validated(), $brand);
        return redirect()->route('admin.brands')->with('status', "Brand has been updated succesfully");
    }

    public function brand_delete($id){
        $this->brandService->delete($id);
        return redirect()->route('admin.brands')->with('status', 'Brand has been deleted successfuly');
    }    
}