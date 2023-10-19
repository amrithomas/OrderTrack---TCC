// Definindo a variável 'modal' no escopo global
let modal;

document.addEventListener('DOMContentLoaded', (event) => {
    // Atribuindo o elemento à variável 'modal' quando o DOM estiver completamente carregado
    modal = document.getElementById("myModal");

    window.aparecemodal = function(funcionarioId) {
        console.log("ID do funcionário selecionado:", funcionarioId);

        if (modal) {
            if (modal.classList.contains("sumiu")) {
                modal.classList.remove("sumiu");
                modal.classList.add("show");
            } else if (modal.classList.contains("show")) {
                modal.classList.remove("show");
                modal.classList.add("sumiu");
            } else {
                modal.classList.add("show");
            }

            // Faz uma solicitação AJAX para buscar os dados do funcionário
            $.ajax({
                url: '/sistema_os/churras/MeatGolden/sistema_OS/src/api/controller/getFuncionario.php',
                type: 'GET',
                data: { funcionarioID: funcionarioId },
                success: function(data) {
                    console.log("Dados recebidos:", data);
                    const response = JSON.parse(data);
            
                    if (response.success) {
                        // Aqui é onde você atualiza os detalhes do funcionário na modal
                        $('#nome').text(response.funcionario); // Adiciona o nome do funcionário
                        // Limpa a tabela antes de inserir novos dados
                        const tableBody = $('.modal-body tbody');
                        tableBody.empty();
            
                        const ordens = response.ordens;
            
                        ordens.forEach(ordem => {
                            // Criação de novas linhas na tabela para cada ordem
                            const row = $('<tr></tr>');
            
                            // Aqui você precisa ajustar de acordo com os dados que deseja exibir
                            row.append(`<td>Título do chamado: ${ordem.titulo}</td>`);
                            row.append(`<td>Status: ${ordem.status}</td>`);
                            row.append(`<td>Data: ${ordem.data}</td>`);
            
                            // Adiciona a nova linha à tabela
                            tableBody.append(row);
                        });
            
                        // Atualiza o nome do funcionário na modal
                        $('#nome').text(response.nome);
                    } else {
                        console.error(response.error);
                    }
                },
                error: function(error) {
                    console.error("Erro ao buscar os dados do funcionário", error);
                }
            });
            
        } else {
            console.error('O elemento modal não foi encontrado');
        }
    }
});

function fecharModal() {
    // Verifica se 'modal' é não-nulo e se contém a classe 'show'
    if (modal && modal.classList.contains("show")) {
        modal.classList.remove("show");
        modal.classList.add("sumiu");
    } else if (modal) {
        modal.classList.remove("sumiu");
        modal.classList.add("show");
    } else {
        console.error('O elemento modal não foi encontrado');
    }
}
