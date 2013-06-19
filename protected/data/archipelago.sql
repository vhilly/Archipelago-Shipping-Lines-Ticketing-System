-- MySQL dump 10.13  Distrib 5.5.31, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: archipelago
-- ------------------------------------------------------
-- Server version	5.5.31-0ubuntu0.12.04.2

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
  `type` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `passenger` (`passenger`),
  KEY `status` (`status`),
  KEY `transaction` (`transaction`),
  KEY `voyage` (`voyage`),
  KEY `seat` (`seat`),
  KEY `rate` (`rate`),
  KEY `type` (`type`),
  CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`passenger`) REFERENCES `passenger` (`id`),
  CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`status`) REFERENCES `booking_status` (`id`),
  CONSTRAINT `booking_ibfk_4` FOREIGN KEY (`transaction`) REFERENCES `transaction` (`id`),
  CONSTRAINT `booking_ibfk_5` FOREIGN KEY (`voyage`) REFERENCES `voyage` (`id`),
  CONSTRAINT `booking_ibfk_6` FOREIGN KEY (`seat`) REFERENCES `seat` (`id`),
  CONSTRAINT `booking_ibfk_7` FOREIGN KEY (`rate`) REFERENCES `passage_fare_rates` (`id`),
  CONSTRAINT `booking_ibfk_8` FOREIGN KEY (`type`) REFERENCES `booking_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
INSERT INTO `booking` VALUES (1,'0000000035','0000000037',26,19,1,NULL,4,'2013-06-14 02:24:56',1,1),(2,'0000000036','0000000038',27,20,3,174,3,'2013-06-14 03:06:05',9,1),(3,'0000000037','0000000038',27,21,1,174,3,'2013-06-14 03:06:05',9,1),(4,'0000000038','0000000038',27,22,3,190,2,'2013-06-14 03:06:05',9,1),(5,'0000000039','0000000040',28,23,3,27,2,'2013-06-17 02:32:42',1,1),(6,'0000000040','0000000040',28,24,3,18,3,'2013-06-17 02:32:42',2,1),(7,'0000000039','0000000040',28,23,3,27,2,'2013-06-17 03:28:49',1,1),(8,'0000000039','0000000040',28,23,3,2,2,'2013-06-17 03:30:48',1,1),(9,'0000000041','0000000041',29,25,2,251,3,'2013-06-17 04:57:57',9,1),(10,'0000000042','0000000041',29,26,2,250,3,'2013-06-17 04:57:57',9,1),(11,'0000000043','0000000041',29,27,2,250,3,'2013-06-17 04:57:57',12,1),(12,'0000000044','0000000043',30,28,3,1,2,'2013-06-18 11:05:53',1,1),(13,'0000000045','0000000048',35,29,3,200,2,'2013-06-18 11:56:31',9,1),(14,'0000000046','0000000048',35,30,3,259,2,'2013-06-18 11:56:31',9,1),(15,'0000000047','0000000048',35,31,3,209,2,'2013-06-18 11:56:31',9,1),(16,'0000000048','0000000050',36,32,3,175,2,'2013-06-18 11:57:36',9,1),(17,'0000000049','0000000050',36,33,3,220,2,'2013-06-18 11:57:36',9,1),(18,'0000000050','0000000050',36,34,3,165,2,'2013-06-18 11:57:36',9,1),(19,'0000000051','0000000052',37,35,3,195,2,'2013-06-18 12:09:21',9,1),(20,'0000000052','0000000052',37,36,3,242,2,'2013-06-18 12:09:21',9,1),(21,'0000000053','0000000052',37,37,3,232,2,'2013-06-18 12:09:21',9,1),(22,'0000000054','0000000054',38,38,3,9,2,'2013-06-18 12:15:04',2,1),(23,'0000000055','0000000055',39,39,3,193,2,'2013-06-18 12:15:53',9,1),(24,'0000000056','0000000055',39,40,3,203,2,'2013-06-18 12:15:53',9,1),(25,'0000000057','0000000055',39,41,3,215,2,'2013-06-18 12:15:53',9,1),(29,'0000000048','0000000049',41,45,3,16,2,'2013-06-18 14:00:34',2,1),(30,'0000000049','0000000050',42,46,3,167,2,'2013-06-18 14:01:59',9,1),(31,'0000000050','0000000050',42,47,3,228,2,'2013-06-18 14:01:59',9,1),(32,'0000000051','0000000050',42,48,3,183,2,'2013-06-18 14:01:59',9,1),(34,'0000000053','0000000054',44,50,4,234,2,'2013-06-19 01:11:30',9,1),(35,'0000000054','0000000056',45,51,4,171,2,'2013-06-19 01:25:26',9,1),(36,'0000000055','0000000058',46,52,4,164,2,'2013-06-19 01:53:23',9,1);
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
  `stowage` int(11) DEFAULT NULL,
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
  KEY `stowage` (`stowage`),
  CONSTRAINT `booking_cargo_ibfk_1` FOREIGN KEY (`transaction`) REFERENCES `transaction` (`id`),
  CONSTRAINT `booking_cargo_ibfk_2` FOREIGN KEY (`cargo`) REFERENCES `cargo` (`id`),
  CONSTRAINT `booking_cargo_ibfk_3` FOREIGN KEY (`status`) REFERENCES `booking_status` (`id`),
  CONSTRAINT `booking_cargo_ibfk_4` FOREIGN KEY (`voyage`) REFERENCES `voyage` (`id`),
  CONSTRAINT `booking_cargo_ibfk_5` FOREIGN KEY (`rate`) REFERENCES `cargo_fare_rates` (`id`),
  CONSTRAINT `booking_cargo_ibfk_6` FOREIGN KEY (`stowage`) REFERENCES `stowage` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking_cargo`
--

LOCK TABLES `booking_cargo` WRITE;
/*!40000 ALTER TABLE `booking_cargo` DISABLE KEYS */;
INSERT INTO `booking_cargo` VALUES (1,'0000000005','0000000039',27,1,1,1,NULL,2,'2013-06-14 03:06:05'),(2,'0000000006','0000000042',29,2,2,2,NULL,2,'2013-06-17 04:57:57'),(3,'0000000007','0000000049',35,3,1,3,NULL,2,'2013-06-18 11:56:31'),(4,'0000000008','0000000051',36,3,1,4,NULL,2,'2013-06-18 11:57:36'),(5,'0000000009','0000000053',37,3,1,5,NULL,2,'2013-06-18 12:09:21'),(6,'0000000010','0000000056',39,3,2,6,NULL,2,'2013-06-18 12:15:53'),(8,'0000000010','0000000051',42,3,3,8,2,2,'2013-06-18 14:01:59'),(10,'0000000012','0000000055',44,4,3,10,1,2,'2013-06-19 01:11:30'),(11,'0000000013','0000000057',45,4,3,11,4,2,'2013-06-19 01:25:26'),(12,'0000000014','0000000059',46,4,3,12,3,2,'2013-06-19 01:53:23');
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
-- Table structure for table `booking_type`
--

DROP TABLE IF EXISTS `booking_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booking_type` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `active` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking_type`
--

LOCK TABLES `booking_type` WRITE;
/*!40000 ALTER TABLE `booking_type` DISABLE KEYS */;
INSERT INTO `booking_type` VALUES (1,'Advance','Y');
/*!40000 ALTER TABLE `booking_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cargo`
--

DROP TABLE IF EXISTS `cargo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plate_num` varchar(10) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargo`
--

