<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/perfil_admin.css">
    <script src="https://kit.fontawesome.com/b2238aa62f.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <?php
    include "funciones.php";
    if (isset($_SESSION['usuario']) && $_SESSION['rol'] == 'A') {
    } else header("Location: ../index.php");
    inactividad();
    ?>
    <div class="container">
        <!-- Menú lateral -->
        <aside class="sidebar">
            <div class="admin-header">
                <h2>Administrador</h2>
                <p>Bienvenido, Admin</p>
                <a href="./paginamain.php">Volver</a>
            </div>
            <nav>
                <ul id="li">
                    <li><a href="#" onclick="mostrarSeccion('datos')">Datos</a></li>
                    <li><a href="#" onclick="mostrarSeccion('admin-cuentas')">Administrar Cuentas</a></li>
                    <li><a href="#" onclick="mostrarSeccion('admin-usuario')">Administrar Usuario</a></li>
                    <li><a href="./logout.php" class="">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Contenido principal -->
        <main class="main-content">
            <!-- Sección para Administrar Cuentas -->
            <section id="datos">
                <?php $datos = mostrarDatos(); ?>
                <h1 class="text-2xl font-bold text-center text-gray-700 my-6">Datos de Proveedores</h1>
                <div class="flex justify-center">
                    <table class="table-auto border-collapse border border-gray-300 bg-white shadow-md">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border border-gray-300 bg-gray-100 text-gray-700 font-semibold">Nombre del Proveedor</th>
                                <th class="px-4 py-2 border border-gray-300 bg-gray-100 text-gray-700 font-semibold">Número de Cuentas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($datos as $fila) {
                                echo "<tr>";
                                echo "<td class='px-4 py-2 border border-gray-300 text-gray-600'>{$fila['Nombre_Proveedor']}</td>";
                                echo "<td class='px-4 py-2 border border-gray-300 text-gray-600'>{$fila['Numero_De_Cuentas']}</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </section>
            <section id="admin-cuentas" class="hidden">

                <div class="container-cards">
                    <div class="card-usuario">
                        <a href="./añadircuenta.php">
                            Administrar Cuenta
                        </a>
                        <i class="fa-solid fa-plus"></i>
                    </div>
                </div>
            </section>

            <!-- Sección para Administrar Usuarios -->
            <section id="admin-usuario" class="hidden">

                <div class="container-cards">
                    <div class="card-usuario">
                        <a href="./usuarios.php"> Administrar Usuario</a>
                        <i class="fa-solid fa-plus"></i>
                    </div>

                </div>
            </section>

            <!-- Sección Añadir Usuario -->
            <section id="add-user" class="hidden">
                <h1>Añadir Usuario</h1>
                <form>
                    <label for="add-name">Nombre del Usuario:</label>
                    <input type="text" id="add-name" name="add-name" required>
                    <label for="add-password">Contraseña:</label>
                    <input type="password" id="add-password" name="add-password" required>
                    <button type="submit">Añadir</button>
                </form>
            </section>

            <!-- Sección Editar Usuario -->
            <section id="edit-user" class="hidden">
                <h1>Editar Usuario</h1>
                <form>
                    <label for="edit-name">Nombre del Usuario:</label>
                    <input type="text" id="edit-name" name="edit-name" required>
                    <label for="edit-new-name">Nuevo Nombre:</label>
                    <input type="text" id="edit-new-name" name="edit-new-name" required>
                    <button type="submit">Actualizar</button>
                </form>
            </section>

            <!-- Sección Eliminar Usuario -->
            <section id="delete-user" class="hidden">
                <h1>Eliminar Usuario</h1>
                <form>
                    <label for="delete-email">Correo del Usuario:</label>
                    <input type="email" id="delete-email" name="delete-email" required>
                    <button type="submit">Eliminar</button>
                </form>
            </section>

            <!-- Sección Agregar Cuenta -->
            <section id="add-cuenta" class="hidden">
                <h1>Agregar Cuenta</h1>
                <form method="POST">
                    <input type="hidden" name="id_cuenta" id="id_cuenta">
                    <label>RP:</label> <input type="number" name="rp" id="rp" required><br>
                    <label>Rango:</label> <input type="text" name="rango" id="rango" required><br>
                    <label>Precio:</label> <input type="number" name="precio" id="precio" step="0.01" required><br>
                    <label>Estado:</label> <input type="text" name="estado" id="estado" required><br>
                    <label>BE:</label> <input type="number" name="be" id="be" required><br>
                    <label>Región:</label> <input type="text" name="region" id="region" required><br>
                    <label>Nivel:</label> <input type="number" name="nivel" id="nivel" required><br>
                    <label>Campeones:</label> <input type="number" name="campeones" id="campeones" required><br>
                    <label>Skins:</label> <input type="number" name="skins" id="skins" required><br>
                    <button type="submit" name="add">Agregar</button>
                </form>
            </section>

            <!-- Sección Editar Cuenta -->
            <section id="edit-cuenta" class="hidden">
                <h1>Editar Cuenta</h1>
                <form>
                    <label for="data-name">Elo</label>
                    <input type="text" id="data-name" name="data-name" required>
                    <label for="data-value">Precio</label>
                    <input type="text" id="data-value" name="data-value" required>
                    <label for="data-rp">Rp de Cuenta</label>
                    <input type="number" id="data-rp" name="data-rp" required>
                    <button type="submit">Actualizar</button>
                </form>
            </section>

            <!-- Sección Eliminar Cuenta -->
            <section id="delete-cuenta" class="hidden">
                <h1>Eliminar Cuenta</h1>
                <form>
                    <label for="data-name">Elo</label>
                    <input type="text" id="data-name" name="data-name" required>
                    <label for="data-value">Precio</label>
                    <input type="text" id="data-value" name="data-value" required>
                    <label for="data-rp">Rp de Cuenta</label>
                    <input type="number" id="data-rp" name="data-rp" required>
                    <button type="submit">Eliminar</button>
                </form>
            </section>

        </main>
    </div>
</body>
<script src="../js/pagina_admin.js"></script>

</html>