<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContatoRequest extends FormRequest
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
            'img' => 'required|max:600'
        ];
    }

    public function messages()
    {
        return [
            'img.required'=> ' Image é requerido',
            'img.max' => 'Tamanho do arquivo maior que 600k'
        ];
    }
}
