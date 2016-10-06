CREATE DATABASE  IF NOT EXISTS `Estaciones` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `Estaciones`;
-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: Estaciones
-- ------------------------------------------------------
-- Server version	5.5.47-0+deb7u1

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
-- Table structure for table `Sensor`
--

DROP TABLE IF EXISTS `Sensor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Sensor` (
  `idSensor` int(11) NOT NULL AUTO_INCREMENT,
  `idArduino` int(11) NOT NULL,
  `idVariable` int(11) NOT NULL,
  `NombreSensor` varchar(100) NOT NULL,
  `Descripcion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idSensor`),
  KEY `fk_Sensor_1` (`idArduino`),
  KEY `fk_Sensor_2` (`idVariable`),
  CONSTRAINT `fk_Sensor_1` FOREIGN KEY (`idArduino`) REFERENCES `Arduino` (`idArduino`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Sensor_2` FOREIGN KEY (`idVariable`) REFERENCES `Variable` (`idVariable`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Sensor`
--

LOCK TABLES `Sensor` WRITE;
/*!40000 ALTER TABLE `Sensor` DISABLE KEYS */;
INSERT INTO `Sensor` VALUES (1,1,1,'SensorT1','Sensor lector de Temperatura en A0'),(2,1,1,'SensorT2','Sensor lector de Temperatura en A1'),(3,1,1,'Sensor1CO2','Sensor lector de CO2 en A3'),(4,2,2,'prueba1','asdasdasdasdasdasdasdasd'),(5,2,2,'asfasfa','asdfasdasda'),(6,1,1,'gris','griss'),(7,3,1,'LM35-Exp','sensor de temperatura'),(8,4,2,'fgfgfgfgf','fgfgfgf'),(9,3,3,'rerererer','ererererere'),(10,3,1,'yuyuy','yuuyuyuy'),(11,4,1,'qwqwqw','qwqwqw'),(12,1,1,'sdgadf','asdfasdfsd');
/*!40000 ALTER TABLE `Sensor` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-06 10:19:01
