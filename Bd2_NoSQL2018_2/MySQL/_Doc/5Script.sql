/*
SQLyog Community v13.0.1 (64 bit)
MySQL - 5.7.21 : Database - fotodeteccionesbd
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`fotodeteccionesbd` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `fotodeteccionesbd`;

/*Table structure for table `fotodetecciones` */

DROP TABLE IF EXISTS `fotodetecciones`;

CREATE TABLE `fotodetecciones` (
  `fecha` timestamp NOT NULL,
  `velocidad` int(11) NOT NULL,
  `Vehiculos_placa` varchar(20) NOT NULL,
  `Lugares_id` int(11) NOT NULL,
  PRIMARY KEY (`fecha`,`Vehiculos_placa`,`Lugares_id`),
  KEY `fk_fotodetecciones_Vehiculos_idx` (`Vehiculos_placa`),
  KEY `fk_fotodetecciones_Lugares1_idx` (`Lugares_id`),
  CONSTRAINT `fk_fotodetecciones_Lugares1` FOREIGN KEY (`Lugares_id`) REFERENCES `lugares` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fotodetecciones_Vehiculos` FOREIGN KEY (`Vehiculos_placa`) REFERENCES `vehiculos` (`placa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table lugares` */

DROP TABLE IF EXISTS `lugares`;

CREATE TABLE `lugares` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `lugares` */

insert  into `lugares`(`id`,`nombre`) values (0,'Manrique');
insert  into `lugares`(`id`,`nombre`) values (1,'SanJavier');
insert  into `lugares`(`id`,`nombre`) values (2,'Poblado');
insert  into `lugares`(`id`,`nombre`) values (3,'Belen');
insert  into `lugares`(`id`,`nombre`) values (4,'Envigado');
insert  into `lugares`(`id`,`nombre`) values (5,'Itagui');
insert  into `lugares`(`id`,`nombre`) values (6,'Guayabal');
insert  into `lugares`(`id`,`nombre`) values (7,'Calazans');
insert  into `lugares`(`id`,`nombre`) values (8,'Palmas');
insert  into `lugares`(`id`,`nombre`) values (9,'Alpes');

/*Table structure for table `vehiculos` */

DROP TABLE IF EXISTS `vehiculos`;

CREATE TABLE `vehiculos` (
  `placa` varchar(20) NOT NULL,
  PRIMARY KEY (`placa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `vehiculos` */

insert  into `vehiculos`(`placa`) values ('AAA111');
insert  into `vehiculos`(`placa`) values ('AAA222');
insert  into `vehiculos`(`placa`) values ('AAA333');
insert  into `vehiculos`(`placa`) values ('AAA444');
insert  into `vehiculos`(`placa`) values ('AAA555');
insert  into `vehiculos`(`placa`) values ('BBB111');
insert  into `vehiculos`(`placa`) values ('BBB222');
insert  into `vehiculos`(`placa`) values ('BBB333');
insert  into `vehiculos`(`placa`) values ('BBB444');
insert  into `vehiculos`(`placa`) values ('BBB555');
insert  into `vehiculos`(`placa`) values ('CCC111');
insert  into `vehiculos`(`placa`) values ('CCC222');
insert  into `vehiculos`(`placa`) values ('CCC333');
insert  into `vehiculos`(`placa`) values ('CCC444');
insert  into `vehiculos`(`placa`) values ('CCC555');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
