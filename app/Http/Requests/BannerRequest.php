<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
            'texto1' => 'required|max:20',
            'texto2' => 'required|max:35',
            'img' => 'required|max:600'
        ];
    }

    public function messages()
    {
        return [
            'texto1.required'=> ' Texto Principal é requerido',
            'texto2.required'=> ' Texto Secundario é requerido',
            'img.max' => ' Tamanho do arquivo maior que 600k',
            'img.required' => ' Arquivo de imagem é obrigatório'

        ];
    }
}
