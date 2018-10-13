@extends('adminlte::page')

@section('title', 'Envie Cartões')

@section('content_header')
    <h1>Ver Pedidos</h1>
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

                        <h3 class="box-title">Pedidos Efetuados</h3>

                    </div>
                    <div class="box-body">
                        <table id="cards" class="table table-hover">
                            <thead>
                            <th>#</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Valor</th>
                            <th>Data</th>
                            <th>Status</th>
                            <th>Campo</th>
                            <th>Detalhe</th>
                            </thead>
                            <tbody>
                            @foreach($pedido as $ped)
                                <tr>
                                    <td>
                                        {{$ped->id}}
                                    </td>
                                    <td>
                                        {{$ped->nome}}
                                    </td>
                                    <td>
                                        {{$ped->cpf}}
                                    </td>

                                    <td>{{$ped->email}}</td>
                                    <td>{{$ped->fone}}</td>
                                    <td>
                                        R$ {{$ped->valor_total}}
                                    </td>
                                    <td>
                                        {{$ped->data}}
                                    </td>
                                    <td>
                                        @if($ped->ped_status == 1)
                                            <span class="label label-success"> <span class="glyphicon glyphicon-ok"> </span> PAGO </span>
                                            <br>
                                            @if($ped->pg_tipo = 'C')
                                                CC
                                                Ecommerce: {{$ped->idprocesso}}
                                            @else
                                                BB
                                                Boleto: {{$ped->idprocesso}}
                                            @endif
                                        @else
                                            <span class="label label-warning"> <span class="glyphicon glyphicon-remove"></span> AGUARDANDO PGTO</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{$ped->idcampo}}
                                    </td>
                                    <td>

                                        <a href="{{url('adm/pedidos/detalhe/'.$ped->id)}}">
                                            <button type="button" class="btn-sm btn-success"><span class="glyphicon glyphicon-pencil"></span>Detalhar</button>
                                        </a>

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
    <script src="//cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script>

        $('#cards').DataTable({
                buttons: [
                    'copy', 'excel', 'pdf'
                ]});

    </script>

@stop