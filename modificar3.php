<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Jefferson, Álvaro , Joaquín">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/modificar.css">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>Modificar</title>
</head>
<body>
    <header>
    <abbr title="Volver a inicio"><a href="index.php"><img src="img/logo.png" alt="Logo web" id="logo"></a></abbr>
        <nav>
            <ul>
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

    <table>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Stockminimo</th>
            <th>Foto</th>
            <th colspan=2></th>
                   
                    <?php
                    try {
                        //Conexion a BBD
                        $conexion = new PDO ( "mysql:host=localhost;dbname=tiffosi; 
                        charset=utf8","root","");
                        $id= $_POST['modificar'];
                        
                        //Session usuario
                        $nomb = "$_SESSION[usuario]";
                        $sentenciaSelect = "SELECT id,nombre, rol,contraseña FROM personas WHERE nombre = '$nomb'";
                        $resultado = $conexion->query($sentenciaSelect);
                        $fila = $resultado->fetchObject();
                        $realnomb = $fila->nombre;
                        $realcontr = $fila->contraseña;
                        $rol = $fila->rol;
                        $realid = $fila->id;
                        
                        $sentenciaSelect = "SELECT id, nombre, precio, stock, stockminimo,descripcion, foto FROM pizzas where id=$id";
                        $resultado = $conexion->query($sentenciaSelect);
                        
                        //consultar database 

                        while ($fila = $resultado->fetchObject()) {

                    ?> 
                    
                        <form action="modificar4.php" method="post">
                        <tr>
                            <input type="hidden" name="id" id="id" value="<?=$fila->id?>">                           
                            <td><?=$fila->id?>                          </td>
                            <td><input type="text" name="nombre" id="nombre" value="<?=$fila->nombre?>">               </td>
                            <td><input type="text" name="precio" id="precio" value="<?=$fila->precio?>">                        </td>
                            <td><input type="text" name="stock" id="stock" value="<?=$fila->stock?>">   </td>
                            <td><input type="text" name="stockminimo" id="stockminimo" value="<?=$fila->stockminimo?>">   </td>
                            <td><input type="text" name="foto" id="foto" value="<?=$fila->foto?>">   </td>
                        </tr>
                        <tr>
                            <td><b>Descripción</b></td>
                            <td colspan=6><textarea placeholder="Descripcion" name="descripcion" id="descripcion" rows="10" cols="100" value="<?=$fila->descripcion?>"> <?=$fila->descripcion?> </textarea></td>
                        </tr>
                        <tr>
                            <td colspan=6><button type="submit" class="botones">Actualizar</button></td>
                            </form>
                        </tr>
                        <tr>
                            <td colspan=6>
                                <?php
                                if($rol == 'administrador') {
                                    echo "<form action='administrador.php' method='post'>
                                        <input type='submit' value='Cancelar'  class='botones'>
                                        </form>";
                                } elseif ($rol == 'empleado') {
                                    echo "<form action='empleado.php' method='post'>
                                        <input type='submit' value='Cancelar'  class='botones'>
                                        </form>";
                                }
                                ?>
                            </td>
                        </tr>                      
                         
                    <?php

                        }
                    } catch (mysqli_sql_exception $ex) {
                        if ($conexion->connect_error) {
                             die ("Algo ha fallado");
                        }else{
                             die ("Algo ha fallado");
                        }
                    }
                    
                    ?>
            </table>
            </article>
        </section>
    </main>
</body>
</html>

    </body>