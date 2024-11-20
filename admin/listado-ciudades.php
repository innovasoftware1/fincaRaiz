<?php
session_start();

if (!$_SESSION['usuarioLogeado']) {
    header("Location:login.php");
}

function obtenerTodasLasCiudades()
{
    include("conexion.php");
    $query = "SELECT * FROM ciudades";
    $result = mysqli_query($conn, $query);
    return $result;
}

function obtenerPais($id_pais)
{
    include("conexion.php");
    $query = "SELECT * FROM paises WHERE id='$id_pais'";
    $resultado_pais = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($resultado_pais);
    return $row['nombre_pais'];
}

$result = obtenerTodasLasCiudades();
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
            <div id="listado-paises">
                <h2>Listado de Ciudades</h2>
                <hr>

                <div class="contenedor-tabla">
                    <table class="listados">
                        <tr>
                            <th>#ID</th>
                            <th>Nombre del Pais</th>
                            <th>Nombre de la Ciudad</th>
                            <th>Acciones</th>
                        </tr>

                        <?php while ($ciudad = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td> <?php echo $ciudad['id'] ?></td>
                                <td> <?php echo obtenerPais($ciudad['id_pais']) ?></td>
                                <td> <?php echo $ciudad['nombre_ciudad'] ?></td>
                                <td>
                                    <form action="actualizar-ciudad.php" method="get" class="form-acciones" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $ciudad['id'] ?>">
                                        <input type="submit" value="Actualizar" name="actualizar">
                                    </form>
                                    <button class="btn-eliminar" onclick="eliminarCiudad(<?php echo $ciudad['id'] ?>)">Eliminar</button>
                                </td>
                            </tr>
                        <?php endwhile ?>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <script>
    $('#link-listado-ciudades').addClass('pagina-activa');

    function eliminarCiudad(idCiudad) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¡Esta ciudad será eliminada permanentemente!',
            icon: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'eliminar-ciudad.php',  
                    type: 'GET',
                    data: { id: idCiudad },
                    success: function(response) {
                        var data = JSON.parse(response);
                        if (data.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Eliminado!',
                                text: 'La ciudad ha sido eliminada.',
                                showConfirmButton: false, 
                                timer: 3000 
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error', 'Hubo un problema al eliminar la ciudad.', 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire('Error', 'Hubo un error al realizar la solicitud.', 'error');
                    }
                });
            }
        });
    }
</script>

</body>

</html>
