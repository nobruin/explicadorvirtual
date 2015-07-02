
var baseUrl = location.origin + "/" == "http://localhost:8080/" ? "http://localhost:8080/explicadorvirtual/" : location.origin + "/";
var urlPura = location.hostname + "/";


function aumentarDiv() {
    if ($('#divErro').is(':visible')) {

        $('#divPainel').height($('#divPainel').height() + $('#divErro').height());
    }
}

function logout()
{
    if (confirm('Tem certeza que deseja sair?'))
    {
        location.href = baseUrl + 'login/logout';
    }
}

function sendPost(url, data, cb, cbError)
{
    if (cbError == null || cbError == undefined)
        cbError = function () {
            alert('Ocorreu um erro inesperado. Tente novamente mais tarde.');
        };
    $.ajax({
        type: "POST",
        url: url,
        dataType: "text",
        data: data,
        success: function (data)
        {
            cb(data);
        },
        error: function ()
        {
            cbError();
        }
    });
}

function voltar(url) {
    location.href = url;
}

function fazerLogin() {

    var login = $('#login').val();
    var senha = $('#senha').val();

    sendPost(baseUrl+'login', {login: login, senha: senha}, function (data) {
        if (data == 1) {
            window.location.href = baseUrl + 'administracao';
        } else
            alert(data);
    });

}
function genericModal(url, params, cbConfirm, cbCancel) {
    sendPost(url, params, function (data) {
        $('#genericModal').html(data).dialog({
            resizable: false,
            modal: true,
            height: "600",
            width: 1000,
            buttons: {
                "Confirmar": function (data){
                    cbConfirm(data);
                },
                "Não responder": function (){
                    cbCancel();
                }
            }
        });
    });

}