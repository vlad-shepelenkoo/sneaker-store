<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Sizes;
use App\Models\Product;
use App\Models\Reviews;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class ShopService
{
    public function filterProducts(Request $request) : array
    {
        $pageSize = $request->query('pageSize') ? $request->query('pageSize') : 12;
        $o_column = "";
        $o_order = "";
        $order = $request->query('order') ? $request->query('order') : -1;
        $f_brands = $request->query('brands');
        $f_categories = $request->query('categories');
        $min_price = $request->query('min') ? $request->query('min') : 1;
        $max_price = $request->query('max') ? $request->query('max') : 500;
        $itemSizes = Sizes::get();
        switch((int)$order){
            case 1: 
                $o_column='created_at';
                $o_order='DESC';
                break;
            case 2: 
                $o_column='created_at';
                $o_order='ASC';
                break;
            case 3: 
                $o_column='regular_price';
                $o_order='ASC';
                break;
            case 4: 
                $o_column='regular_price';
                $o_order='DESC';
                break;
            default:
                $o_column='id';
                $o_order='DESC';
        }

        $queryResult = [$pageSize, $o_column, $o_order, $order, $f_brands, $f_categories, $min_price, $max_price, $itemSizes];
        return $queryResult;
    } 

    public function details($product_slug) : array
    {   
        $itemSizes = Sizes::get();
        $product = Product::where('slug', $product_slug)->first();
        $reviews = Reviews::where('product_id', $product->id)->join('users', 'user_id', '=', 'users.id')->get();
        $reviewsCount = Reviews::where('product_id', $product->id)->count();
        $reviewsAvg = Reviews::selectRaw('avg(rating) as rate')->where('product_id', $product->id)->first()['rate'];
        $cartProductSizes = [];
        $cartItems = Cart::instance('cart')->content()->select('id','options');
        foreach($cartItems as $item){
            if($item['id'] == $product->id){
                array_push($cartProductSizes, $item['options']->size);
            }
        }
        $sizes = Sizes::where('product_id', $product->id)->whereNotIn('size', $cartProductSizes)->get();
        $productDetails = [$itemSizes, $product, $sizes, $reviews, $reviewsCount, $reviewsAvg];
        return $productDetails;
    }
}
