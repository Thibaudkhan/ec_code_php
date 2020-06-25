-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 25, 2020 at 06:22 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codflix`
--
CREATE DATABASE IF NOT EXISTS `codflix` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `codflix`;

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Action'),
(2, 'Horreur'),
(3, 'Science-Fiction');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `finish_date` datetime DEFAULT NULL,
  `watch_duration` int(11) NOT NULL DEFAULT '0' COMMENT 'in seconds',
  PRIMARY KEY (`id`),
  KEY `history_user_id_fk_media_id` (`user_id`),
  KEY `history_media_id_fk_media_id` (`media_id`)
) ENGINE=InnoDB AUTO_INCREMENT=343 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `user_id`, `media_id`, `start_date`, `finish_date`, `watch_duration`) VALUES
(253, 23, 8, '2020-06-25 12:31:17', '2020-06-25 12:31:17', 1),
(256, 23, 6, '2020-06-25 12:32:21', '2020-06-25 12:32:21', 1),
(263, 25, 4, '2020-06-25 12:58:43', '2020-06-25 12:58:53', 1),
(269, 23, 4, '2020-06-25 13:01:41', '2020-06-25 13:01:46', 1),
(271, 23, 5, '2020-06-25 13:03:24', '2020-06-25 13:03:27', 38),
(276, 25, 10, '2020-06-25 16:35:21', '2020-06-25 16:35:27', 10),
(307, 25, 5, '2020-06-25 17:26:29', '2020-06-25 17:26:29', 1),
(338, 25, 9, '2020-06-25 17:56:15', '2020-06-25 17:56:21', 4),
(339, 25, 11, '2020-06-25 18:04:41', '2020-06-25 18:04:54', 11),
(340, 25, 2, '2020-06-25 18:06:46', '2020-06-25 18:06:53', 3),
(342, 25, 1, '2020-06-25 18:10:05', '2020-06-25 18:10:49', 68);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `genre_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `release_date` date NOT NULL,
  `summary` longtext NOT NULL,
  `trailer_url` varchar(255) NOT NULL,
  `name_of_episode` varchar(85) DEFAULT NULL,
  `season_series` int(11) DEFAULT NULL,
  `time_of_show` time DEFAULT NULL,
  `current_episode` int(11) DEFAULT NULL,
  `short_description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_genre_id_fk_genre_id` (`genre_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `genre_id`, `title`, `type`, `status`, `release_date`, `summary`, `trailer_url`, `name_of_episode`, `season_series`, `time_of_show`, `current_episode`, `short_description`) VALUES
(1, 1, 'Prison Break', 'série', 'Média publié', '2015-10-09', 'Une prison pas cool.', 'https://www.youtube.com/embed/VoW8RvUQdUM', 'La grande évasion', 1, NULL, 1, 'Pourra t\'il s\'évader'),
(2, 1, 'Interstellar', 'film', 'Média publié', '2012-10-09', 'Le temps c\'est..', 'https://www.youtube.com/embed/VaOijhK3CRU', NULL, 1, NULL, 1, NULL),
(4, 3, 'Dr who', 'série', 'Média publié', '2012-10-09', 'In the basement of the shop where Rose Tyler works, plastic mannequins begin to attack her. The Ninth Doctor rescues her and they flee the building, which he blows up. The next day, Rose and her boyfriend, Mickey Smith visit a man named Clive who runs a conspiracy theory website, concerning a man fitting the Doctor\'s description, who has appeared throughout history. While Rose is talking to Clive, Mickey is kidnapped and replaced by a plastic duplicate. Rose meets the Doctor again, where he reveals Mickey to be an Auton, and he and Rose locate the Nestene Consciousness which controls the Autons and has been using the London Eye as a transmitter. At this point, Auton mannequins come alive and start killing other people. Rose saves the Doctor and those that the Autons had been killing, and she decides to travel with the Doctor through time and space in his time machine the TARDIS.\r\n', 'https://www.youtube.com/embed/RYIu7Qlqh4M', 'Rose', 1, NULL, 1, 'Can the Doctor save the univers ?'),
(5, 3, 'Dr who', 'série', 'Média publié', '2015-10-09', 'The Doctor takes Rose to the year five billion, where they land on a space station orbiting the Earth named Platform One. Among the elite alien guests assembled to watch the Earth be destroyed by the expanding Sun is Lady Cassandra, who takes pride in being the last pure human, though she has received many operations that have altered her image. It is discovered that Cassandra, to receive money for her many operations, plans to let the guests die and then profit from the stock increases of their competitors. She releases discreet robotic spiders all over Platform One, and they start interfering with the systems. She departs via teleportation and the spiders bring down the shields, causing harmful direct solar radiation to penetrate the station. The Doctor manages to reactivate the system and save Rose, after which he brings Cassandra back and she ruptures from the intense solar heat.\r\n', 'https://www.youtube.com/embed/RYIu7Qlqh4M', 'The end of the world', 1, '00:48:35', 2, 'Geronimo'),
(6, 3, 'Dr who', 'série', 'Média publié', '2015-10-09', 'Rose and the newly-regenerated Tenth Doctor return to Rose\'s flat, where Rose, her mother Jackie and her former boyfriend Mickey Smith carry him inside to rest. When out shopping, Rose and Mickey are attacked by Santa robots; the Doctor theorises that energy from his regeneration has lured them here. Prime Minister Harriet Jones is threatened by the leader of the Sycorax to give them half of the Earth\'s population as slaves; Harriet tries to negotiate and is transmatted on their ship. Rose, Mickey, and Jackie drag the Doctor onto the TARDIS, but the TARDIS is detected by the Sycorax and they transport it to their ship, with Rose, Mickey, and the Doctor inside. After the Doctor has fully recovered, he challenges the Sycorax leader to a sword fight for the future of the Earth, which he eventually wins. However, the Sycorax ship is destroyed against the Doctor\'s wishes by Harriet Jones, who had called Torchwood on the matter.\r\n', 'https://www.youtube.com/embed/RYIu7Qlqh4M', 'The Christmas Invasion', 2, '00:48:35', 1, 'Doctor What ?'),
(7, 3, 'Dr who', 'série', 'Média publié', '2015-10-09', 'The Doctor and Rose go to New Earth, the planet which humanity inhabited after the Earth\'s destruction by the Sun. They go into a hospital in New New York, where Rose meets the villain Cassandra again. Cassandra possesses Rose\'s body as she is in need of one, but the Doctor is suspicious of \"Rose\"\'s actions. They discover that the hospital holds hundreds of artificially-grown humans that have been infected with diseases so the Sisters of Plenitude can find their cures. \"Rose\" releases several of the humans as a distraction, but they release others and a zombie-like attack begins. The Doctor sprays the infected humans with an intravenous solution using a disinfectant shower, curing them. The Doctor orders Cassandra out of Rose and she transfers her consciousness to her servant Chip, but his cloned body fails and Cassandra accepts her death.\r\n', 'https://www.youtube.com/embed/RYIu7Qlqh4M\r\n', 'New Earth', 2, '00:52:35', 2, 'Doctor Who ?'),
(8, 3, 'Dr who', 'série', 'Média publié', '2015-10-09', 'The best episode Watch it !', 'https://www.youtube.com/embed/RYIu7Qlqh4M\r\n', 'The Name of the Doctor', 7, '00:48:35', 13, 'War Doctor'),
(9, 2, 'Black Miror', 'série', 'Média publié', '2016-04-13', 'Bandersnatch', 'https://www.youtube.com/embed/d6-HaZ0zK6U', 'Bandersnatch', 1, '01:21:35', 1, 'Bandersnatch'),
(10, 1, 'Daredevil', 'série', 'Média publié', '2016-02-10', 'Et bim il tape ça fait mal', 'https://www.youtube.com/embed/mGEWftxFX3M', 'Sur le ring', 1, '00:52:35', 1, 'L\'homme masqué '),
(11, 1, 'Daredevil', 'série', 'Média publié', '2016-02-10', 'Et bim il tape ça fait mal', 'https://www.youtube.com/embed/mGEWftxFX3M', 'L\'Homme blessé', 1, '00:52:35', 2, 'L\'homme Super masqué '),
(12, 1, 'Daredevil', 'série', 'Média publié', '2016-02-10', 'Et bim il tape ça fait mal', 'https://www.youtube.com/embed/mGEWftxFX3M', 'Liens de sang', 1, '00:52:35', 4, 'L\'homme en rouge');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(254) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_key` varchar(255) NOT NULL,
  `user_confirmed` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `user_key`, `user_confirmed`) VALUES
