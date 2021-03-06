@extends('adminlte::page')

@section('title', 'Envie Cartões')

@section('content_header')
    <h1>Header - Sobre</h1>
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
                            <h3 class="box-title">Novo Header - Sobre</h3>
                        </div>
                        <div class="box-body" style="background: #EEEEEE">
                            <div class="col-xs-6">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="texto1">Imagem</label> (1920x239)

                                            <input type="file" class="form-control" accept="image/*" name="img" value="" required>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="texto1">Brilho da imagem</label> Dica: para imagens muito claras deve-se utilizar valor de brilho negativo ex: -20

                                            <input type="range" min="-50" max="50" value="0" name="brilho" id="brilho">

                                            <h4 id="range_value" style="color: #FF3500">0</h4>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button class="btn btn-primary" formaction="{{url('adm/savesobre')}}" formmethod="post">ADICIONAR</button>
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
                        <h3 class="box-title">Headers-Sobre Cadastrados</h3>

                    </div>
                    <div class="box-body">
                        <table id="sobre" class="table table-hover">
                            <thead>
                            <th>#</th>
                            <th>IMG</th>
                            <th>Status</th>
                            <th>Ação</th>
                            </thead>
                            <tbody>
                            @foreach($sobre as $con)
                                <tr>
                                    <td>
                                        {{$con->id}}
                                    </td>
                                    <td>
                                        <img src="{{asset('/images/sobre/'.$con->img)}}" width="190" height="40">
                                    </td>

                                    <td>
                                        @if($con->ativo == 1)
                                            <span class="label label-success"> <span class="glyphicon glyphicon-ok"> </span> ATIVO </span>
                                        @else
                                            <span class="label label-danger"> <span class="glyphicon glyphicon-remove"></span> DESATIVADO </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($con->ativo == 1)

                                        @else
                                            <a href="{{url('adm/sobre_status/'.$con->id)}}">
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
            $('#sobre').DataTable();

        });

        $(document).on('input', '#brilho', function() {
            $('#range_value').html( $(this).val() );
        });
    </script>

@stop