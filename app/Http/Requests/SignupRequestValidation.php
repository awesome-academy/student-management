<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequestValidation extends FormRequest
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
            'password' => 'min:8|max:32',
        ];
    }

    public function messages()
    {
        return [
            'email.max' => __('lang.email_max'),
            'password.min' => __('lang.password_min'),
            'password.max' => __('lang.password_max'),
        ];
    }
}
