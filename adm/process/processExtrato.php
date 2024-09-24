<?php
// Inclui o arquivo DAO.php que contém a conexão com o banco de dados
require_once '../../DAO.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['ofx_file'])) {
    $file = $_FILES['ofx_file']['tmp_name'];

    if (is_uploaded_file($file)) {
        // Lê o conteúdo do arquivo OFX
        $content = file_get_contents($file);

        // Extraí as transações usando regex para capturar os dados necessários
        preg_match_all('/<STMTTRN>.*?<TRNTYPE>(.*?)<\/TRNTYPE>.*?<DTPOSTED>(.*?)<\/DTPOSTED>.*?<TRNAMT>(.*?)<\/TRNAMT>.*?<FITID>(.*?)<\/FITID>.*?<MEMO>(.*?)<\/MEMO>.*?<\/STMTTRN>/s', $content, $matches, PREG_SET_ORDER);

        // Loop pelas transações encontradas
        foreach ($matches as $transaction) {
            $tipo = $transaction[1];  // Tipo da transação (CREDIT/DEBIT)
            $data = substr($transaction[2], 0, 8);  // Extrai a data no formato YYYYMMDD
            $valor = $transaction[3];  // Valor da transação
            $fitid = $transaction[4];  // Identificador único da transação (FITID)
            $memo = $transaction[5];  // Memo completo (contém descrição, nome e documento)

            // Usar regex para capturar descrição, nome e documento do campo MEMO
            preg_match('/^(.*?) - (.*?) - (.*?)$/', $memo, $memoDetails);

            // Atribuir valores extraídos
            $descricao = isset($memoDetails[1]) ? $memoDetails[1] : null;  // Descrição da transação
            $nome = isset($memoDetails[2]) ? $memoDetails[2] : null;  // Nome da pessoa
            $documento = isset($memoDetails[3]) ? $memoDetails[3] : null;  // Documento (CPF/CNPJ)

            // Formatar a data para o formato desejado (YYYY-MM-DD)
            $dataFormatada = substr($data, 0, 4) . '-' . substr($data, 4, 2) . '-' . substr($data, 6, 2);

            // Verificar se o FITID já existe no banco de dados
            $checkQuery = "SELECT COUNT(*) FROM extrato WHERE fitid = ?";
            if ($stmtCheck = $conexao->prepare($checkQuery)) {
                $stmtCheck->bind_param("s", $fitid);
                $stmtCheck->execute();
                $stmtCheck->bind_result($count);
                $stmtCheck->fetch();
                $stmtCheck->close();

                if ($count > 0) {
                    // Se a transação já existe, pular a inserção
                    echo "Transação com FITID $fitid já inserida.<br>";
                    continue;
                }
            } else {
                echo "Erro ao verificar duplicidade: " . $conexao->error . "<br>";
            }

            // Preparar a query de inserção no banco de dados
            $sql = "INSERT INTO extrato (data, descricao, nome, documento, valor, fitid) VALUES (?, ?, ?, ?, ?, ?)";

            // Usar prepared statement para evitar SQL Injection
            if ($stmt = $conexao->prepare($sql)) {
                // Associar os parâmetros à consulta
                $stmt->bind_param("ssssds", $dataFormatada, $descricao, $nome, $documento, $valor, $fitid);

                // Executar a query
                if ($stmt->execute()) {
                    echo "<script>alert('Extrato inserido com sucesso!'); window.location.href = '../transparencia.php';</script>";
                } else {
                    echo "Erro ao inserir transação: " . $stmt->error . "<br>";
                }

                // Fechar o statement
                $stmt->close();
            } else {
                echo "Erro ao preparar a consulta: " . $conexao->error . "<br>";
            }
        }
    } else {
        echo "Erro ao fazer upload do arquivo.";
    }
} else {
    echo "Nenhum arquivo foi enviado.";
}
?>
