<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/perfil_admin.css">
    <script src="https://kit.fontawesome.com/b2238aa62f.js" crossorigin="anonymous"></script>

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
                    <li><a href="#logout" class="">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Contenido principal -->
        <main class="main-content">
            <!-- Sección para Administrar Cuentas -->
            <section id="datos">
                <!--Aqui se imprime lo que ha apartado cada usuario -->



            </section>
            <section id="admin-cuentas" class="hidden">
                <h1>Selecciona una Opción</h1>
                <div class="container-cards">
                    <div class="card-usuario" onclick="mostrarSeccion('add-cuenta')">
                        <h3>Añadir Cuenta</h3>
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <div class="card-usuario" onclick="mostrarSeccion('edit-cuenta')">
                        <h3>Editar Cuenta</h3>
                        <i class="fa-solid fa-newspaper"></i>
                    </div>
                    <div class="card-usuario" onclick="mostrarSeccion('delete-cuenta')">
                        <h3>Eliminar Cuenta</h3>
                        <i class="fa-solid fa-user-minus"></i>
                    </div>
                </div>
            </section>

            <!-- Sección para Administrar Usuarios -->
            <section id="admin-usuario" class="hidden">
                <h1>Selecciona una Opción</h1>
                <div class="container-cards">
                    <div class="card-usuario" onclick="mostrarSeccion('add-user')">
                        <h3>Añadir Usuario</h3>
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <div class="card-usuario" onclick="mostrarSeccion('edit-user')">
                        <h3>Editar Usuario</h3>
                        <i class="fa-solid fa-newspaper"></i>
                    </div>
                    <div class="card-usuario" onclick="mostrarSeccion('delete-user')">
                        <h3>Eliminar Usuario</h3>
                        <i class="fa-solid fa-user-minus"></i>
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
                <form>
                    <label for="data-name">Elo</label>
                    <input type="text" id="data-name" name="data-name" required>
                    <label for="data-value">Precio</label>
                    <input type="text" id="data-value" name="data-value" required>
                    <label for="data-rp">Rp de Cuenta</label>
                    <input type="number" id="data-rp" name="data-rp" required>
                    <button type="submit">Agregar</button>
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