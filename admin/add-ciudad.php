<?php

include("conexion.php");

$query = "SELECT * FROM paises";

$resultado = mysqli_query($conn, $query);

if (isset($_POST['agregar'])) {
    include("conexion.php");

    $id_pais = $_POST['pais'];
    $ciudad = $_POST['ciudad'];

    $query = "INSERT INTO ciudades (id, id_pais, nombre_ciudad)
    VALUES (NULL, '$id_pais', '$ciudad')";

    if (mysqli_query($conn, $query)) {
        $pais_query = "SELECT nombre_pais FROM paises WHERE id = '$id_pais'";
        $pais_result = mysqli_query($conn, $pais_query);
        $pais_row = mysqli_fetch_assoc($pais_result);
        $nombre_pais = $pais_row['nombre_pais'];

        $mensaje = "La ciudad se agregó correctamente al país: $nombre_pais";
    } else {
        $mensaje = "No se pudo insertar en la BD: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="estilo.css">
    <title>FRSC - Admin</title>
</head>

<body>
    <?php include("header.php"); ?>
    
    <div id="contenedor-admin">
        <?php include("contenedor-menu.php"); ?>

        <div class="contenedor-principal">
            <div id="nueva-ciudad">
                <h2>Agregar Nueva Ciudad</h2>
                <hr>

                <div class="box-nuevo-tipo">
                    <h3>Agregar Nueva Ciudad</h3>
                    <hr>
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

                        <label for="pais">Seleccione el país</label>
                        <select name="pais" id="select">
                            <?php while ($row = mysqli_fetch_assoc($resultado)) : ?>
                                <option value="<?php echo $row['id'] ?>">
                                    <?php echo $row['nombre_pais'] ?>
                                </option>
                            <?php endwhile ?>
                        </select>
                        <input type="text" name="ciudad" placeholder="Nombre de la Ciudad" required>
                        <input type="submit" name="agregar" value="Agregar" class="btn-accion">
                    </form>

                    <?php if (isset($_POST['agregar'])) : ?>
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: '¡Ciudad Agregada!',
                                text: '<?php echo $mensaje; ?>',
                                showConfirmButton: false,
                                timer: 3000 
                            }).then(function() {
                                window.location.href = 'listado-ciudades.php'; 
                            });
                        </script>
                    <?php endif; ?>

                </div>

            </div>
        </div>
    </div>

    <script>
        $('#link-add-ciudad').addClass('pagina-activa');
    </script>
</body>

</html>
