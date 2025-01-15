<?php

namespace App\Actions;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Support\Facades\Session;

class CreateNewOrder
{
    public function handle($user_id, Address $address)
    {
        return Order::create([
            'user_id' => $user_id,
            'subtotal' => Session::get('checkout')['subtotal'],
            'discount' => Session::get('checkout')['discount'],
            'tax' => Session::get('checkout')['tax'],
            'total' => Session::get('checkout')['total'],
            'name' => $address->name,
            'phone' => $address->phone,
            'locality' => $address->locality,
            'address' => $address->address,
            'city' => $address->city,
            'state' => $address->state,
            'country' => $address->country,
            'landmark' => $address->landmark,
            'zip' => $address->zip,
        ]);
    }
}
