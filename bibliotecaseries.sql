-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 05, 2022 at 12:04 AM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bibliotecaseries`
--

-- --------------------------------------------------------

--
-- Table structure for table `actors`
--

CREATE TABLE `actors` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `first_surname` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `second_surname` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `dni` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `birth_date` date NOT NULL,
  `nationality` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audio_lang`
--

CREATE TABLE `audio_lang` (
  `id_language` int(11) NOT NULL,
  `id_series` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `directors`
--

CREATE TABLE `directors` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `first_surname` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `second_surname` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `dni` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `birth_date` date NOT NULL,
  `nationality` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `directs`
--

CREATE TABLE `directs` (
  `id_director` int(11) NOT NULL,
  `id_series` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `has`
--

CREATE TABLE `has` (
  `id_platform` int(11) NOT NULL,
  `id_series` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `iso_code` varchar(7) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `performs`
--

CREATE TABLE `performs` (
  `id_actor` int(11) NOT NULL,
  `id_series` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `platforms`
--

CREATE TABLE `platforms` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `series`
--

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subtitles_lang`
--

CREATE TABLE `subtitles_lang` (
  `id_language` int(11) NOT NULL,
  `id_series` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actors`
--
ALTER TABLE `actors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audio_lang`
--
ALTER TABLE `audio_lang`
  ADD PRIMARY KEY (`id_language`,`id_series`),
  ADD KEY `audio_lang_fk2` (`id_series`);

--
-- Indexes for table `directors`
--
ALTER TABLE `directors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `directs`
--
ALTER TABLE `directs`
  ADD PRIMARY KEY (`id_director`,`id_series`),
  ADD KEY `directs_fk2` (`id_series`);

--
-- Indexes for table `has`
--
ALTER TABLE `has`
  ADD PRIMARY KEY (`id_platform`,`id_series`),
  ADD KEY `has_fk2` (`id_series`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `performs`
--
ALTER TABLE `performs`
  ADD PRIMARY KEY (`id_actor`,`id_series`),
  ADD KEY `performs_fk2` (`id_series`);

--
-- Indexes for table `platforms`
--
ALTER TABLE `platforms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subtitles_lang`
--
ALTER TABLE `subtitles_lang`
  ADD PRIMARY KEY (`id_language`,`id_series`),
  ADD KEY `subtitles_lang_fk2` (`id_series`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actors`
--
ALTER TABLE `actors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `directors`
--
ALTER TABLE `directors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `platforms`
--
ALTER TABLE `platforms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audio_lang`
--
ALTER TABLE `audio_lang`
  ADD CONSTRAINT `audio_lang_fk1` FOREIGN KEY (`id_language`) REFERENCES `languages` (`id`),
  ADD CONSTRAINT `audio_lang_fk2` FOREIGN KEY (`id_series`) REFERENCES `series` (`id`);

--
-- Constraints for table `directs`
--
ALTER TABLE `directs`
  ADD CONSTRAINT `directs_fk1` FOREIGN KEY (`id_director`) REFERENCES `directors` (`id`),
  ADD CONSTRAINT `directs_fk2` FOREIGN KEY (`id_series`) REFERENCES `series` (`id`);

--
-- Constraints for table `has`
--
ALTER TABLE `has`
  ADD CONSTRAINT `has_fk1` FOREIGN KEY (`id_platform`) REFERENCES `platforms` (`id`),
  ADD CONSTRAINT `has_fk2` FOREIGN KEY (`id_series`) REFERENCES `series` (`id`);

--
-- Constraints for table `performs`
--
ALTER TABLE `performs`
  ADD CONSTRAINT `performs_fk1` FOREIGN KEY (`id_actor`) REFERENCES `actors` (`id`),
  ADD CONSTRAINT `performs_fk2` FOREIGN KEY (`id_series`) REFERENCES `series` (`id`);

--
-- Constraints for table `subtitles_lang`
--
ALTER TABLE `subtitles_lang`
  ADD CONSTRAINT `subtitles_lang_fk1` FOREIGN KEY (`id_language`) REFERENCES `languages` (`id`),
  ADD CONSTRAINT `subtitles_lang_fk2` FOREIGN KEY (`id_series`) REFERENCES `series` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
