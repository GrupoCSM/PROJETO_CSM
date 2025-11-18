<?php
session_start();
include("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['password'];

    $sql = "SELECT Users.id, Users.full_name, Users.email, Users.password, Profiles.role_name 
            FROM Users 
            LEFT JOIN Profiles ON Users.profile_id = Profiles.id
            WHERE Users.email='$email' AND Users.password='$senha'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['full_name'];
        $_SESSION['user_role'] = $user['role_name']; 

        
        if($user['role_name'] == 'Administrador') {
            header("Location: ../crud/index_users.php");
        } elseif($user['role_name'] == 'Professor') {
            header("Location: ../crud/index_users.php");
        } else { 
            header("Location: ../index.html"); 
        }
        exit();
    } else {
        $erro = "Usuário ou senha inválidos.";
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
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        header { background-color: #004080; color: white; }
        main.login-container {
            flex: 1; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5;
        }
        form {
            width: 100%; max-width: 400px; padding: 40px;
            background: white; border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        input, button {
            width: 100%; padding: 12px; margin: 10px 0;
            border-radius: 6px; border: 1px solid #ccc;
        }
        button {
            background: #004080; color: white; border: none; cursor: pointer; font-weight: bold;
        }
        button:hover { background: #003366; }
        .error { color: red; margin-top: 10px; }
    </style>

</head>
<body>
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
</body>
</html>
