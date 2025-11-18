<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Bem-vindo - English4You</title>
    <link rel="stylesheet" href="../style.css" />
    <style>
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

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        .branding img.logo-nome {
            height: 50px;
        }

        nav ul.menu {
            list-style: none;
            margin: 0;
            padding: 10px 0;
            display: flex;
            gap: 20px;
        }

        nav ul.menu li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        nav ul.menu li a:hover {
            text-decoration: underline;
        }

        main.welcome-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f5f5f5;
        }

        .welcome-card {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .welcome-card h2 {
            margin-bottom: 20px;
        }

        .welcome-card a {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 20px;
            background-color: #004080;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }

        .welcome-card a:hover {
            background-color: #003366;
        }

        footer {
            background-color: #004080;
            color: white;
            text-align: center;
            padding: 20px 0;
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

    <main class="welcome-container">
        <div class="welcome-card">
            <h2>Bem-vindo, <?= htmlspecialchars($_SESSION['user']); ?>!</h2>
            <p>Você acessou sua conta com sucesso.</p>
            <a href="logout.php">Sair</a>
        </div>
    </main>

    <footer>
        <p>© 2025 English4You</p>
    </footer>
</body>
</html>

