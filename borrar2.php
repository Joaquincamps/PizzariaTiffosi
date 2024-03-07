<?php   //BORRAR CLIENTES
     try { 
            //Alvaro, Joaquín ,Jefferson
            //Conexion a BBDd
            $conexion = new PDO ( "mysql:host=localhost;dbname=tiffosi; 
            charset=utf8","root","");

            //Session usuario
            session_start();
            $nomb = "$_SESSION[usuario]";
            $sentenciaSelect = "SELECT id,nombre, rol,contraseña FROM personas WHERE nombre = '$nomb'";
            $resultado = $conexion->query($sentenciaSelect);
            $fila = $resultado->fetchObject();
            $realnomb = $fila->nombre;
            $realcontr = $fila->contraseña;
            $rol = $fila->rol;
            $id = $fila->id;

            //Delete
            $id = $_POST['borrar'];

            //Definimos Sentencia
            $sentenciaDelete = " DELETE FROM personas WHERE id=?";
            $stmt = $conexion->prepare($sentenciaDelete);
            // Ejecuto el statement
            $stmt->execute(array($id));
            echo "<script>alert('Usuario eliminado')</script>";
            if($rol == 'administrador') {
                header("Refresh: 0; url=administrador.php", true, 303); 
            }elseif ($rol == 'empleado') {
                header("Refresh: 0; url=empleado.php", true, 303); 
            }

        } catch (mysqli_sql_exception $excp) {
            
            
        }
    ?>