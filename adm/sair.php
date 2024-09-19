<?php
    session_set_cookie_params([
        'lifetime' => 3600,
        'path'     => '/',
        'domain'   => 'isfn.org.br',
        'secure'   => false,
        'httponly' => true
    ]);
    // Inicia a sessão
    session_start();
   
    // Remove todas as variáveis de sessão
    unset($_SESSION['login']);

    // Destroi a sessão
    session_destroy();

    // Redireciona o usuário para a página de login
    header('Location: login.php');

    // exit para garantir que o script pare aqui
    exit(); 
?>