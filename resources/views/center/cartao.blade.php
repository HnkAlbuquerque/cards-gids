@extends('template')

@section('custom-css')
    <style>
        label {
            font-size: 12px;
            color: #e65540;
        }
    </style>
@endsection

@section('content')

    <!-- Title Page -->
    <section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(../images/header/{{$header->img}});">
        <h2 class="l-text2 t-center">
            {{$header->texto1}}
        </h2>
        <p class="m-text13 t-center">
            {{$header->texto2}}
        </p>
    </section>

    <!-- Product Detail -->
    <div class="container bgwhite p-t-35 p-b-80">
        <div class="flex-w flex-sb">

            <div class="w-size13 p-t-30 respon5">
                <div class="wrap-slick3 flex-sb flex-w">
                    <div class="wrap-slick3-dots"></div>

                    <div class="slick3">
                        @foreach($imagens as $img)
                        <div class="item-slick3" data-thumb="{{asset('images/cardthumbs')."/$img->thumb"}}">
                            <div class="wrap-pic-w">
                                <img src="{{asset('images/cardimages')."/$img->image"}}" alt="IMG-PRODUCT">
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>

            <div class="w-size14 p-t-30 respon5 cartao-detalhe">
                <h4 class="product-detail-name m-text16 p-b-13">
                    {{$cartao->codigo}}

                </h4>

                <div class="conteudo-form">
                    <!--  -->
                    <div class="p-b-45">
                        <span class="s-text8">Categoria: {{$categoria->nome}}</span>
                    </div>
                    <!--  -->
                    <div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
                        <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                            Descrição
                            <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                            <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                        </h5>

                        <div class="dropdown-content dis-none p-t-15 p-b-23">
                            <p class="s-text8">
                                {{$cartao->desc}}
                            </p>
                        </div>
                    </div>

                    <div class="wrap-dropdown-content bo7 p-t-15 p-b-14 active-dropdown-content">
                        <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                            Informação Adicional
                            <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                            <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                        </h5>

                        <div class="dropdown-content dis-none p-t-15 p-b-23">
                            <p class="s-text8">
                                <strong>Disponibilidade: </strong> {{$cartao->correio == true ?  'Correio' : ''}} {{$cartao->email == true ?  ' ,Email' : ''}} <br>
                                <strong>Orientação:</strong> {{$cartao->orientacao == 'H' ?  'Horizontal' : 'Vertical'}} <br>
                                <strong>Versículo:</strong> {{$versiculo->referencia}} <br>
                                {{$versiculo->texto}}<br><br>
                                <strong>Testemunho:</strong> {{$testemunho->texto}}
                            </p>
                        </div>
                    </div>

                    <div class="p-t-10 p-l-30">
                        <!--
                        <div class="flex-m flex-w p-b-10">
                            <div class="s-text15 w-size15 t-center">
                                Size
                            </div>

                            <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
                                <select class="selection-2" name="size">
                                    <option>Choose an option</option>
                                    <option>Size S</option>
                                    <option>Size M</option>
                                    <option>Size L</option>
                                    <option>Size XL</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex-m flex-w">
                            <div class="s-text15 w-size15 t-center">
                                Color
                            </div>

                            <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
                                <select class="selection-2" name="color">
                                    <option>Choose an option</option>
                                    <option>Gray</option>
                                    <option>Red</option>
                                    <option>Black</option>
                                    <option>Blue</option>
                                </select>
                            </div>
                        </div>
                        -->

                        <div class="flex-r-m flex-w p-t-10">
                            <div class="w-size16 flex-m flex-w">

                                <!-- <div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
                                     <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                                         <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                     </button>

                                     <input class="size8 m-text18 t-center num-product" type="number" name="num-product" value="1">

                                     <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                                         <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                     </button>
                                 </div>
                                 -->

                                <div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
                                    <!-- Button -->
                                    <button type="button" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" id="personalizar">
                                        Personalizar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <form id="addCartao">
                    {{csrf_field()}}
                    <div class="conteudo-form-custom" style="display: none">
                    <!--  -->

                    <div class="p-t-10">

                        <div class="flex-m flex-w p-b-25">
                            <div class="s-text15 w-size15 t-center">
                                Envio
                            </div>

                            <div class="rs2-select2 rs3-select2 bo4 w-size16">
                                <select class="selection-2" name="tipo" id="tipo">
                                    <option value="">Escolha um tipo de envio</option>
                                    @if($cartao->email == true)
                                        <option value="EM">Email</option>
                                    @endif

                                    @if($cartao->correio == true)
                                        <option value="CO">Correio</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="flex-m flex-w p-b-25">
                            <div class="s-text15 w-size15 t-center">
                                Nome Destinatário
                            </div>

                            <div class='bo4 cartao-input-size'>
                                 <input class='sizefull s-text7 p-l-22 p-r-22' type='text' name='nome_dest' id='nome_dest' placeholder='Destinatário'>
                            </div>
                        </div>

                        <div id="receiveTipo" style="display: none">

                        </div>

                        <div class="flex-m flex-w p-b-20">
                            <div class="p-b-20">
                               Mensagem Personalizada
                            </div>

                            <textarea class="dis-block s-text7 cartao-textarea-size bo4 p-l-22 p-r-22 p-t-13 m-b-20 m-l-100" name="mensagem" placeholder="Mensagem"></textarea>
                        </div>



                        <div class="flex-m flex-w p-b-10">
                            <div>
                                Ofertar Novos Testamentos por este cartão. (Min 4 NT)<br>
                                R$ {{$valor_nt->valor_nt}} cada
                            </div>
                        </div>

                        <div class="flex-m flex-w p-b-10">
                            <div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
                                <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2" onclick="calcLabelMenos()">
                                    <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                </button>

                                <input class="size8 m-text18 t-center num-product" type="number" name="num-product" id="num-product" value="4" onblur="calcLabel()">

                                <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2" onclick="calcLabelMais()">
                                    <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </div>


                          <!--  <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-default ">
                                    <input type="radio" name="orientacao" id="orientacao1" autocomplete="off" value="H"  > HORIZONTAL
                                </label>
                                <label class="btn btn-default ">
                                    <input type="radio" name="orientacao" id="orientacao2" autocomplete="off" value="V"  > VERTICAL
                                </label>
                            </div>
                            -->

                            <div class="size11 trans-0-4 m-t-30 m-b-10">
                                <!-- Button -->
                                <h5>Novos Testamentos</h5>
                            </div>

                            <div class="size9 trans-0-4 m-t-10 m-b-10">
                                <!-- Button -->
                                <h5>Total Ofertado</h5>
                            </div>

                            <div class="size9 trans-0-4 m-t-5 m-b-10">
                                <!-- Button -->
                                <h4 class="m-text-custom"></h4>

                            </div>


                        </div>


                    <!--    <div class="flex-m flex-w p-b-10">
                            <div class="s-text15 w-size15 t-center">
                                E-mail do Destinatário
                            </div>

                            <div class="bo4 of-hidden cartao-input-size">
                                <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="dest-email" placeholder="Email">
                            </div>
                        </div> -->

                        <hr>

                        <div class="flex-r-m flex-w p-t-10">
                            <div class="w-size16 flex-m flex-w">



                                <div class="block2-txt p-t-10">
                                    <a href="#" class="block2-name dis-block s-text3 p-b-5" id="voltar">
                                        VOLTAR
                                    </a>
                                </div>

                                <div class="btn-addcart-product-detail size10 trans-0-4 m-t-10 m-b-10 p-l-20">
                                    <!-- Button -->

                                    <button type="submit" formmethod="post" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" id="adicionar">
                                        ADICIONAR
                                    </button>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                </form>


            </div>
        </div>
    </div>


    @if($relacionado)
    <!-- Relate Product -->
    <section class="relateproduct bgwhite p-t-45 p-b-138">
        <div class="container">
            <div class="sec-title p-b-60">
                <h3 class="m-text5 t-center">
                    Cartões Relacionados
                </h3>
            </div>

            <!-- Slide2 -->
            <div class="wrap-slick2">
                <div class="slick2">

                    @foreach($relacionado as $rel)
                    <div class="item-slick2 p-l-15 p-r-15">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-img wrap-pic-w of-hidden pos-relative">
                                <img src="{{asset('images/cardimages') .'/'. $rel->image}}" alt="IMG-PRODUCT">

                                <div class="block2-overlay trans-0-4">

                                    <div class="block2-btn-addcart w-size1 trans-0-4">
                                        <!-- Button -->
                                        <a href="{{url('/cartao-detalhe') . "/$rel->id"}}" class="block2-name dis-block s-text3 p-b-5">
                                            <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                Mais Detalhes
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="block2-txt p-t-20">
                                <a href="{{url('/cartao-detalhe') . "/$rel->id"}}" class="block2-name dis-block s-text3 p-b-5">
                                    {{$rel->codigo}}
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>

        </div>
    </section>
    @endif


@endsection

@section('post-script')

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
    <script type="text/javascript" src="{{asset('assets/vendor/daterangepicker/moment.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendor/daterangepicker/daterangepicker.js')}}"></script>

    <script>
        var cod = "{{$cartao->codigo}}";
        var cardid = "{{$cartao->id}}";
        var img = "{{$face->image}}";
        var urladd = "{{url('/adicionarcarrinho')}}";
        var cart = "{{url('/carrinho')}}";
        var val = parseFloat("{{$valor_nt->valor_nt}}").toFixed(2)
    </script>

    <script type="text/javascript" src="{{asset('js/site/cartaodetalhe.js')}}"></script>
@endsection