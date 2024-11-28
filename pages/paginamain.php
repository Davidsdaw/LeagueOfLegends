<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoLAccounts</title>
    <link rel="stylesheet" href="../css/pagmain.css">
    <script src="https://kit.fontawesome.com/b2238aa62f.js" crossorigin="anonymous"></script>
</head>

<body class="light-theme">
    <header>
        <div class="logo">LoLAccounts</div>
        <div class="buttons">
            <i class="fa-solid fa-moon"></i> <!--Cambiar el tema -->
            <i class="fa-solid fa-user-plus" id="userIcon"></i> <!--Si el usuario es admin le sale las 2 opciones -->
            <a href="./logout.php" class="aaaa"><i class="fa-solid fa-right-from-bracket"></i></a><!--Logout para eliminar el login guardado !!!!NO HAY UNA PAGINA LOGOUT!!!-->
            <!--Menu Despegable -->
            <div class="dropdown" id="dropdownMenu">
                <a href="./perfil_usuario.php">Personalizar Usuario</a>
                <a href="./perfil_admin.php">Administrar</a>
            </div>
        </div>
    </header>
    <?php
    include "funciones.php";
    if (isset($_SESSION['usuario'])) {
    } else header("Location: ../index.php");

    ?>




    <div id="accounts-container">

        <?php
        $accounts = obtenerCuentasDisponibles();
        foreach ($accounts as $cuenta) {
            echo "<div class='card'>
                <p><span>Rango:</span> " . $cuenta['rango'] . "</p>
                <p><span>Región:</span> " . $cuenta['region'] . "</p>
                <p><span>Nivel:</span> " . $cuenta['nivel'] . "</p>
                <p><span>Blue Essence:</span> " . $cuenta['be'] . "</p>
                <p><span>Riot Points:</span> " . $cuenta['rp'] . "</p>
                <div class='price'>" . $cuenta['precio'] . "€</div>
                <button>Comprar</button>
            </div>";
        }
        ?>
    </div>
</body>
<script src="../js/paginamain.js"></script>

</html>