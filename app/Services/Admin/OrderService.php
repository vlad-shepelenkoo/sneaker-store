<?php

namespace App\Services\Admin;

use App\Models\Order;
use App\Models\Transaction;
use Carbon\Carbon;

class OrderService
{
    public function updateOrderStatus(array $dataOrder){
        $order = Order::find($dataOrder['id']);
        if($dataOrder['status'] == 'delivered'){ 
            $dataOrder['delivered_date'] = Carbon::now();
            $this->updateTransactionStatus($dataOrder['id']);
        }
        if($dataOrder['status'] == 'canceled') $dataOrder['canceled_date'] = Carbon::now();

        $order->update($dataOrder);
        return $order;
    }

    private function updateTransactionStatus($orderId){
        $transaction = Transaction::where('order_id', $orderId)->first();
        $transaction->status = 'approved';
        $transaction->save();
    }
}
