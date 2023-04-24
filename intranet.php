<<<<<<< HEAD
=======
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
                            <h1>TITULO </h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Remova os equipamentos nessa página</h3>
                    </div>
                    <div class="card-body">
                        <form action="remover_equipamento.php" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Escolha o setor</label>
                                        <select class="form-control select2 obg" style="width: 100%;" name="setor" id="setor" onchange="CarregarEquipamentosAlocadosSetor()">
                                          
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </form>
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
>>>>>>> 43a2fb0dcb87415f3a8cb1a4586299701c702ed3
