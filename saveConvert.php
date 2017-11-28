<?php
    session_start();
    $var = 1;

    if(!isset($_SESSION['id']))
    {
        header("Location: /");
        exit();
    }

    require_once('funkcije.php');

    $userID = $_SESSION['id'];
    // $userID = 1;
    $convertsIndexFile = 'converts_by_id/'.$userID.'_converted.txt';
    $centura_code = $_POST['jsCenturaCode'];
    $java_code = $_POST['jsJavaCode'];
    $time = time();
    $postId = increment($convertsIndexFile);
    $centuraLine = 'converted_files/'.$userID.'_'.$time.'_'.$postId.'_cen.txt';
    $javaLine = 'converted_files/'.$userID.'_'.$time.'_'.$postId.'_java.txt';
    $line = $postId."\t".$userID."\t".$centuraLine."\t".$javaLine."\n";
    fileWriteLine($convertsIndexFile, $line);

    file_put_contents($centuraLine, $centura_code);
    file_put_contents($javaLine, $java_code);

?>