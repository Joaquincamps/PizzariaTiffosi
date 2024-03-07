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
    <title></title>
</head>
<body>

    <header>
    <?php


//Session usuario
session_start();
$conexion = new PDO ("mysql:host=localhost;dbname=tiffosi;charset=utf8","root","");

$nomb = "$_SESSION[usuario]";
$sentenciaSelect = "SELECT id,nombre, rol,contraseña FROM personas WHERE nombre = '$nomb'";
$resultado = $conexion->query($sentenciaSelect);
$fila = $resultado->fetchObject();
$realnomb = $fila->nombre;
$realcontr = $fila->contraseña;
$rol = $fila->rol;
$id = $fila->id;


  if (!isset($_SESSION['sesion'])){
    ?>
        <abbr title="Volver a inicio"><a href="index.php"><img src="img/logo.png" alt="Logo web" id="logo"></a></abbr>
    <nav>
    <ul>
        <a href="index.php" id="active"><i class="fa-solid fa-house"></i>Inicio</a>
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
                <a href="index.php" id="active"><i class="fa-solid fa-house"></i>Inicio</a>
                <a href="nosotros.php"><i class="fa-solid fa-address-card"></i>Nosotros</a>
                <a href="carrito.php"><i class="fa-solid fa-cart-shopping"></i>Carrito</a>
                <a href="inicioSesion.php"><i class="fa-solid fa-user"></i><?=$_SESSION['usuario']?></a>
            </ul>
        </nav>
        <div id="contenedor1">
    <div id="contenedor2">
    <div id="contenedor3">
   <?php
        try {
            $nombre=$_POST['nombre'];
            $precio=$_POST['precio'];
            $foto=$_POST['foto'];
            $cantidad=$_POST['cantidad'];
            $id_user=$id;

             //Comprobar si la tabla está vacía
             $comprobar = "SELECT COUNT(*) AS total FROM carrito where id_user=$id and nombre='$nombre'";
             $result = $conexion->query($comprobar);
             $row = $result->fetch(PDO::FETCH_ASSOC);
 
 
             if ($row["total"] == 0) {
                //Si carrito está vacio
            $sentenciaInsert= "INSERT INTO carrito (nombre, precio, foto, id_user, cant) VALUES (?,?,?,?,?)";
            $stmt=$conexion->prepare($sentenciaInsert);
            $stmt->execute(array($nombre,$precio,$foto,$id_user,$cantidad));
            header("Refresh: 0; url=carrito.php", true, 303); 

             }else{
                //Si carrito está lleno
            $sentenciaUpdate= "UPDATE carrito SET cant = cant + ? WHERE nombre = ? and id_user=$id";
            $stmt=$conexion->prepare($sentenciaUpdate);
            $stmt->execute(array($cantidad,$nombre));
                

            header("Refresh: 0; url=carrito.php", true, 303); 
             }
    ?>
            
     
    <?php
        }catch(PDOException $excp){
            die ("Fallo en la conexión" . $excp->getMessage());
        }  
    
}
  ?>
  </div>
  </div>
  </div>
    </header>
</body>
</html>