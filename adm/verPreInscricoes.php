<?php
    
    include_once("process/sessionLogin.php");
    verificarNivel($_SESSION['nivel'], [7]);

    include_once("../DAO.php");
    
    $ordem = isset($_GET['ordem']) ? $_GET['ordem'] : 'nomeAluno';

    // Preparando e executando a consulta para listar os dados
    $stmt = $conexao->prepare("SELECT * FROM pre_inscricao ORDER BY $ordem ASC");
    $stmt->execute();
    
    // Pegando o resultado da consulta
    $result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <?php include("../Componentes/headBasic.html"); ?>

    <title>ADM | Lista Pré-Inscrições</title>

    <style>
        *{
            text-decoration: none !important;
        }
        body{
            position: relative;
        }
        .Doadores{
            padding-top:150px;
            min-height:60vh;
        }
        .form-check-input {
            background-color: #fefefe;
            border: 1px solid #555;
        }
        .pesquisar.row{
            width: 100%;
        }
        .col-pesquisa{
            margin: auto;
        }
        .link-filter:hover{
            background-color: #9fe2f1ff;
        }
        .modalConfirmaSenha2{
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100vw;
            height: 100vh;            
            background: rgba(0, 0, 0, 0.3);
            z-index: 30;
            display: none;
        }
        .modalConfirmaSenha2 .container{
            background: #fff;
            width: 450px;
            margin: auto;
            border-radius: 8px;
            margin-top: 5%;
            padding: 20px;
        }
        @media (max-width: 992px) {
            .col-pesquisa{
                margin-left: 15%;
                padding:0;
            }
        }

    </style>

