<?php
    session_start();
    include_once("conexao.php");

    // Dados do Login (Usuario e Senha)
    $usuario = $_POST['usuario'];
    $senha = filter_input(INPUT_POST, 'senha');
        
    // Verificação no Banco
    $sql = "SELECT * FROM administrador where USUARIO_ADM = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Se USUARIO  for encontrado no banco, então ele verifica a senha↓
    if ($result->num_rows > 0) {
        $verificasenha = $result->fetch_assoc();
       
        //Verificando no banco se a senha que está criptografada em base64 lá, é igual a digitada aq. FUNÇÃO UTILIZADA(password_verify())
        if (password_verify($senha, $verificasenha['SENHA_ADM'])) {
            $_SESSION['login'] = 1;

            header('Location: ../../pages/menu.php');
            exit();
        } else {
            $_SESSION['msg'] = "<center><span style='color:red;'>Usuario ou senha Incorretos</span></center>";
            $_SESSION['login'] = 0;

            header('Location: ../../pages/login.php');
            exit();
        }
      //Caso o usuario não esteja registrado no banco, ele nem verifica a senha e ja manda pra cá↓  
    } else {
        $_SESSION['msg'] = "<center><span style='color:red;'>Usuario ou senha Incorretos</span></center>";
        $_SESSION['login'] = 0;

        header('Location: ../../pages/login.php');
        exit();
    }
    
?>