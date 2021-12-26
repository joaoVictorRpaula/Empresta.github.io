<?php
if(!isset($_SESSION)){
    session_start();
}
//Conexão banco de dados
function getConnection(){
    $user="root";
    $pass="";
    $db="mysql:host=localhost:3307;dbname=empresta";
 
    try{
        $connect = new PDO($db,$user,$pass);

        return $connect;

    } catch(PDOException $ex){

        echo "Falha: ".$ex->getMessage();
        
    }
}


