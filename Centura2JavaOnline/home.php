<?php

if(empty($_POST['username_login']) || emtpy($_POST['password_login']) ){
    // ucitavanje vrijednosti
    $u = $_POST['username_login'];
    $p = $_POST['password_login'];
    // otvaranje datoteke
    $f = fopen("username_password.txt", 'r');
    flock($f, LOCK_EX);
    // čitanje svakog retka i trazenje username i passworda
    while (($redak = fgets($f, 4096)) !== false) {
        $polje = explode("::", $redak);

       if ($u == $polje[0] && $p == $polje[1]) {

            include('page.php');
        }
    }
    flock($f, LOCK_UN);
    fclose($f);
    
}
else
{
    header('Location: '.$uri.'/index.php');
}

?>