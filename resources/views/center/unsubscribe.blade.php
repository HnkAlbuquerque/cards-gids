@extends('template')

@section('content')

    <!-- Title Page -->
    <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url('{{asset('/images/contato').'/'. $contato_header->img}}');">
        <h2 class="l-text2 t-center">
            CONTATO
        </h2>
    </section>

    <!-- content page -->
    <section class="bgwhite p-t-66 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 p-b-30">
                    Você não receberá nossos emails em {{$email}}.
                    <br>
                    <br>
                    Obrigado.
                </div>
            </div>
        </div>
    </section>


@endsection
