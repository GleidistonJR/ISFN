<?php

if (isset($_POST['nomeResponsavel']) && isset($_POST['docResponsavel'])) { //Verifica se foi enviado os dados
    
    // Capturando dados do formulário Responsavel
    // trim() serve para remover espaços em branco (e outros caracteres invisíveis) do início e do fim de uma string.
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

    // Capturando dados do endereço (adicionando)
    $cep = trim($_POST['cep']);
    $pais = trim($_POST['pais']);
    $estado = trim($_POST['estado']);
    $cidade = trim($_POST['cidade']);
    $rua = trim($_POST['rua']);
    $setor = trim($_POST['setor']);
    $numero = trim($_POST['numero']);
    $complemento = trim($_POST['complemento']);


 
    // Incluindo conexão
    include_once("DAO.php");

    // Prepara a consulta para verificar se o documento já está cadastrado
    $stmt = $conexao->prepare("SELECT id FROM preCadastro WHERE docResponsavel = ?");
    $stmt->bind_param("s", $docResponsavel); // Vinculando o doc
    $stmt->execute();
    $stmt->store_result(); // Armazena o resultado

    // Verifica se o documento já existe
    if ($stmt->num_rows > 0) {
    // doc já cadastrado
    echo "<script>alert('Este documento já está cadastrado!'); window.history.back();</script>";
    }else {

        // Iniciando uma transação
        $conexao->begin_transaction();

        try {
            // Inserir na tabela pessoa
            $stmt = $conexao->prepare("INSERT INTO preCadastro (
            nomeResponsavel, nascResponsavel, docResponsavel,
             foneResponsavel, emailResponsavel, sexoResponsavel,
              nomeAluno, nascAluno, docAluno, foneAluno, emailAluno,
              sexoAluno, cep, pais, estado, cidade, rua, setor, numero, complemento 
              ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            if ($stmt === false) {
                throw new Exception("Erro na preparação da consulta: " . $conexao->error);
            }

            $stmt->bind_param(
                "ssssssssssssssssssss", // 20 campos do tipo string
                $nomeResponsavel, $nascResponsavel, $docResponsavel,
                $foneResponsavel, $emailResponsavel, $sexoResponsavel,
                $nomeAluno, $nascAluno, $docAluno, $foneAluno, $emailAluno, $sexoAluno,
                $cep, $pais, $estado, $cidade, $rua, $setor, $numero, $complemento
            );



            if (!$stmt->execute()) {
                throw new Exception("Erro ao inserir na tabela pessoa: " . $stmt->error);
            }

           
            // Commit da transação
            $conexao->commit();

            echo "<script>window.location.href = 'cadastradoComSucesso.php';</script>";

            $stmt->close();
            $conexao->close();
        } catch (Exception $e) {
            // Rollback em caso de erro
            $conexao->rollback();
            echo "Erro: " . $e->getMessage();
            $conexao->close();
        }
    }
}
else {
    retornarCadastro();
}

function retornarCadastro() {
    echo "<script>alert('Preencha todos os campos!'); window.location.href = 'formularioDoador.php';</script>";
    exit();
}
?>
