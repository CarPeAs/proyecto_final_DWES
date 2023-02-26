-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-02-2023 a las 18:41:31
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(100) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `rol` varchar(20) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `nombre`, `clave`, `rol`, `estatus`) VALUES
(1, 'admin', '6216F8A75FD5BB3D5F22B6F9958CDEDE3FC086C2', 'admin', 1),
(2, 'admin2', '1c6637a8f2e1f75e06ff9984894d6bd16a3a36a9', 'admin', 1),
(3, 'empleado1', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', 'editor', 1),
(4, 'jose', '9a3e61b6bcc8abec08f195526c3132d5a4a98cc0', 'admin', 1),
(5, 'Elena', 'cfa1150f1787186742a9a884b73a43d8cf219f9b', 'admin', 0),
(6, 'empleado2', '1c6637a8f2e1f75e06ff9984894d6bd16a3a36a9', 'editor', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id` int(100) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `precio` int(100) NOT NULL,
  `imagen_01` varchar(50) NOT NULL,
  `imagen_02` varchar(50) NOT NULL,
  `imagen_03` varchar(50) NOT NULL,
  `disponible` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id`, `nombre`, `descripcion`, `precio`, `imagen_01`, `imagen_02`, `imagen_03`, `disponible`) VALUES
(2, 'TV Samsung LED 75&#34; ', 'Smart TV, HDR10+, Tizen, Dolby Digital Plus, Titan', 789, 'tvSam1.png', 'tvSam2.png', 'tvSam3.png', 1),
(5, 'Portátil - HP Laptop', '15.6&#34; Full-HD, Intel', 350, 'laptop1.png', 'laptop2.png', 'laptop3.png', 1),
(6, 'Smartwatch - Samsung', 'Exynos W920, 16 GB', 189, 'reloj-samsung1.png', 'reloj-samsung2.png', 'reloj-samsung2.png', 1),
(7, 'Frigorífico combi', 'No Frost, 204 cm, Metalizado', 815, 'frigo-bosch1.png', 'frigo-bosch2.png', 'frigo-bosch3.png', 1),
(8, 'Apple iPhone 13 Smartphone', 'Blanco estrella, 128 GB, iOS', 839, 'smartphone-apple1.png', 'smartphone-apple2.png', 'smartphone-apple3.png', 0),
(9, 'Lavadora carga frontal', 'Samsung 8 kg, 1200 rpm, 14 Programas, Blanco', 369, 'lav-1.png', 'lav-2.png', 'lav-3.png', 1),
(10, 'Ratón inalámbrico', 'Hama Vertical, 6 botones, Negro', 24, 'mouse-1.png', '3mouse-2.png', 'mouse-2.png', 1),
(11, 'Cámara EVIL', 'SONY, 24,2 megapixel, 7,5 cm, Negro', 1494, 'cam-1.png', 'cam-2.png', 'cam-3.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cesta`
--

CREATE TABLE `cesta` (
  `id` int(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `precio` int(100) NOT NULL,
  `cantidad` int(100) NOT NULL,
  `id_usuario` int(100) NOT NULL,
  `id_producto` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mensaje` varchar(200) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `id_usuario` int(100) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `borrado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `email`, `mensaje`, `numero`, `id_usuario`, `nombre`, `borrado`) VALUES
(4, 'pedro@hotmail.com', 'ddd', '4444', 0, 'Pedro', 1),
(5, 'primero@yahoo.com', 'ddd', '444', 0, 'juan', 0),
(7, 'pedro@hotmail.com', 'ddd', '55', 0, 'Pedro', 1),
(8, 'primero@yahoocom', 'ddd', '444', 0, 'juan', 0),
(9, 'daniela@gmail.com', 'ddd', '4444', 1, 'Pedro', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `metodo_pago` varchar(20) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `estatus_pago` varchar(20) NOT NULL DEFAULT 'pendiente',
  `fecha_pedido` date NOT NULL DEFAULT current_timestamp(),
  `precio_total` int(100) NOT NULL,
  `total_articulos` varchar(100) NOT NULL,
  `id_usuario` int(100) NOT NULL,
  `historial` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `nombre`, `direccion`, `email`, `metodo_pago`, `numero`, `estatus_pago`, `fecha_pedido`, `precio_total`, `total_articulos`, `id_usuario`, `historial`) VALUES
(1, 'Pedro', 'calle, dd, elche, Alicante, españa - 03206', 'pedro@hotmail.com', '', '5667788', 'completado', '2023-02-24', 1954, '<br />\r\n<b>Warning</b>:  Undefined variable $total_productos in <b>C:\\xampp\\htdocs\\xampp\\practicasPH', 7, 1),
(2, 'Pedro', 'calle, dd, elche, Alicante, españa - 03206', 'pedro@hotmail.com', '', '5667788', 'completado', '2023-02-24', 1954, '<br />\r\n<b>Warning</b>:  Undefined variable $total_productos in <b>C:\\xampp\\htdocs\\xampp\\practicasPH', 7, 1),
(3, 'Pedro', 'calle, dd, elche, Alicante, españa - 03205', 'primero@yahoo.com', '', '5667788', 'completado', '2023-02-24', 1954, '<br />\r\n<b>Warning</b>:  Undefined variable $total_productos in <b>C:\\xampp\\htdocs\\xampp\\practicasPH', 7, 1),
(4, 'admin', 'calle, dd, elche, Alicante, españa - 03209', 'primero@yahoo.com', 'pago contra reembols', '5667788', 'completado', '2023-02-24', 1954, '<br />\r\n<b>Warning</b>:  Undefined variable $total_productos in <b>C:\\xampp\\htdocs\\xampp\\practicasPH', 7, 1),
(5, 'ddd', 'fff, fff, fff, fff, fff - 03206', 'pedro1@hotmail.com', 'tarjeta de credito', '6666', 'pendiente', '2023-02-25', 1954, 'Portátil - HP Laptop (350 x 1) - TV Samsung LED 75\"  (789 x 1) - Frigorífico combi (815 x 1) - ', 7, 0),
(6, 'juan', 'ddd, dd, dd, dd, dd - 03205', 'primero@yahoo.com', 'pago contra reembols', '4444', 'completado', '2023-02-25', 0, '728', 7, 1),
(7, 'prueba', 'dd, dd, dd, dd, españa - 03205', 'prueba@gmail.com', 'pago contra reembols', '666', 'completado', '2023-02-25', 0, '1578', 7, 1),
(8, 'ddd', 'calle, dd, elche, Alicante, españa - 03205', 'primero@yahoocom', 'tarjeta de credito', '5667788', 'completado', '2023-02-25', 350, 'Portátil - HP Laptop (350 x 1) - ', 7, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(100) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `clave`, `estatus`) VALUES
(1, 'carlos', 'user@gmail.com', 'b3daa77b4c04a9551b8781d03191fe098f325e67', 1),
(2, 'usuario prueba', 'user2@gmail.com', '1c6637a8f2e1f75e06ff9984894d6bd16a3a36a9', 1),
(3, 'usuario3', 'user3@gmail.com', '43814346e21444aaf4f70841bf7ed5ae93f55a9d', 0),
(4, 'usuario 4', 'user4@yahoo.com', '06e6eef6adf2e5f54ea6c43c376d6d36605f810e', 0),
(6, 'Alejandro', 'alejo@gmail.com', '43814346e21444aaf4f70841bf7ed5ae93f55a9d', 1),
(7, 'vanessa', 'vanessa@gmail.com', 'fc7a734dba518f032608dfeb04f4eeb79f025aa7', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cesta`
--
ALTER TABLE `cesta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`,`id_producto`),
  ADD KEY `FK_CESTA_PEDIDOS` (`id_producto`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `cesta`
--
ALTER TABLE `cesta`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
