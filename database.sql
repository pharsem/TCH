-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 02, 2014 at 09:59 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `database`
--
CREATE DATABASE IF NOT EXISTS `database` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `database`;

-- --------------------------------------------------------

--
-- Table structure for table `bed`
--

CREATE TABLE IF NOT EXISTS `bed` (
  `bed_number` varchar(255) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `room_id` varchar(255) NOT NULL,
  PRIMARY KEY (`bed_number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bed`
--

INSERT INTO `bed` (`bed_number`, `patient_id`, `room_id`) VALUES
('110A', 2, '110'),
('205B', 1, '205');

-- --------------------------------------------------------

--
-- Table structure for table `bed_status`
--

CREATE TABLE IF NOT EXISTS `bed_status` (
  `room_id` varchar(255) NOT NULL,
  `bed_number` varchar(255) NOT NULL,
  `in_use` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bed_status`
--

INSERT INTO `bed_status` (`room_id`, `bed_number`, `in_use`) VALUES
('110', 'A', 1),
('110', 'B', 0),
('202', 'A', 0),
('203', 'A', 0),
('203', 'B', 0),
('205', 'A', 0),
('205', 'B', 1),
('207', 'A', 0),
('207', 'B', 0),
('207', 'C', 0),
('210', 'A', 0),
('210', 'B', 0),
('301', 'A', 0),
('302', 'A', 0),
('305', 'A', 0),
('305', 'B', 0);

-- --------------------------------------------------------

--
-- Table structure for table `health_cover_details`
--

CREATE TABLE IF NOT EXISTS `health_cover_details` (
  `patient_id` int(11) NOT NULL,
  `medicare_member` tinyint(1) NOT NULL DEFAULT '0',
  `medicare_card_number` varchar(255) DEFAULT NULL,
  `private_health_insurance` tinyint(1) DEFAULT '0',
  `private_health_provider` varchar(255) DEFAULT NULL,
  `phi_contribution` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `health_cover_details`
--

INSERT INTO `health_cover_details` (`patient_id`, `medicare_member`, `medicare_card_number`, `private_health_insurance`, `private_health_provider`, `phi_contribution`) VALUES
(1, 1, '2130 0193 0392 0193', 1, 'AHM', NULL),
(2, 1, '1000 3294 1830 0200', 0, NULL, NULL),
(3, 0, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login_log`
--

CREATE TABLE IF NOT EXISTS `login_log` (
  `username` varchar(50) NOT NULL,
  `datestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`username`,`datestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_log`
--

INSERT INTO `login_log` (`username`, `datestamp`) VALUES
('admin', '2014-05-20 13:30:56'),
('admin', '2014-05-27 05:19:52'),
('admin', '2014-05-27 10:25:56'),
('admin', '2014-05-27 12:26:20'),
('admin', '2014-05-27 12:39:36'),
('admin', '2014-06-02 13:44:19'),
('admin', '2014-06-02 16:01:07'),
('admin', '2014-06-03 00:17:50'),
('admin', '2014-06-03 05:00:50'),
('admin', '2014-06-03 05:35:18'),
('admin', '2014-06-03 07:36:45'),
('j.peters', '2014-05-27 12:34:49'),
('j.peters', '2014-06-02 16:50:18'),
('j.smithers', '2014-06-02 16:01:49'),
('l.cuddy', '2014-06-03 05:33:18'),
('l.cuddy', '2014-06-03 05:38:38'),
('p.harsem', '2014-05-27 06:23:21'),
('p.harsem', '2014-05-27 11:02:29'),
('p.harsem', '2014-05-27 12:25:26'),
('p.harsem', '2014-05-27 12:30:27'),
('p.harsem', '2014-05-27 12:36:21'),
('p.harsem', '2014-06-02 13:52:28'),
('p.harsem', '2014-06-02 14:45:40'),
('p.harsem', '2014-06-02 14:48:37'),
('p.harsem', '2014-06-03 00:18:15'),
('p.harsem', '2014-06-03 05:51:37'),
('p.harsem', '2014-06-03 07:37:27'),
('p.harsem', '2014-06-03 07:49:47');

-- --------------------------------------------------------

--
-- Table structure for table `patient_billing`
--

CREATE TABLE IF NOT EXISTS `patient_billing` (
  `patient_ID` int(11) NOT NULL,
  `bill_number` int(11) NOT NULL,
  `med_procedure` varchar(255) NOT NULL,
  `cost` int(11) DEFAULT NULL,
  `paid` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient_billing`
--

INSERT INTO `patient_billing` (`patient_ID`, `bill_number`, `med_procedure`, `cost`, `paid`) VALUES
(4, 0, 'Minor Surgery', 1000, 0),
(4, 0, 'Major Surgery', 10000, 0),
(4, 0, 'Major Surgery', 10000, 0),
(4, 0, 'CT-Scan', 750, 0);

-- --------------------------------------------------------

--
-- Table structure for table `patient_details`
--

CREATE TABLE IF NOT EXISTS `patient_details` (
  `patient_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `dob` varchar(10) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `emergency_contact` varchar(255) NOT NULL,
  `emergency_contact_number` int(11) NOT NULL,
  `invoice_owing` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `patient_id` (`patient_id`),
  KEY `patient_id_2` (`patient_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `patient_details`
--

INSERT INTO `patient_details` (`patient_id`, `first_name`, `surname`, `dob`, `nationality`, `gender`, `contact_number`, `address`, `emergency_contact`, `emergency_contact_number`, `invoice_owing`) VALUES
(1, 'Stephen', 'Droder', '2006-05-02', 'Australian', 'Male', '+61731110000', '24 Main Street, Townsville', 'Anne Droder', 400000000, 0),
(2, 'Stephanie', 'Peterson', '2001-08-15', 'Australian', 'Female', '+61732291234', '2 Gregory Street, Townsville 4810', 'John Peterson', 401000111, 0),
(3, 'Adam', 'Brown', '2004-05-22', 'New Zealander', 'Male', '+61412123789', '16 Dean Street, Townsville 4810', 'Michelle Brown', 431567492, 0),
(4, 'jane', 'doe', '2006-05-02', 'Australian', 'Female', '+61400111222', '123 fake st', 'janet doe', 411111111, 0),
(5, 'Jake', 'Jackson', '2008-07-11', 'Australian', 'Male', '0215478654', '2 Park St, Townsville', 'Joe Jackson', 215478655, 0),
(7, 'Thomas', 'Kirke', '1990-09-26', 'New Zealander', 'Male', '0452227497', '4 Sandy Cove Place', 'Mike Kirke', 0, 0),
(8, 'Ben', 'Thompson', '1955-02-17', '', 'Male', '320403302', '4 Sandy Cove Place', 'Garth Thompson', 320403302, 0),
(9, 'James', 'Petterson', '1975-03-17', 'Australian', 'Male', '9234801', '4 Sandy Cove Place', 'Jasmine Scott', 98561395, 0),
(10, 'Emily', 'Hernandez', '12/05/1997', 'Spanish', 'Female', '+61433185243', '15 Kate Road, Brisbane', 'Pedro Hernandez 0414999928', 0, 0),
(11, 'Edward', 'Cox', '11/09/2003', 'Australian', 'Male', '+61745628542', '76 Main Road, Bundaberg', 'Jane Cox 0749862839', 0, 0),
(12, 'Christine', 'Jenkins', '06/02/2007', 'Australian', 'Female', '+61745629231', '231 Muller Road, Townsville', 'Peter Jenkins 0423856142', 0, 0),
(13, 'Earl', 'Moore', '17/11/2005', 'Canadian', 'Male', '+61488723635', '86 Petersham Street, Townsville', 'Steve Moore 0411926497', 0, 0),
(14, 'Rose', 'Simmons', '08/03/1999', 'Australian', 'Female', '+61739850253', '27 Augustine Avenue, Townsville', 'Paul Simmons 0416082211', 0, 0),
(15, 'Ken', 'Alexander', '13/08/2010', 'Australian', 'Male', '+61759274097', '929 Paulson Terrace, Townsville', 'Emily Alexander 0418408284', 0, 0),
(16, 'Angela', 'Bennett', '03/01/2003', 'Australian', 'Female', '+61492979264', '77 North Road, Biloela', 'Ken Bennett 0467829174', 0, 0),
(17, 'Gregory', 'Walker', '07/02/2005', 'Australian', 'Male', '+61754903972', '5 Jobson Parade, Townsville', 'Pauline Walker 0491046168', 0, 0),
(18, 'William', 'Foster', '31/03/2011', 'English', 'Male', '+61745670946', '49 Station Road, Cairns', 'Helen Foster 04298608750', 0, 0),
(19, 'Mark', 'Price', '16/03/2003', 'Australian', 'Male', '+61457000939', '987 Grace Road, Townsville', 'Jenny Price-Davies 0754633709', 0, 0),
(20, 'Nicole', 'Hill', '08/05/2004', 'Australian', 'Female', '+61420326828', '98 Rue Avenue, Perth', 'Glenn Hill 0457208467', 0, 0),
(21, 'Teresa', 'Gray', '11/07/2006', 'Australian', 'Female', '+61730947254', '34 Jasmine Street, Kallangur', 'Adrian Gray 0457308557', 0, 0),
(22, 'Gary', 'Coleman', '09/03/2009', 'Australian', 'Male', '+61420309283', '68 James Street, Townsville', 'Rose Coleman 0752463927', 0, 0),
(23, 'Justin', 'Diaz', '14/09/2003', 'Australian', 'Male', '+61429309276', '62 Jones Road, Townsville', 'Ange Diaz 0410480454', 0, 0),
(24, 'Bruce', 'Washington', '09/02/2010', 'American', 'Male', '+61409290649', '77 Countess Street, Townsville', 'Garth Washington 0496138650', 0, 0),
(25, 'Terry', 'Richardson', '17/03/2011', 'Australian', 'Male', '+61434497568', '14 Ace Road, Townsville', 'Gavin Richardson 0458091658', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `patient_history`
--

CREATE TABLE IF NOT EXISTS `patient_history` (
  `entry_id` int(20) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `doctor` varchar(255) DEFAULT NULL,
  `date_admitted` varchar(50) NOT NULL,
  `date_discharged` varchar(50) NOT NULL,
  `conditionn` varchar(255) NOT NULL,
  `surgeries` varchar(255) DEFAULT NULL,
  `doctors_notes` varchar(255) DEFAULT NULL,
  `nurses_notes` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`entry_id`),
  UNIQUE KEY `entry_id` (`entry_id`),
  KEY `patient_id` (`patient_id`),
  KEY `date_admitted` (`date_admitted`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `patient_history`
--

INSERT INTO `patient_history` (`entry_id`, `patient_id`, `doctor`, `date_admitted`, `date_discharged`, `conditionn`, `surgeries`, `doctors_notes`, `nurses_notes`) VALUES
(1, 5, 'j.franklin', '2013-12-21 00:00:00', '2013-12-23 00:00:00', 'Broken left arm', 'Surgery to correct broken left arm', 'Requested patient to refrain from contact sport', 'Pain killers given for the patient to use if the pain gets too bad'),
(15, 5, 'p.harsem', '123123-03-21T12:23', '123123-03-12T12:03', '', '', '', ''),
(16, 4, 'p.harsem', '', '', 'critical', 'heart', 'Really bad', ''),
(17, 4, 't.kirke', '', '', 'ok', 'none', 'Patient is in a stable condition.', '');

-- --------------------------------------------------------

--
-- Table structure for table `patient_status`
--

CREATE TABLE IF NOT EXISTS `patient_status` (
  `patient_id` int(11) NOT NULL,
  `doctor_id` varchar(255) NOT NULL,
  `date_admitted` datetime NOT NULL,
  `condition` varchar(255) DEFAULT NULL,
  `symptoms` varchar(255) NOT NULL,
  `doctors_notes` varchar(255) DEFAULT NULL,
  `nurses_notes` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient_status`
--

INSERT INTO `patient_status` (`patient_id`, `doctor_id`, `date_admitted`, `condition`, `symptoms`, `doctors_notes`, `nurses_notes`) VALUES
(1, 'QHE0000014', '2014-01-02 00:00:00', 'Metal plate removal', 'n/a', NULL, NULL),
(2, 'QHE0000001', '2014-04-05 00:00:00', 'unknown', 'sore throat', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `procedure_details`
--

CREATE TABLE IF NOT EXISTS `procedure_details` (
  `procedure_id` int(11) NOT NULL,
  `procedure_name` varchar(255) NOT NULL,
  `Cost` int(11) NOT NULL,
  PRIMARY KEY (`procedure_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `procedure_details`
--

INSERT INTO `procedure_details` (`procedure_id`, `procedure_name`, `Cost`) VALUES
(1, 'Stitches', 1000),
(2, 'Surgery', 5000),
(3, 'Chemotherapy', 10000),
(4, 'Injection', 500),
(5, 'CT-Scan', 750);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `room_id` varchar(255) NOT NULL,
  `beds_available` int(11) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `special_capabilities` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `beds_available`, `location`, `special_capabilities`) VALUES
('110', 2, 'Level 1, East', 'Curtain divider in room'),
('202', 1, 'Level 2, West', NULL),
('203', 2, 'Level 2, West', NULL),
('205', 2, 'Level 2, East', 'Curtain divider in room'),
('207', 3, 'Level 2, East', 'Curtain divider in room'),
('210', 2, 'Level 2, East', NULL),
('301', 1, 'Level 3, North', NULL),
('302', 1, 'Level 3, North', NULL),
('305', 2, 'Level 3, West', 'Curtain divider in room');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `first_name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL DEFAULT '',
  `access_level` int(11) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(255) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`first_name`, `surname`, `role`, `username`, `access_level`, `password`, `email`, `phone`) VALUES
('Joseph', 'Franklin', 'Doctor', 'j.franklin', 2, '$2y$10$3q9r7dn/P4sy2kXxXruJJufjatOGLobt21s1lI0/n7euD5vyp/s8G', 'j.franklin@tch.com.au', 402158973),
('Admin', 'Istrator', 'System admin', 'admin', 1, '$2y$10$u8YXrLyZhFmn3qILjd/n8uvs/pGe1bhPQnJAzEzLZCkdzPSrx5lGS', 'admin@tch.com.au', 402158972),
('Luke', 'Preedy', 'System admin', 'l.preedy', 1, '$2y$10$3FIvkiPXn.Y4IirQ1GorKOw1YUdK0Puij6Hw1Kao0DcPWPS.b5.Xy', 'l.preedy@tch.com.au', 402158979),
('Petter', 'Harsem', 'Doctor', 'p.harsem', 2, '$2y$10$kJl2BwWnqIYWmwpoFDw/XusZIDa6lEzBz4XJxpHJ3uxX0EHHNuRt.', 'p.harsem@tch.com.au', 402158976),
('Thomas', 'Kirke', 'Doctor', 't.kirke', 2, '$2y$10$CmCfVJGIV0p8rfimJ/vbqu5zg4PiQ23.KaypQlkPPDNRryBQEeuMW', 't.kirke@tch.com.au', 402158978),
('John', 'Peters', 'Nurse', 'j.peters', 3, '$2y$10$C/ci.bPz7Gtq..oFskQQ4OcD.1PrhhQx8ZOOskoTeSVzCrkyxr73m', 'j.peters@tch.com.au', 402158977),
('Bonnie', 'Tushi', 'Doctor', 'b.tushi', 2, '$2y$10$KFw416aIjV62TBKC2wvk3ObxiyyDrwEKWCkx8LVO4sm0Z7wSaVca2', '', 0),
('Jade', 'Smithers', 'Receptionist', 'j.smithers', 4, '$2y$10$1zizdn2daIkth8XWi2E5IuEgcGNROzRkXGU2PBFqf72oAWj/FUDUe', '', 0),
('Lisa', 'Cuddy', 'Hospital Admin', 'l.cuddy', 0, '$2y$10$iV94cy0rGsUK5mvscaMSHuytJ5oICDZtbwdrYG8fHMZtnx/oAzZrC', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `surgery`
--

CREATE TABLE IF NOT EXISTS `surgery` (
  `surgery_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) DEFAULT NULL,
  `condition` varchar(255) DEFAULT NULL,
  `surgery_date` date DEFAULT NULL,
  `surgery_start` time DEFAULT NULL,
  `surgery_end` time DEFAULT NULL,
  `doctor_id` varchar(255) DEFAULT NULL,
  `type_of_surgery` varchar(255) DEFAULT NULL,
  `equipment` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `room` int(11) DEFAULT NULL,
  `doctors_notes` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`surgery_id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `testing_completed`
--

CREATE TABLE IF NOT EXISTS `testing_completed` (
  `test_id` varchar(255) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` varchar(255) NOT NULL,
  `results` varchar(255) NOT NULL,
  `date_completed` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `testing_completed`
--

INSERT INTO `testing_completed` (`test_id`, `patient_id`, `doctor_id`, `results`, `date_completed`) VALUES
('bloodtest', 2, 'QHE0000001', 'inconclusive', '2014-04-06 00:00:00'),
('xray', 3, 'QHE0000014', 'n/a', '2014-04-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `testing_ordered`
--

CREATE TABLE IF NOT EXISTS `testing_ordered` (
  `test_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `doctor_id` varchar(255) NOT NULL,
  `conditionn` varchar(255) DEFAULT NULL,
  `tests_ordered` varchar(255) DEFAULT NULL,
  `doctors_orders` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`test_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `testing_ordered`
--

INSERT INTO `testing_ordered` (`test_id`, `patient_id`, `doctor_id`, `conditionn`, `tests_ordered`, `doctors_orders`) VALUES
(1, 3, 'QHE0000014', 'unknown', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `testing_request`
--

CREATE TABLE IF NOT EXISTS `testing_request` (
  `patient_ID` int(11) NOT NULL,
  `test_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `test_type` varchar(255) NOT NULL,
  `assign_to` varchar(255) DEFAULT NULL,
  `doctors_notes` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `testing_request`
--

INSERT INTO `testing_request` (`patient_ID`, `test_date`, `start_time`, `end_time`, `test_type`, `assign_to`, `doctors_notes`) VALUES
(5, '0000-00-00', '12:23:00', '12:40:00', 'Blood', 'Nurse', 'sdfsdf'),
(5, '1970-01-03', '12:23:00', '12:40:00', 'Blood', 'Nurse', 'sdfsdf'),
(5, '1970-01-01', '12:00:00', '12:30:00', 'X-ray', 'Medical technician', 'yo'),
(5, '2014-06-03', '12:00:00', '12:30:00', 'X-ray', 'Medical technician', 'yo');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
