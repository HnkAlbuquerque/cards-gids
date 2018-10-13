@extends('adminlte::page')

@section('title', 'Envie Cartões')

@section('content_header')
    <h1>PEDIDO #{{$id}}</h1>
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

                        <h3 class="box-title">Items Pedidos</h3>

                    </div>
                    <div class="box-body">
                        <table id="cards" class="table table-hover">
                            <thead>
                            <th>Imagem</th>
                            <th>Codigo</th>
                            <th>Envio</th>
                            <th>Informações</th>
                            <th>Valor</th>
                            <th>Status</th>
                            <th>Detalhe</th>
                            </thead>
                            <tbody>
                            @foreach($detalhe as $ped)
                                <tr>
                                    <td>
                                        <img src="{{asset('/images/cardimages/'.$ped->image)}}" width="108" height="99">
                                    </td>
                                    <td>
                                        {{$ped->codigo}}
                                    </td>
                                    <td>
                                        @if($ped->tipo_envio == 'EM')
                                            E-Mail
                                        @else
                                            Correio
                                        @endif

                                    </td>

                                    <td>
                                        {{$ped->nome_dest}} <br>
                                        @if($ped->tipo_envio == 'EM')
                                            {{$ped->dest_email}}<br>
                                            Agendado: <strong>{{$ped->data_agenda}}</strong>
                                        @else
                                            {{$ped->cep}}<br>
                                            {{$ped->endereco}}<br>
                                            {{$ped->complemento}}<br>
                                            {{$ped->bairro}}<br>
                                            {{$ped->cidade}} - {{$ped->uf}}<br>
                                        @endif
                                    </td>
                                    <td>
                                        R$ {{$ped->valor_ind}}
                                    </td>
                                    <td>
                                        @if($ped->envio == 1)
                                            <span class="label label-success"> <span class="glyphicon glyphicon-ok"> </span> ENVIADO </span>
                                            <br>
                                            {{$ped->data_envio}}
                                        @else
                                            <span class="label label-warning"> <span class="glyphicon glyphicon-remove"></span> AGUARDANDO ENVIO</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($ped->envio == 1)
                                            @if($ped->tipo_envio == 'EM')
                                                <button type="button" class="btn-sm btn-success"> Enviar Novamente </button>
                                            @endif
                                        @else
                                            @if($ped->tipo_envio == 'EM')
                                                <button type="button" class="btn-sm btn-success" data-toggle="modal" data-target="#modal-edit-email" onclick="addItemModal({{$ped->id}})"> Editar </button>
                                            @else
                                                <button type="button" class="btn-sm btn-success" data-toggle="modal" data-target="#modal-correio" onclick="addItemModal({{$ped->id}})"> Marcar Enviado </button>
                                            @endif
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


            <form>
                {{csrf_field()}}
                <!-- Modal -->
                <div class="modal fade" id="modal-edit-email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Editar Item</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="texto1">Novo Email</label>
                                            <input type="email" class="form-control" name="dest_email" maxlength="50">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="texto1">Nova Data</label>
                                            <input type="date" class="form-control" name="data_agenda">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" value="" name="idItem" id="idItem">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary" formaction="{{url('adm/editaritem')}}" formmethod="post">Editar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modal-correio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Editar Item</h4>
                                </div>
                                <div class="modal-body">
                                    Tem certeza que deseja marcar este cartão como enviado ?
                                    <input type="hidden" value="" name="idItemCorreio" id="idItemCorreio">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary" formaction="{{url('adm/marcarenviadocorreio')}}" formmethod="post">Editar</button>
                                </div>
                            </div>
                        </div>
                    </div>


            </form>
    </div>



@stop

@section('js')

    <script>
        function addItemModal(int)
        {
            $('#idItem').val(int);
            $('#idItemCorreio').val(int);
        }

        $(function () {
            $('#cards').DataTable();
        });
    </script>

@stop