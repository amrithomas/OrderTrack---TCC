<?php
session_start();
include_once("conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Document</title>
</head>
<body>
<div>
    <a href="cadastro.php">cadastrar</a>
    <h1>Listar Usuários</h1>
    <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }

        $pagina_atual=filter_input(INPUT_GET,'pagina',FILTER_SANITIZE_NUMBER_INT);
        $pagina=(!empty($pagina_atual))? $pagina_atual : 1;

        //setar a quantidade  de itens por pagina
        $qnt_result_pg=100;

        //calcular o inicio visualização
        $inicio=($qnt_result_pg * $pagina) - $qnt_result_pg;

        $result_usuario = "SELECT * FROM funcionarios LIMIT $inicio,$qnt_result_pg";
        $resultado_usuario = mysqli_query($conn,$result_usuario);
        while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
            if($row_usuario['STATUS_FUNCIONARIO'] == 'ATIVO'){
                echo "ID: " . $row_usuario['ID_FUNCIONARIO'] . "<br>";
                echo "Nome: " . $row_usuario['NOME_FUNCIONARIO'] . "<br>";

                // Wrap the image with an anchor tag and provide the destination URL
                if (file_exists($row_usuario['IMAGEM_FUNCIONARIO'])) {
                    // Use JavaScript to modify the URL and save the ID in the $_GET['id'] variable
                    echo "<a href='javascript:void(0);' onclick='redirectToProfile(".$row_usuario['ID_FUNCIONARIO'].")'>";
                    echo "<img src='".$row_usuario['IMAGEM_FUNCIONARIO']."' width='200'><br>";
                    echo "</a>";
                } 
                        
                echo "<a href='edit_usuario.php?id=".$row_usuario['ID_FUNCIONARIO']."'>Editar usuário</a><br>";
                echo "<a href='proc_desativar_usuario.php?id=".$row_usuario['ID_FUNCIONARIO']."'>Desativar funcionario</a><br><br>";


            }
            
        }
    ?>

    <!-- Rest of your pagination code here -->

    <script>
        function redirectToProfile(employeeId) {
            // Modify the URL and save the ID in the $_GET['id'] variable
            window.location.href = 'perfil.php?id=' + employeeId;
        }
    </script>
    </div>
</body>
</html>
