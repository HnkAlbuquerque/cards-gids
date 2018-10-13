<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartaoEditRequest;
use App\Http\Requests\CartaoRequest;
use App\Models\Cartao;
use App\Models\CartaoCategoria;
use App\Models\CartaoImagens;
use App\Models\CartaoImgEmail;
use App\Models\CartaoTestemunhos;
use App\Models\CartaoVersiculo;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class CartaoController extends Controller
{
    public function index()
    {
      //  $cartao = Cartao::get();
        $categoria = CartaoCategoria::where('ativo','=',true)->OrderBy('nome','asc')->get();
        $testemunho = CartaoTestemunhos::where('ativo','=',true)->OrderBy('id','desc')->get();
        $versiculo = CartaoVersiculo::where('ativo','=',true)->OrderBy('referencia','asc')->get();

        return view('vendor.adm.cartao.cartao',compact('categoria','testemunho','versiculo'));
    }

    public function saveCartao(CartaoRequest $request)
    {

        // PROCEDIMENTO SALVAR NA TABELA PGD_CARDS
        $cartao = new Cartao;
        $cartao->codigo = $request->get('codigo');
        $cartao->idcategoria = $request->get('idcategoria');
        $cartao->orientacao = $request->get('orientacao');
        $cartao->correio = $request->get('correio');
        $cartao->email = $request->get('email');
        $cartao->idtestemunho = $request->get('idtestemunho');
        $cartao->idversiculo = $request->get('idversiculo');
        $cartao->desc = $request->get('desc');
        $cartao->save();
        ////////////////////////////////////////////

        //SALVAR NA TABELA CARD_IMAGES
            // PROCEDIMENTO - GERAR THUMB E SALVAR NA PASTA DE THUMBS
            $filename_thumb = 't' . time() . rand(0,9) . base64_encode(rand(0,999)) . '.' . $request->file('img')->getClientOriginalExtension();
            $location = public_path('images/cardthumbs/' . $filename_thumb);
            $img = Image::make($request->file('img'))
                ->resize(320, null, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                });
            $img->save($location);

            // PROCEDIMENTO - GERAR IMAGEM PRINCIPAL E SALVAR NA PASTA DE IMAGES
            $filename_image = 'i' . time() . rand(0,9) . base64_encode(rand(0,999)) . '.' . $request->file('img')->getClientOriginalExtension();
            $location = public_path('images/cardimages/' . $filename_image);
            $img = Image::make($request->file('img'))
                ->resize(720, null, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                });
            $img->save($location);
            ////////////////////////////////////////////

            $cartaoImages = new CartaoImagens;
            $cartaoImages->card_id = $cartao->id;
            $cartaoImages->thumb = $filename_thumb;
            $cartaoImages->image = $filename_image;
            $cartaoImages->face = true;
            $cartaoImages->save();
        //////////////////////////////////////////////

        //SALVAR NA TABELA CARD_IMAG_EMAIL
        // PROCEDIMENTO - GERAR IMAGEM PRINCIPAL E SALVAR NA PASTA CARDEMAIL
        $filename_email = 'e' . time() . rand(0,9) . base64_encode(rand(0,999)) . '.' . $request->file('img_email')->getClientOriginalExtension();
        $location = public_path('images/cardemail/' . $filename_email);
        $img = Image::make($request->file('img_email'));
        $img->save($location);
        ////////////////////////////////////////////

        $cartaoImaEmail = new CartaoImgEmail;
        $cartaoImaEmail->card_id = $cartao->id;
        $cartaoImaEmail->image = $filename_email;
        $cartaoImaEmail->ativo = true;
        $cartaoImaEmail->save();
        //////////////////////////////////////////////


        $arrayImg = $request->file('imgs_sec');
        for($i=0; $i < count($arrayImg); $i++)
        {
            //SALVAR NA TABELA CARD_IMAGES
            // PROCEDIMENTO - GERAR THUMB E SALVAR NA PASTA DE THUMBS
            $filename_thumb = 't' . time() . rand(0,9) . base64_encode(rand(0,999)) . '.' . $arrayImg[$i]->getClientOriginalExtension();
            $location = public_path('images/cardthumbs/' . $filename_thumb);
            $img = Image::make($arrayImg[$i])
                ->resize(320, null, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                });
            $img->save($location);

            // PROCEDIMENTO - GERAR IMAGEM PRINCIPAL E SALVAR NA PASTA DE IMAGES
            $filename_image = 'i' . time() . rand(0,9) . base64_encode(rand(0,999)) . '.' . $arrayImg[$i]->getClientOriginalExtension();
            $location = public_path('images/cardimages/' . $filename_image);
            $img = Image::make($arrayImg[$i])
                ->resize(720, null, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                });
            $img->save($location);
            ////////////////////////////////////////////

            $cartaoImages = new CartaoImagens;
            $cartaoImages->card_id = $cartao->id;
            $cartaoImages->thumb = $filename_thumb;
            $cartaoImages->image = $filename_image;
            $cartaoImages->face = false;
            $cartaoImages->save();

        }

        return redirect()->route('cartao')->with('status', 'Cartão Adicionado');

    }

    public function editCartao()
    {
        $cartao = Cartao::select('pgd_cards.*','ci.image','cat.nome')
            ->join('pgd.pgd_card_images as ci','ci.card_id','=','pgd_cards.id')
            ->join('pgd.pgd_categorias as cat','cat.id','=','pgd_cards.idcategoria')
            ->where('ci.face','=',true)->get();

        return view('vendor.adm.cartao.cartao_edit', compact('cartao'));
    }

    public function editCartaoForm($id)
    {
        $cartao = Cartao::where('id','=',$id)->first();
        $imagens = CartaoImagens::where('card_id','=',$id)->orderBy('face','desc')->get();
        $categoria = CartaoCategoria::where('ativo','=',true)->OrderBy('nome','asc')->get();
        $testemunho = CartaoTestemunhos::where('ativo','=',true)->OrderBy('id','desc')->get();
        $versiculo = CartaoVersiculo::where('ativo','=',true)->OrderBy('referencia','asc')->get();

      //  dd($imagens);

        return view('vendor.adm.cartao.cartao_editform',compact('id','cartao','imagens','categoria','testemunho','versiculo'));
    }

    public function editCartaoSave(CartaoEditRequest $request)
    {
        // ATUALIZA CARTÃO
        Cartao::where('id','=', $request->get('id'))
            ->update(
                [
                    'codigo' => $request->get('codigo'),
                    'idcategoria' => $request->get('idcategoria'),
                    'orientacao' => $request->get('orientacao'),
                    'correio' => $request->get('correio'),
                    'email' => $request->get('email'),
                    'idtestemunho' => $request->get('idtestemunho'),
                    'idversiculo' => $request->get('idversiculo'),
                    'desc' => $request->get('desc')
                ]
            );
        ///////////////////////////////////
        ///

        //SALVAR NA TABELA CARD_IMAGES
        // PROCEDIMENTO - GERAR THUMB E SALVAR NA PASTA DE THUMBS
        /// INSERE NOVA IMAGEM DE ROSTO (se existir) E ATUALIZA A IMAGEM DE ROSTO ANTIGA PARA SECUNDARIA
        if($request->file('img'))
        {
            CartaoImagens::where('card_id','=',$request->get('id'))->update(['face' => false]);

          //  dd($a);

            $filename_thumb = 't' . time() . rand(0,9) . base64_encode(rand(0,999)) . '.' . $request->file('img')->getClientOriginalExtension();
            $location = public_path('images/cardthumbs/' . $filename_thumb);
            $img = Image::make($request->file('img'))
                ->resize(320, null, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                });
            $img->save($location);

            // PROCEDIMENTO - GERAR IMAGEM PRINCIPAL E SALVAR NA PASTA DE IMAGES
            $filename_image = 'i' . time() . rand(0,9) . base64_encode(rand(0,999)) . '.' . $request->file('img')->getClientOriginalExtension();
            $location = public_path('images/cardimages/' . $filename_image);
            $img = Image::make($request->file('img'))
                ->resize(720, null, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                });
            $img->save($location);

            $cartaoImages = new CartaoImagens;
            $cartaoImages->card_id = $request->get('id');
            $cartaoImages->thumb = $filename_thumb;
            $cartaoImages->image = $filename_image;
            $cartaoImages->face = true;
            $cartaoImages->save();
        }
        ////////////////////////////////////////////

        /////////INSERE NOVAS IMAGENS SE EXISTIR
        if($request->file('imgs_sec'))
        {
            $arrayImg = $request->file('imgs_sec');
            for($i=0; $i < count($arrayImg); $i++)
            {
                //SALVAR NA TABELA CARD_IMAGES
                // PROCEDIMENTO - GERAR THUMB E SALVAR NA PASTA DE THUMBS
                $filename_thumb = 't' . time() . rand(0,9) . base64_encode(rand(0,999)) . '.' . $arrayImg[$i]->getClientOriginalExtension();
                $location = public_path('images/cardthumbs/' . $filename_thumb);
                $img = Image::make($arrayImg[$i])
                    ->resize(320, null, function ($constraint) {
                        $constraint->upsize();
                        $constraint->aspectRatio();
                    });
                $img->save($location);

                // PROCEDIMENTO - GERAR IMAGEM PRINCIPAL E SALVAR NA PASTA DE IMAGES
                $filename_image = 'i' . time() . rand(0,9) . base64_encode(rand(0,999)) . '.' . $arrayImg[$i]->getClientOriginalExtension();
                $location = public_path('images/cardimages/' . $filename_image);
                $img = Image::make($arrayImg[$i])
                    ->resize(720, null, function ($constraint) {
                        $constraint->upsize();
                        $constraint->aspectRatio();
                    });
                $img->save($location);
                ////////////////////////////////////////////

                $cartaoImages = new CartaoImagens;
                $cartaoImages->card_id = $request->get('id');
                $cartaoImages->thumb = $filename_thumb;
                $cartaoImages->image = $filename_image;
                $cartaoImages->face = false;
                $cartaoImages->save();

            }
        }

        return redirect()->route('editcartao')->with('status', 'Cartão Editado com Sucesso!');
    }

    public function deleteImageCartao($id)
    {
        $imagens = CartaoImagens::where('id','=',$id)->first();

        File::delete(public_path()."/images/cardimages" .'/'.$imagens->image);
        File::delete(public_path()."/images/cardthumbs" .'/'.$imagens->thumb);
//
        CartaoImagens::where('id','=',$id)->delete();

        return response()->json(['pass' => 1]);

    }

    public function statusCartao($id)
    {
        $cartao = Cartao::where('id','=',$id)->first();

        if($cartao->ativo == true)
        {
            Cartao::where('id','=',$id)->update(['ativo' => 'false']);
            return redirect()->route('editcartao')->with('status', 'Cartão Desativado com sucesso!');
        }
        else
        {
            Cartao::where('id','=',$id)->update(['ativo' => 'true','dt_created' => date('Y-m-d H:i:s')]);
            return redirect()->route('editcartao')->with('status', 'Cartão Ativado com sucesso!');
        }
    }





}
