<?php
session_start();
if(!isset($_SESSION['id']))
{
    header('Location: /');
    exit();
}

$userId = $_SESSION['id'];


?>

<?php
    $usersFile = "users.txt";

    $users = file($usersFile);

    foreach($users as $user)
    {
        $userData = explode("\t", $user);
        if($userData[0] == $userId)
        {
            echo "<h1>Dobro dosli korisnice, $userData[1]<h1>";
        }
    }
?>