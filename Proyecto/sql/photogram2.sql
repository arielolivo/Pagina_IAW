-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-12-2018 a las 19:59:08
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
(9, 2, 'ID-9-NAME-EFC9EE.jpg', 'image/jpeg', 287563, 9, 'moon', '2018-10-26 16:00:26'),
(10, 1, 'ID-10-NAME-108473.jpg', 'image/jpeg', 287563, 10, 'kelvin', '2018-10-26 16:05:22'),
(11, 1, 'ID-11-NAME-6A884C.jpg', 'image/jpeg', 287563, 11, 'stinson', '2018-10-26 16:05:38'),
(12, 1, 'ID-12-NAME-635D13.jpg', 'image/png', 7453480, 12, 'moon', '2018-10-26 22:18:15'),
(13, 1, 'ID-13-NAME-5C21DE.jpg', 'image/jpeg', 50607, 13, '', '2018-10-26 22:19:40'),
(14, 2, 'ID-14-NAME-10275E.jpg', 'image/jpeg', 67229, 14, 'reyes', '2018-12-12 21:27:23'),
(15, 2, 'ID-15-NAME-2AB759.jpg', 'image/jpeg', 46836, 15, 'kelvin', '2018-12-12 21:27:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `id` int(11) NOT NULL,
  `post` int(11) NOT NULL,
  `usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `favoritos`
--

INSERT INTO `favoritos` (`id`, `post`, `usuario`) VALUES
(40, 15, 2),
(42, 14, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `post` int(11) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `likes`
--

INSERT INTO `likes` (`id`, `usuario`, `post`, `fecha`) VALUES
(133, 2, 15, '2018-12-13 00:41:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

CREATE TABLE `publicaciones` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  `fecha` datetime NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `publicaciones`
--

INSERT INTO `publicaciones` (`id`, `user`, `descripcion`, `ubicacion`, `fecha`, `likes`) VALUES
(9, 2, 'Lionel Messi', '', '2018-10-26 16:00:26', 0),
(10, 1, 'Messi', '', '2018-10-26 16:05:22', 0),
(11, 1, 'a', '', '2018-10-26 16:05:38', 0),
(12, 1, 'Sistema', '', '2018-10-26 22:18:15', 0),
(13, 1, 'NiÃ±o', '', '2018-10-26 22:19:40', 0),
(14, 2, '', '', '2018-12-12 21:27:23', 0),
(15, 2, 'Adidas', '', '2018-12-12 21:27:55', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguidores`
--

CREATE TABLE `seguidores` (
  `id` int(11) NOT NULL,
  `seguidor` int(11) NOT NULL,
  `seguido` int(11) NOT NULL,
  `aprobada` int(11) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `seguidores`
--

INSERT INTO `seguidores` (`id`, `seguidor`, `seguido`, `aprobada`, `fecha`) VALUES
(17, 2, 1, 1, '2018-12-11 17:32:05');

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
(1, 'demo', '4d186321c1a7f0f354b297e8914ab240', 'demo@demo.com', 'Demo', NULL, NULL, NULL, 'Esto es una descripcion', 1, 'default.png', '1', '0', '0', '', '', '1', '2018-06-02 22:40:18', '2018-06-02 22:40:18', NULL, NULL),
(2, 'tuntoriales', '9f612cba7877513e589bcdfa37c68ddd', 'tuntoriales@tuntos.com', 'Sebastian', NULL, NULL, NULL, 'Desccccc', 1, 'default.png', '0', '1', '0', '5b13632c519bc', '2222', '1', '2018-06-02 22:40:28', NULL, NULL, '::1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seguidores`
--
ALTER TABLE `seguidores`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `seguidores`
--
ALTER TABLE `seguidores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
