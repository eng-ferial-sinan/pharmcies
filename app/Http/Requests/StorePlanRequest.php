<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePlanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:50',
            'number_of_contacts' => 'required|min:1|numeric',
            'add_the_number_of_waiting_messages' => 'required|min:1|numeric',
            'monthly_subscription' => 'required|min:1|numeric',
            'yearly_subscription' => 'required|min:1|numeric',
        ];
    }
}
