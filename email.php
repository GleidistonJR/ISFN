<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("Componentes/headBasic.html") ?>
    <title>ISFN | Formulario</title>
    <style>
        h2 {
            padding-top: 150px;
            font-size: 2em;
            text-align: center;
        }

        a.voltar {
            display: block;
            font-size: 1.3em;
            padding: 10px 25px;
            border-radius: 25px;
            background-image: linear-gradient(180deg, var(--azulPrincipal), var(--azulSecundario));
            color: #fff;
            width: 33%;
            margin: 50px 0 330px 0;
            margin-left: 33%;
            transition: .3s;
            border: none;
            text-decoration: none;
            text-align: center;
        }
    </style>
</head>

<body>

    <?php
    include('Componentes/menu.html');
    if (isset($_POST['name']) && isset($_POST['cpf']) && !empty($_POST['name'])) {
        
        $nome = addslashes($_POST['name']);
        $dataNascimento = addslashes($_POST['data-nascimento']);
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
        
        $to = "info@isfn.org.br, gleidistonjunior@gmail.com, abenaziojunior@gmail.com";
        $subjet = "Formulario Colaborador ISFN";

        if (!empty($_POST['tipo'])) {
            $tipo = $_POST['tipo'];
            
            if ($tipo === 'fisico') {

                $cpf = addslashes($_POST['cpf']);

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

            }else{
                $cnpj = addslashes($_POST['cpf']);            
                $razao = addslashes($_POST['razaosocial']);

                $body =
                "Razão Social: " . $razao . " \n" .
                "Nome: " . $nome . " \n" .
                "Data de Nascimento: " . $dataNascimento . " \n" .
                "CNPJ: " . $cnpj . " \n" .
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
            }
        }
        

        $header = "From: $email" . "\n" . "Reply-To:" . $email . "\n" . "X=Mailer:PHP/" . phpversion();


        if (mail($to, $subjet, $body, $header)) {
            echo ('<h2>Inscrição realizada com sucesso! Logo entraremos em contato</h2>
                    <a class="voltar" href="index.php">Voltar para o Inicio</a>
                    <meta http-equiv="refresh" content="2; url=Doacoes.php">
                    ');
        } else {
            echo ('<h2>Ocorreu um erro</h2>
    <meta http-equiv="refresh" content="2; url=formularioDoador.php">
            ');
        }
    }

    include('Componentes/footer.html');
    ?>

</body>

</html>