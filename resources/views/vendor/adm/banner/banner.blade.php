@extends('adminlte::page')

@section('title', 'Envie Cartões')

@section('content_header')
    <h1>Banners</h1>
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
            <div class="row">
                <div class="col-xs-8">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Novo Banner</h3>
                        </div>
                        <div class="box-body" style="background: #EEEEEE">
                            <div class="col-xs-6">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="texto1">Texto Principal</label> (max 20)
                                            <input type="text" class="form-control" name="texto1" maxlength="20" value="{{ old('texto1') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="texto1">Texto Secundário</label> (max 35)
                                            <input type="text" class="form-control" name="texto2" maxlength="35" value="{{ old('texto2') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="texto1">Haverá botão ?</label> <br>
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-primary active">
                                                    <input type="radio" name="button_exist" id="option2" autocomplete="off" value="true" checked> SIM
                                                </label>
                                                <label class="btn btn-primary">
                                                    <input type="radio" name="button_exist" id="option3" autocomplete="off" value="false"> NÃO
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="texto1">Texto Botão</label> (max 10)
                                            <input type="text" class="form-control" name="button_texto" maxlength="10" value="{{ old('button_texto') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button class="btn btn-primary" formaction="{{url('adm/savebanner')}}" formmethod="post">ADICIONAR</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-6">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="texto1">Redirecionamento do botão(se existir)</label> (Cartão ou Categoria)
                                            <select name="linkpart" id="linkpart" class="form-control">
                                                <option value=""> - </option>
                                                <option value="listarcartoes">Para uma Categoria</option>
                                                <option value="cartao-detalhe">Para um Cartão</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="texto1">Selecione o Cartão ou a Categoria</label>
                                            <select name="linkpart2" id="linkpart2" class="form-control">

                                                <option value=""> - </option>

                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="texto1">Imagem</label> (1920x570)

                                            <input type="file" class="form-control" accept="image/*" name="img" value="" required>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group well">
                                            <label for="texto1">Brilho da imagem</label> Dica: para imagens muito claras deve-se utilizar valor de brilho negativo.
                                            <br>

                                                <input id="brilho" name="brilho" type="text" data-slider-min="-50" data-slider-max="50"
                                                       data-slider-step="1" data-slider-value="0"/>

                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </form>



        <hr>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Banners Cadastrados</h3>

                    </div>
                    <div class="box-body">
                        <table id="banner" class="table table-hover">
                            <thead>
                                <th>#</th>
                                <th>IMG</th>
                                <th>Texto 1</th>
                                <th>Texto 2</th>
                                <th>Texto Botão</th>
                                <th>Ativo</th>
                                <th>Ação</th>
                            </thead>
                            <tbody>
                            @foreach($banner as $ban)
                                <tr>
                                    <td>
                                        {{$ban->id}}
                                    </td>
                                    <td>
                                        <img src="{{asset('/images/banners/'.$ban->img)}}" width="200" height="70">
                                    </td>
                                    <td>{{$ban->texto1}}</td>
                                    <td>{{$ban->texto2}}</td>
                                    <td>{{$ban->button_texto}}</td>
                                    <td>
                                        @if($ban->ativo == 1)
                                            <span class="label label-success"> <span class="glyphicon glyphicon-ok"> </span> ATIVO </span>
                                        @else
                                            <span class="label label-danger"> <span class="glyphicon glyphicon-remove"></span> DESATIVADO </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($ban->ativo == 1)
                                            <a href="{{url('adm/banner_status/'.$ban->id)}}">
                                                <button type="button" class="btn-sm btn-danger">Desativar</button>
                                            </a>
                                        @else
                                            <a href="{{url('adm/banner_status/'.$ban->id)}}">
                                                <button type="button" class="btn-sm btn-success">Ativar</button>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>





@stop

@section('js')


    <script>
        $(function () {

            $('#banner').DataTable();

            // With JQuery
            $("#brilho").slider();

            $("#linkpart2").select2();

            $("#linkpart").on('change', function () {

                $("#linkpart2").empty();
                $("#linkpart2").append("<option value=''> - </option>");

                $.get('{{url('adm/getoptions')}}' + '/' + $(this).val(), function (data) {
                    $.each(data, function (index, objt) {
                        console.log(objt.id);
                        $("#linkpart2").append("<option value='" + objt.ref + "'>" + objt.nome + "</option>");
                    })

                })
            });

        });



    </script>

@stop