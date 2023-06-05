<?php

require_once 'DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once 'DAO/BancoDAO.php';

$dao = new BancoDAO();

if (isset($_POST['btn_filtrar'])) {

    $filtro = $_POST['pesqBanco'];
    $bancos = $dao->FiltrarBanco($filtro);

    $bancos = $dao->FiltrarBanco($filtro);

    if (count($bancos) == 0) {

        $ret = "FILTRO ZERADO";
        $bancos = $dao->ConsultarBanco();
    
    } else {
        $filtrado = "[----- FILTRO ATIVADO -----]";
    }

} else {
    $bancos = $dao->ConsultarBanco();
    $filtrado = "";
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

        <div style="position: sticky; top: 60px; width: 100%; z-index: 1">
            <!-- Título da página -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav" style="width: 100%">
                    <li class="nav-item" style="width: 100%">
                        <div class="row mb-2">
                            <div class="col-sm-6" style="padding-left: 20px; padding-top: 7px">
                                <h1>CADASTRO DE BANCOS</h1>
                                <h3 class="card-title">Cadastre os bancos nesta página</h3>
                            </div>
                            <div class="col-sm-6" style="padding-top: 5px; padding-right: 80px">
                                <button class="btn bg-gradient-primary btn-lg fa fa-star"
                                    style="width: 120px; margin: 5px"><br>Novo</button>
                                <button class="btn bg-gradient-primary btn-lg fa fa-save"
                                    style="width: 120px; margin: 5px"><br>Salvar</button>
                                <button class="btn bg-gradient-primary btn-lg fa fa-trash-alt"
                                    style="width: 120px; margin: 5px"><br>Excluir</button>
                                <button class="btn bg-gradient-primary btn-lg far fa-check-circle"
                                    style="width: 120px; margin: 5px"><br>Carregar</button>
                                <button class="btn bg-gradient-primary btn-lg far fa-window-close"
                                    style="width: 120px; margin: 5px"><br>Sair</button>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="padding-top: 17px">
            <!-- Main content -->
            <section class="content col-sm-12">

                <!-- Default box -->
                <div class="card">
                    <form action="cadastro_bancos.php" method="post">
                        <div class="card-body form-group">
                            <label>Nome do banco (com o código)</label>
                            <input type="text" class="form-control" placeholder="Exemplo: 001 - Banco do Brasil">
                            <br>
                            <div>
                                <button name="btn_salvar" class="btn btn-primary">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card">
                    <!-- <div class="card-header">
                        <h3 class="card-title">Pesquisar</h3>
                    </div> -->
                    <form action="cadastro_bancos.php" method="post">
                        <div class="card-body form-group">
                            <label>Filtro</label>
                            <input type="text" class="form-control"
                                placeholder="Digite o número ou o nome do banco ...">
                            <br>
                            <div>
                                <button name="btn_filtrar" class="btn btn-secondary"
                                    style="margin: 5px">Filtrar</button>
                                <button name="btn_limparfiltro" class="btn btn-secondary" style="margin: 5px">Limpar
                                    filtro</button>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Banco <label id="filtro" style="color: red">
                                            <?= isset($filtrado) ? $filtrado : '' ?>
                                        </label></th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bancos as $item) { ?>
                                    <tr class="odd gradeX">
                                        <td>
                                            <?= $item['nome_banco'] ?>
                                        </td>
                                        <td><a href="alterar_banco.php?cod=<?= $item['id_banco'] ?>"
                                                class="btn btn-warning btn-xs">Alterar</a></td>
                                    </tr>
                                <?php } ?>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php
    //include_once '_footer.php';
    ?>
    </div>
    <!-- ./wrapper -->
</body>

</html>

</html>