LOCK TABLES `cargo` WRITE;
/*!40000 ALTER TABLE `cargo` DISABLE KEYS */;
INSERT INTO `cargo` VALUES (1,NULL,'SHIP','COMPANY',NULL,'makati',1,'','',NULL,NULL,NULL),(2,NULL,'','',NULL,'',2,'','',NULL,NULL,NULL),(3,NULL,'','',NULL,'',1,'','',NULL,NULL,NULL),(4,NULL,'','',NULL,'',1,'','',NULL,NULL,NULL),(5,NULL,'','',NULL,'',1,'','',NULL,NULL,NULL),(6,NULL,'','',NULL,'',2,'','',NULL,NULL,NULL),(8,NULL,'gdfg','dfg',NULL,'fgh',3,'1','dfg',2,3,NULL),(10,NULL,'neil','imperium',NULL,'makati',3,'5','asaf',1,23,NULL),(11,'TEC775','neil','imperium',NULL,'makati',3,'1','afd',71,63,NULL),(12,'ITC664','neil','imperium',NULL,'makati',3,'5','ASD',1,2,NULL);
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
  `description` tinytext NOT NULL,
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
INSERT INTO `cargo_class` VALUES (1,'Tricycle,Motorcycle','Below 3.9',2,'2013-06-14 02:48:36','Y'),(2,'Multicab,Owner Type Jeep','3.9',4,'2013-06-14 02:50:53','Y'),(3,'Sedan,SUV','4 to 4.9',5,'2013-06-14 03:02:53','Y');
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
INSERT INTO `cargo_fare_rates` VALUES (1,1,1,14,672.00,'2013-06-14 03:03:20','Y'),(2,1,2,14,1344.00,'2013-06-14 03:03:46','Y'),(3,1,3,14,1680.00,'2013-06-14 03:04:09','Y');
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
  `type` tinyint(4) NOT NULL,
  `route` int(11) NOT NULL,
  `class` tinyint(4) NOT NULL,
  `price` decimal(20,2) NOT NULL DEFAULT '0.00',
  `as_of` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`),
  KEY `class` (`class`),
  KEY `route` (`route`),
  KEY `route_2` (`route`),
  KEY `type` (`type`),
  KEY `type_2` (`type`),
  CONSTRAINT `passage_fare_rates_ibfk_1` FOREIGN KEY (`class`) REFERENCES `seating_class` (`id`),
  CONSTRAINT `passage_fare_rates_ibfk_2` FOREIGN KEY (`route`) REFERENCES `route` (`id`),
  CONSTRAINT `passage_fare_rates_ibfk_3` FOREIGN KEY (`type`) REFERENCES `passage_fare_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passage_fare_rates`
--

LOCK TABLES `passage_fare_rates` WRITE;
/*!40000 ALTER TABLE `passage_fare_rates` DISABLE KEYS */;
INSERT INTO `passage_fare_rates` VALUES (1,1,1,1,300.00,'2013-06-13 10:46:27','Y'),(2,2,1,1,240.00,'2013-06-13 10:52:09','Y'),(3,3,1,1,240.00,'2013-06-13 10:52:50','Y'),(4,4,1,1,150.00,'2013-06-13 10:53:09','Y'),(5,1,1,2,180.00,'2013-06-13 10:54:57','Y'),(6,2,1,2,144.00,'2013-06-13 10:55:12','Y'),(7,3,1,2,144.00,'2013-06-13 10:55:22','Y'),(8,4,1,2,90.00,'2013-06-13 10:55:46','Y'),(9,1,1,3,120.00,'2013-06-13 10:57:43','Y'),(10,2,1,3,96.00,'2013-06-13 10:58:05','Y'),(11,3,1,3,96.00,'2013-06-13 10:58:15','Y'),(12,4,1,3,60.00,'2013-06-13 10:58:26','Y');
/*!40000 ALTER TABLE `passage_fare_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `passage_fare_types`
--

DROP TABLE IF EXISTS `passage_fare_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `passage_fare_types` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `proposed` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passage_fare_types`
--

