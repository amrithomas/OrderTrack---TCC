<?php
    include_once('conexao.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>Cadastrar usuário</h1>
    <form action="cad_funcionario.php" method="post" enctype="multipart/form-data">
        <input type="text" placeholder="digite o nome completo " name="nome" required> <!-- nome do funcionário -->
        <input type="text" placeholder="crie um usuário" name="usuario" required> 

        <input type="password" placeholder="senha" name="senha_funcionario" required>

       



        <input type="submit">
        <br>
        <br>
        <label for="">Adicionar Foto</label>
        <input type="file" placeholder="Adicione uma foto" name="img" accept="image/*">
        
    </form>
</body>
</html>

<?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
?>