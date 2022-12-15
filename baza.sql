/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.4.25-MariaDB : Database - iteh
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`iteh` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `iteh`;

/*Table structure for table `instruktor` */

DROP TABLE IF EXISTS `instruktor`;

CREATE TABLE `instruktor` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `godina_rada` int(2) NOT NULL,
  `planina_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `spoljniKljuc` (`planina_id`),
  CONSTRAINT `spoljniKljuc` FOREIGN KEY (`planina_id`) REFERENCES `planina` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `instruktor` */

insert  into `instruktor`(`id`,`ime`,`prezime`,`godina_rada`,`planina_id`) values 
(2,'Marina','Marinkovic',4,2),
(3,'Aleksa','Aleksic',2,3),
(4,'Mika','Mikic',5,4),
(17,'Iva','Dimitrijevic',0,2),
(18,'Aleksandar','Aleksic',3,3),
(21,'Ivan','Aleksic',3,1),
(23,'Stanko','Jevtovic',4,1),
(24,'Stanko','Jevtovic',4,1),
(25,'Petar','Petkovic',5,1),
(26,'Jovan','Jovanovic',5,2),
(27,'Milan','Milinkovic',1,4),
(28,'Jana','Jankovic',3,4),
(29,'Radmila','Radic',2,3),
(30,'Jelkica','Boric',6,3),
(31,'bibi','luda',2,1);

/*Table structure for table `korisnik` */

DROP TABLE IF EXISTS `korisnik`;

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `korisnicko_ime` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `sifra` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `korisnik` */

insert  into `korisnik`(`id`,`korisnicko_ime`,`sifra`) values 
(1,'admin','admin'),
(2,'ivka','ivka'),
(3,'mika','bibi');

/*Table structure for table `planina` */

DROP TABLE IF EXISTS `planina`;

CREATE TABLE `planina` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `broj_staza` int(3) NOT NULL,
  `pocetak_sezone` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `planina` */

insert  into `planina`(`id`,`naziv`,`broj_staza`,`pocetak_sezone`) values 
(1,'Kopaonik',22,'2022-12-02'),
(2,'Zlatibor',3,'2022-11-28'),
(3,'Stara planina',5,'2022-12-01'),
(4,'Brezovica',5,'2022-11-22');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
