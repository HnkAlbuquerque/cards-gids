<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Mail\PedidoRealizado;
use App\Models\ContatoFormulario;
use App\Models\ContatoHeader;
use App\Models\Newsletter;
use Illuminate\Http\Request;

use Mail;
use App\Mail\ContatoRecebidoMail;
use App\Mail\InscritoNewsletter;

class SiteContatoController extends Controller
{
    public function index()
    {
        $contato_header = ContatoHeader::where('ativo','=',true)->first();

        return view('center.contato',compact('contato_header'));
    }

    public function formSave(Request $request)
    {

       // return 'true';

        $contato = new ContatoFormulario();
        $contato->nome = $request->get('name');
        $contato->telefone = $request->get('fone');
        $contato->email = $request->get('email');
        $contato->mensagem = $request->get('mensagem');

        if($contato->save())
        {
            Mail::to($request->get('email'))->send(new ContatoRecebidoMail($contato->id));
            return 'true';
        }

        return 'false';
    }

    public function newsletterSave(Request $request)
    {

        $newsletter = new Newsletter();
        $newsletter->email = $request->get('news');


        if($newsletter->save())
        {
            Mail::to($request->get('news'))->send(new InscritoNewsletter($newsletter->id));
            return 'true';
        }

        return 'false';
    }

    public function newsletterUnsubscribe($token)
    {
        $email = base64_decode($token);
        $contato_header = ContatoHeader::where('ativo','=',true)->first();

        Newsletter::where('email','=',$email)->update(['ativo' => 'false']);

        return view('center.unsubscribe',compact('email','contato_header'));
    }

    public function testeemail()
    {
       $teste =  Mail::to('henrique@gideoes.org.br')->send(new PedidoRealizado(11));
    }

    public function testenews()
    {

        $newsletter = new Newsletter();
        $newsletter->email = 'henrique@gideoes.org.br';


        if($newsletter->save())
        {
            Mail::to('henrique@gideoes.org.br')->send(new InscritoNewsletter($newsletter->id));
            return 'true';
        }

        return 'false';
    }
}
