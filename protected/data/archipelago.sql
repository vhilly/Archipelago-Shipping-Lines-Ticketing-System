-- MySQL dump 10.13  Distrib 5.5.31, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: archipelago
-- ------------------------------------------------------
-- Server version	5.5.31-0ubuntu0.13.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `passenger` int(11) NOT NULL,
  `ticket` int(11) NOT NULL,
  `status` char(1) NOT NULL,
  `date_booked` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `departure_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `passenger` (`passenger`),
  KEY `ticket` (`ticket`),
  CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`passenger`) REFERENCES `passenger` (`id`),
  CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`ticket`) REFERENCES `ticket` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
INSERT INTO `booking` VALUES (1,2,2,'2','2013-05-24 09:06:28','2013-05-26'),(2,3,3,'2','2013-05-24 09:06:28','2013-05-26'),(3,4,4,'2','2013-05-24 09:11:24','2013-05-26'),(4,5,5,'2','2013-05-24 09:11:24','2013-05-26'),(5,6,6,'2','2013-05-24 09:14:55','2013-05-26'),(6,7,7,'2','2013-05-24 09:16:03','2013-05-26'),(7,8,8,'2','2013-05-24 09:16:03','2013-05-26'),(8,9,9,'2','2013-05-24 09:16:03','2013-05-26'),(9,10,10,'2','2013-05-24 09:16:03','2013-05-26'),(10,11,11,'2','2013-05-24 09:16:03','2013-05-26'),(11,12,12,'2','2013-05-24 09:16:03','2013-05-26'),(12,13,13,'2','2013-05-24 09:16:03','2013-05-26'),(13,14,14,'2','2013-05-24 09:16:03','2013-05-26'),(14,15,15,'2','2013-05-24 09:16:03','2013-05-26'),(15,16,16,'2','2013-05-24 09:16:03','2013-05-26'),(16,17,17,'2','2013-05-24 09:19:08','2013-05-26'),(17,18,18,'2','2013-05-24 09:19:08','2013-05-26'),(18,21,21,'2','2013-05-24 09:25:35','2013-05-26'),(19,21,21,'','2013-05-24 10:26:47','0000-00-00'),(21,3,2,'2','2013-05-24 10:27:56','2013-05-31'),(22,56,56,'2','2013-05-24 10:31:31','2013-05-26'),(23,57,57,'2','2013-05-24 10:31:52','2013-05-26'),(24,58,58,'2','2013-05-24 10:32:37','2013-05-26'),(25,59,59,'2','2013-05-24 10:32:37','2013-05-26'),(26,60,60,'2','2013-05-24 10:34:32','2013-05-26'),(27,61,61,'2','2013-05-24 10:34:53','2013-05-26'),(28,62,62,'2','2013-05-24 10:35:19','2013-05-26'),(29,63,63,'2','2013-05-24 10:35:19','2013-05-26'),(30,64,64,'2','2013-05-24 10:36:25','2013-05-26'),(31,65,65,'2','2013-05-24 10:37:05','2013-05-26'),(32,66,66,'2','2013-05-24 10:37:51','2013-05-26'),(33,67,67,'2','2013-05-24 10:38:17','2013-05-26'),(34,68,68,'2','2013-05-24 10:38:17','2013-05-26'),(35,69,69,'2','2013-05-24 10:38:53','2013-05-26'),(36,70,70,'2','2013-05-24 10:39:19','2013-05-26'),(37,71,71,'2','2013-05-24 10:39:41','2013-05-26'),(38,72,72,'2','2013-05-24 10:39:41','2013-05-26'),(39,73,73,'2','2013-05-24 10:40:55','2013-05-26'),(40,74,74,'2','2013-05-24 10:40:55','2013-05-26'),(41,75,75,'2','2013-05-24 10:40:55','2013-05-26'),(42,76,76,'2','2013-05-24 10:42:44','2013-05-26'),(43,77,77,'2','2013-05-24 10:42:44','2013-05-26'),(44,78,78,'2','2013-05-24 10:45:46','2013-05-26'),(45,79,79,'2','2013-05-24 10:47:14','2013-05-26'),(46,80,80,'2','2013-05-24 10:47:41','2013-05-26'),(47,81,81,'2','2013-05-24 10:48:01','2013-05-26'),(48,82,82,'2','2013-05-24 10:48:21','2013-05-26'),(49,83,83,'2','2013-05-24 10:49:32','2013-05-26'),(50,84,84,'2','2013-05-24 10:49:49','2013-05-26'),(51,85,85,'2','2013-05-24 11:07:44','0000-00-00'),(52,86,86,'2','2013-05-24 11:08:30','2013-05-26'),(53,87,87,'2','2013-05-24 11:08:30','2013-05-26'),(54,88,88,'2','2013-05-24 11:11:13','2013-05-26'),(55,89,89,'2','2013-05-24 11:13:59','2013-05-26'),(56,90,90,'2','2013-05-24 11:13:59','2013-05-26'),(57,91,91,'2','2013-05-24 11:13:59','2013-05-26'),(58,92,92,'2','2013-05-24 11:35:00','2013-05-31');
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `passage_fare_rates`
--

DROP TABLE IF EXISTS `passage_fare_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `passage_fare_rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `proposed` varchar(100) NOT NULL,
  `class` int(11) NOT NULL,
  `price` decimal(20,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `class` (`class`),
  CONSTRAINT `passage_fare_rates_ibfk_1` FOREIGN KEY (`class`) REFERENCES `seating_class` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passage_fare_rates`
