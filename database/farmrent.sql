-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2024 at 05:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farmrent`
--

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` varchar(36) NOT NULL,
  `rating_date` date NOT NULL,
  `eq_id` varchar(150) NOT NULL,
  `rating` int(1) NOT NULL,
  `review` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `rating_date`, `eq_id`, `rating`, `review`, `user_id`) VALUES
('65eca5dc623bc', '2024-03-09', '26', 5, 'good', 6),
('65eca60fd1bdf', '2024-03-09', '22', 4, 'best', 7),
('65eca6538dc69', '2024-03-09', '23', 3, 'good', 7),
('65eca7609a4dd', '2024-03-09', '32', 4, 'good', 7),
('65f660f8079e8', '2024-03-17', '31', 4, 'good.', 6),
('65f6662e03cd5', '2024-03-17', '25', 4, 'good.', 6),
('65fadcad66e4f', '2024-03-20', '22', 5, 'good', 6);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(20) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `CreationDate`, `UpdationDate`) VALUES
(10, 'Tractor', '2024-01-10 02:12:28', '2024-01-12 05:01:53'),
(11, 'Harvester', '2024-01-10 02:12:39', '2024-01-12 05:02:07'),
(12, 'Plough', '2024-01-10 02:12:45', '2024-01-12 05:02:56'),
(13, 'Rotavator', '2024-01-10 02:12:55', '2024-01-12 05:03:08'),
(14, 'Disc Plough', '2024-01-10 02:13:01', '2024-01-12 05:03:40'),
(15, 'Seeder', '2024-01-12 05:03:53', '2024-04-17 15:06:25'),
(16, 'Cultivator', '2024-01-12 05:04:15', '2024-04-17 15:06:36');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactusinfo`
--

CREATE TABLE `tblcontactusinfo` (
  `id` int(11) NOT NULL,
  `Address` tinytext DEFAULT NULL,
  `EmailId` varchar(255) DEFAULT NULL,
  `ContactNo` char(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcontactusinfo`
--

INSERT INTO `tblcontactusinfo` (`id`, `Address`, `EmailId`, `ContactNo`) VALUES
(1, 'SSVPS, Dhule', 'farmequipment@gmail.com', '1234567890');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactusquery`
--

CREATE TABLE `tblcontactusquery` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `ContactNumber` char(11) DEFAULT NULL,
  `Message` longtext DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcontactusquery`
--

