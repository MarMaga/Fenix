<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class BancoDAO extends Conexao
{

    public function CadastrarBanco($nome)
    {

        if (trim($nome) == '') {
            return 0;
        }

        $nome = $this->TrataNomeBanco($nome);

        if ($nome == 0) {
            return 0;
        }

        $conexao = Conexao::retornarConexao();

        $comando_sql = 'select count(nome_banco) as nome
                          from tb_banco
                          where nome_banco = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        $existe = $sql->fetchAll();

        if ($existe[0]['nome'] >0){
            return -9;
        }

        $comando_sql = "insert into tb_banco
                (nome_banco)
                values
                (?)";

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);

        try {
            $sql->execute();
            return "BANCO GRAVADO";
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }

    }

    private function TrataNomeBanco($nome)
    {

        $numBanco = trim(substr($nome, 0, 3));

        if (!is_numeric($numBanco))
            return 0;

        $localTraco = 0;

        # verifica cada letra de $nome a partir da esquerda
        for ($i = 0; $i <= strlen($nome); $i++) {
            # se encontrar o traço
            if (substr($nome, $i, 1) == '-') {
                # armazena ele em $traco
                $localTraco = $i;
                break;
            }
        }

        # se Traco estiver vazio, não encontrou o traço em $nome e deve retornar 0
        if ($localTraco == 0) {
            # armazena o nome do banco a partir da quarta letra (posição 3)
            $restanteNome = trim(substr($nome, 3, strlen($nome)));
        } else {
            # armazena o nome do banco (após o traço)
            $restanteNome = trim(substr($nome, $localTraco + 1, strlen($nome)));
        }

        # se o restante do nome tiver menos de 2 dígitos, retorna 0 (deve ter pelo menos 2)
        if (strlen($restanteNome) < 2)
            return 0;

        //$restanteNome = strtoupper($restanteNome);

        # se chegou aqui,
        # os 3 primeiros dígitos são numéricos (número do banco)
        # o traço foi encontrado
        # o nome do banco (restante após o traço) tem mais de 1 dígito
        # então, corrige o nome do banco para "999 - NOME"
        $nome = $numBanco . ' - ' . $restanteNome;

        return $nome;
    }

    public function AlterarBanco($nome, $id)
    {
        if (trim($nome) == '' || empty($id)) {
            return 0;
        }

        $nome = $this->TrataNomeBanco($nome);

        if ($nome == 0) {
            return 0;
        }
        
        $conexao = parent::retornarConexao();
        $comando_sql = 'update tb_banco
                           set nome_banco = ?
                         where id_banco = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $id);

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ExcluirBanco($id)
    {
        $conexao = parent::retornarConexao();
        $comando_sql = 'delete from tb_banco
                              where id_banco = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $id);

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            $ex->getMessage();
            return -4;
        }
    }

    public function CarregarBanco($cod)
    {
        $conexao = parent::retornarConexao();
        $comando_sql = 'select id_banco,
                               nome_banco
                          from tb_banco
                         where id_banco = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $cod);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function ConsultarBanco()
    {
        $conexao = parent::retornarConexao();
        $comando_sql = 'select id_banco,
                               nome_banco
                          from tb_banco
                      order by nome_banco';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function FiltrarBanco($filtro)
    {
        $conexao = parent::retornarConexao();
        $comando_sql = 'select id_banco,
                               nome_banco 
                          from tb_banco 
                         where nome_banco like ?
                      order by nome_banco';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, '%' . $filtro . '%');
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

}

?>