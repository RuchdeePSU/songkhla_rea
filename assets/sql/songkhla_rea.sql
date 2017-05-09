-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2017 at 02:37 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `songkhla_rea`
--

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `prop_id` int(11) NOT NULL,
  `prop_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prop_address_no` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `prop_address_moo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `prop_address_road` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prop_address_subdistrict` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prop_address_district` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prop_type_id` int(11) NOT NULL,
  `prop_municipal_id` int(11) NOT NULL,
  `prop_lat` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `prop_long` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `prop_detail_link` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prop_thumbnail_img` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prop_icon_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prop_min_price` decimal(10,0) NOT NULL DEFAULT '0',
  `prop_max_price` decimal(10,0) NOT NULL DEFAULT '0',
  `prop_status` tinyint(1) NOT NULL DEFAULT '1',
  `prop_created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_municipals`
--

CREATE TABLE `property_municipals` (
  `prop_municipal_id` int(11) NOT NULL,
  `prop_municipal_desc` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prop_municipal_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_municipals`
--

INSERT INTO `property_municipals` (`prop_municipal_id`, `prop_municipal_desc`, `prop_municipal_status`) VALUES
(1, 'à¸«à¸²à¸”à¹ƒà¸«à¸à¹ˆ', 1),
(2, 'à¸„à¸­à¸«à¸‡à¸ªà¹Œ', 1),
(4, 'à¸šà¹‰à¸²à¸™à¸žà¸£à¸¸', 1),
(5, 'à¸„à¸§à¸™à¸¥à¸±à¸‡', 1);

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

CREATE TABLE `property_types` (
  `prop_type_id` int(11) NOT NULL,
  `prop_type_desc` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prop_type_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`prop_type_id`, `prop_type_desc`, `prop_type_status`) VALUES
(1, 'à¸šà¹‰à¸²à¸™à¹€à¸”à¸µà¹ˆà¸¢à¸§', 1),
(2, 'à¸šà¹‰à¸²à¸™à¹à¸à¸”', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `passwd` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`email`, `passwd`, `name`, `status`) VALUES
('ruchdee.b@psu.ac.th', '25d55ad283aa400af464c76d713c07ad', 'Ruchdee Binmad', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`prop_id`),
  ADD KEY `prop_type_id` (`prop_type_id`);

--
-- Indexes for table `property_municipals`
--
ALTER TABLE `property_municipals`
  ADD PRIMARY KEY (`prop_municipal_id`);

--
-- Indexes for table `property_types`
--
ALTER TABLE `property_types`
  ADD PRIMARY KEY (`prop_type_id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `prop_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `property_municipals`
--
ALTER TABLE `property_municipals`
  MODIFY `prop_municipal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `property_types`
--
ALTER TABLE `property_types`
  MODIFY `prop_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`prop_type_id`) REFERENCES `property_types` (`prop_type_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
