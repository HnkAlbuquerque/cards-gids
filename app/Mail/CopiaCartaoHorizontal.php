<?php

namespace App\Mail;

use App\Models\Site\PedidoDetalhe;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CopiaCartaoHorizontal extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id_detalhe, $nts)
    {
        $this->id_detalhe = $id_detalhe;
        $this->nts = $nts;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $pedidoDetalhe = PedidoDetalhe::select('pgd_pedido_detalhe.*','pe.nome','email_img.image',
            'ca.orientacao','ver.referencia','ver.texto','tes.texto as testemunho_texto','tes.img')
            ->join('pgd.pgd_pedido as pe','pgd_pedido_detalhe.id_pedido','=','pe.id')
            ->join('pgd.pgd_cards as ca','ca.id','=','pgd_pedido_detalhe.id_cartao')
            ->join('pgd.pgd_card_img_email as email_img','email_img.card_id','=','pgd_pedido_detalhe.id_cartao')
            ->join('pgd.pgd_testemunhos as tes','tes.id','=','ca.idtestemunho')
            ->join('pgd.pgd_versiculos as ver','ver.id','=','ca.idversiculo')
            ->where('pgd_pedido_detalhe.id','=',$this->id_detalhe)
            ->where('tipo_envio','=','EM')
            ->where('data_agenda','=',date("Y-m-d"))
            ->where('envio','=',false)
            ->where('email_img.ativo','=',true)
            ->first();

        $nts = $this->nts;

        return $this->subject("Envie Cartões - Cópia do Cartão enviado para $pedidoDetalhe->nome_dest")
            ->view('emails.enviocartao.cartaohorizontal',compact('pedidoDetalhe','nts'));
    }
}
