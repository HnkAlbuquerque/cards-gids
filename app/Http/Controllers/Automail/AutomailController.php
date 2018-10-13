<?php

namespace App\Http\Controllers\Automail;

use App\Http\Controllers\Controller;
use App\Mail\CartaoHorizontal;
use App\Mail\CartaoVertical;
use App\Mail\CopiaCartaoHorizontal;
use App\Mail\CopiaCartaoVertical;
use App\Models\Exercicio;
use App\Models\Site\Pedido;
use App\Models\Site\PedidoDetalhe;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Mail;

class AutomailController extends Controller
{
    public function sendPedidoEmail(Request $request)
    {
        if($request->get('pedido') > 0)
        {

            $pedidoDetalhe = PedidoDetalhe::select('pgd_pedido_detalhe.*','pe.nome','pe.email',
                'ca.orientacao')
                ->join('pgd.pgd_pedido as pe','pgd_pedido_detalhe.id_pedido','=','pe.id')
                ->join('pgd.pgd_cards as ca','ca.id','=','pgd_pedido_detalhe.id_cartao')
                ->where('id_pedido','=',$request->get('pedido'))
                ->where('tipo_envio','=','EM')
                ->where('data_agenda','=',date("Y-m-d"))
                ->where('envio','=',false)
                ->get();

            $valor_nt = Exercicio::where('valor_nt','>',0)->orderBy('exercicio','desc')->first();

            foreach ($pedidoDetalhe as $ped)
            {
                switch ($ped->orientacao)
                {
                    case 'H':
                        $nts = intval($ped->valor_ind / $valor_nt->valor_nt);
                        Mail::to($ped->dest_email)->send(new CartaoHorizontal($ped->id,$nts));
                        Mail::to($ped->email)->send(new CopiaCartaoHorizontal($ped->id,$nts));
                        PedidoDetalhe::where('id','=',$ped->id)->update(['envio' => true, 'data_envio' => date("Y-m-d H:i:s")]);
                        break;

                    case 'V':
                        $nts = intval($ped->valor_ind / $valor_nt->valor_nt);
                        Mail::to($ped->dest_email)->send(new CartaoVertical($ped->id,$nts));
                        Mail::to($ped->email)->send(new CopiaCartaoVertical($ped->id,$nts));
                        PedidoDetalhe::where('id','=',$ped->id)->update(['envio' => true, 'data_envio' => date("Y-m-d H:i:s")]);
                        break;
                }

            }

        }
        else
        {
            dd('false');
        }

      //  Mail::to($request->get('email'))->send(new CartaoHorizontal());

    }

    public function autoMail()
    {
        $pedidoDetalhe = PedidoDetalhe::select('pgd_pedido_detalhe.*','pe.nome','pe.email',
            'ca.orientacao')
            ->join('pgd.pgd_pedido as pe','pgd_pedido_detalhe.id_pedido','=','pe.id')
            ->join('pgd.pgd_cards as ca','ca.id','=','pgd_pedido_detalhe.id_cartao')
            ->where('tipo_envio','=','EM')
            ->where('data_agenda','=',date("Y-m-d"))
            ->where('envio','=',false)
            ->limit(10)
            ->get();

        $valor_nt = Exercicio::where('valor_nt','>',0)->orderBy('exercicio','desc')->first();

        foreach ($pedidoDetalhe as $ped)
        {
            switch ($ped->orientacao)
            {
                case 'H':
                    $nts = intval($ped->valor_ind / $valor_nt->valor_nt);
                    Mail::to($ped->dest_email)->send(new CartaoHorizontal($ped->id,$nts));
                    Mail::to($ped->email)->send(new CopiaCartaoHorizontal($ped->id,$nts));
                    PedidoDetalhe::where('id','=',$ped->id)->update(['envio' => true, 'data_envio' => date("Y-m-d H:i:s")]);
                    break;

                case 'V':
                    $nts = intval($ped->valor_ind / $valor_nt->valor_nt);
                    Mail::to($ped->dest_email)->send(new CartaoVertical($ped->id,$nts));
                    Mail::to($ped->email)->send(new CopiaCartaoVertical($ped->id,$nts));
                    PedidoDetalhe::where('id','=',$ped->id)->update(['envio' => true, 'data_envio' => date("Y-m-d H:i:s")]);
                    break;
            }

        }
    }


    public function teste()
    {
        $key = 'cGVkaWRvUEdEMTM=';
        return redirect('/exibepedido'.'/'.$key)->with('status', 'Pedido foi realizado com sucesso!');
/*
        $response = Curl::to(url('/automail/pedido'))
            ->withData( array( 'pedido' => 12 ) )
            ->post();*/

     //   dd(url('/automail/pedido'));

        //////////////////////////////////
        ///

      //  dd(base64_encode('74677365:d01af4462f6a4d7d9ecb724288f9fcd3'));
      /*/  $valor_nt = Exercicio::where('valor_nt','>',0)->orderBy('exercicio','desc')->first();
      //  dd($valor_nt->valor_nt);

        $pedidoDetalhe = PedidoDetalhe::select('pgd_pedido_detalhe.*','pe.nome',
            'ca.orientacao')
            ->join('pgd.pgd_pedido as pe','pgd_pedido_detalhe.id_pedido','=','pe.id')
            ->join('pgd.pgd_cards as ca','ca.id','=','pgd_pedido_detalhe.id_cartao')
            ->where('id_pedido','=',10)
            ->where('tipo_envio','=','EM')
            ->where('data_agenda','=',date("Y-m-d"))
            ->where('envio','=',false)
            ->get();
        dd($pedidoDetalhe);
*/

// or if you want the response to be json format
// $responseBody = json_decode($res->getContent(), true);

    }

}
