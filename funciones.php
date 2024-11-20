<?php

function obtenerConfiguracion()
{
    include("admin/conexion.php");
    // Comprobamos si existe el registro 1 que mantiene la configuración
    // Añadimos un alias AS total para identificar más fácil
    $query = "SELECT COUNT(*) AS total FROM configuracion";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row['total'] == '0') {
        echo "Valor" . $row['total'];
        // No existe el registro 1 - DEBO INSERTAR el registro por primera vez
        $query = "INSERT INTO configuracion (id, user, password)
                  VALUES (NULL, 'admin', 'admin')";

        if (mysqli_query($conn, $query)) { // Se insertó correctamente
        } else {
            echo "No se pudo insertar en la BD" . mysqli_error($conn);
        }
    }

    // El registro
    $query = "SELECT * FROM configuracion WHERE id='1'";
    $result = mysqli_query($conn, $query);
    $config = mysqli_fetch_assoc($result);

    // Verificamos si la configuración existe
    if (!$config) {
        echo "No se pudo obtener la configuración.";
        return null;
    }

    return $config;
}

function obtenerTodasLasCiudades()
{
    include("admin/conexion.php");
    $query = "SELECT * FROM ciudades";
    $result = mysqli_query($conn, $query);
    return $result;
}

function obtenerTodosLosTipos()
{
    include("admin/conexion.php");
    $query = "SELECT * FROM tipos";
    $result = mysqli_query($conn, $query);
    return $result;
}

function cargarPropiedades($limInferior)
{
    include("admin/conexion.php");
    $config = obtenerConfiguracion();

    // Verifica si $config es un arreglo válido
    if (!$config) {
        echo "No se pudo obtener la configuración.";
        return null;
    }

    if ($config['tipo_visualizacion_propiedades'] == "f") { // Visualizamos por fecha de carga
        $query = "SELECT * FROM propiedades ORDER BY fecha_alta DESC LIMIT $limInferior, 6";
        $result = mysqli_query($conn, $query);
        return $result;
    } else { // Visualizamos las primeras propiedades de forma personalizada
        // Asegúrate de que las propiedades están bien definidas en $config
        $query = "SELECT * FROM propiedades WHERE id IN ('$config[propiedad1]', '$config[propiedad2]', '$config[propiedad3]', '$config[propiedad4]', '$config[propiedad5]', '$config[propiedad6]')
                  UNION
                  SELECT * FROM propiedades WHERE id NOT IN ('$config[propiedad1]', '$config[propiedad2]', '$config[propiedad3]', '$config[propiedad4]', '$config[propiedad5]', '$config[propiedad6]')
                  LIMIT $limInferior, 6";
        $result = mysqli_query($conn, $query);
        return $result;
    }
}

function obtenerPropiedadPorId($id_propiedad)
{
    include("admin/conexion.php");

    // Armamos el query para seleccionar la propiedad
    $query = "SELECT * FROM propiedades WHERE id='$id_propiedad'";

    // Ejecutamos la consulta
    $resultado_propiedad = mysqli_query($conn, $query);
    $propiedad = mysqli_fetch_assoc($resultado_propiedad);
    return $propiedad;
}

function obtenerCiudad($id_ciudad)
{
    include("admin/conexion.php");
    $query = "SELECT * FROM ciudades WHERE id='$id_ciudad'";

    // Ejecutamos la consulta
    $resultado_ciudad = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($resultado_ciudad);

    if ($row) {
        return $row['nombre_ciudad'];
    } else {
        return "Ciudad no encontrada";  // O alguna otra lógica que desees para manejar los errores
    }
}

function obtenerPais($id_pais)
{
    include("admin/conexion.php");
    $query = "SELECT * FROM paises WHERE id='$id_pais'";

    // Ejecutamos la consulta
    $resultado_pais = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($resultado_pais);

    if ($row) {
        return $row['nombre_pais'];
    } else {
        return "País no encontrado";  // O alguna otra lógica que desees para manejar los errores
    }
}

