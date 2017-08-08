-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-08-2017 a las 23:50:10
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_ventas`
--
CREATE DATABASE IF NOT EXISTS `db_ventas` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_ventas`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `access`
--

DROP TABLE IF EXISTS `access`;
CREATE TABLE IF NOT EXISTS `access` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_group` int(11) NOT NULL,
  `id_permission` int(11) NOT NULL,
  `id_app` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

DROP TABLE IF EXISTS `almacen`;
CREATE TABLE IF NOT EXISTS `almacen` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_tercero` int(11) DEFAULT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`id_record`, `id_tercero`, `id_empleado`, `created_on`, `created_by`, `active`) VALUES
(1, 15, 1, '2017-03-28 23:58:22', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

DROP TABLE IF EXISTS `articulo`;
CREATE TABLE IF NOT EXISTS `articulo` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_suplidor` int(11) DEFAULT NULL,
  `id_subcategoria` int(11) DEFAULT NULL,
  `codigo_barra` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`id_record`, `id_suplidor`, `id_subcategoria`, `codigo_barra`, `description`, `created_on`, `created_by`, `active`) VALUES
(1, 1, 3, '213123123123', 'Oro 24k', '2017-03-30 04:42:44', 1, 1),
(3, 1, 6, '434345345', 'Plata', '2017-04-18 19:18:59', 1, 1),
(4, 1, 7, '123123123123345', 'Cobre', '2017-04-18 15:33:48', 1, 1),
(6, 1, 8, '564654651651651654', 'Plata', '2017-03-30 04:51:07', 1, 1),
(7, 1, 4, '789689435', 'Planta Brillante', '2017-04-20 04:49:14', 1, 1),
(8, 1, 8, '4987987WERIT', 'aretes de oro', '2017-07-15 20:21:29', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(250) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_record`, `description`, `created_on`, `created_by`, `active`) VALUES
(1, 'Hombre', '2017-03-22 12:58:23', 1, 1),
(2, 'Mujer', '2017-03-22 12:58:28', 1, 1),
(3, 'NiÃ±os', '2017-03-22 12:58:34', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

DROP TABLE IF EXISTS `ciudad`;
CREATE TABLE IF NOT EXISTS `ciudad` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_pais` int(11) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`id_record`, `id_pais`, `description`, `created_on`, `created_by`, `active`) VALUES
(1, 2, 'Santo Domingo', '2017-03-22 03:40:56', 1, 1),
(2, 2, 'Santiago', '2017-03-22 03:34:21', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) NOT NULL,
  `telefono` varchar(250) NOT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_record`, `id_persona`, `telefono`, `id_tipo`, `created_on`, `created_by`, `active`) VALUES
