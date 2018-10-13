@extends('adminlte::page')

@section('title', 'Envie Cartões')

@section('content_header')
    <h1>Versículos</h1>
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
                            <h3 class="box-title">Novo Versículo</h3>
                        </div>
                        <div class="box-body" style="background: #EEEEEE">
                            <div class="col-xs-6">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="texto1">Livro</label> (max 16) Ex: Salmos
                                            <input type="text" class="form-control" name="livro" maxlength="16" value="{{ old('livro') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="texto1">Referência</label> (max 13) Ex: 10:34-36
                                            <input type="text" class="form-control" name="ref" maxlength="13" value="{{ old('ref') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button class="btn btn-primary" formaction="{{url('adm/saveversiculo')}}" formmethod="post">ADICIONAR</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-6">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="texto1">Versículo</label> (max 500)
                                            <textarea class="form-control" name="texto" id="texto" cols="10" rows="5" value="{{ old('texto') }}"></textarea>

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
                        <h3 class="box-title">Versículos Cadastrados</h3>

                    </div>
                    <div class="box-body">
                        <table id="versiculo" class="table table-hover">
                            <thead>
                            <th>#</th>
                            <th>Referencia</th>
                            <th>Texto</th>
                            <th>Ativo</th>
                            <th>Ação</th>
                            </thead>
                            <tbody>
                            @foreach($versiculo as $ver)
                                <tr>
                                    <td>
                                        {{$ver->id}}
                                    </td>
                                    <td>{{$ver->referencia}}</td>
                                    <td>{{$ver->texto}}</td>
                                    <td>
                                        @if($ver->ativo == 1)
                                            <span class="label label-success"> <span class="glyphicon glyphicon-ok"> </span> ATIVO </span>
                                        @else
                                            <span class="label label-danger"> <span class="glyphicon glyphicon-remove"></span> DESATIVADO </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($ver->ativo == 1)
                                            <a href="{{url('adm/versiculo_status/'.$ver->id)}}">
                                                <button type="button" class="btn-sm btn-danger">Desativar</button>
                                            </a>
                                        @else
                                            <a href="{{url('adm/versiculo_status/'.$ver->id)}}">
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
            $('#versiculo').DataTable();

        });
        
    </script>

@stop