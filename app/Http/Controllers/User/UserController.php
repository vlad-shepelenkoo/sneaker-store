<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class UserController extends Controller
{
    public function index(){
        return view('user.index');
    }

    public function wishlist(){
        $user = User::find(Auth::user()->id);
        $items = Cart::instance('wishlist')->content();
        $items->map(function($item){
            $item->product = Product::find($item->id);
        });
        return view('user.account-wishlist', compact('user', 'items'));
    }
}
