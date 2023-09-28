document.addEventListener('DOMContentLoaded', function () {
    const periodSelect = document.getElementById('period');
    const canvas = document.getElementById('myChart').getContext('2d');

    // Dados fictícios para demonstração
    const data = {
        semanal: [10, 20, 30, 40, 50],
        mensal: [50, 40, 30, 20, 10],
        anual: [100, 90, 80, 70, 60]
    };

    // Cria o gráfico inicial
    const myChart = new Chart(canvas, {
        type: 'bar',
        data: {
            labels: ['Funcionário 1', 'Funcionário 2', 'Funcionário 3', 'Funcionário 4', 'Funcionário 5'],
            datasets: [{
                label: 'Dados',
                data: data.semanal, // Inicie com dados semanais
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Atualizar o gráfico com base na seleção do período
    periodSelect.addEventListener('change', function () {
        const selectedPeriod = periodSelect.value;

        // Atualiza o gráfico com os dados correspondentes ao período selecionado
        myChart.data.datasets[0].data = data[selectedPeriod];
        myChart.update();
    });
});
