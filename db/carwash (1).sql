-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2022 at 01:04 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

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
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand_name`) VALUES
(1, 'Toyota'),
(2, 'Datsun');

-- --------------------------------------------------------

--
-- Table structure for table `car_type`
--

CREATE TABLE `car_type` (
  `id` int(11) NOT NULL,
  `type_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car_type`
--

INSERT INTO `car_type` (`id`, `type_name`) VALUES
(1, 'SUV'),
(2, 'HatchBack'),
(3, 'Sedan');

-- --------------------------------------------------------

--
-- Table structure for table `city_list`
--

CREATE TABLE `city_list` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city_list`
--

INSERT INTO `city_list` (`city_id`, `city_name`) VALUES
(1, 'Chennai'),
(2, 'Bangalore'),
(3, 'Arakkonam'),
(4, 'Chengalpattu'),
(5, 'Coimbatore'),
(6, 'Kanchipuram'),
(7, 'Tiruvallur'),
(8, 'Viluppuram'),
(12, 'Madurai'),
(13, 'Maduranthakam'),
(14, 'Cuddalore'),
(15, 'Puducherry'),
(24, 'ranipet'),
(25, 'namakkal');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `contact_id` int(10) NOT NULL,
  `name` varchar(45) NOT NULL,
  `emailid` varchar(10) NOT NULL,
  `mobileno` varchar(10) NOT NULL,
  `message` int(100) NOT NULL,
  `lastupddt` date NOT NULL,
  `user_role` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `cartype` int(2) DEFAULT NULL,
  `brand` int(2) DEFAULT NULL,
  `model` int(2) DEFAULT NULL,
  `fueltype` varchar(10) NOT NULL,
  `color` varchar(25) NOT NULL,
  `doorno` varchar(25) NOT NULL,
  `street` varchar(25) NOT NULL,
  `city` int(3) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `zipcode` int(6) DEFAULT NULL,
  `profile_img` varchar(100) NOT NULL,
  `lastupddt` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `firstname`, `lastname`, `dob`, `mobileno`, `emailid`, `gender`, `cartype`, `brand`, `model`, `fueltype`, `color`, `doorno`, `street`, `city`, `state`, `zipcode`, `profile_img`, `lastupddt`) VALUES
(12, 'vj', '', NULL, '7339528000', 'v@g.com', '', 0, 0, 0, '', '', '', '', 0, '', 0, '', '0000-00-00'),
(13, 'abc', '', NULL, '8940460310', 'a@g.com', '', 0, 0, 0, '', '', '', '', 0, '', 0, '', '0000-00-00'),
(26, 'R Vijaya', 'Sankar ', '2022-01-01', '7339528011', 'vijay@gm.com', 'Male', 0, 0, 0, '', '', '21ss', 'kovil street ss', 0, 'Telengana', 628822, 'docs/14661fa5fa9f3f26-817080-downloadpng.png', '2022-02-02'),
(30, 'Vijaya sankar', '', NULL, '7339528000', 'l@g.com', '', 0, 0, 0, '', '', '', '', 0, '', 0, '', '2022-02-02'),
(31, 'Vijaya sankar', 'R', '2022-01-12', '9994616327', 'vg@g.com', 'Male', 0, 0, 0, '', '', '40', 'west street', 0, 'TamilNadu', 628811, 'docs/9462035453dbf0c-301977-istockphotojpg.jpg', '2022-02-02'),
(32, 'sundaram', '', NULL, '9894354613', 'ss@gmail.com', '', 0, 0, 0, '', '', '', '', 0, '', 0, '', '2022-02-03'),
(34, 'Selvi', '', NULL, '6382841799', 'abhianand.j2k@gmail.com', '', NULL, 0, 0, '', '', '', '', 1, '', 0, '', '2022-02-10'),
(36, 'abhi', '', NULL, '6385815161', 'abhianand.j2k@gmail.com', '', NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, '', '2022-02-10');

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `id` int(11) NOT NULL,
  `brand_id` int(3) NOT NULL,
  `model_name` varchar(50) NOT NULL,
  `car_type_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`id`, `brand_id`, `model_name`, `car_type_id`) VALUES
(1, 1, 'Toyota Glanza', 2),
(2, 1, 'Toyota Fortuner', 1),
(3, 1, 'Toyota Camry', 3),
(4, 2, 'Datsun redi-GO', 2),
(5, 2, 'Datsun Go Plus', 1);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(3) NOT NULL,
  `service_name` varchar(150) NOT NULL,
  `lastupddt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `lastupddt`) VALUES
