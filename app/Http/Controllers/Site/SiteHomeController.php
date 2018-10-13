<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Cartao;
use App\Models\CartaoCategoria;
use App\Models\HomeBanner;
use App\Models\HomeParallax;
use Illuminate\Http\Request;
use DB;
use Intervention\Image\ImageManagerStatic as Image;

class SiteHomeController extends Controller
{
    public function index()
    {
        $parallax = HomeParallax::where('ativo', true)->first();
        $banners = HomeBanner::where('ativo', true)
            ->orderBy('created_at','desc')
            ->get();

        $novos = Cartao::select('pgd_cards.*','ci.image','ca.nome')
            ->join('pgd.pgd_card_images as ci','ci.card_id','=','pgd_cards.id')
            ->join('pgd.pgd_categorias as ca','ca.id','=','pgd_cards.idcategoria')
            ->where('pgd_cards.ativo','=',true)
            ->where('ca.ativo','=',true)
            ->where('ci.face','=',true)
            ->whereNotNull('pgd_cards.dt_created')
            ->orderBy('pgd_cards.dt_created','DESC')
            ->limit(8)
            ->get();

        // PEGA 3 CATEGORIAS ALEATORIAS PARA EXIBIR NA HOME
        $randomCat = CartaoCategoria::where('ativo','=',true)->inRandomOrder()->limit(3)->get();

        // PEGA 8 CARTOES DE CADA CATEGORIA ALEATÓRIA E INSERE NO ARRAY DE RESULT.. CHAVE DO ARRAY É O ID DA CATEGORIA
        foreach ($randomCat as $rand)
        {
            $result[$rand->id] = Cartao::select('pgd_cards.*','ci.image','ca.nome')
                ->join('pgd.pgd_card_images as ci','ci.card_id','=','pgd_cards.id')
                ->join('pgd.pgd_categorias as ca','ca.id','=','pgd_cards.idcategoria')
                ->where('pgd_cards.ativo','=',true)
                ->where('ca.ativo','=',true)
                ->where('ci.face','=',true)
                ->where('idcategoria','=',$rand->id)
                ->inRandomOrder()
                ->limit(8)
                ->get();

        }

        return view('center.home',compact('banners','parallax','novos','randomCat','result'));
    }
}
