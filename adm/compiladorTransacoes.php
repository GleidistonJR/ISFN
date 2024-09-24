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
        }
        #footerMaster{
            position: absolute;
            bottom: 0;
        }
    </style>
</head>
<body>
    <?php include("Componentes/menu.php");?>

    <section class="cadastro-extrato container mb-5">
        <h1 class="text-center">Cadastro Extrato</h1>
       
        <form action="process/processExtrato.php" method="POST" enctype="multipart/form-data">
            <label for="ofx_file" class="form-label">Escolha um arquivo OFX:</label>
            <div class="input-group">
                <input type="file" class="form-control" id="ofx_file" name="ofx_file" accept=".ofx">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>
   
        
    </section>

    <?php include("Componentes/footer.html");?>
</body>
</html>