(1, 5, '8093555339', 1, '2017-03-22 05:34:41', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

DROP TABLE IF EXISTS `compra`;
CREATE TABLE IF NOT EXISTS `compra` (
  `id_record` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_solicitud` int(11) DEFAULT NULL,
  `no_factura` varchar(50) DEFAULT NULL,
  `requisition_date` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `tipo_pago` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id_record`, `id_solicitud`, `no_factura`, `requisition_date`, `status`, `tipo_pago`, `created_on`, `created_by`, `active`) VALUES
(1, 4, '132133', '2017-04-15', 25, 21, '2017-04-12 17:27:22', 1, 1),
(2, 5, '56756734562436', '2017-04-14', 25, 21, '2017-07-19 06:30:27', 1, 1),
(3, 10, '465465465464', '2017-04-21', 25, 21, '2017-04-20 05:48:21', 1, 1),
(4, 8, '345345346346', '2017-04-20', 25, 21, '2017-07-19 06:30:28', 1, 1),
(5, 9, '56756734562436', '2017-04-20', 25, 21, '2017-07-19 06:30:28', 1, 1),
(6, 13, '45678782896387', '2017-07-27', 25, 21, '2017-07-19 06:30:29', 1, 1),
(7, 14, '345345346346', '2017-07-29', 25, 21, '2017-07-19 06:30:29', 1, 1),
(9, 16, NULL, '2017-08-09', 2, 21, '2017-08-06 06:40:35', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuadre_terminal`
--

DROP TABLE IF EXISTS `cuadre_terminal`;
CREATE TABLE IF NOT EXISTS `cuadre_terminal` (
  `id_record` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_terminal` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `current_amount` decimal(18,2) DEFAULT NULL,
  `amount` decimal(18,2) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_record`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta_por_cobrar`
--

DROP TABLE IF EXISTS `cuenta_por_cobrar`;
CREATE TABLE IF NOT EXISTS `cuenta_por_cobrar` (
  `id_record` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_factura` int(11) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `cuenta_por_cobrar_id_record_uindex` (`id_record`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta_por_pagar`
--

DROP TABLE IF EXISTS `cuenta_por_pagar`;
CREATE TABLE IF NOT EXISTS `cuenta_por_pagar` (
  `id_recird` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_compra` int(11) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_recird`),
  UNIQUE KEY `cuenta_por_pagar_id_recird_uindex` (`id_recird`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuenta_por_pagar`
--

INSERT INTO `cuenta_por_pagar` (`id_recird`, `id_compra`, `id_tipo`, `created_on`, `active`) VALUES
(1, 9, 32, '2017-08-06 02:40:35', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuento`
--

DROP TABLE IF EXISTS `descuento`;
CREATE TABLE IF NOT EXISTS `descuento` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_articulo` int(11) DEFAULT NULL,
  `id_subcategoria` int(11) DEFAULT NULL,
  `porcentaje` float DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` int(11) DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `descuento`
--

INSERT INTO `descuento` (`id_record`, `id_articulo`, `id_subcategoria`, `porcentaje`, `created_by`, `created_on`, `active`) VALUES
(1, 0, 3, 10, 1, '2017-04-13 20:37:12', 1),
(2, 3, 0, 5, 1, '2017-04-13 20:37:25', 1),
(3, 4, 0, 1, 1, '2017-04-18 19:22:43', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

DROP TABLE IF EXISTS `detalle_factura`;
CREATE TABLE IF NOT EXISTS `detalle_factura` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_factura` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `precio` double(18,2) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_factura`
--

INSERT INTO `detalle_factura` (`id_record`, `id_factura`, `id_articulo`, `qty`, `precio`, `created_on`, `created_by`, `active`) VALUES
(1, 1, 1, 1, 870.74, '2017-04-20 04:22:01', 1, 1),
(2, 2, 3, 1, 537.76, '2017-04-20 04:13:41', 1, 1),
(3, 3, 1, 1, 849.74, '2017-04-20 04:13:41', 1, 1),
(4, 5, 1, 7, 880.74, '2017-04-20 04:22:01', 1, 1),
(5, 5, 7, 7, 849.74, '2017-04-20 07:02:25', 1, 1),
(6, 5, 3, 2, 537.76, '2017-04-20 03:59:43', 1, 1),
(7, 5, 4, 2, 463.54, '2017-04-20 03:59:43', 1, 1),
(8, 6, 3, 3, 538.96, '2017-07-19 03:39:37', 1, 1),
(9, 8, 1, 1, 851.42, '2017-07-19 03:42:48', 1, 1),
(10, 10, 1, 2, 851.42, '2017-07-19 03:50:13', 1, 1),
(11, 13, 1, 2, 851.42, '2017-07-19 03:54:45', 1, 1),
(12, 14, 1, 3, 851.42, '2017-07-19 03:55:42', 1, 1),
(13, 15, 3, 2, 538.96, '2017-07-19 04:15:46', 1, 1),
(14, 16, 1, 6, 851.42, '2017-07-19 05:27:52', 1, 1),
(15, 16, 6, 30, 900.00, '2017-07-19 05:31:15', 1, 1),
(16, 17, 1, 2, 851.42, '2017-08-03 04:19:23', 1, 1),
(17, 17, 7, 2, 0.00, '2017-08-03 04:19:23', 1, 1),
(18, 18, 1, 1, 851.42, '2017-08-03 04:26:14', 1, 1),
(19, 18, 7, 2, 0.00, '2017-08-03 04:26:14', 1, 1),
(20, 19, 1, 1, 851.42, '2017-08-03 04:26:49', 1, 1),
(21, 19, 7, 2, 0.00, '2017-08-03 04:26:49', 1, 1),
(22, 22, 3, 2, 538.96, '2017-08-03 04:35:19', 1, 1),
(23, 27, 4, 2, 379.96, '2017-08-03 04:41:24', 1, 1),
(24, 27, 4, 2, 463.94, '2017-08-03 04:41:24', 1, 1),
(25, 28, 4, 1, 379.96, '2017-08-03 04:43:01', 1, 1),
(26, 28, 4, 1, 463.94, '2017-08-03 04:43:01', 1, 1),
(27, 29, 4, 2, 379.96, '2017-08-03 04:45:55', 1, 1),
(28, 29, 4, 2, 463.94, '2017-08-03 04:45:55', 1, 1),
(29, 30, 4, 1, 379.96, '2017-08-03 04:47:40', 1, 1),
(30, 30, 4, 1, 463.94, '2017-08-03 04:47:40', 1, 1),
(31, 31, 4, 1, 379.96, '2017-08-03 04:48:24', 1, 1),
(32, 31, 4, 1, 463.94, '2017-08-03 04:48:24', 1, 1),
(33, 32, 4, 1, 379.96, '2017-08-03 04:49:00', 1, 1),
(34, 32, 4, 1, 463.94, '2017-08-03 04:49:00', 1, 1),
(35, 33, 4, 1, 379.96, '2017-08-03 04:50:21', 1, 1),
(36, 33, 4, 1, 463.94, '2017-08-03 04:50:21', 1, 1),
(37, 34, 4, 1, 379.96, '2017-08-03 04:54:29', 1, 1),
(38, 34, 4, 1, 463.94, '2017-08-03 04:54:29', 1, 1),
(39, 36, 4, 1, 379.96, '2017-08-03 04:58:50', 1, 1),
(40, 36, 4, 1, 463.94, '2017-08-03 04:58:50', 1, 1),
(41, 37, 4, 2, 379.96, '2017-08-03 05:01:24', 1, 1),
(42, 37, 4, 2, 463.94, '2017-08-03 05:01:24', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura_tmp`
--

DROP TABLE IF EXISTS `detalle_factura_tmp`;
CREATE TABLE IF NOT EXISTS `detalle_factura_tmp` (
  `id_record` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_articulo` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id_record`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_solicitud`
--

DROP TABLE IF EXISTS `detalle_solicitud`;
CREATE TABLE IF NOT EXISTS `detalle_solicitud` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_solicitud` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `id_unidad` int(11) NOT NULL,
  `qty` double NOT NULL DEFAULT '0',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_solicitud`
--

INSERT INTO `detalle_solicitud` (`id_record`, `id_solicitud`, `id_articulo`, `id_unidad`, `qty`, `created_on`, `created_by`, `active`) VALUES
(3, 4, 1, 1, 1, '2017-04-12 14:23:04', 1, 1),
(4, 4, 3, 1, 2, '2017-04-12 14:23:04', 1, 1),
(5, 4, 4, 1, 7, '2017-04-12 14:23:04', 1, 1),
(6, 4, 1, 1, 9, '2017-04-12 14:23:04', 1, 1),
(7, 5, 3, 1, 1, '2017-04-12 14:23:04', 1, 1),
(8, 5, 4, 1, 2, '2017-04-12 14:23:04', 1, 1),
(9, 5, 1, 1, 2, '2017-04-12 14:23:04', 1, 1),
(10, 5, 3, 1, 2, '2017-04-12 14:23:04', 1, 1),
(11, 5, 4, 1, 1, '2017-04-12 14:23:04', 1, 1),
(12, 5, 1, 1, 1, '2017-04-12 14:23:04', 1, 1),
(13, 5, 3, 1, 2, '2017-04-12 14:23:04', 1, 1),
(14, 5, 4, 1, 1, '2017-04-12 14:23:04', 1, 1),
(15, 8, 3, 1, 2, '2017-04-12 14:23:04', 1, 1),
(16, 8, 3, 1, 8, '2017-04-12 14:23:04', 1, 1),
(17, 8, 4, 1, 5, '2017-04-12 14:23:04', 1, 1),
(19, 8, 1, 1, 6, '2017-04-12 14:23:04', 1, 1),
(20, 8, 1, 1, 1, '2017-04-12 14:23:04', 1, 1),
(21, 8, 1, 1, 1, '2017-04-12 14:23:04', 1, 1),
(22, 9, 1, 1, 1, '2017-04-12 14:23:04', 1, 1),
(23, 9, 3, 1, 1, '2017-04-12 14:23:04', 1, 1),
(24, 9, 4, 1, 2, '2017-04-12 14:23:04', 1, 1),
(25, 10, 7, 3, 10, '2017-04-20 04:51:00', 1, 1),
(26, 10, 6, 4, 5, '2017-04-20 04:51:01', 1, 1),
(27, 11, 8, 1, 10, '2017-07-19 06:16:05', 1, 1),
(28, 12, 8, 3, 10, '2017-07-19 06:16:37', 1, 1),
(29, 13, 6, 1, 10, '2017-07-19 06:17:37', 1, 1),
(30, 14, 4, 1, 10, '2017-07-19 06:18:01', 1, 1),
(31, 15, 1, 3, 10, '2017-08-06 06:33:18', 1, 1),
(32, 16, 1, 3, 12, '2017-08-06 06:37:29', 1, 1),
(33, 16, 7, 3, 12, '2017-08-06 06:37:29', 1, 1),
(34, 16, 3, 3, 12, '2017-08-06 06:37:29', 1, 1),
(35, 16, 4, 3, 12, '2017-08-06 06:37:29', 1, 1),
(36, 16, 4, 3, 12, '2017-08-06 06:37:29', 1, 1),
(37, 16, 8, 3, 12, '2017-08-06 06:37:29', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_solicitud_tmp`
--

DROP TABLE IF EXISTS `detalle_solicitud_tmp`;
CREATE TABLE IF NOT EXISTS `detalle_solicitud_tmp` (
  `id_record` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_articulo` int(11) DEFAULT '0',
  `id_unidad` decimal(18,2) DEFAULT '0.00',
  `qty` decimal(18,2) DEFAULT '0.00',
  `id_user` decimal(18,2) DEFAULT '0.00',
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id_record`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_transferencia_mercancia`
--

DROP TABLE IF EXISTS `detalle_transferencia_mercancia`;
CREATE TABLE IF NOT EXISTS `detalle_transferencia_mercancia` (
  `id_record` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_articulo` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `id_transferencia` int(11) DEFAULT NULL,
  `id_unidad` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `detalle_transferencia_mercancia_id_record_uindex` (`id_record`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_transferencia_mercancia_tmp`
--

DROP TABLE IF EXISTS `detalle_transferencia_mercancia_tmp`;
CREATE TABLE IF NOT EXISTS `detalle_transferencia_mercancia_tmp` (
  `id_record` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_articulo` int(11) DEFAULT NULL,
  `id_unidad` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `detalle_transferencia_mercancia_tmp_id_record_uindex` (`id_record`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devolucion`
--

DROP TABLE IF EXISTS `devolucion`;
CREATE TABLE IF NOT EXISTS `devolucion` (
  `id_record` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_factura` int(11) DEFAULT NULL,
  `id_articulo` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_record`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

DROP TABLE IF EXISTS `direccion`;
CREATE TABLE IF NOT EXISTS `direccion` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_tercero` int(11) DEFAULT NULL,
  `id_sector` int(11) DEFAULT NULL,
  `direccion` varchar(250) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`id_record`, `id_tercero`, `id_sector`, `direccion`, `created_on`, `created_by`, `active`) VALUES
(1, 4, 1, '8550 NW 70th ST\\nMCP-195', NULL, 1, 1),
(2, 6, 1, '8550 NW 70th ST\\nMCP-195', NULL, 1, 1),
(3, 13, 1, 'av las caobas', NULL, 1, 1),
(4, 15, 1, 'esq 23.', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

DROP TABLE IF EXISTS `empleado`;
CREATE TABLE IF NOT EXISTS `empleado` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) NOT NULL,
  `telefono` varchar(250) NOT NULL,
  `admission_date` date NOT NULL,
  `estado_civil` varchar(100) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_record`, `id_persona`, `telefono`, `admission_date`, `estado_civil`, `id_tipo`, `created_on`, `created_by`, `active`) VALUES
(1, 3, '8093555339', '2017-03-22', 'soltero', 1, '2017-03-22 05:25:15', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

DROP TABLE IF EXISTS `empresa`;
CREATE TABLE IF NOT EXISTS `empresa` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_tercero` int(11) NOT NULL,
  `rnc` varchar(100) NOT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_record`, `id_tercero`, `rnc`, `id_tipo`, `telefono`, `created_on`, `created_by`, `active`) VALUES
(1, 14, '80990809898', 1, '809-567-3456', '2017-03-22 19:54:08', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exception`
--

DROP TABLE IF EXISTS `exception`;
CREATE TABLE IF NOT EXISTS `exception` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_permission` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

DROP TABLE IF EXISTS `factura`;
CREATE TABLE IF NOT EXISTS `factura` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT '0',
  `monto` decimal(10,0) NOT NULL DEFAULT '0',
  `no_factura` varchar(50) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `descuento` decimal(18,2) DEFAULT NULL,
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id_record`, `id_cliente`, `monto`, `no_factura`, `created_on`, `created_by`, `active`, `descuento`) VALUES
(1, 16, '4289', '1', '2017-04-19 20:02:43', 1, 1, '3.00'),
(2, 16, '7896', '2', '2017-04-19 20:41:46', 1, 1, '3.00'),
(3, 16, '457', '3', '2017-04-19 21:09:52', 1, 1, '3.00'),
(5, 16, '6452', '4', '2017-04-20 03:59:43', 1, 1, '4.00'),
(6, 16, '1617', '6', '2017-07-19 03:39:37', 1, 1, '0.00'),
(7, 16, '1617', '7', '2017-07-19 03:39:41', 1, 1, '0.00'),
(8, 16, '851', '8', '2017-07-19 03:42:48', 1, 1, '0.00'),
(9, 16, '851', '9', '2017-07-19 03:43:23', 1, 1, '0.00'),
(10, 16, '1703', '10', '2017-07-19 03:50:13', 1, 1, '0.00'),
(11, 16, '1703', '11', '2017-07-19 03:50:21', 1, 1, '0.00'),
(14, 16, '2554', '12', '2017-07-19 03:55:42', 1, 1, '0.00'),
(15, 16, '1078', '15', '2017-07-19 04:15:46', 1, 1, '0.00'),
(16, 16, '5109', '16', '2017-07-19 05:27:52', 1, 1, '0.00'),
(17, 16, '1703', '17', '2017-08-03 04:19:23', 1, 1, '0.00'),
(18, 16, '851', '18', '2017-08-03 04:26:14', 1, 1, '0.00'),
(19, 16, '851', '19', '2017-08-03 04:26:49', 1, 1, '0.00'),
(22, 16, '1078', '22', '2017-08-03 04:35:19', 1, 1, '0.00'),
(27, 16, '1688', '23', '2017-08-03 04:41:24', 1, 1, '0.00'),
(28, 16, '844', '28', '2017-08-03 04:43:01', 1, 1, '0.00'),
(29, 16, '1688', '29', '2017-08-03 04:45:55', 1, 1, '0.00'),
(30, 16, '844', '30', '2017-08-03 04:47:40', 1, 1, '0.00'),
(31, 16, '844', '31', '2017-08-03 04:48:24', 1, 1, '0.00'),
(32, 16, '844', '32', '2017-08-03 04:49:00', 1, 1, '0.00'),
(33, 16, '844', '33', '2017-08-03 04:50:21', 1, 1, '0.00'),
(34, 16, '844', '34', '2017-08-03 04:54:28', 1, 1, '0.00'),
(35, 16, '844', '35', '2017-08-03 04:55:53', 1, 1, '0.00'),
(36, 16, '844', '36', '2017-08-03 04:58:50', 1, 1, '0.00'),
(37, 16, '1688', '37', '2017-08-03 05:01:24', 1, 1, '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group`
--

DROP TABLE IF EXISTS `group`;
CREATE TABLE IF NOT EXISTS `group` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(250) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_usuario`
--

DROP TABLE IF EXISTS `historial_usuario`;
CREATE TABLE IF NOT EXISTS `historial_usuario` (
  `id_record` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `login` datetime DEFAULT NULL,
  `logout` datetime DEFAULT NULL,
  PRIMARY KEY (`id_record`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impuesto`
--

DROP TABLE IF EXISTS `impuesto`;
CREATE TABLE IF NOT EXISTS `impuesto` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_subcategoria` varchar(250) DEFAULT NULL,
  `id_articulo` varchar(250) DEFAULT NULL,
  `porcentaje` float NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `impuesto`
--

INSERT INTO `impuesto` (`id_record`, `id_subcategoria`, `id_articulo`, `porcentaje`, `created_on`, `created_by`, `active`) VALUES
(1, '0', '1', 18, '2017-04-10 22:49:52', 0, 1),
(2, '3', '0', 10, '2017-04-10 23:04:24', 0, 1),
(3, '4', '0', 5, '2017-04-10 23:07:44', 1, 1),
(4, '0', '3', 7, '2017-04-10 23:07:54', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

DROP TABLE IF EXISTS `inventario`;
CREATE TABLE IF NOT EXISTS `inventario` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_articulo` int(11) DEFAULT NULL,
  `id_almacen` int(11) DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id_record`, `id_articulo`, `id_almacen`, `qty`, `created_on`, `created_by`, `active`) VALUES
(15, 1, 1, 0, '2017-08-03 00:26:41', 1, 1),
(16, 3, 1, 0, '2017-08-03 00:35:13', 1, 1),
(17, 4, 1, 4, '2017-08-03 01:00:58', 1, 1),
(41, 6, 1, 10, '2017-07-19 02:30:29', 1, 1),
(42, 7, 1, 114, '2017-08-03 00:26:27', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento_cuenta`
--

DROP TABLE IF EXISTS `movimiento_cuenta`;
CREATE TABLE IF NOT EXISTS `movimiento_cuenta` (
  `id_record` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_cuenta` bigint(20) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `movimiento_cuenta_id_record_uindex` (`id_record`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento_inventario`
--

DROP TABLE IF EXISTS `movimiento_inventario`;
CREATE TABLE IF NOT EXISTS `movimiento_inventario` (
  `id_record` int(11) NOT NULL AUTO_INCREMENT,
  `id_inventario` int(11) NOT NULL,
  `qty` double NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `movimiento_inventario`
--

INSERT INTO `movimiento_inventario` (`id_record`, `id_inventario`, `qty`, `id_tipo`, `created_on`, `created_by`, `active`) VALUES
(1, 15, 10, 26, '2017-04-12 18:09:15', 1, 1),
(2, 16, 2, 26, '2017-04-12 18:11:20', 1, 1),
(3, 17, 7, 26, '2017-04-12 18:11:35', 1, 1),
(22, 41, 30, 26, '2017-04-20 05:48:21', 1, 1),
(23, 42, 120, 26, '2017-04-20 05:48:21', 1, 1),
(24, 15, -2, 27, '2017-07-19 04:34:21', 1, 1),
(25, 15, -4, 27, '2017-07-19 04:35:41', 1, 1),
(26, 41, -10, 27, '2017-07-19 04:38:58', 1, 1),
(27, 41, -10, 27, '2017-07-19 04:39:02', 1, 1),
(28, 41, -10, 27, '2017-07-19 04:41:29', 1, 1),
(29, 15, 3, 26, '2017-07-19 06:23:56', 1, 1),
(30, 15, 3, 26, '2017-07-19 06:24:48', 1, 1),
(31, 15, 3, 26, '2017-07-19 06:30:07', 1, 1),
(32, 15, 3, 26, '2017-07-19 06:30:27', 1, 1),
(33, 16, 5, 26, '2017-07-19 06:30:27', 1, 1),
(34, 15, 8, 26, '2017-07-19 06:30:28', 1, 1),
(35, 16, 10, 26, '2017-07-19 06:30:28', 1, 1),
(36, 15, 1, 26, '2017-07-19 06:30:28', 1, 1),
(37, 16, 1, 26, '2017-07-19 06:30:28', 1, 1),
(38, 41, 10, 26, '2017-07-19 06:30:29', 1, 1),
(39, 17, 10, 26, '2017-07-19 06:30:29', 1, 1),
(40, 15, -1, 27, '2017-08-03 04:18:30', 1, 1),
(41, 15, -1, 27, '2017-08-03 04:18:34', 1, 1),
(42, 42, -2, 27, '2017-08-03 04:18:58', 1, 1),
(43, 15, -1, 27, '2017-08-03 04:25:15', 1, 1),
(44, 42, -1, 27, '2017-08-03 04:25:22', 1, 1),
(45, 42, -1, 27, '2017-08-03 04:25:25', 1, 1),
(46, 42, -1, 27, '2017-08-03 04:26:25', 1, 1),
(47, 42, -1, 27, '2017-08-03 04:26:27', 1, 1),
(48, 15, -1, 27, '2017-08-03 04:26:41', 1, 1),
(49, 16, -1, 27, '2017-08-03 04:35:11', 1, 1),
(50, 16, -1, 27, '2017-08-03 04:35:13', 1, 1),
(51, 17, -1, 27, '2017-08-03 04:40:34', 1, 1),
(52, 17, -1, 27, '2017-08-03 04:40:39', 1, 1),
(53, 17, -1, 27, '2017-08-03 04:42:51', 1, 1),
(54, 17, -1, 27, '2017-08-03 04:45:35', 1, 1),
(55, 17, -1, 27, '2017-08-03 04:45:45', 1, 1),
(56, 17, -1, 27, '2017-08-03 04:47:35', 1, 1),
(57, 17, -1, 27, '2017-08-03 04:48:18', 1, 1),
(58, 17, -1, 27, '2017-08-03 04:48:57', 1, 1),
(59, 17, -1, 27, '2017-08-03 04:50:03', 1, 1),
(60, 17, -1, 27, '2017-08-03 04:54:21', 1, 1),
(61, 17, -1, 27, '2017-08-03 04:58:40', 1, 1),
(62, 17, -1, 27, '2017-08-03 05:00:33', 1, 1),
(63, 17, -1, 27, '2017-08-03 05:00:58', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nacionalidad`
--

DROP TABLE IF EXISTS `nacionalidad`;
CREATE TABLE IF NOT EXISTS `nacionalidad` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_pais` int(11) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nacionalidad`
--

INSERT INTO `nacionalidad` (`id_record`, `id_pais`, `description`, `created_on`, `created_by`, `active`) VALUES
(1, 2, 'Dominicana', '2017-03-22 14:08:14', 1, 1),
(2, 3, 'Puerto RiqueÃ±o', '2017-07-09 20:43:23', 0, 1),
(3, 4, 'Mexicano', '2017-07-09 20:44:52', 0, 1),
(4, 5, 'BrazileÃ±o', '2017-07-09 20:45:17', 0, 1),
(5, 6, 'Argentino', '2017-07-09 20:45:48', 0, 1),
(6, 7, 'Canadience', '2017-07-09 20:46:02', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

DROP TABLE IF EXISTS `pais`;
CREATE TABLE IF NOT EXISTS `pais` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(250) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id_record`, `description`, `created_on`, `created_by`, `active`) VALUES
(2, 'Republica Dominicana', '2017-03-22 02:42:19', 1, 1),
(3, 'Puerto Rico', '2017-07-09 20:43:23', 1, 1),
(4, 'Mexico', '2017-07-09 20:44:52', 1, 1),
(5, 'Brazil', '2017-07-09 20:45:17', 1, 1),
(6, 'Argentina', '2017-07-09 20:45:48', 1, 1),
(7, 'Canada', '2017-07-09 20:46:02', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

DROP TABLE IF EXISTS `persona`;
CREATE TABLE IF NOT EXISTS `persona` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_tercero` int(11) NOT NULL,
  `apellidos` varchar(250) NOT NULL,
  `cedula` varchar(50) NOT NULL,
  `sexo` varchar(30) DEFAULT NULL,
  `birthdate` date NOT NULL DEFAULT '0000-00-00',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id_record`, `id_tercero`, `apellidos`, `cedula`, `sexo`, `birthdate`, `created_on`, `created_by`, `active`) VALUES
(1, 2, 'ESPINAL', '809-7889569-9', 'masculino', '2017-03-29', '2017-03-29 01:28:34', 1, NULL),
(2, 3, 'ESPINAL', '809-7889569-9', 'masculino', '2017-03-29', '2017-03-29 01:28:37', 1, NULL),
(3, 4, 'ESPINAL', '809-7889569-9', 'masculino', '2017-03-29', '2017-03-29 01:28:41', 1, NULL),
(4, 5, 'ESPINAL', '809-7889878-9', 'masculino', '2017-03-22', '2017-03-29 01:28:44', 1, NULL),
(5, 6, 'ESPINAL', '809-7889878-9', 'masculino', '2017-03-22', '2017-03-29 01:28:47', 1, NULL),
(6, 7, 'ottenwalder espinal', '809-7889459-9', 'masculino', '2017-03-22', '2017-03-22 18:18:10', 1, NULL),
(7, 8, 'ottenwalder espinal', '809-7889459-9', 'masculino', '2017-03-22', '2017-03-22 18:18:19', 1, NULL),
(8, 9, 'ottenwalder espinal', '809-7889459-9', 'masculino', '2017-03-22', '2017-03-22 18:19:15', 1, NULL),
(9, 10, 'Rodriguez', '789-7899899-9', 'masculino', '2017-03-22', '2017-04-03 01:55:02', 1, NULL),
(10, 11, 'Rodriguez', '789-789-789', 'masculino', '2017-03-22', '2017-04-03 01:55:04', 1, NULL),
(11, 12, 'Rodriguez', '789-789-789', 'masculino', '2017-03-22', '2017-04-03 01:55:05', 1, NULL),
(12, 13, 'Rodriguez', '789-789-789', 'masculino', '2017-03-22', '2017-04-03 01:55:07', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `porcentaje_ganancia`
--

DROP TABLE IF EXISTS `porcentaje_ganancia`;
CREATE TABLE IF NOT EXISTS `porcentaje_ganancia` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_articulo` int(11) NOT NULL,
  `id_subcategoria` int(11) NOT NULL,
  `porcentaje` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `porcentaje_ganancia`
--

INSERT INTO `porcentaje_ganancia` (`id_record`, `id_articulo`, `id_subcategoria`, `porcentaje`, `created_by`, `created_on`, `active`) VALUES
(1, 3, 3, 10, 1, '2017-04-13 18:12:34', 1),
(2, 1, 0, 15, 1, '2017-04-10 15:26:22', 1),
(3, 4, 6, 5, 1, '2017-04-13 18:12:36', 1),
(5, 4, 0, 4, 1, '2017-04-10 22:29:47', 1),
(6, 1, 8, 7, 1, '2017-04-13 18:12:32', 1),
(7, 4, 5, 9, 1, '2017-04-13 18:12:30', 1),
(8, 3, 0, 8, 1, '2017-04-10 22:31:55', 1),
(9, 1, 6, 7, 1, '2017-04-13 18:12:26', 1),
(10, 2, 4, 2, 1, '2017-04-13 18:12:29', 1),
(11, 6, 0, 5, 1, '2017-04-10 22:35:49', 1),
(12, 4, 0, 3, 1, '2017-04-18 15:22:22', 1),
(13, 7, 0, 2, 1, '2017-04-20 00:54:49', 1),
(14, 6, 0, 2, 1, '2017-04-20 00:55:01', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precio_articulo`
--

DROP TABLE IF EXISTS `precio_articulo`;
CREATE TABLE IF NOT EXISTS `precio_articulo` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_articulo` int(11) DEFAULT NULL,
  `precio` decimal(18,2) DEFAULT NULL,
  `id_suplidor` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `precio_articulo`
--

INSERT INTO `precio_articulo` (`id_record`, `id_articulo`, `precio`, `id_suplidor`, `created_on`, `created_by`, `active`) VALUES
(1, 1, '800.96', 1, '2017-03-30 00:25:54', 1, 1),
(2, 3, '500.89', 1, '2017-04-02 17:57:23', 1, 1),
(3, 4, '450.56', 1, '2017-04-02 17:57:34', 1, 1),
(4, 6, '450.00', 1, '2017-04-04 15:52:16', 1, 1),
(6, 7, '746.00', 1, '2017-04-20 01:01:00', 1, 1),
(7, 7, '745.00', 1, '2017-04-20 01:01:02', 1, 1),
(8, 4, '369.00', NULL, '2017-04-20 01:01:26', 1, 1),
(9, 7, '966.00', 1, '2017-04-20 01:02:55', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sector`
--

DROP TABLE IF EXISTS `sector`;
CREATE TABLE IF NOT EXISTS `sector` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_ciudad` int(11) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sector`
--

INSERT INTO `sector` (`id_record`, `id_ciudad`, `description`, `created_on`, `created_by`, `active`) VALUES
(1, 2, 'Las Colinas', '2017-03-22 03:49:21', 1, 1),
(2, 2, 'Gurabo', '2017-03-22 03:49:52', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_compra`
--

DROP TABLE IF EXISTS `solicitud_compra`;
CREATE TABLE IF NOT EXISTS `solicitud_compra` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_suplidor` int(11) UNSIGNED NOT NULL,
  `id_almacen` int(11) UNSIGNED NOT NULL,
  `id_tipo` int(11) UNSIGNED NOT NULL,
  `no_solicitud` bigint(20) UNSIGNED NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) UNSIGNED NOT NULL,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `solicitud_compra`
--

INSERT INTO `solicitud_compra` (`id_record`, `id_suplidor`, `id_almacen`, `id_tipo`, `no_solicitud`, `created_on`, `created_by`, `active`) VALUES
(4, 1, 1, 3, 4789, '2017-04-05 03:39:13', 1, 1),
(5, 1, 1, 25, 5772, '2017-07-19 06:30:27', 1, 1),
(7, 1, 1, 1, 6307, '2017-04-04 17:43:57', 1, 1),
(8, 1, 1, 25, 8376, '2017-07-19 06:30:28', 1, 1),
(9, 1, 1, 25, 9935, '2017-07-19 06:30:28', 1, 1),
(10, 1, 1, 25, 10523, '2017-04-20 05:48:21', 1, 1),
(11, 1, 1, 1, 11924, '2017-07-19 06:16:05', 1, 1),
(12, 1, 1, 1, 12794, '2017-07-19 06:16:37', 1, 1),
(13, 1, 1, 25, 13791, '2017-07-19 06:30:29', 1, 1),
(14, 1, 1, 25, 14783, '2017-07-19 06:30:29', 1, 1),
(15, 1, 1, 3, 15283, '2017-08-06 06:36:50', 1, 1),
(16, 1, 1, 2, 16670, '2017-08-06 06:40:35', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

DROP TABLE IF EXISTS `subcategoria`;
CREATE TABLE IF NOT EXISTS `subcategoria` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `description` varchar(250) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`id_record`, `id_categoria`, `description`, `created_on`, `created_by`, `active`) VALUES
(3, 1, 'Pulceras', '2017-03-22 13:34:48', 1, 1),
(4, 1, 'Cadenas', '2017-03-22 13:37:01', 1, 1),
(5, 2, 'Argollas', '2017-03-22 13:37:22', 1, 1),
(6, 2, 'Cadenas', '2017-03-22 13:37:32', 1, 1),
(7, 3, 'Pulceras', '2017-03-22 13:37:47', 1, 1),
(8, 3, 'Aretes', '2017-03-22 13:37:55', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suplidor`
--

DROP TABLE IF EXISTS `suplidor`;
CREATE TABLE IF NOT EXISTS `suplidor` (
  `id_record` bigint(21) NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `suplidor`
--

INSERT INTO `suplidor` (`id_record`, `id_persona`, `id_empresa`, `id_tipo`, `telefono`, `created_on`, `created_by`, `active`) VALUES
(1, 12, 1, 1, '789-789-7896', '2017-03-22 19:12:58', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tercero`
--

DROP TABLE IF EXISTS `tercero`;
CREATE TABLE IF NOT EXISTS `tercero` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_nacionalidad` int(11) DEFAULT NULL,
  `nombre` varchar(250) NOT NULL,
  `email` varchar(517) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tercero`
--

INSERT INTO `tercero` (`id_record`, `id_nacionalidad`, `nombre`, `email`, `active`) VALUES
(1, 1, 'PAUL GUILLERMO OTTENWALDER', 'paulguillermo19@gmail.com', 1),
(2, 1, 'PAUL GUILLERMO OTTENWALDER', 'paulguillermo19@gmail.com', 1),
(3, 1, 'PAUL GUILLERMO OTTENWALDER', 'paulguillermo19@gmail.com', 1),
(4, 1, 'PAUL GUILLERMO OTTENWALDER', 'paulguillermo19@gmail.com', 1),
(5, 1, 'PAUL GUILLERMO OTTENWALDER', 'paulguillermo19@gmail.com', 1),
(6, 1, 'PAUL GUILLERMO OTTENWALDER', 'paulguillermo19@gmail.com', 1),
(7, 1, 'paul guillermo', 'paulguillermo19@gmail.com', 1),
(8, 1, 'paul guillermo', 'paulguillermo19@gmail.com', 1),
(9, 1, 'paul guillermo', 'paulguillermo19@gmail.com', 1),
(10, 1, 'pedro', 'pluis@gmail.com', 1),
(11, 1, 'Luis', 'luis@gmail.com', 1),
(12, 1, 'Luis', 'luis@gmail.com', 1),
(13, 1, 'Luis', 'luis@gmail.com', 1),
(14, 1, 'UNO', 'uno@uno.com.do', 1),
(15, NULL, 'Santiago', NULL, 1),
(16, NULL, 'CLIENTE GENERICO', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `terminales`
--

DROP TABLE IF EXISTS `terminales`;
CREATE TABLE IF NOT EXISTS `terminales` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(250) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `terminales`
--

INSERT INTO `terminales` (`id_record`, `description`, `created_on`, `created_by`, `active`) VALUES
(1, 'Caja 1', '2017-03-28 22:39:19', 0, 1),
(2, 'Caja 2', '2017-03-28 22:39:38', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

DROP TABLE IF EXISTS `tipo`;
CREATE TABLE IF NOT EXISTS `tipo` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`id_record`, `tipo`, `description`, `created_on`, `created_by`, `active`) VALUES
(1, 'status', 'pendiente', '2017-04-02 06:11:27', 1, 1),
(2, 'status', 'enviado', '2017-04-02 06:11:37', 1, 1),
(3, 'status', 'completado', '2017-04-02 06:11:47', 1, 1),
(4, 'tipo_empleado', 'admin', '2017-04-02 06:12:00', 1, 1),
(5, 'tipo_empleado', 'vendedor', '2017-04-02 06:12:21', 1, 1),
(6, 'tipo_empleado', 'cajero', '2017-04-02 06:12:27', 1, 1),
(7, 'tipo_empleado', 'limpieza', '2017-04-02 06:12:36', 1, 1),
(8, 'tipo_empleado', 'administrativo', '2017-04-02 06:12:45', 1, 1),
(9, 'tipo_usuario', 'admin', '2017-04-02 06:13:18', 1, 1),
(10, 'tipo_usuario', 'ventas', '2017-04-02 06:13:27', 1, 1),
(11, 'tipo_usuario', 'administratativo', '2017-04-02 06:13:47', 1, 1),
(12, 'tipo_empresa', 'lucrativa', '2017-04-02 06:15:35', 1, 1),
(13, 'tipo_empresa', 'sin fines de lucro', '2017-04-02 06:15:44', 1, 1),
(14, 'tipo_cliente', 'al por mayor', '2017-04-02 06:16:47', 1, 1),
(15, 'tipo_cliente', 'normal', '2017-04-02 06:16:54', 1, 1),
(16, 'tipo_suplidor', 'al por mayor', '2017-04-02 06:17:15', 1, 1),
(17, 'tipo_suplidor', 'detalle', '2017-04-02 06:17:21', 1, 1),
(18, 'tipo_contabilidad', 'credito', '2017-04-02 19:44:41', 1, 1),
(19, 'tipo_contabilidad', 'contado', '2017-04-02 19:44:52', 1, 1),
(20, 'tipo_contabilidad', 'debito', '2017-04-02 19:45:15', 1, 1),
(21, 'tipo_pago', 'credito', '2017-04-04 20:15:56', 1, 1),
(22, 'tipo_pago', 'cheque', '2017-04-04 20:16:18', 1, 1),
(23, 'tipo_pago', 'debito', '2017-04-04 20:16:39', 1, 1),
(24, 'status', 'cancelado', '2017-04-05 02:23:48', 1, 1),
(25, 'status', 'inventario', '2017-04-12 17:26:38', 1, 1),
(26, 'tipo_movimiento', 'entrada', '2017-04-12 17:58:15', 1, 1),
(27, 'tipo_movimiento', 'salida', '2017-04-12 17:58:15', 1, 1),
(28, 'tipo_descuento', 'al por mayor', '2017-04-13 20:30:24', 1, 1),
(29, 'tipo_descuento', 'pago efectivo', '2017-04-13 20:30:26', 1, 1),
(30, 'tipo_descuento', 'especial', '2017-04-13 20:30:23', 1, 1),
(31, 'tipo_movimiento_cuenta', 'cxc', '2017-08-06 06:13:35', 1, 1),
(32, 'tipo_movimiento_cuenta', 'cxp', '2017-08-06 06:14:25', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_descuento`
--

DROP TABLE IF EXISTS `tipo_descuento`;
CREATE TABLE IF NOT EXISTS `tipo_descuento` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_tipo` int(11) DEFAULT NULL,
  `porcentaje` float DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` int(11) DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_descuento`
--

INSERT INTO `tipo_descuento` (`id_record`, `id_tipo`, `porcentaje`, `created_by`, `created_on`, `active`) VALUES
(1, 0, 0, NULL, '2017-04-13 20:33:14', 1),
(2, 0, 5, NULL, '2017-04-13 20:34:06', 1),
(3, 28, 5, NULL, '2017-04-13 20:34:27', 1),
(4, 29, 3, NULL, '2017-04-13 20:36:12', 1),
(5, 30, 7, NULL, '2017-04-13 20:36:22', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transferencia_mercancia`
--

DROP TABLE IF EXISTS `transferencia_mercancia`;
CREATE TABLE IF NOT EXISTS `transferencia_mercancia` (
  `id_record` bigint(20) NOT NULL AUTO_INCREMENT,
  `no_transferencia` bigint(20) DEFAULT NULL,
  `id_almacen_suplidor` int(11) DEFAULT NULL,
  `id_almacen_solicitud` int(11) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `transferencia_mercancia_id_record_uindex` (`id_record`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad`
--

DROP TABLE IF EXISTS `unidad`;
CREATE TABLE IF NOT EXISTS `unidad` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(250) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `qty` double(18,2) DEFAULT NULL,
  `short` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `unidad`
--

INSERT INTO `unidad` (`id_record`, `description`, `created_on`, `qty`, `short`, `created_by`, `active`) VALUES
(1, 'Unidad', '2017-04-11 03:32:56', 1.00, 'UND', 1, 1),
(3, 'Docena', '2017-04-11 03:35:11', 12.00, 'DOCENA', 1, 1),
(4, 'Caja de 6', '2017-04-11 03:36:40', 6.00, 'CAJ 6', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_group`
--

DROP TABLE IF EXISTS `user_group`;
CREATE TABLE IF NOT EXISTS `user_group` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_empleado` int(11) NOT NULL,
  `id_terminal` int(11) DEFAULT '0',
  `id_tipo` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `clave` varchar(50) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_record`),
  UNIQUE KEY `id_record` (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_record`, `id_empleado`, `id_terminal`, `id_tipo`, `username`, `clave`, `created_on`, `created_by`, `active`) VALUES
(1, 1, NULL, 1, 'pottenwalder', 'e10adc3949ba59abbe56e057f20f883e', '2017-03-23 03:06:27', 1, 1),
(2, 1, 0, 3, 'pottenwalder2', 'e10adc3949ba59abbe56e057f20f883e', '2017-03-30 03:23:24', 0, 1),
(3, 1, 1, 3, 'pottenwalder3', 'e10adc3949ba59abbe56e057f20f883e', '2017-03-30 03:26:25', 1, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
