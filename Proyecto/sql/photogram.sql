-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-10-2018 a las 05:46:12
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `photogram`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `ruta` varchar(100) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `size` int(50) NOT NULL,
  `publicacion` int(11) NOT NULL,
  `filtro` varchar(255) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `archivos`
--

INSERT INTO `archivos` (`id`, `user`, `ruta`, `tipo`, `size`, `publicacion`, `filtro`, `fecha`) VALUES
(1, 2, 'ID-1-NAME-8CE168.jpg', 'image/png', 7453480, 1, 'moon', '2018-10-25 22:40:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

CREATE TABLE `publicaciones` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `publicaciones`
--

INSERT INTO `publicaciones` (`id`, `user`, `descripcion`, `ubicacion`, `fecha`) VALUES
(1, 2, 'ESto es una imagen', '', '2018-10-25 22:40:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` text COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `phone` text COLLATE utf8_unicode_ci,
  `birthday` date DEFAULT NULL,
  `sex` enum('male','female') COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `site_language` bigint(20) UNSIGNED DEFAULT '1',
  `avatar` varchar(225) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default.png',
  `private_profile` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT 'Este perfil es privado?',
  `verified` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT 'Este perfil esta verificado?',
  `banned` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT 'Este perfil esta baneado?',
  `code` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT 'Verifico el correo',
  `signup_date` datetime NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `signup_ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `phone`, `birthday`, `sex`, `bio`, `site_language`, `avatar`, `private_profile`, `verified`, `banned`, `code`, `token`, `confirmed`, `signup_date`, `last_login`, `signup_ip`, `last_ip`) VALUES
(1, 'demo', '4d186321c1a7f0f354b297e8914ab240', 'demo@demo.com', 'Demo', NULL, NULL, NULL, NULL, 1, 'default.png', '0', '0', '0', '', '', '0', '2018-06-02 22:40:18', '2018-06-02 22:40:18', NULL, NULL),
(2, 'tuntoriales', '4d186321c1a7f0f354b297e8914ab240', 'tuntoriales@tuntos.com', 'Sebastian', NULL, NULL, NULL, NULL, 1, 'default.png', '0', '0', '0', '5b13632c519bc', '2222', '1', '2018-06-02 22:40:28', NULL, NULL, '::1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
