-- MySQL dump 10.13  Distrib 5.5.31, for debian-linux-gnu (i686)
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
-- Table structure for table `authorized_cust_shipper`
--

DROP TABLE IF EXISTS `authorized_cust_shipper`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authorized_cust_shipper` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `company` (`company`),
  CONSTRAINT `authorized_cust_shipper_ibfk_1` FOREIGN KEY (`company`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authorized_cust_shipper`
--

LOCK TABLES `authorized_cust_shipper` WRITE;
/*!40000 ALTER TABLE `authorized_cust_shipper` DISABLE KEYS */;
/*!40000 ALTER TABLE `authorized_cust_shipper` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `authorized_cust_vehicle`
--

DROP TABLE IF EXISTS `authorized_cust_vehicle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authorized_cust_vehicle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` int(11) NOT NULL,
  `classification` tinyint(4) NOT NULL,
  `plate_no` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `company` (`company`),
  KEY `classification` (`classification`),
  CONSTRAINT `authorized_cust_vehicle_ibfk_1` FOREIGN KEY (`company`) REFERENCES `customer` (`id`),
  CONSTRAINT `authorized_cust_vehicle_ibfk_2` FOREIGN KEY (`classification`) REFERENCES `cargo_class` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authorized_cust_vehicle`
--

LOCK TABLES `authorized_cust_vehicle` WRITE;
/*!40000 ALTER TABLE `authorized_cust_vehicle` DISABLE KEYS */;
/*!40000 ALTER TABLE `authorized_cust_vehicle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tkt_no` char(32) NOT NULL,
  `tkt_serial` char(32) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `add_booking` AFTER INSERT ON `booking` FOR EACH ROW BEGIN

        

 INSERT INTO booking_history (booking_id,voyage,seat,status,event) VALUES(New.id,New.voyage,New.seat,New.status,1);

    

    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `update_booking` AFTER UPDATE ON `booking` FOR EACH ROW BEGIN
DECLARE event TINYINT(4);
        IF NEW.voyage <> OLD.voyage THEN  
          INSERT INTO booking_history (booking_id,voyage,seat,status,event) VALUES(New.id,NEW.voyage,New.seat,New.status,2);
        END IF;     
        IF New.seat <> OLD.seat THEN
            INSERT INTO booking_history (booking_id,voyage,seat,status,event) VALUES(New.id,NEW.voyage,New.seat,New.status,3);
        END IF;     
        IF New.status <> OLD.status THEN
            INSERT INTO booking_history (booking_id,voyage,seat,status,event) VALUES(New.id,NEW.voyage,New.seat,New.status,4);
        END IF;     
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

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
  `type` tinyint(4) NOT NULL DEFAULT '1',
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
  KEY `type` (`type`),
  CONSTRAINT `booking_cargo_ibfk_1` FOREIGN KEY (`transaction`) REFERENCES `transaction` (`id`),
  CONSTRAINT `booking_cargo_ibfk_2` FOREIGN KEY (`cargo`) REFERENCES `cargo` (`id`),
  CONSTRAINT `booking_cargo_ibfk_3` FOREIGN KEY (`status`) REFERENCES `booking_status` (`id`),
  CONSTRAINT `booking_cargo_ibfk_4` FOREIGN KEY (`voyage`) REFERENCES `voyage` (`id`),
  CONSTRAINT `booking_cargo_ibfk_5` FOREIGN KEY (`rate`) REFERENCES `cargo_fare_rates` (`id`),
  CONSTRAINT `booking_cargo_ibfk_6` FOREIGN KEY (`stowage`) REFERENCES `stowage` (`id`),
  CONSTRAINT `booking_cargo_ibfk_7` FOREIGN KEY (`type`) REFERENCES `booking_type` (`id`)
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
-- Table structure for table `booking_history`
--

DROP TABLE IF EXISTS `booking_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booking_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) NOT NULL,
  `voyage` int(11) NOT NULL,
  `seat` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_id` (`booking_id`),
  KEY `voyage` (`voyage`),
  KEY `seat` (`seat`),
  KEY `status` (`status`),
  CONSTRAINT `booking_history_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`),
  CONSTRAINT `booking_history_ibfk_2` FOREIGN KEY (`voyage`) REFERENCES `voyage` (`id`),
  CONSTRAINT `booking_history_ibfk_3` FOREIGN KEY (`seat`) REFERENCES `seat` (`id`),
  CONSTRAINT `booking_history_ibfk_4` FOREIGN KEY (`status`) REFERENCES `booking_status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking_history`
--

LOCK TABLES `booking_history` WRITE;
/*!40000 ALTER TABLE `booking_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `booking_history` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking_status`
--

LOCK TABLES `booking_status` WRITE;
/*!40000 ALTER TABLE `booking_status` DISABLE KEYS */;
INSERT INTO `booking_status` VALUES (1,'Reserved','The booking is complete and has locked out further bookings for the same seat. No Payment is associated with this booking.','#FFCC33','Y'),(2,'Reserved (Paid)','The booking has been completed, reserved, and a full payment has been received.','#3366FF','Y'),(3,'Checked-In','Already Checked-In . ','#66CC00','Y'),(4,'Boarded','Passenger already boarded','#FF0066','Y'),(5,'No Show','The booking has been canceled. Locked seat assignment has been removed.','#FF6666','Y'),(6,'Refunded',NULL,'#FF6666','Y');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking_type`
--

LOCK TABLES `booking_type` WRITE;
/*!40000 ALTER TABLE `booking_type` DISABLE KEYS */;
INSERT INTO `booking_type` VALUES (1,'Advance','Y'),(2,'Walk-In','Y');
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
  `description` tinytext NOT NULL,
  `lane_meter` int(11) NOT NULL,
  `bundled_passenger` int(11) NOT NULL,
  `active` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargo_class`
