<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRegistrationValidation extends FormRequest
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
            'name' => 'max:100',
            'date_finish' => 'after_or_equal:date_begin',
            'max_credit' => 'gt:min_credit',
            'generations' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.max' => __('lang.registration_name_max'),
            'date_finish.after_or_equal' => __('lang.time_finish_after_or_equal_time_begin'),
            'max_credit.gt' => __('lang.max_credit_greater_than_min_credit'),
            'generations.required' => __('lang.generation_required'),
        ];
    }
}
