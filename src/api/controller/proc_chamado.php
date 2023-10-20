

<?php

include_once('../../../conection.php');

session_start();

 

$titulo_chamado = filter_input(INPUT_POST, 'titulo_chamado', FILTER_SANITIZE_STRING);

$urgencia = filter_input(INPUT_POST, 'urgencia', FILTER_SANITIZE_STRING);

$prazo = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);

$local = filter_input(INPUT_POST, 'local', FILTER_SANITIZE_STRING);

$funcionario = filter_input(INPUT_POST, 'funcionarios', FILTER_SANITIZE_STRING);

$descricao_tarefa = filter_input(INPUT_POST, 'item', FILTER_SANITIZE_STRING);

$data_atual = date("Y-m-d H:i:s");

$status = "PENDENTE";

// Verifique se um arquivo de imagem foi enviado

if (isset($_FILES["img"]) && $_FILES["img"]["error"] === UPLOAD_ERR_OK) {

    // Obtenha os dados da imagem (nome, nome temporário, tipo do arquivo)

    $image = $_FILES["img"];

 

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

            header('Location: ../../pages/cadastro_funcionario.php');

            exit; // Encerra o script após redirecionar para evitar processamento adicional

        } else {

            $_SESSION['msg'] = "<center><span style='color:red;'>Perfil não cadastrado. Apenas arquivos JPG, PNG e JPEG são permitidos.</span></center>";

            header('Location: ../../pages/cadastro_funcionario.php');

            exit; // Encerra o script após redirecionar para evitar processamento adicional

        }

    }

    // Lê os dados binários da imagem

    $imagem_binaria = file_get_contents($tmp_name);

    // Verifique se a imagem não está vazia

    if (($imagem_binaria)) {

        // Use uma prepared statement para inserir dados no banco de dados

        $sql = "INSERT INTO ordem (SERVICO, PRIORIDADE, ITEM, PRAZO, STATUS, LOCALIZACAO,FOTO,CRIADO) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);

 

        // Vincule os parâmetros à declaração SQL

        mysqli_stmt_bind_param($stmt, "ssssssss", $titulo_chamado, $urgencia, $descricao_tarefa, $prazo, $status,$local,$imagem_binaria,$data_atual);

        if (mysqli_stmt_execute($stmt)) {

            $id = mysqli_insert_id($conn);

            $_SESSION['msg'] = "<center><span style='color:blue;'>Perfil Criado com sucesso!</span></center>";

            $_SESSION['id'] = $id;

            header('Location: ../../pages/menu.php');

        } else {

            $_SESSION['msg'] = "<center><span style='color:red;'>Erro ao inserir perfil no banco de dados.</span></center>";

            header('Location: ../../pages/cadastro_funcionario.php');

        }

        // Feche a declaração preparada

        mysqli_stmt_close($stmt);

    } else {

        echo 'Imagem vazia ou inválida';

    }

}else{

   

    $insert_query = "INSERT INTO ordem (SERVICO, PRIORIDADE, ITEM, PRAZO, STATUS, LOCALIZACAO, CRIADO) VALUES (?, ?, ?, ?, ?, ?, NOW())";

    $stmt = $conn->prepare($insert_query);

    $stmt->bind_param('ssssss', $titulo_chamado, $urgencia, $descricao_tarefa, $prazo, $status, $local);

 

    // $result_usuario = "INSERT INTO ordem (SERVICO, PRIORIDADE,ITEM, PRAZO, STATUS, LOCALIZACAO,FOTO,CRIADO) VALUES ('$titulo_chamado', '$urgencia','$descricao_tarefa','$prazo', 'PENDENTE', '$local', '$path',NOW())";

 

 

 

    if ($stmt->execute()) {

        $ultimoIDInserido = $stmt->insert_id;

        $historico_ordem =  mysqli_query($conn, "INSERT INTO historico_ordem (ID_HISTORICO) VALUES ('$ultimoIDInserido')");

   

        if ($historico_ordem) {

            echo "Registro inserido na tabela historico_ordem com sucesso.<br>";

        } else {

            echo "Erro ao inserir registro na tabela historico_ordem: " . mysqli_error($conn) . "<br>";

        }

    } else {

        echo "Erro ao executar a consulta na tabela ordem: " . mysqli_error($conn) . "<br>";

    }

   

        $cadastro = mysqli_query($conn, "INSERT INTO rel (FK_ORDEM, FK_FUNCIONARIO, FK_HISTORICO) values ('$ultimoIDInserido', '$funcionario', '$ultimoIDInserido')");

   

        if ($cadastro) {

            echo "Registro inserido na tabela rel com sucesso.<br>";

        } else {

            echo "Erro ao inserir registro na tabela rel: " . mysqli_error($conn) . "<br>";

        }

   

 

    if($cadastro AND $historico_ordem == TRUE){
        
        $id = mysqli_insert_id($conn);

        $_SESSION['msg'] = "<center><span style='color:blue;'>Chamado Criado com sucesso!</span></center>";

        $_SESSION['id'] = $id;

        header('Location: ../../pages/menu.php');
    }else{
  
        $_SESSION['msg'] = "<center><span style='color:blue;'>Chamado Criado com sucesso!</span></center>";
        
        header('Location: ../../pages/abrir_chamado.php');
    }

}

?>