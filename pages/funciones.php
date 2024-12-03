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

    function generarToken()
    {
        $hora = date('H:i');
        $session_id = session_id();
        $token = hash('sha256', $hora . $session_id);
        $_SESSION['token'] = $token;
    }

    //GENERAR TOKEN AL PRINCIPIO DE LA PAGINA METERLO AL FORM Y COMPARAR EL SESSION['TOKEN'] con el POST['token']

    function comprobarlogin($usuario, $password,$token)
    {
        global $pdo;
        $returnuser = [];
        try {

            $qry2 = "SELECT user FROM usuarios WHERE user LIKE '$usuario'";
            $resultado2 = $pdo->query($qry2);
            if ($resultado2->fetch()) {
                $qry = "SELECT user,rol,path_image FROM usuarios WHERE user LIKE '$usuario' AND password LIKE '$password'";
                $resultado = $pdo->query($qry);
                $usuarioData = $resultado->fetch(PDO::FETCH_ASSOC);
                if ($usuarioData && $_SESSION['token']==$token) {
                    $_SESSION["usuario"] = $usuario;
                    $_SESSION["rol"] = $usuarioData['rol'];
                    $_SESSION["imagenRuta"] =$usuarioData['path_image'];

                    header("Location: pages/paginamain.php");
                } else {
                    $returnuser[0] = $usuario;
                    $returnuser[1] = "Contraseña no valida";
                    return $returnuser;
                }
            } else {
                $returnuser[0] = false;
                $returnuser[1] = "Usuario no valido <a href='./pages/registerform.php'> registrate </a>";
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
                $returnuser[1] = "El usuario ya está en uso <a href='../index.php'> inicia sesión </a>";
                $returnuser[2] = $password;

                return $returnuser;
            } else {
                $qry2 = "INSERT INTO usuarios VALUES('$usuario','$password','R','$email')";
                $pdo->exec($qry2);
                $_SESSION["usuario"] = $usuario;
                $_SESSION["rol"] = 'R';
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

    function modificarPerfil($usuario, $password, $email,$foto)
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
                    $qry2 = "INSERT INTO usuarios VALUES('$usuario','$password','R','$email','$foto')";
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

    function cambiarFoto($usuario,$foto){
        connect_bd();
        global $pdo;

            // Así se obtiene la información del archivo subido
            $fileTmpPath = $foto['tmp_name'];
            $fileName = $foto['name'];
            $fileSize = $foto['size'];
            $fileType = $foto['type'];
    
            // Validar tipo de archivo
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!in_array($fileType, $allowedTypes)) {
                echo ("Tipo de archivo no permitido. Solo JPEG y PNG son válidos.");
            }
    
            // Crear un nombre único para el archivo
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
            $newFileName = uniqid() . '.' . $fileExtension;
    
            // Dir almacenamiento de imagnes. Si no existe, lo creamos. 
            $uploadDir = "../assets/images/users/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true); // Crear el directorio si no existe
            }
    
            // Ruta completa del archivo a guardar
            $destPath = $uploadDir . $newFileName;
    
            // Movemos el archivo de la ruta actual al destino
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                // Guardar la ruta relativa en la base de datos
                $relativePath = '../assets/images/users/' . $newFileName;
                $_SESSION['imagenRuta']=$relativePath;
                try {
                    $qry = "UPDATE usuarios SET path_image = '$relativePath' WHERE user LIKE '$usuario'";
                    $statement = $pdo->prepare($qry);
                    $statement->execute();
                } catch (PDOException $excepcion) {
                    echo "Error en la modificación de tipo " . $excepcion->getMessage();
                }
    
                echo "Producto subido con éxito.";
            } else {
                echo "Error al mover el archivo.";
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