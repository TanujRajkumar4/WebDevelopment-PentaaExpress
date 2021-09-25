-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2021 at 04:47 PM
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
-- Database: `my_guitar_shop1`
--
CREATE DATABASE IF NOT EXISTS `my_guitar_shop1` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `my_guitar_shop1`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryID`, `categoryName`) VALUES
(1, 'Guitars'),
(2, 'Basses'),
(3, 'Drums');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `orderDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `productCode` varchar(10) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `listPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `categoryID`, `productCode`, `productName`, `listPrice`) VALUES
(2, 1, 'les_paul', 'Gibson Les Paul', '1199.00'),
(3, 1, 'sg', 'Gibson SG', '2517.00'),
(4, 1, 'fg700s', 'Yamaha FG700S', '489.99'),
(5, 1, 'washburn', 'Washburn D10S', '299.00'),
(6, 1, 'rodriguez', 'Rodriguez Caballero 11', '415.00'),
(7, 2, 'precision', 'Fender Precision', '799.99'),
(8, 2, 'hofner', 'Hofner Icon', '499.99'),
(9, 3, 'ludwig', 'Ludwig 5-piece Drum Set with Cymbals', '699.99'),
(10, 3, 'tama', 'Tama 5-Piece Drum Set with Cymbals', '799.99');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`),
  ADD UNIQUE KEY `productCode` (`productCode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Database: `pentaaxpress_logkar`
--
CREATE DATABASE IF NOT EXISTS `pentaaxpress_logkar` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pentaaxpress_logkar`;

-- --------------------------------------------------------

--
-- Table structure for table `book_meth`
--

CREATE TABLE `book_meth` (
  `b_id` int(11) NOT NULL,
  `bname` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'A'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_meth`
--

INSERT INTO `book_meth` (`b_id`, `bname`, `status`) VALUES
(1, 'Kilos', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `book_status`
--

CREATE TABLE `book_status` (
  `b_id` int(11) NOT NULL,
  `bname` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'A'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_status`
--

INSERT INTO `book_status` (`b_id`, `bname`, `status`) VALUES
(1, 'Booked', 'A'),
(2, 'Intransit', 'A'),
(3, 'Deliverd\r\n', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `b_id` int(11) NOT NULL,
  `bname` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'A'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`b_id`, `bname`, `status`) VALUES
(3, 'Salem', 'A'),
(2, 'Erode', 'A'),
(1, 'Tirupur', 'A'),
(4, 'Madurai', 'A'),
(5, 'Karur', 'A'),
(6, 'Dindigual', 'A'),
(7, 'Namakkal', 'A'),
(8, 'Tiruchengode', 'A'),
(9, 'Bhavai', 'A'),
(10, 'Pollachi', 'A'),
(11, 'Trichy', 'A'),
(12, 'Chennai', 'A'),
(13, 'villupuram', 'A'),
(14, 'Pondy', 'A'),
(15, 'Tiruvannamalai', 'A'),
(16, 'Panruti', 'A'),
(17, 'Vellore', 'A'),
(18, 'Gudiyattham', 'A'),
(19, 'Kanchipuram', 'A'),
(20, 'Ranipet', 'A'),
(21, 'Tirunelveli', 'A'),
(22, 'Cuddalore', 'A'),
(23, 'Chidambaram', 'A'),
(24, 'Housur', 'A'),
(25, 'Krishnagiri', 'A'),
(26, 'Thanjavur', 'A'),
(27, 'Chengalpet', 'A'),
(28, 'Coimbatore', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `cust_trans`
--

CREATE TABLE `cust_trans` (
  `tid` int(11) NOT NULL,
  `cust_id` varchar(100) NOT NULL,
  `repaid` varchar(100) NOT NULL,
  `outstanding` varchar(100) NOT NULL,
  `repaydt` date NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `maps`
--

CREATE TABLE `maps` (
  `id` int(11) NOT NULL,
  `Lat` varchar(100) NOT NULL,
  `Lon` varchar(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Adrs` varchar(100) NOT NULL,
  `Division` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL,
  `page_name` varchar(50) DEFAULT NULL,
  `page_content` longtext DEFAULT NULL,
  `status` varchar(100) DEFAULT 'A'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `page_name`, `page_content`, `status`) VALUES
(1, 'About', '<p class=\"content-size\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin: 0in 0in 0.0001pt; vertical-align: baseline; display: inline !important;\"><font face=\"Arial, sans-serif\"><span style=\"font-size: 13.3333px;\">Among different modes of services we, </span></font><span style=\"color: rgb(34, 34, 34); font-size: small;\"><b style=\"color: rgb(34, 34, 34); font-size: small;\">PENTA LOGISTICS (XPRESS CARGO)</b></span><font face=\"Arial, sans-serif\"><span style=\"font-size: 13.3333px;\">&nbsp;put forward our steps into the area of Surface Transport Service in order to meet customers’ demands.</span></font></p><p class=\"content-size\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin: 0in 0in 0.0001pt; vertical-align: baseline;\"><br></p><p class=\"content-size\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin: 0in 0in 0.0001pt; vertical-align: baseline;\">We are committed to deliver the consignments to the destinations within the deadline and ensure customer satisfaction. We assure to have a continuous improvement of our service through promotion of compliance.</p><p class=\"content-size\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin: 0in 0in 0.0001pt; vertical-align: baseline;\"><br></p><p class=\"content-size\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin: 0in 0in 0.0001pt; vertical-align: baseline;\">As a beginner in the field of goods transport service we initially focus our services in between Tirupur and Chennai on a daily basis mode. Our team of professionals delivers distinctive needy deliveries at an affordable cost.</p><p></p>', 'A'),
(15, 'Services', '<p class=\"content-size\" style=\"margin: 0in 0in 0.0001pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><span style=\"font-size: 10pt; font-family: Arial, sans-serif;\">GULFETRADE is a one the best software development company providing software services and application development services with years of experience and expertise in developing customized windows and web based application using the latest Microsoft technologies like VB.<br></span></p><p class=\"content-size\" style=\"margin: 0in 0in 0.0001pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><span style=\"font-size: 10pt; font-family: Arial, sans-serif;\"><br></span></p><p class=\"content-size\" style=\"margin: 0in 0in 0.0001pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><span style=\"font-family: Arial, sans-serif; font-size: 10pt;\">SOFTWARE DEVELOPMENT SERVICES</span><br></p><ul><li>Developing and managing Windows and Web based applications.<br></li><li>Database Management System.<br></li><li>Application Maintenance Contracts.<br></li><li>Application Migration from older technology to newer technology.<br></li><li>Content management system<br></li></ul><p></p>', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `pay_meth`
--

CREATE TABLE `pay_meth` (
  `b_id` int(11) NOT NULL,
  `bname` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'A'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pay_meth`
--

INSERT INTO `pay_meth` (`b_id`, `bname`, `status`) VALUES
(1, 'To pay', 'A'),
(2, 'credit\r\n', 'A'),
(3, 'Paid', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `pincode`
--

CREATE TABLE `pincode` (
  `b_id` int(11) NOT NULL,
  `bname` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'A'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_courier`
--

CREATE TABLE `tbl_courier` (
  `cid` int(10) NOT NULL,
  `waybillno` varchar(100) NOT NULL,
  `consignor_name` varchar(100) NOT NULL,
  `consignor_gst` varchar(50) NOT NULL,
  `consignor_phone` varchar(12) NOT NULL,
  `consignor_add` varchar(200) NOT NULL,
  `consignee_name` varchar(100) NOT NULL,
  `consignee_gst` varchar(50) NOT NULL,
  `consignee_phone` varchar(12) NOT NULL,
  `consignee_pincode` varchar(50) NOT NULL,
  `consignee_add` varchar(200) NOT NULL,
  `toi` varchar(40) NOT NULL,
  `weight` double NOT NULL,
  `actwgt` varchar(50) NOT NULL,
  `volh` varchar(50) NOT NULL,
  `volw` varchar(50) NOT NULL,
  `voll` varchar(50) NOT NULL,
  `volq` varchar(50) NOT NULL,
  `volh1` varchar(50) NOT NULL,
  `volw1` varchar(50) NOT NULL,
  `voll1` varchar(50) NOT NULL,
  `volq1` varchar(50) NOT NULL,
  `volh2` varchar(50) NOT NULL,
  `volw2` varchar(50) NOT NULL,
  `voll2` varchar(50) NOT NULL,
  `volq2` int(11) NOT NULL,
  `cubft` varchar(50) NOT NULL,
  `boxes` varchar(50) NOT NULL,
  `bxpkg` varchar(50) NOT NULL,
  `qty` int(10) NOT NULL,
  `units` varchar(50) NOT NULL,
  `invoice_no` varchar(20) NOT NULL,
  `invoice_val` varchar(50) NOT NULL,
  `setto` varchar(100) NOT NULL,
  `pay_mode` varchar(20) NOT NULL,
  `pick_date` varchar(100) NOT NULL,
  `dest_off` varchar(20) NOT NULL,
  `org_off` varchar(50) NOT NULL,
  `freight` double NOT NULL,
  `insurance` varchar(50) NOT NULL,
  `waych` varchar(100) NOT NULL,
  `othch` varchar(100) NOT NULL,
  `odach` varchar(100) NOT NULL,
  `topaych` varchar(100) NOT NULL,
  `subtot` varchar(100) NOT NULL,
  `sgst` varchar(100) NOT NULL,
  `cgst` varchar(100) NOT NULL,
  `tot` varchar(100) NOT NULL,
  `comments` varchar(250) NOT NULL,
  `book_status` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL,
  `book_date` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_courier`
--

INSERT INTO `tbl_courier` (`cid`, `waybillno`, `consignor_name`, `consignor_gst`, `consignor_phone`, `consignor_add`, `consignee_name`, `consignee_gst`, `consignee_phone`, `consignee_pincode`, `consignee_add`, `toi`, `weight`, `actwgt`, `volh`, `volw`, `voll`, `volq`, `volh1`, `volw1`, `voll1`, `volq1`, `volh2`, `volw2`, `voll2`, `volq2`, `cubft`, `boxes`, `bxpkg`, `qty`, `units`, `invoice_no`, `invoice_val`, `setto`, `pay_mode`, `pick_date`, `dest_off`, `org_off`, `freight`, `insurance`, `waych`, `othch`, `odach`, `topaych`, `subtot`, `sgst`, `cgst`, `tot`, `comments`, `book_status`, `status`, `book_date`) VALUES
(10, '000006', 'crystal knitters private ltd', '33AABCC5572D1Z1', '822 001 3199', 'no-19, new no 41 Nehru street, Tirupur-641601', 'Rikab Agencies', '33AAIPM4051B1Z9', '044-24525562', '600041', 'no-3 l.b road, 1st floor, b-wing\r\ntiruvanmiyur, chennai', '2', 2, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, '0', '4', '35', 4, '1', '819-100899', '81194', 'knitted garments', '3', '22/10/2018 6:00:00 PM', '3', '1', 720, '0.00', '0.00', '0.00', '0.00', '0.00', '720.00', '0.00', '0.00', '720.00', '', '1', 'A', '2018-10-22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_courier_officers`
--

CREATE TABLE `tbl_courier_officers` (
  `office` int(100) NOT NULL,
  `officer_name` varchar(40) NOT NULL,
  `off_pwd` varchar(40) NOT NULL,
  `off_id` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ph_no` varchar(12) NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) NOT NULL DEFAULT 'A'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_courier_officers`
--

INSERT INTO `tbl_courier_officers` (`office`, `officer_name`, `off_pwd`, `off_id`, `email`, `ph_no`, `reg_date`, `status`) VALUES
(1, 'PLXTUP', '456123', '1', 'pentaatrpops@gmail.com', '9944277555', '2011-01-30 09:25:21', 'A'),
(3, 'PLXCHE', '123456', '3', 'pentaachennaiops@gmail.com', '9003054079', '2011-01-30 17:50:34', 'A'),
(7, 'PLXMDU', '456123', '5', 'customercare.penta@gmail.com', '9543481612', '2021-09-15 16:01:10', 'A'),
(8, 'PLXSA', '456123', '6', 'customercare.penta@gmail.com', '9876543210', '2021-09-15 16:02:04', 'A'),
(9, 'PLXCBE', '456123', '4', 'customercare.penta@gmail.com', '6379541406', '2021-09-15 16:03:20', 'A'),
(10, 'ADMIN', '456123', '10', 'pentaatrpops@gmail.com', '9944277555', '2011-01-30 09:25:21', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_courier_track`
--

CREATE TABLE `tbl_courier_track` (
  `id` int(10) NOT NULL,
  `cons_no` varchar(20) NOT NULL,
  `current_city` varchar(100) NOT NULL,
  `bk_status` varchar(30) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `bk_time` date NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'A'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_courier_track`
--

INSERT INTO `tbl_courier_track` (`id`, `cons_no`, `current_city`, `bk_status`, `comments`, `bk_time`, `status`) VALUES
(4, '000006', '1', '3', '', '2019-02-13', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `cid` int(10) NOT NULL,
  `custID` varchar(100) NOT NULL,
  `consignor_name` varchar(100) NOT NULL,
  `consignor_gst` varchar(50) NOT NULL,
  `consignor_phone` varchar(12) NOT NULL,
  `consignor_add` varchar(200) NOT NULL,
  `freight` varchar(100) NOT NULL,
  `boxrate` varchar(50) NOT NULL,
  `waych` varchar(100) NOT NULL,
  `insch` varchar(100) NOT NULL,
  `othch` varchar(100) NOT NULL,
  `odach` varchar(100) NOT NULL,
  `topaych` varchar(100) NOT NULL,
  `bala` varchar(100) NOT NULL,
  `cre_dt` date NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`cid`, `custID`, `consignor_name`, `consignor_gst`, `consignor_phone`, `consignor_add`, `freight`, `boxrate`, `waych`, `insch`, `othch`, `odach`, `topaych`, `bala`, `cre_dt`, `status`) VALUES
(3, 'PLX 000002', 'Go Fashion India  pvt  ltd', '33AADCG9557C1ZO', '958 531 0275', ' M/s. Go Fashions India pvt ltd\r\n 8/60 def mahavishnu nagar\r\n  Angeriplayam road\r\n  Angeriplayam\r\n  Tirupur-641603\r\n', '5.00', '0.00', '50.00', '0.00', '0.00', '0.00', '0.00', '', '2018-11-29', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offices`
--

CREATE TABLE `tbl_offices` (
  `id` int(10) NOT NULL,
  `off_name` varchar(100) NOT NULL,
  `address` varchar(230) NOT NULL,
  `city` varchar(100) NOT NULL,
  `ph_no` varchar(20) NOT NULL,
  `office_time` varchar(100) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'A'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_offices`
--

INSERT INTO `tbl_offices` (`id`, `off_name`, `address`, `city`, `ph_no`, `office_time`, `contact_person`, `status`) VALUES
(1, 'PLX Center- Tiruppur', 'No. 15, Govindarajulu Street,\r\nNear Hotel Sri Saravana Bhavan,\r\nAvinashi Road, Tirupur-641 602,\r\nTamil Nadu', '1', '8667480670', '10.00 am - 9.00 pm', 'Karthik Prabhu', 'A'),
(4, 'PLX Center - Coimbatore', '2/42E Seryampalayam, kadhir engineering collage road, \r\nCoimbatore-641048', '28', '6379541406', '10.00 am - 9.00 pm', 'Karthik Prabhu', 'A'),
(5, 'PLX Center - Madurai', 'No-161- Siddco Industrial Estate\r\nKappalur, Madurai-625008', '4', '9543481612', '10.00 am - 9.00 pm', 'Karthik Prabhu', 'A'),
(3, 'PLX Center- Chennai', 'no-89, krishna nagar, near Jk Mahal\r\npuzhal, chennai-600066', '12', '9003054079', '10.00 am - 9.00 pm', 'Karthik Prabhu', 'A'),
(6, 'PLX Center - Salem', 'NA', '3', '9876543210', '10.00 am - 9.00 pm', 'Karthik Prabhu', 'A'),
(10, 'PLX Head office', 'NA', 'NA', 'NA', 'NA', 'NA', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `toi`
--

CREATE TABLE `toi` (
  `b_id` int(11) NOT NULL,
  `bname` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'A'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `toi`
--

INSERT INTO `toi` (`b_id`, `bname`, `status`) VALUES
(1, 'Parcels', 'A'),
(2, 'Boxes', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_meth`
--
ALTER TABLE `book_meth`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `book_status`
--
ALTER TABLE `book_status`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `cust_trans`
--
ALTER TABLE `cust_trans`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `maps`
--
ALTER TABLE `maps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `pay_meth`
--
ALTER TABLE `pay_meth`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `pincode`
--
ALTER TABLE `pincode`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `tbl_courier`
--
ALTER TABLE `tbl_courier`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `tbl_courier_officers`
--
ALTER TABLE `tbl_courier_officers`
  ADD PRIMARY KEY (`office`);

--
-- Indexes for table `tbl_courier_track`
--
ALTER TABLE `tbl_courier_track`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `tbl_offices`
--
ALTER TABLE `tbl_offices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `toi`
--
ALTER TABLE `toi`
  ADD PRIMARY KEY (`b_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_meth`
--
ALTER TABLE `book_meth`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `book_status`
--
ALTER TABLE `book_status`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cust_trans`
--
ALTER TABLE `cust_trans`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `maps`
--
ALTER TABLE `maps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pay_meth`
--
ALTER TABLE `pay_meth`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pincode`
--
ALTER TABLE `pincode`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_courier`
--
ALTER TABLE `tbl_courier`
  MODIFY `cid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_courier_officers`
--
ALTER TABLE `tbl_courier_officers`
  MODIFY `office` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_courier_track`
--
ALTER TABLE `tbl_courier_track`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `cid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_offices`
--
ALTER TABLE `tbl_offices`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `toi`
--
ALTER TABLE `toi`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin DEFAULT NULL,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"my_guitar_shop1\",\"table\":\"products\"},{\"db\":\"my_guitar_shop1\",\"table\":\"categories\"},{\"db\":\"my_guitar_shop1\",\"table\":\"orders\"},{\"db\":\"testdb1\",\"table\":\"employeeinfo\"},{\"db\":\"product details\",\"table\":\"customer details\"},{\"db\":\"product details\",\"table\":\"product details\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin DEFAULT NULL,
  `data_sql` longtext COLLATE utf8_bin DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2021-09-23 10:43:48', '{\"Console\\/Mode\":\"collapse\",\"NavigationWidth\":0}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `product details`
--
CREATE DATABASE IF NOT EXISTS `product details` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `product details`;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
--
-- Database: `testdb1`
--
CREATE DATABASE IF NOT EXISTS `testdb1` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `testdb1`;

-- --------------------------------------------------------

--
-- Table structure for table `employeeinfo`
--

CREATE TABLE `employeeinfo` (
  `emp_id` int(11) NOT NULL,
  `emp_name` text NOT NULL,
  `emp_salary` int(50) NOT NULL,
  `emp_age` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employeeinfo`
--
ALTER TABLE `employeeinfo`
  ADD PRIMARY KEY (`emp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;