-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-03-2025 a las 23:16:08
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
-- Base de datos: `restaurante`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(50) NOT NULL,
  `nom_categoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id_factu` int(15) NOT NULL,
  `proveedor` varchar(255) NOT NULL,
  ` archivo` varchar(255) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `archivo` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id_factu`, `proveedor`, ` archivo`, `fecha`, `archivo`, `id`) VALUES
(1, 'salserin', '', '2025-02-27 20:29:27', '', 0),
(2, 'salserin', '', '2025-02-28 21:18:50', '', 0),
(3, 'salserin', '', '2025-03-03 01:40:57', '', 0),
(4, 'salserin', '', '2025-03-03 18:02:58', '', 0),
(5, 'salserin', '', '2025-03-03 21:22:34', '', 0),
(6, 'salserin', '', '2025-03-03 22:05:43', '', 0),
(7, 'carnes', '', '2025-03-10 17:15:40', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id pedido` int(11) NOT NULL,
  `productos` text NOT NULL,
  `total` float(123,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_poduc` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cantidad` int(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `fecha_hora` datetime NOT NULL DEFAULT current_timestamp(),
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_poduc`, `nombre`, `cantidad`, `precio`, `categoria`, `fecha_hora`, `id_categoria`) VALUES
(33, 'empanada', 23, 45678.00, 'Bebidas en botella', '2025-03-20 16:12:00', 0),
(34, 'empanada', 12, 34676.00, 'Comida rápida', '2025-03-22 16:21:00', 0),
(35, 'empanada', 12, 34676.00, 'Comida rápida', '2025-03-22 16:21:00', 0),
(36, 'empanada', 23, 232323.00, 'Bebidas en botella', '2025-03-05 15:48:00', 0),
(37, 'empanada', 78, 78878.00, 'Bebidas en vaso', '2025-03-04 16:57:00', 0),
(38, 'empanada', 12, 34424.00, 'Comida rápida', '2025-03-04 12:14:00', 0),
(39, 'empanada', 12, 3434.00, 'Bebidas en botella', '2025-03-10 14:08:00', 0),
(40, 'empanada', 23, 2323.00, 'Bebidas en vaso', '2025-02-26 14:31:00', 0),
(41, 'empanada', 34, 343434.00, 'Bebidas en vaso', '2025-03-07 18:33:00', 0),
(42, 'empanada', 34, 433434.00, 'Bebidas en vaso', '2025-03-07 19:59:00', 0),
(43, 'empanada', 34, 433434.00, 'Bebidas en vaso', '2025-03-07 19:59:00', 0),
(44, 'empanada', 345645, 45646464.00, 'Bebidas en vaso', '2025-03-10 19:01:00', 0),
(45, 'empanada', 12, 343434.00, 'Bebidas en vaso', '2025-03-27 16:21:00', 0),
(46, 'pasteles', 56, 8900.00, 'Bebidas en vaso', '2025-03-10 16:25:00', 0),
(47, 'pasteles', 56, 8900.00, 'Bebidas en vaso', '2025-03-10 16:25:00', 0),
(48, 'pasteles', 56, 8900.00, 'Bebidas en vaso', '2025-03-10 16:25:00', 0),
(49, 'empanada', 34, 45454.00, 'Bebidas en vaso', '2025-03-14 16:28:00', 0),
(50, 'empanada', 34, 343434.00, 'Bebidas en vaso', '2025-03-10 20:29:00', 0),
(51, 'empanada', 34, 678999.00, 'Bebidas en vaso', '2025-03-13 16:45:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_provee` int(100) NOT NULL,
  `nom_provee` varchar(100) NOT NULL,
  `produc_provee` varchar(100) NOT NULL,
  `id_factu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`) VALUES
(21, 'admin', '$2y$10$Saz9w28UHJLOMePcs6lO6e3rLhMDzcMJLHLixCYUf5VyFWMhzcsvm');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id_factu`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id pedido`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_poduc`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_provee`),
  ADD KEY `id_factu` (`id_factu`),
  ADD KEY `id_factu_2` (`id_factu`),
  ADD KEY `id_factu_3` (`id_factu`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id_factu` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_poduc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `categoria_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `productos` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD CONSTRAINT `proveedores_ibfk_1` FOREIGN KEY (`id_factu`) REFERENCES `facturas` (`id_factu`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
