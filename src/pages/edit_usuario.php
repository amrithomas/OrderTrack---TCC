<link rel="stylesheet" href="style.css">
<?php

    session_start();//pega as variaveis compartilhadas de outro código
    include_once("conexao.php");//pega os dados do banco de dados

    $id=filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);

    $result_usuario="SELECT * FROM funcionarios WHERE ID_FUNCIONARIO = '$id'";//string para ver os campos da tabela identificados pelo id e sua inserção
    
    $resultado_usuario=mysqli_query($conn,$result_usuario);// executa 
    $row_usuario=mysqli_fetch_assoc($resultado_usuario);// é usada para retornar uma matriz associativa representando a próxima linha no conjunto de resultados representado pelo parâmetro result , aonde cada chave representa o nome de uma coluna do conjunto de resultados.


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Editar</title>
</head>
<body>
    <a href="cad_usuario.php">cadastrar</a><br>
    <a href = "index.php">listar</a><br>
    <h1>Editar Usuário</h1>
    <?php
    if(isset($_SESSION['msg'])){//serve para dar a mensagem de cadastrado ou não//isset = basicamente verifica a existência de uma variável
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);//unset tira o valor da variavel ou finalizar
    }
    ?>
    <h1>Editar funcionário</h1>

    <form method="post" action= "proc_edit_usuario.php" enctype="multipart/form-data">
        
        <input type="hidden" name="id" value="<?php echo $row_usuario['ID_FUNCIONARIO'];?>">
        
        <label>Nome: </label>
        <input type="text" name="nome" placeholder="Digite o nome completo" autofocus value="<?php echo $row_usuario['NOME_FUNCIONARIO'];?>"><br><br>

        <input type="text" placeholder="nome do usuario" name="usuario" required value="<?php echo $row_usuario['USUARIO_FUNCIONARIO'];?>"><br><br> 

        <input type="password" placeholder="Digite uma nova senha se necessario" name="senha_funcionario"><br><br>

        
        <label for="">Alterar Foto</label>
        <input type="file" placeholder="Adicione uma foto" name="img" accept="image/*">
        <input type="submit" value="salvar">

        <br>
        <br>

        <img src="<?php echo $row_usuario['IMAGEM_FUNCIONARIO'];?>" name="img" type="file" height="100px" width="100px">

    </form>
</body>
</html>