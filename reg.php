<?php

session_start();
if(isset($_SESSION['id']))
{
    header("Location: home.php");
}

?>

<html>
    <head>
        <title>Registration - Centura2Java Online Converter</title>
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
                    </ul>
                    <form method="post" action="login.php" class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="text" autofocus="autofocus" name="username" placeholder="Username or email">
                        <input class="form-control mr-sm-2" type="password" name="password" placeholder="Password">
                        <input class="btn btn-primary" style="font-size: 15px; padding:8px 10px 7px 10px;" type="submit" name="submit" value="Login">
                    </form>
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
if($_POST)
{
    require_once('funkcije.php');

    $file='users.txt';
    define('TAB', "\t");
    define('END', "\n");

    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmedPassowrd = $_POST['confirm_password'];
    $email = $_POST['email'];
    // $gender = $_POST['gender']; // DO NOT FUCKING ASSUME THIS xD gahahahahaha
    $accountActivated = "no";
    $bDate=mktime(0,0,0,$bMonth,$bDay,$bYear);
    $regDate=time();
    $activationId = md5($username.$email.$regDate);



    //echo '<h1>Welcome!</h1>';

    $errors = array();

    if(empty($username))
    {
        $errors[]='Error: username can\'t be empty!';
    }
    else
    {
        if(strlen($username)<=2)
            $errors[]='Error: user name can\'t be less than 3 characters long!';
    }

    if(empty($email) )
    {
        $errors[]='Error: email can\'t be empty!';
    }
    else
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            $errors[]="Error: $email is not a valid email address!";
        }
    }

    if(empty($password))
    {
        $errors[]='Error: password can\'t be empty!';
    }

    if(empty($confirmedPassowrd))
    {
        $errors[]='Error: confirmed password can\'t be empty!';
    }



    if(file_exists($file) && !filesize($file)==0)
    {
        $f = fopen($file, 'r');
        while(($line = fgets($f,4096)) !== false)
        {
            $userDataArray = explode("\t", $line);
            if($userDataArray[2] == $email)
            {
                $errors[]= "Error: $email already in use!";
                break;
            }
            if($userDataArray[1] == $username)
            {
                $errors[]= "Error: $username already in use!";
                break;
            }
        }
        fclose($f);
    }


    if(count($errors) != 0) 
    {
        foreach($errors as $p)
        {
            echo $p. '<br>';
        }
        ?>
            <div align="center">
                <button onclick="goBack()" class="btn btn-primary">Go back</button>
            </div>
        <?php
        // header("refresh:2; url=index.php");
    }
    else 
    {

        $password = md5($password);
        $confirmedPassowrd = md5($confirmedPassowrd);

        if(!file_exists($file))
        {  
            //Napraviti nesto?
        }

        $id = increment($file);
        $line = $id.TAB.$username.TAB.$email.TAB.$password.TAB.TAB.$bDate.TAB.$regDate.TAB.$accountActivated.TAB.$activationId.END;
        fileWriteLine($file, $line);
      
        //echo '<h1>Your registration was successful!</h1>';
        // echo "<p>Please confirm your account with the email sent to $email.</p>"; // mozda kasnije, ali svejedno mozemo spremit activationId pa kasnije pitat aktivaciju :P
        
        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;

        header("Location: home.php");
        exit();
 
    }
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