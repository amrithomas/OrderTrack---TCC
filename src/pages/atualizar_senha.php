<?php
session_start();
ob_start();
include_once '../../conection.php';
?>
<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Incluindo os arquivos CSS do Bootstrap -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="../../src/styles/cadastro_funcionario/styles.css">

    <title>Recuperar Senha</title>

</head>

<body>
<?php
    $chave = filter_input(INPUT_GET, 'chave', FILTER_DEFAULT);

    if (!empty($chave)) {
        //var_dump($chave);

        $query_usuario = "SELECT id FROM usuarios WHERE recuperar_senha = ? LIMIT 1";
        $result_usuario = $conn->prepare($query_usuario);

        if ($result_usuario === false) {
            die('Erro na preparação da consulta: ' . $conn->error);
        }

        $result_usuario->bind_param('s', $chave);
        $result_usuario->execute();
        $result_usuario->store_result();

        if ($result_usuario->num_rows == 1) {
            // A consulta retornou um resultado
            $result_usuario->bind_result($id);
            $result_usuario->fetch();

            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            //var_dump($dados);
            if (!empty($dados['SendNovaSenha'])) {
                $senha_usuario = password_hash($dados['senha_usuario'], PASSWORD_DEFAULT);
                $recuperar_senha = NULL;

                $query_up_usuario = "UPDATE usuarios 
                        SET senha_usuario = ?,
                        recuperar_senha = ?
                        WHERE id = ? 
                        LIMIT 1";
                $result_up_usuario = $conn->prepare($query_up_usuario);

                if ($result_up_usuario === false) {
                    die('Erro na preparação da consulta de atualização: ' . $conn->error);
                }

                $result_up_usuario->bind_param('ssi', $senha_usuario, $recuperar_senha, $id);

                if ($result_up_usuario->execute()) {
                    $_SESSION['msg'] = "<p style='color: green'>Senha atualizada com sucesso!</p>";
                    header("Location: index.php");
                } else {
                    echo "<p style='color: #ff0000'>Erro: Tente novamente!</p>";
                }
            }
        } else {
            $_SESSION['msg_rec'] = "<p style='color: #ff0000'>Erro: Link inválido, solicite novo link para atualizar a senha!</p>";
            header("Location: recuperar_senha.php");
        }
    } else {
        $_SESSION['msg_rec'] = "<p style='color: #ff0000'>Erro: Link inválido, solicite novo link para atualizar a senha!</p>";
        header("Location: recuperar_senha.php");
    }
    ?>

  <nav class="navbar navbar-expand-lg ">

    <div class="container">

      <a class="navbar-brand" href="menu.php">

        <img src="../../assets/images/logo.png" id="logo" alt="Logo" width="30" height="30">

      
      </a>

    </div>
  </nav>
    
    <main>
          <div class="login-form">
              <h2>Atualizar senha</h2>
              <?php
                if (isset($_SESSION['msg'])) {
                    echo($_SESSION['msg'] . "<br>");
                    unset($_SESSION['msg']);
                }
              ?>
              <form action="" method="post">
                  <input type="text" name="senha" placeholder="Digite sua nova senha" required>
                  <button type="submit">Enviar</button>
              </form>
          </div>
        
    </main>
    
    <footer>
        <p>&copy; ProTask . Todos os direitos reservados.</p>
    </footer>
    <!-- Incluindo os arquivos JavaScript do Bootstrap (opcional) -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
