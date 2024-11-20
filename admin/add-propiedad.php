<?php

/********************************************************/
//SELECCIONAMOS LOS TIPOS DE PROPIEDADES
//nos conectamos a la base de datos
include("conexion.php");

//Armamos el query para seleccionar los tipos
$query = "SELECT * FROM tipos";

//Ejecutamos la consulta
$resultado_tipos = mysqli_query($conn, $query);
/******************************************************/

/********************************************************/
//SELECCIONAMOS LOS PAISES
//nos conectamos a la base de datos
include("conexion.php");

//Armamos el query para seleccionar los paises
$query = "SELECT * FROM paises";

//Ejecutamos la consulta
$resultado_paises = mysqli_query($conn, $query);
/********************************************************/


/******************************************************* */
//GUARDAMOS LA PROPIEDAD
if (isset($_POST['agregar'])) {
    //nos conectamos a la base de datos
    include("conexion.php");

    //tomamos los datos que vienen del formulario
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $tipo = $_POST['tipo'];
    $estado = $_POST['estado'];
    $ubicacion = $_POST['ubicacion'];
    $habitaciones = $_POST['habitaciones'];
    $banios = $_POST['banios'];
    $pisos = $_POST['pisos'];
    $garage = $_POST['garage'];
    $dimensiones = $_POST['dimensiones'];
    $precio = $_POST['precio'];
    $moneda = $_POST['moneda'];
    $url_foto_principal = "url";
    $url_galeria = "url";
    $pais = $_POST['pais'];
    $ciudad = $_POST['ciudad'];
    $propietario = $_POST['nombre_propietario'];
    $telefono_propietario = $_POST['telefono_propietario'];
    $agua = $_POST['agua'];
    $luz = $_POST['luz'];
    $gas = $_POST['gas'];
    $internet = $_POST['internet'];
    $clima = $_POST['clima'];
    $documentos_transferencia = $_POST['documentos_transferencia'];
    $permuta = $_POST['permuta'];
    $video_url = $_POST['video_url'];
    $recorrido_360_url = $_POST['recorrido_360_url'];
    $ubicacion_url = $_POST['ubicacion_url'];



    //armamos el query para insertar en la tabla propiedades
    $query = "INSERT INTO propiedades (id, fecha_alta, titulo, descripcion, tipo, estado, ubicacion, habitaciones, banios, pisos, garage, dimensiones, precio, moneda,  url_foto_principal, pais, ciudad, propietario, telefono_propietario, agua, luz, gas, internet, clima, documentos_transferencia, permuta, video_url, recorrido_360_url, ubicacion_url)
    VALUES ('$id',CURRENT_TIMESTAMP, '$titulo', '$descripcion','$tipo','$estado','$ubicacion','$habitaciones','$banios','$pisos','$garage','$dimensiones','$precio', '$moneda', '', '$pais','$ciudad','$propietario','$telefono_propietario' ,'$agua' ,'$luz'  ,'$gas','$internet', '$clima', '$documentos_transferencia', '$permuta', '$video_url', '$recorrido_360_url','$ubicacion_url')";

    //insertamos en la tabla propiedades
    if (mysqli_query($conn, $query)) { //Se insertó correctamente
        include("procesar-foto-principal.php");
        include("procesar-fotos-galeria.php");
        $mensaje = "La propiedad se inserto correctamente";
    } else {
        $mensaje = "No se pudo insertar en la BD" . mysqli_error($conn);
    }
}


/******************************************************* */


?>


<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FRSC - ADMIN.</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="estilo.css">
    <script>
        function muestraselect(str) {
            var conexion;

            if (str == "") {
                document.getElementById("ciudad").innerHTML = "";
                return;
            }
            if (window.XMLHttpRequest) {
                conexion = new XMLHttpRequest();
            }

            conexion.onreadystatechange = function() {
                if (conexion.readyState == 4 && conexion.status == 200) {
                    document.getElementById("ciudad").innerHTML = conexion.responseText;
                }
            }

            conexion.open("GET", "ciudad.php?c=" + str, true);
            conexion.send();

        }
    </script>
</head>

