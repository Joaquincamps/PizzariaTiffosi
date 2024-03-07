<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Jefferson, Álvaro , Joaquín">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/nosotros.css">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>Sobre nosotros</title>
</head>
<body>
    <header>
    <abbr title="Volver a inicio"><a href="index.php"><img src="img/logo.png" alt="Logo web" id="logo"></a></abbr>
        <nav>
            <ul>
                <a href="index.php"><i class="fa-solid fa-house"></i>Inicio</a>
                <a href="nosotros.php" id="active"><i class="fa-solid fa-address-card"></i>Nosotros</a>
                <a href="carrito.php"><i class="fa-solid fa-cart-shopping"></i>Carrito</a>
                <a href="inicioSesion.php"><i class="fa-solid fa-user"></i>
                <?php 
                    session_start();
                    if (!isset($_SESSION['sesion'])){
                    echo("Inicio de sesión");
                    }else{ 
                    echo("$_SESSION[usuario]");
                    }
                ?>
            </a>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h2>Tiffosi Pizza🍕</h2>
        <p> Es uno de los lugares más increíbles que suelen visitar los turistas. Se recomienda pedir la cocina italiana de esta pizzería. No hay nada mejor que probar una sabrosa pizza napolitana, una casera pizza frita o una singular pizza margarita. Prueba su generoso tiramisú. Es estupendo poder tomar una insuperable cerveza, unas espectaculares margaritas o un sorprendente cordial. Recomienda a sus clientes distintas variantes de su estupenda limonada y su sensacional café.</p>
        <br>
        <p>Un gran número de visitantes destacan que el personal es profesional en este lugar. Tenemos que destacar que su servicio se considera pulcro. Este lugar te permite elegir entre una gran variedad de platos a unos precios razonables.</p>
    </div>
    <div class="container2">
        <h2 class="tit2">¿Donde encontrarnos?</h2>
       <a href="https://maps.app.goo.gl/2XZNpPvpifYHAUnXA" target="_blanck"><img src="img/cap.png" alt=""></a>
       <div class="container3">
       <h2 class="tit3">Pizzeria Tiffosi</h2>
       <ul>
        <li><b>Dirección:</b>C. de Peñaranda de Bracamonte, 6</li>
        <li><b>Horario:</b>L-V de 13h a 23h</li>
        <li><b>Teléfono:</b>66611122</li>
        <li><b>Correo electrónico:</b>pizzeria@tiffosi.com</li>
       </ul>
       </div>
      
    </div>
    </body>