<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Cuentas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/formularios.css">
</head>

<body class="bg-gray-100">

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
    <h1 class="text-2xl font-bold text-center text-gray-700 my-6">Administrar Cuentas</h1>
    <div class="flex justify-center">
        <table class="table-auto border-collapse border border-gray-300 bg-white shadow-md w-3/4">
            <thead>
                <tr>
                    <th class="px-4 py-2 border border-gray-300 bg-gray-100 text-gray-700 font-semibold">ID Cuenta</th>
                    <th class="px-4 py-2 border border-gray-300 bg-gray-100 text-gray-700 font-semibold">RP</th>
                    <th class="px-4 py-2 border border-gray-300 bg-gray-100 text-gray-700 font-semibold">Rango</th>
                    <th class="px-4 py-2 border border-gray-300 bg-gray-100 text-gray-700 font-semibold">Precio</th>
                    <th class="px-4 py-2 border border-gray-300 bg-gray-100 text-gray-700 font-semibold">Estado</th>
                    <th class="px-4 py-2 border border-gray-300 bg-gray-100 text-gray-700 font-semibold">BE</th>
                    <th class="px-4 py-2 border border-gray-300 bg-gray-100 text-gray-700 font-semibold">Región</th>
                    <th class="px-4 py-2 border border-gray-300 bg-gray-100 text-gray-700 font-semibold">Nivel</th>
                    <th class="px-4 py-2 border border-gray-300 bg-gray-100 text-gray-700 font-semibold">Campeones</th>
                    <th class="px-4 py-2 border border-gray-300 bg-gray-100 text-gray-700 font-semibold">Skins</th>
                    <th class="px-4 py-2 border border-gray-300 bg-gray-100 text-gray-700 font-semibold">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $resultado = mostrarCuentas();
                // Verificar si hay resultados
                if (!empty($resultado)) {
                    foreach ($resultado as $cuenta) {
                        echo "<tr>";
                        echo "<td class='px-4 py-2 border border-gray-300 text-gray-600'>{$cuenta['id_cuenta']}</td>";
                        echo "<td class='px-4 py-2 border border-gray-300 text-gray-600'>{$cuenta['rp']}</td>";
                        echo "<td class='px-4 py-2 border border-gray-300 text-gray-600'>{$cuenta['rango']}</td>";
                        echo "<td class='px-4 py-2 border border-gray-300 text-gray-600'>{$cuenta['precio']}</td>";
                        echo "<td class='px-4 py-2 border border-gray-300 text-gray-600'>{$cuenta['estado']}</td>";
                        echo "<td class='px-4 py-2 border border-gray-300 text-gray-600'>{$cuenta['be']}</td>";
                        echo "<td class='px-4 py-2 border border-gray-300 text-gray-600'>{$cuenta['region']}</td>";
                        echo "<td class='px-4 py-2 border border-gray-300 text-gray-600'>{$cuenta['nivel']}</td>";
                        echo "<td class='px-4 py-2 border border-gray-300 text-gray-600'>{$cuenta['campeones']}</td>";
                        echo "<td class='px-4 py-2 border border-gray-300 text-gray-600'>{$cuenta['skins']}</td>";
                        echo "<td class='px-4 py-2 border border-gray-300 text-center'>
                                    <!-- Botón para editar -->
                                    <button type='button' class='bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 edit-button' data-id='{$cuenta['id_cuenta']}' data-rp='{$cuenta['rp']}' data-rango='{$cuenta['rango']}' data-precio='{$cuenta['precio']}' data-estado='{$cuenta['estado']}' data-be='{$cuenta['be']}' data-region='{$cuenta['region']}' data-nivel='{$cuenta['nivel']}' data-campeones='{$cuenta['campeones']}' data-skins='{$cuenta['skins']}'>Editar</button>
                                    
                                    <!-- Formulario de eliminación -->
                                    <form method='POST' action='eliminarcuenta.php' class='inline-block ml-2'>
                                        <input type='hidden' name='id_cuenta' value='{$cuenta['id_cuenta']}'>
                                        <button type='submit' class='bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600'>Eliminar</button>
                                    </form>
 <!-- Botón para mostrar el formulario de añadir cuenta -->
                <button type='button' class='bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600' onclick='showAddForm()'>Añadir Cuenta</button>
                                </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='11' class='px-4 py-2 border border-gray-300 text-center text-gray-600'>No hay datos disponibles</td></tr>";
                }

                ?>
            </tbody>
        </table>
    </div>
    <div id="edit-form-container" class="hidden">
        <form method="POST" action="editar_cuenta.php">
            <input type="hidden" name="id_cuenta" id="edit-id_cuenta">

            <div>
                <label for="edit-rp">RP:</label>
                <input type="number" name="rp" id="edit-rp" required>
            </div>
            <div>
                <label for="edit-rango">Rango:</label>
                <input type="text" name="rango" id="edit-rango" required>
            </div>
            <div>
                <label for="edit-precio">Precio:</label>
                <input type="number" name="precio" id="edit-precio" step="0.01" required>
            </div>
            <div>
                <label for="edit-estado">Estado:</label>
                <input type="text" name="estado" id="edit-estado" required>
            </div>
            <div>
                <label for="edit-be">BE:</label>
                <input type="number" name="be" id="edit-be" required>
            </div>
            <div>
                <label for="edit-region">Región:</label>
                <input type="text" name="region" id="edit-region" required>
            </div>
            <div>
                <label for="edit-nivel">Nivel:</label>
                <input type="number" name="nivel" id="edit-nivel" required>
            </div>
            <div>
                <label for="edit-campeones">Campeones:</label>
                <input type="number" name="campeones" id="edit-campeones" required>
            </div>
            <div>
                <label for="edit-skins">Skins:</label>
                <input type="number" name="skins" id="edit-skins" required>
            </div>
            <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Actualizar</button>
            <button type="button" class="bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600" onclick="cancelEdit()">Cancelar</button>
        </form>

    </div>
    <!-- Formulario de añadir cuenta (inicialmente oculto) -->
    <div id="add-form-container" class="hidden">
        <form method="POST" action="formulario_añadir.php">
            <div>
                <label for="rp">RP:</label>
                <input type="number" name="rp" id="rp" required>
            </div>
            <div>
                <label for="rango">Rango:</label>
                <input type="text" name="rango" id="rango" required>
            </div>
            <div>
                <label for="precio">Precio:</label>
                <input type="number" name="precio" id="precio" step="0.01" required>
            </div>
            <div>
                <label for="estado">Estado:</label>
                <input type="text" name="estado" id="estado" required>
            </div>
            <div>
                <label for="be">BE:</label>
                <input type="number" name="be" id="be" required>
            </div>
            <div>
                <label for="region">Región:</label>
                <input type="text" name="region" id="region" required>
            </div>
            <div>
                <label for="nivel">Nivel:</label>
                <input type="number" name="nivel" id="nivel" required>
            </div>
            <div>
                <label for="campeones">Campeones:</label>
                <input type="number" name="campeones" id="campeones" required>
            </div>
            <div>
                <label for="skins">Skins:</label>
                <input type="number" name="skins" id="skins" required>
            </div>
            <div>
                <label for="id_proveedor">Proveedor:</label>
                <input type="text" name="id_proveedor" id="id_proveedor" required>
            </div>

            <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Añadir Cuenta</button>
            <button type="button" class="bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600" onclick="hideAddForm()">Cancelar</button>
        </form>
        <script>
            // Muestra el formulario con los datos de la cuenta al hacer clic en "Editar"
            const editButtons = document.querySelectorAll('.edit-button');
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const data = this.dataset;

                    // Rellenar los campos del formulario con los valores
                    document.getElementById('edit-id_cuenta').value = data.id;
                    document.getElementById('edit-rp').value = data.rp;
                    document.getElementById('edit-rango').value = data.rango;
                    document.getElementById('edit-precio').value = data.precio;
                    document.getElementById('edit-estado').value = data.estado;
                    document.getElementById('edit-be').value = data.be;
                    document.getElementById('edit-region').value = data.region;
                    document.getElementById('edit-nivel').value = data.nivel;
                    document.getElementById('edit-campeones').value = data.campeones;
                    document.getElementById('edit-skins').value = data.skins;

                    // Mostrar el formulario
                    document.getElementById('edit-form-container').classList.remove('hidden');
                });
            });

            // Función para cancelar la edición
            function cancelEdit() {
                document.getElementById('edit-form-container').classList.add('hidden');
            }

            // Función para mostrar el formulario de añadir cuenta
            function showAddForm() {
                document.getElementById('add-form-container').classList.remove('hidden');
            }

            // Función para ocultar el formulario de añadir cuenta
            function hideAddForm() {
                document.getElementById('add-form-container').classList.add('hidden');
            }
        </script>
</body>

</html>