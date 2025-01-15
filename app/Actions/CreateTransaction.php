<?php

namespace App\Actions;

use App\Models\Transaction;

class CreateTransaction
{
    public function handle($user_id, $order_id, $mode)
    {
        return Transaction::create([
            'user_id' => $user_id,
            'order_id' => $order_id,
            'mode' => $mode,
            'status' => 'pending',
        ]);
    }
}
