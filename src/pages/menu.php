<?php
    session_start();
    if ($_SESSION['login'] != 1) {
        header("Location: ./login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Incluindo os arquivos CSS do Bootstrap -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../src/styles/menu/style.css">
    <title>Menu</title>

</head>

<body>

<nav class="navbar navbar-expand-lg ">

<div class="container">

    <a class="navbar-brand" href="./menu.php">

      <img src="../../assets/images/logo.png" id="logo" alt="Logo" width="30" height="30">

    
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

       <div class="collapse navbar-collapse justify-content-end header" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link linkss" href="./tela_inicial.php">Home</a>
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
            <a class="dropdown-item" href="./cadastro_funcionario.php">Cadastrar Funcionário</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</div>
<?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
    echo '<script>
        const notificacao = document.querySelector(".notificacao");
        const tempo = document.querySelector(".tempo");
        let timer1;

        if (notificacao) {
            notificacao.classList.add("active");
            tempo.classList.add("active");
            timer1 = setTimeout(() => {
                notificacao.classList.remove("active");
                tempo.classList.remove("active");
                notificacao.style.display = "none";
            }, 5000); // 1s = 1000 milliseconds
        }

        const closeIcon = document.querySelector(".close");

        if (closeIcon) {
            closeIcon.addEventListener("click", () => {
                notificacao.classList.remove("active");
                tempo.classList.remove("active");
                notificacao.style.display = "none";
                clearTimeout(timer1);
            });
        }

        
    </script>';
    unset($_SESSION['msg']);
    }
    ?>
   <main>
    <div class="card" href="../">
        <a href="./abrir_chamado.php">
            <div class="imgBX">
                <img src="../../assets/images/menu/notificacao.png" style="top: 35px; width: 77%;" alt="Abertura de Lista de Serviço">
            </div>
            <div class="content">
                <div class="details">
                    <h2>Abertura Serviço</h2>
                </div>
            </div>
        </a>
    </div>

    <div class="card">
        <a href="./lista_chamados.php">
            <div class="imgBX">
                <img src="../../assets/images/menu/lista_chamados.png" alt="Lista de Serviço">
            </div>
            <div class="content">
                <div class="details">
                    <h2>Lista de Serviço</h2>
                </div>
            </div>
        </a>
    </div>

    <div class="card">
        <a href="./cadastro_funcionario.php">
            <div class="imgBX">
                <img src="../../assets/images/menu/adicionar-usuario.png" alt="Adicionar Funcionários">
            </div>
            <div class="content">
                <div class="details">
                    <h2>Adicionar Funcionários</h2>
                </div>
            </div>
        </a>
    </div>

    <div class="card" >
        <a href="./lista_funcionarios.php">
            <div class="imgBX">
                <img src="../../assets/images/menu/groupe.png" alt="Lista de Funcionários">
            </div>
            <div class="content">
                <div class="details">
                    <h2>Lista de Funcionários</h2>
                </div>
            </div>
        </a>
    </div>

    <div class="card">
    <a href="./relatorio.php">
        <div class="imgBX">
            <img src="../../assets/images/menu/grafico.png" alt="Relatórios">
        </div>
        <div class="content">
            <div class="details">
                <h2>Relatórios</h2>
            </div>
        </div>
    </a> 
</div>
</main>




    <footer class="footer">
        <div>
            <img id="logo_equipe" src="../../assets/images/logo_equipe.png" alt="">
        </div> 
        <div class="container">
          <p class="d-flex justify-content-center align-items-center">© ProTask. Todos os direitos reservados.</p>

        </div>                
    </footer>
    
    <!-- Incluindo os arquivos JavaScript do Bootstrap (opcional) -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>






