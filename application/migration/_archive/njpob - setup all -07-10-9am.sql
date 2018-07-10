-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2018 at 02:59 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `njpob`
--

-- --------------------------------------------------------

--
-- Table structure for table `business_categories`
--

CREATE TABLE `business_categories` (
  `recno` int(11) NOT NULL COMMENT 'I|11|0',
  `category` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `page` varchar(25) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Z|25|0',
  `date` date NOT NULL COMMENT 'D|10|0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `business_categories`
--

INSERT INTO `business_categories` (`recno`, `category`, `page`, `date`) VALUES
(2, 'Automotive', 'user_business_cat1', '0000-00-00'),
(3, 'Business Support & Supplies', 'user_business_cat1', '0000-00-00'),
(4, 'Computers & Electronics', 'user_business_cat1', '0000-00-00'),
(5, 'Construction & Contractors', 'user_business_cat1', '0000-00-00'),
(6, 'Education', 'user_business_cat1', '0000-00-00'),
(7, 'Entertainment', 'user_business_cat1', '0000-00-00'),
(8, 'Food & Dining', 'user_business_cat1', '0000-00-00'),
(9, 'Health & Medicine', 'user_business_cat1', '0000-00-00'),
(10, 'Home & Garden', 'user_business_cat1', '0000-00-00'),
(11, 'Legal & Financial', 'user_business_cat1', '0000-00-00'),
(12, 'Manufacturing ', 'user_business_cat1', '0000-00-00'),
(13, 'Merchants (Retail)', 'user_business_cat1', '0000-00-00'),
(14, 'Miscellaneous', 'user_business_cat1', '0000-00-00'),
(15, 'Personal Care & Services', 'user_business_cat1', '0000-00-00'),
(16, 'Real Estate', 'user_business_cat1', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `business_listings`
--

CREATE TABLE `business_listings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `business` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `address1` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `cell_phone` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET ucs2 NOT NULL,
  `website` varchar(99) COLLATE utf8_unicode_ci NOT NULL,
  `bus_category` int(4) NOT NULL,
  `specialization` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `pay_option` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8_unicode_ci NOT NULL,
  `create_date` int(11) NOT NULL,
  `modified_date` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `business_listings_upload`
--

CREATE TABLE `business_listings_upload` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `source_id` int(11) NOT NULL,
  `parent_cat` int(11) NOT NULL,
  `caption` varchar(250) DEFAULT NULL,
  `image` varchar(100) NOT NULL,
  `orig_name` varchar(100) NOT NULL,
  `path` varchar(100) NOT NULL,
  `size` int(11) DEFAULT NULL,
  `width_height` varchar(100) NOT NULL,
  `create_date` int(11) DEFAULT NULL,
  `modified_date` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `car_shields`
--

CREATE TABLE `car_shields` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `make` varchar(60) NOT NULL,
  `color` varchar(50) NOT NULL,
  `model` varchar(60) NOT NULL,
  `model_year` int(4) NOT NULL,
  `plate_no` varchar(20) NOT NULL,
  `vin_no` varchar(100) NOT NULL,
  `driver_lic` varchar(20) NOT NULL,
  `shield_no` varchar(60) NOT NULL,
  `status` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `create_date` int(11) NOT NULL,
  `transactionid` varchar(100) NOT NULL,
  `modified_date` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `car_shields_upload`
--

CREATE TABLE `car_shields_upload` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `source_id` int(11) NOT NULL,
  `parent_cat` int(11) NOT NULL,
  `caption` varchar(100) DEFAULT NULL,
  `image` varchar(100) NOT NULL,
  `orig_name` varchar(100) NOT NULL,
  `path` varchar(100) NOT NULL,
  `size` int(11) DEFAULT NULL,
  `width_height` varchar(100) NOT NULL,
  `create_date` int(11) DEFAULT NULL,
  `modified_date` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('094nlkg10pq1g1ag9eokce5822cq40g0', '::1', 1531166118, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533313136363131383b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353331313436393835223b6c6173745f636865636b7c693a313533313136353739313b),
('1f2gjdttdck6s214tl2v5cm8ojpsen7u', '::1', 1531158655, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533313135383635353b726566657272616c5f706167657c733a31383a2275736572735f726567697374726174696f6e223b7472616e73616374696f6e69647c733a33303a22384670444e415a704845444e32636d6e5455635568454a5a676455625a66223b63635f656d61696c7c733a31383a226576656c696f406d61696c6572732e636f6d223b6964656e746974797c733a31343a226d696b6531406d61696c2e636f6d223b757365725f69647c733a313a2233223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313533313135373639393b),
('300oo23fj6sp4r9p11or2l8ekt434jvh', '::1', 1531163098, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533313136333039383b726566657272616c5f706167657c733a31383a2275736572735f726567697374726174696f6e223b7472616e73616374696f6e69647c733a33303a225659344e446d707638533777527059585365795550337a6d425872516579223b63635f656d61696c7c733a31383a226576656c696f406d61696c6572732e636f6d223b6964656e746974797c733a31343a226d696b6533406d61696c2e636f6d223b757365725f69647c733a313a2235223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313533313136303138363b),
('651a5h6l9t1oqcken2ca7gvo7anso5i9', '::1', 1531166474, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533313136363437343b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353331313436393835223b6c6173745f636865636b7c693a313533313136353739313b),
('6e7teku39fejmit7afkbeje3k2od2mjd', '::1', 1531167726, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533313136373732363b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353331313635373931223b6c6173745f636865636b7c693a313533313136373732363b),
('8a68v3phec5mmd5895r6nuoofejq1onr', '::1', 1531161874, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533313136313837343b726566657272616c5f706167657c733a31383a2275736572735f726567697374726174696f6e223b7472616e73616374696f6e69647c733a33303a225659344e446d707638533777527059585365795550337a6d425872516579223b63635f656d61696c7c733a31383a226576656c696f406d61696c6572732e636f6d223b6964656e746974797c733a31343a226d696b6533406d61696c2e636f6d223b757365725f69647c733a313a2235223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313533313136303138363b),
('8hc3546v02sdibh5kc67pd47fg99cuji', '::1', 1531163539, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533313136333533393b726566657272616c5f706167657c733a31383a2275736572735f726567697374726174696f6e223b7472616e73616374696f6e69647c733a33303a225659344e446d707638533777527059585365795550337a6d425872516579223b63635f656d61696c7c733a31383a226576656c696f406d61696c6572732e636f6d223b6964656e746974797c733a31343a226d696b6533406d61696c2e636f6d223b757365725f69647c733a313a2235223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313533313136303138363b),
('8qrd8kpol57btgj63bhnqs7ukbda29rk', '::1', 1531159484, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533313135393438343b6974656d7174797c733a313a2231223b6974656d6e756d6265727c733a393a224c455f416374697665223b6974656d70726963657c733a353a2233352e3030223b7472616e735f747970657c733a31333a2273656c65637465645f706c616e223b676174657761795f6e616d657c733a363a2250617950616c223b66697273745f6e616d657c733a353a224d696b6532223b6c6173745f6e616d657c733a343a2253696361223b6d6964646c655f6e616d657c733a303a22223b70686f6e657c733a31343a222839393929203939392d39393939223b656d61696c7c733a31343a224d696b6532406d61696c2e636f6d223b636f6e6669726d656d61696c7c733a31343a224d696b6532406d61696c2e636f6d223b6974656d6e616d657c733a33353a2231205965617220537562736372697074696f6e207769746820496e6974696174696f6e223b61677265655f7465726d737c733a323a226f6e223b7375626d697470617970616c7c733a303a22223b73657373696f6e5f6b6579737c613a31363a7b693a303b733a373a226974656d717479223b693a313b733a31303a226974656d6e756d626572223b693a323b733a393a226974656d7072696365223b693a333b733a31303a227472616e735f74797065223b693a343b733a31323a22676174657761795f6e616d65223b693a353b733a31303a2266697273745f6e616d65223b693a363b733a393a226c6173745f6e616d65223b693a373b733a31313a226d6964646c655f6e616d65223b693a383b733a353a2270686f6e65223b693a393b733a353a22656d61696c223b693a31303b733a31323a22636f6e6669726d656d61696c223b693a31313b733a383a226974656d6e616d65223b693a31323b733a31313a2261677265655f7465726d73223b693a31333b733a31323a227375626d697470617970616c223b693a31343b733a31313a22746f74616c616d6f756e74223b693a31353b733a31333a226572726f725f6d657373616765223b7d746f74616c616d6f756e747c643a33353b726566657272616c5f706167657c733a31383a2275736572735f726567697374726174696f6e223b7472616e73616374696f6e69647c733a33303a22595577644332685666734a38746452506e516343355a77524e6853795055223b63635f656d61696c7c733a31383a226576656c696f406d61696c6572732e636f6d223b6964656e746974797c733a31343a224d696b6532406d61696c2e636f6d223b757365725f69647c733a313a2234223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313533313135393438343b),
('bkas4oseheorcosrcp3ikadmv03pd14p', '::1', 1531160673, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533313136303637333b726566657272616c5f706167657c733a31383a2275736572735f726567697374726174696f6e223b7472616e73616374696f6e69647c733a33303a225659344e446d707638533777527059585365795550337a6d425872516579223b63635f656d61696c7c733a31383a226576656c696f406d61696c6572732e636f6d223b6964656e746974797c733a31343a226d696b6533406d61696c2e636f6d223b757365725f69647c733a313a2235223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313533313136303138363b),
('cesaculfc59i2kr0j13t3hipmkaq1i2e', '::1', 1531159431, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533313135393430373b),
('d6rpo4p39ev1dc98uk7uio66lnq5favv', '::1', 1531165147, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533313136353134373b726566657272616c5f706167657c733a31383a2275736572735f726567697374726174696f6e223b7472616e73616374696f6e69647c733a33303a225659344e446d707638533777527059585365795550337a6d425872516579223b63635f656d61696c7c733a31383a226576656c696f406d61696c6572732e636f6d223b6964656e746974797c733a31343a226d696b6533406d61696c2e636f6d223b757365725f69647c733a313a2235223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313533313136303138363b),
('e5a836unh2evi2ukviojhttrri5ua4nu', '::1', 1531167855, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533313136373732363b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353331313635373931223b6c6173745f636865636b7c693a313533313136373732363b),
('gelbm1k54l56qujjkeeah9ms2go94m7m', '::1', 1531157639, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533313135373633393b),
('h02f1kvg07t7kphtjku0uhejbuk64hme', '::1', 1531167264, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533313136373236343b6d6573736167657c733a33303a223c703e4c6f67676564204f7574205375636365737366756c6c793c2f703e223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d),
('ibn2lnghlaqoqfjjigc08gsb6927ov4k', '::1', 1531161345, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533313136313334353b726566657272616c5f706167657c733a31383a2275736572735f726567697374726174696f6e223b7472616e73616374696f6e69647c733a33303a225659344e446d707638533777527059585365795550337a6d425872516579223b63635f656d61696c7c733a31383a226576656c696f406d61696c6572732e636f6d223b6964656e746974797c733a31343a226d696b6533406d61696c2e636f6d223b757365725f69647c733a313a2235223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313533313136303138363b),
('jggs5centrt9f3qgpjp3ibpga72ukafh', '::1', 1531162702, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533313136323730323b726566657272616c5f706167657c733a31383a2275736572735f726567697374726174696f6e223b7472616e73616374696f6e69647c733a33303a225659344e446d707638533777527059585365795550337a6d425872516579223b63635f656d61696c7c733a31383a226576656c696f406d61696c6572732e636f6d223b6964656e746974797c733a31343a226d696b6533406d61696c2e636f6d223b757365725f69647c733a313a2235223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313533313136303138363b),
('l6jaaj33m44913sprlvvjs2dep4tunl2', '::1', 1531158962, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533313135383936323b726566657272616c5f706167657c733a31383a2275736572735f726567697374726174696f6e223b7472616e73616374696f6e69647c733a33303a22384670444e415a704845444e32636d6e5455635568454a5a676455625a66223b63635f656d61696c7c733a31383a226576656c696f406d61696c6572732e636f6d223b6964656e746974797c733a31343a226d696b6531406d61696c2e636f6d223b757365725f69647c733a313a2233223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313533313135373639393b),
('ljab6s8667h75pujgd17uhqilo7287ff', '::1', 1531167190, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533313136373139303b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353331313436393835223b6c6173745f636865636b7c693a313533313136353739313b),
('lmtaeo24b0g2iddorv19jcikir0iknsl', '::1', 1531162229, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533313136323232393b726566657272616c5f706167657c733a31383a2275736572735f726567697374726174696f6e223b7472616e73616374696f6e69647c733a33303a225659344e446d707638533777527059585365795550337a6d425872516579223b63635f656d61696c7c733a31383a226576656c696f406d61696c6572732e636f6d223b6964656e746974797c733a31343a226d696b6533406d61696c2e636f6d223b757365725f69647c733a313a2235223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313533313136303138363b),
('m4plt6muthlt19si9bi21vekh4nltpqu', '::1', 1531156962, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533313135363936323b),
('o8r7u2qhn7ml0lea8ntmgmvspu09k8tt', '::1', 1531165764, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533313136353736313b),
('q3iturnt1g84v12t2t3879vv7imeu0gm', '::1', 1531165551, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533313136353535313b726566657272616c5f706167657c733a31383a2275736572735f726567697374726174696f6e223b7472616e73616374696f6e69647c733a33303a225659344e446d707638533777527059585365795550337a6d425872516579223b63635f656d61696c7c733a31383a226576656c696f406d61696c6572732e636f6d223b6964656e746974797c733a31343a226d696b6533406d61696c2e636f6d223b757365725f69647c733a313a2235223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313533313136303138363b),
('q55ra2099rvqpvhrvvq922f7uppal6s9', '::1', 1531165791, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533313136353739313b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353331313436393835223b6c6173745f636865636b7c693a313533313136353739313b),
('r0gff6fv6u0lsvkil4tcbfo60kdrn0tv', '::1', 1531157699, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533313135373639393b6974656d7174797c733a313a2231223b6974656d6e756d6265727c733a393a224c455f416374697665223b6974656d70726963657c733a353a2233352e3030223b7472616e735f747970657c733a31333a2273656c65637465645f706c616e223b676174657761795f6e616d657c733a363a2250617950616c223b66697273745f6e616d657c733a343a226d696b65223b6c6173745f6e616d657c733a343a2253696361223b6d6964646c655f6e616d657c733a303a22223b70686f6e657c733a31343a222839393929203939392d39393939223b656d61696c7c733a31343a226d696b6531406d61696c2e636f6d223b636f6e6669726d656d61696c7c733a31343a226d696b6531406d61696c2e636f6d223b6974656d6e616d657c733a33353a2231205965617220537562736372697074696f6e207769746820496e6974696174696f6e223b61677265655f7465726d737c733a323a226f6e223b7375626d697470617970616c7c733a303a22223b73657373696f6e5f6b6579737c613a31363a7b693a303b733a373a226974656d717479223b693a313b733a31303a226974656d6e756d626572223b693a323b733a393a226974656d7072696365223b693a333b733a31303a227472616e735f74797065223b693a343b733a31323a22676174657761795f6e616d65223b693a353b733a31303a2266697273745f6e616d65223b693a363b733a393a226c6173745f6e616d65223b693a373b733a31313a226d6964646c655f6e616d65223b693a383b733a353a2270686f6e65223b693a393b733a353a22656d61696c223b693a31303b733a31323a22636f6e6669726d656d61696c223b693a31313b733a383a226974656d6e616d65223b693a31323b733a31313a2261677265655f7465726d73223b693a31333b733a31323a227375626d697470617970616c223b693a31343b733a31313a22746f74616c616d6f756e74223b693a31353b733a31333a226572726f725f6d657373616765223b7d746f74616c616d6f756e747c643a33353b726566657272616c5f706167657c733a31383a2275736572735f726567697374726174696f6e223b7472616e73616374696f6e69647c733a33303a22384670444e415a704845444e32636d6e5455635568454a5a676455625a66223b63635f656d61696c7c733a31383a226576656c696f406d61696c6572732e636f6d223b6964656e746974797c733a31343a226d696b6531406d61696c2e636f6d223b757365725f69647c733a313a2233223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313533313135373639393b),
('r3jnv8r7v5aa8ba95v533uvo30ghsdt4', '::1', 1531159803, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533313135393830333b726566657272616c5f706167657c733a31383a2275736572735f726567697374726174696f6e223b7472616e73616374696f6e69647c733a33303a22595577644332685666734a38746452506e516343355a77524e6853795055223b63635f656d61696c7c733a31383a226576656c696f406d61696c6572732e636f6d223b6964656e746974797c733a31343a224d696b6532406d61696c2e636f6d223b757365725f69647c733a313a2234223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313533313135393438343b),
('sugie7ffsumheu534r39m7vt3sb9u0iu', '::1', 1531160186, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533313136303138363b6974656d7174797c733a313a2231223b6974656d6e756d6265727c733a393a224c455f416374697665223b6974656d70726963657c733a353a2233352e3030223b7472616e735f747970657c733a31333a2273656c65637465645f706c616e223b676174657761795f6e616d657c733a363a2250617950616c223b66697273745f6e616d657c733a353a226d696b6533223b6c6173745f6e616d657c733a343a2273696361223b6d6964646c655f6e616d657c733a303a22223b70686f6e657c733a31343a222839393929203939392d39393939223b656d61696c7c733a31343a226d696b6533406d61696c2e636f6d223b636f6e6669726d656d61696c7c733a31343a226d696b6533406d61696c2e636f6d223b6974656d6e616d657c733a33353a2231205965617220537562736372697074696f6e207769746820496e6974696174696f6e223b61677265655f7465726d737c733a323a226f6e223b7375626d697470617970616c7c733a303a22223b73657373696f6e5f6b6579737c613a31363a7b693a303b733a373a226974656d717479223b693a313b733a31303a226974656d6e756d626572223b693a323b733a393a226974656d7072696365223b693a333b733a31303a227472616e735f74797065223b693a343b733a31323a22676174657761795f6e616d65223b693a353b733a31303a2266697273745f6e616d65223b693a363b733a393a226c6173745f6e616d65223b693a373b733a31313a226d6964646c655f6e616d65223b693a383b733a353a2270686f6e65223b693a393b733a353a22656d61696c223b693a31303b733a31323a22636f6e6669726d656d61696c223b693a31313b733a383a226974656d6e616d65223b693a31323b733a31313a2261677265655f7465726d73223b693a31333b733a31323a227375626d697470617970616c223b693a31343b733a31313a22746f74616c616d6f756e74223b693a31353b733a31333a226572726f725f6d657373616765223b7d746f74616c616d6f756e747c643a33353b726566657272616c5f706167657c733a31383a2275736572735f726567697374726174696f6e223b7472616e73616374696f6e69647c733a33303a225659344e446d707638533777527059585365795550337a6d425872516579223b63635f656d61696c7c733a31383a226576656c696f406d61696c6572732e636f6d223b6964656e746974797c733a31343a226d696b6533406d61696c2e636f6d223b757365725f69647c733a313a2235223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313533313136303138363b),
('urhi08amtmeeoqjs39u15766so6uf7t0', '::1', 1531159398, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533313135393339383b726566657272616c5f706167657c733a31383a2275736572735f726567697374726174696f6e223b7472616e73616374696f6e69647c733a33303a22384670444e415a704845444e32636d6e5455635568454a5a676455625a66223b63635f656d61696c7c733a31383a226576656c696f406d61696c6572732e636f6d223b6964656e746974797c733a31343a226d696b6531406d61696c2e636f6d223b757365725f69647c733a313a2233223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313533313135373639393b);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `update_id` int(11) NOT NULL,
  `comment_type` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contact_message`
--

CREATE TABLE `contact_message` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `email` varchar(100) NOT NULL,
  `source` varchar(25) NOT NULL,
  `create_date` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` int(11) NOT NULL,
  `sent_by` int(11) NOT NULL,
  `sent_to` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `opened` tinyint(1) NOT NULL,
  `code` varchar(6) NOT NULL,
  `urgent` tinyint(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `legislative_outreach`
--

CREATE TABLE `legislative_outreach` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `middle_name` varchar(40) NOT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` char(2) DEFAULT NULL,
  `zip` char(5) DEFAULT NULL,
  `occupation` varchar(100) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `cell_phone` varchar(14) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(200) NOT NULL,
  `create_date` int(11) NOT NULL,
  `modified_date` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `main_menu`
--

CREATE TABLE `main_menu` (
  `id` bigint(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `link` varchar(50) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `parentid` bigint(20) NOT NULL DEFAULT '0',
  `priority` tinyint(2) DEFAULT NULL,
  `level` tinyint(2) DEFAULT NULL,
  `modified_date` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `main_menu`
--

INSERT INTO `main_menu` (`id`, `title`, `link`, `parentid`, `priority`, `level`, `modified_date`, `admin_id`) VALUES
(72, 'Staff', 'Staff', 66, 4, 0, 0, 0),
(71, 'President\'s Message', 'President-Message', 66, 2, 0, 0, 0),
(64, 'Home', '', 0, 0, 0, 0, 0),
(66, 'About Us', 'Mission-Statement', 0, 1, 0, 0, 0),
(67, 'Making a Difference', 'Making-a-Difference', 0, 2, 0, 0, 0),
(68, 'Blue Mass', 'Blue-Mass', 0, 3, 0, 0, 0),
(69, 'Mission Statement', 'Mission-Statement', 66, 0, 0, 0, 0),
(70, 'Introduction and History', 'Introduction-and-History', 66, 1, 0, 0, 0),
(73, 'Financial Reports', 'Financial-Reports', 66, 5, 0, 0, 0),
(74, 'Contact Us', 'Contact-Us', 66, 6, 0, 0, 0),
(75, '10-13 Officer Needs Assistance', '10-13-Officer-Needs- Assistance', 67, 0, 0, 0, 0),
(76, 'Officer Shot and Down', 'Officer-Shot-and-Down', 67, 1, 0, 0, 0),
(77, 'Donations and Testimonials', 'Donations-and-Testimonials', 67, 2, 0, 0, 0),
(78, 'Protection Vest and Equipment', 'Protection-Vest-and-Equipment', 67, 3, 0, 0, 0),
(79, 'Program', 'Program', 67, 4, 0, 0, 0),
(80, 'Meetings and Events', 'Meetings-and-Events', 0, 4, 0, 0, 0),
(82, 'Meeting Schedule', 'Meeting-Schedule', 80, 1, 0, 0, 0),
(83, 'Bulletin Board', 'Bulletin-Board', 80, 2, 0, 0, 0),
(84, 'Monthly Calendar', 'Monthly-Calendar', 80, 3, 0, 0, 0),
(85, 'Cigar Events', 'Cigar-Events', 80, 0, 0, 0, 0),
(86, 'Awards Dinner', 'Awards-Dinner', 80, 4, 0, 0, 0),
(87, 'Political Action', 'Political-Action', 0, 5, 0, 0, 0),
(88, 'Cop Shop', 'Cop-Shop', 0, 6, 0, 0, 0),
(89, 'Brotherhood In Action', 'Brotherhood-In-Action', 0, 7, 0, 0, 0),
(90, 'Move Over Law', 'Move-Over-Law', 89, 0, 0, 0, 0),
(91, 'National Blue Alert', 'National-Blue-Alert', 89, 1, 0, 0, 0),
(92, 'POB support', 'POB-Support', 89, 2, 0, 0, 0),
(94, 'POB Pays Tribute', 'POB-Pays-Tribute', 89, 3, 0, 0, 0),
(95, 'Board Members', 'Board-Members', 66, 3, 0, 0, 0),
(96, 'Home', '', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `membership_plans`
--

CREATE TABLE `membership_plans` (
  `mem_plan_level` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `mem_plan_details` text COLLATE utf8_unicode_ci NOT NULL,
  `mem_plan_benefits` text COLLATE utf8_unicode_ci NOT NULL,
  `mem_dues1` float(7,2) NOT NULL,
  `mem_dues2` float(7,2) NOT NULL,
  `mem_life` float(7,2) NOT NULL,
  `mem_initiation` float(7,2) NOT NULL,
  `mem_create_dt` datetime NOT NULL,
  `admin_username` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `mem_plan_image` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `mem_category` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `form_header` varchar(100) CHARACTER SET utf8 NOT NULL,
  `form_mode` int(11) NOT NULL,
  `form_extend` varchar(1) CHARACTER SET utf8 NOT NULL,
  `modified_date` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `membership_plans`
--

INSERT INTO `membership_plans` (`mem_plan_level`, `mem_plan_details`, `mem_plan_benefits`, `mem_dues1`, `mem_dues2`, `mem_life`, `mem_initiation`, `mem_create_dt`, `admin_username`, `mem_plan_image`, `mem_category`, `form_header`, `form_mode`, `form_extend`, `modified_date`, `admin_id`) VALUES
('2-Associate', 'Replace this info....', '', 200.00, 525.00, 3500.00, 0.00, '2013-11-03 16:06:10', 'evelio1157', '1-2T.jpg', 'Civilian', 'Associate Membership', 2, '', 0, 0),
('3-Civilian', '<b>The Civilian Law Enforcement / Private Professional membership</b> shall be comprised of those individuals (Civilians Personnel) who are employed by Law Enforcement Agencies but do not have law enforcement powers of arrest or Private Professionals such as Private Investigators / Constable Officers / Security Officers who wish to be affiliated with this Organization. The yearly membership dues shall be ($85.00) with an additional $25.00 Initiation Fee for a total of $110.00', '0', 100.00, 250.00, 1500.00, 25.00, '2013-11-03 16:12:35', 'evelio1157', '2-2T.jpg', 'Civilian', 'Civilian Law Enforcement Membership', 1, '1', 0, 0),
('4-Family', '<b>The Family membership</b> shall be comprised of individuals recognized by this Organization as a family members (spouse, children 18 years of age and parents) of an Active / Retired law enforcement member of this organization. The yearly membership dues shall be ($95.00) with an additional $25.00 Initiation Fee for a total of $120.00.', '0', 95.00, 230.00, 1000.00, 25.00, '2013-11-03 16:13:51', 'evelio1175', '3-2T.jpg', 'Civilian', 'Family Members of Law Enforcement', 2, '', 0, 0),
('5a-Club Gold', '<b>Club Honorary Gold membership</b>', '0', 1250.00, 3250.00, 12500.00, 250.00, '0000-00-00 00:00:00', 'evelio1157', '4-2T.jpg', 'Club', '', 0, '', 0, 0),
('5a-Gold', '<b>The Honorary Gold membership</b> shall be comprised of individuals recognized by this Organization for exceptional contributions or services to the Law Enforcement Community and/or the State, political subdivision. The yearly membership dues shall be $1,250.00 with an additional $250.00 Initiation Fee. Said fees may be waived by the Executive Director.', '0', 1250.00, 3250.00, 12500.00, 250.00, '2013-11-03 16:17:18', 'evelio1157', '4-2T.jpg', 'Civilian', 'Honorary Gold Membership', 2, '', 0, 0),
('5b-Club Silver', '<b>Club Silver membership</b>', '0', 750.00, 2000.00, 7500.00, 250.00, '0000-00-00 00:00:00', 'evelio1157', '5-2T.jpg', 'Club', '', 0, '', 0, 0),
('5b-Silver', '<b>The Honorary Silver membership</b> shall be comprised of individuals recognized by this Organization for exceptional contributions or services to the Law Enforcement Community and/or the State, political subdivision. The yearly membership dues shall be $750.00 with an additional $250.00 Initiation Fee. Said fees may be waived by the Executive Director.', '0', 750.00, 2000.00, 7500.00, 250.00, '2013-11-03 16:21:38', 'evelio1157', '5-2T.jpg', 'Civilian', 'Honorary Silver Membership', 2, '', 0, 0),
('5c-Bronze', '<b>The Honorary Bronze membership</b> shall be comprised of individuals recognized by this Organization for exceptional contributions or services to the Law Enforcement Community and/or the State, political subdivision. The yearly membership dues shall be $500.00 with an additional $250.00 Initiation Fee. Said fees may be waived by the Executive Director.', '0', 500.00, 1350.00, 5500.00, 250.00, '2013-11-03 16:22:55', 'evelio1157', '6-2T.jpg', 'Civilian', 'Honorary Bronze Membership', 2, '', 0, 0),
('5c-Club Bronze', '<b>Club Honorary Bronze membership</b>', '0', 500.00, 1350.00, 5500.00, 250.00, '0000-00-00 00:00:00', 'evelio1157', '6-2T.jpg', 'Club', '', 0, '', 0, 0),
('LE_Active', '<b>(1) Any Regularly Appointed or Elected Law Enforcement Officer* Official Active or Retired</b> of these United States, or any State, political subdivision thereof, for any agency who is sworn to up hold the law shall be eligible for membership in the Organization, subject to provisions set forth in the Constitution and By-Laws of this Organization. No person shall be denied membership on account of race, religion, sex, age, creed, color or national origin.<br /><br /><b>(2) The Active, Former * Retired Membership</b> shall be comprised of regularly appointed or elected Law Enforcement Officers*Officials sworn to up hold the law of the United States or any of the States or political subdivisions. This class may include, subject to the approval of the Executive Board, those members who formerly served as a law enforcement officer for more than one (1) year. The yearly membership dues shall be ($35.00) or ($90.00) for 3 years savings of $15.00. Said fee may be waived by vote of the Executive Board. All members in good standing active, former * retired, (as herein defined), and those members assigned to positions with titles of Director and*or committee chairman, shall have voice and right to vote on all issues.', '0', 35.00, 90.00, 0.00, 0.00, '2013-11-03 21:57:15', 'evelio1157', '1-2T.jpg', 'LE', 'Active Law Enforcement Membership', 1, '1', 0, 0),
('LE_Retired-Form', '<b>(1) Any Regularly Appointed or Elected Law Enforcement Officer* Official Active or Retired</b> of these United States, or any State, political subdivision thereof, for any agency who is sworn to up hold the law shall be eligible for membership in the Organization, subject to provisions set forth in the Constitution and By-Laws of this Organization. No person shall be denied membership on account of race, religion, sex, age, creed, color or national origin.<br /><br /><b>(2) The Active, Former * Retired Membership</b> shall be comprised of regularly appointed or elected Law Enforcement Officers*Officials sworn to up hold the law of the United States or any of the States or political subdivisions. This class may include, subject to the approval of the Executive Board, those members who formerly served as a law enforcement officer for more than one (1) year. The yearly membership dues shall be ($35.00) or ($90.00) for 3 years savings of $15.00. Said fee may be waived by vote of the Executive Board. All members in good standing active, former * retired, (as herein defined), and those members assigned to positions with titles of Director and*or committee chairman, shall have voice and right to vote on all issues.', '', 35.00, 90.00, 350.00, 0.00, '0000-00-00 00:00:00', '', '', 'LE', 'Retired/Former Law Enforcement Membership', 1, '1', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `msite_accounts`
--

CREATE TABLE `msite_accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(30) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET ucs2 NOT NULL,
  `company_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `add1` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `add2` varchar(40) CHARACTER SET utf8 NOT NULL,
  `city` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `cell` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `create_date` int(11) NOT NULL,
  `modified_date` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `msite_ads`
--

CREATE TABLE `msite_ads` (
  `id` int(11) NOT NULL,
  `item_title` varchar(255) NOT NULL,
  `item_url` varchar(255) NOT NULL,
  `item_price` int(11) NOT NULL,
  `item_description` text NOT NULL,
  `ad_id` varchar(100) NOT NULL,
  `page_order` int(2) NOT NULL,
  `status` int(1) NOT NULL,
  `create_date` int(11) NOT NULL,
  `mod_dt` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `modified_date` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `msite_ads`
--

INSERT INTO `msite_ads` (`id`, `item_title`, `item_url`, `item_price`, `item_description`, `ad_id`, `page_order`, `status`, `create_date`, `mod_dt`, `userid`, `modified_date`, `admin_id`) VALUES
(1, 'Business Sponsorship', 'Business-Sponsorship', 2500, '<ul><li>1 Silver Wallet & badge Credential</li><li>2 Decals</li><li>2 POB Drive Safe Cards</li></ul>                     ', 'Full Page', 1, 1, 0, 0, 0, 0, 0),
(2, 'Business Sponsorship', 'Business-Sponsorship', 1500, '                              <div><ul><li>1 Bronze Wallet Badge & Credentials</li><li>2 POB Drive Safe Cards</li><li>2 Decals</li></ul></div>                                               ', 'Half Page', 2, 1, 0, 0, 0, 0, 0),
(3, 'Corporate ', 'Corporate', 50000, '            <font size=\"2\">      Here we go again.</font><div><font size=\"2\">Time to raise funds for our cause.</font></div><div xss=\"removed\"><span xss=\"removed\"><font color=\"#ff0000\">Join Us!</font></span></div><div xss=\"removed\" xss=removed><br></div>               ', 'Full Page', 1, 1, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `msite_buy_ads`
--

CREATE TABLE `msite_buy_ads` (
  `id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `transactionid` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `payment_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prod_descrip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `art_work` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `art_upload_date` int(11) NOT NULL,
  `create_date` int(11) NOT NULL,
  `admin_user` int(11) NOT NULL,
  `modified_date` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `msite_categories`
--

CREATE TABLE `msite_categories` (
  `id` int(11) NOT NULL,
  `cat_title` varchar(255) NOT NULL,
  `parent_cat_id` int(11) DEFAULT NULL,
  `category_url` varchar(255) NOT NULL,
  `create_date` int(11) NOT NULL,
  `modified_date` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `site_admin_emails`
--

CREATE TABLE `site_admin_emails` (
  `id` int(11) NOT NULL,
  `type` varchar(60) CHARACTER SET utf32 NOT NULL,
  `admin_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `from` varchar(60) CHARACTER SET utf8 NOT NULL,
  `subject` varchar(70) CHARACTER SET utf8 NOT NULL,
  `body` text CHARACTER SET utf8 NOT NULL,
  `date` date NOT NULL,
  `admin_user` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `site_admin_emails`
--

INSERT INTO `site_admin_emails` (`id`, `type`, `admin_email`, `from`, `subject`, `body`, `date`, `admin_user`) VALUES
(1, 'activate', 'supervisor@netcart-dev.com', 'customerservice@njlepob.com', 'Activate your NJLEPOB account.', 'Thank you for joining our family that we call The brotherhood.\r\n\r\nPlease click on the link below to activate your account. You will be directed to a page and asked to enter a password for your account.\r\n\r\n\r\n%syouraccount/activate/%s\r\n\r\n\r\n\r\n\r\n\r\nPlease be advised that your membership cannot take effect until you complete and submit your application in full in order for you to receive membership benefits. \r\n\r\n\r\n\r\n~NJLEPOB\r\n\r\n', '2014-06-14', 'evelio'),
(2, 'activateAds', 'supervisor@netcart-dev.com', 'sales-support@njlepob.com', 'We have received your Ad Purchase', 'Thank you for the placing your ad with us.\r\n\r\nPlease click on the link below to activate your account. You have also been assigned a temporary User Id and Password to login and upload art work for your paid ad.\r\n\r\nhttp://%s/members/ad-activate.php?activate=%s\r\n\r\nUserid  : %s\r\nPassword: %s\r\n\r\nOn behalf of the New Jersey Law Enforcement Police Officers Brotherhood I would like to take this opportunity to thank you for your recent interest in taking an ad in our BUSINESS DIRECTORY & BUYERS GUIDE This directory & guide will be disseminated to all of our members as well as given out at our organizational events. We ask all our members & supporters to patronize the businesses in our book. The New Jersey Law Enforcement Police Officers Brotherhood is a non-profit organization and our membership is comprised of active and retired Law Enforcement Officers throughout the state of New Jersey as well as concerned citizens like your self.\r\n\r\n\r\n\r\n~NJLEPOB\r\n\r\n', '2014-06-16', 'evelio'),
(3, 'memFormCompleted', 'supervisor@netcart-dev.com', 'memrbershipsupport@njlepob.com', 'Your membership application is complete', 'Your completed membership application has been received and will be reviewed for approval.\r\n\r\n\r\n~NJLEPOB\r\n\r\n', '0000-00-00', ''),
(4, 'memFormNotComplete', 'supervisor@netcart-dev.com', 'membershipsupport@njlepob.com', 'Your membership application is incomplete.', 'Your membership application has been received but remains incomplete. Membership cannot take effect until you complete and submit your application in full in order for you to receive membership benefits.\r\n\r\nPlease take a moment to log into your account and finish filling out the form.\r\n\r\n\r\n\r\n~NJLEPOB\r\n', '0000-00-00', ''),
(5, 'recover', 'supervisor@netcart-dev.com', 'customerservice@njlepob.com', 'NJLEPOB - Credentials Recovery', 'You have been assigned a temporary User Id and Password. Login and proceed to reset your password.\r\n\r\n\r\n%syouraccount/activate/%s\r\n\r\n\r\n~NJLEPOB\r\n\r\n', '2014-08-17', 'evelio'),
(6, 'car_shield', 'supervisor@netcart-dev.com', 'customerservice@njlepob.com', 'Car Shield paymnent received.', 'Your payment for the Car Shield has been received.\r\n\r\n\r\n\r\n~NJLEPOB\r\n\r\n', '2014-06-14', 'evelio'),
(7, 'registration_paid', 'supervisor@netcart-dev.com', 'customerservice@njlepob.com', '< ==== > payments have been received.', 'Your payment for < ==== > has been received.\r\n\r\n\r\n\r\n~NJLEPOB\r\n\r\n', '2014-06-14', 'evelio');

-- --------------------------------------------------------

--
-- Table structure for table `site_admin_terms_conditions`
--

CREATE TABLE `site_admin_terms_conditions` (
  `id` int(11) NOT NULL,
  `author` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `agreement` text,
  `create_date` int(11) NOT NULL,
  `modified_date` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `site_cookies`
--

CREATE TABLE `site_cookies` (
  `id` int(11) NOT NULL,
  `cookie_code` varchar(128) NOT NULL,
  `user_id` int(11) NOT NULL,
  `expiry_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `site_messages`
--

CREATE TABLE `site_messages` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `type` enum('info','warning','danger','default','success') NOT NULL,
  `create_date` int(11) NOT NULL,
  `modified_date` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site_messages`
--

INSERT INTO `site_messages` (`id`, `title`, `message`, `type`, `create_date`, `modified_date`, `admin_id`) VALUES
(1, 'save_exit_application', 'Your membership application has been saved but remains incomplete. Membership cannot take effect until you complete and submit your application in full in order for you to receive membership benefits.', 'info', 0, 0, 1),
(2, 'save_check_email', 'Thank you for joining our family that we call The brotherhood.\r\n\r\nAn email has been sent for you to activate your account.', 'success', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `site_payments`
--

CREATE TABLE `site_payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transactionid` varchar(100) NOT NULL,
  `trans_type` varchar(100) NOT NULL,
  `itemnumber` varchar(100) NOT NULL,
  `pay_method` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `check_no` varchar(100) NOT NULL,
  `cc_email` varchar(100) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `create_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site_payments`
--

INSERT INTO `site_payments` (`id`, `user_id`, `transactionid`, `trans_type`, `itemnumber`, `pay_method`, `amount`, `check_no`, `cc_email`, `username`, `create_date`) VALUES
(1, 1, '5ALE7GCWAF5YvDS6h3XeF6XNrxakhq', '1 Year Subscription with Initiation', 'LE_Active', 'PayPal', '35.00', '', 'evelio@mailers.com', NULL, 1531147172),
(2, 2, 'anSkFfKnXu7dc46rvw4HfpfUxHZTSt', '1 Year Subscription with Initiation', 'LE_Active', 'PayPal', '35.00', '', 'evelio@mailers.com', NULL, 1531147349),
(3, 3, '8FpDNAZpHEDN2cmnTUcUhEJZgdUbZf', '1 Year Subscription with Initiation', 'LE_Active', 'PayPal', '35.00', '', 'evelio@mailers.com', NULL, 1531157699),
(4, 4, 'YUwdC2hVfsJ8tdRPnQcC5ZwRNhSyPU', '1 Year Subscription with Initiation', 'LE_Active', 'PayPal', '35.00', '', 'evelio@mailers.com', NULL, 1531159484),
(5, 5, 'VY4NDmpv8S7wRpYXSeyUP3zmBXrQey', '1 Year Subscription with Initiation', 'LE_Active', 'PayPal', '35.00', '', 'evelio@mailers.com', NULL, 1531160186);

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
(6, 'Law Enforcement or Agency Photo ID', 1, 'Law-Enforcement-or-Agency-Photo-ID', 0, 0, 0, 0),
(7, 'Color Passport Picture', 1, 'Color-Passport-Picture', 0, 0, 0, 0),
(8, 'Right Thumb Finger Print', 1, 'Right-Thumb-Finger-Print', 0, 0, 0, 0),
(10, 'Car Shield', 0, 'Car-Shield', 0, 0, 0, 0),
(11, 'Registratation', 10, 'Registratation', 0, 0, 0, 0),
(12, 'Driver License Front', 10, 'Driver-License-Front', 0, 0, 0, 0),
(13, 'Driver License Back', 10, 'Driver-License-Back', 0, 0, 0, 0),
(15, 'Insurance Card', 10, 'Insurance-Card', 0, 0, 0, 0),
(16, 'test 1 sub', 16, 'test-1-sub', 0, 0, 0, 0),
(17, 'test 2', 0, 'test-2', 0, 0, 0, 0),
(18, 'test 3', 0, 'test-3', 0, 0, 0, 0),
(19, 'sub 1', 18, 'sub-1', 0, 0, 0, 0),
(20, 'sub 33', 18, 'sub-33', 0, 0, 0, 0),
(22, 'sub 44', 18, 'sub-44', 0, 0, 0, 0),
(24, 'sub 55', 18, 'sub-55', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `site_users_upload`
--

CREATE TABLE `site_users_upload` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `source_id` int(11) NOT NULL,
  `parent_cat` int(11) NOT NULL,
  `caption` varchar(100) DEFAULT NULL,
  `image` varchar(100) NOT NULL,
  `orig_name` varchar(100) NOT NULL,
  `path` varchar(100) NOT NULL,
  `size` int(11) DEFAULT NULL,
  `width_height` varchar(100) NOT NULL,
  `create_date` int(11) DEFAULT NULL,
  `modified_date` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(30) NOT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `cell_phone` varchar(14) NOT NULL,
  `avatar_name` varchar(30) NOT NULL,
  `exp_date` int(11) NOT NULL,
  `old_expire` int(11) NOT NULL,
  `membership_level` varchar(20) NOT NULL,
  `app_completed_date` int(11) NOT NULL,
  `create_date` int(11) NOT NULL,
  `transactionid` varchar(255) NOT NULL,
  `modified_date` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `middle_name`, `company`, `phone`, `cell_phone`, `avatar_name`, `exp_date`, `old_expire`, `membership_level`, `app_completed_date`, `create_date`, `transactionid`, `modified_date`, `admin_id`, `is_delete`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$08$Xmo2C/45zCQoSZjTi39OZ.7IIyGJF6yN06y9.12U74gxFmGZVfdiG', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1531167726, 1, 'Evelio', 'Velez', 'M.', 'ADMIN', '(973) 478-8813', '(551) 551-5555', '1_avatar_Koala.jpg', 0, 0, 'LE_active', 1531165901, 0, '', 1531165901, 1, 0),
(2, '::1', 'supervisor', '$2y$08$UPC/wEcNAElV5Gs9GwU3F.R65RR2F9yL5HBmcP3t2fStKC/lpSssi', NULL, 'supervisor@netcart-dev.com', NULL, NULL, NULL, NULL, 1531147172, 1531147207, 1, 'john', 'smith', '', NULL, '(452) 348-7451', '', '', 0, 0, 'LE_Active', 0, 0, '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` char(2) DEFAULT NULL,
  `zip` char(5) DEFAULT NULL,
  `county` varchar(30) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `create_date` int(11) NOT NULL,
  `modified_date` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`id`, `user_id`, `address1`, `address2`, `city`, `state`, `zip`, `county`, `country`, `create_date`, `modified_date`, `admin_id`) VALUES
(1, 1, 'aaaaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaa', 'aaaaaaaaaaaa', 'NJ', '07601', 'bergen', NULL, 1531147172, 1531165824, 1),
(2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1531147349, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_children`
--

CREATE TABLE `user_children` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `child_fname` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `child_lname` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `child_dob` date DEFAULT NULL,
  `child_gender` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_date` int(11) NOT NULL,
  `modified_date` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_employment_le`
--

CREATE TABLE `user_employment_le` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `le_agency` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `le_dept` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `le_add1` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `le_add2` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `le_city` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `le_state` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `le_zip` char(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `le_rank` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `le_email` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `le_phone` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `le_dt_hired` date DEFAULT NULL,
  `le_dt_retired` date DEFAULT NULL,
  `le_yos` int(3) DEFAULT NULL,
  `create_date` int(11) NOT NULL,
  `modified_date` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_employment_le`
--

INSERT INTO `user_employment_le` (`id`, `user_id`, `le_agency`, `le_dept`, `le_add1`, `le_add2`, `le_city`, `le_state`, `le_zip`, `le_rank`, `le_email`, `le_phone`, `le_dt_hired`, `le_dt_retired`, `le_yos`, `create_date`, `modified_date`, `admin_id`) VALUES
(1, 1, 'aaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaa', 'aaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaa', 'NJ', '07601', 'aaaaaaaaaaaaaa', 'mail@mail.com', '(973) 478-8813', '2010-10-20', NULL, NULL, 1531147172, 1531165901, 1),
(2, 2, NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1531147349, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_employment_prv_sector`
--

CREATE TABLE `user_employment_prv_sector` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `prv_sector` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `prv_sector_employer` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prv_sector_dept` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prv_sector_add1` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prv_sector_add2` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prv_sector_city` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prv_sector_state` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prv_sector_zip` char(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prv_sector_position` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prv_sector_email` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prv_sector_phone` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prv_sector_dt_hired` date DEFAULT NULL,
  `create_date` int(11) NOT NULL,
  `modified_date` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_employment_prv_sector`
--

INSERT INTO `user_employment_prv_sector` (`id`, `user_id`, `prv_sector`, `prv_sector_employer`, `prv_sector_dept`, `prv_sector_add1`, `prv_sector_add2`, `prv_sector_city`, `prv_sector_state`, `prv_sector_zip`, `prv_sector_position`, `prv_sector_email`, `prv_sector_phone`, `prv_sector_dt_hired`, `create_date`, `modified_date`, `admin_id`) VALUES
(1, 1, 'No', NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1531147172, 1531165901, 1),
(2, 2, '', NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1531147349, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `registered_voter` char(6) CHARACTER SET utf8 DEFAULT NULL,
  `legislative_dist` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `driver_lic` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `height` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `social_sec` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hair_color` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `eye_color` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `marital_status` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `spouse_fname` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `spouse_lname` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `spouse_dob` date DEFAULT NULL,
  `spouse_gender` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `spouse_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `children` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_date` int(11) NOT NULL,
  `modified_date` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `user_id`, `registered_voter`, `legislative_dist`, `gender`, `dob`, `driver_lic`, `height`, `weight`, `social_sec`, `hair_color`, `eye_color`, `marital_status`, `spouse_fname`, `spouse_lname`, `spouse_dob`, `spouse_gender`, `spouse_email`, `children`, `create_date`, `modified_date`, `admin_id`) VALUES
(1, 1, 'Yes', '32', 'Male', '2010-10-20', 'aaaaaaaaaaaaaaaaaaaa', '5-9', 185, NULL, 'brn', 'brn', 'Single', NULL, NULL, NULL, NULL, '', NULL, 1531147172, 1531165858, 1),
(2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1531147349, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_mail_to`
--

CREATE TABLE `user_mail_to` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mail_add1` varchar(100) DEFAULT NULL,
  `mail_add2` varchar(100) DEFAULT NULL,
  `mail_city` varchar(30) DEFAULT NULL,
  `mail_state` char(2) DEFAULT NULL,
  `mail_zip` char(5) DEFAULT NULL,
  `create_date` int(11) NOT NULL,
  `modified_date` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_mail_to`
--

INSERT INTO `user_mail_to` (`id`, `user_id`, `mail_add1`, `mail_add2`, `mail_city`, `mail_state`, `mail_zip`, `create_date`, `modified_date`, `admin_id`) VALUES
(1, 1, 'aaaaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaa', 'aaaaaaaaaaaa', 'NJ', '07601', 1531147172, 1531165824, 1),
(2, 2, NULL, NULL, NULL, NULL, NULL, 1531147349, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `webpages`
--

CREATE TABLE `webpages` (
  `id` int(11) NOT NULL,
  `page_url` varchar(255) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_keywords` text NOT NULL,
  `image_repro` varchar(10) DEFAULT NULL,
  `left_side_nav` varchar(10) DEFAULT NULL,
  `page_description` text NOT NULL,
  `page_content` text NOT NULL,
  `page_overide` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `create_date` int(11) NOT NULL,
  `mod_dt` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `modified_date` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `webpages`
--

INSERT INTO `webpages` (`id`, `page_url`, `page_title`, `page_keywords`, `image_repro`, `left_side_nav`, `page_description`, `page_content`, `page_overide`, `status`, `create_date`, `mod_dt`, `userid`, `modified_date`, `admin_id`) VALUES
(1, '', 'Home Page', '                                                                                        ', NULL, '', '                                                                                        ', '                                            ', '', 0, 0, 0, 0, 0, 0),
(2, 'Contact-Us', 'Contact Us', '                  keywords here               ', '', '', '                  Description Here               ', '           ', '', 0, 0, 0, 0, 0, 0),
(3, 'Mission-Statement', 'Mission Statement', '                                                       ', '0', '', '', '                                ', '', 0, 0, 0, 0, 0, 0),
(4, 'Introduction-and-History', 'Introduction and History', '                                                                                                                                                                                                                                                                                                                                                                                                                       ', '', '', '                                                                                                                                                                                                                                                                                                                                                                                                                       ', '                                                                                                                                                                                                                  &nbsp;                                                                                                                                                                                                     ', '', 0, 0, 0, 0, 0, 0),
(5, 'President-Message', 'President Message', '                      ', '0', '', '                      ', '                      ', '', 0, 0, 0, 0, 0, 0),
(6, 'Board-Members', 'Board Members', '                                                                  ', '0', '', '                                                                  ', '                                                                  ', '', 2, 0, 0, 0, 0, 0),
(7, 'Financial-Reports', 'Financial Reports', '                      ', '0', '', '                      ', '                      ', '', 2, 0, 0, 0, 0, 0),
(8, 'Making-a-Difference', 'Making a Difference', '                                                       ', '', '', '                                                       ', '                                                       ', '', 0, 0, 0, 0, 0, 0),
(9, '10-13-Officer-Needs-Assistance', '10-13 Officer Needs Assistance', '                                                                  ', NULL, NULL, '                                                                  ', '                                                                  ', '', 2, 0, 0, 0, 0, 0),
(10, 'Officer-Shot-and-Down', 'Officer Shot and Down', '                      ', '0', '', '                      ', '                      ', '', 2, 0, 0, 0, 0, 0),
(11, 'Donations-and-Testimonials', 'Donations and Testimonials', '                      ', 'accept', '', '                      ', '                      ', '', 0, 0, 0, 0, 0, 0),
(12, 'Protection-Vest-and-Equipment', 'Protection Vest and Equipment', '                                 ', '0', '', '                                 ', '                                 ', '', 2, 0, 0, 0, 0, 0),
(13, 'Program', 'Program', '                      ', '0', '', '                      ', '                      ', '', 2, 0, 0, 0, 0, 0),
(14, 'Blue-Mass', 'Blue Mass', '                                                                  ', '', '', '                                                                  ', '                                                                  ', '', 0, 0, 0, 0, 0, 0),
(15, 'Meeting-Schedule', 'Meeting Schedule', '                                                                                        ', NULL, '', '                                                                                        ', '                                                                                        ', '', 0, 0, 0, 0, 0, 0),
(16, 'Bulletin-Board', 'Bulletin Board', '           ', '0', '', '           ', '           ', '', 2, 0, 0, 0, 0, 0),
(17, 'Monthly-Calendar', 'Monthly Calendar', '                      ', '0', '', '                      ', '                      ', '', 2, 0, 0, 0, 0, 0),
(18, 'Cigar-Events', 'Cigar Events', '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      ', 'accept', '', '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      ', '', '', 0, 0, 0, 0, 0, 0),
(19, 'Awards-Dinner', 'Awards Dinner', '                                                       ', 'accept', '', '                                                       ', '                                                       ', '', 0, 0, 0, 0, 0, 0),
(20, 'Political-Action', 'Political Action', '           ', '0', '', '           ', '           ', '', 2, 0, 0, 0, 0, 0),
(21, 'Cop-Shop', 'Cop Shop', '           ', '0', '', '           ', '           ', '', 2, 0, 0, 0, 0, 0),
(22, 'Brotherhood-in-Action', 'Brotherhood in Action', '                      ', 'accept', '', '                      ', '                      ', '', 0, 0, 0, 0, 0, 0),
(23, 'Move-Over-Law', 'Move Over Law', '                                 ', 'accept', '', '                                 ', '                                 ', '', 0, 0, 0, 0, 0, 0),
(24, 'National-Blue-Alert', 'National Blue Alert', '                                 ', 'accept', '', '                                 ', '                                 ', '', 0, 0, 0, 0, 0, 0),
(25, 'POB-Support', 'POB Support', '                      ', 'accept', '', '                      ', '                      ', '', 0, 0, 0, 0, 0, 0),
(26, 'POB-Pays-Tribute', 'POB Pays Tribute', '                      ', 'accept', '', '                      ', '                      ', '', 0, 0, 0, 0, 0, 0),
(27, 'Staff', 'Staff', '                                                                                                                                                                     ', '', '', '                                                                                                                                                                     ', '                  Hi! Here I am................               ', '', 0, 0, 0, 0, 0, 0),
(28, 'Blue-Mass-2004', 'Blue Mass 2004', '                                                       ', 'accept', '', '                                                       ', '                                                       ', '', 0, 0, 0, 0, 0, 0),
(29, 'Blue-Mass-2005', 'Blue Mass 2005', '           ', 'accept', '', '           ', '           ', '', 0, 0, 0, 0, 0, 0),
(30, 'Blue-Mass-2006-07', 'Blue Mass 2006-07', '                                 ', 'accept', '', '                                 ', '                                 ', '', 0, 0, 0, 0, 0, 0),
(31, 'Blue-Mass-2008', 'Blue Mass 2008', '           ', 'accept', '', '           ', '           ', '', 0, 0, 0, 0, 0, 0),
(32, 'Blue-Mass-2009', 'Blue Mass 2009', '                                 ', 'accept', '', '                                 ', '                                 ', '', 0, 0, 0, 0, 0, 0),
(33, 'Blue-Mass-2010', 'Blue Mass 2010', '           ', 'accept', '', '           ', '           ', '', 0, 0, 0, 0, 0, 0),
(34, 'Blue-Mass-2013', 'Blue Mass 2013', '           ', 'accept', '', '           ', '           ', '', 0, 0, 0, 0, 0, 0),
(35, 'Blue-Mass-2014', 'Blue Mass 2014', '           ', 'accept', '', '           ', '           ', '', 0, 0, 0, 0, 0, 0),
(36, 'Blue-Mass-2014', 'Blue Mass 2014', '           ', 'accept', '', '           ', '           ', '', 0, 0, 0, 0, 0, 0),
(37, 'Blue-Mass-2015', 'Blue Mass 2015', '                      ', 'accept', '', '                      ', '                      ', '', 0, 0, 0, 0, 0, 0),
(39, 'Make-A-Donation', 'Make A Donation', '                                            ', NULL, '', '                                            ', '                                            ', '', 0, 0, 0, 0, 0, 0),
(40, 'Advertise-Your-Business', 'Advertise Your Business', '                                            ', NULL, NULL, '                                            ', '                                            ', '', 0, 0, 0, 0, 0, 0),
(41, 'Become-A-Member', 'Become A Member', '                                                                                                                                                                                           ', NULL, NULL, '                                                                                                                                                                                           ', '                                                                                                                                                                                           ', '', 0, 0, 0, 0, 0, 0),
(42, 'Membership-Appilication', 'Membership Appilication', '                                 ', NULL, '', '                                 ', '                                 ', '', 0, 0, 0, 0, 0, 0),
(43, 'Membership-Law-Enforcement', 'Membership Law Enforcement', '                      ', NULL, 'accept', '                      ', '                      ', '', 0, 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business_categories`
--
ALTER TABLE `business_categories`
  ADD PRIMARY KEY (`recno`);

--
-- Indexes for table `business_listings`
--
ALTER TABLE `business_listings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_listings_upload`
--
ALTER TABLE `business_listings_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_shields`
--
ALTER TABLE `car_shields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_shields_upload`
--
ALTER TABLE `car_shields_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_message`
--
ALTER TABLE `contact_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `legislative_outreach`
--
ALTER TABLE `legislative_outreach`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_menu`
--
ALTER TABLE `main_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership_plans`
--
ALTER TABLE `membership_plans`
  ADD PRIMARY KEY (`mem_plan_level`);

--
-- Indexes for table `msite_accounts`
--
ALTER TABLE `msite_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msite_ads`
--
ALTER TABLE `msite_ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msite_buy_ads`
--
ALTER TABLE `msite_buy_ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msite_categories`
--
ALTER TABLE `msite_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_admin_emails`
--
ALTER TABLE `site_admin_emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_admin_terms_conditions`
--
ALTER TABLE `site_admin_terms_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_cookies`
--
ALTER TABLE `site_cookies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_messages`
--
ALTER TABLE `site_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_payments`
--
ALTER TABLE `site_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_upload_categories`
--
ALTER TABLE `site_upload_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_users_upload`
--
ALTER TABLE `site_users_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_children`
--
ALTER TABLE `user_children`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_employment_le`
--
ALTER TABLE `user_employment_le`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_employment_prv_sector`
--
ALTER TABLE `user_employment_prv_sector`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_mail_to`
--
ALTER TABLE `user_mail_to`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `webpages`
--
ALTER TABLE `webpages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business_categories`
--
ALTER TABLE `business_categories`
  MODIFY `recno` int(11) NOT NULL AUTO_INCREMENT COMMENT 'I|11|0', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `business_listings`
--
ALTER TABLE `business_listings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `business_listings_upload`
--
ALTER TABLE `business_listings_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `car_shields`
--
ALTER TABLE `car_shields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `car_shields_upload`
--
ALTER TABLE `car_shields_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_message`
--
ALTER TABLE `contact_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `legislative_outreach`
--
ALTER TABLE `legislative_outreach`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `main_menu`
--
ALTER TABLE `main_menu`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `msite_accounts`
--
ALTER TABLE `msite_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `msite_ads`
--
ALTER TABLE `msite_ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `msite_buy_ads`
--
ALTER TABLE `msite_buy_ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `msite_categories`
--
ALTER TABLE `msite_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_admin_emails`
--
ALTER TABLE `site_admin_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `site_admin_terms_conditions`
--
ALTER TABLE `site_admin_terms_conditions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_cookies`
--
ALTER TABLE `site_cookies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_messages`
--
ALTER TABLE `site_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `site_payments`
--
ALTER TABLE `site_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `site_upload_categories`
--
ALTER TABLE `site_upload_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `site_users_upload`
--
ALTER TABLE `site_users_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_children`
--
ALTER TABLE `user_children`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_employment_le`
--
ALTER TABLE `user_employment_le`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_employment_prv_sector`
--
ALTER TABLE `user_employment_prv_sector`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_mail_to`
--
ALTER TABLE `user_mail_to`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `webpages`
--
ALTER TABLE `webpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
