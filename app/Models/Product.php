<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'regular_price',
        'sale_price',
        'SKU',
        'stock_status',
        'featured',
        'image',
        'images',
        'category_id',
        'brand_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function scopeSaleProducts($query){
        return $query->whereNotNull('sale_price')->where('sale_price','<>','')->inRandomOrder()->get();
    }

    public function scopeFeaturedProducts($query){
        return $query->where('featured', 1)->get();
    }

    public function scopeCategoriesBanner($query){
        return $query->select('products.image', 'categories.name')->join('categories', 'products.category_id', '=', 'categories.id')->orderBy('products.id', 'ASC')->get();
    }

    public function scopeShowFilteredProduct($query, $f_brands, $f_categories, $min_price, $max_price, $o_column, $o_order, $pageSize){
        return $query->where(function($query) use($f_brands){
            $query->whereIn('brand_id', explode(',',$f_brands))->orWhereRaw("'".$f_brands."'=''");
        })
                            ->where(function($query) use($f_categories){
                                $query->whereIn('category_id', explode(',',$f_categories))->orWhereRaw("'".$f_categories."'=''");
        })
                            ->where(function($query) use($min_price, $max_price){
                                $query->whereBetween('regular_price', [$min_price, $max_price]);
                            })
                            ->orderBy($o_column, $o_order)->paginate($pageSize);
    }
}
