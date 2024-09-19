<?php
    session_set_cookie_params([
        'lifetime' => 3600,
        'path'     => '/',
        'domain'   => 'isfn.org.br',
        'secure'   => false,
        'httponly' => true
    ]);
    session_start();

    if(!isset($_SESSION['login'])){
        unset($_SESSION['login']);
        session_destroy();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <?php
    include("Componentes/headBasic.html");
    ?>
    <link rel="stylesheet" href="css/banner.css?10">
    <link rel="stylesheet" href="css/IndexSobre.css?10">
    <link rel="stylesheet" href="css/IndexApoiar.css?10">
<!--    <link rel="stylesheet" href="css/IndexDepoimentos.css?10">   -->

    <title>Instituto São Filipe Neri</title>

</head>

<body>
    <main>


        <?php
        include_once("Componentes/menu.php");

        include_once("Componentes/banner.html");

        include_once("Componentes/IndexSobre.html");

        include_once("Componentes/IndexApoiar.html");

        //include_once("Componentes/IndexDepoimentos.html");
        ?>

    </main>

    <?php
    include("Componentes/footer.html");
    ?>



</body>