<!DOCTYPE html>
<html lang="en">
<head>
    <title>Envie Cartões</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{asset('assets/images/icons/favicon.png')}}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/fonts/themify/themify-icons.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/fonts/elegant-font/html-css/style.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/animate/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/animsition/css/animsition.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/daterangepicker/daterangepicker.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/slick/slick.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/lightbox2/css/lightbox.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/main.css')}}">
    <!--===============================================================================================-->
    @yield('custom-css')

</head>
<body class="animsition">

<!-- header fixed -->
<div class="wrap_header fixed-header2 trans-0-4">
    <!-- Logo -->
    <a href="{{url('')}}" class="logo">
        <img src="{{asset('assets/images/icons/logo1.png')}}" alt="IMG-LOGO">
    </a>

    <!-- Menu -->
    <div class="wrap_menu">
        <nav class="menu">
            <ul class="main_menu">
                <li>
                    <a href="{{url('')}}">Home</a>
                </li>

                <li>
                    <a href="{{url('/listarcartoes/cards')}}">Envie Cartões</a>
                </li>

                <li>
                    <a href="{{url('/sobre')}}">Sobre</a>
                </li>

                <li>
                    <a href="{{url('/contato')}}">Contato</a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="header-icons">

        <span class="linedivide1"></span>

        <div class="header-wrapicon2">
            <img src="{{asset("assets/images/icons/icon-header-02.png")}}" class="header-icon1 js-show-header-dropdown" alt="ICON">
            <span class="header-icons-noti">{{Cart::count()}}</span>

            <!-- Header cart noti -->
            <div class="header-cart header-dropdown">

                @if(Cart::count() > 0)
                    <ul class="header-cart-wrapitem">
                        @foreach(Cart::content() as $row)
                        <li class="header-cart-item">
                            <div class="header-cart-item-img">
                                <img src="{{asset('images/cardimages/').'/'.$row->options->img}}" alt="IMG">
                            </div>

                            <div class="header-cart-item-txt">
                                <a href="#" class="header-cart-item-name">
                                    {{$row->name}}
                                </a>

                                <span class="header-cart-item-info">
                                    {{number_format($row->price, 2, ',', '.')}}
                                </span>
                            </div>
                        </li>
                        @endforeach
                    </ul>

                    <div class="header-cart-total">
                        Total: R$ {{number_format(Cart::subtotal(), 2, ',', '.')}}
                    </div>

                    <div class="header-cart-buttons">
                        <div class="header-cart-wrapbtn">
                            <!-- Button -->
                            <a href="{{url('/carrinho')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                Ver Carrinho
                            </a>
                        </div>

                        <div class="header-cart-wrapbtn">
                            <!-- Button -->
                            <a href="{{url('/pagamento')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                Pagamento
                            </a>
                        </div>
                    </div>
                @else
                    <div>
                        Ops! Você não tem cartões adicionados, de uma olhada na nossa loja :)
                    </div>
                    <hr>
                    <div class="header-cart-buttons">
                        <div class="header-cart-wrapbtn">
                            <!-- Button -->
                            <a href="{{url('/listarcartoes/cards')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                Ver Cartões
                            </a>
                        </div>

                    </div>
                @endif

            </div>
        </div>
    </div>
    

</div>

<!-- top noti

<div class="flex-c-m size22 bg0 s-text21 pos-relative">
    20% off everything!
    <a href="product.html" class="s-text22 hov6 p-l-5">
        Shop Now
    </a>

    <button class="flex-c-m pos2 size23 colorwhite eff3 trans-0-4 btn-romove-top-noti">
        <i class="fa fa-remove fs-13" aria-hidden="true"></i>
    </button>
</div>

-->

