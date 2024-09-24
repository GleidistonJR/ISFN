<?php
include_once("../../DAO.php");

if (isset($_GET['search'])) {
    $search = "%" . $_GET['search'] . "%"; // Adiciona os wildcards para a busca

    // Prepara a consulta com o termo de pesquisa
    $stmt = $conexao->prepare("SELECT * FROM pessoa WHERE nome LIKE ? ORDER BY nome ASC");
    $stmt->bind_param("s", $search);  // Usa prepared statement para evitar SQL Injection
    $stmt->execute();

    $result = $stmt->get_result();

    // Verifica se há resultados
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
            echo "<td class='d-none d-md-table-cell'>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td class='d-none d-md-table-cell'>" . htmlspecialchars($row['fone']) . "</td>";
            echo '<td>
            <a class="btn btn-warning btn-sm" href="verDoador.php?id='.$row['id'].'">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi bi-eye-fill" viewBox="0 0 16 16">
                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                </svg>
            </a></td>';
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>Nenhum doador encontrado</td></tr>";
    }

    // Fecha a conexão
    $stmt->close();
    $conexao->close();
}
?>
