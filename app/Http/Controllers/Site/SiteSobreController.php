<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\ContatoFormulario;
use App\Models\ContatoHeader;
use App\Models\SobreHeader;
use Illuminate\Http\Request;


class SiteSobreController extends Controller
{
    public function index()
    {
        $sobre_header = SobreHeader::where('ativo','=',true)->first();

        return view('center.sobre',compact('sobre_header'));
    }


}
