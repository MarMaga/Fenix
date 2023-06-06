<?php

require_once 'funcoes.php';
require_once 'DAO/UsuarioDAO.php';

$email = '';

if (isset($_POST['btnAcessar'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $objDAO = new UsuarioDAO();

    $ret = $objDAO->ValidarLogin($email, $senha);

    if ($ret == '') {
        ChamarPagina('inicial.php');
        exit;
    }
}

?>
<!DOCTYPE html>
<html>

<?php
include_once '_head.php';
require_once '_msg.php';
?>

<body class="hold-transition login-page">
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br />

                <?php include_once '_msg.php' ?>

                <h2> Controle Financeiro : ACESSO</h2>
                <h5>( Faça seu login )</h5>
                <br />
            </div>
        </div>
        <div class="login-box">
            <div class="login-logo">
                <a href="../../index2.html"><b>Fênix </b>Intranet</a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Faça seu login</p>

                    <form action="login.php" method="post">
                        <div class="input-group mb-3">
                            <input name="email" id="email" type="email" class="form-control" placeholder="E-mail">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input name="senha" id="senha" type="password" class="form-control" placeholder="Senha">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <center>
                            <button type="submit" name="btnAcessar" onclick="return ValidarLogin()"
                                class="btn btn-block bg-gradient-primary">Acessar</button>
                        </center>
                        <!-- /.col -->
                    </form>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->

</body>

</html>