function obtenerFotosGaleria($id_propiedad)
{
    include("admin/conexion.php");
    $query = "SELECT * FROM fotos WHERE id_propiedad='$id_propiedad'";

    // Ejecutamos la consulta
    $resultado_fotos = mysqli_query($conn, $query);
    return $resultado_fotos;
}

function obtenerTipo($id_tipo)
{
    include("admin/conexion.php");

    // Verifica si $id_tipo no está vacío
    if (empty($id_tipo)) {
        return "Tipo no proporcionado";
    }

    // Limpia el valor de $id_tipo para evitar problemas con espacios en blanco
    $id_tipo = trim($id_tipo);

    // Verificar el valor de $id_tipo antes de realizar la consulta (por depuración)
    // echo "ID_Tipo: $id_tipo"; // Puedes descomentar esto para depurar

    // Usamos una consulta preparada para evitar inyecciones SQL
    $query = "SELECT * FROM tipos WHERE id = ?";

    // Preparamos la consulta
    if ($stmt = mysqli_prepare($conn, $query)) {
        // Enlazamos el parámetro $id_tipo a la consulta
        mysqli_stmt_bind_param($stmt, "s", $id_tipo); // "s" indica que $id_tipo es un string

        // Ejecutamos la consulta
        mysqli_stmt_execute($stmt);

        // Obtenemos el resultado
        $resultado_tipo = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($resultado_tipo);

        // Si encontramos un tipo
        if ($row) {
            return $row['nombre_tipo'];
        } else {
            return "Tipo no encontrado";
        }

        // Cerramos la declaración preparada
        mysqli_stmt_close($stmt);
    } else {
        return "Error en la preparación de la consulta: " . mysqli_error($conn);
    }
}

function pluralToSingular($word) {
    if (substr($word, -2) == 'es') {
        return substr($word, 0, -2);
    }
    if (substr($word, -1) == 's') {
        return substr($word, 0, -1);
    }
    return $word;
}


function realizarBusqueda($id_ciudad, $id_tipo, $estado, $busqueda)
{
    include("admin/conexion.php");

    $busqueda = strtolower(trim($busqueda));
    $busqueda_singular = pluralToSingular($busqueda);

    $query = "SELECT * FROM propiedades WHERE 1=1";

    if (!empty($busqueda)) {
        $no_results = true;

        $result_ciudades = obtenerTodasLasCiudades();
        while ($ciudad = mysqli_fetch_assoc($result_ciudades)) {
            if (stripos(strtolower($ciudad['nombre_ciudad']), $busqueda) !== false || stripos(strtolower($ciudad['nombre_ciudad']), $busqueda_singular) !== false) {
                $id_ciudad = $ciudad['id'];
                $no_results = false;
                break;
            }
        }

        if (empty($id_ciudad)) {
            $result_tipos = obtenerTodosLosTipos();
            while ($tipo = mysqli_fetch_assoc($result_tipos)) {
                if (stripos(strtolower($tipo['nombre_tipo']), $busqueda) !== false || stripos(strtolower($tipo['nombre_tipo']), $busqueda_singular) !== false) {
                    $id_tipo = $tipo['id'];
                    $no_results = false;
                    break;
                }
            }
        }
    }

    if (empty($busqueda)) {
        $estado = !empty($estado) ? $estado : 'Venta';
        $query .= " AND estado = '$estado'";
    }

    if (!empty($id_ciudad)) {
        $query .= " AND LOWER(ciudad) = LOWER('$id_ciudad')";
    }

    if (!empty($id_tipo)) {
        $query .= " AND LOWER(tipo) = LOWER('$id_tipo')";
    }

    if (!empty($estado)) {
        $query .= " AND estado = '$estado'";
    }

    $resultado_propiedades = mysqli_query($conn, $query);

    if (mysqli_num_rows($resultado_propiedades) === 0) {
        return null;
    }

    return $resultado_propiedades;
}


