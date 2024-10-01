<?php
    include_once("sessionLogin.php");
    verificarNivel($_SESSION['nivel'], [7]);

    //Incluindo conexão
    
    if(isset($_POST['update']) && isset($_POST['doc'])){
        include_once("../../DAO.php");
        // Capturando dados do formulário
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
        
        // Atualiza os dados da tabela pessoa
        $stmt = $conexao->prepare("UPDATE pessoa SET doc = ?, nome = ?, nasc = ?, fone = ?, email = ?, sexo = ? WHERE id = ?");
        // Verifica se a preparação da consulta foi bem-sucedida
        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $conexao->error);
        }
        // Vincula os parâmetros e executa a consulta
        $stmt->bind_param("ssssssi", $doc, $nome, $nasc, $fone, $email, $sexo, $id);        
        if (!$stmt->execute()) {
            echo "<script>alert('Erro ao atualizar dados da pessoa: " . $stmt->error . "'); window.location.href = '../admDoadores.php';</script>";
            $stmt->close();
            $conexao->close();
            exit();
        }
        
        // Atualiza os dados da tabela endereco
        $stmt = $conexao->prepare("UPDATE endereco SET cep = ?, pais = ?, estado = ?, cidade = ?, rua = ?, setor = ?, numero = ?, complemento = ? WHERE id_pessoa = ?");
        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $conexao->error);
        }
        $stmt->bind_param("ssssssssi", $cep, $pais, $estado, $cidade, $rua, $setor, $numero, $complemento, $id);
        if (!$stmt->execute()) {
            echo "<script>alert('Erro ao atualizar dados do endereço: " . $stmt->error . "'); window.location.href = '../admDoadores.php';</script>";
            $stmt->close();
            $conexao->close();
            exit();
        }
        
        // Capturando dados do formulário se for PJ
        if (!empty($_POST['razao'])) {
            $razao = $_POST['razao'];
            $cnpj = $_POST['cnpj'];

            //Verifica se existe, para ou criar, ou fazer update
            $stmt = $conexao->prepare("SELECT * FROM pessoa_juridica WHERE id_pessoa = ?");
            $stmt->bind_param("i", $id);
            // Executando a consulta
            $stmt->execute();                
            $result = $stmt->get_result();                
            
            if($result->num_rows > 0){
                $stmt = $conexao->prepare("UPDATE pessoa_juridica SET razao = ?, cnpj = ? WHERE id_pessoa = ?");
                if ($stmt === false) {
                    die("Erro na preparação da consulta: " . $conexao->error);
                }
                $stmt->bind_param("ssi", $razao, $cnpj, $id);
    
                if (!$stmt->execute()) {
                    die("Erro ao inserir na tabela endereco: " . $stmt->error);
                }

            }else{
                $stmt = $conexao->prepare("INSERT INTO pessoa_juridica (id_pessoa, razao, cnpj) VALUES (?, ?, ?)");
                if ($stmt === false) {
                    die("Erro na preparação da consulta: " . $conexao->error);
                }
                $stmt->bind_param("iss", $id, $razao, $cnpj);
    
                if (!$stmt->execute()) {
                    die("Erro ao inserir na tabela endereco: " . $stmt->error);
                }
            }

        }


        // Fecha a conexão
        $stmt->close();
        $conexao->close();
        
        echo "<script>alert('Dados do Doador atualizados com sucesso!'); window.location.href = '../admDoadores.php';</script>";
    } else {
        // Se não tiver acessado a página enviando dados do formulário
        retornarAdm();
    }
    
    
    function retornarAdm(){
        echo "<script>alert('Houve algo de errado ao acesar a pagina!'); window.location.href = '../admDoadores.php';</script>";
        exit();
    }
    

    ?>