<?php
    include_once("../session_login.php");
   
    // Remove todas as variáveis de sessão
    unset($_SESSION['login']);

    // Destroi a sessão
    session_destroy();

    // Redireciona o usuário para a página de login
    header('Location: ../login.php');

    // exit para garantir que o script pare aqui
    exit(); 
?>