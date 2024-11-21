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
    session_start();
    $error = '&nbsp';
    if (isset($_POST['usuario']) && isset($_POST['password'])) {
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];

        $resultado = comprobarlogin($usuario, $password);

        if ($resultado !== true) {
            $error = $resultado;
        } else {

        }

    }
    ?>
    <div class="session">
        <div class="left">
        </div>
        <form action="#" method="POST" class="log-in" autocomplete="off">
            <h4>Bienvenido</h4>
            <p class="descripcion">Encuentra las mejores ofertas o vende tus cuentas de forma segura y rápida</p>
            <div class="floating-label">
                <input placeholder="Usuario" type="text" name="usuario" id="usuario" autocomplete="off" required>
                <label for="usuario">Usuario:</label>
            </div>
            <div class="floating-label">
                <input placeholder="Contraseña" type="password" name="password" id="password" autocomplete="off" required>
                <label for="password">Contraseña:</label>
            </div>
            <p class="error" id="error"><?php echo $error; ?></p>
            <button id="log" type="submit">Log in</button>
        </form>
    </div>
    <script src="./js/script.js"></script>
</body>

</html>