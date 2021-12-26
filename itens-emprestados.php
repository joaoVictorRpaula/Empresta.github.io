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
        header("location: login.php");
    }

?>
    <link rel="stylesheet" href="css/itens.css">
    <div class="parag-box">
        <p class="parag">Meus Itens Emprestados:</p>
    </div>
    <section class="container-back">
        <div class="container-box">
            <a class='cadastre' href="cadastro-itens.php">Cadastrar item</a>
            <a class='botao2' href="objetos.php">Objetos Disponíveis</a>
        </div>
        <table>
            <tr id='titulo'>
                <td>Item</td>
                <td>Data emprestimo</td>
                <td>Previsão entrega</td>
            </tr>
            <?php
                require_once "itens/Itens.php";
                //Objeto "item"
                $item = new Itens();
                $dados = array();
                $dados = $item->buscarItensEmprestados($_SESSION['id']);
                //Para cada item achado, criar um <tr>
                for ($i=0; $i < count($dados); $i++) { 
                    //Se o idCliente for igual ao id da sessão ele retorna o item.
                    if($dados[$i]["idClienteEmprestado"]==$_SESSION['id']){
                        echo "<tr>";
                        foreach ($dados[$i] as $k => $v) {
                            if($k!="idClienteEmprestado" and $k!="id" and $k!="nomeCliente" and $k!="phone" and $k!="dataEntrega"){
                                if(strtotime(date('Y/m/d'))>strtotime($dados[$i]['previsao'])){
                                    echo "<td style='color:red''>".$v."</td>";
                                }
                                else{
                                    echo "<td>".$v."</td>";
                                }
                            }
                        }
                        foreach ($dados[$i] as $k => $v) {
                            if(($k=="id")){
                                echo"<td><a href='itens/redirecionar.php?id=$v&page=devolver'&page=devolver>devolver</a></td>";
                                echo"</tr>";
                            }
                        }
                    }
                }
            ?>   
        </table>
    </section>


<?php
    include "teamplates/footer.php"
?>