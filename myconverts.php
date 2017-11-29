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
    <title>My Converts - Centura2Java Online Converter</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/png" href="/images/icon2.png"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/additional_style.css">
    <style>
    body{
        background-image: none;
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
                        <input class="btn btn-primary" style="font-size: 15px; padding:8px 10px 7px 10px;" type="submit" name="submit" value="Login"></form>';
                }
            ?>
            </div>
            </div>
        </nav>

        <!-- CONTENT  linear-gradient(rgba(134, 223, 255, 0.55), rgba(134, 223, 255, 0.0)); -->
        <div class="jumbotron jumbotron-fluid" style="padding-top:30px;background: linear-gradient(rgba(57,130, 255, 0.20), rgba(57, 130, 255, 0.0));  height:100vh; background-repeat: no-repeat; margin-top:0px;">
            <div class="container" >
                    <?php
                        $fileName = 'converts_by_id/'.$_SESSION['id'].'_converted.txt';
                        if(!file_exists($fileName) || filesize($fileName) == 0)
                        {
                            echo '<h1>You don\'t have any converted codes so far.</h1>';
                        }
                        else
                        {
                            echo '<h2>Your converts</h2>';
                            //echo '<table width="100%" cellpadding="10px" style="background: linear-gradient(rgba(0,100, 100, 0.20), rgba(0, 100, 100, 0.0)); border-radius: 5px;">';
                           
                            $file = 'converts_by_id/'.$_SESSION['id'].'_converted.txt';                  
                            $allConverts = file($file);
                            $postNum = 0;
                            foreach($allConverts as $line)
                            {
                                $postNum++;
                                $array = explode("\t", $line);
                                $centura_dat = $array[2];
                                $java_dat = $array[3];
                                $java_dat = str_replace("\r", "", $java_dat);
                                $java_dat = str_replace("\n", "", $java_dat);
                                
                                $centura_code = file_get_contents($centura_dat);
                                $java_code = file_get_contents($java_dat);

                                $dat_array = explode("_", $java_dat);
                                
                                $conv_date = date('d/m/Y', $dat_array[2]);

                                echo'

                                <div class="row">
                                    <div width="6%" align="center" class="col-lg-1">
                                        <h3 class="display-4" valign="center">'.$postNum.'</h3>
                                    </div>
                                    <div align="center" class="col-lg-5">
                                        <h3 class="display-4" align="center" style="width:450px;">Centura code</h3>
                                        <textarea rows="10%" cols="60%" name="centura" style="resize: none;" id="centuraCodeTB" readonly>'.$centura_code.'</textarea>
                                    </div>
                                    <div width="47%" align="center" class="col-lg-5">
                                        <h3 class="display-4" align="center">Java code</h3>
                                        <textarea rows="10%" cols="60%" name="java" style="resize: none;" id="javaCodeTB" readonly>'.$java_code.'</textarea>
                                    </div>
                                </div>
                                <p style="margin:5px;">Date of conversion: '.$conv_date.'<a href="deleteConvert.php?uid='.$array[1].'&pid='.$array[0].'" style="float:right;">Delete</a></p>
                                <hr/>';
                                }
                               // echo '</table>';
                            }
                    ?>
            </div>
        </div>  
    

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    </body>
</html>