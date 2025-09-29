<?php
include("../db.php");
$sql = "SELECT id, full_name, email FROM Users";
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
    }

    main {
      flex: 1; 
    }

    footer {
      background: #004080;
      color: #fff;
      text-align: center;
      padding: 10px;
      margin-top: auto; 
    }

    /* Estilo da tabela */
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

    table th, table td {
      padding: 12px 15px;
      text-align: center;
    }

    table th {
      background: #004080;
      color: #fff;
      font-weight: bold;
      text-transform: uppercase;
      font-size: 14px;
    }

    table tr:nth-child(even) {
      background: #f2f2f2;
    }

    table tr:hover {
      background: #eaf2ff;
    }

    /* Links de ação */
    table a {
      text-decoration: none;
      padding: 6px 12px;
      margin: 0 2px;
      border-radius: 5px;
      font-size: 14px;
      transition: 0.3s;
    }

    table a[href*="view"] {
      background: #3498db;
      color: #fff;
    }

    table a[href*="view"]:hover {
      background: #217dbb;
    }

    table a[href*="edit"] {
      background: #f39c12;
      color: #fff;
    }

    table a[href*="edit"]:hover {
      background: #d68910;
    }

    table a[href*="delete"] {
      background: #e74c3c;
      color: #fff;
    }

    table a[href*="delete"]:hover {
      background: #c0392b;
    }

    /* Botão principal */
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

    .btn:hover {
      background: #1e8449;
    }
  </style>
</head>
<body>
  <header>
    <div class="container header-container">
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

  <main>
  <h2 style="text-align:center;">Lista de Usuários</h2>
  
  <table>
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Email</th>
      <th>Ações</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= $row['full_name'] ?></td>
      <td><?= $row['email'] ?></td>
      <td>
        <a href="view_user.php?id=<?= $row['id'] ?>">Ver</a>
        <a href="edit_user.php?id=<?= $row['id'] ?>">Editar</a>
        <a href="delete_user.php?id=<?= $row['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>

  <div style="text-align:center; margin: 20px 0;">
    <a href="create_user.php" class="btn">+ Criar Novo Usuário</a>
  </div>
 </main>

  <footer>
    <p>© 2025 English4You</p>
  </footer>
</body>
</html>
