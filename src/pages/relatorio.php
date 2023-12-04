<?php 
  include_once('../../conection.php');
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
    <link rel="shortcut icon" type="png" href="../../assets/images/icone_logo.png">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Inclua a biblioteca Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  

    <!-- Incluindo os arquivos CSS do Bootstrap -->

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="../../src/styles/relatorios/stylee.css">

    <title>Relatórios</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

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
          <a class="nav-link linkss" href="../../index.php">Home</a>
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


<div class="div-notificacao">

</div>


    <main>
        <div class="formEstilo">
          <div class="container">
            <h1 id="titulo">Controle de Rendimento dos Funcionários</h1>
            <label for="relatorio">Relatórios:</label>
            <select name="relatorio" id="relatorio" onchange="mostrarFormulario()">
              <option value="mensal">Mensal</option>
              <option value="semanal">Semanal</option>
              <option value="diario">Diário</option>
              <option value="anual">Anual</option>
            </select>
          </div>
            
                      
          <?php


            // Formulário Mensal
            echo "<div class='container'>";
            echo "<form id='formMensal' action='../api/controller/proc_relatorios.php' method='post' style='display:none;'>";
            echo "<input type='month' name='mes' id='mes' max='" . date('Y-m') . "' required>";
            echo "<input type='button' value='Gerar Relatório' id='gerar-button' onclick='enviarFormulario(\"formMensal\");' />";
            echo "</form>";
            echo "</div>";

            // Formulário Anual
            echo "<div class='container'>";
            echo "<form id='formAnual' action='../api/controller/proc_relatorio_anual.php' method='POST' style='display:none;'>";
            echo "<label for='ano'>Selecione o ano:</label>";
            echo "<select name='ano' id='ano' required>";
            $anoAtual = date('Y');
            for ($ano = 1990; $ano <= $anoAtual; $ano++) {
                echo "<option value='$ano'>$ano</option>";
            }
            echo "</select>";
            echo "<input type='button' value='Gerar Relatório' id='gerar-button' onclick='enviarFormulario(\"formAnual\");' />";
            echo "</form>";
            echo "</div>";

            // Formulário Semanal
            echo "<div class='container'>";
            echo "<form id='formSemanal' action='../api/controller/proc_semanal.php' method='post' style='display:none;'>";
            echo "<input type='week' name='semana' id='semana' max='" . date('Y-\WW') . "' required>";
            echo "<input type='button' value='Gerar Relatório' id='gerar-button' onclick='enviarFormulario(\"formSemanal\");' />";
            echo "</form>";
            echo "</div>";

            // Formulário Diário
            echo "<div class='container'>";
            echo "<form id='formDiario' action='../api/controller/proc_relatorio_dia.php' method='post' style='display:none;'>";
            echo "<input type='date' name='dia' id='dia' max='" . date("Y-m-d") . "' required>";
            echo "<input type='button' value='Gerar Relatório' id='gerar-button' onclick='enviarFormulario(\"formDiario\");' />";
            echo "</form>";
            echo "</div>";
            ?>

        </div>

        <div class="graficoEstilo"><!-- Local onde o gráfico será renderizado -->
            <canvas id="graficoSemanal" class="canvas" style="display:none;"></canvas>
            <canvas id="graficoMensal" class="canvas" style="display:none;"></canvas>
            <canvas id="graficoDiario" class="canvas" style="display:none;"></canvas>
            <canvas id="graficoAnual" class="canvas" style="display:none;"></canvas>
        </div> 
            <div id="resultado"></div>
        
        <script src="../js/relatorios/scriptt.js"></script>
        
    </main>
    
    <footer class="footer">
        <div>
            <img id="logo_equipe" src="../../assets/images/logo_equipe.png" alt="">
        </div>
        <div class="container">
            <p class="d-flex justify-content-center align-items-center">© ProTask. Todos os direitos reservados.</p>
        </div>
    </footer>

    <script>

      function timeAlert(){
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
                notificacao.remove();
            }, 5000); // 1s = 1000 milliseconds
        }

        const closeIcon = document.querySelector(".close");

        if (closeIcon) {
            closeIcon.addEventListener("click", () => {
                notificacao.classList.remove("active");
                tempo.classList.remove("active");
                notificacao.style.display = "none";
                notificacao.remove();
                clearTimeout(timer1);
            });
        }
        
      }
   
    </script>

    
    <!-- Incluindo os arquivos JavaScript do Bootstrap (opcional) -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   
  

</body>
</html>




