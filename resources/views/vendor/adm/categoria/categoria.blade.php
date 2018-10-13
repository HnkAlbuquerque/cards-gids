@extends('adminlte::page')

@section('title', 'Envie Cartões')

@section('content_header')
    <h1>Categorias</h1>
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
                <div class="col-xs-4">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Nova Categoria</h3>
                        </div>
                        <div class="box-body" style="background: #EEEEEE">
                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="texto1">Nome </label> (max 30)
                                            <input type="text" class="form-control" name="nome" maxlength="30" value="{{ old('nome') }}" required>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button class="btn btn-primary" formaction="{{url('adm/savecategoria')}}" formmethod="post">ADICIONAR</button>
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
                        <h3 class="box-title">Categorias Cadastradas</h3>

                    </div>
                    <div class="box-body">
                        <table id="parallax" class="table table-hover">
                            <thead>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Ativo</th>
                            <th>Ação</th>
                            </thead>
                            <tbody>
                            @foreach($categoria as $catg)
                                <tr>
                                    <td>
                                        {{$catg->id}}
                                    </td>
                                    <td>{{$catg->nome}}</td>
                                    <td>
                                        @if($catg->ativo == 1)
                                            <span class="label label-success"> <span class="glyphicon glyphicon-ok"> </span> ATIVO </span>
                                        @else
                                            <span class="label label-danger"> <span class="glyphicon glyphicon-remove"></span> DESATIVADO </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($catg->ativo == 1)
                                            <a href="{{url('adm/categoria_status/'.$catg->id)}}">
                                                <button type="button" class="btn-sm btn-danger">Desativar</button>
                                            </a>
                                        @else
                                            <a href="{{url('adm/categoria_status/'.$catg->id)}}">
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
            $('#parallax').DataTable();

        });
    </script>

@stop