</head>
<body>
    <?php include_once("../Componentes/menu.php"); ?>

    <section class="Doadores mb-5 mx-md-5">
        <h1 class="text-center mb-5">Lista Pré-Inscrições <span class="badge text-bg-primary"><?php echo $result->num_rows?></span></h1>
        
        <div class="mb-5 pesquisar row">

            <div class="btn-group col-1 col-filtro">
                <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-sort-up"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="?ordem=nomeAluno">Aluno</a></li>
                    <li><a class="dropdown-item" href="?ordem=horarioAula">Periodo</a></li>
                    <li><a class="dropdown-item" href="?ordem=dataCriacao">Data</a></li>
                    <li><a class="dropdown-item" href="?ordem=nomeResponsavel">Responsanvel</a></li>

                </ul>
            </div>
            
            <div class="col-md-6 col-9 col-pesquisa">
                <form class="input-group" id="search-form" onsubmit="return false;"> <!-- Formulário -->
                    <input type="search" class="form-control" id="search-input" placeholder="Pesquisar nome" required>
                    <button type="submit" class="btn btn-primary" id="search-button"><i class="bi bi-search"></i></button>
                </form>
            </div>            
        </div>

        <div class="overflow-x-auto">

            <table class="table table-striped table-hover tabela overflow-x-auto" style="min-width: 800px;">
                <thead class='table-info'>
                    <tr>
                        <th class="d-table-cell link-filter" scope="col"><a class="fw-bold text-dark" href="?ordem=dataCriacao">Data</a></th>
                        <th class="d-table-cell link-filter" scope="col"><a class="fw-bold text-dark" href="?ordem=nomeAluno">Aluno</a></th>
                        <th class="d-table-cell text-center" scope="col">Idade</th>
                        <th class="d-table-cell link-filter" scope="col"><a class="fw-bold text-dark" href="?ordem=nomeResponsavel">Responsanvel</a></th>
                        <th class="d-table-cell" scope="col">Telefone</th>
                        <th class="d-table-cell text-center link-filter" scope="col"><a class="fw-bold text-dark" href="?ordem=horarioAula">Periodo</a></th>
                        <th class="d-table-cell text-center" scope="col">Confirmado</th>
                        <th class="d-table-cell text-center" scope="col">Desistencia</th>
                        <th class="d-table-cell" scope="col">Visualizar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                // Verifica se existem resultados
                if ($result->num_rows > 0) {
                    // Exibindo cada linha de resultado em uma nova linha da tabela
                    while ($row = $result->fetch_assoc()) {
                        
                        //Estou pegando a idade do aluno atravez da data de nacimento
                        $dataAtual = new DateTime();                        
                        $nascimento = DateTime::createFromFormat('d/m/Y', $row['nascAluno']);
                        $idade = $nascimento->diff($dataAtual)->y;
                    
                        echo "<tr>";
                        echo "<td class='d-table-cell'>" . date('d/m/Y H:i:s', strtotime($row['dataCriacao'])) . "</td>";
                        echo "<td class='d-table-cell'>" . htmlspecialchars($row['nomeAluno']) . "</td>";
                        echo "<td class='d-table-cell text-center'>" . htmlspecialchars($idade) . "</td>";
                        echo "<td class='d-table-cell'>" . htmlspecialchars($row['nomeResponsavel']) . "</td>";
                        echo "<td class='d-table-cell'>" . htmlspecialchars($row['foneResponsavel']) . "</td>";
                        echo "<td class='d-table-cell text-center'>" . htmlspecialchars($row['horarioAula']) . "</td>";
                        echo "<td class='d-table-cell text-center' ><input type='checkbox' onclick='pedirSenha(".$row['id'].", 1)' 
                        ". ($row['confirmado'] == 1 ? "checked" : "") . " ></td>";
                        echo "<td class='d-table-cell text-center' ><input type='checkbox' onclick='pedirSenha(".$row['id'].", 0)' 
                        ". ($row['desistencia'] == 1 ? "checked" : "") . " ></td>";
                        echo '<td class="">
                            <a class="btn btn-warning btn-sm" href="/adm/verPreInscricao.php?id='.$row['id'].'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                            </svg>
                            </a>';
                        echo '
                            <a class="btn btn-primary btn-sm edit-link" href="#" data-bs-toggle="modal" data-bs-target="#modalConfirmaSenha" data-id="'.$row['id'].'"">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                                </svg>
                            </a>';
                        echo '
                            <a class="btn btn-danger btn-sm delete-link" href="#" data-bs-toggle="modal" data-bs-target="#modalConfirmaSenha" data-id="'.$row['id'].'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                </svg>
                            </a></td>';
                        echo "</tr>";
                    }
                    } else {
                        echo "<tr><td colspan='6'>Nenhum doador encontrado</td></tr>";
                    }
                    
                    // Fechando a conexão
                    $stmt->close();
                    $conexao->close();
                    ?>
                </tbody>
            </table>
        </div>

    </section>
    <?php include_once('../Componentes/footer.html')?>

    <!-- Modal -->
    <div class="modal fade" id="modalConfirmaSenha" tabindex="-1" aria-labelledby="modalConfirmaSenhaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalConfirmaSenhaLabel">Confirme sua senha</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body my-4">
                <label for="confirme-senha">Senha:</label>
                <div class="input-group">
                    <input class="form-control" id="confirme-senha" type="password">
                    <button class="btn btn-primary" type="submit" id="btn-enviar-modal">Enviar</button>
                </div>

            </div>
            </div>
        </div>
    </div>

    <div class="modalConfirmaSenha2" id="modalConfirmaSenha2">
        <div class="container"> 
            <div class="d-flex flex-row justify-content-between align-items-center mb-3">
                <h1 class="modal-title fs-5" id="modalConfirmaSenhaLabel">Confirme sua senha</h1>
                <button class="btn-close" onclick="window.location.reload()"></button>
            </div>
            <hr>
            <label for="confirme-senha2">Senha:</label>
            <div class="input-group">
                <input class="form-control" id="confirme-senha2" type="password">
                <button class="btn btn-primary" id="btn-modalConfirmaSenha2" onclick="processSenhaPHP()">Enviar</button>
            </div>
        </div>
    </div>


</body>


