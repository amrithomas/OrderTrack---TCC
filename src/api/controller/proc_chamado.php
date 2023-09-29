<?php
include_once('../../../conection.php');
session_start();

$titulo_chamado = filter_input(INPUT_POST, 'titulo_chamado', FILTER_SANITIZE_STRING);
$urgencia = $_POST['urgencia'];
$prazo = $_POST['data'];
$local = $_POST['local'];
$funcionario = filter_input(INPUT_POST, 'funcionarios', FILTER_SANITIZE_STRING);
$descricao_tarefa = filter_input(INPUT_POST, 'item', FILTER_SANITIZE_STRING);

if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] === UPLOAD_ERR_OK) {
    $dir = "img/"; // Certifique-se de que há uma pasta chamada "img" no mesmo diretório deste arquivo PHP.
    
    $image = $_FILES["imagem"];
    $tmp_name = $image['tmp_name'];
    $name = basename($image["name"]);
    $fileType = strtolower(pathinfo($name, PATHINFO_EXTENSION)); 
    $name = uniqid();
    $path = $dir . $name . "." . $fileType;

    $allowTypes = array('jpg', 'png', 'jpeg');

    if (in_array($fileType, $allowTypes) && $image['size'] <= 2097152) {
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        if (move_uploaded_file($tmp_name, $path)) {
            echo "Upload de imagem bem-sucedido!";
        } else {
            $_SESSION['msg'] = "<center><span style='color:red;'>Erro ao fazer upload da imagem.</span></center>";
            header('Location: ../../../src/pages/abrir_chamado.php');
            exit;
        }
    } else {
        if ($image['size'] > 2097152) {   
            $_SESSION['msg'] = "<center><span style='color:red;'>Perfil não cadastrado. Tamanho de imagem não aceita. Máx 2MB.</span></center>";
        } else {
            $_SESSION['msg'] = "<center><span style='color:red;'>Perfil não cadastrado. Apenas arquivos JPG, PNG e JPEG são permitidos.</span></center>";
        }
        header('Location: ../../../src/pages/abrir_chamado.php');
        exit;
    }
}



$result_usuario = "INSERT INTO ordem (SERVICO, PRIORIDADE, ITEM, PRAZO, STATUS, LOCALIZACAO, FOTO) VALUES ('$titulo_chamado', '$urgencia','$descricao_tarefa','$prazo', 'PENDENTE', '$local', '$path')";

echo "Query: $result_usuario"; // Depuração

if ($conn->query($result_usuario)) {
    $ultimoIDInserido = $conn->insert_id;

    $cadastro = mysqli_query($conn, "INSERT INTO rel (FK_ORDEM, FK_FUNCIONARIO) values ('$ultimoIDInserido', '$funcionario')");
    $historico_ordem =  mysqli_query($conn, "INSERT INTO historico_ordem (FK_ORDEM) VALUES ('$ultimoIDInserido')");
    
    
    $_SESSION['msg'] = "<p style='color:blue;'>Chamado criado com sucesso!</p>";
    
    // Redirecionar para a página lista_chamados.php
    header("Location: ../../../src/pages/abrir_chamado.php");
    exit();
} else {
    echo "Erro ao inserir o registro: " . $conn->error;
    
    $_SESSION['msg'] = "<p style='color:red;'>Erro ao criar chamado: " . mysqli_error($conn) . "</p>";
    // Redirecionar para a página edit_chamado.php
    header("Location: ../../../src/pages/abrir_chamado.php.php");
    exit();
}
?>
