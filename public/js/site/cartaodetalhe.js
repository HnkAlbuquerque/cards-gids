$(document).on('focus','#date', function () {
    $('input[name="date"]').daterangepicker({
        singleDatePicker: true,
        startDate: moment(),
        minDate: moment(),
        "locale": {
            "format": "DD/MM/YYYY",
            "separator": " - ",
            "applyLabel": "OK",
            "cancelLabel": "Voltar",
            "daysOfWeek": [
                "Dom",
                "Seg",
                "Ter",
                "Qua",
                "Qui",
                "Sex",
                "Sab"
            ],
            "monthNames": [
                "Janeiro",
                "Fevereiro",
                "Março",
                "Abril",
                "Maio",
                "Junho",
                "Julho",
                "Agosto",
                "Setembro",
                "Outubro",
                "Novembro",
                "Dezembro"
            ]
        }
    });
});

function calcLabelMenos()
{
    var valor;
    valor = (parseFloat($('#num-product').val(),10))-1;
    if (valor >= 4)
    {
        valor = valor * val;
        //    console.log(valor);
        $('.m-text-custom').html('R$ ' + valor.toFixed(2))
    }
    else
    {
        $('#num-product').val(5);
        valor = 4 * 2.80;
        $('.m-text-custom').html('R$ ' + valor.toFixed(2))
    }

}

function calcLabelMais()
{
    var valor;
    valor = (parseFloat($('#num-product').val(),10))+1;
    valor = valor * val;
    //     console.log(valor);

    $('.m-text-custom').html('R$ ' + valor.toFixed(2))

}

function calcLabel()
{
    var valor;
    valor = (parseFloat($('#num-product').val(),10))

    if (valor >= 4)
    {
        valor = valor * val;
        //     console.log(valor);
        $('.m-text-custom').html('R$ ' + valor.toFixed(2))
    }
    else
    {
        $('#num-product').val(4);
        valor = 4 * val;
        $('.m-text-custom').html('R$ ' + valor.toFixed(2))
    }

}

calcLabel();

$(document).on('blur', '#cep', function () {
    $.getJSON( "https://viacep.com.br/ws/" + $(this).val() +"/json/", function(dados) {
        if(!("erro" in dados)){
            $("#endereco").val(dados.logradouro);
            $("#bairro").val(dados.bairro);
            $("#cidade").val(dados.localidade);
            $("#estado").val(dados.uf);
        }

        else{
            alert("CEP não encontrado.");
        }
    });

});

$(".selection-2").select2({
    minimumResultsForSearch: 20,
    dropdownParent: $('#dropDownSelect1')
});

$("#personalizar").click(function(){
    $(".conteudo-form").fadeOut( 250, function() {
        hide('conteudo-form');
        $(".conteudo-form-custom").show();
        $(".conteudo-form-custom").addClass('animated fadeInRight slower');

    });
});

$("#voltar").click(function(e){
    e.preventDefault();
    $(".conteudo-form-custom").fadeOut( 250, function() {
        hide('conteudo-form-custom');
        $(".conteudo-form").show();
        $(".conteudo-form").addClass('animated fadeInRight slower');
    });
});

