@extends('template')



@section('content')

    <!-- Title Page -->
    <section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url('{{asset('/images/header').'/'.$header->img}}')">
        <h2 class="l-text2 t-center">
            {{$header->texto1}}
        </h2>
        <p class="m-text13 t-center">
            {{$header->texto2}}
        </p>
    </section>


    <!-- Content page -->
    <section class="bgwhite p-t-55 p-b-65">
        <div class="container">
            <div class="row">


                <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">

                    <div class="leftbar p-r-20 p-r-0-sm">
                        <!--  -->
                        <form id="filtro">
                            <h4 class="m-text14 p-b-7">
                                Categorias
                            </h4>

                            <ul class="p-b-54">

                                <li class="p-t-4">
                                    <a href="0" class="s-text13 @if($catvar == 0) active1 @endif categoria">
                                        Todos
                                    </a>

                                </li>

                                @foreach($categoria as $cat)
                                    <li class="p-t-4">
                                        <a href="{{$cat->id}}" class="s-text13 @if($catvar == $cat->id) active1 @endif categoria">
                                            {{$cat->nome}}
                                        </a>
                                    </li>
                                @endforeach


                            </ul>

                            <div class="search-product pos-relative bo4 of-hidden">
                                <input class="s-text7 size6 p-l-23 p-r-50" type="text" name="search-product" id="search-product" placeholder="Pesquisar Cartões...">

                                <button type="button" id="search" class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
                                    <i class="fs-12 fa fa-search" aria-hidden="true"></i>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>


                <div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
                    <div class="conteudo">

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('post-script')
    <script>
        var url = "{{url('')}}";
    </script>
    <script src="{{asset('js/site/listarcartoes.js')}}"></script>
@endsection