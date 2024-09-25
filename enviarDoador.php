<?php

if (isset($_POST['nome']) && isset($_POST['doc'])) {
    // Capturando dados do formulário
    $nome = $_POST['nome'];
    $nasc = $_POST['nasc'];
    $doc = $_POST['doc'];
    $fone = $_POST['fone'];
    $email = $_POST['email'];
    $sexo = $_POST['sexo'];

    // Capturando dados do endereço (adicionando)
    $cep = $_POST['cep'];
    $pais = $_POST['pais'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $rua = $_POST['rua'];
    $setor = $_POST['setor'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];

    // Filtrando dados enviados (medida de segurança)
    $nome = trim($nome);
    $doc = trim($doc);
    $fone = trim($fone);
    $sexo = trim($sexo);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Incluindo conexão
    include_once("DAO.php");

    // Prepara a consulta para verificar se o CPF já está cadastrado
    $stmt = $conexao->prepare("SELECT id FROM pessoa WHERE doc = ?");
    $stmt->bind_param("s", $doc); // Vinculando o CPF
    $stmt->execute();
    $stmt->store_result(); // Armazena o resultado

    // Verifica se o CPF já existe
    if ($stmt->num_rows > 0) {
    // CPF já cadastrado
    echo "<script>alert('Este CPF já está cadastrado!'); window.history.back();</script>";
    }else {

        // Iniciando uma transação
        $conexao->begin_transaction();

        try {
            // Inserir na tabela pessoa
            $stmt = $conexao->prepare("INSERT INTO pessoa (doc, nome, nasc, fone, email, sexo) VALUES (?, ?, ?, ?, ?, ?)");
            if ($stmt === false) {
                throw new Exception("Erro na preparação da consulta: " . $conexao->error);
            }
            $stmt->bind_param("ssssss", $doc, $nome, $nasc, $fone, $email, $sexo);

            if (!$stmt->execute()) {
                throw new Exception("Erro ao inserir na tabela pessoa: " . $stmt->error);
            }

            // Obter o ID da pessoa inserida
            $id_pessoa = $conexao->insert_id;

            // Inserir na tabela endereco
            $stmt = $conexao->prepare("INSERT INTO endereco (id_pessoa, cep, pais, estado, cidade, rua, setor, numero, complemento) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            if ($stmt === false) {
                throw new Exception("Erro na preparação da consulta: " . $conexao->error);
            }
            $stmt->bind_param("issssssss", $id_pessoa, $cep, $pais, $estado, $cidade, $rua, $setor, $numero, $complemento);

            if (!$stmt->execute()) {
                throw new Exception("Erro ao inserir na tabela endereco: " . $stmt->error);
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
} else {
    retornarCadastro();
}

function retornarCadastro() {
    echo "<script>alert('Preencha todos os campos!'); window.location.href = 'formularioDoador.php';</script>";
    exit();
}

?>
