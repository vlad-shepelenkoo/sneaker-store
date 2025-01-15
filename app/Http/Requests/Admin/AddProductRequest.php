<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'slug' => 'required|unique:products,slug',
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required',
            'sale_price' => 'nullable|decimal',
            'SKU' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:4096',
            'images' => 'array',
            'category_id' => 'required',
            'brand_id' => 'required',
            'sizes' => 'required'
        ];
    }
}
