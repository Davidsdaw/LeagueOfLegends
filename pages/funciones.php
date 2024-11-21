<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    function connect_bd()
    {
        global $pdo;
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=LeagueOfLegends', 'admin', 'admin');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec('SET NAMES "utf8"');
            echo '<h4>Conexión establecida</h4>';
        } catch (PDOException $e) {
            // echo 'Error en la conexión: ' . $e->getMessage();
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
            $qry = "SELECT user FROM usuarios WHERE user LIKE '$usuario' AND password LIKE $password";
            $resultado = $pdo->query($qry);
            while ($resultado->fetch()) {
                return true;
            }
        } catch (PDOException $excepcion) {
            echo "Usuario o contraseña incorrecto";
        }
    }

    function registrarusuario($usuario, $password, $email)
    {
        global $pdo;
        try {
            $qry = "INSERT INTO usuarios VALUES('$usuario','$password','R','$email') COMMIT";
            $pdo->exec($qry);
            header("Location: paginamain.php");
            exit();
        } catch (PDOException $excepcion) {
            echo "Error en la modificación de tipo " . $excepcion->getMessage();
        }
    }
    ?>
</body>

</html>