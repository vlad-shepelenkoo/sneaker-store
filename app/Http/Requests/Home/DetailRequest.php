<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class DetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required',
            'name' => 'required|max:50',
            'mobile' => 'required|numeric|digits:10',
            'email' => 'required|email',
            'old_password' => 'current_password|nullable|required_unless:password,null',
            'password' => 'required_unless:old_password,null',
            'password_confirmation' => 'same:password',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048'
        ];
    }
}
