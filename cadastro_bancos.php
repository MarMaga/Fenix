<?php

if (isset($_POST['btn_salvar'])) {
    echo 'Botão clicado';
}
?>
<script>
    alert("Botão Salvar clicado");
</script>
<?php } ?>

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

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>CADASTRO DE BANCOS</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Cadastre os bancos nesta página</h3>
                    </div>
                    <form action="cadastro_bancos.php" method="post">
                        <div class="card-body form-group">
                            <label>Nome do banco (com o código)</label>
                            <input type="text" class="form-control" placeholder="Exemplo: 001 - Banco do Brasil"><br>
                            <div>
                                <button name="btn_salvar" class="btn btn-primary">Salvar</button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pesquisar</h3>
                    </div>

                    <form action="cadastro_bancos.php" method="post">
                        <div class="card-body form-group">
                            <label>Pesquisa</label>
                            <input type="text" class="form-control" placeholder="Digite o número ou o nome do banco ...">

                        </div>
                
                            
                                <center>
                                    <button name="btn_filtrar" type="button" class="btn btn-secondary">Filtrar</button> 
                                    <button name="btn_limparfiltro" type="button" class="btn btn-secondary">Limpar filtro</button>
                                </center>
                         

              
                    </form>


                    <!-- <div class="card-body">
                        <form action="remover_equipamento.php" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nome do banco (com o código. Exemplo: 001 - Banco do Brasil)</label>
                                        <select class="form-control select2 obg" style="width: 100%;" name="setor" id="setor" onchange="CarregarEquipamentosAlocadosSetor()">

                                        </select>
                                    </div>

                                </div>
                            </div>
                        </form> -->
                    <hr>
                    <div class="row" id="divResultado" style="display: none">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Lista de Equipamentos do Setor</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover" id="tableResult">

                                    </table>
                                </div>

                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
        </div>
        </section>
    </div>
    <?php
include_once '_footer.php';
?>
    </div>
    <!-- ./wrapper -->

</body>

</html>

</html>