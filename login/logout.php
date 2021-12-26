<?php
session_start();
if(isset($_SESSION['id'])){
    echo("LOGOUT");
    session_destroy();
    header("location: ../index.php");
}