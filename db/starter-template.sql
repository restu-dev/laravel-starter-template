/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 8.0.30 : Database - starter-template
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`starter-template` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `starter-template`;

/*Table structure for table `akses` */

DROP TABLE IF EXISTS `akses`;

CREATE TABLE `akses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_level` varchar(45) DEFAULT NULL,
  `id_menu` varchar(45) DEFAULT NULL,
  `yt_tampil` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'T',
  `yt_add` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'T',
  `yt_edit` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'T',
  `yt_del` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'T',
  `yt_print` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'T',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `akses` */

insert  into `akses`(`id`,`id_level`,`id_menu`,`yt_tampil`,`yt_add`,`yt_edit`,`yt_del`,`yt_print`,`created_at`,`updated_at`) values 
(4,'5','1','Y','Y','Y','Y','Y',NULL,NULL),
(5,'5','2','T','T','T','T','T',NULL,NULL),
(6,'5','3','T','T','T','T','T',NULL,NULL),
(10,'1','1','Y','Y','Y','Y','Y',NULL,NULL),
(11,'1','2','Y','Y','Y','Y','Y',NULL,NULL),
(12,'1','3','Y','Y','Y','Y','Y',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
