<?php
session_start();
include("../db.php");

if (!isset($_SESSION['user_role'])) {
    header("Location: ../auth/login.php");
    exit();
}

if ($_SESSION['user_role'] !== 'Administrador') {
    echo "<script>
        alert('Acesso negado! Somente administradores podem editar usuários.');
        window.location.href = 'index_users.php';
    </script>";
    exit();
}


if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>
        alert('ID inválido.');
        window.location.href = 'index_users.php';
    </script>";
    exit();
}

$id = intval($_GET['id']);


$stmt = $conn->prepare("SELECT * FROM Users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "<script>
        alert('Usuário não encontrado.');
        window.location.href = 'index_users.php';
    </script>";
    exit();
}


$profiles = $conn->query("SELECT id, role_name FROM Profiles");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $nome = $_POST['full_name'];
    $senha = $_POST['password'];
    $profile_id = intval($_POST['profile_id']);

    $stmt = $conn->prepare("
        UPDATE Users 
        SET email = ?, full_name = ?, password = ?, profile_id = ?
        WHERE id = ?
    ");
    $stmt->bind_param("sssii", $email, $nome, $senha, $profile_id, $id);

    if ($stmt->execute()) {
        echo "<script>
            alert('Usuário atualizado com sucesso!');
            window.location.href = 'index_users.php';
        </script>";
        exit();
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Usuário</title>
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
    input, select {
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
      background: #f39c12;
      color: #fff;
      border-radius: 5px;
      cursor: pointer;
      transition: 0.3s;
    }
    button:hover {
      background: #d68910;
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
    <h2>Editar Usuário</h2>
    <form method="post">
      <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
      <input type="text" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" required>
      <input type="password" name="password" value="<?= htmlspecialchars($user['password']) ?>" required>

     
      <select name="profile_id" required>
        <option value="">Selecione um perfil</option>
        <?php while ($p = $profiles->fetch_assoc()): ?>
          <option value="<?= $p['id'] ?>" <?= ($p['id'] == $user['profile_id']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($p['role_name']) ?>
          </option>
        <?php endwhile; ?>
      </select>

      <button type="submit">Atualizar</button>
    </form>
    <a href="index_users.php">← Voltar</a>
  </div>
</body>
</html>
