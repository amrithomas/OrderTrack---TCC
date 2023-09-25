<?php
session_start();
include_once("../../../conection.php");

$id = $_SESSION['id'];
$id_rel = $_SESSION['id_rel'];

$titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
$assunto = filter_input(INPUT_POST, 'assunto', FILTER_SANITIZE_STRING);
$local = filter_input(INPUT_POST, 'local', FILTER_SANITIZE_STRING);

if(isset($_POST['imagem']) && $_POST['imagem'] != " " && !empty($_POST['imagem'])){
    $imagem = $_POST['imagem'];
} else{
    $imagem = false;
}

$urgencia = filter_input(INPUT_POST, 'urgencia', FILTER_SANITIZE_STRING);
$prazo = filter_input(INPUT_POST, 'prazo', FILTER_SANITIZE_STRING);
$funcionario = filter_input(INPUT_POST, 'funcionario', FILTER_SANITIZE_STRING);


// Obtendo os valores originais do chamado
$result_usuario = "SELECT * FROM ordem WHERE ID_ORDEM = '$id'";
$resultado_usuario = mysqli_query($conn, $result_usuario);
$row_usuario = mysqli_fetch_assoc($resultado_usuario);

// Verificação adicional para determinar se alguma alteração foi feita
// if ($servico == $row_usuario['SERVICO'] && $item == $row_usuario['ITEM'] && $local == $row_usuario['LOCALIZACAO'] && $prazo == $row_usuario['PRAZO']) {
//     $_SESSION['msg'] = "<p style='color:green;'>CHAMADO EDITADO COM SUCESSO</p>";
//     header("Location: edit_chamado.php?id=$id");
//     exit;
// }
if($imagem != false && !empty($imagem) && $imagem != " "){
    $update_query = "UPDATE ordem SET SERVICO='$titulo', ITEM='$assunto', LOCALIZACAO='$local', FOTO='$imagem', PRIORIDADE='$urgencia' PRAZO='$prazo' WHERE ID_ORDEM='$id'";
} else {
    $update_query = "UPDATE ordem SET SERVICO='$titulo', ITEM='$assunto', LOCALIZACAO='$local', PRIORIDADE='$urgencia' PRAZO='$prazo' WHERE ID_ORDEM='$id'";
}

$resultado_update = mysqli_query($conn, $update_query);

$select_funcionario = "SELECT * from funcionarios WHERE NOME_FUNCIONARIO = '$funcionario'";
$query_funcionario = mysqli_query($conn, $select_funcionario);
$resultado_funcionario = mysqli_fetch_assoc($query_funcionario);

$id_funcionario = $resultado_funcionario['ID_FUNCIONARIO'];

$update_query_funcionario = "UPDATE rel SET FK_FUNCIONARIO='$id_funcionario' WHERE ID_REL = '$id_rel'";
$query_update_funcionario = mysqli_query($conn, $update_query_funcionario);


if (!$resultado_update) {
    die("Erro na consulta: " . mysqli_error($conn));
}

if (mysqli_affected_rows($conn)) {
    $_SESSION['msg'] = "<p style='color:green;'>CHAMADO EDITADO COM SUCESSO</p>";
    header("Location: ../../pages/lista_chamados.php");
} else {
    $_SESSION['msg'] = "<p style='color:red;'>CHAMADO NÃO FOI EDITADO</p>";
    header("Location: ../../pages/lista_chamados.php");
}
?>
