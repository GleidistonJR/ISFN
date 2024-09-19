<?php
    session_set_cookie_params([
        'lifetime' => 3600,
        'path'     => '/',
        'domain'   => 'isfn.org.br',
        'secure'   => false,
        'httponly' => true
    ]);
    session_start();

    if(!isset($_SESSION['login'])){
        unset($_SESSION['login']);
        session_destroy();
        header('Location: login.php');
        exit();

    }else{

        include_once("../DAO.php");
        
        // Preparando e executando a consulta para listar os dados
        $stmt = $conexao->prepare("SELECT * FROM pessoa");
        $stmt->execute();
        
        // Pegando o resultado da consulta
        $result = $stmt->get_result();
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
        }
        /* Estilo para a tabela responsiva */
        .table-responsive {
            width: 100%;
            overflow-x: auto;  /* Ativa o scroll horizontal */
            -webkit-overflow-scrolling: touch; /* Suaviza o scroll em dispositivos móveis */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
            white-space: nowrap; /* Garante que o conteúdo não quebre */
        }

        /* Adiciona uma sombra para indicar que há mais conteúdo ao lado */
        .table-responsive::-webkit-scrollbar {
            display: none; /* Oculta a barra de rolagem em navegadores baseados no WebKit (opcional) */
        }

    </style>
</head>
<body>
    <?php include_once("Componentes/menu.php"); ?>

    <section class="admDoadores table-responsive">
        <h1 class="text-center mb-5">Lista de Doadores</h1>


        <table class="table table-striped table-hover tabela">
            <thead class='table-info'>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Nome</th>
                    <th scope="col">Documento</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Nascimento</th>
                    <th scope="col">Sexo</th>
                    <!--<th scope="col">Senha</th>-->
                    <th scope="col">Edição</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Verifica se existem resultados
                if ($result->num_rows > 0) {
                    // Exibindo cada linha de resultado em uma nova linha da tabela
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<th scope='row'><input class='form-check-input' type='checkbox' name='radioId' id='radio_". htmlspecialchars($row['id']) ."' ></td>";
                        echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['doc']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['fone']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nasc']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['sexo']) . "</td>";
                        //echo "<td>" . htmlspecialchars($row['senha']) . "</td>";
                        echo '<td>
                        <a class="btn btn-primary btn-sm" href="edit.php?id='.$row['id'].'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                            </svg>
                        </a>
                        <a class="btn btn-danger btn-sm delete-link" href="remove.php?id='.$row['id'].'" data-id="'.$row['id'].'">
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
</body>

<script>
    /* Captura todas as tags <a> com a classe 'delete-link' e adiciona o alerta de confirmação
    const deleteLinks = document.querySelectorAll('.delete-link');

    deleteLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            // Exibe o alerta de confirmação
            const confirmAction = confirm("Você tem certeza que deseja deletar este registro?");
            if (!confirmAction) {
                // Se o usuário clicar em "Cancelar", impede a ação
                event.preventDefault();
            }
        });
    });*/
     // Função para verificar se o radio correspondente está selecionado
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
                window.location.href = 'remove.php?id=' + id; // Redireciona para remover o registro
            } else {
                event.preventDefault(); // Impede a exclusão se o usuário cancelar
            }
        });
    });
</script>
</html>