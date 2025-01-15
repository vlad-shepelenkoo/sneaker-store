<?php

namespace App\Http\Controllers\Admin;

use App\Actions\CreateSize;
use App\Actions\UpdateOrCreateSize;
use App\Models\Brand;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddProductRequest;
use App\Http\Requests\Admin\EditProductRequest;
use App\Models\Product;
use App\Models\Sizes;
use App\Services\Admin\ProductService;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService,
                                private CreateSize $createSize,
                                private UpdateOrCreateSize $updateOrCreateSize){}

    public function products(){
        $products = Product::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.products', compact('products'));
    }

    public function product_add(){
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $brands = Brand::select('id', 'name')->orderBy('name')->get();
        return view('admin.product-add', compact('categories', 'brands'));
    }

    public function product_store(AddProductRequest $request){
        $valdiatedProduct = $request->validated();
        $product = $this->productService->store($valdiatedProduct);

        $sizes = $request->sizes;
        foreach($sizes as $size){
            $this->createSize->handle($product->id, $size); 
        }
        return redirect()->route('admin.products')->with('status', 'Product has been adeed successfully');
    }

    public function product_edit($id){
        $product = Product::find($id);
        $itemSizes = Sizes::where('product_id', $id)->get();
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $brands = Brand::select('id', 'name')->orderBy('name')->get();
        return view('admin.product-edit', compact('product', 'categories', 'brands', 'itemSizes'));
    }

    public function product_update(EditProductRequest $request){
        $sizes = $request->sizes;
        $valdiatedProduct = $request->validated();
        $product = Product::find($request->id);

        $this->productService->update($valdiatedProduct, $product);

        foreach($sizes as $size){
            $this->updateOrCreateSize->handle($product->id, $size);
        }
        return redirect()->route('admin.products')->with('status', 'Product has been updated successfully');
    }

    public function product_delete($id){
        $this->productService->delete($id);
        return redirect()->route('admin.products')->with('status', 'Product has been deleted successfully');
    }
}