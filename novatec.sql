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

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `novatec` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci */;

USE `novatec`;

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Termas Solares','termas-solares'),(2,'Paneles Solares 1','paneles-solares-1'),(3,'Paneles SolaresPaneles SolaresPaneles SolaresPanel','paneles-solarespaneles-solarespaneles-solarespanel'),(4,'asi','asi'),(5,'Terrmas solares 1','terrmas-solares-1'),(11,'sadsad','sadsad');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES (1,'English.png',146569,'/Novatec-Energy/uploads/1.png','C:/xampp/htdocs/Novatec-Energy/uploads/1.png',0),(2,'English.png',146569,'/Novatec-Energy/uploads/2.png','C:/xampp/htdocs/Novatec-Energy/uploads/2.png',0),(3,'English.png',146569,'/Novatec-Energy/uploads/3.png','C:/xampp/htdocs/Novatec-Energy/uploads/3.png',0),(4,'English.png',146569,'/Novatec-Energy/uploads/4.png','C:/xampp/htdocs/Novatec-Energy/uploads/4.png',0);
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `productos_slug_unique` (`slug`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_subcategory` (`id_subcategory`),
  KEY `productos_subcategory_category` (`id_subcategory`,`id_categoria`),
  CONSTRAINT `productos_subcategory_category_fk` FOREIGN KEY (`id_subcategory`, `id_categoria`) REFERENCES `subcategory` (`id`, `id_category`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (32,'Panel Solar 610W Monocristalino N-Type Tensite','panel-solar-610w-monocristalino-n-type-tensite','<h2>Comprar Panel Solar 610W Monocristalino N-Type Tensite</h2>\r\n\r\n<p>El&nbsp;<strong>Panel Solar 610W Monocristalino N-Type</strong>&nbsp;es la nueva apuesta de la&nbsp;<strong>marca Tensite</strong>&nbsp;para brindarle un<strong>&nbsp;</strong>panel de<strong>&nbsp;alto rendimiento</strong>. Las celdas monocristalinas de este panel integran la tecnolog&iacute;a N-type lo cual aumenta su nivel de eficiencia en comparaci&oacute;n a otros paneles del mercado.</p>\r\n\r\n<table style=\"width:100%\">\r\n	<caption><strong>Panel Solar 610W Monocristalino N-Type Tensite: Detalles clave</strong></caption>\r\n	<thead>\r\n		<tr>\r\n			<td>M&aacute;xima<br />\r\n			potencia</td>\r\n			<td>Eficiencia<br />\r\n			del panel</td>\r\n			<td>Potencia<br />\r\n			lineal</td>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td><strong>610Wp</strong></td>\r\n			<td><strong>22.6%</strong></td>\r\n			<td><strong>30 a&ntilde;os</strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Se trata de un panel de alto rendimiento que le permite llegar a una elevada potencia de salida<strong>&nbsp;</strong>incluso en condiciones de poca luz. Es la opci&oacute;n perfecta para&nbsp;<strong>instalaciones dom&eacute;sticas,</strong>&nbsp;as&iacute; como en&nbsp;<strong>proyectos a gran escala</strong>. En AutoSolar encuentras el panel solar 610W de la marca Tensite a un excelente precio.</p>\r\n\r\n<h2>&iquest;Cu&aacute;les son sus principales caracter&iacute;sticas?</h2>\r\n\r\n<p>Este panel fotovoltaico se caracteriza por incluir las&nbsp;<strong>tecnolog&iacute;as m&aacute;s destacadas</strong>&nbsp;en la fabricaci&oacute;n de paneles solares:</p>\r\n\r\n<ul>\r\n	<li><strong>Tecnolog&iacute;a N-type:</strong>&nbsp;Celdas monocristalinas tipo-N que ofrecen una mejor resistencia ante la degradaci&oacute;n.</li>\r\n	<li><strong>Tecnolog&iacute;a Half-Cell:</strong>&nbsp;Reduce las p&eacute;rdidas originadas por la presencia de sombras.</li>\r\n	<li><strong>Celdas MBB:</strong>&nbsp;Mejora las conexiones dentro de cada celda solar para aumentar la eficiencia.</li>\r\n	<li><strong>Tecnolog&iacute;a TOPCon:</strong>&nbsp;Optimiza su rendimiento en altas temperaturas y condiciones de poca luz.</li>\r\n</ul>\r\n\r\n<p>Los datos t&eacute;cnicos de este modelo son:</p>\r\n\r\n<table>\r\n	<thead>\r\n		<tr>\r\n			<td colspan=\"2\"><strong>Datos t&eacute;cnicos del Panel Solar 610W Monocristalino N-Type Tensite</strong></td>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>M&aacute;xima potencia</td>\r\n			<td>610 W</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Voltaje a m&aacute;xima potencia (VMPP)</td>\r\n			<td>39,77 V</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Intensidad a m&aacute;xima potencia (IMPP)</td>\r\n			<td>15,34 A</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Voltaje en circuito abierto (VOC)</td>\r\n			<td>48,10 V</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Intensidad en cortocircuito (ISC)</td>\r\n			<td>16,05 A</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Eficiencia</td>\r\n			<td>22,60 %</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h2>Nueva tecnolog&iacute;a integrada</h2>\r\n\r\n<p>La tecnolog&iacute;a tipo-N se impone como el&nbsp;<strong>nuevo est&aacute;ndar</strong>&nbsp;en la fabricaci&oacute;n de paneles. La principal diferencia radica en que la capa base de las&nbsp;<strong>celdas tipo-N&nbsp;</strong>se encuentran dopadas de f&oacute;sforo, a diferencia de los paneles tradicionales, cuyo dopaje se basa en el boro. Este&nbsp;<strong>cambio puntual</strong>&nbsp;minimiza el impacto del efecto boro-ox&iacute;geno, uno de los principales agentes degradantes en los paneles fotovoltaicos.</p>\r\n\r\n<p>Todos los paneles fotovoltaicos que incluyen este tipo de tecnolog&iacute;a ofrecen las siguientes&nbsp;<strong>ventajas</strong>:</p>\r\n\r\n<ol>\r\n	<li><strong>Alta eficiencia</strong>&nbsp;para convertir la luz solar en corriente el&eacute;ctrica.</li>\r\n	<li>Mejor&nbsp;<strong>tolerancia a altas temperaturas&nbsp;</strong>para evitar que afecte su funcionamiento.</li>\r\n	<li><strong>Amplia vida &uacute;til</strong>&nbsp;que puede extenderse hasta los 30 a&ntilde;os de potencia lineal.</li>\r\n	<li><strong>Menor susceptibilidad&nbsp;</strong>al efecto de degradaci&oacute;n inducida por la luz (LID).</li>\r\n</ol>\r\n\r\n<p>Obt&eacute;n el&nbsp;<strong>mayor rendimiento</strong>&nbsp;de tu sistema fotovoltaico con la compra del Panel Solar 610W Tensite.</p>\r\n\r\n<h3>Ficha T&eacute;cnica Panel Solar 610W Monocristalino N-Type Tensite</h3>\r\n','El Panel Solar 610W Monocristalino N-Type Tensite cuenta con la última novedad en el sector. La tecnología N-type permite que el panel cuente con una eficiencia de 22,6%. Además, su potencia de salida de 610W es ideal para instalaciones domésticas y proyectos a gran escala. Incluye la tecnología TOPCon que mejora su rendimiento durante los 30 años de potencia lineal que ofrece este panel.',1223.21,0.00,0,'RADIUS.png',1,18),(33,'Fotovoltaje','fotovoltaje','','asdsad',123.00,0.00,0,'panel-solar-610w-monocristalino-n-type-tensite-thumb2x.jpg',5,7),(34,'asd','asd','','asd',213213.00,0.00,0,'Frame 1984078938.png',2,2);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `products_files`
--

LOCK TABLES `products_files` WRITE;
/*!40000 ALTER TABLE `products_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_files` ENABLE KEYS */;
UNLOCK TABLES;

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `subcategory_category_pair` (`id`,`id_category`),
  UNIQUE KEY `subcategory_category_slug_unique` (`id_category`,`slug`),
  KEY `id_category` (`id_category`),
  CONSTRAINT `subcategory_category_fk` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategory`
--

LOCK TABLES `subcategory` WRITE;
/*!40000 ALTER TABLE `subcategory` DISABLE KEYS */;
INSERT INTO `subcategory` VALUES (1,1,'General Termas Solares','general-termas-solares'),(2,2,'General Paneles Solares','general-paneles-solares'),(3,3,'radiosradiosradiosradiosradiosradiosradiosradiosra','radiosradiosradiosradiosradiosradiosradiosradiosra'),(4,4,'alo mas nuevo','alo-mas-nuevo'),(5,4,'otro','otro'),(6,4,'asdsad','asdsad'),(7,5,'termas solares 1','termas-solares-1'),(8,5,'ASDA','asda'),(9,1,'ASDSAD','asdsad'),(10,1,'SADSAD','sadsad'),(11,1,'ASDSAD','asdsad-2'),(12,1,'asdsa','asdsa'),(13,1,'asdsad','asdsad-3'),(14,1,'asdsad','asdsad-4'),(15,1,'sadsad','sadsad-2'),(17,1,'asdsad','asdsad-5'),(18,1,'asdsad','asdsad-6'),(19,1,'asd','asd');
/*!40000 ALTER TABLE `subcategory` ENABLE KEYS */;
UNLOCK TABLES;

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

-- Dump completed on 2026-06-06  4:06:31
