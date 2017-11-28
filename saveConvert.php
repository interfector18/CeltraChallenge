<?php

    if(!isset($_SESSION['id']))
    {
        header("Location: /");
        exit();
    }

    require_once('funkcije.php');

    $userID = $_SESSION['id'];
    $convertsIndexFile = 'converts_by_id/'.$userID.'_converted.txt';
    $fileName = 'converts_by_id'.$userID.'_converted.txt';
    $centura_code = $_POST['jsCenturaCode'];
    $java_code = $_POST['jsJavaCode'];

    if(!file_exists($convertsIndexFile))
    {
        $idPost = 1;
        fileWriteLine($fileName, $line);
    }
    else
    {
        $file = 'converts_by_id/'.$_SESSION['id'].'_converted.txt';                  
        $f = fopen($file, 'r');
        while (($line = fgets($f, 4096)) !== false) {
            $array = explode("\t", $line);
            $centura_dat = $array[2];
            $java_dat = $array[3];
            $java_dat = str_replace("\r", "", $java_dat);
            $java_dat = str_replace("\n", "", $java_dat);
            
            $centura_code = array();
            $java_code = array();
            $centura_code = file_get_contents($centura_dat);
            $java_code = file_get_contents($java_dat);

            $dat_array = explode("_", $java_dat);
            
            $conv_date = date('d/m/Y', $dat_array[2]);

        }
        fclose($f);


?>