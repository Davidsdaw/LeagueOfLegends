<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoLAccounts</title>
    <link rel="stylesheet" href="../css/pagmain.css">
    <script src="https://kit.fontawesome.com/b2238aa62f.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/css.css">

</head>

<body class="light-theme">

    <?php
    include "funciones.php";
    if (isset($_SESSION['usuario'])) {
    } else header("Location: ../index.php");
    inactividad();

    ?>
    <div class="coment">
        <i class="fa-solid fa-comment"></i>
    </div>
    <header class="bg-gray-800 text-white p-4 shadow-md flex items-center justify-between">
        <!-- Logo y Nombre de la página -->
        <div class="flex items-center space-x-4">
            <img src="../assets/images/logo.png" alt="Logo" class="w-12 h-12 rounded-full">
            <h1 class="text-xl font-bold">LoLAccs</h1>
        </div>

        <!-- Información del usuario y botón de logout -->
        <div class="flex items-center space-x-4">
            <!-- Foto y Nombre del Usuario -->
            <div class="flex items-center space-x-2" id="userIcon">
                <span class="font-medium"><?php echo $_SESSION['usuario'] ?></span>
                <img src="<?php echo $_SESSION['imagenRuta'] ?>" alt="User Picture" class="w-12 h-12 rounded-full border-2 border-gray-600">
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
    <main class="bg-gray-900 text-white p-8">
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
            <form class="flex flex-wrap gap-4" method="POST">
                <select class="bg-gray-700 border border-gray-600 rounded-lg p-2 text-white w-full sm:w-auto" id="rango" name="rango">
                    <option value="" selected disabled>Rango</option>
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
                <select class="bg-gray-700 border border-gray-600 rounded-lg p-2 text-white w-full sm:w-auto" id="champs" name="champs">
                    <option value=""selected disabled>Campeones</option>
                    <option value="40">Hasta 40 Campeones</option>
                    <option value="80">Hasta 80 Campeones</option>
                    <option value="160">Hasta 160 Campeones</option>
                </select>
                <select class="bg-gray-700 border border-gray-600 rounded-lg p-2 text-white w-full sm:w-auto" id="precio" name="precio">
                    <option value=""selected disabled>Precio</option>
                    <option value="50">Hasta $50</option>
                    <option value="100">Hasta $100</option>
                    <option value="200">Hasta $200</option>
                </select>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">
                    Aplicar Filtros
                </button>
            </form>
        </section>

        <!-- Productos -->
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rango = isset($_POST['rango']) && $_POST['rango'] !== '' ? $_POST['rango'] : 'ALL';
    $champs = isset($_POST['champs']) && $_POST['champs'] !== '' ? $_POST['champs'] : '999';
    $precio = isset($_POST['precio']) && $_POST['precio'] !== '' ? $_POST['precio'] : '999';
    $accounts = obtenerCuentasFiltro($rango, $champs, $precio);
            } else $accounts = obtenerCuentasDisponibles();

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


    <!--Boton de abajo izquierda para algo -->

    <h2 class="faq">Nuestros Clientes</h2>
    <!-- CARRUSEL DE FEEDBACK -->
    <div class="carousel relative overflow-hidden mx-auto w-4/5 mb-10 h-auto bg-gray-900">
  <!-- Sombras laterales -->
  <div class="absolute top-0 left-0 w-36 h-full bg-gradient-to-r from-gray-900 to-transparent pointer-events-none z-10"></div>
  <div class="absolute top-0 right-0 w-36 h-full bg-gradient-to-l from-gray-900 to-transparent pointer-events-none z-10"></div>

  <!-- Pista del carrusel -->
  <div class="carousel-track flex animate-scroll">
    <!-- Tarjeta 1 -->
    <div class="card min-w-[450px] mx-2 p-6 bg-gradient-to-r from-gray-800 to-gray-700 rounded-lg shadow-lg flex-shrink-0 text-white">
      <h3 class="text-xl font-semibold">Eddy Boy</h3>
      <p class="text-sm text-gray-400">Desde España</p>
      <div class="flex items-center mt-3">
        <!-- Estrellas -->
        <div class="flex space-x-1 text-yellow-400">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
        </div>
        <span class="ml-3 text-sm text-gray-400">4/5</span>
      </div>
      <p class="mt-4 text-sm">"¡Siempre cumplen con lo prometido! Estoy impresionado con la rapidez y la calidad del servicio."</p>
    </div>

    <!-- Tarjeta 2 -->
    <div class="card min-w-[450px] mx-2 p-6 bg-gradient-to-r from-gray-800 to-gray-700 rounded-lg shadow-lg flex-shrink-0 text-white">
      <h3 class="text-xl font-semibold">Paulino</h3>
      <p class="text-sm text-gray-400">Desde Portugal</p>
      <div class="flex items-center mt-3">
        <!-- Estrellas -->
        <div class="flex space-x-1 text-yellow-400">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
        </div>
        <span class="ml-3 text-sm text-gray-400">5/5</span>
      </div>
      <p class="mt-4 text-sm">"Literalmente 11/10. Superaron todas mis expectativas, excelente atención al cliente."</p>
    </div>

    <!-- Tarjeta 3 -->
    <div class="card min-w-[450px] mx-2 p-6 bg-gradient-to-r from-gray-800 to-gray-700 rounded-lg shadow-lg flex-shrink-0 text-white">
      <h3 class="text-xl font-semibold">D. McGregor</h3>
      <p class="text-sm text-gray-400">Desde Estados Unidos</p>
      <div class="flex items-center mt-3">
        <!-- Estrellas -->
        <div class="flex space-x-1 text-yellow-400">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
        </div>
        <span class="ml-3 text-sm text-gray-400">4.5/5</span>
      </div>
      <p class="mt-4 text-sm">"Un servicio increíble, definitivamente volveré a usarlo. Lo recomiendo a todos."</p>
    </div>
        <!-- Tarjeta 4 -->
        <div class="card min-w-[450px] mx-2 p-6 bg-gradient-to-r from-gray-800 to-gray-700 rounded-lg shadow-lg flex-shrink-0 text-white">
      <h3 class="text-xl font-semibold">Paulino</h3>
      <p class="text-sm text-gray-400">Desde Portugal</p>
      <div class="flex items-center mt-3">
        <!-- Estrellas -->
        <div class="flex space-x-1 text-yellow-400">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
        </div>
        <span class="ml-3 text-sm text-gray-400">5/5</span>
      </div>
      <p class="mt-4 text-sm">"Literalmente 11/10. Superaron todas mis expectativas, excelente atención al cliente."</p>
    </div>
  </div>
