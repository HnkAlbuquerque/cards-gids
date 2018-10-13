<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\TestemunhoRequest;
use App\Models\CartaoTestemunhos;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class TestemunhoController extends Controller
{
    public function index()
    {
        $testemunho = CartaoTestemunhos::get();

        return view('vendor.adm.testemunho.testemunho',compact('testemunho'));
    }

    public function saveTestemunho(TestemunhoRequest $request)
    {

        $testemunho = new CartaoTestemunhos;
        $testemunho->texto = $request->texto;

        $filename = time() . '.' . $request->file('img')->getClientOriginalExtension();
        $location = public_path('images/testemunho/' . $filename);
        $testemunho->img = $filename;
        $img = Image::make($request->file('img'));
        $img->save($location);

        $testemunho->save();

        return redirect()->route('testemunho')->with('status', 'Testemunho Adicionado');

    }

    public function statusTestemunho($id)
    {
        $testemunho = CartaoTestemunhos::where('id','=',$id)->first();

        if($testemunho->ativo == true)
        {
            CartaoTestemunhos::where('id','=',$id)->update(['ativo' => 'false']);
            return redirect()->route('testemunho')->with('status', 'Testemunho Desativado com sucesso!');
        }
        else
        {
            CartaoTestemunhos::where('id','=',$id)->update(['ativo' => 'true']);
            return redirect()->route('testemunho')->with('status', 'Testemunho Ativado com sucesso!');
        }


    }
}
