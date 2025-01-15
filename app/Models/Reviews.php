<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $fillable = [
        'product_id',
        'user_id',
        'rating',
        'review',
    ];
}
