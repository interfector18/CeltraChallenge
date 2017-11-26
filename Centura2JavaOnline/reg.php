<?php


$greska = false;  //OPCENITI INDIKATOR GRESKE(SEMAFOR)
$poruke = array(); //SPREMNIK ZA SVE PORUKE O GRESKAMA

if(empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['confirm_password'])){
    $greska=true;
    $poruke[]='<p>All fields should be filled!</p>';
}
if(strlen($_POST['username'])<3){
    $greska = true;
    $poruke[]= '<p>Error: Username can\'t be so short.</p>';
}

if(strpos($_POST['email'],'@')===false){
    $greska=true;
    $poruke[]='<p>Error: e-mail should have @ sign!</p>';
}
if($_POST['password']!==$_POST['confirm_password'])
{
    $greska=true;
    $poruke[] = '<p>Error: password not confirmed.</p>';
}

if($greska){
    echo '<h1>Error</h1>';
    foreach($poruke as $poruka) {echo '<p>'.$poruka.'</p>';}
    echo '<a href="index.php">Get me back!</a>';
}
else{
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_md5 = md5($_POST['password']);
    $email_postoji = false;
    
    // KREIRANJE DATUMA REGISTRACIJE
    $datum_registracije = time();
    
    // *2*
    $f = 'username_password.txt';
    define('TAB',"::");
    define('END',"\n");
    
    // KONTROLA JEDINSTVENOSTI USERNAME-a I EMAILA
    if(unikat($f, 0, $username, 1, $email))
    {    
        $redak = $username.TAB.$email.TAB.$password.TAB.md5($password).END;
        
        unos($f,$redak);
        
        // Potvrdna poruka
        
    }else
    {
        echo '<h1>Takav email se vec koristi.</h1>';
    }

}

?>