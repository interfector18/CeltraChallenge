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
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <!--<li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Disabled</a>
        </li>-->
      </ul>
      <form method="post" action="page.php" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" name="username_login" placeholder="Username">
            <input class="form-control mr-sm-2" type="password" name="password_login" placeholder="Password">
            <input class="btn btn-primary" style="font-size: 15px; padding:8px 10px 7px 10px;" type="submit" name="submit" value="Login">
        </form>
    </div>
  </nav>
  </div>

  <!-- CONTENT  linear-gradient(rgba(134, 223, 255, 0.55), rgba(134, 223, 255, 0.0)); -->

    <div class="jumbotron jumbotron-fluid" style="background: linear-gradient(rgba(57,130, 255, 0.20), rgba(57, 130, 255, 0.0));  height:100vh; background-repeat: no-repeat;">
      <div class="container" style="margin-top: 25px;">
        <div style="float:left;">
          <h1 class="display-3" style="width:auto;">Welcome</h1>
          <p class="lead" style="width:auto; opacity:0.9%; ">Centura to Java online converter. First converter online.<br><span >Register for free and convert your code.</span></p>
        </div>
        <form action="reg.php" method="post" style="float:right; width:350px; margin-right: 50px; background:linear-gradient(rgba(0, 15, 55, 0.15),rgba(0, 15, 55, 0.0)); border-radius: 5px; padding: 15px;">
            Username:
            <input class="form-control mr-sm-2" type="text" name="username" placeholder="Enter your username">
            E-mail:
            <input class="form-control mr-sm-2" type="text" name="email" placeholder="Enter your email">
            Password:
            <input class="form-control mr-sm-2" type="Password" name="password" placeholder="Enter your password">
            Confirm password:
            <input class="form-control mr-sm-2" type="Password" name="confirm_password" placeholder="Confirm your password">
            <br>
            <input class="btn btn-primary btn-lg btn-block"  style="font-size: 15px;" type="submit" name="submit" value="Register">
        </form>

      </div>
      
    </div>  
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
</html>