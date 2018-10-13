<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SobreHeader;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Requests\SobreRequest;

class SobreController extends Controller
{
    public function index()
    {
        
        $sobre = SobreHeader::get();

        return view('vendor.adm.sobre.sobre',compact('sobre'));
    }

    public function saveSobre(SobreRequest $request)
    {

        $sobre = new SobreHeader;

        $sobre->ativo = true;

        $filename = time() . '.' . $request->file('img')->getClientOriginalExtension();
        $location = public_path('images/sobre/' . $filename);
        $sobre->img = $filename;
        $img = Image::make($request->file('img'));

        $img->brightness($request->brilho);
        $img->save($location);
        $sobre->save();

        SobreHeader::where('id','<>',$sobre->id)->update(['ativo' => 'false']);
        return redirect()->route('sobre')->with('status', 'Header Sobre Adicionado');

    }

    public function statusSobre($id)
    {
            SobreHeader::where('id','=',$id)->update(['ativo' => 'true']);
            SobreHeader::where('id','<>',$id)->update(['ativo' => 'false']);
            return redirect()->route('sobre')->with('status', 'Imagem de Sobre Ativado com sucesso!');
    }
}
