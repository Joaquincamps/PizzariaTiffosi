<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Authors" content="Joaquín ,Alvaro y Jeffer">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/detalles.css">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>Pizzeria TIFFOSI</title>
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
        <a href="index.php"><i class="fa-solid fa-house"></i>Inicio</a>
        <a href="nosotros.php"><i class="fa-solid fa-address-card"></i>Nosotros</a>
        <a href="carrito.php"><i class="fa-solid fa-cart-shopping"></i>Carrito</a>
        <a href="inicioSesion.php"><i class="fa-solid fa-user"></i>Inicio Sesión</a>
    </ul>
</nav> 
<?php

  }else{
      
  
  ?>
    <abbr title="Volver a inicio"><a href="index.php"><img src="img/logo.png" alt="Logo web" id="logo"></a></abbr>
        <nav>
            <ul>
                <a href="index.php"><i class="fa-solid fa-house"></i>Inicio</a>
                <a href="nosotros.php"><i class="fa-solid fa-address-card"></i>Nosotros</a>
                <a href="carrito.php"><i class="fa-solid fa-cart-shopping"></i>Carrito</a>
                <a href="inicioSesion.php"><i class="fa-solid fa-user"></i><?=$_SESSION['usuario']?></a>
            </ul>
        </nav>
   <?php
  }
  ?>
    </header>

    <div id="contenedor1">
    <div id="contenedor2">
    <div id="contenedor3">
    <?php
try {
    // Conexión a la base de datos
    $conexion = new PDO("mysql:host=localhost;dbname=tiffosi;charset=utf8", "root", "");

    // Obtener el nombre de la pizza seleccionada
    $pizza_nombre = $_POST['pizza_nombre'];

    // Consulta para obtener los detalles de la pizza seleccionada
    $sentencia = $conexion->prepare("SELECT nombre, precio, stock, stockminimo, descripcion ,foto FROM pizzas WHERE nombre = :nombre");
    $sentencia->bindParam(':nombre', $pizza_nombre);
    $sentencia->execute();

    // Mostrar los detalles de la pizza
    if ($fila = $sentencia->fetchObject()) {
        echo "<h1>Pizza " . $fila->nombre . "</h1>";
        echo "<p>Descripcion: " .$fila->descripcion . "</p>";
        echo "<img src='img/" . $fila->foto . "' alt='Foto de la pizza' class='pizzaDetalles'>";
        echo "<p>Precio: " . $fila->precio . " € </p>";
        if (!isset($_SESSION['sesion'])){
                echo "";
            }else{
                ?>
        
        <form action="anadir.php" method="post">
 
                    <input type="hidden" name="nombre" id="nombre" value=<?=$fila->nombre?>>
                    <input type="hidden" name="precio" id="precio" value=<?=$fila->precio?>>
                    <input type="hidden" name="foto" id="foto" value=<?=$fila->foto?>>
                    <input type="number" id="cantidad" name="cantidad" min="1" max="5" />
                    <button type="submit" class="botones">Añadir</button>
            
        <?php
        }
    } else {
        echo "<p>No se encontraron detalles para la pizza seleccionada.</p>";
    }
} catch (PDOException $excp) {
    die("Fallo en la conexión" . $excp->getMessage());
}
?>

    </div>
    </div>
    </div>

</body>