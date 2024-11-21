-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-11-2024 a las 20:16:28
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
-- Base de datos: `leagueoflegends`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE `cuentas` (
  `id_cuenta` int(11) NOT NULL,
  `juego` varchar(100) NOT NULL,
  `nivel` varchar(50) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `estado` enum('disponible','vendido') DEFAULT 'disponible',
  `fecha_creación` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cuentas`
--

INSERT INTO `cuentas` (`id_cuenta`, `juego`, `nivel`, `precio`, `estado`, `fecha_creación`) VALUES
(1, 'League of Legends', 'Plata', 50.00, 'disponible', '2024-11-21 19:14:43'),
(2, 'League of Legends', 'Oro', 80.00, 'disponible', '2024-11-21 19:14:43'),
(3, 'League of Legends', 'Platino', 100.00, 'disponible', '2024-11-21 19:14:43'),
(4, 'League of Legends', 'Diamante', 150.00, 'disponible', '2024-11-21 19:14:43'),
(5, 'League of Legends', 'Oro', 60.00, 'disponible', '2024-11-21 19:14:43'),
(6, 'League of Legends', 'Platino', 110.00, 'disponible', '2024-11-21 19:14:43'),
(7, 'League of Legends', 'Oro', 75.00, 'disponible', '2024-11-21 19:14:43'),
(8, 'League of Legends', 'Platino', 95.00, 'disponible', '2024-11-21 19:14:43'),
(9, 'League of Legends', 'Diamante', 180.00, 'disponible', '2024-11-21 19:14:43'),
(10, 'League of Legends', 'Oro', 65.00, 'disponible', '2024-11-21 19:14:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id_pago` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `método_pago` enum('tarjeta','PayPal','otro') DEFAULT 'otro',
  `fecha_pago` timestamp NOT NULL DEFAULT current_timestamp(),
  `monto` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id_pago`, `id_pedido`, `método_pago`, `fecha_pago`, `monto`) VALUES
(1, 1, 'tarjeta', '2024-11-21 19:14:43', 50.00),
(2, 2, 'PayPal', '2024-11-21 19:14:43', 80.00),
(3, 3, 'tarjeta', '2024-11-21 19:14:43', 100.00),
(4, 4, 'PayPal', '2024-11-21 19:14:43', 150.00),
(5, 6, 'otro', '2024-11-21 19:14:43', 110.00),
(6, 7, 'PayPal', '2024-11-21 19:14:43', 75.00),
(7, 8, 'tarjeta', '2024-11-21 19:14:43', 95.00),
(8, 9, 'PayPal', '2024-11-21 19:14:43', 180.00),
(9, 10, 'tarjeta', '2024-11-21 19:14:43', 65.00),
(10, 5, 'PayPal', '2024-11-21 19:14:43', 60.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_cuenta` int(11) NOT NULL,
  `fecha_pedido` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('en_proceso','completado','cancelado') DEFAULT 'en_proceso',
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_usuario`, `id_cuenta`, `fecha_pedido`, `estado`, `total`) VALUES
(1, 1, 1, '2024-11-21 19:14:43', 'en_proceso', 50.00),
(2, 2, 2, '2024-11-21 19:14:43', 'en_proceso', 80.00),
(3, 3, 3, '2024-11-21 19:14:43', 'completado', 100.00),
(4, 4, 4, '2024-11-21 19:14:43', 'completado', 150.00),
(5, 5, 5, '2024-11-21 19:14:43', 'cancelado', 60.00),
(6, 6, 6, '2024-11-21 19:14:43', 'en_proceso', 110.00),
(7, 7, 7, '2024-11-21 19:14:43', 'completado', 75.00),
(8, 8, 8, '2024-11-21 19:14:43', 'en_proceso', 95.00),
(9, 9, 9, '2024-11-21 19:14:43', 'completado', 180.00),
(10, 10, 10, '2024-11-21 19:14:43', 'cancelado', 65.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `user` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `rol` char(1) DEFAULT NULL CHECK (`rol` in ('A','R')),
  `mail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`user`, `password`, `rol`, `mail`) VALUES
('admin', '1234', 'A', 'admin@riberadeltajo.es'),
('registrado', '1234', 'R', 'registrado@riberadeltajo.es');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`id_cuenta`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `fk_pago_pedido` (`id_pedido`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `id_cuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `fk_pago_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