<!-- Header -->
<header class="header2">
    <!-- Header desktop -->
    <div class="container-menu-header-v2 p-t-26">
        <div class="topbar2">
            <div class="topbar-social">
                <a href="https://www.facebook.com/osgideoesinternacionaisnobrasil" class="topbar-social-item fa fa-facebook"></a>
            </div>

            <!-- Logo2 -->
            <a href="{{url('')}}" class="logo2">
                <img src="{{asset('assets/images/icons/logo1.png')}}" alt="IMG-LOGO">
            </a>

            <div class="topbar-child2">
					<span class="topbar-email">
						pgd@gideoes.org.br
					</span>

                <span class="linedivide1"></span>

                <div class="header-wrapicon2 m-r-13">
                    <img src="{{asset("assets/images/icons/icon-header-02.png")}}" class="header-icon1 js-show-header-dropdown" alt="ICON">
                    <span class="header-icons-noti">{{Cart::count()}}</span>

                    <!-- Header cart noti -->
                    <div class="header-cart header-dropdown">
                        @if(Cart::count() > 0)
                            <ul class="header-cart-wrapitem">
                                @foreach(Cart::content() as $row)
                                    <li class="header-cart-item">
                                        <div class="header-cart-item-img">
                                            <img src="{{asset('images/cardimages/').'/'.$row->options->img}}" alt="IMG">
                                        </div>

                                        <div class="header-cart-item-txt">
                                            <a href="#" class="header-cart-item-name">
                                                {{$row->name}}
                                            </a>

                                            <span class="header-cart-item-info">
                                    {{number_format($row->price, 2, ',', '.')}}
                                </span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="header-cart-total">
                                Total: R$ {{number_format(Cart::subtotal(), 2, ',', '.')}}
                            </div>

                            <div class="header-cart-buttons">
                                <div class="header-cart-wrapbtn">
                                    <!-- Button -->
                                    <a href="{{url('/carrinho')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        Ver Carrinho
                                    </a>
                                </div>

                                <div class="header-cart-wrapbtn">
                                    <!-- Button -->
                                    <a href="{{url('/pagamento')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        Pagamento
                                    </a>
                                </div>
                            </div>
                        @else
                            <div>
                                Ops! Você não tem cartões adicionados, de uma olhada na nossa loja :)
                            </div>
                            <hr>
                            <div class="header-cart-buttons">
                                <div class="header-cart-wrapbtn">
                                    <!-- Button -->
                                    <a href="{{url('/listarcartoes/cards')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        Ver Cartões
                                    </a>
                                </div>

                            </div>
                        @endif
                    </div>
                </div>
            </div>




        </div>

        <div class="wrap_header">

            <!-- Menu -->
            <div class="wrap_menu">
                <nav class="menu">
                    <ul class="main_menu">
                        <li>
                            <a href="{{url('')}}">Home</a>
                        </li>

                        <li>
                            <a href="{{url('/listarcartoes/cards')}}">Envie Cartões</a>
                        </li>

                        <li>
                            <a href="{{url('/sobre')}}">Sobre</a>
                        </li>

                        <li>
                            <a href="{{url('/contato')}}">Contato</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Header Icon -->
            <div class="header-icons">

            </div>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap_header_mobile">
        <!-- Logo moblie -->
        <a href="{{url('')}}" class="logo-mobile">
            <img src="{{asset('assets/images/icons/logo1.png')}}" alt="IMG-LOGO">
        </a>

        <!-- Button show menu -->
        <div class="btn-show-menu">
            <!-- Header Icon mobile -->
            <div class="header-icons-mobile">

                <div class="header-wrapicon2">
                    <img src="{{asset("assets/images/icons/icon-header-02.png")}}" class="header-icon1 js-show-header-dropdown" alt="ICON">
                    <span class="header-icons-noti">{{Cart::count()}}</span>

                    <!-- Header cart noti -->
                    <div class="header-cart header-dropdown">

                        @if(Cart::count() > 0)
                            <ul class="header-cart-wrapitem">
                                @foreach(Cart::content() as $row)
                                    <li class="header-cart-item">
                                        <div class="header-cart-item-img">
                                            <img src="{{asset('images/cardimages/').'/'.$row->options->img}}" alt="IMG">
                                        </div>

                                        <div class="header-cart-item-txt">
                                            <a href="#" class="header-cart-item-name">
                                                {{$row->name}}
                                            </a>

                                            <span class="header-cart-item-info">
                                    {{number_format($row->price, 2, ',', '.')}}
                                </span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="header-cart-total">
                                Total: R$ {{number_format(Cart::subtotal(), 2, ',', '.')}}
                            </div>

                            <div class="header-cart-buttons">
                                <div class="header-cart-wrapbtn">
                                    <!-- Button -->
                                    <a href="{{url('/carrinho')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        Ver Carrinho
                                    </a>
                                </div>

                                <div class="header-cart-wrapbtn">
                                    <!-- Button -->
                                    <a href="{{url('/pagamento')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        Pagamento
                                    </a>
                                </div>
                            </div>
                        @else
                            <div>
                                Ops! Você não tem cartões adicionados, de uma olhada na nossa loja :)
                            </div>
                            <hr>
                            <div class="header-cart-buttons">
                                <div class="header-cart-wrapbtn">
                                    <!-- Button -->
                                    <a href="{{url('/listarcartoes/cards')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        Ver Cartões
                                    </a>
                                </div>

                            </div>
                        @endif

                    </div>
                </div>
            </div>

            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
            </div>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div class="wrap-side-menu" >
        <nav class="side-menu">
            <ul class="main-menu">

                <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
                    <div class="topbar-child2-mobile">
							<span class="topbar-email">
								pgd@gideoes.org.br
							</span>
                    </div>
                </li>

                <li class="item-topbar-mobile p-l-10">
                    <div class="topbar-social-mobile">
                        <a href="https://www.facebook.com/osgideoesinternacionaisnobrasil" class="topbar-social-item fa fa-facebook"></a>
                    </div>
                </li>

                <li class="item-menu-mobile">
                    <a href="{{url('')}}">Home</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="{{url('/listarcartoes/cards')}}">Envie Cartões</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="{{url('/sobre')}}">Sobre</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="{{url('/contato')}}">Contato</a>
                </li>
            </ul>
        </nav>
    </div>


