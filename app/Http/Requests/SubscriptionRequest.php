<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
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
            'plan_id'                   => 'required|exists:plans,id',
            'type'                => 'required|boolean',
            'nonce'                => 'required|string',
            'method_id'                   => 'required|exists:payment_methods,id',
        ];
    }
}
