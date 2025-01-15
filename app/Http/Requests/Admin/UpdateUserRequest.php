<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:50',
            'email' => 'required|email',
            'mobile' => 'required|numeric|digits:10',
            'utype' => 'required',
        ];
    }
}
