-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 14, 2018 at 11:17 PM
-- Server version: 5.5.59-cll
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mysite_njpob`
--

-- --------------------------------------------------------

--
-- Table structure for table `site_upload_categories`
--

CREATE TABLE `site_upload_categories` (
  `id` int(11) NOT NULL,
  `cat_title` varchar(255) NOT NULL,
  `parent_cat_id` int(11) DEFAULT NULL,
  `category_url` varchar(255) NOT NULL,
  `list_order` int(11) NOT NULL,
  `create_date` int(11) NOT NULL,
  `modified_date` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site_upload_categories`
--

INSERT INTO `site_upload_categories` (`id`, `cat_title`, `parent_cat_id`, `category_url`, `list_order`, `create_date`, `modified_date`, `admin_id`) VALUES
(1, 'Site User Required Documents', 0, 'Site-User-Required-Documents', 0, 0, 0, 0),
(2, 'Registratation', 1, 'Registratation', 0, 0, 0, 0),
(3, 'Driver License Front', 1, 'Driver-License-Front', 0, 0, 0, 0),
(4, 'Driver License Back', 1, 'Driver-License-Back', 0, 0, 0, 0),
(6, 'Law Enforcement AgencyPhoto ID', 1, 'Law-Enforcement-AgencyPhoto-ID', 0, 0, 0, 0),
(7, 'Color Passport Picture', 1, 'Color-Passport-Picture', 0, 0, 0, 0),
(8, 'Right Thumb Finger Print', 1, 'Right-Thumb-Finger-Print', 0, 0, 0, 0),
(9, 'Insurance Card', 1, 'Insurance-Card', 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `site_upload_categories`
--
ALTER TABLE `site_upload_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `site_upload_categories`
--
ALTER TABLE `site_upload_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
