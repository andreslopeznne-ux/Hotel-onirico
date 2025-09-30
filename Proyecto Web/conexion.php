<?php
$host = "localhost";
$user = "root";  
$pass = "";  
$db = "hotel_paraiso";

$conexion = new mysqli($host, $user, $pass, $db);

if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}
