<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
 
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required',
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$this->id,
            'image' =>'mimes:png,jpg,jpeg|max:2048'
        ];
    }
}
