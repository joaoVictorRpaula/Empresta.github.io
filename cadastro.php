<?php

  require_once "login/Cliente.php";
  $c = new Cliente();

  if(isset($_POST['submit'])){
    $error = array();

    if(!$nome = filter_input(INPUT_POST,'nome',FILTER_SANITIZE_STRING)){
      if(!empty($nome)){
        $error[] = "Invalid 'nome'";
      }
    }

    if(!$phone = filter_input(INPUT_POST,'phone',FILTER_SANITIZE_STRING)){
      if(!empty($phone)){
        $error[] = "Invalid phone";
      }
    }
  
    if(!$username = filter_input(INPUT_POST,'username',FILTER_SANITIZE_STRING)){
      if(!empty($username)){
        $error[] = "Invalid username";
      }
    }

    if(!$senha = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING)){
      if(!empty($senha)){
        $error[] = "Invalid password";
      }
    }

    if((empty($nome) or empty($username) or (empty($senha)))){
      $errors[]="Nome, User and Pass must be filled";
    }
    
    else if($c->cadastrar($nome,$username,$senha,$phone)){
      header("location: login.php");
    }
    else{
      $errors[]="User already exists";
    }
 
  }
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/1ab94d0eba.js" crossorigin="anonymous"></script>
  <title>Cadastro - Empresta.com</title>
  <link rel="stylesheet" href="css/login.css">
</head>

<body>
  <main class="container">
    <div class='h2-box'>
      <h2>Cadastro</h2>
    </div>
    <?php
      if(!empty($errors)){
        foreach ($errors as $erro){
          echo "<ul><li>$erro</li></ul>";
        }
      }
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <div class="input-field">
        <input type="text" name="nome" placeholder="Digite seu nome*">
        <div class="underline"></div>
      </div>
      <div class="input-field">
        <input type="text" name="phone" placeholder="Digite seu Telefone*">
        <div class="underline"></div>
      </div>
      <div class="input-field">
        <input type="text" name="username"  placeholder="Digite seu username*">
        <div class="underline"></div>
      </div>
      <div class="input-field">
        <input type="password" name="password" placeholder="Insira a senha*">
        <div class="underline"></div>
      </div>
        <input type="submit" name="submit" value="Enviar">
    </form>


  </main>

<?php 
  include "teamplates/footer.php";
?>