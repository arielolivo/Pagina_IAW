-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-02-2020 a las 14:29:11
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `olivogonzalez`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contribuciones`
--

CREATE TABLE `contribuciones` (
  `ID_CONTRIBUCION` int(50) NOT NULL,
  `ID_AUTOR` int(50) NOT NULL,
  `NOMBRE_IMAGEN` varchar(50) NOT NULL,
  `PIE_DE_FOTO` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contribuciones`
--

INSERT INTO `contribuciones` (`ID_CONTRIBUCION`, `ID_AUTOR`, `NOMBRE_IMAGEN`, `PIE_DE_FOTO`) VALUES
(1, 4, '1', 'Este pie de foto es muy largo para comprobar que pasa si alguien se enrolla hablando de su vida en la imagen que sube todavia siguen quedando caracteres asi que quiero comprobar la cantidad'),
(2, 4, '2', 'Esto es un pie de foto'),
(3, 4, '3', 'Este pie de foto es muy largo para comprobar que pasa si alguien se enrolla hablando de su vida en la imagen que sube todavia siguen quedando caracteres asi que quiero comprobar la cantidad'),
(4, 4, '4', 'Este pie de foto es muy largo para comprobar que pasa si alguien se enrolla hablando de su vida en la imagen que sube todavia siguen quedando caracteres asi que quiero comprobar la cantidad'),
(5, 5, '5', 'Esta es la imagen 5'),
(6, 5, '6', 'Este pie de foto es muy largo para comprobar que pasa si alguien se enrolla hablando de su vida en la imagen que sube todavia siguen quedando caracteres asi que quiero comprobar la cantidad'),
(7, 3, '7', 'Esta es la imagen 7'),
(8, 3, '8', 'Esta es la imagen 8');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_USUARIO` int(50) NOT NULL,
  `NOMBRE_USUARIO` varchar(50) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `CONTRASENA` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_USUARIO`, `NOMBRE_USUARIO`, `EMAIL`, `CONTRASENA`) VALUES
(1, 'Admin', 'admin@admin.com', '1234'),
(3, 'Antonio', 'antonio@usuario.com', '1234'),
(4, 'Alejandro', 'alejandro@usuario.com', '1234'),
(5, 'Ariel', 'ariel@usuario.com', '1234');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contribuciones`
--
ALTER TABLE `contribuciones`
  ADD PRIMARY KEY (`ID_CONTRIBUCION`),
  ADD KEY `FK_ID_AUTOR` (`ID_AUTOR`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_USUARIO`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contribuciones`
--
ALTER TABLE `contribuciones`
  MODIFY `ID_CONTRIBUCION` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_USUARIO` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contribuciones`
--
ALTER TABLE `contribuciones`
  ADD CONSTRAINT `FK_ID_AUTOR` FOREIGN KEY (`ID_AUTOR`) REFERENCES `usuarios` (`ID_USUARIO`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
