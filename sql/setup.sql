-- MySQL dump 10.13  Distrib 5.7.23, for Linux (x86_64)
--
-- Host: localhost    Database: tecnikanto
-- ------------------------------------------------------
-- Server version	5.7.23

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
-- Table structure for table `calendar`
--

DROP TABLE IF EXISTS `calendar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student` varchar(12) COLLATE latin1_spanish_ci NOT NULL,
  `date` date NOT NULL,
  `time` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `bookdate` datetime DEFAULT NULL,
  `canceldate` datetime DEFAULT NULL,
  `cancelby` varchar(12) COLLATE latin1_spanish_ci DEFAULT NULL,
  `flag` int(11) NOT NULL DEFAULT '0',
  `updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=328 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendar`
--

LOCK TABLES `calendar` WRITE;
/*!40000 ALTER TABLE `calendar` DISABLE KEYS */;
INSERT INTO `calendar` VALUES (320,'ninas','2018-10-01',800,30,'2018-10-20 12:02:30',NULL,NULL,0,'2018-10-20 12:02:30'),(321,'ninas','2018-10-22',1400,60,'2018-10-20 12:13:34','2018-10-20 12:56:35','ninas',1,'2018-10-20 12:56:35'),(322,'ninas','2018-10-22',1430,0,'2018-10-20 12:13:34','2018-10-20 12:56:35','ninas',1,'2018-10-20 12:56:35'),(323,'ninas','2018-10-22',1800,30,'2018-10-20 15:00:20','2018-10-20 15:00:37','ninas',1,'2018-10-20 15:00:37'),(324,'danieli','2018-10-20',800,60,'2018-10-20 14:00:51',NULL,NULL,0,'2018-10-20 14:00:51'),(325,'danieli','2018-10-20',830,0,'2018-10-20 14:00:51',NULL,NULL,0,'2018-10-20 14:00:51'),(326,'admin','2018-10-20',2100,60,NULL,NULL,NULL,0,'2018-10-20 12:14:07'),(327,'admin','2018-10-20',2130,0,NULL,NULL,NULL,0,'2018-10-20 12:14:07');
/*!40000 ALTER TABLE `calendar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `lastname` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `username` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `phone` int(12) NOT NULL,
  `password` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;



-- Dump completed on 2018-10-20 16:53:13
