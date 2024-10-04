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
        
       
        if(!empty($senha)){
            $senhaSegura = password_hash($senha, PASSWORD_DEFAULT ); // Criptografa a senha 

            $stmt = $conexao->prepare("UPDATE pessoa SET senha = ? WHERE id = ?");
            $stmt->bind_param("si", $senhaSegura, $id);
            $stmt->execute();
            $stmt->close();

        }

        if(!empty($login)){
            $stmt_verifica_login = $conexao->prepare("SELECT * FROM pessoa WHERE login = ?");
            $stmt_verifica_login->bind_param("s", $login);
            $stmt_verifica_login->execute();
            $result_verifica_login = $stmt_verifica_login->get_result();
            
            if ($result_verifica_login->num_rows > 0) {
                echo "<script>alert('Este login já está sendo utilizado!'); window.history.back();</script>";
                $stmt_verifica_login->close();
                $conexao->close();
                exit();
            }
            $stmt_verifica_login->close();
        }



        $stmt = $conexao->prepare("UPDATE pessoa SET login = ?,  nivel = ? WHERE id = ?");

        // Verifica se a preparação da consulta foi bem-sucedida
        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $conexao->error);
        }

        // Vincula os parâmetros e executa a consulta
        $stmt->bind_param("sii", $login, $nivel, $id);

        
        if (!$stmt->execute()) {
            echo "<script>alert('Erro ao atualizar dados da pessoa: " . $stmt->error . "'); window.location.href = 'admDoadores.php';</script>";
            $stmt->close();
            $conexao->close();
            exit();
        }

        $stmt->close();
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