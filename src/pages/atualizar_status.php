<?php
session_start();
include_once("conexao.php");

if (isset($_POST['status']) && isset($_POST['call_id'])) {
    $call_id = $_POST['call_id'];
    $status = $_POST['status'];

   $verifica_historico_ordem = mysqli_query($conn, "SELECT * from historico_ordem WHERE FK_ORDEM = '$call_id'");
   $verifica_histo_ordem = mysqli_fetch_assoc($verifica_historico_ordem);

   if($verifica_histo_ordem < 1){
    $historico_ordem =  mysqli_query($conn, "INSERT INTO historico_ordem (FK_ORDEM) VALUES ('$call_id')");
   }



    if ($status == 'CONCLUIDO') {
        // Atualizar o status e definir o tempo de conclusão para a hora atual
        $query_update_status = "UPDATE ordem SET STATUS = ? WHERE ID_ORDEM = ?";
        $stmt_update_status = $conn->prepare($query_update_status);
        $stmt_update_status->bind_param("si", $status, $call_id);

        $query_update_status1 = "UPDATE historico_ordem SET  DATA_FINALIZACAO = NOW() WHERE FK_ORDEM = ?";
        $stmt_update_status1 = $conn->prepare($query_update_status1);
        $stmt_update_status1->bind_param("i", $call_id);

        if ($stmt_update_status->execute() and $stmt_update_status1->execute()) {
            echo "Status atualizado com sucesso.";
        } else {
            echo "Erro ao atualizar o status.";
        }

        $stmt_update_status->close();
        $stmt_update_status1->close();
    } else if($status == 'EM ANDAMENTO'){
        // Atualizar o status e definir o tempo de conclusão para a hora atual
        $query_update_status = "UPDATE ordem SET STATUS = ? WHERE ID_ORDEM = ?";
        $stmt_update_status = $conn->prepare($query_update_status);
        $stmt_update_status->bind_param("si", $status, $call_id);

        $query_update_status1 = "UPDATE historico_ordem SET  DATA_EXECUCAO = NOW() WHERE FK_ORDEM = ?";
        $stmt_update_status1 = $conn->prepare($query_update_status1);
        $stmt_update_status1->bind_param("i", $call_id);

        if ($stmt_update_status->execute() and $stmt_update_status1->execute()) {
            echo "Status atualizado com sucesso.";
        } else {
            echo "Erro ao atualizar o status.";
        }

        $stmt_update_status->close();
        $stmt_update_status1->close();

    } else {
        // Atualizar apenas o status
        $query_update_status = "UPDATE ordem SET STATUS = ? WHERE ID_ORDEM = ?";
        $stmt_update_status = $conn->prepare($query_update_status);
        $stmt_update_status->bind_param("si", $status, $call_id);

        if ($stmt_update_status->execute()) {
            echo "Status atualizado com sucesso.";
        } else {
            echo "Erro ao atualizar o status.";
        }

        $stmt_update_status->close();
    }

    $conn->close();
}
?>















