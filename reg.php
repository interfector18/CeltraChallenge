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
                <select name="day">
                    <?php 
                    for ($i=1; $i<=31; $i++) {
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                    ?>                
                </select>
                
                <select name="month">
                    <?php  
                    $months = array('1'=>'Jan', '2'=>'Feb','3'=>'Mar',
                                    '4'=>'Apr', '5'=>'May','6'=>'Jun',
                                    '7'=>'Jul', '8'=>'Aug','9'=>'Sep',
                                    '10'=>'Oct', '11'=>'Nov','12'=>'Dec');
                    foreach ($months as $monthId => $monthName) {
                        echo '<option value="'.$monthId.'">'.$monthName.'</option>';
                    }
                    ?>    
                </select>
                
                <select name="year">
                    <?php
                        for ($i=2017; $i>=1905; $i--) {
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                    ?>                   
                </select>
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
    $bDay = $_POST['day'];
    $bMonth = $_POST['month'];
    $bYear = $_POST['year'];
    $gender = $_POST['gender']; // DO NOT FUCKING ASSUME THIS xD gahahahahaha
    $accountActivated = "no";
    $bDate=mktime(0,0,0,$bMonth,$bDay,$bYear);
    $regDate=time();
    $activationId = md5($username.$email.$bDate.$regDate);



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

        $link = 'http://localhost:3000/activation.php?id='.$activationId;

        require_once 'PHPMailer/Exception.php';
        require_once 'PHPMailer/PHPMailer.php';
        require_once 'PHPMailer/SMTP.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer(); 
        $mail->IsSMTP(); 
        $mail->SMTPDebug = 2; 
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // or 587
        $mail->Username = "centura2java@gmail.com";
        $mail->Password = "Celtra1337";
        $mail->SetFrom("centura2java@gmail.com", "Centura2Java");
        $mail->Subject = "Centura 2 Java registration";
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Body = "Welcome to the celtra challenge Centura 2 Java online converter!\n\nPlease click this link to activate your account: $link";
        $mail->AltBody = "Welcome to the celtra challenge Centura 2 Java online converter!\n\nPlease click this link to activate your account: $link";
        $mail->AddAddress($email);
        
        

        if(!$mail->Send()) 
        {
            echo "Mailer Error: " . $mail->ErrorInfo;
            fileDeleteLine($file, $line);
        } 
        else 
        {
            echo '<h1>Your registration was successful!</h1>';
            echo "<p>Please confirm your account with the email sent to $email.</p>";
        }

    }
        
    
    echo '<br>Vasa IP adresa: '.$_SERVER['REMOTE_ADDR'].'<br>';



}
?>
    </body>
</html>