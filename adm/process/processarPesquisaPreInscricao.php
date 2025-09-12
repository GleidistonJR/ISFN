<?php
include_once("../../DAO.php");

if (isset($_GET['search'])) {
    $search = "%" . $_GET['search'] . "%"; // Adiciona os wildcards para a busca

    // Prepara a consulta com o termo de pesquisa
    $stmt = $conexao->prepare("SELECT * FROM pre_inscricao WHERE nomeResponsavel LIKE ? OR nomeAluno LIKE ?
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
            echo "<td class='d-table-cell'>" . date('d/m/Y H:i:s', strtotime($row['dataCriacao'])) . "</td>";
            echo "<td class='d-table-cell'>" . htmlspecialchars($row['nomeAluno']) . "</td>";
            echo "<td class='d-table-cell text-center'>" . htmlspecialchars($idade) . "</td>";
            echo "<td class='d-table-cell'>" . htmlspecialchars($row['nomeResponsavel']) . "</td>";
            echo "<td class='d-table-cell'>" . htmlspecialchars($row['foneResponsavel']) . "</td>";
            echo "<td class='d-table-cell text-center'>" . htmlspecialchars($row['horarioAula']) . "</td>";
            echo "<td class='d-table-cell text-center' ><input type='checkbox' onclick='pedirSenha(".$row['id'].")' 
            ". ($row['confirmado'] == 1 ? "checked" : "") . " ></td>";
            echo '<td class="">
                <a class="btn btn-warning btn-sm" href="/adm/verPreInscricao.php?id='.$row['id'].'">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi bi-eye-fill" viewBox="0 0 16 16">
                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                </svg>
                </a>';
            echo '
                <a class="btn btn-primary btn-sm edit-link" href="#" data-bs-toggle="modal" data-bs-target="#modalConfirmaSenha" data-id="'.$row['id'].'"">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                    </svg>
                </a>';
            echo '
                <a class="btn btn-danger btn-sm delete-link" href="#" data-bs-toggle="modal" data-bs-target="#modalConfirmaSenha" data-id="'.$row['id'].'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                    </svg>
                </a></td>';
            echo "</tr>";
        }

    } else {
        echo "<tr><td colspan='8'>Nenhum inscrito encontrado!</td></tr>";
    }

    // Fecha a conexão
    $stmt->close();
    $conexao->close();
}
?>
