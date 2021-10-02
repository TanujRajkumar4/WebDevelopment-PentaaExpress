-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2021 at 10:26 AM
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
(1, 'About', '<p class=\"content-size\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin: 0in 0in 0.0001pt; vertical-align: baseline; display: inline !important;\"><font face=\"Arial, sans-serif\"><span style=\"font-size: 13.3333px;\">Among different modes of services we, </span></font><span style=\"color: rgb(34, 34, 34); font-size: small;\"><b style=\"color: rgb(34, 34, 34); font-size: small;\">PENTA LOGISTICS (XPRESS CARGO)</b></span><font face=\"Arial, sans-serif\"><span style=\"font-size: 13.3333px;\">&nbsp;put forward our steps into the area of Surface Transport Service in order to meet customersâ€™ demands.</span></font></p><p class=\"content-size\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin: 0in 0in 0.0001pt; vertical-align: baseline;\"><br></p><p class=\"content-size\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin: 0in 0in 0.0001pt; vertical-align: baseline;\">We are committed to deliver the consignments to the destinations within the deadline and ensure customer satisfaction. We assure to have a continuous improvement of our service through promotion of compliance.</p><p class=\"content-size\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin: 0in 0in 0.0001pt; vertical-align: baseline;\"><br></p><p class=\"content-size\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin: 0in 0in 0.0001pt; vertical-align: baseline;\">As a beginner in the field of goods transport service we initially focus our services in between Tirupur and Chennai on a daily basis mode. Our team of professionals delivers distinctive needy deliveries at an affordable cost.</p><p></p>', 'A'),
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
  `branch_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `Kg` int(5) DEFAULT NULL,
  `Box` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tariff`
--

INSERT INTO `tariff` (`branch_id`, `city_id`, `Kg`, `Box`) VALUES
(1, 3, 4, 5),
(5, 1, 4, 4);

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
  `book_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_courier`
--

