-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2019 at 09:08 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proj_pice`
--

-- --------------------------------------------------------

--
-- Table structure for table `pr_catagory`
--

CREATE TABLE `pr_catagory` (
  `id` int(11) NOT NULL,
  `nameid` varchar(8) COLLATE utf8_bin NOT NULL,
  `detail` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `pr_catagory`
--

INSERT INTO `pr_catagory` (`id`, `nameid`, `detail`) VALUES
(1, 'A1', 'Spring,Washer,Nut&Bolt'),
(2, 'A2', 'Fitting,Nut&Bolt'),
(3, 'A3', 'Cup seal,O-ring'),
(4, 'A4', 'สายลม'),
(5, 'A5', 'Top chain EOL,Spiral'),
(6, 'B1', 'Spiral,Roller conveyor'),
(7, 'B2', 'Cylinder'),
(8, 'B3', 'Bearing'),
(9, 'B4', 'Bearing'),
(10, 'B5', 'Top chain line bottle'),
(11, 'C1', 'Specials part G1,C3'),
(12, 'C2', 'Specials Part AK'),
(13, 'C3', 'Specials Part VH1'),
(14, 'C4', 'Specials Part V1,LF5'),
(15, 'C5', 'Blank'),
(16, 'D1', 'Cylinder'),
(17, 'D2', '(Unknow)'),
(18, 'D3', 'Flat belt(Unknow)'),
(19, 'D4', 'Belt(Unknow)'),
(20, 'D5', 'Belt(Unknow)'),
(21, 'E1', 'Knife,Cutting unit'),
(22, 'E2', 'Specials part V2-MP4'),
(23, 'E3', 'Specials part V2-MP4'),
(24, 'E4', 'Blank'),
(25, 'E5', 'Blank');

-- --------------------------------------------------------

--
-- Table structure for table `pr_line`
--

CREATE TABLE `pr_line` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `pr_line`
--

INSERT INTO `pr_line` (`id`, `name`) VALUES
(1, 'AK1'),
(2, 'AK2'),
(3, 'AK3'),
(4, 'AK4'),
(5, 'AK5'),
(6, 'V1'),
(7, 'V2'),
(8, 'V3'),
(9, 'MP1'),
(10, 'MP2'),
(11, 'MP3'),
(12, 'MP4'),
(13, 'MP5'),
(14, 'C3'),
(15, 'G1'),
(16, 'VH1'),
(17, 'LF5'),
(18, 'C2'),
(19, 'EOL1'),
(20, 'EOL2'),
(21, 'EOL3'),
(22, 'Blank'),
(23, 'Etc.');

-- --------------------------------------------------------

--
-- Table structure for table `pr_oauthen`
--

CREATE TABLE `pr_oauthen` (
  `id` int(10) NOT NULL,
  `provider` varchar(32) COLLATE utf8_bin NOT NULL,
  `authen_id` varchar(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(10) NOT NULL,
  `detail` text COLLATE utf8_bin NOT NULL,
  `time_sign` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `pr_oauthen`
--

INSERT INTO `pr_oauthen` (`id`, `provider`, `authen_id`, `user_id`, `detail`, `time_sign`) VALUES
(1, 'google', '60030112@kmitl.ac.th', 2, '{\"envelope\":{\"alg\":\"RS256\",\"kid\":\"8d7bf7218832047dea3f74016fe45fd0d9d42a29\",\"typ\":\"JWT\"},\"payload\":{\"iss\":\"accounts.google.com\",\"azp\":\"286768830126-uocva0ivr16sqf5mfvq7880gi15mgcke.apps.googleusercontent.com\",\"aud\":\"286768830126-uocva0ivr16sqf5mfvq7880gi15mgcke.apps.googleusercontent.com\",\"sub\":\"118438199893370098736\",\"hd\":\"kmitl.ac.th\",\"email\":\"60030112@kmitl.ac.th\",\"email_verified\":true,\"at_hash\":\"L36oYRIqC8uau9hA1l-kZg\",\"iat\":1545358559,\"exp\":1545362159}}', '2018-12-21 02:15:57'),
(2, 'google', '60030014@kmitl.ac.th', 3, '{\"envelope\":{\"alg\":\"RS256\",\"kid\":\"8d7bf7218832047dea3f74016fe45fd0d9d42a29\",\"typ\":\"JWT\"},\"payload\":{\"iss\":\"accounts.google.com\",\"azp\":\"286768830126-uocva0ivr16sqf5mfvq7880gi15mgcke.apps.googleusercontent.com\",\"aud\":\"286768830126-uocva0ivr16sqf5mfvq7880gi15mgcke.apps.googleusercontent.com\",\"sub\":\"106165741483430139784\",\"hd\":\"kmitl.ac.th\",\"email\":\"60030014@kmitl.ac.th\",\"email_verified\":true,\"at_hash\":\"p-xJDIy6yNXnPaAP4IMUkQ\",\"iat\":1545358625,\"exp\":1545362225}}', '2018-12-21 02:17:03'),
(3, 'google', '60030007@kmitl.ac.th', 4, '{\"envelope\":{\"alg\":\"RS256\",\"kid\":\"8d7bf7218832047dea3f74016fe45fd0d9d42a29\",\"typ\":\"JWT\"},\"payload\":{\"iss\":\"accounts.google.com\",\"azp\":\"286768830126-uocva0ivr16sqf5mfvq7880gi15mgcke.apps.googleusercontent.com\",\"aud\":\"286768830126-uocva0ivr16sqf5mfvq7880gi15mgcke.apps.googleusercontent.com\",\"sub\":\"107656029094251305197\",\"hd\":\"kmitl.ac.th\",\"email\":\"60030007@kmitl.ac.th\",\"email_verified\":true,\"at_hash\":\"1dkFIJjGvIo8zhrIM8wi9g\",\"iat\":1545359004,\"exp\":1545362604}}', '2018-12-21 02:23:22'),
(4, 'google', '60030037@kmitl.ac.th', 5, '{\"envelope\":{\"alg\":\"RS256\",\"kid\":\"26fc4cd23d387cbc490f60db54a94a6dd1653998\",\"typ\":\"JWT\"},\"payload\":{\"iss\":\"accounts.google.com\",\"azp\":\"286768830126-uocva0ivr16sqf5mfvq7880gi15mgcke.apps.googleusercontent.com\",\"aud\":\"286768830126-uocva0ivr16sqf5mfvq7880gi15mgcke.apps.googleusercontent.com\",\"sub\":\"102186164878491649156\",\"hd\":\"kmitl.ac.th\",\"email\":\"60030037@kmitl.ac.th\",\"email_verified\":true,\"at_hash\":\"lf9EVEzum_WgHD9mIxl1tA\",\"iat\":1556105174,\"exp\":1556108774}}', '2019-04-24 11:26:07'),
(5, 'google', 'sckmitl@kmitl.ac.th', 6, '{\"envelope\":{\"alg\":\"RS256\",\"kid\":\"6864289ffa51e4e17f14edfaaf5130df40d89e7d\",\"typ\":\"JWT\"},\"payload\":{\"iss\":\"accounts.google.com\",\"azp\":\"771126741100-c8fpr3edpaoj1si1n6obhnv40rerri6e.apps.googleusercontent.com\",\"aud\":\"771126741100-c8fpr3edpaoj1si1n6obhnv40rerri6e.apps.googleusercontent.com\",\"sub\":\"116902531688439214120\",\"hd\":\"kmitl.ac.th\",\"email\":\"sckmitl@kmitl.ac.th\",\"email_verified\":true,\"at_hash\":\"CM0LLsum5jeaWW4lnPHPlw\",\"iat\":1561184849,\"exp\":1561188449}}', '2019-06-22 06:27:25'),
(6, 'google', '59010385@kmitl.ac.th', 7, '{\"envelope\":{\"alg\":\"RS256\",\"kid\":\"6864289ffa51e4e17f14edfaaf5130df40d89e7d\",\"typ\":\"JWT\"},\"payload\":{\"iss\":\"accounts.google.com\",\"azp\":\"771126741100-c8fpr3edpaoj1si1n6obhnv40rerri6e.apps.googleusercontent.com\",\"aud\":\"771126741100-c8fpr3edpaoj1si1n6obhnv40rerri6e.apps.googleusercontent.com\",\"sub\":\"117148343950594740069\",\"hd\":\"kmitl.ac.th\",\"email\":\"59010385@kmitl.ac.th\",\"email_verified\":true,\"at_hash\":\"-IvASzipqgsMXYEK2cXKOQ\",\"iat\":1561194708,\"exp\":1561198308}}', '2019-06-22 09:11:47');

-- --------------------------------------------------------

--
-- Table structure for table `pr_order`
--

CREATE TABLE `pr_order` (
  `id` int(11) NOT NULL,
  `supid` int(11) DEFAULT NULL,
  `name` varchar(64) COLLATE utf8_bin NOT NULL,
  `amount` int(11) NOT NULL,
  `unit` varchar(16) COLLATE utf8_bin NOT NULL,
  `line` int(11) NOT NULL,
  `remark` varchar(256) COLLATE utf8_bin NOT NULL,
  `pic` varchar(64) COLLATE utf8_bin NOT NULL,
  `is_pending` int(11) NOT NULL,
  `is_userconfirm` int(11) NOT NULL,
  `is_approve` int(11) DEFAULT NULL,
  `is_adminconfirm` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `pr_order`
--

INSERT INTO `pr_order` (`id`, `supid`, `name`, `amount`, `unit`, `line`, `remark`, `pic`, `is_pending`, `is_userconfirm`, `is_approve`, `is_adminconfirm`, `user_id`, `datetime`) VALUES
(1, 1, 'Nut M3', 12, 'ตัว', 1, '', 'A-001.png', 1, 1, 0, 1, 1, '2019-07-23 13:43:24'),
(2, 1, 'Nut M3', 12, 'ตัว', 1, '', 'A-001.png', 0, 1, 1, 1, 1, '2019-07-23 13:43:24'),
(3, NULL, 'wefwef', 1, 'wefew', 1, '', 'noimage.png', 0, 1, 1, 1, 1, '2019-07-23 13:43:24'),
(4, 1, 'Nut M3', 30, 'ตัว', 1, '', 'A-001.png', 0, 1, 1, 1, 1, '2019-07-24 12:45:06'),
(5, 2, 'test', 9, 'อัน', 3, '', 'noimage.png', 0, 1, 1, 1, 1, '2019-07-24 12:56:17'),
(6, 1, 'Nut M3', 50, 'ตัว', 1, '', 'A-001.png', 1, 1, 0, 1, 1, '2019-07-24 12:56:27'),
(7, 2, 'test', 10, 'อัน', 1, '', 'noimage.png', 0, 1, 1, 0, 1, '2019-07-24 13:50:44'),
(8, 1, 'Nut M3', 50, 'ตัว', 1, '', 'A-001.png', 0, 1, 1, 0, 1, '2019-07-24 13:48:47'),
(9, NULL, 'test', 16, 'pcs', 1, '', 'noimage.png', 0, 1, 1, 0, 1, '2019-07-24 14:01:04'),
(10, 1, 'Nut M3', 50, 'ตัว', 1, '', 'A-001.png', 1, 1, 1, 0, 1, '2019-07-24 14:02:16'),
(11, 2, 'test', 10, 'อัน', 1, '', 'noimage.png', 0, 1, 1, 0, 1, '2019-07-24 14:02:26');

-- --------------------------------------------------------

--
-- Table structure for table `pr_site_config`
--

CREATE TABLE `pr_site_config` (
  `config_name` varchar(32) COLLATE utf8_bin NOT NULL,
  `detail` text COLLATE utf8_bin NOT NULL,
  `lastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `pr_site_config`
