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
            echo '<tr>';
            echo "<th scope='row'>". htmlspecialchars($row['id']) ." </th>";
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

    // Fecha a conexão
    $stmt->close();
    $conexao->close();
}
?>
