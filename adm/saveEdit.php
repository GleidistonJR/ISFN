<?php
    include_once("session_login_nivel5.php");

    //Incluindo conexão
    
    if(isset($_POST['update']) && isset($_POST['doc'])){
        include_once("../DAO.php");
        // Capturando dados do formulário
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $nivel = $_POST['nivel'];
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $nasc = $_POST['nasc'];
        $doc = $_POST['doc'];
        $fone = $_POST['fone'];
        $email = $_POST['email'];
        $sexo = $_POST['sexo'];
        
        // Dados do endereço
        $cep = $_POST['cep'];
        $pais = $_POST['pais'];
        $estado = $_POST['estado'];
        $cidade = $_POST['cidade'];
        $rua = $_POST['rua'];
        $setor = $_POST['setor'];
        $numero = $_POST['numero'];
        $complemento = $_POST['complemento'];
        
        //Filtrando dados enviados (medida de segurança)
        $nome = trim($nome); // Remove espaços em branco no início e no fim
        $doc = trim($doc); 
        $fone = trim($fone); 
        $sexo = trim($sexo); 
        $email = filter_var($email, FILTER_SANITIZE_EMAIL); // Sanitiza o email (Remove caracteres não permitidos no e-mail.)
        if(isset($senha)){
            $senhaSegura = password_hash($senha, PASSWORD_DEFAULT ); // Criptografa a senha 
        }else{
            $senhaSegura = ''; 
        }

        
        $stmt = $conexao->prepare("UPDATE pessoa SET login = ?, senha = ?, nivel = ?, doc = ?, nome = ?, nasc = ?, fone = ?, email = ?, sexo = ? 
        WHERE id = ?");

        // Verifica se a preparação da consulta foi bem-sucedida
        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $conexao->error);
        }

        // Vincula os parâmetros e executa a consulta
        $stmt->bind_param("ssissssssi", $login, $senhaSegura, $nivel, $doc, $nome, $nasc, $fone, $email, $sexo, $id);

        
        if (!$stmt->execute()) {
            echo "<script>alert('Erro ao atualizar dados da pessoa: " . $stmt->error . "'); window.location.href = 'admDoadores.php';</script>";
            $stmt->close();
            $conexao->close();
            exit();
        }
        $stmt->close();
        
        // Atualiza os dados da tabela endereco
        $stmt = $conexao->prepare("UPDATE endereco SET cep = ?, pais = ?, estado = ?, cidade = ?, rua = ?, setor = ?, numero = ?, complemento = ? WHERE id_pessoa = ?");
        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $conexao->error);
        }
        $stmt->bind_param("ssssssssi", $cep, $pais, $estado, $cidade, $rua, $setor, $numero, $complemento, $id);
        if (!$stmt->execute()) {
            echo "<script>alert('Erro ao atualizar dados do endereço: " . $stmt->error . "'); window.location.href = 'admDoadores.php';</script>";
            $stmt->close();
            $conexao->close();
            exit();
        }
        $stmt->close();
        
        // Fecha a conexão
        $conexao->close();
        
        echo "<script>alert('Doador e endereço atualizados com sucesso!'); window.location.href = 'admDoadores.php';</script>";
    } else {
        // Se não tiver acessado a página enviando dados do formulário
        retornarAdm();
    }
    
    
    function retornarAdm(){
        echo "<script>alert('Houve algo de errado ao acesar a pagina!'); window.location.href = 'admDoadores.php';</script>";
        exit();
    }
    

    ?>