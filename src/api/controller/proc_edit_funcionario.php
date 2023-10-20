<?php
session_start();
include_once("../../../conection.php");

$id = $_SESSION['id'];

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
$nome_completo = $_POST['nome'];
$nome_sobrenome = explode(" ", $nome_completo);
$nome = $nome_sobrenome[0];
$sobrenome = $nome_sobrenome[1];

// Verifique se um arquivo de imagem foi enviado
if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] === UPLOAD_ERR_OK) {
    $image = $_FILES["imagem"];
    $tmp_name = $image['tmp_name'];
    $name = basename($image["name"]);
    $allowTypes = array('jpg', 'png', 'jpeg');
    $fileType = strtolower(pathinfo($name, PATHINFO_EXTENSION));

    if (in_array($fileType, $allowTypes) && $image['size'] <= 2097152) {
        $imagem_binaria = file_get_contents($tmp_name);
    } else {
        if ($image['size'] > 2097152) {
            $_SESSION['msg'] = "<center><span style='color:red;'>Perfil não cadastrado. Tamanho de imagem não aceita. Máx 2MB.</span></center>";
            header('Location: ../../pages/editar_funcionario.php');
            exit();
        } else {
            $_SESSION['msg'] = "<center><span style='color:red;'>Perfil não cadastrado. Apenas arquivos JPG, PNG e JPEG são permitidos.</span></center>";
            header('Location: ../../pages/editar_funcionario.php?id='.$id.'');
            exit();
        }
    }

    if (!empty($imagem_binaria)) {
        $update_query = "UPDATE funcionarios SET NOME_FUNCIONARIO=?, SOBRENOME_FUNCIONARIO=?, IMAGEM_FUNCIONARIO=?, STATUS_FUNCIONARIO=? WHERE ID_FUNCIONARIO = ?";
        $stmt = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($stmt, 'ssssi', $nome, $sobrenome, $imagem_binaria, $status, $id);
    } else {
        $update_query = "UPDATE funcionarios SET NOME_FUNCIONARIO=?, SOBRENOME_FUNCIONARIO=?, STATUS_FUNCIONARIO=? WHERE ID_FUNCIONARIO = ?";
        $stmt = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($stmt, 'sssi', $nome, $sobrenome, $status, $id);
    }

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['msg'] = "<p style='color:green;'>FUNCIONÁRIO EDITADO COM SUCESSO</p>";
        header("Location: ../../pages/lista_funcionarios.php");
    } else {
        $_SESSION['msg'] = "<p style='color:red;'>FUNCIONÁRIO NÃO FOI EDITADO</p>";
        header('Location: ../../pages/editar_funcionario.php?id='.$id.'');
        exit();
    }
} else {
    $update_query = "UPDATE funcionarios SET NOME_FUNCIONARIO=?, SOBRENOME_FUNCIONARIO=?, STATUS_FUNCIONARIO=? WHERE ID_FUNCIONARIO = ?";
    $stmt = mysqli_prepare($conn, $update_query);
    mysqli_stmt_bind_param($stmt, 'sssi', $nome, $sobrenome, $status, $id);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['msg'] = "<p style='color:green;'>FUNCIONÁRIO EDITADO COM SUCESSO</p>";
        header("Location: ../../pages/lista_funcionarios.php");
    } else {
        $_SESSION['msg'] = "<p style='color:red;'>FUNCIONÁRIO NÃO FOI EDITADO</p>";
        header('Location: ../../pages/editar_funcionario.php?id='.$id.'');
        exit();
    }
}
