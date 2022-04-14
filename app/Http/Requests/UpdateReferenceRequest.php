<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\ForeignKeyExist;
use App\Models\Author;

class UpdateReferenceRequest extends FormRequest
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
            'source' => 'required|min:3',
            'author_id' => ['required', 'integer', new ForeignKeyExist(Author::class)]
        ];
    }

    public function messages()
    {
        return [
            'source.required' => 'O :attribute da referência é um campo obrigatório!',
            'source.min' => 'A fonte da referência deve ter mais de 3 caracteres!'
        ];
    }
}