--

LOCK TABLES `cargo_class` WRITE;
/*!40000 ALTER TABLE `cargo_class` DISABLE KEYS */;
INSERT INTO `cargo_class` VALUES (1,'Tricycle, Motorcycle','Below 3.9',2,1,'Y'),(2,'Multicab, Owner Type Jeep','3.9',4,2,'Y'),(3,'Sedan, SUV','4 to 4.9',5,2,'Y'),(4,'Single Ztire, 4 Wheeler Truck','5 to 5.9',6,2,'Y'),(5,'Elf, Passenger Jeepney','6 to 6.9',7,2,'Y'),(6,'Forward 6 Wheeler Truck','7 to 7.9',9,2,'Y'),(7,'6 Wheeler truck','8 to 8.9',9,2,'Y'),(8,'6 Wheeler truck, 8 Wheeler truck','9 to 9.9',10,2,'Y'),(9,'8 Wheeler truck, 10 Wheeler truck','10 to 10.9',11,2,'Y'),(10,'10 Wheeler truck, Wing Van','11 to 11.9',12,2,'Y'),(11,'Wing van, 16 Wheeler truck','12 to 12.9',13,2,'Y'),(12,'Extended trucks','13 to 13.9',14,2,'Y');
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
  `active` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`),
  KEY `class` (`class`),
  KEY `route` (`route`),
  KEY `route_2` (`route`),
  CONSTRAINT `cargo_fare_rates_ibfk_1` FOREIGN KEY (`route`) REFERENCES `route` (`id`),
  CONSTRAINT `cargo_fare_rates_ibfk_2` FOREIGN KEY (`class`) REFERENCES `cargo_class` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargo_fare_rates`
--

