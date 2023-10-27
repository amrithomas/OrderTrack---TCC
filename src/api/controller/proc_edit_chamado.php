<?php
session_start();
include_once("../../../conection.php");

$id = $_SESSION['id'];
$id_rel = $_SESSION['id_rel'];

$titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
$assunto = filter_input(INPUT_POST, 'item', FILTER_SANITIZE_STRING);
$local = filter_input(INPUT_POST, 'local', FILTER_SANITIZE_STRING);


$urgencia = filter_input(INPUT_POST, 'urgencia', FILTER_SANITIZE_STRING);
$prazo = filter_input(INPUT_POST, 'prazo', FILTER_SANITIZE_STRING);
$status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

$nome_completo = $_POST['funcionario'];
$nome_sobrenome = explode(" ", $nome_completo);

$nome = $nome_sobrenome[0];
$sobrenome = $nome_sobrenome[1];


// Obtendo os valores originais do chamado
$result_usuario = "SELECT * FROM ordem WHERE ID_ORDEM = '$id'";
$resultado_usuario = mysqli_query($conn, $result_usuario);
$row_usuario = mysqli_fetch_assoc($resultado_usuario);


$update_query = "UPDATE ordem SET SERVICO='$titulo', ITEM='$assunto', LOCALIZACAO='$local', PRIORIDADE='$urgencia', PRAZO='$prazo', STATUS='$status' WHERE ID_ORDEM='$id'";

$resultado_update = mysqli_query($conn, $update_query);



if (mysqli_affected_rows($conn)) {
    $_SESSION['msg'] = '<div class="notificacao">
                                    <div class="notificacao-div">
                                        <i class="bi bi-check-lg"></i>
                                        <div class="mensagem">
                                            <span class="text text-1">Chamado Editado com Sucesso</span>
                                        </div>
                                    </div>
                                    <i class="bi bi-x close"></i>
                                    <div class="tempo"></div>
                                </div>';
            
    header("Location: ../../pages/lista_chamados.php");
    exit;
} else {
    $_SESSION['msg'] = '<div class="notificacao" style="border-left: 6px solid red;">
            <div class="notificacao-div">
                <i class="bi bi-x-circle-fill" style="color: red;"></i>
                <div class="mensagem">
                    <span class="text text-1" style="color: red;">Chamado não Editado!</span>
                </div>
            </div>
            <i class="bi bi-x close" style="color: red;"></i>
            <div class="tempo tempo_error" style="background-color: #ddd;"></div>
        </div>';
    header("Location: ../../pages/editar_chamado.php?id=".$id);
}

if(isset($nome_completo) && !empty($nome_completo) && $nome_completo != " "){
    $select_funcionario = "SELECT * from funcionarios WHERE NOME_FUNCIONARIO = '$nome'";
    $query_funcionario = mysqli_query($conn, $select_funcionario);
    $resultado_funcionario = mysqli_fetch_assoc($query_funcionario);
    
    $id_funcionario = $resultado_funcionario['ID_FUNCIONARIO'];
    
    $update_query_funcionario = "UPDATE rel SET FK_FUNCIONARIO='$id_funcionario' WHERE ID_REL = '$id_rel'";
    $query_update_funcionario = mysqli_query($conn, $update_query_funcionario);
    
    if (mysqli_affected_rows($conn)) {
        $_SESSION['msg'] = '<div class="notificacao">
                            <div class="notificacao-div">
                                <i class="bi bi-check-lg"></i>
                                <div class="mensagem">
                                    <span class="text text-1">Chamado Editado com Sucesso</span>
                                </div>
                            </div>
                            <i class="bi bi-x close"></i>
                            <div class="tempo"></div>
                        </div>';

                    header("Location: ../../pages/lista_chamados.php");
                    exit;
        header("Location: ../../pages/lista_chamados.php");
    } 
} 




?>
