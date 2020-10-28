-- MySQL dump 10.13  Distrib 8.0.21, for Linux (x86_64)
--
-- Host: localhost    Database: bdr_system
-- ------------------------------------------------------
-- Server version	8.0.21-0ubuntu0.20.04.4

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bdr_academics`
--

DROP TABLE IF EXISTS `bdr_academics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bdr_academics` (
  `id` int NOT NULL AUTO_INCREMENT,
  `school` int NOT NULL,
  `user` int NOT NULL,
  `certificate` text NOT NULL,
  `entered_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bdr_academics`
--

LOCK TABLES `bdr_academics` WRITE;
/*!40000 ALTER TABLE `bdr_academics` DISABLE KEYS */;
INSERT INTO `bdr_academics` VALUES (1,2,3,'../certificates/COSC 327 Exam.pdf','2020-10-28 13:52:49'),(2,4,5,'../certificates/ttyy.pdf','2020-10-28 14:59:49');
/*!40000 ALTER TABLE `bdr_academics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bdr_admin`
--

DROP TABLE IF EXISTS `bdr_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bdr_admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bdr_admin`
--

LOCK TABLES `bdr_admin` WRITE;
/*!40000 ALTER TABLE `bdr_admin` DISABLE KEYS */;
INSERT INTO `bdr_admin` VALUES (1,'admin','$2y$10$eqH6K1mv0K1Q/JLQeG/AHu0IfGFd/vHP25J7wWDSmJvmh1cxHj1CS');
/*!40000 ALTER TABLE `bdr_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bdr_company`
--

DROP TABLE IF EXISTS `bdr_company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bdr_company` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(252) NOT NULL,
  `location` varchar(255) NOT NULL,
  `sector` varchar(64) NOT NULL,
  `comp_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bdr_company`
--

LOCK TABLES `bdr_company` WRITE;
/*!40000 ALTER TABLE `bdr_company` DISABLE KEYS */;
INSERT INTO `bdr_company` VALUES (1,'some company','kabete','Telecommunication','C-107342380','$2y$10$xoU/MpdYtoz/dg8oo4oxV.5W7YsynEMBTS8XKNPooRJ4pX8cpycv.'),(2,'Newton and Sons','Meru','Transport','C-968916194','$2y$10$mqlIwDifjbGofLLn0y0lMOxujY.2JmfgsfMi/WKpcwpBr/yrpkOde');
/*!40000 ALTER TABLE `bdr_company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bdr_health_information`
--

DROP TABLE IF EXISTS `bdr_health_information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bdr_health_information` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hospital` int NOT NULL,
  `user` int NOT NULL,
  `diagnosis` text NOT NULL,
  `medication` text NOT NULL,
  `healed` int NOT NULL DEFAULT '0',
  `entered_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `hsp_id_fk` (`hospital`),
  KEY `usr_id_fk` (`user`),
  CONSTRAINT `hsp_id_fk` FOREIGN KEY (`hospital`) REFERENCES `bdr_hospital` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `usr_id_fk` FOREIGN KEY (`user`) REFERENCES `bdr_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bdr_health_information`
--

LOCK TABLES `bdr_health_information` WRITE;
/*!40000 ALTER TABLE `bdr_health_information` DISABLE KEYS */;
INSERT INTO `bdr_health_information` VALUES (1,1,1,'hOMA','Pritons',1,'2020-10-28 13:39:21'),(2,3,1,'yui','ter',0,'2020-10-28 13:58:53'),(3,4,1,'New Health info','Houus',1,'2020-10-28 14:15:32'),(4,5,5,'Acute Bronchial Asthma','Ziluton',0,'2020-10-28 14:50:54');
/*!40000 ALTER TABLE `bdr_health_information` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bdr_hospital`
--

DROP TABLE IF EXISTS `bdr_hospital`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bdr_hospital` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `hosp_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bdr_hospital`
--

LOCK TABLES `bdr_hospital` WRITE;
/*!40000 ALTER TABLE `bdr_hospital` DISABLE KEYS */;
INSERT INTO `bdr_hospital` VALUES (1,'My Hospital','Somewhere','H-1921685721','$2y$10$F1HirT09ieO136Jo7//ro./9Dhv/50VAATgJVJVDQjJH52BMKesfu'),(2,'New Hospital','Kabete','H-402332900','$2y$10$FOJmPMGCFXWzHbIWOQe35uyKuTVCOxYdsry9cygou4iv9mvyFnyxe'),(3,'New Hospital','Kabete','H-177788089','$2y$10$QwYAHF1MkwYCsZA1Or4Ht.1WVuVtdbIgXhrUsWB/H62qoOZwoiatO'),(4,'Meru Level 5','Meru','H-1102321489','$2y$10$fi3mGJyE/Gs5NVEhVzviEeDtv5lovvHAZEKZaqFXmhKzxdyGkThpG'),(5,'Meru Level 5','Meru','H-1306853590','$2y$10$DuUZUsjOp3GTpEUUYMaci.gNUpsV8pmLF.kxJsvMm7VMbhxti6nG6');
/*!40000 ALTER TABLE `bdr_hospital` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bdr_school`
--

