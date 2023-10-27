<?php

include_once('../../../conection.php');

$idChamado = $_POST['chamadoID'];
$novoStatus = $_POST['novoStatus'];

// Log para depuração
error_log("Tentando atualizar o chamado ID: $idChamado para o status: $novoStatus");
error_log("ID do Chamado: " . $idChamado . ", Novo Status: " . $novoStatus);


$sql = "UPDATE ordem SET STATUS = ? WHERE ID_ORDEM = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $novoStatus, $idChamado);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo "Status atualizado com sucesso.";
    } else {
        echo "Nenhuma atualização foi feita. Verifique o ID do chamado.";
    }
    echo "Status atualizado com sucesso. Linhas afetadas: " . $stmt->affected_rows;
} else {
    echo "Erro ao atualizar o status: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

















