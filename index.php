<html>
<head>
    <title>Celtra challenge </title>
    <meta charset="UTF-8">
</head>
<body>
    <?php

    require_once('funkcije.php');
    require_once('converter.php');


    if(isset($_GET['kv']))
    {
        $kv = $_GET['kv'];
    }
    else
    {
        $kv='';
    }

    switch($kv)
    {
    // case '':
    //     break;
    // case 'd':
    case 'convert':
        convert();
    default:
        login();
        registracija();
        convertInterface();
        break;
    }


    



    ?>





</body>
</html>