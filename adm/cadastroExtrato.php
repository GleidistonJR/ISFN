<?php
include_once("process/sessionLogin.php");
verificarNivel($_SESSION['nivel'], [7]);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<title>ISFN | Cadastro Extrato</title>  
    <?php include("Componentes/headBasic.html");?>

    <style>
        section.cadastro-extrato{
            padding-top: 150px;
            min-height:60vh;
        }
        @media (max-width:720px){
            section.cadastro-extrato{
                padding-top: 150px;
                min-height:50vh;
            }
        }
        
    </style>
</head>
<body>
    <?php include("Componentes/menu.php");?>

    <section class="cadastro-extrato container mb-5">
        <h1 class="text-center mb-5">Cadastro Extrato</h1>
       
        <form action="process/processExtrato.php" method="POST" enctype="multipart/form-data">
            <label for="ofx_file" class="form-label mt-5">Escolha um arquivo OFX:</label>
            <div class="input-group">
                <input type="file" class="form-control" id="ofx_file" name="ofx_file" accept=".ofx">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>
   
        
    </section>

    <?php include("Componentes/footer.html");?>
</body>
</html>