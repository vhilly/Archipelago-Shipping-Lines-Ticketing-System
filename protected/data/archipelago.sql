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
  `tkt_no` char(32) NOT NULL,
  `booking_no` char(32) NOT NULL,
  `transaction` int(11) NOT NULL,
  `passenger` int(11) NOT NULL,
  `voyage` int(11) NOT NULL,
  `seat` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `date_booked` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rate` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `passenger` (`passenger`),
  KEY `status` (`status`),
  KEY `transaction` (`transaction`),
  KEY `voyage` (`voyage`),
  KEY `seat` (`seat`),
  KEY `rate` (`rate`),
  CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`passenger`) REFERENCES `passenger` (`id`),
  CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`status`) REFERENCES `booking_status` (`id`),
  CONSTRAINT `booking_ibfk_4` FOREIGN KEY (`transaction`) REFERENCES `transaction` (`id`),
  CONSTRAINT `booking_ibfk_5` FOREIGN KEY (`voyage`) REFERENCES `voyage` (`id`),
  CONSTRAINT `booking_ibfk_6` FOREIGN KEY (`seat`) REFERENCES `seat` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking_cargo`
--

DROP TABLE IF EXISTS `booking_cargo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booking_cargo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lading_no` char(32) NOT NULL,
  `booking_no` char(32) NOT NULL,
  `transaction` int(11) NOT NULL,
  `voyage` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `cargo` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date_booked` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `passenger` (`cargo`),
  KEY `status` (`status`),
  KEY `transaction` (`transaction`),
  KEY `transaction_2` (`transaction`),
  KEY `cargo` (`cargo`),
  KEY `status_2` (`status`),
  KEY `voyage` (`voyage`),
  KEY `rate` (`rate`),
  CONSTRAINT `booking_cargo_ibfk_1` FOREIGN KEY (`transaction`) REFERENCES `transaction` (`id`),
  CONSTRAINT `booking_cargo_ibfk_2` FOREIGN KEY (`cargo`) REFERENCES `cargo` (`id`),
  CONSTRAINT `booking_cargo_ibfk_3` FOREIGN KEY (`status`) REFERENCES `booking_status` (`id`),
  CONSTRAINT `booking_cargo_ibfk_4` FOREIGN KEY (`voyage`) REFERENCES `voyage` (`id`),
  CONSTRAINT `booking_cargo_ibfk_5` FOREIGN KEY (`rate`) REFERENCES `cargo_fare_rates` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking_cargo`
--

