<?php
try { 
    //Alvaro, Joaquín ,Jefferson
    $conexion = new PDO("mysql:host=localhost;dbname=tiffosi;charset=utf8", "root", "");

    session_start();
    $nomb = $_SESSION["usuario"];

    $sentenciaSelect = "SELECT id FROM personas WHERE nombre = :nombre";
    $stmt = $conexion->prepare($sentenciaSelect);
    $stmt->bindParam(":nombre", $nomb, PDO::PARAM_STR);
    $stmt->execute();
    $fila = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = $fila['id'];

    $nombre = $_POST['nombre'];

    $consulta = "SELECT cant FROM carrito WHERE id_user = :id AND nombre = :nombre";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->execute();

    $cantidad = $stmt->fetchColumn();

    if ($cantidad > 1) {
        // Si la cantidad es mayor que 0, actualizar la cantidad en el carrito
        $sentenciaUpdate = "UPDATE carrito SET cant = cant - 1 WHERE nombre = :nombre AND id_user = :id";
        $stmt = $conexion->prepare($sentenciaUpdate);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header("Refresh: 0; url=carrito.php", true, 303); 
    } else {
        // Si la cantidad es igual a 0, eliminar el producto del carrito
        $sentenciaDelete = "DELETE FROM carrito WHERE nombre = :nombre AND id_user = :id";
        $stmt = $conexion->prepare($sentenciaDelete);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header("Refresh: 0; url=carrito.php", true, 303); 
    }

} catch (PDOException $excp) {
    die ("Fallo en la conexión" . $excp->getMessage());
}
?>
