<?php
    session_start();
    include_once("conexao.php");

    // $_SESSION['logado'] = false; //Parte do esquema de autenticação aq

    // Dados do Login (Usuario e Senha)
    $usuario = $_POST['usuario'];
    $senha = filter_input(INPUT_POST, 'senha');

        
    // Verificação no Banco
    //INSTRUÇÃO PARA CONSULTA SEM AS VARIAVEIS
    $sql = "SELECT * FROM funcionarios where USUARIO_FUNCIONARIO = ?";
    //PREPARANDO A INSTRUÇÃO PARA RECEBER AS VARIAVEIS
    $stmt = $conn->prepare($sql);
    //VERIFICANDO E SETANDO AS VARIAVEIS COM BASE NO TIPO DELAS SENDO: (S = STRING, D = DOUBLE, B = BLOB, I = INTEIRO)>>CONTINUA EM BAIXO
    //('LETRAS PARA IDENTIFICACAO E VERIFICACAO DO TIPO DE VARIAVEIS QUE SERA RECEBIDA', VARIAVEL) 
    $stmt->bind_param('s', $usuario);
    //EXECUTANDO A VALIDACAO DA VERIAVEL E REALIZANDO A CONSULTA
    $stmt->execute();
    //OBTENDO RESULTADO DA CONSULTA COM BASE NAS INTRUÇÕES DADAS
    //ESSE GET_RESULT() É OS DADOS BRUTOS, PARA TRAZER OS DADOS MAIS 'MASTIGADOS', TEM Q USAR fetch_object ou fetch_array, depende mt da situação
    $result = $stmt->get_result();
    //Depois só fazer a verificação do resultado da consulta
    
    // Se USUARIO  for encontrado no banco, então ele verifica a senha↓
    if ($result->num_rows > 0) {
        $verificasenha = $result->fetch_assoc();
       
        //Verificando no banco se a senha que está criptografada em base64 lá, é igual a digitada aq. FUNÇÃO UTILIZADA(password_verify())
        if (password_verify($senha, $verificasenha['SENHA_FUNCIONARIO'])) {
            //$_SESSION['id'] = $row['idFuncionario']; //usaremos para pegar o id do funcionario
            // $_SESSION['logado'] = true; //Parte do esquema de autenticação aq

            //REDIRECIONANDO↓↓↓↓
            header('Location: index.php');
        } else {
            $_SESSION['msg'] = "<center><span style='color:red;'>Usuario ou senha Incorretos</span></center>";
            // $_SESSION['logado'] = false; //Parte do esquema de autenticação aq


            //REDIRECIONANDO↓↓↓↓
            header('Location: login.php');
        }


      //Caso o usuario não esteja registrado no banco, ele nem verifica a senha e ja manda pra cá↓  
    } else {
        $_SESSION['msg'] = "<center><span style='color:red;'>Usuario ou senha Incorretos</span></center>";
        // $_SESSION['logado'] = false; //Parte do esquema de autenticação aq



        //REDIRECIONANDO↓↓↓↓
        header('Location: login.php');
    }
    



?>