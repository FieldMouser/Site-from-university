-- MariaDB dump 10.19  Distrib 10.5.23-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: user101
-- ------------------------------------------------------
-- Server version	10.5.23-MariaDB

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
-- Table structure for table `Faculties`
--

DROP TABLE IF EXISTS `Faculties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Faculties` (
  `FacultyID` int(11) NOT NULL AUTO_INCREMENT,
  `FacultyName` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`FacultyID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Faculties`
--

LOCK TABLES `Faculties` WRITE;
/*!40000 ALTER TABLE `Faculties` DISABLE KEYS */;
INSERT INTO `Faculties` VALUES (1,'ПМ'),(2,'АВТ');
/*!40000 ALTER TABLE `Faculties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Groups`
--

DROP TABLE IF EXISTS `Groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Groups` (
  `GroupID` int(11) NOT NULL AUTO_INCREMENT,
  `GroupNumber` varchar(50) DEFAULT NULL,
  `FacultyID` int(11) DEFAULT NULL,
  PRIMARY KEY (`GroupID`),
  KEY `FacultyID` (`FacultyID`),
  CONSTRAINT `Groups_ibfk_1` FOREIGN KEY (`FacultyID`) REFERENCES `Faculties` (`FacultyID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Groups`
--

LOCK TABLES `Groups` WRITE;
/*!40000 ALTER TABLE `Groups` DISABLE KEYS */;
INSERT INTO `Groups` VALUES (1,'СГУАВТ-23',2),(2,'СГУАВТ-21',2),(3,'СГУПМ-13',1),(4,'СГУПМ-15',1),(5,'СГУАВТ-25',2);
/*!40000 ALTER TABLE `Groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PracticePlaces`
--

DROP TABLE IF EXISTS `PracticePlaces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PracticePlaces` (
  `PracticePlaceID` int(11) NOT NULL AUTO_INCREMENT,
  `PlaceName` varchar(255) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`PracticePlaceID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PracticePlaces`
--

LOCK TABLES `PracticePlaces` WRITE;
/*!40000 ALTER TABLE `PracticePlaces` DISABLE KEYS */;
INSERT INTO `PracticePlaces` VALUES (1,'Станция по засеву облаков','Солнечный Город'),(2,'Цветочногородская мастерская','Цветочный Город'),(3,'Змеввский песчанный пляж','Змеевка');
/*!40000 ALTER TABLE `PracticePlaces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `StudentPlacement`
--

DROP TABLE IF EXISTS `StudentPlacement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `StudentPlacement` (
  `PlacementID` int(11) NOT NULL AUTO_INCREMENT,
  `StudentID` int(11) DEFAULT NULL,
  `PracticePlaceID` int(11) DEFAULT NULL,
  PRIMARY KEY (`PlacementID`),
  KEY `StudentID` (`StudentID`),
  KEY `PracticePlaceID` (`PracticePlaceID`),
  CONSTRAINT `StudentPlacement_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `Students` (`StudentID`),
  CONSTRAINT `StudentPlacement_ibfk_2` FOREIGN KEY (`PracticePlaceID`) REFERENCES `PracticePlaces` (`PracticePlaceID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `StudentPlacement`
--

LOCK TABLES `StudentPlacement` WRITE;
/*!40000 ALTER TABLE `StudentPlacement` DISABLE KEYS */;
INSERT INTO `StudentPlacement` VALUES (1,9,3),(2,2,2),(3,4,1),(4,6,1),(5,7,2),(6,1,3),(7,10,1),(8,5,3),(9,8,2),(10,3,1);
/*!40000 ALTER TABLE `StudentPlacement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Students`
--

DROP TABLE IF EXISTS `Students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Students` (
  `StudentID` int(11) NOT NULL AUTO_INCREMENT,
  `LastName` varchar(255) DEFAULT NULL,
  `BirthYear` int(11) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `GroupID` int(11) DEFAULT NULL,
  `AverageGrade` float DEFAULT NULL,
  PRIMARY KEY (`StudentID`),
  KEY `GroupID` (`GroupID`),
  CONSTRAINT `Students_ibfk_1` FOREIGN KEY (`GroupID`) REFERENCES `Groups` (`GroupID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Students`
--

LOCK TABLES `Students` WRITE;
/*!40000 ALTER TABLE `Students` DISABLE KEYS */;
INSERT INTO `Students` VALUES (1,'Винтиков',2003,'М',3,87),(2,'Кубышкина',2002,'Ж',5,65),(3,'Снежинкина',2004,'Ж',1,53),(4,'Растеряйкин',2003,'М',2,91),(5,'Шпунтиков',2001,'М',4,78),(6,'Знайкин',2004,'М',5,72),(7,'Пилюлькин',2002,'М',2,59),(8,'Кнопочкина',2001,'Ж',4,96),(9,'Синеглазкина',2003,'Ж',1,84),(10,'Тюбиков',2002,'М',3,63);
/*!40000 ALTER TABLE `Students` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-25 16:23:15
