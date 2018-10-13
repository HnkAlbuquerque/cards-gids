<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use App\Mail\Teste;


class EmailController extends Controller
{
    public function enviaTeste()
    {
        Mail::to('henrique@gideoes.org.br')->send(new Teste());
    }
}
