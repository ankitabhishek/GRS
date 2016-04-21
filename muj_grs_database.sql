-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 21, 2016 at 11:17 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `muj_complain`
--
CREATE DATABASE IF NOT EXISTS `muj_complain` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `muj_complain`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `level` varchar(20) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `complains`
--

CREATE TABLE IF NOT EXISTS `complains` (
  `complain_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `complain_text` varchar(8000) NOT NULL,
  `complain_date` datetime NOT NULL,
  PRIMARY KEY (`complain_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `complains`
--

INSERT INTO `complains` (`complain_id`, `user_id`, `category`, `complain_text`, `complain_date`) VALUES
(1, 1, 'IT Infrastructure', 'bad wifi. very bad wifi. :(', '2015-08-17 22:06:47'),
(2, 1, 'Others', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2015-08-17 22:23:44'),
(3, 1, 'IT Infrastructure', 'csdvsdvbsdbsdbv', '2015-08-18 01:25:25'),
(4, 1, 'Others', 'vsdbbbbbbbbbbbbbbbb', '2015-08-18 01:25:32'),
(5, 1, 'Others', 'asfasfaf', '2015-08-18 02:00:31'),
(6, 1, 'Others', 'sdfsdfsdf', '2015-08-18 02:00:35'),
(7, 1, 'Others', 'sdfsdfsd', '2015-08-18 02:00:38'),
(8, 1, 'Others', 'vdsbdb', '2015-08-18 02:01:50'),
(9, 1, 'Others', 'iohroew hwgvi egi edgihedighedwgh iedghiwehg oewhiewg', '2015-08-18 02:01:58'),
(10, 1, 'Others', 'fsdsdg sd dsgsd sdgsdg sdg', '2015-08-18 02:02:02'),
(11, 1, 'Others', 'dsgsdgsdg sdgsdgdsgsg sdgsdg sdgsdgsd', '2015-08-18 02:02:07'),
(12, 1, 'Academics', 'vjhvjuvcv hjv jhkkvcjhvcvvnh bhvjjvvhjjhyvf.', '2015-08-18 02:30:49'),
(13, 1, 'Mess Food', 'sakcb s vas vcasksa asknasllas.', '2015-08-18 02:31:33'),
(14, 1, 'IT Infrastructure', 'mkmkkkkkk m nln;l;', '2015-08-18 23:45:05'),
(15, 1, 'IT Infrastructure', 'fhfkh k gkgkhk', '2015-08-20 15:57:26'),
(16, 1, 'IT Infrastructure', 'dsydhfykxff gjhytghjk jg', '2015-08-20 16:06:40'),
(17, 1, 'IT Infrastructure', 'hhlhjio', '2015-08-20 16:08:18'),
(18, 1, 'Others', 'saca', '2015-08-20 16:12:42'),
(19, 1, 'Academics', 'hgyjuytgh', '2015-08-24 16:35:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `reg_no` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `mob_no` varchar(10) NOT NULL,
  `reg_date` datetime NOT NULL,
  `last_login` varchar(20) DEFAULT NULL,
  `last_ip` int(20) NOT NULL,
  `pass_decrypted` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `reg_no`, `email`, `pass`, `mob_no`, `reg_date`, `last_login`, `last_ip`, `pass_decrypted`) VALUES
(1, 'Ankit', 'Abhishek', '111110000', 'ankitabhishek@manipal', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', '8888889999', '2015-08-17 19:46:18', NULL, 0, 'asdfghjkl');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
