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
            <th>Rol</th>
            <th colspan=2></th>
                   
                    <?php
                    try {
                        //Conexion a BBD
                        $conexion = new PDO ( "mysql:host=localhost;dbname=tiffosi; 
                        charset=utf8","root","");
                        $id= $_POST['modificar'];
                        
                        $sentenciaSelect = "SELECT id,nombre,rol, contraseña, correo, direccion FROM personas where id=$id";
                        $resultado = $conexion->query($sentenciaSelect);
                        
                        //consultar database 

                        while ($fila = $resultado->fetchObject()) {

                    ?> 
                    
                        <form action="modificar2.php" method="post">
                            <tr>
                            <input type="hidden" name="id" id="id" value="<?=$fila->id?>">                           
                            <td><?=$fila->id?>                          </td>
                            <td><?=$fila->nombre?>               </td>
                            <td><select placeholder="rol" name="rol"id='rol'>
                            <option>cliente</option>
                            <option>administrador</option>
                            <option>empleado</option>
                            </select></td>
                            <td><button type="submit" class="botones">Actualizar</button></td>
                            <td><button id="volver" formaction="administrador.php" class="volver" >Volver</button></td>
                            </tr>                      
                        </form>  
                    <?php

                        }

                        //cerrar se cierra solo


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