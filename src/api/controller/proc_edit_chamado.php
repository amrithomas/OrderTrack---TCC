<?php
session_start();
include_once("../../../conection.php");

$id = $_SESSION['id'];
$id_rel = $_SESSION['id_rel'];

$titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
$assunto = filter_input(INPUT_POST, 'assunto', FILTER_SANITIZE_STRING);
$local = filter_input(INPUT_POST, 'local', FILTER_SANITIZE_STRING);


$urgencia = filter_input(INPUT_POST, 'urgencia', FILTER_SANITIZE_STRING);
$prazo = filter_input(INPUT_POST, 'prazo', FILTER_SANITIZE_STRING);

$nome_completo = $_POST['funcionario'];
$nome_sobrenome = explode(" ", $nome_completo);

$nome = $nome_sobrenome[0];
$sobrenome = $nome_sobrenome[1];


// Obtendo os valores originais do chamado
$result_usuario = "SELECT * FROM ordem WHERE ID_ORDEM = '$id'";
$resultado_usuario = mysqli_query($conn, $result_usuario);
$row_usuario = mysqli_fetch_assoc($resultado_usuario);


$update_query = "UPDATE ordem SET SERVICO='$titulo', ITEM='$assunto', LOCALIZACAO='$local', PRIORIDADE='$urgencia', PRAZO='$prazo' WHERE ID_ORDEM='$id'";

$resultado_update = mysqli_query($conn, $update_query);

if (mysqli_affected_rows($conn)) {
    $_SESSION['msg'] = "<p style='color:green;'>CHAMADO EDITADO COM SUCESSO</p>";
    header("Location: ../../pages/lista_chamados.php");
} else {
    $_SESSION['msg'] = "<p style='color:red;'>CHAMADO NÃO FOI EDITADO</p>";
    header("Location: ../../pages/lista_chamados.php");
}


$select_funcionario = "SELECT * from funcionarios WHERE NOME_FUNCIONARIO = '$nome'";
$query_funcionario = mysqli_query($conn, $select_funcionario);
$resultado_funcionario = mysqli_fetch_assoc($query_funcionario);

$id_funcionario = $resultado_funcionario['ID_FUNCIONARIO'];

$update_query_funcionario = "UPDATE rel SET FK_FUNCIONARIO='$id_funcionario' WHERE ID_REL = '$id_rel'";
$query_update_funcionario = mysqli_query($conn, $update_query_funcionario);




?>
