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
            $max = 0;

            $fileContents = file_get_contents($file);
            $fileContents = str_replace($line, "", $fileContents);
            file_put_contents($file, $fileContents);
        }
    }
?>