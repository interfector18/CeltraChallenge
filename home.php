<?php
session_start();

if(!isset($_SESSION['id']))
{
    header('Location: /');
    exit();
}
$username=$_SESSION['username'];
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Home - Centura2Java Online Converter</title>

        <!--jQuery load-->
        <script src="jQuery/jquery-3.2.1.min.js"></script>

        <script>
            function convert()
            {
                centuraCode = document.getElementById("centuraCodeTB").value;
                
                var javaCode;
                var data;

                $.ajax({
                    url:'converter.php',
                    type: "POST",
                    dataType: 'JSON',
                    data: {jsCenturaCode: centuraCode},
                    complete: function (data) {
                        setJavaTB(data.responseText);
                    },
                    error: function () {
                        javaCode = "Oops. There was an error!";
                    },
                });

            }
            function saveConvert()
            {
                centuraCode = document.getElementById("centuraCodeTB").value;
                javaCode = document.getElementById("javaCodeTB").value;

                $.ajax({
                    url:'saveConvert.php',
                    type: "POST",
                    data: {jsCenturaCode: centuraCode, jsJavaCode: javaCode},
                    success: function()
                    {
                        alert("Success!");
                    },
                    error: function () {
                        alert("Oops. There were some errors!");
                    },
                });

            }
            function setJavaTB(string)
            {
                document.getElementById("javaCodeTB").innerHTML = string;

            }
        </script>

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" type="image/png" href="/images/icon2.png"/>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/additional_style.css">
        <style>
            body{
                background: linear-gradient(rgba(0,100, 100, 0.20), rgba(0, 100, 100, 0.0));
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
                                    <input class="btn btn-primary" style="font-size: 15px; padding:8px 10px 7px 10px;" type="submit" name="submit" value="Login">
                                </form>';
                        }
                    ?>
                </div>
            </div>
        </nav>

        <!-- CONTENT  linear-gradient(rgba(134, 223, 255, 0.55), rgba(134, 223, 255, 0.0)); -->
        <div class="jumbotron jumbotron-fluid" style="background: linear-gradient(rgba(57,130, 255, 0.20), rgba(57, 130, 255, 0.0)); height:100vh; background-repeat: no-repeat; padding-top:30px;">
            <div class="container">
                <div style="width: 100%; border-radius: 5px;" class="container-fluid">
                    <div class="row">
                        <div align="center" class="col-lg-6">
                            <h3 class="display-4" align="center">Centura code</h3>
                            <textarea rows="25%" cols="65%" name="centura" style="resize: none;" id="centuraCodeTB"></textarea>
                        </div>
                        <div align="center" class="col-lg-6">
                            <h3 class="display-4" align="center">Java code</h3>
                            <textarea rows="25%" cols="65%" name="java" style="resize: none;" id="javaCodeTB"></textarea>
                        </div>
                        <div align="center" style="width: 100%;">
                            <input align="center" class="btn btn-primary" type="button" value="Convert" onclick="convert();">
                            <input align="center" class="btn btn-primary" type="button" value="Save" onclick="saveConvert();">
                        <div>
                    </div>
                </div>
            </div>
        </div>  
    

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    </body>
</html>