function ValidarCadastro() {

    var nome = $("#nome").val().trim();
    var email = $("#email").val().trim();
    var senha = $("#senha").val().trim();
    var rsenha = $("#rsenha").val().trim();

    if (nome == '' || email == '' || senha == '' || rsenha == '') {
        alert("Preencher todos os campos!");

        if (nome == '') {
            $("#nome").focus();
        } else if (email == '') {
            $("#email").focus();
        } else if (senha == '') {
            $("#senha").focus();
        } else if (rsenha == '') {
            $("#rsenha").focus();
        }
        return false;
    }
    
    if (nome.length < 3) {
        alert("O nome deve ter no mínimo 3 letras!");
        return false;
    }

    if (!email.includes("@") || email.slice(-1) == "@"){
        alert("E-mail inválido!");
        return false;
    }

    if (senha.length < 6){
        alert("A senha deve ter no mínimo 6 dígitos!");
        $("#senha").focus();
        return false;
    }

    if (senha != rsenha){
        alert("As senhas não são iguais!");
        $("#rsenha").focus();
        return false;
    }
}

function ValidarMeusDados() {

    var nome = document.getElementById("nome").value.trim();
    var email = $("#email").val().trim();

    if (nome.length < 3){
        $("#divNome").removeClass("has-success").addClass("has-error");
        alert("O nome deve ter no mínimo 3 letras!");
        $("#nome").focus();
        return false;
    } else {
        $("#divNome").removeClass("has-error").addClass("has-success");
    }

    if (email.length < 3 || !email.includes("@") || email.slice(-1) == "@"){
        $("#divEmail").removeClass("has-success").addClass("has-error");
        alert("E-mail inválido!");
        $("#email").focus();
        return false;
    }
    
    var erroAnt = false;
    var mensagem = "";

    mensagem = NotificarCampo(email, "#divEmail", mensagem, "\n -E-mail");

    if (mensagem != '' && !erroAnt) $("#email").focus();

    if (mensagem !== '') {
        alert("Preencher corretamente o(s) campo(s):" + mensagem);
        return false;
    }

    var h_nome = $("#h_nome").val().trim();
    var h_email = $("#h_email").val().trim();

    if (h_nome == nome && h_email == email) {
        alert("Nenhum dado foi alterado!")
        $("#nome").focus();
        return false;
    }
}

function ValidarCategoria() {

    if ($("#nome").val().trim() == '') {
        alert("Preencher o campo NOME DA CATEGORIA");
        $("#divNome").removeClass("has-success").addClass("has-error");
        $("#nome").focus();
        return false;
    } else {
        var h_nome = $("#h_nome").val().trim();
        var nome = $("#nome").val().trim();

        if (h_nome == nome) {
            alert("A categoria não foi alterada!");
            $("#nome").focus();
            return false;
        } else {
            $("#divNome").removeClass("has-error").addClass("has-success");
        }
    }
}

function ValidarEmpresa() {

    var nome = $("#nome").val().trim();
    var endereco = $("#endereco").val().trim();
    var telefone = $("#telefone").val().trim();

    var erroAnt = false;
    var mensagem = '';

    mensagem = NotificarCampo(nome, "#divNome", mensagem, "\n -Nome");

    if (mensagem != '') {
        $("#nome").focus();
        erroAnt = true;
    }

    mensagem = NotificarCampo(endereco, "#divEndereco", mensagem, "\n -Endereço");

    if (mensagem != '' && !erroAnt) {
        $("#endereco").focus();
        erroAnt = true;
    }

    mensagem = NotificarCampo(telefone, "#divTelefone", mensagem, "\n -Telefone");

    if (mensagem != '' && !erroAnt) {
        $("#telefone").focus();
        erroAnt = true;
    }

    if (mensagem !== '') {
        alert("Preencher corretamente o(s) campo(s):" + mensagem);
        return false;
    }

    var h_nome = $("#h_nome").val().trim();
    var h_endereco = $("#h_endereco").val().trim();
    var h_telefone = $("#h_telefone").val().trim();

    if (h_nome == nome && h_endereco == endereco && h_telefone == telefone) {
        alert("Nenhum campo foi alterado!");
        $("#nome").focus();
        return false;
    }
}

