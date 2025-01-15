<?php

namespace App\Actions;

use App\Models\Sizes;

class CreateSize
{
    public function handle($product_id, $size)
    {
        return Sizes::create([
            'product_id' => $product_id,
            'size' => $size['size'],
            'quantity' => $size['quantity'],
        ]);
    }
}