$("#tipo").change(function () {

    switch($(this).val())
    {
        case 'CO':

            $('#receiveTipo').empty();
            $('#receiveTipo').append("<div class='p-b-20'>\n" +
                "                                Informações do Destinatário\n" +
                "                            </div>\n" +
                "\n" +
                "                            <div class='flex-m flex-w p-b-25'>\n" +
                "                                <div class='s-text15 w-size15 t-center'>\n" +
                "                                    CEP\n" +
                "                                </div>\n" +
                "\n" +
                "                                <div class='bo4 cartao-input-size'>\n" +
                "                                    <input class='sizefull s-text7 p-l-22 p-r-22' type='text' name='cep' id='cep' placeholder='CEP'>\n" +
                "                                </div>\n" +
                "                            </div>\n" +
                "\n" +
                "                            <div class='flex-m flex-w p-b-25'>\n" +
                "                                <div class='s-text15 w-size15 t-center'>\n" +
                "                                    Endereço\n" +
                "                                </div>\n" +
                "\n" +
                "                                <div class='bo4 cartao-input-size'>\n" +
                "                                    <input class='sizefull s-text7 p-l-22 p-r-22' type='text' name='endereco' id='endereco' placeholder='Rua + Número'>\n" +
                "                                </div>\n" +
                "                            </div>\n" +
                "\n" +
                "                            <div class='flex-m flex-w p-b-25'>\n" +
                "                                <div class='s-text15 w-size15 t-center'>\n" +
                "                                    Complemento\n" +
                "                                </div>\n" +
                "\n" +
                "                                <div class='bo4 cartao-input-size'>\n" +
                "                                    <input class='sizefull s-text7 p-l-22 p-r-22' type='text' name='compl' placeholder='Complemento'>\n" +
                "                                </div>\n" +
                "                            </div>\n" +
                "\n" +
                "                            <div class='flex-m flex-w p-b-25'>\n" +
                "                                <div class='s-text15 w-size15 t-center'>\n" +
                "                                    Bairro\n" +
                "                                </div>\n" +
                "\n" +
                "                                <div class='bo4 cartao-input-size'>\n" +
                "                                    <input class='sizefull s-text7 p-l-22 p-r-22' type='text' name='bairro' id='bairro'  placeholder='Bairro'>\n" +
                "                                </div>\n" +
                "                            </div>\n" +
                "\n" +
                "                            <div class='flex-m flex-w p-b-25'>\n" +
                "                                <div class='s-text15 w-size15 t-center'>\n" +
                "                                    Cidade\n" +
                "                                </div>\n" +
                "\n" +
                "                                <div class='bo4 cartao-input-size'>\n" +
                "                                    <input class='sizefull s-text7 p-l-22 p-r-22' type='text' name='cidade' id='cidade' data-autocomplete-city placeholder='Cidade'>\n" +
                "                                </div>\n" +
                "                            </div>\n" +
                "\n" +
                "                            <div class='flex-m flex-w p-b-25'>\n" +
                "                                <div class='s-text15 w-size15 t-center'>\n" +
                "                                    Estado\n" +
                "                                </div>\n" +
                "\n" +
                "                                <div class='rs2-select2 rs3-select2 bo4 of-hidden w-size16'>\n" +
                "                                    <select class='selection-2' name='estado' id='estado'>\n" +
                "                                        <option value=''>Selecione um Estado</option>\n" +
                "                                        <option value='AC'>Acre</option>\n" +
                "                                        <option value='AL'>Alagoas</option>\n" +
                "                                        <option value='AP'>Amapá</option>\n" +
                "                                        <option value='AM'>Amazonas</option>\n" +
                "                                        <option value='BA'>Bahia</option>\n" +
                "                                        <option value='CE'>Ceará</option>\n" +
                "                                        <option value='DF'>Distrito Federal</option>\n" +
                "                                        <option value='ES'>Espírito Santo</option>\n" +
                "                                        <option value='GO'>Goiás</option>\n" +
                "                                        <option value='MA'>Maranhão</option>\n" +
                "                                        <option value='MT'>Mato Grosso</option>\n" +
                "                                        <option value='MS'>Mato Grosso do Sul</option>\n" +
                "                                        <option value='MG'>Minas Gerais</option>\n" +
                "                                        <option value='PA'>Pará</option>\n" +
                "                                        <option value='PB'>Paraíba</option>\n" +
                "                                        <option value='PR'>Paraná</option>\n" +
                "                                        <option value='PE'>Pernambuco</option>\n" +
                "                                        <option value='PI'>Piauí</option>\n" +
                "                                        <option value='RJ'>Rio de Janeiro</option>\n" +
                "                                        <option value='RN'>Rio Grande do Norte</option>\n" +
                "                                        <option value='RS'>Rio Grande do Sul</option>\n" +
                "                                        <option value='RO'>Rondônia</option>\n" +
                "                                        <option value='RR'>Roraima</option>\n" +
                "                                        <option value='SC'>Santa Catarina</option>\n" +
                "                                        <option value='SP'>São Paulo</option>\n" +
                "                                        <option value='SE'>Sergipe</option>\n" +
                "                                        <option value='TO'>Tocantins</option>\n" +
                "                                    </select>\n" +
                "                                </div>\n" +
                "                            </div>");


            $("#estado").select2({
                minimumResultsForSearch: 20,
                dropdownParent: $('#dropDownSelect1')
            });

            $('#receiveTipo').show();
            $('#receiveTipo').addClass('animated fadeInRight slower')
                .one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimatonend animationend', function () {
                        $('#receiveTipo').removeClass('animated fadeInRight slower');
                    }
                );

            break;

        case 'EM':

            $('#receiveTipo').empty();
            $('#receiveTipo').append("<div class='flex-m flex-w p-b-25'>\n" +
                "                                <div class='s-text15 w-size15 t-center'>\n" +
                "                                    E-mail do Destinatário\n" +
                "                                </div>\n" +
                "\n" +
                "                                <div class='bo4 cartao-input-size'>\n" +
                "                                    <input class='sizefull s-text7 p-l-22 p-r-22' type='email' name='dest_email' placeholder=''>\n" +
                "                                </div>\n" +
                "                            </div>" +
                "                            <div class='flex-m flex-w p-b-25'>\n" +
                "                                <div class='s-text15 w-size15 t-center'>\n" +
                "                                    Data de envio\n" +
                "                                </div>\n" +
                "\n" +
                "                                <div class='bo4 cartao-input-size'>\n" +
                "                                    <input class='sizefull s-text7 p-l-22 p-r-22' type='text' name='date' id='date' maxlength='10'>\n" +
                "                                </div>\n" +
                "                            </div>\n");


            $('#receiveTipo').show();
            $('#receiveTipo').addClass('animated fadeInRight slower')
                .one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimatonend animationend', function () {
                        $('#receiveTipo').removeClass('animated fadeInRight slower');
                    }
                );

            break;

        default:
            $('#receiveTipo').fadeOut(250, function () {
                $('#receiveTipo').empty();
            });
            break;
    }

});

