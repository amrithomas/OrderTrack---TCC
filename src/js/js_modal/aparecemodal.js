const modal = document.getElementById("myModal");

function aparecemodal(funcionarioId) {
    console.log("ID do funcionário selecionado:", funcionarioId);
    let funcionarioIdGlobal = funcionarioId; // Adicione este console.log
    console.log(funcionarioIdGlobal);
    if (modal.classList.contains("sumiu")) {
        modal.classList.remove("sumiu");
        modal.classList.add("show");

        // Exibe o ID do funcionário na modal após um pequeno atraso
        setTimeout(function () {
            const funcionarioIdElement = document.getElementById("funcionario-id");
            if (funcionarioIdElement) {
                funcionarioIdElement.textContent = funcionarioId;
            }
        }, 100); // Atraso de 100 milissegundos (ajuste conforme necessário)
    } else if (modal.classList.contains("show")) {
        modal.classList.remove("show");
        modal.classList.add("sumiu");
    } else {
        // Se a classe sumiu e "show" não estiver presente,
        // adicione a classe "show" para mostrar o modal na primeira vez que o botão for clicado
        modal.classList.add("show");
    }

    
}

function fecharModal() {
    if (modal.classList.contains("show")) {
        modal.classList.remove("show");
        modal.classList.add("sumiu");
    } else {
        modal.classList.remove("sumiu");
        modal.classList.add("show");
    }
}