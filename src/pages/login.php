<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Página de Login</title>
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
            <h2>Login</h2>
            <form action="login.php" method="post">
                <input type="text" name="username" placeholder="Nome de Usuário" required>
                <input type="password" name="password" placeholder="Senha" required>
                <div>
                    <a href="#" class="forget"> Esqueceu a senha?</a>
                </div>
                <button type="submit">Entrar</button>
            </form>
        </div>
        
    </main>
    
    <footer>
        <p>&copy; OrderTech . Todos os direitos reservados.</p>
    </footer>
</body>
</html>
