-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2025 a las 00:14:04
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
-- Base de datos: `safe_money`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alertas`
--

CREATE TABLE `alertas` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `mensaje` text DEFAULT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alertas`
--

INSERT INTO `alertas` (`id`, `usuario_id`, `mensaje`, `fecha`) VALUES
(6, 6, 'Hay que ahorrar', '2025-10-30 22:25:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metas`
--

CREATE TABLE `metas` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `monto_objetivo` decimal(10,2) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `nombre_meta` varchar(100) NOT NULL,
  `descripcion_meta` text NOT NULL,
  `cantidad` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cantidad_acumulada` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `metas`
--

INSERT INTO `metas` (`id`, `usuario_id`, `monto_objetivo`, `categoria`, `fecha_inicio`, `fecha_fin`, `nombre_meta`, `descripcion_meta`, `cantidad`, `cantidad_acumulada`) VALUES
(19, 6, NULL, 'viaje', '2025-10-31', '2026-02-23', 'Irrme de viaje', 'Me quiero ir a Cancún', 70000.00, 0.00),
(20, 6, NULL, 'viaje', '2026-03-01', '2026-05-31', 'Irrme de viaje', 'Acapulco', 50000.00, 0.00),
(21, 6, NULL, 'otros', '2025-10-30', '2026-02-07', 'Xbox', 'Me quiero comprar un Xbox', 14000.00, 0.00),
(22, 7, NULL, 'viaje', '2025-10-30', '2025-12-31', 'XBOX', 'Me quiero comprar un xbox', 14000.00, 14001.00),
(23, 7, NULL, 'otros', '2025-10-30', '2025-12-31', 'XBOX', 'M e quiero comprar un xbox\r\n', 14000.00, 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transacciones`
--

CREATE TABLE `transacciones` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `tipo` enum('ingreso','gasto') DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `monto` decimal(10,2) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `transacciones`
--

INSERT INTO `transacciones` (`id`, `usuario_id`, `tipo`, `categoria`, `monto`, `fecha`) VALUES
(11, 6, 'ingreso', 'beca', 1900.00, '2025-10-31 05:15:52'),
(12, 6, 'gasto', 'comida', 45.00, '2025-10-31 05:16:03'),
(13, 6, 'ingreso', 'prestamo', 50.00, '2025-10-31 05:16:12'),
(14, 6, 'gasto', 'otros', 500.00, '2025-10-31 05:16:23'),
(15, 6, 'ingreso', 'sueldo', 1000.00, '2025-10-31 05:22:59'),
(16, 7, 'ingreso', 'sueldo', 500.00, '2025-11-06 22:34:27'),
(17, 7, 'gasto', 'pasajes', 40.00, '2025-11-06 22:34:40'),
(18, 7, 'gasto', 'comida', 60.00, '2025-11-06 22:39:17'),
(19, 7, 'gasto', 'regalos', 90.00, '2025-11-06 22:39:26'),
(20, 7, 'gasto', 'entretenimiento', 240.00, '2025-11-06 22:39:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `edad`, `correo`, `contrasena`) VALUES
(6, 'RICARDO BUSTAMANTE', 17, 'bustamantejuarezricardo251@gmail.com', '$2y$10$wHK.0/LAeVU2B6jBoPn4rORvZVGjWXdfc1CkJME8/SjQKz3y5CRiO'),
(7, 'Ricardo Bustamante Juarez', 17, 'ricardobj0208@gmail.com', '$2y$10$7aGll3V835zEmg2xEtHJnu014zo45A1NtfIWf7/1m5f2KuUxE44Mu');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alertas`
--
ALTER TABLE `alertas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `metas`
--
ALTER TABLE `metas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alertas`
--
ALTER TABLE `alertas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `metas`
--
ALTER TABLE `metas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alertas`
--
ALTER TABLE `alertas`
  ADD CONSTRAINT `alertas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `metas`
--
ALTER TABLE `metas`
  ADD CONSTRAINT `metas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD CONSTRAINT `transacciones_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
