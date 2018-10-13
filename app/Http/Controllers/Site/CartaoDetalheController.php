<?php

namespace App\Http\Controllers\Site;

use App\Models\Cartao;
use App\Models\CartaoCategoria;
use App\Models\CartaoImagens;
use App\Models\CartaoTestemunhos;
use App\Models\CartaoVersiculo;
use App\Models\Exercicio;
use App\Models\ListarCartoesHeader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartaoDetalheController extends Controller
{
    public function index($id)
    {

        $cartao = Cartao::where('pgd_cards.ativo','=',true)
            ->where('pgd_cards.id','=',$id)
            ->first();

        $imagens = CartaoImagens::where('card_id','=',$id)->orderBy('face','desc')->get();
        $face = CartaoImagens::where('card_id','=',$id)->where('face','=', true)
            ->orderBy('face','desc')->first();
        $categoria = CartaoCategoria::where('id','=',$cartao->idcategoria)->first();
        $versiculo = CartaoVersiculo::where('id','=',$cartao->idversiculo)->first();
        $testemunho = CartaoTestemunhos::where('id','=',$cartao->idtestemunho)->first();
        $header = ListarCartoesHeader::where('ativo','=', true)->first();

        $relacionado = Cartao::select('pgd_cards.*','ci.image')
            ->join('pgd.pgd_card_images as ci','ci.card_id','=','pgd_cards.id')
            ->where('pgd_cards.ativo','=',true)
            ->where('ci.face','=',true)
            ->where('idcategoria','=',$cartao->idcategoria)
            ->limit(8)
            ->get();

        $valor_nt = Exercicio::where('valor_nt','>',0)->orderBy('exercicio','desc')->first();

       // dd($relacionado);
      //  dd($face->image);

        return view('center.cartao',compact('cartao','imagens','categoria','versiculo','relacionado','header','face','testemunho','valor_nt'));
    }


}
