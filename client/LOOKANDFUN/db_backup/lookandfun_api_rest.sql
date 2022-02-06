-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-12-2019 a las 17:28:40
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lookandfun_api_rest`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id_cat` int(11) NOT NULL,
  `nom_cat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id_cat`, `nom_cat`) VALUES
(1, 'Musica'),
(2, 'Exposicions'),
(3, 'Teatre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `id_event` int(11) NOT NULL,
  `nom_event` varchar(32) NOT NULL,
  `desc_event` text NOT NULL,
  `fk_id_org` int(11) NOT NULL,
  `fk_id_cat` int(11) NOT NULL,
  `privat` tinyint(1) NOT NULL DEFAULT '0',
  `data_event` date NOT NULL,
  `aforo` varchar(6) DEFAULT NULL,
  `source_poster_event` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `events`
--

INSERT INTO `events` (`id_event`, `nom_event`, `desc_event`, `fk_id_org`, `fk_id_cat`, `privat`, `data_event`, `aforo`, `source_poster_event`) VALUES
(1, 'Concert One Ok Rock', 'Concert Sala RazzMatazz Barcelona', 1, 1, 0, '2020-06-01', '600', 'resources/url_img/1.jpg'),
(40, 'exemple', 'Això és un exemple de alguna cosa', 1, 1, 0, '2020-08-01', '1000', 'resources\\url_img\\40.jpg'),
(41, 'Aixo es una altra prova', 'De nou nomes estic testejant que funcioni correctament tot i que aqui falten accents i signes de puntuacio', 1, 3, 0, '2020-05-03', '100', 'resources\\url_img\\41.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `organitzadors`
--

CREATE TABLE `organitzadors` (
  `id_org` int(11) NOT NULL,
  `nom_org` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `organitzadors`
--

INSERT INTO `organitzadors` (`id_org`, `nom_org`) VALUES
(1, 'Trui Espectacles'),
(2, 'El Liceu');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id_event`),
  ADD KEY `fk_id_org` (`fk_id_org`),
  ADD KEY `fk_id_cat` (`fk_id_cat`);

--
-- Indices de la tabla `organitzadors`
--
ALTER TABLE `organitzadors`
  ADD PRIMARY KEY (`id_org`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `organitzadors`
--
ALTER TABLE `organitzadors`
  MODIFY `id_org` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`fk_id_org`) REFERENCES `organitzadors` (`id_org`),
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`fk_id_cat`) REFERENCES `categories` (`id_cat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
