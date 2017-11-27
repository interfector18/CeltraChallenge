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
        <title>Centura2Java Online Converter</title>
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
                input.btn.btn-primary{
                    cursor:pointer;
                }
                .column {
                    float: left;
                    width: 50%;
                }

                /* Clear floats after the columns */
                .row:after {
                    content: "";
                    display: table;
                    clear: both;
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
                    <!--<li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                    </li>-->
                </ul>
                <form method="post" action="logout.php" class="form-inline my-2 my-lg-0">
                    <?php 
                        if(isset($_SESSION['id']))
                        {
                            echo "<p style='margin: 0px 10px 0px 0px; color:#fff; font-size: 13px;'>Welcome, $username.</p>;
                                <input class='btn btn-primary' style='font-size: 15px; padding:8px 10px 7px 10px;' type='submit' name='submit' value='Logout'>";
                        }
                        else
                        {
                            echo '<input class="form-control mr-sm-2" type="text" name="username" placeholder="Username or email">
                                  <input class="form-control mr-sm-2" type="password" name="password" placeholder="Password">
                                  <input class="btn btn-primary" style="font-size: 15px; padding:8px 10px 7px 10px;" type="submit" name="submit" value="Login">';
                        }
                    ?>
                </form>
                </div>
            </div>
        </nav>

    <!-- CONTENT  linear-gradient(rgba(134, 223, 255, 0.55), rgba(134, 223, 255, 0.0)); -->

        <div class="jumbotron jumbotron-fluid" style="background: linear-gradient(rgba(57,130, 255, 0.20), rgba(57, 130, 255, 0.0));padding-top: 30px;  height:100vh; background-repeat: no-repeat;">
            <div class="container">
                <div style="float:left; ">
                    <h1 class="display-3" style="width:auto;">About project</h1>
                    <p class="lead" style="width:auto; padding: 20px; font-weight:1; border-radius: 10px; background: linear-gradient(rgba(255,255, 255, 0.40), rgba(255, 255, 255, 0.30)); ">This project was made by Denis Zornada and Jasmin Makaj for participation within Celtra November Challenge.<br>

                    The project is still a work in progress, but has:<br>
                    - working registration system<br>
                    - working login system<br>
                    - a converter that converts Centura code to Java code (some bugs need to be ironed out)<br><br>

                    It is hosted on AWS, and a database integration is planned.<br>
                    It uses html, css, php, and bootstrap.<br><br>

                    The main motivation for creating this project was learning new technologies and this is where the 
                    challenge came in just at the right moment. The main thing we learned is that git version control system is 
                    a literal life saver, and has saved us from starting over again many time, in addition to making it really
                    easy for us to work independently of each other.</p>
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