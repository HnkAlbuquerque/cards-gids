@extends('template')

@section('custom-css')
    <style>
        label {
            font-size: 12px;
            color: #e65540;
        }

        .lds-roller {
            display: inline-block;
            position: relative;
            width: 64px;
            height: 64px;
            z-index: 1000;
        }
        .lds-roller div {
            animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
            transform-origin: 32px 32px;
        }
        .lds-roller div:after {
            content: " ";
            display: block;
            position: absolute;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #e65540;
            margin: -3px 0 0 -3px;
        }
        .lds-roller div:nth-child(1) {
            animation-delay: -0.036s;
        }
        .lds-roller div:nth-child(1):after {
            top: 50px;
            left: 50px;
        }
        .lds-roller div:nth-child(2) {
            animation-delay: -0.072s;
        }
        .lds-roller div:nth-child(2):after {
            top: 54px;
            left: 45px;
        }
        .lds-roller div:nth-child(3) {
            animation-delay: -0.108s;
        }
        .lds-roller div:nth-child(3):after {
            top: 57px;
            left: 39px;
        }
        .lds-roller div:nth-child(4) {
            animation-delay: -0.144s;
        }
        .lds-roller div:nth-child(4):after {
            top: 58px;
            left: 32px;
        }
        .lds-roller div:nth-child(5) {
            animation-delay: -0.18s;
        }
        .lds-roller div:nth-child(5):after {
            top: 57px;
            left: 25px;
        }
        .lds-roller div:nth-child(6) {
            animation-delay: -0.216s;
        }
        .lds-roller div:nth-child(6):after {
            top: 54px;
            left: 19px;
        }
        .lds-roller div:nth-child(7) {
            animation-delay: -0.252s;
        }
        .lds-roller div:nth-child(7):after {
            top: 50px;
            left: 14px;
        }
        .lds-roller div:nth-child(8) {
            animation-delay: -0.288s;
        }
        .lds-roller div:nth-child(8):after {
            top: 45px;
            left: 10px;
        }
        @keyframes lds-roller {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .modal {
            display:    none;
            position:   fixed;
            z-index:    1000;
            top:        0;
            left:       0;
            height:     100%;
            width:      100%;
            background: rgba( 255, 255, 255, .8 )
            url('{{asset('css/gifloading.gif')}}')
            50% 50%
            no-repeat;
        }

        /* When the body has the loading class, we turn
           the scrollbar off with overflow:hidden */
        body.loading .modal {
            overflow: hidden;
        }

        /* Anytime the body has the loading class, our
           modal element will be visible */
        body.loading .modal {
            display: block;
        }



    </style>
@endsection


@section('content')

    <!-- Title Page -->
    <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url('{{asset('/images/carrinho').'/'. $carrinho_header->img}}');">
        <h2 class="l-text2 t-center">
            PAGAMENTO
        </h2>
    </section>

    <!-- content page -->
    <section class="bgwhite p-t-66 p-b-60">
        <div class="container">

            @if (session('status'))
                <div class="alert alert-danger">
                    {!! session('status')  !!}
                </div>
            @endif

            <form id="form" method="post" action="{{url('/gerarpedido')}}">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="bo9 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 p-lr-15-sm">
                            <h5 class="m-text20 p-b-24">
                                Total
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


                        </div>
                    </div>


                    <div class="col-md-9" id="infoRemetente">
                        <div class="bo9 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 p-lr-15-sm">
                            <h5 class="m-text20 p-b-24">
                                Informações do remetente
                            </h5>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class='flex-m flex-w p-b-25'>
                                        <div class='s-text15 w-size15'>
                                            CPF
                                        </div>

                                        <div class='bo4 cartao-input-size'>
                                            <input class='sizefull s-text7 p-l-22 p-r-22' type='text' name='cpf' id="cpf" placeholder=''>
                                        </div>
                                    </div>

                                    <div class='flex-m flex-w p-b-25'>
                                        <div class='s-text15 w-size15'>
                                            Nome
                                        </div>

                                        <div class='bo4 cartao-input-size'>
                                            <input class='sizefull s-text7 p-l-22 p-r-22' type='text' name='nome' id="nome" placeholder='' maxlength="50">
                                        </div>
                                    </div>

                                    <div class='flex-m flex-w p-b-25'>
                                        <div class='s-text15 w-size15'>
                                            Sexo
                                        </div>

                                        <div class="rs2-select2 rs3-select2 bo4 w-size16">
                                            <select class="selection-2" name="sexo" id="sexo">
                                                <option value="">Selecione o Sexo</option>
                                                <option value="A">Feminino</option>
                                                <option value="G">Masculino</option>
                                            </select>
                                        </div>

                                    </div>

                                </div>

                                <div class="col-sm-6">
                                    <div class='flex-m flex-w p-b-25'>
                                        <div class='s-text15 w-size15'>
                                            Email
                                        </div>

                                        <div class='bo4 cartao-input-size'>
                                            <input class='sizefull s-text7 p-l-22 p-r-22' type='email' name='email' id="email" placeholder=''>
                                        </div>
                                    </div>

                                    <div class='flex-m flex-w p-b-25'>
                                        <div class='s-text15 w-size15'>
                                            Telefone
                                        </div>

                                        <div class='bo4 cartao-input-size'>
                                            <input class='sizefull s-text7 p-l-22 p-r-22' type='text' name='fone' id="fone" placeholder=''>
                                        </div>
                                    </div>

                                    <div class='flex-m flex-w p-b-25'>
                                        <div class='s-text15 w-size15'>
                                            Campo
                                        </div>

                                        <div class="rs2-select2 rs3-select2 bo4 w-size16">
                                            <select class="selection-2" name="campo" id="campo">
                                                <option value="0"></option>
                                                @foreach($campo as $cmp)
                                                    <option value="{{$cmp->id}}">{{$cmp->id}} - {{$cmp->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- <div class='bo4 cartao-input-size'>

                                         </div> -->
                                    </div>


                                </div>


                                <div class="w-size24 m-l-auto">
                                    <!-- Button -->
                                    <button type="button" id="proximoPasso" class="flex-c-m size1 bg1 bo-rad-23 hov1 m-text3 trans-0-4">
                                        PROXIMO PASSO
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-9" id="infoPagamento" style="display: none">
                        <div class="bo9 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 p-lr-15-sm">
                            <h5 class="m-text20 p-b-24">
                                Informações de Pagamento
                            </h5>

                            <div class="row">

                                <div class="col-sm-6">
                                    <div class='flex-m flex-w p-b-25'>
                                        <div class='s-text15 w-size15'>
                                            Pagamento
                                        </div>

                                        <div class="rs2-select2 rs3-select2 bo4 w-size16">
                                            <select class="selection-2" name="pagTipo" id="pagTipo">
                                                <option value="">Selecione o Tipo</option>
                                                <option value="C">Cartão de Crédito</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="w-size16 flex-m flex-w m-l-auto">
                                        <div class="block2-txt">
                                            <a href="#" class="block2-name dis-block s-text3 p-b-5" id="voltar">
                                                VOLTAR
                                            </a>
                                        </div>

                                        <div class="btn-addcart-product-detail size10 trans-0-4 m-t-10 m-b-10 p-l-20">
                                            <!-- Button -->
                                            <button type="button" id="gerar" class="flex-c-m size1 bg1 bo-rad-23 hov1 m-text3 trans-0-4">
                                                GERAR PEDIDO
                                            </button>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-6" id="receive">



                                </div>




                            </div>




                        </div>
                    </div>
                </div>
            </form>

        </div>
    </section>

    <div class="modal">

        <!-- <div style="background: #0a2b1d;">
             <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
             Processando ...
         </div> -->

    </div>


@endsection

@section('post-script')

    <script>
        var varcpf = "{{url('/consultacpf')}}"
    </script>
    <script src="{{asset('js/site/pagamento.js')}}"></script>

@endsection