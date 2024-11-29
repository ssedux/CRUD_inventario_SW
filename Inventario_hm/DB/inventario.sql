-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-07-2023 a las 21:21:08
-- Versión del servidor: 8.0.33
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesorios`
--

CREATE TABLE `accesorios` (
  `Serie` varchar(35) NOT NULL,
  `marca` varchar(10) NOT NULL,
  `Modelo` varchar(30) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `Descripcion` varchar(100) DEFAULT NULL,
  `ID_equipo` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
ALTER TABLE `accesorios`
  ADD PRIMARY KEY (`Serie`),
  ADD KEY `ID_equipo` (`ID_equipo`);
--
-- Volcado de datos para la tabla `accesorios`
--

INSERT INTO `accesorios` (`Serie`, `marca`, `Modelo`, `tipo`, `Descripcion`, `ID_equipo`) VALUES
('FCGNF0ECW5P18C', 'HP', 'M-U0031-0', 'Mouse', 'Mouse USB', '1733-11-8M');



--
-- Estructura de tabla para la tabla `inventariof`
--

CREATE TABLE `inventariof` (
  `N_inventario` varchar(25) NOT NULL,
  `fecha` date NOT NULL,
  `Unidad` varchar(50) NOT NULL,
  `Tipo_equipo` varchar(35) DEFAULT NULL,
  `Marca` varchar(10) DEFAULT NULL,
  `Modelo` varchar(15) DEFAULT NULL,
  `Serie` varchar(35) DEFAULT NULL,
  `caracteristicas` varchar(255) DEFAULT NULL,
  `estado` varchar(11) NOT NULL,
  PRIMARY KEY (`N_inventario`)  -- Definir la clave primaria
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
--
-- Volcado de datos para la tabla `inventariof`
--

  INSERT INTO `inventariof` (`N_inventario`, `fecha`, `Unidad`, `Tipo_equipo`, `Marca`, `Modelo`, `Serie`, `caracteristicas`, `estado`) VALUES
  ('1733-11-8M', '2011-02-21', 'Nacer con cariño', 'Monitor', 'Samsung', 'SYNMASTERE1920', 'V83H9NZAO9615H', 'Monitor pantalla plana', 'descartado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_sw`
--

CREATE TABLE `inventario_sw` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `ID_equipo` varchar(25) NOT NULL,  -- El campo que debe coincidir con N_inventario en inventariof
  `ver_windows` varchar(25) DEFAULT NULL,
  `Key_W` varchar(30) DEFAULT NULL,
  `ver_office` varchar(25) DEFAULT NULL,
  `Key_of` varchar(30) DEFAULT NULL,
  `Antivirus` varchar(25) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `Ip_interna` varchar(15) NOT NULL,
  `otra_ip` varchar(15) DEFAULT NULL,
  `ip02` varchar(17) DEFAULT NULL,
  `ip03` varchar(17) DEFAULT NULL,
  `maclan` varchar(20) DEFAULT NULL,
  `macwifi` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  CONSTRAINT `fk_inventariof` FOREIGN KEY (`ID_equipo`) REFERENCES `inventariof` (`N_inventario`)  -- Clave foránea
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
--
-- Volcado de datos para la tabla `inventario_sw`
--

INSERT INTO `inventario_sw` (`ID`, `ID_equipo`, `ver_windows`, `Key_W`, `ver_office`, `Key_of`, `Antivirus`, `fecha_inicio`, `Ip_interna`, `otra_ip`, `ip02`, `ip03`, `maclan`, `macwifi`) VALUES
(3, '1733-11-8M', '7 Profecional', 'XXXXX-XXXXX-XXXXX-XXXXX-XXXXX', '2010', 'xxxxxx-xxxx-xxx', 'Avast', '2023-07-27', '192.168.0.1', '63.90.00.10', '10', '10.255.255.255', '10.0.0.1', '102');



COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
