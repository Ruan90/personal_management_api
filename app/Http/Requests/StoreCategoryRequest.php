<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name' => 'required|min:3',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome do autor é um campo obrigatório!',
            'name.min' => 'O nome da categoria deve ter mais de 3 caracteres!'
        ];
    }
}
