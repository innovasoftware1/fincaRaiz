<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuarioLogeado']) || !isset($_SESSION['rol_id'])) {
    header("Location: login.php");
    exit();
}

$rol = $_SESSION['rol_id'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>SAWPI - Dashboard</title>
</head>

<body>
    <div class="contenedor-menu">
        <h2>MENU</h2>
        <nav>
            <ul>
                <hr>
                <?php if ($rol == 1 || $rol == 2) : ?>
                    <li id="link-dashboard">
                        <a href="index.php">
                            <i class="fa-solid fa-user"></i>
                            Dashboard
                        </a>
                    </li>
                    <hr>
                    <li id="link-add-propiedad">
                        <a href="add-propiedad.php">
                            <i class="fa-solid fa-building"></i>
                            Nueva Propiedad
                        </a>
                    </li>

                    <li id="link-listado-propiedades">
                        <a href="listado-propiedades.php">
                            <i class="fa-solid fa-list"></i>
                            Listado de Propiedades
                        </a>
                    </li>

                    <hr>

                    <li id="link-add-tipo-propiedad">
                        <a href="add-tipo-propiedad.php">
                            <i class="fa-solid fa-folder-plus"></i>
                            Nuevo Tipo de Propiedad
                        </a>
                    </li>

                    <li id="link-listado-tipo-propiedades">
                        <a href="listado-tipo-propiedades.php">
                            <i class="fa-solid fa-list"></i>
                            Listado de Tipo
                        </a>
                    </li>

                    <hr>

                    <li id="link-add-departamento">
                        <a href="add-departamento.php">
                            <i class="fa-solid fa-earth-americas"></i>
                            Nuevo Departamento
                        </a>
                    </li>

                    <li id="link-listado-departamentos">
                        <a href="listado-departamento.php">
                            <i class="fa-solid fa-list"></i>
                            Listado de Departamento
                        </a>
                    </li>

                    <hr>

                    <li id="link-add-ciudad">
                        <a href="add-ciudad.php">
                            <i class="fa-solid fa-location-dot"></i>
                            Nueva Ciudad
                        </a>
                    </li>

                    <li id="link-listado-ciudades">
                        <a href="listado-ciudades.php">
                            <i class="fa-solid fa-list"></i>
                            Listado de Ciudades
                        </a>
                    </li>

                <?php endif; ?>

                <hr>
                <li id="link-ver-sitio">
                    <a href="../index.php" target="_blank">
                        <i class="fa-solid fa-earth-africa"></i>
                        Ver Sitio Web
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</body>

</html>
