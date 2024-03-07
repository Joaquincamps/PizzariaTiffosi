<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Jefferson, Álvaro , Joaquín">
    <title>Pago de Compra</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/pagar.css">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

</head>
<body>
    <header>
<?php
session_start();
if (isset($_SESSION['sesion'])){
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
    </header>
    <?php
}
$conexion = new PDO ("mysql:host=localhost;dbname=tiffosi;charset=utf8","root","");

$nomb = "$_SESSION[usuario]";
$sentenciaSelect = "SELECT id,nombre, rol,contraseña,direccion,correo FROM personas WHERE nombre = '$nomb'";
$resultado = $conexion->query($sentenciaSelect);
$fila = $resultado->fetchObject();
$realnomb = $fila->nombre;
$realcontr = $fila->contraseña;
$dire=$fila->direccion;
$correo=$fila->correo;
$rol = $fila->rol;
$id = $fila->id;
?>
    <div class="container">
        <h1>Pago de Compra</h1>
        <div class="detalle-compra">
                    <h2>Resumen de Compra</h2>
        <?php 
        try{
            $id_user=$id;
            $conexion = new PDO("mysql:host=localhost;dbname=tiffosi;charset=utf8", "root", "");
            $sentenciaSelect = "SELECT id, nombre, precio, foto, id_user,cant FROM carrito where id_user=$id";
            $resultado = $conexion -> query($sentenciaSelect);
            while ($fila = $resultado->fetchObject()){ 
        ?>
            <?php 
            $precio=$fila->precio;
            $cantidad=$fila->cant;
            $precio_n=$precio*$cantidad;

            echo"<div class='item'>
                <span class='nombre'>".$fila->nombre." x ".$fila->cant."</span>
                <span class='precio'>".$precio_n." €</span>
            </div>";}
            $sentenciaSuma = "SELECT SUM(precio*cant) AS total FROM carrito where id_user=$id";
            $stmt = $conexion->query($sentenciaSuma);
            $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            $iva=$total*0.21;
            $totalmasiva=$total+$iva;
            echo"<div class='total'>
                <span>Total:</span>
                <span class='precio'>".$total." €</span>
            </div>";
           ?>
        </div>
        <div class="metodo-pago">
            <h2>Método de Pago</h2>
            <form action="elimcarrito.php">
                <label for="nom">Nombre</label>
                <input type="text" name="nom" id="nom" value='<?= $nomb?>'>
                <label for="dire">Dirección</label>
                <input type="text" name="dire" id="dire" value='<?= $dire?>'>
                <label for="correo">Correo Electrónico</label>
                <input type="text" name="correo" id="correo" value='<?= $correo?>'>
                <label for="tarjeta">Tarjeta de Crédito:</label>
                <input type="text" id="tarjeta" name="tarjeta" placeholder="Número de Tarjeta" required pattern="[0-9]{16}">
                <label for="fecha">Fecha de Expiración:</label>
                <input type="text" id="fecha" name="fecha" placeholder="MM/AA" required  pattern="[0-9]{2}\/[0-9]{2}">
                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" placeholder="CVV" required pattern="[0-9]{3}">
                <input type="hidden" name="total" id="total" value='<?= $total?>'>
                <input type="hidden" name="iva" id="iva" value='<?= $iva?>'>
                <input type="hidden" name="totalmasiva" id="totalmasiva" value='<?= $totalmasiva?>'>
                <button type="submit" onclick="generarPDF()">Pagar</button>
            </form>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>

        <script>
    function generarPDF() {
        var tarjeta = document.getElementById('tarjeta').value;
        var fecha = document.getElementById('fecha').value;
        var cvv = document.getElementById('cvv').value;

        
        if (tarjeta.length == 0 && fecha.length == 0 && cvv.length == 0) {
            alert("No dejes los datos bancarios en blanco");
        }else if(cvv.length != 3){
                alert("El CVV debe tener exactamente 3 dígitos")
        }else if (tarjeta.length  != 16 || isNaN(tarjeta)) {
            alert("La tarjeta no es válida, ingrese una con 16 dígitos y sin espacios ni letras.");
            }
        else if(!/^\d{2}\/\d{2}$/.test(fecha)){
            alert("Fecha con formato incorrecto: MM/AA");
        }
        else {
            var nom = document.getElementById('nom').value;
            var dire = document.getElementById('dire').value;
            var correo = document.getElementById('correo').value;
            var tarjeta = document.getElementById('tarjeta').value;
            var total = document.getElementById('total').value;           
            var iva = document.getElementById('iva').value;
            var totalmasiva = document.getElementById('totalmasiva').value;

            var ahora = new Date();
            var fechaHora = ahora.toLocaleString();

            var doc = new jsPDF();

            doc.setFont("helvetica", "bold");
            doc.setFontSize(24);
            doc.setTextColor("#007bff");
            doc.text(20, 20, 'Factura');

            doc.setFont("helvetica", "normal");
            doc.setFontSize(14);
            doc.setTextColor("#000000");
            doc.text(20, 40, 'Nombre: ' + nom);
            doc.text(20, 50, 'Dirección: ' + dire);
            doc.text(20, 60, 'Correo Electrónico: ' + correo);
            doc.text(20, 70, 'Tarjeta: ' + tarjeta);
            doc.text(20, 80, 'Fecha y Hora:    ' + fechaHora);
            doc.text(20, 90, 'Total Base Imponible:    ' + total);
            doc.text(20, 100, 'IVA 21%:                        ' + iva+ "€");
            doc.setFont("helvetica", "bold");
            doc.text(20, 110, 'Total:                             ' + totalmasiva + "€");



            doc.setLineWidth(0.5);
            doc.setDrawColor("#000000");
            doc.line(20, 140, 190, 140);

            doc.setFontSize(10);
            doc.text(20, 150, 'Gracias por su compra.');

            doc.save('factura.pdf');
            
        }
    }
        
</script>

        <?php

        }catch (PDOException $excp){
                    die("Fallo en la conexión" . $excp->getMessage());
                }
    ?>
    </div>
</body>
</html>
