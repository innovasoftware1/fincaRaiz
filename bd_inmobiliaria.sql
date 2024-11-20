-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 20-11-2024 a las 23:06:19
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_inmobiliaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `id` int(11) NOT NULL,
  `id_pais` int(11) NOT NULL,
  `nombre_ciudad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`id`, `id_pais`, `nombre_ciudad`) VALUES
(1, 1, 'Bogotá'),
(2, 2, 'Medellín'),
(3, 2, 'Bello'),
(4, 2, 'Itagüí'),
(5, 3, 'Cali'),
(6, 3, 'Palmira'),
(7, 3, 'Buenaventura'),
(8, 4, 'Barranquilla'),
(9, 4, 'Soledad'),
(10, 4, 'Malambo'),
(11, 5, 'Soacha'),
(12, 5, 'Zipaquirá'),
(13, 5, 'Girardot'),
(14, 6, 'Bucaramanga'),
(15, 6, 'Floridablanca'),
(16, 6, 'Piedecuesta'),
(17, 7, 'Cartagena'),
(18, 7, 'Magangué'),
(19, 7, 'Turbaco');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `propiedad1` int(11) DEFAULT NULL,
  `propiedad2` int(11) DEFAULT NULL,
  `propiedad3` int(11) DEFAULT NULL,
  `propiedad4` int(11) DEFAULT NULL,
  `propiedad5` int(11) DEFAULT NULL,
  `propiedad6` int(11) DEFAULT NULL,
  `oficina_central` varchar(400) DEFAULT NULL,
  `telefono1` varchar(100) DEFAULT NULL,
  `telefono2` varchar(100) DEFAULT NULL,
  `email_contacto` varchar(100) DEFAULT NULL,
  `horarios` varchar(200) DEFAULT NULL,
  `mapa` varchar(300) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `twitter` varchar(200) DEFAULT NULL,
  `tipo_visualizacion_propiedades` varchar(1) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `email_administrador` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `propiedad1`, `propiedad2`, `propiedad3`, `propiedad4`, `propiedad5`, `propiedad6`, `oficina_central`, `telefono1`, `telefono2`, `email_contacto`, `horarios`, `mapa`, `facebook`, `twitter`, `tipo_visualizacion_propiedades`, `user`, `password`, `email_administrador`) VALUES
(1, 2147483647, 2147483647, 2147483647, 2147483647, 2147483647, 2147483647, 'Carrera 25A # 10-60, Bogotà', '(+57) 3102499843', '(+57) 3202005197', 'supata@fincaraizsincomisiones.com', 'Domingo a Domingo de 7:00am a 6:00pm', 'mapa', 'https://www.facebook.com/InnovaPublicidadVisualSAS', 'https://x.com/i/flow/login?redirect_after_login=%2Finnovapvisual', 'p', 'Feldman Rodriguez', '123456', 'gerencia@innovapublicidad.com.co');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `id` int(11) NOT NULL,
  `id_propiedad` varchar(25) NOT NULL,
  `nombre_foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fotos`
--

INSERT INTO `fotos` (`id`, `id_propiedad`, `nombre_foto`) VALUES
(118, '2222222222', 'ad197ff62e8db609ad84d974b584ba682da897eb.jpg'),
(119, '2222222222', 'f3662dd56034a46ddbd5b16a23c6b6873a06bf53.jpg'),
(120, '2222222222', '8a8f3883b7560d0936d67a9954615f42c4af41b8.jpg'),
(121, '2222222222', 'dfaa99408daedf162405fdecedbc8e9497c71888.jpg'),
(122, '3333333333', 'aaeee7302ae9007b117f5cb1965e3d2dae0077f5.jpg'),
(123, '3333333333', 'ad197ff62e8db609ad84d974b584ba682da897eb.jpg'),
(124, '3333333333', 'b62d88c3fb84a8a6d7f1586bba1754c6827b831d.jpg'),
(125, '3333333333', '8a8f3883b7560d0936d67a9954615f42c4af41b8.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `id` int(11) NOT NULL,
  `nombre_pais` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id`, `nombre_pais`) VALUES