</div>
<div class="carousel relative overflow-hidden mx-auto w-4/5 mb-20 h-auto bg-gray-900">
  <!-- Sombras laterales -->
  <div class="absolute top-0 left-0 w-36 h-full bg-gradient-to-r from-gray-900 to-transparent pointer-events-none z-10"></div>
  <div class="absolute top-0 right-0 w-36 h-full bg-gradient-to-l from-gray-900 to-transparent pointer-events-none z-10"></div>

  <!-- Pista del carrusel -->
  <div class="carousel-track2 flex animate-scroll">
    <!-- Tarjeta 1 -->
    <div class="card min-w-[450px] mx-2 p-6 bg-gradient-to-r from-gray-800 to-gray-700 rounded-lg shadow-lg flex-shrink-0 text-white">
      <h3 class="text-xl font-semibold">Eddy Boy</h3>
      <p class="text-sm text-gray-400">Desde España</p>
      <div class="flex items-center mt-3">
        <!-- Estrellas -->
        <div class="flex space-x-1 text-yellow-400">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
        </div>
        <span class="ml-3 text-sm text-gray-400">4/5</span>
      </div>
      <p class="mt-4 text-sm">"¡Siempre cumplen con lo prometido! Estoy impresionado con la rapidez y la calidad del servicio."</p>
    </div>

    <!-- Tarjeta 2 -->
    <div class="card min-w-[450px] mx-2 p-6 bg-gradient-to-r from-gray-800 to-gray-700 rounded-lg shadow-lg flex-shrink-0 text-white">
      <h3 class="text-xl font-semibold">Paulino</h3>
      <p class="text-sm text-gray-400">Desde Portugal</p>
      <div class="flex items-center mt-3">
        <!-- Estrellas -->
        <div class="flex space-x-1 text-yellow-400">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
        </div>
        <span class="ml-3 text-sm text-gray-400">5/5</span>
      </div>
      <p class="mt-4 text-sm">"Literalmente 11/10. Superaron todas mis expectativas, excelente atención al cliente."</p>
    </div>

    <!-- Tarjeta 3 -->
    <div class="card min-w-[450px] mx-2 p-6 bg-gradient-to-r from-gray-800 to-gray-700 rounded-lg shadow-lg flex-shrink-0 text-white">
      <h3 class="text-xl font-semibold">D. McGregor</h3>
      <p class="text-sm text-gray-400">Desde Estados Unidos</p>
      <div class="flex items-center mt-3">
        <!-- Estrellas -->
        <div class="flex space-x-1 text-yellow-400">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
        </div>
        <span class="ml-3 text-sm text-gray-400">4.5/5</span>
      </div>
      <p class="mt-4 text-sm">"Un servicio increíble, definitivamente volveré a usarlo. Lo recomiendo a todos."</p>
    </div>
        <!-- Tarjeta 4 -->
        <div class="card min-w-[450px] mx-2 p-6 bg-gradient-to-r from-gray-800 to-gray-700 rounded-lg shadow-lg flex-shrink-0 text-white">
      <h3 class="text-xl font-semibold">Paulino</h3>
      <p class="text-sm text-gray-400">Desde Portugal</p>
      <div class="flex items-center mt-3">
        <!-- Estrellas -->
        <div class="flex space-x-1 text-yellow-400">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 .587l3.668 7.431L23.39 9.9l-5.726 5.553 1.353 7.885L12 18.897l-7.017 4.441 1.353-7.885L.61 9.9l7.722-1.882z" />
          </svg>
        </div>
        <span class="ml-3 text-sm text-gray-400">5/5</span>
      </div>
      <p class="mt-4 text-sm">"Literalmente 11/10. Superaron todas mis expectativas, excelente atención al cliente."</p>
    </div>
  </div>
