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

        <form action="reg.php" method="post">
            <input type="text" name="username" placeholder="Enter your username">
            <br>
            <input type="Password" name="password" placeholder="Enter your password">
            <br>
            <input type="Password" name="confirm_password" placeholder="Confirm your password">
            <br>
            <input type="text" name="email" placeholder="Enter your email">
            <br>
            <input type="submit" name="submit" value="Register">
        </form>



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
?>