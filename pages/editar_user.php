<?php
include "funciones.php";

// Comprobar si se pasa un usuario por GET
if (isset($_GET['user'])) {
    $user = $_GET['user']; // Nombre del usuario

    // Obtener datos del usuario desde la base de datos
    $usuario = obtenerUsuarioPorUser($user);

    if (!$usuario) {
        echo "<p class='text-red-500 text-center'>Usuario no encontrado.</p>";
        exit;
    }
} else {
    // Redirigir si noa se recibe un usuario
    header("Location: usuarios.php");
    exit;
}

// Actualizar datos si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar_usuario'])) {
    $old_user = $_POST['old_user']; // Nombre de usuario original
    $new_user = $_POST['new_user']; // Nuevo nombre de usuario
    $password = $_POST['password'];
    $rol = $_POST['rol'];
    $mail = $_POST['mail'];

    // Verificar si el nuevo usuario ya existe
    if ($new_user !== $old_user && usuarioExiste($new_user)) {
        echo "<p class='text-red-500 text-center'>El nombre de usuario ya está en uso. Por favor, elige otro.</p>";
    } else {
        // Actualizar los datos del usuario
        if (actualizarUsuario($old_user, $new_user, $password, $rol, $mail)) {
            echo "<p class='text-green-500 text-center'>Usuario actualizado correctamente.</p>";
            header("Location: usuarios.php");
            exit;
        } else {
            echo "<p class='text-red-500 text-center'>Error al actualizar el usuario.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
        <h1 class="text-2xl font-bold text-gray-700">Editar Usuario</h1>
        <form method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
    <label class="block text-gray-700">Nombre de Usuario:</label>
    <input type="text" required name="new_user" value="<?php echo htmlspecialchars($usuario['user']); ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" requiredd>
</div>
<input type="hidden" name="old_user" value="<?php echo htmlspecialchars($usuario['user']); ?>">

            <div class="mb-4">
                <label class="block text-gray-700">Contraseña:</label>
                <input type="password" name="password" required value="" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Rol:</label>
                <select name="rol" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none">
                    <option selected value="A" <?php echo $usuario['rol'] === 'A' ? 'selected' : ''; ?>>Administrador</option>
                    <option value="R" <?php echo $usuario['rol'] === 'R' ? 'selected' : ''; ?>>Usuario</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Correo:</label>
                <input type="email" required name="mail" value="<?php echo htmlspecialchars($usuario['mail']); ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" name="actualizar_usuario" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none">
                    Actualizar
                </button>
                <a href="usuarios.php" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</body>

</html>
