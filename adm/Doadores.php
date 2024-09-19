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
            .col-nome{
                width: 80%;
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
                    <th class='col-nome' scope="col">Nome</th>
                    <th class="d-none d-md-table-cell" scope="col">Documento</th>
                    <th class="d-none d-md-table-cell" scope="col">Email</th>
                    <th class="d-none d-md-table-cell" scope="col">Telefone</th>
                    <th class="d-none d-md-table-cell" scope="col">Nascimento</th>
                    <th class="" scope="col">Sexo</th>
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
                        echo "<td class='d-none d-md-table-cell'>*****</td>";
                        echo "<td class='d-none d-md-table-cell'>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td class='d-none d-md-table-cell'>" . htmlspecialchars($row['fone']) . "</td>";
                        echo "<td class='d-none d-md-table-cell'>" . htmlspecialchars($row['nasc']) . "</td>";
                        echo "<td >" . htmlspecialchars($row['sexo']) . "</td>";
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