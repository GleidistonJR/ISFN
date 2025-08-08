<?php
    include_once("adm/process/sessionLogin.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <title>ISFN | Pré-Cadastro Aluno</title>

    <?php
    include("Componentes/headBasic.html");
    ?>

    <link rel="stylesheet" href="css/formularioDoador.css?14">
</head>


<body>
    <?php
    include("Componentes/menu.php");
    ?>
    <section class="position-relative formulario-colaborador container-fluid" id="formulario-colaborador">



        <div class="position-fixed z-index-img" id="modalImg">
            <img class="img-fluid " src="img/aviso.png" alt="">
            <br>
            <button class="text-center btn btn-primary" onclick="fecharModal()">X</button>
        </div>



        <article class="row">
            <h2>Pré-Inscrição Aluno</h2>
            <form class="col-12 col-lg-8 col-form my-5 p-0" method="POST" action="enviarAluno.php">

                <h3 class="fs-5">Dados do Responsavel:</h3>
                <div class="input-group">
                    <div class="col-12 col-md-8 mb-2 mb-md-1">
                        <label for="nomeResponsavel" class="form-label" id="nomeResponsavel">Nome</label>
                        <input type="text" class="form-control" placeholder="Nome Completo" name="nomeResponsavel"
                            id="nomeResponsavel" required>
                    </div>
                    <div class="col-5 col-md-4 mb-2 mb-md-1">
                        <label for="nascResponsavel" class="form-label">Nascimento</label>
                        <input type="text" class="form-control" placeholder="00/00/0000" name="nascResponsavel"
                            id="nascResponsavel" required>
                    </div>
                    <div class="col-7 col-md-3 mb-2 mb-md-1">
                        <label for="docResponsavel" class="form-label">CPF</label>
                        <input type="text" class="form-control" id="cpfInp" placeholder="000.000.000-00"
                            name="docResponsavel" id="docResponsavel" required>
                    </div>

                    <div class="col-6 col-md-4 mb-2 mb-md-1">
                        <label for="foneResponsavel" class="form-label">Celular</label>
                        <input type="text" class="form-control" name="foneResponsavel" id="foneResponsavel"
                            placeholder="(00)00000-0000" required>
                    </div>

                    <div class="col-6 col-md-5 mb-2 mb-md-1 mb-2 mb-md-1">
                        <label for="emailResponsavel" class="form-label">E-mail</label>
                        <input type="email" class="form-control" name="emailResponsavel" id="emailResponsavel"
                            placeholder="nome@exemplo.com">
                    </div>
                </div>

                <div class="col-6 mb-4">
                    <label class="form-label" for="sexoResponsavel">Sexo*</label>
                    <div class="form-check col-6">
                        <input class="form-check-input" type="radio" name="sexoResponsavel" value="M"
                            id="masculinoResponsavel" checked>
                        <label class="form-check-label" for="masculinoResponsavel">Masculino</label>
                    </div>
                    <div class="form-check  col-6">
                        <input class="form-check-input" type="radio" name="sexoResponsavel" value="F"
                            id="femininoResponsavel">
                        <label class="form-check-label" for="femininoResponsavel">Feminino</label>
                    </div>
                </div>

                <h3 class="fs-5">Dados do Aluno:</h3>
                <div class="input-group">
                    <div class="col-12 col-md-8 mb-2 mb-md-1">
                        <label for="nomeAluno" class="form-label">Nome</label>
                        <input type="text" class="form-control" placeholder="Nome Completo" name="nomeAluno"
                            id="nomeAluno" required>
                    </div>
                    <div class="col-5 col-md-4 mb-2 mb-md-1">
                        <label for="nascAluno" class="form-label">Nascimento</label>
                        <input type="text" class="form-control" placeholder="00/00/0000" name="nascAluno" id="nascAluno"
                         required>
                    </div>
                    <div class="col-7 col-md-3 mb-2 mb-md-1">
                        <label for="cpf" class="form-label" id="docAluno">CPF</label>
                        <input type="text" class="form-control" placeholder="000.000.000-00" name="docAluno"
                            id="docAluno">
                    </div>

                    <div class="col-6 col-md-4 mb-2 mb-md-1">
                        <label for="foneAluno" class="form-label">Celular</label>
                        <input type="text" class="form-control" name="foneAluno" id="foneAluno"
                            placeholder="(00)00000-0000">
                    </div>

                    <div class="col-6 col-md-5 mb-2 mb-md-1">
                        <label for="emailAluno" class="form-label">E-mail</label>
                        <input type="email" class="form-control" name="emailAluno" id="emailAluno"
                            placeholder="nome@exemplo.com">
                    </div>
                </div>

                <div class="col-6 mb-4">
                    <label class="form-label" for="sexoAluno">Sexo*</label>
                    <div class="form-check col-6">
                        <input class="form-check-input" type="radio" name="sexoAluno" value="M" id="masculinoAluno"
                            checked>
                        <label class="form-check-label" for="masculinoAluno">Masculino</label>
                    </div>
                    <div class="form-check  col-6">
                        <input class="form-check-input" type="radio" name="sexoAluno" value="F" id="femininoAluno">
                        <label class="form-check-label" for="femininoAluno">Feminino</label>
                    </div>
                </div>

                <h3 class="fs-5">Endereço:</h3>
                <div class="input-group mb-4">
                    <div class="input-group">
                        <div class="col-4 col-md-3 mb-2">
                            <input type="text" class="form-control" name="cep" id="cep" placeholder="CEP" required>
                        </div>
                        <div class="col-8 col-md-3 mb-2">
                            <input type="text" class="form-control" name="pais" id="pais" placeholder="Pais" required>
                        </div>
                        <div class="col-4 col-md-3 mb-2">
                            <input type="text" class="form-control" name="estado" id="estado" placeholder="Estado"
                             required>
                        </div>
                        <div class="col-8 col-md-3 mb-2">
                            <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Cidade"
                             required>
                        </div>
                        <div class="col-4 col-md-4 mb-2">
                            <input type="text" class="form-control" name="rua" id="rua" placeholder="Rua" required>
                        </div>

                        <div class="col-8 col-md-5 mb-2">
                            <input type="text" class="form-control" name="setor" id="setor" placeholder="Setor"
                             required>
                        </div>
                        <div class="col-3 col-md-3 mb-2">
                            <input type="text" class="form-control" name="numero" id="numero" placeholder="Numero"
                            >
                        </div>
                        <div class="col-9 col-md-12 mb-2">
                            <input type="text" class="form-control" name="complemento" id="complemento"
                                placeholder="Complemento">
                        </div>
                    </div>
                </div>

                <input class="btn btn-enviar mt-2" type="submit" name="submit" value="Enviar">

            </form>

            <div class="col-12 col-lg-8 dificuldade-cadastro">
                <h5><a href="https://wa.me//5562992862544" target="_blank">Dificuldades com cadastro?</a></h5>
            </div>
        </article>


    </section>

    <?php
    
    include("Componentes/footer.html");
    
    ?>
</body>


<script>
    $("#nascResponsavel").mask("00/00/0000");
    $("#nascAluno").mask("00/00/0000");
    $("#foneResponsavel").mask("(00)00000-0000");
    $("#foneAluno").mask("(00)00000-0000");
    $("#cep").mask("00000-000");
    $("#docResponsavel").mask("000.000.000-00");
    $("#docAluno").mask("000.000.000-00");

    function validarCPF(cpf) {
        cpf = cpf.replace(/[^\d]+/g, ''); // Remove caracteres não numéricos
        if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) {
            return false; // Verifica se todos os números são iguais (caso inválido)
        }

        let soma = 0;
        let resto;

        // Validação do primeiro dígito verificador
        for (let i = 1; i <= 9; i++) {
            soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);
        }
        resto = (soma * 10) % 11;
        if ((resto === 10) || (resto === 11)) resto = 0;
        if (resto !== parseInt(cpf.substring(9, 10))) {
            return false;
        }

        soma = 0;

        // Validação do segundo dígito verificador
        for (let i = 1; i <= 10; i++) {
            soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);
        }
        resto = (soma * 10) % 11;
        if ((resto === 10) || (resto === 11)) resto = 0;
        if (resto !== parseInt(cpf.substring(10, 11))) {
            return false;
        }

        return true;
    }

    function validarFormulario() {
        const cpf = document.getElementById('docResponsavel').value;
        if (!validarCPF(cpf)) {
            alert('CPF inválido!');
            return false; // Impede o envio do formulário
        }
        return true; // Permite o envio do formulário
    }

    function fecharModal(){
        document.getElementById('modalImg').classList.add('d-none');
        
    }
</script>
<script type="text/javascript" src="js/cep.js"></script>

</html>