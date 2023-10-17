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

//colocar a imagem

// Verifique se um arquivo de imagem foi enviado
if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] === UPLOAD_ERR_OK) {
    // Obtenha os dados da imagem (nome, nome temporário, tipo do arquivo)
    $image = $_FILES["imagem"];

    $tmp_name = $image['tmp_name'];
    
    $name = basename($image["name"]);

    $allowTypes = array('jpg','png','jpeg');

    $fileType = strtolower(pathinfo($name, PATHINFO_EXTENSION));

    if (in_array($fileType, $allowTypes) && $image['size'] <= 2097152) {
        // Lê os dados binários da imagem
        $imagem_binaria = file_get_contents($tmp_name);
    }else {

        if ($image['size'] > 2097152) { 
            $_SESSION['msg'] = "<center><span style='color:red;'>Perfil não cadastrado. Tamanho de imagem não aceita. Máx 2MB.</span></center>";
            header('Location: ../../pages/editar_funcionario.php');
            exit; // Encerra o script após redirecionar para evitar processamento adicional
        } else {
            $_SESSION['msg'] = "<center><span style='color:red;'>Perfil não cadastrado. Apenas arquivos JPG, PNG e JPEG são permitidos.</span></center>";
            header('Location: ../../pages/editar_funcionario.php');
            exit; // Encerra o script após redirecionar para evitar processamento adicional
        }
    }

    // Lê os dados binários da imagem
    $imagem_binaria = file_get_contents($tmp_name);

     
    // Verifique se a imagem não está vazia
    if (!empty($imagem_binaria)) {
        $update_query = "UPDATE funcionarios SET NOME_FUNCIONARIO='$nome', SOBRENOME_FUNCIONARIO='$sobrenome', IMAGEM_FUNCIONARIO='$imagem_binaria', STATUS='$status' WHERE ID_FUNCIONARIO = '$id'";
        $resultado_update = mysqli_query($conn, $update_query);
        
        if (mysqli_affected_rows($conn)) {
            $_SESSION['msg'] = "<p style='color:green;'>FUNCIONÁRIO EDITADO COM SUCESSO</p>";
            header("Location: ../../pages/lista_funcionarios.php");
        } else {
            $_SESSION['msg'] = "<p style='color:red;'>FUNCIONÁRIO NÃO FOI EDITADO</p>";
            header('Location: ../../pages/editar_funcionario.php');
        }
    } else {
        $update_query = "UPDATE funcionarios SET NOME_FUNCIONARIO='$nome', SOBRENOME_FUNCIONARIO='$sobrenome', STATUS='$status' WHERE ID_FUNCIONARIO = '$id'";
        $resultado_update = mysqli_query($conn, $update_query);

        if (mysqli_affected_rows($conn)) {
            $_SESSION['msg'] = "<p style='color:green;'>FUNCIONÁRIO EDITADO COM SUCESSO</p>";
            header("Location: ../../pages/lista_funcionarios.php");
        } else {
            $_SESSION['msg'] = "<p style='color:red'>FUNCIONÁRIO NÃO FOI EDITADO</p>";
            header('Location: ../../pages/editar_funcionario.php');
        }
    }
        
    }else{
        
        $update_query = "UPDATE funcionarios SET NOME_FUNCIONARIO='$nome', SOBRENOME_FUNCIONARIO='$sobrenome', STATUS='$status' WHERE ID_FUNCIONARIO = '$id'";
        $resultado_update = mysqli_query($conn, $update_query);

        if (mysqli_affected_rows($conn)) {

            $_SESSION['msg'] = "<p style='color:green;'>FUNCIONÁRIO EDITADO COM SUCESSO</p>";
        
            header("Location: ../../pages/lista_funcionarios.php");
        
        }else {
        
            $_SESSION['msg'] = "<p style='color:red;'>FUNCIONÁRIO NÃO FOI EDITADO</p>";
        
            header('Location: ../../pages/editar_funcionario.php');
        
        }
    }



 


 

 


 

 

 

 

 

?>

 