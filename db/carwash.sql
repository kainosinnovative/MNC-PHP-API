-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2022 at 11:11 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carwash`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(10) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `dob` date DEFAULT NULL,
  `mobileno` varchar(13) NOT NULL,
  `emailid` varchar(45) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `cartype` varchar(20) NOT NULL,
  `doorno` varchar(25) NOT NULL,
  `street` varchar(25) NOT NULL,
  `city` varchar(15) NOT NULL,
  `state` varchar(20) NOT NULL,
  `zipcode` int(6) NOT NULL,
  `profile_img` varchar(100) NOT NULL,
  `lastupddt` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `firstname`, `lastname`, `dob`, `mobileno`, `emailid`, `gender`, `cartype`, `doorno`, `street`, `city`, `state`, `zipcode`, `profile_img`, `lastupddt`) VALUES
(12, 'vj', '', NULL, '7339528000', 'v@g.com', '', '', '', '', '', '', 0, '', '0000-00-00'),
(13, 'abc', '', NULL, '8940460339', 'a@g.com', '', '', '', '', '', '', 0, '', '0000-00-00'),
(26, 'R Vijaya', 'sankar ', '2022-01-01', '7339528035', 'vijay@gm.com', 'Male', 'Maruthi', '21ss', 'kovil street ss', 'Madurai', 'Telengana', 628822, 'docs/3961fa45ece8a67-798976-downloadjpg.jpg', '2022-02-02');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE `testimonial` (
  `id` int(10) NOT NULL,
  `user_profile` varchar(100) NOT NULL,
  `user_title` varchar(100) NOT NULL,
  `user_description` varchar(100) NOT NULL,
  `user_rating` varchar(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `review_count` varchar(10) NOT NULL,
  `review_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`id`, `user_profile`, `user_title`, `user_description`, `user_rating`, `customer_id`, `review_count`, `review_date`) VALUES
(124, '', '', 'test', '3', 26, '1', '2022-02-01'),
(125, '', '', 'best application', '2', 13, '2', '2022-02-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
