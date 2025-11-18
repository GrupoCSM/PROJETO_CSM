<?php
session_start();
include("../db.php");

if (!isset($_SESSION['user_role'])) {
    header("Location: ../auth/login.php");
    exit();
}


if ($_SESSION['user_role'] === 'Aluno') {
    echo "<script>
        alert('Acesso negado! Somente professores e administradores podem visualizar esta página.');
        window.location.href = '../index.html';
    </script>";
    exit();
}


$sql = "SELECT Users.id, Users.full_name, Users.email, Profiles.role_name 
        FROM Users 
        LEFT JOIN Profiles ON Users.profile_id = Profiles.id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Gerenciar Usuários</title>
  <link rel="stylesheet" href="../style.css">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      display: flex;
      flex-direction: column;
      font-family: Arial, sans-serif;
    }

    main { flex: 1; }

    footer {
      background: #004080;
      color: #fff;
      text-align: center;
      padding: 10px;
      margin-top: auto;
    }

    table {
      border-collapse: collapse;
      width: 90%;
      max-width: 900px;
      margin: 20px auto;
      background: #fff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    th, td {
      padding: 12px 15px;
      text-align: center;
    }

    th {
      background: #004080;
      color: #fff;
      text-transform: uppercase;
      font-size: 14px;
    }

    tr:nth-child(even) { background: #f2f2f2; }
    tr:hover { background: #eaf2ff; }

    a {
      text-decoration: none;
      padding: 6px 12px;
      margin: 0 2px;
      border-radius: 5px;
      font-size: 14px;
      transition: 0.3s;
    }

    a.view { background: #3498db; color: #fff; }
    a.view:hover { background: #217dbb; }

    a.edit { background: #f39c12; color: #fff; }
    a.edit:hover { background: #d68910; }

    a.delete { background: #e74c3c; color: #fff; }
    a.delete:hover { background: #c0392b; }

    .btn {
      display: inline-block;
      padding: 10px 18px;
      margin: 10px auto;
      border-radius: 5px;
      background: #27ae60;
      color: #fff;
      text-decoration: none;
      font-size: 15px;
      transition: 0.3s;
    }

    .btn:hover { background: #1e8449; }
  </style>
</head>
<body>
  <header style="background-color:#004080; color:white; padding:15px 0;">
  <div style="max-width:1100px; margin:auto; display:flex; justify-content:space-between; align-items:center; padding:0 20px;">
    
    <div class="branding" style="display:flex; align-items:center; gap:10px;">
      <img src="../img/Letreiro.png" alt="Logo English4You" style="height:45px;">
    </div>

    <nav>
      <ul class="menu" style="list-style:none; margin:0; padding:0; display:flex; gap:20px; align-items:center;">
        <li><a href="../index.html" style="color:white; text-decoration:none; font-weight:bold;">Início</a></li>
        <li><a href="../setores/pais-alunos.html" style="color:white; text-decoration:none; font-weight:bold;">Pais e Alunos</a></li>
        <li><a href="../setores/apoio-pedagogico.html" style="color:white; text-decoration:none; font-weight:bold;">Apoio Pedagógico</a></li>
        <li><a href="../setores/supervisao.html" style="color:white; text-decoration:none; font-weight:bold;">Supervisão</a></li>
        <li><a href="../setores/rh.html" style="color:white; text-decoration:none; font-weight:bold;">RH</a></li>
        <li><a href="../setores/projetos.html" style="color:white; text-decoration:none; font-weight:bold;">Projetos</a></li>
      </ul>
    </nav>

    
    <div style="text-align:right;">
      <span style="font-weight:bold;"> <?= htmlspecialchars($_SESSION['user_name']) ?></span><br>
      <small><?= htmlspecialchars($_SESSION['user_role']) ?></small>
      <br>
      <a href="../auth/logout.php" style="color:#ffcccb; text-decoration:none; font-size:13px;">Sair</a>
    </div>
  </div>
</header>


  <main>
    <h2 style="text-align:center;">Lista de Usuários</h2>
  
    <table>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Perfil</th>
        <th>Ações</th>
      </tr>

      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= htmlspecialchars($row['full_name']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['role_name'] ?? 'Não definido') ?></td>
          <td>
          
            <a href="view_user.php?id=<?= $row['id'] ?>" class="view">Ver</a>

            
            <?php if ($_SESSION['user_role'] === 'Administrador'): ?>
              <a href="edit_user.php?id=<?= $row['id'] ?>" class="edit">Editar</a>
              <a href="delete_user.php?id=<?= $row['id'] ?>" class="delete" onclick="return confirm('Deseja realmente excluir este usuário?')">Excluir</a>
            <?php endif; ?>
          </td>
        </tr>
      <?php endwhile; ?>
    </table>

    <?php if ($_SESSION['user_role'] === 'Administrador'): ?>
      <div style="text-align:center; margin: 20px 0;">
        <a href="create_user.php" class="btn">+ Criar Novo Usuário</a>
      </div>
    <?php endif; ?>
  </main>

  <footer>
    <p>© 2025 English4You</p>
  </footer>
</body>
</html>
