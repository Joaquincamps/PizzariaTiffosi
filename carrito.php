<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/anadir.css">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <meta name="author" content="Jefferson, Álvaro , Joaquín">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>Carrito de compras</title>
</head>
<body>

    <header>
    <?php

session_start();



  if (!isset($_SESSION['sesion'])){
    ?>
        <abbr title="Volver a inicio"><a href="index.php"><img src="img/logo.png" alt="Logo web" id="logo"></a></abbr>
    <nav>
    <ul>
        <a href="index.php" ><i class="fa-solid fa-house"></i>Inicio</a>
        <a href="nosotros.php"><i class="fa-solid fa-address-card"></i>Nosotros</a>
        <a href="carrito.php" id="active"><i class="fa-solid fa-cart-shopping"></i>Carrito</a>
        <a href="inicioSesion.php"><i class="fa-solid fa-user"></i>Inicio Sesión</a>
    </ul>
    </nav> 
    </header>

    
    <div class="reenvio">
    <h2>Inicia sesión</h2>
    <form action="inicioSesion.php">
        <button type="submit" class="botones">Inicio</button>
    </form>
    </div>


<?php

  }else{
    //Session usuario
    $conexion = new PDO ("mysql:host=localhost;dbname=tiffosi;charset=utf8","root","");

    $nomb = "$_SESSION[usuario]";
    $sentenciaSelect = "SELECT id,nombre, rol,contraseña FROM personas WHERE nombre = '$nomb'";
    $resultado = $conexion->query($sentenciaSelect);
    $fila = $resultado->fetchObject();
    $realnomb = $fila->nombre;
    $realcontr = $fila->contraseña;
    $rol = $fila->rol;
    $id = $fila->id;
      
  
  ?>
    <abbr title="Volver a inicio"><a href="index.php"><img src="img/logo.png" alt="Logo web" id="logo"></a></abbr>
        <nav>
            <ul>
                <a href="index.php" ><i class="fa-solid fa-house"></i>Inicio</a>
                <a href="nosotros.php"><i class="fa-solid fa-address-card"></i>Nosotros</a>
                <a href="carrito.php" id="active"><i class="fa-solid fa-cart-shopping"></i>Carrito</a>
                <a href="inicioSesion.php"><i class="fa-solid fa-user"></i><?=$_SESSION['usuario']?></a>
            </ul>
        </nav>
        <div id="contenedor1">
    <div id="contenedor2">
    <div id="contenedor3">

<?php
            //Comprobar si la tabla está vacía
            $comprobar = "SELECT COUNT(*) AS total FROM carrito where id_user=$id";
            $result = $conexion->query($comprobar);
            $row = $result->fetch(PDO::FETCH_ASSOC);


            if ($row["total"] == 0) {
                //Si carrito está vacio
                ?>
                    <table class="carritoVacio">
                        <tr>
                            <th>El Carrito está Vacío <i class="fa-solid fa-cart-shopping"></th>
                        </tr>
                    </table>
                <?php

            } else {
                //Si la tabla esta llena
                ?>
    
                <table class="tabla">
                        <tr>
                            <th>Foto</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                        </tr>
                <?php
                        try {
            
                            $sentenciaSelect = "SELECT nombre, precio, foto, cant FROM carrito where id_user=$id";
                            $resultado = $conexion -> query($sentenciaSelect);
                            while ($fila = $resultado->fetchObject()){
                                echo "<tr>  <td><img src=img/".$fila->foto." class='pizzas'> </td> <td>".$fila->nombre."</td><td>". $fila->precio."€</td><td>". $fila->cant."</td>
                                <td>
                                <form action='restar.php' method='post'>
                                <input type='hidden' name='nombre'  id='nombre' value=".$fila->nombre.">
                                <input type='submit' value='Eliminar' class='botones'>
                                </form>
                                </td>
                                </tr>";
                            }
                            $sentenciaSuma = "SELECT SUM(precio*cant) AS total FROM carrito where id_user=$id";
                            $stmt = $conexion->query($sentenciaSuma);
                            $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

                            echo "<tr><td colspan=5 class='total'>El coste será ".$total."€</td></tr>";
            
                    ?>
                    <tr>
                        <td colspan=3>
                        <form action="index.php" method="post">   
                        <button type="submit" id="volver">Seguir Comprando</button>
                        </form>
                        <td colspan=2>
                        <form action="pagar.php" method="post">
                            <button type="submit" id="pagar">Pagar</button>
                        </form>
                        </td>     
                    </tr>
                  </table>      
                 
                <?php
            }catch(PDOException $excp){
                die ("Fallo en la conexión" . $excp->getMessage());
            }

        }  
}
    ?>
  </div>

  </div>
  </div>
    
</body>
</html>