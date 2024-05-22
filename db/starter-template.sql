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

/*Table structure for table `button` */

DROP TABLE IF EXISTS `button`;

CREATE TABLE `button` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `color` varchar(100) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `button` */

insert  into `button`(`id`,`name`,`color`,`icon`,`created_at`,`updated_at`) values 
(1,'Add','secondary','plus','2024-05-20 07:37:01','2024-05-21 01:06:31'),
(2,'Edit','primary','edit','2024-05-20 07:37:39','2024-05-20 07:52:18'),
(3,'Hapus','danger','trash','2024-05-20 07:38:03','2024-05-20 07:38:03'),
(4,'Detail','info','eye','2024-05-20 07:38:42','2024-05-20 07:38:42'),
(5,'Reset','warning','exclamation-circle','2024-05-20 07:53:21','2024-05-20 07:53:54'),
(6,'Save','success','save','2024-05-21 01:06:05','2024-05-21 01:06:05'),
(7,'Close','default','times','2024-05-21 02:16:46','2024-05-21 02:16:46');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `level` */

DROP TABLE IF EXISTS `level`;

CREATE TABLE `level` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `level` */

insert  into `level`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'Super Admin','2024-05-16 04:04:33','2024-05-18 01:35:42'),
(5,'Admin','2024-05-16 06:41:23','2024-05-18 01:35:50');

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_header` int DEFAULT NULL,
  `nama` varchar(45) NOT NULL,
  `url` varchar(100) DEFAULT NULL,
  `punya_sub` varchar(20) DEFAULT NULL,
  `icon` varchar(60) DEFAULT NULL,
  `yt_header` varchar(10) DEFAULT NULL,
  `yt_parent` varchar(10) DEFAULT NULL,
  `urut_header` varchar(10) DEFAULT NULL,
  `urut_parent` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `menu` */

insert  into `menu`(`id`,`id_header`,`nama`,`url`,`punya_sub`,`icon`,`yt_header`,`yt_parent`,`urut_header`,`urut_parent`,`created_at`,`updated_at`) values 
(1,NULL,'Dashboard','home','T','fa-home','Y',NULL,'1',NULL,'2024-05-18 00:51:51','2024-05-18 03:19:07'),
(2,NULL,'Master','header-master','Y','fa-folder','Y',NULL,'2',NULL,'2024-05-18 01:12:46','2024-05-21 02:37:27'),
(3,2,'Master Button','master-button',NULL,'fa-circle',NULL,'Y',NULL,'1','2024-05-18 01:19:26','2024-05-18 01:19:26');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_level` int DEFAULT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`id_level`,`image`) values 
(1,'Resru Winaldi Wibisono','restuwinaldi@gmail.com','2024-05-20 08:01:03','$2y$10$GQDeQtfOj7ZqH.2vTncEauKpnE891VmobrD93O.lD1i2kXVGEkYVS',NULL,'2024-05-16 00:23:16','2024-05-20 07:08:34',1,'05202024070834664af6f21fc58.png'),
(19,'Winaldi','retuwinaldi02@gmail.com',NULL,'$2y$10$gmlp1k.ohfEWxF4y2pouA.m/46A6oHWkdHqwgPBV2T5ou4pNeLxz.',NULL,'2024-05-20 04:10:11','2024-05-21 01:49:20',5,'user.png');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
