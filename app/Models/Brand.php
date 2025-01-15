<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image'
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function scopeSortBy($query, $column, $direction = 'asc')
    {
        return $query->orderBy($column, $direction);
    }
}
