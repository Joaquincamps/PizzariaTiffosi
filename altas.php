<?php
    try{
        //Alvaro, Joaquín ,Jefferson
        $conexion = new PDO ("mysql:host=localhost;dbname=tiffosi;charset=utf8","root","");


        //Session usuario
        session_start();
        $nomb = "$_SESSION[usuario]";
        $sentenciaSelect = "SELECT id,nombre,rol, contraseña, correo, direccion FROM personas WHERE nombre = '$nomb'";
        $resultado = $conexion->query($sentenciaSelect);
        $fila = $resultado->fetchObject();
        $realnomb = $fila->nombre;
        $realcontr = $fila->contraseña;
        $rol = $fila->rol;
        $realcorreo = $fila->correo;
        $realdireccion = $fila->direccion;

        $nombre=$_POST['nombre'];
        $rol=$_POST['rol'];
        $contraseña=$_POST['contraseña'];
        $correo=$_POST['correo'];
        $direccion=$_POST['direccion'];
        
        if (empty($nombre) or empty($rol) or empty($contraseña) or empty($correo) or empty($direccion)) {
            echo "<script>alert('Se debe rellenar todos los campos');</script>";
            header("Refresh: 0; url=administrador.php", true, 303); 

        }else{
        $sentenciaInsert="INSERT INTO personas (nombre,rol,contraseña,correo, direccion) VALUES (?,?,?,?,?)";
        $stm=$conexion->prepare($sentenciaInsert);
        $stm->execute(array($nombre,$rol,$contraseña,$correo,$direccion));
        echo "<script>alert('Usuario añadido correctamente');</script>";
            header("Refresh: 0; url=administrador.php", true, 303); 
        }
    }
    catch(PDOException $excp){
        die ("Fallo en la conexión" . $excp->getMessage());
    }
?>