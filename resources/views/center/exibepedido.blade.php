@extends('template')


@section('content')
    <!-- Title Page -->
    <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url('{{asset('/images/carrinho').'/'. $carrinho_header->img}}')">
        <h2 class="l-text2 t-center">
            Pedido #{{$pedido->id}}
        </h2>
    </section>

    <!-- Cart -->
    <section class="cart bgwhite p-t-70 p-b-100">
        <div class="container">

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif


            <!-- Total -->
            <div class="bo9 w-size13 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 p-lr-15-sm">
                <h5 class="m-text20 p-b-24">
                    Informações de Pagamento
                </h5>

                <!--  -->
                <div class="flex-w flex-sb-m p-t-26 p-b-30">
                    <span class="m-text22 w-size29 w-full-sm">
                            Total:
                    </span>
                    <span class="m-text21 w-size29 w-full-sm">
                      R$   {{number_format($pedido->valor_total, 2, ',', '.')}}
                    </span>
                    <span class="m-text22 w-size29 w-full-sm">
                           Forma de Pagamento:
                    </span>
                    <span class="m-text21 w-size29 w-full-sm">
                        @if($pedido->pg_tipo == 'C')
                            Cartão de Crédito
                        @else
                            Boleto Bancário
                        @endif
                    </span>
                    <span class="m-text22 w-size29 w-full-sm">
                           Status:
                    </span>
                    <span class="m-text21 w-size29 w-full-sm">
                        @if($pedido->ped_status == 'true')
                            Pagamento Recebido
                        @else
                            Aguardando Recebimento
                        @endif
                    </span>
                </div>

                <h3 class="m-text19 p-b-10">
                    Informações da forma de pagamento
                </h3>

                <div class="flex-w flex-sb-m p-t-10 p-b-30">
                @if($pedido->pg_tipo == 'C')
                    <span class="m-text22 w-size29 w-full-sm">
                           Processamento:
                    </span>
                    <span class="m-text21 w-size29 w-full-sm">
                            {{$formaPag->id_cartao}}
                    </span>

                    <span class="m-text22 w-size29 w-full-sm">
                          Nome:
                    </span>
                    <span class="m-text21 w-size29 w-full-sm">
                            {{$formaPag->nome}}
                    </span>

                    <span class="m-text22 w-size29 w-full-sm">
                          Cartão:
                    </span>
                    <span class="m-text21 w-size29 w-full-sm">
                        {{$formaPag->cartao_num}}
                    </span>

                    <span class="m-text22 w-size29 w-full-sm">
                          Validade:
                    </span>
                    <span class="m-text21 w-size29 w-full-sm">
                          {{$formaPag->validade}}
                    </span>
                @else
                    <span class="m-text22 w-size29 w-full-sm">
                           Boleto número:
                    </span>
                    <span class="m-text21 w-size29 w-full-sm">
                            {{$formaPag->id}}
                    </span>
                @endif
                </div>



            </div>

            <!-- Cart item -->
            <div class="container-table-cart pos-relative">
                <div class="wrap-table-shopping-cart bgwhite">
                    <table class="table-shopping-cart">
                        <tr class="table-head">

                            <th class="column-1"></th>
                            <th class="column-2">Cartão</th>
                            <th class="column-3">Envio</th>
                            <th class="column-4">Status</th>
                            <th class="column-5">Oferta</th>

                        </tr>

                        @foreach($pedidoDetalhe as $row)
                            <tr class="table-row">
                                <td class="column-1">
                                    <div class="cart-img-product b-rad-4 o-f-hidden">
                                        <img src="{{asset('images/cardimages').'/'.$row->image}}" alt="IMG-PRODUCT">
                                    </div>
                                </td>
                                <td class="column-2">{{$row->codigo}}</td>
                                @if($row->tipo_envio == 'EM')
                                    <td class="column-3">
                                        Email <br>
                                        {{$row->dest_email}} <br>
                                        {{$row->dt_agenda}}
                                    </td>
                                @else
                                    <td class="column-3">
                                        Correio <br>
                                        {{$row->cep}} <br>
                                        {{$row->endereco}} <br>
                                        {{$row->cidade}} - {{$row->uf}}

                                    </td>
                                @endif
                                <td class="column-4">
                                    @if($row->envio == true)
                                        Enviado <br>
                                        {{$row->dt_envio}}
                                    @else
                                        Agendado
                                    @endif

                                </td>
                                <td class="column-5">{{number_format($row->valor_ind, 2, ',', '.')}}</td>

                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>



        </div>
    </section>
@endsection


