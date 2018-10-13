$('#fone').mask('(00) 00000-0000');
$('#cpf').mask('000.000.000-00');


$("#campo").select2();
$("#sexo").select2({
    minimumResultsForSearch: 20,
    dropdownParent: $('#dropDownSelect1')
});
$("#pagTipo").select2({
    minimumResultsForSearch: 20,
    dropdownParent: $('#dropDownSelect1')
});

$("#form").validate({
    rules: {
        nome: { required: true, minlength: 5 },
        cpf:  { required: true, minlength: 14},
        email:{ required: true, email: true},
        sexo: { required: true },
        pagTipo: { required: true },
        cc_nome:  { required: true, minlength: 5, maxlength: 20},
        cc_num: { required: true, minlength: 15 },
        cc_val: { required: true, minlength: 7},
        cc_ver: { required: true, minlength: 3}
    },
    messages: {
        nome: { required: 'Seu nome é necessário', minlength: 'Seu nome está muito curto' },
        cpf:  { required: 'Seu CPF é necessário', minlength: 'CPF preenchido de forma incorreta' },
        email:{ required: 'Seu Email é necessário', email: 'Informe um email válido' },
        sexo: { required: 'Informe o Sexo para prosseguir' },
        pagTipo: { required: 'Selecione o Tipo de Pagamento' },
        cc_nome:  { required: 'Digite o nome do cartão', minlength: 'Nome não corresponde ao do cartão',  maxlength: 'nome ultrapassa o limite de caracteres'},
        cc_num:  { required: 'Digite o número', minlength: 'Número incorreto' },
        cc_val:  { required: 'Digite a validade', minlength: 'preencha a validade no formato mm/aaaa' },
        cc_ver:  { required: 'Digite o código do verso', minlength: 'Verso possui o mínimo de 3 digitos' }

    }
});

$("#proximoPasso").click(function(){
    if ($('#form').valid() == true){

        $("#infoRemetente").fadeOut( 250, function() {
            $("#infoRemetente").hide();
            $("#infoPagamento").show();
            $("#infoPagamento").addClass('animated fadeInRight slower');

        });
    }
});

$("#gerar").click(function(){
    if ($('#form').valid() == true){
        $body = $("body");
        $body.addClass("loading");
        $('form').submit();
    }
});

$("#voltar").click(function(e){
    e.preventDefault();
    $("#infoPagamento").fadeOut( 250, function() {
        $("#infoPagamento").hide();
        $("#infoRemetente").show();
        $("#infoRemetente").addClass('animated fadeInRight slower');
    });
});

$("#cpf").blur(function () {
    $.ajax({
        method: "GET",
        url: varcpf,
        data: { cpf: $(this).val() }
    })
        .done(function( data ) {
            if(data)
            {
                $('#nome').val(data['as_nome']);
                $('#email').val(data['as_email']);
                $('#fone').val(data['as_fone_cel']);
                $('#campo').val(data['cmp_cod']).change();
                $('#sexo').val(data['as_tipo']).change();

                if($("#pagTipo option[value='B']").length > 0)
                {

                }
                else {
                    // verificar esse trecho para quando puder registrar boleto e exibir na hora
                    /*   $('#pagTipo').append($('<option>', {
                           value: 'B',
                           text: 'Boleto Bancário'
                       })); */
                }

            }

        });
});

$("#pagTipo").change(function () {

    switch($(this).val())
    {
        case 'C':

            $('#receive').empty();
            $('#receive').append("<h5 class=\"m-text19 p-b-24\">\n" +
                "                                        Informações do Cartão\n" +
                "                                    </h5>\n" +
                "                                    <div class='flex-m flex-w p-b-25'>\n" +
                "                                        <div class='s-text15 w-size15'>\n" +
                "                                            Nome no Cartão\n" +
                "                                        </div>\n" +
                "\n" +
                "                                        <div class='bo4 cartao-input-size'>\n" +
                "                                            <input class='sizefull s-text7 p-l-22 p-r-22' type='text' name='cc_nome' id='cc_nome' placeholder=''>\n" +
                "                                        </div>\n" +
                "                                    </div>\n" +
                "\n" +
                "                                    <div class='flex-m flex-w p-b-25'>\n" +
                "                                        <div class='s-text15 w-size15'>\n" +
                "                                            Número\n" +
                "                                        </div>\n" +
                "\n" +
                "                                        <div class='bo4 cartao-input-size'>\n" +
                "                                            <input class='sizefull s-text7 p-l-22 p-r-22' type='text' name='cc_num' id='cc_num' placeholder=''>\n" +
                "                                        </div>\n" +
                "                                    </div>\n" +
                "\n" +
                "                                    <div class='flex-m flex-w p-b-25'>\n" +
                "                                        <div class='s-text15 w-size15'>\n" +
                "                                            Validade\n" +
                "                                        </div>\n" +
                "\n" +
                "                                        <div class='bo4 cartao-input-size'>\n" +
                "                                            <input class='sizefull s-text7 p-l-22 p-r-22' type='text' name='cc_val' id='cc_val' placeholder='MM/AAAA'>\n" +
                "                                        </div>\n" +
                "                                    </div>\n" +
                "\n" +
                "                                    <div class='flex-m flex-w p-b-25'>\n" +
                "                                        <div class='s-text15 w-size15'>\n" +
                "                                            Verso\n" +
                "                                        </div>\n" +
                "\n" +
                "                                        <div class='bo4 cartao-input-size'>\n" +
                "                                            <input class='sizefull s-text7 p-l-22 p-r-22' type='password' name='cc_ver' id='cc_ver' placeholder=''>\n" +
                "                                        </div>\n" +
                "                                    </div>\n");


            $('#cc_num').mask('0000 0000 0000 0000');
            $('#cc_val').mask('00/0000');
            $('#cc_ver').mask('0000');


            $('#receive').show();
            $('#receive').addClass('animated fadeInRight slower')
                .one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimatonend animationend', function () {
                        $('#receive').removeClass('animated fadeInRight slower');
                    }
                );

            break;

        case 'B':

            $('#receive').fadeOut(250, function () {
                $('#receive').empty();
            });

            break;

        default:
            $('#receive').fadeOut(250, function () {
                $('#receive').empty();
            });
            break;
    }

});