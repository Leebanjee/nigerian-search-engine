<?php


$pdo = require_once '../../Database/databaseconfig.php';

$id = $_POST['id'] ?? null;
if (!$id) {
    echo '<script>window.location.href="dashboard.php"</script>';
    exit;
}

$statement = $pdo->prepare('DELETE FROM posts WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();

echo '<script>window.location.href="dashboard.php"</script>';
exit;