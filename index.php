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
    <main>
        <div class="search-container">
            <div class="search-border">
                <h1>empresta.com</h1>
                <h4>Aqui você encontra o que precisa para pegar emprestado!</h1>
            </div>
        </div>
    </main>    

    <div class ="h1-container">
        <h1>encontre seu objeto</h1>
    </div>

    <section class="section-back">
        <div class="section-container">
            <div>
                <a href="objetos.php"><h2>objetos disponíveis</h2></a>
                <hr>
                <a href="objetos.php"><img class='imagem-link' src="imgs/celular-emprestado.jpg"></a>
            </div>
            <div>
                <a href="objetos.php"><h2>objetos disponíveis</h2></a>
                <hr>
                <a href="objetos.php"><img class='imagem-link2' src="imgs/carro-empresta(1).JPG"></a>
            </div>
        </div>
    </section>

<?php include "teamplates/footer.php" ?>
