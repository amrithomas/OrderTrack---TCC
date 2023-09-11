<?php
include_once('conexao.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ano_selecionado = filter_input(INPUT_POST, 'ano', FILTER_SANITIZE_NUMBER_INT);

    // Define o primeiro e o último dia do ano selecionado
    $primeiro_dia = "$ano_selecionado-01-01 00:00:00";
    $ultimo_dia = "$ano_selecionado-12-31 23:59:59";

    // Consulta para contar o total de ordens no ano
    $ordem_total = "SELECT COUNT(ID_ORDEM) AS total_ordens FROM ordem WHERE CRIADO >= ? AND CRIADO <= ?";
    $stmt_total = mysqli_prepare($conn, $ordem_total);
    mysqli_stmt_bind_param($stmt_total, 'ss', $primeiro_dia, $ultimo_dia);
    mysqli_stmt_execute($stmt_total);
    $resultado_total = mysqli_stmt_get_result($stmt_total);
    $row_total = mysqli_fetch_assoc($resultado_total);
    
    echo "TOTAL DE ORDEM NO ANO: " . $row_total['total_ordens'];

    // Consulta para o total de pendentes no ano
    $ordem_pendente = "SELECT COUNT(ID_ORDEM) AS total_pendente FROM ordem WHERE CRIADO >= ? AND CRIADO <= ? AND STATUS = 'PENDENTE'";
    $stmt_pendente = mysqli_prepare($conn, $ordem_pendente);
    mysqli_stmt_bind_param($stmt_pendente, 'ss', $primeiro_dia, $ultimo_dia);
    mysqli_stmt_execute($stmt_pendente);
    $resultado_pendente = mysqli_stmt_get_result($stmt_pendente);
    $row_pendente = mysqli_fetch_assoc($resultado_pendente);
    
    echo "<br><br>";
    echo "TOTAL DE PENDENTES NO ANO: " . $row_pendente['total_pendente'];

    // Consulta para o total de em andamento no ano
    $ordem_andamento = "SELECT COUNT(ID_ORDEM) AS total_andamento FROM ordem WHERE CRIADO >= ? AND CRIADO <= ? AND STATUS = 'EM ANDAMENTO'";
    $stmt_andamento = mysqli_prepare($conn, $ordem_andamento);
    mysqli_stmt_bind_param($stmt_andamento, 'ss', $primeiro_dia, $ultimo_dia);
    mysqli_stmt_execute($stmt_andamento);
    $resultado_andamento = mysqli_stmt_get_result($stmt_andamento);
    $row_andamento = mysqli_fetch_assoc($resultado_andamento);
    
    echo "<br><br>";
    echo "TOTAL DE EM ANDAMENTO NO ANO: " . $row_andamento['total_andamento'];

    // Consulta para o total de concluído no ano
    $ordem_concluido = "SELECT COUNT(ID_ORDEM) AS total_concluido FROM ordem WHERE CRIADO >= ? AND CRIADO <= ? AND STATUS = 'CONCLUIDO'";
    $stmt_concluido = mysqli_prepare($conn, $ordem_concluido);
    mysqli_stmt_bind_param($stmt_concluido, 'ss', $primeiro_dia, $ultimo_dia);
    mysqli_stmt_execute($stmt_concluido);
    $resultado_concluido = mysqli_stmt_get_result($stmt_concluido);
    $row_concluido = mysqli_fetch_assoc($resultado_concluido);
    
    echo "<br><br>";
    echo "TOTAL DE CONCLUÍDO NO ANO: " . $row_concluido['total_concluido'];

    // Consulta para o total de canceladas no ano
    $ordem_cancelado = "SELECT COUNT(ID_ORDEM) AS total_cancelado FROM ordem WHERE CRIADO >= ? AND CRIADO <= ? AND STATUS = 'CANCELADO'";
    $stmt_cancelado = mysqli_prepare($conn, $ordem_cancelado);
    mysqli_stmt_bind_param($stmt_cancelado, 'ss', $primeiro_dia, $ultimo_dia);
    mysqli_stmt_execute($stmt_cancelado);
    $resultado_cancelado = mysqli_stmt_get_result($stmt_cancelado);
    $row_cancelado = mysqli_fetch_assoc($resultado_cancelado);
    
    echo "<br><br>";
    echo "TOTAL DE CANCELADAS NO ANO: " . $row_cancelado['total_cancelado'];

} else {
    $_SESSION['msg'] = "<p style='color:red;'>Não foi possível</p>";
    header('location:lista_chamados.php');
}
?>