--

LOCK TABLES `passage_fare_rates` WRITE;
/*!40000 ALTER TABLE `passage_fare_rates` DISABLE KEYS */;
INSERT INTO `passage_fare_rates` VALUES (1,'Full Fare','',1,300.00),(2,'Full Fare','',2,180.00),(3,'Full Fare','',3,120.00),(4,'Student','',1,240.00),(5,'Student','',2,144.00),(6,'Student','',3,96.00),(7,'Senior','',1,240.00),(8,'Senior','',2,144.00),(9,'Senior','',3,96.00),(10,'Children','Ages 7 and below',1,150.00),(11,'Children','Ages 7 and below',2,90.00),(12,'Children','Ages 7 and below',3,60.00);
/*!40000 ALTER TABLE `passage_fare_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `passenger`
--

DROP TABLE IF EXISTS `passenger`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `passenger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `prefix` char(5) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `civil_status` char(1) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passenger`
--

LOCK TABLES `passenger` WRITE;
/*!40000 ALTER TABLE `passenger` DISABLE KEYS */;
INSERT INTO `passenger` VALUES (1,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'vhilly','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'sdfds','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'vhilly','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'vsdf','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'jae','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(11,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(13,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(14,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(17,'as','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(18,'dfsdf','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(21,'vhilly','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(56,'fsdfsd','fsdsdffsdf',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(57,'vhilly','sdfdsf',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(58,'','',NULL,NULL,'','',NULL,NULL,'',''),(59,'','',NULL,NULL,'','',NULL,NULL,'',''),(60,'','',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL),(61,'vhilly','santiago',NULL,NULL,'Madlangbayan',NULL,NULL,NULL,NULL,NULL),(62,'vhilly','ds',NULL,NULL,'Madlangbayan',NULL,NULL,NULL,NULL,NULL),(63,'joanne','dfsf',NULL,NULL,'mad',NULL,NULL,NULL,NULL,NULL),(64,'vhilly','santiago',NULL,NULL,'Madlangbayan','1',NULL,NULL,NULL,NULL),(65,'vhilly','santiago',NULL,NULL,'Madlangbayan','','',NULL,NULL,NULL),(66,'vhilly','santiago',NULL,NULL,'Madlangbayan','','0',NULL,NULL,NULL),(67,'vhilly','santiago',NULL,NULL,'Madlangbayan','','',NULL,NULL,NULL),(68,'joanne','santiago',NULL,NULL,'mad','','',NULL,NULL,NULL),(69,'vhilly','santiago',NULL,NULL,'Madlangbayan','','',NULL,'Filipino',NULL),(70,'vhilly','santiago',NULL,NULL,'Madlangbayan','jr','0',NULL,'Filipino',NULL),(71,'jae','m',NULL,NULL,'sdf','','',NULL,'',NULL),(72,'fdsf','fsdf',NULL,NULL,'sdf','','',NULL,'',NULL),(73,'','',NULL,NULL,'','','',NULL,'',NULL),(74,'','',NULL,NULL,'','','',NULL,'',NULL),(75,'','',NULL,NULL,'','','',NULL,'',NULL),(76,'v','sdf',NULL,NULL,'sdf','sfd','',NULL,'f',NULL),(77,'fsd','sdf',NULL,NULL,'fsd','fsd','0',NULL,'sdf',NULL),(78,'','',NULL,NULL,'','','',NULL,'','fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff'),(79,'','',NULL,NULL,'','','',NULL,'','fdf'),(80,'','',NULL,NULL,'','','',NULL,'','fd'),(81,'','',NULL,NULL,'','','',NULL,'','fd'),(82,'fsdf','fsdf',NULL,NULL,'fsdf','fsdf','0',NULL,'Filipino','ffd'),(83,'','',NULL,NULL,'','','',NULL,'',''),(84,'f','fds',NULL,NULL,'fsd','fds','0',NULL,'fd',''),(85,'sdfsdf sdfsdf','dsfdfs',NULL,NULL,'','','',NULL,'',''),(86,'Noi','Nsdfsdf',NULL,NULL,'Ma','sdfds','0',NULL,'sdffddf','Cavite City'),(87,'dsfsdf','fsdfds',NULL,NULL,'sdfsdf','sdfsd','',NULL,'F','fsdfsdsdfsdf fdsf'),(88,'enteng','',NULL,NULL,'','','M',NULL,'',''),(89,'vhilly','santiago',NULL,NULL,'Madlangbayan','jr','M',NULL,'Filipino','Makati City'),(90,'joanne','santiago',NULL,NULL,'madlangayan','jr','M',NULL,'F','cavite city'),(91,'angela','venice',NULL,NULL,'santiago','','F',NULL,'filipino',''),(92,'vhilly','santiago',NULL,NULL,'Madlangbayan','jr','M',NULL,'Filipino','Makati City');
/*!40000 ALTER TABLE `passenger` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`),
  CONSTRAINT `user_profile_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (1,'Admin','Administrator'),(2,'Demo','Demo');
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles_fields`
--

DROP TABLE IF EXISTS `profiles_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` varchar(15) NOT NULL DEFAULT '0',
  `field_size_min` varchar(15) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles_fields`
--

LOCK TABLES `profiles_fields` WRITE;
/*!40000 ALTER TABLE `profiles_fields` DISABLE KEYS */;
INSERT INTO `profiles_fields` VALUES (1,'lastname','Last Name','VARCHAR','50','3',1,'','','Incorrect Last Name (length between 3 and 50 characters).','','','','',1,3),(2,'firstname','First Name','VARCHAR','50','3',1,'','','Incorrect First Name (length between 3 and 50 characters).','','','','',0,3);
/*!40000 ALTER TABLE `profiles_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `route`
--

DROP TABLE IF EXISTS `route`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `route` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `from` varchar(100) NOT NULL,
  `to` varchar(100) NOT NULL,
  `active` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `route`
--

LOCK TABLES `route` WRITE;
/*!40000 ALTER TABLE `route` DISABLE KEYS */;
INSERT INTO `route` VALUES (1,'CALAPAN-BATANGAS','CALAPAN','BATANGAS','Y');
/*!40000 ALTER TABLE `route` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seat`
--

DROP TABLE IF EXISTS `seat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `active` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seat`
--

LOCK TABLES `seat` WRITE;
/*!40000 ALTER TABLE `seat` DISABLE KEYS */;
/*!40000 ALTER TABLE `seat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seat_ticket_map`
--

DROP TABLE IF EXISTS `seat_ticket_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seat_ticket_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seat` int(11) DEFAULT NULL,
  `ticket` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `seat` (`seat`),
  KEY `ticket` (`ticket`),
  CONSTRAINT `seat_ticket_map_ibfk_1` FOREIGN KEY (`seat`) REFERENCES `seat` (`id`),
  CONSTRAINT `seat_ticket_map_ibfk_2` FOREIGN KEY (`ticket`) REFERENCES `ticket` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seat_ticket_map`
--

LOCK TABLES `seat_ticket_map` WRITE;
/*!40000 ALTER TABLE `seat_ticket_map` DISABLE KEYS */;
/*!40000 ALTER TABLE `seat_ticket_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seating_class`
--

DROP TABLE IF EXISTS `seating_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seating_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `desc` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seating_class`
--

LOCK TABLES `seating_class` WRITE;
/*!40000 ALTER TABLE `seating_class` DISABLE KEYS */;
INSERT INTO `seating_class` VALUES (1,'Business Class',''),(2,'Premium Class',''),(3,'Economy','');
/*!40000 ALTER TABLE `seating_class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp`
--

DROP TABLE IF EXISTS `temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp` (
  `hash` char(32) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `prefix` char(5) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `civil_status` char(1) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `seat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp`
--

LOCK TABLES `temp` WRITE;
/*!40000 ALTER TABLE `temp` DISABLE KEYS */;
/*!40000 ALTER TABLE `temp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voyage` int(11) NOT NULL,
  `price` decimal(20,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `voyage` (`voyage`),
  CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`voyage`) REFERENCES `voyage` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
INSERT INTO `ticket` VALUES (1,1,300.00),(2,1,300.00),(3,1,300.00),(4,1,300.00),(5,1,300.00),(6,1,300.00),(7,1,300.00),(8,1,300.00),(9,1,300.00),(10,1,300.00),(11,1,300.00),(12,1,300.00),(13,1,300.00),(14,1,300.00),(15,1,300.00),(16,1,300.00),(17,1,300.00),(18,1,300.00),(21,1,60.00),(56,1,300.00),(57,1,180.00),(58,1,300.00),(59,1,300.00),(60,1,300.00),(61,1,300.00),(62,1,300.00),(63,1,300.00),(64,1,300.00),(65,1,300.00),(66,1,300.00),(67,1,300.00),(68,1,300.00),(69,1,300.00),(70,1,300.00),(71,1,300.00),(72,1,300.00),(73,1,300.00),(74,1,300.00),(75,1,300.00),(76,1,180.00),(77,1,180.00),(78,1,300.00),(79,1,300.00),(80,1,300.00),(81,1,300.00),(82,1,300.00),(83,1,300.00),(84,1,300.00),(85,1,300.00),(86,1,240.00),(87,1,300.00),(88,1,300.00),(89,1,144.00),(90,1,90.00),(91,1,180.00),(92,1,96.00);
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastvisit_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3','webmaster@example.com','9a24eff8c15a6a141ece27eb6947da0f','2013-05-22 05:15:20','2013-05-24 10:29:58',1,1),(2,'demo','fe01ce2a7fbac8fafaed7c982a04e229','demo@example.com','099f825543f7850cc038b90aaff39fac','2013-05-22 05:15:20','2013-05-24 02:42:32',0,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vessel`
--

DROP TABLE IF EXISTS `vessel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vessel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  `passenger_limit` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vessel`
--

LOCK TABLES `vessel` WRITE;
/*!40000 ALTER TABLE `vessel` DISABLE KEYS */;
INSERT INTO `vessel` VALUES (1,'FASTCAT-A1','Very Fast Ferry',230);
/*!40000 ALTER TABLE `vessel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voyage`
--

DROP TABLE IF EXISTS `voyage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voyage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `vessel` int(11) NOT NULL,
  `route` int(11) NOT NULL,
  `departure_time` time NOT NULL,
  `arrival_time` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vessel` (`vessel`),
  KEY `route` (`route`),
  CONSTRAINT `voyage_ibfk_1` FOREIGN KEY (`vessel`) REFERENCES `vessel` (`id`),
  CONSTRAINT `voyage_ibfk_2` FOREIGN KEY (`route`) REFERENCES `route` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voyage`
--

LOCK TABLES `voyage` WRITE;
/*!40000 ALTER TABLE `voyage` DISABLE KEYS */;
INSERT INTO `voyage` VALUES (1,'ARC-VOY1',1,1,'06:00:00','14:00:00');
/*!40000 ALTER TABLE `voyage` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-05-24 20:08:59
