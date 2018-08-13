-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 13, 2018 at 02:55 PM
-- Server version: 5.7.23-0ubuntu0.16.04.1
-- PHP Version: 7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `FileVault`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `uuid` varchar(8) NOT NULL,
  `owner` varchar(8) NOT NULL,
  `title` text NOT NULL,
  `extension` text NOT NULL,
  `download` int(11) NOT NULL,
  `secure` varchar(7) NOT NULL,
  `path` text NOT NULL,
  `upload_time` datetime NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`uuid`, `owner`, `title`, `extension`, `download`, `secure`, `path`, `upload_time`, `size`) VALUES
('4ed87e4b', '6a86fa2e', 'FileVault - Logo', '.png', 0, 'false', 'uploads/6a86fa2e/2018/08/FileVault - Logo.png', '2018-08-13 09:29:44', 21099),
('dee83fda', 'a6a2f031', 'FileVault', '.png', 0, 'false', 'uploads/a6a2f031/2018/08/FileVault.png', '2018-08-13 09:30:03', 21099),
('e71db467', '6a86fa2e', 'Andy Williams\' Speak Softly, Love', '.mp3', 0, 'false', 'uploads/6a86fa2e/2018/08/Andy Williams\' Speak Softly, Love.mp3', '2018-08-13 09:45:57', 4446386);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`uuid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
