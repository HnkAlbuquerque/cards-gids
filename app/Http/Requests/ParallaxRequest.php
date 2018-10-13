<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParallaxRequest extends FormRequest
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
            'texto1' => 'required|max:35',
            'texto2' => 'required|max:35',
            'video_url' => 'required|max:50',
            'img' => 'required|max:600'
        ];
    }

    public function messages()
    {
        return [
            'texto1.required'=> ' Texto Principal é requerido',
            'texto2.required'=> ' Texto Secundario é requerido',
            'img.max' => 'Tamanho do arquivo maior que 600k',
            'video_url.required' => 'Link do vídeo é requerido',
        ];
    }
}