--

INSERT INTO `pr_site_config` (`config_name`, `detail`, `lastUpdate`) VALUES
('activeGoogleOpenID', 'deactivated', '2019-07-02 11:32:45'),
('applications', '[{\"name\":\"HeadTeacher\",\"config\":{\"type\":\"Application\",\"userType\":\"user\"}},{\"name\":\"admin\",\"config\":{\"type\":\"systemApp\",\"userType\":\"administrator\"}},{\"name\":\"finance_\",\"config\":{\"type\":\"Application\",\"userType\":\"user\"}},{\"name\":\"stock\",\"config\":{\"type\":\"Application\",\"userType\":\"user\"}},{\"name\":\"teacher_\",\"config\":{\"type\":\"Application\",\"userType\":\"user\"}},{\"name\":\"user\",\"config\":{\"type\":\"systemApp\",\"userType\":[\" \",\"user\",\"administrator\",\"teacher\"]}}]', '2019-07-02 12:20:03'),
('googleAppID', '771126741100-c8fpr3edpaoj1si1n6obhnv40rerri6e.apps.googleusercontent.com', '2019-05-28 11:42:17'),
('googleAppSecret', 'd8rGPU8FwnoLFO7b0Q3V1ZqV', '2019-05-28 11:42:27'),
('siteName', '<b>My Storage</b><h3>Uni HCL</h3>', '2019-07-05 00:39:49'),
('siteURL', 'http://localhost/picework', '2019-07-12 12:42:22'),
('subName', '<b>My Storage</b>', '2019-07-05 00:39:33');

