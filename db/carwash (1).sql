-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2022 at 11:26 AM
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
(2, 'Datsun'),
(3, 'Honda'),
(4, 'Maruthi');

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
(35, '1,2', '2022-03-16', '2022-03-16', 10, '1170', '10', 1, '1300', '2022-03-16', 'Basic'),
(36, '2', '2022-03-16', '2022-03-16', 10, '285', '5', 1, '300', '2022-03-16', 'Classic'),
(38, '3,1', '2022-03-17', '2022-03-19', 15, '270', '10', 1, '300', '2022-03-17', 'super'),
(39, '3,2', '2022-03-17', '2022-03-17', 15, '540', '10', 1, '600', '2022-03-17', ''),
(40, '3,2', '2022-03-17', '2022-03-17', 15, '480', '20', 1, '600', '2022-03-17', 'Delux'),
(41, '2,1', '2022-03-17', '2022-03-17', 10, '1105', '15', 1, '1300', '2022-03-17', 'super1'),
(42, '1,2', '2022-03-17', '2022-03-17', 10, '1040', '20', 1, '1300', '2022-03-17', 'Supreme'),
(43, '2,1', '2022-03-17', '2022-03-17', 10, '975', '25', 1, '1300', '2022-03-17', 'super2');

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
(47, 'Vijaya sankar', '', NULL, '7339528035', 'v@g.com', '', NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, 'docs/9362317c1bf0855-11100-imagesjpg.jpg', '2022-03-15'),
(48, 'Vijaya sankar', '', NULL, '9489840339', 'k@g.com', '', NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, '', '2022-03-16');

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
(48, '10', 119, 3, '2022-03-16');

-- --------------------------------------------------------

--
-- Table structure for table `master_carwash_status`
--

