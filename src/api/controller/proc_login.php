<?php
    session_start();
    include_once("conexao.php");

    // $_SESSION['logado'] = false; //Parte do esquema de autenticação aq

    // Dados do Login (Usuario e Senha)
    $usuario = $_POST['usuario'];
    $senha = filter_input(INPUT_POST, 'senha');

    // $senha = md5($senha); //Tem q criptografar a senha no painel de criação de funcionario meu fih

    // Verificação no Banco
    $query = "SELECT * FROM funcionarios where USUARIO_FUNCIONARIO = '$usuario' and SENHA_FUNCIONARIO = '$senha'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // se os inputs(CPF e senha) forem igual ao que está registrado no Banco o usuario será logado
    if($row > 0){
        $_SESSION['msg'] = "<center><span style='color:blue;'>Login Efetuado</span></center>";

        //$_SESSION['id'] = $row['idFuncionario']; //usaremos para pegar o id do funcionario
        // $_SESSION['logado'] = true; //Parte do esquema de autenticação aq

        header('Location: index.php');

    } else {
        $_SESSION['msg'] = "<center><span style='color:red;'>Usuario ou senha Incorretos</span></center>";
        // $_SESSION['logado'] = false; //Parte do esquema de autenticação aq
        header('Location: login.php');

    }

?>