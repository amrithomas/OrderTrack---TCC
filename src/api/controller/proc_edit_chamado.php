<?php
session_start();
include_once("../../../conection.php");

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_SESSION['id'];
    $id_rel = $_SESSION['id_rel'];

    // Obtenha os valores do formulário
    $tituloNovo = trim(filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING));
    $assuntoNovo = trim(filter_input(INPUT_POST, 'item', FILTER_SANITIZE_STRING));
    $localNovo = trim(filter_input(INPUT_POST, 'local', FILTER_SANITIZE_STRING));
    $urgenciaNova = filter_input(INPUT_POST, 'urgencia', FILTER_SANITIZE_STRING);
    $prazoNovo = filter_input(INPUT_POST, 'prazo', FILTER_SANITIZE_STRING);
    $statusNovo = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

    // Consulta para obter os valores atuais do banco de dados
    $consulta = "SELECT SERVICO, ITEM, LOCALIZACAO, PRIORIDADE, PRAZO, STATUS FROM ordem WHERE ID_ORDEM = '$id'";
    $resultado = mysqli_query($conn, $consulta);
    $row = mysqli_fetch_assoc($resultado);

    // Obtenha os valores atuais do banco de dados
    $tituloAtual = $row['SERVICO'];
    $assuntoAtual = $row['ITEM'];
    $localAtual = $row['LOCALIZACAO'];
    $urgenciaAtual = $row['PRIORIDADE'];
    $prazoAtual = $row['PRAZO'];
    $statusAtual = $row['STATUS'];

    // Verifique se os valores enviados são diferentes dos valores atuais
    if ($tituloNovo != $tituloAtual || $assuntoNovo != $assuntoAtual || $localNovo != $localAtual || $urgenciaNova != $urgenciaAtual || $prazoNovo != $prazoAtual || $statusNovo != $statusAtual) {
        // Houve alteração, execute a atualização
        $update_query = "UPDATE ordem SET SERVICO='$tituloNovo', ITEM='$assuntoNovo', LOCALIZACAO='$localNovo', PRIORIDADE='$urgenciaNova', PRAZO='$prazoNovo', STATUS='$statusNovo' WHERE ID_ORDEM='$id'";
        
        $resultado_update = mysqli_query($conn, $update_query);
        
        if ($resultado_update) {
            // Atualização bem-sucedida
            $alteracao_descricao = "Ordem atualizada: 
            Título: $tituloNovo,
            Assunto: $assuntoNovo,
            Localização: $localNovo,
            Urgência: $urgenciaNova,
            Prazo: $prazoNovo,
            Status: $statusNovo";

            $alteracao_query = "INSERT INTO alteracao_ordem (DATA_ALTERACAO, ALTERACAO, FK_ORDEM) VALUES (NOW(), '$alteracao_descricao', '$id')";
            $resultado_insercao = mysqli_query($conn, $alteracao_query);

            if ($resultado_insercao) {
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
                exit;
            }
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
            exit;
        }
    }
    $_SESSION['msg'] = '<div class="notificacao" style="border-left: 6px solid red;">
                <div class="notificacao-div">
                    <i class="bi bi-x-circle-fill" style="color: red;"></i>
                    <div class="mensagem">
                        <span class="text text-1" style="color: red;">Nenhum campo alterado</span>
                    </div>
                </div>
                <i class="bi bi-x close" style="color: red;"></i>
                <div class="tempo tempo_error" style="background-color: #ddd;"></div>
            </div>';
    // Se não houver alterações, redirecione de volta para a página de edição sem executar a atualização
    header('Location: ../../pages/lista_chamados.php');
    exit();
}
?>
