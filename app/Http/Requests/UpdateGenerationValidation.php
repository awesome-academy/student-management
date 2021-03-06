<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGenerationValidation extends FormRequest
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
            'name' => [
                'max:20',
                Rule::unique('generations')->ignore($this->id, 'id'),
            ],
            'begin_year' => Rule::unique('generations')->ignore($this->id, 'id'),
        ];
    }

    public function messages()
    {
        return [
            'name.max' => __('lang.generation_name_max'),
            'name.unique' => __('lang.generation_name_exist'),
            'begin_year.unique' => __('lang.generation_begin_year_exist'),
        ];
    }
}
