-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-06-2023 a las 21:22:14
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
(2, 'carne de res', 'carne de res', 26, 'carnes_res.png', 'carnes_res.png', 'carnes_res.png', 1),
(5, 'carne de cerdo', 'carne de cerdo', 12, 'puerco.png', 'puerco.png', 'puerco.png', 1),
(6, 'pan de molde', 'pan de molde integral', 3, 'pan_molde.png', 'pan_molde.png', 'pan_molde.png', 1),
(7, 'pan artesanal', 'Pan artesanal de masa madre', 2, 'pan_artesano.png', 'pan_artesano.png', 'pan_artesano.png', 1),
(8, 'Salmón - pescado', 'Salmón ', 27, 'pescado_salmon.png', 'pescado_salmon.png', 'pescado_salmon.png', 0),
(9, 'mango - fruta', 'Mango', 5, 'mango.png', 'mango.png', 'mango.png', 1),
(10, 'lejía - limpieza', 'Lejía', 4, 'lejia.png', 'lejia.png', 'lejia.png', 1),
(11, 'zanahoria - verduras', 'zanahoria', 3, 'zanahorias.png', 'zanahorias.png', 'zanahorias.png', 1);

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

--
-- Volcado de datos para la tabla `cesta`
--

INSERT INTO `cesta` (`id`, `nombre`, `imagen`, `precio`, `cantidad`, `id_usuario`, `id_producto`) VALUES
(86, 'TV Samsung LED 75&#34; ', 'tvSam1.png', 789, 1, 1, 2);

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
(5, 'ddd', 'fff, fff, fff, fff, fff - 03206', 'pedro1@hotmail.com', 'tarjeta de credito', '6666', 'pendiente', '2023-02-25', 1954, 'Portátil - HP Laptop (350 x 1) - TV Samsung LED 75\"  (789 x 1) - Frigorífico combi (815 x 1) - ', 7, 1),
(6, 'juan', 'ddd, dd, dd, dd, dd - 03205', 'primero@yahoo.com', 'pago contra reembols', '4444', 'completado', '2023-02-25', 0, '728', 7, 1),
(7, 'prueba', 'dd, dd, dd, dd, españa - 03205', 'prueba@gmail.com', 'pago contra reembols', '666', 'completado', '2023-02-25', 0, '1578', 7, 1),
(8, 'ddd', 'calle, dd, elche, Alicante, españa - 03205', 'primero@yahoocom', 'tarjeta de credito', '5667788', 'completado', '2023-02-25', 350, 'Portátil - HP Laptop (350 x 1) - ', 7, 1),
(9, 'Carlos', 'planta baja, carrer, elche, alicante, españa - 032', 'user1@gmail.com', 'tarjeta de credito', '666555777', 'pendiente', '2023-06-06', 350, 'Portátil - HP Laptop (350 x 1) - ', 1, 1),
(10, 'Carlos', 'calle, carrer, elche, alicante, españa - 03206', 'user1@gmail.com', 'tarjeta de credito', '444555666', 'pendiente', '2023-06-06', 189, 'Smartwatch - Samsung (189 x 1) - ', 1, 1),
(11, 'Carlos', 'planta baja, dd, elche, alicante, españa - 03206', 'astorkiza08@gmail.com', 'pago contra reembols', '5667788', 'pendiente', '2023-06-06', 350, 'Portátil - HP Laptop (350 x 1) - ', 8, 1),
(12, 'Carlos', 'planta baja, calle 124, elche, Alicante, españa - ', 'astorkiza08@gmail.com', 'pago contra reembols', '5667788', 'pendiente', '2023-06-06', 189, 'Smartwatch - Samsung (189 x 1) - ', 8, 1),
(13, 'Pedro', 'planta baja, dd, elche, Alicante, españa - 03206', 'astorkiza08@gmail.com', 'pago contra reembols', '5667788', 'pendiente', '2023-06-06', 189, 'Smartwatch - Samsung (189 x 1) - ', 8, 1),
(14, 'Pedro', 'planta baja, dd, elche, Alicante, españa - 03206', 'astorkiza08@gmail.com', 'pago contra reembols', '5667788', 'pendiente', '2023-06-06', 350, 'Portátil - HP Laptop (350 x 1) - ', 8, 1),
(15, 'Pedro', 'planta baja, dd, elche, Alicante, españa - 03206', 'astorkiza08@gmail.com', 'pago contra reembols', '5667788', 'pendiente', '2023-06-06', 350, 'Portátil - HP Laptop (350 x 1) - ', 8, 1),
(16, 'Carlos', 'apa, accs, elche, alicante, españa - 3205', 'astorkiza08@gmail.com', 'pago contra reembols', '666777888', 'pendiente', '2023-06-06', 350, 'Portátil - HP Laptop (350 x 1) - ', 1, 1),
(17, 'Pedro', 'gg, dd, elche, dd, fff - 03206', 'astorkiza08@gmail.com', 'pago contra reembols', '5667788', 'pendiente', '2023-06-06', 789, 'TV Samsung LED 75\"  (789 x 1) - ', 8, 1),
(18, 'Pedro', 'planta baja, dd, elche, dd, españa - 03206', 'astorkiza08@gmail.com', 'tarjeta de credito', '5667788', 'pendiente', '2023-06-06', 24, 'Ratón inalámbrico (24 x 1) - ', 8, 1),
(19, 'Pedro', 'planta baja, dd, elche, Alicante, españa - 03206', 'astorkiza08@gmail.com', 'tarjeta de credito', '5667788', 'pendiente', '2023-06-06', 350, 'Portátil - HP Laptop (350 x 1) - ', 9, 1),
(20, 'Pedro', 'planta baja, dd, elche, Alicante, españa - 03206', 'astorkiza08@gmail.com', 'pago contra reembols', '5667788', 'pendiente', '2023-06-07', 978, 'Smartwatch - Samsung (189 x 1) - ', 9, 1),
(21, 'Juan', 'planta baja, dd, elche, Alicante, españa - 03290', 'astorkiza08@gmail.com', 'pago contra reembols', '999888666', 'pendiente', '2023-06-07', 1139, 'TV Samsung LED 75\"  (789 x 1) - ', 9, 1),
(22, 'Rosa', 'planta baja, dd, elche, Alicante, españa - 03206', 'astorkiza08@gmail.com', 'pago contra reembols', '5667788', 'pendiente', '2023-06-07', 539, 'Smartwatch - Samsung (189 x 1) - ', 1, 1),
(23, 'Jose', 'planta baja, dd, elche, Alicante, españa - 03290', 'astorkiza08@gmail.com', 'pago contra reembols', '5667788', 'pendiente', '2023-06-07', 1844, 'Portátil - HP Laptop (350 x 1) - ', 8, 1),
(24, 'User2', 'planta baja, dd, elche, Alicante, españa - 03590', 'astorkiza08@gmail.com', 'pago contra reembols', '5667788', 'pendiente', '2023-06-07', 350, 'Portátil - HP Laptop (350 x 1) - ', 2, 1),
(25, 'Pedro', 'planta baja, dd, elche, Alicante, españa - 03495', 'astorkiza08@gmail.com', 'pago contra reembols', '5667788', 'pendiente', '2023-06-07', 350, 'Portátil - HP Laptop (350 x 1) - ', 2, 1),
(26, 'Alejandro', 'planta baja, dd, elche, alicante, españa - 03206', 'astorkiza08@gmail.com', 'pago contra reembols', '5667788', 'pendiente', '2023-06-07', 350, 'Portátil - HP Laptop (350 x 1) - ', 6, 1),
(27, 'Pedro', 'planta baja, dd, elche, Alicante, españa - 03206', 'astorkiza08@gmail.com', 'pago contra reembols', '5667788', 'pendiente', '2023-06-07', 350, 'Portátil - HP Laptop (350 x 1) - ', 6, 1),
(28, 'Pedro', 'planta baja, dd, elche, Alicante, españa - 03207', 'astorkiza08@gmail.com', 'pago contra reembols', '5667788', 'pendiente', '2023-06-07', 350, 'Portátil - HP Laptop (350 x 1) - ', 6, 1),
(29, 'Pedro', 'planta baja, dd, elche, Alicante, españa - 03206', 'astorkiza08@gmail.com', 'pago contra reembols', '5667788', 'pendiente', '2023-06-07', 1376, 'Ratón inalámbrico (24 x 2) - ', 6, 1),
(30, 'Martin', 'planta baja, calle 124, elche, alicante, españa - ', 'astorkiza08@gmail.com', 'pago contra reembols', '5667788', 'pendiente', '2023-06-07', 1188, 'Lavadora carga frontal (369 x 2) - ', 6, 1),
(31, 'Pedro', 'planta baja, calle 124, elche, alicante, españa - ', 'astorkiza08@gmail.com', 'pago contra reembols', '5667788', 'pendiente', '2023-06-07', 1239, 'Ratón inalámbrico (24 x 3) - ', 6, 1),
(32, 'Pedro', 'planta baja, calle 124, elche, alicante, españa - ', 'astorkiza08@gmail.com', 'pago contra reembols', '5667788', 'pendiente', '2023-06-07', 450, 'Ratón inalámbrico (24 x 3) - ', 6, 1),
(33, 'Rocio', 'planta baja, calle 128, campello, alicante, españa', 'astorkiza08@gmail.com', 'pago contra reembols', '5667788', 'pendiente', '2023-06-07', 615, 'Ratón inalámbrico (24 x 2) - ', 6, 1),
(34, 'Pedro', 'planta baja, dd, elche, alicante, españa - 02394', 'astorkiza08@gmail.com', 'tarjeta de credito', '5667788', 'pendiente', '2023-06-08', 24, 'Ratón inalámbrico (24 x 1) - ', 6, 1),
(35, 'Fernando', 'planta baja, dd, elche, Alicante, españa - 03496', 'astorkiza08@gmail.com', 'tarjeta de credito', '5667788', 'pendiente', '2023-06-08', 539, 'Smartwatch - Samsung (189 x 1) - ', 6, 1),
(36, 'Josefina', 'planta baja, dd, elche, alicante, españa - 04596', 'astorkiza08@gmail.com', 'tarjeta de credito', '66667778', 'pendiente', '2023-06-08', 2283, 'TV Samsung LED 75\"  (789 x 1) -  - Cámara EVIL (1494 x 1) -  - ', 6, 1),
(37, 'Carlos', 'planta baja, carrer, elche, alicante, españa - 032', 'astorkiza08@gmail.com', 'tarjeta de credito', '666777888', 'pendiente', '2023-06-09', 374, 'a:2:{i:0;a:3:{s:6:', 1, 1),
(38, 'Carlos', 'planta baja, carrera, elche, alicante, españa - 03', 'astorkiza08@gmail.com', 'tarjeta de credito', '678678689', 'pendiente', '2023-06-10', 350, 's:34:', 1, 1),
(39, 'Carlos 2', 'entresuelo, calle primera, elche, alicante, españa', 'astorkiza08@gmail.com', 'paypal', '678679687', 'pendiente', '2023-06-10', 1494, 'Cámara EVIL (1494 x 1) - ', 1, 1),
(40, 'Prueba', 'calle, carrer, campello, alicante, españa - 03020', 'astorkiza08@gmail.com', 'tarjeta de credito', '888999666', 'pendiente', '2023-06-13', 350, 'Portátil - HP Laptop (350 x 1) - ', 1, 1);

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
(2, 'usuario prueba', 'user2@gmail.com', 'a1881c06eec96db9901c7bbfe41c42a3f08e9cb4', 1),
(3, 'usuario3', 'user3@gmail.com', '43814346e21444aaf4f70841bf7ed5ae93f55a9d', 0),
(4, 'usuario 4', 'user4@yahoo.com', '06e6eef6adf2e5f54ea6c43c376d6d36605f810e', 0),
(6, 'Alejandro', 'user6@gmail.com', '312a46dc52117efa4e3096eda510370f01c83b27', 1),
(7, 'vanessa', 'vanessa@gmail.com', 'fc7a734dba518f032608dfeb04f4eeb79f025aa7', 1),
(8, 'Carlos', 'astorkiza08@gmail.com', 'b3daa77b4c04a9551b8781d03191fe098f325e67', 1),
(9, 'Pedro', 'user9@gmail.com', '86f28434210631fa6bda6db990aba7391f512774', 1);

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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
