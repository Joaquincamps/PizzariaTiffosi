<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/crearcuenta.css">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <meta name="author" content="Jefferson, Álvaro , Joaquín">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>Crear cuenta</title>
</head>
<body>
        <script>
            function validar() {
                var contrasena = document.getElementById('contrasena').value;
                var contrasena2 = document.getElementById('contrasena2').value;

                if (contrasena != contrasena2) {
                    alert("Contraseñas Diferentes");
                }else{
                    true;
                }
            }
        </script>
    <?php
   
        
        session_start();
        if (!isset($_SESSION['sesion'])){
    
    ?>
    <header>
        <abbr title="Volver a inicio"><a href="index.php"><img src="img/logo.png" alt="Logo web" id="logo"></a></abbr>
        <nav>

        <ul>
            <a href="index.php"><i class="fa-solid fa-house"></i>Inicio</a>
            <a href="nosotros.php"><i class="fa-solid fa-address-card"></i>Nosotros</a>
            <a href="carrito.php"><i class="fa-solid fa-cart-shopping"></i>Carrito</a>
            <a href="inicioSesion.php" id="active"><i class="fa-solid fa-user"></i>Inicio Sesión</a>
        </ul>
        </nav> 
    </header>
         
    <?php
        try {
            $conexion = new PDO ("mysql:host=localhost;dbname=tiffosi;charset=utf8","root","");
            //consultar 
            $sentenciaSelect = "SELECT nombre, contraseña FROM personas ";
            $resultado = $conexion -> query($sentenciaSelect);

            
    ?>

        <div id="container">
        <form action="crearcuenta2.php" method="post">
            <table>
                    <h2>Creación de Cuenta</h2>
                <tr>
                    <td><label for="usuario">Usuario:</label></td>
                    <td><input type="text" name="usuario" id="usuario"></td>
                </tr>
                
                <tr>
                    <td><label for="contrasena">Contraseña:</label></td>
                    <td><input type="password" name="contrasena" id="contrasena"></td>
                </tr>

                <tr>
                    <td><label for="contrasena2">Repetir contraseña:</label></td>
                    <td><input type="password" name="contrasena2" id="contrasena2"></td>
                </tr>

                <tr>
                    <td><label for="correo">Correo:</label></td>
                    <td><input type="email" name="correo" id="correo"></td>
                </tr>

                <tr>
                    <td><label for="direccion">Dirección:</label></td>
                    <td><input type="text" name="direccion" id="direccion"></td>
                </tr>
            </table>
            <br>
            <button type="submit" id="enviar" onclick="validar()" name="enviar">Crear cuenta</button>
        </form><br>
            <a href="inicioSesion.php" ><button id="volver">Volver</button></a>

        </div>
        

        <?php

            }catch(PDOException $excp){
                die ("Fallo en la conexión" . $excp->getMessage());
            }

        }
        ?>
</body>
</html>       