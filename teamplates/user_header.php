<!DOCTYPE html>
<html lang="pt-br"> 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/1ab94d0eba.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <div class="container-menu">
                <a class="menu-logo" href="index.php"><img src="imgs/empresta.com.png" alt="EMPRESTA.COM"></a>
                <a class="titulo-logo" href="index.php">empresta.com</a>
                <nav class='menu-nav'>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <ul>
                            <li><a href="meus-itens.php">meus itens</a></li>
                            <li><a href="itens-emprestados.php">itens emprestados</a></li>
                            <?php require_once "../atp/login/Cliente.php";
                                $c = new Cliente();
                                $name = $c->dados($_SESSION['id']);
                                //$c é o objeto pessoa a qual vai estar logada e a funcao dados puxa o username
                                echo "<li><a href='../atp/user_config.php'>" . $name['nomeCliente'] . "</a></li>" ;?>
                            <li><a href="../atp/login/logout.php" >Sair</a></li>
                        </ul>
                    </form>
                </nav>
        </div>
    </header>