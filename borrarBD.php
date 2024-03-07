<?php
try {//Alvaro, Joaquín ,Jefferson
    session_start();
    //Conexion a BBD
    $conexion = new PDO ( "mysql:host=localhost;dbname=tiffosi;charset=utf8","root","");
    //Session usuario
    $nomb = "$_SESSION[usuario]";
    $sentenciaSelect = "SELECT id,nombre, rol,contraseña FROM personas WHERE nombre = '$nomb'";
    $resultado = $conexion->query($sentenciaSelect);
    $fila = $resultado->fetchObject();
    $realnomb = $fila->nombre;
    $realcontr = $fila->contraseña;
    $rol = $fila->rol;
    $id = $fila->id;
        
    $sentenciaDelete="DELETE FROM carrito WHERE id_user='$id'";
    $resultado = $conexion->query($sentenciaDelete);
    $fila = $resultado->fetchObject();
    header("Location: index.php");

} catch (mysqli_sql_exception $excp) {
   
    echo "Error: " . $excp->getMessage();

}
?>
