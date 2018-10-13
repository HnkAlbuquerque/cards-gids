@extends('adminlte::page')

@section('title', 'Envie Cartões')

@section('content_header')
    <h1>Testemunhos</h1>
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
                <div class="col-xs-5">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Novo Testemunho</h3>
                        </div>
                        <div class="box-body" style="background: #EEEEEE">
                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="texto1">Texto Principal</label> (max 1000)
                                            <textarea class="form-control" name="texto" id="texto" cols="10" rows="5" value="{{ old('texto') }}" required></textarea>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="texto1">Imagem</label>

                                            <input type="file" class="form-control" accept="image/*" name="img" value="" required>

                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button class="btn btn-primary" formaction="{{url('adm/savetestemunho')}}" formmethod="post">ADICIONAR</button>
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
                        <h3 class="box-title">Testemunhos Cadastrados</h3>

                    </div>
                    <div class="box-body">
                        <table id="testemunho" class="table table-hover">
                            <thead>
                            <th>#</th>
                            <th>IMG</th>
                            <th>Texto</th>
                            <th>Ativo</th>
                            <th>Ação</th>
                            </thead>
                            <tbody>
                            @foreach($testemunho as $tes)
                                <tr>
                                    <td>
                                        {{$tes->id}}
                                    </td>
                                    <td>
                                        <img src="{{asset('/images/testemunho/'.$tes->img)}}" width="100" height="70">
                                    </td>
                                    <td>{{(strlen($tes->texto) > 150) ? substr($tes->texto, 0, 150) : $tes->texto}} ...</td>
                                    <td>
                                        @if($tes->ativo == 1)
                                            <span class="label label-success"> <span class="glyphicon glyphicon-ok"> </span> ATIVO </span>
                                        @else
                                            <span class="label label-danger"> <span class="glyphicon glyphicon-remove"></span> DESATIVADO </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($tes->ativo == 1)
                                            <a href="{{url('adm/testemunho_status/'.$tes->id)}}">
                                                <button type="button" class="btn-sm btn-danger">Desativar</button>
                                            </a>
                                        @else
                                            <a href="{{url('adm/testemunho_status/'.$tes->id)}}">
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
            $('#testemunho').DataTable();

        });


    </script>

@stop