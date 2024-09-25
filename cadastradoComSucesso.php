<?php
    include_once("adm/process/sessionLogin.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <?php include("Componentes/headBasic.html"); ?>

    <title>ISFN | Cadastrado com Sucesso</title>

    <style>
        .cadastradoComSucesso{
            padding-top:150px;
            min-height: 60vh;
        }
        .cadastradoComSucesso .row>div{
            display:flex;
            justify-content: center;
        }
        @media (max-width:720px){
            .cadastradoComSucesso .row>div{
                display:block;
            }
            .cadastradoComSucesso .row>div>a{
                margin-bottom:10px;
            }
        }
    </style>
</head>



<body>
    <?php include("Componentes/menu.php"); ?>




    <section class="cadastradoComSucesso container-fluid mb-5">
        <h2 class="text-center mt-5">Seu cadastro foi efetuado com sucesso!</h2>
        <br>
        <h4 class="text-center">Em breve entraremos em contato</h4>
        <div class="row d-flex justify-content-center my-5">
            <div class="col-md-6 col-12 gap-5 mt-5">
                <a class="btn btn-secondary col-md-5 col-12" href="index.php">Pagina Inicial</a>

                <a class="btn btn-primary col-md-5 col-12" href="Doacoes.php">Fazer Doação</a>
            </div>
        </div>

    </section>

    


    <?php

    include("Componentes/footer.html");

    ?>


</body>
</html>