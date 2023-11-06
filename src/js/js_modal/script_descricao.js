let conteudoOriginal = '';



function substituirLayout(idChamado) {
    const modal = document.querySelector("#myModal");

    // Se o conteúdo original não foi definido, defina-o agora
    if (!conteudoOriginal) { 
        conteudoOriginal = modal.innerHTML;
    }
    // Fazendo uma requisição AJAX para buscar os detalhes do chamado
    $.ajax({
      url: '/sistema_os/src/api/controller/getChamado.php',
      type: 'GET',
      data: { chamadoID: idChamado },  // Modificado para passar o ID do chamado
      success: function(response) {
        const dados = JSON.parse(response);

        if (!dados.chamado) {
            console.error('Chamado não encontrado');
            return;
        }

        

        const ordem = dados.chamado; 
        let botaoAceitarHtml = '';
        if (ordem.STATUS === 'PENDENTE') {
            botaoAceitarHtml = `
                <div class="botao">
                    <input type="button" id="botao_aceitar" value="aceitar">
                </div>
            `;
        } else if (ordem.STATUS === 'EM ANDAMENTO') {
            botaoAceitarHtml = `
                <div class="botao">
                    <input type="button" id="botao_aceitar" value="concluir">
                </div>
            `;
        }
  
          // Novo layout desejado (DESCRIÇÃO DO CHAMADO)
          modal.innerHTML = `            
            <link rel="stylesheet" href="/sistema_OS/src/styles/modal/styleDescricao.css">
            
        
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-lg">
                  <div class="header_descricao">
                  <p id="titulo_chamado" style=" font-weight: 700; font-size: 25px; color: white; padding: 10px; ">DESCRIÇÃO</p>
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
                      <p style="font-weight: 700; margin-left: 80px; margin-top: -46px; font-size: 25px;" id="titulo_chamado">${ordem.SERVICO}</p>
                    </div>
                    <br>
                    
                    <div class="container">
                      <div class="row div_assunto ">

                        <div style="" class="col descricao_esquerda">
                          <textarea readonly class="textarea_assunto" name="" cols="70" rows="5">${ordem.ITEM}</textarea>
                            <br><br><hr style="border: 1px solid  #999999; margin-bottom: 10px;">

                            
                        </div>
                      
                        <div class="col box-foto" >
                          <img src="../../assets/images/modal/pessoa.png" id="foto" alt="">
                        </div> 
                                
                      </div>
                    </div> 

                    <div class="row infos" style="margin-left: 10px">
                              <p style="font-size: 24px;">Urgência: <span style="color: ${ordem.PRIORIDADE === 'BAIXA' ? '#7dc73b' : (ordem.PRIORIDADE === 'MÉDIA' ? '#ffa632' : (ordem.PRIORIDADE === 'ALTA' ? '#ff5555' : '#008efb'))}
                              ; font-weight: 700; font-size: 20px;"> ${ordem.PRIORIDADE} </p>
                              <p style="font-size: 24px;">Status: <span style="font-size: 24px; margin-left: 10px;">${ordem.STATUS}</span> </p>
                              </div>
                        

                    <div>
                      <hr style="border: 1px solid #999999; width: 98%; ">         
                      
                      <p class="datas" style="font-size: 24px;">Local: <span style="font-size: 24px; margin-left: 10px;">${ordem.LOCALIZACAO}</span> </p>
                      <p class="datas" style="font-size: 24px;">Data inicial: <span style="font-size: 24px; margin-left: 10px;">${ordem.PRAZO}</span> </p>
                    
                      <div class="botao">
                        ${botaoAceitarHtml}
                      </div>
                    
                    </div>
                    </div>
                </div>
              </div>
              
          `;

          const botaoAceitar = document.getElementById('botao_aceitar');
          if (botaoAceitar) {
              botaoAceitar.addEventListener('click', function() {
                let statusAtual = ordem.STATUS;// Supondo que 'ordem.STATUS' contém o status atual
          
                  // Atualiza o status
                  if (statusAtual === 'PENDENTE') {
                      statusAtual = 'EM ANDAMENTO';
                  } else if (statusAtual === 'EM ANDAMENTO') {
                      statusAtual = 'CONCLUIDO';
                  }
          
                  // Faz uma requisição AJAX para atualizar o status no servidor
                  $.ajax({
                      url: '/sistema_OS/src/api/controller/atualizar_status.php',  // Substitua com a URL do seu servidor
                      type: 'POST',
                      data: {
                          chamadoID: idChamado, // Supondo que você tenha o ID do chamado disponível
                          novoStatus: statusAtual
                      },
                      success: function(response) {
                          console.log('Status atualizado com sucesso.');
                          // Você pode querer atualizar a interface do usuário aqui
                      },
                      error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Erro ao atualizar o status: ', textStatus, errorThrown);
                      }
                  });
            
              });
          }
          
          
          // Adicione um evento de clique ao botão "back"
          const back = modal.querySelector("#back");
          back.addEventListener('click', function () {
            modal.innerHTML = conteudoOriginal;
             
          });
}
});
}