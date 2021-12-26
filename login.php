<?php

require_once 'login/Cliente.php';
//$c é um objeto cliente que salva e exporta para o bd.
$c = new Cliente();


//verificar botão continuar
if(isset($_POST['submit'])){
  //array que armazena erro
  $errors = array();

  //sanitize do username
  if(!$username = filter_input(INPUT_POST,'username',FILTER_SANITIZE_STRING)){
    if(!empty($username)){
      $errors[] = "Invalid username";
    }
    
  }
  //sanitize da senha
  $senha = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);

  //se a senha ou user estiver vazio aparece a mensagem de erro
  if(empty($username) or empty($senha)){
    $errors[] = "<ul><li> O campo login/senha deve ser preenchido</li></ul>";
  }

  //Se o user e pass estiver correto então ele loga.
  else if($c->logar($username,$senha)){
    if(isset($_SESSION['id'])){
      header("Location: index.php");
 
    }
    else {
      header("Location: login.php");
    }
  }

  else{
    $errors[] = "Invalid pass or user.";
  }
  
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/1ab94d0eba.js" crossorigin="anonymous"></script>
  <title>Login - Empresta.com</title>
  <link rel="stylesheet" href="css/login.css">
</head>

<body>
  <main class="container">
    <div class='h2-box'>
      <h2>Entrar</h2>
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
        <input type="text" name="username" id="username"  placeholder="Insira o usuário">
        <div class="underline"></div>
      </div>
      <div class="input-field">
        <input type="password" name="password" id="password"  placeholder="Insira a senha">
        <div class="underline"></div>
      </div>

      <input type="submit" name="submit" value="Continuar">
    </form>

    <div class="footer">
      <a href="cadastro.php" class='cadastre'>Cadastre-se</a>
    </div>
  </main>

<?php include "teamplates/footer.php" ?>