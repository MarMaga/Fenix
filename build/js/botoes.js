function VaiParaCima(){
    window.scrollTo(1,1);
    return false;
}

function btnNovoBanco(){
    $("#msg").hide();
    $("#idBanco").val('');
    $("#nome").val('');
    $("#h_nome").val('');
    $("#nome").focus();
    return false;
}

function AlterarBanco(nome, id) {
    $("#msg").hide();
    $("#nome").val(nome);
    $("#h_nome").val(nome);
    $("#idBanco").val(id);
    $("#nome").focus();
    return false;
  }