(22, 'your.sdsdsdemail+faker15010@gmail.com', '8819869466f90a057b4150517f80dbe3ad224faae19f8263e423da1652f74aa62ed4bf85eef58da2eb0bf387ae576117450170f89b52a68038b0dbf26357da3a', '5f3ae00a7cabf0b8948b24d17f349df7', 1),
(23, 'coding@gmail.com', '84f1fc6eac1cbf4e54a694c4f03c03fd3c7357e021e3a0b7a0beb37b349dca9c5cea4b7a7b68cd934ffe06c56588c8e758b2c95cfb80e6ad316800b04156ee93', 'a92f97b3da530de1b0b2f40e1daddcff', 1),
(24, 'your.email+faker15azeaze010@gmail.com', '93c67cd3351338f40045db1363b34b4ef49b19bbfb5fbc76c07a9370322a8962cee1061691375ee39f8f0d3137013e559b2609985116e324fab743de594a0ac6', '9be17be1a4365edf7ac81490566b6e4a', 0),
(25, 'your.sdqsdsdqemail+faker15010@gmail.com', '98fcde80277c40e88d6c43be8efde949bfd660347040f7370ed7a21b0ac410a90d48079220c53a35ef0858f33bb6c6c60ec52cee6f58bc3f935c82b0d868734b', '35df556a51eb1de954d457970d62616f', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_media_id_fk_media_id` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `history_user_id_fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_genre_id_b1257088_fk_genre_id` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
