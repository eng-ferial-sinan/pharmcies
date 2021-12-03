<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'string|min:3|max:50',
            'email' => 'max:200|email|unique:users,email,'.auth()->user()->id,
            'password' => 'string|confirmed||min:6|max:25',
        ];
    }
}
