<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("Componentes/headBasic.html") ?>
    <title>ISFN | Formulario</title>
    <style>
        h2{
            font-size: 2em;
        }
        a{
            text-decoration: none;
            background-color: var(--azulPrincipal);
        }
    </style>
</head>

<body>

    <?php
    include('Componentes/menu.html');
    if (true) { 
    //(isset($_POST['name']) && isset($_POST['cpf']) && !empty($_POST['name'])) {

        $nome = addslashes($_POST['name']);
        $dataNascimento = addslashes($_POST['data-nascimento']);
        $cpf = addslashes($_POST['cpf']);
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);
        $cep = addslashes($_POST['cep']);
        $pais = addslashes($_POST['pais']);
        $uf = addslashes($_POST['uf']);
        $cidade = addslashes($_POST['cidade']);
        $rua = addslashes($_POST['rua']);
        $quadra = addslashes($_POST['quadra']);
        $lote = addslashes($_POST['lote']);
        $setor = addslashes($_POST['setor']);
        $complemento = addslashes($_POST['complemento']);
        $numero = addslashes($_POST['numero']);

        $to = "info@isfn.org.br";
        $subjet = "Formulario Colaborador";

        $body =
            "Nome: " . $nome . " \n" .
            "Data de Nascimento: " . $dataNascimento . " \n" .
            "CPF: " . $cpf . " \n" .
            "Telefone: " . $telefone . " \n" .
            "Email: " . $email . " \n \n" .
            "ENDERECO \n" .
            "CEP: " . $cep . " \n" .
            "Pais: " . $pais . " \n" .
            "Estado: " . $uf . " \n" .
            "Cidade: " . $cidade . " \n" .
            "Rua: " . $rua . " \n" .
            "Quadra: " . $quadra . " \n" .
            "Lote: " . $lote . " \n" .
            "Setor: " . $setor . " \n" .
            "Complemento: " . $complemento . " \n" .
            "Numero: " . $numero . " \n";

        $header = "From: $email" . "\n" . "Reply-To:" . $email . "\n" . "X=Mailer:PHP/" . phpversion();


        if (mail($to, $subjet, $body, $header)) {
            echo ('<h2>Inscrição realizada com sucesso! Logo entraremos em contato</h2>
                    <a href="index.php">Voltar para o Inicio</a>
                    ');
                } else {
                    echo ('<h2>Ocorreu um erro</h2>
                    ');
                }
            }
            
            ?>

</body>
</html>
<!--
<meta http-equiv="refresh" content="3; url=Doacoes.php">
<meta http-equiv="refresh" content="5; url=formularioDoador.php">
-->