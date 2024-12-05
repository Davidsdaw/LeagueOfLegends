<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/perfil_admin.css">
</head>

<body>
<?php
    include "funciones.php";
    if (isset($_SESSION['usuario'])&&$_SESSION['rol']=='A') {
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
                    <li><a href="#dashboard" class="active">Dashboard</a></li>
                    <li><a href="#add-data" class="">Agregar Cuentas</a></li>
                    <li><a href="#edit-data" class="">Administrar Cuentas </a></li>
                    <li><a href="#delete-data" class="">Eliminar Usuarios</a></li>
                    <li><a href="#logout" class="">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Contenido principal -->
        <main class="main-content">
            <section id="dashboard">
                <h1>Panel de Control</h1>
                <p>Aquí puedes gestionar las bases de datos de la aplicación.</p>
            </section>

            <section id="add-data" class="hidden">
                <h1>Agregar Cuentas</h1>
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

            <section id="edit-data" class="hidden">
                <h1>Administrar Datos de Usuario</h1>
                <form>
                    <label for="data-id">Nombre del Usuario</label>
                    <input type="text" id="data-id" name="data-id" required>
                    <label for="new-value">Nuevo Nombre del Usuario </label>
                    <input type="text" id="new-value" name="new-value" required>
                    <label for="data-id">Contraseña del Usuario</label>
                    <input type="text" id="data-id" name="data-id" required>
                    <label for="new-value">Nueva Contraseña del Usuario </label>
                    <input type="text" id="new-value" name="new-value" required>
                    <button type="submit">Actualizar</button>
                </form>
            </section>

            <section id="delete-data" class="hidden">
                <h1>Eliminar informacion del Usuario</h1>
                <form>
                    <label for="delete-id">Correo del Usuario:</label>
                    <input type="mail" id="delete-id" name="delete-mail" required>
                    <button type="submit">Eliminar</button>
                </form>
            </section>
        </main>
    </div>
</body>
<script src="../js/pagina_admin.js"></script>

</html>