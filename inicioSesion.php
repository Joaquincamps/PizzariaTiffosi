<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/inicioSesion.css">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <meta name="author" content="Jefferson, Álvaro , Joaquín">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>Inicio de sesión</title>
</head>
<body>
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
            $sentenciaSelect = "SELECT nombre,rol, contraseña FROM personas ";
            $resultado = $conexion -> query($sentenciaSelect);


    ?>

        <div id="container">
        <form action="comprobaruser.php" method="post">
            <table>
                    <h2>Inicio de Sesión</h2>
                <tr>
                    <td><label for="usuario">Usuario:</label></td>
                    <td><input type="text" name="usuario" id="usuario"></td>
                </tr>
                <tr>
                    <td><label for="contrasena">Contraseña:</label></td>
                    <td><input type="password" name="contrasena" id="contrasena"></td>
                </tr>
            </table>
            <br>
            <button type="submit" id="enviar" name="enviar">Iniciar sesión</button>
            
        </form><br>
            <button onclick="window.location.href = 'crearcuenta.php';">Crear cuenta</button>

        </div>

        <?php
            }catch(PDOException $excp){
                die ("Fallo en la conexión" . $excp->getMessage());
            }

        }else{
            $conexion = new PDO ("mysql:host=localhost;dbname=tiffosi;charset=utf8","root","");
            //Session usuario
            $nomb = "$_SESSION[usuario]";
            $sentenciaSelect = "SELECT id,nombre, rol,contraseña FROM personas WHERE nombre = '$nomb'";
            $resultado = $conexion->query($sentenciaSelect);
            $fila = $resultado->fetchObject();
            $realnomb = $fila->nombre;
            $realcontr = $fila->contraseña;
            $rol = $fila->rol;
            $id = $fila->id;

            if($rol=='cliente'){
        ?>
                <header>
                <abbr title="Volver a inicio"><a href="index.php"><img src="img/logo.png" alt="Logo web" id="logo"></a></abbr>
                    <nav>
                        <ul>
                            <a href="index.php"><i class="fa-solid fa-house"></i>Inicio</a>
                            <a href="nosotros.php"><i class="fa-solid fa-address-card"></i>Nosotros</a>
                            <a href="carrito.php"><i class="fa-solid fa-cart-shopping"></i>Carrito</a>
                            <a href="inicioSesion.php" id="active"><i class="fa-solid fa-user"></i><?=$_SESSION['usuario']?></a>
                        </ul>
                    </nav>
                </header>

        <?php
            }elseif($rol=='administrador'){
                ?>
                <header>
                <abbr title="Volver a inicio"><a href="index.php"><img src="img/logo.png" alt="Logo web" id="logo"></a></abbr>
                    <nav>
                        <ul>
                            <a href="administrador.php"><i class="fa-solid fa-house"></i>Administrador</a>
                            <a href="inicioSesion.php" id="active"><i class="fa-solid fa-user"></i><?=$_SESSION['usuario']?></a>
                        </ul>
                    </nav>
                </header>
        <?php
            }elseif($rol=='empleado'){
                ?>
                <header>
                <abbr title="Volver a inicio"><a href="index.php"><img src="img/logo.png" alt="Logo web" id="logo"></a></abbr>
                    <nav>
                        <ul>
                            <a href="empleado.php"><i class="fa-solid fa-house"></i>Empleado</a>
                            <a href="inicioSesion.php" id="active"><i class="fa-solid fa-user"></i><?=$_SESSION['usuario']?></a>
                        </ul>
                    </nav>
                </header>
        <?php
            }

        try {
            $conexion = new PDO ("mysql:host=localhost;dbname=tiffosi;charset=utf8","root","");
            //consultar 
            $sentenciaSelect = "SELECT nombre, contraseña FROM personas ";
            $resultado = $conexion -> query($sentenciaSelect);     
         ?>
         
        <div id="container">
            <form action="comprobaruser.php" method="post" id="form1" name="form1">
            <table>
                    <h2>Cambiar de usuario</h2>
                <tr>
                    <td><label for="usuario">Usuario:</label></td>
                    <td><input type="text" name="usuario" id="usuario" placeholder="<?=$_SESSION['usuario']?>"></td>
                </tr>
                <tr>
                    <td><label for="contrasena">Contraseña:</label></td>
                    <td><input type="password" name="contrasena" id="contrasena"></td>
                </tr>
            </table>
            <br>
            <button type="submit">Cambiar de usuario</button>
            <br>
            <br>
            <button type="submit" onclick= "document.form1.action = 'cerrar.php'; document.form1.submit()">Cerrar sesión</button>

            <?php
            
            }catch(PDOException $excp){
                die ("Fallo en la conexión" . $excp->getMessage());
            }
        }
        
        ?>
            </form>
        </div>   
     
    </body>
    </html>