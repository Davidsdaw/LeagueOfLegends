<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoLAccounts</title>
    <link rel="stylesheet" href="../css/pagmain.css">
    <script src="https://kit.fontawesome.com/b2238aa62f.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="light-theme">

    <?php
    include "funciones.php";
    if (isset($_SESSION['usuario'])) {
    } else header("Location: ../index.php");

    ?>

    <header class="bg-gray-800 text-white p-4 shadow-md flex items-center justify-between">
        <!-- Logo y Nombre de la página -->
        <div class="flex items-center space-x-4">
            <img src="" alt="Logo" class="w-10 h-10 rounded-full">
            <h1 class="text-xl font-bold">LoLAccs</h1>
        </div>

        <!-- Información del usuario y botón de logout -->
        <div class="flex items-center space-x-4">
            <!-- Foto y Nombre del Usuario -->
            <div class="flex items-center space-x-2" id="userIcon">
                <span class="font-medium"><?php echo $_SESSION['usuario'] ?></span>
                <img src="<?php echo $_SESSION['imagenRuta'] ?>" alt="User Picture" class="w-10 h-10 rounded-full border-2 border-gray-600">
                <div class="dropdown" id="dropdownMenu">
                    <a href="./perfil_usuario.php">Personalizar Usuario</a>
                    <?php
                    if ($_SESSION['rol'] == "A") echo '<a href="./perfil_admin.php">Administrar</a>';
                    ?>
                </div>
            </div>
            <!-- Botón Logout -->
            <a href="./logout.php"
                class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg font-medium transition-all duration-300">
                Logout
            </a>
        </div>
    </header>
    <main class="bg-gray-900 text-white min-h-screen p-8">
        <!-- Header del perfil -->
        <section class="bg-gray-800 rounded-lg p-6 mb-10 flex items-center justify-between shadow-lg">
            <div class="flex items-center">
                <img src="<?php echo $_SESSION['imagenRuta'] ?>" alt="Foto de perfil" class="w-12 h-12 rounded-full object-cover">
                <div class="ml-4">
                    <h2 class="text-xl font-bold">Usuario: <?php echo $_SESSION['usuario'] ?></h2>
                    <p class="text-gray-400">Saldo: <span class="text-green-500">$120.00</span></p>
                </div>
            </div>
            <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg">
                Recargar saldo
            </button>
        </section>

        <!-- Filtro -->
        <section class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Filtrar Cuentas</h2>
            <form class="flex flex-wrap gap-4">
                <select class="bg-gray-700 border border-gray-600 rounded-lg p-2 text-white w-full sm:w-auto">
                    <option value="">Rango</option>
                    <option value="hierro">Hierro</option>
                    <option value="bronze">Bronze</option>
                    <option value="plata">Plata</option>
                    <option value="oro">Oro</option>
                    <option value="platino">Platino</option>
                    <option value="esmeralda">Esmeralda</option>
                    <option value="diamante">Diamante</option>
                    <option value="master">Master</option>
                    <option value="grandmaster">Grand Master</option>
                    <option value="challenger">Challenger</option>
                </select>
                <select class="bg-gray-700 border border-gray-600 rounded-lg p-2 text-white w-full sm:w-auto">
                    <option value="">Campeones</option>
                    <option value="40">Hasta 40 Campeones</option>
                    <option value="60">Hasta 60 Campeones</option>
                    <option value="80">Más de 80 Campeones</option>
                </select>
                <select class="bg-gray-700 border border-gray-600 rounded-lg p-2 text-white w-full sm:w-auto">
                    <option value="">Precio</option>
                    <option value="20">$20 - $50</option>
                    <option value="50">$50 - $100</option>
                    <option value="100">Más de $100</option>
                </select>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">
                    Aplicar Filtros
                </button>
            </form>
        </section>

        <!-- Productos -->
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <?php
            $accounts = obtenerCuentasDisponibles();
            foreach ($accounts as $cuenta) {

                echo '<div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <img src="https://via.placeholder.com/300x200" alt="" class="w-full h-48 object-cover">
                <div class="p-4">
                <h2 class="text-lg font-semibold">' . $cuenta['region'] . ' - Nivel ' . $cuenta['nivel'] . ' - ' . $cuenta['rango'] . '</h2>
                    <p class="text-gray-400">' . $cuenta['campeones'] . ' Campeones - ' . $cuenta['skins'] . ' Skins Limitadas</p>
                    <p class="text-gray-400">' . $cuenta['be'] . ' Blue Essence - ' . $cuenta['rp'] . ' Riot Points</p>
                    <p class="text-xl font-bold mt-2">' . $cuenta['precio'] . '€</p>
                    <button class="mt-4 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg w-full">
                        Comprar
                    </button>
                </div>
            </div>';
            }
            ?>
        </section>
    </main>

</body>
<script src="../js/paginamain.js"></script>

</html>