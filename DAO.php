<?php

/*
    $dbHost = "Localhost";
    $dbUsername = "isfn";
    $dbPassword = "newISFN@2024";
    $dbName = "isfn_isfn";
    */
  
    $dbHost = "Localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "isfn";

    $conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    //Se der erro em minha conexão ele dara mensagem de erro
    if ($conexao->connect_error) {
        die("Falha na conexão: " . $conexao->connect_error);
    }

?>
