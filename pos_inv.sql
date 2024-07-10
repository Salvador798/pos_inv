-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 08-07-2024 a las 06:09:22
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
-- Base de datos: `pos_inv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `estado`) VALUES
(1, 'Café', 1),
(2, 'Azucar', 1),
(3, 'Pepsi', 0),
(4, 'Ajo', 0),
(5, 'Arroz', 1),
(6, 'papa', 1),
(7, 'bebidas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `total`, `fecha`) VALUES
(1, 590.00, '2024-06-30 22:30:35'),
(2, 590.00, '2024-06-30 22:30:39'),
(3, 590.00, '2024-06-30 22:31:54'),
(4, 20.00, '2024-06-30 23:50:40'),
(5, 20.00, '2024-07-01 00:10:11'),
(6, 270.00, '2024-07-01 00:16:42'),
(7, 570.00, '2024-07-01 02:50:43'),
(8, 40.00, '2024-07-02 21:47:52'),
(9, 40.00, '2024-07-02 22:00:33'),
(10, 40.00, '2024-07-02 22:03:49'),
(11, 40.00, '2024-07-02 22:39:22'),
(12, 122.00, '2024-07-03 21:11:55'),
(13, 40.00, '2024-07-04 00:31:25'),
(14, 40.00, '2024-07-04 00:31:32'),
(15, 40.00, '2024-07-04 01:03:36'),
(16, 40.00, '2024-07-04 01:03:43'),
(17, 40.00, '2024-07-04 01:04:35'),
(18, 40.00, '2024-07-04 01:04:51'),
(19, 40.00, '2024-07-04 01:05:14'),
(20, 40.00, '2024-07-04 01:06:42'),
(21, 1400.00, '2024-07-04 01:31:12'),
(22, 5000.00, '2024-07-04 01:32:29'),
(23, 50.00, '2024-07-04 02:33:36'),
(24, 6000.00, '2024-07-04 14:08:46'),
(25, 250.00, '2024-07-08 01:47:21'),
(26, 160.00, '2024-07-08 03:28:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `ruc` varchar(20) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `mensaje` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `ruc`, `nombre`, `telefono`, `direccion`, `mensaje`) VALUES
(1, '13545264', 'Autorepuesto Espinoza C.A', '02943322410', 'Calle Monaga', 'Gracias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

CREATE TABLE `detalle` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `sub_total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compras`
--

CREATE TABLE `detalle_compras` (
  `id` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `detalle_compras`
--

INSERT INTO `detalle_compras` (`id`, `id_compra`, `id_producto`, `cantidad`, `precio`, `sub_total`) VALUES
(1, 3, 2, 20, 3.00, 60.00),
(2, 3, 3, 50, 5.00, 250.00),
(3, 3, 4, 40, 2.00, 80.00),
(4, 3, 5, 40, 5.00, 200.00),
(5, 4, 4, 10, 2.00, 20.00),
(6, 5, 4, 10, 2.00, 20.00),
(7, 6, 4, 10, 2.00, 20.00),
(8, 6, 5, 50, 5.00, 250.00),
(9, 7, 3, 40, 5.00, 200.00),
(10, 7, 4, 60, 2.00, 120.00),
(11, 7, 5, 50, 5.00, 250.00),
(12, 8, 4, 20, 2.00, 40.00),
(13, 9, 4, 20, 2.00, 40.00),
(14, 10, 4, 20, 2.00, 40.00),
(15, 11, 4, 20, 2.00, 40.00),
(16, 12, 4, 61, 2.00, 122.00),
(17, 20, 4, 20, 2.00, 40.00),
(18, 21, 4, 700, 2.00, 1400.00),
(19, 22, 5, 500, 5.00, 2500.00),
(20, 22, 3, 500, 5.00, 2500.00),
(21, 23, 4, 25, 2.00, 50.00),
(22, 24, 3, 500, 5.00, 2500.00),
(23, 24, 4, 500, 2.00, 1000.00),
(24, 24, 5, 500, 5.00, 2500.00),
(25, 25, 3, 30, 5.00, 150.00),
(26, 25, 5, 20, 5.00, 100.00),
(27, 26, 3, 20, 5.00, 100.00),
(28, 26, 4, 30, 2.00, 60.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_temp`
--

