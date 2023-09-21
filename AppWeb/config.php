<?php
//Variables para conección a la base de datos.
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'db_form');
 
//Cadena de conexion base de datos.
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
//Validar conexión
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
