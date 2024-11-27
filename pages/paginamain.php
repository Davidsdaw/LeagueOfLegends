<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoLAccounts</title>
    <link rel="stylesheet" href="../css/pagmain.css">
</head>

<body>
    <?php
    include "funciones.php";
    if (isset($_SESSION['usuario'])) {
    } else header("Location: ../index.php");

    ?>
    <h1>Cuentas de League of Legends</h1>
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

</html>