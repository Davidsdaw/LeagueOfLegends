<?php
// Incluir las funciones necesarias
include 'funciones.php';
// Verificar si se ha enviado el formulario para añadir el usuario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $user = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];

    // Validar que los campos no estén vacíos
    if (empty($user) || empty($email) || empty($password) || empty($rol)) {
        echo "Todos los campos son obligatorios.";
    } else {
        // Llamar a la función para añadir la cuenta
        $resultado = insertarUsuario($user, $password, $rol, $email);
        if ($resultado) {
            echo "Usuario añadido con éxito.";
            header("Location: usuarios.php"); // Redirigir de nuevo a la página de cuentas
        } else {
            echo "Hubo un error al añadir el usuario.";
        }
    }
}
