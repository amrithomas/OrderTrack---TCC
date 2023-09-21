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
        session_start();
        include_once("../../conection.php");
        $result_usuario = "SELECT * FROM funcionarios";
        $resultado_usuario = mysqli_query($conn,$result_usuario);
        while ($row_usuario = mysqli_fetch_assoc($resultado_usuario)) {
            if ($row_usuario['STATUS_FUNCIONARIO'] == 'ATIVO') {
        ?>
            <div class="sub-card">
            <?php
                if (file_exists($row_usuario['IMAGEM_FUNCIONARIO'])) {
            ?>
                    <a href='javascript:void(0);' onclick='redirectToProfile(<?php echo $row_usuario["ID_FUNCIONARIO"]; ?>)'>
                        <img src='<?php echo htmlspecialchars($row_usuario['IMAGEM_FUNCIONARIO'], ENT_QUOTES, 'UTF-8'); ?>' alt='Funcionário <?php echo htmlspecialchars($row_usuario['NOME_FUNCIONARIO'], ENT_QUOTES, 'UTF-8'); ?>' width='200'>
                    </a>
            <?php
                } // Fecha o if
            ?>

                <h3><?php echo $row_usuario['NOME_FUNCIONARIO']; ?></h3>
                <p>Cargo: <?php echo 'trabalhador' ?></p>
                <a href="#"><img src="../../assets/images/telaPrincipal/messagem.png" alt="Ícone de Mensagem"></a>

                <!-- Subcard de sobreposição -->
                <div class="subcard-overlay">
                    <h3>Detalhes do Funcionário <?php echo 'a'; ?></h3>
                     <!-- echo "<img src='".$row_usuario['IMAGEM_FUNCIONARIO']."' width='200'><br>"; -->
                </div>
                <!-- <a href='edit_usuario.php?id=<?php echo $row_usuario['ID_FUNCIONARIO']; ?>'>Editar usuário</a><br>
                <a href='proc_desativar_usuario.php?id=<?php echo $row_usuario['ID_FUNCIONARIO']; ?>'>Desativar funcionario</a><br><br> -->
            </div>
        <?php
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
