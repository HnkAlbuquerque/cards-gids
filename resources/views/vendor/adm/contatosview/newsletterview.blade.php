@extends('adminlte::page')

@section('title', 'Envie Cartões')

@section('content_header')
    <h1>Emails Cadastrados</h1>
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

                        <h3 class="box-title">Emails</h3>

                    </div>
                    <div class="box-body">
                        <table id="cards" class="table table-hover">
                            <thead>
                                <th>#</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Ação</th>
                            </thead>
                            <tbody>
                            @foreach($news as $n)
                                <tr>
                                    <td>
                                        {{$n->id}}
                                    </td>
                                    <td>
                                        {{$n->email}}
                                    </td>
                                    <td>
                                        @if($n->ativo == 1)
                                            <span class="label label-success"> <span class="glyphicon glyphicon-ok"> </span> ATIVO </span>
                                        @else
                                            <span class="label label-danger"> DESATIVO</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($n->ativo == 1)
                                            <a href="{{url('adm/change_email_status/'.$n->id)}}">
                                                <button type="button" class="btn-sm btn-danger">Desativar</button>
                                            </a>
                                        @else
                                            <a href="{{url('adm/change_email_status/'.$n->id)}}">
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

        $('#cards').DataTable({
            buttons: [
                'copy', 'excel', 'pdf'
            ]});

    </script>

@stop