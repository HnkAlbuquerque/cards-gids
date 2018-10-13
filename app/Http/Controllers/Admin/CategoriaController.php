<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriaRequest;
use App\Models\CartaoCategoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categoria = CartaoCategoria::get();

        return view('vendor.adm.categoria.categoria',compact('categoria'));
    }

    public function saveCategoria(CategoriaRequest $request)
    {

        $categoria = new CartaoCategoria;
        $categoria->nome = $request->nome;
        $categoria->save();

        return redirect()->route('categoria')->with('status', 'Categoria adicionada');

    }

    public function statusCategoria($id)
    {

        $categoria = CartaoCategoria::where('id','=',$id)->first();

        if($categoria->ativo == true)
        {
            CartaoCategoria::where('id','=',$id)->update(['ativo' => 'false']);
            return redirect()->route('categoria')->with('status', 'Categoria Desativada com sucesso!');
        }
        else
        {
            CartaoCategoria::where('id','=',$id)->update(['ativo' => 'true']);
            return redirect()->route('categoria')->with('status', 'Categoria Ativada com sucesso!');
        }


    }
}
