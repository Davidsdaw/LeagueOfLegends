<?php
// Incluir el archivo con las funciones
include 'funcionese.php';

// Llamar a la función y obtener las cuentas
$accounts = obtenerCuentasDisponibles();

// Devolver los datos como JSON
echo json_encode($accounts);
    