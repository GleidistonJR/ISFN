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
        unset($_SESSION['nivel']);
        session_destroy();
        header('Location: login.php');
        exit();
    }

    if($_SESSION['nivel'] < 5){
        echo "<script>
        alert('Você não possui permissão para acessar essa página'); 
        window.history.back();
        </script>";
    }
?>