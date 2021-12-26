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
        $nome = filter_input(INPUT_POST,"nome",FILTER_SANITIZE_STRING);

        $tipo = filter_input(INPUT_POST,"tipo",FILTER_SANITIZE_STRING);

        if(!empty($nome) or !empty($tipo)){
            if(!$i->edit($_SESSION['idItem'],$nome,$tipo)){
                $errors[]="<li>Erro ao editar o item</li>";
            }
        }
        else{
            $errors[]="Todos os campos devem ser preenchidos.";
        }
    }
    if(isset($_POST['excluir'])){
        require_once "itens/Itens.php";
        $i = new Itens();
        $errors = array();
        if(!$i->excluir($_SESSION['idItem'])){
            $errors[]="<li>Erro ao excluir o item.</li>";
        }
        else{
            header("Location: meus-itens.php");
        }
    }

?>

<link rel="stylesheet" href="css/item_config.css">
<section class="container-back">
    <div class="container-box">
        <div class="box">
            <h1>Editar item</h1>
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
                    <input class="inp" type="text" name="nome" value='<?php
                        require_once "itens/Itens.php";
                        $i = new Itens();
                        $dados = $i->buscarDados($_SESSION['idItem']);
                        echo($dados[0]["nome"]);
                    ?>'></input>
            </div>
            <div class='info'>
                <h2>Tipo de Item</h2>
                <select class="inp" name="tipo">
                    <option value="<?php
                        require_once "itens/Itens.php";
                        $i = new Itens();
                        $dados = $i->buscarDados($_SESSION['idItem']);
                        echo($dados[0]["tipo"]);
                    ?>"selected><?php
                        require_once "itens/Itens.php";
                        $i = new Itens();
                        $dados = $i->buscarDados($_SESSION['idItem']);
                        echo($dados[0]["tipo"]);

                        echo "</option>";
                        if(($dados[0]["tipo"]=="celular") or ($dados[0]["tipo"]=="Celular")){
                            $option2="Carro";
                        }
                        if(($dados[0]["tipo"]=="carro") or ($dados[0]["tipo"]=="Carro")){
                            $option2="Celular";
                        }
                        echo "<option value='$option2'>$option2</option>";
                    ?></option>
                </select>
            </div>
                <input class="submit" type="submit" name="submit" value="salvar"></input>
                <input class="excluir" type="submit" name="excluir" value="Excluir Item"></input>
                </form>
        </div>
    </div>
</section>

<?php include "teamplates/footer.php"; ?>