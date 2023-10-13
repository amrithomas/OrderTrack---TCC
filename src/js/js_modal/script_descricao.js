let conteudoOriginal = '';

function substituirLayout() {
  // Referência ao modal
  const modal = document.querySelector("#myModal");

  if (!conteudoOriginal) { 
    conteudoOriginal = modal.querySelector(".modal-lg").innerHTML;
  }
  
  // Novo layout desejado 
  modal.innerHTML = `
    <!-- Seu novo layout aqui -->
    
    <link rel="stylesheet" href="../../styles/modal/styleDescricao.css">
 
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-lg">
          <div class="header_descricao">
            <p id="Titulo">CHAMADOS</p>
            <div class="fechar">
              <button
                type="button"
                class="close"
                onclick="fecharModal()"
                data-dismiss="modal"
                aria-label="Close"
                style="height: 57px; margin-top: -3px;"
              >
                <span aria-hidden="true" 
                style="font-size: 31px;
                font-weight: 600;
                opacity: 0.7;" 
                id="x">x</span>
              </button>
            </div>
          </div>

          <div class="container">
          
          <div class="modal-body modalBody" style="padding-top: 20px;">
        
            <div>
              <img src="../../assets/images/modal/voltar.png" id="back" alt="" style="width: 50px; padding: 5px" > 
              <p style="font-weight: 700; margin-left: 80px; margin-top: -46px;" id="titulo_chamado">Novo Modal</p>
            </div>
            <br>
            
            <div class="container">
              <div class="row div_assunto ">

                <div style="" class="col descricao_esquerda">
                  <textarea readonly class="textarea_assunto" name="" cols="70" rows="5"></textarea>
                    <br><br><hr style="border: 1px solid  #999999; margin-bottom: 10px;">

                    
                </div>
               
                <div class="col box-foto" >
                  <img src="../../assets/images/modal/pessoa.png" id="foto" alt="">
                </div> 
                         
              </div>
            </div>

            <div class="row infos" style="margin-left: 10px">
                      <p style="font-size: 24px;">Urgência: </p>
                      <div class="urgencia_button" style="background-color: #ffab4b; margin-left: 137px; width: 100px; position: absolute; height: 30px; border-radius: 20px; margin-top: 8px"></div>
                      <br> <p style="font-size: 24px;">Status: <span style="font-size: 24px; margin-left: 10px;">Pendente</span> </p>
                      </div>
                

            <div>
              <hr style="border: 1px solid #999999; width: 98%; ">         
              
              <p class="datas" style="font-size: 24px;">Data inicial: <span style="font-size: 24px; margin-left: 10px;">dti</span> </p>
              <p class="datas" style="font-size: 24px;">Data final: <span style="font-size: 24px; margin-left: 10px;">dtf</span> </p>
            
              <div class="botao">
                <input type="button" id="botao_aceitar" value="aceitar">
              </div>
            
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
