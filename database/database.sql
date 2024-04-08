-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_james
CREATE DATABASE IF NOT EXISTS `db_james` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `db_james`;

-- Dumping structure for table db_james.products
CREATE TABLE IF NOT EXISTS `Popular products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_james.products: ~20 rows (approximately)
REPLACE INTO `products` (`id`, `name`, `description`, `price`, `image_url`) VALUES
	(1, 'Lanos', 'WBAPN7C53AA502557', 1999.00, 'https://media.discordapp.net/attachments/1097490957911478382/1220675945539833890/nc_musicplayers_001.png?ex=66190890&is=66069390&hm=b8fcc7c907e96209dc08f0be940b12dc0a57195ad5648ed7c1e824cd22ea7e92&=&format=webp&quality=lossless&width=466&height=350'),
	(2, 'Ram Van 3500', 'JTHBK1EG2C2588358', 1999.00, 'https://media.discordapp.net/attachments/1097490957911478382/1220675945539833890/nc_musicplayers_001.png?ex=66190890&is=66069390&hm=b8fcc7c907e96209dc08f0be940b12dc0a57195ad5648ed7c1e824cd22ea7e92&=&format=webp&quality=lossless&width=466&height=350'),
	(3, '740', '2C3CCARG2DH431438', 1992.00, 'https://media.discordapp.net/attachments/1097490957911478382/1220675945539833890/nc_musicplayers_001.png?ex=66190890&is=66069390&hm=b8fcc7c907e96209dc08f0be940b12dc0a57195ad5648ed7c1e824cd22ea7e92&=&format=webp&quality=lossless&width=466&height=350'),
	(4, 'ES', 'JH4KB16557C836311', 1994.00, 'https://media.discordapp.net/attachments/1097490957911478382/1220675945539833890/nc_musicplayers_001.png?ex=66190890&is=66069390&hm=b8fcc7c907e96209dc08f0be940b12dc0a57195ad5648ed7c1e824cd22ea7e92&=&format=webp&quality=lossless&width=466&height=350'),
	(5, 'Ranger', '1GD311CG8FZ605893', 1989.00, 'https://media.discordapp.net/attachments/1097490957911478382/1220675945539833890/nc_musicplayers_001.png?ex=66190890&is=66069390&hm=b8fcc7c907e96209dc08f0be940b12dc0a57195ad5648ed7c1e824cd22ea7e92&=&format=webp&quality=lossless&width=466&height=350'),
	(6, 'Accord', 'WAUXU54B33N697275', 2004.00, 'https://media.discordapp.net/attachments/1097490957911478382/1220675945539833890/nc_musicplayers_001.png?ex=66190890&is=66069390&hm=b8fcc7c907e96209dc08f0be940b12dc0a57195ad5648ed7c1e824cd22ea7e92&=&format=webp&quality=lossless&width=466&height=350'),
	(7, 'M-Class', '2C3CCAAG8CH905760', 2010.00, 'https://media.discordapp.net/attachments/1097490957911478382/1220675945539833890/nc_musicplayers_001.png?ex=66190890&is=66069390&hm=b8fcc7c907e96209dc08f0be940b12dc0a57195ad5648ed7c1e824cd22ea7e92&=&format=webp&quality=lossless&width=466&height=350'),
	(8, '1500', '1G6AF5SX3D0234765', 1992.00, 'https://media.discordapp.net/attachments/1097490957911478382/1220675945539833890/nc_musicplayers_001.png?ex=66190890&is=66069390&hm=b8fcc7c907e96209dc08f0be940b12dc0a57195ad5648ed7c1e824cd22ea7e92&=&format=webp&quality=lossless&width=466&height=350'),
	(9, 'XL-7', '5FNYF3H35FB415794', 2003.00, 'https://media.discordapp.net/attachments/1097490957911478382/1220675945539833890/nc_musicplayers_001.png?ex=66190890&is=66069390&hm=b8fcc7c907e96209dc08f0be940b12dc0a57195ad5648ed7c1e824cd22ea7e92&=&format=webp&quality=lossless&width=466&height=350'),
	(10, 'Explorer', '5J8TB4H33GL422545', 2005.00, 'https://media.discordapp.net/attachments/1097490957911478382/1220675945539833890/nc_musicplayers_001.png?ex=66190890&is=66069390&hm=b8fcc7c907e96209dc08f0be940b12dc0a57195ad5648ed7c1e824cd22ea7e92&=&format=webp&quality=lossless&width=466&height=350'),
	(11, 'Stratus', 'WAULH54BX1N364720', 2000.00, 'https://media.discordapp.net/attachments/1097490957911478382/1220675945539833890/nc_musicplayers_001.png?ex=66190890&is=66069390&hm=b8fcc7c907e96209dc08f0be940b12dc0a57195ad5648ed7c1e824cd22ea7e92&=&format=webp&quality=lossless&width=466&height=350'),
	(12, 'Grand Marquis', 'WAUDH78E38A517346', 1993.00, 'https://media.discordapp.net/attachments/1097490957911478382/1220675945539833890/nc_musicplayers_001.png?ex=66190890&is=66069390&hm=b8fcc7c907e96209dc08f0be940b12dc0a57195ad5648ed7c1e824cd22ea7e92&=&format=webp&quality=lossless&width=466&height=350'),
	(13, 'Grand Marquis', '1N6AA0CJ0EN434495', 1990.00, 'https://media.discordapp.net/attachments/1097490957911478382/1220675945539833890/nc_musicplayers_001.png?ex=66190890&is=66069390&hm=b8fcc7c907e96209dc08f0be940b12dc0a57195ad5648ed7c1e824cd22ea7e92&=&format=webp&quality=lossless&width=466&height=350'),
	(14, 'F-Series', 'KM8JT3AC3AU674431', 2002.00, 'https://media.discordapp.net/attachments/1097490957911478382/1220675945539833890/nc_musicplayers_001.png?ex=66190890&is=66069390&hm=b8fcc7c907e96209dc08f0be940b12dc0a57195ad5648ed7c1e824cd22ea7e92&=&format=webp&quality=lossless&width=466&height=350'),
	(15, 'LR2', '1G4GC5GR2DF274466', 2010.00, 'https://media.discordapp.net/attachments/1097490957911478382/1220675945539833890/nc_musicplayers_001.png?ex=66190890&is=66069390&hm=b8fcc7c907e96209dc08f0be940b12dc0a57195ad5648ed7c1e824cd22ea7e92&=&format=webp&quality=lossless&width=466&height=350'),
	(16, 'Sonoma Club Coupe', 'JTEBU5JR2F5020619', 1998.00, 'https://media.discordapp.net/attachments/1097490957911478382/1220675945539833890/nc_musicplayers_001.png?ex=66190890&is=66069390&hm=b8fcc7c907e96209dc08f0be940b12dc0a57195ad5648ed7c1e824cd22ea7e92&=&format=webp&quality=lossless&width=466&height=350'),
	(17, 'Golf', 'WUAYU48H58K059816', 1993.00, 'https://media.discordapp.net/attachments/1097490957911478382/1220675945539833890/nc_musicplayers_001.png?ex=66190890&is=66069390&hm=b8fcc7c907e96209dc08f0be940b12dc0a57195ad5648ed7c1e824cd22ea7e92&=&format=webp&quality=lossless&width=466&height=350'),
	(18, 'Grand Prix', '5N1CL0MMXEC706539', 1974.00, 'https://media.discordapp.net/attachments/1097490957911478382/1220675945539833890/nc_musicplayers_001.png?ex=66190890&is=66069390&hm=b8fcc7c907e96209dc08f0be940b12dc0a57195ad5648ed7c1e824cd22ea7e92&=&format=webp&quality=lossless&width=466&height=350'),
	(19, '626', 'WAUEH98E08A436076', 1998.00, 'https://media.discordapp.net/attachments/1097490957911478382/1220675945539833890/nc_musicplayers_001.png?ex=66190890&is=66069390&hm=b8fcc7c907e96209dc08f0be940b12dc0a57195ad5648ed7c1e824cd22ea7e92&=&format=webp&quality=lossless&width=466&height=350'),
	(20, 'Silhouette', '2G4WB52K431032521', 1998.00, 'https://media.discordapp.net/attachments/1097490957911478382/1220675945539833890/nc_musicplayers_001.png?ex=66190890&is=66069390&hm=b8fcc7c907e96209dc08f0be940b12dc0a57195ad5648ed7c1e824cd22ea7e92&=&format=webp&quality=lossless&width=466&height=350');

-- Dumping structure for table db_james.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `group` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_password` (`password`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_james.users: ~1 rows (approximately)
REPLACE INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `created_at`) VALUES
	(1, 'Nanthawut', 'Raksachat', 'Jaxen9415@gmail.com', '$2y$10$jVtK9HOftX3UqWGAo1sVnOcRE8J4nABbFyV3mXPybElwCF7o.NtvC', '2024-03-31 10:21:25');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
