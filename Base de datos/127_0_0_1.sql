-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-02-2025 a las 03:41:36
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
-- Base de datos: `leyciclos`
--
CREATE DATABASE IF NOT EXISTS `leyciclos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `leyciclos`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acciones_guardianes`
--

CREATE TABLE `acciones_guardianes` (
  `id` int(11) NOT NULL,
  `guardian_id` int(11) DEFAULT NULL,
  `chica_id` int(11) DEFAULT NULL,
  `accion` varchar(255) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `acciones_guardianes`
--

INSERT INTO `acciones_guardianes` (`id`, `guardian_id`, `chica_id`, `accion`, `fecha`) VALUES
(1, 1, 1, 'Madoka ha sido rescatada por la Ley de los Ciclos.', '2024-02-10 05:00:00'),
(2, 2, 3, 'Sayaka cayó en la desesperación y se convirtió en bruja.', '2024-02-05 05:00:00'),
(3, 1, 4, 'Homura intentó salvar a Mami, pero fue demasiado tarde.', '2024-01-10 05:00:00'),
(4, 1, 6, 'Nagisa Momoe fue rescatada por la Ley de los Ciclos.', '2024-02-05 05:00:00'),
(5, 3, 7, 'Kirika Kure desapareció en batalla contra una bruja.', '2024-02-08 05:00:00'),
(6, 2, 8, 'Tsuruno Yui fue salvada y añadida al sistema.', '2024-02-12 05:00:00'),
(7, 4, 9, 'Alina Gray cayó en combate contra una anomalía mágica.', '2024-02-15 05:00:00'),
(8, 3, 10, 'Felicia Mitsuki desapareció tras una emboscada.', '2024-02-18 05:00:00'),
(9, 1, 11, 'Ui Tamaki fue rescatada y devuelta a salvo.', '2024-02-05 05:00:00'),
(10, 2, 12, 'Kaede Akino desapareció tras un enfrentamiento.', '2024-02-08 05:00:00'),
(11, 3, 13, 'Rena Minami fue salvada en el último momento.', '2024-02-12 05:00:00'),
(12, 4, 14, 'Touka Satomi no pudo ser encontrada.', '2024-02-15 05:00:00'),
(13, 5, 15, 'Nemu Hiiragi desapareció en circunstancias misteriosas.', '2024-02-20 05:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chicas_magicas`
--

CREATE TABLE `chicas_magicas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `edad` int(11) NOT NULL,
  `ciudad_origen` varchar(100) DEFAULT NULL,
  `estado` enum('activa','desaparecida','rescatada') NOT NULL,
  `fecha_contrato` date NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `chicas_magicas`
--

INSERT INTO `chicas_magicas` (`id`, `nombre`, `edad`, `ciudad_origen`, `estado`, `fecha_contrato`, `fecha_creacion`) VALUES
(1, 'Madoka Kaname', 14, 'Ciudad Mitakihara', 'rescatada', '2024-02-01', '2025-02-24 01:17:14'),
(2, 'Homura Akemi', 14, 'Ciudad Mitakihara', 'activa', '2024-01-15', '2025-02-24 01:17:14'),
(3, 'Sayaka Miki', 14, 'Ciudad Mitakihara', 'desaparecida', '2024-01-20', '2025-02-24 01:17:14'),
(4, 'Mami Tomoe', 15, 'Ciudad Mitakihara', 'desaparecida', '2024-01-05', '2025-02-24 01:17:14'),
(5, 'Kyoko Sakura', 15, 'Ciudad Kazamino', 'activa', '2024-01-18', '2025-02-24 01:17:14'),
(6, 'Nagisa Momoe', 12, 'Ciudad Mitakihara', 'rescatada', '2024-02-03', '2025-02-24 01:17:14'),
(7, 'Oriko Mikuni', 15, 'Ciudad Kazamino', 'activa', '2024-01-22', '2025-02-24 01:17:14'),
(8, 'Kirika Kure', 16, 'Ciudad Kazamino', 'desaparecida', '2024-01-28', '2025-02-24 01:17:14'),
(9, 'Yuma Chitose', 11, 'Ciudad Mitakihara', 'activa', '2024-02-12', '2025-02-24 01:17:14'),
(10, 'Alina Gray', 17, 'Ciudad Kamihama', 'activa', '2024-02-15', '2025-02-24 01:17:14'),
(11, 'Tsuruno Yui', 16, 'Ciudad Kamihama', 'rescatada', '2024-02-18', '2025-02-24 01:17:14'),
(12, 'Felicia Mitsuki', 14, 'Ciudad Kamihama', 'activa', '2024-02-20', '2025-02-24 01:17:14'),
(13, 'Iroha Tamaki', 15, 'Ciudad Kamihama', 'activa', '2024-02-01', '2025-02-24 01:29:00'),
(14, 'Yachiyo Nanami', 19, 'Ciudad Kamihama', 'activa', '2024-01-10', '2025-02-24 01:29:00'),
(15, 'Ui Tamaki', 13, 'Ciudad Kamihama', 'desaparecida', '2024-02-03', '2025-02-24 01:29:00'),
(16, 'Momoko Togame', 16, 'Ciudad Kamihama', 'activa', '2024-01-25', '2025-02-24 01:29:00'),
(17, 'Rena Minami', 14, 'Ciudad Kamihama', 'rescatada', '2024-02-12', '2025-02-24 01:29:00'),
(18, 'Kaede Akino', 14, 'Ciudad Kamihama', 'desaparecida', '2024-02-08', '2025-02-24 01:29:00'),
(19, 'Sana Futaba', 14, 'Ciudad Kamihama', 'activa', '2024-02-15', '2025-02-24 01:29:00'),
(20, 'Touka Satomi', 14, 'Ciudad Kamihama', 'desaparecida', '2024-02-20', '2025-02-24 01:29:00'),
(21, 'Nemu Hiiragi', 14, 'Ciudad Kamihama', 'activa', '2024-02-22', '2025-02-24 01:29:00'),
(22, 'Iroha Tamaki', 15, 'Ciudad Kamihama', 'activa', '2024-02-01', '2025-02-24 01:29:43'),
(23, 'Yachiyo Nanami', 19, 'Ciudad Kamihama', 'activa', '2024-01-10', '2025-02-24 01:29:43'),
(24, 'Ui Tamaki', 13, 'Ciudad Kamihama', 'desaparecida', '2024-02-03', '2025-02-24 01:29:43'),
(25, 'Momoko Togame', 16, 'Ciudad Kamihama', 'activa', '2024-01-25', '2025-02-24 01:29:43'),
(26, 'Rena Minami', 14, 'Ciudad Kamihama', 'rescatada', '2024-02-12', '2025-02-24 01:29:43'),
(27, 'Kaede Akino', 14, 'Ciudad Kamihama', 'desaparecida', '2024-02-08', '2025-02-24 01:29:43'),
(28, 'Sana Futaba', 14, 'Ciudad Kamihama', 'activa', '2024-02-15', '2025-02-24 01:29:43'),
(29, 'Touka Satomi', 14, 'Ciudad Kamihama', 'desaparecida', '2024-02-20', '2025-02-24 01:29:43'),
(30, 'Nemu Hiiragi', 14, 'Ciudad Kamihama', 'activa', '2024-02-22', '2025-02-24 01:29:43'),
(31, 'Iroha Tamaki', 15, 'Ciudad Kamihama', 'activa', '2024-02-01', '2025-02-24 01:30:05'),
(32, 'Yachiyo Nanami', 19, 'Ciudad Kamihama', 'activa', '2024-01-10', '2025-02-24 01:30:05'),
(33, 'Ui Tamaki', 13, 'Ciudad Kamihama', 'desaparecida', '2024-02-03', '2025-02-24 01:30:05'),
(34, 'Momoko Togame', 16, 'Ciudad Kamihama', 'activa', '2024-01-25', '2025-02-24 01:30:05'),
(35, 'Rena Minami', 14, 'Ciudad Kamihama', 'rescatada', '2024-02-12', '2025-02-24 01:30:05'),
(36, 'Kaede Akino', 14, 'Ciudad Kamihama', 'desaparecida', '2024-02-08', '2025-02-24 01:30:05'),
(37, 'Sana Futaba', 14, 'Ciudad Kamihama', 'activa', '2024-02-15', '2025-02-24 01:30:05'),
(38, 'Touka Satomi', 14, 'Ciudad Kamihama', 'desaparecida', '2024-02-20', '2025-02-24 01:30:05'),
(39, 'Nemu Hiiragi', 14, 'Ciudad Kamihama', 'activa', '2024-02-22', '2025-02-24 01:30:05'),
(40, 'Maria', 20, 'Bogota', 'desaparecida', '2025-02-23', '2025-02-25 01:22:09'),
(41, 'Paola', 22, 'Bogota', 'activa', '2025-02-24', '2025-02-25 01:32:08'),
(42, 'gfsdg', 23, 'cal', 'activa', '2025-02-26', '2025-02-25 01:43:59'),
(43, 'paola', 23, 'bogota', 'activa', '2025-02-25', '2025-02-25 01:50:01'),
(44, 'paola', 22, 'bogota', 'desaparecida', '2025-02-26', '2025-02-25 01:57:04'),
(45, 'paola', 22, 'bogota', 'rescatada', '2025-02-23', '2025-02-25 01:58:23'),
(46, 'paola', 11, 'bogota', 'desaparecida', '2025-02-25', '2025-02-25 02:06:26'),
(47, 'paola', 11, 'bogota', 'desaparecida', '2025-02-25', '2025-02-25 02:06:43'),
(48, 'paola', 11, 'bogota', 'desaparecida', '2025-02-25', '2025-02-25 02:06:46'),
(49, 'paola', 11, 'bogota', 'desaparecida', '2025-02-25', '2025-02-25 02:06:50'),
(50, 'paola', 22, 'bogota', 'activa', '2025-02-25', '2025-02-25 02:12:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guardianes`
--

CREATE TABLE `guardianes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contrasena` text NOT NULL,
  `rol` enum('admin','moderador') NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `guardianes`
--

INSERT INTO `guardianes` (`id`, `nombre`, `email`, `contrasena`, `rol`, `fecha_registro`) VALUES
(1, 'Homura Akemi', 'homura@leydelosciclos.com', 'hashed_password_1', 'admin', '2025-02-24 01:18:24'),
(2, 'Kyubey', 'kyubey@incubadores.com', 'hashed_password_2', 'moderador', '2025-02-24 01:18:24'),
(3, 'Nagisa Momoe', 'nagisa@leydelosciclos.com', 'hashed_password_3', 'moderador', '2025-02-24 01:18:24'),
(4, 'Oriko Mikuni', 'oriko@leydelosciclos.com', 'hashed_password_4', 'moderador', '2025-02-24 01:18:24'),
(5, 'Mitama Yakumo', 'mitama@leydelosciclos.com', 'hashed_password_5', 'moderador', '2025-02-24 01:18:24'),
(6, 'Touka Satomi', 'touka@leydelosciclos.com', 'hashed_password_6', 'moderador', '2025-02-24 01:18:24'),
(7, 'Nemu Hiiragi', 'nemu@leydelosciclos.com', 'hashed_password_7', 'moderador', '2025-02-24 01:18:24'),
(17, 'Iroha Tamaki', 'iroha@leydelosciclos.com', 'hashed_password_8', 'moderador', '2025-02-24 01:30:05'),
(18, 'Yachiyo Nanami', 'yachiyo@leydelosciclos.com', 'hashed_password_9', 'moderador', '2025-02-24 01:30:05'),
(19, 'Mifuyu Azusa', 'mifuyu@leydelosciclos.com', 'hashed_password_10', 'moderador', '2025-02-24 01:30:05'),
(20, 'Paola', 'greisp.lopezp', 'Colombia2024', 'admin', '2025-02-24 02:28:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_estados`
--

CREATE TABLE `historial_estados` (
  `id` int(11) NOT NULL,
  `chica_id` int(11) NOT NULL,
  `estado_anterior` enum('activa','desaparecida','rescatada') DEFAULT NULL,
  `estado_nuevo` enum('activa','desaparecida','rescatada') NOT NULL,
  `fecha_cambio` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_estados`
--

INSERT INTO `historial_estados` (`id`, `chica_id`, `estado_anterior`, `estado_nuevo`, `fecha_cambio`) VALUES
(1, 1, 'activa', 'rescatada', '2024-02-10 05:00:00'),
(2, 3, 'activa', 'desaparecida', '2024-02-05 05:00:00'),
(3, 4, 'activa', 'desaparecida', '2024-01-10 05:00:00'),
(4, 6, 'activa', 'rescatada', '2024-02-05 05:00:00'),
(5, 7, 'activa', 'desaparecida', '2024-02-08 05:00:00'),
(6, 8, 'activa', 'rescatada', '2024-02-12 05:00:00'),
(7, 9, 'activa', 'desaparecida', '2024-02-15 05:00:00'),
(8, 10, 'activa', 'desaparecida', '2024-02-18 05:00:00'),
(9, 11, 'activa', 'rescatada', '2024-02-05 05:00:00'),
(10, 12, 'activa', 'desaparecida', '2024-02-08 05:00:00'),
(11, 13, 'activa', 'rescatada', '2024-02-12 05:00:00'),
(12, 14, 'activa', 'desaparecida', '2024-02-15 05:00:00'),
(13, 15, 'activa', 'desaparecida', '2024-02-20 05:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acciones_guardianes`
--
ALTER TABLE `acciones_guardianes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guardian_id` (`guardian_id`),
  ADD KEY `chica_id` (`chica_id`);

--
-- Indices de la tabla `chicas_magicas`
--
ALTER TABLE `chicas_magicas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `guardianes`
--
ALTER TABLE `guardianes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_email` (`email`);

--
-- Indices de la tabla `historial_estados`
--
ALTER TABLE `historial_estados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chica_id` (`chica_id`),
  ADD KEY `idx_fecha_cambio` (`fecha_cambio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acciones_guardianes`
--
ALTER TABLE `acciones_guardianes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `chicas_magicas`
--
ALTER TABLE `chicas_magicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `guardianes`
--
ALTER TABLE `guardianes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `historial_estados`
--
ALTER TABLE `historial_estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acciones_guardianes`
--
ALTER TABLE `acciones_guardianes`
  ADD CONSTRAINT `acciones_guardianes_ibfk_1` FOREIGN KEY (`guardian_id`) REFERENCES `guardianes` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `acciones_guardianes_ibfk_2` FOREIGN KEY (`chica_id`) REFERENCES `chicas_magicas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `historial_estados`
--
ALTER TABLE `historial_estados`
  ADD CONSTRAINT `historial_estados_ibfk_1` FOREIGN KEY (`chica_id`) REFERENCES `chicas_magicas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
