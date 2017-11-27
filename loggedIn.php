<?php
session_start();
if(!isset($_SESSION['id']))
{
    header('Location: /');
    exit();
}

$userId = $_SESSION['id'];
$username = $_SESSION['username'];

?>

<?php
    $usersFile = "users.txt";

    $users = file($usersFile);

    foreach($users as $user)
    {
        $userData = explode("\t", $user);
        if($userData[0] == $userId)
        {
            header('Location: /home.php');
            //echo "<h1>Dobro dosli korisnice, $userData[1]<h1>";
        }
    }
?>