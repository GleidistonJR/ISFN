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
        unset($_SESSION['nome']);
        session_destroy();
    }
    
    function verificarNivel($nivelUsuario, $niveisPermitidos) {
        if (!in_array($nivelUsuario, $niveisPermitidos)) {
            echo "<script>
                alert('Você não possui permissão para acessar essa página'); 
                window.history.back();
                </script>";
            exit();
        } else {
            //permitido
        }
    }
?>