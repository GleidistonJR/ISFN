<?php
include_once("../../DAO.php");

if (isset($_GET['search'])) {
    $search = "%" . $_GET['search'] . "%"; // Adiciona os wildcards para a busca

    // Prepara a consulta com o termo de pesquisa
    $stmt = $conexao->prepare("SELECT * FROM precadastro WHERE nomeResponsavel LIKE ? OR nomeAluno LIKE ?
     ORDER BY nomeAluno ASC");
    $stmt->bind_param("ss", $search, $search);  // Usa prepared statement para evitar SQL Injection
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Exibindo cada linha de resultado em uma nova linha da tabela
        while ($row = $result->fetch_assoc()) {
            
            //Estou pegando a idade do aluno atravez da data de nacimento
            $dataAtual = new DateTime();                        
            $nascimento = DateTime::createFromFormat('d/m/Y', $row['nascAluno']);
            $idade = $nascimento->diff($dataAtual)->y;
            
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['nomeAluno']) . "</td>";
            echo "<td class='d-table-cell'>" . htmlspecialchars($idade) . "</td>";
            echo "<td class='d-table-cell'>" . htmlspecialchars($row['nomeResponsavel']) . "</td>";
            echo "<td class='d-table-cell'>" . htmlspecialchars($row['foneResponsavel']) . "</td>";
            echo "<td class='d-table-cell'>" . htmlspecialchars($row['horarioAula']) . "</td>";
            echo '<td class="ps-5">
            <a class="btn btn-warning btn-sm" href="/adm/verPreCadastro.php?id='.$row['id'].'">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi bi-eye-fill" viewBox="0 0 16 16">
            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
            </svg>
            </a>
            </td>';
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>Nenhum inscrito encontrado!</td></tr>";
    }

    // Fecha a conexão
    $stmt->close();
    $conexao->close();
}
?>
