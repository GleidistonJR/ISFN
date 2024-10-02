<?php
    
    include_once("process/sessionLogin.php");
    verificarNivel($_SESSION['nivel'], [7]);
    
    include_once("../DAO.php");
    

    // 1. Consulta para a tabela `pessoa`
    $query_pessoa = "SELECT nome, doc AS documento, email, fone, id FROM pessoa";
    $result_pessoa = $conexao->query($query_pessoa);
    $pessoas = []; // Array para armazenar os dados da tabela pessoa
    if ($result_pessoa->num_rows > 0) {
        while ($row = $result_pessoa->fetch_assoc()) {
            // Salva os documentos em um array para checagem posterior
            $pessoas[] = $row;
        }
    }

    
    // 2. Consulta para a tabela `extrato`, excluindo documentos já presentes na tabela `pessoa`
    $documentos_pessoa = array_column($pessoas, 'documento'); // Extraindo os documentos
    $documentos_pessoa_imploded = "'" . implode("','", $documentos_pessoa) . "'"; // Preparando para uso no IN

    $query_extrato = "SELECT DISTINCT nome, documento, NULL AS email, NULL AS fone, NULL AS id 
                    FROM extrato 
                    WHERE documento NOT IN ($documentos_pessoa_imploded)";

    $result_extrato = $conexao->query($query_extrato);

    $extratos = []; // Array para armazenar os dados da tabela extrato

    if ($result_extrato->num_rows > 0) {
        while ($row = $result_extrato->fetch_assoc()) {
            $extratos[] = $row;
        }
    }

    
    // 3. Combina os resultados das duas consultas
    $resultados_finais = array_merge($pessoas, $extratos);

    // 4. Exibição dos resultados finais ordenados por nome
    usort($resultados_finais, function($a, $b) {
        return strcmp(strtolower($a['nome']), strtolower($b['nome']));
    });






    // Preparando a consulta com UNION
    $query = "
    SELECT DISTINCT nome, documento, email, fone, id 
    FROM (
        SELECT nome, doc AS documento, email, fone, id 
        FROM pessoa

        UNION ALL

        SELECT nome, documento, NULL AS email, NULL AS fone, NULL AS id 
        FROM extrato
    ) AS combined
    WHERE documento IS NOT NULL
    ORDER BY nome ASC";
        
    //$stmt = $conexao->prepare("SELECT * FROM pessoa ORDER BY nome ASC");
    $stmt = $conexao->prepare($query);
    if ($stmt === false) {
        die("Erro na preparação da consulta: " . $conexao->error);
    }







    $stmt->execute();
    $result = $stmt->get_result(); // Pegando o resultado da consulta

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <?php include("Componentes/headBasic.html"); ?>

    <title>ADM | Lista de Doadores</title>

    <style>
        .admDoadores{
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
            margin-left: 17%;
        }
        @media (max-width: 992px) {
            .admDoadores{
                padding-top:150px;
                min-height:50vh;
            }.col-nome{
                width: 55%;
            }
            .col-filtro{
                margin-left: 6%;
            }
            .col-pesquisa{
                margin-left: 9%;
            }
        }

    </style>
