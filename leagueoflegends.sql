-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-12-2024 a las 20:40:42
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
  `rp` int(100) NOT NULL,
  `rango` varchar(50) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `estado` enum('disponible','vendido') DEFAULT 'disponible',
  `be` int(11) NOT NULL,
  `region` varchar(5) NOT NULL DEFAULT 'EUW',
  `nivel` int(3) NOT NULL,
  `campeones` int(11) NOT NULL,
  `skins` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cuentas`
--

INSERT INTO `cuentas` (`id_cuenta`, `rp`, `rango`, `precio`, `estado`, `be`, `region`, `nivel`, `campeones`, `skins`) VALUES
(1, 3200, 'Plata', 55.00, 'disponible', 5000, 'EUW', 5, 10, 5),
(2, 4500, 'Oro', 85.00, 'disponible', 7000, 'EUW', 10, 20, 15),
(3, 6000, 'Platino', 105.00, 'vendido', 9000, 'EUW', 15, 30, 25),
(4, 7500, 'Diamante', 155.00, 'disponible', 11000, 'EUW', 20, 40, 35),
(5, 3600, 'Plata', 60.00, 'disponible', 5500, 'EUW', 6, 12, 7),
(6, 5000, 'Oro', 90.00, 'disponible', 7500, 'EUW', 12, 24, 18),
(7, 6500, 'Platino', 115.00, 'disponible', 9500, 'EUW', 17, 35, 27),
(8, 8000, 'Diamante', 165.00, 'disponible', 11500, 'EUW', 22, 45, 37),
(9, 3800, 'Oro', 70.00, 'disponible', 6000, 'EUW', 8, 16, 10),
(10, 5500, 'Platino', 100.00, 'disponible', 8500, 'EUW', 14, 28, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentasproveedor`
--

CREATE TABLE `cuentasproveedor` (
  `ID_Proveedor` int(11) NOT NULL,
  `ID_Cuenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cuentasproveedor`
--

INSERT INTO `cuentasproveedor` (`ID_Proveedor`, `ID_Cuenta`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 4),
(2, 5),
(3, 6),
(3, 7),
(4, 8),
(4, 9),
(4, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `ID_Proveedor` int(11) NOT NULL,
  `Nombre_Proveedor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`ID_Proveedor`, `Nombre_Proveedor`) VALUES
(1, 'Juan'),
(2, 'Pedro'),
(3, 'Victor'),
(4, 'David');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `user` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` char(1) DEFAULT NULL CHECK (`rol` in ('A','R')),
  `mail` varchar(100) NOT NULL,
  `path_image` varchar(255) NOT NULL DEFAULT '../assets/images/users/674f64281c8c9.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`user`, `password`, `rol`, `mail`, `path_image`) VALUES
('a', 'a', 'R', 'a@a.a', '../assets/images/users/6751e7547505c.png'),
('aa', '$2y$10$t43MBqcIPirQOpupBSoCNegF48kQnNK7jH9exUrdtRe1jWZ4IsGO.', 'A', 'aa@aa', '../assets/images/users/674f64281c8c9.png'),
('admin', '1234', 'A', 'admin@riberadeltajo.es', '../assets/images/users/674f64281c8c9.png'),
('asd', 'asd', 'R', 'admin@lolaccs.es', '../assets/images/users/674f64281c8c9.png'),
('pwtest', '$2y$10$6S4rtWd0ScewGWankNxC4uV4vUo0dy4A.h/mcle.VGY', 'R', 'pwtest@pwtest', '../assets/images/users/674f64281c8c9.png'),
('registrado', '1234', 'R', 'registrado@riberadeltajo.es', '../assets/images/users/674f64281c8c9.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`id_cuenta`);

--
-- Indices de la tabla `cuentasproveedor`
--
ALTER TABLE `cuentasproveedor`
  ADD PRIMARY KEY (`ID_Proveedor`,`ID_Cuenta`),
  ADD KEY `ID_Cuenta` (`ID_Cuenta`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`ID_Proveedor`);

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
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `ID_Proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuentasproveedor`
--
ALTER TABLE `cuentasproveedor`
  ADD CONSTRAINT `cuentasproveedor_ibfk_1` FOREIGN KEY (`ID_Proveedor`) REFERENCES `proveedores` (`ID_Proveedor`),
  ADD CONSTRAINT `cuentasproveedor_ibfk_2` FOREIGN KEY (`ID_Cuenta`) REFERENCES `cuentas` (`id_cuenta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
