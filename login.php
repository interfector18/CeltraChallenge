<?php

$usersFile = "users.txt";

if($_POST)
{
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    if(file_exists($usersFile))
    {
        $users = file($usersFile);
    }
    else
    {
        header("Location: /");
        exit();
    }

    foreach($users as $user)
    {
        $userData = explode("\t", $user);
        if(($userData[2] == $username || $userData[1] == $username) && $userData[3] == $password) // userdata[1] i userdata[2] da se moze prijavit ili s username ili s email
        {
            session_start();
            $_SESSION['id'] = $userData[0];
            header("Location: /loggedIn.php");
            //header("Location: ".$_SERVER['SERVER_NAME'].'/Centura2JavaOnline/');
            exit();
        }
    }

    header("Location: /"); /* Redirect browser */
    exit();

}


?>