<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSemesterValidation extends FormRequest
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
            'name' => 'max:50|unique:semesters',
            'finish_date' => 'after:begin_date',
        ];
    }

    public function messages()
    {
        return [
            'name.max' => __('lang.name_max'),
            'name.unique' => __('lang.coincide_name'),
            'finish_date.after' => __('lang.finish_date_after_begin_date'),
        ];
    }
}
