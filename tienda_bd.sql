-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-02-2023 a las 09:05:17
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
  `rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `nombre`, `clave`, `rol`) VALUES
(1, 'admin', '6216F8A75FD5BB3D5F22B6F9958CDEDE3FC086C2', 'admin'),
(2, 'admin2', '1c6637a8f2e1f75e06ff9984894d6bd16a3a36a9', 'admin'),
(3, 'admin3', '9a3e61b6bcc8abec08f195526c3132d5a4a98cc0', 'editor');

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
  `imagen_03` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id`, `nombre`, `descripcion`, `precio`, `imagen_01`, `imagen_02`, `imagen_03`) VALUES
(2, 'TV Samsung LED 75&#34; ', 'Smart TV, HDR10+, Tizen, Dolby Digital Plus, Titan', 789, 'tvSam1.png', 'tvSam2.png', 'tvSam3.png'),
(5, 'Portátil - HP Laptop', '15.6&#34; Full-HD, Intel', 329, 'laptop1.png', 'laptop2.png', 'laptop3.png'),
(6, 'Smartwatch - Samsung', 'Exynos W920, 16 GB', 189, 'reloj-samsung1.png', 'reloj-samsung2.png', 'reloj-samsung2.png'),
(7, 'Frigorífico combi', 'No Frost, 204 cm, Metalizado', 815, 'frigo-bosch1.png', 'frigo-bosch2.png', 'frigo-bosch3.png'),
(8, 'Apple iPhone 13 Smartphone', 'Blanco estrella, 128 GB, iOS', 819, 'smartphone-apple1.png', 'smartphone-apple2.png', 'smartphone-apple3.png');

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
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `email`, `mensaje`, `numero`, `id_usuario`, `nombre`) VALUES
(4, 'pedro@hotmail.com', 'ddd', '4444', 0, 'Pedro'),
(5, 'primero@yahoo.com', 'ddd', '444', 0, 'juan'),
(7, 'pedro@hotmail.com', 'ddd', '55', 0, 'Pedro'),
(8, 'primero@yahoocom', 'ddd', '444', 0, 'juan'),
(9, 'daniela@gmail.com', 'ddd', '4444', 1, 'Pedro');

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
  `id_usuario` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(100) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `clave`) VALUES
(1, 'carlos', 'user@gmail.com', 'a1881c06eec96db9901c7bbfe41c42a3f08e9cb4'),
(2, 'usuario 2', 'user2@gmail.com', 'a1881c06eec96db9901c7bbfe41c42a3f08e9cb4'),
(3, 'usuario3', 'user3@gmail.com', '0b7f849446d3383546d15a480966084442cd2193'),
(4, 'usuario 4', 'user4@yahoo.com', '06e6eef6adf2e5f54ea6c43c376d6d36605f810e'),
(5, 'Francisco', 'fran@gmail.com', '7d112681b8dd80723871a87ff506286613fa9cf6');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `cesta`
--
ALTER TABLE `cesta`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cesta`
--
ALTER TABLE `cesta`
  ADD CONSTRAINT `FK_CESTA_PEDIDOS` FOREIGN KEY (`id_producto`) REFERENCES `articulos` (`id`),
  ADD CONSTRAINT `FK_CESTA_USUARIOS` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `FK_PEDIDOS_USUARIOS` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
