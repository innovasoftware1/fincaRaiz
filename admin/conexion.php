 <?php

/* Conexion INNNOVA - Desde Casa. */
/* $server		="localhost";
$username	="root";
$password	="1014274668";
$bd			="bd_inmobiliaria";

$conn = mysqli_connect($server, $username, $password, $bd);

if(!$conn){
	die("Conexión fallida:" . mysqli_connect_error());
}

if(!$conn){
	die("Conexión fallida:" . mysqli_connect_error());
} */



/* Conexion INNNOVA - Desde Innova. */
$server		="localhost:3307";
$username	="root";
$password	="clave.innova";
$bd			="bd_inmobiliaria";

$conn = mysqli_connect($server, $username, $password, $bd);

if(!$conn){
	die("Conexión fallida:" . mysqli_connect_error());
}

if(!$conn){
	die("Conexión fallida:" . mysqli_connect_error());
}

?> 