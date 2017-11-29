<?php
    session_start();

    if(!isset($_SESSION['id']))
    {
        header('Location: /');
        exit();
    }
    $userID = $_SESSION['id'];
    $username=$_SESSION['username'];

    if($userID != $_GET['uid']) //zastita da ne netko ne obrise nekom drugom convert, odnosno da moze samo svoj
    {
        header('Location: /');
        exit();
    }
    $postId = $_GET['pid'];

    require_once('funkcije.php');


    
    $convertsIndexFile = 'converts_by_id/'.$userID.'_converted.txt';
    $time = time();

    
    $allConverts = file($convertsIndexFile);
    foreach($allConverts as $line)
    {
        $lineData = explode("\t", $line);
        $centura_dat = $lineData[2];
        $java_dat = $lineData[3];
        $java_dat = str_replace("\r", "", $java_dat);
        $java_dat = str_replace("\n", "", $java_dat);

        if($postId == $lineData[0])
        {
            fileDeleteLine($convertsIndexFile, $line);
        }
    }

    header("Location: /myconverts.php");
    
?>