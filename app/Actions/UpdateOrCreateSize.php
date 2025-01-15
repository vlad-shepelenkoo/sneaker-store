<?php

namespace App\Actions;

use App\Models\Sizes;

class UpdateOrCreateSize
{
    public function handle($product_id, $size){
        return Sizes::updateOrCreate([
            'product_id'=> $product_id, 
            'size' => $size['size']
        ], 
            ['quantity' => $size['quantity']]);
    }
}
