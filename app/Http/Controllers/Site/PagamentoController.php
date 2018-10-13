<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Mail\CartaoAutorizado;
use App\Mail\PedidoRealizado;
use App\Models\Site\Associado;
use App\Models\Campo;
use App\Models\CarrinhoHeader;
use App\Models\Exercicio;
use App\Models\Site\Pedido;
use App\Models\Site\CartaoEcommerce;
use App\Models\Site\PedidoDetalhe;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Ixudra\Curl\Facades\Curl;
use DB;
use Mail;

class PagamentoController extends Controller
{
    public function index()
    {

    
        $campo = Campo::where('ativo','=',true)
            ->where('dtinstalacao','>','1900-01-01')
            ->orderBy('nome','asc')->get();

        $carrinho_header = CarrinhoHeader::where('ativo','=',true)->first();

        return view('center.pagamento',compact('carrinho_header','campo'));
    }

    public function consultaCpf(Request $request)
    {
        $cpf = preg_replace('/\D/', '', $request->get('cpf'));

        if(strlen($cpf) > 10)
        {

            $associado = Associado::where('as_cpf','=',$cpf)->whereIn('mot_cod',[1,6,7,8])->first();

            if($associado)
            {
                return response()->json($associado);
            }

        }

    }

    public function gerarPedido(Request $request)
    {

        switch ($request->get('pagTipo'))
        {
            case 'C':

                $valor = intval(Cart::subtotal()*100);
                $numero = preg_replace('/\D/', '', $request->get('cc_num'));
                $val = explode('/',$request->get('cc_val'));
                $nome = $request->get('cc_nome');
                $ver = $request->get('cc_ver');


         

                /* FRAGMENTO PARA TESTE.....
                
                $response = Curl::to($url)
                    ->withHeader("Authorization: Basic HUSAHUIDASHIDHUIHFUISDHFUISHDUIFHSDFSUDI")
                    ->withContentType('application/json')
                    ->withData(
                        array(  'capture' => true,
                            'reference' => "99" . time(),
                            'amount' => intval(Cart::subtotal()*100),
                            'cardNumber' => "767676767676767676",
                            'expirationMonth' => 12,
                            'expirationYear' => 7676,
                            'cardholderName' => "76767",
                            'securityCode' => "123"
                        )
                    )
                    ->asJson( true )
                    ->post();

              //  dd($response);

*/

                // SE CARTÃO PROCESSAR -- SEGUE O PROCESSO DE SAVE E PEDIDO
                if($response['returnCode'] == '00')
                {

                    $ecommerce = new CartaoEcommerce;
                    $ecommerce->tid = $response['tid'];
                    $ecommerce->nsu = $response['nsu'];
                    $ecommerce->aut = $response['returnCode'];
                    $ecommerce->cartao_num = $response['cardBin'] . '******' . $response['last4'];
                    $ecommerce->status_cod =  $response['returnCode'];
                    $ecommerce->status_desc = $response['returnMessage'];
                    $ecommerce->nome = $nome;
                    $ecommerce->validade = $request->get('cc_val');
                    $ecommerce->administradora = 1;
                    $ecommerce->valor = $valor;
                    $ecommerce->save();

                    $pedido = new Pedido;
                    $pedido->cpf = $request->get('cpf');
                    $pedido->nome = $request->get('nome');
                    $pedido->email = $request->get('email');
                    $pedido->fone = $request->get('fone');
                    $pedido->pg_tipo = $request->get('pagTipo');
                    $pedido->valor_total = Cart::subtotal();
                    $pedido->ped_status = true;
                    $pedido->idcampo = $request->get('campo');
                    $pedido->idprocesso = $ecommerce->id;
                    $pedido->save();

                    foreach (Cart::content() as $cart)
                    {
                        if($cart->options['tipo'] == 'EM')
                        {
                            $date = str_replace('/', '-', $cart->options['date']);

                            $pedidoDetalhe = new PedidoDetalhe;
                            $pedidoDetalhe->id_pedido =  $pedido->id;
                            $pedidoDetalhe->id_cartao = $cart->id;
                            $pedidoDetalhe->tipo_envio = $cart->options['tipo'];
                            $pedidoDetalhe->dest_email = $cart->options['email'];
                            $pedidoDetalhe->valor_ind = $cart->price;
                            $pedidoDetalhe->data_agenda = date('Y-m-d', strtotime($date));
                            $pedidoDetalhe->nome_dest = $cart->options['nome_dest'];
                            $pedidoDetalhe->mensagem = $cart->options['mensagem'];
                            $pedidoDetalhe->save();

                        }
                        else
                        {
                            $pedidoDetalhe = new PedidoDetalhe;
                            $pedidoDetalhe->id_pedido = $pedido->id;
                            $pedidoDetalhe->id_cartao = $cart->id;
                            $pedidoDetalhe->tipo_envio = $cart->options['tipo'];
                            $pedidoDetalhe->cep = $cart->options['cep'];
                            $pedidoDetalhe->endereco = $cart->options['endereco'];
                            $pedidoDetalhe->complemento = $cart->options['compl'];
                            $pedidoDetalhe->bairro = $cart->options['bairro'];
                            $pedidoDetalhe->cidade = $cart->options['cidade'];
                            $pedidoDetalhe->uf = $cart->options['estado'];
                            $pedidoDetalhe->valor_ind = $cart->price;
                            $pedidoDetalhe->nome_dest = $cart->options['nome_dest'];
                            $pedidoDetalhe->mensagem = $cart->options['mensagem'];
                            $pedidoDetalhe->save();
                        }

                    }
                }
                else
                {
                    return redirect('/pagamento')
                        ->with('status', "Houve um erro ao processar os dados do Cartão de Crédito. Tente novamente com outro cartão.
                                    <br>Codigo: {$response['returnCode']}<br>{$response['returnMessage']}" );
                }

                break;

            case 'B':

                break;
        }

        if($pedido->id > 0)
        {
            Cart::destroy();

            Mail::to($request->get('email'))->send(new PedidoRealizado($pedido->id));
            Mail::to($request->get('email'))->send(new CartaoAutorizado($ecommerce->id));

            /// ACESSO A ROTA PARA VERIFICAR SE EXISTE EMAIL PARA SER ENVIADO
            $response = Curl::to(url('/automail/pedido'))
                ->withData( array( 'pedido' => $pedido->id ) )
                ->post();
            //////////////////////////////////

            $key = base64_encode('pedidoPGD'.$pedido->id);
            return redirect('/exibepedido'.'/'.$key)->with('status', 'Pedido foi realizado com sucesso!');
        }


    }

    public function exibePedido($key)
    {

      //  dd(url('/automail/pedido'));
       // $key = 'cGVkaWRvUEdENw==';
        $str = base64_decode($key);
        $str = explode('PGD',$str);

        $carrinho_header = CarrinhoHeader::where('ativo','=',true)->first();

        if(isset($str[1]) && $str > 0)
        {
            $pedido = Pedido::where('id','=',$str[1])->first();

            $pedidoDetalhe = PedidoDetalhe::select('pgd_pedido_detalhe.*','ci.image',DB::raw("to_char(data_agenda,'DD/MM/YYYY') as dt_agenda"),DB::raw("to_char(data_envio,'DD/MM/YYYY') as dt_envio"),'ca.codigo')
                ->join('pgd.pgd_card_images as ci','ci.card_id','=','pgd_pedido_detalhe.id_cartao')
                ->join('pgd.pgd_cards as ca','ca.id','=','pgd_pedido_detalhe.id_cartao')
                ->where('ci.face','=',true)
                ->where('id_pedido','=',$str[1])
                ->get();

          //  dd($pedidoDetalhe);

            if($pedido->pg_tipo == 'C')
            {
                $formaPag = CartaoEcommerce::where('id','=',$pedido->idprocesso)->first();
            }
            else
            {

            }

            return view('center.exibepedido',compact('pedido','carrinho_header','pedidoDetalhe','formaPag'));
        }
        else
        {
            return redirect()->route('inicio');
        }

    }

}
