<?php
include("../db.php");
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM Users WHERE id=$id");
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Detalhes do Usuário</title>
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
    .card {
      background: #fff;
      padding: 25px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      width: 350px;
      text-align: center;
    }
    h2 {
      color: #2c3e50;
    }
    p {
      font-size: 15px;
      margin: 8px 0;
    }
    a {
      display: inline-block;
      margin-top: 15px;
      padding: 10px 18px;
      border-radius: 5px;
      background: #3498db;
      color: #fff;
      text-decoration: none;
      transition: 0.3s;
    }
    a:hover {
      background: #217dbb;
    }
  </style>
</head>
<body>
  <div class="card">
    <h2>Detalhes do Usuário</h2>
    <p><strong>ID:</strong> <?= $user['id'] ?></p>
    <p><strong>Email:</strong> <?= $user['email'] ?></p>
    <p><strong>Nome:</strong> <?= $user['full_name'] ?></p>
    <p><strong>Senha:</strong> <?= $user['password'] ?></p>
    <a href="index_users.php">← Voltar</a>
  </div>
</body>
</html>