INSERT INTO `tblcontactusquery` (`id`, `name`, `EmailId`, `ContactNumber`, `Message`, `PostingDate`, `status`) VALUES
(5, 'Yash Patil', '', '8605787655', 'is there any  Discount on Equipment', '2024-01-23 18:35:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblequipment`
--

CREATE TABLE `tblequipment` (
  `id` int(11) NOT NULL,
  `EqipmentTitle` varchar(50) DEFAULT NULL,
  `EquipmentCategory` int(11) DEFAULT NULL,
  `OwnerDetails` longtext DEFAULT NULL,
  `PricePerDay` int(11) DEFAULT NULL,
  `EquipLocation` varchar(10) DEFAULT NULL,
  `ModelYear` int(6) DEFAULT NULL,
  `Vimage1` varchar(120) DEFAULT NULL,
  `Vimage2` varchar(120) DEFAULT NULL,
  `Vimage3` varchar(120) DEFAULT NULL,
  `Vimage4` varchar(120) DEFAULT NULL,
  `Vimage5` varchar(120) DEFAULT NULL,
  `HorsePower` varchar(10) DEFAULT NULL,
  `CCCapcity` varchar(10) DEFAULT NULL,
  `LifttingCapacity` varchar(10) DEFAULT NULL,
  `CropType` varchar(10) DEFAULT NULL,
  `PowerRequired` varchar(10) DEFAULT NULL,
  `WorkingCondition` varchar(10) DEFAULT NULL,
  `CurrentStatus` varchar(50) DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `ownerid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblequipment`
--

INSERT INTO `tblequipment` (`id`, `EqipmentTitle`, `EquipmentCategory`, `OwnerDetails`, `PricePerDay`, `EquipLocation`, `ModelYear`, `Vimage1`, `Vimage2`, `Vimage3`, `Vimage4`, `Vimage5`, `HorsePower`, `CCCapcity`, `LifttingCapacity`, `CropType`, `PowerRequired`, `WorkingCondition`, `CurrentStatus`, `RegDate`, `UpdationDate`, `ownerid`) VALUES
(22, 'Mahindra Yuvraj 215 NXT Tractor', 10, '', 600, 'Chimthana', 2021, 'tractor2.jpg', 'tra1.jpg', 'tra3.jpg', NULL, NULL, '15 HP', '863.5 CC', '778 ', '780 ', '_', 'Moderate', 'Available', '2024-01-31 20:34:44', '2024-03-17 12:22:58', 4),
(23, 'Shaktiman Paddy Master 3736 Harvester', 11, '', 800, 'Chimthana', 2022, 'ao.png', 'hr5.jpg', 'hr2.jpg', NULL, NULL, '76 HP', '_', '_', '4700 kg', '_', 'Good', 'Available', '2024-02-01 01:27:39', '2024-03-14 16:59:21', 4),
(24, 'Jhon Deere Tractor Chisel Plough', 12, 'Owner Name: Tejas Patil\r\nContact No: 9251236723\r\nAddress: 156, Shirud , tal.Dhule, dist.Dhule', 500, 'Shirud', 2021, 'pol.jpg', 'plo.jpg', 'pl6.jpg', NULL, NULL, '_', '_', '_', '290 kg', '35-50 HP', ' Good', 'Not Available', '2024-02-01 02:59:54', '2024-02-07 03:05:49', 5),
(25, 'Swaraj 724 FE 4WD Tractor', 10, 'Owner Name: Tejas Patil\r\nContact No: 9251236723\r\nAddress: 156, Shirud, tal.Dhule, dist.Dhule', 700, 'Shirud', 2023, 'z6.jpg', 'z5.jpg', 'z2.jpg', NULL, NULL, '25 HP', '1823 CC', '750 kg', '1495 kg', '_', ' Good', 'Available', '2024-02-01 03:13:45', '2024-03-14 05:33:20', 5),
(26, 'Sonalika Super Seeders', 15, 'Owner Name: Himanshu Pawar\r\nContact No: 9421568934\r\nAddress: 34,Vishnu Nagar, Nizampur,tal.Sakri', 700, 'Nizampur', 2021, 'seed1.jpg', 'seed2.jpg', 'seed4.jpg', NULL, NULL, '_', '_', '_', '880 kg', '50 HP', NULL, 'Available', '2024-02-01 05:40:44', '2024-02-03 17:21:43', 6),
(27, 'Jhon Deere Tractor Disc Plough', 14, 'Owner Name: Himanshu Pawar\r\nContact No: 9421568934\r\nAddress: 34,Vishnu Nagar, Nizampur,tal.Sakri', 500, 'Nizampur', 2022, 'disc1.jpg', 'disc3.jpg', 'disc4.jpg', NULL, NULL, '_', '_', '_', '335 kg', '50 HP', NULL, 'Not Available', '2024-02-01 06:07:42', '2024-02-03 18:17:51', 6),
(29, 'Shaktiman Champion Rotavator', 13, 'Name: Yash Patil\r\nContact No: 9405374962\r\nAddress: 151, Shiv Colony, Nardana,Tal.Shindkheda', 800, 'Nardana', 2023, 'rt3.jpg', 'rt4.jpg', 'rt1.jpg', NULL, NULL, '_', '_', '_', '567 kg', '60-70 HP', NULL, 'Available', '2024-02-04 14:53:55', '2024-02-04 15:33:20', 7),
(31, 'Mahindra Arjun 605 Harvester', 11, 'Name: Yash Patil\r\nContact No: 9405374962\r\nAddress: 151, Shiv Colony, Nardana,Tal.Shindkheda', 800, 'Nardana', 2022, 'abc.jpg', 'abc5.jpg', 'abc3.jpg', NULL, NULL, '57 HP', '3531 CC', '_', '1400 kg', '_', NULL, 'Available', '2024-02-04 15:31:42', '2024-02-06 04:59:40', 7),
(32, 'Sonalika Tiger DI 75 ', 10, NULL, 800, 'Chimthana', 2023, 'tr12.jpg', 'tr31.jpg', 'tr22.jpg', NULL, NULL, '40', '2200', '345', '2770', '_', 'Good', 'Available', '2024-02-29 18:27:18', '2024-04-04 08:33:10', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tblowner`
--

CREATE TABLE `tblowner` (
  `Id` int(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `mob` char(11) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblowner`
--

INSERT INTO `tblowner` (`Id`, `Name`, `mob`, `email`, `address`, `pass`) VALUES
(4, 'Vaibhav Patil', '9499275612', 'vaibhavp56@gmail.com', '67,near to primary health center, Chimthana, Dhule', '9f61408e3afb633e50cdf1b20de6f466'),
(5, 'Tejas Patil', '9251236723', 'tejas55@gmail.com', '151,Shirud, tal.Dhule, dist.Dhule', 'b53b3a3d6ab90ce0268229151c9bde11'),
(6, 'Himanshu Pawar', '9421568934', 'himanshu60@gmail.com', '34, Vishnu nagar, Nizampur, tal.Sakri', '072b030ba126b2f4b2374f342be9ed44'),
(7, 'Yash Patil', '9405374962', 'yashpatil03@gmail.com', '151,Oswal Nagar, Deopur, Dhule', '66f041e16a60928b05a7e228a89c3799'),
(9, 'Dhiraj Patil', '7798812664', 'dhiraj123@gmail.com', 'Amanler', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `tblpages`
--

CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL,
  `PageName` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT '',
  `detail` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpages`
--

INSERT INTO `tblpages` (`id`, `PageName`, `type`, `detail`) VALUES
(1, 'Terms and Conditions', 'terms', '																														<p style=\"margin-bottom: 20px; color: rgb(102, 102, 102); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px;\">Welcome to Farm Equipment Hire and Rental Hub!</p><p style=\"margin-bottom: 20px; color: rgb(102, 102, 102); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px;\">These terms and conditions outline the rules and regulations for the use of Farm Equipment Hire and Rental Hub\'s Website.</p><p style=\"margin-bottom: 20px; color: rgb(102, 102, 102); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px;\">By accessing this website we assume you accept these terms and conditions. Do not continue to use Farm Equipment Hire and Rental Hub if you do not agree to take all of the terms and conditions stated on this page.</p><p style=\"margin-bottom: 20px; color: rgb(102, 102, 102); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px;\">The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and all Agreements: \"Client\", \"You\" and \"Your\" refers to you, the person log on this website and compliant to the Company\'s terms and conditions. \"The Company\", \"Ourselves\", \"We\", \"Our\" and \"Us\", refers to our Company. \"Party\", \"Parties\", or \"Us\", refers to both the Client and ourselves. All terms refer to the offer, acceptance and consideration of payment necessary to undertake the process of our assistance to the Client in the most appropriate manner for the express purpose of meeting the Client\'s needs in respect of provision of the Company\'s stated services, in accordance with and subject to, prevailing law of in. Any use of the above terminology or other words in the singular, plural, capitalization and/or he/she or they, are taken as interchangeable and therefore as referring to same</p>\r\n										\r\n										\r\n										'),
(2, 'Privacy Policy', 'privacy', '<span style=\"color: rgb(51, 51, 51); font-family: georama, sans-serif; font-size: 14.4px;\">Your privacy is important to us, and this Policy will explain how we collect and use information that personally identifies you (\"personal information\") as well as non-personal information about your interaction with the M&amp;M Website. Protecting your privacy and ensuring that your personal information is held securely is very important to M&amp;M. We want you to be confident that we are looking after your interests and that is why we have set out our information practices in this Privacy Policy.</span><br>'),
(3, 'About Us ', 'aboutus', '										The main purpose of our system is to provide hire and rental services to the farmer and equipment owner. in which farmer can find the equipments for the farming and also contact with equipment owner for to finalize the deal.');

-- --------------------------------------------------------

--
-- Table structure for table `tblrent`
--

CREATE TABLE `tblrent` (
  `id` int(11) NOT NULL,
  `BookingNumber` bigint(12) DEFAULT NULL,
  `userEmail` varchar(100) DEFAULT NULL,
  `equipmentId` int(11) DEFAULT NULL,
  `FromDate` varchar(20) DEFAULT NULL,
  `ToDate` varchar(20) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `LastUpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblrent`
--

INSERT INTO `tblrent` (`id`, `BookingNumber`, `userEmail`, `equipmentId`, `FromDate`, `ToDate`, `message`, `Status`, `PostingDate`, `LastUpdationDate`) VALUES
(15, 740, 'vaibhav56@gmail.com', 22, '2024-02-06', '2024-02-08', '3 day', 1, '2024-02-03 21:55:49', '2024-03-16 06:37:16'),
(21, 955, 'vaibhav56@gmail.com', 23, '2024-03-21', '2024-03-23', 'for 2 days', 1, '2024-03-09 18:11:13', '2024-03-16 06:36:53'),
(22, 648, 'vaibhav56@gmail.com', 32, '2024-03-09', '2024-03-13', 'for 3 days', 1, '2024-03-09 18:15:48', '2024-03-16 00:28:34'),
(25, 893, 'pranav69@gmail.com', 22, '2024-03-21', '2024-03-22', 'for 1 day', 2, '2024-03-14 06:01:48', '2024-03-27 15:30:50'),
(28, 214, 'vaibhav56@gmail.com', 25, '2024-03-17', '2024-03-18', 'for 1 day', 1, '2024-03-16 06:45:54', '2024-03-16 06:46:23'),
(40, 750, 'yashr58@gmail.com', 22, '2024-04-01', '2024-04-02', '', 1, '2024-03-21 06:37:52', '2024-03-22 05:48:43'),
(41, 169, 'YASHR58@GMAIL.COM', 23, '2024-04-05', '2024-04-06', 'hello', 1, '2024-04-04 08:25:45', '2024-04-04 08:28:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbltestimonial`
--

CREATE TABLE `tbltestimonial` (
  `id` int(11) NOT NULL,
  `UserEmail` varchar(100) NOT NULL,
  `Testimonial` mediumtext NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbltestimonial`
--

INSERT INTO `tbltestimonial` (`id`, `UserEmail`, `Testimonial`, `PostingDate`, `status`) VALUES
(2, 'vaibhav@gmail.com', 'nice job', '2024-01-06 05:14:42', 1),
(3, 'pranav69@gmail.com', 'Best Service Provided.', '2024-02-05 14:38:16', 1),
(4, 'yashr58@gmail.com', 'Time saving and Effortless .', '2024-02-08 04:05:45', 1),
(5, 'vaibhav56@gmail.com', 'Good service, very helpful.', '2024-02-08 04:08:07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `FullName` varchar(120) DEFAULT NULL,
  `EmailId` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `ContactNo` char(11) DEFAULT NULL,
  `dob` varchar(100) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `Country` varchar(100) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `FullName`, `EmailId`, `Password`, `ContactNo`, `dob`, `Address`, `City`, `Country`, `RegDate`, `UpdationDate`) VALUES
(6, 'YASH PATIL', 'YASHR58@GMAIL.COM', '66f041e16a60928b05a7e228a89c3799', '9871234723', '', '', 'Songir', 'Dhule', '2024-01-25 21:49:05', '2024-04-04 14:47:37'),
(7, 'VAIBHAV PATIL', 'VAIBHAV56@GMAIL.COM', '9f61408e3afb633e50cdf1b20de6f466', '9121217536', NULL, NULL, 'Songir', 'Dhule', '2024-01-29 14:38:20', NULL),
(8, 'PRANAV SHINDE', 'PRANAV69@GMAIL.COM', '14bfa6bb14875e45bba028a21ed38046', '9871234512', NULL, NULL, 'Nardana', 'Shindkheda', '2024-02-05 14:37:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tlbadmin`
--

CREATE TABLE `tlbadmin` (
  `Id` int(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `mob` char(11) DEFAULT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tlbadmin`
--

INSERT INTO `tlbadmin` (`Id`, `Name`, `Email`, `mob`, `Password`) VALUES
(1, 'Yash', 'yash78@gmail.com', '2147483647', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'Vaibhav', 'vaibhav@gmail.com', '2147483647', 'c81e728d9d4c2f636f067f89cc14862c');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcontactusinfo`
--
ALTER TABLE `tblcontactusinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcontactusquery`
--
ALTER TABLE `tblcontactusquery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblequipment`
--
ALTER TABLE `tblequipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblowner`
--
ALTER TABLE `tblowner`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblrent`
--
ALTER TABLE `tblrent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltestimonial`
--
ALTER TABLE `tbltestimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `EmailId` (`EmailId`);

--
-- Indexes for table `tlbadmin`
--
ALTER TABLE `tlbadmin`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tblcontactusinfo`
--
ALTER TABLE `tblcontactusinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblcontactusquery`
--
ALTER TABLE `tblcontactusquery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblequipment`
--
ALTER TABLE `tblequipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tblowner`
--
ALTER TABLE `tblowner`
  MODIFY `Id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tblrent`
--
ALTER TABLE `tblrent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbltestimonial`
--
ALTER TABLE `tbltestimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tlbadmin`
--
ALTER TABLE `tlbadmin`
  MODIFY `Id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
