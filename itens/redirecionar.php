<?php
if(!isset($_SESSION)){
    session_start();
}
    try
    {
        if($_GET['page']=="emprestar"){
            $_SESSION['idItem']=$_GET['id'];

            header("location: ../emprestar-item.php");
        }
        else if($_GET['page']=="devolver"){
            $_SESSION['idItem']=$_GET['id'];

            header("location: ../devolver-item.php");
        }
        else if ($_GET['page']=="edit"){
            $_SESSION['idItem']=$_GET['id'];

            header("location: ../edit-item.php");
        }
    }
    catch(Exception $e){
        echo "Error: ", $e->getMessage(),"\n";
    }
?>