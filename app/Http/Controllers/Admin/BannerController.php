<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Models\Cartao;
use App\Models\CartaoCategoria;
use App\Models\HomeBanner;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use DB;

class BannerController extends Controller
{
    public function index()
    {
        $banner = HomeBanner::get();

        return view('vendor.adm.banner.banner',compact('banner'));
    }

    public function saveBanner(BannerRequest $request)
    {

      //  dd($request);

        $banner = new HomeBanner;
        $banner->texto1 = $request->texto1;
        $banner->texto2 = $request->texto2;
        $banner->button_texto = $request->button_texto;
        $banner->button_exist = $request->button_exist;
        $banner->button_link = $request->linkpart . $request->linkpart2;


        $filename = time() . '.' . $request->file('img')->getClientOriginalExtension();
        $location = public_path('images/banners/' . $filename);
        $banner->img = $filename;
        $img = Image::make($request->file('img'));

        $img->brightness($request->brilho);
        $img->save($location);
        $banner->save();

        return redirect()->route('banner')->with('status', 'Banner Adicionado');

    }

    public function statusBanner($id)
    {
        $banner = HomeBanner::where('id','=',$id)->first();

        if($banner->ativo == true)
        {
            HomeBanner::where('id','=',$id)->update(['ativo' => 'false']);
            return redirect()->route('banner')->with('status', 'Banner Desativado com sucesso!');
        }
        else
        {
            HomeBanner::where('id','=',$id)->update(['ativo' => 'true']);
            return redirect()->route('banner')->with('status', 'Banner Ativado com sucesso!');
        }

    }

    public function getOptions(Request $request, $link)
    {

        if ($request->ajax()) {

            switch ($link)
            {
                case 'listarcartoes':

                    $result = CartaoCategoria::select(DB::raw("'/cat' || id as ref"),DB::raw("nome as nome"))
                        ->where('ativo','=','true')
                        ->orderBy('nome','asc')
                        ->get();

                    break;

                case 'cartao-detalhe':
                    $result = Cartao::select(DB::raw("'/' || id as ref"),DB::raw("id || ' - ' || codigo as nome"))
                        ->where('ativo','=','true')
                        ->orderBy('codigo','asc')
                        ->get();
                    break;
            }

            return response()->json($result);

        }
    }
}
