<?php
    try{
        //Alvaro, Joaquín ,Jefferson    
        session_start();
        $conexion = new PDO("mysql:host=localhost;dbname=tiffosi;charset=utf8", "root", "");
    
        $nomb = $_POST['usuario'];
        $contr = $_POST['contrasena'];
        $correo = $_POST['correo'];
        $direccion = $_POST['direccion'];
        $cliente = 'cliente';

        $sentenciaSelect = "SELECT nombre, contraseña, correo, direccion FROM personas WHERE nombre = '$nomb'";
        $resultado = $conexion->query($sentenciaSelect);

        $sentenciaInsert="INSERT INTO personas (nombre, rol, contraseña, correo, direccion) VALUES (?,?,?,?,?)";
        $stm=$conexion->prepare($sentenciaInsert);

        if (!empty($nomb) && !empty($contr)) {
            if ($resultado->rowCount() == 0) {
                $stm->execute(array($nomb,$cliente,$contr,$correo,$direccion));
                echo "<script>alert('Usuario agregado correctamente');</script>";
                $_SESSION['sesion'] = true;
                $_SESSION['usuario'] = $nomb;
                header("Refresh: 0; url=inicioSesion.php", true, 303);
            } else {
                $fila = $resultado->fetchObject();
                $realnomb = $fila->nombre;
                $realcontr = $fila->contraseña;
        
                if ($nomb == $realnomb) {
                    echo "<script>alert('Usuario ya existente');</script>";
                    header("Refresh: 0; url=crearcuenta.php", true, 303); 
                }
            }
        } else {
            echo "<script>alert('Nombre y contraseña obligatorio');</script>";
            header("Refresh: 0; url=crearcuenta.php", true, 303);
        }
        
    }
    catch(PDOException $excp){
        die ("Fallo en la conexión" . $excp->getMessage());
    }
?>