LOCK TABLES `cargo_fare_rates` WRITE;
/*!40000 ALTER TABLE `cargo_fare_rates` DISABLE KEYS */;
INSERT INTO `cargo_fare_rates` VALUES (1,3,1,0,672.00,'Y'),(2,3,2,0,1344.00,'Y'),(3,3,3,0,1680.00,'Y'),(4,3,4,0,2016.00,'Y'),(5,3,5,0,2352.00,'Y'),(6,3,6,0,3024.00,'Y'),(7,3,7,0,3024.00,'Y'),(8,3,8,0,3360.00,'Y'),(9,3,9,0,3696.00,'Y'),(10,3,10,0,4032.00,'Y'),(11,3,11,0,4368.00,'Y'),(12,3,12,0,4704.00,'Y'),(13,1,1,0,672.00,'Y'),(14,1,2,0,1344.00,'Y'),(15,1,3,0,1680.00,'Y'),(16,1,4,0,2016.00,'Y'),(17,1,5,0,2352.00,'Y'),(18,1,6,0,3024.00,'Y'),(19,1,7,0,3024.00,'Y'),(20,1,8,0,3360.00,'Y'),(21,1,9,0,3696.00,'Y'),(22,1,10,0,4032.00,'Y'),(23,1,11,0,4368.00,'Y'),(24,1,12,0,4704.00,'Y'),(25,2,1,0,672.00,'Y'),(26,2,2,0,1344.00,'Y'),(27,2,3,0,1680.00,'Y'),(28,2,4,0,2016.00,'Y'),(29,2,5,0,2352.00,'Y'),(30,2,6,0,3024.00,'Y'),(31,2,7,0,3024.00,'Y'),(32,2,8,0,3360.00,'Y'),(33,2,9,0,3696.00,'Y'),(34,2,10,0,4032.00,'Y'),(35,2,11,0,4368.00,'Y'),(36,2,12,0,4704.00,'Y');
/*!40000 ALTER TABLE `cargo_fare_rates` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `CARGO_PRICE_UPDATE` AFTER UPDATE ON `cargo_fare_rates` FOR EACH ROW BEGIN
        IF NEW.proposed_tariff <> OLD.proposed_tariff THEN  
            INSERT INTO price_history (category,category_id,price) VALUES(2,New.id,OLD.proposed_tariff);
        END IF;
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` varchar(100) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `contact_no` varchar(100) NOT NULL,
  `address` varchar(250) NOT NULL,
  `active` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'IMPERIUM','Vhilly Santiago','09065504','Makati City','Y');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `misc_fees`
--

DROP TABLE IF EXISTS `misc_fees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `misc_fees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` tinytext NOT NULL,
  `amt` decimal(20,2) NOT NULL,
  `active` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `misc_fees`
--

LOCK TABLES `misc_fees` WRITE;
/*!40000 ALTER TABLE `misc_fees` DISABLE KEYS */;
INSERT INTO `misc_fees` VALUES (1,'Terminal Fee','desc',155.00,'Y'),(2,'Rebooking','Rebooking',30.00,'Y');
/*!40000 ALTER TABLE `misc_fees` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `update_misc_amt` AFTER UPDATE ON `misc_fees` FOR EACH ROW BEGIN
        IF NEW.amt <> OLD.amt THEN  
            INSERT INTO price_history (category,category_id,price) VALUES(3,New.id,OLD.amt);
        END IF;
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `paid_misc_fees`
--

DROP TABLE IF EXISTS `paid_misc_fees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paid_misc_fees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `misc_fee` int(11) NOT NULL,
  `amt` decimal(20,2) NOT NULL DEFAULT '0.00',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `misc_fee` (`misc_fee`),
  CONSTRAINT `paid_misc_fees_ibfk_2` FOREIGN KEY (`misc_fee`) REFERENCES `paid_misc_fees` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paid_misc_fees`
--

LOCK TABLES `paid_misc_fees` WRITE;
/*!40000 ALTER TABLE `paid_misc_fees` DISABLE KEYS */;
/*!40000 ALTER TABLE `paid_misc_fees` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passage_fare_rates`
--

LOCK TABLES `passage_fare_rates` WRITE;
/*!40000 ALTER TABLE `passage_fare_rates` DISABLE KEYS */;
INSERT INTO `passage_fare_rates` VALUES (1,1,1,1,300.00,'Y'),(2,1,1,2,180.00,'Y'),(3,2,1,1,240.00,'Y'),(4,2,1,2,144.00,'Y'),(5,3,1,1,240.00,'Y'),(6,3,1,2,144.00,'Y'),(7,4,1,1,150.00,'Y'),(8,4,1,2,90.00,'Y'),(9,5,1,1,0.00,'Y'),(10,5,1,2,0.00,'Y'),(11,1,2,1,300.00,'Y'),(12,1,2,2,180.00,'Y'),(13,2,2,1,240.00,'Y'),(14,2,2,2,144.00,'Y'),(15,3,2,1,240.00,'Y'),(16,3,2,2,144.00,'Y'),(17,4,2,1,150.00,'Y'),(18,4,2,2,150.00,'Y'),(19,5,2,1,0.00,'Y'),(20,5,2,2,0.00,'Y'),(21,6,1,1,240.00,'Y'),(22,6,1,2,144.00,'Y'),(23,6,2,1,240.00,'Y'),(24,6,2,2,144.00,'Y'),(25,7,1,1,0.00,'Y'),(26,7,1,2,0.00,'Y');
/*!40000 ALTER TABLE `passage_fare_rates` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `PRICE_UPDATE` AFTER UPDATE ON `passage_fare_rates` FOR EACH ROW BEGIN
        IF NEW.price <> OLD.price THEN  
            INSERT INTO price_history (category,category_id,price) VALUES(1,New.id,OLD.price);
        END IF;
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passage_fare_types`
--

LOCK TABLES `passage_fare_types` WRITE;
/*!40000 ALTER TABLE `passage_fare_types` DISABLE KEYS */;
INSERT INTO `passage_fare_types` VALUES (1,'Full-Fare',''),(2,'Student',''),(3,'Senior',''),(4,'Children','Age 7 and below'),(5,'Infant',''),(6,'PWD',''),(7,'w/ PASS','');
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
-- Table structure for table `price_history`
--

