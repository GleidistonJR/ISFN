<?php
    include_once("adm/process/sessionLogin.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <?php
    include("Componentes/headBasic.html");
    ?>
    <link rel="stylesheet" href="/css/banner.css?16">
    <link rel="stylesheet" href="/css/IndexSobre.css?16">
    <link rel="stylesheet" href="/css/IndexApoiar.css?16">
<!--    <link rel="stylesheet" href="/css/IndexDepoimentos.css?16">   -->

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