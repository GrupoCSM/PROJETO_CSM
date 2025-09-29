<?php
include("../db.php");
$id = $_GET['id'];
$sql = "DELETE FROM Users WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    header("Location: index_users.php");
    exit();
} else {
    echo "Erro ao excluir: " . $conn->error;
}
?>
