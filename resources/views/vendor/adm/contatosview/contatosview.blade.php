@extends('adminlte::page')

@section('title', 'Envie Cartões')

@section('content_header')
    <h1>Contatos Recebidos</h1>
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

                        <h3 class="box-title">Contatos</h3>

                    </div>
                    <div class="box-body">
                        <table id="cards" class="table table-hover">
                            <thead>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Mensagem</th>
                            <th>Data</th>
                            </thead>
                            <tbody>
                            @foreach($contato as $n)
                                <tr>
                                    <td>
                                        {{$n->id}}
                                    </td>
                                    <td>
                                        {{$n->nome}}
                                    </td>
                                    <td>
                                        {{$n->telefone}}
                                    </td>
                                    <td>
                                        {{$n->email}}
                                    </td>
                                    <td>
                                        {{$n->mensagem}}
                                    </td>
                                    <td>
                                        {{$n->data}}
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

        $('#cards').DataTable({
            buttons: [
                'copy', 'excel', 'pdf'
            ]});

    </script>

@stop