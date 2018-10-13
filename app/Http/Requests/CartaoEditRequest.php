<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartaoEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

   // protected $redirectRoute = 'cartao';


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
            'img' => 'max:300',
            'imgs_sec.*' => 'max:500'
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
            'imgs_sec.*.max' => ' Tamanho do arquivo de imagem secundária maior que 500k'
        ];
    }
}