LOCK TABLES `passage_fare_types` WRITE;
/*!40000 ALTER TABLE `passage_fare_types` DISABLE KEYS */;
INSERT INTO `passage_fare_types` VALUES (1,'Full Fare',NULL),(2,'Student',NULL),(3,'Senior',NULL),(4,'Children',NULL);
/*!40000 ALTER TABLE `passage_fare_types` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passenger`
--

LOCK TABLES `passenger` WRITE;
/*!40000 ALTER TABLE `passenger` DISABLE KEYS */;
INSERT INTO `passenger` VALUES (19,'vhilly','santiagos',NULL,'2323','Madlangbayan','','M',NULL,'Filipino','Makati\\','2013-06-01'),(20,'test','test','sfsdf','2323','test','','M',NULL,'','test','2013-06-14'),(21,'test','test',NULL,'test','test','','M',NULL,'','makati','2013-06-01'),(22,'test','test',NULL,'test','','','M',NULL,'','makti','2013-06-29'),(23,'vhilly','santiago',NULL,NULL,'Madlangbayan','','M',NULL,'Filipino','Makati City','2013-06-10'),(24,'joanne','',NULL,'09065804375','marasigan','','M',NULL,'Filipino','Makati City','2013-05-01'),(25,'a','te','test','test','','','M',NULL,'','test','2013-06-17'),(26,'b','tewtwet',NULL,'test','','','M',NULL,'','test','2013-06-03'),(27,'c','',NULL,NULL,'','','',NULL,'','','2013-06-30'),(28,'','',NULL,NULL,'','','',NULL,'','','2013-06-18'),(29,'','',NULL,NULL,'','','',NULL,'','','2013-06-18'),(30,'','',NULL,NULL,'','','',NULL,'','','2013-06-12'),(31,'','',NULL,NULL,'','','',NULL,'','','2013-06-01'),(32,'','',NULL,NULL,'','','',NULL,'','','2013-06-18'),(33,'','',NULL,NULL,'','','',NULL,'','','2013-06-06'),(34,'','',NULL,NULL,'','','',NULL,'','','2013-06-06'),(35,'','',NULL,NULL,'','','',NULL,'','','2013-06-24'),(36,'','',NULL,NULL,'','','',NULL,'','','2013-06-03'),(37,'','',NULL,NULL,'','','',NULL,'','','2013-06-01'),(38,'','',NULL,NULL,'','','',NULL,'','','2013-06-04'),(39,'','',NULL,NULL,'','','',NULL,'','','2013-06-05'),(40,'','',NULL,NULL,'','','',NULL,'','','2013-06-01'),(41,'','',NULL,NULL,'','','',NULL,'','','2013-06-01'),(45,'','',NULL,NULL,'','','M',NULL,'','','2013-06-18'),(46,'','',NULL,NULL,'','','M',NULL,'','','2013-06-05'),(47,'','',NULL,NULL,'','','M',NULL,'','','2013-06-19'),(48,'','',NULL,NULL,'','','F',NULL,'','','2013-06-12'),(50,'sample1','asdasd',NULL,NULL,'aasdas','','M',NULL,'American','','2013-06-13'),(51,'asdas','asdfhg',NULL,NULL,'middle name','','M',NULL,'Chinese','','2013-06-12'),(52,'','',NULL,NULL,'','','',NULL,'','','2013-06-18');
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
-- Table structure for table `seating_class`
--

