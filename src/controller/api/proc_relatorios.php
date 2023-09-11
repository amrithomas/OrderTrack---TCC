<?php
include_once('conexao.php');
session_start();

$mes = filter_input(INPUT_POST, 'mes', FILTER_SANITIZE_NUMBER_INT);


if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
    // Recebe o mês selecionado do formulário (formato "YYYY-MM")
    $mes_selecionado = filter_input(INPUT_POST, 'mes', FILTER_SANITIZE_STRING);

    // Extrai o ano e o mês da data selecionada
    list($ano, $mes) = explode('-', $mes_selecionado);

    // Define o primeiro e o último dia do mês
    $primeiro_dia = "$ano-$mes-01 00:00:00";
    $ultimo_dia = date('Y-m-t 23:59:59', strtotime($primeiro_dia));

    //Conta o total de ordens no mês

    $ordem_total = "SELECT COUNT(ID_ORDEM) AS total_ordens FROM ordem where MONTH(CRIADO)= $mes";
    $result_total = mysqli_query($conn,$ordem_total);
    $resultado_total = mysqli_fetch_assoc($result_total);
    
    echo"TOTAL DE ORDENS DO MÊS: ". $resultado_total['total_ordens'];
    


    // Consulta para o total de pendentes no mês
    $ordem_pendente = "SELECT COUNT(ID_ORDEM) AS total_pendente FROM ordem WHERE MONTH(CRIADO) = $mes AND STATUS = 'PENDENTE'";
    $result_pendente = mysqli_query($conn, $ordem_pendente);
    $total_pendente = mysqli_fetch_assoc($result_pendente);
    echo "<br>";
    echo "<br>";
    echo "TOTAL DE PENDENTES NO MÊS: " .$total_pendente['total_pendente'];

    // Consulta para o total de em andamento
    $ordem_andamento = "SELECT COUNT(ID_ORDEM) AS andamento FROM ordem WHERE MONTH(CRIADO) = $mes AND STATUS = 'EM ANDAMENTO'";
    $result_andamento = mysqli_query($conn,$ordem_andamento);
    $resultado_andamento = mysqli_fetch_assoc($result_andamento);
    echo "<br>";
    echo "<br>";
    echo "TOTAL DE EM ANDAMENTO DO MÊS: " .$resultado_andamento['andamento'];

    // Consulta para o total de concluído do mês
    $ordem_concluido = "SELECT COUNT(ID_ORDEM) AS concluido FROM ordem WHERE MONTH(CRIADO) = $mes AND STATUS = 'CONCLUIDO'";
    $result_concluido = mysqli_query($conn,$ordem_concluido);
    $resultado_concluido = mysqli_fetch_assoc($result_concluido);
    echo "<br>";
    echo "<br>";
    echo "TOTAL DE CONCLUÍDOS DO MÊS: " .$resultado_concluido['concluido'];
    

    // Consulta para o total de cancelados do mês
    $ordem_cancelado = "SELECT COUNT(ID_ORDEM) AS cancelado FROM ordem WHERE MONTH(CRIADO) = $mes AND STATUS = 'CANCELADO'";
    $result_cancelado = mysqli_query($conn,$ordem_cancelado);
    $resultado_cancelado = mysqli_fetch_assoc($result_cancelado);
    echo "<br>";
    echo "<br>";
    echo "TOTAL DE  CANCELADOS DO MÊS: " .$resultado_cancelado['cancelado'];
}else{
    $_SESSION['msg'] = "<p style='color:red;'>Não foi possivel</p>";
    header('location:lista_chamados.php');
}

?>
