<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\VersiculoRequest;
use App\Models\CartaoVersiculo;
use Illuminate\Http\Request;

class VersiculoController extends Controller
{
    public function index()
    {
        $versiculo = CartaoVersiculo::get();

        return view('vendor.adm.versiculo.versiculo',compact('versiculo'));
    }

    public function saveVersiculo(VersiculoRequest $request)
    {

        $versiculo = new CartaoVersiculo;
        $versiculo->referencia = $request->livro . ' ' . $request->ref;
        $versiculo->texto = $request->texto;
        $versiculo->save();

        return redirect()->route('versiculo')->with('status', 'Versiculo adicionado');


    }

    public function statusVersiculo($id)
    {

        $versiculo = CartaoVersiculo::where('id','=',$id)->first();

        if($versiculo->ativo == true)
        {
            CartaoVersiculo::where('id','=',$id)->update(['ativo' => 'false']);
            return redirect()->route('versiculo')->with('status', 'Versiculo Desativado com sucesso!');
        }
        else
        {
            CartaoVersiculo::where('id','=',$id)->update(['ativo' => 'true']);
            return redirect()->route('versiculo')->with('status', 'Versiculo Ativado com sucesso!');
        }


    }
}
