<?php
include_once('../../../conection.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$response = [];

if (isset($_GET['chamadoID'])) {
    $chamadoID = intval($_GET['chamadoID']);

    // Consulta para obter detalhes específicos do chamado
    $queryChamado = "SELECT o.*, h.* 
    FROM ordem o 
    JOIN rel r ON o.ID_ORDEM = r.FK_ORDEM 
    LEFT JOIN historico_ordem h ON r.FK_HISTORICO = h.ID_HISTORICO 
    WHERE o.ID_ORDEM = ?";
    
    $stmtChamado = $conn->prepare($queryChamado);
    $stmtChamado->bind_param("i", $chamadoID);
    $stmtChamado->execute();
    $chamado = $stmtChamado->get_result()->fetch_assoc();

    if (!$chamado) {
        echo json_encode(["error" => "Chamado não encontrado"]);
        exit;
    }

    echo json_encode(["success" => true, "chamado" => $chamado]);
    exit;
}


echo json_encode($response);
?>
