<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/administrador.css">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <meta name="author" content="Jefferson, Álvaro , Joaquín">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>Empleado</title>
</head>
<body>
    <header>
    <abbr title="Volver a inicio"><a href="index.php"><img src="img/logo.png" alt="Logo web" id="logo"></a></abbr>
        <nav>
            <ul>
                <a href="empleado.php" id="active"><i class="fa-solid fa-house"></i>Empleado</a>
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
                        <br>
                        <!-- TABLA DE PIZZAS-->
                        <table>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>stock</th>
                        <th>stockminimo</th>
                        <th>Url foto</th>
                        <th colspan=2></th>

                        <?php
                    try {
                        //Conexion a BBD
                        $conexion = new PDO ( "mysql:host=localhost;dbname=tiffosi; 
                        charset=utf8","root","");
                        $sentenciaSelect2 = "SELECT id, nombre, precio, stock, stockminimo,descripcion, foto FROM pizzas";
                        $resultado2= $conexion->query($sentenciaSelect2);
                        while ($fila = $resultado2->fetchObject()) {

                            echo "<tr> <td>".$fila->id. "</td> <td>".$fila->nombre."</td> <td >".$fila->precio."</td> <td>".$fila->stock."</td> <td>".$fila->stockminimo."</td> <td>".$fila->foto."</td><td>";
                            ?>
                                <div id='botones'>
                                <form action="borrar3.php" method='post' id='borrar'>
                                <input type="hidden" name='borrar'  id='borrar' value='<?=$fila->id?>'>
                                <input type="submit" value="Borrar" id='borrar' class="botones">
                                </form>   
                            </td>
                            <td>
                                <form action='modificar3.php' method='post'>
                                <input type='hidden' name='modificar' id='modificar'  value=<?=$fila->id?>>
                                <input type='submit' value='Modificar'  id='modificar' class="modificar">
                                </form> 
                                </div>
                            </td>
                            <?php
                            echo "<tr><td colspan=2><b>Descripcion:</b></td></tr>";
                            echo "<tr><td colspan=6>".$fila->descripcion."</td></tr>";
                            }
    
                            ?>
                            
                            <form action="altaspizzas.php" method="post" enctype="multipart/form-data">
                                <tr>
                                    <td><input type="hidden" id="id"></td>
                                    <td><input type="text" placeholder="nombre" name="nombre" id="nombre"></td>
                                    <td><input type="text" placeholder="precio" name="precio" id="precio"></td>
                                    <td><input type="text" placeholder="stock" name="stock" id="stock"></td>
                                    <td><input type="text" placeholder="stockminimo" name="stockminimo" id="stockminimo"></td>
                                    <td><input type="file" name="foto" id="foto"></td>
                                    <td colspan="2"><input type="submit" value="Insertar" class="botones"></td>
                                </tr>
                                    <tr><td colspan=6><textarea placeholder="Descripcion" name="descripcion" id="descripcion" rows="10" cols="100"></textarea></td></tr>
                            </form>

                            </table>
                        <?php

                    } catch (mysqli_sql_exception $ex) {
                        if ($conexion->connect_error) {
                             die ("Algo ha fallado");
                        }else{
                             die ("Algo ha fallado");
                        }
                    }
                    
                    ?>
            </article>
        </section>
    </main>
</body>
</html>

    </body>