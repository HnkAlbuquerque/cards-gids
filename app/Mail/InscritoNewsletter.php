<?php

namespace App\Mail;

use App\Models\Newsletter;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InscritoNewsletter extends Mailable
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
        $newsletter = Newsletter::where('id','=',$this->id)->first();

        $token = base64_encode("$newsletter->email");
        $url = url('/unsubscribe')."/$token";

        return $this->subject('Envie Cartões - Newsletter.')->view('emails.inscritonewsletter.inscritonewsletter', compact('url'));
    }
}
