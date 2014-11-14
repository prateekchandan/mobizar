-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 15, 2014 at 12:56 AM
-- Server version: 5.5.40-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shezartc_mobizar`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE IF NOT EXISTS `calendar` (
  `calendarid` int(11) NOT NULL AUTO_INCREMENT,
  `courseid` int(11) NOT NULL,
  `groups` varchar(10000) NOT NULL,
  `userid` int(11) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `sttime` varchar(100) NOT NULL,
  `endtime` varchar(100) NOT NULL,
  PRIMARY KEY (`calendarid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`calendarid`, `courseid`, `groups`, `userid`, `time`, `date`, `sttime`, `endtime`) VALUES
(31, 2, '["2"]', 5, '12:42:00', '2014-06-16', '1402902720000', '1402907520000'),
(35, 4, '["2","4"]', 5, '09:00:00', '2014-06-14', '1402716600000', '1402720200000'),
(36, 5, '["3","4"]', 5, '01:00:00', '2014-06-21', '1403292600000', '1403296260000'),
(37, 1, '["2","4"]', 5, '12:42:00', '2014-06-15', '1402816320000', '1402816920000');

-- --------------------------------------------------------

--
-- Table structure for table `courseattended`
--

CREATE TABLE IF NOT EXISTS `courseattended` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `courseid` int(11) NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `coursesent` datetime DEFAULT NULL,
  `attendedon` datetime DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_course_attended_users1_idx` (`userid`),
  KEY `fk_course_attended_Courses1_idx` (`courseid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `courseid` int(11) NOT NULL AUTO_INCREMENT,
  `createdby` int(11) NOT NULL,
  `coursename` varchar(250) DEFAULT NULL,
  `filetype` varchar(5) DEFAULT NULL,
  `filepath` varchar(255) NOT NULL,
  `courseduration` int(5) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `modifiedon` datetime DEFAULT NULL,
  PRIMARY KEY (`courseid`,`createdby`),
  KEY `fk_Courses_Users1_idx` (`createdby`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`courseid`, `createdby`, `coursename`, `filetype`, `filepath`, `courseduration`, `createdon`, `modifiedon`) VALUES
(1, 5, 'Demo 1', 'pdf', './courses/W1644e26b9c67e906ffa12ba0cf25830.pdf', 10, '2014-06-13 02:11:08', NULL),
(2, 5, 'hello', 'xls', './courses/u87a6147ac6ec30bcb2700e7bdf96a16.xls', 80, '2014-06-13 03:39:15', NULL),
(4, 5, 'new course', 'pdf', './courses/r65264d16f29bd948a2ffd3605b870c1.pdf', 60, '2014-06-13 06:45:17', NULL),
(5, 5, 'jquery', 'xls', './courses/Fd4287c40ea52b71d80a5d626eae562c.xls', 61, '2014-06-13 10:31:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `groupid` int(11) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(250) DEFAULT NULL,
  `createdby` int(11) NOT NULL,
  `createdon` datetime DEFAULT NULL,
  `modifiedon` datetime DEFAULT NULL,
  `students` varchar(10000) NOT NULL DEFAULT '{}',
  PRIMARY KEY (`groupid`,`createdby`),
  KEY `fk_Group_Users1_idx` (`createdby`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`groupid`, `groupname`, `createdby`, `createdon`, `modifiedon`, `students`) VALUES
(2, 'Class 2', 5, '2014-06-11 02:54:03', NULL, '{"3":"10","4":"8"}'),
(3, 'Class 3', 5, '2014-06-11 09:53:47', NULL, '{"3":"9","6":"6","7":"8"}'),
(4, 'class 4', 5, '2014-06-11 09:53:52', NULL, '{"2":"10","3":"8"}'),
(5, 'class1', 5, '2014-06-13 06:49:05', NULL, '{"1":"10","2":"8"}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `firstname` varchar(250) DEFAULT NULL,
  `lastname` varchar(250) DEFAULT NULL,
  `usertype` varchar(20) DEFAULT NULL,
  `organisation` varchar(250) DEFAULT NULL,
  `designation` varchar(250) DEFAULT NULL,
  `phone` int(10) DEFAULT NULL,
  `createdby` int(10) NOT NULL,
  `studentlist` varchar(10000) DEFAULT '{}',
  `grouplist` varchar(5000) NOT NULL DEFAULT '{}',
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `email`, `password`, `firstname`, `lastname`, `usertype`, `organisation`, `designation`, `phone`, `createdby`, `studentlist`, `grouplist`) VALUES
(4, 'ram@iitb', 'ZUVEbjFldVVYTDVCdWI2WHE3R2JlZz09', 'iou oiuo i', 'oiu ouoiu', NULL, 'oiw oioi u', 'oiu oiu', 89808, 0, '{}', '{}'),
(5, 'prateekchandan5545@gmail.com', 'dnNFd29nNnZkdWNEUHJ1blcxMExGZz09', 'Prateek', 'Chandan', 'Instructor', 'IIT Bombay', 'student', 2147483647, 0, '{"2":"8","4":"10"}', '[]'),
(6, 'prateekchandan@iitb.ac.in', 'dnNFd29nNnZkdWNEUHJ1blcxMExGZz09', 'Prateek', 'Chandan', NULL, 'IITB', 'Student', 2147483647, 0, '{}', '{"2":"3"}'),
(7, 'prateekchandan5545@yahoo.com', 'RzJCK2hObkVmZkk3ZE95dWJTR3VNUT09', 'iuoiu', ';o;k;lk', NULL, ';lk;lk;lk;l', ';lk;lk;lk', 809809, 0, '{}', '{}'),
(8, 'shyam@gmail.com', 'bXAyQTN2OTYrNDhxWUVZc3gvOUxHQT09', 'Shyam', 'Sunder', NULL, 'IITB', 'Student', 2147483647, 5, '{}', '{"2":"4","4":"2","5":"5","6":"3"}'),
(9, 'nishant@iit', 'OERXaTIxOCtwZHBsb2tHTkwrSXEwUT09', 'nishant', 'singh', NULL, 'iitb', 'ljlkj', 9809809, 5, '{}', '{"1":"3"}'),
(10, 'hello@gmail.com', 'blltUWZzSldZRVdQSjBGa2tMUVdBZz09', 'honey', 'singh', NULL, 'chut', 'iioi', 779879878, 5, '{}', '{"2":"4","3":"2","4":"5"}'),
(11, 'prateekchandan5545@gmail.co', 'a1RuS3V2bFdkZDZtTmloNDhzNEFmZz09', 'Prateek', 'Prateek Chandan', NULL, 'IITB ', 'Student', 87654321, 0, '{}', '{}'),
(12, 'admin@shezartech.com', 'azB6RkJKZVpuNS9kOXltYm1nTHpsRFV1TVpCSkVtaTA5YWZRb1R6RDl2QT0=', 'shezartech', '', 'Instructor', 'Shezartech', 'admin', 2147483647, 0, '{}', '{}');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courseattended`
--
ALTER TABLE `courseattended`
  ADD CONSTRAINT `fk_course_attended_Courses1` FOREIGN KEY (`courseid`) REFERENCES `courses` (`courseid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_course_attended_users1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `fk_Courses_Users1` FOREIGN KEY (`createdby`) REFERENCES `users` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `group`
--
ALTER TABLE `group`
  ADD CONSTRAINT `fk_Group_Users1` FOREIGN KEY (`createdby`) REFERENCES `users` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