DROP TABLE IF EXISTS `price_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` decimal(20,2) NOT NULL,
  `changed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price_history`
--

LOCK TABLES `price_history` WRITE;
/*!40000 ALTER TABLE `price_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `price_history` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (1,'Santiago','Vhilly'),(2,'Demo','Demo'),(3,'Cabug-os','Neil'),(4,'Collera','Dandy'),(5,'One','Teller'),(6,'Fuentes','Ann Everette '),(7,'adelantar','rowell'),(8,'Muje','Anna Viguia'),(9,'factor','beverly kim'),(10,'lorque','mark john'),(11,'cabacang','alfeo'),(12,'Magistrado','Kenneth');
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
-- Table structure for table `refunded_tkts`
--

DROP TABLE IF EXISTS `refunded_tkts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `refunded_tkts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tkt_no` char(32) NOT NULL,
  `tkt_serial` char(32) NOT NULL,
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
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `refunded_tkts`
--

LOCK TABLES `refunded_tkts` WRITE;
/*!40000 ALTER TABLE `refunded_tkts` DISABLE KEYS */;
/*!40000 ALTER TABLE `refunded_tkts` ENABLE KEYS */;
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
  `from_port` varchar(100) NOT NULL,
  `to_port` varchar(100) NOT NULL,
  `active` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `route`
--

