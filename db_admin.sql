-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: db_admin
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
-- Table structure for table `tbl_product`
--

DROP TABLE IF EXISTS `tbl_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_product` (
  `id_product` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Price` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Category` varchar(50) NOT NULL,
  `Amount` int(11) NOT NULL,
  PRIMARY KEY (`id_product`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_product`
--

LOCK TABLES `tbl_product` WRITE;
/*!40000 ALTER TABLE `tbl_product` DISABLE KEYS */;
INSERT INTO `tbl_product` VALUES (1,'Coca-Cola Regular 600ml',18,'2026-08-11','Bebidas',50),(2,'Agua Purificada Epura 1L',15,'2026-08-11','Bebidas',30),(3,'Jugo del Valle Manzana 413ml',20,'2026-08-11','Bebidas',25),(4,'Cerveza Tecate Lata 473ml',22,'2026-08-11','Bebidas',40),(5,'Gatorade Naranja 500ml',25,'2026-08-11','Bebidas',0),(6,'Sabritas Sal Original 170g',42,'2026-08-11','Botanas',15),(7,'Doritos Nacho 146g',38,'2026-08-11','Botanas',20),(8,'Cheetos Torciditos 145g',35,'2026-08-11','Botanas',20),(9,'Gansito Marinela',22,'2026-08-11','Botanas',12),(10,'Galletas Emperador Chocolate',18,'2026-08-11','Botanas',0),(11,'Frijoles Isadora Refritos 430g',21,'2026-08-11','Abarrotes',10),(12,'Atún Dolores en Agua 140g',22,'2026-08-11','Abarrotes',35),(13,'Aceite 123 1 Litro',45,'2026-08-11','Abarrotes',8),(14,'Salsa Valentina Amarilla 370ml',17,'2026-08-11','Abarrotes',15),(15,'Puré de Tomate Del Fuerte 210g',9,'2026-08-11','Abarrotes',20),(16,'Leche Lala Entera 1 Litro',28,'2026-08-11','Lácteos',18),(17,'Cartera Huevo San Juan 12 pz',38,'2026-08-11','Lácteos',10),(18,'Yoghurt Bebible Danone Fresa',14,'2026-08-11','Lácteos',22),(19,'Queso Panela Fud 200g',42,'2026-08-11','Lácteos',5),(20,'Jamón Virginia Fud 250g',35,'2026-08-11','Lácteos',0),(21,'Pan Blanco Bimbo Grande',45,'2026-08-11','Panadería',10),(22,'Tortillas de Harina Tía Rosa',28,'2026-08-11','Panadería',15),(23,'Tortillas de Maíz 1kg',22,'2026-08-11','Panadería',12),(24,'Nito Bimbo',16,'2026-08-11','Panadería',25),(25,'Pan Tostado Bimbo Clásico',32,'2026-08-11','Panadería',8);
/*!40000 ALTER TABLE `tbl_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_roles`
--

DROP TABLE IF EXISTS `tbl_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'role_id',
  `role` varchar(255) DEFAULT NULL COMMENT 'role_text',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_roles`
--

LOCK TABLES `tbl_roles` WRITE;
/*!40000 ALTER TABLE `tbl_roles` DISABLE KEYS */;
INSERT INTO `tbl_roles` VALUES (1,'Admin'),(2,'Editor'),(3,'User');
/*!40000 ALTER TABLE `tbl_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile` varchar(25) DEFAULT NULL,
  `roleid` tinyint(4) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_users`
--

LOCK TABLES `tbl_users` WRITE;
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` VALUES (23,'achref','achref','achref.nefzazoui@gmail.com','3ea543d29ad3c1c09fcfbdda3f2f0617c50ab138','54852852',1,0,'2020-12-19 14:35:56','2020-12-19 14:35:56'),(24,'ahmed','benahmed','achme@gmail.com','7f0c9d56d40c3cc1e23e0113d5377779a4de86ff','54277528',3,0,'2020-12-19 15:13:39','2020-12-19 15:13:39'),(25,'Fathi','fathiA','fathianh@gmail.com','0a859b9a4ebbde4f63383bca7e34890985782348','54672828',3,0,'2020-12-19 15:15:52','2020-12-19 15:15:52'),(26,'Makrem','makrem','makrem@gmail.com','adef7009a84a71c226ddf68671e929d68a707762','42551771',3,0,'2020-12-19 15:16:59','2020-12-19 15:16:59'),(27,'Sirin','Sirin','Sirin@gmail.com','03ee5fda2eae80be34c0142fe28ac6401e63324c','23451671',3,0,'2020-12-19 15:17:34','2020-12-19 15:17:34'),(29,'Cesar','Lopez','lopez.juliocesar.unison@gmail.com','1a58f5c310732fb37ee524d592498d438964c129','66223158899',3,0,'2026-08-11 21:19:34','2026-08-11 21:19:34');
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-08-12 13:13:20
