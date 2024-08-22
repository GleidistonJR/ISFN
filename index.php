<!DOCTYPE html>
<html lang="pt-br">

<head>

    <?php
    include("Componentes/headBasic.html");
    ?>
    <link rel="stylesheet" href="css/banner.css?9">
    <link rel="stylesheet" href="css/IndexSobre.css?9">
    <link rel="stylesheet" href="css/IndexApoiar.css?9">
<!--    <link rel="stylesheet" href="css/IndexDepoimentos.css?9">   -->

    <title>Instituto São Filipe Neri</title>

</head>

<body>
    <main>


        <?php
        include_once("Componentes/menu.html");

        include_once("Componentes/banner.html");

        include_once("Componentes/IndexSobre.html");

        include_once("Componentes/IndexApoiar.html");

        //include_once("Componentes/IndexDepoimentos.html");
        ?>

    </main>

    <?php
    include("Componentes/footer.html");
    ?>



    <script src="js/javascript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>