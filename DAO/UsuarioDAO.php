<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';
require_once 'funcoes.php';

class UsuarioDAO extends Conexao
{
    public function CarregarMeusDados()
    {
        $conexao = parent::retornarConexao();

        $comando_sql = "select nome_usuario,
                               email_usuario
                          from tb_usuario
                         where id_usuario = ?";

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, UtilDAO::CodigoLogado());

        # remove os index de dentro do array, permanecendo somente as colunas do BD
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function GravarMeusDados($nome, $email)
    {
        if (trim($nome) == '' || trim($email) == '') {
            return 0;
        }

        if ($this->VerificarEmailDuplicadoCadastro($email) > 0) {
            return -5;
        }

        $conexao = parent::retornarConexao();

        $comando_sql = 'update tb_usuario
                        set nome_usuario = ?,
                        email_usuario = ?
                        where id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $email);
        $sql->bindValue(3, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            $ex->getMessage();
            return -1;
        }
    }

    public function ValidarLogin($email, $senha)
    {

        if (trim($email) == '' || trim($senha) == '') {
            return 0;
        }

        $email = trim($email);
        $senha = trim($senha);

        $conexao = parent::retornarConexao();

        $comando_sql = 'select id_usuario,
                               nome_usuario
                          from tb_usuario
                         where email_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $email);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        $usuario = $sql->fetchAll();

        if (count($usuario) == 0) {
            return -6;
        }

        $cod = $usuario[0]['id_usuario'];
        $nome = $usuario[0]['nome_usuario'];
        UtilDAO::CriarSessao($cod, $nome);

        $comando_sql = 'select count(senha_usuario) as senha
                          from tb_usuario
                         where email_usuario = ?
                           and senha_usuario = ?';

        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $email);
        $sql->bindValue(2, $senha);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        $senhaCorreta = $sql->fetchAll();

        if ($senhaCorreta[0]['senha'] == 0) {
            return -7;
        }

        ChamarPagina('inicial.php');
        exit;
    }

    public function CriarCadastro($nome, $email, $senha, $rsenha)
    {

        if (trim($nome) == '' || trim($email) == '' || trim($senha) == '' || trim($rsenha) == '') {
            return 0;
        }

        if (strlen(trim($senha)) < 6) {
            return -2;
        }

        if (trim($senha) != trim($rsenha)) {
            return -3;
        }

        if ($this->VerificarEmailDuplicadoCadastro($email) > 0) {
            return -5;
        }

        $conexao = parent::retornarConexao();

        $comando_sql = 'insert into tb_usuario
                                    (nome_usuario,
                                    email_usuario,
                                    senha_usuario,
                                    data_cadastro)
                             values (?,?,?,?)';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $email);
        $sql->bindValue(3, $senha);
        $sql->bindValue(4, date('Y-m-d'));

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function VerificarEmailDuplicadoCadastro($email)
    {

        if (trim($email) == '') {
            return 0;
        }

        $conexao = parent::retornarConexao();

        // verificação de existência do email no cadastro
        // porque o email deve estar em apenas um registro
        $comando_sql = 'select count(email_usuario) as contar
                          from tb_usuario
                         where email_usuario = ?';

        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $email);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $contar = $sql->fetchAll();

        return $contar[0]['contar'];
    }
}
?>