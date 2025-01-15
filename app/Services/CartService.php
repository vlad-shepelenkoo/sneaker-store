<?php

namespace App\Services;

use App\Constants;
use App\Models\Address;
use App\Http\Requests\Home\AddressRequest;
use Illuminate\Support\Facades\Session;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class CartService
{
    public function addressCreate(AddressRequest $request){
        $validatedAddress = $request->validated();
        array_key_exists('isDefault', $validatedAddress) ? $validatedAddress['isDefault'] : $validatedAddress['isDefault'] = Constants::NOT_DEFAULT_ADDRESS;
        $address = Address::create($validatedAddress);
        return $address;
    }

    public function setAmountforCheckout(){
        if(!Cart::instance('cart')->content()->count() > 0){
            Session::forget('checkout');
            return;
        }

        if(Session::has('coupon')){
            Session::put('checkout', [
                'discount' => Session::get('discounts')['discount'],
                'subtotal' => Session::get('discounts')['subtotal'],
                'tax' => Session::get('discounts')['tax'],
                'total' => Session::get('discounts')['total'],
            ]);
        }
        else{
            Session::put('checkout', [
                'discount' => 0,
                'subtotal' => Cart::instance('cart')->subtotal(),
                'tax' => Cart::instance('cart')->tax(),
                'total' => Cart::instance('cart')->total(),
            ]);
        }
    }

    public function calculateDiscount(){
        $discount = 0;
        if(Session::has('coupon')){
            if(Session::get('coupon')['type'] == 'fixed'){
                $discount = Session::get('coupon')['value'];
            }
            else{
                $discount = Cart::instance('cart')->subtotal() * Session::get('coupon')['value']/100;
            }
        }
        $subtotalAfterDiscount = Cart::instance('cart')->subtotal() - $discount;
        $taxAfterDiscount = ($subtotalAfterDiscount * config('cart.tax'))/100;
        $totalAfterDiscount = $subtotalAfterDiscount + $taxAfterDiscount;

        Session::put('discounts', [
            'discount' => number_format(floatval($discount),2,'.',''),
            'subtotal'=> number_format(floatval($subtotalAfterDiscount),2,'.',''),
            'tax' => number_format(floatval($taxAfterDiscount),2,'.',''),
            'total' => number_format(floatval($totalAfterDiscount),2,'.','')
        ]);
    }
}