(1, 'Bogotá D.C.'),
(2, 'Antioquia'),
(3, 'Valle del Cauca'),
(4, 'Atlántico'),
(5, 'Cundinamarca'),
(6, 'Santander'),
(7, 'Bolívar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `nombre_permiso` varchar(100) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `nombre_permiso`, `descripcion`) VALUES
(1, 'crear_propiedad', 'Permiso para crear nuevas propiedades'),
(2, 'editar_propiedad', 'Permiso para editar propiedades existentes'),
(3, 'ver_propiedad', 'Permiso para ver propiedades en el portal'),
(4, 'gestionar_usuarios', 'Permiso para gestionar usuarios y roles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades`
--

CREATE TABLE `propiedades` (
  `id` varchar(20) NOT NULL,
  `fecha_alta` date NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `tipo` int(11) NOT NULL,
  `estado` varchar(15) NOT NULL,
  `ubicacion` varchar(200) NOT NULL,
  `habitaciones` varchar(2) NOT NULL,
  `banios` varchar(2) NOT NULL,
  `pisos` varchar(1) NOT NULL,
  `garage` varchar(2) NOT NULL,
  `dimensiones` varchar(50) NOT NULL,
  `precio` int(11) NOT NULL,
  `moneda` varchar(5) NOT NULL,
  `url_foto_principal` varchar(200) NOT NULL,
  `pais` int(11) NOT NULL,
  `ciudad` int(11) NOT NULL,
  `propietario` varchar(100) NOT NULL,
  `telefono_propietario` varchar(50) NOT NULL,
  `agua` varchar(2) DEFAULT NULL,
  `luz` varchar(2) DEFAULT NULL,
  `gas` varchar(2) DEFAULT NULL,
  `internet` varchar(2) DEFAULT NULL,
  `clima` varchar(300) DEFAULT NULL,
  `documentos_transferencia` varchar(300) DEFAULT NULL,
  `video_url` text DEFAULT NULL,
  `recorrido_360_url` varchar(300) DEFAULT NULL,
  `permuta` varchar(2) NOT NULL,
  `ubicacion_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `propiedades`
--

INSERT INTO `propiedades` (`id`, `fecha_alta`, `titulo`, `descripcion`, `tipo`, `estado`, `ubicacion`, `habitaciones`, `banios`, `pisos`, `garage`, `dimensiones`, `precio`, `moneda`, `url_foto_principal`, `pais`, `ciudad`, `propietario`, `telefono_propietario`, `agua`, `luz`, `gas`, `internet`, `clima`, `documentos_transferencia`, `video_url`, `recorrido_360_url`, `permuta`, `ubicacion_url`) VALUES
('2222222222', '2024-11-14', 'Finca de Dios', 'Finca de Dios es un lugar sagrado, rodeado de montañas y campos verdes donde el cielo parece tocar la tierra. En sus tierras crecen frutas y flores que nunca marchitan, y el aire está impregnado de una paz celestial. Los ríos fluyen con aguas cristalinas, y cada rincón de la finca resplandece con una luz suave y dorada. Los habitantes, humildes y sabios, viven en armonía con la naturaleza, cuidando cada ser vivo como un hermano. Es un refugio de calma y espiritualidad, un santuario donde se sienten las bendiciones divinas. Aquí, el tiempo parece detenerse, y todo lo que toca el alma encuentra su propósito.', 4, 'venta', 'Km. 14, vía Grande', '4', '2', '1', 'Si', '10 Hectareas', 210000000, '$', 'fotos/2222222222/finca10.jpg', 1, 1, 'QQQQQQQ', '3216584747', 'Si', 'Si', 'Si', 'No', 'Cálido (24 °C a 30 °C)', 'Escritura pública', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/7l5SkwfCXUw?si=XMosbLi9YISDgFl3\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 'https://salasdeventas.com/vikalanding2//', 'No', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31814.189459751513!2d-74.4787061553955!3d4.634420977514907!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f6de22e174619%3A0x36dd14291f41e841!2sBanco%20Contactar%20-%20La%20Mesa%2C%20Cundinamarca!5e0!3m2!1ses!2sco!4v1730821778447!5m2!1ses!2sco\" width=\"100%\"      height=\"100%\"      style=\"border:0; border-radius: 20px; max-width: 600px; max-height: 500px; margin-top: 20px; box-sizing: border-box;\"  allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
('3333333333', '2024-11-14', 'Finca la arrocera', 'WWWWWWWWWWWWWWWWWWWWWW', 2, 'venta', 'Calle 135 # 143- 13', '3', '3', '3', 'No', '12mts x 24mts', 128500000, '$', 'fotos/3333333333/nombre6.jpg', 5, 12, 'DDDDDDDDD', '3118285872', 'No', 'No', 'No', 'No', 'Cálido (24 °C a 30 °C)', 'Escritura pública', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/7l5SkwfCXUw?si=XMosbLi9YISDgFl3\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 'https://salasdeventas.com/vikalanding2//', 'No', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63665.33868870668!2d-74.7050229932351!3d4.203901019642354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3edf334ff57def%3A0x7b0652fd489bdd0!2sPiscilago%20%7C%20Parque%20Acu%C3%A1tico%20y%20%C3%81rea%20de%20Conservaci%C3%B3n!5e0!3m2!1ses!2sco!4v1731941442502!5m2!1ses!2sco\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre_rol`, `descripcion`) VALUES
(1, 'administrador', 'Rol con todos los permisos: administrar propiedades, usuarios, configuraciones, etc.'),
(2, 'moderador', 'Rol con permisos limitados: puede crear y editar propiedades, pero no gestionar usuarios o configuraciones.'),
(3, 'usuario', 'Rol para usuarios comunes, con acceso restringido a ver propiedades y realizar acciones limitadas.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_permisos`
--

CREATE TABLE `roles_permisos` (
  `id_rol` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles_permisos`
--

INSERT INTO `roles_permisos` (`id_rol`, `id_permiso`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `id` int(11) NOT NULL,
  `nombre_tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`id`, `nombre_tipo`) VALUES
(1, 'Casa'),
(2, 'Apartamento'),
(3, 'Apartaestudio'),
(4, 'Cabaña'),
(5, 'Casa Campestre'),
(6, 'Casa Lote Finca'),
(11, 'cambuches');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` varchar(25) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `usuario`, `password`, `rol_id`, `fecha_creacion`) VALUES
('1014274668', 'Sergio Pinzon', 'sergio@gmail.com', 'sergpinz68', '101010', 2, '2024-11-14 10:34:55'),
('admin123456', 'Feldan D. Rodriguez', 'admininnova@example.com', 'Admin10.', '123456', 1, '2024-11-12 11:06:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_permisos`
--

CREATE TABLE `usuarios_permisos` (
  `id_usuario` varchar(25) NOT NULL,
  `id_permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios_permisos`
--

INSERT INTO `usuarios_permisos` (`id_usuario`, `id_permiso`) VALUES
('admin123456', 1),
('admin123456', 2),
('admin123456', 3),
('admin123456', 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles_permisos`
--
ALTER TABLE `roles_permisos`
  ADD PRIMARY KEY (`id_rol`,`id_permiso`),
  ADD KEY `id_permiso` (`id_permiso`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indices de la tabla `usuarios_permisos`
--
ALTER TABLE `usuarios_permisos`
  ADD PRIMARY KEY (`id_usuario`,`id_permiso`),
  ADD KEY `id_permiso` (`id_permiso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `roles_permisos`
--
ALTER TABLE `roles_permisos`
  ADD CONSTRAINT `roles_permisos_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `roles_permisos_ibfk_2` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios_permisos`
--
ALTER TABLE `usuarios_permisos`
  ADD CONSTRAINT `usuarios_permisos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_permisos_ibfk_2` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
