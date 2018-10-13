<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContatoFormulario;
use App\Models\ContatoHeader;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Requests\ContatoRequest;

class ContatoController extends Controller
{
    ////////////////////////////////// GERENCIAMENTO DE HEADER CONTATO
    public function index()
    {
        
        $contato = ContatoHeader::get();

        return view('vendor.adm.contato.contato',compact('contato'));
    }

    public function saveContato(ContatoRequest $request)
    {

        $contato = new ContatoHeader;

        $contato->ativo = true;

        $filename = time() . '.' . $request->file('img')->getClientOriginalExtension();
        $location = public_path('images/contato/' . $filename);
        $contato->img = $filename;
        $img = Image::make($request->file('img'));

        $img->brightness($request->brilho);
        $img->save($location);
        $contato->save();

        ContatoHeader::where('id','<>',$contato->id)->update(['ativo' => 'false']);
        return redirect()->route('contato')->with('status', 'Header Contato Adicionado');

    }

    public function statusContato($id)
    {
            ContatoHeader::where('id','=',$id)->update(['ativo' => 'true']);
            ContatoHeader::where('id','<>',$id)->update(['ativo' => 'false']);
            return redirect()->route('contato')->with('status', 'Imagem de Contato Ativado com sucesso!');
    }
    //////////////////////////////////////////////////////////////////


    ////////////// GERENCIAMENTO DOS CONTATOS REGISTRADOS E NEWSLETTER
    public function exibeContatos()
    {
        $contato = ContatoFormulario::OrderBy('id','desc')->get();
        return view('vendor.adm.contatosview.contatosview',compact('contato'));
    }

    public function exibeEmailsNews()
    {
        $news = Newsletter::OrderBy('id','DESC')->get();
        return view('vendor.adm.contatosview.newsletterview',compact('news'));
    }

    public function changeEmailStatus($id)
    {
        $news = Newsletter::where('id','=',$id)->first();
        if($news->ativo == true) {
            Newsletter::where('id','=',$id)->update(['ativo' => false]);
            return redirect()->route('inscritos')->with('status', 'Email Desativado!');
        }
        else {
            Newsletter::where('id','=',$id)->update(['ativo' => true]);
            return redirect()->route('inscritos')->with('status', 'Email Ativado!');
        }

    }
    //////////////////////////////////////////////////////////////////
}
