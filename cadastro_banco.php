<?php

require_once 'DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once 'DAO/BancoDAO.php';

$banco = '';

$dao = new BancoDAO();

if (isset($_POST['btnFiltrar'])) {

    $filtro = $_POST['filtroBanco'];
    $bancos = $dao->FiltrarBanco($filtro);

    $bancos = $dao->FiltrarBanco($filtro);

    if (count($bancos) == 0) {

        $ret = "FILTRO ZERADO";
        $bancos = $dao->ConsultarBanco();

    } else {
        $filtrado = "[----- FILTRO ATIVADO -----]";
    }

} else {

    if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

        $cod = $_GET['cod'];

        //if (!ValidaCodigo($cod)) {
        //    ChamarPagina('cadastro_banco.php');
        //    exit;
        //} else {
        $banco = $dao->CarregarBanco($cod);
        if (count($banco) == 0) {
            ChamarPagina('cadastro_banco.php');
            exit;
        }
        //}

    } else if (isset($_POST['btnExcluir'])) {

        $idBanco = $_POST['idBancoExcluir'];

        $ret = $dao->ExcluirBanco($idBanco);

    } else if (isset($_POST['btnSalvar'])) {

        $idBanco = $_POST['idBanco'];
        $nome = $_POST['nome'];

        $objDAO = new BancoDAO();

        if ($idBanco == '') {
            $ret = $objDAO->CadastrarBanco($nome);
        } else {
            $ret = $objDAO->AlterarBanco($nome, $idBanco);
        }

    }

    $bancos = $dao->ConsultarBanco();
    $filtrado = '';
}

?>

<!DOCTYPE html>
<html>

<?php
include_once '_head.php';
?>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <?php
        include_once '_topo.php';
        include_once '_menu.php';
        ?>

        <form action="cadastro_banco.php" method="post">
            <div style="position: sticky; top: 57px; width: 100%; z-index: 1">
                <!-- Título da página -->
                <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                    <ul class="navbar-nav" style="width: 100%">
                        <li class="nav-item" style="width: 100%">
                            <div class="row mb-2">
                                <div class="col-sm-12" style="padding-left: 20px; padding-top: 7px">
                                    <h3 style="color: #007bff">CADASTRO DE BANCOS</h3>
                                    <h3 class="card-title">Inclua, altere e exclua os bancos nesta página</h3>
                                </div>
                                <hr>
                                <div class="col-sm-12" style="padding-top: 10px; padding-left: 20px">
                                    <button name="btnNovo" title=" Limpar a tela para incluir um novo banco"
                                        onclick="return btnNovoBanco()"
                                        class="btn bg-gradient-primary btn-sm fa fa-star"
                                        style="width: 55px; margin: 2px"></button>
                                    <button name="btnSalvar" title="Salvar o banco" onclick="return ValidarBanco()"
                                        class="btn bg-gradient-primary btn-sm fa fa-save"
                                        style="width: 55px; margin: 2px"></button>
                                    <!--<button name="btnExcluir" title="Excluir"
                                        class="btn bg-gradient-primary btn-sm fa fa-trash-alt"
                                        style="width: 55px; margin: 2px"></button>
                                        <button name="btnCarregar"
                                        class="btn bg-gradient-primary btn-sm far fa-check-circle"
                                        style="width: 75px; margin: 2px"><br>Carregar</button>
                                        <button name="btnSair" class="btn bg-gradient-primary btn-sm far fa-window-close"
                                        style="width: 75px; margin: 2px"><br>Sair</button>-->
                                    <button title="Volta para o início da página" onclick="return VaiParaCima()"
                                        class="btn btn-lg fa fa-arrow-alt-circle-up"></button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>

            <?php require_once '_msg.php' ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" style="padding-top: 15px">
                <!-- Main content -->
                <section class="content col-sm-12">

                    <!-- Default box -->
                    <div class="card">
                        <div class="card-body form-group">
                            <input name="idBanco" id="idBanco" type="hidden"
                                value="<?= isset($banco[0]['id_banco']) ? $banco[0]['id_banco'] : '' ?>" />
                            <a><b>Número e nome do banco</b> (com o código)</a>
                            <input name="nome" id="nome" class="form-control"
                                placeholder="Exemplo: 001 - Banco do Brasil"
                                value="<?= isset($banco[0]['nome_banco']) ? $banco[0]['nome_banco'] : '' ?>">
                        </div>
                    </div>
                    <div class="card">
                        <!-- <div class="card-header">
                            <h3 class="card-title">Pesquisar</h3>
                            </div> -->
                        <form action="cadastro_banco.php" method="post">
                            <div class="card col-sm-12">
                                <div class="card-body form-group">
                                    <a><b>Filtro</b></a><br>
                                    <input name="filtroBanco" id="filtroBanco" class="form-control"
                                        style="width: 415px; display: inline-block"
                                        placeholder="Digite o número ou o nome do banco ...">
                                    <button name="btnFiltrar" class="btn btn-secondary btn-sm"
                                        onclick="return FiltrarBanco()">Filtrar</button>
                                    <button name="btnLimparfiltro" class="btn btn-secondary btn-sm"
                                        onclick="return LimparFiltroBanco()">Limpar</button>
                                    <br>
                                    <br>
                                    <table class="table table-striped table-bordered table-hover"
                                        id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Banco <label id="lblBanco" style="color: red">
                                                        <?= isset($filtrado) ? $filtrado : '' ?>
                                                    </label></th>
                                                <th style="width: 100px; text-align: center">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for ($i = 0; $i < count($bancos); $i++) { ?>
                                                <tr class="odd gradeX">
                                                    <td style="vertical-align: middle">
                                                        <a>
                                                            <?= $bancos[$i]['nome_banco'] ?>
                                                        </a>
                                                    </td>
                                                    <td style="text-align: center; vertical-align: middle">
                                                        <a href="cadastro_banco.php?cod=<?= $bancos[$i]['id_banco'] ?>"
                                                            title="Alterar" style="width: 33px"
                                                            class="btn btn-warning btn-sm fa fa-edit"></a>
                                                        <a href="" title="Excluir" style="width: 33px"
                                                            class="btn btn-danger btn-sm fa fa-trash-alt"
                                                            data-toggle="modal" data-target="#modalExcluir<?= $i ?>"></a>
                                                        <form action="cadastro_banco.php" method="post">
                                                            <input name="idBancoExcluir" type="hidden"
                                                                value="<?= $bancos[$i]['id_banco'] ?>" />
                                                            <div class="modal fade" id="modalExcluir<?= $i ?>" tabindex="-1"
                                                                role="dialog" aria-labelledby="myModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal"
                                                                                aria-hidden="true">&times;</button>
                                                                            <h4 class="modal-title" id="myModalLabel">
                                                                                Confirmação de
                                                                                exclusão</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Deseja excluir o banco:
                                                                            <b>
                                                                                <?= $bancos[$i]['nome_banco'] ?>
                                                                            </b>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default"
                                                                                data-dismiss="modal">Cancelar</button>
                                                                            <button type="submit" class="btn btn-primary"
                                                                                name="btnExcluir">Sim</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                        </form>
                    </div>
            </div>
    </div>
    </section>
    </div>
    </form>
    </div>
    <?php
    include_once '_footer.php';
    ?>
    </div>
    <!-- ./wrapper -->
</body>

</html>