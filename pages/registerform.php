<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>LeagueOfLegends</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php
    include 'funciones.php';
    connect_bd();
    session_start();
    $error = '&nbsp';
    if (isset($_POST['usuario']) && isset($_POST['password']) && isset($_POST['email'])) {
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        
        $resultado = registrarusuario($usuario, $password, $email);

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
            <h4>Registrate</h4>
            <p class="descripcion">Crea tu cuenta y únete a la plataforma líder en compra y venta de cuentas.</p>
            <div class="floating-label">
                <input placeholder="Usuario" type="text" name="usuario" id="usuario" autocomplete="off" required>
                <label for="usuario">Usuario:</label>
            </div>
            <div class="floating-label">
                <input placeholder="Contraseña" type="password" name="password" id="password" autocomplete="off" required>
                <label for="password">Contraseña:</label>
            </div>
            <div class="floating-label">
                <input placeholder="Email" type="email" name="email" id="email" autocomplete="off" required>
                <label for="email">Email:</label>
            </div>
            <p class="error" id="error"><?php echo $error; ?></p>
            <button id="reg" type="submit">Registrar</button>
        </form>
    </div>

    <script src="../js/script2.js"></script>
</body>

</html>