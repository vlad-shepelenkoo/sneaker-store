<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'old_password' => 'current_password|nullable|required_unless:password,null',
            'password' => 'required_unless:old_password,null',
            'password_confirmation' => 'same:password'
        ];
    }
}
