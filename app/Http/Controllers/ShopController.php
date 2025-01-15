<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Reviews;
use App\Services\ShopService;
use Illuminate\Http\Request;

class ShopController extends Controller
{

    public function __construct(private ShopService $shopService)
    {
    }

    public function index(Request $request){
        [$pageSize, $o_column, $o_order, $order, $f_brands, $f_categories, $min_price, $max_price, $itemSizes] = $this->shopService->filterProducts($request);
        $brands =  Brand::orderBy('name', "ASC")->get();
        $categories = Category::orderBy('name', "ASC")->get();
        $products = Product::showFilteredProduct($f_brands, $f_categories, $min_price, $max_price, $o_column, $o_order, $pageSize);
        return view('shop', compact('products', 'pageSize', 'order', 'brands', 'f_brands', 'categories', 'f_categories', 'min_price', 'max_price', 'itemSizes'));
    }

    public function product_details($product_slug){
        [$itemSizes, $product, $sizes, $reviews, $reviewsCount, $reviewsAvg] = $this->shopService->details($product_slug);
        $rproducts = Product::where('slug', '<>', $product_slug)->get()->take(8);
        return view('details', compact('product', 'rproducts', 'sizes', 'itemSizes', 'reviews', 'reviewsCount', 'reviewsAvg'));
    }

    public function add_review(ReviewRequest $request){
        $validatedReview = $request->validated();
        Reviews::create($validatedReview);
        return redirect()->back();
    }
}
