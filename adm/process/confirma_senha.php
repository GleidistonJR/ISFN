<?php
    include_once("../session_login_nivel5.php");


    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $senha = $_POST['senha'];
        $id = $_POST['id'];
        $arquivo = $_POST['arquivo'];

        include_once("../../DAO.php");
        // Busca no banco de dados
        $stmt = $conexao->prepare("SELECT * FROM pessoa WHERE login = ?");

        // Verifica se a preparação da consulta foi bem-sucedida
        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $conexao->error);
        }

        // Vincula os parâmetros e executa a consulta
        $stmt->bind_param("s", $_SESSION['login']);

        if (!$stmt->execute()) {
            echo "<script>alert('Erro ao verificar se existe login: " . $stmt->error . "'); window.location.href = '../login.php';</script>";
            $stmt->close();
            $conexao->close();
            exit();
        }

        // Obtem o resultado da consulta
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Verifica a senha
            $row = $result->fetch_assoc();
            if (password_verify($senha, $row['senha'])) {
                // Redireciona para a página de alteração de dados
                header('Location: ../'. $arquivo .'?id=' .$id. '');
                exit();
                
            } else {
                //senha incorreta
                echo "<script>
                alert('Senha incorreta!'); 
                window.history.back();
                </script>";
                exit();
            }
        } else {
            echo "<script>alert('Login não encontrado!'); window.location.href = '../login.php';</script>";
        }

        // Fecha a declaração e a conexão
        $stmt->close();
        $conexao->close();
    }
?>
