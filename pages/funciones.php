<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    session_start();

    function connect_bd()
    {
        global $pdo;
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=LeagueOfLegends', 'admin', 'admin');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec('SET NAMES "utf8"');
            // echo '<h4>Conexión establecida</h4>';
        } catch (PDOException $e) {
            echo 'Error en la conexión: ' . $e->getMessage();
        }
    }
    function insertar_agenda()
    {
        global $pdo;
        try {
            $filasInsertadas = $pdo->exec("INSERT INTO tabla
            VALUES( valores )");
            echo "Se han añadido $filasInsertadas filas<br />";
        } catch (PDOException $excepcion) {
            echo "Error en la inserción de tipo " . $excepcion->getMessage();
        }
        try {
            $sql = "SELECT * FROM tabla";
            $lista = $pdo->query($sql);
            echo "<h4>Lista de contactos</h4>";
            while ($contacto = $lista->fetch()) {
                echo "Nombre: " . $contacto['nombreContacto'] . " " .
                    $contacto['apellidosContacto'];
                echo " Email: " . $contacto['emailContacto'];
                echo " Teléfono: " . $contacto['tfnoContacto'] . "<br>";
            }
        } catch (PDOException $excepcion) {
            echo "Error en la consulta de tipo " . $excepcion->getMessage();
        }
    }

    function modificar_tabla()
    {
        global $pdo;
        try {
            $sql = "UPDATE tabla SET campo='valor' WHERE
            capo='valor'";
            $filasModificadas = $pdo->exec($sql);
            echo "Se han modificado $filasModificadas filas<br/>";
        } catch (PDOException $excepcion) {
            echo "Error en la modificación de tipo " . $excepcion->getMessage();
        }
    }


    function comprobarlogin($usuario, $password)
    {
        global $pdo;
        try {
            $qry = "SELECT user FROM usuarios WHERE user LIKE '$usuario' AND password LIKE '$password'";
            $resultado = $pdo->query($qry);
            if ($resultado->fetch()) {
                return true;
            } else {
                return "Usuario o contraseña no valido";
            }
        } catch (PDOException $excepcion) {
            echo "Error en la modificación de tipo " . $excepcion->getMessage();
            // return "Usuario o contraseña no valido";
        }
    }

    function registrarusuario($usuario, $password, $email)
    {
        global $pdo;
        try {
            $qry = "SELECT user FROM usuarios WHERE user LIKE '$usuario'";
            $resultado = $pdo->query($qry);
            if ($resultado->fetch()) {
                return "El usuario ya está en uso";
            } else {
                $qry2 = "INSERT INTO usuarios VALUES('$usuario','$password','R','$email')";
                $pdo->exec($qry2);
                header("Location: paginamain.php");
            }
        } catch (PDOException $excepcion) {
            echo "Error en la modificación de tipo " . $excepcion->getMessage();
        }
    }


    function obtenerCuentasDisponibles()
    {
        connect_bd();
        global $pdo;

        try {
            $query = "SELECT * FROM cuentas WHERE estado = 'disponible'";
            $statement = $pdo->prepare($query); // Usamos prepare para mayor seguridad
            $statement->execute(); // Ejecutamos la consulta

            $accounts = $statement->fetchAll(PDO::FETCH_ASSOC); // Obtenemos todos los resultados como un array asociativo
            return $accounts;
        } catch (PDOException $excepcion) {
            echo "Error en la base de datos: " . $excepcion->getMessage();
            return []; // En caso de error, devuelve un array vacío
        }
    }

    ?>



</body>

</html>