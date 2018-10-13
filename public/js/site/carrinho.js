function removeProduct(rowid, nome)
{
    var id = rowid;
    var url = url_rm + '/' +rowid;

    swal("Deseja retirar o produto " + nome + " do carrinho ?", {
        buttons: {
            cancel: "Cancelar",
            catch: {
                text: "Sim!",
                value: id,
            },
        },
    }).then((value) => {
        if (!value) throw null;

    return fetch(url);

}).then(results => {

    return results.json();

}).then(pass => {
    if(pass.pass == 'true')
    {
        swal({
            title: "Item Removido",
            text: "Você será redirecinado em instantes ...",
            icon: "success",
        });

        setTimeout(
            function(){ window.location.href = cart; },
            2000)
    }

else
    {
        console.log(pass.pass);
    }

}).catch(err => {
    if (err) {
        swal("Ocorreu um erro ao tentar remover o item do carrinho, tente novamente", "error");
    } else {
        swal.stopLoading();
    swal.close();
}
});

}
