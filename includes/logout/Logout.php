<?php
@include '../../Database/databaseconfig.php';

session_start();
session_unset();
session_destroy();
header('Location: ../../index.php');
?>