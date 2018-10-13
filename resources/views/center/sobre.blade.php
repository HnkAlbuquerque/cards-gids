@extends('template')

@section('content')

    <!-- Title Page -->
    <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url('{{asset('/images/sobre').'/'. $sobre_header->img}}');">
        <h2 class="l-text2 t-center">
            Sobre
        </h2>
    </section>

    <!-- content page -->
    <section class="bgwhite p-t-66 p-b-38">
        <div class="container">
            <div class="row">
                <div class="col-md-4 p-b-30">
                    <div class="hov-img-zoom">
                        <img src="{{asset('assets/images/sobre_sitepgd.png')}}" alt="IMG-ABOUT">
                    </div>
                </div>

                <div class="col-md-8 p-b-30">
                    <h3 class="m-text26 p-t-15 p-b-16">
                        Nossa História
                    </h3>

                    <h4 class="m-text15 p-t-15 p-b-16">
                        Distribuir a Palavra de Deus ao redor do Mundo
                    </h4>
                    <p class="p-b-28">

                        Ao ter acesso à Palavra de Deus as pessoas podem conhecer as boas novas do evangelho e aceitar a salvação em Cristo. Estes novos cristãos podem, por sua vez, ao estudar as Escrituras, crescer espiritualmente e usá-las para compartilhar sua fé em Cristo com outras pessoas. Por esta razão, temos por objetivo distribuir Bíblias completas ou Novos Testamentos com Salmos e Provérbios. Estas Escrituras são impressas em 99 línguas e oferecidas direta e gratuitamente às pessoas ou colocadas em locais públicos selecionados, onde muitos que estão buscando respostas terão possibilidade de encontrar a Palavra de Deus.
                    </p>

                    <h4 class="m-text15 p-t-15 p-b-16">
                        Áreas de distribuição
                    </h4>
                    <p class="p-b-28">

                        As Escrituras são distribuídas uma a uma pelos membros de Os Gideões Internacionais a estes grupos: <br>
                        • Estudantes da 4a. Série (5º ano) e acima. <br>
                        • Presidiários e funcionários da polícia, bombeiros, área de saúde e militares. <br>
                        • A qualquer outra pessoa para quem os Gideões testemunhem individualmente.
                    </p>

                    <h4 class="m-text15 p-t-15 p-b-16">
                        As Escrituras são colocadas em diversos locais, incluindo:
                    </h4>
                    <p class="p-b-28">
                        • Hotéis <br>
                        • Hospitais, casas de repouso, asilos, consultórios médicos e odontológicos, escritórios de advocacia e abrigos para vítimas de violência doméstica. <br>
                        • Navios e Aviões
                    </p>

                    <div class="bo13 p-l-29 m-l-9 p-b-10">
                        <p class="p-b-11">
                            Assim será a palavra que sair da minha boca: ela não voltará para mim vazia, antes fará o que me apraz, e prosperará naquilo para que a enviei.
                        </p>

                        <span class="s-text7">
							- Isaías 55:11
						</span>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection