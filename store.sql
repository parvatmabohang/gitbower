-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 21, 2018 at 04:46 AM
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
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE `attribute` (
  `aid` int(11) NOT NULL,
  `iid` int(11) NOT NULL,
  `iattribute` varchar(113) DEFAULT NULL,
  `iinfo` varchar(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`aid`, `iid`, `iattribute`, `iinfo`) VALUES
(1, 72, 'Model', 'Dota2'),
(2, 86, 'Price', '21323'),
(7, 86, 'esfd', 'sdf'),
(8, 72, 'Size', 'XXL'),
(9, 109, 'Color', 'Blue'),
(10, 109, 'Length', '20'),
(11, 109, 'Size', 'XL'),
(12, 106, 'asd', 'ad'),
(13, 106, 'wd', 'asdasd');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cid` int(123) NOT NULL,
  `createdby` int(123) NOT NULL,
  `ncategory` varchar(123) NOT NULL,
  `scategory` varchar(123) NOT NULL,
  `createdat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `createdby`, `ncategory`, `scategory`, `createdat`, `updatedat`) VALUES
(1, 64, 'Household Appliances', 'on', '2018-05-16 04:38:48', '2018-05-17 06:29:15'),
(2, 64, 'Sports', 'on', '2018-05-16 04:38:48', '2018-05-18 09:49:38'),
(3, 64, 'Books', 'on', '2018-05-16 04:38:48', '2018-05-16 04:43:36'),
(4, 64, 'Vehicle', 'on', '2018-05-16 04:38:48', '2018-05-17 05:41:54'),
(5, 64, 'Electrical Equipment', 'on', '2018-05-16 04:38:48', '2018-05-16 04:43:29'),
(15, 64, 'Snow', 'on', '2018-05-16 04:38:48', '2018-05-16 09:05:12'),
(16, 64, 'aaaaaaaaaaaaaaaa', 'on', '2018-05-17 07:19:28', '2018-05-17 07:19:28');

-- --------------------------------------------------------

--
-- Table structure for table `catupdate`
--

