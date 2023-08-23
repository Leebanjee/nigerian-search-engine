<?php

include("databaseconfig.php");
$statement = $pdo->prepare('SELECT * FROM posts');
$statement->execute();
$urls = $statement->fetchAll(PDO::FETCH_ASSOC);
$length = count($urls);


// for($i = 0; $i < $length; $i++){
//     print $urls[$i];
// }
// foreach ($urls as $i => $url) {
//     echo $i,  $url["siteurl"];
// }
