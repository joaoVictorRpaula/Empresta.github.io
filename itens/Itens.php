<?php
class Itens{
    private $connect;

    public function __construct(){
        require_once "../atp/login/db_connect.php";
        $this->connect = getConnection();
    }

    public function buscarDados($id=null){
        $dados = array();
        if($id==null){
            $cmd = $this->connect->query("SELECT * FROM Itens");
        }
        else{
            $cmd = $this->connect->query("SELECT * FROM Itens WHERE id='$id'");
        }
        $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);

        return $dados;
    }

    public function buscarItensEmprestados($idCliente){
        $dados=array();
        $cmd=$this->connect->query("SELECT Itens.id,idClienteEmprestado,Itens.nome,Itens.dataEmprestimo,Itens.previsao,Itens.dataEntrega,Cliente.nomeCliente,Cliente.phone 
        FROM Itens INNER JOIN Cliente ON Cliente.id = Itens.idCliente WHERE idClienteEmprestado = '$idCliente' ");
        $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);

        return $dados;
    }

    public function devolverItem($idItem){
        $dataEntrega=date('Y/m/d');
        $status="liberado";
        $idClienteEmprestado=null;
        $this->connect->query('SET foreign_key_checks = 0;');
        if($this->connect->query("UPDATE Itens SET dataEntrega='$dataEntrega', status='$status', idClienteEmprestado='$idClienteEmprestado' WHERE id = '$idItem' ")){
            $this->connect->query('SET foreign_key_checks = 1;');
            return true;
        }
        else{
            $this->connect->query('SET foreign_key_checks = 1;');
            return false;
        }
    }
    
    public function cadastraritem($nome,$tipo){
       $dataEmprestimo = "";
       $dataEntrega ="";
       $previsao = "";
       //status = 'liberado' ou 'bloqueado';
       $status="liberado";
       $idCliente = $_SESSION['id'];

       $this->connect->query("INSERT INTO Itens (nome,dataEmprestimo,previsao,dataEntrega,status,tipo,idCliente)
       VALUES ('$nome','$dataEmprestimo','$previsao','$dataEntrega','$status','$tipo','$idCliente');");
    }

    public function Emprestar($idCliente,$idItem,$previsao){
        //Função date retorna data atual
        $dataEmprestimo= date('Y/m/d');
        $dataEntrega="";
        //status = 'liberado' ou 'bloqueado';
        $status="bloqueado";

        //se não for definido o prazo de entrega, será depois de 10 dias do emprestimo.
        if(empty($previsao)){
            $previsao = strtotime('+10 days',strtotime($dataEmprestimo));
            $previsao = date("Y/m/d",$previsao);
            
            //---strtotime() TRANSFORMA EM NUMERO INT PARA O PROGRAMA TRABALHAR
            //PARA RETORNAR DE VOLTA PRECISA TRANSFORMAR EM DATE('d/m/Y')
            //---------------------------------------------------------------
            //echo date('d/m/Y',strtotime($dataEmprestimo)).'<br>'; 
            //echo $previsao.'<br>';
        }
        if($this->connect->query("UPDATE Itens SET dataEmprestimo='$dataEmprestimo', previsao='$previsao', 
        dataEntrega='$dataEntrega', status='$status', idClienteEmprestado='$idCliente' WHERE id = '$idItem' "))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function edit($idItem,$nome,$tipo){
        if($this->connect->query("UPDATE Itens SET nome='$nome', tipo='$tipo' WHERE id ='$idItem'")){
            return true;
        }
        else{
            return false;
        }
    }
    public function excluir($idItem){
        if($this->connect->query("DELETE FROM Itens WHERE id='$idItem'")){
            return true;
        }
        else{
            return false;
        }
    }
}



?>