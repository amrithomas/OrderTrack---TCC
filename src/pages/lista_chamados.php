<label for="statusFilter">Filtrar por Status:</label>
<select id="statusFilter" name="status" onchange="applyStatusFilter()">
  <option value="">Todos</option>
  <option value="Em andamento">Em andamento</option>
  <option value="Concluido">Concluído</option>
  <option value="Pendente">Pendente</option>
  <option value="CANCELADO">CANCELADO</option>
</select>
<br>
<br>
<br>
<label for="search">Buscar:</label>
<input type="text" id="search" name="search" placeholder="Digite sua busca..." oninput="applySearchWithDebounce()">
<br>
<br>

<?php
include_once('conexao.php');
session_start();

if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

$pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
$pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
$qnt_result_pg = 1000;
$inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;

$status_filter = '';
if (isset($_GET['status']) && !empty($_GET['status'])) {
    $status = $_GET['status'];
    $status_filter = " AND STATUS = '$status'";
}

$search_filter = '';
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $search_filter = " AND (SERVICO LIKE '%$search%' OR ITEM LIKE '%$search%' OR LOCALIZACAO LIKE '%$search%')";
}

$historico_ordem= "SELECT * FROM historico_ordem";
$his_ord = mysqli_query($conn, $historico_ordem);

$result_usuario = "SELECT * FROM ordem WHERE 1 $status_filter $search_filter LIMIT $inicio, $qnt_result_pg";
$resultado_usuario = mysqli_query($conn, $result_usuario);

while($row_usuario = mysqli_fetch_assoc($resultado_usuario) AND $row_historico = mysqli_fetch_assoc($his_ord)){
    // Exibir detalhes dos chamados
    echo "ID:" . $row_usuario['ID_ORDEM']."<br><br>";
    echo "SERVIÇO:" . $row_usuario['SERVICO']."<br><br>";
    echo "ITEM:" . $row_usuario['ITEM']."<br><br>";
    echo "LOCALIZACAO:" . $row_usuario['LOCALIZACAO']."<br><br>";
    echo "PRAZO:" . $row_usuario['PRAZO']."<br><br>";
    echo "PRIORIDADE:" . $row_usuario['PRIORIDADE']."<br><br>";
    echo "STATUS:" . $row_usuario['STATUS']."<br><br>";
    $datetime = $row_historico['DATA_EXECUCAO'];
    $datehora = new DateTime($datetime);
    // Extrair a data
    $data = $datehora->format('Y-m-d');
    echo "Data de Criação do Chamado:".$data."<br><br>";
    if($row_usuario['STATUS'] == 'CONCLUIDO' AND $row_usuario > 0 AND $row_usuario['TEMPO_CONCLUSAO'] != null){
        echo "Data de conclusão:".$row_usuario['TEMPO_CONCLUSAO']."<br><br>";
    }

    echo "<a href='edit_chamado.php?id=".$row_usuario['ID_ORDEM']."'>Editar</a><br>";
    echo "--------------------------------------------------------------------";
    echo "<br><br><br>";
}

echo '
    <script>
    let searchTimeout;

    function applyStatusFilter() {
        const selectedStatus = document.getElementById("statusFilter").value;
        window.location.href = "lista_chamados.php?pagina=1&status=" + selectedStatus;
    }

    function applySearch() {
        const searchString = document.getElementById("search").value;
        const selectedStatus = document.getElementById("statusFilter").value;
        window.location.href = "lista_chamados.php?pagina=1&status=" + selectedStatus + "&search=" + searchString;
    }

    function applySearchWithDebounce() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            applySearch();
        }, 800); // Aguarde 500 milissegundos (0,5 segundos) após a última digitação
    }

    function goToPage(page) {
        const selectedStatus = document.getElementById("statusFilter").value;
        window.location.href = "lista_chamados.php?pagina=" + page + "&status=" + selectedStatus;
    }
    </script>
';

$result_pg="SELECT COUNT(ID_ORDEM) AS num_result FROM ordem";
$resultado_pg=mysqli_query($conn,$result_pg);
$row_pg = mysqli_fetch_assoc($resultado_pg);
$quantidade_pg=ceil($row_pg['num_result'] / $qnt_result_pg);

$max_links = 1;
echo "<a href='lista_chamados.php?pagina=1'>Primeira</a> " ;

for($pag_ant = $pagina - $max_links;$pag_ant <= $pagina -1; $pag_ant++){
    if($pag_ant >= 1){
        echo "<a href='lista_chamados.php?pagina=$pag_ant'>$pag_ant</a>";
    }
}

echo "$pagina";

for($pag_dep=$pagina + 1; $pag_dep <= $pagina + $max_links;$pag_dep++){
    if($pag_dep <= $quantidade_pg){
        echo "<a href='lista_chamados.php?pagina=$pag_dep'>$pag_dep</a>";
    }
}

echo "<a href='lista_chamados.php?pagina=$quantidade_pg'>Ultima</a>";
?>
