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
        $hora = rand(0, 9999);
        $session_id = session_id();
        $token = hash('sha256', $hora . $session_id);
        $_SESSION['token'] = $token;
    }

    function comprobarlogin($usuario, $password, $token)
    {
        global $pdo;
        $returnuser = [];
        try {
            $qry = "SELECT user, password, rol, path_image FROM usuarios WHERE user = :usuario";
            $stmt = $pdo->prepare($qry);
            $stmt->execute(['usuario' => $usuario]);
            $usuarioData = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($usuarioData) {
                // Verificar la contraseña usando password_verify ¡¡¡VARCHAR255 EN LA BD!!!!
                if (password_verify($password, $usuarioData['password']) && $_SESSION['token'] == $token) {
                    $_SESSION["usuario"] = $usuario;
                    $_SESSION["rol"] = $usuarioData['rol'];
                    $_SESSION["imagenRuta"] = $usuarioData['path_image'];

                    header("Location: pages/paginamain.php");
                } else {
                    $returnuser[0] = $usuario;
                    $returnuser[1] = "Contraseña no válida";
                    return $returnuser;
                }
            } else {
                $returnuser[0] = false;
                $returnuser[1] = "Usuario no válido <a href='./pages/registerform.php'> registrate </a>";
                return $returnuser;
            }
        } catch (PDOException $excepcion) {
            echo "Error en la modificación de tipo " . $excepcion->getMessage();
        }
    }

    function registrarusuario($usuario, $password, $email)
    {
        global $pdo;

        // Inicializar una lista de errores de validación
        $errores = [];

        // Validar longitud mínima
        if (strlen($password) < 8) {
            $errores[] = "Debe tener al menos 8 caracteres.";
        }
        // Validar mayúsculas
        if (!preg_match('/[A-Z]/', $password)) {
            $errores[] = "Debe incluir al menos una letra mayúscula.";
        }
        // Validar minúsculas
        if (!preg_match('/[a-z]/', $password)) {
            $errores[] = "Debe incluir al menos una letra minúscula.";
        }
        // Validar números
        if (!preg_match('/\d/', $password)) {
            $errores[] = "Debe incluir al menos un número.";
        }
        // Validar caracteres especiales
        if (!preg_match('/[@$!%*?&]/', $password)) {
            $errores[] = "Debe incluir al menos un carácter especial (@$!%*?&).";
        }

        // Si hay errores, devolvemos los detalles

        try {
            $qry = "SELECT user FROM usuarios WHERE user LIKE :usuario";
            $stmt = $pdo->prepare($qry);
            $stmt->execute(['usuario' => $usuario]);
            if ($stmt->fetch()) {
                $returnuser[0] = $email;
                $returnuser[1] = "El usuario ya está en uso <a href='../index.php'> inicia sesión </a>";
                $returnuser[2] = $password;
                $returnuser[3] = '';
                $returnuser[4] = $usuario;

                return $returnuser;
            } else {
                if (!empty($errores)) {
                    $returnuser[0] = $email;
                    $returnuser[1] = "La contraseña no cumple con los siguientes requisitos:";
                    $returnuser[2] = $password;
                    $returnuser[3] = $errores;
                    $returnuser[4] = $usuario;

                    return $returnuser;
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                    // Preparar la consulta de inserción
                    $qry2 = "INSERT INTO usuarios (user, password, rol, mail, path_image) 
                     VALUES (:usuario, :password, 'R', :mail, :path_image)";
                    $stmt = $pdo->prepare($qry2);
                    $stmt->execute([
                        'usuario' => $usuario,
                        'password' => $hashedPassword,
                        'mail' => $email,
                        'path_image' => '../assets/images/users/674f64281c8c9.png'
                    ]);

                    // Configurar las variables de sesión
                    $_SESSION["usuario"] = $usuario;
                    $_SESSION["rol"] = 'R';
                    $_SESSION["imagenRuta"] = '../assets/images/users/674f64281c8c9.png';

                    header("Location: paginamain.php");
                }
                // Cifrar la contraseña

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

    function obtenerCuentasFiltro($rango,$champs,$precio)
    {
        connect_bd();
        global $pdo;

        try {
            // Base de la consulta
            $query = "SELECT * FROM cuentas WHERE estado = 'disponible'";
            $params = [];

            // Agregar filtros dinámicamente
            if ($rango!='ALL') {
                $query .= " AND rango = :rango";
                $params[':rango'] = $rango;
            }

            if ($champs) {
                $query .= " AND campeones <= :champs";
                $params[':champs'] = $champs;
            }

            if ($precio) {
                $query .= " AND precio <= :precio";
                $params[':precio'] = $precio;
            }

            // Preparar la consulta
            $statement = $pdo->prepare($query);

            // Ejecutar con parámetros
            $statement->execute($params);

            // Obtener los resultados como un array asociativo
            $accounts = $statement->fetchAll(PDO::FETCH_ASSOC);

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

    function modificarPerfil($usuario, $password, $email, $foto)
    {
        connect_bd();
        global $pdo;
        if ($_SESSION['usuario'] == $usuario) {
            try {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $qry = "UPDATE usuarios SET password = '$hashedPassword', mail = '$email' WHERE user LIKE '$usuario'";
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
                    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                    $qry2 = "INSERT INTO usuarios VALUES('$usuario','$hashedPassword','R','$email','$foto')";
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

    function cambiarFoto($usuario, $foto)
    {
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
            $_SESSION['imagenRuta'] = $relativePath;
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

    function inactividad(){
        $inactivityLimit = 300;  //5 minutos
if (isset($_SESSION['last_activity'])) {
    $timeElapsed = time() - $_SESSION['last_activity']; 
    if ($timeElapsed > $inactivityLimit) {
        session_unset();
        session_destroy();
        header("Location: ../index.php?message=inactivity");
        exit();
    }
}
$_SESSION['last_activity'] = time();
    }

    ?>
</body>

</html>