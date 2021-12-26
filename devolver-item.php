<?php
    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION['id'])){
        header("location: login.php");
    }

    include "teamplates/user_header.php";

    if(isset($_POST['submit'])){
        require_once "itens/Itens.php";
        $i = new Itens();
        $errors = array();

        $previsao=filter_input(INPUT_POST,"previsao",FILTER_SANITIZE_STRING);
        if($i->devolverItem($_SESSION['idItem'])){
            header("location: itens-emprestados.php");
        }
        else{
            $errors[]="erro ao emprestar item";
        }
    }
?>

<link rel="stylesheet" href="css/item_config.css">
<section class="container-back">
    <div class="container-box">
        <div class="box">
            <h1>Devolver Item:</h1>
            <a class='botao2' href="objetos.php">Objetos Disponíveis</a>
        </div>
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
                    <h2>Nome do Item:</h2>
                    <div class='valor-box'> 
                        <?php
                            require_once "itens/itens.php";
                            $item = new Itens();
                            $dados = array();
                            $dados = $item->buscarDados($_SESSION["idItem"]);
                            if(!empty($dados)){
                                echo($dados[0]["nome"]);
                            }
                            else{
                                echo "<li style='font-weight:bold'>Error: Objeto não encontrado</li>";
                            }
                        ?>
                    </div>
            </div>
            <div class='info'>
                <h2>Dono do Item:</h2>
                <div class='valor-box'> 
                        <?php
                            require_once "itens/itens.php";
                            $item = new Itens();
                            $dados = array();
                            $dados = $item->buscarItensEmprestados($_SESSION["id"]);
                            if(!empty($dados)){
                                echo($dados[0]["nomeCliente"]);
                            }
                            else{
                                echo "<li style='font-weight:bold'>Error: Objeto não encontrado</li>";
                            }
                        ?>
                    </div>
            </div>
            <div class='info'>
                <h2>Contato do dono:</h2>
                <div class='valor-box'> 
                        <?php
                            require_once "itens/itens.php";
                            $item = new Itens();
                            $dados = array();
                            $dados = $item->buscarItensEmprestados($_SESSION["id"]);
                            if(!empty($dados)){
                                echo($dados[0]["phone"]);
                            }
                            else{
                                echo "<li style='font-weight:bold'>Error: Objeto não encontrado</li>";
                            }
                        ?>
                    </div>
            </div>
                <input class="submit" type="submit" name="submit" value="Devolver"></input>
                </form>
        </div>
    </div>
</section>

<?php include "teamplates/footer.php"; ?>