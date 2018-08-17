-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 17, 2018 at 02:59 PM
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
CREATE DATABASE IF NOT EXISTS `FileVault` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;
USE `FileVault`;

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `uuid` varchar(8) CHARACTER SET latin1 NOT NULL,
  `owner` varchar(8) CHARACTER SET latin1 NOT NULL,
  `title` text CHARACTER SET latin1 NOT NULL,
  `extension` text CHARACTER SET latin1 NOT NULL,
  `download` int(11) NOT NULL,
  `public` varchar(7) CHARACTER SET latin1 NOT NULL,
  `path` text CHARACTER SET latin1 NOT NULL,
  `upload_time` datetime NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`uuid`, `owner`, `title`, `extension`, `download`, `public`, `path`, `upload_time`, `size`) VALUES
('1b3d1990', '6a86fa2e', 'Marilyn Manson - God\'s Gonna Cut You Down', '.mp3', 1, 'true', 'uploads/6a86fa2e/2018/08/Marilyn Manson - God\'s Gonna Cut You Down.mp3', '2018-08-17 08:11:44', 3815059),
('224e72bf', '6a86fa2e', 'build', '.txt', 4, 'false', 'uploads/6a86fa2e/2018/08/build.txt', '2018-08-14 14:31:53', 14),
('269c7261', '6a86fa2e', 'Andy Williams\' Speak Softly, Love', '.mp3', 4, 'true', 'uploads/6a86fa2e/2018/08/Andy Williams\' Speak Softly, Love.mp3', '2018-08-16 08:00:22', 4446386),
('4b190c9f', 'a6a2f031', 'Login_v19', '.zip', 0, 'false', 'uploads/a6a2f031/2018/08/Login_v19.zip', '2018-08-16 13:09:32', 3741720),
('8ef63007', '6a86fa2e', 'PhpStorm', '.desktop', 2, 'false', 'uploads/6a86fa2e/2018/08/PhpStorm.desktop', '2018-08-16 09:48:20', 148),
('ad99d388', '6a86fa2e', 'assets', '.sql', 0, 'false', 'uploads/6a86fa2e/2018/08/assets.sql', '2018-08-17 09:14:29', 2189);

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `uuid` varchar(8) CHARACTER SET latin1 NOT NULL,
  `name` varchar(30) CHARACTER SET latin1 NOT NULL,
  `path` text CHARACTER SET latin1 NOT NULL,
  `owner` varchar(8) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`uuid`, `name`, `path`, `owner`) VALUES
('83d2ee7d', 'A', '/uploads/6a86fa2e', '6a86fa2e');

-- --------------------------------------------------------

--
-- Table structure for table `relations`
--

CREATE TABLE `relations` (
  `id` int(11) NOT NULL,
  `user_id` varchar(8) CHARACTER SET latin1 NOT NULL,
  `file_id` varchar(8) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `relations`
--

INSERT INTO `relations` (`id`, `user_id`, `file_id`) VALUES
(10, '6a86fa2e', '224e72bf'),
(13, 'a6a2f031', '224e72bf'),
(14, '6a86fa2e', '269c7261'),
(17, '6a86fa2e', '8ef63007'),
(20, 'a6a2f031', '8ef63007'),
(21, '6cadfb91', '224e72bf'),
(22, 'a6a2f031', '4b190c9f'),
(23, 'a6a2f031', '269c7261'),
(24, '6632dce5', '8ef63007'),
(25, '6632dce5', '269c7261'),
(29, '6a86fa2e', '1b3d1990'),
(30, '6a86fa2e', 'ad99d388');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uuid` varchar(8) CHARACTER SET latin1 NOT NULL,
  `username` varchar(30) CHARACTER SET latin1 NOT NULL,
  `password` varchar(64) CHARACTER SET latin1 NOT NULL,
  `email` varchar(254) CHARACTER SET latin1 NOT NULL,
  `active` varchar(5) CHARACTER SET latin1 NOT NULL,
  `confirmed` varchar(5) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uuid`, `username`, `password`, `email`, `active`, `confirmed`) VALUES
('6632dce5', 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin@admin.com', 'false', 'false'),
('669d31ab', 'astipicasf', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'antonio.stipicdfdsf2@gmail.com', 'false', 'false'),
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
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `fk_owner` (`owner`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`uuid`);

--
-- Indexes for table `relations`
--
ALTER TABLE `relations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_file_id` (`file_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `assets`
--
ALTER TABLE `assets`
  ADD CONSTRAINT `fk_owner` FOREIGN KEY (`owner`) REFERENCES `users` (`uuid`);

--
-- Constraints for table `relations`
--
ALTER TABLE `relations`
  ADD CONSTRAINT `fk_file_id` FOREIGN KEY (`file_id`) REFERENCES `assets` (`uuid`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`uuid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
