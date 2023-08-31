<?php
session_start();
//Conexão com o banco
include_once("conexao.php");

// Verificando se foi obtido o id do usuario
if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];
    
    // Pegando dados do funcionario
    $linha_funcionario = "SELECT * FROM funcionarios WHERE ID_FUNCIONARIO = $id_usuario";
    $resultado_funcio = mysqli_query($conn, $linha_funcionario);
    $dados_funcionario = mysqli_fetch_assoc($resultado_funcio);
    
    // Pegando dados do relacionamento do funcionario e do chamado
    $relacao_funcion = "SELECT * FROM rel WHERE FK_FUNCIONARIO = $id_usuario";
    $resultado_relacaofun = mysqli_query($conn,$relacao_funcion);

    
   
   
    //Setando data e hora do br
    date_default_timezone_set('America/Sao_Paulo');

}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Profile</title>
</head>
<body>  
    <?php
        //Contador de chamados por funcionario
        $conta_chamados = mysqli_query($conn, "SELECT COUNT(*) as contando_chamados FROM rel INNER JOIN ordem ON rel.FK_ORDEM = ordem.ID_ORDEM WHERE rel.FK_FUNCIONARIO =  $id_usuario and ordem.STATUS = 'EM ANDAMENTO'");
        $result_chamados = mysqli_fetch_assoc($conta_chamados);
        $resultado_contador_chamados = $result_chamados['contando_chamados']
        
    ?>





    <h1>User Profile</h1>

    <?php   if ($dados_funcionario): ?>
    <h2>Nome: <?php echo htmlspecialchars($dados_funcionario['NOME_FUNCIONARIO']); ?></h2>
    <p>Chamados Pendentes: <?php echo $resultado_contador_chamados; ?> </p>
    <?php if (file_exists($dados_funcionario['IMAGEM_FUNCIONARIO'])): ?>
        <img src="<?php echo htmlspecialchars($dados_funcionario['IMAGEM_FUNCIONARIO']); ?>" width="200"><br>
    <?php endif; ?>
    <br>
    <br>

    <br>
    <br>
    
    <h1>Chamados Vinculados</h1>

        <?php while($call = mysqli_fetch_assoc($resultado_relacaofun)): $query_chamado2 = "SELECT * FROM ordem WHERE ID_ORDEM = '" . $call['FK_ORDEM'] . "'";
                $result_chamados2 = mysqli_query($conn, $query_chamado2);?>
               
        
        <?php while ($chamados = mysqli_fetch_assoc($result_chamados2)):  if($chamados['STATUS'] != 'CANCELADO'):?>

            <?php echo $chamados['ID_ORDEM'];?>
            <?php
                if(!empty($chamados['FOTO']) AND $chamados != null){
                    echo '<p style="font-size: 20px; color: red;"><BR>Foto do Local: <br> </p> <p></p><img src="' . $chamados['FOTO'] . '" alt="Foto do chamado" width="200" height="200">';
                }
            ?>
            <p style="font-size: 20px; color: red;"><BR>Serviço a ser feito: <br> </p> <p></p><?php echo $chamados['SERVICO']; ?></p>
            <p style="font-size: 20px; color: red;">Local: <br> </p> <p></p><?php echo $chamados['LOCALIZACAO']; ?></p>
            <p style="font-size: 20px; color: red;">Descrição: <br> </p> <p></p><?php echo $chamados['ITEM']; ?></p>
            <p style="font-size: 20px; color: red;">Prioridade: <br> </p> <p></p><?php echo $chamados['PRIORIDADE']; ?></p>
            <p style="font-size: 20px; color: red;">STATUS:<br>
            <select class="status-select" data-callid="<?php echo $chamados['ID_ORDEM']; ?>">
                <option value="PENDENTE" <?php if ($chamados['STATUS'] === 'PENDENTE') echo 'selected'; ?>>PENDENTE</option>
                <option value="EM ANDAMENTO" <?php if ($chamados['STATUS'] === 'EM ANDAMENTO') echo 'selected'; ?>>EM ANDAMENTO</option>
                <option value="CONCLUIDO" <?php if ($chamados['STATUS'] === 'CONCLUIDO') echo 'selected'; ?>>CONCLUIDO</option>
            </select>
            </p>
            <input type="hidden" id="call_id" value="<?php echo $chamados['ID_ORDEM']; ?>">
            <p style="font-size: 20px; color: red;">Data final cumpri-lo: <br> </p> <p></p><?php echo date('d/m/Y', strtotime($chamados['PRAZO'])); ?></p>
            <p style="font-size: 20px; color: red;">------------------------------------------------------------------------</p>
        <?php endif; endwhile; ?>
        <?php endwhile; ?>

    <?php else: ?>
        <p>User not found.</p>
    <?php endif; ?>
</body>

<script>
    // Obtendo todos os elementos de seleção de status
    const statusSelects = document.querySelectorAll('.status-select');

    // Iterar sobre cada elemento de seleção de status
    statusSelects.forEach(function (statusSelect) {
        statusSelect.addEventListener('change', function () {
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
    });
</script>



</html>