<body>
    <?php include("header.php"); ?>

    <div id="contenedor-admin">
        <?php include("contenedor-menu.php"); ?>

        <div class="contenedor-principal">
            <div id="nueva-propiedad">
                <h2>Nueva propiedad</h2>
                <br>
                <hr>
                <br>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" method="post">
                    <div class="fila-una-columna">
                        <label for="titulo">Título de la Propiedad</label>
                        <input type="text" name="titulo" required class="input-entrada-texto" placeholder="Nombre de pila del sitio...">
                    </div>

                    <div class="fila-una-colummna">
                        <label for="descripcion">Descripción de la Propiedad</label>
                        <textarea name="descripcion" id="" cols="30" rows="10" class="input-entrada-texto" placeholder="Descripcion detallada de la propiedad e inventario de la misma..."  style="resize: none;"></textarea>
                    </div>
                    <br>
                    <br>
                    <h2>Datos basicos de la propiedad</h2>
                    <hr>
                    <div class="fila">
                        <div class="box">
                            <label for="tipo">Seleccione tipo de propiedad</label>
                            <select name="tipo" id="" class="input-entrada-texto">
                                <?php while ($row = mysqli_fetch_assoc($resultado_tipos)) : ?>
                                    <option value="<?php echo $row['id'] ?>">
                                        <?php echo $row['nombre_tipo'] ?>
                                    </option>
                                <?php endwhile ?>
                            </select>
                        </div>

                        <div class="box">
                            <label for="estado">Elija estado de la propiedad</label>
                            <select name="estado" id="" class="input-entrada-texto">
                                <option value="Venta">Venta</option>
                                <option value="Proyecto">Proyecto</option>
                            </select>
                        </div>

                        <div class="box">
                            <label for="ubicacion">Direcciòn</label>
                            <input type="text" name="ubicacion" class="input-entrada-texto" placeholder="Ingrese direcciòn">
                        </div>
                    </div>

                    <div class="fila">
                        <div class="box">
                            <label for="habitaciones">Habitaciones</label>
                            <input type="number" name="habitaciones" class="input-entrada-texto" placeholder="Cantidad numérica" min="0" max="9" required>
                        </div>

                        <div class="box">
                            <label for="baños">Baños</label>
                            <input type="number" name="banios" class="input-entrada-texto" placeholder="Cantidad numerica" min="0" max="9" required>
                        </div>

                        <div class="box">
                            <label for="pisos">Pisos</label>
                            <input type="number" name="pisos" class="input-entrada-texto" placeholder="Cantidad numerica" min="0" max="9" required>
                        </div>
                    </div>

                    <div class="fila">
                        <div class="box">
                            <label for="garage">Garage</label>
                            <select name="garage" id="" class="input-entrada-texto">
                                <option value="No">No</option>
                                <option value="Si">Si</option>
                            </select>
                        </div>

                        <div class="box">
                            <label for="dimensiones">Área</label>
                            <input type="text" name="dimensiones" class="input-entrada-texto" placeholder="Área total del predio" maxlength="12">
                        </div>

                        <div class="box">
                            <label for="precio">Precio (Venta)</label>
                            <input type="text" name="precio" class="input-entrada-texto" required placeholder="Precio sin signos de putnuaciòn">
                        </div>
                    </div>

                    <div class="fila">
                        <div class="box">
                            <label for="moneda">Moneda</label>
                            <input type="text" name="moneda" class="input-entrada-texto" required value="$">
                        </div>
                        <div class="box">
                            <label for="ubicacion_url">Url ubicacion</label>
                            <input type="text" name="ubicacion_url" class="input-entrada-texto" required placeholder="Ingrese la url de MAPS de la propiedad">
                        </div>
                    </div>


                    <div>
                        <br>
                        <br>
                        <h2>Servicios del predio</h2>
                        <hr>

                        <div class="fila">
                            <div class="box">
                                <label for="internet">Internet</label>
                                <select name="internet" id="" class="input-entrada-texto">
                                    <option value="No">No</option>
                                    <option value="Si">Si</option>
                                </select>
                            </div>

                            <div class="box">
                                <label for="agua">Agua</label>
                                <select name="agua" id="" class="input-entrada-texto">
                                    <option value="No">No</option>
                                    <option value="Si">Si</option>
                                </select>
                            </div>

                            <div class="box">
                                <label for="gas">Gas</label>
                                <select name="gas" id="" class="input-entrada-texto">
                                    <option value="No">No</option>
                                    <option value="Si">Si</option>
                                </select>
                            </div>
                        </div>
                        <div class="fila">

                            <div class="box">
                                <label for="luz">Luz</label>
                                <select name="luz" id="" class="input-entrada-texto">
                                    <option value="No">No</option>
                                    <option value="Si">Si</option>
                                </select>
                            </div>

                            <div class="box">
                                <label for="clima">Clima</label>
                                <select name="clima" id="" class="input-entrada-texto">
                                    <option value="Cálido (24 °C a 30 °C)">Cálido<br>(24 °C a 30 °C)</option>
                                    <option value="Templado (16 °C a 24 °C)">Templado<br>(16 °C a 24 °C)</option>
                                    <option value="Frío (0 °C a 16 °C)">Frío<br>(0 °C a 16 °C)</option>
                                    <option value="Páramo (0 °C a 10 °C)">Páramo<br>(0 °C a 10 °C)</option>
                                    <option value="Tropical (25 °C a 35 °C)">Tropical<br>(25 °C a 35 °C)</option>

                                </select>
                            </div>

                            <div class="box">
                                <label for="documentos_transferencia">Documentos de transferencia</label>
                                <select name="documentos_transferencia" id="" class="input-entrada-texto">
                                    <option value="Escritura pública">Escritura pública</option>
                                    <option value="Promesa de compraventa">Promesa de compraventa</option>
                                    <option value="Certificado de libertad y tradición">Certificado de libertad y tradición</option>
                                    <option value="Recibo de pago de impuestos">Recibo de pago de impuestos</option>
                                    <option value="Documento de identidad">Documento de identidad</option>
                                    <option value="Autorizaciones">Autorizaciones</option>
                                    <option value="Declaración de impuestos de ganancia ocasional">Declaración de impuestos de ganancia ocasional</option>
                                </select>
                            </div>
                        </div>

                        <br>
                        <br>
                        <h2>Galería de fotos</h2>
                        <hr>

                        <label for="foto1" class="btn-fotos">Foto Principal</label>
                        <output id="list" class="contenedor-foto-principal">
                            <img src="<?php echo $propiedad['url_foto_principal'] ?>" alt="">
                        </output>
                        <input type="file" id="foto1" accept="image/*" name="foto1" style="display:none">
                    </div>

                    <div>
                        <label for="fotos" class="btn-fotos"> Galería de Fotos </label>

                        <div id="contenedor-fotos-publicacion">

                        </div>


                        <input type="file" id="fotos" accept="image/*" name="fotos[]" value="Foto" multiple="" required style="display:none">
                    </div>

                    <br>
                    <br>
                    <h2>Video y Recorrido 360º</h2>
                    <hr>
                    <div>
                        <label for="video_url">Video del predio</label>
                        <input class="input-entrada-texto" type="text" name="video_url" id="video_url" placeholder="Ingrese URL del video de YouTube" required>
                        <div id="videoPreview"></div> <!-- Contenedor para la vista previa -->
                    </div>
                    <br>
                    <br>
                    <div>
                        <label for="recorrido_360_url">Recorrido 360°</label>
                        <input class="input-entrada-texto" type="text" name="recorrido_360_url" id="recorrido_360_url" placeholder="Ingrese URL del recorrido 360" required>
                        <div id="recorridoPreview"></div> <!-- Mantenemos la vista previa -->
                    </div>
                    <br>
                    <br>
                    <h2>Ubicación y datos del Propietario</h2>
                    <hr>
                    <div class="fila">
                        <div class="box">
                            <label for="pais">Seleccione País de la Propiedad</label>
                            <select name="pais" id="" onchange="muestraselect(this.value)" class="input-entrada-texto">
                                <option value="">Seleccione pais</option>
                                <?php while ($row = mysqli_fetch_assoc($resultado_paises)) : ?>
                                    <option value="<?php echo $row['id'] ?>">
                                        <?php echo $row['nombre_pais'] ?>
                                    </option>
                                <?php endwhile ?>
                            </select>
                        </div>
                        <div class="box">
                            <label for="ciudad">Seleccione una ciudad</label>
                            <select name="ciudad" id="ciudad" class="input-entrada-texto">

                            </select>
                        </div>

                        <div class="box">
                            <label for="propietario">Nombre del propietario</label>
                            <input type="text" name="nombre_propietario" class="input-entrada-texto" placeholder="Nombres y apellidos">
                        </div>

                    </div>
                    <div class="fila">
                        <div class="box">
                            <label for="id">Cédula</label>
                            <input type="text" name="id" class="input-entrada-texto" placeholder="Cédula de propietario" pattern="^\d{10}$" maxlength="10" minlength="10" required>
                        </div>

                        <div class="box">
                            <label for="telefono_propietario">Teléfono del propietario</label>
                            <input type="text" name="telefono_propietario" class="input-entrada-texto" placeholder="Telefono celular" pattern="^\d{10}$" maxlength="10" minlength="10" required>
                        </div>

                        <div class="box">
                            <label for="permuta">¿Permuta?</label>
                            <select name="permuta" id="" class="input-entrada-texto">
                                <option value="No">No</option>
                                <option value="Si">Si</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <input type="submit" value="Agregar Propiedad" name="agregar" class="btn-accion">

                </form>

            </div>
        </div>
    </div>

    <?php if (isset($_POST['agregar'])) : ?>
        <script>
            alert("<?php echo $mensaje ?>");
            window.location.href = 'index.php';
        </script>
    <?php endif ?>

    <script>
        $('#link-add-propiedad').addClass('pagina-activa');
    </script>

    <script src="subirfoto.js"></script>
    <script src="scriptFotos.js"></script>
    <script src="subir_v_r.js"></script>
    <script src="vista_recorrido_video.js"></script>
</body>

</html>