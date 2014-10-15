-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 15, 2014 at 12:47 PM
-- Server version: 5.5.38-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `email`
--

-- --------------------------------------------------------

--
-- Table structure for table `email_account`
--

CREATE TABLE IF NOT EXISTS `email_account` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `smtp` varchar(100) NOT NULL DEFAULT 'smtp.gmail.com',
  `imap` varchar(100) NOT NULL DEFAULT '{imap.gmail.com:993/imap/ssl}INBOX',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `email_account`
--

INSERT INTO `email_account` (`ID`, `username`, `email`, `alias`, `password`, `smtp`, `imap`) VALUES
(1, 'rohman', 'susedamedia@gmail.com', 'rohman@suseda.com', 'rohman123', 'smtp.gmail.com', '{imap.gmail.com:993/imap/ssl}INBOX');

-- --------------------------------------------------------

--
-- Table structure for table `email_messages`
--

CREATE TABLE IF NOT EXISTS `email_messages` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `time` datetime NOT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `content` text,
  `pengirim` varchar(50) NOT NULL,
  `tujuan` varchar(50) NOT NULL,
  `attach` varchar(200) DEFAULT NULL,
  `state` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `email_messages`
--

INSERT INTO `email_messages` (`ID`, `time`, `subject`, `content`, `pengirim`, `tujuan`, `attach`, `state`) VALUES
(1, '2014-04-03 11:03:58', 'Jng', 'Gdbdknjd\r\n', 'rohmanmail@gmail.com', '123@suseda.com', NULL, 1),
(2, '2014-04-03 11:08:57', 'Re: Jng', 'Evhdvhdjd\r\nPada 3 Apr 2014 11.03, "Rohman Ahmad" <rohmanmail@gmail.com> menulis:\r\n\r\n> Gdbdknjd\r\n>\r\n', 'rohmanmail@gmail.com', 'rohman@suseda.com', NULL, 1),
(3, '2014-04-03 11:10:15', 'Re: Jng', 'T\r\nPada 3 Apr 2014 11.08, "Rohman Ahmad" <rohmanmail@gmail.com> menulis:\r\n\r\n> Evhdvhdjd\r\n> Pada 3 Apr 2014 11.03, "Rohman Ahmad" <rohmanmail@gmail.com> menulis:\r\n>\r\n>> Gdbdknjd\r\n>>\r\n>\r\n', 'rohmanmail@gmail.com', 'rohman@suseda.com', NULL, 1),
(4, '2014-04-03 11:11:23', 'Re: Jng', 'Rc\r\nPada 3 Apr 2014 11.08, "Rohman Ahmad" <rohmanmail@gmail.com> menulis:\r\n\r\n> Evhdvhdjd\r\n> Pada 3 Apr 2014 11.03, "Rohman Ahmad" <rohmanmail@gmail.com> menulis:\r\n>\r\n>> Gdbdknjd\r\n>>\r\n>\r\n', 'rohmanmail@gmail.com', 'rohman@suseda.com', NULL, 1),
(5, '2014-04-03 11:14:13', 'Re: Jng', 'Poleh\r\nPada 3 Apr 2014 11.08, "Rohman Ahmad" <rohmanmail@gmail.com> menulis:\r\n\r\n> Evhdvhdjd\r\n> Pada 3 Apr 2014 11.03, "Rohman Ahmad" <rohmanmail@gmail.com> menulis:\r\n>\r\n>> Gdbdknjd\r\n>>\r\n>\r\n', 'rohmanmail@gmail.com', 'rohman@suseda.com', NULL, 1),
(6, '2014-04-03 11:15:58', 'Re: Jng', 'Dolen\r\nPada 3 Apr 2014 11.08, "Rohman Ahmad" <rohmanmail@gmail.com> menulis:\r\n\r\n> Evhdvhdjd\r\n> Pada 3 Apr 2014 11.03, "Rohman Ahmad" <rohmanmail@gmail.com> menulis:\r\n>\r\n>> Gdbdknjd\r\n>>\r\n>\r\n', 'rohmanmail@gmail.com', 'rohman@suseda.com', NULL, 1),
(7, '2014-04-03 11:16:56', 'Re: Jng', 'Uuuuu\r\nPada 3 Apr 2014 11.08, "Rohman Ahmad" <rohmanmail@gmail.com> menulis:\r\n\r\n> Evhdvhdjd\r\n> Pada 3 Apr 2014 11.03, "Rohman Ahmad" <rohmanmail@gmail.com> menulis:\r\n>\r\n>> Gdbdknjd\r\n>>\r\n>\r\n', 'rohmanmail@gmail.com', 'rohman@suseda.com', NULL, 1),
(8, '2014-04-03 11:18:23', 'Re: Jng', '1\r\nPada 3 Apr 2014 11.08, "Rohman Ahmad" <rohmanmail@gmail.com> menulis:\r\n\r\n> Evhdvhdjd\r\n> Pada 3 Apr 2014 11.03, "Rohman Ahmad" <rohmanmail@gmail.com> menulis:\r\n>\r\n>> Gdbdknjd\r\n>>\r\n>\r\n', 'rohmanmail@gmail.com', 'rohman@suseda.com', NULL, 1),
(9, '2014-04-03 11:20:34', 'Re: Jng', '', 'rohmanmail@gmail.com', 'rohman@suseda.com', NULL, 1),
(10, '2014-04-03 11:21:09', 'Re: Jng', 'G\r\nPada 3 Apr 2014 11.08, "Rohman Ahmad" <rohmanmail@gmail.com> menulis:\r\n\r\n> Evhdvhdjd\r\n> Pada 3 Apr 2014 11.03, "Rohman Ahmad" <rohmanmail@gmail.com> menulis:\r\n>\r\n>> Gdbdknjd\r\n>>\r\n>\r\n', 'rohmanmail@gmail.com', 'rohman@suseda.com', NULL, 1),
(11, '2014-04-03 11:22:31', 'Re: Jng', 'Udb\r\n', 'rohmanmail@gmail.com', 'rohman@suseda.com', NULL, 1),
(12, '2014-04-03 11:23:24', 'Re: Jng', '', 'rohmanmail@gmail.com', 'rohman@suseda.com', NULL, 1),
(13, '2014-04-05 11:24:08', 'Re: Jng', 'G\r\n', 'rohmanmail@gmail.com', 'rohman@suseda.com', NULL, 1),
(14, '2014-04-05 11:25:10', 'Re: Jng', 'T\r\n', 'rohmanmail@gmail.com', 'rohman@suseda.com', NULL, 1),
(15, '2014-04-03 11:25:40', 'Re: Jng', 'Ggg\r\nPada 3 Apr 2014 11.08, "Rohman Ahmad" <rohmanmail@gmail.com> menulis:\r\n\r\n> Evhdvhdjd\r\n> Pada 3 Apr 2014 11.03, "Rohman Ahmad" <rohmanmail@gmail.com> menulis:\r\n>\r\n>> Gdbdknjd\r\n>>\r\n>\r\n', 'rohmanmail@gmail.com', 'rohman@suseda.com', NULL, 1),
(16, '2014-04-04 11:17:42', 'Hbd', 'Hdbd\r\n', 'rohmanmail@gmail.com', 'rohman@suseda.com', NULL, 1),
(17, '2014-04-04 14:23:09', 'Hshd', 'Hzdhd\r\n', 'rohmanmail@gmail.com', 'rohman@suseda.com', NULL, 1),
(18, '2014-04-04 14:24:11', 'Vhuff', 'Hari ini pada jam ini\r\n', 'rohmanmail@gmail.com', 'rohman@suseda.com', NULL, 1),
(19, '2014-04-04 14:25:11', 'lkjlk', '<p>uouoyoioyo</p>', '234234@suseda.com', 'rohmanmail@gmail.com', '', 1),
(20, '2014-04-04 14:25:32', 'Re: lkjlk', 'Ghjfhd pada jan uthbif\nPada 4 Apr 2014 14.25, "CS of suseda.com" <rohman@suseda.com> menulis:\n\n> uouoyoioyo\n>\n', 'rohmanmail@gmail.com', 'rohman@suseda.com', NULL, 1),
(21, '2014-04-04 14:27:21', 'Re: lkjlk', 'Hbfud pada hjf\r\nPada 4 Apr 2014 14.25, "Rohman Ahmad" <rohmanmail@gmail.com> menulis:\r\n\r\n> Ghjfhd pada jan uthbif\r\n> Pada 4 Apr 2014 14.25, "CS of suseda.com" <rohman@suseda.com> menulis:\r\n>\r\n>> uouoyoioyo\r\n>>\r\n>\r\n', 'rohmanmail@gmail.com', 'rohman@suseda.com', NULL, 1),
(22, '2014-04-04 14:28:08', 'Re: lkjlk', 'Yuuoonff\r\nPada hajjfjf\r\nPada 4 Apr 2014 14.27, "Rohman Ahmad" <rohmanmail@gmail.com> menulis:\r\n\r\n> Hbfud pada hjf\r\n> Pada 4 Apr 2014 14.25, "Rohman Ahmad" <rohmanmail@gmail.com> menulis:\r\n>\r\n>> Ghjfhd pada jan uthbif\r\n>> Pada 4 Apr 2014 14.25, "CS of suseda.com" <rohman@suseda.com> menulis:\r\n>>\r\n>>> uouoyoioyo\r\n>>>\r\n>>\r\n', 'rohmanmail@gmail.com', 'rohman@suseda.com', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `email_user_alias`
--

CREATE TABLE IF NOT EXISTS `email_user_alias` (
  `ID_alias` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(20) NOT NULL,
  `email_pengirim` varchar(100) NOT NULL,
  `email_induk` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_alias`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `email_user_alias`
--

INSERT INTO `email_user_alias` (`ID_alias`, `nama`, `email_pengirim`, `email_induk`) VALUES
(1, 'rohman', 'rohman@suseda.com', 'susedamedia@gmail.com'),
(2, 'bintang', 'bintang@suseda.com', 'susedamedia@gmail.com'),
(3, 'bumi', 'bumi@suseda.com', 'susedamedia@gmail.com'),
(4, 'bulan', 'bulan@suseda.com', 'susedamedia@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
