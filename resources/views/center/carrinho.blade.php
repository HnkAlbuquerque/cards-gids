@extends('template')


@section('content')
<!-- Title Page -->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url('{{asset('/images/carrinho').'/'. $carrinho_header->img}}')">
    <h2 class="l-text2 t-center">
       Meu Carrinho
    </h2>
</section>

<!-- Cart -->
<section class="cart bgwhite p-t-70 p-b-100">
    <div class="container">
        <!-- Cart item -->
        <div class="container-table-cart pos-relative">
            <div class="wrap-table-shopping-cart bgwhite">
                <table class="table-shopping-cart">
                    <tr class="table-head">
                        <th class="column-1"></th>
                        <th class="column-2">Cartão</th>
                        <th class="column-3">Envio</th>
                        <th class="column-4">Ação</th>
                        <th class="column-5">Oferta</th>

                    </tr>

                    @foreach(Cart::content() as $row)
                        <tr class="table-row">
                        <td class="column-1">
                            <div class="cart-img-product b-rad-4 o-f-hidden">
                                <img src="{{asset('images/cardimages').'/'.$row->options->img}}" alt="IMG-PRODUCT">
                            </div>
                        </td>
                        <td class="column-2">{{$row->name}}</td>
                        @if($row->options->tipo == 'EM')
                                <td class="column-3">
                                    Email <br>
                                    {{$row->options->email}} <br>
                                    {{$row->options->date}}
                                </td>
                        @else
                                <td class="column-3">
                                    Correio <br>
                                    {{$row->options->cep}} <br>
                                    {{$row->options->endereco}} <br>
                                    {{$row->options->cidade}} - {{$row->options->estado}}

                                </td>
                        @endif
                        <td class="column-4">
                            <button type="button" class="btn-num-product-down color1 flex-c-m size7 bg8 eff2" onclick="removeProduct('{{$row->rowId}}', '{{$row->name}}')">
                                <i class="fs-12 fa fa-remove" aria-hidden="true"></i>
                            </button>
                        </td>

                        <td class="column-5">{{number_format($row->price, 2, ',', '.')}}</td>

                    </tr>
                    @endforeach

                </table>
            </div>
        </div>


        <!-- Total -->
        <div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
            <h5 class="m-text20 p-b-24">
                Total no Carrinho
            </h5>


            <!--  -->
            <div class="flex-w flex-sb-m p-t-26 p-b-30">
				<span class="m-text22 w-size19 w-full-sm">
						Total:
                </span>

                <span class="m-text21 w-size20 w-full-sm">
						R$ {{Cart::subtotal()}}
                </span>
            </div>

            <div class="size15 trans-0-4">
                <!-- Button -->
                <a href="{{route('sitePagamento')}}">
                    <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                        Ir para Pagamento
                    </button>
                </a>

            </div>
        </div>
    </div>
</section>
@endsection

@section('post-script')

    <script>

        var url_rm = "{{url('/removerproduto')}}";
        var cart = '{{url('/carrinho')}}';

    </script>

    <script type="text/javascript" src="{{asset('js/site/carrinho.js')}}"></script>

@endsection
