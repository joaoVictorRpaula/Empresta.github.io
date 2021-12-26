<?php

Class Cliente{
    private $connect;
    //Conexão com o banco 
    public function __construct()
    {
        require_once 'db_connect.php';
        $this->connect = getConnection();
    }
    //logar
    public function logar($username,$senha){
        $cmd = $this->connect->query("SELECT id, username, senha FROM Cliente
        WHERE username = '$username' AND senha = md5('$senha')");
        //Se existir uma coluna usuario e senha compativel ao digitado retorna TRUE.
        if($cmd->rowCount() > 0){
            $dados = array();
            $dados = $cmd->fetch();
            $_SESSION['id']=$dados["id"];
            return true;
        }
        else { return false; }

    } 
    //Função que pega o username da pessoa caso o id dela esteja correto(ou seja se ela estiver logada)
    public function dados($id){
        $dados = array();
        $cmd = $this->connect->query("SELECT nomeCliente,phone,username,senha FROM Cliente WHERE id = '$id'");
        if($cmd->rowCount() > 0){
            $dados = $cmd->fetch();
        }
        return $dados;
    }


    public function cadastrar($nome, $username, $senha,$phone){
        $cmd = $this->connect->query("SELECT id FROM Cliente WHERE username = '$username';");
        if($cmd->rowCount()>0){
            return false;
        }
        else{
            $cmd = $this->connect->query("INSERT INTO Cliente (nomeCliente,phone,username,senha)
            VALUES('$nome','$phone','$username',md5('$senha'));");
            return true;
        }
    }

    public function editar($id,$nome,$username,$phone){
        $cmd = $this->connect->query("SELECT id FROM Cliente WHERE username = '$username';");
        if($cmd->rowCount()>0){
            return false;
        }
        else if($cmd = $this->connect->query("UPDATE Cliente SET nomeCliente = '$nome', phone = '$phone' WHERE id = '$id' ")){
            return true;
        }
        else{
            return false;
        }
    }   
    public function editarSenha($id,$username,$senha){
        $cmd = $this->connect->query("SELECT id FROM Cliente WHERE username = '$username';");
        if($cmd->rowCount()>0){
            return 'false';
        }
        else if($cmd = $this->connect->query("UPDATE Cliente SET senha = md5('$senha') WHERE id = '$id' ")){
            return true;
        }
        else{
            return false;
        }

    }
    public function editarUsername($id,$username){
        $cmd = $this->connect->query("SELECT id FROM Cliente WHERE username = '$username';");
        if($cmd->rowCount()>0){
            return 'false';
        }
        else if($cmd = $this->connect->query("UPDATE Cliente SET username = '$username' WHERE id = '$id' ")){
            return true;
        }
        else{
            return false;
        }

    }
    
}

    

?>