</div>

    <!--Preguntas y respuestas-->
    <div class="faq-container">
        <h2 class="faq">FAQs About LoL Accounts</h2>
        <div class="faq-item">
            <button class="faq-question">How do I pick a League of Legends account?</button>
            <div class="faq-answer">
                <p>Choose an account based on your desired rank, skins, and champion pool.</p>
            </div>
        </div>
        <div class="faq-item">
            <button class="faq-question">I’ve chosen an account. Now what?</button>
            <div class="faq-answer">
                <p>Once you've chosen an account, complete the purchase and follow the delivery instructions.</p>
            </div>
        </div>
        <div class="faq-item">
            <button class="faq-question">How fast can I start playing?</button>
            <div class="faq-answer">
                <p>You can start playing as soon as you receive the account credentials, usually within minutes.</p>
            </div>
        </div>
        <div class="faq-item">
            <button class="faq-question">What if I encounter issues with the account?</button>
            <div class="faq-answer">
                <p>Contact support immediately for assistance with any account issues.</p>
            </div>
        </div>
        <div class="faq-item">
            <button class="faq-question">How do I keep the account secure?</button>
            <div class="faq-answer">
                <p>Enable two-factor authentication and avoid sharing your credentials with anyone.</p>
            </div>
        </div>
    </div>
    <!--Pie de pagina -->
    <footer class="footer">
        <div class="payment-methods">
            <img src="../assets/images/metodos de pago/visa.png" alt="Visa">
            <img src="../assets/images/metodos de pago/mastercard.png" alt="MasterCard">
            <img src="../assets/images/metodos de pago/psc.png" alt="PaySafeCard">
            <img src="../assets/images/metodos de pago/apay.png" alt="Apple Pay">
            <img src="../assets/images/metodos de pago/gpay.png" alt="Google Pay">
            <img src="../assets/images/metodos de pago/sepa.png" alt="SEPA">
            <img src="../assets/images/metodos de pago/skrill.png" alt="Skrill">
            <img src="../assets/images/metodos de pago/trustly.png" alt="Trustly">
        </div>
        <div class="footer-content">
            <div class="footer-column">
                <h3>Game Boost</h3>
                <p>The All-In-One Platform for Gamers</p>
                <p>Changing the lives of everyday gamers, one game at a time.</p>
                <p>
                    <strong>Headquarter:</strong> Strmec Stubički 124, Općina Stubičke Toplice, Croatia<br>
                    <strong>Office:</strong> Petrovaradinska 1, 4th floor, 10 000 Zagreb, Croatia<br>
                    <strong>Registration Number:</strong> 081421549
                </p>
            </div>
            <div class="footer-column">
                <h3>Company</h3>
                <ul>
                    <li><a href="#">Contact us</a></li>
                    <li><a href="#">Work with us</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">GameBoost Cares</a></li>
                    <li><a href="#">Definitions</a></li>
                    <li><a href="#">Site Map</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Legal</h3>
                <ul>
                    <li><a href="#">Terms of service</a></li>
                    <li><a href="#">Privacy policy</a></li>
                    <li><a href="#">Cookies policy</a></li>
                    <li><a href="#">Code of honor</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Need Help?</h3>
                <p>We're here to help. Our expert human-support team is at your service 24/7.</p>
                <div class="support-buttons">
                    <button class="chat-btn">
                        <i class="fa-regular fa-comment"></i>
                        Let’s Chat</button>
                    <button class="discord-btn">
                        <i class="fa-brands fa-discord"></i>
                        Join Discord</button>
                </div>
            </div>
        </div>


        <div class="copyright">
            <small>
                <h3>Copyright © 2024 Global Gaming Services d.o.o. All rights Reserved</h3>
            </small>
            <div>


            </div>
            <div class="i">
                <i class="fa-brands fa-facebook"></i>
                <i class="fa-brands fa-x-twitter"></i>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-youtube"></i>
                <i class="fa-brands fa-tiktok"></i>
            </div>
        </div>
    </footer>

</body>
<script src="../js/paginamain.js"></script>

</html>