<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VersiculoRequest extends FormRequest
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
            'livro' => 'required|max:16',
            'texto' => 'required|max:500',
            'ref' => 'required|max:13'
        ];
    }

    public function messages()
    {
        return [
            'livro.required'=> ' Nome do livro é requerido',
            'livro.max'=> ' Nome do livro possui mais que 16 caracteres',
            'texto.required'=> ' Texto Principal é requerido',
            'texto.max'=> ' Texto possui mais que 500 caracteres',
            'ref.required'=> ' Referencia é requerido - ex: 10:35',
            'ref.max'=> ' Referencia possui mais que 13 caracteres',
        ];
    }
}
