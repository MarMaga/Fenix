<?php

require_once 'UtilDAO.php';
require_once 'Conexao.php';

class EmpresaDAO extends Conexao
{

    public function CadastrarEmpresa($nome, $endereco, $telefone)
    {

        if (trim($nome) == '') {
            return 0;
        }

        $conexao = parent::retornarConexao();

        $comando_sql = 'select count(nome_empresa) as nome
                          from tb_empresa
                         where nome_empresa = ?
                           and id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        $existe = $sql->fetchAll();

        if ($existe[0]['nome'] > 0){
            return -9;
        }

        $comando_sql = 'insert into tb_empresa
                        (nome_empresa, endereco_empresa, telefone_empresa, id_usuario)
                        values
                        (?, ?, ?, ?);';

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $endereco);
        $sql->bindValue(3, $telefone);
        $sql->bindValue(4, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function AlterarEmpresa($id, $nome, $endereco, $telefone)
    {
        if (trim($nome) == '' || $id == '') {
            return 0;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = 'update tb_empresa
                           set nome_empresa = ?,
                               endereco_empresa = ?,
                               telefone_empresa = ?
                         where id_empresa = ?
                           and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $endereco);
        $sql->bindValue(3, $telefone);
        $sql->bindValue(4, $id);
        $sql->bindValue(5, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ExcluirEmpresa($id)
    {
        if ($id == '') {
            return 0;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = 'delete
                          from tb_empresa
                         where id_empresa = ?
                           and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $id);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -4;
        }

    }

    public function ConsultarEmpresa()
    {
        $conexao = parent::retornarConexao();
        $comando_sql = 'select id_empresa,
                               nome_empresa,
                               endereco_empresa,
                               telefone_empresa
                          from tb_empresa
                         where id_usuario = ?
                      order by nome_empresa ASC';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, UtilDAO::CodigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();

    }

    public function DetalharEmpresa($idEmpresa)
    {
        $conexao = parent::retornarConexao();
        $comando_sql = 'select id_empresa,
                               nome_empresa,
                               endereco_empresa,
                               telefone_empresa
                          from tb_empresa
                         where id_empresa = ?
                           and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idEmpresa);
        $sql->bindValue(2, UtilDAO::CodigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

}
?>