<?php

namespace App\Mail;

use App\Models\ContatoFormulario;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContatoRecebidoMail extends Mailable
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
        $contato = ContatoFormulario::where('id','=',$this->id)->first();

        return $this->subject('Envie Cartões - Seu contato.')->view('emails.contatorecebido.contatorecebido',compact('contato'));
    }
}
