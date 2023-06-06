function VaiParaCima(){
    window.scrollTo(1,1);
    return false;
}

function btnEditarBanco(){
    $("#nome").val('');
}

function btnNovoBanco(){
    $("#msg").hide();
    $("#idBanco").val('');
    $("#nome").val('');
    $("#nome").focus();
    return false;
}

