<?php
    session_set_cookie_params([
        'lifetime' => 3600,
        'path'     => '/',
        'domain'   => 'isfn.org.br',
        'secure'   => false,
        'httponly' => true
    ]);
    session_start();


    if (isset($_POST['submit']) && !empty($_POST['login']) && !empty($_POST['senha'])) {
        // Acessa o banco de dados
        include_once('../DAO.php');

        $login = $_POST['login'];
        $senha = $_POST['senha'];

        // Busca no banco de dados
        $stmt = $conexao->prepare("SELECT * FROM pessoa WHERE login = ?");

        // Verifica se a preparação da consulta foi bem-sucedida
        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $conexao->error);
        }

        // Vincula os parâmetros e executa a consulta
        $stmt->bind_param("s", $login);

        if (!$stmt->execute()) {
            echo "<script>alert('Erro ao verificar se existe login: " . $stmt->error . "'); window.location.href = 'login.php';</script>";
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
                $_SESSION['login'] = $row['login'];
                $_SESSION['nivel'] = $row['nivel'];
                echo "<script>alert('Login bem-sucedido!'); window.location.href = 'admDoadores.php';</script>";
            } else {
                unset($_SESSION['login']);
                session_destroy();
                echo "<script>alert('Senha incorreta!'); window.location.href = 'login.php';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Login não encontrado!'); window.location.href = 'login.php';</script>";
        }

        // Fecha a declaração e a conexão
        $stmt->close();
        $conexao->close();
    } else {
        // Se não tiver acessado a página enviando dados do formulário
        header('Location: login.php');
    }
?>
