-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2019 at 11:17 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pro_x1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_control`
--

CREATE TABLE `admin_control` (
  `admincontrol_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `stdid` varchar(255) CHARACTER SET utf8 NOT NULL,
  `roomid` int(11) NOT NULL,
  `time` varchar(255) CHARACTER SET utf8 NOT NULL,
  `reserv_time` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `approve_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `allroom`
--

CREATE TABLE `allroom` (
  `roomid` int(11) NOT NULL,
  `roomname` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `allroom`
--

INSERT INTO `allroom` (`roomid`, `roomname`, `status`) VALUES
(1, 'Room1', '2'),
(4, 'Room2', '2'),
(5, 'Room3', '2'),
(6, 'Room99', '2');

-- --------------------------------------------------------

--
-- Table structure for table `auto`
--

CREATE TABLE `auto` (
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auto`
--

INSERT INTO `auto` (`status`) VALUES
(0);

-- --------------------------------------------------------

--
-- Table structure for table `blacklist`
--

CREATE TABLE `blacklist` (
  `blacklist_id` int(11) NOT NULL,
  `blacklist_userid` int(11) NOT NULL,
  `blacklist_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `blacklist_stdid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `blacklist_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `blacklist_note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `blacklist_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blacklist`
--

INSERT INTO `blacklist` (`blacklist_id`, `blacklist_userid`, `blacklist_name`, `blacklist_stdid`, `blacklist_date`, `blacklist_note`, `blacklist_status`) VALUES
(1, 99, 'นหก่ดฟ้ด้หกาดา้', '7788', '2019-09-24 10:25:01', 'ชำรุด', 0),
(2, 99, 'นหก่ดฟ้ด้หกาดา้', '7788', '2019-09-24 10:25:01', 'ชำรุด', 0),
(3, 99, 'นหก่ดฟ้ด้หกาดา้', '7788', '2019-09-24 10:25:01', 'ชำรุด', 0),
(4, 6, 'black_list_test1', '6789', '2019-09-24 11:18:05', 'ยาม', 0),
(5, 6, 'black_list_test1', '6789', '2019-09-24 11:22:26', 'พำ', 0),
(6, 6, 'black_list_test1', '6789', '2019-09-24 11:28:24', '[[[[', 0),
(7, 1, 'kittinan', '59523206001-1', '2019-09-26 15:34:35', 'ห้องชำรุด', 0),
(8, 6, 'black_list_test1', '6789', '2019-09-28 11:44:35', 'ทำห้องชำรุด', 0),
(9, 2, 'wachira', '59523206044-1', '2019-09-28 16:11:48', 'ห้องชำรุด', 0),
(10, 20, 'นายวชิร วินิจฉัย', '59523206044-1', '2019-09-28 16:11:48', 'ห้องชำรุด', 0),
(11, 6, 'black_list_test1', '6789', '2019-10-17 06:57:02', '', 0),
(12, 1, 'kittinan', '59523206001-1', '2019-10-17 06:57:13', '', 0),
(13, 6, 'black_list_test1', '6789', '2019-10-17 06:59:00', '', 0),
(14, 5, 'แอดมิน', '12345', '2019-10-17 06:59:06', '', 0),
(15, 6, 'black_list_test1', '6789', '2019-10-17 06:59:24', '', 1),
(16, 5, 'แอดมิน', '12345', '2019-10-17 07:08:04', '', 0),
(17, 5, 'แอดมิน', '12345', '2019-10-17 07:09:28', '', 0),
(18, 5, 'แอดมิน', '12345', '2019-10-17 07:10:07', 'www', 0);

-- --------------------------------------------------------

--
-- Table structure for table `history_reservation`
--

CREATE TABLE `history_reservation` (
  `h_id` int(11) NOT NULL,
  `h_name` varchar(255) NOT NULL,
  `h_stdid` varchar(255) NOT NULL,
  `h_roomid` int(11) NOT NULL,
  `h_time` varchar(255) NOT NULL,
  `h_reserv_time` int(11) NOT NULL,
  `h_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history_reservation`
--

INSERT INTO `history_reservation` (`h_id`, `h_name`, `h_stdid`, `h_roomid`, `h_time`, `h_reserv_time`, `h_status`) VALUES
(58, 'admin', '12212121212', 1, '28/09/19-00:58', 2, 2),
(59, 'admin', '12212121212', 1, '27/09/19-01:06', 1, 2),
(60, 'kittinan', '59523206001-1', 0, '', 0, 1),
(61, 'admin', '12212121212', 0, '', 0, 1),
(62, 'admin', '12212121212', 1, '27/09/19-01:06', 5, 2),
(63, '', '', 0, '27/09/19', 0, 0),
(64, '', '', 0, '27/19/19', 0, 0),
(65, '', '', 0, '25/09/19', 0, 0),
(66, '', '', 0, '21/09/19', 0, 0),
(67, '', '', 0, '21/09/19', 0, 0),
(68, '', '', 0, '19/09/19', 0, 0),
(69, 'kittinan', '59523206001-1', 1, '28/09/19-02:18', 1, 2),
(70, 'นายวชิร วินิจฉัย', '59523206044-1', 1, '28/09/19-18:38', 3, 0),
(71, 'นายวชิร วินิจฉัย', '59523206044-1', 1, '28/09/19-18:56', 5, 2),
(72, 'นายเกียรติสง่า ผิวเหลือง', '59523206003-8', 5, '28/09/19-22:57', 5, 0),
(73, 'นายเกียรติสง่า ผิวเหลือง', '59523206003-8', 4, '28/09/19-22:58', 5, 0),
(74, 'เกียรติสง่า ผิวเหลือง', '59523206003-8', 4, '28/09/19-22:59', 5, 2),
(75, 'เกียรติสง่า ผิวเหลือง', '59523206003-8', 4, '28/09/19-23:07', 5, 0),
(76, 'เกียรติสง่า ผิวเหลือง', '59523206003-8', 1, '28/09/19-23:20', 6, 0),
(77, 'เกียรติสง่า ผิวเหลือง', '59523206003-8', 1, '28/09/19-18:21', 6, 2),
(78, 'เกียรติสง่า ผิวเหลือง', '59523206003-8', 1, '28/09/19-23:22', 6, 0),
(79, 'เกียรติสง่า ผิวเหลือง', '59523206003-8', 1, '28/09/19-23:22', 6, 2),
(80, 'นายวชิร วินิจฉัย', '59523206044-1', 1, '01/10/19-18:49', 5, 2),
(81, 'นายวชิร วินิจฉัย', '59523206044-1', 1, '01/10/19-23:56', 5, 2),
(82, 'นายวชิร วินิจฉัย', '59523206044-1', 1, '02/10/19-00:03', 5, 2),
(83, 'kittinan', '59523206001-1', 1, '02/10/19-00:07', 6, 0),
(84, 'kittinan', '59523206001-1', 4, '02/10/19-00:41', 5, 2),
(85, 'kittinan', '59523206001-1', 1, '05/10/19-11:09', 9, 0),
(86, 'kittinan', '59523206001-1', 1, '05/10/19-11:14', 9, 0),
(87, 'kittinan', '59523206001-1', 1, '05/10/19-11:14', 9, 0),
(88, 'kittinan', '59523206001-1', 1, '05/10/19-11:20', 9, 0),
(89, 'kittinan', '59523206001-1', 5, '05/10/19-11:21', 9, 0),
(90, 'kittinan', '59523206001-1', 5, '05/10/19-16:24', 9, 0),
(91, 'kittinan', '59523206001-1', 5, '05/10/19-16:26', 9, 2),
(92, 'kittinan', '59523206001-1', 1, '05/10/19-16:31', 9, 2),
(93, 'kittinan', '59523206001-1', 1, '05/10/19-16:34', 9, 2),
(94, 'เจ้าหน้าที่', '12212121212', 1, '05/10/19-16:36', 9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(11) NOT NULL,
  `stdid` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `name`, `username`, `password`, `status`, `stdid`) VALUES
(1, 'kittinan', 'boat', '1234', 1, '59523206001-1'),
(2, 'wachira', 'mos', '1234', 1, '59523206044-1'),
(3, 'เจ้าหน้าที่', 'admin', 'admin', 2, '12212121212'),
(4, 'admin2', 'admin2', 'admin2', 2, '5874555'),
(5, 'แอดมิน', 'master', 'master', 1, '12345'),
(6, 'black_list_test1', 'b1', 'b1', 4, '6789'),
(7, 'qwqqqqqqq', 'ospfkka', '1234', 1, '58456521-8'),
(8, 'นายธรรมดา สุดๆแล้ว', 'b', 'b', 1, '59523206006-8'),
(9, 'สมศัก ทองคำ', 'admin3', 'admin3', 2, ''),
(10, 'สมศัก ทองคำ', 'admin3', 'admin3', 2, ''),
(11, 'ยยนยนย', 'qq', 'qq', 2, '89898989'),
(12, 'asd', '', 'ww', 2, 'asdas'),
(13, 'asd', ' ', 'ww', 1, 'asd'),
(14, 'asd', ' ', 'ww', 1, 'asd'),
(15, 'qwe', '', 'boatfull', 1, 'qwe'),
(16, '', 'boatasd', 'boatfullasdasd', 1, 'asd'),
(17, '', 'boatasd', 'boatfullasdasd', 1, 'asd'),
(18, '', 'boatasd', 'boatfullasdasd', 1, 'asd'),
(19, '', 'boatasd', 'boatfullasd', 1, 'asd'),
(20, 'นายวชิร วินิจฉัย', 'mosmos', '1', 1, '59523206044-1'),
(21, 'เกียรติสง่า ผิวเหลือง', 'nong', '1234', 1, '59523206003-8'),
(22, 'adboat', 'adboat', '1234', 2, '2222'),
(23, 'สามเทา เกาหัว', 'a', 'a', 1, '59523206007-8');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `rid` int(11) NOT NULL,
  `roomid` int(11) NOT NULL,
  `date` date NOT NULL,
  `1` int(255) NOT NULL,
  `q1` varchar(255) CHARACTER SET utf8 NOT NULL,
  `2` int(11) NOT NULL,
  `q2` varchar(255) CHARACTER SET utf8 NOT NULL,
  `3` int(11) NOT NULL,
  `q3` varchar(255) CHARACTER SET utf8 NOT NULL,
  `4` int(11) NOT NULL,
  `q4` varchar(255) CHARACTER SET utf8 NOT NULL,
  `5` int(11) NOT NULL,
  `q5` varchar(255) CHARACTER SET utf8 NOT NULL,
  `6` int(11) NOT NULL,
  `q6` varchar(255) CHARACTER SET utf8 NOT NULL,
  `7` int(11) NOT NULL,
  `q7` varchar(255) CHARACTER SET utf8 NOT NULL,
  `8` int(11) NOT NULL,
  `q8` varchar(255) CHARACTER SET utf8 NOT NULL,
  `9` int(11) NOT NULL,
  `q9` varchar(255) CHARACTER SET utf8 NOT NULL,
  `q10` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`rid`, `roomid`, `date`, `1`, `q1`, `2`, `q2`, `3`, `q3`, `4`, `q4`, `5`, `q5`, `6`, `q6`, `7`, `q7`, `8`, `q8`, `9`, `q9`, `q10`) VALUES
(1, 1, '0000-00-00', 3, ' ', 3, ' ', 3, ' ', 3, ' ', 3, ' ', 3, ' ', 3, ' ', 0, ' ', 0, ' ', '99999/250/1/10'),
(4, 4, '0000-00-00', 3, ' ', 3, ' ', 3, ' ', 3, ' ', 3, ' ', 3, ' ', 3, ' ', 0, ' ', 0, ' ', '99999/167/4/10'),
(5, 5, '0000-00-00', 3, ' ', 3, ' ', 3, ' ', 3, ' ', 3, ' ', 3, ' ', 3, ' ', 0, ' ', 0, ' ', ''),
(6, 6, '0000-00-00', 3, ' ', 3, ' ', 3, ' ', 3, ' ', 3, ' ', 3, ' ', 3, ' ', 0, ' ', 0, ' ', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_control`
--
ALTER TABLE `admin_control`
  ADD PRIMARY KEY (`admincontrol_id`);

--
-- Indexes for table `allroom`
--
ALTER TABLE `allroom`
  ADD PRIMARY KEY (`roomid`);

--
-- Indexes for table `blacklist`
--
ALTER TABLE `blacklist`
  ADD PRIMARY KEY (`blacklist_id`);

--
-- Indexes for table `history_reservation`
--
ALTER TABLE `history_reservation`
  ADD PRIMARY KEY (`h_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`rid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_control`
--
ALTER TABLE `admin_control`
  MODIFY `admincontrol_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `allroom`
--
ALTER TABLE `allroom`
  MODIFY `roomid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `blacklist`
--
ALTER TABLE `blacklist`
  MODIFY `blacklist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `history_reservation`
--
ALTER TABLE `history_reservation`
  MODIFY `h_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
