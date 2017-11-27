<html>
    <head>
        <title>Registration</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        
<?php
if(!$_POST)
{
    ?>
        <div>Registracija
            <form action="" method="post">
                <input type="text" name="username" placeholder="Enter your username">
                <br>
                <input type="Password" name="password" placeholder="Enter your password">
                <br>
                <input type="Password" name="confirm_password" placeholder="Confirm your password">
                <br>
                <input type="text" name="email" placeholder="Enter your email">             
                <br>
                <input type="radio" name="gender" value="F">Female
                <input type="radio" name="gender" value="M">Male
                <br>            
                <input type="submit" name="submit" value="Register!">
            </form>
        </div>
    <?php
}
else
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



    echo '<h1>Welcome!</h1>';

    $errors = array();

    if(empty($username))
    {
        $errors[]='Error: username can\'t be empty!';
    }

    if(empty($email) )
    {
        $errors[]='Error: email can\'t be empty!';
    }

    if(empty($password))
    {
        $errors[]='Error: password can\'t be empty!';
    }

    if(empty($confirmedPassowrd))
    {
        $errors[]='Error: confirmed password can\'t be empty!';
    }

    if(empty($gender))
    {
        $gender = "U"; // unspecified ili unassumed xD
    }

    if(strlen($username)<=2)
    {
        $errors[]='Error user name can\'t be less than 3 characters long!';
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
        }
        fclose($f);
    }


    if(count($errors) != 0) 
    {
        foreach($errors as $p)
        {
            echo $p. '<br>';
        }
        echo '<a href="reg.php">Go back</a>';
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
        $line = $id.TAB.$username.TAB.$email.TAB.$password.TAB.$gender.TAB.$bDate.TAB.$regDate.TAB.$accountActivated.TAB.$activationId.END;
        fileWriteLine($file, $line);
      
        echo '<h1>Your registration was successful!</h1>';
        // echo "<p>Please confirm your account with the email sent to $email.</p>"; // mozda kasnije, ali svejedno mozemo spremit activationId pa kasnije pitat aktivaciju :P
        
        session_start();
        $_SESSION['id'] = $id;

        header("refresh:5; Location /loggedIn.php");
        exit();
 
    }
}
?>
    </body>
</html>