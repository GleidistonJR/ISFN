<?php
    
    include_once("process/sessionLogin.php");
    verificarNivel($_SESSION['nivel'], [7]);

    include_once("../DAO.php");
    
    // Preparando e executando a consulta para listar os dados
    $stmt = $conexao->prepare("SELECT * FROM pessoa ORDER BY nome ASC");
    $stmt->execute();
    
    // Pegando o resultado da consulta
    $result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <?php include("Componentes/headBasic.html"); ?>

    <title>ADM | Lista de Doadores</title>

    <style>
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
            margin-left: 17%;
        }
        @media (max-width: 992px) {
            .Doadores{
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

    <section class="Doadores mb-5 mx-md-5">
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
                    <th class="col-nome " scope="col">Nome</th>
                    <th class="d-none d-md-table-cell" scope="col">Email</th>
                    <th class="d-none d-md-table-cell" scope="col">Telefone</th>
                    <th scope="col">Visualizar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Verifica se existem resultados
                if ($result->num_rows > 0) {
                    // Exibindo cada linha de resultado em uma nova linha da tabela
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                        echo "<td class='d-none d-md-table-cell'>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td class='d-none d-md-table-cell'>" . htmlspecialchars($row['fone']) . "</td>";
                        echo '<td class="ps-5">
                        <a class="btn btn-warning btn-sm" href="verDoador.php?id='.$row['id'].'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                            </svg>
                        </a>
                        </td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Nenhum doador encontrado</td></tr>";
                }

                // Fechando a conexão
                $stmt->close();
                $conexao->close();
                ?>
            </tbody>
        </table>
        
    </section>
    <?php include_once('Componentes/footer.html')?>
</body>

<script>
    document.getElementById('search-button').addEventListener('click', function(e) {
        e.preventDefault(); // Previne o comportamento padrão do botão
        
        // Pega o valor inserido no campo de pesquisa
        var searchValue = document.getElementById('search-input').value;

        // Faz a requisição AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'process/processarPesquisaNivel2.php?search=' + encodeURIComponent(searchValue), true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Atualiza o corpo da tabela com o resultado da pesquisa
                document.querySelector('tbody').innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    });
</script>
</html>