<?php

require_once 'DAO/Conexao.php';
require_once 'DAO/UtilDAO.php';

class MovimentoDAO extends Conexao
{

    public function RealizarMovimento($tipo, $data, $valor, $obs, $categoria, $empresa, $conta)
    {
        if ($tipo == '' || trim($data) == '' || trim($valor) == '' || trim($categoria) == '' || trim($empresa) == '' || trim($conta) == '') {
            return 0;
        }
        
        $conexao = parent::retornarConexao();
        
        // verifica se o movimento já existe em tb_movimento
        $comando_sql = 'select count(id_movimento) as movimento
                          from tb_movimento
                         where tipo_movimento = ?
                           and data_movimento = ?
                           and valor_movimento = ?
                           and id_categoria = ?
                           and id_empresa = ?
                           and id_conta = ?
                           and id_usuario = ?';
        
        $sql = new PDOStatement();
        
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $tipo);
        $sql->bindValue(2, $data);
        $sql->bindValue(3, $valor);
        $sql->bindValue(4, $categoria);
        $sql->bindValue(5, $empresa);
        $sql->bindValue(6, $conta);
        $sql->bindValue(7, UtilDAO::CodigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        $existe = $sql->fetchAll();

        if ($existe[0]['movimento'] > 0) {
            return -9;
        }

        $comando_sql = 'insert into tb_movimento
                                    (tipo_movimento,
                                    data_movimento,
                                    valor_movimento,
                                    obs_movimento,
                                    id_categoria,
                                    id_empresa,
                                    id_conta,
                                    id_usuario)
                                    values (?, ?, ?, ?, ?, ?, ?, ?)';

        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $tipo);
        $sql->bindValue(2, $data);
        $sql->bindValue(3, $valor);
        $sql->bindValue(4, $obs);
        $sql->bindValue(5, $categoria);
        $sql->bindValue(6, $empresa);
        $sql->bindValue(7, $conta);
        $sql->bindValue(8, UtilDAO::CodigoLogado());

        $conexao->beginTransaction();
        try {
            // inserção na tb_movimento
            $sql->execute();

            if ($tipo == 1) {

                $comando_sql = 'update tb_conta 
                                   set saldo_conta = saldo_conta + ?
                                 where id_conta = ?';
            } elseif ($tipo == 2) {
                $comando_sql = 'update tb_conta 
                                   set saldo_conta = saldo_conta - ?
                                 where id_conta = ?';
            }

            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $valor);
            $sql->bindValue(2, $conta);

            // atualização do saldo da conta
            $sql->execute();

            $conexao->commit();

            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $conexao->rollBack();
            return -1;
        }
    }

    public function FiltrarMovimento($tipo, $datainicial, $datafinal)
    {
        if ($tipo == '' || $datainicial == '' || $datafinal == '') {
            return 0;
        }

        $conexao = parent::retornarConexao();

        $comando_sql = 'select date_format(data_movimento, "%d/%m/%Y") as data_movimento,
                               id_movimento,
                               tipo_movimento,
                               nome_categoria,
                               nome_empresa,
                               tb_movimento.id_conta,
                               agencia_conta,
                               numero_conta,
                               valor_movimento,
                               obs_movimento,
                               nome_banco
                          from tb_movimento
                    inner join tb_categoria
                            on tb_categoria.id_categoria = tb_movimento.id_categoria
                    inner join tb_empresa
                            on tb_empresa.id_empresa = tb_movimento.id_empresa
                    inner join tb_conta
                            on tb_conta.id_conta = tb_movimento.id_conta
                    inner join tb_banco
                            on tb_banco.id_banco = tb_conta.id_banco
                         where tb_movimento.data_movimento between ? and ?
                           and tb_movimento.id_usuario = ?';

        if ($tipo != "0") {

            $comando_sql = $comando_sql . 'and tipo_movimento = ?';
        }

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $datainicial);
        $sql->bindValue(2, $datafinal);
        $sql->bindValue(3, UtilDAO::CodigoLogado());

        if ($tipo != "0") {
            $sql->bindValue(4, $tipo);
        }

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function MostrarUltimosMovimentos()
    {
        $conexao = parent::retornarConexao();

        $comando_sql = 'select date_format(data_movimento, "%d/%m/%Y") as data_movimento,
                               id_movimento,
                               tipo_movimento,
                               nome_categoria,
                               nome_empresa,
                               tb_movimento.id_conta,
                               agencia_conta,
                               numero_conta,
                               valor_movimento,
                               obs_movimento,
                               nome_banco
                          from tb_movimento
                    inner join tb_categoria
                            on tb_categoria.id_categoria = tb_movimento.id_categoria
                    inner join tb_empresa
                            on tb_empresa.id_empresa = tb_movimento.id_empresa
                    inner join tb_conta
                            on tb_conta.id_conta = tb_movimento.id_conta
                    inner join tb_banco
                            on tb_banco.id_banco = tb_conta.id_banco
                         where tb_movimento.id_usuario = ?
                      order by tb_movimento.id_movimento DESC limit 10';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function ExcluirMovimento($id, $tipo, $valor, $conta)
    {
        if ($id == '' || $tipo == '' || $valor == '' || $conta == '') {
            return 0;
        }

        $conexao = parent::retornarConexao();

        $comando_sql = 'delete from tb_movimento
                              where id_movimento = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $id);

        $conexao->beginTransaction();

        try {
            // excluisão do movimento
            $sql->execute();

            //consulta o saldo da conta
            $comando_sql = 'select saldo_conta
                              from tb_conta
                             where id_conta = ?';

            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $conta);
            $sql->execute();
            $saldo = $sql->fetch();

            if ($saldo['saldo_conta'] - $valor < 0) {
                // pergunta se o cliente confirma a exclusão mesmo deixando a conta negativa
                //echo 'A conta ficará negativa em ' . $saldo['saldo_conta'] - $valor . ' Confirma?';exit;
                // se não confirmar, deve cancelar a transação e voltar para a consulta
            }

            if ($tipo == 1) {

                $comando_sql = 'update tb_conta 
                                   set saldo_conta = saldo_conta - ?
                                 where id_conta = ?';
            } elseif ($tipo == 2) {
                $comando_sql = 'update tb_conta 
                                   set saldo_conta = saldo_conta + ?
                                 where id_conta = ?';
            }

            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $valor);
            $sql->bindValue(2, $conta);

            // atualização do saldo da conta
            $sql->execute();

            $conexao->commit();

            return 1;

        } catch (Exception $ex) {
            $ex->getMessage();
            $conexao->rollBack();
            return -4;
        }
    }

    public function Total($EouS)
    {
        $conexao = parent::retornarConexao();

        $comando_sql = 'select sum(valor_movimento) as total
                          from tb_movimento
                         where tipo_movimento = ?
                           and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        // $EouS 1 = ENTRADA; 2 = SAIDA
        $sql->bindValue(1, $EouS);
        $sql->bindValue(2, UtilDAO::CodigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }
}

?>