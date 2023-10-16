// Variáveis para armazenar os gráficos
var graficoSemanal = null;
var graficoMensal = null;
var graficoDiario = null;
var graficoAnual = null;

// Certifique-se de que o documento está pronto antes de executar o código JavaScript
$(document).ready(function() {
    // Verifique se os IDs dos elementos <canvas> correspondem aos IDs usados nas funções JavaScript
    var graficoSemanalCanvas = document.getElementById('graficoSemanal');
    var graficoMensalCanvas = document.getElementById('graficoMensal');
    var graficoDiarioCanvas = document.getElementById('graficoDiario');
    var graficoAnualCanvas = document.getElementById('graficoAnual');

    if (!graficoSemanalCanvas || !graficoMensalCanvas || !graficoDiarioCanvas || !graficoAnualCanvas) {
        console.error('Um ou mais elementos <canvas> não foram encontrados.');
        return;
    }
});

// Função para criar ou atualizar o gráfico de relatório semanal
function criarOuAtualizarGraficoSemanal(dados) {
    if (graficoSemanal) {
        graficoSemanal.destroy();
    }

    var canvas = document.getElementById('graficoSemanal');
    if (!canvas) {
        console.error('Elemento de gráfico semanal não encontrado.');
        return;
    }

    var ctx = canvas.getContext('2d');
    if (!ctx) {
        console.error('Contexto de gráfico semanal não encontrado.');
        return;
    }

    graficoSemanal = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Total de Ordens', 'Pendentes', 'Em Andamento', 'Concluídas', 'Canceladas'],
            datasets: [{
                label: 'Estatísticas Semanais',
                data: dados,
                backgroundColor: [
                    'rgba(0, 0, 255, 0.5)',  // Azul para "Total de Ordens"
                    'rgba(255, 0, 0, 0.2)',  // Vermelho para "Pendentes"
                    'rgba(255, 206, 86, 1)',  // Amarelo para "Em Andamento"
                    'rgba(0, 128, 0, 0.2)',  // Verde para "Concluídas"
                    'rgba(0, 128, 0, 0.2)'  // Verde para "Canceladas"
                ],
                borderColor: [
                    'rgba(0, 0, 255, 1)',  // Azul para "Total de Ordens"
                        'rgba(255, 0, 0, 1)',  // Vermelho para "Pendentes"
                        'rgba(255, 206, 86, 1)',  // Amarelo para "Em Andamento"
                        'rgba(0, 128, 0, 1)',  // Verde para "Concluídas"
                        'rgba(0, 128, 0, 1)'  // Verde para "Canceladas"
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    stacked: true
                },
                y: {
                    beginAtZero: true,
                    stepSize: 1  // Define o intervalo de incremento para 1
                }
            }
        }
    });
}

// Função para criar ou atualizar o gráfico de relatório mensal
function criarOuAtualizarGraficoMensal(dados) {
    if (graficoMensal) {
        graficoMensal.destroy();
    }

    var canvas = document.getElementById('graficoMensal');
    if (!canvas) {
        console.error('Elemento de gráfico mensal não encontrado.');
        return;
    }

    var ctx = canvas.getContext('2d');
    if (!ctx) {
        console.error('Contexto de gráfico mensal não encontrado.');
        return;
    }

    graficoMensal = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Total de Ordens', 'Pendentes', 'Em Andamento', 'Concluídas', 'Canceladas'],
            datasets: [{
                label: 'Estatísticas Mensais',
                data: dados,
                backgroundColor: [
                    'rgba(0, 0, 255, 0.5)',  // Azul para "Total de Ordens"
                        'rgba(255, 0, 0, 0.2)',  // Vermelho para "Pendentes"
                        'rgba(255, 206, 86, 0.2)',  // Amarelo para "Em Andamento"
                        'rgba(0, 128, 0, 0.2)',  // Verde para "Concluídas"
                        'rgba(0, 128, 0, 0.2)'  // Verde para "Canceladas"
                ],
                borderColor: [
                    'rgba(0, 0, 255, 1)',  // Azul para "Total de Ordens"
                    'rgba(255, 0, 0, 1)',  // Vermelho para "Pendentes"
                    'rgba(255, 206, 86, 1)',  // Amarelo para "Em Andamento"
                    'rgba(0, 128, 0, 1)',  // Verde para "Concluídas"
                    'rgba(0, 128, 0, 1)'  // Verde para "Canceladas"
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    stacked: true
                },
                y: {
                    beginAtZero: true,
                    stepSize: 1  // Define o intervalo de incremento para 1
                }
            }
        }
    });
}

// Função para criar ou atualizar o gráfico de relatório diário
function criarOuAtualizarGraficoDiario(dados) {
    if (graficoDiario) {
        
    }

    var canvas = document.getElementById('graficoDiario');
    if (!canvas) {
        console.error('Elemento de gráfico diário não encontrado.');
        return;
    }

    var ctx = canvas.getContext('2d');
    if (!ctx) {
        console.error('Contexto de gráfico diário não encontrado.');
        return;
    }

    graficoDiario = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Total de Ordens', 'Pendentes', 'Em Andamento', 'Concluídas', 'Canceladas'],
            datasets: [{
                label: 'Estatísticas Diárias',
                data: dados,
                backgroundColor: [
                    'rgba(0, 0, 255, 0.5)',  // Azul para "Total de Ordens"
                    'rgba(255, 0, 0, 0.2)',  // Vermelho para "Pendentes"
                    'rgba(255, 206, 86, 0.2)',  // Amarelo para "Em Andamento"
                    'rgba(0, 128, 0, 0.2)',  // Verde para "Concluídas"
                    'rgba(0, 128, 0, 0.2)'  // Verde para "Canceladas"
                ],
                borderColor: [
                    'rgba(0, 0, 255, 1)',  // Azul para "Total de Ordens"
                        'rgba(255, 0, 0, 1)',  // Vermelho para "Pendentes"
                        'rgba(255, 206, 86, 1)',  // Amarelo para "Em Andamento"
                        'rgba(0, 128, 0, 1)',  // Verde para "Concluídas"
                        'rgba(0, 128, 0, 1)'  // Verde para "Canceladas"
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    stacked: true
                },
                y: {
                    beginAtZero: true,
                    stepSize: 1  // Define o intervalo de incremento para 1
                }
            }
        }
    });
}

