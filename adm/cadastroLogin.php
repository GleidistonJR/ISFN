<?php
    include_once("process/sessionLogin.php");
    verificarNivel($_SESSION['nivel'], [7]);

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
                $login = $row['login'];
                $senha = $row['senha'];
                $nivel = $row['nivel'];
                $nome = $row['nome'];
            }
            
        }else{
            echo "<script>alert('ID não encontrado para edição!'); window.location.href = 'admDoadores.php';</script>";
        }
    
    }

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    
    <title>ISFN | Cadastro Login</title>

    <?php
    include("Componentes/headBasic.html");
    ?>

<style>
    #formulario-cadastro-login{
        padding-top: 150px;
    }
    #formulario-cadastro-login .row{
        max-width: 100%;
    }
    .btn-voltar{
        margin-left: 18%;
        width: 30%;
    }
    .btn-enviar{
        margin-left: 5%;
        width: 30%;
    }
    @media (max-width: 992px) {
        .btn-voltar{
            margin-left: 0%;
            width: 100%;
        }
        .btn-enviar{
        margin-left: 0%;
        width: 100%;
        }
    }
</style>
</head>


<body>

    <?php include("Componentes/menu.php"); ?>


    <section class="container" id="formulario-cadastro-login">
        <article class="row d-flex flex-column jusify-content-center align-items-center">
            <h2 class="text-center">Cadastro Login <?php echo $nome?></h2>
            
            <form class="col-10 col-form m-5" method="POST" action="process/saveCadastroLogin.php">
                
                <div class="input-group justify-content-around mb-4">
                    <div class="col-12 col-md-4 mb-2 mb-md-4">
                        <label for="login" class="form-label">login:</label>
                        <input type="text" class="form-control" placeholder="login" value="<?php echo $login?>" name="login" id="login">
                    </div>
                    <div class="col-12 col-md-4 mb-2 mb-md-4">
                        <label for="senha" class="form-label">nova senha:</label>
                        <input type="text" class="form-control" placeholder="senha" name="senha" id="senha">
                    </div>
                    <div class="col-12 col-md-2 mb-2 mb-md-4">
                        <label for="nivel" class="form-label">nivel:</label>                    
                        <select class="form-control" name="nivel" value="<?php echo $nivel?>" id="nivel">
                            <option value="0" <?php echo($nivel == '0') ? 'selected=""' : '' ?>>0</option>
                            <option value="1" <?php echo($nivel == '1') ? 'selected=""' : '' ?>>1 Doador</option>
                            <option value="2" <?php echo($nivel == '2') ? 'selected=""' : '' ?>>2 Colaborador</option>                                
                            <option value="7" <?php echo($nivel == '7') ? 'selected=""' : '' ?>>7 Adiministrador</option>                                
                        </select>                    
                    </div>
                </div>

                <input type="hidden" name="id" value="<?php echo $id?>">

                <a class="btn btn-secondary btn-voltar px-5 mt-4" href="admDoadores.php">Voltar</a>
                <input class="btn btn-success btn-enviar px-5 mt-4" type="submit" name="update" value="Salvar Edição">

            </form>
        </article>


    </section>
      
    <?php include("Componentes/footer.html"); ?>
    
</body>