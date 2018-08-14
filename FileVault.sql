-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 14, 2018 at 02:37 PM
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
CREATE DATABASE IF NOT EXISTS `FileVault` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `FileVault`;

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
('224e72bf', '6a86fa2e', 'build', '.txt', 0, 'false', 'uploads/6a86fa2e/2018/08/build.txt', '2018-08-14 14:31:53', 14),
('9c1fbf8a', '6a86fa2e', 'Install-Linux-tar', '.txt', 0, 'false', 'uploads/6a86fa2e/2018/08/Install-Linux-tar.txt', '2018-08-14 14:32:34', 1911);

-- --------------------------------------------------------

--
-- Table structure for table `relations`
--

CREATE TABLE `relations` (
  `id` int(11) NOT NULL,
  `user_id` varchar(8) NOT NULL,
  `file_id` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `relations`
--

INSERT INTO `relations` (`id`, `user_id`, `file_id`) VALUES
(10, '6a86fa2e', '224e72bf'),
(12, '6a86fa2e', '9c1fbf8a'),
(13, 'a6a2f031', '224e72bf');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uuid` varchar(8) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(254) NOT NULL,
  `active` varchar(5) NOT NULL,
  `confirmed` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uuid`, `username`, `password`, `email`, `active`, `confirmed`) VALUES
('6a86fa2e', 'astipic', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'antonio.stipic2@gmail.com', 'true', 'true'),
('6cadfb91', 'AA', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'antonio.stipic2@gmail.com123', 'false', 'false'),
('a6a2f031', 'A', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'antonio.stipic12@gmail.com', 'false', 'false');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`uuid`);

--
-- Indexes for table `relations`
--
ALTER TABLE `relations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uuid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `relations`
--
ALTER TABLE `relations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
