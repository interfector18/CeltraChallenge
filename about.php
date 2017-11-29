<?php
    session_start();

    if(!isset($_SESSION['id']))
    {
        // header('Location: /');
        // exit();
    }
    else
    {
        $username=$_SESSION['username'];
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <title>About - Centura2Java Online Converter</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" type="image/png" href="/images/icon2.png"/>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/additional_style.css">
        <style>
            body{
                background-image: url("images/background.png");
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
                    
                </div>
            </div>
        </nav>

    <!-- CONTENT  linear-gradient(rgba(134, 223, 255, 0.55), rgba(134, 223, 255, 0.0)); -->

        <div class="jumbotron jumbotron-fluid" style="background: linear-gradient(rgba(57,130, 255, 0.20), rgba(57, 130, 255, 0.0));padding-top: 30px;  height:100vh; background-repeat: no-repeat;">
            <div class="container">
                <div style="float:left; ">
                    <h1 class="display-3" style="width:auto;">About project</h1>
                    <p class="lead" style="width:auto; margin-top: 20px; padding: 20px; font-weight:1; border-radius: 10px; background: linear-gradient(rgba(255,255, 255, 0.45), rgba(255, 255, 255, 0.30)); ">
                    This project was made by Denis Zornada and Jasmin Makaj for participation within <a href='https://www.facebook.com/celtra/'>Celtra</a> November Challenge.<br><br>
                        Our main goal was to make an online converter for Centura programming language to Java code using Amazon Web Services (AWS).<br>
                        In attempt to realise this project we used previously acquired knowledge, but we also had to learn some new technologies.<br><br>
                        
                        The project is still a work in progress, but has:<br>
                        - registration system<br>
                        - login system<br>
                        - a converter that converts Centura code to Java code (some bugs need to be ironed out)<br>
                        - system to save and delete converted codes<br>
                        - profile editing capabilities<br><br>
                        The project is hosted on AWS, and a database integration is planned. It was made using HTML, CSS, PHP, Javascript, jQuery and AJAX. The knowledge of C#, Centura, and Java programming languages was also necessary to finalize this project.<br><br>
                        
                        "Gupta's first product was SQLBase, followed by SQLWindows, which combined SQLBase with a graphical user interface and programming language for creating business applications, known as Centura Gupta programming language." - Wikipedia<br><br>
                        
                        "Java is a general-purpose computer programming language that is concurrent, class-based, object-oriented, and specifically designed to have as few implementation dependencies as possible." - Wikipedia<br><br>
                        
                        The main motivation for creating this project was learning new technologies and this is where the challenge came in just at the right moment. The main thing we learned is that git version control system is a literal life saver, and has saved us from starting over again many time. In addition to making it really easy for us to work independently of each other.</p><br><br>
                </div>
            </div>
        </div>  
    
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    </body>
</html>