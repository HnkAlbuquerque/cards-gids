<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarrinhoHeader;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Requests\CarrinhoRequest;

class CarrinhoController extends Controller
{
    public function index()
    {
        
        $carrinho = CarrinhoHeader::get();

        return view('vendor.adm.carrinho.carrinho',compact('carrinho'));
    }

    public function saveCarrinho(CarrinhoRequest $request)
    {

        $carrinho = new CarrinhoHeader;

        $carrinho->ativo = true;

        $filename = time() . '.' . $request->file('img')->getClientOriginalExtension();
        $location = public_path('images/carrinho/' . $filename);
        $carrinho->img = $filename;
        $img = Image::make($request->file('img'));

        $img->brightness($request->brilho);
        $img->save($location);
        $carrinho->save();

        CarrinhoHeader::where('id','<>',$carrinho->id)->update(['ativo' => 'false']);
        return redirect()->route('carrinho')->with('status', 'Header Carrinho Adicionado');

    }

    public function statusCarrinho($id)
    {
            CarrinhoHeader::where('id','=',$id)->update(['ativo' => 'true']);
            CarrinhoHeader::where('id','<>',$id)->update(['ativo' => 'false']);
            return redirect()->route('carrinho')->with('status', 'Imagem de Carrinho Ativado com sucesso!');
    }
}
