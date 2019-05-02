-- MySQL dump 10.13  Distrib 5.7.26, for Linux (x86_64)
--
-- Host: localhost    Database: bnb_projet2
-- ------------------------------------------------------
-- Server version	5.7.26-0ubuntu0.18.10.1

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
  `begin_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `nb_person` int(11) NOT NULL,
  `options` varchar(45) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_price` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `room_id` (`room_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`),
  CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
INSERT INTO `booking` VALUES (2,'2019-01-01 00:00:00','2019-01-31 00:00:00',2,'dej_separateBed',4,1,100),(3,'2019-03-01 00:00:00','2019-03-30 00:00:00',2,'dej_separateBed',3,3,100),(5,'2019-04-18 00:00:00','2019-04-24 00:00:00',5,'truc',5,1,120),(6,'2019-04-18 00:00:00','2019-04-20 00:00:00',4,' ',2,NULL,120),(8,'2019-01-01 00:00:00','2019-01-15 00:00:00',2,'dej_separateBed',1,2,100),(9,'2019-02-01 00:00:00','2019-02-15 00:00:00',2,'dej_separateBed',1,2,100),(10,'2019-03-07 00:00:00','2019-03-09 00:00:00',2,'dej_separateBed',1,2,100),(11,'2019-04-02 00:00:00','2019-04-06 00:00:00',2,'dej_separateBed',1,2,100),(14,'2019-07-10 00:00:00','2019-07-20 00:00:00',2,'dej_separateBed',1,2,100),(16,'2019-12-01 00:00:00','2019-12-17 00:00:00',2,'dej_separateBed',1,2,100),(17,'2019-12-20 00:00:00','2019-12-31 00:00:00',2,'dej_separateBed',1,2,100),(20,'2019-06-07 00:00:00','2019-06-09 00:00:00',2,'dej_separateBed',2,2,100),(21,'2019-04-02 00:00:00','2019-04-06 00:00:00',2,'dej_separateBed',2,2,100),(22,'2019-04-07 00:00:00','2019-04-08 00:00:00',2,'dej_separateBed',2,2,100),(25,'2019-10-01 00:00:00','2019-10-11 00:00:00',2,'dej_separateBed',2,2,100),(27,'2019-12-20 00:00:00','2019-12-31 00:00:00',2,'dej_separateBed',2,2,100),(28,'2019-01-01 00:00:00','2019-01-15 00:00:00',2,'dej_separateBed',3,2,100),(29,'2019-02-01 00:00:00','2019-02-15 00:00:00',2,'dej_separateBed',3,2,100),(30,'2019-03-07 00:00:00','2019-03-09 00:00:00',2,'dej_separateBed',3,2,100),(32,'2019-04-07 00:00:00','2019-04-08 00:00:00',2,'dej_separateBed',3,2,100),(33,'2019-05-01 00:00:00','2019-05-13 00:00:00',2,'dej_separateBed',3,2,100),(34,'2019-08-10 00:00:00','2019-08-20 00:00:00',2,'dej_separateBed',3,2,100),(35,'2019-10-01 00:00:00','2019-10-11 00:00:00',2,'dej_separateBed',3,2,100),(38,'2019-01-01 00:00:00','2019-01-15 00:00:00',2,'dej_separateBed',4,2,100),(39,'2019-02-01 00:00:00','2019-02-15 00:00:00',2,'dej_separateBed',4,2,100),(40,'2019-03-07 00:00:00','2019-03-09 00:00:00',2,'dej_separateBed',4,2,100),(42,'2019-04-07 00:00:00','2019-04-08 00:00:00',2,'dej_separateBed',4,2,100),(45,'2019-11-01 00:00:00','2019-11-11 00:00:00',2,'dej_separateBed',4,2,100),(47,'2019-12-20 00:00:00','2019-12-31 00:00:00',2,'dej_separateBed',4,2,100),(48,'2019-01-01 00:00:00','2019-01-15 00:00:00',2,'dej_separateBed',5,2,100),(49,'2019-02-01 00:00:00','2019-02-15 00:00:00',2,'dej_separateBed',5,2,100),(50,'2019-03-07 00:00:00','2019-03-09 00:00:00',2,'dej_separateBed',5,2,100),(51,'2019-04-02 00:00:00','2019-04-06 00:00:00',2,'dej_separateBed',5,2,100),(52,'2019-04-07 00:00:00','2019-04-08 00:00:00',2,'dej_separateBed',5,2,100),(53,'2019-05-01 00:00:00','2019-05-13 00:00:00',2,'dej_separateBed',5,2,100),(56,'2019-08-23 00:00:00','2019-09-07 00:00:00',3,'baby1',2,2,528),(57,'2019-05-14 00:00:00','2019-05-16 00:00:00',1,' Petit déjeuner Table d\'hôte baby1',3,2,270),(61,'2019-08-09 00:00:00','2019-08-11 00:00:00',1,' Table d\'hôte',2,2,330);
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `grade` varchar(45) NOT NULL,
  `comment` text NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `room_id` (`room_id`),
  CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (1,2,'3','We had an excellent time in france in this bed and breakfast. Would recommend',1),(2,3,'4','Très bon moment !! La chambre Japon est superbe',2),(3,6,'3','On se croit en Asie. L\'ambiance est impressionante.',3),(4,4,'4','Les hôtes sont super accueillants, le cadre est très beau. Ça fait du bien un bon bol d\'air frais',4),(5,5,'5','Les hôtes sont super accueillant, le cadre est très beau. Ça fait du bien un bon bol d\'air frais.',5);

