<?php
include_once("../../DAO.php");
include_once("sessionLogin.php");

if (isset($_GET['search'])) {
    $search = "%" . $_GET['search'] . "%"; // Adiciona os wildcards para a busca

    // 1. Consulta para a tabela `pessoa`
    $query_pessoa = "SELECT nome, doc AS documento, email, fone, id, data FROM pessoa WHERE nome LIKE ? ORDER BY nome ASC";
        
    if ($stmt_pessoa = $conexao->prepare($query_pessoa)) {
        $stmt_pessoa->bind_param("s", $search);
        $stmt_pessoa->execute();
        $result_pessoa = $stmt_pessoa->get_result();
        
        $pessoas = [];
        if ($result_pessoa->num_rows > 0) {
            while ($row = $result_pessoa->fetch_assoc()) {
                $pessoas[] = $row;
            }
        }

    }
    $stmt_pessoa->close();

    // 2. Consulta para a tabela `extrato`, excluindo documentos já presentes na tabela `pessoa`
    $documentos_pessoa = array_column($pessoas, 'documento'); // Extraindo os documentos
    $documentos_pessoa_imploded = "'" . implode("','", $documentos_pessoa) . "'"; // Preparando para uso no IN



     // 3. Consulta para a tabela `extrato`
    $query_extrato = "SELECT DISTINCT nome, documento, NULL AS email, NULL AS fone, NULL AS id, NULL AS data 
                    FROM extrato 
                    WHERE documento NOT IN ($documentos_pessoa_imploded) AND nome LIKE ? ORDER BY nome ASC";

    if ($stmt_extrato = $conexao->prepare($query_extrato)) {
        $stmt_extrato->bind_param("s", $search);
        $stmt_extrato->execute();
        $result_extrato = $stmt_extrato->get_result();

        $extratos = []; // Array para armazenar os dados da tabela extrato

        if ($result_extrato->num_rows > 0) {
            while ($row = $result_extrato->fetch_assoc()) {
                $extratos[] = $row;
            }
        }
    }
    $stmt_extrato->close();

    usort($pessoas, function($a, $b) {
        return strcmp(strtolower($a['nome']), strtolower($b['nome']));
    });
    usort($extratos, function($a, $b) {
        return strcmp(strtolower($a['nome']), strtolower($b['nome']));
    });

    $resultados_finais = array_merge($pessoas, $extratos);



    // Verifica se há resultados
    if (!empty($resultados_finais)) {
        $i = 1;
        foreach ($resultados_finais as $doador) {
                        
            //consulta para saber se aquele doador e Pessoa Juridica
            $conn = $conexao->prepare("SELECT * FROM pessoa_juridica WHERE id_pessoa=?");
            $conn->bind_param("i", $doador['id']);
            $conn->execute();
            $resultado = $conn->get_result();
            //Retorna verdadeiro ou falso
            if ($resultado->num_rows > 0) {
                $pj = true;
                
            }else{
                $pj = false;
            }



            $conn = $conexao->prepare("SELECT * FROM extrato WHERE documento=? ORDER BY data DESC LIMIT 1;");
            $conn->bind_param("s", $doador['documento']);
            $conn->execute();
            $resultado = $conn->get_result();
            
            if ($resultado->num_rows > 0) {
                //Existe doação
                $linha = $resultado->fetch_assoc();
                $ultimaDoacao = $linha['data'];
                $dataUltimaDoacao = new DateTime($ultimaDoacao);
                $dataAtual = new DateTime(); // Data atual

                $intervalo = $dataAtual->diff($dataUltimaDoacao);
                $diasIntervalo = $intervalo->days;

                $status = $diasIntervalo;
                if($diasIntervalo < 31){
                    $status = "green"; //verde
                }elseif($diasIntervalo < 45){
                    $status = "#efd51d"; //amarelo

                }elseif($diasIntervalo < 60){
                    $status = "#ef911d"; //laranja

                }elseif($diasIntervalo > 60){
                    $status = "#dc3545"; //vermelho
                }
            }else{
                //Não existe doação
                $status = "#6633FF"; //lilas
                
            }
            //Verificando se Doador e cadastrado
            $conn = $conexao->prepare("SELECT * FROM pessoa WHERE doc=?;");
            $conn->bind_param("s", $doador['documento']);
            $conn->execute();
            $resultado = $conn->get_result();
            
            if ($resultado->num_rows > 0) {
                $cadastrado = true;
            }else{
                $cadastrado = false;
            }






            echo '<tr>';
            echo "<th scope='row'>". htmlspecialchars($i) ." </th>";
            if($pj){
                echo "<td>" . htmlspecialchars($doador['nome']) . " <b>(PJ)</b></td>";
            }else{
                echo "<td>" . htmlspecialchars($doador['nome']) . "</td>";                            
            }

            echo "<td class='d-none d-md-table-cell'>" . htmlspecialchars($doador['email']) . "</td>";
            // echo "<td class='d-none d-md-table-cell'>";
            //  print_r($doador);
            //  echo "</td>";
            echo "<td class='d-none d-md-table-cell'>" . htmlspecialchars($doador['fone']) . "</td>";
            if($cadastrado){
                
                echo '<td>
                <a class="btn btn-ver btn-sm" href="verDoador.php?id='.$doador['id'].'" style="background-color: '.$status.';">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi bi-eye-fill" viewBox="0 0 16 16">
                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                </svg>
                </a>';
                echo '
                <a class="btn btn-primary btn-sm edit-link" href="#" data-bs-toggle="modal" data-bs-target="#modalConfirmaSenha" data-id="'.$doador['id'].'"">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                </svg>
                </a>';
                echo '
                <a class="btn btn-danger btn-sm delete-link" href="#" data-bs-toggle="modal" data-bs-target="#modalConfirmaSenha" data-id="'.$doador['id'].'">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                </svg>
                </a></td>';
            }else{
                $documento = verificarDocumento($doador['documento']);
                echo '<td>
                        <a class="btn btn-sm" href="historicoDoador.php?doc='.$doador['documento'].'" style="background-color: '.$status.';">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#FFF" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                        <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73z"/>
                        </svg>
                        </a>';
                if($documento == "cpf"){
                    echo '  <a class="btn btn-success btn-sm" href="../formularioDoador.php?doc='.$doador["documento"].'&nome='.$doador['nome'].'">
                                Cadastrar
                            </a>
                            </td>';
                }else{
                    echo '  <a class="btn btn-success btn-sm" href="../formularioDoadorPJ.php?doc='.$doador["documento"].'&nome='.$doador['nome'].'">
                            Cadastrar
                            </a>
                            </td>';
                }
            }
                echo "</tr>";

            $i++;
        }
    } else {
        echo "<tr><td colspan='5'>Nenhum doador encontrado</td></tr>";
    }

    // Fecha a conexão
    $conexao->close();
}
?>
