<?php

require_once "../includes/helper/functions.php";
$pdo = require_once '../Database/databaseconfig.php';

$id = $_POST['id'] ?? null;
if (!$id) {
    echo '<script>window.location.href="imageIndex.php"</script>';
    exit;
}

$statement = $pdo->prepare('DELETE FROM sites WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();
echo '<script>window.location.href="siteIndex.php"</script>';
exit();