/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prices`
--

DROP TABLE IF EXISTS `prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `room_id` (`room_id`),
  CONSTRAINT `prices_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prices`
--

LOCK TABLES `prices` WRITE;
/*!40000 ALTER TABLE `prices` DISABLE KEYS */;
INSERT INTO `prices` VALUES (1,100,1),(2,110,2),(3,90,3),(4,120,4),(5,150,5);
/*!40000 ALTER TABLE `prices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` text NOT NULL,
  `pic_path` varchar(250) NOT NULL,
  `location` varchar(45) NOT NULL,
  `caracs` varchar(45) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room`
--

LOCK TABLES `room` WRITE;
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` VALUES (1,'New York','Un véritable petit appartement composé d\'une chambre à deux lits jumeaux, d\'une petite chambre à lits superposés, d\'un salon avec ses fauteuils en cuir et d\'une luxueuse salle de bains en marbre vous permettant de vous ressourcer dans le luxe et le calme.','usa.png','USA','dej_repas_separateBed',120),(2,'Japon','La Japan Suite est une chambre spacieuse avec un coin salon et une grande TV. La terrasse privée a une belle vue sur nos jardins ou vers la montagne.','japan.png','Japan','dej_separateBed',120),(3,'Thaïlande','La Thai Suite est la plus grande chambre du gîte. Elle est pourvue d\'un salon à part et une terrasse privée exposée soleil','thailand.png','Thailand','dej_repas',120),(4,'France','La chambre \'Luxe francais\' vous donnera espace et confort dans un cadre chaleureux.','france.png','France','dej',120),(5,'Afrique','Petite suite lumineuse située en façade avec vue sur le safari.','africa.png','Africa','dej_repas',120);
/*!40000 ALTER TABLE `room` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `mail` varchar(45) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$9HCjvYSYwktTJhYxnRVR9usUcMxwVL6nIg7s8R8asA6ZR5iIzA4TG','admin@mail.fr','Administrator'),(2,'tom','$2y$10$OftxITfDKzwq3PhS0sGiGu8VzavvwUMO6qcAtUCYRzY3h5T0AJ6eu','tom@mail.fr','User'),(3,'clelia','$2y$10$fiKtWU8e7Njx25GKxhRDl.YWd378owNqTgZn6HxfOFrUN6ETHjQz6','clelia@mail.fr','User'),(4,'herve','$2y$10$ynrozAJc6FFvqq7efkzfz.6Q4CvTYgmZFloVZEuVX8BbudE9E5uiG','herve@mail.fr','User'),(5,'quentin','$2y$10$suO8ZmxboEkO8fmhL7.1QuPs4Y6T8D1ouHC8OuNbiD9XQ4AbxtczG','quentin@mail.fr','User'),(6,'heyliam','$2y$10$x6Ofi573wXfUyGyX94M9POz0jXPdlsr.Xhhh4vLbJiee/cxk9.CG.','heyliam@mail.fr','User'),(7,'toto','$2y$10$RwVzzOPNcvTyJRiAmYLm..jFoJ8Ax2BErnbEaFdX5VepK/h0cTTn2','toto@mail.fr','User'),(8,'test','$2y$10$qoHPeGknY7eKwuzrCuFBwOxqNukNF.g0TUfBfP5NU14WeEmDiRZG2','test@test.com','User'),(9,'tom','$2y$10$xWXMfUsG2zSkmIO.CSmL/eHOz6ZjCb1.0YMlO7QaYP5Tm4NkwCQg.','tom@tom.fr','User'),(10,'tom','$2y$10$s1xCrKKWxYbEK1nxRONjxOXV0nSLxclOaxXbcJVzre9bE9xYI8X9e','tom@tom.fr','User'),(11,'truc','$2y$10$f3CUlr7WLZwXdSLBmUegeOA9Pghfu84eqHddTr4m5FzSHhdisOAhi','truc@trruc.fr','User'),(12,'tata','$2y$10$RdR06ODAnyUeONpAdgcPDe9BUjY.63PEeDwXvVCViMxW3gfXoaZMG','tata@tat.fr','User'),(13,'max','$2y$10$HuRwhSt2skDBXv5SsgJ3Lus685xp1K9yC2LQXuoD10UxfcVBPcc.S','max@max.fr','User');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-02  9:52:14
