<!--
$server		="localhost:3307";
$username	="root";
$password	="clave.innova";
$bd			="finca_raiz_v1";

$conn = mysqli_connect($server, $username, $password, $bd);

if(!$conn){
	die("Conexión fallida:" . mysqli_connect_error());
}

if(!$conn){
	die("Conexión fallida:" . mysqli_connect_error());
}
-->


<?php
/* Conexión a la base de datos */
$server = "localhost:3307"; // Servidor y puerto
$username = "root";         // Usuario
$password = "clave.innova";             // Contraseña
$bd = "finca_raiz_v1";      // Base de datos

$conn = mysqli_connect($server, $username, $password, $bd);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>
