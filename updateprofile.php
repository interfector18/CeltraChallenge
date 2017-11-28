<?php
    session_start();

    if(!isset($_SESSION['id']))
    {
        header('Location: /');
        exit();
    }
    $username=$_SESSION['username'];
?>

<html>
    <head>
        <title>Edit profile - Centura2Java Online Converter</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <style>
            body{
                background-image: url("test_bg.png");
                background-repeat: no-repeat;
                background-position: center center; 
                background-size:     cover;  
            }
            
            .btn.btn-primary{
                cursor: pointer;
            }

        </style>
    </head>
    <body>
        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <a class="navbar-brand" href="index.php" style="color:#17a2b8">Centura2Java</a>
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item active" style="margin-top:3px;">
                            <a class="nav-link" href="about.php">About <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active" style="margin-top:3px;">
                            <a class="nav-link" href="myconverts.php">My Converts<span class="sr-only">(current)</span></a>
                        </li>
                        <?php if(isset($_SESSION['id']))
                                {
                                    echo'
                                    <li class="nav-item active" style="margin-top:3px;">
                                        <a class="nav-link" href="myconverts.php">My Converts<span class="sr-only">(current)</span></a>
                                    </li>   ';
                                }?>
                    </ul>
                    
                        <?php 
                            if(isset($_SESSION['id']))
                            {
                                echo "<form method='post' action='logout.php' class='form-inline my-2 my-lg-0'>
                                <p style='margin: 0px 10px 0px 0px; color:#fff; font-size: 13px;'>Welcome, <a href='profile.php'>$username</a>.</p>;
                                    <input class='btn btn-primary' style='font-size: 15px; padding:8px 10px 7px 10px;' type='submit' name='submit' value='Logout'></form>";
                            }
                            else
                            {
                                echo '<form method="post" action="login.php" class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2" type="text" name="username" placeholder="Username or email">
                                    <input class="form-control mr-sm-2" type="password" name="password" placeholder="Password">
                                    <input class="btn btn-primary" style="font-size: 15px; padding:8px 10px 7px 10px;" type="submit" name="submit" value="Login"></form>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>

         <!-- CONTENT  linear-gradient(rgba(134, 223, 255, 0.55), rgba(134, 223, 255, 0.0)); -->
        <div class="jumbotron jumbotron-fluid" style="background: linear-gradient(rgba(255, 0, 0, 0.20), rgba(255, 0, 0, 0.0));  height:100vh; background-repeat: no-repeat;">
            <div class="container" style="margin-top: 25px; margin-bottom: 25px;">
                <div style="float:left;">
                    <h1 class="display-3" style="width:auto;">Oops. There were some errors!</h1>
                    <p class="lead" style="width:auto; opacity:0.9%; ">
<?php
        require_once('funkcije.php');
        $errors = array();
        $file='users.txt';
        define('TAB', "\t");
        define('END', "\n");

        $username = $_SESSION['username'];
        $id_user = $_SESSION['id'];
        $email_old = $_SESSION['email'];
        $email_new = $_POST['email'];
        $loaded_old_password = $_SESSION['loaded_old_password'];
        $password_old = md5($_POST['old_password']);
        $password_new = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);
        
        if($_POST['btn_email'] == "Update email")
        {
            if($email_old !== $email_new)
            {
                if (!filter_var($email_new, FILTER_VALIDATE_EMAIL)) 
                {
                    $errors[]="Error: $email_new is not a valid email address!";
                }
                else{

                    $file_loaded = file_get_contents('users.txt');
                    $file_loaded = str_replace($email_old, $email_new, $file_loaded);

                    $f = fopen('users.txt', 'w+');
                    flock($f, LOCK_EX);
                    $_SESSION['email'] = $email_new;
                    fwrite($f, $file_loaded);
                    flock($f, LOCK_UN);
                    fclose($f);
                }
            }
        }
        if($_POST['btn_password'] == "Update password")
        {
            if(empty($_POST['old_password']) || empty($_POST['new_password']) || empty($_POST['confirm_password']))
            {
                $errors[]='Error: password boxes can\'t be empty!';
            }
            else{
                if($password_old == $password_new)
                {
                    $errors[]='Error: new password cannot be the same as old!';
                }
                if($password_old !== $loaded_old_password)
                {
                    $errors[]='Error: old password not confirmed!';
                }
                else{
                    if($password_new !== $confirm_password)
                    {
                        $errors[]='Error: new password not confirmed!';
                    }
                    else
                    {
                        // PROMJENA PASSWORDA
                        $file_loaded = file_get_contents('users.txt');
                        $file_loaded = str_replace($password_old, $password_new, $file_loaded);
    
                        $f = fopen('users.txt', 'w+');
                        flock($f, LOCK_EX);

                        fwrite($f, $file_loaded);
                        flock($f, LOCK_UN);
                        fclose($f);
                    }
                }
            }
        }
        

    if(count($errors) != 0) 
    {
        foreach($errors as $p)
        {
            echo $p.'<br>';
        }
        ?>
            <div align="center">
                <button onclick="goBack()" class="btn btn-primary">Go back</button>
            </div>
        <?php
    }
    else 
    {

        header("Location: profile.php");
        exit();
 
    }

?>
                    </p>
                </div>
            </div>
        </div>  

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script>
            function goBack() {
                window.history.back();
            }
        </script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    </body>
</html>