CREATE TABLE `catupdate` (
  `cupdateid` int(11) NOT NULL,
  `updateuserid` int(11) NOT NULL,
  `updatecid` int(11) DEFAULT NULL,
  `createdat` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `updatedat` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `event` varchar(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catupdate`
--

INSERT INTO `catupdate` (`cupdateid`, `updateuserid`, `updatecid`, `createdat`, `updatedat`, `event`) VALUES
(1, 64, 1, '2018-05-16 05:26:40.709006', '2018-05-16 05:26:40.709006', 'Category Updated'),
(7, 64, 15, '2018-05-16 09:05:12.405845', '2018-05-16 09:05:12.405845', 'Category Updated'),
(8, 64, 1, '2018-05-17 05:29:44.176473', '2018-05-17 05:29:44.176473', 'Category Updated'),
(9, 64, 1, '2018-05-17 05:29:55.684731', '2018-05-17 05:29:55.684731', 'Category Updated'),
(10, 64, 1, '2018-05-17 05:30:58.780880', '2018-05-17 05:30:58.780880', 'Category Updated'),
(11, 64, 1, '2018-05-17 05:33:22.663253', '2018-05-17 05:33:22.663253', 'Category Updated'),
(12, 64, 1, '2018-05-17 05:38:36.190435', '2018-05-17 05:38:36.190435', 'Category Updated'),
(13, 64, 1, '2018-05-17 05:39:08.748708', '2018-05-17 05:39:08.748708', 'Category Updated'),
(14, 64, 1, '2018-05-17 05:39:13.676604', '2018-05-17 05:39:13.676604', 'Category Updated'),
(15, 64, 1, '2018-05-17 05:39:17.760429', '2018-05-17 05:39:17.760429', 'Category Updated'),
(16, 64, 4, '2018-05-17 05:40:38.918867', '2018-05-17 05:40:38.918867', 'Category Updated'),
(17, 64, 4, '2018-05-17 05:41:48.590207', '2018-05-17 05:41:48.590207', 'Category Updated'),
(18, 64, 4, '2018-05-17 05:41:54.458931', '2018-05-17 05:41:54.458931', 'Category Updated'),
(19, 64, 2, '2018-05-17 05:45:53.199255', '2018-05-17 05:45:53.199255', 'Category Updated'),
(20, 64, 1, '2018-05-17 05:46:46.603487', '2018-05-17 05:46:46.603487', 'Category Updated'),
(21, 64, 1, '2018-05-17 06:14:01.077428', '2018-05-17 06:14:01.077428', 'Category Updated'),
(22, 64, 1, '2018-05-17 06:14:37.516785', '2018-05-17 06:14:37.516785', 'Category Updated'),
(23, 64, 1, '2018-05-17 06:29:03.732452', '2018-05-17 06:29:03.732452', 'Category Updated'),
(24, 64, 1, '2018-05-17 06:29:15.503292', '2018-05-17 06:29:15.503292', 'Category Updated'),
(25, 64, 16, '2018-05-17 07:19:28.442418', '2018-05-17 07:19:28.442418', 'Category Created'),
(26, 64, NULL, '2018-05-18 08:48:58.174538', '2018-05-18 08:48:58.174538', 'Category Updated'),
(27, 64, NULL, '2018-05-18 08:50:08.969765', '2018-05-18 08:50:08.969765', 'Category Updated'),
(28, 64, 2, '2018-05-18 09:49:38.111800', '2018-05-18 09:49:38.111800', 'Category Updated');

-- --------------------------------------------------------

--
-- Table structure for table `iimage`
--

CREATE TABLE `iimage` (
  `pid` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `ipic` varchar(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iimage`
--

INSERT INTO `iimage` (`pid`, `id`, `ipic`) VALUES
(116, 72, 'image/6411_Dota2-Axe.jpg'),
(130, 86, 'image/64IMG_9369-3.jpg'),
(135, 90, 'image/64p.jpg'),
(145, 102, 'image/64asd.png'),
(147, 104, 'image/64as.jpg'),
(149, 106, 'image/64g_1_future_shock.jpg'),
(150, 107, 'image/55LAa52ZfpTle0._UX300_TTW__.jpeg'),
(151, 108, 'image/22LAa52ZfpTle0._UX300_TTW__.jpeg'),
(152, 108, 'image/22asd.png'),
(153, 108, 'image/22as.jpg'),
(154, 109, 'image/64g_1_future_shock.jpg'),
(155, 72, 'image/6408bc82ff3f0b3a3be7ab86bd1d157d17.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `istore`
--

CREATE TABLE `istore` (
  `id` int(11) NOT NULL,
  `uid` int(123) NOT NULL,
  `iname` varchar(255) NOT NULL,
  `idetail` varchar(255) NOT NULL,
  `iprice` int(11) NOT NULL,
  `createdat` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `updatedat` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `event` varchar(123) NOT NULL,
  `istatus` varchar(123) NOT NULL,
  `icategory` varchar(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `istore`
--

INSERT INTO `istore` (`id`, `uid`, `iname`, `idetail`, `iprice`, `createdat`, `updatedat`, `event`, `istatus`, `icategory`) VALUES
(72, 64, 'DOTA2 AXE', 'all heroes are good', 789, '2018-05-11 07:41:00.463176', '2018-05-18 12:04:37.617201', 'Product Updated', 'on', '3'),
(86, 64, 'asdd', ' asd', 345, '2018-05-14 06:52:59.686563', '2018-05-18 11:38:02.272967', 'Product Updated', 'on', '3'),
(90, 64, 'gg', ' gg', 23456, '2018-05-14 08:47:05.475932', '2018-05-16 09:06:51.516197', 'Product Updated', 'on', '2'),
(102, 64, 'sasd', ' asdas', 1234, '2018-05-15 09:32:14.062270', '2018-05-16 09:06:33.213770', 'Product Stored', 'on', '3'),
(104, 64, 'tr', ' re', 3456, '2018-05-15 09:37:23.589767', '2018-05-15 09:37:23.589767', 'Product Stored', 'on', '1'),
(106, 64, 'dsa', ' sada', 23456, '2018-05-15 10:00:49.448112', '2018-05-16 09:06:56.462921', 'Product Updated', 'on', '15'),
(107, 55, 'hhwhhw', ' hhwhhw', 23456, '2018-05-16 05:54:15.893567', '2018-05-16 05:54:15.893567', 'Product Stored', 'on', '15'),
(108, 22, 'qwe', ' qwe', 34, '2018-05-16 05:57:09.249975', '2018-05-16 09:06:59.921492', 'Product Updated', 'on', '2'),
(109, 64, '2132', '123\r\nasd\r\nasd\r\n\r\nda\r\nsd\r\nada\r\nsda', 123, '2018-05-18 06:29:04.190034', '2018-05-18 06:29:04.190034', 'Product Stored', 'on', '15');

-- --------------------------------------------------------

--
-- Table structure for table `iupdate`
--

CREATE TABLE `iupdate` (
  `updateid` int(11) NOT NULL,
  `updateuid` int(11) NOT NULL,
  `updateuserid` int(123) NOT NULL,
  `updateiid` int(11) DEFAULT NULL,
  `createdat` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `updatedat` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `event` varchar(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iupdate`
--

INSERT INTO `iupdate` (`updateid`, `updateuid`, `updateuserid`, `updateiid`, `createdat`, `updatedat`, `event`) VALUES
(15, 64, 55, 72, '2018-05-11 05:57:11.555134', '2018-05-11 08:18:40.848395', ''),
(18, 64, 64, 72, '2018-05-11 08:22:16.123517', '2018-05-11 08:22:16.123517', ''),
(19, 55, 55, 72, '2018-05-11 08:22:56.334343', '2018-05-11 08:22:56.334343', ''),
(25, 64, 64, 72, '2018-05-14 06:41:45.592435', '2018-05-14 06:41:45.592435', 'Product Updated'),
(26, 64, 64, 72, '2018-05-14 06:41:55.467019', '2018-05-14 06:41:55.467019', 'Product Updated'),
(27, 64, 64, 72, '2018-05-14 06:43:07.833120', '2018-05-14 06:43:07.833120', 'Product Updated'),
(28, 64, 64, 72, '2018-05-14 06:44:23.761201', '2018-05-14 06:44:23.761201', 'Product Updated'),
(29, 64, 64, 72, '2018-05-14 06:44:25.974417', '2018-05-14 06:44:25.974417', 'Product Updated'),
(30, 64, 64, 72, '2018-05-14 06:44:27.709314', '2018-05-14 06:44:27.709314', 'Product Updated'),
(31, 64, 64, 72, '2018-05-14 06:44:29.165539', '2018-05-14 06:44:29.165539', 'Product Updated'),
(32, 64, 64, 72, '2018-05-14 06:44:35.257256', '2018-05-14 06:44:35.257256', 'Product Updated'),
(33, 64, 64, 72, '2018-05-14 06:44:41.560254', '2018-05-14 06:44:41.560254', 'Product Updated'),
(34, 64, 64, 72, '2018-05-14 06:44:48.064961', '2018-05-14 06:44:48.064961', 'Product Updated'),
(35, 64, 64, 72, '2018-05-14 06:44:49.799598', '2018-05-14 06:44:49.799598', 'Product Updated'),
(36, 64, 64, 72, '2018-05-14 06:44:53.868661', '2018-05-14 06:44:53.868661', 'Product Updated'),
(37, 64, 64, 72, '2018-05-14 06:44:54.736122', '2018-05-14 06:44:54.736122', 'Product Updated'),
(38, 64, 64, 72, '2018-05-14 06:45:39.241306', '2018-05-14 06:45:39.241306', 'Product Updated'),
(39, 64, 64, 72, '2018-05-14 06:48:01.427894', '2018-05-14 06:48:01.427894', 'Product Updated'),
(40, 64, 64, 72, '2018-05-14 06:48:33.443145', '2018-05-14 06:48:33.443145', 'Product Updated'),
(41, 64, 64, 72, '2018-05-14 06:48:52.988006', '2018-05-14 06:48:52.988006', 'Product Updated'),
(42, 64, 64, 86, '2018-05-14 06:52:59.737215', '2018-05-14 06:52:59.737215', 'Product Stored'),
(43, 64, 64, 86, '2018-05-14 06:53:07.055251', '2018-05-14 06:53:07.055251', 'Product Updated'),
(47, 64, 64, 90, '2018-05-14 08:47:05.630586', '2018-05-14 08:47:05.630586', 'Product Stored'),
(53, 64, 64, 72, '2018-05-14 09:03:24.027171', '2018-05-14 09:03:24.027171', 'Product Updated'),
(54, 64, 64, 72, '2018-05-14 09:03:36.397458', '2018-05-14 09:03:36.397458', 'Product Updated'),
(55, 64, 64, 72, '2018-05-14 09:05:29.019185', '2018-05-14 09:05:29.019185', 'Product Updated'),
(56, 64, 64, 72, '2018-05-14 09:10:17.167298', '2018-05-14 09:10:17.167298', 'Product Updated'),
(57, 64, 64, 72, '2018-05-14 09:10:26.871919', '2018-05-14 09:10:26.871919', 'Product Updated'),
(58, 64, 64, 72, '2018-05-14 09:12:43.629564', '2018-05-14 09:12:43.629564', 'Product Updated'),
(59, 64, 64, 72, '2018-05-14 09:12:49.935104', '2018-05-14 09:12:49.935104', 'Product Updated'),
(61, 64, 64, 72, '2018-05-14 09:14:43.330821', '2018-05-14 09:14:43.330821', 'Product Updated'),
(62, 64, 64, 72, '2018-05-14 09:15:34.257249', '2018-05-14 09:15:34.257249', 'Product Updated'),
(63, 64, 64, 72, '2018-05-14 09:32:15.866947', '2018-05-14 09:32:15.866947', 'Product Updated'),
(64, 64, 64, 72, '2018-05-14 11:27:28.293410', '2018-05-14 11:27:28.293410', 'Product Updated'),
(65, 64, 64, 72, '2018-05-14 11:27:30.750744', '2018-05-14 11:27:30.750744', 'Product Updated'),
(72, 64, 64, 102, '2018-05-15 09:32:14.228311', '2018-05-15 09:32:14.228311', 'Product Stored'),
(74, 64, 64, 104, '2018-05-15 09:37:23.640447', '2018-05-15 09:37:23.640447', 'Product Stored'),
(76, 64, 64, 72, '2018-05-15 09:44:17.988667', '2018-05-15 09:44:17.988667', 'Product Updated'),
(77, 64, 64, 106, '2018-05-15 10:00:49.501333', '2018-05-15 10:00:49.501333', 'Product Stored'),
(80, 55, 55, 107, '2018-05-16 05:54:15.965134', '2018-05-16 05:54:15.965134', 'Product Stored'),
(81, 22, 22, 108, '2018-05-16 05:57:09.308580', '2018-05-16 05:57:09.308580', 'Product Stored'),
(82, 22, 22, 108, '2018-05-16 06:16:39.209333', '2018-05-16 06:16:39.209333', 'Product Updated'),
(83, 64, 64, 72, '2018-05-16 08:59:10.491500', '2018-05-16 08:59:10.491500', 'Product Updated'),
(84, 64, 64, 86, '2018-05-16 09:05:23.621894', '2018-05-16 09:05:23.621894', 'Product Updated'),
(85, 64, 64, 90, '2018-05-16 09:05:32.668712', '2018-05-16 09:05:32.668712', 'Product Updated'),
(86, 64, 64, 106, '2018-05-16 09:05:41.250240', '2018-05-16 09:05:41.250240', 'Product Updated'),
(87, 64, 64, 86, '2018-05-17 06:14:58.050612', '2018-05-17 06:14:58.050612', 'Product Updated'),
(88, 64, 64, 86, '2018-05-17 06:16:52.692563', '2018-05-17 06:16:52.692563', 'Product Updated'),
(89, 64, 64, 86, '2018-05-17 06:17:04.331935', '2018-05-17 06:17:04.331935', 'Product Updated'),
(90, 64, 64, 86, '2018-05-17 06:17:26.699401', '2018-05-17 06:17:26.699401', 'Product Updated'),
(91, 64, 64, 86, '2018-05-17 06:17:52.729932', '2018-05-17 06:17:52.729932', 'Product Updated'),
(92, 64, 64, 86, '2018-05-17 06:26:58.919419', '2018-05-17 06:26:58.919419', 'Product Updated'),
(93, 64, 64, 86, '2018-05-17 06:27:26.587120', '2018-05-17 06:27:26.587120', 'Product Updated'),
(94, 64, 64, 86, '2018-05-17 06:27:49.874589', '2018-05-17 06:27:49.874589', 'Product Updated'),
(95, 64, 64, 86, '2018-05-17 06:28:06.918185', '2018-05-17 06:28:06.918185', 'Product Updated'),
(96, 64, 64, 72, '2018-05-17 07:25:40.948573', '2018-05-17 07:25:40.948573', 'Product Updated'),
(97, 64, 64, 86, '2018-05-17 07:29:16.215089', '2018-05-17 07:29:16.215089', 'Product Updated'),
(98, 64, 64, 109, '2018-05-18 06:29:04.285610', '2018-05-18 06:29:04.285610', 'Product Stored'),
(99, 64, 64, 72, '2018-05-18 06:49:33.358119', '2018-05-18 06:49:33.358119', 'Product Updated'),
(100, 64, 64, 72, '2018-05-18 09:20:43.692926', '2018-05-18 09:20:43.692926', 'Product Updated'),
(101, 64, 64, 86, '2018-05-18 10:51:49.429240', '2018-05-18 10:51:49.429240', 'Product Updated'),
(102, 64, 64, 86, '2018-05-18 10:53:14.802216', '2018-05-18 10:53:14.802216', 'Product Updated'),
(103, 64, 64, 72, '2018-05-18 11:00:10.386720', '2018-05-18 11:00:10.386720', 'Product Updated'),
(104, 64, 64, 72, '2018-05-18 11:15:01.870919', '2018-05-18 11:15:01.870919', 'Product Updated'),
(105, 64, 64, 72, '2018-05-18 11:15:31.608735', '2018-05-18 11:15:31.608735', 'Product Updated'),
(106, 64, 64, 72, '2018-05-18 11:15:37.111730', '2018-05-18 11:15:37.111730', 'Product Updated'),
(107, 64, 64, 72, '2018-05-18 11:19:59.769762', '2018-05-18 11:19:59.769762', 'Product Updated'),
(108, 64, 64, 72, '2018-05-18 11:20:54.364869', '2018-05-18 11:20:54.364869', 'Product Updated'),
(109, 64, 64, 72, '2018-05-18 11:21:26.676472', '2018-05-18 11:21:26.676472', 'Product Updated'),
(110, 64, 64, 72, '2018-05-18 11:21:38.790957', '2018-05-18 11:21:38.790957', 'Product Updated'),
(111, 64, 64, 72, '2018-05-18 11:21:44.361361', '2018-05-18 11:21:44.361361', 'Product Updated'),
(112, 64, 64, 72, '2018-05-18 11:21:50.841177', '2018-05-18 11:21:50.841177', 'Product Updated'),
(113, 64, 64, 72, '2018-05-18 11:22:52.458294', '2018-05-18 11:22:52.458294', 'Product Updated'),
(114, 64, 64, 72, '2018-05-18 11:25:19.226212', '2018-05-18 11:25:19.226212', 'Product Updated'),
(115, 64, 64, 72, '2018-05-18 11:25:25.505724', '2018-05-18 11:25:25.505724', 'Product Updated'),
(116, 64, 64, 72, '2018-05-18 11:25:31.777365', '2018-05-18 11:25:31.777365', 'Product Updated'),
(117, 64, 64, 72, '2018-05-18 11:25:46.569824', '2018-05-18 11:25:46.569824', 'Product Updated'),
(118, 64, 64, 72, '2018-05-18 11:26:15.054291', '2018-05-18 11:26:15.054291', 'Product Updated'),
(119, 64, 64, 72, '2018-05-18 11:27:41.987180', '2018-05-18 11:27:41.987180', 'Product Updated'),
(120, 64, 64, 72, '2018-05-18 11:27:44.713858', '2018-05-18 11:27:44.713858', 'Product Updated'),
(121, 64, 64, 72, '2018-05-18 11:27:46.937940', '2018-05-18 11:27:46.937940', 'Product Updated'),
(122, 64, 64, 72, '2018-05-18 11:27:48.851390', '2018-05-18 11:27:48.851390', 'Product Updated'),
(123, 64, 64, 72, '2018-05-18 11:28:15.194358', '2018-05-18 11:28:15.194358', 'Product Updated'),
(124, 64, 64, 72, '2018-05-18 11:28:21.297754', '2018-05-18 11:28:21.297754', 'Product Updated'),
(125, 64, 64, 72, '2018-05-18 11:28:22.965741', '2018-05-18 11:28:22.965741', 'Product Updated'),
(126, 64, 64, 72, '2018-05-18 11:28:25.356313', '2018-05-18 11:28:25.356313', 'Product Updated'),
(127, 64, 64, 72, '2018-05-18 11:28:32.281032', '2018-05-18 11:28:32.281032', 'Product Updated'),
(128, 64, 64, 72, '2018-05-18 11:28:34.049316', '2018-05-18 11:28:34.049316', 'Product Updated'),
(129, 64, 64, 72, '2018-05-18 11:34:39.174117', '2018-05-18 11:34:39.174117', 'Product Updated'),
(130, 64, 64, 72, '2018-05-18 11:35:01.413808', '2018-05-18 11:35:01.413808', 'Product Updated'),
(131, 64, 64, 72, '2018-05-18 11:35:13.815712', '2018-05-18 11:35:13.815712', 'Product Updated'),
(132, 64, 64, 72, '2018-05-18 11:35:43.280411', '2018-05-18 11:35:43.280411', 'Product Updated'),
(133, 64, 64, 72, '2018-05-18 11:35:47.882238', '2018-05-18 11:35:47.882238', 'Product Updated'),
(134, 64, 64, 72, '2018-05-18 11:36:25.701421', '2018-05-18 11:36:25.701421', 'Product Updated'),
(135, 64, 64, 72, '2018-05-18 11:36:29.003361', '2018-05-18 11:36:29.003361', 'Product Updated'),
(136, 64, 64, 72, '2018-05-18 11:36:31.782819', '2018-05-18 11:36:31.782819', 'Product Updated'),
(137, 64, 64, 86, '2018-05-18 11:37:44.286859', '2018-05-18 11:37:44.286859', 'Product Updated'),
(138, 64, 64, 86, '2018-05-18 11:38:00.336935', '2018-05-18 11:38:00.336935', 'Product Updated'),
(139, 64, 64, 86, '2018-05-18 11:38:02.404878', '2018-05-18 11:38:02.404878', 'Product Updated'),
(140, 64, 64, 72, '2018-05-18 11:40:37.524387', '2018-05-18 11:40:37.524387', 'Product Updated'),
(141, 64, 64, 72, '2018-05-18 11:40:49.172751', '2018-05-18 11:40:49.172751', 'Product Updated'),
(142, 64, 64, 72, '2018-05-18 11:41:01.732164', '2018-05-18 11:41:01.732164', 'Product Updated'),
(143, 64, 64, 72, '2018-05-18 12:04:37.984345', '2018-05-18 12:04:37.984345', 'Product Updated');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `reqid` int(11) NOT NULL,
  `requestuid` varchar(113) NOT NULL,
  `requestuname` varchar(123) NOT NULL,
  `requestucomment` varchar(123) NOT NULL,
  `requestcontact` int(123) NOT NULL,
  `reqiid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`reqid`, `requestuid`, `requestuname`, `requestucomment`, `requestcontact`, `reqiid`) VALUES
(2, 'parvatmaboo@gmail.com', '', '', 0, 108),
(3, 'parvatmao@gmail.com', '', '', 0, 108),
(4, 'haters11123@gmail.com', '', '', 0, 90),
(5, 'haters11123@gmail.com', '', '', 0, 90),
(6, 'paspds@gmail.com', '', '', 0, 106),
(7, 'asad@gmail.com', '', '', 0, 102),
(8, 'asdad@gmail.com', '', '', 0, 104),
(9, 'poip@gmail.com', 'poip', 'asdgyu byasdbhunj ', 0, 102),
(10, 'saddsaa@gmail.com', 'addas', ' asdas', 12345678, 72),
(11, 'asdasd@gmail.com', 'dssd', ' ghytrewe', 345676543, 72);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `uname` varchar(255) DEFAULT NULL,
  `uemail` varchar(255) DEFAULT NULL,
  `upw` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `uname`, `uemail`, `upw`) VALUES
(22, 'shikharmabo', 'haters11123@gmail.com', 'asd'),
(55, 'bibek limbu', 'bibek@gmail.com', 'qwe'),
(64, 'parvatmabo', 'parvatmabo@gmail.com', 'asd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`aid`),
  ADD KEY `id` (`iid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `catupdate`
--
ALTER TABLE `catupdate`
  ADD PRIMARY KEY (`cupdateid`),
  ADD KEY `updatecid` (`updatecid`);

--
-- Indexes for table `iimage`
--
ALTER TABLE `iimage`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `istore`
--
ALTER TABLE `istore`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iupdate`
--
ALTER TABLE `iupdate`
  ADD PRIMARY KEY (`updateid`),
  ADD KEY `updateuid` (`updateuid`),
  ADD KEY `updateiid` (`updateiid`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`reqid`),
  ADD KEY `reqiid` (`reqiid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cid` int(123) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `catupdate`
--
ALTER TABLE `catupdate`
  MODIFY `cupdateid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `iimage`
--
ALTER TABLE `iimage`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `istore`
--
ALTER TABLE `istore`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `iupdate`
--
ALTER TABLE `iupdate`
  MODIFY `updateid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `reqid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute`
--
ALTER TABLE `attribute`
  ADD CONSTRAINT `attribute_ibfk_1` FOREIGN KEY (`iid`) REFERENCES `istore` (`id`);

--
-- Constraints for table `catupdate`
--
ALTER TABLE `catupdate`
  ADD CONSTRAINT `catupdate_ibfk_1` FOREIGN KEY (`updatecid`) REFERENCES `category` (`cid`) ON DELETE CASCADE;

--
-- Constraints for table `iimage`
--
ALTER TABLE `iimage`
  ADD CONSTRAINT `iimage_ibfk_1` FOREIGN KEY (`id`) REFERENCES `istore` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `iupdate`
--
ALTER TABLE `iupdate`
  ADD CONSTRAINT `iupdate_ibfk_1` FOREIGN KEY (`updateuid`) REFERENCES `user` (`uid`) ON DELETE CASCADE,
  ADD CONSTRAINT `iupdate_ibfk_2` FOREIGN KEY (`updateiid`) REFERENCES `istore` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`reqiid`) REFERENCES `istore` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
