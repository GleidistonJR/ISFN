<?php


    /* Xamp local 
    */
    $dbHost = "Localhost";
    $dbUsername = "root"; //"Junior_isfn";
    $dbPassword = ""; //"newISFN@2025";
    $dbName = "junior_isfn"; //"Junior_isfn"; 
    
    /* Servidor Hestia
    $dbHost = "localhost";
    $dbUsername = "Junior_isfn";
    $dbPassword = "newISFN@2025";
    $dbName = "Junior_isfn";
    */

    $conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    //Se der erro em minha conexão ele dara mensagem de erro
    if ($conexao->connect_error) {
        die("Falha na conexão: " . $conexao->connect_error);
    }

?>
