<?php
    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION['id'])){
        header("location: login.php");
    }
    var_dump($_POST);
    include "teamplates/user_header.php";

    if(isset($_POST['submit'])){
        require_once "itens/Itens.php";
        $i = new Itens();
        $errors = array();

        $nome = filter_input(INPUT_POST,"nome",FILTER_SANITIZE_STRING);

        $tipo = filter_input(INPUT_POST,"tipo",FILTER_SANITIZE_STRING);

        if(!empty($nome) or !empty($tipo)){
            $i->cadastraritem("$nome","$tipo");
        }
        else{
            $errors[]="Todos os campos devem ser preenchidos.";
        }
      
    }

?>

<link rel="stylesheet" href="css/item_config.css">
<section class="container-back">
    <div class="container-box">
        <div class="box">
            <h1>Cadastro de Item</h1>
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
                    <input class="inp" type="text" name="nome" ></input>
            </div>
            <div class='info'>
                <h2>Tipo de Item</h2>
                <select class="inp" name="tipo">
                    <option value="" data-default disabled selected></option>
                    <option value="Carro">Carro</option>
                    <option value="Celular">Celular</option>
                </select>
            </div>
                <input class="submit" type="submit" name="submit" value="salvar"></input>
                </form>
        </div>
    </div>
</section>

<?php include "teamplates/footer.php"; ?>