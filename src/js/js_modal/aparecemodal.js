const modal = document.getElementById("myModal");

function aparecemodal() {
    if (modal.classList.contains("sumiu")) {
        modal.classList.remove("sumiu");
        modal.classList.add("show");
        
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



