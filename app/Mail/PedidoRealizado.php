<?php

namespace App\Mail;

use App\Models\Exercicio;
use App\Models\Site\Pedido;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PedidoRealizado extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pedido = Pedido::where('id','=',$this->id)->first();
        $exercicio = Exercicio::orderBy('exercicio','desc')->first();

        $nts = intval($pedido->valor_total / $exercicio->valor_nt);
        return $this->subject('Envie Cartões - Pedido Realizado com Sucesso.')->view('emails.pedidorealizado.pedidorealizado',compact('pedido','nts'));
    }
}
