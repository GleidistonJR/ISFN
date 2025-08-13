<?php
    include_once("sessionLogin.php");
    verificarNivel($_SESSION['nivel'], [7]);

    //Incluindo conexão
    
    if(isset($_POST['nomeAluno'])){
        include_once("../../DAO.php");

        // Capturando dados do formulário Responsavel
        // trim() serve para remover espaços em branco (e outros caracteres invisíveis) do início e do fim de uma string.
        $id = trim($_POST['id']);  
        $nomeResponsavel = trim($_POST['nomeResponsavel']);  
        $nascResponsavel = trim($_POST['nascResponsavel']);
        $docResponsavel = trim($_POST['docResponsavel']);
        $foneResponsavel = trim($_POST['foneResponsavel']);
        $emailResponsavel = trim($_POST['emailResponsavel'], FILTER_SANITIZE_EMAIL);
        $sexoResponsavel = trim($_POST['sexoResponsavel']);

        // Capturando dados do formulário Aluno
        $nomeAluno = trim($_POST['nomeAluno']);
        $nascAluno = trim($_POST['nascAluno']);
        $docAluno = trim($_POST['docAluno']);
        $foneAluno = trim($_POST['foneAluno']);
        $emailAluno = trim($_POST['emailAluno'], FILTER_SANITIZE_EMAIL);
        $sexoAluno = trim($_POST['sexoAluno']);
        $horarioAula = trim($_POST['horarioAula']);

        // Capturando dados do endereço (adicionando)
        $cep = trim($_POST['cep']);
        $pais = trim($_POST['pais']);
        $estado = trim($_POST['estado']);
        $cidade = trim($_POST['cidade']);
        $rua = trim($_POST['rua']);
        $setor = trim($_POST['setor']);
        $numero = trim($_POST['numero']);
        $complemento = trim($_POST['complemento']);
        


        // Atualiza os dados da tabela pessoa
        $stmt = $conexao->prepare("UPDATE precadastro SET
                nomeResponsavel = ?, nascResponsavel = ?, docResponsavel = ?,
                foneResponsavel = ?, emailResponsavel = ?, sexoResponsavel = ?,
                nomeAluno = ?, nascAluno = ?, docAluno = ?, foneAluno = ?, emailAluno = ?,
                sexoAluno = ?, horarioAula = ?, cep = ?, pais = ?, estado = ?, cidade = ?, 
                rua = ?, setor = ?, numero = ?, complemento = ?
            WHERE id = ?");


        // Verifica se a preparação da consulta foi bem-sucedida
        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $conexao->error);
        }
        // Vincula os parâmetros e executa a consulta
        $stmt->bind_param(
                "sssssssssssssssssssssi", // 21 campos do tipo string
                $nomeResponsavel, $nascResponsavel, $docResponsavel,
                $foneResponsavel, $emailResponsavel, $sexoResponsavel, $nomeAluno,
                $nascAluno, $docAluno, $foneAluno, $emailAluno, $sexoAluno, $horarioAula,
                $cep, $pais, $estado, $cidade, $rua, $setor, $numero, $complemento, $id
            ); 
        
        
        if (!$stmt->execute()) {
            echo "<script>alert('Erro ao atualizar dados: " . $stmt->error . "'); window.location.href = '../verPreCadastros.php';</script>";
        }
        
        

        // Fecha a conexão
        $stmt->close();
        $conexao->close();
        
        echo "<script>alert('Dados do Doador atualizados com sucesso!'); window.location.href = '../verPreCadastros.php';</script>";
    } else {
        // Se não tiver acessado a página enviando dados do formulário
        retornarAdm();
    }
    
    
    function retornarAdm(){
        echo "<script>alert('Houve algo de errado ao acesar a pagina!'); window.location.href = '../verPreCadastros.php';</script>";
        exit();
    }
    

    ?>