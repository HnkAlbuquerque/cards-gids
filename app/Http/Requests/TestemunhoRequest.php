<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestemunhoRequest extends FormRequest
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
            'texto' => 'required|max:1000',
            'img' => 'required|max:200'
        ];
    }

    public function messages()
    {
        return [
            'texto.required'=> ' Texto Principal é requerido',
            'texto.max'=> ' Texto possui mais que 1000 caracteres',
            'img.max' => ' Tamanho do arquivo maior que 200k',
            'img.required' => ' Arquivo de imagem é obrigatório'
        ];
    }
}
