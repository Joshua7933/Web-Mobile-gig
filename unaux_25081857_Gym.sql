-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql101.byetcluster.com
-- Generation Time: Jan 27, 2020 at 03:43 AM
-- Server version: 5.6.21-69.0
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unaux_25081857_Gym`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) NOT NULL,
  `admin_name` varchar(30) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'Joshua', 'joshkish55gmail.com', 'josh7933'),
(2, 'admin', 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `bookedschedules`
--

CREATE TABLE `bookedschedules` (
  `bschedule_id` int(10) NOT NULL,
  `trainer_id` int(10) NOT NULL,
  `trainer_name` varchar(30) NOT NULL,
  `client_name` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `gym_name` varchar(30) NOT NULL,
  `gym_location` varchar(30) NOT NULL,
  `datebooked` datetime NOT NULL,
  `amount` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookedschedules`
--

INSERT INTO `bookedschedules` (`bschedule_id`, `trainer_id`, `trainer_name`, `client_name`, `date`, `start_time`, `end_time`, `gym_name`, `gym_location`, `datebooked`, `amount`) VALUES
(2, 4, 'Racheal', 'joshua', '2020-01-11', '16:10:00', '17:30:00', 'jlsjcij', 'sjdiljd', '2020-01-24 07:04:11', '500');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(10) NOT NULL,
  `client_fname` varchar(20) NOT NULL,
  `client_lname` varchar(20) NOT NULL,
  `client_email` varchar(50) NOT NULL,
  `client_phone` varchar(20) NOT NULL,
  `client_address` varchar(30) NOT NULL,
  `client_password` varchar(30) NOT NULL,
  `client_gender` varchar(20) NOT NULL,
  `client_profilepic` varchar(50) NOT NULL,
  `date_joined` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `client_fname`, `client_lname`, `client_email`, `client_phone`, `client_address`, `client_password`, `client_gender`, `client_profilepic`, `date_joined`) VALUES
(1, 'joshua', 'kithinji', 'joshkish55@gmail.com', '0796143149', 'Ishiara', 'josh7933', 'male', 'uploads/img_2.jpg', '2020-01-08 22:52:06');

-- --------------------------------------------------------

--
-- Table structure for table `gym`
--

