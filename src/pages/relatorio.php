<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    function mostrarFormulario() {
      var relatorioSelecionado = document.getElementById("relatorio").value;
      var formMensal = document.getElementById("formMensal");
      var formAnual = document.getElementById("formAnual");
      var formSemanal = document.getElementById("formSemanal");
      var formDiario = document.getElementById("formDiario");

      formMensal.style.display = (relatorioSelecionado === "mensal") ? "block" : "none";
      formAnual.style.display = (relatorioSelecionado === "anual") ? "block" : "none";
      formSemanal.style.display = (relatorioSelecionado === "semanal") ? "block" : "none";
      formDiario.style.display = (relatorioSelecionado === "diario") ? "block" : "none";
    }

    function enviarFormulario(formularioId) {
      var formElement = document.getElementById(formularioId);

      if (formElement.checkValidity()) {
        var formData = new FormData(formElement);

        $.ajax({
          type: 'POST',
          url: $('#' + formularioId).attr('action'),
          data: formData,
          processData: false,
          contentType: false,
          success: function(response) {
            $('#resultado').html(response);
          },
          error: function() {
            alert('Ocorreu um erro ao enviar o formulário.');
          }
        });
      } else {
        alert('Por favor, preencha todos os campos corretamente.');
      }
    }

    // Executar a função mostrarFormulario inicialmente para exibir o formulário correto ao carregar a página
    $(document).ready(function() {
      mostrarFormulario();
    });
  </script>
</head>
<body>
    <label for="relatorio">Relatórios:</label>
    <select name="relatorio" id="relatorio" onchange="mostrarFormulario()">
        <option value="mensal">Mensal</option>
        <option value="semanal">Semanal</option>
        <option value="diario">Diario</option>
        <option value="anual">Anual</option>
    </select>

   <?php
    include_once('conexao.php');
    session_start();
    echo "<br>";
    echo "<br>";

    // Formulário Mensal
    echo "<form id='formMensal' action='proc_relatorios.php' method='post' style='display:none;'>";
    echo "<input type='month' name='mes' id='mes' max='" . date('Y-m') . "' required>";
    echo "<input type='button' value='Gerar Relatório' onclick='enviarFormulario(\"formMensal\");' />";
    echo "</form>";
  

    // Formulário Anual
    echo "<form id='formAnual' action='proc_relatorio_anual.php' method='POST' style='display:none;'>";
    echo "<label for='ano'>Selecione o ano:</label>";
    echo "<select name='ano' id='ano' required>";
    $anoAtual = date('Y');
    for ($ano = 2010; $ano <= $anoAtual; $ano++) {
        echo "<option value='$ano'>$ano</option>";
    }
    echo "</select>";
    echo "<input type='button' value='Gerar Relatório' onclick='enviarFormulario(\"formAnual\");' />";
    echo "</form>";
    
    // Formulário Semanal
    echo "<form id='formSemanal' action='proc_semanal.php' method='post' style='display:none;'>";
    echo "<input type='week' name='semana' id='semana' max='" . date('Y-\WW') . "' required>";
    echo "<input type='button' value='Gerar Relatório' onclick='enviarFormulario(\"formSemanal\");' />";
    echo "</form>";
    

    // Formulário Diário
    echo "<form id='formDiario' action='proc_relatorio_dia.php' method='post' style='display:none;'>";
    echo "<input type='date' name='dia' id='dia' max='" . date("Y-m-d") . "' required>";
    echo "<input type='button' value='Gerar Relatório' onclick='enviarFormulario(\"formDiario\");' />";
    echo "</form>";
    echo "<br>";
  ?>

  <div id="resultado"></div>
</body>
</html>
