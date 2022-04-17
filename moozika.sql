-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2022 at 12:52 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

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

CREATE TABLE `albums` (
  `id` int(8) NOT NULL,
  `title` varchar(255) NOT NULL,
  `number_of_songs` int(255) NOT NULL,
  `release_date` date NOT NULL,
  `genre` varchar(255) NOT NULL,
  `artist` varchar(255) NOT NULL,
  `image_album` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `title`, `number_of_songs`, `release_date`, `genre`, `artist`, `image_album`) VALUES
(2, '256', 11, '2020-12-12', 'Pop', 'Adele', 'gfg'),
(3, '21', 11, '2020-12-12', 'Pop', 'Adele', ''),
(4, '21', 11, '2020-12-12', 'Pop', 'Adele', ''),
(5, '21', 11, '2020-12-12', 'Pop', 'Adele', ''),
(7, 'Malekgd', 22, '2017-01-01', 'dfsd', 'ff', 'fgdg');

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(8) NOT NULL,
  `Titre` varchar(20) NOT NULL,
  `Description` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `Titre`, `Description`) VALUES
(3, 'llll', 'dkzjqdfjeqjfqzjfo');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220415090216', '2022-04-15 11:02:31', 58);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `IdEvent` int(8) NOT NULL,
  `NomEvent` varchar(10) NOT NULL,
  `LocalisationEvent` varchar(10) NOT NULL,
  `DateEvent` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `nouveautes`
--

CREATE TABLE `nouveautes` (
  `id` int(8) NOT NULL,
  `Titre` varchar(20) NOT NULL,
  `Description` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nouveautes`
--

INSERT INTO `nouveautes` (`id`, `Titre`, `Description`) VALUES
(1, '1111', '21231321'),
(2, '1111', '21231321');

-- --------------------------------------------------------

--
-- Table structure for table `organisateur`
--

CREATE TABLE `organisateur` (
  `IdOrganisateur` int(8) NOT NULL,
  `NomOrganisateur` varchar(10) NOT NULL,
  `PrenomOrganisateur` varchar(10) NOT NULL,
  `UsernameOrganisateur` varchar(10) NOT NULL,
  `MdpOrganisateur` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

CREATE TABLE `produits` (
  `id` int(8) NOT NULL,
  `prix` float NOT NULL,
  `nom` varchar(10) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int(8) NOT NULL,
  `pourcentage` int(8) NOT NULL,
  `duree` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `pourcentage`, `duree`) VALUES
(1, 43540, 10),
(2, 43540, 10),
(3, 43540, 15),
(4, 43540, 15),
(5, 43540, 15),
(6, 43540, 15),
(7, 12, 120),
(8, 12, 120),
(9, 12, 120);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id` int(11) NOT NULL,
  `resultat` int(11) NOT NULL,
  `duree` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `singles`
--

CREATE TABLE `singles` (
  `id` int(8) NOT NULL,
  `artist` varchar(255) NOT NULL,
  `single_name` varchar(255) NOT NULL,
  `release_date` date NOT NULL,
  `genre` varchar(255) NOT NULL,
  `image_single` varchar(255) NOT NULL,
  `audio_single` varchar(255) NOT NULL,
  `albums_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `singles`
--

INSERT INTO `singles` (`id`, `artist`, `single_name`, `release_date`, `genre`, `image_single`, `audio_single`, `albums_id`) VALUES
(1, 'fgfh', 'fdgdg', '2017-01-01', 'pop', 'fdsf', 'fdsfd', NULL),
(2, 'gdfgd', 'fdgdg', '2017-01-01', 'ddgd', 'dsf', 'gdgd', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `IdTicket` int(8) NOT NULL,
  `ReferenceTicket` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `titres`
--

CREATE TABLE `titres` (
  `id` int(8) NOT NULL,
  `nom` varchar(10) NOT NULL,
  `artiste` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `mdp` varchar(30) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `age` int(10) NOT NULL,
  `sexe` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`IdEvent`);

--
-- Indexes for table `nouveautes`
--
ALTER TABLE `nouveautes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organisateur`
--
ALTER TABLE `organisateur`
  ADD PRIMARY KEY (`IdOrganisateur`);

--
-- Indexes for table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `singles`
--
ALTER TABLE `singles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7FAFC0ECECBB55AF` (`albums_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`IdTicket`);

--
-- Indexes for table `titres`
--
ALTER TABLE `titres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `IdEvent` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nouveautes`
--
ALTER TABLE `nouveautes`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `organisateur`
--
ALTER TABLE `organisateur`
  MODIFY `IdOrganisateur` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `singles`
--
ALTER TABLE `singles`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `IdTicket` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `titres`
--
ALTER TABLE `titres`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `singles`
--
ALTER TABLE `singles`
  ADD CONSTRAINT `FK_7FAFC0ECECBB55AF` FOREIGN KEY (`albums_id`) REFERENCES `albums` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
