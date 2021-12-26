<?php
    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION['id'])){
        header("location: login.php");
    }

    include "teamplates/user_header.php";

    if(isset($_POST['submit'])){
        require_once "login/Cliente.php";
        $c = new Cliente();
        $errors= array();

        $nome = filter_input(INPUT_POST,'nome',FILTER_SANITIZE_STRING);
  
        $username = filter_input(INPUT_POST,'username',FILTER_SANITIZE_STRING);
  
        $senha = filter_input(INPUT_POST,'senha',FILTER_SANITIZE_STRING);

        $phone = filter_input(INPUT_POST,'phone',FILTER_SANITIZE_STRING);

        if((empty($nome) or(empty($phone)))){
            $errors[]="Nome, User, phone and Pass must be filled";
        }

        if($c->editar($_SESSION['id'],$nome,$username,$phone)){
            //If senha :: enabled ele atualiza a senha, if disabled ele so att o nome e user.
            if(isset($_POST['senha'])){
                if(!$c->editarSenha($_SESSION['id'],$username,$senha)){
                    $errors[]="Username already exists";
                }
            }
            if(isset($_POST['username'])){
                if(!$c->editarUsername($_SESSION['id'],$username)){
                    $errors[]="Username already exists";
                }
            }
        }
        else {
            $errors[]="Username already exists";
        }

    }
    
?>
<link rel="stylesheet" href="css/user_config.css">
<section class="container-back">
    <div class="container-box">
        <h1>Dados da conta:</h1>
        <?php
        if(!empty($errors)){
            foreach ($errors as $erro){
            echo "<ul><li>$erro</li></ul>";
            }
        }
        ?>
        <div class="h2-box">
            <div class='info'>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <h2>nome:</h2>
                <input class="inp" type="text" name="nome" value= "<?php
                    //Valor da caixa input vai ser um SELECT do banco de dados puxando a informação.
                    require_once "login/Cliente.php";
                    $c = new Cliente();
                    $dados = $c->dados($_SESSION['id']);
                    echo($dados['nomeCliente']);
                    ?>">
                </input>
            </div>
            <div class='info'>
                <h2>phone:</h2>
                <input class="inp" type="text" name="phone" value= "<?php
                    require_once "login/Cliente.php";
                    $c = new Cliente();
                    $dados = $c->dados($_SESSION['id']);
                    echo $dados['phone'];
                    ?>">
                </input>
            </div>
            <div class='info'>
                <h2>username:</h2>
                <input class="inp" id="username" type="text" disabled="disabled" name="username" value= "<?php
                    require_once "login/Cliente.php";
                    $c = new Cliente();
                    $dados = $c->dados($_SESSION['id']);
                    echo $dados['username'];
                    ?>">
                </input>
                <input type="button" name="user-b" onclick="enableUser()" value="editar"></input>
            </div>
            <div class='info'>
                <h2>senha:</h2>
                <input class='inp' id="senha" type="password" disabled="disabled" name="senha" value= "<?php
                    require_once "login/Cliente.php";
                    $c = new Cliente();
                    $dados = $c->dados($_SESSION['id']);
                    echo $dados['senha'];
                    ?>">
                </input>
                <input type="button" name="pass-b" onclick="enablePass()" value="editar"></input>
            </div>
            <input class="submit" type="submit" name="submit" value="salvar"></input>
            </form>
        </div>
    </div>
</section>

<script>
    function enableUser() {
        document.getElementById('username').disabled = false;
    }
    function enablePass() {
        document.getElementById('senha').disabled = false;
    }
</script>
<?php include "teamplates/footer.php"; ?>