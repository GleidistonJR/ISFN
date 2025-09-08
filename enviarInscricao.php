<?php
//Verifica se foi enviado os dados
if (isset($_POST['nomeResponsavel']) && isset($_POST['docResponsavel'])) { 
    
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

    $formNascimento = DateTime::createFromFormat('d/m/Y', $nascAluno);
    $hoje = new DateTime();

    $idadeAluno = $formNascimento->diff($hoje);
    $anos = $idadeAluno->y;

    if ($anos > 13 or $anos < 10) {
        echo "<script>alert('O aluno deve ter entre 10 e 13 anos!'); window.history.back();</script>";
        exit();
    }

 
    // Incluindo conexão ao banco de dados
    include_once("DAO.php");

    // Prepara a consulta para verificar se o Aluno ja esta cadastrado
    $stmt = $conexao->prepare("SELECT id FROM precadastro WHERE nomeAluno = ?");
    $stmt->bind_param("s", $nomeAluno); 
    $stmt->execute();
    $stmt->store_result(); // Armazena o resultado

    // Verifica se o documento já existe
    if ($stmt->num_rows > 0) {
        // Aluno já cadastrado
        echo "<script>alert('Este aluno já foi cadastrado!'); window.history.back();</script>";
    }else {

        // Inserir na tabela pessoa
        $stmt = $conexao->prepare("INSERT INTO precadastro (
        nomeResponsavel, nascResponsavel, docResponsavel,
            foneResponsavel, emailResponsavel, sexoResponsavel,
            nomeAluno, nascAluno, docAluno, foneAluno, emailAluno,
            sexoAluno, horarioAula, cep, pais, estado, cidade, rua, setor, numero, complemento 
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        if ($stmt === false) {
            throw new Exception("Erro na preparação da consulta: " . $conexao->error);
        }

        $stmt->bind_param(
            "sssssssssssssssssssss", // 21 campos do tipo string
            $nomeResponsavel, $nascResponsavel, $docResponsavel,
            $foneResponsavel, $emailResponsavel, $sexoResponsavel, $nomeAluno,
            $nascAluno, $docAluno, $foneAluno, $emailAluno, $sexoAluno, $horarioAula,
            $cep, $pais, $estado, $cidade, $rua, $setor, $numero, $complemento
        );



        if (!$stmt->execute()) {
            throw new Exception("Erro ao inserir na tabela precadastro: " . $stmt->error);
            $stmt->close();
            $conexao->close();
        }

        echo "<script>window.location.href = 'cadastradoComSucesso.php';</script>";

        $stmt->close();
        $conexao->close();
    }
}
else {
    echo "<script>
            alert('Preencha todos os campos!'); 
            window.location.href = 'preInscricaoAluno.php';
        </script>";
    exit();
}
?>
