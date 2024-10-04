<?php
    
    include_once("process/sessionLogin.php");
    verificarNivel($_SESSION['nivel'], [7]);
    
    include_once("../DAO.php");
    

    // 1. Consulta para a tabela `pessoa`
    $query_pessoa = "SELECT nome, doc AS documento, email, fone, id, data FROM pessoa";
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

    $query_extrato = "SELECT DISTINCT nome, documento, NULL AS email, NULL AS fone, NULL AS id, NULL AS data 
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


    // // 4. Exibição dos resultados finais ordenados por nome
    // usort($resultados_finais, function($a, $b) {
    //     return strcmp(strtolower($a['nome']), strtolower($b['nome']));
    // });


    //Ordem FILTROS
    // Captura o parâmetro de ordenação da URL
$ordem = isset($_GET['ordem']) ? $_GET['ordem'] : 'alfabetica_cadastrados';

// Aplica a ordenação com base no parâmetro selecionado
switch($ordem) {
    case 'alfabetica_cadastrados':
        // Ordenar alfabeticamente separando cadastrados de nao cadastrados (padrão)
        
        usort($pessoas, function($a, $b) {
            return strcmp(strtolower($a['nome']), strtolower($b['nome']));
        });
        usort($extratos, function($a, $b) {
            return strcmp(strtolower($a['nome']), strtolower($b['nome']));
        });
        $resultados_finais = array_merge($pessoas, $extratos);
        

        break;
        
    case 'ultimos_cadastrados':
        // Ordenar pela data de cadastro mais recente (últimos cadastrados primeiro)

        usort($pessoas, function($a, $b) {
            return strtotime($b['data']) - strtotime($a['data']);
        });
        usort($extratos, function($a, $b) {
            return strcmp(strtolower($a['nome']), strtolower($b['nome']));
        });
        $resultados_finais = $pessoas;


        
        break;
        
    case 'alfabetica_asc':
        // Ordenar em ordem alfabética crescente
        $resultados_finais = array_merge($pessoas, $extratos);
        usort($resultados_finais, function($a, $b) {
            return strcmp(strtolower($a['nome']), strtolower($b['nome']));
        });
        break;
        
    case 'alfabetica_desc':
        // Ordenar em ordem alfabética decrescente
        $resultados_finais = array_merge($pessoas, $extratos);
        usort($resultados_finais, function($a, $b) {
            return strcmp(strtolower($b['nome']), strtolower($a['nome']));
        });
        break;
        
    case 'doacoes_mais':
        // Ordenar por número de doações (supondo que você tenha uma chave 'doacoes' no array)
        $resultados_finais = array_merge($pessoas, $extratos);
        usort($resultados_finais, function($a, $b) {
            return $b['doacoes'] - $a['doacoes'];
        });
        break;
        
    case 'doacoes_menos':
        // Ordenar por número de doações em ordem crescente
        $resultados_finais = array_merge($pessoas, $extratos);
        usort($resultados_finais, function($a, $b) {
            return $a['doacoes'] - $b['doacoes'];
        });
        break;
        
    default:
        // Ordenar alfabeticamente separando cadastrados de nao cadastrados (padrão)
        
        usort($pessoas, function($a, $b) {
            return strcmp(strtolower($a['nome']), strtolower($b['nome']));
        });
        usort($extratos, function($a, $b) {
            return strcmp(strtolower($a['nome']), strtolower($b['nome']));
        });
        $resultados_finais = array_merge($pessoas, $extratos);
        

        break;
}


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
                    <li><a class="dropdown-item" href="?ordem=alfabetica_cadastrados">Todos</a></li>
                    <li><a class="dropdown-item" href="?ordem=ultimos_cadastrados">Ultimos Cadastrados</a></li>
                    <li><a class="dropdown-item" href="?ordem=alfabetica_asc">Alfabetica +</a></li>
                    <li><a class="dropdown-item" href="?ordem=alfabetica_desc">Alfabetica -</a></li>
                <!--<li><a class="dropdown-item" href="?ordem=doacoes_mais">Doações +</a></li>
                    <li><a class="dropdown-item" href="?ordem=doacoes_menos">Doações -</a></li>-->
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
                if (!empty($resultados_finais)) {
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
                                $status = "green"; //verde
                            }elseif($diasIntervalo < 45){
                                $status = "#efd51d"; //amarelo

                            }elseif($diasIntervalo < 60){
                                $status = "#ef911d"; //laranja

                            }elseif($diasIntervalo > 60){
                                $status = "#dc3545"; //vermelho
                            }
                        }else{
                            //Não existe doação
                            $status = "#6633FF"; //lilas
                            
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
                            
                            echo '<td>
                            <a class="btn btn-ver btn-sm" href="verDoador.php?id='.$doador['id'].'" style="background-color: '.$status.';">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                            </svg>
                            </a>';
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
                            echo '<td>
                                    <a class="btn btn-sm" href="historicoDoador.php?doc='.$doador['documento'].'" style="background-color: '.$status.';">
                                        <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="16px" height="16px" version="1.1" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd"
                                            viewBox="0 0 2000 2000">
                                            <g id="Camada_x0020_1">
                                            <metadata id="CorelCorpID_0Corel-Layer"/>
                                            <path fill="#fff" stroke="#fff" stroke-width="2" stroke-miterlimit="22.9256" d="M191 1014.26c3.56,-10.7 14.25,-21.39 24.94,-21.39l128.3 0c17.82,0 24.95,7.13 28.51,21.39 0,167.5 0,335 0,502.5 -3.56,17.83 -3.56,17.83 -21.38,21.39l-32.07 0 -49.9 0 -53.46 0c-14.25,-3.56 -21.38,-10.69 -24.94,-28.52 0,-165.12 0,-330.25 0,-495.37z"/>
                                            <polygon fill="#fff" stroke="#fff" stroke-width="2" stroke-miterlimit="22.9256" points="422.65,1317.18 422.65,1160.37 422.65,1096.22 433.34,1081.97 440.47,1074.84 468.98,1064.15 511.74,1053.46 575.9,1039.2 625.79,1032.07 654.3,1028.51 697.07,1024.95 729.14,1021.38 768.35,1021.38 807.55,1021.38 836.06,1024.95 871.7,1032.07 914.46,1042.77 967.92,1060.58 1014.25,1081.97 1085.53,1117.61 1114.04,1128.3 1138.99,1131.86 1178.19,1135.43 1238.78,1138.99 1281.55,1142.56 1302.93,1146.12 1367.08,1156.81 1420.54,1171.07 1456.18,1181.76 1474,1188.88 1484.69,1196.01 1495.38,1203.14 1506.07,1213.83 1509.64,1220.96 1520.33,1231.65 1523.89,1242.34 1527.45,1253.03 1527.45,1274.42 1520.33,1288.67 1506.07,1313.62 1498.94,1324.31 1477.56,1345.7 1463.3,1352.82 1456.18,1356.39 1445.49,1359.95 1427.66,1363.52 1413.41,1363.52 1377.77,1356.39 1349.26,1352.82 1292.24,1352.82 1249.47,1349.26 1199.58,1345.7 1131.86,1345.7 1089.1,1342.13 1074.84,1345.7 1053.46,1345.7 1046.33,1349.26 1064.15,1359.95 1089.1,1370.64 1142.55,1392.02 1192.45,1406.28 1256.6,1413.41 1310.05,1413.41 1381.34,1409.85 1413.41,1406.28 1477.56,1395.59 1509.64,1381.33 1541.71,1367.08 1580.91,1338.57 1602.3,1317.18 1634.37,1295.8 1666.45,1281.55 1694.96,1270.86 1719.9,1267.29 1741.29,1267.29 1755.54,1270.86 1773.36,1274.42 1784.05,1281.55 1798.31,1295.8 1809,1310.06 1809,1324.31 1805.44,1342.13 1794.75,1356.39 1784.05,1367.08 1784.05,1374.21 1794.75,1377.77 1805.44,1388.46 1809,1399.16 1809,1416.97 1801.87,1427.67 1798.31,1438.36 1787.62,1456.18 1741.29,1495.38 1680.7,1538.15 1623.68,1577.35 1559.53,1620.11 1523.89,1634.37 1491.81,1645.06 1459.74,1648.63 1399.15,1655.76 1342.13,1666.45 1267.29,1677.14 1181.76,1691.39 1121.17,1698.52 1067.71,1702.08 1042.76,1702.08 985.74,1684.27 885.95,1637.93 750.53,1573.78 611.54,1509.63 540.26,1477.56 511.74,1466.87 465.41,1463.31 440.47,1456.18 429.78,1449.05 422.65,1434.79 "/>
                                            <path fill="#fff" fill-rule="nonzero" stroke="#fff" stroke-width="2" stroke-miterlimit="22.9256" d="M1231.64 442.25c48.11,-96.22 96.23,-144.33 192.46,-144.33 106.23,0 192.44,86.21 192.44,192.44 0,192.45 -192.44,384.91 -384.9,577.35 -192.45,-192.44 -384.89,-384.9 -384.89,-577.35 0,-106.23 86.21,-192.44 192.44,-192.44 96.23,0 144.35,48.11 192.45,144.33z"/>
                                            </g>
                                        </svg>
                                    </a>';
                            if($documento == "cpf"){
                                echo '  <a class="btn btn-success btn-sm" href="../formularioDoador.php?doc='.$doador["documento"].'&nome='.$doador['nome'].'">
                                            Cadastrar
                                        </a>
                                        </td>';
                            }else{
                                echo '  <a class="btn btn-success btn-sm" href="../formularioDoadorPJ.php?doc='.$doador["documento"].'&nome='.$doador['nome'].'">
                                        Cadastrar
                                        </a>
                                        </td>';
                            }
                        }
                            echo "</tr>";

                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhum doador encontrado</td></tr>";
                }

                // Fechando a conexão
                $conn->close();
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