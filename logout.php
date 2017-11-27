<?php
/*
$_SESSION['logged_in'] = false;
$_SESSION['username'] = "";
*/
session_start();
//session_stop();
unset($_SESSION['id']);
unset($_SESSION['username']);
session_destroy();

if($_SERVER['HTTP_REFERER'] != $_SERVER['SERVER_NAME'])
    $stranica = basename($_SERVER['HTTP_REFERER']);
header("Location: $stranica");
// header("Location: index.php");

?>