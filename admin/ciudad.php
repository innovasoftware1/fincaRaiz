<?php

include("conexion.php");
$departamento = $_GET['c'];
echo 

$query = "SELECT * FROM ciudades WHERE id_departamento='$departamento'";

$resultado_ciudades = mysqli_query($conn, $query);

while($row = mysqli_fetch_assoc($resultado_ciudades)){
    echo '<option value="'.$row['id'].'">';
    echo $row['nombre_ciudad'];
    echo '</option>';
}

?>