</header>



@yield('content')


<!-- Footer -->
<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
    <div class="flex-w p-b-90">
        <div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
            <h4 class="s-text12 p-b-30">
                ENTRE EM CONTATO
            </h4>

            <div>
                <p class="s-text7 w-size27">
                    Ligue através do número (19) 3744-3700
                </p>

                <div class="flex-m p-t-30">
                    <a href="https://www.facebook.com/osgideoesinternacionaisnobrasil" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
                </div>
            </div>
        </div>

        <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
            <h4 class="s-text12 p-b-30">
                Cartões
            </h4>

            <ul>
                <li class="p-b-9">
                    <a href="{{url('/listarcartoes/cat2')}}" class="s-text7">
                        Lembrando de Você
                    </a>
                </li>

                <li class="p-b-9">
                    <a href="{{url('/listarcartoes/cat3')}}" class="s-text7">
                        Gratidão a Deus
                    </a>
                </li>

                <li class="p-b-9">
                    <a href="{{url('/listarcartoes/cat7')}}" class="s-text7">
                        Nascimento
                    </a>
                </li>

                <li class="p-b-9">
                    <a href="{{url('/listarcartoes/cat13')}}" class="s-text7">
                        Relacionamentos
                    </a>
                </li>
            </ul>
        </div>

        <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
            <h4 class="s-text12 p-b-30">
                Links
            </h4>

            <ul>
                <li class="p-b-9">
                    <a href="http://www.gideoes.org.br/" class="s-text7">
                        Portal Gideões
                    </a>
                </li>

                <li class="p-b-9">
                    <a href="https://online.gideoes.org.br/sitenew/public/login" class="s-text7">
                        Área de Membros
                    </a>
                </li>

                <li class="p-b-9">
                    <a href="{{route('sitecontato')}}" class="s-text7">
                        Contato
                    </a>
                </li>


            </ul>
        </div>

        <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">

        </div>



        <div class="w-size8 p-t-30 p-l-15 p-r-15 respon3">
            <h4 class="s-text12 p-b-30">
                Notícias sobre o Envie Cartões
            </h4>

            <form id="newsletter">
                {{csrf_field()}}
                <div class="effect1 w-size9">
                    <input class="s-text7 bg6 w-full p-b-5" type="text" name="news" id="news" placeholder="email@examplo.com">
                    <span class="effect1-line"></span>
                </div>

                <div class="w-size2 p-t-20">
                    <!-- Button -->
                    <button type="submit" class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
                        Inscreva-se
                    </button>
                </div>

            </form>
        </div>
    </div>

    <div class="t-center p-l-5 p-r-15">


            <img class="h-size2" src="{{asset('assets/images/icons/visa.png')}}" alt="IMG-VISA">

            <img class="h-size2" src="{{asset('assets/images/icons/mastercard.png')}}" alt="IMG-MASTERCARD">

            <img class="h-size2" src="{{asset('assets/images/icons/express.png')}}" alt="IMG-EXPRESS">


        <div class="t-center s-text8 p-t-20">
            Copyright © 2018 Todos os diretos reservados à Os Gideões Internacionais no Brasil & (Henrique Mauricio de Albuquerque). | Este template foi criado com <i class="fa fa-heart-o" aria-hidden="true"></i> <a href="https://colorlib.com" target="_blank">Colorlib</a>
        </div>
    </div>
