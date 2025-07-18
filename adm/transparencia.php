<?php
include_once("process/sessionLogin.php");
verificarNivel($_SESSION['nivel'], [7]);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>ISFN | Transparencia</title>  
    <?php include("Componentes/headBasic.html");?>

    <style>
        section.transparencia {
            padding-top: 150px;
        }
        section.transparencia tr{
            cursor: pointer;
        }
        @media (max-width:720px){
            .table-dark .data{
                padding-right:80px;
            }
            .table-dark .descricao{
                padding-right:100px;
            }
            .table-dark .documento{
                padding-right:80px;
            }
            .table-dark .valor{
                padding-right:40px;
            }
        }

    </style>
</head>
<body>
    <?php include("Componentes/menu.php");?>

    <section class="transparencia container mb-5">
        <h1 class="text-center">Transparência</h1>
        
        <div class="table-responsive">
            <table class="table table-striped table-hover mt-5">
                <thead class="table-info">
                    <tr>
                        <th class="data" scope="col">Data</th>
                        <th class="d-none d-md-table-cell descricao">Descrição</th>
                        <?php if ($_SESSION['nivel'] == 7): ?>
                            <th class="nome">Nome</th>
                            <th class="d-none d-md-table-cell documento">Documento</th>
                        <?php endif; ?>
                        <th class="valor">Valor</th>
                    </tr>   
                </thead>
                <tbody>
                    <?php
                    // Inclui o arquivo DAO.php que contém a conexão com o banco de dados
                    require_once '../DAO.php';

                    // Definindo o número de transações por página
                    $limit = 20;
                    
                    // Captura o número da página atual da URL (default: 1)
                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $offset = ($page - 1) * $limit;
                    
                    // Consulta para selecionar todas as transações do banco de dados, ordenadas pela data e limitadas a 20 por página
                    $sql = "SELECT data, descricao, nome, documento, valor FROM extrato ORDER BY data DESC LIMIT ?, ?";
                    $stmt = $conexao->prepare($sql);
                    $stmt->bind_param("ii", $offset, $limit);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    // Verificar se há transações no resultado
                    if ($result->num_rows > 0) {
                        // Loop pelas transações e exibir na tabela
                        while ($transacao = $result->fetch_assoc()) {
                        echo "<tr  onclick='verdoacoes(\"". $transacao['documento']."\",".$_SESSION['nivel']." )'>";

                            $dataFormatada = date("d/m/Y", strtotime($transacao['data'])); // Converte para DD/MM/YYYY
                            
                            echo "<td>" . htmlspecialchars($dataFormatada) . "</td>";
                            echo "<td class='d-none d-md-table-cell'>" . htmlspecialchars($transacao['descricao']) . "</td>";
                            if($_SESSION['nivel'] == 7){
                                echo "<td>" . htmlspecialchars($transacao['nome']) . "</td>";
                                echo "<td class='d-none d-md-table-cell'>" . htmlspecialchars($transacao['documento']) . "</td>";
                            }
                            echo "<td>" . htmlspecialchars(number_format($transacao['valor'], 2, ',', '.')) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>Nenhuma transação encontrada.</td></tr>";
                    }

                    // Fechar o statement
                    $stmt->close();
                    
                    // Contar o total de transações para a paginação
                    $sqlCount = "SELECT COUNT(*) AS total FROM extrato";
                    $resultCount = $conexao->query($sqlCount);
                    $total = $resultCount->fetch_assoc()['total'];
                    $totalPages = ceil($total / $limit);
                    ?>

                </tbody>
            </table>
        </div>

        <!-- Exibir links de paginação usando estilos do Bootstrap -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=1" aria-label="Primeira">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $totalPages ?>" aria-label="Última">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

    </section>    

    <?php include("Componentes/footer.html");?>

</body>
<script>
    function verdoacoes(doc, nivel) {
        if(nivel == 7){
            window.location.href = 'historicoDoador.php?doc=' + doc;
        }
    }
</script>

</html>

