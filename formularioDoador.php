<!DOCTYPE html>
<html lang="pt-br">

<head>
    
    <title>ISFN | Cadastro Colaborador</title>

    <?php
    include("Componentes/headBasic.html");
    ?>

    <link rel="stylesheet" href="css/formularioDoador.css?7">
</head>


<body>
    <?php
    include("Componentes/menu.html");
    ?>
    <section class="formulario-colaborador container-fluid" id="formulario-colaborador">
        <article class="row">
            <h2>Cadastro Colaborador Mensal</h2>
            <form class="col-12 col-md-5 col-form" method="POST" action="./email.php">

                <div class="col-12 mb-2 mb-md-4 radio-pessoas">
                    <div class="col-6 col-md-5 mb-2 mb-md-4">
                        <input class="form-check-input" type="radio" name="tipo" value="fisico" id="PessoaFisica" checked>
                        <label class="form-check-label PessoaFisica" for="PessoaFisica">Pessoa Física</label>
                    </div>
                    <div class="col-6 col-md-5 mb-2 mb-md-4">
                        <input class="form-check-input" type="radio" name="tipo" value="juridico" id="PessoaJuridica">
                        <label class="form-check-label" for="PessoaJuridica">Pessoa Jurídica</label>
                    </div>
                </div>

                <div class="col-12 razao_social mb-3">
                    <label for="razao" class="form-label" id="razaosocial" >Razão Social:</label>
                    <input type="text" class="form-control" placeholder="Razão Social" aria-label="Nome" aria-describedby="basic-addon1" name="razaosocial" id="razaosocial" >
                </div>

                <div class="input-group mb-4">
                    <div class="col-12 col-md-8 mb-2 mb-md-4">
                        <label for="nome" class="form-label" id="nome" name="nomeLabel">Nome:</label>
                        <input type="text" class="form-control" placeholder="Nome Completo" aria-label="Nome" aria-describedby="basic-addon1" name="name" id="nome" required>
                    </div>
                    <div class="col-5 col-md-4 mb-2 mb-md-4">
                        <label for="data-nascimento" class="form-label">Nascimento:</label>
                        <input type="text" class="form-control" placeholder="00/00/0000" aria-label="data-nascimento" aria-describedby="basic-addon1" name="data-nascimento" id="data-nascimento" required>
                    </div>
                    <div class="col-7 col-md-4">
                        <label for="cpf" class="form-label" id="cpf" >CPF:</label>
                        <input type="text" class="form-control" id="cpfInp" placeholder="000.000.000-00" aria-label="cpf" aria-describedby="basic-addon1" name="cpf" id="cpf" required>
                    </div>

                    <div class="col-6 col-md-3">
                        <label for="telefone" class="form-label">Telefone:</label>
                        <input type="text" class="form-control" name="telefone" id="telefone" placeholder="(00)0 0000-0000" required>
                    </div>

                    <div class="col-5">
                        <label for="email-inp" class="form-label">E-mail</label>
                        <input type="email" class="form-control" name="email" id="email-inp" placeholder="nome@exemplo.com" >
                    </div>
                </div>




                <label for="endereco" class="form-label">Endereço</label>
                <div class="input-group mb-2">
                    <div class="input-group mb-3">
                        <div class="col-3 ">
                            <input type="text" class="form-control" name="cep" id="cep" placeholder="CEP" required>
                        </div>
                        <div class="col-3">
                            <select class="form-control" name="pais" id="pais" required>
                                <option value="África do Sul">África do Sul</option>
                                <option value="Albânia">Albânia</option>
                                <option value="Alemanha">Alemanha</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Anguilla">Anguilla</option>
                                <option value="Antigua">Antigua</option>
                                <option value="Arábia Saudita">Arábia Saudita</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Armênia">Armênia</option>
                                <option value="Aruba">Aruba</option>
                                <option value="Austrália">Austrália</option>
                                <option value="Áustria">Áustria</option>
                                <option value="Azerbaijão">Azerbaijão</option>
                                <option value="Bahamas">Bahamas</option>
                                <option value="Bahrein">Bahrein</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Barbados">Barbados</option>
                                <option value="Bélgica">Bélgica</option>
                                <option value="Benin">Benin</option>
                                <option value="Bermudas">Bermudas</option>
                                <option value="Botsuana">Botsuana</option>
                                <option value="Brasil" selected="">Brasil</option>
                                <option value="Brunei">Brunei</option>
                                <option value="Bulgária">Bulgária</option>
                                <option value="Burkina Fasso">Burkina Fasso</option>
                                <option value="botão">botão</option>
                                <option value="Cabo Verde">Cabo Verde</option>
                                <option value="Camarões">Camarões</option>
                                <option value="Camboja">Camboja</option>
                                <option value="Canadá">Canadá</option>
                                <option value="Cazaquistão">Cazaquistão</option>
                                <option value="Chade">Chade</option>
                                <option value="Chile">Chile</option>
                                <option value="China">China</option>
                                <option value="Cidade do Vaticano">Cidade do Vaticano</option>
                                <option value="Colômbia">Colômbia</option>
                                <option value="Congo">Congo</option>
                                <option value="Coréia do Sul">Coréia do Sul</option>
                                <option value="Costa do Marfim">Costa do Marfim</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Croácia">Croácia</option>
                                <option value="Dinamarca">Dinamarca</option>
                                <option value="Djibuti">Djibuti</option>
                                <option value="Dominica">Dominica</option>
                                <option value="EUA">EUA</option>
                                <option value="Egito">Egito</option>
                                <option value="El Salvador">El Salvador</option>
                                <option value="Emirados Árabes">Emirados Árabes</option>
                                <option value="Equador">Equador</option>
                                <option value="Eritréia">Eritréia</option>
                                <option value="Escócia">Escócia</option>
                                <option value="Eslováquia">Eslováquia</option>
                                <option value="Eslovênia">Eslovênia</option>
                                <option value="Espanha">Espanha</option>
                                <option value="Estônia">Estônia</option>
                                <option value="Etiópia">Etiópia</option>
                                <option value="Fiji">Fiji</option>
                                <option value="Filipinas">Filipinas</option>
                                <option value="Finlândia">Finlândia</option>
                                <option value="França">França</option>
                                <option value="Gabão">Gabão</option>
                                <option value="Gâmbia">Gâmbia</option>
                                <option value="Gana">Gana</option>
                                <option value="Geórgia">Geórgia</option>
                                <option value="Gibraltar">Gibraltar</option>
                                <option value="Granada">Granada</option>
                                <option value="Grécia">Grécia</option>
                                <option value="Guadalupe">Guadalupe</option>
                                <option value="Guam">Guam</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guiana">Guiana</option>
                                <option value="Guiana Francesa">Guiana Francesa</option>
                                <option value="Guiné-bissau">Guiné-bissau</option>
                                <option value="Haiti">Haiti</option>
                                <option value="Holanda">Holanda</option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hong Kong">Hong Kong</option>
                                <option value="Hungria">Hungria</option>
                                <option value="Iêmen">Iêmen</option>
                                <option value="Ilhas Cayman">Ilhas Cayman</option>
                                <option value="Ilhas Cook">Ilhas Cook</option>
                                <option value="Ilhas Curaçao">Ilhas Curaçao</option>
                                <option value="Ilhas Marshall">Ilhas Marshall</option>
                                <option value="Ilhas Turks &amp; Caicos">Ilhas Turks &amp; Caicos</option>
                                <option value="Ilhas Virgens (brit.)">Ilhas Virgens (brit.)</option>
                                <option value="Ilhas Virgens(amer.)">Ilhas Virgens(amer.)</option>
                                <option value="Ilhas Wallis e Futuna">Ilhas Wallis e Futuna</option>
                                <option value="Índia">Índia</option>
                                <option value="Indonésia">Indonésia</option>
                                <option value="Inglaterra">Inglaterra</option>
                                <option value="Irlanda">Irlanda</option>
                                <option value="Islândia">Islândia</option>
                                <option value="Israel">Israel</option>
                                <option value="Itália">Itália</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Japão">Japão</option>
                                <option value="Jordânia">Jordânia</option>
                                <option value="Kuwait">Kuwait</option>
                                <option value="Latvia">Latvia</option>
                                <option value="Líbano">Líbano</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lituânia">Lituânia</option>
                                <option value="Luxemburgo">Luxemburgo</option>
                                <option value="Macau">Macau</option>
                                <option value="Macedônia">Macedônia</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malásia">Malásia</option>
                                <option value="Malaui">Malaui</option>
                                <option value="Mali">Mali</option>
                                <option value="Malta">Malta</option>
                                <option value="Marrocos">Marrocos</option>
                                <option value="Martinica">Martinica</option>
                                <option value="Mauritânia">Mauritânia</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="México">México</option>
                                <option value="Moldova">Moldova</option>
                                <option value="Mônaco">Mônaco</option>
                                <option value="Montserrat">Montserrat</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Nicarágua">Nicarágua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigéria">Nigéria</option>
                                <option value="Noruega">Noruega</option>
                                <option value="Nova Caledônia">Nova Caledônia</option>
                                <option value="Nova Zelândia">Nova Zelândia</option>
                                <option value="Omã">Omã</option>
                                <option value="Palau">Palau</option>
                                <option value="Panamá">Panamá</option>
                                <option value="Papua-nova Guiné">Papua-nova Guiné</option>
                                <option value="Paquistão">Paquistão</option>
                                <option value="Peru">Peru</option>
                                <option value="Polinésia Francesa">Polinésia Francesa</option>
                                <option value="Polônia">Polônia</option>
                                <option value="Porto Rico">Porto Rico</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Quênia">Quênia</option>
                                <option value="Rep. Dominicana">Rep. Dominicana</option>
                                <option value="Rep. Tcheca">Rep. Tcheca</option>
                                <option value="Reunion">Reunion</option>
                                <option value="Romênia">Romênia</option>
                                <option value="Ruanda">Ruanda</option>
                                <option value="Rússia">Rússia</option>
                                <option value="Saipan">Saipan</option>
                                <option value="Samoa Americana">Samoa Americana</option>
                                <option value="Senegal">Senegal</option>
                                <option value="Serra Leone">Serra Leone</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Singapura">Singapura</option>
                                <option value="Síria">Síria</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                                <option value="St. Kitts &amp; Nevis">St. Kitts &amp; Nevis</option>
                                <option value="St. Lúcia">St. Lúcia</option>
                                <option value="St. Vincent">St. Vincent</option>
                                <option value="Sudão">Sudão</option>
                                <option value="Suécia">Suécia</option>
                                <option value="Suiça">Suiça</option>
                                <option value="Suriname">Suriname</option>
                                <option value="Tailândia">Tailândia</option>
                                <option value="Taiwan">Taiwan</option>
                                <option value="Tanzânia">Tanzânia</option>
                                <option value="Togo">Togo</option>
                                <option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
                                <option value="Tunísia">Tunísia</option>
                                <option value="Turquia">Turquia</option>
                                <option value="Ucrânia">Ucrânia</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Uruguai">Uruguai</option>
                                <option value="Venezuela">Venezuela</option>
                                <option value="Vietnã">Vietnã</option>
                                <option value="Zaire">Zaire</option>
                                <option value="Zâmbia">Zâmbia</option>
                                <option value="Zimbábue">Zimbábue</option>
                            </select>
                            <i class="fa fa-chevron-down select_after" aria-hidden="true"></i>
                        </div>
                        <div class="col-3 ">
                            <input type="text" class="form-control" name="uf" id="uf" placeholder="Estado" required>
                        </div>
                        <div class="col-3 ">
                            <input type="text" class="form-control" name="cidade" id="endereco" placeholder="Cidade" required>
                        </div>

                    </div>
                    <div class="input-group mb-0">
                        <div class="col-4 col-md-3 mb-3">
                            <input type="text" class="form-control" name="rua" id="rua" placeholder="Rua" required>
                        </div>
                        <div class="col-4 col-md-3 mb-3">
                            <input type="text" class="form-control" name="quadra" id="quadra" placeholder="Quadra" >
                        </div>
                        <div class="col-4 col-md-3 mb-3">
                            <input type="text" class="form-control" name="lote" id="lote" placeholder="Lote" >
                        </div>
                        <div class="col-9 col-md-3 mb-3">
                            <input type="text" class="form-control" name="setor" id="setor" placeholder="Setor" required>
                        </div>
                        <div class="col-3 col-md-3 mb-3">
                            <input type="number" class="form-control" name="numero" id="numero" placeholder="Numero">
                        </div>
                        <div class="col-12 col-md-9 mb-3">
                            <input type="text" class="form-control" name="complemento" id="complemento" placeholder="Complemento">
                        </div>
                    </div>

                </div>

                <input class="btn btn-enviar" type="submit" value="Enviar">

            </form>

            <div class="col-12 col-md-5 col-img">
                <img src="./img/img-banner/criancas-fazendo-robo.webp" alt="">
            </div>
        </article>

    </section>
      
    <?php
    
    include("Componentes/footer.html");
    
    ?>
