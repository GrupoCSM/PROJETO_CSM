<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Senha - English4You</title>
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

        main.reset-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f5f5f5;
        }

        .reset-container form {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .reset-container input,
        .reset-container button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .reset-container button {
            background-color: #004080;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        .reset-container button:hover {
            background-color: #003366;
        }

        footer {
            background-color: #004080;
            color: white;
            text-align: center;
            padding: 20px 0;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
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

    <main class="reset-container">
        <form method="post" action="reset_process.php">
            <h2>Recuperação de Senha</h2>
            <input type="email" name="email" placeholder="Digite seu email" required>
            <input type="text" name="full_name" placeholder="Digite seu nome completo" required>
            <input type="password" name="new_password" placeholder="Nova senha" required>
            <button type="submit">Redefinir Senha</button>
        </form>
    </main>

    <footer>
        <p>© 2025 English4You</p>
    </footer>
</body>
</html>
