<?php

Class Pessoa{


    private $pdo;

    //conexao com banco
    public function __construct($dbname, $host, $user, $senha){
        
        try {
            $this->pdo = new PDO(
                "mysql:dbname=".$dbname.
                ";host=".$host,
                $user,
                $senha);
    
        } catch (PDOException $e) {
            echo "Erro no banco de dados: ".$e->getMessage();
        }

        catch (Exception $e) {
            echo "Erro genérico: ".$e->getMessage();
        }
    }

    // função busca os dados e coloca na direita da tela para visualizar
    public function buscaDados()
    {
        $res = array();
        $cmd = $this->pdo->query("SELECT * FROM pessoa ORDER BY nome");

        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }



    public function cadastrarPessoa($nome, $telefone, $email){
        
        // antes de cadastrar verificar se ja tem o email cadastrado
        $cmd = $this->pdo->prepare("SELECT id FROM pessoa WHERE email = :e");
        $cmd->bindValue(":e", $email);
        $cmd->execute();
        if($cmd->rowCount() > 0)//email ja existe
        {
            return false;
        } else{
            $cmd = $this->pdo->prepare("INSERT INTO pessoa (nome, telefone, email) Values(:n, :t, :e)");
            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":t", $telefone);
            $cmd->bindValue(":e", $email);
            $cmd->execute();  
            return true;
        }
    }


    public function excluiPessoa($id){
        
        $cmd = $this->pdo->prepare("DELETE FROM pessoa WHERE id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
    }


    // buscar dados pessoa especifica
    public function buscarDadosPessoa($id){
        
        $res = array();
        $cmd = $this->pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    // atualizar no banco
    public function atualizarDadosPessoa($id, $nome, $telefone, $email){
            
        $cmd = $this->pdo->prepare("UPDATE pessoa SET nome = :n,
            telefone = :t, email = :e WHERE id = :id");
        $cmd->bindValue(":n", $nome);
        $cmd->bindValue(":t", $telefone);
        $cmd->bindValue(":e", $email);
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        return true;
            
    }
}
?>