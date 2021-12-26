<!DOCTYPE html>
<?php
if(!isset($_SESSION)){
    session_start();
}
//puxar o header personalizado caso SESSION['id'] existir
    require_once "login/Cliente.php";
    if(isset($_SESSION['id'])){
        include "teamplates/user_header.php";
    }
    else{
        include "teamplates/header.php";
    }
?>
    <link rel="stylesheet" href="css/itens.css">
    <div class="parag-box">
        <p class="parag">Objetos disponíveis:</p>
    </div>
    <section class="container-back">
        <div class="container-box">
            <a class='cadastre' href="cadastro-itens.php">Cadastrar item</a>
        </div>
        <table>
            <tr id='titulo'>
                <td>Item</td>
                <td>Tipo</td>
            </tr>
            <?php
                require_once "itens/Itens.php";
                //Objeto "item"
                $item = new Itens();
                $dados = array();
                $dados = $item->buscarDados();
                //Para cada item achado, criar um <tr>
                for ($i=0; $i < count($dados); $i++) { 
                    echo "<tr>";
                    foreach ($dados[$i] as $k => $v) {
                        //IF $KEY [status] estiver "liberado" então ele mostrará o $valor da $key [nome];
                        if(($k=="nome" or $k=="tipo") and $dados[$i]["status"]=="liberado"){
                            echo "<td>".$v."</td>";
                        }
                    }
                    if($dados[$i]["status"]=="liberado"){
                        foreach ($dados[$i] as $k => $v) {
                            if(($k=="id") and $dados[$i]["status"]=="liberado"){
                                echo"<td><a href='itens/redirecionar.php?id=$v&page=emprestar' style='text-decoration: none;color:#056367' >EMPRESTAR</a></td>";
                            }
                        }
                    }
                  echo"</tr>";
                }
            ?>   
        </table>
    </section>


<?php
    include "teamplates/footer.php"
?>