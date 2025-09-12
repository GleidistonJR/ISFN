<?php
    include_once("process/sessionLogin.php");
    verificarNivel($_SESSION['nivel'], [7]);

    // Verifica se os parâmetros foram enviados na URL
    if (isset($_GET['id'])) {
        include_once('../DAO.php');
        
        // Captura o valor do parâmetro 'id'
        $id = $_GET['id'];
        
        $stmt = $conexao->prepare("SELECT * FROM pre_inscricao WHERE id=?");
        
        // Vinculando o parâmetro à consulta (número inteiro)
        $stmt->bind_param("i", $id);
        
        // Executando a consulta
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        
        if($result->num_rows > 0){
            
            while ($row = $result->fetch_assoc()) {
                $nomeResponsavel = $row['nomeResponsavel'];
                $nascResponsavel = $row['nascResponsavel'];
                $docResponsavel = $row['docResponsavel'];
                $foneResponsavel = $row['foneResponsavel'];
                $emailResponsavel = $row['emailResponsavel'];
                $sexoResponsavel = $row['sexoResponsavel'];
                
                $cep = $row['cep'];
                $pais = $row['pais'];
                $estado = $row['estado'];
                $cidade = $row['cidade'];
                $rua = $row['rua'];
                $setor = $row['setor'];
                $numero = $row['numero'];
                $complemento = $row['complemento'];
                
                $nomeAluno = $row['nomeAluno'];
                $nascAluno = $row['nascAluno'];
                $docAluno = $row['docAluno'];
                $foneAluno = $row['foneAluno'];
                $emailAluno = $row['emailAluno'];
                $sexoAluno = $row['sexoAluno'];
                $horarioAula = $row['horarioAula'];
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
    
    <title>ISFN | Editar Pré-Inscrição</title>

    <?php
    include("../Componentes/headBasic.html");
    ?>

<style>
    #edit-formulario-colaborador{
        padding-top: 150px;
    }
    #edit-formulario-colaborador .row{
        max-width: 100%;
    }
    .btn-voltar{
        margin-left: 15%;
        width: 33%;
    }
    .btn-enviar{
        margin-left: 5%;
        width: 33%;
    }
    @media (max-width: 992px) {
        .btn-voltar{
            margin-left: 29%;
            width: 100%;
        }
        .btn-enviar{
        margin-left: 5%;
        width: 100%;
        }
    }
</style>
</head>


<body>

    <?php include("../Componentes/menu.php"); ?>


    <section class="container" id="edit-formulario-colaborador">
        <article class="row d-flex flex-column jusify-content-center align-items-center">
            <h2 class="text-center">Editar Pré-Inscrição </h2>
            
            <form class="col-12 col-lg-8 col-form my-5 p-0" method="POST" action="process/saveEditIncricao.php">
                
                <h3 class="fs-5">Dados do Responsavel:</h3>
                <div class="input-group">
                    <div class="col-12 col-md-8 mb-2 mb-md-1">
                        <label for="nomeResponsavel" class="form-label" id="nomeResponsavel">Nome</label>
                        <input type="text" class="form-control" placeholder="Nome Completo" value="<?php echo $nomeResponsavel?>" name="nomeResponsavel" id="nomeResponsavel">
                    </div>
                    <div class="col-5 col-md-4 mb-2 mb-md-1">
                        <label for="nascResponsavel" class="form-label">Nascimento</label>
                        <input type="text" class="form-control" placeholder="00/00/0000" value="<?php echo $nascResponsavel?>" name="nascResponsavel" id="nascResponsavel">
                    </div>
                    <div class="col-7 col-md-3 mb-2 mb-md-1">
                        <label for="docResponsavel" class="form-label">CPF</label>
                        <input type="text" class="form-control" placeholder="000.000.000-00" value="<?php echo $docResponsavel?>" name="docResponsavel" id="docResponsavel">
                    </div>

                    <div class="col-6 col-md-4 mb-2 mb-md-1">
                        <label for="foneResponsavel" class="form-label">Celular</label>
                        <input type="text" class="form-control" name="foneResponsavel" value="<?php echo $foneResponsavel?>" id="foneResponsavel" placeholder="(00)00000-0000">
                    </div>

                    <div class="col-6 col-md-5 mb-2 mb-md-1 mb-2 mb-md-1">
                        <label for="emailResponsavel" class="form-label">E-mail</label>
                        <input type="email" class="form-control" name="emailResponsavel" value="<?php echo $emailResponsavel?>" id="emailResponsavel" placeholder="nome@exemplo.com">
                    </div>
                </div>
                

                 <div class="col-6 mb-4">
                    <label class="form-label" for="sexoResponsavel">Sexo</label>
                    <div class="form-check col-6">
                        <input class="form-check-input" type="radio" name="sexoResponsavel" value="M"
                            id="masculinoResponsavel"<?php echo($sexoResponsavel == 'M') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="masculinoResponsavel">Masculino</label>
                    </div>
                    <div class="form-check  col-6">
                        <input class="form-check-input" type="radio" name="sexoResponsavel" value="F"
                            id="femininoResponsavel" <?php echo($sexoResponsavel == 'F') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="femininoResponsavel">Feminino</label>
                    </div>
                </div>

                
                <h3 class="fs-5">Dados do Aluno:</h3>
                <div class="input-group">
                    <div class="col-12 col-md-8 mb-2 mb-md-1">
                        <label for="nomeAluno" class="form-label">Nome</label>
                        <input type="text" class="form-control" placeholder="Nome Completo" value="<?php echo $nomeAluno?>" name="nomeAluno" id="nomeAluno">
                    </div>
                    <div class="col-5 col-md-4 mb-2 mb-md-1">
                        <label for="nascAluno" class="form-label">Nascimento</label>
                        <input type="text" class="form-control" placeholder="00/00/0000" value="<?php echo $nascAluno?>" name="nascAluno" id="nascAluno">
                    </div>
                    <div class="col-7 col-md-3 mb-2 mb-md-1">
                        <label for="docAluno" class="form-label" >CPF</label>
                        <input type="text" class="form-control" placeholder="000.000.000-00" value="<?php echo $docAluno?>" name="docAluno" id="docAluno">
                    </div>

                    <div class="col-6 col-md-4 mb-2 mb-md-1">
                        <label for="foneAluno" class="form-label">Celular</label>
                        <input type="text" class="form-control" name="foneAluno" value="<?php echo $foneAluno?>" id="foneAluno" placeholder="(00)00000-0000">
                    </div>

                    <div class="col-6 col-md-5 mb-2 mb-md-1">
                        <label for="emailAluno" class="form-label">E-mail</label>
                        <input type="email" class="form-control" name="emailAluno" value="<?php echo $emailAluno?>" id="emailAluno" placeholder="nome@exemplo.com">
                    </div>
                </div>


                <div class="col-6 mb-4">
                    <label class="form-label" for="sexoAluno">Sexo*</label>
                    <div class="form-check col-6">
                        <input class="form-check-input" type="radio" name="sexoAluno" value="M" id="masculinoAluno"
                            <?php echo($sexoAluno == 'M') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="masculinoAluno">Masculino</label>
                    </div>
                    <div class="form-check  col-6">
                        <input class="form-check-input" type="radio" name="sexoAluno" value="F" id="femininoAluno"
                        <?php echo($sexoAluno == 'F') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="femininoAluno">Feminino</label>
                    </div>
                </div>


                <div class="col-12 mb-4">
                    <label class="form-label" for="horarioAula">Período escolhido:</label>
                    <div class="form-check col-12">
                        <input class="form-check-input" type="radio" name="horarioAula" value="M" id="Matutino"
                            <?php echo($horarioAula == 'M') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="Matutino">Matutino (Sábado das 8h às 11h)</label>
                    </div>
                    <div class="form-check  col-12">
                        <input class="form-check-input" type="radio" name="horarioAula" value="V" id="Vespertino" 
                        <?php echo($horarioAula == 'V') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="Vespertino">Vespertino (Sábado das 14h às 17h)</label>
                    </div>
                </div>


                <h3 class="fs-5">Endereço:</h3>
                <div class="input-group mb-4">
                    <div class="input-group">
                        <div class="col-4 col-md-3 mb-2">
                            <input type="text" class="form-control" name="cep" id="cep" value="<?php echo $cep?>" placeholder="CEP">
                        </div>
                        <div class="col-8 col-md-3 mb-2">
                            <input type="text" class="form-control" name="pais" id="pais" value="<?php echo $pais?>" placeholder="pais">                          
                        </div>
                        <div class="col-4 col-md-3 mb-2">
                            <input type="text" class="form-control" name="estado" id="estado" value="<?php echo $estado?>" placeholder="Estado">
                        </div>
                        <div class="col-8 col-md-3 mb-2">
                            <input type="text" class="form-control" name="cidade" id="cidade" value="<?php echo $cidade?>" placeholder="Cidade">
                        </div>
                        <div class="col-4 col-md-4 mb-2">
                            <input type="text" class="form-control" name="rua" id="rua" value="<?php echo $rua?>" placeholder="Rua">
                        </div>
                        
                        <div class="col-8 col-md-5 mb-2">
                            <input type="text" class="form-control" name="setor" id="setor" value="<?php echo $setor?>" placeholder="Setor">
                        </div>
                        <div class="col-3 col-md-3 mb-2">
                            <input type="text" class="form-control" name="numero" id="numero" value="<?php echo $numero?>" placeholder="Numero">
                        </div>
                        <div class="col-9 col-md-12 mb-2">
                            <input type="text" class="form-control" name="complemento" id="complemento" value="<?php echo $complemento?>" placeholder="Complemento">
                        </div>
                    </div>
                </div>


                <input type="hidden" name="id" value="<?php echo $id?>">


                <a class="btn btn-secondary btn-voltar px-5 mt-4" href="/adm/verPreInscricoes.php">Voltar</a>
                <input class="btn btn-success btn-enviar px-5 mt-4" type="submit" name="update" value="Salvar Edição">
                
            </form>
        </article>


    </section>
      
    <?php
    
    include("../Componentes/footer.html");
    
    ?>
    <script>
    $("#nascResponsavel").mask("00/00/0000");
    $("#nascAluno").mask("00/00/0000");
    $("#foneResponsavel").mask("(00)00000-0000");
    $("#foneAluno").mask("(00)00000-0000");
    $("#cep").mask("00000-000");
    $("#docResponsavel").mask("000.000.000-00");
    $("#docAluno").mask("000.000.000-00");

    </script>
    <script type="text/javascript" src="/js/cep.js?17"></script>
</body>