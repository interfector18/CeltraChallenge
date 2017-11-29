<?php

    function login()
    {
        ?>

        <form action="login.php" method="post">
            <input type="text" name="username" placeholder="Enter your name">
            <br>
            <input type="Password" name="password" placeholder="Enter your password">
            <br>
            <input type="submit" name="submit" value="Login">
        </form>



        <?php
    }

    function registracija()
    {
        ?>

        <a href="reg.php">Register</a>

        <?php
    }

    function convertInterface()
    {
        ?>

        <form method="post" action="?kv=convert">
            <input type="text" name="gCenturaCode" placeholder="Enter your centura code">
            <input type="text" name="gJavaCode" placeholder="Converted code will go here">
            <input type="submit" name="submit" value="Convertaj">
        </form>



        <?php
    }

    function fileWriteLine($file, $line, $mode='a')
    {
        $f=fopen($file,$mode);
        flock($f,LOCK_EX);

        if(fwrite($f,$line)==false)
        {
            return false;
        }

        flock($f,LOCK_UN);
        fclose($f);

        return true;
    }


    function increment($file, $column = 0)
    {
        if(!file_exists($file))
        {
            $id = 1;
            return $id;
        }
        if(file_exists($file) && filesize($file) == 0)
        {
            $id = 1;
            return $id;
        }
        else
        {
            $max = 0;
            $f = fopen($file,'r');
            while(($line = fgets($f,4096)) !== false)
            {
                $polje = explode("\t", $line);
                if($polje[$column] > $max)
                {
                    $max = $polje[$column];
                }
            }
            fclose($f);
            $id = $max + 1;
        }
        return $id;
    }

    function fileDeleteLine($file, $line)
    {
        if(!file_exists($file))
        {
            return;
        }
        else
        {
            $fileContents = file_get_contents($file);
            $fileContents = str_replace($line, "", $fileContents);
            file_put_contents($file, $fileContents);
        }
    }

    function newconversion(){
        
        $java_code=$_POST['java'];
        $centura_code=$_POST['centura'];
        $time=time(); 
        $id_user=$_SESSION['id'];
        $f='converts_by_id/'.$id_user.'_converted.txt';
        $id_conv=increment($f); 
        $centura_dat = 'converted_files/'.$id_user."_".$time."_".$id_conv."_cen.txt";
        $java_dat = 'converted_files/'.$id_user."_".$time."_".$id_conv."_dat.txt";

        $line = $id_conv."\t".$id_user."\t".$time."\t".$centura_dat."\t".$java_dat."\n"; 

        unos($f, $line); 

        //header ('Location: '.$_SERVER['SCRIPT_NAME']); 
                
    }
    
function contains_string($text, $word)
{
    if (strpos($text, $word) !== false) 
    {
        return true;
    } 
    else
    {
        return false;
    }
}
?>