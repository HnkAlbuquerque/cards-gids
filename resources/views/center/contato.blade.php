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
                    <form class="leave-comment" id="formContato">
                        {{ csrf_field() }}
                        <h4 class="m-text26 p-b-36 p-t-15">
                            Envie uma mensagem
                        </h4>

                        <div class="bo4 size15 m-b-25">
                            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="name" placeholder="Nome Completo">
                        </div>

                        <div class="bo4 size15 m-b-25">
                            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="fone" id="fone" placeholder="Telefone">
                        </div>

                        <div class="bo4 size15 m-b-25">
                            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="email" placeholder="Email">
                        </div>

                        <textarea class="dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20" name="mensagem" placeholder="mensagem" maxlength="400"></textarea>

                        <div class="w-size25">
                            <!-- Button -->
                            <button type="submit" class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4">
                                ENVIAR
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('post-script')


    <script>
        $('#fone').mask('(00) 00000-0000');

        $('#formContato').validate({
            rules: {
                name: { required: true, minlength: 5 },
                fone: { required: true, minlength: 12 },
                mensagem: { required: true },
                email: {required: true, email: true}

            },
            messages: {
                name: { required: 'Seu nome é necessário para enviar o formulário', minlength: 'Seu nome está muito curto' },
                fone: { required: 'Selecione uma data para envio do emial', minlength: 'Telefone inválido' },
                mensagem: { required: 'Escreva uma mensagem personalizada para o destinatário' },
                email: { required: 'Digite um email', email: 'Digite um email válido' }

            },
            submitHandler: function( form ){
                var data = $( form ).serialize();

                $.ajax({
                    url: "{{url('/formcontato')}}",
                    data: data,
                    method: "POST"
                }).done(function(data) {

                    swal({
                        title: "Obrigado!",
                        text: "Você receberá um email com a confirmação de recebimento",
                        icon: "success"
                    });

                    setTimeout(
                        function(){ window.location.href = '{{url('')}}'; },
                        4000)


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


    </script>

@endsection