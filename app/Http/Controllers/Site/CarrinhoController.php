<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\CarrinhoHeader;
use App\Models\Exercicio;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CarrinhoController extends Controller
{
    public function index()
    {
        $carrinho_header = CarrinhoHeader::where('ativo','=',true)->first();

        if(count(Cart::content()) > 0)
        {
            return view('center.carrinho',compact('carrinho_header'));
        }
        else
        {
            return redirect()->route('inicio');
        }

    }

    public function addCart(Request $request)
    {
        // Cart::destroy();
        $exercicio = Exercicio::orderby('exercicio','desc')->first();

        $productArray = array();
        $price = $request->get('num-product') * $exercicio->valor_nt;

        switch($request->get('tipo'))
        {
            case 'CO':
                $productArray = array(

                    'cep' => $request->get('cep'),
                    'endereco' => $request->get('endereco'),
                    'bairro' => $request->get('bairro'),
                    'cidade' => $request->get('cidade'),
                    'estado' => $request->get('estado'),
                    'compl' => $request->get('compl'),
                    'mensagem' => $request->get('mensagem'),
                    'img' => $request->get('img'),
                    'tipo' => 'CO',
                    'nome_dest' => $request->get('nome_dest')
                );

                break;

            case 'EM':
                $productArray = array(

                    'email' => $request->get('dest_email'),
                    'date' => $request->get('date'),
                    'mensagem' => $request->get('mensagem'),
                    'img' => $request->get('img'),
                    'tipo' => 'EM',
                    'nome_dest' => $request->get('nome_dest')
                );
                break;
        }

        Cart::add(['id' => $request->get('id'), 'name' => $request->get('name'), 'qty' => 1, 'price' => $price,
            'options' => $productArray ,
        ]);

        return 'true';

    }

    public function removeProduct($rowId)
    {

      //  $teste = $rowId;
     //   Cart::remove($rowId);
        // Cart::get($teste);

        if(Cart::get($rowId))
        {
            Cart::remove($rowId);
            return ['pass' =>'true'];
        }
        else
        {
            return ['pass' => 'false'];
        }

      // return ['pass' => 'true'];

            //response()->json($ex);
    }
}