LOCK TABLES `booking_cargo` WRITE;
/*!40000 ALTER TABLE `booking_cargo` DISABLE KEYS */;
/*!40000 ALTER TABLE `booking_cargo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking_status`
--

DROP TABLE IF EXISTS `booking_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booking_status` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `desc` tinytext,
  `color` char(32) NOT NULL DEFAULT '#FF6666',
  `active` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking_status`
--

LOCK TABLES `booking_status` WRITE;
/*!40000 ALTER TABLE `booking_status` DISABLE KEYS */;
INSERT INTO `booking_status` VALUES (1,'Reserved','The booking is complete and has locked out further bookings for the same seat. No Payment is associated with this booking.','#FFCC33','Y'),(2,'Paid','The booking has been competed, reserved, and a full payment has been received.','#3366FF','Y'),(3,'Checked-In','Already Checked-In . ','#66CC00','Y'),(4,'Canceled','The booking has been canceled. Locked seat assignment has been removed.','#FF0066','Y');
/*!40000 ALTER TABLE `booking_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cargo`
--

DROP TABLE IF EXISTS `cargo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shipper` varchar(100) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `destination` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `cargo_class` tinyint(4) NOT NULL,
  `article_no` varchar(100) DEFAULT NULL,
  `article_desc` tinytext,
  `weight` int(11) DEFAULT NULL,
  `length` int(11) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cargo_class` (`cargo_class`),
  KEY `cargo_class_2` (`cargo_class`),
  CONSTRAINT `cargo_ibfk_1` FOREIGN KEY (`cargo_class`) REFERENCES `cargo_class` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargo`
--

LOCK TABLES `cargo` WRITE;
/*!40000 ALTER TABLE `cargo` DISABLE KEYS */;
/*!40000 ALTER TABLE `cargo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cargo_class`
--

DROP TABLE IF EXISTS `cargo_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargo_class` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `desc` tinytext NOT NULL,
  `lane_meter` int(11) NOT NULL,
  `as_of` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargo_class`
--

LOCK TABLES `cargo_class` WRITE;
/*!40000 ALTER TABLE `cargo_class` DISABLE KEYS */;
INSERT INTO `cargo_class` VALUES (1,'Tricycle','desc',12,'2013-06-08 10:21:12','Y'),(2,'Bus','desc',14,'2013-06-08 13:19:14','Y'),(3,'jeep','test',12,'2013-06-08 17:04:35','Y');
/*!40000 ALTER TABLE `cargo_class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cargo_fare_rates`
--

DROP TABLE IF EXISTS `cargo_fare_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargo_fare_rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `route` int(11) NOT NULL,
  `class` tinyint(4) NOT NULL,
  `lane_meter_rate` int(11) NOT NULL,
  `proposed_tariff` decimal(20,2) NOT NULL DEFAULT '0.00',
  `as_of` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`),
  KEY `class` (`class`),
  KEY `route` (`route`),
  KEY `route_2` (`route`),
  CONSTRAINT `cargo_fare_rates_ibfk_1` FOREIGN KEY (`route`) REFERENCES `route` (`id`),
  CONSTRAINT `cargo_fare_rates_ibfk_2` FOREIGN KEY (`class`) REFERENCES `cargo_class` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargo_fare_rates`
--

LOCK TABLES `cargo_fare_rates` WRITE;
/*!40000 ALTER TABLE `cargo_fare_rates` DISABLE KEYS */;
INSERT INTO `cargo_fare_rates` VALUES (1,1,1,13,200.00,'2013-06-08 10:43:52','Y'),(2,1,2,14,100.00,'2013-06-08 13:20:47','Y'),(3,1,1,11,0.00,'2013-06-08 17:05:46','Y');
/*!40000 ALTER TABLE `cargo_fare_rates` ENABLE KEYS */;
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
  `route` int(11) NOT NULL,
  `class` tinyint(4) NOT NULL,
  `price` decimal(20,2) NOT NULL DEFAULT '0.00',
  `as_of` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`),
  KEY `class` (`class`),
  KEY `route` (`route`),
  KEY `route_2` (`route`),
  CONSTRAINT `passage_fare_rates_ibfk_1` FOREIGN KEY (`class`) REFERENCES `seating_class` (`id`),
  CONSTRAINT `passage_fare_rates_ibfk_2` FOREIGN KEY (`route`) REFERENCES `route` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passage_fare_rates`
--

LOCK TABLES `passage_fare_rates` WRITE;
/*!40000 ALTER TABLE `passage_fare_rates` DISABLE KEYS */;
INSERT INTO `passage_fare_rates` VALUES (1,'Full Fare','',1,1,300.00,'0000-00-00 00:00:00','Y'),(2,'Full Fare','',1,2,180.00,'0000-00-00 00:00:00','Y'),(3,'Full Fare','',1,3,120.00,'0000-00-00 00:00:00','Y'),(4,'Student','',1,1,240.00,'0000-00-00 00:00:00','Y'),(5,'Student','',1,2,144.00,'0000-00-00 00:00:00','Y'),(6,'Student','',1,3,96.00,'0000-00-00 00:00:00','Y'),(7,'Senior','',1,1,240.00,'0000-00-00 00:00:00','Y'),(8,'Senior','',1,2,144.00,'0000-00-00 00:00:00','Y'),(9,'Senior','',1,3,96.00,'0000-00-00 00:00:00','Y'),(10,'Children','Ages 7 and below',1,1,150.00,'0000-00-00 00:00:00','Y'),(11,'Children','Ages 7 and below',1,2,90.00,'0000-00-00 00:00:00','Y'),(12,'Children','Ages 7 and below',1,3,60.00,'0000-00-00 00:00:00','Y');
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
  `birth_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passenger`
