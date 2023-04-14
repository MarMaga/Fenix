function ValidarPrimeiroTitulo() {

    var ok = true;
    if ($("#primeiro").val() == "") {
        ok = false;
        $("#validarPrimeiro").show();
    } else {
        $("#validarPrimeiro").hide();
    }
    if ($("#segundo").val() == "") {
        ok = false;
        $("#validarSegundo").show();
    } else {
        $("#validarSegundo").hide();
    }
    if ($("#subtitulo").val() == "") {
        ok = false;
        $("#validarSubtitulo").show();
    } else {
        $("#validarSubtitulo").hide();
    }
    return ok;
}
function ValidarCampo() {

    var ok = true;
    if ($("#campo").val() == "") {
        ok = false;
        $("#validarCampo").show();
    } else {
        $("#validarCampo").hide();
    }
    return ok;
}
function ValidarSobreIgreja() {

    var ok = true
    if ($("#sobre").val() == "") {
        ok = false;
        $("#validarSobre").show();
    } else {
        $("#validarSobre").hide();
    }
    if ($("#descricao").val() == "") {
        ok = false;
        $("#validarDescricao").show();
    } else {
        $("#validarDescricao").hide();
    }
    return ok;
}
function ValidarEventos() {

    var ok = true
    if ($("#evento").val() == "") {
        ok = false;
        $("#validarEvento").show();
    } else {
        $("#validarEvento").hide();
    }
    if ($("#nome").val() == "") {
        ok = false;
        $("#validarNome").show();
    } else {
        $("#validarNome").hide();
    }
    if ($("#desc").val() == "") {
        ok = false;
        $("#validarDesc").show();
    } else {
        $("#validarDesc").hide();
    }
    if ($("#dataEvento").val() == "") {
        ok = false;
        $("#validarDataEvento").show();
    } else {
        $("#validarDataEvento").hide();
    }
    return ok;
}