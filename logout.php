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

header("Location: index.php");

?>