let conteudoOriginal = '';

function substituirLayout() {
  // Referência ao modal
  const modal = document.querySelector("#myModal");

  if (!conteudoOriginal) {
    conteudoOriginal = modal.querySelector(".modal-lg").innerHTML;
  }

  
 

  modal.innerHTML = `
  
    
    <link rel="stylesheet" href="../styles/modal/styleDescricao.css">
 
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-lg">
          <div class="header">
            <p id="Titulo">CHAMADOS</p>
            <div class="fechar">
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true" id="x">&times;</span>
              </button>
            </div>
          </div>
  
          <div class="modal-body modalBody container" style="padding-top: 20px;">
        
            <div>
              <img src="../../assets/images/modal/voltar.png" id="back" alt="" style="width: 50px; padding: 5px" > 
              <p style="font-weight: 700; margin-left: 80px; margin-top: -46px;" id="titulo_chamado">aaaa</p>
            </div>
            
            
            <div class="container">
              <div class="flex-row-reverse">
               
                <div class="box-foto">
                  <img src="../../assets/images/modal/pessoa.png" id="foto"  alt="">
                </div> 
              
                <div class="col  informacoes ">
                  <textarea class='descricao' readonly></textarea>
                    <br><br><hr id='linha'>
                    
                    <p style="font-size: 24px;">Urgência</p>
                    <div class="nivel" style="background-color: #ffab4b; margin-left: 120px;"></div>
                  <br> <p style="font-size: 24px;">Status: <span style="font-size: 24px; margin-left: 10px;">Pendente</span> </p>

                </div>             
              </div>

              <div>
                <hr style="border: 1px solid #999999; width: 98%; ">         
                <p class="datas" style="font-size: 24px;">Data inicial: <span style="font-size: 24px; margin-left: 10px;">15/09/2023</span> </p>
                <p class="datas" style="font-size: 24px;">Data final: <span style="font-size: 24px; margin-left: 10px;">11/11/2023</span> </p>
              
                <div class="botao">
                  <input type="button" id="botao_aceitar" value="aceitar">
                </div>
              </div>
                
              </div>
            </div>
            
  `;


  // Adicione um evento de clique ao botão "back"
  const back = modal.querySelector("#back");
  back.addEventListener('click', function () {
    // Restaura o conteúdo original do modal quando o botão "back" for clicado
    modal.querySelector(".modal-lg ").innerHTML = conteudoOriginal;
  });
}
