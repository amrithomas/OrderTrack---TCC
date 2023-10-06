<?php
session_start();
include_once("../../../conection.php");

$id = $_SESSION['id'];
$id_rel = $_SESSION['id_rel'];

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);


$prazo = filter_input(INPUT_POST, 'prazo', FILTER_SANITIZE_STRING);
$status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

$nome_completo = $_POST['funcionario'];
$nome_sobrenome = explode(" ", $nome_completo);

$nome = $nome_sobrenome[0];
$sobrenome = $nome_sobrenome[1];


// Obtendo os valores originais do Funcionário
$result_usuario = "SELECT * FROM ordem WHERE ID_ORDEM = '$id'";
$resultado_usuario = mysqli_query($conn, $result_usuario);
$row_usuario = mysqli_fetch_assoc($resultado_usuario);


$update_query = "UPDATE ordem SET SERVICO='$titulo', ITEM='$assunto', LOCALIZACAO='$local', PRIORIDADE='$urgencia', PRAZO='$prazo', STATUS='$status' WHERE ID_ORDEM='$id'";

$resultado_update = mysqli_query($conn, $update_query);



if (mysqli_affected_rows($conn)) {
    $_SESSION['msg'] = "<p style='color:green;'>FUNCIONÁRIO EDITADO COM SUCESSO</p>";
    header("Location: ../../pages/lista_funcionarios.php");
} else {
    $_SESSION['msg'] = "<p style='color:red;'>FUNCIONÁRIO NÃO FOI EDITADO</p>";
    header("Location: ../../pages/lista_funcionarios.php");
}

if(isset($nome_completo) && !empty($nome_completo) && $nome_completo != " "){
    $select_funcionario = "SELECT * from funcionarios WHERE NOME_FUNCIONARIO = '$nome'";
    $query_funcionario = mysqli_query($conn, $select_funcionario);
    $resultado_funcionario = mysqli_fetch_assoc($query_funcionario);
    
    $id_funcionario = $resultado_funcionario['ID_FUNCIONARIO'];
    
    $update_query_funcionario = "UPDATE rel SET FK_FUNCIONARIO='$id_funcionario' WHERE ID_REL = '$id_rel'";
    $query_update_funcionario = mysqli_query($conn, $update_query_funcionario);
    
    if (mysqli_affected_rows($conn)) {
        $_SESSION['msg'] = "<p style='color:green;'>FUNCIONÁRIO EDITADO COM SUCESSO</p>";
        header("Location: ../../pages/lista_funcionarios.php");
    } 
} 




?>
