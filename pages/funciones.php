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

    function comprobarlogin($usuario, $password)
    {
        global $pdo;
        $returnuser = [];
        try {

            $qry2 = "SELECT user FROM usuarios WHERE user LIKE '$usuario'";
            $resultado2 = $pdo->query($qry2);
            if ($resultado2->fetch()) {
                $qry = "SELECT user,rol FROM usuarios WHERE user LIKE '$usuario' AND password LIKE '$password'";
                $resultado = $pdo->query($qry);
                $usuarioData = $resultado->fetch(PDO::FETCH_ASSOC);
                if ($usuarioData) {
                    $hora = date('H:i');
                    $session_id = session_id();
                    $token = hash('sha256', $hora . $session_id);
                    $_SESSION['token'] = $token;
                    $_SESSION["usuario"] = $usuario;
                    $_SESSION["rol"] = $usuarioData['rol'];
                    header("Location: pages/paginamain.php");
                } else {
                    $returnuser[0] = $usuario;
                    $returnuser[1] = "Contraseña no valida";
                    return $returnuser;
                }
            } else {
                $returnuser[0] = false;
                $returnuser[1] = "Usuario no valido";
                return $returnuser;
            }
        } catch (PDOException $excepcion) {
            echo "Error en la modificación de tipo " . $excepcion->getMessage();
        }
    }

    function registrarusuario($usuario, $password, $email)
    {
        global $pdo;
        try {
            $qry = "SELECT user FROM usuarios WHERE user LIKE '$usuario'";
            $resultado = $pdo->query($qry);
            if ($resultado->fetch()) {
                $returnuser[0] = $email;
                $returnuser[1] = "El usuario ya está en uso";
                $returnuser[2] = $password;

                return $returnuser;
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

    function cargarDatosPerfil($usuario)
    {
        connect_bd();
        global $pdo;

        try {
            $query = "SELECT * FROM usuarios WHERE user LIKE '$usuario'";
            $statement = $pdo->prepare($query); // Usamos prepare para mayor seguridad
            $statement->execute(); // Ejecutamos la consulta

            $accounts = $statement->fetchAll(PDO::FETCH_ASSOC); // Obtenemos todos los resultados como un array asociativo
            if ($accounts) {
                $informacionPerfil[0] = $accounts[0]['user'];
                $informacionPerfil[1] = $accounts[0]['password'];
                $informacionPerfil[2] = $accounts[0]['mail'];
                return $informacionPerfil;
            }
        } catch (PDOException $excepcion) {
            echo "Error en la base de datos: " . $excepcion->getMessage();
            return []; // En caso de error, devuelve un array vacío
        }
    }

    function modificarPerfil($usuario, $password, $email)
    {
        connect_bd();
        global $pdo;
        if ($_SESSION['usuario'] == $usuario) {
            try {
                $qry = "UPDATE usuarios SET password = '$password', mail = '$email' WHERE user LIKE '$usuario'";
                $statement = $pdo->prepare($qry);
                $statement->execute();
                // header("Location: paginamain.php");
                logOut();
            } catch (PDOException $excepcion) {
                echo "Error en la modificación de tipo " . $excepcion->getMessage();
            }
        } else {
            try {
                $qry3 = "SELECT user FROM usuarios WHERE user LIKE '$usuario'";
                $statement3 = $pdo->prepare($qry3);
                $statement3->execute();
                $nombres = $statement3->fetchAll(PDO::FETCH_ASSOC);
                if ($nombres) {
                    return "Usuario no disponible";
                } else {
                    $qry2 = "INSERT INTO usuarios VALUES('$usuario','$password','R','$email')";
                    $statement2 = $pdo->prepare($qry2);
                    $statement2->execute();
                    $userOld = $_SESSION['usuario'];
                    $qry3 = "DELETE FROM usuarios WHERE user = '$userOld'";
                    $statement3 = $pdo->prepare($qry3);
                    $statement3->execute();
                    logOut();
                }
            } catch (PDOException $excepcion) {
                echo "Error en la modificación de tipo " . $excepcion->getMessage();
            }
        }
    }

    function logOut()
    {
        $_SESSION = [];
        session_destroy();
        header("Location: ../index.php");
    }


    ?>
</body>

</html>