<?php

// Inclua o arquivo de conexão com o banco de dados
include_once('../../../conection.php');
// Inicie a sessão
session_start(); 

// Verifique se há mensagens na sessão
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

// Obtenha os dados do formulário
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
$senha_funcionario = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
$sobrenome = ''; // ENQUANTO NÃO FAZ PARA NÃO FICAR SEM NADA NO CAMPO DO SOBRENOME

// Criptografia da senha (MÉTODO UTILIZADO MEU FILHO >>>>> password_hash($variavel, PASSWORD_DEFAULT))
$criptosenha = password_hash($senha_funcionario, PASSWORD_DEFAULT);

// Verifique se um arquivo de imagem foi enviado
if (isset($_FILES["img"]) && $_FILES["img"]["error"] === UPLOAD_ERR_OK) {
    // Obtenha os dados da imagem (nome, nome temporário, tipo do arquivo)
    $image = $_FILES["img"];

    $tmp_name = $image['tmp_name'];

    // Lê os dados binários da imagem
    $imagem_binaria = file_get_contents($tmp_name);
    // Verifique se a imagem não está vazia
    if (!empty($imagem_binaria)) {
        // Use uma prepared statement para inserir dados no banco de dados
        $sql = "INSERT INTO funcionarios (NOME_FUNCIONARIO, SOBRENOME_FUNCIONARIO, IMAGEM_FUNCIONARIO, USUARIO_FUNCIONARIO, SENHA_FUNCIONARIO, STATUS_FUNCIONARIO) VALUES (?, ?, ?, ?, ?, 'ATIVO')";
        $stmt = mysqli_prepare($conn, $sql);

        // Vincule os parâmetros à declaração SQL
        mysqli_stmt_bind_param($stmt, "sssss", $nome, $sobrenome, $imagem_binaria, $usuario, $criptosenha);
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
} else {

    // Se a imagem não foi enviada, ou após o tratamento da imagem, realizamos a inserção no banco de dados apenas com o nome do usuário
    $sql = "INSERT INTO funcionarios (NOME_FUNCIONARIO, SOBRENOME_FUNCIONARIO, USUARIO_FUNCIONARIO, SENHA_FUNCIONARIO, STATUS_FUNCIONARIO) VALUES (?, ?, ?, ?, 'ATIVO')";
    $stmt = mysqli_prepare($conn, $sql);
    // Vincule os parâmetros à declaração SQL
    mysqli_stmt_bind_param($stmt, "ssss", $nome, $sobrenome, $usuario, $criptosenha);
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
}
// Feche a conexão com o banco de dados
mysqli_close($conn);
?>

 