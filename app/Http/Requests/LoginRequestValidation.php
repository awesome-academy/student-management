<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequestValidation extends FormRequest
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
            'email' => 'max:50',
            'password' => 'max:30',
        ];
    }

    public function messages()
    {
        return [
            'email.max' => __('lang.email_max'),
            'password.max' => __('lang.password_max'),
        ];
    }
}
