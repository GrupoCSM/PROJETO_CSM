<?php
include("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $nome = $_POST['full_name'];
    $senha = $_POST['password'];

    $sql = "INSERT INTO Users (email, full_name, password) VALUES ('$email','$nome','$senha')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index_users.php");
        exit();
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Criar Usuário</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .form-container {
      background: #fff;
      padding: 25px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      width: 350px;
    }
    h2 {
      text-align: center;
      color: #2c3e50;
    }
    input {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    button {
      width: 100%;
      padding: 10px;
      border: none;
      background: #27ae60;
      color: #fff;
      border-radius: 5px;
      cursor: pointer;
      transition: 0.3s;
    }
    button:hover {
      background: #1e8449;
    }
    a {
      display: block;
      margin-top: 10px;
      text-align: center;
      text-decoration: none;
      color: #3498db;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Criar Usuário</h2>
    <form method="post">
      <input type="email" name="email" placeholder="Email" required>
      <input type="text" name="full_name" placeholder="Nome completo" required>
      <input type="password" name="password" placeholder="Senha" required>
      <button type="submit">Salvar</button>
    </form>
    <a href="index_users.php">← Voltar</a>
  </div>
</body>
</html>
