// //modal

// let telaPrincipal = '';

// function layoutPrincipal() { 
//   // Referência ao modal
//   const principal = document.querySelector("#original");

//   if (!telaPrincipal) {
//     telaPrincipal = principal.querySelector(".container").innerHTML;
//   }


//   principal.innerHTML += `
   
        
//         <title>Listagem de Chamados</title>
//         </head>
//         <body>
    
        
        
           
    
    
//         <link
//         rel="stylesheet"
//         href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
//     />
//     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">


//     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
//     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
//     <script src="../../src/js/js_modal/script_descricao.js"></script>
//     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
//     <link rel="stylesheet" href="../../src/styles/modal/styleModal.css" />
//     <script src="../../src/js/js_modal/script_botao.js"></script>
            



//             <div class="modal-dialog modal-lg" role="document">
//                 <div class="modal-content modal-lg">
//                 <div class="header">
//                     <p id="Titulo">CHAMADOS</p>
//                     <div class="fechar">
//                     <button
//                         type="button"
//                         class="close"
//                         data-dismiss="modal"
//                         aria-label="Close"
//                     >
//                         <span aria-hidden="true" id="x">&times;</span>
//                     </button>
//                     </div>
//                 </div>
    
//                 <div class="perfil">
//                     <div>
//                     <img id="pessoa" style="padding-bottom: 7px;" src="../../assets/images/modal/pessoa.png" alt="" /><span id="nome"
//                         >NOME</span
//                     >
//                     </div>
//                 </div>
    
//                 <div class="modal-body modalBody">
//                     <table class="table table-bordered responsive-table">
//                     <thead>
//                         <tr>
//                         <th id="contador"                
                            
//                             colspan="3"
//                             style="text-align: center; background-color: #8cb2b0"
//                         >
//                             X Chamados Abertos
//                         </th>
//                         </tr>
//                         <tr>
//                         <th
//                             colspan="3"
//                             scope="col" 
//                             style="background-color: #dde6db"
//                         >
//                             <div id="categoria" scope="col" style="justify-content: space-evenly; display: flex">
//                             <img
//                                 id="lista"
//                                 src="../../assets/images/modal/fechado.png"
//                                 onclick="pendente()" 
//                                 alt=""
//                             >
//                             <img
//                                 id="aguardando"
//                                 src="../../assets/images/modal/aguardando.png"
//                                 onclick="andamento()"
//                                 alt=""
//                             >
//                             <img
//                                 id="concluido"
//                                 src="../../assets/images/modal/concluido.png"
//                                 onclick="finalizado()"
//                                 alt=""
//                             >
//                             </div>
//                         </th>
//                         </tr>
//                     </thead>
//                     <tbody>
    
//                         <!-- chamados abertos -->
//                         <!-- linha 1 -->
//                         <tr id="listaPadrao" class="abertos" id="abertos1" onclick="substituirLayout()">
//                         <td>
//                             <p>Título do chamado:  <span id="titulo_chamado">aaaa</span></p> 
//                             <p id="urgencia">Urgência</p>
//                             <div class="nivel" style="background-color: #86cefb;"></div>
    
//                             <!-- segunda coluna -->
//                             <td id="seg_col">
//                             <p id="status">Status:</p>
//                             <p>Data:</p>
//                             </td>
//                         </td>
//                         </tr>
    
//                         <!-- linha 2 -->
//                         <tr id="listaPadrao" class="abertos" colspan="3">
//                         <td>
//                             <p>Título do chamado:</p>
//                             <p id="urgencia">Urgência</p>
//                             <div class="nivel" style="background-color: #86cefb;"></div>
    
//                             <!-- segunda coluna -->
//                             <td id="seg_col">
//                             <p id="status">Status:</p>
//                             <p>Data:</p>
//                             </td>
//                         </td>
//                         </tr>
    
//                         <!-- linha 3 -->
//                         <tr id="listaPadrao" class="abertos" colspan="3">
//                         <td>
//                             <p>Título do chamado:</p>
//                             <p id="urgencia">Urgência</p>
//                             <div class="nivel" style="background-color: #86cefb;"></div>
    
