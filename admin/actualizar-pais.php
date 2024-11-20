<?php
include("conexion.php");
$id_pais = $_GET['id'];

$query = "SELECT * FROM paises WHERE id='$id_pais'";

$result = mysqli_query($conn, $query);
$pais = mysqli_fetch_assoc($result);

if (isset($_GET['modificar'])) {
    include("conexion.php");

    $id = $_GET['id'];
    $nombre_pais = $_GET['nombre_pais'];

    $query = "UPDATE paises SET nombre_pais='$nombre_pais' WHERE id='$id'";

    if (mysqli_query($conn, $query)) {
        $mensaje = "El país se actualizó correctamente";
        $estado = 'success';
    } else {
        $mensaje = "No se pudo actualizar en la BD: " . mysqli_error($conn);
        $estado = 'error';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="estilo.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>FRSC - Admin</title>
</head>

<body>
    <?php include("header.php"); ?>
    <div id="contenedor-admin">
        <?php include("contenedor-menu.php"); ?>

        <div class="contenedor-principal">
            <div id="nuevo-pais">
                <h2>Actualizar Pais</h2>
                <hr>

                <div class="box-nuevo-tipo">
                    <h3>Actualizar Pais</h3>
                    <hr>
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
                        <input type="hidden" name="id" value="<?php echo $pais['id'] ?>"> 
                        <input type="text" name="nombre_pais" value="<?php echo $pais['nombre_pais'] ?>" placeholder="Nombre del pais" required>
                        <input type="submit" name="modificar" value="Modificar" class="btn-accion">
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
    <?php if (isset($estado)) : ?>
        Swal.fire({
            icon: '<?php echo $estado; ?>',
            title: '<?php echo $estado == 'success' ? "¡Éxito!" : "¡Error!"; ?>',
            text: '<?php echo $mensaje; ?>',
            showConfirmButton: false,  
            timer: 2000,  
            allowOutsideClick: false 
        }).then(() => {
            <?php if ($estado == 'success') : ?>
                window.location.href = 'listado-paises.php'; 
            <?php endif; ?>
        });
    <?php endif; ?>
</script>

</body>

</html>