LOCK TABLES `route` WRITE;
/*!40000 ALTER TABLE `route` DISABLE KEYS */;
INSERT INTO `route` VALUES (1,'BATANGAS-CALAPAN','BATANGAS','CALAPAN','Y');
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
INSERT INTO `seat` VALUES (1,1,'1A','Y'),(2,1,'2A','Y'),(3,1,'3A','Y'),(4,1,'4A','Y'),(5,1,'5A','Y'),(6,1,'6A','Y'),(7,1,'7A','Y'),(8,1,'8A','Y'),(9,1,'9A','Y'),(10,1,'1B','Y'),(11,1,'2B','Y'),(12,1,'3B','Y'),(13,1,'4B','Y'),(14,1,'5B','Y'),(15,1,'6B','Y'),(16,1,'7B','Y'),(17,1,'8B','Y'),(18,1,'9B','Y'),(19,1,'1C','Y'),(20,1,'2C','Y'),(21,1,'3C','Y'),(22,1,'4C','Y'),(23,1,'5C','Y'),(24,1,'6C','Y'),(25,1,'7C','Y'),(26,1,'8C','Y'),(27,1,'9C','Y'),(28,1,'1D','Y'),(29,1,'2D','Y'),(30,1,'3D','Y'),(31,1,'4D','Y'),(32,1,'5D','Y'),(33,1,'6D','Y'),(34,1,'7D','Y'),(35,1,'8D','Y'),(36,1,'9D','Y'),(37,1,'1E','Y'),(38,1,'2E','Y'),(39,1,'3E','Y'),(40,1,'4E','Y'),(41,1,'5E','Y'),(42,1,'6E','Y'),(43,1,'7E','Y'),(44,1,'8E','Y'),(45,1,'9E','Y'),(46,1,'1F','Y'),(47,1,'2F','Y'),(48,1,'3F','Y'),(49,1,'4F','Y'),(50,1,'5F','Y'),(51,1,'6F','Y'),(52,1,'7F','Y'),(53,1,'8F','Y'),(54,1,'9F','Y'),(55,1,'1G','Y'),(56,1,'2G','Y'),(57,1,'3G','Y'),(58,1,'4G','Y'),(59,1,'5G','Y'),(60,1,'6G','Y'),(61,1,'7G','Y'),(62,1,'8G','Y'),(63,1,'9G','Y'),(64,1,'10A','Y'),(65,1,'11A','Y'),(66,1,'12A','Y'),(67,1,'13A','Y'),(68,1,'14A','Y'),(69,1,'15A','Y'),(70,1,'16A','Y'),(71,1,'17A','Y'),(72,1,'18A','Y'),(73,1,'19A','Y'),(74,1,'20A','Y'),(75,1,'21A','Y'),(76,1,'22A','Y'),(77,1,'23A','Y'),(78,1,'24A','Y'),(79,1,'25A','Y'),(80,1,'26A','Y'),(81,1,'27A','Y'),(82,1,'28A','Y'),(83,1,'29A','Y'),(84,1,'10B','Y'),(85,1,'11B','Y'),(86,1,'12B','Y'),(87,1,'13B','Y'),(88,1,'14B','Y'),(89,1,'15B','Y'),(90,1,'16B','Y'),(91,1,'17B','Y'),(92,1,'18B','Y'),(93,1,'19B','Y'),(94,1,'20B','Y'),(95,1,'21B','Y'),(96,1,'22B','Y'),(97,1,'23B','Y'),(98,1,'24B','Y'),(99,1,'25B','Y'),(100,1,'26B','Y'),(101,1,'27B','Y'),(102,1,'28B','Y'),(103,1,'29B','Y'),(104,1,'18C','Y'),(105,1,'19C','Y'),(106,1,'20C','Y'),(107,1,'21C','Y'),(108,1,'22C','Y'),(109,1,'23C','Y'),(110,1,'24C','Y'),(111,1,'25C','Y'),(112,1,'26C','Y'),(113,1,'27C','Y'),(114,1,'28C','Y'),(115,1,'29C','Y'),(116,1,'18D','Y'),(117,1,'19D','Y'),(118,1,'20D','Y'),(119,1,'21D','Y'),(120,1,'22D','Y'),(121,1,'23D','Y'),(122,1,'24D','Y'),(123,1,'25D','Y'),(124,1,'26D','Y'),(125,1,'27D','Y'),(126,1,'28D','Y'),(127,1,'18E','Y'),(128,1,'19E','Y'),(129,1,'20E','Y'),(130,1,'21E','Y'),(131,1,'22E','Y'),(132,1,'23E','Y'),(133,1,'24E','Y'),(134,1,'25E','Y'),(135,1,'26E','Y'),(136,1,'27E','Y'),(137,1,'28E','Y'),(138,1,'18F','Y'),(139,1,'19F','Y'),(140,1,'20F','Y'),(141,1,'21F','Y'),(142,1,'22F','Y'),(143,1,'23F','Y'),(144,1,'24F','Y'),(145,1,'25F','Y'),(146,1,'26F','Y'),(147,1,'27F','Y'),(148,1,'28F','Y'),(149,1,'18G','Y'),(150,1,'19G','Y'),(151,1,'20G','Y'),(152,1,'21G','Y'),(153,1,'22G','Y'),(154,1,'23G','Y'),(155,1,'24G','Y'),(156,1,'25G','Y'),(157,1,'26G','Y'),(158,1,'27G','Y'),(159,1,'28G','Y'),(160,2,'45A','Y'),(161,2,'43A','Y'),(162,2,'42A','Y'),(163,2,'41A','Y'),(164,2,'40A','Y'),(165,2,'39A','Y'),(166,2,'38A','Y'),(167,2,'37A','Y'),(168,2,'36A','Y'),(169,2,'35A','Y'),(170,2,'34A','Y'),(171,2,'33A','Y'),(172,2,'32A','Y'),(173,2,'31A','Y'),(174,2,'30A','Y'),(175,2,'45B','Y'),(176,2,'43B','Y'),(177,2,'42B','Y'),(178,2,'41B','Y'),(179,2,'40B','Y'),(180,2,'39B','Y'),(181,2,'38B','Y'),(182,2,'37B','Y'),(183,2,'36B','Y'),(184,2,'35B','Y'),(185,2,'34B','Y'),(186,2,'33B','Y'),(187,2,'32B','Y'),(188,2,'31B','Y'),(189,2,'30B','Y'),(190,2,'45C','Y'),(191,2,'43C','Y'),(192,2,'42C','Y'),(193,2,'41C','Y'),(194,2,'40C','Y'),(195,2,'39C','Y'),(196,2,'38C','Y'),(197,2,'37C','Y'),(198,2,'36C','Y'),(199,2,'35C','Y'),(200,2,'34C','Y'),(201,2,'33C','Y'),(202,2,'32C','Y'),(203,2,'31C','Y'),(204,2,'30C','Y'),(205,2,'44D','Y'),(206,2,'43D','Y'),(207,2,'42D','Y'),(208,2,'41D','Y'),(209,2,'40D','Y'),(210,2,'39D','Y'),(211,2,'38D','Y'),(212,2,'37D','Y'),(213,2,'36D','Y'),(214,2,'35D','Y'),(215,2,'34D','Y'),(216,2,'33D','Y'),(217,2,'32D','Y'),(218,2,'31D','Y'),(219,2,'30D','Y'),(220,2,'44E','Y'),(221,2,'43E','Y'),(222,2,'42E','Y'),(223,2,'41E','Y'),(224,2,'40E','Y'),(225,2,'39E','Y'),(226,2,'38E','Y'),(227,2,'37E','Y'),(228,2,'36E','Y'),(229,2,'35E','Y'),(230,2,'34E','Y'),(231,2,'33E','Y'),(232,2,'32E','Y'),(233,2,'31E','Y'),(234,2,'30E','Y'),(235,2,'44F','Y'),(236,2,'43F','Y'),(237,2,'42F','Y'),(238,2,'41F','Y'),(239,2,'40F','Y'),(240,2,'39F','Y'),(241,2,'38F','Y'),(242,2,'37F','Y'),(243,2,'36F','Y'),(244,2,'35F','Y'),(245,2,'34F','Y'),(246,2,'33F','Y'),(247,2,'32F','Y'),(248,2,'31F','Y'),(249,2,'30F','Y'),(250,2,'44G','Y'),(251,2,'43G','Y'),(252,2,'42G','Y'),(253,2,'41G','Y'),(254,2,'40G','Y'),(255,2,'39G','Y'),(256,2,'38G','Y'),(257,2,'37G','Y'),(258,2,'36G','Y'),(259,2,'35G','Y'),(260,2,'34G','Y'),(261,2,'33G','Y'),(262,2,'32G','Y'),(263,2,'31G','Y'),(264,2,'30G','Y');
/*!40000 ALTER TABLE `seat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seat_lock`
--

DROP TABLE IF EXISTS `seat_lock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seat_lock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voyage` int(11) NOT NULL,
  `seat` int(11) NOT NULL,
  `vsid` char(30) NOT NULL,
  `row_index` char(30) NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vsid` (`vsid`),
  UNIQUE KEY `vsid_2` (`vsid`),
  UNIQUE KEY `row_index` (`row_index`),
  KEY `voyage` (`voyage`),
  KEY `seat` (`seat`),
  CONSTRAINT `seat_lock_ibfk_1` FOREIGN KEY (`voyage`) REFERENCES `voyage` (`id`),
  CONSTRAINT `seat_lock_ibfk_2` FOREIGN KEY (`seat`) REFERENCES `seat` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seat_lock`
--

LOCK TABLES `seat_lock` WRITE;
/*!40000 ALTER TABLE `seat_lock` DISABLE KEYS */;
/*!40000 ALTER TABLE `seat_lock` ENABLE KEYS */;
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
  `active` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seating_class`
--

LOCK TABLES `seating_class` WRITE;
/*!40000 ALTER TABLE `seating_class` DISABLE KEYS */;
INSERT INTO `seating_class` VALUES (1,'Business Class','','Y'),(2,'Premium Economy','','Y');
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
  `trans_date` datetime NOT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `input_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ovamount` double NOT NULL DEFAULT '0',
  `ovdiscount` double NOT NULL DEFAULT '0',
  `account_to` int(11) DEFAULT NULL,
  `reference` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `payment_method` (`payment_method`),
  KEY `payment_status` (`payment_status`),
  KEY `account_to` (`account_to`),
  CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`type`) REFERENCES `transaction_type` (`id`),
  CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`payment_method`) REFERENCES `payment_method` (`id`),
  CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`payment_status`) REFERENCES `payment_status` (`id`),
  CONSTRAINT `transaction_ibfk_5` FOREIGN KEY (`account_to`) REFERENCES `customer` (`id`)
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
  `cargo` char(1) NOT NULL DEFAULT 'N',
  `discount` double NOT NULL DEFAULT '0',
  `discount_percent` tinyint(3) NOT NULL DEFAULT '0',
  `bundled_passenger_rate` int(11) DEFAULT NULL,
  `minimum_passenger` int(11) NOT NULL DEFAULT '0',
  `maximum_passenger` int(11) NOT NULL DEFAULT '0',
  `account_to` char(1) NOT NULL DEFAULT 'N',
  `active` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`),
  KEY `bundled_passenger_rate` (`bundled_passenger_rate`),
  CONSTRAINT `transaction_type_ibfk_1` FOREIGN KEY (`bundled_passenger_rate`) REFERENCES `passage_fare_rates` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_type`
--

LOCK TABLES `transaction_type` WRITE;
/*!40000 ALTER TABLE `transaction_type` DISABLE KEYS */;
INSERT INTO `transaction_type` VALUES (1,'Passenger','Ticket Purchase','N',0,0,NULL,1,10,'N','Y'),(2,'Cargo','Cargo/RORO','Y',0,0,1,0,0,'N','Y'),(3,'Cargo Account','Cargo Account To','Y',0,0,1,0,0,'Y','Y');
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
  `username` varchar(100) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3','webmaster@example.com','9a24eff8c15a6a141ece27eb6947da0f','2013-05-22 05:15:20','2013-08-01 06:17:19',1,1),(2,'demo','fe01ce2a7fbac8fafaed7c982a04e229','demo@example.com','099f825543f7850cc038b90aaff39fac','2013-05-22 05:15:20','2013-07-25 02:29:08',0,1),(3,'neil','db684cf96914fce8df7d94353f73edfa','neil@imperium.ph','a15cea299e063b2b77eab0a29bb39197','2013-07-18 12:02:48','2013-07-31 05:56:42',1,1),(4,'yankie','5a51e03713d250b961e1f706a51bc838','yankie@yankie.com','a11ec7013c87aedde046d9371916fac3','2013-07-25 03:47:17','2013-07-25 03:47:37',1,1),(5,'teller1','a23bb7f29e615f5002f5c2a3587aef53','teller@archi.com','baad0bcdde08c4c858e25eb7140b6c54','2013-07-25 03:48:34','2013-07-25 03:49:09',0,1),(6,'anneverette','112225b7b9f48e642b14336e05ce778a','anneverette_fuentes@yahoo.com','063c401709168e12406cd062847c59fe','2013-07-31 05:56:52','2013-07-31 07:35:00',0,1),(7,'rowelladelantar','e10adc3949ba59abbe56e057f20f883e','rowell_adelantar@yahoo.com','f3ef41c020709000fa8c3eb83fef89d7','2013-07-31 05:57:55','2013-07-31 05:58:21',0,1),(8,'annamuje','d758b08bf04484bbcc1cb136ece4af42','annamuje@yahoo.com','120c5d507fca0e533861766fa096ca7a','2013-07-31 06:03:13','2013-07-31 06:24:07',0,1),(9,'kim','e8b21174b0d15a94b83c4f799a421a51','factorbeverlykim@yahoo.com','8e5341a01b9ddaf88481c8e9c70bdf89','2013-07-31 06:08:04','2013-07-31 06:44:04',0,1),(10,'mlorque','3455495112a761fc011a6e91a66b00c5','mlorque@yahoo.com','39eebe0d634cf13377051ffb9d15f79c','2013-07-31 06:10:51','2013-07-31 07:08:53',0,1),(11,'alfeocabacang','b1d7aa8b0f2d45e2fe164e02a95a656f','alfeo.cabacang@fastcat.com','27d19e05cb10881fa797fa97aa677dde','2013-07-31 06:14:50','2013-07-31 06:15:37',0,1),(12,'kenmag','6dd63e79372d96058a0fb477e3013de5','magistradok@yahoo.com','21797f3de006f82c83fab7f59f13a6ec','2013-07-31 06:20:25','2013-07-31 06:21:50',0,1);
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
  `passenger_limit` int(11) NOT NULL DEFAULT '264',
  `blocked_seats` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vessel`
