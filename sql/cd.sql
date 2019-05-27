-- MySQL dump 10.13  Distrib 5.7.26, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: CD
-- ------------------------------------------------------
-- Server version	5.7.26-0ubuntu0.19.04.1

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
-- Table structure for table `artists`
--

DROP TABLE IF EXISTS `artists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artists`
--

LOCK TABLES `artists` WRITE;
/*!40000 ALTER TABLE `artists` DISABLE KEYS */;
INSERT INTO `artists` VALUES (2,'asdf'),(3,'test'),(4,'ddis'),(5,'ddis2');
/*!40000 ALTER TABLE `artists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cd`
--

DROP TABLE IF EXISTS `cd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cd` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `album_name` varchar(255) NOT NULL,
  `artist_id` int(10) unsigned NOT NULL,
  `year_of_issue` int(10) unsigned NOT NULL,
  `durations` int(10) unsigned NOT NULL,
  `buy_date` datetime NOT NULL,
  `price` int(10) unsigned NOT NULL,
  `position_room` int(10) unsigned NOT NULL,
  `position_rack` int(10) unsigned NOT NULL,
  `position_shelf` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `artist` (`artist_id`),
  KEY `buy_date` (`buy_date`),
  KEY `duration` (`durations`),
  KEY `position_rack` (`position_rack`),
  KEY `position_room` (`position_room`),
  KEY `position_shelf` (`position_shelf`),
  KEY `price` (`price`),
  KEY `year_of_issue` (`year_of_issue`),
  KEY `album_name` (`album_name`),
  CONSTRAINT `cd_artists_id_fk` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cd`
--

LOCK TABLES `cd` WRITE;
/*!40000 ALTER TABLE `cd` DISABLE KEYS */;
INSERT INTO `cd` VALUES (2,'test',4,134,134,'2019-05-10 00:00:00',1340000,134,14,12);
/*!40000 ALTER TABLE `cd` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-27 18:56:32