//                             <!-- segunda coluna -->
//                             <td id="seg_col">
//                             <p id="status">Status:</p>
//                             <p>Data:</p>
//                             </td>
//                         </td>
//                         </tr>
    
//                         <!-- linha 4 -->
//                         <tr id="listaPadrao" class="abertos" colspan="3">
//                         <td>
//                             <p>Título do chamado:</p>
//                             <p id="urgencia">Urgência</p>
//                             <div class="nivel" style="background-color: #86cefb;"></div>
    
//                             <!-- segunda coluna -->
//                             <td id="seg_col">
//                             <p id="status">Status:</p>
//                             <p>Data:</p>
//                             </td>
//                         </td>
//                         </tr>
    
//                         <!-- linha 4 -->
//                         <tr id="listaPadrao" class="abertos" colspan="3">
//                         <td>
//                             <p>Título do chamado:</p>
//                             <p id="urgencia">Urgência</p>
//                             <div class="nivel" style="background-color: #86cefb;"></div>
    
//                             <!-- segunda coluna -->
//                             <td id="seg_col">
//                             <p id="status">Status:</p>
//                             <p>Data:</p>
//                             </td>
//                         </td>
//                         </tr>
    
//                         <!-- linha 5 -->
//                         <tr id="listaPadrao" class="abertos" colspan="3">
//                         <td>
//                             <p>Título do chamado:</p>
//                             <p id="urgencia">Urgência</p>
//                             <div class="nivel" style="background-color: #86cefb;"></div>
    
//                             <!-- segunda coluna -->
//                             <td id="seg_col">
//                             <p id="status">Status:</p>
//                             <p>Data:</p>
//                             </td>
//                         </td>
//                         </tr>
    
//                         <!-- linha 6 -->
//                         <tr id="listaPadrao" class="abertos" colspan="3">
//                         <td>
//                             <p>Título do chamado:</p>
//                             <p id="urgencia">Urgência</p>
//                             <div class="nivel" style="background-color: #86cefb;"></div>
    
//                             <!-- segunda coluna -->
//                             <td id="seg_col">
//                             <p id="status">Status:</p>
//                             <p>Data:</p>
//                             </td>
//                         </td>
//                         </tr>
    
//                         <!-- chamados aguardando -->
//                         <!-- linha 1 -->
//                         <tr id="aguardandoLista" class="aguardando invisivel">
//                         <td>
//                             <p>Título do chamado:</p>
//                             <p id="urgencia">Urgência</p>
//                             <div class="nivel" style="background-color: #c286fb;"></div>
                            
//                             <!-- segunda coluna -->
//                             <td id="seg_col">
//                             <p id="status">Status:</p>
//                             <p>Data:</p>
//                             </td>
//                         </td>
//                         </tr>
    
//                         <!-- linha 2  -->
//                         <tr id="aguardandoLista" class="aguardando invisivel" colspan="3">
//                         <td>
//                             <p>Título do chamado:</p>
//                             <p id="urgencia">Urgência</p>
//                             <div class="nivel" style="background-color: #c286fb;"></div>
                        
//                             <!-- segunda coluna -->
//                             <td id="seg_col">
//                             <p id="status">Status:</p>
//                             <p>Data:</p>
//                             </td>
//                         </td>
//                         </tr>
    
//                         <!-- linha 3 -->
//                         <tr id="aguardandoLista" class="aguardando invisivel" colspan="3">
//                         <td>
//                             <p>Título do chamado: </p>
//                             <p id="urgencia">Urgência</p>
//                             <div class="nivel" style="background-color: #c286fb;"></div>
    
//                             <!-- segunda coluna -->
//                             <td id="seg_col">
//                             <p id="status">Status:</p>
//                             <p>Data:</p>
//                             </td>
//                         </td>
//                         </tr>
    
//                         <!-- chamados Concluído -->
//                         <!-- linha 1 -->
//                         <tr id="concluidoLista" class="fechados invisivel">
//                         <td>
//                             <p>Título do chamado: </p>
//                             <p id="urgencia">Urgência</p>
//                             <div class="nivel" style="background-color: #86fba3;"></div>
    
//                             <!-- segunda coluna -->
//                             <td id="seg_col">
//                             <p id="status">Status:</p>
//                             <p>Data:</p>
//                             </td>
//                         </td>
//                         </tr>
    
