<?php
    include_once('conexao.php');
    session_start();


    if(isset($_SESSION['msg'])){//serve para dar a mensagem de cadastrado ou não//isset = basicamente verifica a existência de uma variável
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);//unset tira o valor da variavel ou finalizar
    }

    $pessoas = "SELECT * FROM funcionarios";
    $pessoa = mysqli_query($conn, $pessoas);
    $pessoaas = mysqli_fetch_assoc($pessoa);

?>   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="proc_chamado.php" method="post" enctype="multipart/form-data">

        <label for="">Título do chamado:</label>
        <input type="text" name="titulo_chamado" id="titulo_chamado" required>

        <br>
        <br>
    
        <label for="">Urgência do Chamado:</label>
        <select name="urgencia" id="urgencia">
            <option value="BAIXA">Baixa</option>
            <option value="MEDIA">Média</option>
            <option value="ALTA">Alta</option>
        </select>

        <br>
        <br>

        <label>Nome funcionarios</label>
        <select name="funcionarios" id="funcionarios">
            <?php
                $result_usuario = "SELECT * FROM funcionarios";
                $resultado_usuario = mysqli_query($conn, $result_usuario);
                while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
                    echo "<option value='" . $row_usuario['ID_FUNCIONARIO'] . "'>" . $row_usuario['NOME_FUNCIONARIO'] . "</option>";
                }
            ?>
            
        </select>

        <br>
        <br>

        <input type="text" placeholder="Local" name="local" required>

        <br>
        <br>
        <label for="">Descrição da Tarefa:</label> 
        <br>
        <br>
        <textarea rows="5" cols="30" name="descricao_tarefa" id="descricao_tarefa" placeholder="Descrição da tarefa"></textarea>
        <br>
        <br>
        <input type="date" name="data" id='data' min="<?php echo date("Y-m-d");?>" required>
        <br>
        <br>

        <label for="">Adicionar Foto</label>
        <input type="file" placeholder="Adicione uma foto" name="imagem" id="imagem" accept="image/*">

        <br>
        <br>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>