--

LOCK TABLES `vessel` WRITE;
/*!40000 ALTER TABLE `vessel` DISABLE KEYS */;
INSERT INTO `vessel` VALUES (1,'FASTCAT-M1','Very Fast Vesel',264,'');
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
  UNIQUE KEY `name` (`name`),
  KEY `vessel` (`vessel`),
  KEY `route` (`route`),
  KEY `status` (`status`),
  CONSTRAINT `voyage_ibfk_1` FOREIGN KEY (`vessel`) REFERENCES `vessel` (`id`),
  CONSTRAINT `voyage_ibfk_2` FOREIGN KEY (`route`) REFERENCES `route` (`id`),
  CONSTRAINT `voyage_ibfk_3` FOREIGN KEY (`status`) REFERENCES `voyage_status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voyage`
--

LOCK TABLES `voyage` WRITE;
/*!40000 ALTER TABLE `voyage` DISABLE KEYS */;
/*!40000 ALTER TABLE `voyage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voyage_status`
--

DROP TABLE IF EXISTS `voyage_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voyage_status` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voyage_status`
--

LOCK TABLES `voyage_status` WRITE;
/*!40000 ALTER TABLE `voyage_status` DISABLE KEYS */;
INSERT INTO `voyage_status` VALUES (1,'Open',''),(2,'Advance Booking Closed',''),(3,'Voyage Closed','');
/*!40000 ALTER TABLE `voyage_status` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-08-01 14:22:08
