<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\HomeParallax;
use App\Http\Requests\ParallaxRequest;

class ParallaxController extends Controller
{
    public function index()
    {
        $parallax = HomeParallax::get();

        return view('vendor.adm.parallax.parallax',compact('parallax'));
    }

    public function saveParallax(ParallaxRequest $request)
    {

        $parallax = new HomeParallax;
        $parallax->texto1 = $request->texto1;
        $parallax->texto2 = $request->texto2;
        $parallax->ativo = true;
        $parallax->video_url = $request->video_url;

        $filename = time() . '.' . $request->file('img')->getClientOriginalExtension();
        $location = public_path('images/parallax/' . $filename);
        $parallax->img = $filename;
        $img = Image::make($request->file('img'));

        $img->brightness($request->brilho);
        $img->save($location);
        $parallax->save();

        HomeParallax::where('id','<>',$parallax->id)->update(['ativo' => 'false']);

        return redirect()->route('parallax')->with('status', 'Parallax Adicionado');

    }

    public function statusParallax($id)
    {

            HomeParallax::where('id','=',$id)->update(['ativo' => 'true']);
            HomeParallax::where('id','<>',$id)->update(['ativo' => 'false']);
            return redirect()->route('parallax')->with('status', 'Parallax Ativado com sucesso!');

    }
}
