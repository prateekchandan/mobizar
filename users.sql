-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 14, 2014 at 03:02 PM
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
