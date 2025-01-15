<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'type',
        'value',
        'cart_value',
        'expiry_date'
    ];

    public function scopeSortBy($query, $column, $direction = 'asc')
    {
        return $query->orderBy($column, $direction);
    }
}
