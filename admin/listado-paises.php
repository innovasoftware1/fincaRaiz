<?php
session_start();

if (!$_SESSION['usuarioLogeado']) {
    header("Location:login.php");
    exit;
}
function obtenerTodosLosPaises()
{
    include("conexion.php");

    $query = "SELECT * FROM paises";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error en la consulta: " . mysqli_error($conn)); 
    }

    return $result;
}

$result = obtenerTodosLosPaises();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            <div id="listado-paises">
                <h2>Listado de Paises</h2>
                <hr>
                <div class="contenedor-tabla">
                    <table class="listados">
                        <tr>
                            <th>#ID</th>
                            <th>Nombre del Pais</th>
                            <th>Acciones</th>
                        </tr>

                        <?php while ($pais = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td> <?php echo $pais['id'] ?></td>
                                <td> <?php echo $pais['nombre_pais'] ?></td>
                                <td>
                                    <form action="actualizar-pais.php" method="get" class="form-acciones" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $pais['id'] ?>">
                                        <input type="submit" value="Actualizar" name="actualizar">
                                    </form>
                                    <button class="btn-eliminar" onclick="eliminarPais(<?php echo $pais['id']; ?>)">Eliminar</button>
                                </td>
                            </tr>
                        <?php endwhile ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
    function eliminarPais(idPais) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¡No podrás revertir esta acción!',
            icon: 'warning',
            showCancelButton: false, 
            confirmButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'eliminar-pais.php',
                    type: 'GET',
                    data: { id: idPais },
                    success: function(response) {
                        var data = JSON.parse(response);
                        if (data.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Eliminado!',
                                text: 'El país ha sido eliminado.',
                                showConfirmButton: false,
                                timer: 3000,
                                allowOutsideClick: false
                            }).then(() => {
                                $('tr').has('button[onclick="eliminarPais(' + idPais + ')"]').remove();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Hubo un problema al eliminar el país.',
                                showConfirmButton: false,
                                timer: 3000,
                                allowOutsideClick: false
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Hubo un error al realizar la solicitud.',
                            showConfirmButton: false,
                            timer: 3000,
                            allowOutsideClick: false
                        });
                    }
                });
            }
        });
    }
</script>


    <script>
        // Resaltar la página actual en el menú
        $('#link-listado-paises').addClass('pagina-activa');
    </script>
</body>

</html>
