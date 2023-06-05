<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class CategoriaDAO extends Conexao
{
    public function CadastrarCategoria($nome)
    {
        if (trim($nome) == '') {
            return 0;
        }

        // 1º passo: criar uma variável que receberá o obj de conexão
        $conexao = parent::retornarConexao();

        // 2º passo: criar uma variável que receberá o texto do comando SQL que deverá ser executado no BD
        // verifica a existência do registro no BD
        $comando_sql = 'select count(nome_categoria) as nome
                          from tb_categoria
                         where nome_categoria = ?
                           and id_usuario =?';

        // 3º passo: criar um obj que será configurado e levado no BD para ser executado
        $sql = new PDOStatement();

        // 4º passo: colocar dentro do obj $sql a conexão preparada para executar o comando_sql
        $sql = $conexao->prepare($comando_sql);

        // 5º passo: verificar se no comando_sql eu tenho ? para ser configurado
        // Se tiver, configurar os bindValues
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, UtilDAO::CodigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        $existe = $sql->fetchAll();

        if ($existe[0]['nome'] > 0){
            return -9;
        }

        $comando_sql = 'insert into tb_categoria 
                        (nome_categoria, id_usuario)
                        values (?, ?);';

        
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        try {
            // 6º passo: executar no BD
            $sql->execute();
            return "CATEGORIA GRAVADA";
        } catch (Exception $ex) {
            //echo $ex->getMessage();
            return -1;
        }
    }

    public function ConsultarCategoria()
    {
        $conexao = parent::retornarConexao();

        $comando_sql = 'select id_categoria,
                               nome_categoria
                          from tb_categoria
                         where id_usuario = ?
                      order by nome_categoria ASC;';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function CarregarCategoria($cod)
    {
        $conexao = parent::retornarConexao();

        $comando_sql = 'select id_categoria,
                               nome_categoria
                          from tb_categoria
                         where id_categoria = ?
                         and   id_usuario = ?';
                        
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $cod);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        $sql->execute();
        
        return $sql->fetchAll();
    }

    public function AlterarCategoria($nome, $cod){

        if (trim($nome) == '' || empty($cod)) {
            return 0;
        }

        $conexao = parent::retornarConexao();

        $comando_sql = 'update tb_categoria
                           set nome_categoria = ?
                         where id_categoria = ?
                           and id_usuario = ?';

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $cod);
        $sql->bindValue(3, UtilDAO::CodigoLogado());

        try{
            $sql->execute();
            return 1;
        }
        catch (Exception $ex){
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ExcluirCategoria($id_categoria)
    {
        if ($id_categoria == '') {
            return 0;
        }

        $conexao = parent::retornarConexao();

        $comando_sql = 'delete from tb_categoria
                         where id_categoria = ?
                           and id_usuario = ?';

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $id_categoria);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        try{
            $sql->execute();
            return 1;
        }
        catch (Exception $ex){
            echo $ex->getMessage();
            return -4;
        }
    }
}

?>