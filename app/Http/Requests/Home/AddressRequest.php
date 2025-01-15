<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => '',
            'name' => 'required',
            'phone' => 'required|numeric|digits:10',
            'zip' => 'required|numeric|digits:6',
            'state' => 'required',
            'city' => 'required',
            'country' => 'required',
            'address' => 'required',
            'locality' => 'required',
            'landmark' => 'required',
            'isDefault' => '',
        ];
    }
}
