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
                    <h1 class="display-3" style="width:auto;">Edit your profile</h1>
                    
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