<?php
try {
     //Alvaro, Joaquín ,Jefferson
    session_start();
    $conexion = new PDO("mysql:host=localhost;dbname=tiffosi;charset=utf8", "root", "");
    
    $nomb = $_POST['usuario'];
    $contr = $_POST['contrasena'];

    $sentenciaSelect = "SELECT nombre, rol,contraseña FROM personas WHERE nombre = '$nomb'";
    $resultado = $conexion->query($sentenciaSelect);



    

    if ($resultado->rowCount() == 0) {
        echo "<script>alert('Usuario no registrado')</script>";
        header("Refresh: 0; url=inicioSesion.php", true, 303); 

    } else {
        $fila = $resultado->fetchObject();
        $realnomb = $fila->nombre;
        $realcontr = $fila->contraseña;
        $rol = $fila->rol;

        if ($nomb == $realnomb && $contr == $realcontr) {
            $_SESSION['sesion'] = true;
            $_SESSION['usuario'] = $nomb;
            echo "<script>alert('Bienvenido $nomb')</script>";

            if($rol == 'cliente'){
                header("Refresh: 0; url=inicioSesion.php", true, 303); 
            }elseif ($rol == 'administrador') {
                header("Refresh: 0; url=administrador.php", true, 303); 
            }elseif ($rol == 'empleado') {
                header("Refresh: 0; url=empleado.php", true, 303); 
            }

        } else {
            echo "<script>alert('Contraseña incorrecta')</script>";
            header("Refresh: 0; url=inicioSesion.php", true, 303);  

        }
    }

    } catch(PDOException $excp) {
    die("Fallo en la conexión" . $excp->getMessage());
}
?>
