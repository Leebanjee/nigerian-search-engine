<?php

include("../../../../Database/databaseconfig.php");

if(isset($_POST["id"]) && isset($_POST["type"])) {
    $table = $_POST["type"];
    $query =  $pdo->prepare("UPDATE $table SET timesvisited = timesvisited + 1 where id = :id");
    $query->bindParam(":id", $_POST["id"]);

    $query->execute();
}
?>