(1, 'Battery', NULL),
(2, 'Belt and Hoses', NULL),
(3, 'Brakes', NULL),
(4, 'Charging and Starting System', NULL),
(5, 'Cooling', NULL),
(6, 'CV Joints and Boots', NULL),
(7, 'Emissions System', NULL),
(8, 'Filters', NULL),
(9, 'Exhaust Systems', NULL),
(10, 'Fluids', NULL),
(11, 'Wheel Alignment, Wheel Tyres ,Wheel Wells', NULL),
(12, 'Wipers', NULL),
(13, 'Engine Cleaning', NULL),
(14, 'Roof and Doors Cleaning', NULL),
(15, 'Mirrors Cleaning', NULL),
(16, 'Emblems and License Plates', NULL),
(17, 'Vacuuming', NULL),
(18, 'Washing Upholstery', NULL),
(19, 'Clean Leather-Covered Elements', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shopinfo`
--

CREATE TABLE `shopinfo` (
  `shop_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `mobileno` varchar(15) NOT NULL,
  `emailid` varchar(45) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date DEFAULT NULL,
  `aadharno` varchar(15) DEFAULT NULL,
  `doorno` varchar(10) NOT NULL,
  `street` varchar(45) NOT NULL,
  `city` varchar(15) DEFAULT NULL,
  `state` varchar(25) DEFAULT NULL,
  `zipcode` int(6) DEFAULT NULL,
  `shop_image` varchar(100) NOT NULL,
  `lastupddt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shopinfo`
--

INSERT INTO `shopinfo` (`shop_id`, `name`, `firstname`, `lastname`, `mobileno`, `emailid`, `gender`, `dob`, `aadharno`, `doorno`, `street`, `city`, `state`, `zipcode`, `shop_image`, `lastupddt`) VALUES
(1, 'abc carwash', 'muthu', 'kumar', '9994616327', 'abc@g.com', 'Male', '2022-02-24', '2234 5678 9456', 'streetno', 'south street', '3', '1', 600089, 'docs/506203a12aaa69a-194343-coffeeshopjpg.jpg', '2022-02-09');

-- --------------------------------------------------------

--
-- Table structure for table `shop_service`
--

CREATE TABLE `shop_service` (
  `service_id` int(10) NOT NULL,
  `shop_id` int(10) NOT NULL,
  `actual_amount` varchar(10) NOT NULL,
  `offer_percent` varchar(10) NOT NULL,
  `offer_price` int(10) NOT NULL,
  `lastupddt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shop_service`
--

INSERT INTO `shop_service` (`service_id`, `shop_id`, `actual_amount`, `offer_percent`, `offer_price`, `lastupddt`) VALUES
(4, 1, '1200', '', 0, '2022-02-09'),
(1, 1, '1200', '', 0, '2022-02-09'),
(6, 1, '1', '', 0, '2022-02-09'),
(9, 1, '1', '', 0, '2022-02-09'),
(8, 1, '1', '', 0, '2022-02-09'),
(7, 1, '12', '', 0, '2022-02-09'),
(2, 1, '300', '', 0, '2022-02-09'),
(3, 1, '600', '', 0, '2022-02-09'),
(19, 1, '458', '', 0, '2022-02-09');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `state_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `name`) VALUES
(1, 'TamilNadu'),
(2, 'Karnataka');

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
(125, '', '', 'best application', '2', 13, '2', '2022-02-01'),
(126, '', '', 'good to view', '5', 31, '2', '2022-02-07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_type`
--
ALTER TABLE `car_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city_list`
--
ALTER TABLE `city_list`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `shopinfo`
--
ALTER TABLE `shopinfo`
  ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `car_type`
--
ALTER TABLE `car_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `city_list`
--
ALTER TABLE `city_list`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `contact_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `shopinfo`
--
ALTER TABLE `shopinfo`
  MODIFY `shop_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
