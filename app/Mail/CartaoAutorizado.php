<?php

namespace App\Mail;

use App\Models\Site\CartaoEcommerce;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CartaoAutorizado extends Mailable
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
        $cartaoecommerce = CartaoEcommerce::where('id','=',$this->id)->first();

        return $this->subject('Envie Cartões - Cartão Autorizado.')
            ->view('emails.cartaodecredito.cartaoautorizado',compact('cartaoecommerce'));
    }
}
