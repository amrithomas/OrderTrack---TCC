<?php

session_start();
include_once('../../conection.php');
$id = $_GET['id'];

$_SESSION['id'] = $id;

$result_usuario="SELECT * FROM ordem WHERE ID_ORDEM = '$id'";//string para ver os campos da tabela identificados pelo id e sua inserção
    
$resultado_usuario= mysqli_query($conn, $result_usuario);// executa 
$row_usuario = mysqli_fetch_assoc($resultado_usuario);// é usada para retornar uma matriz associativa representando a próxima linha no conjunto de resultados representado pelo parâmetro result , aonde cada chave representa o nome de uma coluna do conjunto de resultados.


//setando data e hora do br
 date_default_timezone_set('America/Sao_Paulo');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Funcionários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../styles/editar_chamado/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg ">
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
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
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
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                      </svg>
                  </a>

                  <div class="dropdown-menu" aria-labelledby="funcionariosDropdown">
                    <a class="dropdown-item" href="./lista_funcionarios.php">Lista de Funcionários</a>
                    <a class="dropdown-item" href="./cadastrar_funcionario.php">Cadastrar Funcionário</a>
                  </div>
                </li>
              </ul>
            </div>
          </nav>
        </div>

      
        <div class="container">
    <div class="container container-form">
        <h2 class="d-flex justify-content-center align-items-center titulo">Editar Funcionário</h2>
        <form class="cont-form" method="post" action="../../src/api/controller/proc_edit_funcionario.php">
            <div class="form-group">
                <label for="nomeFuncionario">Nome do Funcionário:</label>
                <input type="text" class="form-control" id="nomeFuncionario" name="nome" value="<?php echo $row_usuario['SERVICO']; ?>" required>
            </div>

            <div class="form-group" style="display: flex; gap: 20px;">
                <div style="flex: 1;">
                    <label for="usuario">Usuário:</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $row_usuario['SERVICO']; ?>" required>
                </div>
                <div style="flex: 1;">
                    <label for="senha">Senha:</label>
                    <input class="form-control" id="senha" name="password" rows="4" value="<?php echo $row_usuario['LOCALIZACAO']; ?>" required>
                </div>
            </div>

            <div style="display: flex;">
                <div style="flex: 1;">
                    <label for="imagemUpload" class="form-label">Imagem:</label>
                    <div style="width: 200px; height: 200px; border: 1px solid #ccc;">
                        <img id="imagemPreview" src="caminho_para_sua_imagem.jpg" alt="Imagem" style="max-width: 100%; max-height: 100%; display: block; margin: auto;">
                    </div>
                    <input type="file" id="imagemUpload" name="imagem" accept="image/*" required onchange="previewImagem(this);">
                </div>
                <div style="flex: 1;">
                    <div class="form-group">
                        <label for="inputDate">Data Final: <span id="asterisco">*</span></label><br>
                        <input type="date" name='prazo' id="inputDate" value="<?php echo $row_usuario['PRAZO']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="statusSelect">Status Ordem:</label>
                        <select class="form-select" name='status' style="width: 200px;" id="statusSelect" required>
                            <option value="<?php echo $row_usuario['STATUS']; ?>"><?php echo $row_usuario['STATUS']; ?></option>
                            <option value='PENDENTE'>PENDENTE</option>
                            <option value='EM ANDAMENTO'>EM ANDAMENTO</option>
                            <option value='CONCLUIDO'>CONCLUIDO</option>
                            <option value='CANCELADO'>CANCELADO</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center align-items-center" style="margin-top: 50px;">
                <button type="submit" class="btn">Enviar</button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImagem(input) {
        var imagemPreview = document.getElementById('imagemPreview');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                imagemPreview.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>




    <footer class="footer">
        <p class="d-flex justify-content-center align-items-center">© OrderTech. Todos os direitos reservados.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

      
    
</body>
</html>






