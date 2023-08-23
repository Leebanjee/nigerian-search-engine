<?php


$server = "localhost";
$dbuser = "root";
$dbpass = "";
$database = "searchengine";

$conn = mysqli_connect($server, $dbuser, $dbpass, $database);

if (!$conn) {
    die("<script>alert('Connection Failed.')</script>");
}
 return $conn;

?>   