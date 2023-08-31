<?php
include_once('conexao.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe a data selecionada do formulário (formato "YYYY-MM-DD")
    $data_selecionada = filter_input(INPUT_POST, 'dia', FILTER_SANITIZE_STRING);

    // Extrai o ano, mês e dia da data selecionada
    list($ano, $mes, $dia) = explode('-', $data_selecionada);

    // Define o primeiro e o último segundo do dia selecionado
    $inicio_dia = "$ano-$mes-$dia 00:00:00";
    $fim_dia = "$ano-$mes-$dia 23:59:59";

    // Consulta para o total de ordens no dia
    $ordem_total = "SELECT COUNT(ID_ORDEM) AS total_ordens FROM ordem WHERE CRIADO BETWEEN '$inicio_dia' AND '$fim_dia'";
    $result_total = mysqli_query($conn, $ordem_total);
    $resultado_total = mysqli_fetch_assoc($result_total);

    echo "TOTAL DE ORDENS DO DIA: " . $resultado_total['total_ordens'];
    echo "<br><br>";

    // Consulta para o total de pendentes no dia
    $ordem_pendente = "SELECT COUNT(ID_ORDEM) AS total_pendente FROM ordem WHERE CRIADO BETWEEN '$inicio_dia' AND '$fim_dia' AND STATUS = 'PENDENTE'";
    $result_pendente = mysqli_query($conn, $ordem_pendente);
    $total_pendente = mysqli_fetch_assoc($result_pendente);

    echo "TOTAL DE PENDENTES NO DIA: " . $total_pendente['total_pendente'];
    echo "<br><br>";

    // Consulta para o total de em andamento no dia
    $ordem_andamento = "SELECT COUNT(ID_ORDEM) AS andamento FROM ordem WHERE CRIADO BETWEEN '$inicio_dia' AND '$fim_dia' AND STATUS = 'EM ANDAMENTO'";
    $result_andamento = mysqli_query($conn, $ordem_andamento);
    $resultado_andamento = mysqli_fetch_assoc($result_andamento);

    echo "TOTAL DE EM ANDAMENTO DO DIA: " . $resultado_andamento['andamento'];
    echo "<br><br>";

    // Consulta para o total de concluído no dia
    $ordem_concluido = "SELECT COUNT(ID_ORDEM) AS concluido FROM ordem WHERE CRIADO BETWEEN '$inicio_dia' AND '$fim_dia' AND STATUS = 'CONCLUIDO'";
    $result_concluido = mysqli_query($conn, $ordem_concluido);
    $resultado_concluido = mysqli_fetch_assoc($result_concluido);

    echo "TOTAL DE CONCLUÍDOS NO DIA: " . $resultado_concluido['concluido'];
    echo "<br><br>";


    // Consulta para o total de canceladas no dia
    $ordem_cancelado = "SELECT COUNT(ID_ORDEM) AS cancelado FROM ordem WHERE CRIADO BETWEEN '$inicio_dia' AND '$fim_dia' AND STATUS = 'CANCELADO'";
    $result_cancelado = mysqli_query($conn, $ordem_cancelado);
    $resultado_cancelado = mysqli_fetch_assoc($result_cancelado);

    echo "TOTAL DE CANCELADOS NO DIA: " . $resultado_cancelado['cancelado'];
} else {
    $_SESSION['msg'] = "<p style='color:red;'>Não foi possível</p>";
    header('location:lista_chamados.php');
}
?>
