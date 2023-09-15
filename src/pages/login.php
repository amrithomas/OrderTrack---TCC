
<!-- Tem que criar uma validação pra ver se o fela ta logado -->
<!-- ?php
    session_start();
    $_SESSION['logado'] = false;
? -->

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <center>



        <?php 
            session_start();
            if (isset($_SESSION['msg'])) {
                echo($_SESSION['msg'] . "<br>");
                unset($_SESSION['msg']);
            }
        ?>

        <div>
            <form action="proc_login.php" method="POST">
                <label for="">Usuario: </label>
                <br>
                <input name="usuario" type="text" placeholder="Digite seu usurio.">
                <br>
                <label for="">Senha: </label>
                <br>
                <input name="senha" type="text" placeholder="Digite sua senha">
                <br>
                <br>
                <button type="submit">Entrar</button>
            </form>
        </div>
    </center>
</body>
</html>