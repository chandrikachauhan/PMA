<?php 
session_start();
$_SESSION['names'];
session_destroy();
header('location:login.php');
?>