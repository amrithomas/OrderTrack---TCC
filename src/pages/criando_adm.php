<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="../api/controller/proc_adm.php" method="post">
                <input type="text" name="nome" placeholder="Nome de Usuário" required>
                <input type="text" name="usuario" placeholder="Nome de Usuário" required>
                <input type="password" name="senha" placeholder="Senha" required>

                <button type="submit">Entrar</button>
</form>
<?php

echo 'current php' . phpversion();
?>
    
</body>
</html>