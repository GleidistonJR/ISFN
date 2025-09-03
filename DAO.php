<?php


    /* Xamp local 
    */
    $dbHost = "Localhost";
    $dbUsername = "root"; //"Junior_isfn";
    $dbPassword = ""; //"newISFN@2025";
    $dbName = "abenazio_isfn"; //"Junior_isfn"; 
    
    /* Servidor Hestia
    $dbHost = "localhost";
    $dbUsername = "Abenazio_ISFN";
    $dbPassword = "newISFN@2025";
    $dbName = "Abenazio_ISFN";
    */

    $conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    //Se der erro em minha conexão ele dara mensagem de erro
    if ($conexao->connect_error) {
        die("Falha na conexão: " . $conexao->connect_error);
    }

?>
