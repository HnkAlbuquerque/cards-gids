<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', 'Site\SiteHomeController@index')->name('inicio');

/// ROTAS GALERIA DE CARTÕES
Route::get('/listarcartoes/{catvar}', 'Site\CartaoListaController@index')->name('listarcartoes');
Route::get('/listarprodutos', 'Site\CartaoListaController@produtosResults')->name('listarprodutos');
Route::get('/cartao-detalhe/{id}', 'Site\CartaoDetalheController@index')->name('cartaodetalhe');
///////////////////////////

//// ROTAS CARRINHO DE COMPRAS
Route::get('/carrinho', 'Site\CarrinhoController@index')->name('siteCarrinho');
Route::post('/adicionarcarrinho', 'Site\CarrinhoController@addCart')->name('adicionarcarrinho');
Route::get('/removerproduto/{rowId}', 'Site\CarrinhoController@removeProduct')->name('removerproducto');
///////////////////////////////

// ROTAS PAGAMENTO
Route::get('/pagamento', 'Site\PagamentoController@index')->name('sitePagamento');
Route::get('/consultacpf','Site\PagamentoController@consultaCpf');
Route::post('/gerarpedido','Site\PagamentoController@gerarPedido');
Route::get('/exibepedido/{key}','Site\PagamentoController@exibePedido')->name('exibepedido');
Route::get('/testerede', 'Site\PagamentoController@teste')->name('testesteste');
///////////////////////////////

//// ROTAS TELA CONTATO
Route::get('/contato', 'Site\SiteContatoController@index')->name('sitecontato');
Route::post('/formcontato', 'Site\SiteContatoController@formSave')->name('formSave');

////////////////////////

//// ROTAS TELA SOBRE
Route::get('/sobre', 'Site\SiteSobreController@index')->name('sitesobre');
////////////////////

Route::post('/newsletter_subscribe', 'Site\SiteContatoController@newsletterSave')->name('newsSave');
Route::get('/unsubscribe/{token}', 'Site\SiteContatoController@newsletterUnsubscribe')->name('newsUnsubscribe');

////////// ROTAS DE EMAIL
Route::get('/enviaemail', 'Site\EmailController@enviaTeste')->name('enviaemail');
Route::post('/automail/pedido', 'Automail\AutomailController@sendPedidoEmail')->name('automail_pedido');
Route::get('/automail/robot', 'Automail\AutomailController@autoMail');


Route::get('/automail/teste', 'Automail\AutomailController@teste');
/////////////////////////


Route::get('/login', 'Auth\LoginController@loginScreen')->name('login');
Route::post('/loginauth', 'Auth\LoginController@login');

Route::post('adm/logout', function ()
{
    Auth::logout();
    return redirect()->route('login');
});