CREATE TABLE `gym` (
  `gym_id` int(10) NOT NULL,
  `gym_name` varchar(30) NOT NULL,
  `gym_location` varchar(30) NOT NULL,
  `gym_image` varchar(40) NOT NULL,
  `gym_contactemail` varchar(50) NOT NULL,
  `gym_contactmobile` varchar(20) NOT NULL,
  `gym_dateadded` datetime NOT NULL,
  `gym_desc` text NOT NULL,
  `gym_services` varchar(250) NOT NULL,
  `amount` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gym`
--

INSERT INTO `gym` (`gym_id`, `gym_name`, `gym_location`, `gym_image`, `gym_contactemail`, `gym_contactmobile`, `gym_dateadded`, `gym_desc`, `gym_services`, `amount`) VALUES
(10, 'Limzo Gym', 'Nairobi', 'uploads/person_4.jpg', 'joshkish55@gmail.com', '0783092484', '2020-01-14 08:45:39', 'Nice', 'Jogging,stretching,Body building,flexibility,', '400'),
(11, 'Binko', 'Kasarani', 'uploads/person_2.jpg', 'stevewonder6310@gmail.com', '0798873762', '2020-01-14 08:47:02', 'Fully equipped', 'Jogging,stretching,Body building,flexibility,', '300'),
(12, 'Munito', 'Thika', 'uploads/img_2.jpg', 'Kellifhhj@gmail.com', '0787847833', '2020-01-14 08:50:59', 'nice', 'Jogging,stretching,Body building,flexibility,', '500'),
(13, 'Pliori', 'Siaya', 'uploads/adhes.jpg', 'adhespliori@gmail.com', '07565678382', '2020-01-18 11:48:43', 'Fully equiped', 'Jogging,stretching,Body building,', '300');

-- --------------------------------------------------------

--
-- Table structure for table `Paid`
--

CREATE TABLE `Paid` (
  `paid_id` int(10) NOT NULL,
  `booked_id` int(10) NOT NULL,
  `trainer_id` int(10) NOT NULL,
  `trainer_name` varchar(30) NOT NULL,
  `client_name` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `gym_name` varchar(30) NOT NULL,
  `gym_location` varchar(30) NOT NULL,
  `amount_paid` int(10) NOT NULL,
  `date_paid` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Paid`
--

INSERT INTO `Paid` (`paid_id`, `booked_id`, `trainer_id`, `trainer_name`, `client_name`, `date`, `start_time`, `end_time`, `gym_name`, `gym_location`, `amount_paid`, `date_paid`) VALUES
(1, 1, 4, '', 'joshua', '2020-01-11', '16:10:00', '17:30:00', 'g_name', 'sjdiljd', 500, '2020-01-24 08:54:06'),
(2, 1, 4, '', 'joshua', '2020-01-11', '16:10:00', '17:30:00', 'g_name', 'sjdiljd', 500, '2020-01-24 08:55:57'),
(3, 1, 4, '', 'joshua', '2020-01-11', '16:10:00', '17:30:00', 'g_name', 'sjdiljd', 500, '2020-01-24 07:46:43'),
(4, 0, 0, '', '', '0000-00-00', '00:00:00', '00:00:00', 'g_name', '', 500, '2020-01-24 07:47:50');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(10) NOT NULL,
  `trainer_id` int(10) NOT NULL,
  `client_fname` varchar(30) NOT NULL,
  `client_lname` varchar(30) NOT NULL,
  `client_profilepic` varchar(30) NOT NULL,
  `review` text NOT NULL,
  `review_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `trainer_id`, `client_fname`, `client_lname`, `client_profilepic`, `review`, `review_date`) VALUES
(1, 4, '1', '', '', 'Nice experience!', '2020-01-10 00:00:00'),
(2, 4, 'Joshua', 'Kithinji', 'uploads/tomatoes.jpg', 'Nice experience', '2020-01-10 00:00:00'),
(3, 5, 'joshua', 'kithinji', 'uploads/img_2.jpg', 'hjhuihuihuiohio', '2020-01-13 11:59:53'),
(4, 5, 'joshua', 'kithinji', 'uploads/img_2.jpg', 'I loved it! it was a nice experience. I would like to have another session with her', '2020-01-13 12:04:38'),
(5, 5, 'joshua', 'kithinji', 'uploads/img_2.jpg', 'Fantastic experience', '2020-01-18 10:43:32'),
(6, 5, 'joshua', 'kithinji', 'uploads/img_2.jpg', 'good', '2020-01-18 10:46:14'),
(7, 5, 'joshua', 'kithinji', 'uploads/img_2.jpg', 'hsfgfuio', '2020-01-18 10:59:33'),
(8, 5, 'joshua', 'kithinji', 'uploads/img_2.jpg', 'jfdiovdfiuh', '2020-01-18 11:00:16'),
(9, 5, 'joshua', 'kithinji', 'uploads/img_2.jpg', 'hhuihu', '2020-01-18 11:00:52'),
(10, 5, 'joshua', 'kithinji', 'uploads/img_2.jpg', 'jkfhkdf', '2020-01-18 11:04:53'),
(11, 5, '', '', '', 'hjkdhashdi', '2020-01-18 11:06:13'),
(12, 5, 'joshua', 'kithinji', 'uploads/img_2.jpg', 'asioasi', '2020-01-18 11:06:35'),
(13, 5, 'joshua', 'kithinji', 'uploads/img_2.jpg', 'sduihsduo', '2020-01-18 11:07:52'),
(14, 5, 'joshua', 'kithinji', 'uploads/img_2.jpg', 'ifdudfh', '2020-01-18 11:08:00'),
(15, 5, 'joshua', 'kithinji', 'uploads/img_2.jpg', 'djhdfjk', '2020-01-18 11:11:25'),
(16, 5, 'joshua', 'kithinji', 'uploads/img_2.jpg', 'gjhgh', '2020-01-18 11:17:30'),
(17, 5, 'joshua', 'kithinji', 'uploads/img_2.jpg', 'jsdjj', '2020-01-18 11:27:26'),
(18, 5, 'joshua', 'kithinji', 'uploads/img_2.jpg', 'ldjiosdj', '2020-01-18 11:29:41'),
(19, 3, 'joshua', 'kithinji', 'uploads/img_2.jpg', 'dkjsdioj', '2020-01-18 11:30:11');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `schedule_id` int(10) NOT NULL,
  `trainer_id` int(10) NOT NULL,
  `trainer_fname` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `gym_name` varchar(30) NOT NULL,
  `gym_location` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `date_added` datetime NOT NULL,
  `amount` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`schedule_id`, `trainer_id`, `trainer_fname`, `date`, `start_time`, `end_time`, `gym_name`, `gym_location`, `status`, `date_added`, `amount`) VALUES
(2, 4, '', '2020-01-11', '16:10:00', '19:30:00', 'jlsjcij', 'sjdiljd', 'booked', '2020-01-11 16:10:45', ''),
(3, 4, 'Racheal', '2020-01-11', '16:10:00', '17:30:00', 'jlsjcij', 'sjdiljd', 'booked', '2020-01-14 00:00:00', '500'),
(4, 3, 'joshua', '2020-01-23', '16:00:00', '17:00:00', 'Limzo Gym', 'Nairobi', 'unbooked', '2020-01-18 11:45:30', '200'),
(5, 3, 'joshua', '2020-01-22', '18:00:00', '19:30:00', 'Limzo Gym', 'Nairobi', 'unbooked', '2020-01-18 13:12:15', '600'),
(6, 6, 'joshua', '2020-11-03', '12:59:00', '14:59:00', 'Binko', 'Kasarani', 'unbooked', '2020-01-24 06:57:51', '800');

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `trainer_id` int(10) NOT NULL,
  `trainer_fname` varchar(30) NOT NULL,
  `trainer_lname` varchar(30) NOT NULL,
  `trainer_pass` varchar(10) NOT NULL,
  `trainer_email` varchar(30) NOT NULL,
  `trainer_phone` varchar(15) NOT NULL,
  `trainer_address` varchar(30) NOT NULL,
  `trainer_profilepic` varchar(50) NOT NULL,
  `trainer_gender` varchar(30) NOT NULL,
  `trainer_shortdesc` text NOT NULL,
  `date_joined` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`trainer_id`, `trainer_fname`, `trainer_lname`, `trainer_pass`, `trainer_email`, `trainer_phone`, `trainer_address`, `trainer_profilepic`, `trainer_gender`, `trainer_shortdesc`, `date_joined`) VALUES
(3, 'joshua', 'kithinji', 'josh7933', 'joshkish55@gmail.com', '0796143149', 'Ishiara', 'uploads/img_5.jpg', 'male', 'jdfljiosdj', '2020-01-07 12:36:04'),
(4, 'Racheal', 'Ngendo', 'josh7933', 'raych@gmail.com', '0725855691', 'Ishiara kamutu', '../uploads/person_3.jpg', 'female', '', '2020-01-08 20:55:50'),
(5, 'Kelvin', 'Mwenda', 'josh7933', 'kelvinmwenda@gmail.com', '0797436764', 'Isiolo', '../uploads/img_2.jpg', 'male', 'Passonate', '2020-01-08 22:46:45'),
(6, 'joshua', 'kithinji', 'josh7933', 'joshkish55@gmail.com', '4719443593', 'N/A', 'trainer/uploads/user.png', 'male', 'kljckljkldjc', '2020-01-24 03:31:23'),
(7, 'Kusj', 'kithinji', 'josh7933', 'kisyd@gmail.com', '4719443593', 'N/A', 'trainer/uploads/download.png', 'male', 'hsdukhaduio', '2020-01-24 03:41:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `bookedschedules`
--
ALTER TABLE `bookedschedules`
  ADD PRIMARY KEY (`bschedule_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `gym`
--
ALTER TABLE `gym`
  ADD PRIMARY KEY (`gym_id`);

--
-- Indexes for table `Paid`
--
ALTER TABLE `Paid`
  ADD PRIMARY KEY (`paid_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`trainer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookedschedules`
--
ALTER TABLE `bookedschedules`
  MODIFY `bschedule_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gym`
--
ALTER TABLE `gym`
  MODIFY `gym_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `Paid`
--
ALTER TABLE `Paid`
  MODIFY `paid_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedule_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `trainer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
