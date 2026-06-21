-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: novatec
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `novatec`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `u543705487_novatec` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci */;

USE `u543705487_novatec`;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(50) NOT NULL,
  `slug` varchar(120) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_slug_unique` (`slug`),
  UNIQUE KEY `category_name_unique` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(250) NOT NULL DEFAULT '',
  `filesize` int(11) NOT NULL DEFAULT 0,
  `web_path` varchar(250) NOT NULL DEFAULT '',
  `system_path` varchar(250) NOT NULL DEFAULT '',
  `test` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `slug` varchar(180) NOT NULL,
  `descripcion` text NOT NULL,
  `breve_descripcion` varchar(400) NOT NULL DEFAULT '',
  `precio_normal` decimal(10,2) NOT NULL,
  `precio_rebajado` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cantidad` int(11) NOT NULL DEFAULT 0,
  `imagen` varchar(255) DEFAULT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_subcategory` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `productos_slug_unique` (`slug`),
  UNIQUE KEY `productos_nombre_unique` (`nombre`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_subcategory` (`id_subcategory`),
  KEY `productos_subcategory_category` (`id_subcategory`,`id_categoria`),
  CONSTRAINT `productos_subcategory_category_fk` FOREIGN KEY (`id_subcategory`, `id_categoria`) REFERENCES `subcategory` (`id`, `id_category`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `products_files`
--

DROP TABLE IF EXISTS `products_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_files` (
  `products_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  PRIMARY KEY (`products_id`,`file_id`),
  KEY `file_id` (`file_id`),
  CONSTRAINT `products_files_file_fk` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `products_files_product_fk` FOREIGN KEY (`products_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subcategory`
--

DROP TABLE IF EXISTS `subcategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) NOT NULL,
  `subcategory` varchar(50) NOT NULL,
  `slug` varchar(120) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subcategory_category_pair` (`id`,`id_category`),
  UNIQUE KEY `subcategory_category_slug_unique` (`id_category`,`slug`),
  UNIQUE KEY `subcategory_category_name_unique` (`id_category`,`subcategory`),
  KEY `id_category` (`id_category`),
  CONSTRAINT `subcategory_category_fk` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Triggers para registrar modificaciones reales del catálogo y alimentar sitemap.xml
--

DELIMITER //

CREATE TRIGGER `category_set_updated_at_before_insert`
BEFORE INSERT ON `category`
FOR EACH ROW
BEGIN
  IF NEW.`updated_at` IS NULL THEN
    SET NEW.`updated_at` = CURRENT_TIMESTAMP;
  END IF;
END//

CREATE TRIGGER `category_set_updated_at_before_update`
BEFORE UPDATE ON `category`
FOR EACH ROW
BEGIN
  SET NEW.`updated_at` = CURRENT_TIMESTAMP;
END//

CREATE TRIGGER `subcategory_set_updated_at_before_insert`
BEFORE INSERT ON `subcategory`
FOR EACH ROW
BEGIN
  IF NEW.`updated_at` IS NULL THEN
    SET NEW.`updated_at` = CURRENT_TIMESTAMP;
  END IF;
END//

CREATE TRIGGER `subcategory_set_updated_at_before_update`
BEFORE UPDATE ON `subcategory`
FOR EACH ROW
BEGIN
  SET NEW.`updated_at` = CURRENT_TIMESTAMP;
END//

CREATE TRIGGER `productos_set_updated_at_before_insert`
BEFORE INSERT ON `productos`
FOR EACH ROW
BEGIN
  IF NEW.`updated_at` IS NULL THEN
    SET NEW.`updated_at` = CURRENT_TIMESTAMP;
  END IF;
END//

CREATE TRIGGER `productos_set_updated_at_before_update`
BEFORE UPDATE ON `productos`
FOR EACH ROW
BEGIN
  SET NEW.`updated_at` = CURRENT_TIMESTAMP;
END//

CREATE TRIGGER `subcategory_touch_category_after_insert`
AFTER INSERT ON `subcategory`
FOR EACH ROW
BEGIN
  UPDATE `category` SET `updated_at` = CURRENT_TIMESTAMP WHERE `id` = NEW.`id_category`;
END//

CREATE TRIGGER `subcategory_touch_category_after_update`
AFTER UPDATE ON `subcategory`
FOR EACH ROW
BEGIN
  UPDATE `category`
  SET `updated_at` = CURRENT_TIMESTAMP
  WHERE `id` IN (OLD.`id_category`, NEW.`id_category`);
END//

CREATE TRIGGER `subcategory_touch_category_after_delete`
AFTER DELETE ON `subcategory`
FOR EACH ROW
BEGIN
  UPDATE `category` SET `updated_at` = CURRENT_TIMESTAMP WHERE `id` = OLD.`id_category`;
END//

CREATE TRIGGER `productos_touch_taxonomy_after_insert`
AFTER INSERT ON `productos`
FOR EACH ROW
BEGIN
  UPDATE `category` SET `updated_at` = CURRENT_TIMESTAMP WHERE `id` = NEW.`id_categoria`;
  UPDATE `subcategory` SET `updated_at` = CURRENT_TIMESTAMP WHERE `id` = NEW.`id_subcategory`;
END//

CREATE TRIGGER `productos_touch_taxonomy_after_update`
AFTER UPDATE ON `productos`
FOR EACH ROW
BEGIN
  UPDATE `category`
  SET `updated_at` = CURRENT_TIMESTAMP
  WHERE `id` IN (OLD.`id_categoria`, NEW.`id_categoria`);
  UPDATE `subcategory`
  SET `updated_at` = CURRENT_TIMESTAMP
  WHERE `id` IN (OLD.`id_subcategory`, NEW.`id_subcategory`);
END//

CREATE TRIGGER `productos_touch_taxonomy_after_delete`
AFTER DELETE ON `productos`
FOR EACH ROW
BEGIN
  UPDATE `category` SET `updated_at` = CURRENT_TIMESTAMP WHERE `id` = OLD.`id_categoria`;
  UPDATE `subcategory` SET `updated_at` = CURRENT_TIMESTAMP WHERE `id` = OLD.`id_subcategory`;
END//

DELIMITER ;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'castillo','d033e22ae348aeb5660fc2140aec35850c4da997','Jhon Carlos '),(2,'admin','$2y$10$Wpz8BP9G/fi.iE5DtdCZ1uDlTeXuO8gC7BrKgPPBjCan9TZpC/9rG','Administrador');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-06  5:46:35
