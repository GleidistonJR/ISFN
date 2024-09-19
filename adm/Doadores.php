<?php
    
    include_once("session_login.php");
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
        @media (max-width: 992px) {
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
        }

    </style>
</head>
<body>
    <?php include_once("Componentes/menu.php"); ?>

    <section class="admDoadores mx-md-5 mb-5 table-responsive">
        <h1 class="text-center mb-5">Lista de Doadores Mensal</h1>


        <table class="table table-striped table-hover tabela">
            <thead class='table-info'>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Documento</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Nascimento</th>
                    <th scope="col">Sexo</th>
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
                        echo "<td>" . htmlspecialchars($row['doc']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['fone']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nasc']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['sexo']) . "</td>";
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