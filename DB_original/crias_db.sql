-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 05-07-2022 a las 18:24:45
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crias_db`
--

DELIMITER $$
--
-- Funciones
--
DROP FUNCTION IF EXISTS `CLASIFICACION`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `CLASIFICACION` (`peso` INT, `colorMusculo` INT, `marmoleo` INT) RETURNS VARCHAR(20) CHARSET latin1 BEGIN
	
    declare c int;
    IF peso >= 15 || peso <= 25 THEN
     set c =c+1;
    END IF;
    
    IF colorMusculo >= 3 || colorMusculo <= 5 THEN
    set c =c+1;
    END IF;
    
    IF marmoleo >= 15 || marmoleo <= 25 THEN
    set c =c+1;
    END IF;
    
    CASE c
    WHEN 1 THEN RETURN 'GRASA TIPO 1';
    WHEN 2 THEN RETURN 'GRASA TIPO 1';
    WHEN 3 THEN RETURN 'GRASA TIPO 2';
    ELSE BEGIN END;
    END CASE;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corral`
--

DROP TABLE IF EXISTS `corral`;
CREATE TABLE IF NOT EXISTS `corral` (
  `id_corral` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `ubicacion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `capacidad` int(6) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_corral`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `corral`
--

INSERT INTO `corral` (`id_corral`, `nombre`, `ubicacion`, `capacidad`, `created_at`, `updated_at`) VALUES
(1, 'corral 1', 'ubicacion corral 1', 400, '2022-07-02 07:04:32', '2022-07-02 07:04:32'),
(2, 'corral 2', 'ubicacion corral 2', 400, '2022-07-02 07:04:32', '2022-07-02 07:04:32'),
(3, 'corral 3', 'ubicacion corral 3', 250, '2022-07-02 07:05:20', '2022-07-02 07:05:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cria`
--

DROP TABLE IF EXISTS `cria`;
CREATE TABLE IF NOT EXISTS `cria` (
  `id_cria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `peso` int(11) NOT NULL,
  `costo` int(11) NOT NULL,
  `colorMusculo` int(1) NOT NULL,
  `marmoleo` int(1) NOT NULL,
  `id_sensor` int(11) DEFAULT NULL,
  `id_corral` int(11) NOT NULL,
  `id_status` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_cria`),
  KEY `id_proveedor` (`id_proveedor`),
  KEY `id_sensor` (`id_sensor`),
  KEY `id_corral` (`id_corral`),
  KEY `status` (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cria`
--

INSERT INTO `cria` (`id_cria`, `nombre`, `descripcion`, `fecha`, `id_proveedor`, `peso`, `costo`, `colorMusculo`, `marmoleo`, `id_sensor`, `id_corral`, `id_status`, `created_at`, `updated_at`) VALUES
(2, 'prueba', 'prueba prueba', '2022-07-04', 1, 12, 1500, 1, 5, 1, 3, 2, '2022-07-04 10:17:03', '2022-07-05 17:31:12'),
(4, 'pruebass', 'prueba2', '2022-07-04', 1, 12, 1500, 2, 4, 3, 3, 2, '2022-07-04 10:28:39', '2022-07-05 17:31:18'),
(5, 'feliz', 'animal aniala', '2022-07-04', 1, 21, 1200, 3, 3, 4, 3, 2, '2022-07-04 10:30:45', '2022-07-05 17:52:43'),
(6, 'pedro', 'prueba cerdo 4', '2022-07-05', 3, 22, 1600, 4, 2, NULL, 3, 2, '2022-07-04 10:33:38', '2022-07-04 10:33:38'),
(7, 'Patricio', 'prueba con fecha', '2022-07-01', 2, 16, 160, 5, 1, NULL, 2, 1, '2022-07-04 11:55:25', '2022-07-04 11:55:25'),
(8, 'EDGAR', 'edgar el puerco', '2022-07-12', 2, 15, 800, 2, 4, NULL, 2, 1, '2022-07-04 16:50:37', '2022-07-04 16:50:37'),
(9, 'LUIS', 'CERDITO LUIS', '2022-07-08', 3, 18, 900, 4, 2, 5, 2, 1, '2022-07-05 17:32:57', '2022-07-05 17:33:52'),
(10, 'marcos', 'marcos prueba', '2022-07-15', 1, 16, 800, 4, 2, 6, 1, 1, '2022-07-05 17:51:15', '2022-07-05 17:52:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

DROP TABLE IF EXISTS `empleado`;
CREATE TABLE IF NOT EXISTS `empleado` (
  `id_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `apaterno` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `amaterno` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `contrasena` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `id_rol` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_empleado`),
  KEY `id_rol` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `nombre`, `apaterno`, `amaterno`, `email`, `contrasena`, `id_rol`, `created_at`, `updated_at`) VALUES
(4, 'oziel', 'pacheco', 'mateos', 'ozielpacheco.m@gmail.com', 'ba7816bf8f01cfea414140de5dae2223b00361a396177a9cb410ff61f20015ad', 1, '2022-07-03 05:17:29', '2022-07-03 05:17:29'),
(5, 'francisco', 'colmenares', 'perez', 'francisco.cpp@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 1, '2022-07-03 05:35:55', '2022-07-03 05:35:55'),
(8, 'prueba', 'preba', 'pruebas', 'prueba@correo.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 1, '2022-07-04 03:01:45', '2022-07-04 03:01:45'),
(9, 'oziel', 'pacheco', 'asdasd', 'micorreo@example.com', '3fe313175afea412da75d900bfa337c30e9ff315b9d07fc88663dee33007b96f', 2, '2022-07-04 03:15:59', '2022-07-04 03:15:59'),
(10, 'oziel', 'pacheco', 'Asdfaf', 'micorresso@example.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 3, '2022-07-04 03:17:00', '2022-07-04 03:17:00'),
(11, 'pedro', 'tepole', 'maternia', 'perdro@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 3, '2022-07-04 07:38:31', '2022-07-04 07:38:31'),
(12, 'PEDRO', 'JUAREZ', 'BRAVO', 'pedro@gmail.com', 'ba7816bf8f01cfea414140de5dae2223b00361a396177a9cb410ff61f20015ad', 2, '2022-07-05 17:37:36', '2022-07-05 17:37:36'),
(13, 'ramires', 'ra', 'ra', 'ramires@g.co', 'ba7816bf8f01cfea414140de5dae2223b00361a396177a9cb410ff61f20015ad', 1, '2022-07-05 17:53:32', '2022-07-05 17:53:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE IF NOT EXISTS `proveedor` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `nombre`, `direccion`, `telefono`, `email`, `created_at`, `updated_at`) VALUES
(1, 'cerditos felices', 'carretera federal, rancho escondido #2019, Queretaro, Queretaro.', '7538694120', 'contacto@cerditosfelices.com', '2022-07-02 06:41:35', '2022-07-02 06:41:35'),
(2, 'carnes frias s.a. de c.v.', 'francisco i. madero, rancho trinidad #78, Puebla, Puebla.', '4567891238', 'contacto@carnesfrias.com.mx', '2022-07-02 06:43:58', '2022-07-02 06:43:58'),
(3, 'oink carnes s.a. de c.v.', 'carretera federal, rancho regina s/n, Veracruz, Veracruz.', '1594872630', 'contacto@oinkcarnes.net', '2022-07-02 06:46:39', '2022-07-02 06:46:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', '2022-07-02 05:57:30', '2022-07-02 05:57:30'),
(2, 'Veterinario', '2022-07-02 05:57:30', '2022-07-02 05:57:30'),
(3, 'Aux. veterinario', '2022-07-02 05:59:52', '2022-07-02 05:59:52'),
(4, 'Personal de control', '2022-07-02 05:59:52', '2022-07-02 05:59:52'),
(5, 'Reclutador', '2022-07-02 06:00:52', '2022-07-02 06:00:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sensor`
--

DROP TABLE IF EXISTS `sensor`;
CREATE TABLE IF NOT EXISTS `sensor` (
  `id_sensor` int(11) NOT NULL AUTO_INCREMENT,
  `freCardiaca` int(3) NOT NULL,
  `preSanguinea` varchar(7) COLLATE utf8_spanish_ci NOT NULL,
  `freRespiratoria` int(3) NOT NULL,
  `temperatura` int(3) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_sensor`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sensor`
--

INSERT INTO `sensor` (`id_sensor`, `freCardiaca`, `preSanguinea`, `freRespiratoria`, `temperatura`, `created_at`, `updated_at`) VALUES
(1, 41, '120/70', 28, 56, '2022-07-05 04:19:39', '2022-07-05 17:21:11'),
(2, 15, '100/50', 15, 38, '2022-07-05 07:11:28', '2022-07-05 07:11:28'),
(3, 15, '100/50', 15, 38, '2022-07-05 07:24:17', '2022-07-05 07:24:17'),
(4, 100, '100/80', 100, 35, '2022-07-05 07:29:43', '2022-07-05 07:29:43'),
(5, 60, '120/60', 44, 37, '2022-07-05 17:33:52', '2022-07-05 17:33:52'),
(6, 60, '120/60', 45, 37, '2022-07-05 17:51:49', '2022-07-05 17:51:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`id_status`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'SANO', '2022-07-04 11:27:18', '2022-07-04 11:27:18'),
(2, 'ENFERMO', '2022-07-04 11:27:18', '2022-07-04 11:27:18'),
(3, 'FINADO', '2022-07-04 11:27:34', '2022-07-04 11:27:34');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cria`
--
ALTER TABLE `cria`
  ADD CONSTRAINT `cria_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cria_ibfk_2` FOREIGN KEY (`id_sensor`) REFERENCES `sensor` (`id_sensor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cria_ibfk_3` FOREIGN KEY (`id_corral`) REFERENCES `corral` (`id_corral`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cria_ibfk_4` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
