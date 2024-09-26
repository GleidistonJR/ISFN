<?php
    include_once("process/sessionLogin.php");
    verificarNivel($_SESSION['nivel'], [2,7]);

    // Verifica se os parâmetros foram enviados na URL
    if (isset($_GET['id'])) {
        include_once('../DAO.php');
        
        // Captura o valor do parâmetro 'id'
        $id = $_GET['id'];
        
        $stmt = $conexao->prepare("SELECT * FROM pessoa WHERE id=?");
        
        // Vinculando o parâmetro à consulta (número inteiro)
        $stmt->bind_param("i", $id);
        
        // Executando a consulta
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        
        if($result->num_rows > 0){
            
            while ($row = $result->fetch_assoc()) {
                $nome = $row['nome'];
                $nasc = $row['nasc'];
                $doc = $row['doc'];
                $fone = $row['fone'];
                $email = $row['email'];
                $naturalidade = $row['naturalidade'];
                $sexo = $row['sexo'];
            }
            
            
            // Prepara e executa a consulta para obter o endereço associado à pessoa
            $stmt_endereco = $conexao->prepare("SELECT * FROM endereco WHERE id_pessoa=?");
            $stmt_endereco->bind_param("i", $id);
            $stmt_endereco->execute();
            $result_endereco = $stmt_endereco->get_result();

            if ($result_endereco->num_rows > 0) {
                // Recupera os dados do endereço
                while ($row_endereco = $result_endereco->fetch_assoc()) {
                    $cep = $row_endereco['cep'];
                    $pais = $row_endereco['pais'];
                    $estado = $row_endereco['estado'];
                    $cidade = $row_endereco['cidade'];
                    $rua = $row_endereco['rua'];
                    $setor = $row_endereco['setor'];
                    $numero = $row_endereco['numero'];
                    $complemento = $row_endereco['complemento'];
                }
            } else {
                // Se não encontrar o endereço, você pode definir valores padrão ou lidar com o caso como preferir
                $cep = $pais = $estado = $cidade = $rua = $setor = $numero = $complemento = '';
            }
        }
        else{
            echo "<script>alert('ID não encontrado para edição!'); window.location.href = 'admDoadores.php';</script>";
        }
    
    }

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    
    <title>ISFN | Visualizar Doador</title>

    <?php
    include("Componentes/headBasic.html");
    ?>

<style>
    #edit-formulario-colaborador{
        padding-top: 150px;
    }
    #edit-formulario-colaborador .row{
        max-width: 100%;
    }
    .btn-voltar{
        margin-left: 33%;
        width: 33%;
    }
    @media (max-width: 992px) {
        .btn-voltar{
            margin-left: 0%;
            width: 100%;
        }
    }
</style>
</head>


<body>

    <?php include("Componentes/menu.php"); ?>


    <section class="container" id="edit-formulario-colaborador">
        <article class="row d-flex flex-column jusify-content-center align-items-center">
            <h2 class="text-center">Dados Doador <?php echo $nome?></h2>
            
            <form class="col-10 col-form m-5" method="POST" action="process/saveEdit.php">
                
                <div class="input-group mb-4">
                    <div class="col-12 col-md-8 mb-2 mb-md-4">
                        <label for="nome" class="form-label" id="nome">Nome:</label>
                        <input type="text" class="form-control" placeholder="Nome Completo" value="<?php echo $nome?>" name="nome" id="nome" disabled>
                    </div>
                    <div class="col-5 col-md-4 mb-2 mb-md-4">
                        <label for="data-nascimento" class="form-label">Nascimento:</label>
                        <input type="text" class="form-control" placeholder="00/00/0000" value="<?php echo $nasc?>" name="nasc" id="data-nascimento" disabled>
                    </div>
                    <div class="col-7 col-md-3">
                        <label for="cpf" class="form-label" id="cpf" >CPF:</label>
                        <input type="text" class="form-control" id="cpfInp" placeholder="000.000.000-00" value="<?php echo $doc?>" name="doc" id="cpf" disabled>
                    </div>

                    <div class="col-6 col-md-4">
                        <label for="telefone" class="form-label">Celular:</label>
                        <input type="text" class="form-control" name="fone" value="<?php echo $fone?>" id="telefone" placeholder="(00)00000-0000" disabled>
                    </div>

                    <div class="col-6 col-md-5">
                        <label for="email-inp" class="form-label">E-mail</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $email?>" id="email-inp" placeholder="nome@exemplo.com" disabled>
                    </div>
                </div>
                
                <div class="input-group mb-3">
                    <div class="col-6 mb-4">
                        <label class="form-label" for="sexo">Sexo</label>
                        <div class="form-check col-6">
                            <input class="form-check-input" type="radio" name="sexo" value="M" id="sexo" checked>
                            <label class="form-check-label" for="sexo"><?php echo($sexo == 'M') ? 'Masculino' : 'Feminino' ?></label>
                        </div>                        
                    </div>
                </div>

                <label for="endereco" class="form-label">Endereço</label>
                <div class="input-group mb-2">
                    <div class="input-group mb-3">
                        <div class="col-4 col-md-3 mb-1">
                            <input type="text" class="form-control" name="cep" id="cep" value="<?php echo $cep?>" placeholder="CEP" disabled>
                        </div>
                        <div class="col-8 col-md-3 mb-1">
                            <input type="text" class="form-control" name="pais" id="pais" value="<?php echo $pais?>" placeholder="pais" disabled>                          
                        </div>
                        <div class="col-4 col-md-3 mb-1">
                            <input type="text" class="form-control" name="estado" id="estado" value="<?php echo $estado?>" placeholder="Estado" disabled>
                        </div>
                        <div class="col-8 col-md-3 mb-1">
                            <input type="text" class="form-control" name="cidade" id="cidade" value="<?php echo $cidade?>" placeholder="Cidade" disabled>
                        </div>

                    </div>
                    <div class="input-group mb-0">
                        <div class="col-4 col-md-4 mb-1">
                            <input type="text" class="form-control" name="rua" id="rua" value="<?php echo $rua?>" placeholder="Rua" disabled>
                        </div>
                        
                        <div class="col-8 col-md-5 mb-1">
                            <input type="text" class="form-control" name="setor" id="setor" value="<?php echo $setor?>" placeholder="Setor" disabled>
                        </div>
                        <div class="col-3 col-md-3 mb-1">
                            <input type="text" class="form-control" name="numero" id="numero" value="<?php echo $numero?>" placeholder="Numero" disabled>
                        </div>
                        <div class="col-9 col-md-12 mb-1">
                            <input type="text" class="form-control" name="complemento" id="complemento" value="<?php echo $complemento?>" placeholder="Complemento" disabled>
                        </div>
                    </div>

                </div>

                <input type="hidden" name="id" value="<?php echo $id?>">

                <a class="btn btn-secondary btn-voltar px-5 mt-4" href="#" onclick="window.history.back()">Voltar</a>
               
            </form>
        </article>


    </section>
      
    <?php
    
    include("Componentes/footer.html");
    
    ?>
    <script>
        $("#data-nascimento").mask("00/00/0000");
        $("#telefone").mask("(00)00000-0000");
        $("#cep").mask("00000-000");
        $("#cpfInp").mask("000.000.000-00");
        
    </script>
    <script type="text/javascript" src="js/cep.js"></script>
</body>