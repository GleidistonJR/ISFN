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
        include_once('../../DAO.php');

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
                //armazenando na seção dados
                $_SESSION['login'] = $row['login'];
                $_SESSION['nivel'] = $row['nivel'];
                $nomeCompleto = $row['nome'];
                $partesDoNome = explode(' ', trim($nomeCompleto));
                //Armazenando na seção apenas o primeiro nome
                $_SESSION['nome'] = $partesDoNome[0];
                
                if(isset($_SESSION['login']) && $_SESSION['nivel'] == 0){
                    //logado nivel 0
                    header('Location: ../../index.php');
                }else if(isset($_SESSION['login']) && $_SESSION['nivel'] == 1){
                    //logado nivel 1
                    //header('Location: ../transparencia.php');
                    header('Location: ../../index.php');
                }else if(isset($_SESSION['login']) && $_SESSION['nivel'] == 2){
                    //logado com nivel baixo
                    //header('Location: ../transparencia.php');
                    header('Location: ../../index.php');
                }else if(isset($_SESSION['login']) && $_SESSION['nivel'] == 7){
                    //logado com nivel 7
                    header('Location: ../admDoadores.php');
                }
                
                //Inserir historico de login
                // Busca no banco de dados
                $conn = $conexao->prepare("INSERT INTO historico (id_usuario) VALUES (?);");
                
                //Verifica se ocorreu erro na conexão
                if ($conn === false) {
                    throw new Exception("Erro na preparação da consulta: " . $conexao->error);
                }
                $conn->bind_param("i", $row['id']);
    
                if (!$conn->execute()) {
                    throw new Exception("Erro ao inserir na tabela historico: " . $conn->error);
                }

                                
            } else {
                //senha incorreta
                unset($_SESSION['login']);
                session_destroy();
                echo "<script>alert('Senha incorreta!'); window.location.href = '../login.php';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Login não encontrado!'); window.location.href = '../login.php';</script>";
        }

        // Fecha as declarações e a conexão
        $conn->close();
        $stmt->close();
        $conexao->close();
    } else {
        // Se não tiver acessado a página enviando dados do formulário
        header('Location: ../login.php');
    }
?>
