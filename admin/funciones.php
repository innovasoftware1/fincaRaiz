<?php
function obtenerConfiguracion()
{
    include("conexion.php");
    $query = "SELECT COUNT(*) AS total FROM configuracion";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row['total'] == '0') {
        $query = "INSERT INTO configuracion (id,user,password)
        VALUES (NULL, 'admin', 'admin')";

        if (mysqli_query($conn, $query)) {
        } else {
            echo "No se pudo insertar en la BD" .mysqli_errno($conn);
        }
    }

    $query = "SELECT * FROM configuracion  WHERE id='1'";
    $result = mysqli_query($conn, $query);
    $config = mysqli_fetch_assoc($result);
    return $config;
}

function obtenerTotalRegistros($tabla)
{
    include("conexion.php");
    $query = "SELECT COUNT(*) id FROM $tabla";
    $result = mysqli_query($conn, $query);
    $fila = mysqli_fetch_assoc($result);
    return $fila['id'];
}

function agregarNuevoTipoDePropiedad($tipo){
    include("conexion.php");
    $query = "INSERT INTO tipos (id, nombre_tipo)
    VALUES (NULL, '$tipo')";

    if (mysqli_query($conn, $query)) {
        $mensaje = "Tipo de Propiedad agregado correctamente";
    } else {
        $mensaje = "No se pudo insertar en la BD" . mysqli_errno($conn);
    }
    return $mensaje;
}

function agregarNuevoPais($pais){
    include("conexion.php");
    $query = "INSERT INTO paises (id, nombre_pais)
    VALUES (NULL, '$pais')";

    if (mysqli_query($conn, $query)) {
        $mensaje = "Pais agregado correctamente";
    } else {
        $mensaje = "No se pudo insertar en la BD" . mysqli_errno($conn);
    }
    return $mensaje;
}
?>
