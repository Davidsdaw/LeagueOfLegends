<?php
include 'funciones.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cuenta = $_POST['id_cuenta'];
    $rp = $_POST['rp'];
    $rango = $_POST['rango'];
    $precio = $_POST['precio'];
    $estado = $_POST['estado'];
    $be = $_POST['be'];
    $region = $_POST['region'];
    $nivel = $_POST['nivel'];
    $campeones = $_POST['campeones'];
    $skins = $_POST['skins'];

    connect_bd();
    global $pdo;
    try {
        $query = "UPDATE cuentas SET rp = :rp, rango = :rango, precio = :precio, estado = :estado, 
                  be = :be, region = :region, nivel = :nivel, campeones = :campeones, skins = :skins 
                  WHERE id_cuenta = :id_cuenta";
        
        $statement = $pdo->prepare($query);
        $statement->bindParam(':rp', $rp);
        $statement->bindParam(':rango', $rango);
        $statement->bindParam(':precio', $precio);
        $statement->bindParam(':estado', $estado);
        $statement->bindParam(':be', $be);
        $statement->bindParam(':region', $region);
        $statement->bindParam(':nivel', $nivel);
        $statement->bindParam(':campeones', $campeones);
        $statement->bindParam(':skins', $skins);
        $statement->bindParam(':id_cuenta', $id_cuenta);
        
        $statement->execute();
        
        echo "Cuenta actualizada correctamente!";
        header("Location: añadircuenta.php");
    } catch (PDOException $e) {
        echo "Error al actualizar la cuenta: " . $e->getMessage();
    }
}
?>
