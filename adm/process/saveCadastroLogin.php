<?php
    include_once("sessionLogin.php");
    verificarNivel($_SESSION['nivel'], [7]);

    //Incluindo conexão
    
    if(isset($_POST['update']) && isset($_POST['login'])){
        include_once("../../DAO.php");
        // Capturando dados do formulário
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $nivel = $_POST['nivel'];
        $id = $_POST['id'];
        
       
        if(isset($senha)){
            $senhaSegura = password_hash($senha, PASSWORD_DEFAULT ); // Criptografa a senha 
        }else{
            $senhaSegura = ''; 
        }

        
        $stmt = $conexao->prepare("UPDATE pessoa SET login = ?, senha = ?, nivel = ? 
        WHERE id = ?");

        // Verifica se a preparação da consulta foi bem-sucedida
        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $conexao->error);
        }

        // Vincula os parâmetros e executa a consulta
        $stmt->bind_param("ssii", $login, $senhaSegura, $nivel, $id);

        
        if (!$stmt->execute()) {
            echo "<script>alert('Erro ao atualizar dados da pessoa: " . $stmt->error . "'); window.location.href = 'admDoadores.php';</script>";
            $stmt->close();
            $conexao->close();
            exit();
        }
        $stmt->close();
               
        // Fecha a conexão
        $conexao->close();
        
        echo "<script>alert('Doador e endereço atualizados com sucesso!'); window.location.href = '../admDoadores.php';</script>";
    } else {
        // Se não tiver acessado a página enviando dados do formulário
        retornarAdm();
    }
    
    
    function retornarAdm(){
        echo "<script>alert('Houve algo de errado ao acesar a pagina!'); window.location.href = 'admDoadores.php';</script>";
        exit();
    }
    

    ?>