</head>
<body>
    <?php include_once("Componentes/menu.php"); ?>

    <section class="admDoadores mb-5 mx-md-5 ">
        <h1 class="text-center mb-5">Lista de Doadores</h1>
        
        <div class="mb-5 pesquisar row">
            <div class="btn-group col-1 col-filtro">
                <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-sort-up"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                </ul>
            </div>

            <div class="col-md-6 col-9 col-pesquisa">
                <form class="input-group" id="search-form" onsubmit="return false;"> <!-- Formulário -->
                    <input type="search" class="form-control" id="search-input" placeholder="Pesquisar nome" required>
                    <button type="submit" class="btn btn-primary" id="search-button"><i class="bi bi-search"></i></button>
                </form>
            </div>            
        </div>

        <table class="table table-striped table-hover tabela">
            <thead class='table-info'>
                <tr>
                    <th scope="col"> </th>
                    <th class="col-nome " scope="col">Nome</th>
                    <th class="d-none d-md-table-cell" scope="col">Email</th>
                    <th class="d-none d-md-table-cell" scope="col">Telefone</th>
                    <th scope="col">Edição</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Verifica se existem resultados
                if ($result->num_rows > 0) {
                    $i = 1;
                    // Exibindo cada linha de resultado em uma nova linha da tabela
                    foreach ($resultados_finais as $doador) {
                        
                        //consulta para saber se aquele doador e Pessoa Juridica
                        $conn = $conexao->prepare("SELECT * FROM pessoa_juridica WHERE id_pessoa=?");
                        $conn->bind_param("i", $doador['id']);
                        $conn->execute();
                        $resultado = $conn->get_result();
                        //Retorna verdadeiro ou falso
                        if ($resultado->num_rows > 0) {
                            $pj = true;
                            
                        }else{
                            $pj = false;
                        }



                        $conn = $conexao->prepare("SELECT * FROM extrato WHERE documento=? ORDER BY data DESC LIMIT 1;");
                        $conn->bind_param("s", $doador['documento']);
                        $conn->execute();
                        $resultado = $conn->get_result();
                        
                        if ($resultado->num_rows > 0) {
                            //Existe doação
                            $linha = $resultado->fetch_assoc();
                            $ultimaDoacao = $linha['data'];
                            $dataUltimaDoacao = new DateTime($ultimaDoacao);
                            $dataAtual = new DateTime(); // Data atual

                            $intervalo = $dataAtual->diff($dataUltimaDoacao);
                            $diasIntervalo = $intervalo->days;

                            $status = $diasIntervalo;
                            if($diasIntervalo < 31){
                                $status = "Verde";
                            }elseif($diasIntervalo < 45){
                                $status = "Amarelo";

                            }elseif($diasIntervalo < 60){
                                $status = "Laranja";

                            }elseif($diasIntervalo > 60){
                                $status = "Vermelho";
                            }
                        }else{
                            //Não existe doação
                            $status = "Nunca";
                            
                        }
                        //Verificando se Doador e cadastrado
                        $conn = $conexao->prepare("SELECT * FROM pessoa WHERE doc=?;");
                        $conn->bind_param("s", $doador['documento']);
                        $conn->execute();
                        $resultado = $conn->get_result();
                        
                        if ($resultado->num_rows > 0) {
                            $cadastrado = true;
                        }else{
                            $cadastrado = false;
                        }






                        echo '<tr>';
                        echo "<th scope='row'>". htmlspecialchars($i) ." </th>";
                        if($pj){
                            echo "<td>" . htmlspecialchars($doador['nome']) . " <b>(PJ)</b></td>";
                        }else{
                            echo "<td>" . htmlspecialchars($doador['nome']) . "</td>";                            
                        }

                        echo "<td class='d-none d-md-table-cell'>" . htmlspecialchars($doador['email']) . "</td>";
                        //echo "<td class='d-none d-md-table-cell'>";
                        // print_r($doador);
                        // echo "</td>";
                        echo "<td class='d-none d-md-table-cell'>" . htmlspecialchars($doador['fone']) . "</td>";
                        if($cadastrado){

                            if($status == 'Verde'){
                                echo '<td>
                                <a class="btn btn-ver btn-sm" href="verDoador.php?id='.$doador['id'].'" style="background-color: green;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                </svg>
                                </a>';
                            }elseif($status == 'Amarelo'){
                                echo '<td>
                                <a class="btn btn-ver btn-sm" href="verDoador.php?id='.$doador['id'].'" style="background-color: #efd51d;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                </svg>
                                </a>';
                            }elseif($status == 'Laranja'){
                                echo '<td>
                                <a class="btn btn-ver btn-sm" href="verDoador.php?id='.$doador['id'].'" style="background-color: #ef911d;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                </svg>
                                </a>';
                            }elseif($status == 'Vermelho'){
                                echo '<td>
                                <a class="btn btn-ver btn-sm" href="verDoador.php?id='.$doador['id'].'" style="background-color: #dc3545;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                </svg>
                                </a>';
                            }elseif($status == 'Nunca'){
                                echo '<td>
                                <a class="btn btn-ver btn-sm" href="verDoador.php?id='.$doador['id'].'" style="background-color: #6633FF;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                </svg>
                                </a>';
                            }
                            echo '
                            <a class="btn btn-primary btn-sm edit-link" href="#" data-bs-toggle="modal" data-bs-target="#modalConfirmaSenha" data-id="'.$doador['id'].'"">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                            </svg>
                            </a>';
                            echo '
                            <a class="btn btn-danger btn-sm delete-link" href="#" data-bs-toggle="modal" data-bs-target="#modalConfirmaSenha" data-id="'.$doador['id'].'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                            </svg>
                            </a></td>';
                        }else{
                            $documento = verificarDocumento($doador['documento']);
                            if($documento == "cpf"){
                                echo '<td>
                                        <a class="btn btn-success btn-sm" href="../formularioDoador.php?doc='.$doador["documento"].'&nome='.$doador['nome'].'">
                                            Cadastrar
                                        </a>
                                        </td>';
                            }else{
                                echo '<td>
                                <a class="btn btn-success btn-sm" href="../formularioDoadorPJ.php?doc='.$doador["documento"].'&nome='.$doador['nome'].'">
                                    Cadastrar
                                </a>
                                </td>';
                            }
                        }
                            echo "</tr>";

                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='3'>Nenhum doador encontrado</td></tr>";
                }

                // Fechando a conexão
                $conn->close();
                $stmt->close();
                $conexao->close();
                ?>
            </tbody>
        </table>
        
    </section>
    <?php include_once('Componentes/footer.html')?>


<!-- Modal -->
<div class="modal fade" id="modalConfirmaSenha" tabindex="-1" aria-labelledby="modalConfirmaSenhaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalConfirmaSenhaLabel">Confirme sua senha</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body my-4">
        <label for="confirme-senha">Digite sua senha:</label>
        <div class="input-group">
            <input class="form-control" id="confirme-senha" type="password">
            <button class="btn btn-primary" type="submit" id="btn-enviar-modal" >Enviar</button>
        </div>

      </div>
    </div>
  </div>
</div>


</body>

<script>
    let id;
    let arquivo;

    
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


    //EDIT
    document.querySelectorAll('.edit-link').forEach(link => {
        link.addEventListener('click', function(event) {
            id = this.getAttribute('data-id'); // Pega o id do link
            arquivo = "edit.php"
        });
    });
    document.querySelectorAll('.delete-link').forEach(link => {
        link.addEventListener('click', function(event) {
            id = this.getAttribute('data-id'); // Pega o id do link
            arquivo = "process/remove.php"
        });
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
    



    // Quando o botão de pesquisa é clicado, dispara o evento
    document.getElementById('search-button').addEventListener('click', function(e) {

        // Previne o comportamento padrão (como enviar um formulário ou recarregar a página)
        e.preventDefault();

        // Captura o valor inserido no campo de pesquisa (input)
        var searchValue = document.getElementById('search-input').value;

        // Cria um objeto XMLHttpRequest para fazer uma requisição AJAX
        var xhr = new XMLHttpRequest();

        // Configura a requisição como GET e inclui o valor da pesquisa na URL
        xhr.open('GET', 'process/processarPesquisa.php?search=' + encodeURIComponent(searchValue), true);

        // Define a função que será executada quando o estado da requisição mudar
        xhr.onreadystatechange = function() {

            // Verifica se a requisição está completa (readyState 4) e se a resposta foi bem-sucedida (status 200)
            if (xhr.readyState == 4 && xhr.status == 200) {

                // Atualiza o conteúdo do corpo da tabela (<tbody>) com o resultado da pesquisa
                document.querySelector('tbody').innerHTML = xhr.responseText;
            }
        };

        // Envia a requisição para o servidor
        xhr.send();
    });


</script>
</html>