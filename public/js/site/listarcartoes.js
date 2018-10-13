function getProducts(page){
    var searchinput = "&search-product=" + $('#search-product').val();
    var data = $('#filtro').serialize();
    var categoria = $('.active1').attr('href');

    console.log(categoria);

    $.ajax({
        // substituir local host pela url de produção
        url: url + "/listarprodutos?page=" + page,
        data: data + "&categoria=" + categoria
    }).done(function(data){

        $('.conteudo').html(data);
        $('.conteudo-produto').addClass('animated fadeInRight slower');

    });

    $('.conteudo-produto').removeClass('animated fadeInRight slower');
}

$(document).ready(function () {
    getProducts(1);

    $('#search').click(function () {
        $('.categoria').removeClass('active1');
        getProducts(1);
    });

    $(document).on('click','.pagination a', function(e){
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        //alert(page);
        getProducts(page);
        // location.hash = page;
    });

    $(document).on('click','.categoria', function(e){
        e.preventDefault();

        var cat = $(this).attr('href');

        $('.categoria').removeClass('active1');
        $('#search-product').val('');
        $(this).addClass('active1');

        getProducts(1);

        // alert(cat);

    });

});