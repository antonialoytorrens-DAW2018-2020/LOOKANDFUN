-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Temps de generació: 16-01-2020 a les 16:41:17
-- Versió del servidor: 5.7.28-0ubuntu0.18.04.4
-- Versió de PHP: 7.2.24-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `LOOKANDFUN`
--
CREATE DATABASE IF NOT EXISTS `LOOKANDFUN` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `LOOKANDFUN`;

-- --------------------------------------------------------

--
-- Estructura de la taula `BUTACA`
--

CREATE TABLE `BUTACA` (
  `PK_FK_CODI_RECINTE` int(11) NOT NULL,
  `PK_FILA_BUTACA` int(11) NOT NULL,
  `PK_NUMERO_BUTACA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de la taula `ENTRADA`
--

CREATE TABLE `ENTRADA` (
  `PK_FK_ID_ENTRADA_ESDEVENIMENT` int(11) NOT NULL,
  `PK_NUMERO_ENTRADA` int(11) NOT NULL,
  `DESCOMPTE` double DEFAULT '0',
  `DATA_ENTRADA` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FK_CODI_PERSONA` int(11) DEFAULT NULL,
  `FK_CODI_RECINTE` int(11) DEFAULT NULL,
  `FK_FILA_BUTACA` int(11) DEFAULT NULL,
  `FK_NUMERO_BUTACA` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Bolcament de dades per a la taula `ENTRADA`
--

INSERT INTO `ENTRADA` (`PK_FK_ID_ENTRADA_ESDEVENIMENT`, `PK_NUMERO_ENTRADA`, `DESCOMPTE`, `DATA_ENTRADA`, `FK_CODI_PERSONA`, `FK_CODI_RECINTE`, `FK_FILA_BUTACA`, `FK_NUMERO_BUTACA`) VALUES
(1, 1, 0, '2020-01-16 16:31:42', NULL, 1, NULL, NULL),
(1, 2, 0, '2020-01-16 16:32:33', NULL, 1, NULL, NULL),
(1, 3, 0, '2020-01-16 16:32:35', NULL, 1, NULL, NULL),
(1, 4, 0, '2020-01-16 16:32:35', NULL, 1, NULL, NULL),
(1, 5, 0, '2020-01-16 16:32:36', NULL, 1, NULL, NULL),
(1, 6, 0, '2020-01-16 16:32:36', NULL, 1, NULL, NULL),
(1, 7, 0, '2020-01-16 16:32:36', NULL, 1, NULL, NULL),
(1, 8, 0, '2020-01-16 16:32:36', NULL, 1, NULL, NULL),
(1, 9, 0, '2020-01-16 16:32:36', NULL, 1, NULL, NULL),
(1, 10, 0, '2020-01-16 16:32:37', NULL, 1, NULL, NULL),
(1, 11, 0, '2020-01-16 16:32:37', NULL, 1, NULL, NULL),
(1, 12, 0, '2020-01-16 16:32:37', NULL, 1, NULL, NULL),
(1, 13, 0, '2020-01-16 16:32:37', NULL, 1, NULL, NULL),
(1, 14, 0, '2020-01-16 16:32:38', NULL, 1, NULL, NULL),
(1, 15, 0, '2020-01-16 16:32:38', NULL, 1, NULL, NULL),
(1, 16, 0, '2020-01-16 16:32:38', NULL, 1, NULL, NULL),
(1, 17, 0, '2020-01-16 16:32:39', NULL, 1, NULL, NULL),
(1, 18, 0, '2020-01-16 16:32:39', NULL, 1, NULL, NULL),
(1, 19, 0, '2020-01-16 16:32:39', NULL, 1, NULL, NULL),
(1, 20, 0, '2020-01-16 16:32:39', NULL, 1, NULL, NULL),
(1, 21, 0, '2020-01-16 16:36:28', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de la taula `ESDEVENIMENT`
--

CREATE TABLE `ESDEVENIMENT` (
  `PK_ID_ESDEVENIMENT` int(11) NOT NULL,
  `NOM` varchar(100) NOT NULL,
  `DESCRIPCIO` varchar(700) DEFAULT NULL,
  `DATA_INICI` datetime NOT NULL,
  `DATA_FI` datetime NOT NULL,
  `PREU` decimal(7,2) DEFAULT '0.00',
  `AFORAMENT` int(11) NOT NULL DEFAULT '0',
  `OCUPACIO` int(11) NOT NULL DEFAULT '0',
  `FK_CODI_RECINTE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Bolcament de dades per a la taula `ESDEVENIMENT`
--

INSERT INTO `ESDEVENIMENT` (`PK_ID_ESDEVENIMENT`, `NOM`, `DESCRIPCIO`, `DATA_INICI`, `DATA_FI`, `PREU`, `AFORAMENT`, `OCUPACIO`, `FK_CODI_RECINTE`) VALUES
(1, 'DISCOTECA LOREM IPSUM', 'LOREM LOREM IPSUM IPSUM', '2019-12-12 00:00:00', '2021-12-12 00:00:00', '0.00', 0, 0, 1),
(2, 'DISCOTECA LOREM IPSUM', 'LOREM LOREM IPSUM IPSUM', '2019-12-12 00:00:00', '2021-12-12 00:00:00', '0.00', 0, 0, 1),
(3, 'DISCOTECA LOREM IPSUM', 'LOREM LOREM IPSUM IPSUM', '2019-12-12 00:00:00', '2021-12-12 00:00:00', '0.00', 0, 0, 1),
(4, 'DISCOTECA LOREM IPSUM', 'LOREM LOREM IPSUM IPSUM', '2019-12-12 00:00:00', '2021-12-12 00:00:00', '0.00', 0, 0, 1),
(5, 'DISCOTECA LOREM IPSUM', 'LOREM LOREM IPSUM IPSUM', '2019-12-12 00:00:00', '2021-12-12 00:00:00', '0.00', 0, 0, 1),
(6, 'DISCOTECA LOREM IPSUM', 'LOREM LOREM IPSUM IPSUM', '2019-12-12 00:00:00', '2021-12-12 00:00:00', '0.00', 0, 0, 1),
(7, 'DISCOTECA LOREM IPSUM', 'LOREM LOREM IPSUM IPSUM', '2019-12-12 00:00:00', '2021-12-12 00:00:00', '0.00', 0, 0, 1),
(8, 'DISCOTECA LOREM IPSUM', 'LOREM LOREM IPSUM IPSUM', '2019-12-12 00:00:00', '2021-12-12 00:00:00', '0.00', 0, 0, 1),
(9, 'DISCOTECA LOREM IPSUM', 'LOREM LOREM IPSUM IPSUM', '2019-12-12 00:00:00', '2021-12-12 00:00:00', '0.00', 0, 0, 1),
(10, 'DISCOTECA LOREM IPSUM', 'LOREM LOREM IPSUM IPSUM', '2019-12-12 00:00:00', '2021-12-12 00:00:00', '0.00', 0, 0, 1),
(11, 'DISCOTECA LOREM IPSUM', 'LOREM LOREM IPSUM IPSUM', '2019-12-12 00:00:00', '2021-12-12 00:00:00', '0.00', 0, 0, 1),
(12, 'DISCOTECA LOREM IPSUM', 'LOREM LOREM IPSUM IPSUM', '2019-12-12 00:00:00', '2021-12-12 00:00:00', '0.00', 0, 0, 1),
(13, 'DISCOTECA LOREM IPSUM', 'LOREM LOREM IPSUM IPSUM', '2019-12-12 00:00:00', '2021-12-12 00:00:00', '0.00', 0, 0, 1),
(14, 'DISCOTECA LOREM IPSUM', 'LOREM LOREM IPSUM IPSUM', '2019-12-12 00:00:00', '2021-12-12 00:00:00', '0.00', 0, 0, 1),
(15, 'DISCOTECA LOREM IPSUM', 'LOREM LOREM IPSUM IPSUM', '2019-12-12 00:00:00', '2021-12-12 00:00:00', '0.00', 0, 0, 1),
(16, 'DISCOTECA LOREM IPSUM', 'LOREM LOREM IPSUM IPSUM', '2019-12-12 00:00:00', '2021-12-12 00:00:00', '0.00', 0, 0, 1),
(17, 'DISCOTECA LOREM IPSUM', 'LOREM LOREM IPSUM IPSUM', '2019-12-12 00:00:00', '2021-12-12 00:00:00', '0.00', 0, 0, 1),
(18, 'DISCOTECA LOREM IPSUM', 'LOREM LOREM IPSUM IPSUM', '2019-12-12 00:00:00', '2021-12-12 00:00:00', '0.00', 0, 0, 1),
(19, 'DISCOTECA LOREM IPSUM', 'LOREM LOREM IPSUM IPSUM', '2019-12-12 00:00:00', '2021-12-12 00:00:00', '0.00', 0, 0, 1),
(20, 'DISCOTECA LOREM IPSUM', 'LOREM LOREM IPSUM IPSUM', '2019-12-12 00:00:00', '2021-12-12 00:00:00', '0.00', 0, 0, 1),
(21, 'DISCOTECA LOREM IPSUM', 'LOREM LOREM IPSUM IPSUM', '2019-12-12 00:00:00', '2021-12-12 00:00:00', '0.00', 0, 0, 1),
(22, 'DISCOTECA LOREM IPSUM', 'LOREM LOREM IPSUM IPSUM', '2019-12-12 00:00:00', '2021-12-12 00:00:00', '0.00', 0, 0, 1),
(23, 'DISCOTECA LOREM IPSUM', 'LOREM LOREM IPSUM IPSUM', '2019-12-12 00:00:00', '2021-12-12 00:00:00', '0.00', 0, 0, 1),
(24, 'DISCOTECA LOREM IPSUM', 'LOREM LOREM IPSUM IPSUM', '2019-12-12 00:00:00', '2021-12-12 00:00:00', '0.00', 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de la taula `PERSONA`
--

CREATE TABLE `PERSONA` (
  `PK_CODI_PERSONA` int(11) NOT NULL,
  `DNI` varchar(20) DEFAULT NULL,
  `NOM` varchar(50) NOT NULL,
  `LLINATGES` varchar(100) NOT NULL,
  `TELEFON` varchar(20) NOT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `DATA_NAIXEMENT` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Bolcament de dades per a la taula `PERSONA`
--

INSERT INTO `PERSONA` (`PK_CODI_PERSONA`, `DNI`, `NOM`, `LLINATGES`, `TELEFON`, `EMAIL`, `DATA_NAIXEMENT`) VALUES
(1, 'X4887522E', 'Juan Pablo', 'Marquez Ortega', '652391023', 'juanpablomarquez@paucasesnovescifp.cat', '1998-12-07');

-- --------------------------------------------------------

--
-- Estructura de la taula `RECINTE`
--

CREATE TABLE `RECINTE` (
  `PK_CODI_RECINTE` int(11) NOT NULL,
  `NOM_RECINTE` varchar(100) NOT NULL,
  `DIRECCIO` varchar(200) NOT NULL,
  `CAPACITAT` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Bolcament de dades per a la taula `RECINTE`
--

INSERT INTO `RECINTE` (`PK_CODI_RECINTE`, `NOM_RECINTE`, `DIRECCIO`, `CAPACITAT`) VALUES
(1, 'Palau Sant Jordi', 'Av. Pepito El Catolico 1', 20000),
(2, 'Palma Arena', 'Av. Uruguay 3', 15000);

-- --------------------------------------------------------

--
-- Estructura de la taula `TIPUS`
--

CREATE TABLE `TIPUS` (
  `PK_CODI_TIPUS` int(11) NOT NULL,
  `NOM_TIPUS` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de la taula `TIPUS_ESDEVENIMENT`
--

CREATE TABLE `TIPUS_ESDEVENIMENT` (
  `PK_FK_CODI_TIPUS` int(11) NOT NULL,
  `PK_FK_ID_TIPUS_ESDEVENIMENT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `BUTACA`
--
ALTER TABLE `BUTACA`
  ADD PRIMARY KEY (`PK_FK_CODI_RECINTE`,`PK_FILA_BUTACA`,`PK_NUMERO_BUTACA`);

--
-- Índexs per a la taula `ENTRADA`
--
ALTER TABLE `ENTRADA`
  ADD PRIMARY KEY (`PK_NUMERO_ENTRADA`,`PK_FK_ID_ENTRADA_ESDEVENIMENT`),
  ADD KEY `PK_FK_ID_ENTRADA_ESDEVENIMENT` (`PK_FK_ID_ENTRADA_ESDEVENIMENT`),
  ADD KEY `FK_CODI_PERSONA` (`FK_CODI_PERSONA`),
  ADD KEY `FK_BUTACA` (`FK_CODI_RECINTE`,`FK_FILA_BUTACA`,`FK_NUMERO_BUTACA`);

--
-- Índexs per a la taula `ESDEVENIMENT`
--
ALTER TABLE `ESDEVENIMENT`
  ADD PRIMARY KEY (`PK_ID_ESDEVENIMENT`),
  ADD KEY `FK_CODI_RECINTE` (`FK_CODI_RECINTE`);

--
-- Índexs per a la taula `PERSONA`
--
ALTER TABLE `PERSONA`
  ADD PRIMARY KEY (`PK_CODI_PERSONA`);

--
-- Índexs per a la taula `RECINTE`
--
ALTER TABLE `RECINTE`
  ADD PRIMARY KEY (`PK_CODI_RECINTE`);

--
-- Índexs per a la taula `TIPUS`
--
ALTER TABLE `TIPUS`
  ADD PRIMARY KEY (`PK_CODI_TIPUS`);

--
-- Índexs per a la taula `TIPUS_ESDEVENIMENT`
--
ALTER TABLE `TIPUS_ESDEVENIMENT`
  ADD PRIMARY KEY (`PK_FK_CODI_TIPUS`,`PK_FK_ID_TIPUS_ESDEVENIMENT`),
  ADD KEY `PK_FK_ID_TIPUS_ESDEVENIMENT` (`PK_FK_ID_TIPUS_ESDEVENIMENT`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `ENTRADA`
--
ALTER TABLE `ENTRADA`
  MODIFY `PK_NUMERO_ENTRADA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT per la taula `ESDEVENIMENT`
--
ALTER TABLE `ESDEVENIMENT`
  MODIFY `PK_ID_ESDEVENIMENT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT per la taula `PERSONA`
--
ALTER TABLE `PERSONA`
  MODIFY `PK_CODI_PERSONA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la taula `RECINTE`
--
ALTER TABLE `RECINTE`
  MODIFY `PK_CODI_RECINTE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la taula `TIPUS`
--
ALTER TABLE `TIPUS`
  MODIFY `PK_CODI_TIPUS` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `BUTACA`
--
ALTER TABLE `BUTACA`
  ADD CONSTRAINT `PK_FK_CODI_RECINTE` FOREIGN KEY (`PK_FK_CODI_RECINTE`) REFERENCES `RECINTE` (`PK_CODI_RECINTE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriccions per a la taula `ENTRADA`
--
ALTER TABLE `ENTRADA`
  ADD CONSTRAINT `FK_BUTACA` FOREIGN KEY (`FK_CODI_RECINTE`,`FK_FILA_BUTACA`,`FK_NUMERO_BUTACA`) REFERENCES `BUTACA` (`PK_FK_CODI_RECINTE`, `PK_FILA_BUTACA`, `PK_NUMERO_BUTACA`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CODI_PERSONA` FOREIGN KEY (`FK_CODI_PERSONA`) REFERENCES `PERSONA` (`PK_CODI_PERSONA`) ON UPDATE CASCADE,
  ADD CONSTRAINT `PK_FK_ID_ENTRADA_ESDEVENIMENT` FOREIGN KEY (`PK_FK_ID_ENTRADA_ESDEVENIMENT`) REFERENCES `ESDEVENIMENT` (`PK_ID_ESDEVENIMENT`) ON UPDATE CASCADE;

--
-- Restriccions per a la taula `ESDEVENIMENT`
--
ALTER TABLE `ESDEVENIMENT`
  ADD CONSTRAINT `FK_CODI_RECINTE` FOREIGN KEY (`FK_CODI_RECINTE`) REFERENCES `RECINTE` (`PK_CODI_RECINTE`) ON UPDATE CASCADE;

--
-- Restriccions per a la taula `TIPUS_ESDEVENIMENT`
--
ALTER TABLE `TIPUS_ESDEVENIMENT`
  ADD CONSTRAINT `PK_FK_CODI_TIPUS` FOREIGN KEY (`PK_FK_CODI_TIPUS`) REFERENCES `TIPUS` (`PK_CODI_TIPUS`) ON UPDATE CASCADE,
  ADD CONSTRAINT `PK_FK_ID_TIPUS_ESDEVENIMENT` FOREIGN KEY (`PK_FK_ID_TIPUS_ESDEVENIMENT`) REFERENCES `ESDEVENIMENT` (`PK_ID_ESDEVENIMENT`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
