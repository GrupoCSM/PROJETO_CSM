<?php
session_start();
include("../db.php");

if (!isset($_SESSION['user_role'])) {
    header("Location: ../auth/login.php");
    exit();
}

if ($_SESSION['user_role'] !== 'Administrador') {
    echo "<script>
        alert('Acesso negado! Somente administradores podem excluir usuários.');
        window.location.href = 'index_users.php';
    </script>";
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    if ($id == $_SESSION['user_id']) {
        echo "<script>
            alert('Você não pode excluir sua própria conta!');
            window.location.href = 'index_users.php';
        </script>";
        exit();
    }


    $stmt = $conn->prepare("DELETE FROM Users WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>
            alert('Usuário excluído com sucesso!');
            window.location.href = 'index_users.php';
        </script>";
        exit();
    } else {
        echo "<script>
            alert('Erro ao excluir usuário: " . addslashes($conn->error) . "');
            window.location.href = 'index_users.php';
        </script>";
    }

    $stmt->close();
} else {
    echo "<script>
        alert('ID de usuário inválido.');
        window.location.href = 'index_users.php';
    </script>";
}
?>
