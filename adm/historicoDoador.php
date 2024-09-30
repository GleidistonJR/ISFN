<?php
    include_once('process/sessionLogin.php'); 
    verificarNivel($_SESSION['nivel'], [7]);

    if (isset($_GET['doc'])) {
        $doc = $_GET['doc'];

        include('../DAO.php');
              
        $conn = $conexao->prepare("SELECT * FROM pessoa WHERE doc=?");
        
        // Vinculando o parâmetro à consulta (número inteiro)
        $conn->bind_param("s", $doc);
        
        // Executando a consulta
        $conn->execute();
        
        $result = $conn->get_result();
        
        
        if($result->num_rows > 0){
            //Pussui cadastro
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $login = $row['login'];
            }
            if(empty($login)){ //se o doador possuir cadastro mas não possuir login
                $cadastroLogin = true;
                $cadastroDoador = false;
            }else{ //se o doador possuir cadastro mas e tambem possuir login
                $cadastroLogin = false;
                $cadastroDoador = false;

            }
            
        }else{
            $cadastroLogin = false;
            $cadastroDoador = true;
           //se o não doador possuir cadastro
            
        }
        $conn->close();
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include_once('Componentes/headBasic.html'); ?>
    <title>ISFN | Historico Doador <?php echo $login ?> </title>

    <style>
        .historico-doador{
            padding-top: 150px;
        }
        .btn-voltar{
            margin-left: 15%;
            width: 30%;
        }
        .btn-cadastro{
            margin-left: 10%;
            width: 30%;
        }
    </style>
</head>
<body>
    <?php include_once('Componentes/menu.php'); ?>
    
    <section class="container historico-doador">

        <h1 class="text-center">Historico do Doador</h1>
        
        <div class="table-responsive">
            <table class="table table-striped mt-5">
                <thead class="table-info">
                    <tr>
                        <th class="data" scope="col">Data</th>
                        <th class="d-none d-md-table-cell descricao">Descrição</th>
                        <th class="nome">Nome</th>
                        <?php if ($_SESSION['nivel'] == 7): ?>
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
                    $sql = "SELECT data, descricao, nome, documento, valor FROM extrato WHERE documento=? ORDER BY data DESC LIMIT ?, ?";
                    $stmt = $conexao->prepare($sql);
                    $stmt->bind_param("sii", $doc,$offset, $limit);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    // Verificar se há transações no resultado
                    if ($result->num_rows > 0) {
                        // Loop pelas transações e exibir na tabela
                        while ($transacao = $result->fetch_assoc()) {
                            echo "<tr>";

                            $dataFormatada = date("d/m/Y", strtotime($transacao['data'])); // Converte para DD/MM/YYYY
                            
                            echo "<td>" . htmlspecialchars($dataFormatada) . "</td>";
                            echo "<td class='d-none d-md-table-cell'>" . htmlspecialchars($transacao['descricao']) . "</td>";
                            if($_SESSION['nivel'] == 7){
                                echo "<td>" . htmlspecialchars($transacao['nome']) . "</td>";
                            }else{
                                $nomeOculto = esconderNome($transacao['nome']);
                                echo "<td>" . htmlspecialchars($nomeOculto) . "</td>";
                                
                            }
                            if($_SESSION['nivel'] == 7){
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
                    $sqlCount = "SELECT COUNT(*) AS total FROM extrato WHERE documento='$doc'";
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

        <a class="btn btn-secondary btn-voltar my-5" href="#" onclick="window.history.back()">Voltar</a>
        <!-- verifica se esse doador tem ou nao login, para oferecer criar -->
        <?php if ($cadastroLogin): ?>
        <a class="btn btn-primary my-5 btn-cadastro" href="cadastroLogin.php?id=<?php echo $id?>">Cadastrar Login</a>
        <?php endif; ?>
        <?php if ($cadastroDoador): ?>
        <a class="btn btn-success my-5 btn-cadastro" href="../formularioDoador.php?doc=<?php echo $doc?>">Cadastrar Doador</a>
        <?php endif; ?>
    </section>
    
    <?php include_once('Componentes/footer.html'); ?>
</body>
</html>