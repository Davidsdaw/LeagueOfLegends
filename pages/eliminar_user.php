<?php
include "funciones.php"; // Asegúrate de que tienes la función para conectar a la base de datos y para eliminar el usuario.

if (isset($_POST['eliminar_usuario']) && isset($_POST['user'])) {
    // Obtener el email del usuario que quieres eliminar
    $user = $_POST['user'];

    // Llamar a la función eliminarUsuario() para eliminar el usuario de la base de datos
    if (eliminarUsuario($user)) {
        // Redirigir o mostrar mensaje de éxito
        echo "<p class='text-green-500 text-center'>El usuario con el correo $user ha sido eliminado correctamente.</p>";
        header("Location: ./usuarios.php"); // Redirigir a la página de administración
    } else {
        echo "<p class='text-red-500 text-center'>Hubo un error al eliminar el usuario con el correo $user.</p>";
    }
} else {
    echo "<p class='text-red-500 text-center'>No se recibió el correo del usuario.</p>";
}
?>

