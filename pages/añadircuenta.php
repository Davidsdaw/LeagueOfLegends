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
    <div class="flex flex-row gap-8 items-center justify-center  text-center">
        <h1 class="text-2xl font-bold text-gray-700 my-6">Administrar Cuentas</h1>
        <button class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-700">
            <a href="./perfil_admin.php">Volver</a>
        </button>
    </div>


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
                
                                </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='11' class='px-4 py-2 border border-gray-300 text-center text-gray-600'>No hay datos disponibles</td></tr>";
                }

                ?>
            </tbody>
        </table>
        <?php echo "<button type='button' class='bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600' onclick='showAddForm()'>Añadir Cuenta</button>" ?>
    </div>
    <div id="edit-form-container" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center overflow-auto">
    
    <form method="POST" action="editar_cuenta.php" 
          class="bg-white rounded-lg p-6 shadow-lg w-full max-w-md mx-auto my-8 space-y-4 overflow-auto max-h-[90vh]">
        <h2 class="text-2xl font-semibold text-gray-700 text-center">Editar Cuenta</h2>

        <input type="hidden" name="id_cuenta" id="edit-id_cuenta">

        <div class="space-y-2">
            <label for="edit-rp" class="block text-gray-600 font-medium">RP:</label>
            <input type="number" name="rp" id="edit-rp" required
                class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none">
        </div>
        <div class="space-y-2">
            <label for="edit-rango" class="block text-gray-600 font-medium">Rango:</label>
            <input type="text" name="rango" id="edit-rango" required
                class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none">
        </div>
        <div class="space-y-2">
            <label for="edit-precio" class="block text-gray-600 font-medium">Precio:</label>
            <input type="number" name="precio" id="edit-precio" step="0.01" required
                class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none">
        </div>
        <div class="space-y-2">
            <label for="estado" class="block text-gray-600 font-medium">Estado:</label>
    <select name="estado" id="edit-estado" required
            class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none">
        <option value="Disponible">Disponible</option>
        <option value="Vendido">Vendida</option>
    </select>
        </div>
        <div class="space-y-2">
            <label for="edit-be" class="block text-gray-600 font-medium">BE:</label>
            <input type="number" name="be" id="edit-be" required
                class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none">
        </div>
        <div class="space-y-2">
            <label for="edit-region" class="block text-gray-600 font-medium">Región:</label>
            <input type="text" name="region" id="edit-region" required
                class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none">
        </div>
        <div class="space-y-2">
            <label for="edit-nivel" class="block text-gray-600 font-medium">Nivel:</label>
            <input type="number" name="nivel" id="edit-nivel" required
                class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none">
        </div>
        <div class="space-y-2">
            <label for="edit-campeones" class="block text-gray-600 font-medium">Campeones:</label>
            <input type="number" name="campeones" id="edit-campeones" required
                class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none">
        </div>
        <div class="space-y-2">
            <label for="edit-skins" class="block text-gray-600 font-medium">Skins:</label>
            <input type="number" name="skins" id="edit-skins" required
                class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none">
        </div>

        <div class="flex justify-between space-x-2">
            <button type="submit"
                class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 rounded-lg">Actualizar</button>
            <button type="button" onclick="cancelEdit()"
                class="w-full bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 rounded-lg">Cancelar</button>
        </div>
    </form>
</div>
    <!-- Formulario de añadir cuenta (inicialmente oculto) -->
    <div id="add-form-container" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center overflow-auto">
    <form method="POST" action="formulario_añadir.php" 
          class="bg-white rounded-lg p-6 shadow-lg w-full max-w-md mx-auto my-8 space-y-4 overflow-auto max-h-[90vh]">
        <h2 class="text-2xl font-semibold text-gray-700 text-center">Añadir Cuenta</h2>

        <div class="space-y-2">
            <label for="rp" class="block text-gray-600 font-medium">RP:</label>
            <input type="number" name="rp" id="rp" required
                class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none">
        </div>
        <div class="space-y-2">
            <label for="rango" class="block text-gray-600 font-medium">Rango:</label>
            <input type="text" name="rango" id="rango" required
                class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none">
        </div>
        <div class="space-y-2">
            <label for="precio" class="block text-gray-600 font-medium">Precio:</label>
            <input type="number" name="precio" id="precio" step="0.01" required
                class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none">
        </div>
        <div class="space-y-2">
        <label for="estado" class="block text-gray-600 font-medium">Estado:</label>
    <select name="estado" id="estado" required
            class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none">
        <option value="Disponible">Disponible</option>
        <option value="Vendido">Vendida</option>
    </select>
        </div>
        <div class="space-y-2">
            <label for="be" class="block text-gray-600 font-medium">BE:</label>
            <input type="number" name="be" id="be" required
                class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none">
        </div>
        <div class="space-y-2">
            <label for="region" class="block text-gray-600 font-medium">Región:</label>
            <input type="text" name="region" id="region" required
                class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none">
        </div>
        <div class="space-y-2">
            <label for="nivel" class="block text-gray-600 font-medium">Nivel:</label>
            <input type="number" name="nivel" id="nivel" required
                class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none">
        </div>
        <div class="space-y-2">
            <label for="campeones" class="block text-gray-600 font-medium">Campeones:</label>
            <input type="number" name="campeones" id="campeones" required
                class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none">
        </div>
        <div class="space-y-2">
            <label for="skins" class="block text-gray-600 font-medium">Skins:</label>
            <input type="number" name="skins" id="skins" required
                class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none">
        </div>

        <div class="flex justify-between space-x-2">
            <button type="submit"
                class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 rounded-lg">Añadir
                Cuenta</button>
            <button type="button" onclick="hideAddForm()"
                class="w-full bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 rounded-lg">Cancelar</button>
        </div>
    </form>
</div>

<script>
    // Función para mostrar el formulario de añadir cuenta
    function showAddForm() {
        document.getElementById('add-form-container').classList.remove('hidden');
    }

    // Función para ocultar el formulario de añadir cuenta
    function hideAddForm() {
        document.getElementById('add-form-container').classList.add('hidden');
    }
</script>


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