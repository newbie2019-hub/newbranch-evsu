<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
            'payment_for' => 'bail|required|max:200',
            'status' => 'bail|required|max:50',
            'amount' => 'bail|required|max:20',
            'instructor' => 'bail|required|max:100',
        ];
    }
}