</body>

<script>
    $("#data-nascimento").mask("00/00/0000");
    $("#telefone").mask("(00)0 0000-0000");
    $("#cep").mask("00000-000");
    $("#cpfInp").mask("000.000.000-00");
    $("#cnpjInp").mask("00.000.000/0000-00");
</script>

<script>

    const atualizarCnpj = () => {
        $("#cnpjInp").mask("00.000.000/0000-00");
    }
    const atualizarCpf = () => {
        $("#cpfInp").mask("000.000.000-00");
    }

    const tipoRadios = document.querySelectorAll('input[name="tipo"]');
    const campNome = document.querySelector('#nome');
    const campCPF = document.querySelector('#cpf');
    const campCPFInp = document.querySelector('#cpfInp');
    const campRazao = document.querySelector('.razao_social');


    const atualizarFormulario = () => {
        const tipoSelecionado = document.querySelector('input[name="tipo"]:checked').value;

        if (tipoSelecionado === 'fisico') {
            campNome.innerText = 'Nome';
            campCPF.innerText = 'CPF';
            campCPFInp.setAttribute('id', 'cpfInp');
            campCPFInp.setAttribute('placeholder', '000.000.000-00');
            campRazao.style = 'display:none;';
            atualizarCpf();
            
        } else if (tipoSelecionado === 'juridico') {
            campNome.innerText = 'Nome do Responsável';
            campCPF.innerText = 'CNPJ';
            campCPFInp.setAttribute('id', 'cnpjInp');
            campCPFInp.setAttribute('placeholder', '00.000.000/0000-00');
            campRazao.style = 'display:block;';
            atualizarCnpj();
        }
    };

    // Adiciona event listeners aos radios
    tipoRadios.forEach(radio => {
        radio.addEventListener('change', atualizarFormulario);
    });

    // Inicializa o estado do formulário
    atualizarFormulario();
</script>
</html>

