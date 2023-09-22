<?php
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $dbname = "order_tech";
    
    // criar a conexão - string de conexão
    $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

    $id = $_GET['id'];

    $resultado = "UPDATE ordem SET STATUS = 'CANCELADO' WHERE ordem.ID_ORDEM = $id";
    $query = mysqli_query($conn, $resultado);
    
    if(mysqli_affected_rows($conn)){
        header("Location: ../../pages/lista_chamados.php");
    }

?>