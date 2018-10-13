<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartaoRequest extends FormRequest
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
            'codigo' => 'required|max:15',
            'desc' => 'required|max:500',
            'idcategoria' => 'required',
            'idtestemunho' => 'required',
            'idversiculo' => 'required',
            'img' => 'required|max:300',
            'img_email' => 'required|max:500',
            'imgs_sec.*' => 'required|max:500'
        ];

    }

    public function messages()
    {
        return [
            'codigo.required'=> ' Código do cartão é obrigatório.',
            'codigo.max'=> ' Código possui mais de 15 caracteres.',
            'desc.required'=> ' Descrição do cartão é obrigatório.',
            'desc.max'=> ' Descrição possui mais de 500 caracteres.',
            'idcategoria.required'=> ' Categoria do cartão é obrigatório.',
            'idtestemunho.required'=> ' Testemunho do cartão é obrigatório.',
            'idversiculo.required'=> ' Versículo do cartão é obrigatório.',
            'img.max' => ' Tamanho do arquivo maior que 300k',
            'img.required' => ' Arquivo de imagem é obrigatório',
            'img_email.max' => ' Tamanho do arquivo maior que 500k',
            'img_email.required' => ' Imagem por email é requerida',
            'imgs_sec.*.required' => ' Imagem secundária é requerida',
            'imgs_sec.*.max' => ' Tamanho do arquivo de imagem secundária maior que 500k'
        ];
    }
}
