<?php
include("funciones.php");

$limInferior = 0;

// Configuraciones iniciales
$config = obtenerConfiguracion();
$result_ciudades = ObtenerTodasLasCiudades();
$result_tipos = obtenerTodosLosTipos();

// Capturar filtros y búsqueda
$busqueda = isset($_GET['busqueda']) ? trim($_GET['busqueda']) : '';
$id_ciudad = isset($_GET['ciudad']) ? $_GET['ciudad'] : '';
$id_tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';
$estado = isset($_GET['estado']) ? $_GET['estado'] : 'Venta';

// Consultar propiedades con o sin filtros
$result_busqueda = null;
if ($id_ciudad || $id_tipo || $estado || $busqueda) {
    $result_busqueda = realizarBusqueda($id_ciudad, $id_tipo, $estado, $busqueda);
} else {
    $result_busqueda = cargarPropiedades($limInferior, $busqueda);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venta de propiedades</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="estilo.css">
    <script src="script.js"></script>
</head>

<body class="page-propiedades">
    <div class="container">
        <?php include("header.php"); ?>

        <div class="box-buscar-propiedades pos-centrada">
            <div class="box-interior">
                <p>Encuentra la propiedad que buscas</p>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
                    <input type="text" name="busqueda" id="busqueda" placeholder="Busca por ubicación..."
                        class="input-buscar" value="<?php echo htmlspecialchars($busqueda); ?>" style="text-transform: lowercase;">
                    <div class="estado">
                        <span>
                            <input type="radio" value="Proyecto" name="estado" <?php echo ($estado == 'Proyecto') ? 'checked' : ''; ?>> Proyecto
                        </span>
                        <span>
                            <input type="radio" value="Venta" name="estado" <?php echo ($estado == 'Venta') ? 'checked' : ''; ?>> Venta
                        </span>
                    </div>
                    <input type="submit" value="Buscar" name="buscar">
                </form>
            </div>
        </div>

        <h2 class="titulo-seccion">
            <?php if ($busqueda || $id_ciudad || $id_tipo || $estado): ?>
                <b>Resultados de la Búsqueda</b>
            <?php else: ?>
                <b>Propiedades Destacadas</b>
            <?php endif; ?>
        </h2>

        <div class="contenedor-propiedades" id="contenedor-propiedades">
            <?php if ($result_busqueda && mysqli_num_rows($result_busqueda) > 0): ?>
                <?php while ($propiedad = mysqli_fetch_assoc($result_busqueda)) : ?>
                    <form action="publicacion.php" method="get" id="<?php echo $propiedad['id'] ?>">
                        <input type="hidden" value="<?php echo $propiedad['id'] ?>" name="idPropiedad">
                        <div class="contenedor-propiedad" onclick="document.getElementById('<?php echo $propiedad['id'] ?>').submit();">
                            <div class="contenedor-img">
                                <img src="<?php echo 'admin/' . $propiedad['url_foto_principal'] ?>" alt="">
                                <div class="estado">
                                    <?php echo $propiedad['estado'] ?>
                                </div>
                            </div>
                            <div class="info">
                                <h2><?php echo $propiedad['titulo'] ?></h2>
                                <p><i class="fa-solid fa-location-pin"></i><?php echo $propiedad['ubicacion'] ?></p>
                                <span class="precio"><?php echo $propiedad['moneda'] ?> <?php echo number_format($propiedad['precio'], 0, '', '.') ?></span>
                                <hr>
                                <table>
                                    <tr>
                                        <th>Habts.</th>
                                        <th>Baños</th>
                                        <th>Area</th>
                                    </tr>
                                    <tr>
                                        <td><?php echo $propiedad['habitaciones'] ?></td>
                                        <td><?php echo $propiedad['banios'] ?></td>
                                        <td><?php echo $propiedad['dimensiones'] ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </form>
                <?php endwhile ?>
            <?php else: ?>
                <div class="mensaje-no-resultados">
                    <img src="./img/main.svg" alt="No resultados" class="imagen-no-resultados">
                    <p>Ups, no tenemos resultados para tu búsqueda.</p>
                </div>
            <?php endif; ?>
        </div>

        <button value="0" onclick="cargarMasPropiedades(this.value)" id="botonCargarMas"> Ver Más</button>
    </div>

    <footer class="inferior">
        <?php include("contenido-footer.php") ?>
    </footer>
</body>

</html>