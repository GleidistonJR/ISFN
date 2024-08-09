<!DOCTYPE html>
<html lang="pt-br">

    <?php
    include("Componentes/headBasic.html");
    ?>
    <link rel="stylesheet" href="css/styleEquipe.css">
    <title>Equipe</title>


<body>
    <?php
    include("Componentes/menu.html");
    ?>




    <!----------------------CONTAINER NOSSA EQUIPE-------------------------->
    <div class="container-fluid" id="container-equipe">
        <div class="row">
            <div class="col-12">
                <h1>
                    NOSSA EQUIPE
                </h1>
            </div>
        </div>

        <!----------------------CONTAINER PESSOAS DA EQUIPE-------------------------->
    </div>

    <div class="container-fluid" id="container-pessoas">
        <div class="row">
            <div class="col-12 col-md-4 colImg">
                <img class="img-fluid" src="img/img-teste/laranja.webp" alt="">
                <h4>Mike Cannon-Brookes</h4>
                <p>Lorem ipsum dolor sit amet</p>
            </div>
            <div class="col-12 col-md-4 colImg">
                <img class="img-fluid" src="img/img-teste/verde.webp" alt="">
                <h4>Scott Farquhar</h4>
                <p>Lorem ipsum dolor sit amet</p>
            </div>
            <div class="col-12 col-md-4 colImg">
                <img class="img-fluid" src="img/img-teste/azul.webp" alt="">
                <h4>Anu Bharadwa</h4>
                <p>Lorem ipsum dolor sit amet</p>
            </div>

        </div>
    </div>


    <!----------------------CONTAINER NOSSo concelho-------------------------->
    <div class="container-fluid" id="titulo-concelho">
        <div class="row">
            <div class="col-12">
                <h1 class="titulo2">
                    Conselho Administrativo
                </h1>
                <p>
                    Os melhores e mais brilhantes inovadores do Vale 
                    do Silício aconselham nossos líderes.
                </p>
            </div>
        </div>
    </div>

    <div class="container-fluid" id="ConcelhoADM">
            <div class="row">
                <div class="col-6 col-md-2 P1">
                    <img src="img/img-concelho/Shona_Brown.jpg" alt="">
                    <h6>Shona Brown</h6>
                    <p>Presidente do Conselho</p>
                </div>
                <div class="col-6 col-md-2 P1">
                <img src="img/img-concelho/Mike_Cannon-Brookes.jpg" alt="">
                    <h6>Mike Cannon-Brookes</h6>
                    <p>Board Member</p>
                </div>
                <div class="col-6 col-md-2 P1">
                <img src="img/img-concelho/Scott_Farquhar.jpg" alt="">
                    <h6>Scott Farquhar</h6>
                    <p>Board Member</p>
                </div>
                <div class="col-6 col-md-2 P1">
                <img src="img/img-concelho/Heather_M_Fernandez.jpg" alt="">
                    <h6>Heather M. Fernandez</h6>
                    <p>Board Member</p>
                </div>
                <div class="col-6 col-md-2 P1">
                <img src="img/img-concelho/Sasan_ Goodarzi_small.jpg" alt="">
                    <h6>Sasan Goodarzi</h6>
                    <p>Board Member</p>
                </div>
            </div>
        </div>







    <?php
    include("Componentes/footer.html");
    ?>

        <script src="js/javascript.js"></script>
</body>