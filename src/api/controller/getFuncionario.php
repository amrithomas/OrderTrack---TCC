<?php
include_once('../../../conection.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$response = [];

if (isset($_GET['funcionarioID'])) {
    $funcionarioID = intval($_GET['funcionarioID']);

    // Consulta para obter detalhes do funcionário
    $queryFunc = "SELECT * FROM funcionarios WHERE ID_FUNCIONARIO = ?";
    $stmtFunc = $conn->prepare($queryFunc);
    $stmtFunc->bind_param("i", $funcionarioID);
    $stmtFunc->execute();
    $funcionario = $stmtFunc->get_result()->fetch_assoc();

    if (!$funcionario) {
        echo json_encode(["error" => "Funcionário não encontrado"]);
        exit;
    }

    $response['funcionario'] = $funcionario['NOME_FUNCIONARIO']; // Ajuste conforme necessário

    // Consulta para obter informações das ordens relacionadas ao funcionário
    $query = "SELECT o.*, h.* 
    FROM ordem o 
    JOIN rel r ON o.ID_ORDEM = r.FK_ORDEM 
    LEFT JOIN historico_ordem h ON r.FK_HISTORICO = h.ID_HISTORICO
    WHERE r.FK_FUNCIONARIO = ?
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $funcionarioID);
    $stmt->execute();
    $result = $stmt->get_result();

    $ordens = [];
    while ($row = $result->fetch_assoc()) {
        $ordens[] = $row;
    }

    $response['success'] = true;
    $response['ordens'] = $ordens;
} else {
    $response['error'] = "ID do funcionário não definido";
}

echo json_encode($response);
?>
