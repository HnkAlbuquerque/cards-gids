<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ListarCartoesHeader;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Requests\HeaderRequest;

class HeaderController extends Controller
{
    public function index()
    {
        
        $header = ListarCartoesHeader::get();

        return view('vendor.adm.header.header',compact('header'));
    }

    public function saveHeader(HeaderRequest $request)
    {

        $header = new ListarCartoesHeader;
        $header->texto1 = $request->texto1;
        $header->texto2 = $request->texto2;
        $header->ativo = true;

        $filename = time() . '.' . $request->file('img')->getClientOriginalExtension();
        $location = public_path('images/header/' . $filename);
        $header->img = $filename;
        $img = Image::make($request->file('img'));

        $img->brightness($request->brilho);
        $img->save($location);
        $header->save();

        ListarCartoesHeader::where('id','<>',$header->id)->update(['ativo' => 'false']);
        return redirect()->route('header')->with('status', 'Header Adicionado');

    }

    public function statusHeader($id)
    {
            ListarCartoesHeader::where('id','=',$id)->update(['ativo' => 'true']);
            ListarCartoesHeader::where('id','<>',$id)->update(['ativo' => 'false']);
            return redirect()->route('header')->with('status', 'Header Ativado com sucesso!');
    }
}
