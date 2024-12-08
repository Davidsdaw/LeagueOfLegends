<?php
// Incluir las funciones necesarias
include 'funciones.php';

// Verificar si se envió el formulario con el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = $_POST['email']; // Obtener el ID de la cuenta a eliminar

    // Llamar a la función para eliminar la cuenta
    if (eliminarUsuario($email)) {
        // Redirigir con éxito
        header("Location: ../pages/usuarios.php");
        exit;
    } else {
        // Redirigir con error
        header("Location: ../pages/administrar_cuentas.php?mensaje=error");
        exit;
    }
} else {
    // Si se accede al archivo directamente o no se pasa el ID, redirigir
    header("Location: ../pages/usuarios.php");
    exit;
}
