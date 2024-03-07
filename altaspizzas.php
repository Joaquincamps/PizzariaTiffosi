<?php
try {
    //Alvaro, Joaquín ,Jefferson
    $conexion = new PDO("mysql:host=localhost;dbname=tiffosi;charset=utf8", "root", "");

    //Session usuario
    session_start();
    $nomb = $_SESSION["usuario"];
    $sentenciaSelect = "SELECT nombre, rol,contraseña FROM personas WHERE nombre = '$nomb'";
    $resultado = $conexion->query($sentenciaSelect);
    $fila = $resultado->fetchObject();
    $realnomb = $fila->nombre;
    $rol = $fila->rol;

    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $stockminimo = $_POST['stockminimo'];
    $descripcion = $_POST['descripcion'];

    
    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {
        $dir_img = "../TIFFOSI/img/"; 
        $archivo = basename($_FILES["foto"]["name"]);

        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if ($check !== false) {
            
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $dir_img . $archivo)) {

                $foto = $archivo; 
            } else {
                echo "<script>alert('Hubo un error al subir la imagen.');</script>";
                $foto = ""; 
            }
        } else {
            echo "<script>alert('El archivo no es una imagen válida.');</script>";
            $foto = "";
        }
    } else {
        echo "<script>alert('No se ha seleccionado ninguna imagen.');</script>";
        $foto = ""; 
    }

    if (empty($nombre) or empty($precio) or empty($stock) or empty($stockminimo) or empty($foto) or empty($descripcion)) {
        echo "<script>alert('Se debe rellenar todos los campos');</script>";
        if ($rol == 'administrador') {
            header("Refresh: 0; url=administrador.php", true, 303);
        } elseif ($rol == 'empleado') {
            header("Refresh: 0; url=empleado.php", true, 303);
        }
    } else {
        $sentenciaInsert = "INSERT INTO pizzas (nombre,precio,stock,stockminimo,descripcion,foto) VALUES (?,?,?,?,?,?)";
        $stm = $conexion->prepare($sentenciaInsert);
        $stm->execute(array($nombre, $precio, $stock, $stockminimo,$descripcion, $foto));
        echo "<script>alert('Pizza añadida correctamente');</script>";
        if ($rol == 'administrador') {
            header("Refresh: 0; url=administrador.php", true, 303);
        } elseif ($rol == 'empleado') {
            header("Refresh: 0; url=empleado.php", true, 303);
        }
    }
} catch (PDOException $excp) {
    die("Fallo en la conexión" . $excp->getMessage());
}
?>
