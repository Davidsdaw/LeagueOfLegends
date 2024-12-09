<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/formularios.css">
</head>

<body>
    <?php
    include "funciones.php";
    if (isset($_SESSION['usuario']) && $_SESSION['rol'] == 'A') {
    } else header("Location: ../index.php");
    inactividad();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_cuenta'])) {
        $id_cuenta = $_POST['id_cuenta']; // Obtener el ID de la cuenta a eliminar
        if (eliminarCuenta($id_cuenta)) {
            echo "<p class='text-green-500 text-center'>La cuenta con ID $id_cuenta se eliminó correctamente.</p>";
        } else {
            echo "<p class='text-red-500 text-center'>Ocurrió un error al intentar eliminar la cuenta con ID $id_cuenta.</p>";
        }
    }
    ?>
    <div class="flex flex-row gap-8 items-center justify-center  text-center">
        <h1 class="text-2xl font-bold text-center text-gray-700 my-6">Administrar Usuarios</h1>
        <button class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-700">
            <a href="./perfil_admin.php">Volver</a>
        </button>
    </div>


    <div class="flex justify-center">
        <table class="table-auto border-collapse border border-gray-300 bg-white shadow-md w-3/4">
            <thead>
                <tr>
                    <th class="px-4 py-2 border border-gray-300 bg-gray-100 text-gray-700 font-semibold">Usuario</th>
                    <th class="px-4 py-2 border border-gray-300 bg-gray-100 text-gray-700 font-semibold">Password</th>
                    <th class="px-4 py-2 border border-gray-300 bg-gray-100 text-gray-700 font-semibold">Rol</th>
                    <th class="px-4 py-2 border border-gray-300 bg-gray-100 text-gray-700 font-semibold">Mail</th>
                    <th class="px-4 py-2 border border-gray-300 bg-gray-100 text-gray-700 font-semibold">Accion</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $resultado = mostrarUsuarios();
                // Verificar si hay resultados
                if (!empty($resultado)) {
                    foreach ($resultado as $user) {
                        echo "<tr>";
                        echo "<td class='px-4 py-2 border border-gray-300 text-gray-600'>{$user['user']}</td>";
                        echo "<td class='px-4 py-2 border border-gray-300 text-gray-600'>{$user['password']}</td>";
                        echo "<td class='px-4 py-2 border border-gray-300 text-gray-600'>{$user['rol']}</td>";
                        echo "<td class='px-4 py-2 border border-gray-300 text-gray-600'>{$user['mail']}</td>";
                        echo "<td class='px-4 py-2 border border-gray-300 text-center'>
                        
    <form method='GET' action='editar_user.php' class='inline-block'>
        <input type='hidden' name='user' value='{$user['user']}'>
        <button type='submit' class='px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700'>
            Editar
        </button>
    </form>
                                <!-- Formulario para eliminar -->
    <form method='POST' action='eliminar_user.php' class='inline-block'>
        <input type='hidden' name='user' value='{$user['user']}'>
        <button type='submit' name='eliminar_usuario' class='px-4 py-2 bg-red-500 text-white rounded hover:bg-red-700'>
            Eliminar
        </button>
    </form>
                                </td>";


                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='11' class='px-4 py-2 border border-gray-300 text-center text-gray-600'>No hay datos disponibles</td></tr>";
                }

                ?>
            </tbody>
        </table>
        <button type='button' class='bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600' onclick='showAddForm()'>Añadir Usuario</button>
    </div>
    <!-- Formulario para añadir usuario (inicialmente oculto) -->
    <div id="addUserForm" class="hidden">
        <h2 class="text-xl font-bold text-center text-gray-700 mb-6">Añadir Usuario</h2>
        <form method="POST" action="añadir_usuario.php" class="w-1/2 mx-auto bg-white p-6 rounded shadow-md">
            <div class="mb-4">
                <label for="nombre" class="block text-gray-700">Nombre de Usuario:</label>
                <input type="text" name="nombre" id="nombre" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email:</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Contraseña:</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="rol" class="block text-gray-700">Rol:</label>
                <select name="rol" id="rol" class="w-full px-4 py-2 border rounded" required>
                    <option value="A">A</option>
                    <option value="U">R</option>
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">Añadir Usuario</button>
            <button type="button" onclick="closeAddForm()" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700 mt-2">Cancelar</button>
        </form>
    </div>

    <!-- Script de JavaScript -->
    <script>
        // Mostrar el formulario para añadir usuario
        function showAddForm() {
            document.getElementById('addUserForm').classList.remove('hidden');
        }

        // Ocultar el formulario para añadir usuario
        function closeAddForm() {
            document.getElementById('addUserForm').classList.add('hidden');
        }
    </script>

</body>

</html>