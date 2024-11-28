<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    //Aqui va la logica del cierre de sesion pero seguro que no esta bien , maten a los moros

    session_start();
    session_destroy();
    session_unset();
    $_SESSION = [];
    header("Location: ../index.php"); //donde coño esta login.php
    exit();





    ?>
</body>

</html>