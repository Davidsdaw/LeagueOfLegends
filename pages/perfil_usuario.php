<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Usuario</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/perfil_usuario.css">
</head>

<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center">
    <?php
    include "./funciones.php";
    if (isset($_SESSION['usuario'])) {
    } else header("Location: ../index.php");

    $datosPerfil = cargarDatosPerfil($_SESSION['usuario']);

    $error = '';

    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
        cambiarFoto($_SESSION['usuario'], $_FILES['product_image']);
    }

    if (isset($_POST['usuario']) && isset($_POST['password']) && isset($_POST['email'])) {
        $error = modificarPerfil($_POST['usuario'], $_POST['password'], $_POST['email'], $_SESSION['imagenRuta']);
    }

    ?>
    <div class="bg-gray-800 p-8 rounded-lg shadow-lg max-w-lg w-full">
        <h1 class="text-2xl font-bold mb-6 text-center">Perfil Publico</h1>

        <form action="#" method="POST" enctype="multipart/form-data" class="space-y-6">
            <!-- Nombre -->
            <div>
                <label for="usuario" class="block text-sm font-medium">Usuario</label>
                <input type="text" id="usuario" name="usuario" <?php if ($datosPerfil[0]) echo "value='$datosPerfil[0]'" ?>
                    class="mt-2 w-full bg-gray-700 border border-gray-600 rounded-lg p-2.5 text-white placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500" />
                <?php
                if ($error != '') {
                    echo '<p class="error">' . $error . ' </p>';
                }
                ?>
            </div>

            <!-- Correo público -->
            <div>
                <label for="email" class="block text-sm font-medium">Email</label>
                <input type="email" id="email" name="email" <?php if ($datosPerfil[2]) echo "value='$datosPerfil[2]'" ?> class="mt-2 w-full bg-gray-700 border border-gray-600 rounded-lg p-2.5
                    text-white focus:ring-blue-500 focus:border-blue-500">
                </select>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium">Contraseña</label>
                <input type="password" id="password" name="password" <?php if ($datosPerfil[1]) echo "value='$datosPerfil[1]'" ?> class="mt-2 w-full bg-gray-700 border border-gray-600 rounded-lg p-2.5
                    text-white focus:ring-blue-500 focus:border-blue-500">
                </select>
            </div>

            <!-- Foto de perfil -->
            <div>
                <label class="block text-sm font-medium mb-2">Foto de Perfil</label>
                <div class="relative w-32 h-32 mx-auto">
                    <img id="profileImage" src="<?php if ($_SESSION['imagenRuta'] != '') echo $_SESSION['imagenRuta'] ?>" alt="Profile Picture"
                        class="w-32 h-32 rounded-full object-cover border-2 border-gray-600" />
                    <label for="product_image"
                        class="absolute bottom-0 right-0 bg-blue-500 text-white p-2 rounded-full cursor-pointer hover:bg-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </label>
                    <input type="file" id="product_image" name="product_image" accept="image/*" class="hidden"
                        onchange="updateProfilePicture(event)" />

                </div>
            </div>

            <!-- Botón de guardar -->
            <div class="text-center flex space-x-4">
                <!-- Botón Guardar -->
                <button type="submit" name="insert"
                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg w-1/2">
                    Guardar
                </button>
                <!-- Botón Descartar -->
                <button type="reset"
                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg w-1/2">
                    Descartar
                </button>
            </div>
            <div class="text-center mt-4">
                <!-- Botón Volver -->
                <a href="./paginamain.php"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg w-full block">
                    Volver
                </a>
            </div>
        </form>
    </div>




</body>
<script src="../js/profile.js"></script>

</html>