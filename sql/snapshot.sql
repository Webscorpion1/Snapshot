# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.38)
# Database: snapshot
# Generation Time: 2018-04-01 13:03:58 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL DEFAULT '',
  `lastname` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `avatar`, `description`)
VALUES
	(1,'lucas','debelder',NULL,'Lucasdebelder@hotmail.com','$2y$10$3yPOhn2r6pP/LWSmac9Doug48qnXpDTXOk7qeyaXcaGG5jp3R9Gn2','',''),
	(2,'lucas','debelder',NULL,'Lucasdebelder@hotmail.com','$2y$10$SjM.IMqYH74irDlfFPIg9OPajZK0FEDU9qDfX2yObqSE8gtvYizHW','',''),
	(3,'rootroot','root',NULL,'root@root.com','$2y$10$DUJhd9T1wrFH9IkXa4.0j.mz9ZDInCRV8l2gP52znO8UeshoyelHG','',''),
	(4,'lucas','debelder',NULL,'Lucasdebelder@hotmail.comsfddf','$2y$10$WxSVInzyjbMuateg3taPAuwLWzOqk3TdwU6wks514bF0AsckVSQli','',''),
	(5,'rootrootroot','root','root','root@root.comroot','$2y$10$1vt6FNWBg0LZVuwZxc4dXeOEjsd.LZvNZut.lHsFiRlxwJmpw00RO','',''),
	(6,'','sdffds','dsffsd','sdf@df.com','$2y$10$qE8HgoGzPMTRoBL55OWS4O3LTTiPZ5NA6feMKA2.IuPCCGyD13wyi','',''),
	(7,'flslfs','dsflkfsjkd','sdfflsdjl','Lucasdebelder@hotmail.com','$2y$10$yrvkKfWOT3rdRkO3cnr67..hxt9pdws7dNBClZs5HHHCnBEbbR9cO','',''),
	(8,'Lucas','','azerty','azerty@azerty.be','$2y$10$j6NqXzpc1H0jrpIUi8JBlORPcgLFGd.A2s7lEewI5XRsVBDpXpCD6','',''),
	(9,'thomas','debelder','sdffds','sfdfsd@hotmail.com','$2y$10$g27v68NWAa0dGaIdn8kBQufprQ/Yt5yppSS8oTAq1ksMYF8nZH/iS','',''),
	(10,'sssss','sdfdfs','sdffds','sdf@df.com','$2y$10$kZePbNY/5J7yK2ZxhgXln.hD7Sqlo.WZ295j3mo7SEqx/2opuWO6C','',''),
	(11,'thomaske','thomaskeee','thomaske','thomas@thomas.be','$2y$10$3ouDTSOE4fQ1VwUIH9x2.uMF03tbGaUIaar3j1wpTsZXglLoiDPnS','',''),
	(12,'lucas','dssfd','zlfdsjs','sdf@df.com','$2y$10$679Wg6M56D.NozP14TUVXug.fL2PwsYtOKtBRacLGyxvph5jKnesy','','');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
