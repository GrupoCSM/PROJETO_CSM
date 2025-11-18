<?php
include("../db.php");

$mensagem = "";
$tipo = ""; // success ou error


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $nome  = $_POST['full_name'];
    $novaSenha = $_POST['new_password'];

    $sql = "SELECT * FROM Users WHERE email='$email' AND full_name='$nome'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $sqlUpdate = "UPDATE Users SET password='$novaSenha' WHERE email='$email'";
        if ($conn->query($sqlUpdate) === TRUE) {
            $mensagem = "Senha atualizada com sucesso!";
            $tipo = "success";
        } else {
            $mensagem = "Erro ao atualizar senha!";
            $tipo = "error";
        }
    } else {
        $mensagem = "Dados incorretos!";
        $tipo = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Processar Redefinição</title>
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

        main.process-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f5f5f5;
        }

        .process-card {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .process-card h2 {
            margin-bottom: 20px;
        }

        .message.success {
            color: green;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .message.error {
            color: red;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .process-card a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 18px;
            background-color: #004080;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }

        .process-card a:hover {
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

    <main class="process-container">
        <div class="process-card">
            <h2>Recuperação de Senha</h2>
            <p class="message <?= $tipo ?>"><?= $mensagem ?></p>

            <?php if ($tipo === "success"): ?>
                <a href="login.php">Fazer login</a>
            <?php else: ?>
                <a href="reset_password.php">Tentar novamente</a>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <p>© 2025 English4You</p>
    </footer>
</body>
</html>
