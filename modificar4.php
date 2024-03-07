<?php
   try{
     //Alvaro, Joaquín ,Jefferson
    session_start();
    $conexion = new PDO ("mysql:host=localhost;dbname=tiffosi;charset=utf8","root","");
    //Session usuario
    $nomb = "$_SESSION[usuario]";
    $sentenciaSelect = "SELECT id,nombre, rol,contraseña FROM personas WHERE nombre = '$nomb'";
    $resultado = $conexion->query($sentenciaSelect);
    $fila = $resultado->fetchObject();
    $realnomb = $fila->nombre;
    $realcontr = $fila->contraseña;
    $rol = $fila->rol;
    $realid = $fila->id;


    $id=$_POST['id'];
    $nombre=$_POST['nombre'];
    $precio=$_POST['precio'];
    $stock=$_POST['stock'];
    $stockminimo=$_POST['stockminimo'];
    $foto=$_POST['foto'];
    $descripcion=$_POST['descripcion'];



    $sentenciaUpdate="UPDATE pizzas SET id=?,nombre=?,precio=?,stock=?,stockminimo=?,descripcion=?,foto=? WHERE id=?";
    $stm=$conexion->prepare($sentenciaUpdate);
    $stm->execute(array($id,$nombre,$precio,$stock,$stockminimo,$descripcion,$foto,$id));
    echo "<script>alert('Campos actualizados correctamente ');</script>";
    if($rol == 'administrador') {
        header("Refresh: 0; url=administrador.php", true, 303); 
    }elseif ($rol == 'empleado') {
        header("Refresh: 0; url=empleado.php", true, 303); 
    } 
}
catch(PDOException $excp){
    die ("Fallo en la conexión" . $excp->getMessage());
}
?>