<?php
    include_once("sessionLogin.php");
    verificarNivel($_SESSION['nivel'], [7]);


    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $senha = $_POST['senha'];
        $id = $_POST['id'];

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
                //Senha Correta

                // Atualiza o status da inscrição para 'true'
                $consulta = $conexao->prepare("UPDATE precadastro SET confirmado = 1 - confirmado WHERE id = ?");

                // Verifica se a preparação da consulta foi bem-sucedida
                if ($consulta === false) {
                    die("Erro na preparação da consulta: " . $conexao->error);
                }

                // Vincula os parâmetros e executa a consulta
                $consulta->bind_param("i", $id);

                // Executa a consulta
                if ($consulta->execute()) {
                    echo "
                        <script> 
                            alert('Inscrição confirmada com sucesso!');
                            window.location.href = '../verPreInscricoes.php'; 
                        </script>
                    ";
                } else {
                    echo "
                        <script> 
                            alert('Erro ao confirmar inscrição: " . $consulta->error . "');
                            window.location.href = '../verPreInscricoes.php'; 
                        </script>
                    ";
                }


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
        $consulta->close();
        $conexao->close();
    }
?>
