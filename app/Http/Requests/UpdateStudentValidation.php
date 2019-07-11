<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentValidation extends FormRequest
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
            'name' => 'max:50',
            'id_card' => [
                'max:15',
                Rule::unique('students')->ignore($this->id, 'id'),
            ],
            'phone' => 'max:15',
            'local_address' => 'max:50',
            'current_address' => 'max:50',
        ];
    }
    
    public function messages()
    {
        return [
            'name.max' => __('lang.name_max'),
            'id_card.max' => __('lang.id_card_max'),
            'id_card.unique' => __('lang.id_card_exist'),
            'phone.max' => __('lang.phone_max'),
            'local_address.max' => __('lang.local_address_max'),
            'current_address.max' => __('lang.current_address_max'),
        ];
    }
}