</footer>



<!-- Back to top -->
<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
</div>

<!-- Container Selection1 -->
<div id="dropDownSelect1"></div>


<!--===============================================================================================-->
<script type="text/javascript" src="{{asset('assets/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="{{asset('assets/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="{{asset('assets/vendor/bootstrap/js/popper.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="{{asset('assets/vendor/select2/select2.min.js')}}"></script>

<script type="text/javascript">
    $(".selection-1").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });
</script>
<!--===============================================================================================-->
<script type="text/javascript" src="{{asset('assets/vendor/slick/slick.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/slick-custom.js')}}"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="{{asset('assets/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="{{asset('assets/vendor/lightbox2/js/lightbox.min.js')}}"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="{{asset('assets/vendor/sweetalert/sweetalert.min.js')}}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>

<script type="text/javascript">
    $('#newsletter').validate({
        rules: {
            news: {required: true, email: true}
        },
        messages: {
            news: { required: 'Digite um email', email: 'Digite um email válido' }

        },
        submitHandler: function( form ){
            var data = $( form ).serialize();

            $.ajax({
                url: "{{url('/newsletter_subscribe')}}",
                data: data,
                method: "POST"
            }).done(function(data) {

                swal({
                    title: "Obrigado!",
                    text: "Você receberá um email com a confirmação de recebimento",
                    icon: "success"
                });

               $('#news').val(null);


            }).fail(function() {
                var texto = 'Houve um problema ao enviar seu contato, tente novamente.';
                swal({
                    title: ":/",
                    text: texto,
                    icon: "error"
                });
            });

            return false;
        }
    });

    /*  $('.block2-btn-addcart').each(function(){
          var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
          $(this).on('click', function(){
              swal(nameProduct, "is added to cart !", "success");
          });
      });

      $('.block2-btn-addwishlist').each(function(){
          var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
          $(this).on('click', function(){
              swal(nameProduct, "is added to wishlist !", "success");
          });
      });*/
</script>

<!--===============================================================================================-->
<script type="text/javascript" src="{{asset('assets/vendor/parallax100/parallax100.js')}}"></script>
<script type="text/javascript">
    $('.parallax100').parallax100();
</script>
<!--===============================================================================================-->
<script src="{{asset('assets/js/main.js')}}"></script>

@yield('post-script')

</body>
</html>