function ValidarConta() {

    var banco = $("#banco").val().trim();
    var agencia = $("#agencia").val().trim();
    // Operação é tratada em ContaDAO->CadastrarConta()
    var conta = $("#conta").val().trim();
    var saldo = $("#saldo").val().trim();

    var erroAnt = false;
    var mensagem = '';

    mensagem = NotificarCampo(banco, "#divBanco", mensagem, "\n -Banco");

    if (mensagem != '') {
        $("#banco").focus();
        erroAnt = true;
    }

    mensagem = NotificarCampo(agencia, "#divAgencia", mensagem, "\n -Agência");

    if (mensagem != '' && !erroAnt) {
        $("#agencia").focus();
        erroAnt = true;
    }

    mensagem = NotificarCampo(conta, "#divConta", mensagem, "\n -Conta");

    if (mensagem != '' && !erroAnt) {
        $("#conta").focus();
        erroAnt = true;
    }

    mensagem = NotificarCampo(saldo, "#divSaldo", mensagem, "\n -Saldo");

    if (mensagem != '' && !erroAnt) {
        $("#saldo").focus();
    }

    if (mensagem !== '') {
        alert("Preencher corretamente o(s) campo(s):" + mensagem);
        return false;
    }
}

function ValidarAlteracaoConta() {

    var banco = $("#banco").val().trim();
    var agencia = $("#agencia").val().trim();
    // operacao é somente comparada com o que está armazenado no BD
    // na verificação de existência de alteração de algum campo
    // para enviar UPDATE somente se algum campo tiver sido alterado
    var operacao = $("#operacao").val().trim();
    var conta = $("#conta").val().trim();

    var erroAnt = false;
    var mensagem = '';

    mensagem = NotificarCampo(banco, "#divBanco", mensagem, "\n -Banco");

    if (mensagem != '') {
        $("#banco").focus();
        erroAnt = true;
    }

    mensagem = NotificarCampo(agencia, "#divAgencia", mensagem, "\n -Agência");

    if (mensagem != '' && !erroAnt) {
        $("#agencia").focus();
        erroAnt = true;
    }

    mensagem = NotificarCampo(conta, "#divConta", mensagem, "\n -Conta");

    if (mensagem != '' && !erroAnt) {
        $("#conta").focus();
        erroAnt = true;
    }

    if (mensagem !== '') {
        alert("Preencher corretamente o(s) campo(s):" + mensagem);
        return false;
    }

    var h_banco = $("#h_banco").val().trim();
    var h_agencia = $("#h_agencia").val().trim();
    var h_operacao = $("#h_operacao").val().trim();
    var h_conta = $("#h_conta").val().trim();

    numBanco = banco.trim().substr(0, 3);
    if (numBanco != '104') {
        operacao = '';
    }

    if (h_banco == banco && h_agencia == agencia && h_operacao == operacao && h_conta == conta) {
        alert("Nenhum campo foi alterado!");
        $("#banco").focus();
        return false;
    }

}

function ValidarBanco() {

    $("#msg").hide();

    var nome = $("#nome").val().trim();
    var mensagem = '';

    mensagem = NotificarCampo(nome, "#divNome", mensagem, "\n -Banco");

    if (mensagem != '') {
        alert("Preencher corretamente o campo:" + mensagem);
        $("#nome").focus();
        return false;
    }

    nome = TrataNomeBanco(nome);

    if (nome == 0) {
        alert("Preencher corretamente o campo:\n -Banco");
        $("#nome").focus();
        return false;
    }

    var h_nome = $("#h_nome").val().trim();

    if (h_nome == nome) {
        alert("Nenhum campo foi alterado!");
        $("#nome").focus();
        return false;
    }
}

function NotificarCampo(campo, div, mensagem, novoCampo) {

    if (campo.trim() == '') {
        $(div).removeClass("has-success").addClass("has-error");
        mensagem += novoCampo;
    } else {
        $(div).removeClass("has-error").addClass("has-success");
    }

    return mensagem;
}

