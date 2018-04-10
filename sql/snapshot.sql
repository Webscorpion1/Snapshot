-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 10, 2018 at 10:58 AM
-- Server version: 5.6.34-log
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `snapshot`
--

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `id` int(11) NOT NULL,
  `user1_id` int(11) NOT NULL,
  `user2_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `picture`, `description`, `location`, `user_id`, `post_date`) VALUES
(1, 'https://hdwallsource.com/img/2014/8/landscape-28214-28936-hd-wallpapers.jpg', 'Amazing view!', '', 3, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL DEFAULT '',
  `lastname` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `avatar`, `description`) VALUES
(1, 'lucas', 'debelder', NULL, 'Lucasdebelder@hotmail.com', '$2y$10$3yPOhn2r6pP/LWSmac9Doug48qnXpDTXOk7qeyaXcaGG5jp3R9Gn2', '', ''),
(2, 'lucas', 'debelder', NULL, 'Lucasdebelder@hotmail.com', '$2y$10$SjM.IMqYH74irDlfFPIg9OPajZK0FEDU9qDfX2yObqSE8gtvYizHW', '', ''),
(3, 'rootroot', 'root', NULL, 'root@root.com', '$2y$10$DUJhd9T1wrFH9IkXa4.0j.mz9ZDInCRV8l2gP52znO8UeshoyelHG', '', ''),
(4, 'lucas', 'debelder', NULL, 'Lucasdebelder@hotmail.comsfddf', '$2y$10$WxSVInzyjbMuateg3taPAuwLWzOqk3TdwU6wks514bF0AsckVSQli', '', ''),
(5, 'rootrootroot', 'root', 'root', 'root@root.comroot', '$2y$10$1vt6FNWBg0LZVuwZxc4dXeOEjsd.LZvNZut.lHsFiRlxwJmpw00RO', '', ''),
(6, '', 'sdffds', 'dsffsd', 'sdf@df.com', '$2y$10$qE8HgoGzPMTRoBL55OWS4O3LTTiPZ5NA6feMKA2.IuPCCGyD13wyi', '', ''),
(7, 'flslfs', 'dsflkfsjkd', 'sdfflsdjl', 'Lucasdebelder@hotmail.com', '$2y$10$yrvkKfWOT3rdRkO3cnr67..hxt9pdws7dNBClZs5HHHCnBEbbR9cO', '', ''),
(8, 'Lucas', '', 'azerty', 'azerty@azerty.be', '$2y$10$j6NqXzpc1H0jrpIUi8JBlORPcgLFGd.A2s7lEewI5XRsVBDpXpCD6', '', ''),
(9, 'thomas', 'debelder', 'sdffds', 'sfdfsd@hotmail.com', '$2y$10$g27v68NWAa0dGaIdn8kBQufprQ/Yt5yppSS8oTAq1ksMYF8nZH/iS', '', ''),
(10, 'sssss', 'sdfdfs', 'sdffds', 'sdf@df.com', '$2y$10$kZePbNY/5J7yK2ZxhgXln.hD7Sqlo.WZ295j3mo7SEqx/2opuWO6C', '', ''),
(11, 'thomaske', 'thomaskeee', 'thomaske', 'thomas@thomas.be', '$2y$10$3ouDTSOE4fQ1VwUIH9x2.uMF03tbGaUIaar3j1wpTsZXglLoiDPnS', '', ''),
(12, 'lucas', 'dssfd', 'zlfdsjs', 'sdf@df.com', '$2y$10$679Wg6M56D.NozP14TUVXug.fL2PwsYtOKtBRacLGyxvph5jKnesy', '', ''),
(13, 'dhd', 'dh', 'hdset', 'thomas@thomas.be', '$2y$10$YOxa7YZsyJwIRYVvkJIK9.HToYCAitR7y29vberIlcG.sDuXjQkSO', '', ''),
(14, 'dfgh', 'hbfd', 'fxhhbf', 'Lucasdebelder@hotmail.com', '$2y$10$oaE9J3xKVnW09TkwQ8t9NeT94gL7RwvkjbjI2uEBf.DkFpzM8z5qi', '', ''),
(15, 'Frederik Delaet', 'frederik850', 'sgsrgs', 'root@root.com', '$2y$10$BhyEHc1PsSv2IN.NWeCBhOZvC8RVIBY0wgmJMR6nk4EJN0KbmsBFq', '', ''),
(16, 'ztgers', 'zesgt', 'szerg', 'frederik.delaet@hotmail.com', '$2y$10$ilnR7nlsZNA5Zp16ArG2J.cqSkkj.Kc61X3r2ydaSHnI67w2bm5.O', '', ''),
(17, 'fred', 'qfre', 'fred', 'fredsdfgfsgsdferik.delaet@hotmail.com', '$2y$10$clyA0FKWX9i/4Zw1ncGq7.79HLahYCWVBWK3QvMsnx.VW5SeZ0YZ2', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user1_id` (`user1_id`),
  ADD KEY `user2_id` (`user2_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`user1_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`user2_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
