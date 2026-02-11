-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2026 at 01:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fietsenmaker`
--

-- --------------------------------------------------------

--
-- Table structure for table `fietsen`
--

CREATE TABLE `fietsen` (
  `id` int(11) NOT NULL,
  `merk` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `prijs` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fietsen`
--

INSERT INTO `fietsen` (`id`, `merk`, `type`, `prijs`, `foto`) VALUES
(1, 'Batavus', 'Blockbusters', 100000, 'www'),
(2, 'Batavus', 'Flying D', 749, 'Fiets3.jpg'),
(3, 'Gazelle', 'Chamonix', 799, 'Fiets1c.jpg'),
(5, 'eww', 'wew', 1, ''),
(7, '11', '00', 11, ''),
(8, 'eeeee', 'asas', 111, ''),
(10, 'gazale', 'sport bike', 1999, '');

-- --------------------------------------------------------

--
-- Table structure for table `fietsenmaker`
--

CREATE TABLE `fietsenmaker` (
  `Merk` varchar(255) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Prijs` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fietsenmaker`
--

INSERT INTO `fietsenmaker` (`Merk`, `Type`, `Prijs`) VALUES
('Gazelle', 'Giro', 899),
('Gazalle', 'Chamonix', 1049),
('Gazalle', 'Eclipse', 799),
('Giant', 'Competition', 999),
('Giant', 'Expedition AT', 1299);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fietsen`
--
ALTER TABLE `fietsen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fietsen`
--
ALTER TABLE `fietsen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
