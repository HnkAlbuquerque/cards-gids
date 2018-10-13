<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Site\Pedido;
use App\Models\Site\PedidoDetalhe;
use Illuminate\Http\Request;

class PedidoAdmController extends Controller
{
    public function index()
    {
        $pedido = Pedido::get();
        return view('vendor.adm.pedido.index',compact('pedido'));
    }

    public function detalharPedido($id)
    {
        $detalhe = PedidoDetalhe::select('pgd_pedido_detalhe.*','ca.codigo','ci.image')
            ->join('pgd.pgd_cards as ca','ca.id','=','pgd_pedido_detalhe.id_cartao')
            ->join('pgd.pgd_card_images as ci','ci.card_id','=','pgd_pedido_detalhe.id_cartao')
            ->where('ci.face','=',true)
            ->where('id_pedido','=',$id)->get();

        return view('vendor.adm.pedido.detalharpedido',compact('detalhe','id'));
    }

    public function editarItem(Request $request)
    {
        $pedido = PedidoDetalhe::where('id','=',$request->get('idItem'))->first();

        PedidoDetalhe::where('id','=',$request->get('idItem'))
            ->update(
                [
                    'dest_email' => $request->get('dest_email'),
                    'data_agenda' => $request->get('data_agenda')
                ]
            );

        return redirect('/adm/pedidos/detalhe'.'/'.$pedido->id_pedido)->with('status', 'Dados do Item foram Alterados!');
    }

    public function marcarEnvioCorreio(Request $request)
    {

        $pedido = PedidoDetalhe::where('id','=',$request->get('idItemCorreio'))->first();

        PedidoDetalhe::where('id','=',$request->get('idItemCorreio'))
            ->update(
                [
                    'envio' => 'true',
                    'data_envio' => date('Y-m-d H:i:s')
                ]
            );

        return redirect('/adm/pedidos/detalhe'.'/'.$pedido->id_pedido)->with('status', 'Item Marcado como Enviado!');

    }
}
