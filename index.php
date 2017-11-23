<html>
<head>
    <title>Celtra challenge </title>
    <meta charset="UTF-8">
</head>
<body>
    <?php

    require_once('funkcije.php');


    if(isset($_GET['kv']))
    {
        $kv = $_GET['kv'];
    }
    else
    {
        // $kv='d';
    }

    switch($kv)
    {
    // case '':
    //     break;
    // case 'd':
    default:
        login();
        break;
    }


    



    ?>





</body>
</html>