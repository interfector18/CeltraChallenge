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
else
    $stranica = "";

$stranica = str_replace($_SERVER['SERVER_NAME'], "", $stranica);
$stranica = str_replace("logout.php", "", $stranica);
$stranica = str_replace("/", "", $stranica);
header("Location: $stranica");
// header("Location: index.php");

?>