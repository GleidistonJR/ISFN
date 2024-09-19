<?php
    include_once("session_login.php"); 

    if(isset($_SESSION['login'])){
        header('Location: ../index.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    
    <title>ISFN | Login</title>

    <?php
    include("Componentes/headBasic.html");
    ?>

<style>
    #formulario-login{
        padding-top: 150px;
        max-width: 100%;
    }
    #formulario-login .row{
        max-width: 100%;
    }
    .btn-enviar{
        margin-left: 10%;
        width: 20%;
    }
    .btn-voltar{
        margin-left: 25%;
        width: 20%;
    }
    @media (max-width: 992px) {
        .btn-enviar{
        margin-left: 0%;
        width: 45%;
    }
    .btn-voltar{
        margin-left: 0%;
        width: 45%;
    }
    }
</style>
</head>


<body>

    <?php include("Componentes/menu.php"); ?>


    <section class="container" id="formulario-login">
        <article class="row d-flex flex-column jusify-content-center align-items-center">
            <h2 class="text-center">Login</h2>
            <form class="col-10 col-form m-5" method="POST" action="processLogin.php">

                <div class="d-flex flex-column jusify-content-center align-items-center mb-5">
                    <div class="col-10 col-md-5 mb-4">
                        <label for="login" class="form-label">Login</label>
                        <input type="text" class="form-control" placeholder="login" name="login" id="login" required>
                    </div>
                    <div class="col-10 col-md-5">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" name="senha" id="senha" placeholder="senha" required>
                    </div>
                </div>



                <a class="btn btn-secondary btn-voltar px-5 my-5" href="../index.php">Voltar</a>
                <input class="btn btn-primary btn-enviar px-5 my-5" type="submit" name="submit" value="Entrar">

            </form>
        </article>


    </section>
      
    <?php include("Componentes/footer.html"); ?>

</body>