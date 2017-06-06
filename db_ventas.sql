-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2017 at 11:09 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ventas`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE `access` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `id_group` int(11) NOT NULL,
  `id_permission` int(11) NOT NULL,
  `id_app` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `almacen`
--

CREATE TABLE `almacen` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `id_tercero` int(11) DEFAULT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `almacen`
--

INSERT INTO `almacen` (`id_record`, `id_tercero`, `id_empleado`, `created_on`, `created_by`, `active`) VALUES
(1, 15, 1, '2017-03-28 23:58:22', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `app`
--

CREATE TABLE `app` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(250) NOT NULL,
  `icon` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL,
  `id_father` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `id_tipo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app`
--

INSERT INTO `app` (`id_record`, `description`, `icon`, `url`, `id_father`, `created_on`, `created_by`, `active`, `id_tipo`) VALUES
(1, 'dashboard', '<i class="mdi-action-dashboard"></i>', 'menu', 0, '2017-06-06 14:51:22', 1, 1, 31),
(2, 'it', '<i class="mdi-hardware-computer"></i>      ', 'it', 1, '2017-06-06 14:51:22', 1, 1, 31);

-- --------------------------------------------------------

--
-- Table structure for table `articulo`
--

CREATE TABLE `articulo` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `id_suplidor` int(11) DEFAULT NULL,
  `id_subcategoria` int(11) DEFAULT NULL,
  `codigo_barra` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articulo`
--

