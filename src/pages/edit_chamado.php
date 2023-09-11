
<?php

    session_start();//pega as variaveis compartilhadas de outro código
    include_once("conexao.php");//pega os dados do banco de dados

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  

    $result_usuario="SELECT * FROM ordem WHERE ID_ORDEM = '$id'";//string para ver os campos da tabela identificados pelo id e sua inserção
    
    $resultado_usuario= mysqli_query($conn, $result_usuario);// executa 
    $row_usuario= mysqli_fetch_assoc($resultado_usuario);// é usada para retornar uma matriz associativa representando a próxima linha no conjunto de resultados representado pelo parâmetro result , aonde cada chave representa o nome de uma coluna do conjunto de resultados.

    
    //setando data e hora do br
     date_default_timezone_set('America/Sao_Paulo');
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
    
    <a href = "lista_chamados.php">listar</a><br>
   
    <?php
    if(isset($_SESSION['msg'])){//serve para dar a mensagem de cadastrado ou não//isset = basicamente verifica a existência de uma variável
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);//unset tira o valor da variavel ou finalizar
    }
    ?>
    <h1>Editar chamado</h1>

    <form method="post" action= "proc_edit_chamado.php" >
        
        <input type="hidden" name="ID_ORDEM" value="<?php echo $row_usuario['ID_ORDEM'];?>">
        
        <label>Nome: </label>
        <input type="text" name="SERVICO" placeholder="TÍTULO DA TAREFA" autofocus value="<?php echo $row_usuario['SERVICO'];?>"><br><br>

        <textarea rows="5" cols="30" name="ITEM"  placeholder="Descrição da tarefa" ><?php echo $row_usuario['ITEM'];?></textarea><br><br>

        <input type="text" placeholder="LOCAL" name='LOCAL' value="<?php echo $row_usuario['LOCALIZACAO'];?>"><br><br>

        <input type="date" name="PRAZO" id='PRAZO' value="<?php echo $row_usuario['PRAZO'];?>"><br><br>
        <select class="status-select" data-callid="<?php echo $row_usuario['ID_ORDEM']; ?>">
                <option value="PENDENTE" <?php if ($row_usuario['STATUS'] === 'PENDENTE') echo 'selected'; ?>>PENDENTE</option>
                <option value="EM ANDAMENTO" <?php if ($row_usuario['STATUS'] === 'EM ANDAMENTO') echo 'selected'; ?>>EM ANDAMENTO</option>
                <option value="CONCLUIDO" <?php if ($row_usuario['STATUS'] === 'CONCLUIDO') echo 'selected'; ?>>CONCLUIDO</option>
                <option value="CANCELADO" <?php if ($row_usuario['STATUS'] === 'CANCELADO') echo 'selected'; ?>>CANCELADO</option>
        </select>
        <Br>

        
        <label for="">Urgência do Chamado:</label>
        <select name="urgencia" id="urgencia">
            <option value="baixa" <?php if ($row_usuario['PRIORIDADE'] === 'BAIXA') echo 'selected'; ?>>Baixa</option>
            <option value="media" <?php if ($row_usuario['PRIORIDADE'] === 'MEDIA') echo 'selected'; ?>>Média</option>
            <option value="prioridade" <?php if ($row_usuario['PRIORIDADE'] === 'ALTA') echo 'selected'; ?>>Alta</option>
        </select>
        <br>
        <input type="submit" value="enviar" onclick='cancelar()'>  
         
        <script>
            function cancelar() {
                if (confirm("Deseja realmente atualizar o chamado?")) {
                    // Obtendo todos os elementos de seleção de status
                        const statusSelects = document.querySelectorAll('.status-select');

                    // Iterar sobre cada elemento de seleção de status
                    statusSelects.forEach(function (statusSelect) {
                            const status = statusSelect.value;
                            const callId = statusSelect.getAttribute('data-callid');
                            // Atualizando o valor no com com ajax
                            const xhr = new XMLHttpRequest();
                            xhr.open('POST', 'atualizar_status.php', true);
                            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                            xhr.onreadystatechange = function () {
                                if (xhr.readyState === XMLHttpRequest.DONE) {
                                    if (xhr.status === 200) {
                                        // Deu bom meu fih
                                        alert(xhr.responseText);
                                    } else {
                                        //Mensagem de erro
                                        alert('Ocorreu um erro em atualizar o status.');
                                    }
                                }
                            };
                            // Enviando os dados pro banco
                            const data = `status=${encodeURIComponent(status)}&call_id=${encodeURIComponent(callId)}`; 
                            xhr.send(data);
                        
                    });
                }

            }
        </script>



      
 
    </form>


</body>
</html>