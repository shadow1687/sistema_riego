-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.0.51b-community-nt-log - MySQL Community Edition (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             8.1.0.4545
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para sistema_riego
CREATE DATABASE IF NOT EXISTS `sistema_riego` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sistema_riego`;


-- Volcando estructura para tabla sistema_riego.modulo
CREATE TABLE IF NOT EXISTS `modulo` (
  `id` bigint(20) NOT NULL auto_increment,
  `serial` varchar(50) default NULL,
  `ip` varchar(50) default NULL,
  `ssid` varchar(50) default NULL,
  `password` varchar(50) default NULL,
  `conectado` bit(1) default NULL,
  `habilitado` bit(1) default NULL,
  `ultima_hora_conexion` datetime default NULL,
  `estado` bit(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sistema_riego.modulo: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `modulo` DISABLE KEYS */;
/*!40000 ALTER TABLE `modulo` ENABLE KEYS */;


-- Volcando estructura para tabla sistema_riego.regada_forzada
CREATE TABLE IF NOT EXISTS `regada_forzada` (
  `id` int(11) NOT NULL auto_increment,
  `descripcion` varchar(50) default NULL,
  `id_modulo` bigint(20) default NULL,
  `estado` bit(1) default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_regada_forzada_modulo` (`id_modulo`),
  CONSTRAINT `FK_regada_forzada_modulo` FOREIGN KEY (`id_modulo`) REFERENCES `modulo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sistema_riego.regada_forzada: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `regada_forzada` DISABLE KEYS */;
/*!40000 ALTER TABLE `regada_forzada` ENABLE KEYS */;


-- Volcando estructura para tabla sistema_riego.regada_planificada
CREATE TABLE IF NOT EXISTS `regada_planificada` (
  `id` bigint(20) NOT NULL auto_increment,
  `fecha_hora` datetime default NULL,
  `descipcion` varchar(50) default NULL,
  `id_modulo` bigint(20) default NULL,
  `estado` bit(1) default NULL,
  `repetir` bit(1) default NULL,
  `periodo_repeticion` varchar(50) default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_regada_planificada_modulo` (`id_modulo`),
  CONSTRAINT `FK_regada_planificada_modulo` FOREIGN KEY (`id_modulo`) REFERENCES `modulo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sistema_riego.regada_planificada: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `regada_planificada` DISABLE KEYS */;
/*!40000 ALTER TABLE `regada_planificada` ENABLE KEYS */;


-- Volcando estructura para tabla sistema_riego.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` bigint(20) NOT NULL auto_increment,
  `username` varchar(50) default NULL,
  `password` varchar(50) default NULL,
  `activo` bit(1) default NULL,
  `bloqueado` bit(1) default NULL,
  `ultima_fecha_login` datetime default NULL,
  `nombre` varchar(50) default NULL,
  `apellido` varchar(50) default NULL,
  `email` varchar(50) default NULL,
  `rol` varchar(50) default NULL,
  `id_modulo` bigint(20) default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_usuario_modulo` (`id_modulo`),
  CONSTRAINT `FK_usuario_modulo` FOREIGN KEY (`id_modulo`) REFERENCES `modulo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sistema_riego.usuario: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
