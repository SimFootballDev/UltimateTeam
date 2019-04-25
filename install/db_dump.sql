-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 25, 2019 at 09:21 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iltornan_nsfl_ut`
--

DELIMITER $$
--
-- Functions
--

-- NOTE: Need to add the LastMonday function
--       It is required for some queries
--       Grab the SQL for it from Workbench (?)

$$

-- --------------------------------------------------------

-- 
-- Stored Procedures
-- 

-- NOTE: Not created yet, but will be required
--       Move this to end when ready
-- 
-- 1. Convert queries in PHP to stored procs
-- 2. Create stored procs to check for "achievements"
-- 	  2.1. Create "Achievements"
-- 3. General maintenance and admin procedures
--    3.1. Set/Lift bans
--    3.2. Purge inactives


-- --------------------------------------------------------

DELIMITER ;

--
-- Table structure for table `accountCollections`
--

CREATE TABLE IF NOT EXISTS `accountCollections` (
  `accountID` int(11) NOT NULL,
  `playerAttributesID` int(11) NOT NULL,
  `dateDrawn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `accountID` (`accountID`),
  KEY `playerAttributesID` (`playerAttributesID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `accountCollections`
--

TRUNCATE TABLE `accountCollections`;
--
-- Dumping data for table `accountCollections`
--

INSERT DELAYED INTO `accountCollections` (`accountID`, `playerAttributesID`, `dateDrawn`) VALUES
(1, 1, '2019-04-01 15:43:03'),
(1, 2, '2019-04-01 15:43:03'),
(1, 3, '2019-04-01 15:43:03'),
(1, 4, '2019-04-01 15:43:03'),
(1, 5, '2019-04-01 15:43:03'),
(1, 6, '2019-04-01 15:43:03'),
(1, 7, '2019-04-01 15:43:03'),
(1, 8, '2019-04-01 15:43:03'),
(1, 9, '2019-04-01 15:43:03'),
(1, 10, '2019-04-01 15:43:03'),
(1, 11, '2019-04-01 15:43:03'),
(1, 12, '2019-04-01 15:43:03'),
(1, 13, '2019-04-01 15:43:03'),
(1, 14, '2019-04-01 15:43:03'),
(1, 15, '2019-04-01 15:43:03'),
(1, 16, '2019-04-01 15:43:03'),
(1, 17, '2019-04-01 15:43:03'),
(1, 18, '2019-04-01 15:43:03'),
(1, 19, '2019-04-01 15:43:03'),
(1, 20, '2019-04-01 15:43:03'),
(1, 21, '2019-04-01 15:43:03'),
(1, 22, '2019-04-01 15:43:03'),
(1, 23, '2019-04-01 15:43:03'),
(1, 24, '2019-04-01 15:43:03'),
(1, 25, '2019-04-01 15:43:03'),
(1, 26, '2019-04-01 15:43:03'),
(1, 27, '2019-04-01 15:43:03'),
(1, 28, '2019-04-01 15:43:03'),
(1, 29, '2019-04-01 15:43:03'),
(1, 30, '2019-04-01 15:43:03'),
(1, 31, '2019-04-01 15:43:03'),
(1, 32, '2019-04-01 15:43:03'),
(1, 33, '2019-04-01 15:43:03'),
(1, 34, '2019-04-01 15:43:03'),
(1, 35, '2019-04-01 15:43:03'),
(1, 36, '2019-04-01 15:43:03'),
(1, 37, '2019-04-01 15:43:03'),
(1, 38, '2019-04-01 15:43:03'),
(1, 16, '2019-04-08 12:43:47'),
(2, 21, '2019-04-12 15:20:46'),
(2, 22, '2019-04-12 15:20:46'),
(2, 25, '2019-04-12 15:20:46'),
(2, 26, '2019-04-12 15:20:46'),
(2, 27, '2019-04-12 15:20:46'),
(2, 28, '2019-04-12 15:20:46'),
(2, 31, '2019-04-12 15:20:46'),
(2, 34, '2019-04-12 15:20:46'),
(2, 36, '2019-04-12 15:20:46'),
(2, 38, '2019-04-12 15:20:46'),
(3, 21, '2019-04-24 07:38:44'),
(3, 22, '2019-04-24 07:38:44'),
(3, 25, '2019-04-24 07:38:44'),
(3, 26, '2019-04-24 07:38:44'),
(3, 27, '2019-04-24 07:38:44'),
(3, 28, '2019-04-24 07:38:44'),
(3, 31, '2019-04-24 07:38:44'),
(3, 34, '2019-04-24 07:38:44'),
(3, 36, '2019-04-24 07:38:44'),
(3, 38, '2019-04-24 07:38:44'),
(3, 21, '2019-04-24 07:43:19'),
(3, 22, '2019-04-24 07:43:19'),
(3, 25, '2019-04-24 07:43:19'),
(3, 26, '2019-04-24 07:43:19'),
(3, 27, '2019-04-24 07:43:19'),
(3, 28, '2019-04-24 07:43:19'),
(3, 31, '2019-04-24 07:43:19'),
(3, 34, '2019-04-24 07:43:19'),
(3, 36, '2019-04-24 07:43:19'),
(3, 38, '2019-04-24 07:43:19'),
(3, 21, '2019-04-24 07:43:25'),
(3, 22, '2019-04-24 07:43:25'),
(3, 25, '2019-04-24 07:43:25'),
(3, 26, '2019-04-24 07:43:25'),
(3, 27, '2019-04-24 07:43:25'),
(3, 28, '2019-04-24 07:43:25'),
(3, 31, '2019-04-24 07:43:25'),
(3, 34, '2019-04-24 07:43:25'),
(3, 36, '2019-04-24 07:43:25'),
(3, 38, '2019-04-24 07:43:25'),
(3, 21, '2019-04-24 07:43:28'),
(3, 22, '2019-04-24 07:43:28'),
(3, 25, '2019-04-24 07:43:28'),
(3, 26, '2019-04-24 07:43:28'),
(3, 27, '2019-04-24 07:43:28'),
(3, 28, '2019-04-24 07:43:28'),
(3, 31, '2019-04-24 07:43:28'),
(3, 34, '2019-04-24 07:43:28'),
(3, 36, '2019-04-24 07:43:28'),
(3, 38, '2019-04-24 07:43:28'),
(3, 21, '2019-04-24 07:49:46'),
(3, 22, '2019-04-24 07:49:46'),
(3, 25, '2019-04-24 07:49:46'),
(3, 26, '2019-04-24 07:49:46'),
(3, 27, '2019-04-24 07:49:46'),
(3, 28, '2019-04-24 07:49:46'),
(3, 31, '2019-04-24 07:49:46'),
(3, 34, '2019-04-24 07:49:46'),
(3, 36, '2019-04-24 07:49:46'),
(3, 38, '2019-04-24 07:49:46');

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `accountID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `acctBalance` int(11) NOT NULL,
  `lastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`accountID`),
  KEY `userID` (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `accounts`
--

TRUNCATE TABLE `accounts`;
--
-- Dumping data for table `accounts`
--

INSERT DELAYED INTO `accounts` (`accountID`, `userID`, `acctBalance`, `lastUpdate`) VALUES
(1, 1, 3005, '2019-04-25 15:19:39'),
(2, 3, 25, '2019-04-25 15:04:06'),
(3, 4, 150, '2019-04-25 15:08:02');

-- --------------------------------------------------------

--
-- Table structure for table `cardRarity`
--

CREATE TABLE IF NOT EXISTS `cardRarity` (
  `cardRarityID` int(11) NOT NULL AUTO_INCREMENT,
  `cardRarityDesc` varchar(10) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`cardRarityID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `cardRarity`
--

TRUNCATE TABLE `cardRarity`;
--
-- Dumping data for table `cardRarity`
--

INSERT DELAYED INTO `cardRarity` (`cardRarityID`, `cardRarityDesc`) VALUES
(1, 'Standard'),
(2, 'Bronze'),
(3, 'Silver'),
(4, 'Gold');

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE IF NOT EXISTS `cards` (
  `cardID` int(11) NOT NULL AUTO_INCREMENT,
  `playerAttributesID` int(11) NOT NULL,
  PRIMARY KEY (`cardID`),
  KEY `playerAttributesID` (`playerAttributesID`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `cards`
--

TRUNCATE TABLE `cards`;
--
-- Dumping data for table `cards`
--

INSERT DELAYED INTO `cards` (`cardID`, `playerAttributesID`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(20, 20),
(21, 21),
(22, 22),
(23, 23),
(24, 24),
(25, 25),
(26, 26),
(27, 27),
(28, 28),
(29, 29),
(30, 30),
(31, 31),
(32, 32),
(33, 33),
(34, 34),
(35, 35),
(36, 36),
(37, 37),
(38, 38);

-- --------------------------------------------------------

--
-- Table structure for table `cardSets`
--

CREATE TABLE IF NOT EXISTS `cardSets` (
  `cardSetID` int(11) NOT NULL AUTO_INCREMENT,
  `cardSetDesc` varchar(50) CHARACTER SET latin1 NOT NULL,
  `setCode` varchar(4) DEFAULT NULL,
  `available` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`cardSetID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `cardSets`
--

TRUNCATE TABLE `cardSets`;
--
-- Dumping data for table `cardSets`
--

INSERT DELAYED INTO `cardSets` (`cardSetID`, `cardSetDesc`, `setCode`, `available`) VALUES
(1, 'Base Set', 'UTB', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE IF NOT EXISTS `logins` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET latin1 NOT NULL,
  `password` varchar(128) CHARACTER SET latin1 NOT NULL,
  `pwsalt` varchar(128) CHARACTER SET latin1 NOT NULL,
  `isAdmin` bit(1) NOT NULL DEFAULT b'0',
  `style` varchar(5) NOT NULL DEFAULT 'light',
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `logins`
--

TRUNCATE TABLE `logins`;
--
-- Dumping data for table `logins`
--

INSERT DELAYED INTO `logins` (`userID`, `username`, `password`, `pwsalt`, `isAdmin`, `style`) VALUES
(1, '37thchamber', '$2y$10$muvhRLuyOn8t0V9Dd68BoeOvJTSaiZVIcDZ44t3NZt/k7B8G96ou.', '', b'1', 'dark'),
(2, 'pdxballer', '$2y$10$NyItUudPU05YXIhFQ2LiY.Nk1zAwvZ9SB.RTn3KjKtWBaSm7lSUeu', '', b'0', 'dark'),
(3, 'testAccount', '$2y$10$p1cf4kwaJ.PZ2Trq195RE..XymW49zDk94JF8UPvEmwGZLh7OOyYW', '', b'0', 'dark'),
(4, 'testAccount2', '$2y$10$/kAKSdODV7j4jkQn9stwqe2WKI682prz6gDlDgIeGCI0a5HC/Rn4G', '', b'0', 'dark');

-- --------------------------------------------------------

--
-- Table structure for table `playerAttributes`
--

CREATE TABLE IF NOT EXISTS `playerAttributes` (
  `playerAttributesID` int(11) NOT NULL AUTO_INCREMENT,
  `cardRarityID` int(11) NOT NULL,
  `cardSetID` int(11) NOT NULL,
  `setNumber` int(3) DEFAULT NULL COMMENT 'number of the card within its set. i.e. UTB-001 would have setNumber of 1',
  `teamID` int(11) NOT NULL,
  `position` varchar(2) CHARACTER SET latin1 NOT NULL,
  `redemptionCode` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `playerFirstName` varchar(50) CHARACTER SET latin1 NOT NULL,
  `playerLastName` varchar(50) CHARACTER SET latin1 NOT NULL,
  `height` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `strength` int(11) NOT NULL,
  `agility` int(11) NOT NULL,
  `arm` int(11) NOT NULL,
  `speed` int(11) NOT NULL,
  `hands` int(11) NOT NULL,
  `accuracy` int(11) NOT NULL,
  `runBlocking` int(11) NOT NULL,
  `passBlocking` int(11) NOT NULL,
  `intelligence` int(11) NOT NULL,
  `endurance` int(11) NOT NULL,
  `tackling` int(11) NOT NULL,
  `kickDistance` int(11) NOT NULL,
  `kickAccuracy` int(11) NOT NULL,
  `puntDistance` int(11) NOT NULL,
  `puntAccuracy` int(11) NOT NULL,
  PRIMARY KEY (`playerAttributesID`),
  KEY `cardRarityID` (`cardRarityID`),
  KEY `cardSetID` (`cardSetID`),
  KEY `teamID` (`teamID`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `playerAttributes`
--

TRUNCATE TABLE `playerAttributes`;
--
-- Dumping data for table `playerAttributes`
--

INSERT DELAYED INTO `playerAttributes` (`playerAttributesID`, `cardRarityID`, `cardSetID`, `setNumber`, `teamID`, `position`, `redemptionCode`, `playerFirstName`, `playerLastName`, `height`, `weight`, `strength`, `agility`, `arm`, `speed`, `hands`, `accuracy`, `runBlocking`, `passBlocking`, `intelligence`, `endurance`, `tackling`, `kickDistance`, `kickAccuracy`, `puntDistance`, `puntAccuracy`) VALUES
(1, 3, 1, 34, 16, 'QB', 'WU02', 'Genius', 'GZA', 185, 200, 35, 50, 90, 60, 30, 90, 1, 1, 100, 75, 5, 1, 1, 1, 1),
(2, 2, 1, 25, 16, 'RB', 'WU06', 'Inspectah', 'Deck', 178, 230, 60, 90, 1, 90, 70, 1, 1, 1, 75, 75, 1, 1, 1, 1, 1),
(3, 1, 1, 8, 16, 'WR', 'WU07', 'Killa', 'Masta', 182, 190, 40, 90, 1, 95, 85, 1, 1, 1, 95, 75, 1, 1, 1, 1, 1),
(4, 1, 1, 10, 16, 'WR', 'WU10', 'Vocabulary', 'Cappadonna', 185, 190, 40, 85, 1, 85, 80, 1, 1, 1, 85, 75, 1, 1, 1, 1, 1),
(5, 1, 1, 17, 16, 'WR', 'EPMD', 'Keith', 'Murray', 179, 190, 40, 85, 1, 85, 80, 1, 1, 1, 75, 75, 1, 1, 1, 1, 1),
(6, 4, 1, 35, 16, 'TE', 'WU09', 'Golden Arms', 'U-God', 190, 196, 50, 90, 1, 80, 100, 1, 1, 1, 75, 75, 1, 1, 1, 1, 1),
(7, 1, 1, 0, 16, 'OL', 'FREEBOTS', 'Tier 1', 'Bots', 188, 350, 75, 25, 1, 25, 1, 1, 75, 75, 75, 75, 1, 1, 1, 1, 1),
(8, 2, 1, 26, 16, 'DE', 'WU03', 'Theodore', 'Ghostface', 188, 260, 90, 40, 1, 45, 30, 1, 1, 1, 75, 75, 75, 1, 1, 1, 1),
(9, 1, 1, 18, 16, 'DE', 'MKTCLP', 'Busta', 'Busta', 186, 270, 90, 40, 1, 45, 30, 1, 1, 1, 65, 75, 75, 1, 1, 1, 1),
(10, 1, 1, 16, 16, 'DT', 'TWIN1', 'Big', 'Pun', 194, 350, 100, 30, 1, 30, 30, 1, 1, 1, 65, 75, 80, 1, 1, 1, 1),
(11, 1, 1, 15, 16, 'DT', 'TWIN2', 'Fat', 'Joe', 192, 320, 100, 30, 1, 35, 30, 1, 1, 1, 65, 75, 80, 1, 1, 1, 1),
(12, 2, 1, 27, 16, 'LB', 'WU05', 'Chef', 'Raekwon', 182, 220, 80, 65, 1, 55, 40, 1, 1, 1, 90, 75, 90, 1, 1, 1, 1),
(13, 2, 1, 28, 16, 'LB', 'WU04', 'Mister', 'Method Man', 185, 210, 75, 80, 1, 75, 40, 1, 1, 1, 95, 75, 90, 1, 1, 1, 1),
(14, 4, 1, 36, 16, 'LB', 'WU01', 'Abbot', 'RZA', 192, 200, 70, 90, 1, 80, 40, 1, 1, 1, 100, 75, 90, 1, 1, 1, 1),
(15, 1, 1, 12, 16, 'CB', 'BRIX', 'Reggie', 'Redman', 190, 190, 55, 95, 1, 90, 72, 1, 1, 1, 75, 75, 55, 1, 1, 1, 1),
(16, 4, 1, 37, 16, 'CB', '37AD', 'Antoine', 'Delacour', 180, 186, 50, 100, 1, 100, 75, 1, 1, 1, 80, 75, 60, 1, 1, 1, 1),
(17, 3, 1, 29, 16, 'S', 'LG29', 'Lennox', 'Garnett', 186, 212, 60, 90, 1, 100, 75, 1, 1, 1, 80, 75, 60, 1, 1, 1, 1),
(18, 1, 1, 6, 16, 'S', 'WU08', 'Ason', 'O.D.B.', 178, 190, 55, 95, 1, 95, 70, 1, 1, 1, 70, 75, 50, 1, 1, 1, 1),
(19, 3, 1, 33, 16, 'K', 'WU11', 'DJ', 'Cilvaringz', 178, 180, 15, 10, 1, 10, 1, 1, 1, 1, 80, 80, 1, 80, 80, 80, 80),
(20, 2, 1, 24, 16, 'QB', 'WU02B', 'Genius', 'GZA', 185, 200, 35, 50, 80, 55, 30, 85, 1, 1, 90, 70, 5, 1, 1, 1, 1),
(21, 1, 1, 2, 16, 'QB', 'BASE', 'Genius', 'GZA', 185, 200, 35, 50, 70, 50, 30, 80, 1, 1, 80, 65, 5, 1, 1, 1, 1),
(22, 1, 1, 3, 16, 'RB', 'BASE', 'Inspectah', 'Deck', 178, 230, 50, 80, 1, 80, 60, 1, 1, 1, 70, 70, 1, 1, 1, 1, 1),
(23, 3, 1, 30, 16, 'TE', 'WU09S', 'Golden Arms', 'U-God', 190, 196, 45, 85, 1, 75, 95, 1, 1, 1, 70, 70, 1, 1, 1, 1, 1),
(24, 2, 1, 23, 16, 'TE', 'WU09B', 'Golden Arms', 'U-God', 190, 196, 40, 80, 1, 70, 90, 1, 1, 1, 65, 65, 1, 1, 1, 1, 1),
(25, 1, 1, 9, 16, 'TE', 'BASE', 'Golden Arms', 'U-God', 190, 196, 35, 70, 1, 60, 85, 1, 1, 1, 60, 60, 1, 1, 1, 1, 1),
(26, 1, 1, 4, 16, 'DE', 'BASE', 'Theodore', 'Ghostface', 188, 260, 75, 40, 1, 40, 30, 1, 1, 1, 70, 70, 70, 1, 1, 1, 1),
(27, 1, 1, 5, 16, 'LB', 'BASE', 'Chef', 'Raekwon', 182, 220, 70, 60, 1, 50, 30, 1, 1, 1, 80, 70, 80, 1, 1, 1, 1),
(28, 1, 1, 7, 16, 'LB', 'BASE', 'Mister', 'Method Man', 185, 210, 65, 70, 1, 60, 35, 1, 1, 1, 85, 70, 80, 1, 1, 1, 1),
(29, 3, 1, 32, 16, 'LB', 'WU01S', 'Abbot', 'RZA', 192, 200, 65, 85, 1, 75, 40, 1, 1, 1, 95, 70, 90, 1, 1, 1, 1),
(30, 2, 1, 20, 16, 'LB', 'WU01B', 'Abbot', 'RZA', 192, 200, 60, 80, 1, 70, 35, 1, 1, 1, 90, 70, 85, 1, 1, 1, 1),
(31, 1, 1, 1, 16, 'LB', 'BASE', 'Abbot', 'RZA', 192, 200, 55, 75, 1, 65, 30, 1, 1, 1, 80, 65, 80, 1, 1, 1, 1),
(32, 3, 1, 31, 16, 'CB', '37ADS', 'Antoine', 'Delacour', 180, 186, 45, 95, 1, 95, 70, 1, 1, 1, 75, 70, 55, 1, 1, 1, 1),
(33, 2, 1, 21, 16, 'CB', '37ADB', 'Antoine', 'Delacour', 180, 186, 40, 90, 1, 90, 70, 1, 1, 1, 70, 70, 50, 1, 1, 1, 1),
(34, 1, 1, 14, 16, 'CB', 'BASE', 'Antoine', 'Delacour', 180, 186, 40, 80, 1, 80, 70, 1, 1, 1, 70, 70, 45, 1, 1, 1, 1),
(35, 2, 1, 19, 16, 'S', 'LG29B', 'Lennox', 'Garnett', 186, 212, 60, 90, 1, 100, 75, 1, 1, 1, 80, 75, 60, 1, 1, 1, 1),
(36, 1, 1, 13, 16, 'S', 'BASE', 'Lennox', 'Garnett', 186, 212, 50, 80, 1, 90, 65, 1, 1, 1, 70, 65, 50, 1, 1, 1, 1),
(37, 2, 1, 22, 16, 'K', 'WU11B', 'DJ', 'Cilvaringz', 178, 180, 15, 10, 1, 10, 1, 1, 1, 1, 75, 75, 1, 75, 75, 75, 75),
(38, 1, 1, 11, 16, 'K', 'BASE', 'DJ', 'Cilvaringz', 178, 180, 10, 10, 1, 10, 1, 1, 1, 1, 70, 70, 1, 70, 70, 70, 70);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `teamID` int(11) NOT NULL AUTO_INCREMENT,
  `teamName` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`teamID`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `teams`
--

TRUNCATE TABLE `teams`;
--
-- Dumping data for table `teams`
--

INSERT DELAYED INTO `teams` (`teamID`, `teamName`) VALUES
(1, 'Arizona Outlaws'),
(2, 'Baltimore Hawks'),
(3, 'Colorado Yeti'),
(4, 'New Orleans Second Line'),
(5, 'Orange County Otters'),
(6, 'Philadelphia Liberty'),
(7, 'San Jose Sabercats'),
(8, 'Yellowknife Wraiths'),
(9, 'Kansas City Coyotes'),
(10, 'Norfolk Seawolves'),
(11, 'Palm Beach Solar Bears'),
(12, 'Portland Pythons'),
(13, 'San Antonio Marshals'),
(14, 'Tijuana Luchadores'),
(15, 'Free Agent'),
(16, 'Wu-Tang Sports Management');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `transactionID` int(11) NOT NULL AUTO_INCREMENT,
  `accountID` int(11) NOT NULL,
  `transactionDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `transactionAmount` int(11) NOT NULL,
  `transactionTypeID` int(11) NOT NULL,
  `redemptionCode` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`transactionID`),
  KEY `accountID` (`accountID`),
  KEY `transactionTypeID` (`transactionTypeID`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `transactions`
--

TRUNCATE TABLE `transactions`;
--
-- Dumping data for table `transactions`
--

INSERT DELAYED INTO `transactions` (`transactionID`, `accountID`, `transactionDate`, `transactionAmount`, `transactionTypeID`, `redemptionCode`) VALUES
(1, 1, '2019-04-11 06:00:00', 25, 5, 'STARTERS'),
(2, 1, '2019-04-11 06:00:00', 10, 2, NULL),
(3, 1, '2019-04-01 06:00:00', 10, 2, NULL),
(4, 1, '2019-04-25 14:54:33', 25, 1, NULL),
(5, 1, '2019-04-25 14:55:32', 25, 1, NULL),
(6, 2, '2019-04-25 15:02:39', 100, 1, NULL),
(7, 2, '2019-04-25 15:02:39', 25, 5, NULL),
(8, 3, '2019-04-25 15:02:39', 50, 4, NULL),
(9, 2, '2019-04-25 15:04:06', 100, 1, NULL),
(10, 2, '2019-04-25 15:04:06', 25, 5, NULL),
(11, 3, '2019-04-25 15:04:06', 50, 4, NULL),
(12, 3, '2019-04-25 15:08:02', 50, 4, NULL),
(13, 1, '2019-04-25 15:17:31', 1000, 1, NULL),
(14, 1, '2019-04-25 15:19:03', 1000, 1, NULL),
(15, 1, '2019-04-25 15:19:39', 1000, 1, NULL);

--
-- Triggers `transactions`
--
DELIMITER $$
CREATE TRIGGER `updateAcctBalance` AFTER INSERT ON `transactions` FOR EACH ROW UPDATE accounts a JOIN (SELECT accountID, SUM(NetAmount) AS NewBalance FROM (SELECT accountID, transactionAmount, t.transactionTypeID, transactionAmount*transactionModifier AS NetAmount FROM `transactions` t INNER JOIN `transactionType` tt ON t.transactionTypeID=tt.transactionTypeID) AS AcctTx GROUP BY accountID) n ON a.accountID=n.accountID 
SET a.lastUpdate = NOW(), a.acctBalance = n.NewBalance 
WHERE a.accountID = NEW.accountID
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transactionType`
--

CREATE TABLE IF NOT EXISTS `transactionType` (
  `transactionTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `transactionTypeDesc` varchar(10) CHARACTER SET latin1 NOT NULL,
  `transactionModifier` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`transactionTypeID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `transactionType`
--

TRUNCATE TABLE `transactionType`;
--
-- Dumping data for table `transactionType`
--

INSERT DELAYED INTO `transactionType` (`transactionTypeID`, `transactionTypeDesc`, `transactionModifier`) VALUES
(1, 'Deposit', 1),
(2, 'Withdrawal', -1),
(3, 'Redeem', -1),
(4, 'Award', 1),
(5, 'Special', -1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
