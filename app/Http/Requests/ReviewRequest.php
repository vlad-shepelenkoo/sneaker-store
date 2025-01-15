<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required',
            'user_id' => 'required',
            'rating' => 'required|numeric',
            'review' => 'required|max:150',
        ];
    }
}