<script>
    let id;
    let arquivo;
    var idCheckbox;
    var confirmado;
    
    //Função para confirmar Incrição do aluno
    // Fecha o modal se clicar fora do conteúdo
    window.onclick = function(event) {
        let modal = document.getElementById('modalConfirmaSenha2');
        if (event.target === modal) {
            window.location.reload();
        }
    }
    function pedirSenha(id, isConfirmado) {    
        //alert("Ação confirmada para o ID: " + id);
        idCheckbox = id;
        confirmado = isConfirmado;
        document.getElementById('modalConfirmaSenha2').style.display = 'block';
        document.getElementById('confirme-senha2').focus();
        
        
    };
    
    //Apenas para capturar a tecla enter
    document.getElementById('confirme-senha2').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault(); // evita comportamento padrão
            processSenhaPHP();
        }
    });

    //Quando clicar no botão enviar do modal de confirmação de senha 2
    function processSenhaPHP() {
        let senha = document.getElementById('confirme-senha2').value;

        // Enviar a senha via POST para a página de confirmação em PHP
        var form = document.createElement("form");
        form.method = "POST";
        if(confirmado){
            form.action = "process/process_confirmacao_inscricao.php";  // Página que processa a senha
        }else{
            form.action = "process/process_desistencia.php";  // Página que processa a senha
        }

        //Criando Input para enviar a senha
        var _senha = document.createElement("input");
        _senha.type = "hidden";
        _senha.name = "senha";
        _senha.value = senha;
        form.appendChild(_senha);
        
        //Criando Input para enviar o ID 
        var _id = document.createElement("input");
        _id.type = "hidden";
        _id.name = "id";
        _id.value = idCheckbox;
        form.appendChild(_id);
        
        document.body.appendChild(form);
        form.submit(); // Envia o formulário para verificar a senha

    };


    
    function confirmarSenha(id, arquivo, senha) {
                
        if (senha !== null && senha !== "") {
            // Enviar a senha via POST para a página de confirmação em PHP
            var form = document.createElement("form");
            form.method = "POST";
            form.action = "process/confirma_senha.php";  // Página que processa a senha

            var _senha = document.createElement("input");
            _senha.type = "hidden";
            _senha.name = "senha";
            _senha.value = senha;
            form.appendChild(_senha);
            
            //id
            var _id = document.createElement("input");
            _id.type = "hidden";
            _id.name = "id";
            _id.value = id;
            form.appendChild(_id);
            
            //arquivo
            var _arquivo = document.createElement("input");
            _arquivo.type = "hidden";
            _arquivo.name = "arquivo";
            _arquivo.value = arquivo;
            form.appendChild(_arquivo);

            document.body.appendChild(form);
            form.submit(); // Envia o formulário para verificar a senha
        }
    }


    function criarLinks() {
        //EDIT
        document.querySelectorAll('.edit-link').forEach(link => {
            link.addEventListener('click', function(event) {
                id = this.getAttribute('data-id'); // Pega o ID do elemento clicado
                arquivo = "editIncricao.php"       // Define qual script será chamado
            });
        });
        //DELETE
        document.querySelectorAll('.delete-link').forEach(link => {
            link.addEventListener('click', function(event) {
                id = this.getAttribute('data-id');      // Pega o ID do elemento clicado
                arquivo = "process/removeIncricao.php"  // Define qual script será chamado
            });
        });
    }
    criarLinks(); // Chama a função para criar os links inicialmente

    document.getElementById('confirme-senha').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault(); // evita comportamento padrão
            document.getElementById('btn-enviar-modal').click(); // simula clique
        }
    });

    document.getElementById('btn-enviar-modal').addEventListener('click', function() {
        enviarDados(arquivo);
    });

    // Função chamada ao confirmar a senha
    function enviarDados(arquivo) {
        // Obtém o valor da senha digitada
        let senha = document.getElementById('confirme-senha').value;

        // Chama uma função passando o ID do link e a senha
        confirmarSenha(id, arquivo, senha);
    }
    




    //--------------------------------Search------------------------------------------
    

    document.getElementById('search-button').addEventListener('click', function(e) {
        e.preventDefault(); // Previne o comportamento padrão do botão
        
        // Pega o valor inserido no campo de pesquisa
        var searchValue = document.getElementById('search-input').value;

        // Faz a requisição AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'process/processarPesquisaPreInscricao.php?search=' + encodeURIComponent(searchValue), true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Atualiza o corpo da tabela com o resultado da pesquisa
                document.querySelector('tbody').innerHTML = xhr.responseText;
                criarLinks(); // Recria os links após atualizar a tabela
            }
        };
        xhr.send();
    });
</script>
</html>