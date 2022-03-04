-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2022 at 12:36 PM
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
-- Table structure for table `booking_status`
--

CREATE TABLE `booking_status` (
  `id` int(10) NOT NULL,
  `Booking_id` varchar(20) NOT NULL,
  `booked_status` varchar(20) NOT NULL,
  `carwash_status` int(20) NOT NULL,
  `lastup_bookstatus_date` date DEFAULT NULL,
  `lastup_carwashstatus_date` date DEFAULT NULL,
  `pickedAndDrop_status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_status`
--

INSERT INTO `booking_status` (`id`, `Booking_id`, `booked_status`, `carwash_status`, `lastup_bookstatus_date`, `lastup_carwashstatus_date`, `pickedAndDrop_status`) VALUES
(15, '880512-4', 'Rejected', 0, '2022-03-04', NULL, ''),
(16, '996099-3', 'Accepted', 0, '2022-03-04', NULL, 'Today, please drop your car'),
(17, '114443-4', 'Accepted', 0, '2022-03-04', NULL, 'Today, Our employee will pick your car at your door step');

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
-- Table structure for table `combo_offers`
--

CREATE TABLE `combo_offers` (
  `offer_id` int(20) NOT NULL,
  `services` varchar(45) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `shop_id` int(10) NOT NULL,
  `combo_price` decimal(10,0) NOT NULL,
  `offer_percent` decimal(10,0) NOT NULL,
  `model_id` int(10) NOT NULL,
  `original_amount` varchar(10) NOT NULL,
  `lastupddt` date NOT NULL,
  `offer_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `combo_offers`
--

INSERT INTO `combo_offers` (`offer_id`, `services`, `start_date`, `end_date`, `shop_id`, `combo_price`, `offer_percent`, `model_id`, `original_amount`, `lastupddt`, `offer_name`) VALUES
(28, '7,3,9', '2022-02-16', '2022-03-31', 4, '244', '5', 2, '257', '2022-02-16', 'Classic'),
(29, '7,9', '2022-02-16', '2022-02-25', 4, '77', '54', 2, '168', '2022-02-16', 'SuperPremium'),
(30, '3,7', '2022-02-17', '2022-02-25', 4, '134', '20', 2, '167', '2022-02-17', 'Basic'),
(31, '5,8', '2022-02-17', '2022-02-20', 4, '356', '10', 6, '396', '2022-02-17', ''),
(32, '7', '2022-02-01', '2022-02-25', 2, '560', '20', 6, '700', '2022-02-17', ''),
(33, '1,3', '2022-02-07', '2022-02-26', 3, '425', '15', 1, '500', '2022-02-17', ''),
(34, '1,3', '2022-02-07', '2022-02-12', 4, '425', '15', 1, '500', '2022-02-17', '');

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
(13, 'abc', '', NULL, '9489840339', 'a@g.com', '', 0, 0, 0, '', '', '', '', 0, '', 0, 'docs/1676209e00aeab14-154319-pngtree-cartoon-color-simple-male-avatar-png-image1934459jpg.jpg', '0000-00-00'),
(26, 'R Vijaya', 'Sankar ', '2022-01-01', '7339528011', 'vijay@gm.com', 'Male', 0, 0, 0, '', '', '21ss', 'kovil street ss', 0, 'Telengana', 628822, 'docs/14661fa5fa9f3f26-817080-downloadpng.png', '2022-02-02'),
(30, 'Vijaya sankar', '', NULL, '7339528035', 'l@g.com', '', 0, 0, 0, '', '', '', '', 0, '', 0, 'docs/1386209df0ba349d-364073-imgavatarpng.png', '2022-02-02'),
(31, 'Vijaya sankar', 'R', '2022-01-12', '9994616327', 'vg@g.com', 'Male', 0, 0, 0, '', '', '40', 'west street', 0, 'TamilNadu', 628811, 'docs/9462035453dbf0c-301977-istockphotojpg.jpg', '2022-02-02'),
(32, 'sundaram', '', NULL, '9894354613', 'ss@gmail.com', '', 0, 0, 0, '', '', '', '', 0, '', 0, '', '2022-02-03'),
(34, 'Selvi', '', NULL, '6382841799', 'abhianand.j2k@gmail.com', '', NULL, 0, 0, '', '', '', '', 1, '', 0, '', '2022-02-10'),
(36, 'abhi', '', NULL, '6385815161', 'abhianand.j2k@gmail.com', '', NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, '', '2022-02-10'),
(37, 'vijay', '', NULL, '8940460311', 'a@g.com', '', NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, '', '2022-03-03'),
(38, 'a', '', NULL, '8940460339', 'a@g.com', '', NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, '', '2022-03-04');

-- --------------------------------------------------------

--
-- Table structure for table `customer_carinfo`
--

CREATE TABLE `customer_carinfo` (
  `carinfo_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `cartype` int(11) NOT NULL,
  `brand` int(11) NOT NULL,
  `model` int(10) NOT NULL,
  `fueltype` varchar(10) NOT NULL,
  `color` varchar(25) NOT NULL,
  `vehicle_number` varchar(20) NOT NULL,
  `lastupddt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_carinfo`
--

INSERT INTO `customer_carinfo` (`carinfo_id`, `customer_id`, `cartype`, `brand`, `model`, `fueltype`, `color`, `vehicle_number`, `lastupddt`) VALUES
(19, 30, 1, 1, 2, 'diesel', 'black', 'TN69 989111', '2022-02-23'),
(20, 30, 2, 1, 1, 'petrol', 'black', 'TN61 555876', '2022-02-23'),
(21, 30, 1, 1, 2, 'petrol', 'black', 'TN61 123456', '2022-03-02'),
(22, 29, 1, 1, 2, 'petrol', 'black', 'TN61 989876', '2022-03-02'),
(23, 37, 1, 1, 2, 'petrol', 'black', 'TN69 900987', '2022-03-03');

-- --------------------------------------------------------

--
-- Table structure for table `customer_whislist`
--

CREATE TABLE `customer_whislist` (
  `Customer_id` int(10) NOT NULL,
  `whislist` varchar(15) NOT NULL,
  `id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `lastupddt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_whislist`
--

INSERT INTO `customer_whislist` (`Customer_id`, `whislist`, `id`, `city_id`, `lastupddt`) VALUES
(1, '6,7', 1, 0, '2022-02-23'),
(0, '6,7', 2, 0, '2022-02-23'),
(3, '6,7', 3, 0, '2022-02-23'),
(0, '4', 4, 0, '2022-03-03');

-- --------------------------------------------------------

--
-- Table structure for table `master_pickdrop_status`
--

CREATE TABLE `master_pickdrop_status` (
  `id` int(10) NOT NULL,
  `status_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_pickdrop_status`
--

INSERT INTO `master_pickdrop_status` (`id`, `status_name`) VALUES
(1, 'Today, please drop your car'),
(2, 'Today, Our employee will pick your car at your door step');

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
(5, 2, 'Datsun Go Plus', 1),
(6, 2, 'Datsun Go', 3);

-- --------------------------------------------------------

--
-- Table structure for table `onlinebooking`
--

CREATE TABLE `onlinebooking` (
  `id` int(11) NOT NULL,
  `Booking_id` varchar(25) NOT NULL,
  `Customer_id` int(10) NOT NULL,
  `Shop_id` int(10) NOT NULL,
  `combo_id` varchar(10) DEFAULT NULL,
  `comboprice_total` decimal(10,0) DEFAULT NULL,
  `services` varchar(20) DEFAULT NULL,
  `serviceprice_total` decimal(10,0) DEFAULT NULL,
  `payable_amt` decimal(10,0) NOT NULL,
  `lastupddt` date DEFAULT NULL,
  `status` varchar(25) NOT NULL,
  `model_id` int(5) NOT NULL,
  `instructions` varchar(300) DEFAULT NULL,
  `vehicle_number` varchar(20) NOT NULL,
  `pickup_drop` varchar(10) NOT NULL,
  `bookingdate` date DEFAULT NULL,
  `pickup_date` date DEFAULT NULL,
  `pickup_time` varchar(20) DEFAULT NULL,
  `drop_date` date DEFAULT NULL,
  `drop_time` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `onlinebooking`
--

INSERT INTO `onlinebooking` (`id`, `Booking_id`, `Customer_id`, `Shop_id`, `combo_id`, `comboprice_total`, `services`, `serviceprice_total`, `payable_amt`, `lastupddt`, `status`, `model_id`, `instructions`, `vehicle_number`, `pickup_drop`, `bookingdate`, `pickup_date`, `pickup_time`, `drop_date`, `drop_time`) VALUES
(52, '880512-4', 30, 4, '29', '77', '1', '108', '185', '2022-03-04', '', 0, 'test', 'TN69 989111', '0', '2022-03-12', '2022-03-10', '9', '2022-03-25', '10'),
(53, '996099-3', 30, 4, '33', '425', '1', '300', '725', '2022-03-04', '', 0, 'without pickup', 'TN61 555876', '0', '2022-03-04', NULL, NULL, NULL, NULL),
(54, '114443-4', 37, 4, '30,34', '559', '3,25', '1060', '1619', '2022-03-04', '', 0, 'no instructions', 'TN69 900987', '1', '2022-03-12', '2022-03-18', '9', '2022-03-26', '10.30');

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
(19, 'Clean Leather-Covered Elements', NULL),
(24, 'engine service', '2022-03-01'),
(25, 'tyre change', '2022-03-01');

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
  `status` varchar(1) NOT NULL,
  `lastupddt` date NOT NULL,
  `shop_pic` varchar(100) NOT NULL,
  `shop_logo` varchar(100) NOT NULL,
  `shop_timing_from` varchar(10) NOT NULL,
  `shop_timing_to` varchar(10) NOT NULL,
  `leave_from_date` date NOT NULL,
  `leave_to_date` date DEFAULT NULL,
  `is_pickup_drop_avl` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shopinfo`
--

INSERT INTO `shopinfo` (`shop_id`, `name`, `firstname`, `lastname`, `mobileno`, `emailid`, `gender`, `dob`, `aadharno`, `doorno`, `street`, `city`, `state`, `zipcode`, `shop_image`, `status`, `lastupddt`, `shop_pic`, `shop_logo`, `shop_timing_from`, `shop_timing_to`, `leave_from_date`, `leave_to_date`, `is_pickup_drop_avl`) VALUES
(1, 'abc carwash', 'muthu', 'kumar', '9994616327', 'abc@g.com', 'Male', '2022-02-01', '2234 5678 9456', 'streetno', 'south street', '3', '1', 600089, 'docs/506203a12aaa69a-194343-coffeeshopjpg.jpg', '1', '2022-02-21', '', 'docs/1676214d69d0c158-702952-coffeeshopjpg.jpg', '9.30', '5.30', '2022-02-01', '2022-02-28', '0'),
(2, 'kumaran carwash', 'kumar', 'k', '9489840339', 'abc@g.com', 'Male', '2022-02-01', '424234', '11', 'south street', '3', '1', 600089, 'docs/photo-1505761283622-7fe50142c97f.jpg', '1', '2022-02-16', '', 'docs/depositphotos_124010534-stock-illustration-car-logo-auto-symbol-and.jpg', '9', '18', '2022-02-18', '2022-02-21', '1'),
(3, 'xyz carwash', 'bharath', 'k', '8940460339', 'xyz@g.com', 'Male', '2022-02-01', '1234', '11', 'south street', '3', '1', 123456, 'docs/photo-1505761283622-7fe50142c97f.jpg', '1', '2022-02-17', '', 'docs/depositphotos_124010534-stock-illustration-car-logo-auto-symbol-and.jpg', '9', '6', '2022-01-25', '2022-02-01', '0'),
(4, 'ramesh carwash', 'bharath', 'k', '7339528035', 'xyz@g.com', 'Male', '2022-02-01', '1234', '11', 'south street', '3', '1', 123456, 'docs/photo-1505761283622-7fe50142c97f.jpg', '1', '2022-02-17', '', 'docs/depositphotos_124010534-stock-illustration-car-logo-auto-symbol-and.jpg', '9', '6', '2022-02-18', '2022-02-18', '1');

-- --------------------------------------------------------

--
-- Table structure for table `shop_service`
--

CREATE TABLE `shop_service` (
  `id` int(10) NOT NULL,
  `service_id` int(10) NOT NULL,
  `shop_id` int(10) NOT NULL,
  `actual_amount` varchar(10) NOT NULL,
  `offer_percent` decimal(10,0) NOT NULL,
  `offer_price` int(10) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `lastupddt` date NOT NULL,
  `model_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shop_service`
--

INSERT INTO `shop_service` (`id`, `service_id`, `shop_id`, `actual_amount`, `offer_percent`, `offer_price`, `from_date`, `to_date`, `status`, `lastupddt`, `model_id`) VALUES
(1, 1, 1, '67', '0', 0, '2022-02-16', '2022-02-23', '1', '2022-02-12', 1),
(2, 3, 1, '89', '0', 0, '2022-02-16', '2022-02-25', '1', '2022-02-12', 2),
(3, 7, 1, '78', '0', 0, '2022-02-16', '2022-02-19', '1', '2022-02-12', 2),
(5, 9, 1, '90', '0', 0, '2022-02-16', '2022-02-16', '1', '2022-02-14', 2),
(6, 5, 2, '96', '0', 0, '2022-02-16', '2022-02-16', '1', '2022-02-14', 6),
(13, 8, 2, '300', '10', 270, '2022-02-01', '2022-02-28', '1', '2022-02-16', 6),
(14, 7, 2, '700', '0', 0, '0000-00-00', '0000-00-00', '1', '2022-02-16', 6),
(15, 1, 3, '300', '0', 0, '0000-00-00', '0000-00-00', '1', '2022-02-17', 1),
(16, 2, 3, '400', '0', 0, '0000-00-00', '0000-00-00', '1', '2022-02-17', 2),
(17, 3, 4, '200', '20', 160, '2022-02-16', '2022-02-25', '1', '2022-03-01', 1),
(18, 4, 3, '500', '0', 0, '0000-00-00', '0000-00-00', '1', '2022-02-17', 2),
(19, 1, 4, '120', '10', 108, '2022-03-01', '2022-03-31', '1', '2022-03-01', 1),
(20, 5, 4, '78', '0', 0, '0000-00-00', '0000-00-00', '0', '2022-03-01', 2),
(21, 4, 4, '600', '0', 0, '0000-00-00', '0000-00-00', '1', '2022-03-01', 1),
(29, 2, 4, '670', '0', 0, '0000-00-00', '0000-00-00', '1', '2022-03-01', 3),
(33, 24, 4, '300', '0', 0, '0000-00-00', '0000-00-00', '1', '2022-03-02', 1),
(34, 25, 4, '900', '0', 0, '0000-00-00', '0000-00-00', '1', '2022-03-01', 2);

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
(127, '', '', 'good service', '4', 30, '1', '2022-02-14'),
(128, '', '', 'best application', '5', 13, '1', '2022-02-14'),
(129, '', '', 'Widows and orphans occur when the first line of a paragraph is the last in a column or page, or when', '4', 31, '2', '2022-02-22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_status`
--
ALTER TABLE `booking_status`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `combo_offers`
--
ALTER TABLE `combo_offers`
  ADD PRIMARY KEY (`offer_id`);

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
-- Indexes for table `customer_carinfo`
--
ALTER TABLE `customer_carinfo`
  ADD PRIMARY KEY (`carinfo_id`);

--
-- Indexes for table `customer_whislist`
--
ALTER TABLE `customer_whislist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_pickdrop_status`
--
ALTER TABLE `master_pickdrop_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `onlinebooking`
--
ALTER TABLE `onlinebooking`
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
-- Indexes for table `shop_service`
--
ALTER TABLE `shop_service`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `booking_status`
--
ALTER TABLE `booking_status`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
-- AUTO_INCREMENT for table `combo_offers`
--
ALTER TABLE `combo_offers`
  MODIFY `offer_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `contact_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `customer_carinfo`
--
ALTER TABLE `customer_carinfo`
  MODIFY `carinfo_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `customer_whislist`
--
ALTER TABLE `customer_whislist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `master_pickdrop_status`
--
ALTER TABLE `master_pickdrop_status`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `onlinebooking`
--
ALTER TABLE `onlinebooking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `shopinfo`
--
ALTER TABLE `shopinfo`
  MODIFY `shop_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shop_service`
--
ALTER TABLE `shop_service`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
