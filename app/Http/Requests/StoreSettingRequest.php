<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettingRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules()
    {
        return [
            'nameAr' => 'string|nullable',
            'nameEn' => 'string|nullable',
            'email' => 'max:200|email',
            'address' => 'string|nullable',
            'phone' => 'string|nullable',
            'map_1' => 'string|nullable',
            'map_2' => 'string|nullable',
            'google_plus' => 'string|nullable',
            'instagram' => 'string|nullable',
            'twitter' => 'string|nullable',
            'facebook' => 'string|nullable',
        ];
    }
}
