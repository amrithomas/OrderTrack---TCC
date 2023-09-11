<?php
session_start();
include_once("conexao.php");

$id = filter_input(INPUT_POST, 'ID_ORDEM', FILTER_SANITIZE_NUMBER_INT);
$servico = filter_input(INPUT_POST, 'SERVICO', FILTER_SANITIZE_STRING);
$item = filter_input(INPUT_POST, 'ITEM', FILTER_SANITIZE_STRING);
$local = filter_input(INPUT_POST, 'LOCAL', FILTER_SANITIZE_STRING);
$prazo = $_POST['PRAZO'];

// Obtendo os valores originais do chamado
$result_usuario = "SELECT * FROM ordem WHERE ID_ORDEM = '$id'";
$resultado_usuario = mysqli_query($conn, $result_usuario);
$row_usuario = mysqli_fetch_assoc($resultado_usuario);

// Verificação adicional para determinar se alguma alteração foi feita
if ($servico == $row_usuario['SERVICO'] && $item == $row_usuario['ITEM'] && $local == $row_usuario['LOCALIZACAO'] && $prazo == $row_usuario['PRAZO']) {
    $_SESSION['msg'] = "<p style='color:green;'>CHAMADO EDITADO COM SUCESSO</p>";
    header("Location: edit_chamado.php?id=$id");
    exit;
}

$update_query = "UPDATE ordem SET SERVICO='$servico', ITEM='$item', LOCALIZACAO='$local', PRAZO='$prazo' WHERE ID_ORDEM='$id'";
$resultado_update = mysqli_query($conn, $update_query);

if (!$resultado_update) {
    die("Erro na consulta: " . mysqli_error($conn));
}

if (mysqli_affected_rows($conn)) {
    $_SESSION['msg'] = "<p style='color:green;'>CHAMADO EDITADO COM SUCESSO</p>";
    header("Location: edit_chamado.php?id=$id");
} else {
    $_SESSION['msg'] = "<p style='color:red;'>CHAMADO NÃO FOI EDITADO</p>";
    header("Location: edit_chamado.php?id=$id");
}
?>
