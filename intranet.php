<!DOCTYPE html>
<html>

<?php
include_once '_head.php';
?>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
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
              <h1>Modelo</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Administrador</a></li>
                <li class="breadcrumb-item active">Gerenciar Modelo</li>
              </ol>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Aqui você gerencia os modelos</h3>


          </div>
          <div class="card-body">
            <form method="post" action="modelo.php">
              <div class="form-group">
                <label>Nome do modelo</label>
                <input class="form-control" name="nome" id="nome">

              </div>
              <button name="btnCadastrar" class="btn btn-success">Cadastrar</button>
            </form>
          </div>
          <!-- /.card-body -->

          <!-- /.card-footer-->
        </div>
        <!-- /.card -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Modelos cadastrados</h3>


              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover table">
                  <thead>
                    <tr>
                      <th>Ação</th>
                      <th>Modelo</th>

                    </tr>
                  </thead>
                  <tbody>

                    <tr>
                      <td>

                      </td>
                      <td></td>
                    </tr>

                  </tbody>
                </table>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </section>
      <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- ./wrapper -->

  <?php
  include_once '_footer.php';
  ?>

</body>

</html>