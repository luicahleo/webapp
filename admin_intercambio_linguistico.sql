-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 19-05-2020 a las 20:59:56
-- Versión del servidor: 5.7.30-0ubuntu0.18.04.1
-- Versión de PHP: 7.2.24-0ubuntu0.18.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `admin_intercambio_linguistico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuarios_id` int(11) NOT NULL,
  `usuarios_nombre` varchar(60) CHARACTER SET utf8 NOT NULL,
  `usuarios_uvus` varchar(30) CHARACTER SET utf8 NOT NULL,
  `usuarios_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuarios_email` varchar(60) CHARACTER SET utf8 NOT NULL,
  `usuarios_password` varchar(60) CHARACTER SET utf8 NOT NULL,
  `usuarios_ip` varchar(60) CHARACTER SET utf8 NOT NULL,
  `usuarios_ultimo_login` timestamp NULL DEFAULT NULL,
  `usuarios_imagen` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuarios_id`, `usuarios_nombre`, `usuarios_uvus`, `usuarios_fecha`, `usuarios_email`, `usuarios_password`, `usuarios_ip`, `usuarios_ultimo_login`, `usuarios_imagen`) VALUES
(2, '', '', '2020-04-15 07:22:12', 'carlos@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '172.31.44.44', NULL, ''),
(3, 'narcy', '', '2020-04-15 08:32:19', 'narcy1029@hotmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '172.31.44.44', NULL, ''),
(4, 'enrique', 'enrique123', '2020-04-15 08:36:40', 'enrique@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '172.31.44.44', NULL, ''),
(5, 'sara', 'sara123', '2020-04-15 08:43:03', 'sara@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '172.31.44.44', '2020-04-15 11:23:37', 'archivos/logo3.png'),
(6, 'clara', 'clara123', '2020-04-28 13:08:01', 'clara@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '172.31.44.44', NULL, ''),
(7, 'pepe', 'pepe123', '2020-04-28 13:25:04', 'pepe@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '172.31.44.44', '2020-04-28 15:59:53', ''),
(8, 'Luis Rolando Cahuana leon', 'Luicahleo1', '2020-04-28 13:30:45', 'luisrolandocahuanaleon@gmail.com', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a', '172.31.44.44', '2020-04-28 13:30:59', ''),
(9, 'Mariya Kupriyanova', 'marcup', '2020-04-28 13:42:47', 'kma.123@ya.ru', '7c222fb2927d828af22f592134e8932480637c0d', '172.31.44.44', '2020-04-28 13:43:56', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuarios_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuarios_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