// Função para criar ou atualizar o gráfico de relatório anual
function criarOuAtualizarGraficoAnual(dados) {
    if (graficoAnual) {
        graficoAnual.destroy();
    }

    var canvas = document.getElementById('graficoAnual');
    if (!canvas) {
        console.error('Elemento de gráfico anual não encontrado.');
        return;
    }

    var ctx = canvas.getContext('2d');
    if (!ctx) {
        console.error('Contexto de gráfico anual não encontrado.');
        return;
    }

    graficoAnual = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Total de Ordens', 'Pendentes', 'Em Andamento', 'Concluídas', 'Canceladas'],
            datasets: [{
                label: 'Estatísticas Anuais',
                data: dados,
                backgroundColor: [
                    'rgba(0, 0, 255, 0.5)',  // Azul para "Total de Ordens"
                    'rgba(255, 0, 0, 0.2)',  // Vermelho para "Pendentes"
                    'rgba(255, 206, 86, 0.2)',  // Amarelo para "Em Andamento"
                    'rgba(0, 128, 0, 0.2)',  // Verde para "Concluídas"
                    'rgba(0, 128, 0, 0.2)'  // Verde para "Canceladas"
                ],
                borderColor: [
                    'rgba(0, 0, 255, 1)',  // Azul para "Total de Ordens"
                    'rgba(255, 0, 0, 1)',  // Vermelho para "Pendentes"
                    'rgba(255, 206, 86, 1)',// Amarelo para "Em Andamento"
                    'rgba(0, 128, 0, 1)',  // Verde para "Concluídas"
                    'rgba(0, 128, 0, 1)'  // Verde para "Canceladas"
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    stacked: true
                },
                y: {
                    beginAtZero: true,
                    stepSize: 1  // Define o intervalo de incremento para 1
                  
                }
            }
        }
    });
}

// Função para enviar o formulário via AJAX
function enviarFormulario(formularioId) {
    var formElement = document.getElementById(formularioId);

    if (formElement && formElement.checkValidity()) {
        var formData = new FormData(formElement);

        $.ajax({
            type: 'POST',
            url: formElement.action, // Usando a URL do formulário como a URL de envio
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                try {
                    // Verifique se a resposta contém um campo "error"
                    if (response.error) {
                        console.error('Erro do servidor:', response.error);
                    } else if (typeof response.data !== 'undefined') {
                        // Chame a função apropriada para criar ou atualizar o gráfico com base na resposta
                        if (formularioId === 'formSemanal') {
                            criarOuAtualizarGraficoSemanal(response.data);
                        } else if (formularioId === 'formMensal') {
                            criarOuAtualizarGraficoMensal(response.data);
                        } else if (formularioId === 'formDiario') {
                            criarOuAtualizarGraficoDiario(response.data);
                        } else if (formularioId === 'formAnual') {
                            criarOuAtualizarGraficoAnual(response.data);
                        }
                    } else {
                        // A resposta não é válida
                        console.error('A resposta do servidor não é válida.');
                    }
                } catch (e) {
                    // Ocorreu um erro ao processar a resposta como JSON
                    console.error('Ocorreu um erro ao processar a resposta do servidor:', e);
                }
            },
            error: function(xhr, status, error) {
                console.error('Status:', status);
                console.error('Error:', error);
                alert('Ocorreu um erro ao enviar o formulário.');
            }
        });
    } else {
        alert('Por favor, preencha todos os campos corretamente.');
    }
}

// Função para mostrar o formulário com base no relatório selecionado e destruir gráficos existentes
function mostrarFormulario() {
    var relatorioSelecionado = document.getElementById("relatorio").value;
    var formMensal = document.getElementById("formMensal");
    var formAnual = document.getElementById("formAnual");
    var formSemanal = document.getElementById("formSemanal");
    var formDiario = document.getElementById("formDiario");

    // Destrói os gráficos existentes antes de ocultar os formulários
    if (graficoSemanal) {
        graficoSemanal.destroy();
        graficoSemanal = null;
    }
    if (graficoMensal) {
        graficoMensal.destroy();
        graficoMensal = null;
    }
    if (graficoDiario) {
        graficoDiario.destroy();
        graficoDiario = null;
    }
    if (graficoAnual) {
        graficoAnual.destroy();
        graficoAnual = null;
    }

    formMensal.style.display = (relatorioSelecionado === "mensal") ? "block" : "none";
    formAnual.style.display = (relatorioSelecionado === "anual") ? "block" : "none";
    formSemanal.style.display = (relatorioSelecionado === "semanal") ? "block" : "none";
    formDiario.style.display = (relatorioSelecionado === "diario") ? "block" : "none";
}

// Função para executar quando o documento estiver pronto
$(document).ready(function() {
    mostrarFormulario();
});
