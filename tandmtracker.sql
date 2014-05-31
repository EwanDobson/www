-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2014 at 08:03 PM
-- Server version: 5.5.25
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tandmtracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event`
--

CREATE TABLE IF NOT EXISTS `tbl_event` (
  `eventId` int(11) NOT NULL AUTO_INCREMENT,
  `projectId` int(11) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(128) DEFAULT NULL,
  `title` varchar(64) NOT NULL,
  `author` varchar(64) NOT NULL,
  PRIMARY KEY (`eventId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mindmap`
--

CREATE TABLE IF NOT EXISTS `tbl_mindmap` (
  `mindmapId` int(11) NOT NULL AUTO_INCREMENT,
  `projectId` int(11) NOT NULL,
  `json` varchar(256) DEFAULT NULL,
  `img` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`mindmapId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `tbl_mindmap`
--

INSERT INTO `tbl_mindmap` (`mindmapId`, `projectId`, `json`, `img`) VALUES
(20, 1, '20140512mindmap33.json', '20140512mindmap33.png'),
(21, 1, '20140512mindmap14.json', '20140512mindmap14.png'),
(22, 1, '20140512mindmap50.json', '20140512mindmap50.png'),
(23, 1, '20140512mindmap.json', '20140512mindmap.png'),
(24, 1, '20140512mindmap.json', '20140512mindmap.png'),
(25, 1, '20140513mindmap.json', '20140513mindmap.png'),
(26, 1, '20140513mindmap.json', '20140513mindmap.png'),
(27, 1, '20140513mindmap.json', '20140513mindmap.png'),
(28, 1, '20140513mindmap.json', '20140513mindmap.png'),
(29, 1, '20140513mindmap.json', '20140513mindmap.png'),
(30, 1, '20140513mindmap59.json', '20140513mindmap59.png'),
(31, 1, '20140513mindmap28.json', '20140513mindmap28.png'),
(32, 1, '20140513mindmap48.json', '20140513mindmap48.png'),
(33, 1, '20140513mindmap28.json', '20140513mindmap28.png'),
(34, 1, '20140513070553mindmap.json', '20140513070553mindmap.png'),
(35, 1, '20140513070536mindmap.json', '20140513070536mindmap.png'),
(36, 1, '20140513070507mindmap.json', '20140513070507mindmap.png'),
(37, 1, '20140513070534mindmap.json', '20140513070534mindmap.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project`
--

CREATE TABLE IF NOT EXISTS `tbl_project` (
  `projectId` int(11) NOT NULL AUTO_INCREMENT,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `title` varchar(128) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  `modified` date NOT NULL,
  `status` varchar(64) NOT NULL,
  PRIMARY KEY (`projectId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_project`
--

INSERT INTO `tbl_project` (`projectId`, `start`, `end`, `title`, `description`, `modified`, `status`) VALUES
(1, '1000-01-01', '1000-01-01', 'Test1', 'asdasdasd', '1000-01-01', 'Active'),
(2, '1000-01-01', '1000-01-01', 'test2', 'asdasdasd', '1000-01-01', 'Completed'),
(3, '1000-01-01', '1000-01-01', 'test3', 'asdasdasd', '1000-01-01', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_specification`
--

CREATE TABLE IF NOT EXISTS `tbl_specification` (
  `specificationId` int(11) NOT NULL AUTO_INCREMENT,
  `projectId` int(11) NOT NULL,
  `text` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`specificationId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task`
--

CREATE TABLE IF NOT EXISTS `tbl_task` (
  `taskId` int(11) NOT NULL AUTO_INCREMENT,
  `todoId` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `status` varchar(64) NOT NULL DEFAULT 'false',
  PRIMARY KEY (`taskId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `tbl_task`
--

INSERT INTO `tbl_task` (`taskId`, `todoId`, `title`, `status`) VALUES
(6, 1, '233', 'false'),
(8, 2, 'vasa', 'false'),
(9, 2, 'ngn', 'false'),
(12, 1, 'jghjg', 'true'),
(16, 1, 'ghjgh', 'false'),
(17, 1, 'fghj', 'false'),
(18, 1, 'asdasd', 'true'),
(19, 1, 'asdasd', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_todo`
--

CREATE TABLE IF NOT EXISTS `tbl_todo` (
  `todoId` int(11) NOT NULL AUTO_INCREMENT,
  `projectId` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  PRIMARY KEY (`todoId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_todo`
--

INSERT INTO `tbl_todo` (`todoId`, `projectId`, `title`) VALUES
(1, 1, 'First'),
(2, 2, 'xz'),
(3, 1, 'Test22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `projectId` int(11) DEFAULT NULL,
  `firstname` varchar(128) NOT NULL,
  `lastname` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `usergroup` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `projectId`, `firstname`, `lastname`, `password`, `usergroup`, `email`) VALUES
(1, NULL, 'ТИмя', 'ТФамилия', '1234', 'client', 'tmail@gmail.com'),
(2, NULL, 'ТИмя', 'ТФамилия', '1234', 'client', 'tmail@gmail.com'),
(3, NULL, 'vasa', 'vasa2', '12', 'admin', 'tmail2@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
