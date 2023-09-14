<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Cadastro de Funcionário</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="Logo da Empresa">
        </div>
        <nav>
            <a href="#">Home</a>
            <a href="#">Funcionário</a>
            <a href="#">Chamados</a>
        </nav>
    </header>
    
    <main>
        <div class="login-form">
            <h2>Cadastrar Funcionári</h2>
            <form action="cadastrar_funcionario.php" method="post">
                <input type="text" name="nome" placeholder="Nome" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <div class="employee-image">
                    <img src="images/funcionario.png" alt="Foto do Funcionário">
                </div>
                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </main>
    
    <footer>
        <p>&copy;OrderTech . Todos os direitos reservados.</p>
    </footer>
</body>
</html>
