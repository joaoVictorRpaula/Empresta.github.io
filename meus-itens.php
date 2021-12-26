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
        <p class="parag">Meus itens cadastrados:</p>
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
                <td>Data entrega</td>
                <td>Status</td>
            </tr>
            <?php
                require_once "itens/Itens.php";
                //Objeto "item"
                $item = new Itens();
                $dados = array();
                $dados = $item->buscarDados();
                //Para cada item achado, criar um <tr>
                for ($i=0; $i < count($dados); $i++) { 
                    //Se o idCliente for igual ao id da sessão ele retorna o item.
                    if($dados[$i]["idCliente"]==$_SESSION['id']){
                        echo "<tr>";
                        foreach ($dados[$i] as $k => $v) {
                            if($k!="id" and $k!="tipo" and $k!="idCliente" and $k!="idClienteEmprestado"){
                                if(($dados[$i]['dataEmprestimo']!='0000-00-00') and (strtotime(date('Y/m/d'))>strtotime($dados[$i]['previsao']))){
                                    echo "<td style='color:red''>".$v."</td>";
                                }
                                else{
                                    echo "<td>".$v."</td>";
                                }
                            }
                        }
                        if($dados[$i]["status"]=="liberado"){
                            foreach ($dados[$i] as $k => $v) {
                                if(($k=="id") and $dados[$i]["status"]=="liberado"){
                                    echo"<td><a href='itens/redirecionar.php?id=$v&page=edit' style='text-decoration: none;color:#056367' >editar</a></td>";
                                }
                            }
                        }
                      echo"</tr>";
                    }
                }
            ?>   
        </table>
    </section>


<?php
    include "teamplates/footer.php"
?>