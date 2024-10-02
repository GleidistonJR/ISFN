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
            return true;
        }
    }

    //FUNÇÔES REPETITIVAS
    function verificarDocumento($_documento){
        if(strlen($_documento) < 15){
            //Foi enviado um cpf
            $documento = 'cpf';
            return $documento;
        }else{
            //Foi enviado um cnpj
            $documento = 'cnpj';
            return $documento;
        }
    }
?>