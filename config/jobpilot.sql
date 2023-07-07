-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for jobpilot
CREATE DATABASE IF NOT EXISTS `jobpilot` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `jobpilot`;

-- Dumping structure for table jobpilot.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `title` varchar(200) DEFAULT '',
  `cv` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '',
  `bio` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '',
  `facebook_url` varchar(200) DEFAULT '',
  `twitter_url` varchar(200) DEFAULT '',
  `linkedin_url` varchar(200) DEFAULT '',
  `usertype` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table jobpilot.users: ~3 rows (approximately)
INSERT INTO `users` (`id`, `username`, `email`, `password`, `image`, `title`, `cv`, `bio`, `facebook_url`, `twitter_url`, `linkedin_url`, `usertype`, `created_at`) VALUES
	(14, 'saiedrahman', 'worker@mail.com', '$2y$10$WvarEjTIuWW.Fs1FGp4n1eoEKv26k7WWZCmK6/gmE2okKlBsMoX0C', 'public/upload/user/97738978.jpg', 'Web Developer', 'public/upload/cv/20215914.pdf', 'Update Quisque nullam omnis nostrum sociis malesuada temporibus natoque, eum tempore nostrud leo quos urna esse faucibus nesciunt condimentum!', 'https://facebook.com', 'https://twitter.com', 'https://linkedin.com', 'worker', '2023-07-05 06:29:28'),
	(15, 'Digital Hub', 'company@mail.com', '$2y$10$zcPAdnu3ReoFZhnwajzu7.HeVoGVwxSrATeBNJmVcx1O2QfmoE0Nu', 'default.png', 'Software Solution', 'cv_url', 'Quisque nullam omnis nostrum sociis malesuada temporibus natoque, eum tempore nostrud leo quos urna esse faucibus nesciunt condimentum!', 'https://facebook.com', 'twitter.com', 'linkedin.com', 'company', '2023-07-05 06:30:01'),
	(16, 'admin', 'admin@mail.com', '$2y$10$YgBx5fMKuDdxH6SbACfNaOKvuKQm2a8UoT9jK7VCJep14.IoME9W.', 'default.png', '', '', '', '', '', '', 'admin', '2023-07-05 11:32:19');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