CREATE TABLE `detalle_temp` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `detalle_ventas`
--

INSERT INTO `detalle_ventas` (`id`, `id_venta`, `id_producto`, `cantidad`, `precio`, `sub_total`) VALUES
(1, 1, 3, 10, 5.00, 50.00),
(2, 2, 5, 10, 5.00, 50.00),
(3, 3, 4, 20, 2.00, 40.00),
(4, 4, 4, 50, 2.00, 100.00),
(5, 5, 4, 20, 2.00, 40.00),
(6, 6, 3, 50, 5.00, 250.00),
(7, 7, 3, 50, 5.00, 250.00),
(8, 8, 3, 50, 5.00, 250.00),
(9, 9, 4, 40, 2.00, 80.00),
(10, 10, 3, 25, 5.00, 125.00),
(11, 11, 5, 25, 5.00, 125.00),
(12, 12, 5, 25, 5.00, 125.00),
(13, 13, 4, 20, 2.00, 40.00),
(14, 14, 3, 50, 5.00, 250.00),
(15, 15, 3, 20, 5.00, 100.00),
(16, 15, 5, 70, 5.00, 350.00),
(17, 16, 4, 50, 2.00, 100.00),
(18, 16, 5, 20, 5.00, 100.00),
(19, 17, 3, 10, 5.00, 50.00),
(20, 17, 4, 40, 2.00, 80.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `nombre`, `estado`) VALUES
(1, 'Pepsi', 1),
(2, 'Cocacola', 0),
(3, 'Zulia', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `precio_compra` decimal(10,2) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 0,
  `id_marca` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `nombre`, `precio_compra`, `precio_venta`, `cantidad`, `id_marca`, `id_categoria`, `estado`) VALUES
(2, '04', 'San Salvador', 3.00, 3.00, 0, 1, 1, 0),
(3, '03', 'Cocacola', 5.00, 5.00, 735, 1, 1, 1),
(4, '01', 'Zulia', 2.00, 2.00, 746, 1, 1, 1),
(5, '02', 'Refresco', 5.00, 5.00, 835, 1, 1, 1),
(6, '05', 'Café', 3.00, 3.00, 0, 3, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `rif` varchar(8) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `direccion` text NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `rif`, `nombre`, `telefono`, `direccion`, `estado`) VALUES
(1, '816545', 'Salvador', '51518', 'El Valle', 0),
(2, 'J-23425', 'Cruz', '984181', 'El Valle', 1),
(3, 'V54843', 'Niurka', '541543', 'Casanai', 1),
(4, 'J-4534', 'rgerg', '432432', 'fdgdfg', 1),
(10, 'J-534543', 'Salvador', '5198415', 'el valle', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `nombre`, `clave`, `estado`) VALUES
(1, 'admin', 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 1),
(2, 'salvador', 'salvador', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 1),
(3, 'admin12', 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 1),
(4, 'Niurka', 'Niurka López', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 0),
(6, 'chuchu', 'chuchu pelo', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `total`, `fecha`) VALUES
(1, 50.00, '2024-07-04 01:37:45'),
(2, 50.00, '2024-07-04 01:38:02'),
(3, 40.00, '2024-07-04 01:38:46'),
(4, 100.00, '2024-07-04 01:49:01'),
(5, 40.00, '2024-07-04 01:49:39'),
(6, 250.00, '2024-07-04 01:51:08'),
(7, 250.00, '2024-07-04 01:53:41'),
(8, 250.00, '2024-07-04 01:54:06'),
(9, 80.00, '2024-07-04 02:20:01'),
(10, 125.00, '2024-07-04 02:26:42'),
(11, 125.00, '2024-07-04 02:33:11'),
(12, 125.00, '2024-07-04 02:34:12'),
(13, 40.00, '2024-07-04 03:04:40'),
(14, 250.00, '2024-07-04 03:05:05'),
(15, 450.00, '2024-07-04 14:07:31'),
(16, 200.00, '2024-07-08 01:48:12'),
(17, 130.00, '2024-07-08 03:30:19');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle`
--
ALTER TABLE `detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
