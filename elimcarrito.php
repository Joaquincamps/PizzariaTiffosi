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


            //Definimos Sentencia
            $sentenciaDelete = " DELETE FROM carrito WHERE id_user=?";
            $stmt = $conexion->prepare($sentenciaDelete);
            $stmt->execute(array($id));
            header("Refresh: 0; url=index.php", true, 303); 

        } catch (mysqli_sql_exception $excp) {
            
            
        }
    ?>