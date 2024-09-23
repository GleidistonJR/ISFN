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
        .admDoadores{
            padding-top:150px;
        }
        .form-check-input {
            background-color: #fefefe;
            border: 1px solid #555;
        }
        .pesquisar{
            width: 40%;
            margin-left:30%;
        }
        @media (max-width: 992px) {
            .col-nome{
                width: 55%;
            }
        }

    </style>
</head>
<body>
    <?php include_once("Componentes/menu.php"); ?>

    <section class="admDoadores mb-5 mx-md-5">
        <h1 class="text-center mb-5">Lista de Doadores</h1>
        
        <div class="input-group mb-5 pesquisar">
            <input type="search" class="form-control" id="search-input" placeholder="Pesquisar pelo nome">
            <button class="btn btn-primary" id="search-button"><i class="bi bi-search"></i></button>
        </div>

        <table class="table table-striped table-hover tabela">
            <thead class='table-info'>
                <tr>
                    <th scope="col"></th>
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
                    // Exibindo cada linha de resultado em uma nova linha da tabela
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr onclick="selecionaRadio(\'radio_'. htmlspecialchars($row['id']) .'\' )">';
                        echo "<th scope='row'><input class='form-check-input' type='radio' name='radioId' id='radio_". htmlspecialchars($row['id']) ."' ></td>";
                        echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                        echo "<td class='d-none d-md-table-cell'>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td class='d-none d-md-table-cell'>" . htmlspecialchars($row['fone']) . "</td>";
                        echo '<td>
                        <a class="btn btn-warning btn-sm" href="verDoador.php?id='.$row['id'].'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                            </svg>
                        </a>
                        <a class="btn btn-primary btn-sm" href="#" onclick="confirmarSenha('.$row['id'].', \'edit.php\')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                            </svg>
                        </a>
                        <a class="btn btn-danger btn-sm delete-link" href="#" data-id="'.$row['id'].'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                            </svg>
                        </a></td>';
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
    
    function selecionaRadio(id) {
        const radio = document.getElementById(id)        
        radio.checked = true;
    }
    function confirmarSenha(id, arquivo) {
        var senha = prompt("Por favor, insira sua senha para confirmar:");
        
        if (senha !== null && senha !== "") {
            // Enviar a senha via POST para a página de confirmação em PHP
            var form = document.createElement("form");
            form.method = "POST";
            form.action = "process/confirma_senha.php";  // Página que processa a senha

            var input = document.createElement("input");
            input.type = "hidden";
            input.name = "senha";
            input.value = senha;
            form.appendChild(input);
            
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

    document.querySelectorAll('.delete-link').forEach(link => {
        link.addEventListener('click', function(event) {
            const id = this.getAttribute('data-id'); // Pega o id do link
            const radio = document.getElementById('radio_' + id); // Acha o radio correspondente
            
            // Verifica se o radio está selecionado
            if (!radio.checked) {
                alert("Por favor, selecione o registro correspondente para excluir.");
                event.preventDefault(); // Impede a exclusão se o radio não estiver marcado
                return;
            }

            // Confirmação da exclusão
            const confirmAction = confirm("Você tem certeza que deseja deletar este registro?");
            if (confirmAction) {
                confirmarSenha(id, "process/remove.php" )
            } else {
                event.preventDefault(); // Impede a exclusão se o usuário cancelar
            }
        });
    });

    document.getElementById('search-button').addEventListener('click', function(e) {
        e.preventDefault(); // Previne o comportamento padrão do botão
        
        // Pega o valor inserido no campo de pesquisa
        var searchValue = document.getElementById('search-input').value;

        // Faz a requisição AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'process/processarPesquisa.php?search=' + encodeURIComponent(searchValue), true);
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