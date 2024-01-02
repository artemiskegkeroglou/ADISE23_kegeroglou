-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: iee2019067_schema
-- ------------------------------------------------------
-- Server version	5.5.5-10.11.4-MariaDB-1~deb12u1-log

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `board`
--

LOCK TABLES `board` WRITE;
/*!40000 ALTER TABLE `board` DISABLE KEYS */;
INSERT INTO `board` VALUES (1,1,'R',NULL,NULL),(1,2,'R',NULL,NULL),(1,3,'R',NULL,NULL),(1,4,'R',NULL,NULL),(1,5,'R',NULL,NULL),(1,6,'W','R','K2'),(1,7,'W',NULL,NULL),(1,8,'W',NULL,NULL),(1,9,'W',NULL,NULL),(1,10,'W',NULL,NULL),(1,11,'W',NULL,NULL),(1,12,'W',NULL,NULL),(1,13,'W',NULL,NULL),(2,1,'R',NULL,NULL),(2,2,'W',NULL,NULL),(2,3,'W',NULL,NULL),(2,4,'W',NULL,NULL),(2,5,'R',NULL,NULL),(2,6,'W',NULL,NULL),(2,7,'W',NULL,NULL),(2,8,'W',NULL,NULL),(2,9,'W',NULL,NULL),(2,10,'W',NULL,NULL),(2,11,'W',NULL,NULL),(2,12,'W',NULL,NULL),(2,13,'W',NULL,NULL),(3,1,'R',NULL,NULL),(3,2,'W',NULL,NULL),(3,3,'W',NULL,NULL),(3,4,'W',NULL,NULL),(3,5,'R',NULL,NULL),(3,6,'W',NULL,NULL),(3,7,'W',NULL,NULL),(3,8,'W',NULL,NULL),(3,9,'W',NULL,NULL),(3,10,'W',NULL,NULL),(3,11,'W',NULL,NULL),(3,12,'W',NULL,NULL),(3,13,'W',NULL,NULL),(4,1,'R',NULL,NULL),(4,2,'W',NULL,NULL),(4,3,'W',NULL,NULL),(4,4,'W',NULL,NULL),(4,5,'R',NULL,NULL),(4,6,'W',NULL,NULL),(4,7,'W',NULL,NULL),(4,8,'W',NULL,NULL),(4,9,'W',NULL,NULL),(4,10,'W',NULL,NULL),(4,11,'W',NULL,NULL),(4,12,'W',NULL,NULL),(4,13,'W',NULL,NULL),(5,1,'R',NULL,NULL),(5,2,'R',NULL,NULL),(5,3,'R',NULL,NULL),(5,4,'R',NULL,NULL),(5,5,'R',NULL,NULL),(5,6,'W',NULL,NULL),(5,7,'W',NULL,NULL),(5,8,'W',NULL,NULL),(5,9,'W',NULL,NULL),(5,10,'W',NULL,NULL),(5,11,'W',NULL,NULL),(5,12,'W',NULL,NULL),(5,13,'W',NULL,NULL),(6,1,'W',NULL,NULL),(6,2,'R',NULL,NULL),(6,3,'W',NULL,NULL),(6,4,'W',NULL,NULL),(6,5,'W',NULL,NULL),(6,6,'W',NULL,NULL),(6,7,'W',NULL,NULL),(6,8,'W',NULL,NULL),(6,9,'W',NULL,NULL),(6,10,'W',NULL,NULL),(6,11,'W',NULL,NULL),(6,12,'W',NULL,NULL),(6,13,'W',NULL,NULL),(7,1,'W',NULL,NULL),(7,2,'W',NULL,NULL),(7,3,'W',NULL,NULL),(7,4,'W',NULL,NULL),(7,5,'R','R','K1'),(7,6,'W',NULL,NULL),(7,7,'W',NULL,NULL),(7,8,'W',NULL,NULL),(7,9,'P',NULL,NULL),(7,10,'P',NULL,NULL),(7,11,'W','P','K1'),(7,12,'W',NULL,NULL),(7,13,'W',NULL,NULL),(8,1,'W',NULL,NULL),(8,2,'W',NULL,NULL),(8,3,'W',NULL,NULL),(8,4,'W',NULL,NULL),(8,5,'W',NULL,NULL),(8,6,'W',NULL,NULL),(8,7,'W',NULL,NULL),(8,8,'W',NULL,NULL),(8,9,'W',NULL,NULL),(8,10,'W',NULL,NULL),(8,11,'W',NULL,NULL),(8,12,'P','P','K2'),(8,13,'W',NULL,NULL),(9,1,'W',NULL,NULL),(9,2,'W',NULL,NULL),(9,3,'W',NULL,NULL),(9,4,'W',NULL,NULL),(9,5,'W',NULL,NULL),(9,6,'W',NULL,NULL),(9,7,'W',NULL,NULL),(9,8,'W',NULL,NULL),(9,9,'P',NULL,NULL),(9,10,'P',NULL,NULL),(9,11,'P',NULL,NULL),(9,12,'P',NULL,NULL),(9,13,'P',NULL,NULL),(10,1,'W',NULL,NULL),(10,2,'W',NULL,NULL),(10,3,'W',NULL,NULL),(10,4,'W',NULL,NULL),(10,5,'W',NULL,NULL),(10,6,'W',NULL,NULL),(10,7,'W',NULL,NULL),(10,8,'W',NULL,NULL),(10,9,'P',NULL,NULL),(10,10,'W',NULL,NULL),(10,11,'W',NULL,NULL),(10,12,'W',NULL,NULL),(10,13,'P',NULL,NULL),(11,1,'W',NULL,NULL),(11,2,'W',NULL,NULL),(11,3,'W',NULL,NULL),(11,4,'W',NULL,NULL),(11,5,'W',NULL,NULL),(11,6,'W',NULL,NULL),(11,7,'W',NULL,NULL),(11,8,'W',NULL,NULL),(11,9,'P',NULL,NULL),(11,10,'W',NULL,NULL),(11,11,'W',NULL,NULL),(11,12,'W',NULL,NULL),(11,13,'P',NULL,NULL),(12,1,'W',NULL,NULL),(12,2,'W',NULL,NULL),(12,3,'W',NULL,NULL),(12,4,'W',NULL,NULL),(12,5,'W',NULL,NULL),(12,6,'W',NULL,NULL),(12,7,'W',NULL,NULL),(12,8,'W',NULL,NULL),(12,9,'P',NULL,NULL),(12,10,'W',NULL,NULL),(12,11,'W',NULL,NULL),(12,12,'W',NULL,NULL),(12,13,'P',NULL,NULL),(13,1,'W',NULL,NULL),(13,2,'W',NULL,NULL),(13,3,'W',NULL,NULL),(13,4,'W',NULL,NULL),(13,5,'W',NULL,NULL),(13,6,'W',NULL,NULL),(13,7,'W',NULL,NULL),(13,8,'W',NULL,NULL),(13,9,'P',NULL,NULL),(13,10,'P',NULL,NULL),(13,11,'P',NULL,NULL),(13,12,'P',NULL,NULL),(13,13,'P',NULL,NULL);
/*!40000 ALTER TABLE `board` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

-- Dumping structure for procedure iee2019067_schema.clean_board
DROP PROCEDURE IF EXISTS `clean_board`;
DELIMITER //
CREATE PROCEDURE `clean_board`()
BEGIN
	REPLACE INTO board SELECT * FROM board_empty;
	UPDATE show_winner SET status=0 WHERE id=1 or id=2; -- set status=0=no winner for players
	DELETE FROM players WHERE piece_color='P';
	INSERT INTO players (piece_color) VALUES ('P');
	DELETE FROM players where piece_color='R';
	INSERT INTO players (piece_color) VALUES ('R');
        DELETE FROM position where id=1 or id=2;
	INSERT INTO position VALUES (1, 4, 2), (2,10,12);
	DELETE FROM game_status;
	INSERT INTO game_status VALUES ("started","R",null,"2023-12-31 18:01:55");
END//
DELIMITER ;


--
-- Dumping data for table `board_empty`
--

LOCK TABLES `board_empty` WRITE;
/*!40000 ALTER TABLE `board_empty` DISABLE KEYS */;
INSERT INTO `board_empty` VALUES (1,1,'R',NULL,NULL),(1,2,'R',NULL,NULL),(1,3,'R',NULL,NULL),(1,4,'R',NULL,NULL),(1,5,'R',NULL,NULL),(1,6,'W',NULL,NULL),(1,7,'W',NULL,NULL),(1,8,'W',NULL,NULL),(1,9,'W',NULL,NULL),(1,10,'W',NULL,NULL),(1,11,'W',NULL,NULL),(1,12,'W',NULL,NULL),(1,13,'W',NULL,NULL),(2,1,'R',NULL,NULL),(2,2,'W',NULL,NULL),(2,3,'W',NULL,NULL),(2,4,'W',NULL,NULL),(2,5,'R',NULL,NULL),(2,6,'W',NULL,NULL),(2,7,'W',NULL,NULL),(2,8,'W',NULL,NULL),(2,9,'W',NULL,NULL),(2,10,'W',NULL,NULL),(2,11,'W',NULL,NULL),(2,12,'W',NULL,NULL),(2,13,'W',NULL,NULL),(3,1,'R',NULL,NULL),(3,2,'W','R','K2'),(3,3,'W',NULL,NULL),(3,4,'W',NULL,NULL),(3,5,'R',NULL,NULL),(3,6,'W',NULL,NULL),(3,7,'W',NULL,NULL),(3,8,'W',NULL,NULL),(3,9,'W',NULL,NULL),(3,10,'W',NULL,NULL),(3,11,'W',NULL,NULL),(3,12,'W',NULL,NULL),(3,13,'W',NULL,NULL),(4,1,'R',NULL,NULL),(4,2,'W','R','K1'),(4,3,'W',NULL,NULL),(4,4,'W',NULL,NULL),(4,5,'R',NULL,NULL),(4,6,'W',NULL,NULL),(4,7,'W',NULL,NULL),(4,8,'W',NULL,NULL),(4,9,'W',NULL,NULL),(4,10,'W',NULL,NULL),(4,11,'W',NULL,NULL),(4,12,'W',NULL,NULL),(4,13,'W',NULL,NULL),(5,1,'R',NULL,NULL),(5,2,'R',NULL,NULL),(5,3,'R',NULL,NULL),(5,4,'R',NULL,NULL),(5,5,'R',NULL,NULL),(5,6,'W',NULL,NULL),(5,7,'W',NULL,NULL),(5,8,'W',NULL,NULL),(5,9,'W',NULL,NULL),(5,10,'W',NULL,NULL),(5,11,'W',NULL,NULL),(5,12,'W',NULL,NULL),(5,13,'W',NULL,NULL),(6,1,'W',NULL,NULL),(6,2,'R',NULL,NULL),(6,3,'W',NULL,NULL),(6,4,'W',NULL,NULL),(6,5,'W',NULL,NULL),(6,6,'W',NULL,NULL),(6,7,'W',NULL,NULL),(6,8,'W',NULL,NULL),(6,9,'W',NULL,NULL),(6,10,'W',NULL,NULL),(6,11,'W',NULL,NULL),(6,12,'W',NULL,NULL),(6,13,'W',NULL,NULL),(7,1,'W',NULL,NULL),(7,2,'W',NULL,NULL),(7,3,'W',NULL,NULL),(7,4,'W',NULL,NULL),(7,5,'R',NULL,NULL),(7,6,'W',NULL,NULL),(7,7,'W',NULL,NULL),(7,8,'W',NULL,NULL),(7,9,'P',NULL,NULL),(7,10,'P',NULL,NULL),(7,11,'W',NULL,NULL),(7,12,'W',NULL,NULL),(7,13,'W',NULL,NULL),(8,1,'W',NULL,NULL),(8,2,'W',NULL,NULL),(8,3,'W',NULL,NULL),(8,4,'W',NULL,NULL),(8,5,'W',NULL,NULL),(8,6,'W',NULL,NULL),(8,7,'W',NULL,NULL),(8,8,'W',NULL,NULL),(8,9,'W',NULL,NULL),(8,10,'W',NULL,NULL),(8,11,'W',NULL,NULL),(8,12,'P',NULL,NULL),(8,13,'W',NULL,NULL),(9,1,'W',NULL,NULL),(9,2,'W',NULL,NULL),(9,3,'W',NULL,NULL),(9,4,'W',NULL,NULL),(9,5,'W',NULL,NULL),(9,6,'W',NULL,NULL),(9,7,'W',NULL,NULL),(9,8,'W',NULL,NULL),(9,9,'P',NULL,NULL),(9,10,'P',NULL,NULL),(9,11,'P',NULL,NULL),(9,12,'P',NULL,NULL),(9,13,'P',NULL,NULL),(10,1,'W',NULL,NULL),(10,2,'W',NULL,NULL),(10,3,'W',NULL,NULL),(10,4,'W',NULL,NULL),(10,5,'W',NULL,NULL),(10,6,'W',NULL,NULL),(10,7,'W',NULL,NULL),(10,8,'W',NULL,NULL),(10,9,'P',NULL,NULL),(10,10,'W',NULL,NULL),(10,11,'W',NULL,NULL),(10,12,'W','P','K1'),(10,13,'P',NULL,NULL),(11,1,'W',NULL,NULL),(11,2,'W',NULL,NULL),(11,3,'W',NULL,NULL),(11,4,'W',NULL,NULL),(11,5,'W',NULL,NULL),(11,6,'W',NULL,NULL),(11,7,'W',NULL,NULL),(11,8,'W',NULL,NULL),(11,9,'P',NULL,NULL),(11,10,'W',NULL,NULL),(11,11,'W',NULL,NULL),(11,12,'W','P','K2'),(11,13,'P',NULL,NULL),(12,1,'W',NULL,NULL),(12,2,'W',NULL,NULL),(12,3,'W',NULL,NULL),(12,4,'W',NULL,NULL),(12,5,'W',NULL,NULL),(12,6,'W',NULL,NULL),(12,7,'W',NULL,NULL),(12,8,'W',NULL,NULL),(12,9,'P',NULL,NULL),(12,10,'W',NULL,NULL),(12,11,'W',NULL,NULL),(12,12,'W',NULL,NULL),(12,13,'P',NULL,NULL),(13,1,'W',NULL,NULL),(13,2,'W',NULL,NULL),(13,3,'W',NULL,NULL),(13,4,'W',NULL,NULL),(13,5,'W',NULL,NULL),(13,6,'W',NULL,NULL),(13,7,'W',NULL,NULL),(13,8,'W',NULL,NULL),(13,9,'P',NULL,NULL),(13,10,'P',NULL,NULL),(13,11,'P',NULL,NULL),(13,12,'P',NULL,NULL),(13,13,'P',NULL,NULL);
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
  `p_turn` varchar(10) DEFAULT NULL,        -- enum('P','R')
  `result` varchar(10) DEFAULT NULL,
  `last_change` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_status`
--

LOCK TABLES `game_status` WRITE;
/*!40000 ALTER TABLE `game_status` DISABLE KEYS */;
INSERT INTO `game_status` VALUES ('started','R',null,'2023-12-31 18:01:55');
/*!40000 ALTER TABLE `game_status` ENABLE KEYS */;
UNLOCK TABLES;

--Procedure for move
DROP PROCEDURE IF EXISTS `move_piece`;
DELIMITER //
CREATE PROCEDURE `move_piece`(x1 tinyint,y1 tinyint,x2 tinyint,y2 tinyint,color_of_player char)
BEGIN
declare p, p_color varchar(2);
select  piece into p  FROM `board` WHERE X=x1 AND Y=y1;
select  piece_color into p_color  FROM `board` WHERE X=x1 AND Y=y1;
if(color_of_player!=p_color) then 
	update board
	set piece=p, piece_color=p_color
	where x=x2 and y=y2;
	
	UPDATE board
	SET piece=null,piece_color=null
	WHERE X=x1 AND Y=y1;
	update game_status set p_turn=if(p_color='P','R','P');
    end if;
    END//
DELIMITER ;
--end of procedure

--
-- Table structure for table `move_P`
--

DROP TABLE IF EXISTS `move_P`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `move_P` (
  `number` int(11) NOT NULL,
  `x` tinyint(1) NOT NULL,
  `y` tinyint(1) NOT NULL,
  PRIMARY KEY (`number`,`x`,`y`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `move_P`
--

LOCK TABLES `move_P` WRITE;
/*!40000 ALTER TABLE `move_P` DISABLE KEYS */;
INSERT INTO `move_P` VALUES (1,8,12),(2,8,11),(3,8,10),(4,8,9),(5,8,8),(6,9,8),(7,10,8),(8,11,8),(9,12,8),(10,13,8),(11,13,7),(12,13,6),(13,12,6),(14,11,6),(15,10,6),(16,9,6),(17,8,6),(18,8,5),(19,8,4),(20,8,3),(21,8,2),(22,8,1),(23,7,1),(24,6,1),(25,6,2),(26,6,3),(27,6,4),(28,6,5),(29,6,6),(30,5,6),(31,4,6),(32,3,6),(33,2,6),(34,1,6),(35,1,7),(36,1,8),(37,2,8),(38,3,8),(39,4,8),(40,5,8),(41,6,8),(42,6,9),(43,6,10),(44,6,11),(45,6,12),(46,6,13),(47,7,13),(48,7,12),(49,7,11),(50,7,10),(51,7,9);
/*!40000 ALTER TABLE `move_P` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `move_R`
--

DROP TABLE IF EXISTS `move_R`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `move_R` (
  `number` int(11) NOT NULL,
  `x` tinyint(1) NOT NULL,
  `y` tinyint(1) NOT NULL,
  PRIMARY KEY (`number`,`x`,`y`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `move_R`
--

LOCK TABLES `move_R` WRITE;
/*!40000 ALTER TABLE `move_R` DISABLE KEYS */;
INSERT INTO `move_R` VALUES (1,6,2),(2,6,3),(3,6,4),(4,6,5),(5,6,6),(6,5,6),(7,4,6),(8,3,6),(9,2,6),(10,1,6),(11,1,7),(12,1,8),(13,2,8),(14,3,8),(15,4,8),(16,5,8),(17,6,8),(18,6,9),(19,6,10),(20,6,11),(21,6,12),(22,6,13),(23,7,13),(24,8,13),(25,8,12),(26,8,11),(27,8,10),(28,8,9),(29,8,8),(30,9,8),(31,10,8),(32,11,8),(33,12,8),(34,13,8),(35,13,7),(36,13,6),(37,12,6),(38,11,6),(39,10,6),(40,9,6),(41,8,6),(42,8,5),(43,8,4),(44,8,3),(45,8,2),(46,8,1),(47,7,1),(48,7,2),(49,7,3),(50,7,4),(51,7,5);
/*!40000 ALTER TABLE `move_R` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `players`
--

DROP TABLE IF EXISTS `players`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `players` (
  `username` varchar(20) DEFAULT NULL,
  `piece_color` varchar(1) NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  `last_action` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`piece_color`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `players`
--

LOCK TABLES `players` WRITE;
/*!40000 ALTER TABLE `players` DISABLE KEYS */;
INSERT INTO `players` VALUES ('mixalis','P','8fec6ad8366e07795edbd3736fe79d87','2023-12-31 16:36:57'),('petros','R','1f6ef8765c917c30f5bcbfed7442db69','2023-12-31 16:36:27');
/*!40000 ALTER TABLE `players` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;


--table to identify the winner

DROP TABLE IF EXISTS `show_winner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `show_winner` (
  `id` int not null,
  `winner` varchar(15) not null,
  `status` int default 0,
  PRIMARY KEY (`id`,`winner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `show_winner`
--

LOCK TABLES `show_winner` WRITE;
/*!40000 ALTER TABLE `show_winner` DISABLE KEYS */;
INSERT INTO `show_winner` VALUES (1,"Red player", 0),(2,"Purple player", 0); //id=1 for red, id=2 for purple player. Status=0=no winner, status=1=winner
/*!40000 ALTER TABLE `show_winner` ENABLE KEYS */;
UNLOCK TABLES;


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-31 20:04:42

