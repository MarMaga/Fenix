<?php

if (isset($_GET['ret']))
  $ret = $_GET['ret'];

if (isset($ret)) {

  switch ($ret) {
    case 0:
      echo '<div class="alert alert-warning" id="msg" style="margin-left: 260px; padding-left: 20px; margin: 10px; margin-left: 265px">
            Preencher o(s) campo(s) obrigatório(s)!
            </div>';
      break;
    case 1:
      echo '<div class="alert alert-success" id="msg" style="margin-left: 260px; padding-left: 20px; margin: 10px; margin-left: 265px">
            Ação realizada com sucesso!
            </div>';
      break;
    case -1:
      echo '<div class="alert alert-danger" id="msg" style="margin-left: 260px; padding-left: 20px; margin: 10px; margin-left: 265px">
            Ocorreu um erro na operação. Tente mais tarde!
            </div>';
      break;
    case -2:
      echo '<div class="alert alert-danger" id="msg" style="margin-left: 260px; padding-left: 20px; margin: 10px; margin-left: 265px">
            A senha deve conter no mínimo 6 caracteres!
            </div>';
      break;
    case -3:
      echo '<div class="alert alert-danger" id="msg" style="margin-left: 260px; padding-left: 20px; margin: 10px; margin-left: 265px">
            As duas senhas não conferem!
            </div>';
      break;
    case -4:
      echo '<div class="alert alert-danger" id="msg" style="margin-left: 260px; padding-left: 20px; margin: 10px; margin-left: 265px">
            O registro não pode ser excluído, pois está em uso!
            </div>';
      break;
    case -5:
      echo '<div class="alert alert-danger" id="msg" style="margin-left: 260px; padding-left: 20px; margin: 10px; margin-left: 265px">
            E-mail já cadastrado. Coloque outro e-mail!
            </div>';
      break;
    case -6:
      echo '<div class="alert alert-danger" id="msg" style="margin-left: 260px; padding-left: 20px; margin: 10px; margin-left: 265px">
            Usuário não encontrado!
            </div>';
      break;
    case -7:
      echo '<div class="alert alert-danger" id="msg" style="margin-left: 260px; padding-left: 20px; margin: 10px; margin-left: 265px">
            Senha inválida!
            </div>';
      break;
    case -8:
      echo '<div class="alert alert-danger" id="msg" style="margin-left: 260px; padding-left: 20px; margin: 10px; margin-left: 265px">
            A data final é anterior à data inicial!
            </div>';
      break;
    case -9:
      echo '<div class="alert alert-danger" id="msg" style="margin-left: 260px; padding-left: 20px; margin: 10px; margin-left: 265px">';
      echo 'Este registro já existe no cadastro! ';
      if ($_SERVER["REQUEST_URI"] == "/financeiro/nova_categoria.php") {
        echo '<a href="consultar_categoria.php" class="btn btn-success">Consultar</a>';
      } else if ($_SERVER["REQUEST_URI"] == "/financeiro/nova_empresa.php") {
        echo '<a href="consultar_empresa.php" class="btn btn-success">Consultar</a>';
      } else if ($_SERVER["REQUEST_URI"] == "/financeiro/novo_banco.php") {
        echo '<a href="consultar_banco.php" class="btn btn-success">Consultar</a>';
      } else if ($_SERVER["REQUEST_URI"] == "/financeiro/nova_conta.php") {
        echo '<a href="consultar_conta.php" class="btn btn-success">Consultar</a>';
      } else if ($_SERVER["REQUEST_URI"] == "/financeiro/realizar_movimento.php") {
        echo '<a href="consultar_movimento.php" class="btn btn-success">Consultar</a>';
      }
      echo '</div>';
      break;
    case -10:
      echo '<div class="alert alert-danger" id="msg" style="margin-left: 260px; padding-left: 20px; margin: 10px; margin-left: 265px">
              O nome do banco deve ter no mínimo 3 letras!
              </div>';
      break;
    case -11:
      echo '<div class="alert alert-danger" id="msg" style="margin-left: 260px; padding-left: 20px; margin: 10px; margin-left: 265px">
                Este número já está sendo usado em outro banco!
                </div>';
      break;
    case "CATEGORIA GRAVADA":
      echo '<div class="alert alert-success" id="msg" style="margin-left: 260px; padding-left: 20px; margin: 10px; margin-left: 265px">
            A categoria foi gravada com sucesso!
            </div>';
      break;
    case "BANCO GRAVADO":
      echo '<div class="alert alert-success" id="msg" style="margin-left: 260px; padding-left: 20px; margin: 10px; margin-left: 265px">
            O banco foi gravado com sucesso!
            </div>';
      break;
    case "FILTRO ZERADO":
      echo '<div class="alert alert-danger" id="msg" style="margin-left: 260px; padding-left: 20px; margin: 10px; margin-left: 265px">
            Este filtro retornou vazio!
            </div>';
      break;
  }

}

?>