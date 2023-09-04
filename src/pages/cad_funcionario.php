<?php
include_once('conexao.php');
session_start();

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
    
// pega os dados do input
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
$senha_funcionario = filter_input(INPUT_POST, 'senha_funcionario', FILTER_SANITIZE_STRING);
$sobrenome = '';//ENQUANTO NÃO FAZ PARA NÃO FICAR SEM NADA NO CAMPO DO SOBRENOME
$status_funcionario = 'ATIVO';

//Criptografia senha(MÉTODO UTILIZADO MEU FIH >>>>> password_hash($variavel, PASSWORD_DEFAULT))
$criptosenha = password_hash($senha_funcionario, PASSWORD_DEFAULT);

if (isset($_FILES["img"]) && $_FILES["img"]["error"] === UPLOAD_ERR_OK) {
    // seleção do diretório
    $dir = "img/"; // Certifique-se de que há uma pasta chamada "img" no mesmo diretório deste arquivo PHP.
    
    // pega dados da imagem (nome, nome temporário, tipo do arquivo)
    $image = $_FILES["img"];
    $tmp_name = $image['tmp_name'];
    $name = basename($image["name"]);
    $fileType = strtolower(pathinfo($name, PATHINFO_EXTENSION)); 
    // cria um id único pro arquivo (evita arquivos com nome repetido se substituirem) e cria o caminho onde vai armazenar o arquivo
    $name = uniqid();
    $path = $dir . $name . "." . $fileType;

    // caso seja png, jpg ou jpeg, move o arquivo para a pasta images/imgCliente com o nome dele
    $allowTypes = array('jpg','png','jpeg');

    if (in_array($fileType, $allowTypes) && $image['size'] <= 2097152) {
        // Upload the image to the designated folder
        move_uploaded_file($tmp_name, $path);
    } else {
        if ($image['size'] > 2097152) {   
            $_SESSION['msg'] = "<center><span style='color:red;'>Perfil não cadastrado. Tamanho de imagem não aceita. Máx 2MB.</span></center>";
            header('Location: cadastro.php');
            exit; // Encerra o script após redirecionar para evitar processamento adicional
        } else {
            $_SESSION['msg'] = "<center><span style='color:red;'>Perfil não cadastrado. Apenas arquivos JPG, PNG e JPEG são permitidos.</span></center>";
            header('Location: cadastro.php');
            exit; // Encerra o script após redirecionar para evitar processamento adicional
        }
    }
}

// Se a imagem não foi enviada, ou após o tratamento da imagem, realizamos a inserção no banco de dados apenas com o nome do usuário
$insereImagem =  "INSERT INTO funcionarios (NOME_FUNCIONARIO, SOBRENOME_FUNCIONARIO, IMAGEM_FUNCIONARIO, USUARIO_FUNCIONARIO, SENHA_FUNCIONARIO, STATUS_FUNCIONARIO) VALUES (? , ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($insereImagem);
$stmt->bind_param('ssssss', $nome, $sobrenome, $path, $usuario, $criptosenha, $status_funcionario);

if ($stmt->execute()) {
    $id = mysqli_insert_id($conn);
    $_SESSION['msg'] = "<center><span style='color:blue;'>Perfil Criado com sucesso!</span></center>";
    $_SESSION['id'] = $id;
    header('Location: index.php');
} else {
    $_SESSION['msg'] = "<center><span style='color:red;'>Erro ao inserir perfil no banco de dados.</span></center>";
    header('Location: cadastro.php');
}
?>
