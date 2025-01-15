<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderStatusRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Services\Admin\OrderService;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService){}

    public function orders(){
        $orders = Order::orderBy('created_at', 'DESC')->paginate(12);
        return view('admin.orders', compact('orders'));
    }

    public function order_details($order_id){
        $order = Order::find($order_id);
        $orderItems = OrderItem::where('order_id', $order_id)->orderBy('id')->paginate(12);
        $transaction = Transaction::where('order_id', $order_id)->first();
        return view('admin.order-details', compact('order', 'orderItems', 'transaction'));
    }

    public function update_order_status(OrderStatusRequest $request){
        $this->orderService->updateOrderStatus($request->validated());
        return back()->with('status', 'Status changed successfully!');
    }
}