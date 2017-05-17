-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 17, 2017 at 03:50 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

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
  `prop_municipal_id` int(11) NOT NULL,
  `prop_lat` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `prop_long` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `prop_detail_link` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prop_thumbnail_img` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prop_icon_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prop_status` tinyint(1) NOT NULL DEFAULT '1',
  `prop_created_date` date NOT NULL,
  `prop_updated_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_details`
--

CREATE TABLE `property_details` (
  `prop_id` int(11) NOT NULL,
  `prop_type_id` int(11) NOT NULL,
  `units_total` smallint(6) NOT NULL,
  `units_sold` smallint(6) NOT NULL,
  `units_sold_avg` smallint(6) NOT NULL,
  `units_unsold` smallint(6) NOT NULL,
  `time_unsold_avg` tinyint(4) NOT NULL,
  `units_new_6m` smallint(6) NOT NULL,
  `prop_min_price` int(11) NOT NULL,
  `prop_max_price` int(11) NOT NULL
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
(1, 'à¸šà¹‰à¸²à¸™à¹€à¸”à¸µà¹ˆà¸¢à¸§ 1 à¸Šà¸±à¹‰à¸™', 1),
(2, 'à¸šà¹‰à¸²à¸™à¹€à¸”à¸µà¹ˆà¸¢à¸§ 2 à¸Šà¸±à¹‰à¸™', 1),
(3, 'à¸šà¹‰à¸²à¸™à¹à¸à¸” 1 à¸Šà¸±à¹‰à¸™', 1),
(4, 'à¸šà¹‰à¸²à¸™à¹à¸à¸” 2 à¸Šà¸±à¹‰à¸™', 1),
(5, 'à¸—à¸²à¸§à¸™à¹Œà¹€à¸®à¸²à¸ªà¹Œ+à¸—à¸²à¸§à¸™à¹Œà¹‚à¸®à¸¡ 2 à¸Šà¸±à¹‰à¸™', 1),
(6, 'à¸—à¸²à¸§à¸™à¹Œà¹€à¸®à¸²à¸ªà¹Œ+à¸—à¸²à¸§à¸™à¹Œà¹‚à¸®à¸¡ à¸¡à¸²à¸à¸à¸§à¹ˆà¸² 2 à¸Šà¸±à¹‰à¸™', 1),
(7, 'à¸­à¸²à¸„à¸²à¸£à¸žà¸²à¸“à¸´à¸Šà¸¢à¹Œ 2 à¸Šà¸±à¹‰à¸™', 1),
(8, 'à¸­à¸²à¸„à¸²à¸£à¸žà¸²à¸“à¸´à¸Šà¸¢à¹Œ à¸¡à¸²à¸à¸à¸§à¹ˆà¸² 2 à¸Šà¸±à¹‰à¸™', 1),
(9, 'à¸„à¸­à¸™à¹‚à¸”à¸¡à¸´à¹€à¸™à¸µà¸¢à¸¡', 1),
(10, 'à¸­à¸·à¹ˆà¸™à¹†', 1);

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
('psu.songkhlarea@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'Songkhla REA', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`prop_id`);

--
-- Indexes for table `property_details`
--
ALTER TABLE `property_details`
  ADD KEY `prop_id` (`prop_id`),
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
  MODIFY `prop_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `property_details`
--
ALTER TABLE `property_details`
  ADD CONSTRAINT `property_details_ibfk_1` FOREIGN KEY (`prop_id`) REFERENCES `properties` (`prop_id`),
  ADD CONSTRAINT `property_details_ibfk_2` FOREIGN KEY (`prop_type_id`) REFERENCES `property_types` (`prop_type_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
