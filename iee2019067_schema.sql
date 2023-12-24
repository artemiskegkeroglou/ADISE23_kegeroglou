-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: dblabs.iee.ihu.gr    Database: iee2019067
-- ------------------------------------------------------
-- Server version	5.7.35

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `board`
--

DROP TABLE IF EXISTS `board`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `board` (
  `x` tinyint(1) NOT NULL,
  `y` tinyint(1) NOT NULL,
  `b_color` enum('R','P','W') NOT NULL,
  `piece_color` enum('R','P') DEFAULT NULL,
  `piece` enum('K1','K2') DEFAULT NULL,
  PRIMARY KEY (`x`,`y`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `board`
--

LOCK TABLES `board` WRITE;
/*!40000 ALTER TABLE `board` DISABLE KEYS */;
INSERT INTO `board` VALUES (1,1,'R','',''),(1,2,'R','',''),(1,3,'R','',''),(1,4,'R','',''),(1,5,'R','',''),(1,6,'W','',''),(1,7,'W','',''),(1,8,'W','',''),(1,9,'W','',''),(1,10,'W','',''),(1,11,'W','',''),(1,12,'W','',''),(1,13,'W','',''),(2,1,'R','',''),(2,2,'W','',''),(2,3,'W','',''),(2,4,'W','',''),(2,5,'R','',''),(2,6,'W','',''),(2,7,'W','',''),(2,8,'W','',''),(2,9,'W','',''),(2,10,'W','',''),(2,11,'W','',''),(2,12,'W','',''),(2,13,'W','',''),(3,1,'R','',''),(3,2,'W','R','K2'),(3,3,'W','',''),(3,4,'W','',''),(3,5,'R','',''),(3,6,'W','',''),(3,7,'W','',''),(3,8,'W','',''),(3,9,'W','',''),(3,10,'W','',''),(3,11,'W','',''),(3,12,'W','',''),(3,13,'W','',''),(4,1,'R','',''),(4,2,'W','R','K1'),(4,3,'W','',''),(4,4,'W','',''),(4,5,'R','',''),(4,6,'W','',''),(4,7,'W','',''),(4,8,'W','',''),(4,9,'W','',''),(4,10,'W','',''),(4,11,'W','',''),(4,12,'W','',''),(4,13,'W','',''),(5,1,'R','',''),(5,2,'R','',''),(5,3,'R','',''),(5,4,'R','',''),(5,5,'R','',''),(5,6,'W','',''),(5,7,'W','',''),(5,8,'W','',''),(5,9,'W','',''),(5,10,'W','',''),(5,11,'W','',''),(5,12,'W','',''),(5,13,'W','',''),(6,1,'W','',''),(6,2,'R','',''),(6,3,'W','',''),(6,4,'W','',''),(6,5,'W','',''),(6,6,'W','',''),(6,7,'W','',''),(6,8,'W','',''),(6,9,'W','',''),(6,10,'W','',''),(6,11,'W','',''),(6,12,'W','',''),(6,13,'W','',''),(7,1,'W','',''),(7,2,'W','',''),(7,3,'W','',''),(7,4,'W','',''),(7,5,'R','',''),(7,6,'W','',''),(7,7,'W','',''),(7,8,'W','',''),(7,9,'P','',''),(7,10,'P','',''),(7,11,'W','',''),(7,12,'W','',''),(7,13,'W','',''),(8,1,'W','',''),(8,2,'W','',''),(8,3,'W','',''),(8,4,'W','',''),(8,5,'W','',''),(8,6,'W','',''),(8,7,'W','',''),(8,8,'W','',''),(8,9,'W','',''),(8,10,'W','',''),(8,11,'W','',''),(8,12,'P','',''),(8,13,'W','',''),(9,1,'W','',''),(9,2,'W','',''),(9,3,'W','',''),(9,4,'W','',''),(9,5,'W','',''),(9,6,'W','',''),(9,7,'W','',''),(9,8,'W','',''),(9,9,'P','',''),(9,10,'P','',''),(9,11,'P','',''),(9,12,'P','',''),(9,13,'P','',''),(10,1,'W','',''),(10,2,'W','',''),(10,3,'W','',''),(10,4,'W','',''),(10,5,'W','',''),(10,6,'W','',''),(10,7,'W','',''),(10,8,'W','',''),(10,9,'P','',''),(10,10,'W','',''),(10,11,'W','',''),(10,12,'W','P','K1'),(10,13,'P','',''),(11,1,'W','',''),(11,2,'W','',''),(11,3,'W','',''),(11,4,'W','',''),(11,5,'W','',''),(11,6,'W','',''),(11,7,'W','',''),(11,8,'W','',''),(11,9,'P','',''),(11,10,'W','',''),(11,11,'W','',''),(11,12,'W','P','K2'),(11,13,'P','',''),(12,1,'W','',''),(12,2,'W','',''),(12,3,'W','',''),(12,4,'W','',''),(12,5,'W','',''),(12,6,'W','',''),(12,7,'W','',''),(12,8,'W','',''),(12,9,'P','',''),(12,10,'W','',''),(12,11,'W','',''),(12,12,'W','',''),(12,13,'P','',''),(13,1,'W','',''),(13,2,'W','',''),(13,3,'W','',''),(13,4,'W','',''),(13,5,'W','',''),(13,6,'W','',''),(13,7,'W','',''),(13,8,'W','',''),(13,9,'P','',''),(13,10,'P','',''),(13,11,'P','',''),(13,12,'P','',''),(13,13,'P','','');
/*!40000 ALTER TABLE `board` ENABLE KEYS */;
UNLOCK TABLES;


DROP PROCEDURE IF EXISTS `clean_board`;
DELIMITER //
CREATE PROCEDURE `clean_board`()
BEGIN
	REPLACE INTO board SELECT * FROM board_empty;
END//
DELIMITER ;
--
-- Table structure for table `board_empty`
--

DROP TABLE IF EXISTS `board_empty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `board_empty` (
  `x` tinyint(1) NOT NULL,
  `y` tinyint(1) NOT NULL,
  `b_color` enum('R','P','W') NOT NULL,
  `piece_color` enum('R','P') DEFAULT NULL,
  `piece` enum('K1','K2') DEFAULT NULL,
  PRIMARY KEY (`x`,`y`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `board_empty`
--

LOCK TABLES `board_empty` WRITE;
/*!40000 ALTER TABLE `board_empty` DISABLE KEYS */;
INSERT INTO `board_empty` VALUES (1,1,'R','',''),(1,2,'R','',''),(1,3,'R','',''),(1,4,'R','',''),(1,5,'R','',''),(1,6,'W','',''),(1,7,'W','',''),(1,8,'W','',''),(1,9,'W','',''),(1,10,'W','',''),(1,11,'W','',''),(1,12,'W','',''),(1,13,'W','',''),(2,1,'R','',''),(2,2,'W','',''),(2,3,'W','',''),(2,4,'W','',''),(2,5,'R','',''),(2,6,'W','',''),(2,7,'W','',''),(2,8,'W','',''),(2,9,'W','',''),(2,10,'W','',''),(2,11,'W','',''),(2,12,'W','',''),(2,13,'W','',''),(3,1,'R','',''),(3,2,'W','R','K2'),(3,3,'W','',''),(3,4,'W','',''),(3,5,'R','',''),(3,6,'W','',''),(3,7,'W','',''),(3,8,'W','',''),(3,9,'W','',''),(3,10,'W','',''),(3,11,'W','',''),(3,12,'W','',''),(3,13,'W','',''),(4,1,'R','',''),(4,2,'W','R','K1'),(4,3,'W','',''),(4,4,'W','',''),(4,5,'R','',''),(4,6,'W','',''),(4,7,'W','',''),(4,8,'W','',''),(4,9,'W','',''),(4,10,'W','',''),(4,11,'W','',''),(4,12,'W','',''),(4,13,'W','',''),(5,1,'R','',''),(5,2,'R','',''),(5,3,'R','',''),(5,4,'R','',''),(5,5,'R','',''),(5,6,'W','',''),(5,7,'W','',''),(5,8,'W','',''),(5,9,'W','',''),(5,10,'W','',''),(5,11,'W','',''),(5,12,'W','',''),(5,13,'W','',''),(6,1,'W','',''),(6,2,'R','',''),(6,3,'W','',''),(6,4,'W','',''),(6,5,'W','',''),(6,6,'W','',''),(6,7,'W','',''),(6,8,'W','',''),(6,9,'W','',''),(6,10,'W','',''),(6,11,'W','',''),(6,12,'W','',''),(6,13,'W','',''),(7,1,'W','',''),(7,2,'W','',''),(7,3,'W','',''),(7,4,'W','',''),(7,5,'R','',''),(7,6,'W','',''),(7,7,'W','',''),(7,8,'W','',''),(7,9,'P','',''),(7,10,'P','',''),(7,11,'W','',''),(7,12,'W','',''),(7,13,'W','',''),(8,1,'W','',''),(8,2,'W','',''),(8,3,'W','',''),(8,4,'W','',''),(8,5,'W','',''),(8,6,'W','',''),(8,7,'W','',''),(8,8,'W','',''),(8,9,'W','',''),(8,10,'W','',''),(8,11,'W','',''),(8,12,'P','',''),(8,13,'W','',''),(9,1,'W','',''),(9,2,'W','',''),(9,3,'W','',''),(9,4,'W','',''),(9,5,'W','',''),(9,6,'W','',''),(9,7,'W','',''),(9,8,'W','',''),(9,9,'P','',''),(9,10,'P','',''),(9,11,'P','',''),(9,12,'P','',''),(9,13,'P','',''),(10,1,'W','',''),(10,2,'W','',''),(10,3,'W','',''),(10,4,'W','',''),(10,5,'W','',''),(10,6,'W','',''),(10,7,'W','',''),(10,8,'W','',''),(10,9,'P','',''),(10,10,'W','',''),(10,11,'W','',''),(10,12,'W','P','K1'),(10,13,'P','',''),(11,1,'W','',''),(11,2,'W','',''),(11,3,'W','',''),(11,4,'W','',''),(11,5,'W','',''),(11,6,'W','',''),(11,7,'W','',''),(11,8,'W','',''),(11,9,'P','',''),(11,10,'W','',''),(11,11,'W','',''),(11,12,'W','P','K2'),(11,13,'P','',''),(12,1,'W','',''),(12,2,'W','',''),(12,3,'W','',''),(12,4,'W','',''),(12,5,'W','',''),(12,6,'W','',''),(12,7,'W','',''),(12,8,'W','',''),(12,9,'P','',''),(12,10,'W','',''),(12,11,'W','',''),(12,12,'W','',''),(12,13,'P','',''),(13,1,'W','',''),(13,2,'W','',''),(13,3,'W','',''),(13,4,'W','',''),(13,5,'W','',''),(13,6,'W','',''),(13,7,'W','',''),(13,8,'W','',''),(13,9,'P','',''),(13,10,'P','',''),(13,11,'P','',''),(13,12,'P','',''),(13,13,'P','','');
/*!40000 ALTER TABLE `board_empty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_status`
--

DROP TABLE IF EXISTS `game_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `game_status` (
  `status` enum('not active','initialized','started','ended','aborded') NOT NULL DEFAULT 'not active',
  `p_turn` enum('R','P') DEFAULT NULL,
  `result` enum('R','P','D') DEFAULT NULL,
  `last_change` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_status`
--

LOCK TABLES `game_status` WRITE;
/*!40000 ALTER TABLE `game_status` DISABLE KEYS */;
INSERT INTO `game_status` VALUES ('started','R','P','2022-11-29 15:00:00');
/*!40000 ALTER TABLE `game_status` ENABLE KEYS */;
UNLOCK TABLES;


DROP PROCEDURE IF EXISTS `move_piece`;
DELIMITER //
CREATE PROCEDURE `move_piece`(x1 tinyint,y1 tinyint,x2 tinyint,y2 tinyint)
BEGIN
	declare  p, p_color char;
	
	select  piece, piece_color into p, p_color FROM `board` WHERE X=x1 AND Y=y1;
	
	update board
	set piece=p, piece_color=p_color
	where x=x2 and y=y2;
	
	UPDATE board
	SET piece=null,piece_color=null
	WHERE X=x1 AND Y=y1;
	update game_status set p_turn=if(p_color='W','B','W');
	
    END//
DELIMITER ;

--
-- Table structure for table `players`
--

DROP TABLE IF EXISTS `players`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `players` (
  `username` varchar(20) DEFAULT NULL,
  `piece_color` enum('P','R') NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  `last_action` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`piece_color`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `players`
--

LOCK TABLES `players` WRITE;
/*!40000 ALTER TABLE `players` DISABLE KEYS */;
INSERT INTO `players` VALUES ('qqqqqq','P','8599a2efe05697622caeddae84507ee3','2022-11-29 15:00:01'),('aaaa','R','05da4297eecc648e840b6d3bfa772adc','2022-11-29 15:00:02');
/*!40000 ALTER TABLE `players` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-29 13:04:35
