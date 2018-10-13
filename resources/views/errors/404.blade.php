@extends('template')

@section('content')



    <!-- content page -->
    <section class="bgwhite p-t-66 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-12 p-b-20" align="center">
                    <h1>ERRO 404</h1>
                    <br>
                    <h3>Não foi possível encontrar a página que você está tentando acessar.</h3>
                </div>
                <div class="col-md-12 p-b-30" align="center">
                    <img src="{{asset('assets/images/waifu.jpg')}}" alt="Waifu 404" width="720">
                </div>
            </div>
        </div>
    </section>


@endsection
