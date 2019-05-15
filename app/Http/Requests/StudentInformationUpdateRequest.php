<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentInformationUpdateRequest extends FormRequest
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
            'phone' => 'max:15',
            'current_address' => 'max:50',
        ];
    }
    public function messages()
    {
        return [
            'phone.max' => __('lang.phone_max'),
            'current_address.max' => __('lang.current_address_max'),
        ];
    }
}