CREATE TABLE `master_carwash_status` (
  `id` int(10) NOT NULL,
  `carwash_status_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_carwash_status`
--

INSERT INTO `master_carwash_status` (`id`, `carwash_status_name`) VALUES
(0, 'None'),
(2, 'In Queue'),
(3, 'In Progress'),
(4, 'Completed');

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
(6, 2, 'Datsun Go', 3),
(7, 3, 'Honda WR-V', 1),
(8, 3, 'Honda City', 3),
(9, 4, 'Maruti Baleno', 2),
(10, 4, 'edan-Maruti Dzire', 2),
(11, 4, 'Vitara Brezza', 2);

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
  `drop_time` varchar(20) DEFAULT NULL,
  `payment_type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(3) NOT NULL,
  `search_id` varchar(11) NOT NULL,
  `service_name` varchar(250) NOT NULL,
  `lastupddt` date DEFAULT NULL,
  `lastupdby` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `search_id`, `service_name`, `lastupddt`, `lastupdby`) VALUES
(1, 'S1', 'Inspecting & Changing Engine Oil.', '2022-03-17', 11),
(2, 'S2', 'Inspecting & Changing Air Filter.', '2022-03-17', 11),
(3, 'S3', 'Inspecting & Changing A/C Belt', '2022-03-17', 11),
(4, 'S4', 'Inspecting & Changing Spark Plugs', '2022-03-17', 11),
(5, 'S5', 'Inspecting & Changing Fuel Filter', '2022-03-17', 11),
(6, 'S6', 'Radiator Flushing/Cleaning', '2022-03-17', 11),
(7, 'S7', 'Suspension Check.', '2022-03-17', 11),
(8, 'S8', 'Inspecting & Changing Power Steering Oil', '2022-03-17', 11),
(9, 'S9', 'Axel/Drive Shaft Check', '2022-03-17', 11),
(10, 'S10', 'Clutch Adjustment.', '2022-03-17', 11),
(11, 'S11', 'Inspecting & Changing Oil Filter.', '2022-03-17', 11),
(12, 'S12', 'Interior Car Wash', '2022-03-17', 11),
(13, 'S13', 'Exterior Car Wash', '2022-03-17', 11),
(14, 'S14', 'Interior and Exterior Car wash', '2022-03-17', 11);

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
  `street` varchar(100) NOT NULL,
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
(10, '4g Waterless Car Wash', 'kkk', '', '7339528035', 'k@g.com', '', NULL, NULL, '', '', '1', NULL, NULL, 'docs/1826231dd14bc4c3-362265-imagesjpg.jpg', '1', '0000-00-00', '', 'docs/1316231d8064e75e-941964-360F411200316B3Ed9tKuqUca8juyXY1hRp0rfKI4iFOkjpg.jpg', '', '', '0000-00-00', NULL, ''),
(11, 'Happy Car Wash', 'xyz', '', '9489840339', 'xyz@g.com', '', NULL, NULL, '', '', '1', NULL, NULL, 'docs/1026231dec1b54bd-777812-t-55-1-home-box-shop-dcc7jpg.jpg', '1', '0000-00-00', '', 'docs/656231de55b7cf9-956099-istockphoto-1090457308-612x612jpg.jpg', '', '', '0000-00-00', NULL, ''),
(12, 'Speed car wash', 'ramesh', '', '9994616327', 'r@g.com', '', NULL, NULL, '', '', '1', NULL, NULL, 'docs/206232bfd812f1b-672559-images1jpg.jpg', '1', '0000-00-00', '', 'docs/1576232bf65c7aaf-936593-attachment109365425jpg.jpg', '', '', '0000-00-00', NULL, ''),
(13, 'SS Water Service Centre', 'jegan', '', '7339528033', 'j@g.com', '', NULL, NULL, '', '', '3', NULL, NULL, 'docs/726232c1b73c312-464809-images2jpg.jpg', '1', '0000-00-00', '', 'docs/506232c09cdf77f-784922-previewjpg.jpg', '', '', '0000-00-00', NULL, ''),
(14, 'Shanmitha Water Wash', 'guhan', '', '7339528034', 'guhan@g.com', '', NULL, NULL, '', '', '3', NULL, NULL, 'docs/1806232c3750aab0-10137-images3jpg.jpg', '1', '0000-00-00', '', 'docs/186232c3974c4eb-309687-52-523749car-wash-logo-png-transparent-pngpng.png', '', '', '0000-00-00', NULL, ''),
(15, 'Dakshna water service', 'Ganesh', 'k', '7339528000', 'ganesh@g.com', 'Male', '2022-03-03', '9000 1245 5678', '56', 'Dr Thomas Rd, JJ Nagar, T. Nagar, Chennai, Tamil Nadu 600017', '3', '1', 600089, '', '1', '2022-03-17', '', '', '9', '6', '0000-00-00', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `shop_holidays`
--

CREATE TABLE `shop_holidays` (
  `id` int(10) NOT NULL,
  `shop_id` int(10) NOT NULL,
  `leave_date` date NOT NULL,
  `lastupddt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shop_holidays`
--

INSERT INTO `shop_holidays` (`id`, `shop_id`, `leave_date`, `lastupddt`) VALUES
(90, 15, '2022-03-01', '2022-03-17'),
(91, 15, '2022-03-08', '2022-03-17'),
(92, 15, '2022-03-15', '2022-03-17');

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
(35, 1, 10, '1000', '0', 0, '0000-00-00', '0000-00-00', '1', '2022-03-16', 1),
(36, 2, 10, '300', '0', 0, '0000-00-00', '0000-00-00', '1', '2022-03-16', 1),
(37, 1, 12, '800', '0', 0, '0000-00-00', '0000-00-00', '1', '2022-03-17', 1),
(38, 1, 15, '100', '0', 0, '0000-00-00', '0000-00-00', '1', '2022-03-17', 1),
(39, 2, 15, '400', '0', 0, '0000-00-00', '0000-00-00', '1', '2022-03-17', 1),
(40, 3, 15, '200', '0', 0, '0000-00-00', '0000-00-00', '1', '2022-03-17', 1);

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
  `user_description` varchar(250) NOT NULL,
  `user_rating` varchar(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `review_count` varchar(10) NOT NULL,
  `review_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Indexes for table `master_carwash_status`
--
ALTER TABLE `master_carwash_status`
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
-- Indexes for table `shop_holidays`
--
ALTER TABLE `shop_holidays`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `offer_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `contact_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `customer_carinfo`
--
ALTER TABLE `customer_carinfo`
  MODIFY `carinfo_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `customer_whislist`
--
ALTER TABLE `customer_whislist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `master_carwash_status`
--
ALTER TABLE `master_carwash_status`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `master_pickdrop_status`
--
ALTER TABLE `master_pickdrop_status`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `onlinebooking`
--
ALTER TABLE `onlinebooking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `shopinfo`
--
ALTER TABLE `shopinfo`
  MODIFY `shop_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `shop_holidays`
--
ALTER TABLE `shop_holidays`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `shop_service`
--
ALTER TABLE `shop_service`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
