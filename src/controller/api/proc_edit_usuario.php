<?php
session_start();
include_once("conexao.php");

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
$senha_funcionario = filter_input(INPUT_POST, 'senha_funcionario', FILTER_SANITIZE_STRING);
$validanome = false;
$validasenha = false;
$validausuario = false;
$dadostrocados = false;
$data_atual = date("Y-m-d H:i:s");




// Verifica se foi enviado um arquivo
if (isset($_FILES["img"]) && $_FILES["img"]["error"] == 0) {
    $dir = "img/"; // Certifique-se de que há uma pasta chamada "img" no mesmo diretório deste arquivo PHP.

    // pega dados da imagem (nome, nome temporário, tipo do arquivo)
    $image = $_FILES["img"];
    $tmp_name = $image['tmp_name'];
    $name = basename($image["name"]);
    $fileType = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    // cria um id único pro arquivo (evita arquivos com nome repetido se substituirem) e cria o caminho onde vai armazenar o arquivo
    $name = uniqid();
    $path = $dir . $name . "." . $fileType;

    $allowTypes = array('jpg', 'png', 'jpeg');
   

    if (in_array($fileType, $allowTypes) && $image['size'] <= 2097152) {
        // Upload the image to the designated folder
        move_uploaded_file($tmp_name, $path);
        // Use $path to store the full path of the image in the database
        // Agora você deve adicionar a coluna de imagem no seu banco de dados e atualizá-la nesta consulta
        if(!empty($senha_funcionario)){
            //Criptografia senha(MÉTODO UTILIZADO MEU FIH >>>>> password_hash($variavel, PASSWORD_DEFAULT))
            
            $criptosenha = password_hash($senha_funcionario, PASSWORD_DEFAULT);
            $result_usuario = "UPDATE FUNCIONARIOS SET NOME_FUNCIONARIO = ?, IMAGEM_FUNCIONARIO = ?, USUARIO_FUNCIONARIO = ?, SENHA_FUNCIONARIO = ? WHERE ID_FUNCIONARIO = ?";
            $stmt = $conn->prepare($result_usuario);
            $stmt->bind_param('ssssi', $nome, $path, $usuario, $criptosenha, $id);
            $stmt->execute();


        }else{
            
            $result_usuario = "UPDATE FUNCIONARIOS SET NOME_FUNCIONARIO = ?, IMAGEM_FUNCIONARIO = ?, USUARIO_FUNCIONARIO = ? WHERE ID_FUNCIONARIO = ? ";
            $stmt = $conn->prepare($result_usuario);
            $stmt->bind_param('sssi', $nome, $path, $usuario, $id);
            $stmt->execute();
        }   

        //PARA NO FINAL SAIR A MENSAGEM DE QUE TODOS OS DADOS FORAM TROCADOS
        $dadostrocados = true;
    } else {
        if ($image['size'] > 2097152) {
            $_SESSION['msg'] = "<p style='color:red;'>Perfil não atualizado. Tamanho de imagem não aceita. Máx 2MB.</p>";
        } else {
            $_SESSION['msg'] = "<p style='color:red;'>Perfil não atualizado. Apenas arquivos JPG, PNG e JPEG são permitidos.</p>";
        }
        header("Location: index.php");
        exit; // Encerra o script após redirecionar para evitar processamento adicional
    }
} else {
    // Verifica se o nome do usuário foi alterado antes de executar a consulta de atualização
    $result_usuario = null;
    $usuario_atual = mysqli_query($conn, "SELECT * FROM FUNCIONARIOS WHERE ID_FUNCIONARIO='$id';");
    $dados_usuario = mysqli_fetch_assoc($usuario_atual);
    $nome_atual = $dados_usuario['NOME_FUNCIONARIO'];

    if ($nome != $nome_atual) {
        $_SESSION['msg'] = "<p style='color:blue;'>Nome alterado com sucesso</p>"
        ;
        $validanome = true;

        if (!empty($senha_funcionario)) {
            $_SESSION['msg'] = "<p style='color:blue;'>Senha alterada com sucesso</p>";
            $validasenha = true;
            $criptosenha = password_hash($senha_funcionario, PASSWORD_DEFAULT);
            $result_senha = "UPDATE FUNCIONARIOS SET SENHA_FUNCIONARIO = ? WHERE ID_FUNCIONARIO = ?";
            $stmt = $conn->prepare($result_senha);
            $stmt->bind_param('si', $criptosenha, $id);
            $stmt->execute();
        }

        if ($usuario != $dados_usuario['USUARIO_FUNCIONARIO']) {
            $_SESSION['msg'] = "<p style='color:blue;'>Usuario alterado com sucesso</p>";
            $validausuario = true;
            $result_usuario = "UPDATE FUNCIONARIOS SET USUARIO_FUNCIONARIO = ? WHERE ID_FUNCIONARIO = ?";
            $stmt = $conn->prepare($result_usuario);
            $stmt->bind_param('si', $usuario, $id);
            $stmt->execute();
        }

        $result_usuario = "UPDATE FUNCIONARIOS SET NOME_FUNCIONARIO = ? WHERE ID_FUNCIONARIO = ?";
        $stmt = $conn->prepare($result_usuario);
        $stmt->bind_param('si', $nome, $id);
        $stmt->execute();

    } else if (!empty($senha_funcionario) or $usuario != $dados_usuario['USUARIO_FUNCIONARIO']) {

        if (!empty($senha_funcionario)) {
            $validasenha = true;
            $_SESSION['msg'] = "<p style='color:blue;'>Senha alterada com sucesso</p>";
            $criptosenha = password_hash($senha_funcionario, PASSWORD_DEFAULT);
            $result_senha = "UPDATE FUNCIONARIOS SET SENHA_FUNCIONARIO = ? WHERE ID_FUNCIONARIO = ?";
            $stmt = $conn->prepare($result_senha);
            $stmt->bind_param('si', $criptosenha, $id);
            $stmt->execute();
        }

        if ($usuario != $dados_usuario['USUARIO_FUNCIONARIO']) {
            $_SESSION['msg'] = "<p style='color:blue;'>Usuario alterado com sucesso</p>";
            $validausuario = true;
            $result_usuario = "UPDATE FUNCIONARIOS SET USUARIO_FUNCIONARIO = ? WHERE ID_FUNCIONARIO = ?";
            $stmt = $conn->prepare($result_usuario);
            $stmt->bind_param('si', $usuario, $id);
            $stmt->execute();
        }

    }
  
}


if ($result_usuario !== null || $stmt->errno == 0) {
    if ($validanome && $validasenha && $validausuario) {
        $_SESSION['msg'] = "<p style='color:blue;'>Dados atualizados com sucesso</p>";
    } else if ($validasenha && $validausuario) {
        $_SESSION['msg'] = "<p style='color:blue;'>Usuário e senha alterados com sucesso</p>";
    } else if ($validanome && $validausuario) {
        $_SESSION['msg'] = "<p style='color:blue;'>Usuário e nome alterados com sucesso</p>";
    } else if ($validanome && $validasenha) {
        $_SESSION['msg'] = "<p style='color:blue;'>Nome e senha alterados com sucesso</p>";
    } else if ($dadostrocados) {
        $_SESSION['msg'] = "<p style='color:blue;'>Dados atualizados com sucesso</p>";
    }
} else {
    $_SESSION['msg'] = "<p style='color:blue;'>Ocorreu um erro ao atualizar os dados</p>";
}


header("Location: index.php");
?>