//                         <!-- linha 2 -->
//                         <tr id="concluidoLista" class="fechados invisivel" colspan="3">
//                         <td>
//                             <p>Título do chamado: </p>
//                             <p id="urgencia">Urgência</p>
//                             <div class="nivel" style="background-color: #86fba3;"></div>
    
//                             <!-- segunda coluna -->
//                             <td id="seg_col">
//                             <p id="status">Status:</p>
//                             <p>Data:</p>
//                             </td>
//                         </td>
//                         </tr>
    
//                         <!-- linha 3 -->
//                         <tr id="concluidoLista" class="fechados invisivel" colspan="3">
//                         <td>
//                             <p>Título do chamado:</p>
//                             <p id="urgencia">Urgência</p>
//                             <div class="nivel" style="background-color: #86fba3;"></div>
    
//                             <!-- segunda coluna -->
//                             <td id="seg_col">
//                             <p id="status">Status:</p>
//                             <p>Data:</p>
//                             </td>
//                         </td>
//                         </tr>
    
//                         <!-- linha 4 -->
//                         <tr id="concluidoLista" class="fechados invisivel" colspan="3">
//                         <td>
//                             <p>Título do chamado:</p>
//                             <p id="urgencia">Urgência</p>
//                             <div class="nivel" style="background-color: #86fba3;"></div>
    
//                             <!-- segunda coluna -->
//                             <td id="seg_col">
//                             <p id="status">Status:</p>
//                             <p>Data:</p>
//                             </td>
//                         </td>
//                         </tr>
    
//                         <!-- linha 5 -->
//                         <tr id="concluidoLista" class="fechados invisivel" colspan="3">
//                         <td>
//                             <p>Título do chamado:</p>
//                             <p id="urgencia">Urgência</p>
//                             <div class="nivel" style="background-color: #86fba3;"></div>
    
//                             <!-- segunda coluna -->
//                             <td id="seg_col">
//                             <p id="status">Status:</p>
//                             <p>Data:</p>
//                             </td>
//                         </td>
//                         </tr>
    
//                         <!-- linha 6 -->
//                         <tr id="concluidoLista" class="fechados invisivel" colspan="3">
//                         <td>
//                             <p>Título do chamado:</p>
//                             <p id="urgencia">Urgência</p>
//                             <div class="nivel" style="background-color: #86fba3;"></div>
    
//                             <!-- segunda coluna -->
//                             <td id="seg_col">
//                             <p id="status">Status:</p>
//                             <p>Data:</p>
//                             </td>
//                         </td>
//                         </tr>
    
//                         <!-- linha 7 -->
//                         <tr id="concluidoLista" class="fechados invisivel" colspan="3">
//                         <td>
//                             <p>Título do chamado:</p>
//                             <p id="urgencia">Urgência</p>
//                             <div class="nivel" style="background-color: #86fba3;"></div>
    
//                             <!-- segunda coluna -->
//                             <td id="seg_col">
//                             <p id="status">Status:</p>
//                             <p>Data:</p>
//                             </td>
//                         </td>
//                         </tr>
    
//                         <!-- linha 8 -->
//                         <tr id="concluidoLista" class="fechados invisivel" colspan="3">
//                         <td>
//                             <p>Título do chamado:</p>
//                             <p id="urgencia">Urgência</p>
//                             <div class="nivel" style="background-color: #86fba3;"></div>
    
//                             <!-- segunda coluna -->
//                             <td id="seg_col">
//                             <p id="status">Status:</p>
//                             <p>Data:</p>
//                             </td>
//                         </td>
//                         </tr>
    
//                     </tbody>
//                     </table>
//                 </div>
//                 </div>
//             </div>
//             </div>
//         </div>
//         </body>
//     </html>
    
//     </body>
//     </html>
//   `;


//   // Adicione um evento de clique ao botão "back"
//   const x = principal.querySelector("#x"); 
//   document.getElementById('x');
//   x.addEventListener('click', function () {
//     // Restaura o conteúdo original do modal quando o botão "back" for clicado
//     principal.querySelector(".container ").innerHTML = telaPrincipal;
//   });
// }
