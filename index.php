<?php
    include_once("adm/session_login.php");
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