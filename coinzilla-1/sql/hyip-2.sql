-- MySQL dump 10.13  Distrib 8.0.31, for Linux (x86_64)
--
-- Host: localhost    Database: hyip
-- ------------------------------------------------------
-- Server version	8.0.31-0ubuntu0.22.04.1

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
-- Current Database: `hyip`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `hyip` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `hyip`;

--
-- Table structure for table `2021-05-26`
--

DROP TABLE IF EXISTS `2021-05-26`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2021-05-26` (
  `id` int NOT NULL DEFAULT '0',
  `hyip` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `perf` decimal(10,2) NOT NULL DEFAULT '0.00',
  `details` text,
  `ttime` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `2021-05-30`
--

DROP TABLE IF EXISTS `2021-05-30`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2021-05-30` (
  `id` int NOT NULL DEFAULT '0',
  `hyip` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `perf` decimal(10,2) NOT NULL DEFAULT '0.00',
  `details` text,
  `ttime` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `2021-05-31`
--

DROP TABLE IF EXISTS `2021-05-31`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2021-05-31` (
  `id` int NOT NULL DEFAULT '0',
  `hyip` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `perf` decimal(10,2) NOT NULL DEFAULT '0.00',
  `details` text,
  `ttime` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `2021-06-01`
--

DROP TABLE IF EXISTS `2021-06-01`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2021-06-01` (
  `id` int NOT NULL DEFAULT '0',
  `hyip` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `perf` decimal(10,2) NOT NULL DEFAULT '0.00',
  `details` text,
  `ttime` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `2022-09-02`
--

DROP TABLE IF EXISTS `2022-09-02`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2022-09-02` (
  `id` int NOT NULL DEFAULT '0',
  `hyip` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `perf` decimal(10,2) NOT NULL DEFAULT '0.00',
  `details` text,
  `ttime` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `2022-09-03`
--

DROP TABLE IF EXISTS `2022-09-03`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2022-09-03` (
  `id` int NOT NULL DEFAULT '0',
  `hyip` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `perf` decimal(10,2) NOT NULL DEFAULT '0.00',
  `details` text,
  `ttime` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `2022-09-05`
--

DROP TABLE IF EXISTS `2022-09-05`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2022-09-05` (
  `id` int NOT NULL DEFAULT '0',
  `hyip` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `perf` decimal(10,2) NOT NULL DEFAULT '0.00',
  `details` text,
  `ttime` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `2022-09-06`
--

DROP TABLE IF EXISTS `2022-09-06`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2022-09-06` (
  `id` int NOT NULL DEFAULT '0',
  `hyip` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `perf` decimal(10,2) NOT NULL DEFAULT '0.00',
  `details` text,
  `ttime` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `2022-09-07`
--

DROP TABLE IF EXISTS `2022-09-07`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2022-09-07` (
  `id` int NOT NULL DEFAULT '0',
  `hyip` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `perf` decimal(10,2) NOT NULL DEFAULT '0.00',
  `details` text,
  `ttime` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `2022-10-10`
--

DROP TABLE IF EXISTS `2022-10-10`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2022-10-10` (
  `id` int NOT NULL DEFAULT '0',
  `hyip` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `perf` decimal(10,2) NOT NULL DEFAULT '0.00',
  `details` text,
  `ttime` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `2022-10-11`
--

DROP TABLE IF EXISTS `2022-10-11`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `2022-10-11` (
  `id` int NOT NULL DEFAULT '0',
  `hyip` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `perf` decimal(10,2) NOT NULL DEFAULT '0.00',
  `details` text,
  `ttime` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `banner`
--

DROP TABLE IF EXISTS `banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banner` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cus_id` int NOT NULL,
  `banner_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `banner_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `site` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `slot` int NOT NULL,
  `days` int NOT NULL,
  `start_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=258 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `curl_data`
--

DROP TABLE IF EXISTS `curl_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `curl_data` (
  `curl_id` int NOT NULL AUTO_INCREMENT,
  `ttime` datetime DEFAULT CURRENT_TIMESTAMP,
  `curlinfo_effective_url` text,
  `curlinfo_total_time` varchar(255) DEFAULT NULL,
  `curlinfo_response_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`curl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56032 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cus_data`
--

DROP TABLE IF EXISTS `cus_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cus_data` (
  `id` int NOT NULL AUTO_INCREMENT,
  `time_they` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `partner` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `device` varchar(255) DEFAULT NULL,
  `time_me` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `user_email` varchar(255) COLLATE latin1_general_ci DEFAULT '0',
  `address` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `country` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `activation_code` int DEFAULT NULL,
  `agree` int DEFAULT NULL,
  `pwd` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `pwd1` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `user_ip` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `regdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `website` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `sq` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `sa` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `activation_cod` int DEFAULT NULL,
  `agre` int DEFAULT NULL,
  `banned` int DEFAULT '0',
  `pw` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  `delete_reason` text COLLATE latin1_general_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_email` (`pwd`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `graph`
--

DROP TABLE IF EXISTS `graph`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `graph` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hyip` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `perf` decimal(10,2) NOT NULL DEFAULT '0.00',
  `details` text,
  `ttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `htime` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11878 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `graph-1`
--

DROP TABLE IF EXISTS `graph-1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `graph-1` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hyip` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `perf` decimal(10,2) NOT NULL DEFAULT '0.00',
  `details` text,
  `ttime` datetime DEFAULT NULL,
  `htime` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9380 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `graph4`
--

DROP TABLE IF EXISTS `graph4`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `graph4` (
  `id` int NOT NULL DEFAULT '0',
  `hyip` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `perf` decimal(10,2) NOT NULL DEFAULT '0.00',
  `details` text,
  `ttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `htime` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `graph5`
--

DROP TABLE IF EXISTS `graph5`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `graph5` (
  `id` int NOT NULL DEFAULT '0',
  `hyip` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `perf` decimal(10,2) NOT NULL DEFAULT '0.00',
  `details` text,
  `ttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `htime` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `graph_backup`
--

DROP TABLE IF EXISTS `graph_backup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `graph_backup` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hyip` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `perf` decimal(10,2) NOT NULL DEFAULT '0.00',
  `details` text,
  `ttime` datetime DEFAULT NULL,
  `htime` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68388 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hyip`
--

DROP TABLE IF EXISTS `hyip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hyip` (
  `hyip_id` int NOT NULL AUTO_INCREMENT,
  `monitor` varchar(255) DEFAULT NULL,
  `da` tinyint(1) NOT NULL DEFAULT '0',
  `hyip` varchar(255) DEFAULT NULL,
  `hit` tinyint(1) NOT NULL DEFAULT '0',
  `ttime` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`hyip_id`),
  UNIQUE KEY `hyip` (`hyip`)
) ENGINE=InnoDB AUTO_INCREMENT=35196 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hyip1`
--

DROP TABLE IF EXISTS `hyip1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hyip1` (
  `hyip_id` int NOT NULL AUTO_INCREMENT,
  `hyip1` varchar(255) DEFAULT NULL,
  `hit` tinyint(1) NOT NULL DEFAULT '0',
  `ttime` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`hyip_id`),
  UNIQUE KEY `hyip1` (`hyip1`)
) ENGINE=InnoDB AUTO_INCREMENT=2389 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log` (
  `id` int NOT NULL AUTO_INCREMENT,
  `seed` int DEFAULT '0',
  `seed1` int DEFAULT '0',
  `monitor` int DEFAULT '0',
  `hyip` int DEFAULT '0',
  `hyip1` int DEFAULT '0',
  `rate` int DEFAULT '0',
  `graph` int DEFAULT '0',
  `ttime` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1086383 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  `ip` tinytext NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `monitor`
--

DROP TABLE IF EXISTS `monitor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `monitor` (
  `monitor_id` int NOT NULL AUTO_INCREMENT,
  `monitor` varchar(255) DEFAULT NULL,
  `hit` tinyint NOT NULL DEFAULT '0',
  `scode` int DEFAULT NULL,
  `elapsed` decimal(10,2) DEFAULT '0.00',
  `reall` tinyint(1) DEFAULT '0',
  `req` tinyint(1) DEFAULT '0',
  `sel` tinyint(1) DEFAULT '0',
  `alexa` int DEFAULT '0',
  `da` tinyint(1) NOT NULL DEFAULT '0',
  `ttime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `da1` tinyint(1) NOT NULL DEFAULT '0',
  `comment` text,
  PRIMARY KEY (`monitor_id`),
  UNIQUE KEY `monitor` (`monitor`)
) ENGINE=InnoDB AUTO_INCREMENT=9444 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `monitor_1`
--

DROP TABLE IF EXISTS `monitor_1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `monitor_1` (
  `monitor_id` int NOT NULL AUTO_INCREMENT,
  `monitor` varchar(255) DEFAULT NULL,
  `hit` tinyint NOT NULL DEFAULT '0',
  `scode` int DEFAULT NULL,
  `elapsed` int DEFAULT NULL,
  `alexa` int DEFAULT '0',
  `cook` text,
  `headd` text,
  `da` tinyint(1) NOT NULL DEFAULT '0',
  `da1` tinyint(1) NOT NULL DEFAULT '0',
  `ttime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`monitor_id`),
  UNIQUE KEY `monitor` (`monitor`)
) ENGINE=InnoDB AUTO_INCREMENT=7773 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `monitor_backup`
--

DROP TABLE IF EXISTS `monitor_backup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `monitor_backup` (
  `monitor_id` int NOT NULL,
  `monitor` text,
  `hit` tinyint(1) NOT NULL DEFAULT '0',
  `ttime` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `monitor_req`
--

DROP TABLE IF EXISTS `monitor_req`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `monitor_req` (
  `monitor_id` int NOT NULL AUTO_INCREMENT,
  `monitor` varchar(255) DEFAULT NULL,
  `hit` tinyint NOT NULL DEFAULT '0',
  `scode` int DEFAULT NULL,
  `elapsed` decimal(10,2) DEFAULT '0.00',
  `reall` tinyint(1) DEFAULT '0',
  `alexa` int DEFAULT '0',
  `da` tinyint(1) NOT NULL DEFAULT '0',
  `ttime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `da1` tinyint(1) NOT NULL DEFAULT '0',
  `comment` text,
  PRIMARY KEY (`monitor_id`),
  UNIQUE KEY `monitor` (`monitor`)
) ENGINE=InnoDB AUTO_INCREMENT=7773 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `monitor_sel`
--

DROP TABLE IF EXISTS `monitor_sel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `monitor_sel` (
  `monitor_id` int NOT NULL AUTO_INCREMENT,
  `monitor` varchar(255) DEFAULT NULL,
  `hit` tinyint NOT NULL DEFAULT '0',
  `scode` int DEFAULT NULL,
  `elapsed` decimal(10,2) DEFAULT '0.00',
  `reall` tinyint(1) DEFAULT '0',
  `alexa` int DEFAULT '0',
  `da` tinyint(1) NOT NULL DEFAULT '0',
  `ttime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `da1` tinyint(1) NOT NULL DEFAULT '0',
  `comment` text,
  PRIMARY KEY (`monitor_id`),
  UNIQUE KEY `monitor` (`monitor`)
) ENGINE=InnoDB AUTO_INCREMENT=7773 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `new_table`
--

DROP TABLE IF EXISTS `new_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `new_table` (
  `monitor_id` int NOT NULL AUTO_INCREMENT,
  `monitor` varchar(255) DEFAULT NULL,
  `hit` tinyint NOT NULL DEFAULT '0',
  `scode` int DEFAULT NULL,
  `elapsed` int DEFAULT NULL,
  `alexa` int DEFAULT '0',
  `cook` text,
  `headd` text,
  `da` tinyint(1) NOT NULL DEFAULT '0',
  `da1` tinyint(1) NOT NULL DEFAULT '0',
  `ttime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`monitor_id`),
  UNIQUE KEY `monitor` (`monitor`)
) ENGINE=InnoDB AUTO_INCREMENT=7773 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rate`
--

DROP TABLE IF EXISTS `rate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rate` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hyip` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `perf` decimal(10,2) NOT NULL DEFAULT '0.00',
  `details` text,
  `ttime` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=InnoDB AUTO_INCREMENT=2864 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ref`
--

DROP TABLE IF EXISTS `ref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ref` (
  `ref_id` int NOT NULL AUTO_INCREMENT,
  `cus_id` int DEFAULT NULL,
  `ref` varchar(255) DEFAULT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0',
  `rtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ref_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `seed`
--

DROP TABLE IF EXISTS `seed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seed` (
  `seed_id` int NOT NULL AUTO_INCREMENT,
  `seed` varchar(255) DEFAULT NULL,
  `hit` tinyint(1) NOT NULL DEFAULT '0',
  `ttime` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`seed_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `seed1`
--

DROP TABLE IF EXISTS `seed1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seed1` (
  `seed_id` int NOT NULL AUTO_INCREMENT,
  `seed1` varchar(255) DEFAULT NULL,
  `hit` tinyint(1) NOT NULL DEFAULT '0',
  `ttime` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`seed_id`),
  UNIQUE KEY `seed1` (`seed1`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test` (
  `id` int NOT NULL AUTO_INCREMENT,
  `huy` varchar(255) DEFAULT 'kak',
  `rtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `htime` varchar(255) DEFAULT 'kak',
  `ttime` varchar(255) DEFAULT 'kak',
  `mtime` varchar(255) DEFAULT 'kak',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `test2`
--

DROP TABLE IF EXISTS `test2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test2` (
  `id` int NOT NULL DEFAULT '0',
  `huy` varchar(255) DEFAULT NULL,
  `rtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `htime` varchar(255) DEFAULT NULL,
  `ttime` varchar(255) DEFAULT NULL,
  `mtime` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trans`
--

DROP TABLE IF EXISTS `trans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trans` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cus_id` int DEFAULT NULL,
  `amount` decimal(12,8) NOT NULL DEFAULT '0.00000000',
  `usd` decimal(10,2) NOT NULL DEFAULT '0.00',
  `btc` decimal(10,8) NOT NULL DEFAULT '0.00000000',
  `paid` decimal(12,8) NOT NULL DEFAULT '0.00000000',
  `usd_paid` decimal(10,2) NOT NULL DEFAULT '0.00',
  `btc_paid` decimal(11,8) NOT NULL DEFAULT '0.00000000',
  `payment` enum('new','pending','complete','') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'new',
  `ref` tinyint(1) DEFAULT '0',
  `banner_id` int NOT NULL DEFAULT '0',
  `address` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `paytime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `start_date` text COLLATE latin1_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3379 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trans1`
--

DROP TABLE IF EXISTS `trans1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trans1` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cus_id` int DEFAULT '0',
  `amount` decimal(12,8) DEFAULT '0.00000000',
  `usd` decimal(10,2) DEFAULT '0.00',
  `btc` decimal(10,8) DEFAULT '0.00000000',
  `paid` decimal(12,8) DEFAULT '0.00000000',
  `usd_paid` decimal(10,2) DEFAULT '0.00',
  `btc_paid` decimal(11,8) DEFAULT '0.00000000',
  `payment` enum('new','pending','complete','') COLLATE latin1_general_ci DEFAULT 'new',
  `ref` tinyint(1) DEFAULT '0',
  `banner_id` int DEFAULT '0',
  `address` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `paytime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `start_date` text COLLATE latin1_general_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `trans1_address_uindex` (`address`)
) ENGINE=MyISAM AUTO_INCREMENT=11006 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `url_data`
--

DROP TABLE IF EXISTS `url_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `url_data` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tdate` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `lang` varchar(2) DEFAULT NULL,
  `url` varchar(1000) DEFAULT NULL,
  `url_ref` varchar(10000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-10 20:24:24
