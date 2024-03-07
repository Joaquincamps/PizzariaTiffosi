<?php
//Alvaro, Joaquín ,Jefferson
session_start();
session_destroy();
header('Refresh: 0; url=inicioSesion.php', true, 303);
?>
