-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 22, 2017 at 06:04 AM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
  `prop_phone_no` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `prop_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prop_lat` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `prop_long` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `prop_detail_link` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prop_thumbnail_img` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prop_icon_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prop_status` tinyint(1) NOT NULL DEFAULT '1',
  `prop_created_date` date NOT NULL,
  `prop_updated_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`prop_id`, `prop_name`, `prop_address_no`, `prop_address_moo`, `prop_address_road`, `prop_address_subdistrict`, `prop_address_district`, `prop_municipal_id`, `prop_phone_no`, `prop_email`, `prop_lat`, `prop_long`, `prop_detail_link`, `prop_thumbnail_img`, `prop_icon_type`, `prop_status`, `prop_created_date`, `prop_updated_date`) VALUES
(1, 'à¸›à¸´à¸¢à¸°à¸—à¸£à¸±à¸žà¸¢à¹Œ à¸šà¹‰à¸²à¸™à¹„à¸£à¹ˆ', '88/5', '8', 'à¸šà¹‰à¸²à¸™à¹„à¸£à¹ˆ-à¸—à¸¸à¹ˆà¸‡à¸‚à¸¡à¸´à¹‰à¸™', 'à¸šà¹‰à¸²à¸™à¸žà¸£à¸¸', 'à¸«à¸²à¸”à¹ƒà¸«à¸à¹ˆ', 4, '0815998653', 'pookhingkant@gmail.com', '6.896111', '100.476111', 'properties-detail.php', 'assets/img/properties/property-sample.jpg', 'assets/img/property-types/single-family.png', 1, '2017-05-20', '2017-05-20'),
(2, 'à¸®à¸²à¸£à¹Œà¹‚à¸¡à¸™à¸µà¸šà¸´à¸‹', '', '', '', 'à¸šà¹‰à¸²à¸™à¸žà¸£à¸¸', 'à¸«à¸²à¸”à¹ƒà¸«à¸à¹ˆ', 4, '0887929825', '', '6.97166667', '100.475', 'properties-detail.php', 'assets/img/properties/property-sample.jpg', 'assets/img/property-types/single-family.png', 1, '2017-05-20', '2017-05-20'),
(3, 'à¸®à¸²à¸£à¹Œà¹‚à¸¡à¸™à¸µà¸§à¸´à¸¥à¸¥à¹Œ 1', '', '', '', 'à¸šà¹‰à¸²à¸™à¸žà¸£à¸¸', 'à¸«à¸²à¸”à¹ƒà¸«à¸à¹ˆ', 4, '074216178', 'nattaao.555@hotmail.com', '6.98055556', '100.47527778', 'properties-detail.php', 'assets/img/properties/property-sample.jpg', 'assets/img/property-types/single-family.png', 1, '2017-05-20', '0000-00-00'),
(4, 'à¸®à¸²à¸£à¹Œà¹‚à¸¡à¸™à¸µà¸§à¸´à¸¥à¸¥à¹Œ 3', '', '', 'à¸šà¹‰à¸²à¸™à¹‚à¸›à¹Šà¸°à¸«à¸¡à¸­', 'à¸šà¹‰à¸²à¸™à¸žà¸£à¸¸', 'à¸«à¸²à¸”à¹ƒà¸«à¸à¹ˆ', 4, '0887929825', '', '6.9325', '100.46916667', 'properties-detail.php', 'assets/img/properties/property-sample.jpg', 'assets/img/property-types/single-family.png', 1, '2017-05-20', '0000-00-00'),
(5, 'à¸‰à¸±à¸•à¸£à¸—à¸­à¸‡à¸žà¸²à¸§à¸´à¸¥à¹€à¸¥à¸µà¹ˆà¸¢à¸™ 5 à¹€à¸Ÿà¸ª 2', '', '', 'à¹€à¸¢à¸·à¹‰à¸­à¸‡à¸ªà¸™à¸²à¸¡à¸à¸µà¸¬à¸²à¸žà¸£à¸¸à¸„à¹‰à¸²à¸‡à¸„à¸²à¸§', 'à¸šà¹‰à¸²à¸™à¸žà¸£à¸¸', 'à¸«à¸²à¸”à¹ƒà¸«à¸à¹ˆ', 4, '0842662228', 'homjiao@gmail.com', '6.91972222', '100.45861111', 'properties-detail.php', 'assets/img/properties/property-sample.jpg', 'assets/img/property-types/single-family.png', 1, '2017-05-20', '0000-00-00'),
(6, 'à¸­à¸²à¹€à¸‹à¸µà¸¢à¸™ à¸‹à¸´à¸•à¸µà¹‰ à¸£à¸µà¸ªà¸­à¸£à¹Œà¸—', '', '', 'à¸à¸²à¸à¸ˆà¸™à¸§à¸“à¸´à¸Šà¸¢à¹Œ', 'à¸«à¸²à¸”à¹ƒà¸«à¸à¹ˆ', 'à¸«à¸²à¸”à¹ƒà¸«à¸à¹ˆ', 1, '074801769', 'hatyainakarin@yahoo.com', '6.99472222', '100.48527778', 'properties-detail.php', 'assets/img/properties/property-sample.jpg', 'assets/img/property-types/single-family.png', 1, '2017-05-20', '0000-00-00'),
(7, 'à¹€à¸šà¸à¸ˆà¸žà¸£ à¸„à¸¥à¸­à¸‡à¸«à¸§à¸°', '', '', 'à¸«à¸²à¸”à¹ƒà¸«à¸à¹ˆ-à¸›à¸±à¸•à¸•à¸²à¸™à¸µ', 'à¸„à¸­à¸«à¸‡à¸ªà¹Œ', 'à¸«à¸²à¸”à¹ƒà¸«à¸à¹ˆ', 2, '0862914401', 'vilairut.bj@gmail.com', '6.97265833', '100.48944444', 'properties-detail.php', 'assets/img/properties/property-sample.jpg', 'assets/img/property-types/single-family.png', 1, '2017-05-20', '2017-05-20'),
(8, 'à¸›à¸²à¸¥à¹Œà¸¡à¸ªà¸›à¸£à¸´à¸‡à¸ªà¹Œ 8', '', '', 'à¸„à¸¥à¸­à¸‡à¸¢à¸²à¹€à¸«à¸™à¸·à¸­ 9', 'à¸šà¹‰à¸²à¸™à¸žà¸£à¸¸', 'à¸«à¸²à¸”à¹ƒà¸«à¸à¹ˆ', 4, '0815419507', 'hatyainakarin@yahoo.com', '6.94611111', '100.47888889', 'properties-detail.php', 'assets/img/properties/property-sample.jpg', 'assets/img/property-types/single-family.png', 1, '2017-05-20', '0000-00-00'),
(9, 'à¸›à¸²à¸¥à¹Œà¸¡à¸ªà¸›à¸£à¸´à¸‡à¸ªà¹Œ 9', '', '', 'à¸à¸²à¸à¸ˆà¸™à¸§à¸“à¸´à¸Šà¸¢à¹Œ', 'à¸šà¹‰à¸²à¸™à¸žà¸£à¸¸', 'à¸«à¸²à¸”à¹ƒà¸«à¸à¹ˆ', 4, '074801761', 'hatyainakarin@yahoo.com', '6.93916667', '100.46861111', 'properties-detail.php', 'assets/img/properties/property-sample.jpg', 'assets/img/property-types/single-family.png', 1, '2017-05-20', '0000-00-00'),
(10, 'à¸›à¸²à¸¥à¹Œà¸¡à¸ªà¸›à¸£à¸´à¸‡à¸ªà¹Œ 10', '', '', 'à¸žà¸£à¸¸à¸„à¹‰à¸²à¸‡à¸„à¸²à¸§', 'à¸šà¹‰à¸²à¸™à¸žà¸£à¸¸', 'à¸«à¸²à¸”à¹ƒà¸«à¸à¹ˆ', 4, '074800806', 'hatyainakarin@yahoo.com', '6.91972222', '100.46444444', 'properties-detail.php', 'assets/img/properties/property-sample.jpg', 'assets/img/property-types/single-family.png', 1, '2017-05-20', '0000-00-00'),
(11, 'à¸™à¸µà¹‚à¸­à¸ªà¸¡à¸²à¸£à¹Œà¸— à¸žà¸£à¸¸à¸˜à¸²à¸™à¸µ', '', '', 'à¸šà¹‰à¸²à¸™à¸žà¸£à¸¸à¸˜à¸²à¸™à¸µ', 'à¸šà¹‰à¸²à¸™à¸žà¸£à¸¸', 'à¸«à¸²à¸”à¹ƒà¸«à¸à¹ˆ', 4, '', '', '6.939991', '100.46805', 'properties-detail.php', 'assets/img/properties/property-sample.jpg', 'assets/img/property-types/single-family.png', 1, '2017-05-20', '0000-00-00'),
(12, 'à¸™à¸µà¹‚à¸­à¸ªà¸¡à¸²à¸£à¹Œà¸— à¸šà¹‰à¸²à¸™à¸žà¸£à¸¸', '', '', 'à¸à¸²à¸à¸ˆà¸™à¸§à¸“à¸´à¸Šà¸¢à¹Œ', 'à¸šà¹‰à¸²à¸™à¸žà¸£à¸¸', 'à¸«à¸²à¸”à¹ƒà¸«à¸à¹ˆ', 4, '', '', '6.9369332', '100.4683856', 'properties-detail.php', 'assets/img/properties/property-sample.jpg', 'assets/img/property-types/single-family.png', 1, '2017-05-20', '0000-00-00'),
(13, 'à¸™à¸µà¹‚à¸­à¸ªà¸¡à¸²à¸£à¹Œà¸— à¸„à¸¥à¸­à¸‡à¸«à¸§à¸°', '', '', 'à¸­à¸´à¸ªà¸£à¸ à¸²à¸ž 2', 'à¸„à¸­à¸«à¸‡à¸ªà¹Œ', 'à¸«à¸²à¸”à¹ƒà¸«à¸à¹ˆ', 2, '', '', '6.972639', '100.474699', 'properties-detail.php', 'assets/img/properties/property-sample.jpg', 'assets/img/property-types/single-family.png', 1, '2017-05-20', '0000-00-00'),
(14, 'à¸™à¸µà¹‚à¸­à¸ªà¸¡à¸²à¸£à¹Œà¸— à¸šà¸´à¹Šà¸à¸‹à¸µà¹€à¸­à¹Šà¸à¸‹à¹Œà¸•à¸£à¹‰à¸²', '', '1', 'à¸—à¸¸à¹ˆà¸‡à¸£à¸§à¸‡à¸—à¸­à¸‡', 'à¸„à¸­à¸«à¸‡à¸ªà¹Œ', 'à¸«à¸²à¸”à¹ƒà¸«à¸à¹ˆ', 2, '', '', '7.031108', '100.486528', 'properties-detail.php', 'assets/img/properties/property-sample.jpg', 'assets/img/property-types/single-family.png', 1, '2017-05-20', '0000-00-00'),
(15, 'à¸”à¸´ à¹à¸­à¸—à¸£à¸´à¸šà¸´à¸§', '64/141', '', 'à¸à¸²à¸à¸ˆà¸™à¸§à¸“à¸´à¸Šà¸¢à¹Œ', 'à¸„à¸­à¸«à¸‡à¸ªà¹Œ', 'à¸«à¸²à¸”à¹ƒà¸«à¸à¹ˆ', 2, '', '', '7.03500000', '100.50027778', 'properties-detail.php', 'assets/img/properties/property-sample.jpg', 'assets/img/property-types/single-family.png', 1, '2017-05-21', '0000-00-00'),
(16, 'à¸”à¸´ à¹‚à¸­à¸—à¸²à¸§à¸™à¹Œ', '', '', 'à¸à¸²à¸à¸ˆà¸™à¸§à¸“à¸´à¸Šà¸¢à¹Œ', 'à¸šà¹‰à¸²à¸™à¸žà¸£à¸¸', 'à¸«à¸²à¸”à¹ƒà¸«à¸à¹ˆ', 4, '', '', '6.92833333', '100.46861111', 'properties-detail.php', 'assets/img/properties/property-sample.jpg', 'assets/img/property-types/single-family.png', 1, '2017-05-21', '0000-00-00'),
(17, 'à¸šà¹‰à¸²à¸™à¸ªà¸§à¸™à¸§à¸±à¸‡à¸™à¸™à¸—à¹Œ', '', '', 'à¸šà¹‰à¸²à¸™à¸žà¸£à¸¸à¸˜à¸²à¸™à¸µ', 'à¸šà¹‰à¸²à¸™à¸žà¸£à¸¸', 'à¸«à¸²à¸”à¹ƒà¸«à¸à¹ˆ', 4, '', '', '6.93444444', '100.45388889', 'properties-detail.php', 'assets/img/properties/property-sample.jpg', 'assets/img/property-types/single-family.png', 1, '2017-05-21', '0000-00-00');

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

--
-- Dumping data for table `property_details`
--

INSERT INTO `property_details` (`prop_id`, `prop_type_id`, `units_total`, `units_sold`, `units_sold_avg`, `units_unsold`, `time_unsold_avg`, `units_new_6m`, `prop_min_price`, `prop_max_price`) VALUES
(1, 1, 6, 4, 2, 2, 0, 2, 2330000, 2800000),
(1, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(1, 3, 0, 0, 0, 0, 0, 0, 0, 0),
(1, 4, 0, 0, 0, 0, 0, 0, 0, 0),
(1, 5, 4, 0, 2, 0, 0, 8, 1790000, 1790000),
(1, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(1, 7, 0, 0, 0, 0, 0, 0, 0, 0),
(1, 8, 0, 0, 0, 0, 0, 0, 0, 0),
(1, 9, 0, 0, 0, 0, 0, 0, 0, 0),
(1, 10, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 3, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 4, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 5, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 7, 24, 8, 1, 16, 0, 0, 2800000, 3400000),
(2, 8, 30, 18, 1, 12, 0, 0, 4010000, 8870000),
(2, 9, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 10, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 3, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 4, 48, 48, 0, 0, 0, 0, 3300000, 4000000),
(3, 5, 60, 60, 0, 0, 0, 0, 1690000, 2500000),
(3, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 7, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 8, 15, 15, 0, 0, 0, 0, 3800000, 5490000),
(3, 9, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 10, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 3, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 4, 4, 1, 0, 3, 0, 0, 3500000, 4020000),
(4, 5, 32, 30, 1, 2, 0, 0, 2420000, 2430000),
(4, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 7, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 8, 6, 3, 0, 3, 0, 0, 4800000, 5200000),
(4, 9, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 10, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 1, 26, 21, 2, 5, 0, 0, 3500000, 4500000),
(5, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 3, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 4, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 5, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 7, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 8, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 9, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 10, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 3, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 4, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 5, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 7, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 8, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 9, 618, 599, 0, 19, 0, 0, 1900000, 4700000),
(6, 10, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 2, 15, 13, 1, 0, 0, 2, 6800000, 7200000),
(7, 3, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 4, 14, 14, 1, 0, 0, 0, 3800000, 4200000),
(7, 5, 14, 13, 1, 1, 0, 0, 2800000, 4000000),
(7, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 7, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 8, 21, 21, 1, 0, 0, 0, 3900000, 4300000),
(7, 9, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 10, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 2, 8, 0, 0, 8, 0, 0, 3940000, 4470000),
(8, 3, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 4, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 5, 27, 18, 3, 0, 0, 0, 1850000, 2360000),
(8, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 7, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 8, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 9, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 10, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 2, 19, 7, 0, 6, 0, 0, 4520000, 6270000),
(9, 3, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 4, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 5, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 6, 44, 13, 0, 8, 0, 23, 3410000, 4510000),
(9, 7, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 8, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 9, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 10, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 2, 56, 30, 0, 26, 0, 0, 3430000, 4850000),
(10, 3, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 4, 35, 25, 0, 10, 0, 0, 2880000, 3070000),
(10, 5, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 7, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 8, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 9, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 10, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 3, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 4, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 5, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 7, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 8, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 9, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 10, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 3, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 4, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 5, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 7, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 8, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 9, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 10, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 3, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 4, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 5, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 7, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 8, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 9, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 10, 0, 0, 0, 0, 0, 0, 0, 0),
(14, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(14, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(14, 3, 0, 0, 0, 0, 0, 0, 0, 0),
(14, 4, 0, 0, 0, 0, 0, 0, 0, 0),
(14, 5, 0, 0, 0, 0, 0, 0, 0, 0),
(14, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(14, 7, 0, 0, 0, 0, 0, 0, 0, 0),
(14, 8, 0, 0, 0, 0, 0, 0, 0, 0),
(14, 9, 0, 0, 0, 0, 0, 0, 0, 0),
(14, 10, 0, 0, 0, 0, 0, 0, 0, 0),
(15, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(15, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(15, 3, 0, 0, 0, 0, 0, 0, 0, 0),
(15, 4, 0, 0, 0, 0, 0, 0, 0, 0),
(15, 5, 0, 0, 0, 0, 0, 0, 0, 0),
(15, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(15, 7, 0, 0, 0, 0, 0, 0, 0, 0),
(15, 8, 0, 0, 0, 0, 0, 0, 0, 0),
(15, 9, 0, 0, 0, 0, 0, 0, 0, 0),
(15, 10, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 3, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 4, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 5, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 7, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 8, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 9, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 10, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 3, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 4, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 5, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 7, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 8, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 9, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 10, 0, 0, 0, 0, 0, 0, 0, 0);

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
  MODIFY `prop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
