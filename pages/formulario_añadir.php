<?php
include 'funciones.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar los datos del formulario
    $rp = $_POST['rp'];
    $rango = $_POST['rango'];
    $precio = $_POST['precio'];
    $estado = $_POST['estado'];
    $be = $_POST['be'];
    $region = $_POST['region'];
    $nivel = $_POST['nivel'];
    $campeones = $_POST['campeones'];
    $skins = $_POST['skins'];
    $id_proveedor = $_POST['id_proveedor'];
    // Llamar a la función para añadir la cuenta
    $resultado = añadirCuenta($rp, $rango, $precio, $estado, $be, $region, $nivel, $campeones, $skins, $id_proveedor);

    if ($resultado) {
        echo "Cuenta añadida con éxito.";
        header("Location: añadircuenta.php"); // Redirigir de nuevo a la página de cuentas
    } else {
        echo "Hubo un error al añadir la cuenta.";
    }
}