function hide(classe)
{
    $("." + classe).hide();
}

//// USA VARIAVEIS DE BLADE
$('#addCartao').validate({
    rules: {
        tipo: { required: true },
        nome_dest: { required: true, minlength: 3, maxlength: 30 },
        date: { required: true },
        mensagem: { required: true, minlength: 2 },
        dest_email: {required: true, email: true},
        estado: { required: true }
    },
    messages: {
        tipo: { required: 'Selecione um tipo de envio para este cartão' },
        nome_dest: { required: 'Escreva o nome do destinatário', minlength: 'Nome muito curto', maxlength: 'Nome ultrapassa 30 caracteres' },
        date: { required: 'Selecione uma data para envio do emial' },
        mensagem: { required: 'Escreva uma mensagem personalizada para o destinatário' },
        dest_email: { required: 'Digite um email', email: 'Digite um email válido' },
        estado: { required: 'Selecione um tipo de envio para este cartão' }

    },
    submitHandler: function( form ){

        var data = $( form ).serialize();

        $.ajax({
            url: urladd,
            data: data + "&name="+ cod +"&id="+ cardid +"&img=" + img,
            method: "POST"
        }).done(function(data) {

            //  console.log(data);
            var texto = 'O item ' + cod + ' foi adicionado ao carrinho!';
            swal({
                title: "Obrigado!",
                text: texto,
                icon: "success"
            });

            setTimeout(
                function(){ window.location.href = cart; },
                2000)


        }).fail(function() {
            var texto = 'Houve um problema ao adicionar o item ' + cod  + ', tente novamente.';
            swal({
                title: ":/",
                text: texto,
                icon: "error"
            });
        });

        return false;
    }
});
//////////////////////////