INSERT INTO `articulo` (`id_record`, `id_suplidor`, `id_subcategoria`, `codigo_barra`, `description`, `created_on`, `created_by`, `active`) VALUES
(1, 1, 3, '213123123123', 'Oro 24k', '2017-03-30 04:42:44', 1, 1),
(3, 1, 6, '434345345', 'Plata', '2017-04-18 19:18:59', 1, 1),
(4, 1, 7, '123123123123345', 'Cobre', '2017-04-18 15:33:48', 1, 1),
(6, 1, 8, '564654651651651654', 'Plata', '2017-03-30 04:51:07', 1, 1),
(7, 1, 4, '789689435', 'Planta Brillante', '2017-04-20 04:49:14', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`id_record`, `description`, `created_on`, `created_by`, `active`) VALUES
(1, 'Hombre', '2017-03-22 12:58:23', 1, 1),
(2, 'Mujer', '2017-03-22 12:58:28', 1, 1),
(3, 'NiÃ±os', '2017-03-22 12:58:34', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ciudad`
--

CREATE TABLE `ciudad` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `id_pais` int(11) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ciudad`
--

INSERT INTO `ciudad` (`id_record`, `id_pais`, `description`, `created_on`, `created_by`, `active`) VALUES
(1, 2, 'Santo Domingo', '2017-03-22 03:40:56', 1, 1),
(2, 2, 'Santiago', '2017-03-22 03:34:21', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `id_persona` int(11) NOT NULL,
  `telefono` varchar(250) NOT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`id_record`, `id_persona`, `telefono`, `id_tipo`, `created_on`, `created_by`, `active`) VALUES
(1, 5, '8093555339', 1, '2017-03-22 05:34:41', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `compra`
--

CREATE TABLE `compra` (
  `id_record` bigint(20) NOT NULL,
  `id_solicitud` int(11) DEFAULT NULL,
  `no_factura` varchar(50) DEFAULT NULL,
  `requisition_date` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `tipo_pago` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `compra`
--

INSERT INTO `compra` (`id_record`, `id_solicitud`, `no_factura`, `requisition_date`, `status`, `tipo_pago`, `created_on`, `created_by`, `active`) VALUES
(1, 4, '132133', '2017-04-15', 25, 21, '2017-04-12 17:27:22', 1, 1),
(2, 5, '', '2017-04-14', 2, 21, '2017-04-12 17:31:32', 1, 1),
(3, 10, '465465465464', '2017-04-21', 25, 21, '2017-04-20 05:48:21', 1, 1),
(4, 8, NULL, '2017-04-20', 2, 21, '2017-04-20 06:00:57', 1, 1),
(5, 9, NULL, '2017-04-20', 2, 21, '2017-04-20 06:01:15', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cuadre_terminal`
--

CREATE TABLE `cuadre_terminal` (
  `id_record` bigint(20) NOT NULL,
  `id_terminal` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `current_amount` decimal(18,2) DEFAULT NULL,
  `amount` decimal(18,2) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `descuento`
--

CREATE TABLE `descuento` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `id_articulo` int(11) DEFAULT NULL,
  `id_subcategoria` int(11) DEFAULT NULL,
  `porcentaje` float DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `descuento`
--

INSERT INTO `descuento` (`id_record`, `id_articulo`, `id_subcategoria`, `porcentaje`, `created_by`, `created_on`, `active`) VALUES
(1, 0, 3, 10, 1, '2017-04-13 20:37:12', 1),
(2, 3, 0, 5, 1, '2017-04-13 20:37:25', 1),
(3, 4, 0, 1, 1, '2017-04-18 19:22:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `detalle_factura`
--

CREATE TABLE `detalle_factura` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `id_factura` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `precio` double(18,2) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detalle_factura`
--

INSERT INTO `detalle_factura` (`id_record`, `id_factura`, `id_articulo`, `qty`, `precio`, `created_on`, `created_by`, `active`) VALUES
(1, 1, 1, 1, 870.74, '2017-04-20 04:22:01', 1, 1),
(2, 2, 3, 1, 537.76, '2017-04-20 04:13:41', 1, 1),
(3, 3, 1, 1, 849.74, '2017-04-20 04:13:41', 1, 1),
(4, 5, 1, 7, 880.74, '2017-04-20 04:22:01', 1, 1),
(5, 5, 7, 7, 849.74, '2017-04-20 07:02:25', 1, 1),
(6, 5, 3, 2, 537.76, '2017-04-20 03:59:43', 1, 1),
(7, 5, 4, 2, 463.54, '2017-04-20 03:59:43', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detalle_factura_tmp`
--

CREATE TABLE `detalle_factura_tmp` (
  `id_record` bigint(20) NOT NULL,
  `id_articulo` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detalle_solicitud`
--

CREATE TABLE `detalle_solicitud` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `id_solicitud` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `id_unidad` int(11) NOT NULL,
  `qty` double NOT NULL DEFAULT '0',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detalle_solicitud`
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
(26, 10, 6, 4, 5, '2017-04-20 04:51:01', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detalle_solicitud_tmp`
--

CREATE TABLE `detalle_solicitud_tmp` (
  `id_record` bigint(20) NOT NULL,
  `id_articulo` int(11) DEFAULT '0',
  `id_unidad` decimal(18,2) DEFAULT '0.00',
  `qty` decimal(18,2) DEFAULT '0.00',
  `id_user` decimal(18,2) DEFAULT '0.00',
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `devolucion`
--

CREATE TABLE `devolucion` (
  `id_record` bigint(20) NOT NULL,
  `id_factura` int(11) DEFAULT NULL,
  `id_articulo` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `direccion`
--

CREATE TABLE `direccion` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `id_tercero` int(11) DEFAULT NULL,
  `id_sector` int(11) DEFAULT NULL,
  `direccion` varchar(250) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `direccion`
--

INSERT INTO `direccion` (`id_record`, `id_tercero`, `id_sector`, `direccion`, `created_on`, `created_by`, `active`) VALUES
(1, 4, 1, '8550 NW 70th ST\\nMCP-195', NULL, 1, 1),
(2, 6, 1, '8550 NW 70th ST\\nMCP-195', NULL, 1, 1),
(3, 13, 1, 'av las caobas', NULL, 1, 1),
(4, 15, 1, 'esq 23.', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `empleado`
--

CREATE TABLE `empleado` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `id_persona` int(11) NOT NULL,
  `telefono` varchar(250) NOT NULL,
  `admission_date` date NOT NULL,
  `estado_civil` varchar(100) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `empleado`
--

INSERT INTO `empleado` (`id_record`, `id_persona`, `telefono`, `admission_date`, `estado_civil`, `id_tipo`, `created_on`, `created_by`, `active`) VALUES
(1, 3, '8093555339', '2017-03-22', 'soltero', 1, '2017-03-22 05:25:15', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `empresa`
--

CREATE TABLE `empresa` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `id_tercero` int(11) NOT NULL,
  `rnc` varchar(100) NOT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `empresa`
--

INSERT INTO `empresa` (`id_record`, `id_tercero`, `rnc`, `id_tipo`, `telefono`, `created_on`, `created_by`, `active`) VALUES
(1, 14, '80990809898', 1, '809-567-3456', '2017-03-22 19:54:08', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `exception`
--

CREATE TABLE `exception` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_permission` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `factura`
--

CREATE TABLE `factura` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `id_cliente` int(11) DEFAULT '0',
  `monto` decimal(10,0) NOT NULL DEFAULT '0',
  `no_factura` varchar(50) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `descuento` decimal(18,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `factura`
--

INSERT INTO `factura` (`id_record`, `id_cliente`, `monto`, `no_factura`, `created_on`, `created_by`, `active`, `descuento`) VALUES
(1, 16, '4289', '1', '2017-04-19 20:02:43', 1, 1, '3.00'),
(2, 16, '7896', '2', '2017-04-19 20:41:46', 1, 1, '3.00'),
(3, 16, '457', '3', '2017-04-19 21:09:52', 1, 1, '3.00'),
(5, 16, '6452', '4', '2017-04-20 03:59:43', 1, 1, '4.00');

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(250) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `historial_usuario`
--

CREATE TABLE `historial_usuario` (
  `id_record` bigint(20) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `login` datetime DEFAULT NULL,
  `logout` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `impuesto`
--

CREATE TABLE `impuesto` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `id_subcategoria` varchar(250) DEFAULT NULL,
  `id_articulo` varchar(250) DEFAULT NULL,
  `porcentaje` float NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `impuesto`
--

INSERT INTO `impuesto` (`id_record`, `id_subcategoria`, `id_articulo`, `porcentaje`, `created_on`, `created_by`, `active`) VALUES
(1, '0', '1', 18, '2017-04-10 22:49:52', 0, 1),
(2, '3', '0', 10, '2017-04-10 23:04:24', 0, 1),
(3, '4', '0', 5, '2017-04-10 23:07:44', 1, 1),
(4, '0', '3', 7, '2017-04-10 23:07:54', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventario`
--

CREATE TABLE `inventario` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `id_articulo` int(11) DEFAULT NULL,
  `id_almacen` int(11) DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventario`
--

INSERT INTO `inventario` (`id_record`, `id_articulo`, `id_almacen`, `qty`, `created_on`, `created_by`, `active`) VALUES
(15, 1, 1, 10, '2017-04-12 11:28:05', 1, 1),
(16, 3, 1, 2, '2017-04-12 11:28:05', 1, 1),
(17, 4, 1, 7, '2017-04-12 11:28:05', 1, 1),
(41, 6, 1, 30, '2017-04-20 01:48:21', 1, 1),
(42, 7, 1, 120, '2017-04-20 01:48:21', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `movimiento_inventario`
--

CREATE TABLE `movimiento_inventario` (
  `id_record` int(11) NOT NULL,
  `id_inventario` int(11) NOT NULL,
  `qty` double NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movimiento_inventario`
--

INSERT INTO `movimiento_inventario` (`id_record`, `id_inventario`, `qty`, `id_tipo`, `created_on`, `created_by`, `active`) VALUES
(1, 15, 10, 26, '2017-04-12 18:09:15', 1, 1),
(2, 16, 2, 26, '2017-04-12 18:11:20', 1, 1),
(3, 17, 7, 26, '2017-04-12 18:11:35', 1, 1),
(22, 41, 30, 26, '2017-04-20 05:48:21', 1, 1),
(23, 42, 120, 26, '2017-04-20 05:48:21', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nacionalidad`
--

CREATE TABLE `nacionalidad` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `id_pais` int(11) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nacionalidad`
--

INSERT INTO `nacionalidad` (`id_record`, `id_pais`, `description`, `created_on`, `created_by`, `active`) VALUES
(1, 2, 'Dominicana', '2017-03-22 14:08:14', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pais`
--

CREATE TABLE `pais` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pais`
--

INSERT INTO `pais` (`id_record`, `description`, `created_on`, `created_by`, `active`) VALUES
(2, 'Republica Dominicana', '2017-03-22 02:42:19', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `persona`
--

CREATE TABLE `persona` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `id_tercero` int(11) NOT NULL,
  `apellidos` varchar(250) NOT NULL,
  `cedula` varchar(50) NOT NULL,
  `sexo` varchar(30) DEFAULT NULL,
  `birthdate` date NOT NULL DEFAULT '0000-00-00',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `persona`
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
-- Table structure for table `porcentaje_ganancia`
--

CREATE TABLE `porcentaje_ganancia` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `id_subcategoria` int(11) NOT NULL,
  `porcentaje` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `porcentaje_ganancia`
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
-- Table structure for table `precio_articulo`
--

CREATE TABLE `precio_articulo` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `id_articulo` int(11) DEFAULT NULL,
  `precio` decimal(18,2) DEFAULT NULL,
  `id_suplidor` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `precio_articulo`
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
-- Table structure for table `sector`
--

CREATE TABLE `sector` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `id_ciudad` int(11) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sector`
--

INSERT INTO `sector` (`id_record`, `id_ciudad`, `description`, `created_on`, `created_by`, `active`) VALUES
(1, 2, 'Las Colinas', '2017-03-22 03:49:21', 1, 1),
(2, 2, 'Gurabo', '2017-03-22 03:49:52', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `solicitud_compra`
--

CREATE TABLE `solicitud_compra` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `id_suplidor` int(11) UNSIGNED NOT NULL,
  `id_almacen` int(11) UNSIGNED NOT NULL,
  `id_tipo` int(11) UNSIGNED NOT NULL,
  `no_solicitud` bigint(20) UNSIGNED NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) UNSIGNED NOT NULL,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `solicitud_compra`
--

INSERT INTO `solicitud_compra` (`id_record`, `id_suplidor`, `id_almacen`, `id_tipo`, `no_solicitud`, `created_on`, `created_by`, `active`) VALUES
(4, 1, 1, 3, 4789, '2017-04-05 03:39:13', 1, 1),
(5, 1, 1, 2, 5772, '2017-04-05 03:40:07', 1, 1),
(7, 1, 1, 1, 6307, '2017-04-04 17:43:57', 1, 1),
(8, 1, 1, 2, 8376, '2017-04-20 06:00:57', 1, 1),
(9, 1, 1, 2, 9935, '2017-04-20 06:01:15', 1, 1),
(10, 1, 1, 25, 10523, '2017-04-20 05:48:21', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subcategoria`
--

CREATE TABLE `subcategoria` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `description` varchar(250) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategoria`
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
-- Table structure for table `suplidor`
--

CREATE TABLE `suplidor` (
  `id_record` bigint(21) NOT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suplidor`
--

INSERT INTO `suplidor` (`id_record`, `id_persona`, `id_empresa`, `id_tipo`, `telefono`, `created_on`, `created_by`, `active`) VALUES
(1, 12, 1, 1, '789-789-7896', '2017-03-22 19:12:58', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tercero`
--

CREATE TABLE `tercero` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `id_nacionalidad` int(11) DEFAULT NULL,
  `nombre` varchar(250) NOT NULL,
  `email` varchar(517) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tercero`
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
-- Table structure for table `terminales`
--

CREATE TABLE `terminales` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terminales`
--

INSERT INTO `terminales` (`id_record`, `description`, `created_on`, `created_by`, `active`) VALUES
(1, 'Caja 1', '2017-03-28 22:39:19', 0, 1),
(2, 'Caja 2', '2017-03-28 22:39:38', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tipo`
--

CREATE TABLE `tipo` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `tipo` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo`
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
(31, 'tipo_application', 'modulo', '2017-06-06 17:51:27', 1, 1),
(32, 'tipo_application', 'section', '2017-06-06 17:51:45', 1, 1),
(33, 'tipo_application', 'application', '2017-06-06 17:51:57', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tipo_descuento`
--

CREATE TABLE `tipo_descuento` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `porcentaje` float DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo_descuento`
--

INSERT INTO `tipo_descuento` (`id_record`, `id_tipo`, `porcentaje`, `created_by`, `created_on`, `active`) VALUES
(1, 0, 0, NULL, '2017-04-13 20:33:14', 1),
(2, 0, 5, NULL, '2017-04-13 20:34:06', 1),
(3, 28, 5, NULL, '2017-04-13 20:34:27', 1),
(4, 29, 3, NULL, '2017-04-13 20:36:12', 1),
(5, 30, 7, NULL, '2017-04-13 20:36:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `unidad`
--

CREATE TABLE `unidad` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `qty` double(18,2) DEFAULT NULL,
  `short` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unidad`
--

INSERT INTO `unidad` (`id_record`, `description`, `created_on`, `qty`, `short`, `created_by`, `active`) VALUES
(1, 'Unidad', '2017-04-11 03:32:56', 1.00, 'UND', 1, 1),
(3, 'Docena', '2017-04-11 03:35:11', 12.00, 'DOCENA', 1, 1),
(4, 'Caja de 6', '2017-04-11 03:36:40', 6.00, 'CAJ 6', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_record` bigint(20) UNSIGNED NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_terminal` int(11) DEFAULT '0',
  `id_tipo` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `clave` varchar(50) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_record`, `id_empleado`, `id_terminal`, `id_tipo`, `username`, `clave`, `created_on`, `created_by`, `active`) VALUES
(1, 1, NULL, 1, 'pottenwalder', 'e10adc3949ba59abbe56e057f20f883e', '2017-03-23 03:06:27', 1, 1),
(2, 1, 0, 3, 'pottenwalder2', 'e10adc3949ba59abbe56e057f20f883e', '2017-03-30 03:23:24', 0, 1),
(3, 1, 1, 3, 'pottenwalder3', 'e10adc3949ba59abbe56e057f20f883e', '2017-03-30 03:26:25', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `app`
--
ALTER TABLE `app`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `cuadre_terminal`
--
ALTER TABLE `cuadre_terminal`
  ADD PRIMARY KEY (`id_record`);

--
-- Indexes for table `descuento`
--
ALTER TABLE `descuento`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `detalle_factura_tmp`
--
ALTER TABLE `detalle_factura_tmp`
  ADD PRIMARY KEY (`id_record`);

--
-- Indexes for table `detalle_solicitud`
--
ALTER TABLE `detalle_solicitud`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `detalle_solicitud_tmp`
--
ALTER TABLE `detalle_solicitud_tmp`
  ADD PRIMARY KEY (`id_record`);

--
-- Indexes for table `devolucion`
--
ALTER TABLE `devolucion`
  ADD PRIMARY KEY (`id_record`);

--
-- Indexes for table `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `exception`
--
ALTER TABLE `exception`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `historial_usuario`
--
ALTER TABLE `historial_usuario`
  ADD PRIMARY KEY (`id_record`);

--
-- Indexes for table `impuesto`
--
ALTER TABLE `impuesto`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `movimiento_inventario`
--
ALTER TABLE `movimiento_inventario`
  ADD PRIMARY KEY (`id_record`);

--
-- Indexes for table `nacionalidad`
--
ALTER TABLE `nacionalidad`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `porcentaje_ganancia`
--
ALTER TABLE `porcentaje_ganancia`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `precio_articulo`
--
ALTER TABLE `precio_articulo`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `sector`
--
ALTER TABLE `sector`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `solicitud_compra`
--
ALTER TABLE `solicitud_compra`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `suplidor`
--
ALTER TABLE `suplidor`
  ADD PRIMARY KEY (`id_record`);

--
-- Indexes for table `tercero`
--
ALTER TABLE `tercero`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `terminales`
--
ALTER TABLE `terminales`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `tipo_descuento`
--
ALTER TABLE `tipo_descuento`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `unidad`
--
ALTER TABLE `unidad`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `id_record` (`id_record`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access`
--
ALTER TABLE `access`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `almacen`
--
ALTER TABLE `almacen`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `app`
--
ALTER TABLE `app`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `articulo`
--
ALTER TABLE `articulo`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `compra`
--
ALTER TABLE `compra`
  MODIFY `id_record` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `cuadre_terminal`
--
ALTER TABLE `cuadre_terminal`
  MODIFY `id_record` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `descuento`
--
ALTER TABLE `descuento`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `detalle_factura_tmp`
--
ALTER TABLE `detalle_factura_tmp`
  MODIFY `id_record` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT for table `detalle_solicitud`
--
ALTER TABLE `detalle_solicitud`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `detalle_solicitud_tmp`
--
ALTER TABLE `detalle_solicitud_tmp`
  MODIFY `id_record` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `devolucion`
--
ALTER TABLE `devolucion`
  MODIFY `id_record` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `direccion`
--
ALTER TABLE `direccion`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `exception`
--
ALTER TABLE `exception`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `factura`
--
ALTER TABLE `factura`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `historial_usuario`
--
ALTER TABLE `historial_usuario`
  MODIFY `id_record` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `impuesto`
--
ALTER TABLE `impuesto`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `movimiento_inventario`
--
ALTER TABLE `movimiento_inventario`
  MODIFY `id_record` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `nacionalidad`
--
ALTER TABLE `nacionalidad`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pais`
--
ALTER TABLE `pais`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `persona`
--
ALTER TABLE `persona`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `porcentaje_ganancia`
--
ALTER TABLE `porcentaje_ganancia`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `precio_articulo`
--
ALTER TABLE `precio_articulo`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `sector`
--
ALTER TABLE `sector`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `solicitud_compra`
--
ALTER TABLE `solicitud_compra`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `suplidor`
--
ALTER TABLE `suplidor`
  MODIFY `id_record` bigint(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tercero`
--
ALTER TABLE `tercero`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `terminales`
--
ALTER TABLE `terminales`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `tipo_descuento`
--
ALTER TABLE `tipo_descuento`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `unidad`
--
ALTER TABLE `unidad`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_record` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
