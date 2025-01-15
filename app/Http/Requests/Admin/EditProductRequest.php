<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'slug' => 'required|unique:products,slug,'.$this->id,
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required',
            'sale_price' => '',
            'SKU' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'image' => 'mimes:png,jpg,jpeg|max:2048',
            'images' => '',
            'category_id' => 'required',
            'brand_id' => 'required',
            'sizes' => ''
        ];
    }
}