Route::get('adm/getoptions/{link}','Admin\BannerController@getOptions')->name('getoptions');
Route::group(['middleware' => ['auth']], function () {

    Route::group(['prefix' => 'adm'], function () {


    Route::get('/home', 'Admin\HomeController@index')->name('home');

    /////// LAYOUT ROUTES
            /// BANNER ROUTES
            Route::get('/banner', 'Admin\BannerController@index')->name('banner');
            Route::post('/savebanner', 'Admin\BannerController@saveBanner')->name('savebanner');
            Route::get('/banner_status/{id}', 'Admin\BannerController@statusBanner')->name('banner_status');


            /// PARALLAX ROUTES
            Route::get('/parallax', 'Admin\ParallaxController@index')->name('parallax');
            Route::post('/saveparallax', 'Admin\ParallaxController@saveParallax')->name('saveparallax');
            Route::get('/parallax_status/{id}', 'Admin\ParallaxController@statusParallax')->name('parallax_status');

            /// HEADER - CARTÕES ROUTES
            Route::get('/header', 'Admin\HeaderController@index')->name('header');
            Route::post('/saveheader', 'Admin\HeaderController@saveHeader')->name('saveheader');
            Route::get('/header_status/{id}', 'Admin\HeaderController@statusHeader')->name('header_status');

            /// HEADER - CONTATO ROUTES
            Route::get('/contato', 'Admin\ContatoController@index')->name('contato');
            Route::post('/savecontato', 'Admin\ContatoController@saveContato')->name('savecontato');
            Route::get('/contato_status/{id}', 'Admin\ContatoController@statusContato')->name('contato_status');

            /// HEADER - SOBRE ROUTES
            Route::get('/sobre', 'Admin\SobreController@index')->name('sobre');
            Route::post('/savesobre', 'Admin\SobreController@saveSobre')->name('savesobre');
            Route::get('/sobre_status/{id}', 'Admin\SobreController@statusSobre')->name('sobre_status');

            /// HEADER - CARRINHO ROUTES
            Route::get('/carrinho', 'Admin\CarrinhoController@index')->name('carrinho');
            Route::post('/savecarrinho', 'Admin\CarrinhoController@saveCarrinho')->name('savecarrinho');
            Route::get('/carrinho_status/{id}', 'Admin\CarrinhoController@statusCarrinho')->name('carrinho_status');
    ///////////////

    //// ROTAS DE GERENCIAMENTO DE CARTÕES
            /// CATEGORIA ROUTES
            Route::get('/categoria', 'Admin\CategoriaController@index')->name('categoria');
            Route::post('/savecategoria', 'Admin\CategoriaController@saveCategoria')->name('savecategoria');
            Route::get('/categoria_status/{id}', 'Admin\CategoriaController@statusCategoria')->name('categoria_status');

            /// TESTEMUNHOS ROUTES
            Route::get('/testemunho', 'Admin\TestemunhoController@index')->name('testemunho');
            Route::post('/savetestemunho', 'Admin\TestemunhoController@saveTestemunho')->name('savetestemunho');
            Route::get('/testemunho_status/{id}', 'Admin\TestemunhoController@statusTestemunho')->name('testemunho_status');

            /// VERSICULO ROUTES
            Route::get('/versiculo', 'Admin\VersiculoController@index')->name('versiculo');
            Route::post('/saveversiculo', 'Admin\VersiculoController@saveVersiculo')->name('saveversiculo');
            Route::get('/versiculo_status/{id}', 'Admin\VersiculoController@statusVersiculo')->name('versiculo_status');

            /// CARTAO ROUTES
            Route::get('/cartao', 'Admin\CartaoController@index')->name('cartao');
            Route::post('/savecartao', 'Admin\CartaoController@saveCartao')->name('savecartao');
            Route::get('/cartao/edit', 'Admin\CartaoController@editCartao')->name('editcartao');
            Route::get('/cartao/edit_form/{id}', 'Admin\CartaoController@editCartaoForm')->name('editcartao_form');
            Route::post('/cartao/edit_save', 'Admin\CartaoController@editCartaoSave')->name('editcartaosave');
            Route::get('/cartao/delete_image/{id}', 'Admin\CartaoController@deleteImageCartao')->name('deleteimagecartao');
            Route::get('/cartao_status/{id}', 'Admin\CartaoController@statusCartao')->name('statuscartao');
    ///////////////////////

    /// ROTAS GERENCIAMENTO DE PEDIDOS
        Route::get('/pedidos','Admin\PedidoAdmController@index')->name('pedidoadm');
        Route::get('/pedidos/detalhe/{id}','Admin\PedidoAdmController@detalharPedido')->name('detalharpedido');
        Route::post('/editaritem','Admin\PedidoAdmController@editarItem')->name('editaritem');
        Route::post('/marcarenviadocorreio','Admin\PedidoAdmController@marcarEnvioCorreio')->name('enviadocorreio');
    ////////////

    //// NEWSLETTER E FORMULARIO DE CONTATOS
        Route::get('/contatosrecebidos','Admin\ContatoController@exibeContatos')->name('contatosrecebidos');
        Route::get('/inscritos','Admin\ContatoController@exibeEmailsNews')->name('inscritos');
        Route::get('/change_email_status/{id}','Admin\ContatoController@changeEmailStatus')->name('change_email_status');

    });
    ///////////////////////////////////////

});