DROP TABLE IF EXISTS `bdr_school`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bdr_school` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(252) NOT NULL,
  `location` varchar(255) NOT NULL,
  `level` varchar(64) NOT NULL,
  `sch_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bdr_school`
--

LOCK TABLES `bdr_school` WRITE;
/*!40000 ALTER TABLE `bdr_school` DISABLE KEYS */;
INSERT INTO `bdr_school` VALUES (1,'Some School','Kabete','Tertiary College','S-1436420624','$2y$10$fCOtKfAx3ygiP8wsLQPVgO6bd5pDNNxqBD7RdzQfTsP6ZaPDBuB4u'),(2,'Chuka University','Chuka','University','S-404379703','$2y$10$V.G7E.V5pj9caGEFhXAB1OwHyh0xNJfrbB.ChKtdXruckwNOzK8Ji'),(3,'BURI','Maua','Secondary','S-1183055103','$2y$10$7fzVqppWMds75Ed/q2gpw.8Ixg1nr0Hv67M7Q/mcgO231BDKuvCUa'),(4,'Chuka University','Chuka','University','S-1256175692','$2y$10$wwYlulsXoo3pb7evP09mxO97H9uhgEw5igoxLuNHCSFXEzkN.7w3.');
/*!40000 ALTER TABLE `bdr_school` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bdr_users`
--

DROP TABLE IF EXISTS `bdr_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bdr_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `health` text NOT NULL,
  `pic` text NOT NULL,
  `gender` varchar(16) NOT NULL,
  `dob` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bdr_users`
--

LOCK TABLES `bdr_users` WRITE;
/*!40000 ALTER TABLE `bdr_users` DISABLE KEYS */;
INSERT INTO `bdr_users` VALUES (1,'U-462009319','$2y$10$9CT0Kz2mwkPMMiawjEADcuWJwa/AWJtwfK2GdIGU7udt81sTNQV5.','Test User Name','INieine inei\r\neineinie\r\neinine','../userImages/264Screenshot-20201024091401-660x506.png','male','2020-10-28'),(2,'U-338325624','$2y$10$q5BV.u41.bqgdrCz6o.Ejum43xF46Ys42dnGr9z9HL8eFTRmi3t9C','New User','None','../userImages/1201_fZQihFeFluFT5N8Ab18Kng.jpeg','male','2015-06-05'),(3,'U-278772906','$2y$10$pZyBao08K5v9Nfu9zKjIj.J5ky723YiwyVXMruZPCQRDCIkfrT.Le','Test 3','Asthma','../userImages/802Screenshot-20200911162209-765x535.png','male','2020-10-01'),(4,'U-96873000','$2y$10$Kl2SHLrM46dxaLqnYc1pkO8eR02T7G2gj0SAbbIFBs4zunXg2CLfK','Test User 6','Terminal Illness','../userImages/697italy-1587287_1920.jpg','female','2020-09-30'),(5,'U-2114052621','$2y$10$izW8WuWEcF4Gt7QcteDU9.hc4lkfm6INRy/qvcvE9HWAW6CaACGH6','Test User 7','Hineom','../userImages/645profile_img.jpeg','female','2020-09-30');
/*!40000 ALTER TABLE `bdr_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bdr_work_information`
--

DROP TABLE IF EXISTS `bdr_work_information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bdr_work_information` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company` int NOT NULL,
  `user` int NOT NULL,
  `position` varchar(255) NOT NULL,
  `remarks` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `entered_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id_fk` (`user`),
  KEY `comp_id_fk` (`company`),
  CONSTRAINT `comp_id_fk` FOREIGN KEY (`company`) REFERENCES `bdr_company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_id_fk` FOREIGN KEY (`user`) REFERENCES `bdr_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bdr_work_information`
--

LOCK TABLES `bdr_work_information` WRITE;
/*!40000 ALTER TABLE `bdr_work_information` DISABLE KEYS */;
INSERT INTO `bdr_work_information` VALUES (1,2,5,'Chief Technology Officer','A team player','2020-08-01','2020-10-28','2020-10-28 14:55:57');
/*!40000 ALTER TABLE `bdr_work_information` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-28 15:06:19
