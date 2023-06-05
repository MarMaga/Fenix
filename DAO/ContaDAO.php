<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class ContaDAO extends Conexao
{

    public function CadastrarConta($banco, $agencia, $operacao, $conta, $saldo)
    {

        if (trim($banco) == '' || trim($agencia) == '' || trim($conta) == '' || trim($saldo) == '') {
            return 0;
        }

        # se não é CAIXA, Operação deve ser nula
        if (trim(substr($banco, 0, 3)) != '104') {
            $operacao = '';
        }

        # consulta o id do banco para salvar na conta
        $conexao = parent::retornarConexao();

        $comando_sql = "select id_banco
                        from tb_banco
                        where nome_banco = '" . $banco . "';";

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->execute();

        $id_banco = $sql->fetch();
        //echo $id_banco[0]; OU
        //$ret = $sql->fetchAll();
        //echo $ret[0][0];

        // verifica a existência da conta em tb_conta
        $comando_sql = 'select count(numero_conta) as conta
                          from tb_conta
                         where id_banco = ?
                           and agencia_conta = ?
                           and numero_conta = ?
                           and id_usuario = ?';

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $id_banco['id_banco']);
        $sql->bindValue(2, $agencia);
        $sql->bindValue(3, $conta);
        $sql->bindValue(4, UtilDAO::CodigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        $existe = $sql->fetchAll();

        if ($existe[0]['conta'] > 0){
            return -9;
        }
        
        # com todos os dados prontos, insere no BD
        $comando_sql = "insert into tb_conta
                        (id_banco, agencia_conta, operacao_conta, numero_conta, saldo_conta, id_usuario)
                        values (?, ?, ?, ?, ?, ?);";

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $id_banco['id_banco']);
        $sql->bindValue(2, $agencia);
        $sql->bindValue(3, $operacao);
        $sql->bindValue(4, $conta);
        $sql->bindValue(5, $saldo);
        $sql->bindValue(6, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function AlterarConta($id, $banco, $agencia, $operacao, $conta)
    {
        if (trim($id) == '' || trim($banco) == '' || trim($agencia) == '' || trim($conta) == '') {
            return 0;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = 'select id_banco
                          from tb_banco
                         where nome_banco = ?';

        $sqlBanco = new PDOStatement();
        $sqlBanco = $conexao->prepare($comando_sql);
        $sqlBanco->bindValue(1, $banco);
        $sqlBanco->setFetchMode(PDO::FETCH_ASSOC);
        $sqlBanco->execute();
        $id_banco = $sqlBanco->fetch();

        $comando_sql = 'update tb_conta
                           set id_banco = ?,
                               agencia_conta = ?,
                               operacao_conta = ?,
                               numero_conta = ?
                         where id_conta = ?
                           and id_usuario = ?';

        if (substr($banco, 0, 3) != '104') {
            $operacao = '';
        }

        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $id_banco['id_banco']);
        $sql->bindValue(2, $agencia);
        $sql->bindValue(3, $operacao);
        $sql->bindValue(4, $conta);
        $sql->bindValue(5, $id);
        $sql->bindValue(6, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ExcluirConta($id)
    {
        if ($id == '') {
            return 0;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = 'delete from tb_conta
                              where id_conta = ?
                                and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $id);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -4;
        }
    }

    public function ConsultarConta()
    {
        $conexao = parent::retornarConexao();
        $comando_sql = 'select id_conta,
                               nome_banco,
                               agencia_conta,
                               operacao_conta,
                               numero_conta,
                               saldo_conta
                          from tb_conta
                    inner join tb_banco
                            on tb_conta.id_banco = tb_banco.id_banco
                         where id_usuario = ?
                      order by nome_banco ASC;';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, UtilDAO::CodigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function CarregarConta($id)
    {
        if ($id == '') {
            return 0;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = 'select id_conta,
                               nome_banco,
                               agencia_conta,
                               operacao_conta,
                               numero_conta,
                               saldo_conta
                          from tb_conta
                    inner join tb_banco
                            on tb_conta.id_banco = tb_banco.id_banco
                         where id_conta = ?
                           and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $id);
        $sql->bindValue(2, UtilDAO::CodigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }
}

?>