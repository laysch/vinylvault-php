-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 06, 2024 at 01:10 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bcs350fa24`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `password`) VALUES
('kevin123', 'kevin@abc.com', '$2y$10$J6qOM3DSNh.Pt1285E3gfeA97phVWc4qeSLq7G3sCpv.0IwyZxRLK');

-- --------------------------------------------------------

--
-- Table structure for table `vinyls`
--

CREATE TABLE `vinyls` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `artist` varchar(128) NOT NULL,
  `year` char(4) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vinyls`
--

INSERT INTO `vinyls` (`id`, `title`, `artist`, `year`, `description`, `price`) VALUES
(1, 'Abbey Road', 'The Beatles', '1969', 'Classic album by The Beatles. A timeless masterpiece.', 19.99),
(2, 'Feel Special', 'TWICE', '2019', 'A vibrant pop album with catchy hits from TWICE.', 18.99),
(3, 'Likey', 'TWICE', '2017', 'Energetic and catchy hit song by TWICE.', 17.99),
(4, 'Me & You', 'EXID', '2018', 'A popular track by EXID.', 16.99),
(5, 'Dil Diyan Gallan', 'Atif Aslam', '2017', 'A romantic song.', 15.99),
(6, 'Dil Diyan Gallan', 'Ali Zafar', '2017', 'Another beautiful version of Dil Diyan Gallan, sung by Ali Zafar.', 15.99);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vinyls`
--
ALTER TABLE `vinyls`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vinyls`
--
ALTER TABLE `vinyls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
