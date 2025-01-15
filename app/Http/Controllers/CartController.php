<?php

namespace App\Http\Controllers;

use App\Actions\CreateNewOrder;
use App\Actions\CreateOrderItem;
use App\Actions\CreateTransaction;
use App\Models\Address;
use App\Models\Coupon;
use App\Models\Order;
use App\Services\CartService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class CartController extends Controller
{

    public function __construct(private CartService $cartService, 
                                private CreateNewOrder $createNewOrder, 
                                private CreateOrderItem $createOrderItem, 
                                private CreateTransaction $createTransaction){}

    public function index(){
        $items = Cart::instance('cart')->content();
        return view('cart', compact('items'));
    }

    public function add_to_cart(Request $request){
        foreach($request->size as $size)
        {
            Cart::instance('cart')->add($request->id, $request->name, $request->quantity, $request->price, ['size' => $size])->associate('App\Models\Product');
        }
        return redirect()->back();
    }

    public function increase_cart_quantity($rowId){
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId, $qty);
        return redirect()->back();
    }

    public function  decrease_cart_quantity($rowId){
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId, $qty);
        return redirect()->back();
    }

    public function remove_item($rowId){
        Cart::instance('cart')->remove($rowId);
        return redirect()->back();
    }

    public function empty_cart(){
        Cart::instance('cart')->destroy();
        return redirect()->back();
    }

    public function apply_coupon_code(Request $request){
        $coupon_code = $request->coupon_code;
        if(isset($coupon_code)){
            $coupon = Coupon::where('code', $coupon_code)->where('expiry_date', '>=', Carbon::today())->where('cart_value', '<=', Cart::instance('cart')->subtotal())->first();
            if(!$coupon){
                return redirect()->back()->with('error', 'Invalid coupon code!');
            }
            else{
                Session::put('coupon', [
                    'code' => $coupon->code,
                    'type' => $coupon->type,
                    'value' => $coupon->value,
                    'cart_value' => $coupon->cart_value
                ]);
                $this->cartService->calculateDiscount();
                return redirect()->back()->with('success', 'Coupon has been applied');
            }
        }
        else{
            return redirect()->back()->with('error', 'Invalid coupon code!');
        }
    }

    public function remove_coupon_code(){
        Session::forget('coupon');
        Session::forget('discounts');
        return back()->with('success', 'Coupon has been removed!');
    }

    public function checkout(){
        if(!Auth::check()){
            return redirect()->route('login');
        }

        $items = Cart::instance('cart')->content();
        $address = Address::where('user_id', Auth::user()->id)->where('isdefault', 1)->first();
        return view('checkout', compact('address', 'items'));
    }

    public function place_an_order(Request $request){
        $user = Auth::user();
        $address = Address::where('user_id', $user->id)->where('isdefault', true)->first();
        $cartItems = Cart::instance('cart')->content();

        if(!$address){
            $address = $this->cartService->addressCreate($request);
        }

        $this->cartService->setAmountforCheckout();
        $order = $this->createNewOrder->handle($user->id, $address);

        foreach($cartItems as $item){
            $this->createOrderItem->handle($item, $order);
        }

        if($request->mode == 'card'){

        }
        elseif($request->mode == 'paypal'){

        }
        elseif($request->mode == 'cod'){
            $this->createTransaction->handle($user->id, $order->id, $request->mode);
        }

        Cart::instance('cart')->destroy();
        Session::forget('checkout');
        Session::forget('coupon');
        Session::forget('discounts');
        Session::put('order_id', $order->id);
        return redirect()->route('cart.order.confirmation');
    }

    public function order_confirmation(){
        if(Session::has('order_id')){
            $order = Order::find(Session::get('order_id'));
            return view('order-confirmation', compact('order'));    
        }
        return redirect()->route('cart.index');
    }
}
