@extends('template')

@section('content')

<!-- Slide1 -->
<section class="slide1">
    <div class="wrap-slick1">
        <div class="slick1">
            @foreach($banners as $banner)
            <div class="item-slick1 item1-slick1" style="background-image: url(images/banners/{{$banner->img}});">
                <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
                    <h2 class="caption1-slide1 xl-text2 t-center bo14 p-b-6 animated visible-false m-b-22" data-appear="fadeInUp" >
                        {{$banner->texto1}}
                    </h2>

                    <span class="caption2-slide1 m-text1 t-center animated visible-false m-b-33" data-appear="fadeInDown">
							{{$banner->texto2}}
						</span>
                    @if($banner->button_exist)
                    <div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
                        <!-- Button -->
                        <a href="{{$banner->button_link}}" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-8">
                            {{$banner->button_texto}}
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach




        </div>
    </div>
</section>

<!-- Banner
<div class="banner bgwhite p-t-40 p-b-40">
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">

                <div class="block1 hov-img-zoom pos-relative m-b-30">
                    <img src="{{asset('assets/images/banner-05.jpg')}}" alt="IMG-BENNER">

                    <div class="block1-wrapbtn w-size2">

                        <a href="#" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
                            Sunglasses
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">

                <div class="block1 hov-img-zoom pos-relative m-b-30">
                    <img src="{{asset('assets/images/banner-03.jpg')}}" alt="IMG-BENNER">

                    <div class="block1-wrapbtn w-size2">

                        <a href="#" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
                            Watches
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">

                <div class="block1 hov-img-zoom pos-relative m-b-30">
                    <img src="{{asset('assets/images/banner-10.jpg')}}" alt="IMG-BENNER">

                    <div class="block1-wrapbtn w-size2">

                        <a href="#" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
                            Bags
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
-->

<!-- Our product -->
<section class="bgwhite p-t-45 p-b-58">
    <div class="container">
        <div class="sec-title p-b-22">
            <h3 class="m-text5 t-center">
                Nossos Cartões
            </h3>
        </div>

        <!-- Tab01 -->
        <div class="tab01">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#novos" role="tab">Últimos Adicionados</a>
                </li>
                @foreach($randomCat as $r)
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#{{$r->id}}" role="tab">{{$r->nome}}</a>
                    </li>
                @endforeach


            </ul>

            <!-- Tab panes -->
            <div class="tab-content p-t-35">
                <!-- - -->
                <div class="tab-pane fade show active" id="novos" role="tabpanel">
                    <div class="row">

                        @foreach($novos as $n)
                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
                                    <img src="{{asset('images/cardimages') .'/'. $n->image}}" alt="IMG-PRODUCT">

                                    <div class="block2-overlay trans-0-4">

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <a href="{{url('/cartao-detalhe') . "/$n->id"}}">
                                                <button type="button" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                    MAIS DETALHES
                                                </button>
                                            </a>

                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="{{url('/cartao-detalhe') . "/$n->id"}}" class="block2-name dis-block s-text3 p-b-5">
                                        {{$n->codigo}}
                                    </a>
                                    <span class="block2-price p-r-5">
                                        {{$n->nome}}
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>

                <!-- 3 CATEGORIAS ALEATORIAS QUE SÃO EXIBIDAS NA PAGINA INICIAL -->
                @foreach($randomCat as $r)
                <div class="tab-pane fade" id="{{$r->id}}" role="tabpanel">
                    <div class="row">

                        @foreach($result[$r->id] as $res)
                            <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                                <!-- Block2 -->
                                <div class="block2">
                                    <div class="block2-img wrap-pic-w of-hidden pos-relative">
                                        <img src="{{asset('images/cardimages') .'/'. $res->image}}" alt="IMG-PRODUCT">

                                        <div class="block2-overlay trans-0-4">

                                            <div class="block2-btn-addcart w-size1 trans-0-4">
                                                <!-- Button -->
                                                <a href="{{url('/cartao-detalhe') . "/$res->id"}}">
                                                    <button type="button" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                        MAIS DETALHES
                                                    </button>
                                                </a>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="block2-txt p-t-20">
                                        <a href="{{url('/cartao-detalhe') . "/$res->id"}}" class="block2-name dis-block s-text3 p-b-5">
                                            {{$res->codigo}}
                                        </a>
                                        <span class="block2-price p-r-5">
                                        {{$res->nome}}
                                    </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                @endforeach



            </div>
        </div>
    </div>
</section>


<!-- Banner video -->
<section class="parallax0 parallax100" style="background-image: url(images/parallax/{{$parallax->img}});">
    <div class="overlay0 p-t-190 p-b-200">
        <div class="flex-col-c-m p-l-15 p-r-15">
				<span class="m-text9 p-t-45 fs-20-sm">
                {{$parallax->texto1}}
				</span>

            <h3 class="l-text1 fs-35-sm">
                {{$parallax->texto2}}
            </h3>

            <span class="btn-play s-text4 hov5 cs-pointer p-t-25" data-toggle="modal" data-target="#modal-video-01">
					<i class="fa fa-play" aria-hidden="true"></i>
					Veja o vídeo
				</span>
        </div>
    </div>
</section>

<!-- Modal Video 01-->
<div class="modal fade" id="modal-video-01" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog" role="document" data-dismiss="modal">
        <div class="close-mo-video-01 trans-0-4" data-dismiss="modal" aria-label="Close">&times;</div>

        <div class="wrap-video-mo-01">
            <div class="w-full wrap-pic-w op-0-0"><img src="{{asset('assets/images/icons/video-16-9.jpg')}}" alt="IMG"></div>
            <div class="video-mo-01">
                <iframe src="{{$parallax->video_url}}?autoplay=0&loop=0&autopause=0"></iframe>
            </div>
        </div>
    </div>
</div>


<!-- Shipping -->
<section class="shipping bgwhite p-t-62 p-b-46">
    <div class="flex-w p-l-15 p-r-15">
        <div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
            <h4 class="m-text12 t-center">
                Entrega de cartões por e-mail imediata
            </h4>

            <a href="{{route('sitesobre')}}" class="s-text11 t-center">
                Clique aqui para mais informações sobre o Envie Cartões
            </a>
        </div>

        <div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 bo2 respon2">
            <h4 class="m-text12 t-center">
                20 Dias para cartões via correios
            </h4>

            <span class="s-text11 t-center">
                Aplica-se para todos os cartões dessa modalidade
            </span>
        </div>

        <div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
            <h4 class="m-text12 t-center">
                Envie cartões em qualquer momento
            </h4>

            <span class="s-text11 t-center">

			</span>
        </div>
    </div>
</section>

@endsection