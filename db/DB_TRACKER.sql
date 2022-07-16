-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2018 at 01:52 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rwa_bp_projekt_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `id_card` int(11) NOT NULL COMMENT 'ID zadatka',
  `card_name` varchar(255) NOT NULL COMMENT 'Ime "To do liste"',
  `description` varchar(255) DEFAULT NULL COMMENT 'Kratki opis',
  `deadline` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`id_card`, `card_name`, `description`, `deadline`) VALUES
(17, 'Test Card', 'Something about this card...', '2018-01-23'),
(18, 'Test Card 2', 'Something about this card...', '2018-01-18'),
(19, 'Deliver Project', 'Finish and deliver...', '2018-01-31'),
(20, 'Design index page!', 'Blah blah...', '2018-01-15'),
(21, 'Integrate search bar', 'Add search bar to main navigation bar... ', '2018-03-16');

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `id_user1` int(11) NOT NULL COMMENT 'Korisnik koji prati',
  `id_user2` int(11) NOT NULL COMMENT 'Korisnik kojeg prati'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`id_user1`, `id_user2`) VALUES
(1, 3),
(6, 7),
(7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id_project` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id_project`, `project_name`, `description`) VALUES
(20, 'Cool App', 'This is cool app project!! Join us!!'),
(21, 'Razvoj Web Aplikacija', 'Razvoj web aplikacij za projekt!!'),
(22, 'Novi projekt', 'Proba 123'),
(23, 'BP Project', 'Design database'),
(24, 'Test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `project_card`
--

CREATE TABLE `project_card` (
  `id_card` int(11) NOT NULL,
  `id_project` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_card`
--

INSERT INTO `project_card` (`id_card`, `id_project`) VALUES
(15, 21),
(16, 21),
(17, 20),
(18, 20),
(19, 21),
(20, 21),
(21, 21),
(22, 21);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `user_type` int(11) NOT NULL DEFAULT '1',
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT '../images/profilePhotoDefault.png',
  `created_date` date NOT NULL,
  `country` varchar(255) DEFAULT 'None',
  `age` int(11) DEFAULT '18',
  `gender` varchar(255) DEFAULT 'Other',
  `about` varchar(255) DEFAULT 'None'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `user_type`, `fname`, `lname`, `username`, `email`, `password`, `avatar`, `created_date`, `country`, `age`, `gender`, `about`) VALUES
(1, 2, 'Mateo', 'Niksic', 'mateonik', 'mniksic5@gmail.com', '1', '../users/avatars/giphy.gif', '2018-01-04', 'Croatia', 21, 'Male', 'Admin'),
(3, 1, 'Marko', 'Doe', 'mpantic12', 'mojmailmarko@hotmail.com', 'supercool432', '../users/avatars/dnae.jpg', '2018-01-04', 'Germany', 58, 'Male', 'I have liked many but loved very few.\r\nYet no-one has been as sweet as u.'),
(4, 1, 'Ivana', 'Spahic', 'ispahic', 'ivana.spahic@riteh.hr', 'Dog677', '../users/avatars/avatar0001.jpg', '2018-01-04', 'China', 45, 'Female', '18'),
(5, 1, 'Ana', 'Kaktus', 'girl212', 'kaktusana@net.hr', 'anakakt', '../users/avatars/akakt.jpg', '2018-01-04', 'England', 42, 'Female', 'Life is short.\r\nBreak the rules.'),
(6, 1, 'George', 'Bush', 'gbush', 'gbush@live.com', 'rpolic', '../users/avatars/rpo.png', '2018-01-04', 'Rijeka', 20, 'Male', 'Wazzap'),
(7, 1, 'Vito', 'Dulic', 'vdulic', 'vitodulic@hotmail.com', '0000', '../users/avatars/user1.jpg', '2018-01-05', 'Croatia', 25, 'Male', 'Add me'),
(8, 1, 'Maja', 'Dodic', 'mdodic', 'mdodic@net.hr', '1', '../users/avatars/chine.jpg', '2018-01-05', 'Italia', 32, 'Female', 'Hey, please contact mee!'),
(9, 1, 'Jelena', 'Dadic', 'jdane', 'jdane@gmail.com', '1', '../users/avatars/jdane.jpg', '2018-01-05', 'Egypt', 18, 'Female', 'Please do not add me if you do not know me!!! '),
(10, 1, 'Ana', 'Babic', 'ababic12', 'ababic@net.hr', 'mojasifra', '../users/avatars/ababic.jpg', '2018-01-05', 'China', 39, 'Female', 'Hiiiiii!'),
(11, 1, 'Matko', 'Ratko', 'mkovac12', 'mratko@mail.com', '22', '../users/avatars/mkovac.jpg', '2018-01-05', 'Tailand', 22, 'Male', 'Bass sam kralj hehahaha!! :D\r\nBass sam kralj hehahaha!! :DB'),
(12, 1, 'Matko', 'Danic', 'md', 'mdanic@riteh.hr', 'mdanic', '../users/avatars/md.jpg', '2018-01-06', 'England', 36, 'Male', 'Welcome to my profile! :D'),
(13, 1, 'Jhon', 'Doe', 'jdoe', 'jdoe@net.hr', 'bp', '../users/avatars/user0.png', '2018-01-07', 'Croatia', 27, 'Male', 'Someone ask me to describe u\r\nin two words he expect me\r\nto answer The Best but i did not answer\r\ni just smiled and\r\nsaid No Comparison'),
(14, 1, 'Jane', 'Doe', 'JDoe', 'jdoe@gmail.com', '2', '../images/profilePhotoDefault.png', '2018-01-10', 'Croatia', 18, 'Female', 'Komentar');

-- --------------------------------------------------------

--
-- Table structure for table `user_group_membership`
--

CREATE TABLE `user_group_membership` (
  `id_user` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `user_type` int(11) NOT NULL DEFAULT '1' COMMENT 'default(1),admin(2),super_admin(3),super_user(4)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_group_membership`
--

INSERT INTO `user_group_membership` (`id_user`, `id_group`, `user_type`) VALUES
(0, 16, 2),
(0, 31, 1),
(1, 16, 2),
(1, 17, 2),
(1, 18, 2),
(1, 19, 2),
(1, 20, 2),
(1, 22, 1),
(1, 25, 2),
(1, 26, 1),
(3, 16, 1),
(3, 23, 1),
(4, 17, 1),
(4, 19, 1),
(4, 22, 1),
(4, 23, 1),
(4, 24, 1),
(4, 25, 2),
(4, 30, 1),
(5, 17, 1),
(5, 20, 1),
(5, 24, 2),
(5, 26, 1),
(6, 16, 1),
(8, 20, 1),
(9, 16, 1),
(9, 17, 2),
(9, 19, 1),
(9, 20, 2),
(9, 22, 1),
(9, 23, 1),
(9, 25, 1),
(9, 26, 2),
(10, 0, 1),
(10, 16, 1),
(10, 20, 1),
(10, 22, 1),
(10, 24, 2),
(10, 26, 1),
(10, 30, 1),
(11, 17, 1),
(11, 22, 2),
(11, 23, 1),
(11, 26, 1),
(12, 16, 1),
(12, 17, 2),
(12, 19, 1),
(12, 20, 1),
(12, 21, 2),
(12, 23, 1),
(12, 26, 1),
(12, 31, 2),
(13, 17, 1),
(13, 19, 1),
(13, 20, 1),
(13, 21, 1),
(13, 23, 2),
(13, 25, 1),
(13, 30, 2),
(14, 31, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_group_project_membership`
--

CREATE TABLE `user_group_project_membership` (
  `id_user` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `user_type` int(11) NOT NULL DEFAULT '1' COMMENT '1(default),2(project_admin),**3(GroupAdmin)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_group_project_membership`
--

INSERT INTO `user_group_project_membership` (`id_user`, `id_group`, `id_project`, `user_type`) VALUES
(1, 16, 20, 3),
(1, 16, 21, 3),
(1, 16, 22, 3),
(1, 20, 23, 3),
(1, 25, 24, 3),
(4, 16, 20, 2),
(4, 16, 21, 1),
(4, 20, 23, 1),
(5, 16, 21, 2),
(6, 16, 20, 1),
(6, 16, 22, 2),
(6, 20, 23, 1),
(6, 25, 24, 1),
(7, 16, 21, 1),
(7, 16, 22, 1),
(7, 20, 23, 1),
(7, 25, 24, 2),
(9, 16, 20, 1),
(9, 16, 21, 2),
(9, 20, 23, 2),
(10, 16, 20, 1),
(10, 16, 21, 1),
(10, 16, 22, 1),
(10, 20, 23, 1),
(11, 16, 21, 2),
(11, 16, 22, 2),
(12, 16, 20, 1),
(12, 16, 21, 1),
(12, 20, 23, 1),
(13, 16, 20, 1),
(13, 16, 21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `_group`
--

CREATE TABLE `_group` (
  `id_group` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_date` date NOT NULL,
  `group_type` int(11) NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_group`
--

INSERT INTO `_group` (`id_group`, `group_name`, `password`, `description`, `created_date`, `group_type`) VALUES
(16, 'First Official Group', NULL, 'Everyone are welcome! :)', '2018-01-07', 3),
(17, 'Microsoft Developers', NULL, 'Memebers of Microsoft Web Developers Club..\r\n', '2018-01-07', 1),
(19, 'Family Trip', NULL, 'Personal group for family members!!', '2018-01-09', 1),
(20, 'RiTeh Projects', NULL, 'Need a cool nickname for your game ? Use our fancy symbols to make a nickname or a clan for games ', '2018-01-09', 2),
(21, 'Drink Dudes', NULL, 'Morning is godâ€™s way of saying:\r\nâ€œone more time! Live life.\r\nMake a difference.\r\nTouch 1 heart.\r\nEncourage 1 mind.\r\nInspire 1 soulâ€¦â€\r\nGood morning.', '2018-01-09', 1),
(22, 'Motivational Group', NULL, 'If we both exchange one dollar,\r\nWe both have one dollar each.\r\nBut if we exchange one good thought,\r\nWe both have two good thougths.', '2018-01-09', 3),
(23, 'Join at your own risk', NULL, 'There is a saying\r\nIf you want to be great,\r\nYou must walk with great people.\r\nSeriously,\r\nI have no objection,\r\nYou can walk with me!', '2018-01-09', 3),
(24, 'Just Bold Ladies', NULL, 'I have liked many but loved very few.\r\nYet no-one has been as sweet as u.\r\nI would stand and wait in the worlds longest queue.\r\nJust for the pleasure of a moment with u.', '2018-01-09', 2),
(25, 'Tech Ninjas', NULL, 'Worrying doesnâ€™t reduce yesterdays sorrows,\r\nBut it empties todays strength.\r\nSo dont worry,\r\nBe happy & make others happy.', '2018-01-09', 3),
(26, 'The Public Square', NULL, 'Sleeping lion is better than a barking dog\r\nSo.....\r\nSleeping student is better than a barking teacher', '2018-01-09', 3),
(30, 'Home Alone Team', NULL, 'We are cool!', '2018-01-09', 3),
(31, 'gRUPA', NULL, 'kdkd', '2018-01-10', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`id_card`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id_user1`,`id_user2`),
  ADD UNIQUE KEY `id_user1` (`id_user1`),
  ADD UNIQUE KEY `id_user2` (`id_user2`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id_project`);

--
-- Indexes for table `project_card`
--
ALTER TABLE `project_card`
  ADD PRIMARY KEY (`id_card`,`id_project`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_group_membership`
--
ALTER TABLE `user_group_membership`
  ADD PRIMARY KEY (`id_user`,`id_group`),
  ADD UNIQUE KEY `ID_user` (`id_user`,`id_group`);

--
-- Indexes for table `user_group_project_membership`
--
ALTER TABLE `user_group_project_membership`
  ADD PRIMARY KEY (`id_user`,`id_group`,`id_project`);

--
-- Indexes for table `_group`
--
ALTER TABLE `_group`
  ADD PRIMARY KEY (`id_group`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `card`
--
ALTER TABLE `card`
  MODIFY `id_card` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID zadatka', AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id_project` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `_group`
--
ALTER TABLE `_group`
  MODIFY `id_group` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
