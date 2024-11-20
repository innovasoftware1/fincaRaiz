<?php
include("funciones.php");

$config = obtenerConfiguracion();
$result_ciudades = obtenerTodasLasCiudades();
$result_tipos = obtenerTodosLosTipos();

$busqueda = isset($_GET['busqueda']) ? trim($_GET['busqueda']) : '';

$estado = isset($_GET['estado']) ? $_GET['estado'] : 'Venta';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fincaraizsincomisiones.com</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="estilo.css">
</head>

<body class="home" id="home">
    <div class="container">
        <?php include("header.php"); ?>

        <h2>Casas, fincas, departamentos <br> Al mejor precio.</h2>

        <div class="box-buscar-propiedades pos-inferior">
            <div class="box-interior">
                <p>¿Dónde quieres comprar?</p>
                <form action="propiedades.php" method="get">
                    <input type="text" name="busqueda" id="busqueda" placeholder="Busca por ubicación... " class="input-buscar" value="<?php echo htmlspecialchars($busqueda); ?>" oninput="convertirAMinusculas(this)">

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

        <footer class="inferior2">
            <?php include("contenido-footer.php"); ?>
        </footer>
    </div>

    <script>
        function convertirAMinusculas(input) {
            input.value = input.value.toLowerCase();
        }
    </script>
</body>

<script src="script.js"></script>

</html>
