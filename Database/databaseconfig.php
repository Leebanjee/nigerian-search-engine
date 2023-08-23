<?php

// try{

//     $connection = new PDO("mysql:dbname=searchengine;host=localhost","root","");

// }
// catch(PDOException $ex){
// echo "Error occured : " . $ex->getMessage();
// }

//


$pdo = new PDO('mysql:host=localhost;port=3306;dbname=searchengine', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

return $pdo;