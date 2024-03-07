<?php
   try{
    //Alvaro, Joaquín ,Jefferson
    $conexion = new PDO ("mysql:host=localhost;dbname=tiffosi;charset=utf8","root","");
    $id=$_POST['id'];
    $rol=$_POST['rol'];

    $sentenciaUpdate="UPDATE personas SET rol=? WHERE id=?";
    $stm=$conexion->prepare($sentenciaUpdate);
    $stm->execute(array($rol,$id));
    echo "<script>alert('Campos actualizados correctamente ');</script>";
    header("Refresh: 0; url=administrador.php", true, 303); 
}
catch(PDOException $excp){
    die ("Fallo en la conexión" . $excp->getMessage());
}
?>