@extends('adminlte::page')

@section('title', 'Envie Cartões')

@section('content_header')
    <h1>Editar Cartões</h1>
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

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Cartões Cadastrados</h3>

                    </div>
                    <div class="box-body">
                        <table id="cards" class="table table-hover">
                            <thead>
                            <th>#</th>
                            <th>Imagem</th>
                            <th>Codigo</th>
                            <th>Categoria</th>
                            <th>Correio</th>
                            <th>E-mail</th>
                            <th>Status</th>
                            <th>Ação</th>
                            </thead>
                            <tbody>
                            @foreach($cartao as $catg)
                                <tr>
                                    <td>
                                        {{$catg->id}}
                                    </td>
                                    <td>
                                        <img src="{{asset('/images/cardimages/'.$catg->image)}}" width="108" height="99">
                                    </td>
                                    <td>{{$catg->codigo}}</td>
                                    <td>{{$catg->nome}}</td>
                                    <td>
                                        @if($catg->correio == 1)
                                            <span class="label label-success">  SIM </span>
                                        @else
                                            <span class="label label-danger"> NÃO </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($catg->email == 1)
                                            <span class="label label-success">  SIM </span>
                                        @else
                                            <span class="label label-danger"> NÃO </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($catg->ativo == 1)
                                            <span class="label label-success"> <span class="glyphicon glyphicon-ok"> </span> ATIVO </span>
                                        @else
                                            <span class="label label-danger"> <span class="glyphicon glyphicon-remove"></span> DESATIVADO </span>
                                        @endif
                                    </td>
                                    <td>

                                        <a href="{{url('adm/cartao/edit_form/'.$catg->id)}}">
                                            <button type="button" class="btn-sm btn-success"><span class="glyphicon glyphicon-pencil"></span>Editar</button>
                                        </a>
                                        @if($catg->ativo == 1)
                                            <a href="{{url('adm/cartao_status/'.$catg->id)}}">
                                                <button type="button" class="btn-sm btn-danger">Desativar</button>
                                            </a>
                                        @else
                                            <a href="{{url('adm/cartao_status/'.$catg->id)}}">
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
            $('#cards').DataTable();
        });
    </script>

@stop