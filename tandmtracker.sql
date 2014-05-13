-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2014 at 05:44 PM
-- Server version: 5.6.16
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
  PRIMARY KEY (`mindmapId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_mindmap`
--

INSERT INTO `tbl_mindmap` (`mindmapId`, `projectId`, `json`) VALUES
(1, 1, 'dssd'),
(2, 2, 'xddd');

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
(1, '1000-01-01', '1000-01-01', 'Test1', 'asdasdasd', '1000-01-01', 'asdasdasd'),
(2, '1000-01-01', '1000-01-01', 'test2', 'asdasdasd', '1000-01-01', 'asdasdasd'),
(3, '1000-01-01', '1000-01-01', 'test3', 'asdasdasd', '1000-01-01', 'asdasdasd');

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
  `status` varchar(64) NOT NULL,
  PRIMARY KEY (`taskId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_task`
--

INSERT INTO `tbl_task` (`taskId`, `todoId`, `title`, `status`) VALUES
(1, 1, 'ТестовыйПункт', 'active'),
(2, 1, 'ТестовыйПункт2', 'completed');

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
