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
    $resultado = [];
    $resultado2 = '';
    include 'pages/funciones.php';
    connect_bd();
    generarToken();
    $error = '&nbsp';
    if (!isset($_SESSION['usuario'])) {
        if (isset($_POST['usuario']) && isset($_POST['password']) && isset($_POST['token'])) {
            $usuario = $_POST['usuario'];
            $password = $_POST['password'];
            $token = $_POST['token'];


            $resultado = comprobarlogin($usuario, $password,$token);

            if ($resultado[0] != $usuario) {
                $error = $resultado[1];
            } else if ($resultado[1] != '') {
                $resultado2 = $resultado[0];
                $error = $resultado[1];
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
                    <input placeholder="Usuario" type="text" name="usuario" id="usuario" autocomplete="off" required <?php if ($resultado2 !== '') echo "value='$resultado2'"; ?>>

                    <label for="usuario">Usuario:</label>
                </div>
                <div class="floating-label">
                    <input placeholder="Contraseña" type="password" name="password" id="password" autocomplete="off" required>
                    <label for="password">Contraseña:</label>
                </div>
                <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                <p class="error" id="error"><?php echo $error; ?></p>
                <button id="log" type="submit">Log in</button>
            </form>
        </div>
        <script src="./js/script.js"></script>
    <?php
    } else header("Location: ./pages/paginamain.php")
    ?>
</body>

</html>