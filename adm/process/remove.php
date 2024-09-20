<?php
    include_once("../session_login_nivel5.php");


    // Verifica se os parâmetros foram enviados na URL
    if (isset($_GET['id'])) {
        include_once("../../DAO.php");
    // Captura o valor do parâmetro 'id'
    $id = $_GET['id'];

    // Prepara a consulta SQL com um placeholder
    $stmt = $conexao->prepare("DELETE FROM pessoa WHERE id = ?");
    
    // Verifica se a consulta foi preparada corretamente
    if ($stmt === false) {
        die('Erro na preparação da consulta: ' . $conexao->error);
    }
    
    // Vincula o parâmetro à consulta (número inteiro)
    $stmt->bind_param("i", $id);
    
    // Executa a consulta
    if ($stmt->execute()) {
        echo "window.location.href = '../admDoadores.php';</script>";
    } else {
        echo "<script>alert('Erro ao deletar registro! ". $stmt->erro ."'); window.location.href = '../admDoadores.php';</script>";
    }
    
    
    
    // Fecha a declaração e a conexão
    $stmt->close();
    $conexao->close();
    }else {
        echo "ID não foi enviado.";
    }
?>