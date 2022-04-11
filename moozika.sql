-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 11, 2022 at 09:32 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moozika`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

DROP TABLE IF EXISTS `albums`;
CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `number_of_songs` int(255) NOT NULL,
  `release_date` date NOT NULL,
  `genre` varchar(255) NOT NULL,
  `artist` varchar(255) NOT NULL,
  `length` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `Titre` varchar(20) NOT NULL,
  `Description` varchar(20) NOT NULL,
  `nbEtoiles` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `Titre`, `Description`, `nbEtoiles`, `userId`) VALUES
(3, 'llll', 'dkzjqdfjeqjfqzjfo', 0, 0),
(4, 'qsdqs', 'qsdqdqsd', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `IdEvent` int(8) NOT NULL AUTO_INCREMENT,
  `NomEvent` varchar(10) NOT NULL,
  `LocalisationEvent` varchar(10) NOT NULL,
  `DateEvent` varchar(20) NOT NULL,
  PRIMARY KEY (`IdEvent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `nouveautes`
--

DROP TABLE IF EXISTS `nouveautes`;
CREATE TABLE IF NOT EXISTS `nouveautes` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `Titre` varchar(20) NOT NULL,
  `Description` varchar(20) NOT NULL,
  `nbEtoiles` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nouveautes`
--

INSERT INTO `nouveautes` (`id`, `Titre`, `Description`, `nbEtoiles`, `userId`) VALUES
(2, '1111', '21231321', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `organisateur`
--

DROP TABLE IF EXISTS `organisateur`;
CREATE TABLE IF NOT EXISTS `organisateur` (
  `IdOrganisateur` int(8) NOT NULL AUTO_INCREMENT,
  `NomOrganisateur` varchar(10) NOT NULL,
  `PrenomOrganisateur` varchar(10) NOT NULL,
  `UsernameOrganisateur` varchar(10) NOT NULL,
  `MdpOrganisateur` int(20) NOT NULL,
  PRIMARY KEY (`IdOrganisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `prix` float NOT NULL,
  `nom` varchar(10) NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

DROP TABLE IF EXISTS `promotions`;
CREATE TABLE IF NOT EXISTS `promotions` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `pourcentage` int(8) NOT NULL,
  `duree` int(8) NOT NULL,
  `idProd` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `pourcentage`, `duree`, `idProd`) VALUES
(9, 3, 200, 55);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
CREATE TABLE IF NOT EXISTS `quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(50) NOT NULL,
  `reponse` varchar(20) NOT NULL,
  `duree` int(11) NOT NULL,
  `idPromo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `question`, `reponse`, `duree`, `idPromo`) VALUES
(2, 'Question', 'Reponse', 120, 0),
(3, 'Question', 'Reponse', 120, 0),
(4, 'Question', 'Reponse', 120, 0),
(5, 'qdsfqds', 'sdfqs', 1, 0),
(6, 'qsdf', 'qsdfqsfd', 131321, 0),
(7, 'sdkljfhskdf', 'mosidinfsmonfsqomd', 351651651, 0),
(8, 'AAAAAAAAAAA', 'AAAAAAAAAA', 123, 0),
(9, 'qsdq', 'qdqd', 1200, 0),
(10, 'majdmajdmajd', 'majdmajdmajd', 100, 0);

-- --------------------------------------------------------

--
-- Table structure for table `singles`
--

DROP TABLE IF EXISTS `singles`;
CREATE TABLE IF NOT EXISTS `singles` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `artist` varchar(255) NOT NULL,
  `single_name` varchar(255) NOT NULL,
  `artist_image` varchar(255) NOT NULL,
  `release_date` date NOT NULL,
  `rate` int(10) NOT NULL,
  `genre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `IdTicket` int(8) NOT NULL AUTO_INCREMENT,
  `ReferenceTicket` int(8) NOT NULL,
  PRIMARY KEY (`IdTicket`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `titres`
--

DROP TABLE IF EXISTS `titres`;
CREATE TABLE IF NOT EXISTS `titres` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `nom` varchar(10) NOT NULL,
  `artiste` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `mail` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `mdp` varchar(30) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `age` int(10) NOT NULL,
  `sexe` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
