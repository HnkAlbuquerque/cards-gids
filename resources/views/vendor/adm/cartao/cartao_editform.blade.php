@extends('adminlte::page')

@section('title', 'Envie Cartões')

@section('content_header')
    <h1>Editar cartão {{$cartao->codigo}}</h1>
@stop

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
@stop

@section('content')
    <div class="container">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" value="{{$id}}" name="id" readonly>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Novo Cartão</h3>
                        </div>
                        <div class="box-body" style="background: #EEEEEE">

                            <!-- LADO DIREITO DO FORM -->
                            <div class="col-xs-6">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="codigo">Codigo</label> (max 15) Ex: PGD 142
                                            <input type="text" class="form-control" name="codigo" maxlength="15" value="@if(old('codigo')) {{ old('codigo') }} @else {{ $cartao->codigo }} @endif">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="texto1">Orientação do cartão</label> <br>
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-primary @if($cartao->orientacao == 'H') active @endif">
                                                    <input type="radio" name="orientacao" id="orientacao1" autocomplete="off" value="H" @if($cartao->orientacao == 'H') checked @endif> HORIZONTAL
                                                </label>
                                                <label class="btn btn-primary @if($cartao->orientacao == 'V') active @endif">
                                                    <input type="radio" name="orientacao" id="orientacao2" autocomplete="off" value="V" @if($cartao->orientacao == 'V') checked @endif> VERTICAL
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="texto1">Disponível via correio</label> <br>
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-primary @if($cartao->correio == 1) active @endif">
                                                    <input type="radio" name="correio" id="correio1" autocomplete="off" value="true" @if($cartao->correio == 1) checked @endif> SIM
                                                </label>
                                                <label class="btn btn-primary @if($cartao->correio == 0) active @endif">
                                                    <input type="radio" name="correio" id="correio2" autocomplete="off" value="false" @if($cartao->correio == 0) checked @endif> NÃO
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="texto1">Disponível via email</label> <br>
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-primary @if($cartao->email == 1) active @endif">
                                                    <input type="radio" name="email" id="email1" autocomplete="off" value="true" @if($cartao->email == 1) checked @endif> SIM
                                                </label>
                                                <label class="btn btn-primary @if($cartao->email == 0) active @endif">
                                                    <input type="radio" name="email" id="email2" autocomplete="off" value="false" @if($cartao->email == 0) checked @endif> NÃO
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- LADO ESQUERDO DO FORM -->
                            <div class="col-xs-6">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="texto1">Categoria</label>
                                            <select name="idcategoria" id="idcategoria" class="form-control" required>
                                                <option value=""></option>
                                                @foreach($categoria as $cat)
                                                    <option value="{{$cat->id}}" {{ $cartao->idcategoria == $cat->id ? 'selected' : '' }}>{{$cat->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="texto1">Testemunho</label>
                                                <select name="idtestemunho" id="idtestemunho" class="form-control" required>
                                                    <option value=""></option>
                                                    @foreach($testemunho as $test)
                                                        <option value="{{$test->id}}" {{ $cartao->idtestemunho == $test->id ? 'selected' : '' }}>{{substr($test->texto, 0, 180)}} ...</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="texto1">Versículo</label>
                                            <select name="idversiculo" id="idversiculo" class="form-control" required>
                                                <option value=""></option>
                                                @foreach($versiculo as $ver)
                                                    <option value="{{$ver->id}}" {{ $cartao->idversiculo == $ver->id ? 'selected' : '' }}>{{ $ver->referencia . ' | ' . $ver->texto }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="texto1">Breve descrição do cartão</label> (max 500)
                                            <textarea class="form-control" name="desc" id="desc" cols="10" rows="5" required>{{ $cartao->desc }}</textarea>
                                        </div>
                                    </div>
                                </div>



                            </div>

                            <!-- IMAGENS -->
                            <div class="col-xs-12">
                                <div class="row">
                                    @foreach($imagens as $img)

                                            <div class="col-sm-2 well" align="center" id="{{$img->id}}">
                                                <input type="hidden" value="{{$img->id}}" id="idImagem">
                                                @if($img->face == true)
                                                    <label for=""><strong>Imagem de Rosto</strong></label>
                                                @else
                                                    <label for="">Imagem Secundária</label>
                                                @endif

                                                <div class="row">
                                                    <img src="{{asset('images/cardimages') .'/'. $img->image}}" width="120" height="97">
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <button type="button" class="btn-sm btn-danger" data-toggle="modal" data-target="#modal-aviso" onclick="addImgIdModal({{$img->id}})"> Excluir </button>
                                                </div>

                                            </div>


                                    @endforeach
                                </div>
                                <div id="successMessage">

                                </div>

                            </div>

                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="texto1">Imagem de Capa</label> (Exibido como rosto do cartão)
                                            <input id="img" name="img" type="file" class="file" data-show-upload="false" data-preview-file-type="text" accept="image/*">

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="texto1">Imagens Secudárias</label> (Exibido na págino do produto)
                                            <input id="imgs_sec" name="imgs_sec[]" type="file" class="file" data-show-upload="false" data-preview-file-type="text" accept="image/*" multiple>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <button class="btn btn-success" formaction="{{url('adm/cartao/edit_save')}}" formmethod="post"><span class="glyphicon glyphicon-pencil"></span>EDITAR</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>





            <!-- Modal -->
            <div class="modal fade" id="modal-aviso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Apagar</h4>
                        </div>
                        <div class="modal-body">
                            Tem certeza que deseja excluir essa foto ?
                            <input type="hidden" value="" id="idImagemModal">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal" id="delete">Sim</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>



@stop

@section('js')
    <!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you
        wish to resize images before upload. This must be loaded before fileinput.min.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/js/plugins/piexif.min.js" type="text/javascript"></script>
    <!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview.
        This must be loaded before fileinput.min.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/js/plugins/sortable.min.js" type="text/javascript"></script>
    <!-- purify.min.js is only needed if you wish to purify HTML content in your preview for
        HTML files. This must be loaded before fileinput.min.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/js/plugins/purify.min.js" type="text/javascript"></script>
    <!-- popper.min.js below is needed if you use bootstrap 4.x. You can also use the bootstrap js
       3.3.x versions without popper.min.js. -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/js/fileinput.min.js"></script>

    <!-- optionally if you need a theme like font awesome theme you can include it as mentioned below -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/themes/fa/theme.js"></script>

    <script src="{{asset('assets/js/pt-br.js')}}"></script>

    <script>
        function addImgIdModal(int)
        {
            $('#idImagemModal').val(int);
        }

        $(function () {

            $("#imgs_sec").fileinput({
                allowedFileExtensions: ["jpg", "png"],
                showUpload: false,
                maxFileSize: 100
            });

            $("#img").fileinput({
                allowedFileExtensions: ["jpg", "png"],
                showUpload: false,
                maxFileSize: 100
            });

            $('#idcategoria').select2();
            $('#idtestemunho').select2();
            $('#idversiculo').select2();

            $('#delete').click(function() {
                var divid = $('#idImagemModal').val();
              //  alert(divid);
                $.ajax({
                    url: "{{url('adm/cartao/delete_image')}}/"+$('#idImagemModal').val()
                }).done(function(data) {
                        console.log(data['pass']);
                        if(data['pass'] == 1)
                        {
                            $('#successMessage').append("<div class='alert alert-success'>\n" +
                                "                               Imagem excluida com sucesso\n" +
                                "                            </div>");

                            setTimeout(function() {
                                $('#successMessage').empty();
                                $("#" + divid ).fadeOut('slow');
                            }, 1000);

                        }

                    });

            });


        });


    </script>




@stop