<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable = [
        'tagline',
        'title',
        'subtitle',
        'link',
        'status',
        'image'
    ];

    public function scopeSortBy($query, $column, $direction = 'asc')
    {
        return $query->orderBy($column, $direction);
    }
}