DROP TABLE IF EXISTS `seating_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seating_class` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stowage`
--

LOCK TABLES `stowage` WRITE;
/*!40000 ALTER TABLE `stowage` DISABLE KEYS */;
INSERT INTO `stowage` VALUES (1,'1','Y'),(2,'2','Y'),(3,'3','Y'),(4,'4','Y'),(5,'5','Y'),(6,'6','Y'),(7,'7','Y'),(8,'8','Y'),(9,'9','Y'),(10,'10','Y'),(11,'11','Y'),(12,'12','Y'),(13,'13','Y'),(14,'14','Y'),(15,'15','Y'),(16,'16','Y'),(17,'17','Y'),(18,'18','Y'),(19,'19','Y'),(20,'20','Y'),(21,'21','Y'),(22,'22','Y'),(23,'23','Y'),(24,'24','Y'),(25,'25','Y'),(26,'26','Y'),(27,'27','Y'),(28,'28','Y'),(29,'29','Y'),(30,'30','Y'),(31,'31','Y'),(32,'32','Y'),(33,'33','Y'),(34,'34','Y'),(35,'35','Y'),(36,'36','Y'),(37,'37','Y'),(38,'38','Y'),(39,'39','Y'),(40,'30','Y'),(41,'41','Y');
/*!40000 ALTER TABLE `stowage` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` VALUES (26,1,1,1,1,'2013-06-14 10:24:56','2013-06-14 02:24:56',300,0,NULL),(27,2,1,1,1,'2013-06-14 11:06:05','2013-06-14 03:06:05',1032,0,NULL),(28,1,1,1,1,'2013-06-17 10:32:42','2013-06-17 02:32:42',540,0,NULL),(29,2,1,1,1,'2013-06-17 12:57:57','2013-06-17 04:57:57',1644,0,NULL),(30,1,1,1,1,'2013-06-18 19:05:53','2013-06-18 11:05:53',300,0,NULL),(35,2,1,1,1,'2013-06-18 19:56:31','2013-06-18 11:56:31',672,720,NULL),(36,2,1,1,1,'2013-06-18 19:57:36','2013-06-18 11:57:36',672,360,NULL),(37,2,1,1,1,'2013-06-18 20:09:21','2013-06-18 12:09:21',672,360,NULL),(38,1,1,1,1,'2013-06-18 20:15:04','2013-06-18 12:15:04',240,0,NULL),(39,2,1,1,1,'2013-06-18 20:15:53','2013-06-18 12:15:53',1704,720,NULL),(41,1,1,1,1,'2013-06-18 22:00:34','2013-06-18 14:00:34',240,0,NULL),(42,2,1,1,1,'2013-06-18 22:01:59','2013-06-18 14:01:59',2040,720,NULL),(44,2,1,1,1,'2013-06-19 09:11:30','2013-06-19 01:11:30',1680,120,NULL),(45,2,1,1,1,'2013-06-19 09:25:26','2013-06-19 01:25:26',1680,120,NULL),(46,2,1,1,1,'2013-06-19 09:53:23','2013-06-19 01:53:23',1680,120,NULL);
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
  `bundled_passenger` int(11) NOT NULL DEFAULT '0',
  `bundled_passenger_rate` int(11) DEFAULT NULL,
  `minimum_passenger` int(11) NOT NULL DEFAULT '0',
  `maximum_passenger` int(11) NOT NULL DEFAULT '0',
  `free_cargo` int(11) NOT NULL DEFAULT '0',
  `minimum_cargo` int(11) NOT NULL DEFAULT '0',
  `terminal_fee` char(1) NOT NULL DEFAULT 'Y',
  `terminal_fee_amnt` decimal(20,2) NOT NULL DEFAULT '0.00',
  `active` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`),
  KEY `bundled_passenger_rate` (`bundled_passenger_rate`),
  CONSTRAINT `transaction_type_ibfk_1` FOREIGN KEY (`bundled_passenger_rate`) REFERENCES `passage_fare_rates` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_type`
--

LOCK TABLES `transaction_type` WRITE;
/*!40000 ALTER TABLE `transaction_type` DISABLE KEYS */;
INSERT INTO `transaction_type` VALUES (1,'Ticket Only','Ticket Purchase','Y','N',0,0,0,1,1,10,0,0,'Y',0.00,'Y'),(2,'Bulk Ticket','Bulk Purchase','Y','Y',0,0,1,1,1,20,0,0,'Y',0.00,'Y');
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
INSERT INTO `users` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3','webmaster@example.com','9a24eff8c15a6a141ece27eb6947da0f','2013-05-22 05:15:20','2013-06-19 10:03:12',1,1),(2,'demo','fe01ce2a7fbac8fafaed7c982a04e229','demo@example.com','099f825543f7850cc038b90aaff39fac','2013-05-22 05:15:20','2013-05-24 02:42:32',0,1);
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
  `description` text NOT NULL,
  `passenger_limit` int(11) NOT NULL,
  `blocked_seats` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vessel`
--

LOCK TABLES `vessel` WRITE;
/*!40000 ALTER TABLE `vessel` DISABLE KEYS */;
INSERT INTO `vessel` VALUES (1,'VESSEL-1','Very Fast Vessel',260,''),(2,'VESSEL-2','Fast Vessel',260,''),(3,'VESSEL-3','Super Fast Vessel',264,'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137');
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
  `status` tinyint(4) NOT NULL DEFAULT '1',
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
INSERT INTO `voyage` VALUES (1,'VOY1',1,1,'07:00:00','07:00:00','2013-06-14',1),(2,'VOY-LET',3,1,'10:15:00','10:15:00','2013-06-17',1),(3,'VOY-ZEN',2,1,'10:15:00','10:15:00','2013-06-18',1),(4,'FASTCAT-M1-6',1,1,'07:15:00','07:15:00','2013-06-19',1);
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

-- Dump completed on 2013-06-20  7:49:20
