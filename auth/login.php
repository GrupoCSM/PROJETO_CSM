<?php
session_start();
include("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['password'];

    $sql = "SELECT * FROM Users WHERE email='$email' AND password='$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['user'] = $email;
        header("Location: welcome.php");
        exit();
    } else {
        $erro = "Login incorreto!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - English4You</title>
    <link rel="stylesheet" href="../style.css" />
    <style>
        /* Layout da página */
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background-color: #004080;
            color: white;
        }

        main.login-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f5f5f5;
        }

        .login-container form {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .login-container input,
        .login-container button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .login-container button {
            background-color: #004080;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        .login-container button:hover {
            background-color: #003366;
        }

        .login-container a {
            display: block;
            margin-top: 15px;
            color: #004080;
            text-decoration: none;
        }

        .login-container a:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        footer {
            background-color: #004080;
            color: white;
            text-align: center;
            padding: 20px 0;
        }

        nav ul.menu {
            list-style: none;
            margin: 0;
            padding: 10px 0;
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        nav ul.menu li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        nav ul.menu li a:hover {
            text-decoration: underline;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        .branding img.logo-nome {
            height: 50px;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <div class="branding">
                <img src="../img/Letreiro.png" alt="Logo English4You" class="logo-nome">
            </div>
            <nav>
                <ul class="menu">
                    <li><a href="../index.html">Início</a></li>
                    <li><a href="pais-alunos.html">Pais e Alunos</a></li>
                    <li><a href="apoio-pedagogico.html">Apoio Pedagógico</a></li>
                    <li><a href="supervisao.html">Supervisão</a></li>
                    <li><a href="rh.html">RH</a></li>
                    <li><a href="projetos.html">Projetos</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="login-container">
        <form method="post">
            <h2>Login</h2>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Senha" required>
            <button type="submit">Entrar</button>
            <a href="reset_password.php">Esqueci minha senha</a>
            <p class="error"><?= isset($erro) ? $erro : '' ?></p>
        </form>
    </main>

    <footer>
        <p>© 2025 English4You</p>
    </footer>
</body>
</html>
