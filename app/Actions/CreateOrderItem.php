<?php

namespace App\Actions;

use App\Models\OrderItem;
use App\Models\Order;

class CreateOrderItem
{
    public function handle($item, Order $order)
    {
        return OrderItem::create([
            'product_id' => $item->id,
            'order_id' => $order->id,
            'price' => $item->price,
            'quantity' => $item->qty,
            'options' => $item->options['size'],
        ]);
    }
}