INSERT INTO `tbl_courier` (`cid`, `waybillno`, `consignor_name`, `consignor_gst`, `consignor_phone`, `consignor_add`, `consignee_name`, `consignee_gst`, `consignee_phone`, `consignee_pincode`, `consignee_add`, `toi`, `weight`, `actwgt`, `volh`, `volw`, `voll`, `volq`, `volh1`, `volw1`, `voll1`, `volq1`, `volh2`, `volw2`, `voll2`, `volq2`, `cubft`, `boxes`, `bxpkg`, `qty`, `units`, `invoice_no`, `invoice_val`, `setto`, `pay_mode`, `pick_date`, `dest_off`, `org_off`, `freight`, `insurance`, `waych`, `othch`, `odach`, `topaych`, `subtot`, `sgst`, `cgst`, `tot`, `comments`, `book_status`, `status`, `book_date`) VALUES
(10, '000006', 'crystal knitters private ltd', '33AABCC5572D1Z1', '822 001 3199', 'no-19, new no 41 Nehru street, Tirupur-641601', 'Rikab Agencies', '33AAIPM4051B1Z9', '044-24525562', '600041', 'no-3 l.b road, 1st floor, b-wing\r\ntiruvanmiyur, chennai', '2', 2, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, '0', '4', '35', 4, '1', '819-100899', '81194', 'knitted garments', '3', '22/10/2018 6:00:00 PM', '3', '1', 720, '0.00', '0.00', '0.00', '0.00', '0.00', '720.00', '0.00', '0.00', '720.00', '', '3', 'A', '2018-10-22');

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
(4, '000006', '10', '1', '', '2021-10-02', 'A');

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
(3, 'PLX 000002', 'Go Fashion India  Pvt  Ltd', 1, '33AADCG9557C1ZO', '958 531 0275', ' M/s. Go Fashions India Pvt ltd\r\n 8/60 def mahavishnu nagar\r\n  Angeriplayam road\r\n  Angeriplayam\r\n  Tirupur-641603\r\n', '5.00', '0.00', '50.00', '0.00', '0.00', '0.00', '0.00', '', '2018-11-29', 'A', 'Branch'),
(53, 'PLX 000052', 'TEST 50', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(52, 'PLX 000051', 'TEST 49', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(51, 'PLX 000050', 'TEST 48', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(50, 'PLX 000049', 'TEST 47', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(49, 'PLX 000048', 'TEST 46', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(48, 'PLX 000047', 'TEST 45', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(47, 'PLX 000046', 'TEST 44', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(46, 'PLX 000045', 'TEST 43', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(45, 'PLX 000044', 'TEST 42', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(44, 'PLX 000043', 'TEST 41', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(43, 'PLX 000042', 'TEST 40', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(42, 'PLX 000041', 'TEST 39', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(41, 'PLX 000040', 'TEST 38', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(40, 'PLX 000039', 'TEST 37', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(39, 'PLX 000038', 'TEST 36', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(38, 'PLX 000037', 'TEST 35', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(37, 'PLX 000036', 'TEST 34', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(36, 'PLX 000035', 'TEST 33', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(35, 'PLX 000034', 'TEST 32', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(34, 'PLX 000033', 'TEST 31', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(33, 'PLX 000032', 'TEST 30', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(32, 'PLX 000031', 'TEST 29', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(31, 'PLX 000030', 'TEST 28', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(30, 'PLX 000029', 'TEST 27', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(29, 'PLX 000028', 'TEST 26', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(28, 'PLX 000027', 'TEST 25', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(27, 'PLX 000026', 'TEST 24', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(26, 'PLX 000025', 'TEST 23', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(25, 'PLX 000024', 'TEST 22', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(24, 'PLX 000023', 'TEST 21', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(23, 'PLX 000022', 'TEST 20', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(22, 'PLX 000021', 'TEST 19', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(21, 'PLX 000020', 'TEST 18', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(20, 'PLX 000019', 'TEST 17', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(19, 'PLX 000018', 'TEST 16', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(18, 'PLX 000017', 'TEST 15', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(17, 'PLX 000016', 'TEST 14', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(16, 'PLX 000015', 'TEST 13', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(15, 'PLX 000014', 'TEST 12', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(14, 'PLX 000013', 'TEST 11', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(13, 'PLX 000012', 'TEST 10', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(12, 'PLX 000011', 'TEST 9', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(11, 'PLX 000010', 'TEST 8', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(10, 'PLX 000009', 'TEST 7', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(9, 'PLX 000008', 'TEST 6', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(8, 'PLX 000007', 'TEST 5', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(7, 'PLX 000006', 'TEST 4', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(6, 'PLX 000005', 'TEST 3', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(5, 'PLX 000004', 'TEST 2', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(4, 'PLX 000003', 'TEST 1', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(54, 'PLX 000053', 'TEST 51', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(55, 'PLX 000054', 'TEST 52', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(56, 'PLX 000055', 'TEST 53', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(57, 'PLX 000056', 'TEST 54', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(58, 'PLX 000057', 'TEST 55', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(59, 'PLX 000058', 'TEST 56', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(60, 'PLX 000059', 'TEST 57', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(61, 'PLX 000060', 'TEST 58', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(62, 'PLX 000061', 'TEST 59', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(63, 'PLX 000062', 'TEST 60', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(64, 'PLX 000063', 'TEST 61', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(65, 'PLX 000064', 'TEST 62', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(66, 'PLX 000065', 'TEST 63', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(67, 'PLX 000066', 'TEST 64', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(68, 'PLX 000067', 'TEST 65', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(69, 'PLX 000068', 'TEST 66', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(70, 'PLX 000069', 'TEST 67', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(71, 'PLX 000070', 'TEST 68', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(72, 'PLX 000071', 'TEST 69', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(73, 'PLX 000072', 'TEST 70', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(74, 'PLX 000073', 'TEST 71', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(75, 'PLX 000074', 'TEST 72', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(76, 'PLX 000075', 'TEST 73', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(77, 'PLX 000076', 'TEST 74', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(78, 'PLX 000077', 'TEST 75', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(79, 'PLX 000078', 'TEST 76', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(80, 'PLX 000079', 'TEST 77', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(81, 'PLX 000080', 'TEST 78', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(82, 'PLX 000081', 'TEST 79', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(83, 'PLX 000082', 'TEST 80', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(84, 'PLX 000083', 'TEST 81', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(85, 'PLX 000084', 'TEST 82', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(86, 'PLX 000085', 'TEST 83', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(87, 'PLX 000086', 'TEST 84', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(88, 'PLX 000087', 'TEST 85', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(89, 'PLX 000088', 'TEST 86', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(90, 'PLX 000089', 'TEST 87', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(91, 'PLX 000090', 'TEST 88', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(92, 'PLX 000091', 'TEST 89', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(93, 'PLX 000092', 'TEST 90', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(94, 'PLX 000093', 'TEST 91', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(95, 'PLX 000094', 'TEST 92', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(96, 'PLX 000095', 'TEST 93', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(97, 'PLX 000096', 'TEST 94', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(98, 'PLX 000097', 'TEST 95', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(99, 'PLX 000098', 'TEST 96', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(100, 'PLX 000099', 'TEST 97', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 'A', 'Branch'),
(101, '', '', 0, '', '', '', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '2021-09-30', 'A', 'HO'),
(102, '', '', 0, '', '', '', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '2021-09-30', 'A', 'HO'),
(103, '', '', 0, '', '', '', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '2021-09-30', 'A', 'HO'),
(104, '', '', 0, '', '', '', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '2021-09-30', 'A', 'HO');

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
  MODIFY `cid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `tbl_courier_officers`
--
ALTER TABLE `tbl_courier_officers`
  MODIFY `office` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_courier_track`
--
ALTER TABLE `tbl_courier_track`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `cid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
