<!-- Product -->
<div class="conteudo-produto">

    <div class="row">
        @forelse($cartao as $cart)
            <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
                <!-- Block2 -->
                <div class="block2">
                    <div class="block2-img wrap-pic-w of-hidden pos-relative">
                        <img src="{{asset('images/cardimages') .'/'. $cart->image}}" alt="IMG-PRODUCT">

                        <div class="block2-overlay trans-0-4">

                            <div class="block2-btn-addcart w-size1 trans-0-4">
                                <!-- Button -->
                                <a href="{{url('/cartao-detalhe') . "/$cart->id"}}">
                                    <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                        Mais Detalhes
                                    </button>
                                </a>

                            </div>
                        </div>
                    </div>

                    <div class="block2-txt p-t-20">
                        <a href="{{url('/cartao-detalhe') . "/$cart->id"}}" class="block2-name dis-block s-text3 p-b-5">
                            {{$cart->codigo}}
                        </a>

                        <span class="block2-price p-r-5">
                            {{$cart->nome}}
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <span>
                 Ops! Não conseguimos encontrar cartões, tente novamente.
            </span>

        @endforelse
    </div>


</div>

<!-- Pagination -->
<div class="pagination flex-m flex-w p-t-26">
    @include('center.products.pagination', ['paginator' => $cartao])
</div>