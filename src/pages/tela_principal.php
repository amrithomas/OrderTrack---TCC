<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../../src/styles/tela_principal/styles.css">
    <title>Tela Principal</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../../assets/images/logo.png" id="logo" alt="Logo" width="30" height="30">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end header" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link links" href="#">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle links" href="#" id="chamadosDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Chamados <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="chamadosDropdown">
                            <a class="dropdown-item" href="#">Lista de Chamados</a>
                            <a class="dropdown-item" href="#">Abrir Chamado</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle links" href="#" id="funcionariosDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Funcionários <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="funcionariosDropdown">
                            <a class="dropdown-item" href="#">Lista de Funcionários</a>
                            <a class="dropdown-item" href="#">Login Funcionário</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <div class="main-card">
            <?php
                include_once('../api/controller/conexao.php');
                if(isset($_SESSION['msg'])){
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                
                $result_usuario = "SELECT * FROM funcionarios ";
                $resultado_usuario = mysqli_query($conn,$result_usuario);
        
                while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
                    if($row_usuario['STATUS_FUNCIONARIO'] == 'ATIVO'){
                        echo '<div class="sub-card">';
                        echo '<img src="../../assets/images/telaInicial/funcionario.PNG" alt="' . $row_usuario['NOME_FUNCIONARIO'] . '" class="funcionario-img">';
                        echo '<h3>' . $row_usuario['NOME_FUNCIONARIO'] . '</h3>';
                        echo '<a href="#"><img src="../../assets/images/telaInicial/funcionario.PNG" alt="Ícone de Mensagem" class="mensagem-img"></a>';
                        echo '<div class="subcard-overlay">';
                        echo '<h3>Detalhes do ' . $row_usuario['NOME_FUNCIONARIO'] . '</h3>';
                        // Coloque aqui mais detalhes sobre o funcionário
                        echo '</div>';
                        echo '</div>';
                    }
                }
            ?>
        </div>
    </main>



    <footer>
        <p>&copy; OrderTech. Todos os direitos reservados.</p>
    </footer>
    
    <!-- Incluindo os arquivos JavaScript do Bootstrap (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
