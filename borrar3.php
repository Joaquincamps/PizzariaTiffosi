<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Jefferson, Álvaro , Joaquín">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/administrador.css">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>Borrar</title>
</head>
<body>
    <div class="quieresborrar">
    <h3 >¿Seguro que quieres borrar?</h3>
    <?php
     try {
                
            session_start();
            //Conexion a BBD
            $conexion = new PDO ( "mysql:host=localhost;dbname=tiffosi; 
            charset=utf8","root","");
           //Session usuario
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
    ?>

        <form action="borrar4.php" method="post">
            <input type="hidden" name='borrar'  id='borrar' value='<?=$id?>'>
            <input type='submit' value='Borrar' class="borrar">
        </form>
        <br>

<?php
        if($rol == 'administrador') {
            echo "<form action='administrador.php' method='post'>
                <input type='submit' value='Cancelar'  class='botones'>
                </form>";
        }elseif ($rol == 'empleado') {
            echo "<form action='empleado.php' method='post'>
                <input type='submit' value='Cancelar'  class='botones'>
                </form>";
        }

?>

    </div>
    <?php

        } catch (mysqli_sql_exception $excp) {
           
            
        }
    ?>


</body>
</html>

    </body>