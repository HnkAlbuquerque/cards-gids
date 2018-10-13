<?php

namespace App\Http\Controllers\Site;

use App\Models\Cartao;
use App\Models\CartaoCategoria;
use App\Models\ListarCartoesHeader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartaoListaController extends Controller
{

    public function index($catvar)
    {

        if(strpos($catvar, 'cat') !== false)
        {
            $catvar = explode('cat',$catvar);
            $catvar = $catvar[1];
        }
        else
        {
            $catvar = 0;
        }

        $header = ListarCartoesHeader::where('ativo','=', true)->first();
        $categoria = CartaoCategoria::where('ativo','=',true)->orderby('nome','asc')->get();
        return view('center.listarcartoes', compact('categoria','header','catvar'));
    }

    public function produtosResults(Request $request)
    {

        $cartao =
            Cartao::select('pgd_cards.*','ca.nome','ci.image')
                ->join('pgd.pgd_card_images as ci','pgd_cards.id','=','ci.card_id')
                ->join('pgd.pgd_categorias as ca','ca.id','=','pgd_cards.idcategoria')
                ->where('pgd_cards.ativo','=',true)
                ->where('ca.ativo','=',true)
                ->where('ci.face','=',true);

            if($request->get('search-product') and strlen($request->get('search-product')) > 0)
            {
                $cartao = $cartao->where('pgd_cards.codigo','ilike',"%".$request->get('search-product')."%");
            }

            if($request->get('categoria') > 0)
            {
                $cartao = $cartao->where('pgd_cards.idcategoria','=',$request->get('categoria'));
            }



            $cartao = $cartao->orderBy('id','desc')->paginate(9);

       // return dd($request);
        return view('center.products.products',compact('cartao'));
    }
}