--

LOCK TABLES `passenger` WRITE;
/*!40000 ALTER TABLE `passenger` DISABLE KEYS */;
/*!40000 ALTER TABLE `passenger` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_method`
--

DROP TABLE IF EXISTS `payment_method`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_method` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `desc` tinytext,
  `active` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_method`
--

LOCK TABLES `payment_method` WRITE;
/*!40000 ALTER TABLE `payment_method` DISABLE KEYS */;
INSERT INTO `payment_method` VALUES (1,'Cash','','Y');
/*!40000 ALTER TABLE `payment_method` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_status`
--

DROP TABLE IF EXISTS `payment_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_status` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `desc` tinytext,
  `active` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_status`
--

LOCK TABLES `payment_status` WRITE;
/*!40000 ALTER TABLE `payment_status` DISABLE KEYS */;
INSERT INTO `payment_status` VALUES (1,'Completed','','Y'),(2,'Pending','','Y');
/*!40000 ALTER TABLE `payment_status` ENABLE KEYS */;
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
  `seating_class` tinyint(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `active` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`),
  KEY `seating_class` (`seating_class`),
  CONSTRAINT `seat_ibfk_1` FOREIGN KEY (`seating_class`) REFERENCES `seating_class` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=265 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seat`
--

LOCK TABLES `seat` WRITE;
/*!40000 ALTER TABLE `seat` DISABLE KEYS */;
INSERT INTO `seat` VALUES (1,1,'1A','Y'),(2,1,'2A','Y'),(3,1,'3A','Y'),(4,1,'4A','Y'),(5,1,'5A','Y'),(6,1,'6A','Y'),(7,1,'7A','Y'),(8,1,'8A','Y'),(9,1,'9A','Y'),(10,1,'1B','Y'),(11,1,'2B','Y'),(12,1,'3B','Y'),(13,1,'4B','Y'),(14,1,'5B','Y'),(15,1,'6B','Y'),(16,1,'7B','Y'),(17,1,'8B','Y'),(18,1,'9B','Y'),(19,1,'1C','Y'),(20,1,'2C','Y'),(21,1,'3C','Y'),(22,1,'4C','Y'),(23,1,'5C','Y'),(24,1,'6C','Y'),(25,1,'7C','Y'),(26,1,'8C','Y'),(27,1,'9C','Y'),(28,1,'1D','Y'),(29,1,'2D','Y'),(30,1,'3D','Y'),(31,1,'4D','Y'),(32,1,'5D','Y'),(33,1,'6D','Y'),(34,1,'7D','Y'),(35,1,'8D','Y'),(36,1,'9D','Y'),(37,1,'1E','Y'),(38,1,'2E','Y'),(39,1,'3E','Y'),(40,1,'4E','Y'),(41,1,'5E','Y'),(42,1,'6E','Y'),(43,1,'7E','Y'),(44,1,'8E','Y'),(45,1,'9E','Y'),(46,1,'1F','Y'),(47,1,'2F','Y'),(48,1,'3F','Y'),(49,1,'4F','Y'),(50,1,'5F','Y'),(51,1,'6F','Y'),(52,1,'7F','Y'),(53,1,'8F','Y'),(54,1,'9F','Y'),(55,1,'1G','Y'),(56,1,'2G','Y'),(57,1,'3G','Y'),(58,1,'4G','Y'),(59,1,'5G','Y'),(60,1,'6G','Y'),(61,1,'7G','Y'),(62,1,'8G','Y'),(63,1,'9G','Y'),(64,2,'10A','Y'),(65,2,'11A','Y'),(66,2,'12A','Y'),(67,2,'13A','Y'),(68,2,'14A','Y'),(69,2,'15A','Y'),(70,2,'16A','Y'),(71,2,'17A','Y'),(72,2,'18A','Y'),(73,2,'19A','Y'),(74,2,'20A','Y'),(75,2,'21A','Y'),(76,2,'22A','Y'),(77,2,'23A','Y'),(78,2,'24A','Y'),(79,2,'25A','Y'),(80,2,'26A','Y'),(81,2,'27A','Y'),(82,2,'28A','Y'),(83,2,'29A','Y'),(84,2,'10B','Y'),(85,2,'11B','Y'),(86,2,'12B','Y'),(87,2,'13B','Y'),(88,2,'14B','Y'),(89,2,'15B','Y'),(90,2,'16B','Y'),(91,2,'17B','Y'),(92,2,'18B','Y'),(93,2,'19B','Y'),(94,2,'20B','Y'),(95,2,'21B','Y'),(96,2,'22B','Y'),(97,2,'23B','Y'),(98,2,'24B','Y'),(99,2,'25B','Y'),(100,2,'26B','Y'),(101,2,'27B','Y'),(102,2,'28B','Y'),(103,2,'29B','Y'),(104,2,'18C','Y'),(105,2,'19C','Y'),(106,2,'20C','Y'),(107,2,'21C','Y'),(108,2,'22C','Y'),(109,2,'23C','Y'),(110,2,'24C','Y'),(111,2,'25C','Y'),(112,2,'26C','Y'),(113,2,'27C','Y'),(114,2,'28C','Y'),(115,2,'29C','Y'),(116,2,'18D','Y'),(117,2,'19D','Y'),(118,2,'20D','Y'),(119,2,'21D','Y'),(120,2,'22D','Y'),(121,2,'23D','Y'),(122,2,'24D','Y'),(123,2,'25D','Y'),(124,2,'26D','Y'),(125,2,'27D','Y'),(126,2,'28D','Y'),(127,2,'18E','Y'),(128,2,'19E','Y'),(129,2,'20E','Y'),(130,2,'21E','Y'),(131,2,'22E','Y'),(132,2,'23E','Y'),(133,2,'24E','Y'),(134,2,'25E','Y'),(135,2,'26E','Y'),(136,2,'27E','Y'),(137,2,'28E','Y'),(138,2,'18F','Y'),(139,2,'19F','Y'),(140,2,'20F','Y'),(141,2,'21F','Y'),(142,2,'22F','Y'),(143,2,'23F','Y'),(144,2,'24F','Y'),(145,2,'25F','Y'),(146,2,'26F','Y'),(147,2,'27F','Y'),(148,2,'28F','Y'),(149,2,'18G','Y'),(150,2,'19G','Y'),(151,2,'20G','Y'),(152,2,'21G','Y'),(153,2,'22G','Y'),(154,2,'23G','Y'),(155,2,'24G','Y'),(156,2,'25G','Y'),(157,2,'26G','Y'),(158,2,'27G','Y'),(159,2,'28G','Y'),(160,3,'45A','Y'),(161,3,'43A','Y'),(162,3,'42A','Y'),(163,3,'41A','Y'),(164,3,'40A','Y'),(165,3,'39A','Y'),(166,3,'38A','Y'),(167,3,'37A','Y'),(168,3,'36A','Y'),(169,3,'35A','Y'),(170,3,'34A','Y'),(171,3,'33A','Y'),(172,3,'32A','Y'),(173,3,'31A','Y'),(174,3,'30A','Y'),(175,3,'45B','Y'),(176,3,'43B','Y'),(177,3,'42B','Y'),(178,3,'41B','Y'),(179,3,'40B','Y'),(180,3,'39B','Y'),(181,3,'38B','Y'),(182,3,'37B','Y'),(183,3,'36B','Y'),(184,3,'35B','Y'),(185,3,'34B','Y'),(186,3,'33B','Y'),(187,3,'32B','Y'),(188,3,'31B','Y'),(189,3,'30B','Y'),(190,3,'45C','Y'),(191,3,'43C','Y'),(192,3,'42C','Y'),(193,3,'41C','Y'),(194,3,'40C','Y'),(195,3,'39C','Y'),(196,3,'38C','Y'),(197,3,'37C','Y'),(198,3,'36C','Y'),(199,3,'35C','Y'),(200,3,'34C','Y'),(201,3,'33C','Y'),(202,3,'32C','Y'),(203,3,'31C','Y'),(204,3,'30C','Y'),(205,3,'44D','Y'),(206,3,'43D','Y'),(207,3,'42D','Y'),(208,3,'41D','Y'),(209,3,'40D','Y'),(210,3,'39D','Y'),(211,3,'38D','Y'),(212,3,'37D','Y'),(213,3,'36D','Y'),(214,3,'35D','Y'),(215,3,'34D','Y'),(216,3,'33D','Y'),(217,3,'32D','Y'),(218,3,'31D','Y'),(219,3,'30D','Y'),(220,3,'44E','Y'),(221,3,'43E','Y'),(222,3,'42E','Y'),(223,3,'41E','Y'),(224,3,'40E','Y'),(225,3,'39E','Y'),(226,3,'38E','Y'),(227,3,'37E','Y'),(228,3,'36E','Y'),(229,3,'35E','Y'),(230,3,'34E','Y'),(231,3,'33E','Y'),(232,3,'32E','Y'),(233,3,'31E','Y'),(234,3,'30E','Y'),(235,3,'44F','Y'),(236,3,'43F','Y'),(237,3,'42F','Y'),(238,3,'41F','Y'),(239,3,'40F','Y'),(240,3,'39F','Y'),(241,3,'38F','Y'),(242,3,'37F','Y'),(243,3,'36F','Y'),(244,3,'35F','Y'),(245,3,'34F','Y'),(246,3,'33F','Y'),(247,3,'32F','Y'),(248,3,'31F','Y'),(249,3,'30F','Y'),(250,3,'44G','Y'),(251,3,'43G','Y'),(252,3,'42G','Y'),(253,3,'41G','Y'),(254,3,'40G','Y'),(255,3,'39G','Y'),(256,3,'38G','Y'),(257,3,'37G','Y'),(258,3,'36G','Y'),(259,3,'35G','Y'),(260,3,'34G','Y'),(261,3,'33G','Y'),(262,3,'32G','Y'),(263,3,'31G','Y'),(264,3,'30G','Y');
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
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
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
-- Table structure for table `stowage`
--

DROP TABLE IF EXISTS `stowage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stowage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `active` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stowage`
--

LOCK TABLES `stowage` WRITE;
/*!40000 ALTER TABLE `stowage` DISABLE KEYS */;
/*!40000 ALTER TABLE `stowage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stowage_cargo_map`
--

DROP TABLE IF EXISTS `stowage_cargo_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stowage_cargo_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cargo` int(11) NOT NULL,
  `stowage` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `stowage` (`stowage`),
  KEY `cargo` (`cargo`),
  KEY `stowage_2` (`stowage`),
  CONSTRAINT `stowage_cargo_map_ibfk_2` FOREIGN KEY (`stowage`) REFERENCES `stowage` (`id`),
  CONSTRAINT `stowage_cargo_map_ibfk_3` FOREIGN KEY (`cargo`) REFERENCES `booking_cargo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stowage_cargo_map`
--

LOCK TABLES `stowage_cargo_map` WRITE;
/*!40000 ALTER TABLE `stowage_cargo_map` DISABLE KEYS */;
/*!40000 ALTER TABLE `stowage_cargo_map` ENABLE KEYS */;
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
  `rate` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `voyage` (`voyage`),
  KEY `rate` (`rate`),
  CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`voyage`) REFERENCES `voyage` (`id`),
  CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`rate`) REFERENCES `passage_fare_rates` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL,
  `payment_method` tinyint(4) NOT NULL,
  `payment_status` tinyint(4) NOT NULL,
  `uid` int(11) NOT NULL,
  `trans_date` datetime NOT NULL,
  `input_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ovamount` double NOT NULL DEFAULT '0',
  `ovdiscount` double NOT NULL DEFAULT '0',
  `reference` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `payment_method` (`payment_method`),
  KEY `payment_status` (`payment_status`),
  KEY `uid` (`uid`),
  CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`type`) REFERENCES `transaction_type` (`id`),
  CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`payment_method`) REFERENCES `payment_method` (`id`),
  CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`payment_status`) REFERENCES `payment_status` (`id`),
  CONSTRAINT `transaction_ibfk_4` FOREIGN KEY (`uid`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_type`
--

DROP TABLE IF EXISTS `transaction_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_type` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `navigation_title` varchar(100) NOT NULL,
  `passenger` char(1) NOT NULL DEFAULT 'Y',
  `cargo` char(1) NOT NULL DEFAULT 'N',
  `discount` double NOT NULL DEFAULT '0',
  `discount_percent` tinyint(3) NOT NULL DEFAULT '0',
  `free_passenger` int(11) NOT NULL DEFAULT '0',
  `minimum_passenger` int(11) NOT NULL DEFAULT '0',
  `maximum_passenger` int(11) NOT NULL DEFAULT '0',
  `free_cargo` int(11) NOT NULL DEFAULT '0',
  `minimum_cargo` int(11) NOT NULL DEFAULT '0',
  `active` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_type`
--

LOCK TABLES `transaction_type` WRITE;
/*!40000 ALTER TABLE `transaction_type` DISABLE KEYS */;
INSERT INTO `transaction_type` VALUES (1,'Ticket Only','Purchase Ticket','Y','N',0,0,0,1,10,0,0,'Y'),(2,'Bulk Ticket','Bulk Purchase','Y','Y',0,0,0,1,2,0,1,'Y');
/*!40000 ALTER TABLE `transaction_type` ENABLE KEYS */;
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
INSERT INTO `users` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3','webmaster@example.com','9a24eff8c15a6a141ece27eb6947da0f','2013-05-22 05:15:20','2013-06-11 07:34:43',1,1),(2,'demo','fe01ce2a7fbac8fafaed7c982a04e229','demo@example.com','099f825543f7850cc038b90aaff39fac','2013-05-22 05:15:20','2013-05-24 02:42:32',0,1);
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
  `blocked_seats` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vessel`
--

LOCK TABLES `vessel` WRITE;
/*!40000 ALTER TABLE `vessel` DISABLE KEYS */;
INSERT INTO `vessel` VALUES (1,'FASTCAT-A1','Very Fast Ferry',230,'1,2'),(2,'FASTCAT-A2','FAST CAT',264,''),(3,'VESSEL-3','Vesse',9,'1,2,3,4,5,6,7'),(4,'VESSEL-3','DESC',264,'6,8,9');
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
  `departure_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vessel` (`vessel`),
  KEY `route` (`route`),
  CONSTRAINT `voyage_ibfk_1` FOREIGN KEY (`vessel`) REFERENCES `vessel` (`id`),
  CONSTRAINT `voyage_ibfk_2` FOREIGN KEY (`route`) REFERENCES `route` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voyage`
--

LOCK TABLES `voyage` WRITE;
/*!40000 ALTER TABLE `voyage` DISABLE KEYS */;
INSERT INTO `voyage` VALUES (1,'ARC-VOY1',1,1,'06:00:00','12:00:00','2013-06-10'),(2,'VOY2',1,1,'05:45:00','02:45:00','2013-06-04'),(3,'VOY3',2,1,'08:30:00','01:30:00','2013-06-05'),(4,'VOY4',1,1,'10:45:00','10:45:00','2013-06-30');
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

-- Dump completed on 2013-06-11 16:18:44
