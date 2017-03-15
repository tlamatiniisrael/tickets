CREATE DATABASE  IF NOT EXISTS `tickets` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `tickets`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win32 (AMD64)
--
-- Host: 127.0.0.1    Database: tickets
-- ------------------------------------------------------
-- Server version	5.6.20

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
-- Table structure for table `ambiente_ticket`
--

DROP TABLE IF EXISTS `ambiente_ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ambiente_ticket` (
  `ambiente_id` int(11) NOT NULL,
  `ambiente` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ambiente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ambiente_ticket`
--

LOCK TABLES `ambiente_ticket` WRITE;
/*!40000 ALTER TABLE `ambiente_ticket` DISABLE KEYS */;
/*!40000 ALTER TABLE `ambiente_ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `archivo_ticket`
--

DROP TABLE IF EXISTS `archivo_ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `archivo_ticket` (
  `archivo_ticket_id` int(11) NOT NULL AUTO_INCREMENT,
  `content_type` varchar(50) NOT NULL,
  `fecha_archivo` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nombre` varchar(100) NOT NULL,
  `nombre_original` varchar(100) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`archivo_ticket_id`) KEY_BLOCK_SIZE=1024
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPRESSED KEY_BLOCK_SIZE=8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `archivo_ticket`
--

LOCK TABLES `archivo_ticket` WRITE;
/*!40000 ALTER TABLE `archivo_ticket` DISABLE KEYS */;
INSERT INTO `archivo_ticket` VALUES (1,'image/png','2017-03-01 13:01:24','MTIxNDg4Mzk0ODg0.png','edomexlogo-header-opt.png',1,2),(2,'image/png','2017-03-01 13:01:44','MTIxNDg4Mzk0OTA0.png','edomexlogo.png',1,2);
/*!40000 ALTER TABLE `archivo_ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `categoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Control Vehicular'),(2,'Trámites Electronicos');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_ticket`
--

DROP TABLE IF EXISTS `estado_ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado_ticket` (
  `estado_id` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`estado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_ticket`
--

LOCK TABLES `estado_ticket` WRITE;
/*!40000 ALTER TABLE `estado_ticket` DISABLE KEYS */;
INSERT INTO `estado_ticket` VALUES (1,'Nuevo'),(2,'Asignado'),(3,'Cerrado'),(4,'Rechazado'),(5,'En progreso'),(6,'Resuelto'),(7,'Reabierto');
/*!40000 ALTER TABLE `estado_ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial_tickets`
--

DROP TABLE IF EXISTS `historial_tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historial_tickets` (
  `historial_id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_movimiento` datetime DEFAULT CURRENT_TIMESTAMP,
  `movimiento` varchar(250) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`historial_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial_tickets`
--

LOCK TABLES `historial_tickets` WRITE;
/*!40000 ALTER TABLE `historial_tickets` DISABLE KEYS */;
INSERT INTO `historial_tickets` VALUES (1,'2017-02-09 12:41:19','Nota Enviada',1,11),(2,'2017-02-09 12:42:01','Ticket Asignado',1,1),(3,'2017-02-09 12:42:18','Nota Enviada',1,1),(4,'2017-02-09 12:42:23','Estado Asignado',1,1),(5,'2017-02-09 12:56:08','Nota Enviada',1,4),(6,'2017-02-10 13:30:56','Estado Asignado',1,4),(7,'2017-02-10 13:31:06','Estado Asignado',1,4),(8,'2017-02-13 11:08:07','Nota Enviada',2,11),(9,'2017-02-13 11:21:19','Estado Asignado',2,1),(10,'2017-02-13 11:21:22','Ticket Asignado',2,1),(11,'2017-02-13 11:32:13','Ticket Asignado',1,1),(12,'2017-02-13 11:43:03','Ticket Asignado',2,1),(13,'2017-02-13 11:46:37','SQL Enviado',2,1),(14,'2017-02-13 11:49:52','SQL Enviado',1,1),(15,'2017-02-13 11:50:16','SQL Enviado',2,1),(16,'2017-02-13 11:51:47','Revisión Enviada',1,1),(17,'2017-02-13 11:51:55','Revisión Enviada',1,1),(18,'2017-02-13 11:52:08','Revisión Enviada',2,1),(19,'2017-02-13 11:52:30','SQL Enviado',2,1),(20,'2017-02-14 12:39:38','Solventación Enviada',1,4),(21,'2017-02-14 12:39:44','Solventación Enviada',1,4),(22,'2017-02-14 12:39:59','Solventación Enviada',1,4),(23,'2017-02-14 12:40:06','Solventación Enviada',1,4),(24,'2017-02-14 12:40:34','Solventación Enviada',1,4),(25,'2017-02-14 12:40:45','Solventación Enviada',1,4),(26,'2017-02-14 12:48:53','Solventación Enviada',0,4),(27,'2017-02-14 12:49:12','Solventación Enviada',0,4),(28,'2017-02-14 12:49:16','Solventación Enviada',0,4),(29,'2017-02-14 12:49:20','Solventación Enviada',0,4),(30,'2017-02-14 12:49:31','Solventación Enviada',0,4),(31,'2017-02-14 12:49:37','Solventación Enviada',0,4),(32,'2017-02-14 13:00:19','Solventación Enviada',0,4),(33,'2017-02-14 13:00:34','Solventación Enviada',0,4),(34,'2017-02-14 13:01:01','Solventación Enviada',0,4),(35,'2017-02-14 13:01:47','Solventación Enviada',1,4),(36,'2017-02-14 13:01:56','Solventación Enviada',1,4),(37,'2017-02-14 13:10:04','Solventación Enviada',1,4),(38,'2017-02-14 13:10:04','Nota Enviada',1,4),(39,'2017-02-14 13:11:31','Solventación Enviada',1,4),(40,'2017-02-14 13:11:31','Nota Enviada',1,4),(41,'2017-02-14 13:21:22','SQL Enviado',1,1),(42,'2017-02-14 13:21:28','SQL Enviado',1,1),(43,'2017-02-14 13:21:33','SQL Enviado',1,1),(44,'2017-02-14 13:21:38','SQL Enviado',1,1);
/*!40000 ALTER TABLE `historial_tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nota_ticket`
--

DROP TABLE IF EXISTS `nota_ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nota_ticket` (
  `nota_id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_nota` datetime DEFAULT CURRENT_TIMESTAMP,
  `nota` varchar(255) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`nota_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nota_ticket`
--

LOCK TABLES `nota_ticket` WRITE;
/*!40000 ALTER TABLE `nota_ticket` DISABLE KEYS */;
INSERT INTO `nota_ticket` VALUES (1,'2017-02-09 12:41:19','Sigue sin asignar y son las 12:41',1,11),(2,'2017-02-09 12:42:18','Ya está en proceso de validación por Lulú',1,1),(3,'2017-02-09 12:56:08','Ya está ese cambio y se subió a el war de las 13:00',1,4),(4,'2017-02-13 11:08:07','Se está esperando el cambio desde el fin de semana.',2,11),(5,'2017-02-14 13:10:04','12345',1,4),(6,'2017-02-14 13:11:31','El ticket ha sido solventado por Lulú',1,4);
/*!40000 ALTER TABLE `nota_ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil_usuario`
--

DROP TABLE IF EXISTS `perfil_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfil_usuario` (
  `perfil_id` int(11) NOT NULL AUTO_INCREMENT,
  `perfil` varchar(30) NOT NULL,
  PRIMARY KEY (`perfil_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil_usuario`
--

LOCK TABLES `perfil_usuario` WRITE;
/*!40000 ALTER TABLE `perfil_usuario` DISABLE KEYS */;
INSERT INTO `perfil_usuario` VALUES (1,'Administrador'),(2,'Usuario'),(3,'Técnico');
/*!40000 ALTER TABLE `perfil_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prioridad`
--

DROP TABLE IF EXISTS `prioridad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prioridad` (
  `prioridad_id` int(11) NOT NULL AUTO_INCREMENT,
  `prioridad` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`prioridad_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prioridad`
--

LOCK TABLES `prioridad` WRITE;
/*!40000 ALTER TABLE `prioridad` DISABLE KEYS */;
INSERT INTO `prioridad` VALUES (1,'Baja'),(2,'Media'),(3,'Alta');
/*!40000 ALTER TABLE `prioridad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `revision_ticket`
--

DROP TABLE IF EXISTS `revision_ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `revision_ticket` (
  `revision_id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_revision` datetime DEFAULT CURRENT_TIMESTAMP,
  `revision` mediumtext NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`revision_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `revision_ticket`
--

LOCK TABLES `revision_ticket` WRITE;
/*!40000 ALTER TABLE `revision_ticket` DISABLE KEYS */;
INSERT INTO `revision_ticket` VALUES (1,'2017-02-13 11:51:47','Revisión 1',1,1),(2,'2017-02-13 11:51:55','Revisión 2',1,1),(3,'2017-02-13 11:52:08','Revisión 3',2,1);
/*!40000 ALTER TABLE `revision_ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solventacion_ticket`
--

DROP TABLE IF EXISTS `solventacion_ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solventacion_ticket` (
  `solventacion_id` int(11) NOT NULL AUTO_INCREMENT,
  `solventacion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`solventacion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solventacion_ticket`
--

LOCK TABLES `solventacion_ticket` WRITE;
/*!40000 ALTER TABLE `solventacion_ticket` DISABLE KEYS */;
INSERT INTO `solventacion_ticket` VALUES (1,'Solventado'),(2,'No solventado'),(3,'Duplicado'),(4,'Suspendido'),(5,'No se solventará'),(6,'No requiere cambio');
/*!40000 ALTER TABLE `solventacion_ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sql_ticket`
--

DROP TABLE IF EXISTS `sql_ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sql_ticket` (
  `sql_id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_sql` datetime DEFAULT CURRENT_TIMESTAMP,
  `sql` mediumtext NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`sql_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sql_ticket`
--

LOCK TABLES `sql_ticket` WRITE;
/*!40000 ALTER TABLE `sql_ticket` DISABLE KEYS */;
INSERT INTO `sql_ticket` VALUES (1,'2017-02-13 11:49:52','SELECT * FROM DUAL;',1,1),(2,'2017-02-13 11:50:16','SELECT * FROM DUAL;',2,1),(3,'2017-02-13 11:52:30','SELECT  * FROM TE-MEDIA;',2,1),(4,'2017-02-14 13:21:22','SELECT * FROM DUAL; --CONSULTA UNO',1,1),(5,'2017-02-14 13:21:28','SELECT * FROM DUAL; --CONSULTA DOS',1,1),(6,'2017-02-14 13:21:32','SELECT * FROM DUAL; --CONSULTA TRES',1,1),(7,'2017-02-14 13:21:38','SELECT * FROM DUAL; --CONSULTA CUATRO',1,1);
/*!40000 ALTER TABLE `sql_ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(250) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `solventacion_id` smallint(6) DEFAULT NULL,
  `sumario` varchar(45) DEFAULT NULL,
  `categoria_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `prioridad_id` int(11) NOT NULL,
  `asignado_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  `ambiente_id` int(11) NOT NULL,
  `tipo_cambio_id` int(11) NOT NULL,
  PRIMARY KEY (`ticket_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
INSERT INTO `tickets` VALUES (1,'Control Vehicular\r\nAlta\r\nVictor','2017-02-09 12:01:16',1,'CV-A-VG',1,4,3,4,11,0,0),(2,'Tramites eléctronicos\r\nMedia\r\nVictor','2017-02-09 12:30:48',NULL,'TE-M-VG',2,2,2,5,11,0,0);
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_cambio`
--

DROP TABLE IF EXISTS `tipo_cambio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_cambio` (
  `tipo_cambio_id` int(11) NOT NULL,
  `tipo_cambio` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`tipo_cambio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_cambio`
--

LOCK TABLES `tipo_cambio` WRITE;
/*!40000 ALTER TABLE `tipo_cambio` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_cambio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `contrasena` mediumtext,
  `email` varchar(50) DEFAULT NULL,
  `usuario` varchar(15) DEFAULT NULL,
  `perfil_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'/bZxGCe5nw4RcK8DuvoemTv2lUH8Jbphuy26SjTyvBO8O/qSNxj6mONRQGZ16saR2apXvysWwLEWQFP5BP3jlA==','admin@admin.com','admin',1),(2,'MPw1+K8jmHKsvpyrKeu/RT5MqrFTnwJVJov3gXPzrU8KJS1sL4cWU6QCVeyy2ztgeBmSkwCiJLWMvzUPPCoeZw==','root@root.com','root',1),(3,'wyFauJZt8ban6+gz+L3A0aGCHgEK+aso8cmUmRHV/WsQ/sJKdHHMGDRkZvMdhXAz0ZOaSIORFMhZWEhreq97xQ==','david.aguilar.dgr@gmail.com','israel',1),(4,'tiffV9yXqtkB+ZWbJm8gPWOY8zAhMrTdG+aRkRCXrmcOYS8/WL7/q8m16dusHf4Fo6TYT/NBBxuLzU3DbI320A==','lourdes@gmail.com','lourdes',3),(5,'CA3E14Ogwt2856LitQHhiIeOJ0CYTBxxp+TtaW85v0Ou5/srDTrIWPFU9P/x3PSfwZ1E76wdQ7s8MtSODULX3A==','gabriel@gmail.com','gabriel',3),(6,'u9MJN4qKO8HXtQ4KpHMBtAlkvTBvRuXkkcKqIC27L/7/NP/jHWAZzhf+phqMLMo0EaQLzFc61NEjtF64iupdzg==','sergio@gmail.com','sergio',3),(7,'znmud/BUFIVRY9sS88SDwOwZsQClIA433IDHuE0cAJpMB30B8wgLNFmVNpBUbBjM7uIkgg4iDoDBz/cas4IFrA==','blanca@gmail.com','blanca',3),(8,'Qf6yl7f9TCgs8Aj5ovZkqy6vBrA72pdshx1EL8tfMRWzS1V6p+n13mP6LwV7wlgT4/S/Uuuxx+ptlS3oFDbPOw==','jhonny@gmail.com','jhonatan',3),(9,'E2UXl96H5axnXpXBsAikd9Ekuz8ydICAkpsgiKqAwnLF1fm+PNYpepLYw/k8YqgJ6YlfP43FaWAP1dH/b/t8xA==','hector@gmail.com','hector',3),(10,'R6rcd2Xx3hABrIJpH/lFItR70K+K7clz/Plev+iCs62MRVbnf9F9W5184RfhFpHoOB9ZMfm0fApnch/nZ7JPsQ==','miguel@gmail.com','miguel',3),(11,'2dAANkw7NlT82c7x7stGrzawRP9AR3JGxzb614hkA8n97Cc+8e2WqFPgwZswKAZr8nk6wNJqLXXAkM/LVKENRQ==','victor@gmail.com','victor',2),(12,'2lI2EZsV0NF8OF2rXjc7nzsT8oBa6wkSWsaPBtTpiNatDaLDyjqWJZy2FvFs9N5JIyMqRvp/SOi3pSAw4Ar6+A==','usuario@gmail.com','usuario',2);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-01 13:51:43
