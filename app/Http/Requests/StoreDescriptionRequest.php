<?php

namespace App\Http\Requests;
use App\Rules\ForeignKeyExist;
use App\Models\Author;

use Illuminate\Foundation\Http\FormRequest;

class StoreDescriptionRequest extends FormRequest
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
            'title' => 'required|min:3|max:80',
            'description' => 'required|min:3',
            'author_id' => ['required', 'integer', new ForeignKeyExist(Author::class)]
        ];
    }

    public function messages()
    {
        return [
            'min' => ':attribute deve ter mais de :min caracteres!',
            'max' => ':attribute deve ter menos de :max caracteres!',
            'required' => 'O campo :attribute é obrigatório',
            'author_id.integer' => 'O campo author_id deve ser um inteiro válido!'
        ];
    }
}