function TrataNomeBanco(nome) {
    var numBanco = '';
    var localTraco = 0;

    numBanco = nome.trim().substr(0, 3);

    // verifica os 3 primeiros dígitos de nome a partir da esquerda
    // a procura de espaços porque isNaN aceita espaço como se fosse número
    // então, se houver espaço, retorna 0
    for (let i = 0; i <= 2; i++) {
        if (nome.substr(i, 1) == ' ') {
            return 0;
        }
    }

    // se isNaN é falso, é um número
    // se é verdadeiro, não é um número
    if (isNaN(numBanco)) {
        return 0;
    }

    // verifica cada letra de nome a partir da esquerda
    for (let i = 0; i <= nome.length - 1; i++) {
        // se encontrar o traço
        if (nome.substr(i, 1) == '-') {
            // armazena ele em traco
            localTraco = i;
            break;
        }
    }
    var restanteNome = '';

    // se localTraco = 0, não encontrou o traço em nome e deve retornar 0
    if (localTraco == 0) {
        // armazena o nome do banco a partir da quarta letra (posição 3)
        restanteNome = nome.trim().substr(3, nome.length);
    } else {
        // armazena o nome do banco (após o traço)
        restanteNome = nome.trim().substr(localTraco + 1, nome.length);
    }

    // se o restante do nome tiver menos de 2 dígitos, retorna 0 (deve ter pelo menos 2)
    if (restanteNome.length < 2)
        return 0;

        // se chegou aqui,
    // os 3 primeiros dígitos são numéricos (número do banco)
    // o traço foi encontrado
    // o nome do banco (restante após o traço) tem mais de 1 dígito
    // então, corrige o nome do banco para "999 - NOME"
    nome = numBanco + ' - ' + restanteNome.trim();

    return nome;
}

function ShowHideOperacao() {
    var banco = $("#banco :selected").text()
    var numBanco = '';

    numBanco = banco.trim().substr(0, 3);

    switch (numBanco) {
        case '':
            return false;
        case '104':
            $("#divOperacao").show();
            break;
        default:
            $("#divOperacao").hide();
            break;
    }
}

function HideOperacao() {
    if ($("#banco").val().trim().substr(0, 3) != "104") {
        $("#divOperacao").hide();
    }
}

function FiltrarBanco() {
    var banco = $("#pesqBanco").val()

    if (banco == '') {
        $("#pesqBanco").focus();
        return false;
    }
}

function LimparFiltroBanco() {
    var lblBanco = $("#lblBanco").text()

    if (lblBanco.trim().length == 39) {
        $("#banco").focus();
        return false;
    }
}

function LimparFiltroBancoConsulta() {
    var lblFiltro = $("#filtro").text()

    if (lblFiltro.trim().length == 0) {
        $("#pesqBanco").focus();
        return false;
    }
}

function ValidarConsultaMovimento() {

    var dataInicial = $("#datainicial").val();
    var dataFinal = $("#datafinal").val();

    if (dataInicial == '' || dataFinal == '') {
        if ($("#datafinal").val() == '') {
            $("#datafinal").focus()
        }
        if ($("#datainicial").val() == '') {
            $("#datainicial").focus()
        }
        return false;
    }
}

function HojeInicial() {

    document.getElementById('datainicial').value = Hoje();

    $("#datafinal").focus();

    return false;
}

function HojeFinal() {
    document.getElementById('datafinal').value = Hoje();

    if ($("#datainicial").val() == '') {
        $("#datainicial").focus();
    } else {
        $("#btn_pesquisar").focus();
    }

    return false;
}

function Hoje() {
    var hoje = new Date();
    var dd = String(hoje.getDate()).padStart(2, '0');
    var mm = String(hoje.getMonth() + 1).padStart(2, '0'); //Janeiro é 0!
    var aaaa = hoje.getFullYear();

    hoje = aaaa + '-' + mm + '-' + dd;
    return hoje;
}