-- --------------------------------------------------------

--
-- Table structure for table `pr_status_data`
--

CREATE TABLE `pr_status_data` (
  `id` int(11) NOT NULL,
  `detail` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `pr_status_data`
--

INSERT INTO `pr_status_data` (`id`, `detail`) VALUES
(1, 'ปกติ'),
(2, 'หมด'),
(3, 'ใกล้หมด'),
(4, 'ชำรุด'),
(5, 'สูญหาย');

-- --------------------------------------------------------

--
-- Table structure for table `pr_supplies`
--

CREATE TABLE `pr_supplies` (
  `id` int(11) NOT NULL,
  `sid` varchar(20) COLLATE utf8_bin NOT NULL,
  `name` varchar(60) COLLATE utf8_bin NOT NULL,
  `cname` varchar(60) COLLATE utf8_bin NOT NULL,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `pic` varchar(100) COLLATE utf8_bin NOT NULL,
  `box` varchar(80) COLLATE utf8_bin NOT NULL,
  `remain_amount` int(11) NOT NULL,
  `statusid` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `pr_supplies`
--

INSERT INTO `pr_supplies` (`id`, `sid`, `name`, `cname`, `min`, `max`, `unit`, `pic`, `box`, `remain_amount`, `statusid`, `catid`, `datetime`) VALUES
(1, 'A-001', 'Nut M3', 'นัท M3', 10, 50, 2, 'A-001.png', 'A1-001', 0, 2, 1, '2019-07-24 14:10:33'),
(2, 'test', 'test', 'test', 1, 10, 1, 'noimage.png', 'test', 8, 1, 2, '2019-07-24 14:08:09');

-- --------------------------------------------------------

--
-- Table structure for table `pr_transaction`
--

CREATE TABLE `pr_transaction` (
  `id` int(11) NOT NULL,
  `supid` int(11) NOT NULL,
  `amount` int(20) NOT NULL,
  `type` int(11) NOT NULL,
  `remark` varchar(200) COLLATE utf8_bin NOT NULL,
  `userid` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `line` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `pr_transaction`
--

INSERT INTO `pr_transaction` (`id`, `supid`, `amount`, `type`, `remark`, `userid`, `datetime`, `line`) VALUES
(1, 1, 20, 1, '', 14, '2019-07-12 02:04:44', 0),
(2, 1, 20, 1, '', 1, '2019-07-22 12:44:58', 0),
(3, 1, -31, 2, '', 1, '2019-07-22 14:11:24', 0),
(4, 2, 25, 1, '', 1, '2019-07-22 14:30:59', 0),
(5, 2, 24, 3, 'เบิกวัสดุ', 1, '2019-07-23 10:43:44', 6),
(6, 1, -9, 2, '', 1, '2019-07-24 12:25:07', 0),
(7, 2, 1, 3, '', 1, '2019-07-24 12:53:51', 7),
(8, 1, 245, 3, '', 1, '2019-07-24 14:08:09', 9),
(9, 2, 62, 3, '', 1, '2019-07-24 14:08:09', 9),
(10, 1, 5, 3, '', 59, '2019-07-24 14:10:33', 16);

-- --------------------------------------------------------

--
-- Table structure for table `pr_type`
--

CREATE TABLE `pr_type` (
  `id` int(11) NOT NULL,
  `name` varchar(40) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `pr_type`
--

INSERT INTO `pr_type` (`id`, `name`) VALUES
(1, 'เพิ่ม'),
(2, 'ปรับยอด'),
(3, 'เบิก');

-- --------------------------------------------------------

--
-- Table structure for table `pr_unit_data`
--

CREATE TABLE `pr_unit_data` (
  `id` int(11) NOT NULL COMMENT 'รหัสหน่วยนับ',
  `unit_name` varchar(100) NOT NULL COMMENT 'ชื่อหน่วยนับ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pr_unit_data`
--

INSERT INTO `pr_unit_data` (`id`, `unit_name`) VALUES
(1, 'อัน'),
(2, 'ตัว'),
(3, 'ม้วน'),
(4, 'เล่ม');

-- --------------------------------------------------------

--
-- Table structure for table `pr_userdata`
--

CREATE TABLE `pr_userdata` (
  `user_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `password` varchar(32) COLLATE utf8_bin NOT NULL,
  `title` varchar(64) COLLATE utf8_bin NOT NULL,
  `name` varchar(140) COLLATE utf8_bin NOT NULL,
  `surname` varchar(140) COLLATE utf8_bin NOT NULL,
  `position` varchar(140) COLLATE utf8_bin DEFAULT NULL,
  `mobile` varchar(10) COLLATE utf8_bin NOT NULL,
  `email` varchar(60) COLLATE utf8_bin NOT NULL,
  `user_type` enum('administrator','user') COLLATE utf8_bin NOT NULL DEFAULT 'user',
  `accession` text COLLATE utf8_bin NOT NULL,
  `default_uri` varchar(64) COLLATE utf8_bin NOT NULL,
  `active` enum('Y','N','B') COLLATE utf8_bin NOT NULL,
  `signup` datetime NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `pr_userdata`
--

INSERT INTO `pr_userdata` (`user_id`, `dept_id`, `username`, `password`, `title`, `name`, `surname`, `position`, `mobile`, `email`, `user_type`, `accession`, `default_uri`, `active`, `signup`, `last_login`) VALUES
(1, 2, 'administrator', '200ceb26807d6bf99fd6f4f0d1ca54d4', '1', 'Admin', 'Mystorage', 'Admin', '08x-xxxxxx', 'example@example.com', 'administrator', '[\"\"]', 'main/main/dashboard/index', 'Y', '0000-00-00 00:00:00', '2019-07-26 16:22:17'),
(14, 2, 'iceice415', '48e2cd1366743e0d67e54a85d2af6841', '1', 'ณภัทร', 'พิพัฒนปราการ', 'ฝึกงาน', '0819387813', '', 'administrator', '[]', '', 'Y', '2019-07-06 17:35:37', '2019-07-24 11:53:33'),
(59, 0, 'naphatice2411', '25d55ad283aa400af464c76d713c07ad', '', 'ธนัชพร', 'งามสุข', NULL, '0989412585', '', 'user', '[]', '', 'Y', '2019-07-09 07:48:16', '2019-07-24 21:09:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pr_catagory`
--
ALTER TABLE `pr_catagory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pr_line`
--
ALTER TABLE `pr_line`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pr_oauthen`
--
ALTER TABLE `pr_oauthen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pr_order`
--
ALTER TABLE `pr_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pr_site_config`
--
ALTER TABLE `pr_site_config`
  ADD PRIMARY KEY (`config_name`),
  ADD UNIQUE KEY `config_name` (`config_name`);

--
-- Indexes for table `pr_status_data`
--
ALTER TABLE `pr_status_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pr_supplies`
--
ALTER TABLE `pr_supplies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pr_transaction`
--
ALTER TABLE `pr_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pr_type`
--
ALTER TABLE `pr_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pr_unit_data`
--
ALTER TABLE `pr_unit_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pr_userdata`
--
ALTER TABLE `pr_userdata`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `username` (`username`),
  ADD KEY `userdata_ibfk_1` (`dept_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pr_catagory`
--
ALTER TABLE `pr_catagory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pr_line`
--
ALTER TABLE `pr_line`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pr_oauthen`
--
ALTER TABLE `pr_oauthen`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pr_order`
--
ALTER TABLE `pr_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pr_status_data`
--
ALTER TABLE `pr_status_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pr_supplies`
--
ALTER TABLE `pr_supplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pr_transaction`
--
ALTER TABLE `pr_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pr_type`
--
ALTER TABLE `pr_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pr_unit_data`
--
ALTER TABLE `pr_unit_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสหน่วยนับ', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pr_userdata`
--
ALTER TABLE `pr_userdata`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
