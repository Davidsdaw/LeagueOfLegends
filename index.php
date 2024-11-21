<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>LeagueOfLegends</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php
    include 'pages/funciones.php';
    connect_bd();
    if(isset($_POST['usuario'])){
        $usuario= $_POST['usuario'];
    }
    ?>
    <div class="session">
        <div class="left">
        </div>
        <form action="#" method="POST" class="log-in" autocomplete="off">
            <h4>Somos <span>LoLAccs</span></h4>
            <p>Welcome back! Log in to your account to view today's clients:</p>
            <div class="floating-label">
                <input placeholder="Usuario" type="text" name="usuario" id="usuario" autocomplete="off">
                <label for="usuario">Usuario:</label>
            </div>
            <div class="floating-label">
                <input placeholder="Contraseña" type="password" name="password" id="password" autocomplete="off">
                <label for="password">Contraseña:</label>
            </div>
            <button type="submit" onClick="return false;">Log in</button>
        </form>
    </div>
</body>

</html>