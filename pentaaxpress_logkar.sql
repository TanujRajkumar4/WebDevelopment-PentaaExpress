-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2021 at 04:56 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pentaaxpress_logkar`
--

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
(2, 'In Transit', 'A'),
(3, 'Delivered', 'A');

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
-- Table structure for table `customer_tariff`
--

CREATE TABLE `customer_tariff` (
  `CT_ID` int(11) NOT NULL,
  `Cust_ID` varchar(11) NOT NULL COMMENT 'Customer ID from tbl_customer',
  `Branch_ID` int(11) DEFAULT NULL COMMENT 'Pickup City ID',
  `City_ID` int(11) DEFAULT NULL COMMENT 'Destination City ID',
  `Price_KG` int(5) DEFAULT NULL,
  `Price_Box` int(5) DEFAULT NULL,
  `Status` varchar(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_tariff`
--

INSERT INTO `customer_tariff` (`CT_ID`, `Cust_ID`, `Branch_ID`, `City_ID`, `Price_KG`, `Price_Box`, `Status`) VALUES
(6, 'PLX000002', 10, 1, 7, 8, 'A');

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
(1, 'About', '<p class=\"content-size\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin: 0in 0in 0.0001pt; vertical-align: baseline; display: inline !important;\"><font face=\"Arial, sans-serif\"><span style=\"font-size: 13.3333px;\">Among different modes of services we, </span></font><span style=\"color: rgb(34, 34, 34); font-size: small;\"><b style=\"color: rgb(34, 34, 34); font-size: small;\">PENTA LOGISTICS (XPRESS CARGO)</b></span><font face=\"Arial, sans-serif\"><span style=\"font-size: 13.3333px;\">&nbsp;put forward our steps into the area of Surface Transport Service in order to meet customers???????? demands.</span></font></p><p class=\"content-size\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin: 0in 0in 0.0001pt; vertical-align: baseline;\"><br></p><p class=\"content-size\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin: 0in 0in 0.0001pt; vertical-align: baseline;\">We are committed to deliver the consignments to the destinations within the deadline and ensure customer satisfaction. We assure to have a continuous improvement of our service through promotion of compliance.</p><p class=\"content-size\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin: 0in 0in 0.0001pt; vertical-align: baseline;\"><br></p><p class=\"content-size\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin: 0in 0in 0.0001pt; vertical-align: baseline;\">As a beginner in the field of goods transport service we initially focus our services in between Tirupur and Chennai on a daily basis mode. Our team of professionals delivers distinctive needy deliveries at an affordable cost.</p><p></p>', 'A'),
(15, 'Services', '<p class=\"content-size\" style=\"margin: 0in 0in 0.0001pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><span style=\"font-size: 10pt; font-family: Arial, sans-serif;\">GULFETRADE is a one the best software development company providing software services and application development services with years of experience and expertise in developing customized windows and web based application using the latest Microsoft technologies like VB.<br></span></p><p class=\"content-size\" style=\"margin: 0in 0in 0.0001pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><span style=\"font-size: 10pt; font-family: Arial, sans-serif;\"><br></span></p><p class=\"content-size\" style=\"margin: 0in 0in 0.0001pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; vertical-align: baseline;\"><span style=\"font-family: Arial, sans-serif; font-size: 10pt;\">SOFTWARE DEVELOPMENT SERVICES</span><br></p><ul><li>Developing and managing Windows and Web based applications.<br></li><li>Database Management System.<br></li><li>Application Maintenance Contracts.<br></li><li>Application Migration from older technology to newer technology.<br></li><li>Content management system<br></li></ul><p></p>', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `pay_meth`
--

CREATE TABLE `pay_meth` (
  `b_id` int(11) NOT NULL,
  `bname` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'A',
  `User_Access` varchar(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pay_meth`
--

INSERT INTO `pay_meth` (`b_id`, `bname`, `status`, `User_Access`) VALUES
(1, 'To Pay', 'A', 'Branch'),
(2, 'Credit\r\n', 'A', 'HO'),
(3, 'Pre-Paid', 'A', 'Branch');

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
-- Table structure for table `tariff`
--

CREATE TABLE `tariff` (
  `tariff_id` int(11) NOT NULL,
  `Remarks` varchar(50) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `price_per_kg` int(5) DEFAULT NULL,
  `price_per_box` int(5) DEFAULT NULL,
  `Status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tariff`
--

INSERT INTO `tariff` (`tariff_id`, `Remarks`, `branch_id`, `city_id`, `price_per_kg`, `price_per_box`, `Status`) VALUES
(1, '', 10, 3, 5, 4, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_courier`
--

CREATE TABLE `tbl_courier` (
  `cid` int(10) NOT NULL,
  `waybillno` varchar(100) NOT NULL,
  `Cust_ID` varchar(12) NOT NULL,
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
  `dest_city` int(11) NOT NULL,
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
  `book_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_courier`
--

INSERT INTO `tbl_courier` (`cid`, `waybillno`, `Cust_ID`, `consignor_name`, `consignor_gst`, `consignor_phone`, `consignor_add`, `consignee_name`, `consignee_gst`, `consignee_phone`, `consignee_pincode`, `consignee_add`, `toi`, `weight`, `actwgt`, `volh`, `volw`, `voll`, `volq`, `volh1`, `volw1`, `voll1`, `volq1`, `volh2`, `volw2`, `voll2`, `volq2`, `cubft`, `boxes`, `bxpkg`, `qty`, `units`, `invoice_no`, `invoice_val`, `setto`, `pay_mode`, `pick_date`, `dest_off`, `dest_city`, `org_off`, `freight`, `insurance`, `waych`, `othch`, `odach`, `topaych`, `subtot`, `sgst`, `cgst`, `tot`, `comments`, `book_status`, `status`, `book_date`) VALUES
(161, '000012', 'PLX000003', 'Go Fashion India  Pvt.  Ltd.', '33AADCG9557C1ZO', '958 531 0275', ' M/s. Go Fashions India Pvt ltd\r\n 8/60 def mahavishnu nagar\r\n  Angeriplayam road\r\n  Angeriplayam\r\n  Tirupur-641603\r\n', 'TEST', 'GST', '9876543210', '641603', 'ADDRESS', '1', 1, '100', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, '0', '0', '7', 0, '', '', '', '', '2', '12/10/2021 7:00:00 PM', '6', 0, '10', 700, '50', '0.00', '0.00', '0.00', '0.00', '750.00', '9', '9', '885.00', 'TEST COMMENT', '1', 'A', '2021-10-13'),
(162, '000013', 'PLX000005', 'Go Fashion India  Pvt.  Ltd.', '33AADCG9557C1ZO', '958 531 0275', ' M/s. Go Fashions India Pvt ltd\r\n 8/60 def mahavishnu nagar\r\n  Angeriplayam road\r\n  Angeriplayam\r\n  Tirupur-641603\r\n', 'xdff', 'hfghfg', '9876543210', '641603', 'ADD', '', 1, '100', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, '0', '0', '5', 0, '', '', '', '', '1', '21/10/2021 12:00:00 AM', '10', 0, '1', 500, '0.00', '0.00', '0.00', '0.00', '0.00', '500.00', '9', '9', '590.00', '', '1', 'A', '2021-10-13'),
(163, '000020', 'PLX000002', 'Go Fashion India  Pvt.  Ltd.', '33AADCG9557C1ZO', '958 531 0275', ' M/s. Go Fashions India Pvt ltd\r\n 8/60 def mahavishnu nagar\r\n  Angeriplayam road\r\n  Angeriplayam\r\n  Tirupur-641603\r\n', 'TEST', 'TEST', '9876543210', '641603', 'ADDRESS', '1', 1, '100', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, '0', '0', '5', 10, '1', '', '', '', '1', '13/10/2021 12:00:00 AM', '6', 0, '10', 500, '0.00', '0.00', '0.00', '0.00', '0.00', '500.00', '9', '9', '590.00', 'HI', '1', 'A', '2021-10-13');

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
  `status` varchar(10) NOT NULL DEFAULT 'A',
  `user_type` varchar(6) DEFAULT 'Branch'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_courier_officers`
--

INSERT INTO `tbl_courier_officers` (`office`, `officer_name`, `off_pwd`, `off_id`, `email`, `ph_no`, `reg_date`, `status`, `user_type`) VALUES
(1, 'PLXTUP', '456123', '1', 'pentaatrpops@gmail.com', '9944277555', '2011-01-30 09:25:21', 'A', 'Branch'),
(3, 'PLXCHE', '123456', '3', 'pentaachennaiops@gmail.com', '9003054079', '2011-01-30 17:50:34', 'A', 'Branch'),
(7, 'PLXMDU', '456123', '5', 'customercare.penta@gmail.com', '9543481612', '2021-09-15 16:01:10', 'A', 'Branch'),
(8, 'PLXSA', '456123', '6', 'customercare.penta@gmail.com', '9876543210', '2021-09-15 16:02:04', 'A', 'Branch'),
(9, 'PLXCBE', '456123', '4', 'customercare.penta@gmail.com', '6379541406', '2021-09-15 16:03:20', 'A', 'Branch'),
(10, 'PLXHO-CBE', '456123', '10', 'customercare.penta@gmail.com', '6379541406', '2021-09-25 13:27:58', 'A', 'HO');

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
(155, '000012', '10', '2', 'TEST COMMENT', '2021-10-13', 'A'),
(156, '000013', '1', '1', '', '2021-10-13', 'A'),
(157, '000020', '10', '1', '', '2021-10-13', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `cid` int(10) NOT NULL,
  `custID` varchar(100) NOT NULL,
  `consignor_name` varchar(100) NOT NULL,
  `Type` int(11) NOT NULL,
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
  `status` varchar(20) NOT NULL,
  `User_Access` varchar(10) NOT NULL DEFAULT 'Branch'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`cid`, `custID`, `consignor_name`, `Type`, `consignor_gst`, `consignor_phone`, `consignor_add`, `freight`, `boxrate`, `waych`, `insch`, `othch`, `odach`, `topaych`, `bala`, `cre_dt`, `status`, `User_Access`) VALUES
(3, 'PLX000002', 'Go Fashion India  Pvt.  Ltd.', 2, '33AADCG9557C1ZO', '958 531 0275', ' M/s. Go Fashions India Pvt ltd\r\n 8/60 def mahavishnu nagar\r\n  Angeriplayam road\r\n  Angeriplayam\r\n  Tirupur-641603\r\n', '0', '0', '0', '0', '0', '0', '0', '3812.28', '2018-11-29', 'A', 'Branch'),
(108, 'PLX000005', 'TEST3', 2, 'TEST-GST', '987 654 3210', 'TEST-ADD', '', '', '', '', '', '', '', '', '2021-10-09', 'A', 'HO'),
(107, 'PLX000004', 'TEST2', 3, 'TEST-GST', '987 654 3210', 'TEST- ADD', '', '', '', '', '', '', '', '', '2021-10-09', 'A', 'HO'),
(106, 'PLX000003', 'TEST1', 1, 'ABCD', '987 654 3210', 'TEST ADD1', '', '', '', '', '', '', '', '', '2021-10-08', 'A', 'HO');

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
(10, 'PLX Head Office', 'FLAT NO2-D, N0-1741 HAVEN RADHAKRISHNA ENCLAVE, RAMANATHAPURAM,TRICHY ROAD, COIMBATORE-641045', '28', '6379541406', '10.00 am - 9.00 pm', 'Karthik Prabhu', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transactions`
--

CREATE TABLE `tbl_transactions` (
  `Tran_ID` int(11) NOT NULL,
  `Tran_Date` date NOT NULL DEFAULT current_timestamp(),
  `Cust_ID` varchar(10) NOT NULL,
  `Way_Bill_No` int(11) NOT NULL,
  `Branch_ID` int(11) NOT NULL,
  `Pay_Meth_ID` int(11) NOT NULL,
  `Tran_Type` varchar(2) NOT NULL COMMENT 'Credit / Debit',
  `Tran_Remarks` varchar(50) NOT NULL,
  `Tran_Amt` int(11) NOT NULL,
  `Status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transactions`
--

INSERT INTO `tbl_transactions` (`Tran_ID`, `Tran_Date`, `Cust_ID`, `Way_Bill_No`, `Branch_ID`, `Pay_Meth_ID`, `Tran_Type`, `Tran_Remarks`, `Tran_Amt`, `Status`) VALUES
(1, '2021-10-08', 'PLX000002', 0, 1, 2, 'Dr', 'Credit Payment', 1000, 'A'),
(15, '2021-10-09', 'PLX000003', 0, 10, 3, 'Dr', 'To Pay Payment', 1500, 'A'),
(23, '2021-10-09', 'PLX000003', 0, 10, 1, 'Cr', 'To Pay Repayment', 100, 'A'),
(25, '2021-10-12', 'PLX000002', 0, 10, 2, 'Dr', 'Credit Payment', 130, 'A'),
(26, '2021-10-12', 'PLX000002', 0, 10, 2, 'Cr', 'Credit\r\n Repayment', 100, 'A'),
(27, '2021-10-12', 'PLX000002', 0, 10, 1, 'Dr', 'To Pay Payment', 149, 'A'),
(28, '2021-10-12', 'PLX000002', 0, 10, 1, 'Dr', 'To Pay Payment', 543, 'A'),
(29, '2021-10-12', 'PLX000002', 0, 10, 2, 'Dr', 'Credit\r\n Repayment', 1722, 'A'),
(30, '2021-10-09', 'PLX000003', 0, 10, 3, 'Dr', 'To Pay Payment', 1500, 'A'),
(31, '2021-10-09', 'PLX000003', 0, 10, 1, 'Cr', 'To Pay Repayment', 100, 'A'),
(32, '2021-10-12', 'PLX000002', 0, 10, 2, 'Dr', 'Credit Payment', 130, 'A'),
(33, '2021-10-12', 'PLX000002', 0, 10, 2, 'Cr', 'Credit\r\n Repayment', 100, 'A'),
(34, '2021-10-12', 'PLX000002', 0, 10, 1, 'Dr', 'To Pay Payment', 149, 'A'),
(35, '2021-10-12', 'PLX000002', 0, 10, 1, 'Dr', 'To Pay Payment', 543, 'A'),
(36, '2021-10-12', 'PLX000002', 0, 10, 2, 'Dr', 'Credit\r\n Repayment', 1722, 'A'),
(37, '2021-10-08', 'PLX000002', 0, 1, 2, 'Dr', 'Credit Payment', 1000, 'A'),
(38, '2021-10-12', 'PLX000002', 0, 10, 2, 'Cr', 'Credit\r\n Repayment', 100, 'A'),
(39, '2021-10-12', 'PLX000002', 0, 10, 2, 'Dr', 'Credit Payment', 130, 'A'),
(40, '2021-10-12', 'PLX000002', 0, 10, 2, 'Cr', 'Credit\r\n Repayment', 1722, 'A'),
(41, '2021-10-12', 'PLX000002', 0, 10, 2, 'Cr', 'Credit\r\n Repayment', 100, 'A'),
(42, '2021-10-12', 'PLX000002', 0, 10, 2, 'Dr', 'Credit Payment', 130, 'A'),
(43, '2021-10-12', 'PLX000002', 0, 10, 2, 'Cr', 'Credit\r\n Repayment', 1722, 'A'),
(44, '2021-10-12', 'PLX000002', 0, 10, 2, 'Cr', 'Credit\r\n Repayment', 1722, 'A'),
(45, '2021-10-08', 'PLX000002', 0, 1, 2, 'Dr', 'Credit Payment', 1000, 'A'),
(46, '2021-10-12', 'PLX000002', 0, 10, 2, 'Cr', 'Credit\r\n Repayment', 100, 'A'),
(47, '2021-10-12', 'PLX000002', 0, 10, 2, 'Dr', 'Credit Payment', 130, 'A'),
(48, '2021-10-12', 'PLX000002', 0, 10, 2, 'Dr', 'Credit\r\n Repayment', 1722, 'A'),
(49, '2021-10-12', 'PLX000002', 0, 10, 2, 'Cr', 'Credit\r\n Repayment', 100, 'A'),
(50, '2021-10-12', 'PLX000002', 0, 10, 2, 'Dr', 'Credit Payment', 130, 'A'),
(51, '2021-10-08', 'PLX000002', 0, 1, 2, 'Dr', 'Credit Payment', 1000, 'A'),
(52, '2021-10-12', 'PLX000002', 0, 10, 2, 'Cr', 'Credit\r\n Repayment', 100, 'A'),
(53, '2021-10-12', 'PLX000002', 0, 10, 2, 'Dr', 'Credit Payment', 130, 'A'),
(54, '2021-10-12', 'PLX000002', 0, 10, 2, 'Cr', 'Credit\r\n Repayment', 1722, 'A'),
(55, '2021-10-12', 'PLX000002', 0, 10, 2, 'Cr', 'Credit\r\n Repayment', 100, 'A'),
(56, '2021-10-12', 'PLX000002', 0, 10, 2, 'Dr', 'Credit Payment', 130, 'A'),
(57, '2021-10-12', 'PLX000002', 0, 10, 2, 'Dr', 'Credit\r\n Repayment', 1722, 'A'),
(58, '2021-10-13', 'PLX000002', 0, 10, 2, 'Dr', 'Credit Payment', 885, 'A'),
(59, '2021-10-13', 'PLX000002', 0, 1, 1, 'Dr', 'To Pay Payment', 590, 'A'),
(60, '2021-10-13', 'PLX000002', 0, 1, 2, 'Cr', 'Credit\r\n Repayment', 1000, 'A'),
(61, '2021-10-13', 'PLX000002', 0, 10, 1, 'Dr', 'To Pay Payment', 590, 'A'),
(62, '2021-10-14', 'PLX000002', 55, 10, 1, 'Dr', 'To Pay Payment', 826, 'A'),
(63, '2021-10-14', 'PLX000002', 55, 10, 1, 'Cr', 'To Pay Consignment - DELETED', 826, 'A');

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
-- Indexes for table `customer_tariff`
--
ALTER TABLE `customer_tariff`
  ADD PRIMARY KEY (`CT_ID`);

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
-- Indexes for table `tariff`
--
ALTER TABLE `tariff`
  ADD PRIMARY KEY (`tariff_id`);

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
-- Indexes for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  ADD PRIMARY KEY (`Tran_ID`);

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
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `customer_tariff`
--
ALTER TABLE `customer_tariff`
  MODIFY `CT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
-- AUTO_INCREMENT for table `tariff`
--
ALTER TABLE `tariff`
  MODIFY `tariff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_courier`
--
ALTER TABLE `tbl_courier`
  MODIFY `cid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `tbl_courier_officers`
--
ALTER TABLE `tbl_courier_officers`
  MODIFY `office` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_courier_track`
--
ALTER TABLE `tbl_courier_track`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `cid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `tbl_offices`
--
ALTER TABLE `tbl_offices`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  MODIFY `Tran_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `toi`
--
ALTER TABLE `toi`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
