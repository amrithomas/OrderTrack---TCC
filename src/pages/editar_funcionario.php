<?php

session_start();
include_once('../../conection.php');
$id = $_GET['id'];

$_SESSION['id'] = $id;

$result_usuario = "SELECT * FROM funcionarios WHERE ID_FUNCIONARIO = '$id'"; //string para ver os campos da tabela identificados pelo id e sua inserção

$resultado_usuario = mysqli_query($conn, $result_usuario); // executa 
$row_usuario = mysqli_fetch_assoc($resultado_usuario); // é usada para retornar uma matriz associativa representando a próxima linha no conjunto de resultados representado pelo parâmetro result , aonde cada chave representa o nome de uma coluna do conjunto de resultados.

//setando data e hora do br
date_default_timezone_set('America/Sao_Paulo');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Editar Funcionario</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../styles/editar_chamado/style.css">
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="../../assets/images/logo.png" id="logo" alt="Logo" width="30" height="30">

        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end header" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link linkss" href="#">Home</a>
            </li>

            <li class="nav-item dropdown linkss">
              <a class="nav-link dropdown-toggle links" href="#" id="chamadosDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Chamados <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                </svg>
              </a>

              <div class="dropdown-menu" aria-labelledby="chamadosDropdown">
                <a class="dropdown-item" href="./lista_chamados.php">Lista de Chamados</a>
                <a class="dropdown-item" href="./abrir_chamado.php">Abrir Chamado</a>
              </div>
            </li>

            <li class="nav-item dropdown ">
              <a class="nav-link dropdown-toggle linkss" href="#" id="funcionariosDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Funcionários <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                </svg>
              </a>

              <div class="dropdown-menu" aria-labelledby="funcionariosDropdown">
                <a class="dropdown-item" href="./lista_funcionarios.php">Lista de Funcionários</a>
                <a class="dropdown-item" href="./cadastrar_funcionario.php">Cadastrar Funcionário</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <main>
    <div class="container">
      <div class="container contianer-form">
        <div class="text-start">
          <h2 class="d-flex justify-content-center align-items-center titulo">Editar Funcionario</h2>
          <form action="" method="post">
            <div class="employee-image">

              <img src="../../assets/images/telaPrincipal/funcionario.png" alt="Foto do Funcionário">

              <input type="file" placeholder="Adicione uma foto" name="img" accept="image/*">

            </div>

            <div class="form-group">
              <input type="text" class="form-control" name="nome" placeholder="Nome" value="" required>
            </div>

            <div class="form-group">
              <input type="text" class="form-control" name="sobrenome" placeholder="Sobrenome" value="" required>
            </div>

            <div class="d-flex justify-content-center align-items-center">
              <button type="submit" class="btn">Editar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>

  <footer class="mt-5 footer">
    <p class="d-flex justify-content-center align-items-center">&copy; ProTask . Todos os direitos reservados.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>