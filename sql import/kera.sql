-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2024 at 06:05 PM
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
-- Database: `kera`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_password`) VALUES
(1, 'alwaleed', 'admin123'),
(2, 'abian', 'admin123'),
(3, 'marya', 'admin123'),
(4, 'admin', 'admin123\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `cart_id` int(20) NOT NULL,
  `event_code` int(20) NOT NULL,
  `quantity` double NOT NULL,
  `cust_id` int(20) NOT NULL,
  `cart_created` datetime NOT NULL,
  `cart_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `comp_id` int(20) NOT NULL,
  `comp_name` varchar(200) NOT NULL,
  `comp_cr` varchar(30) NOT NULL,
  `comp_email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`comp_id`, `comp_name`, `comp_cr`, `comp_email`, `password`) VALUES
(2, 'Omani Archive', '1111CR1111', 'omaniarchive@gmail.com', '$2y$10$iimTGqpsZ5mlGIhqSVmKV.T2JbjqWCU7Nz2j4g/MyZiAt0p3R127K'),
(3, 'Snow Oman', '1111CR1111', 'snowoman@gmail.com', '$2y$10$x/TrTSZahqujA3inHTWu6.IXTSN7OjdZqEDbe8tj3NKEC.56z0G1S'),
(5, 'Test', '1111CR1111', 'testing@kera.com', '$2y$10$DE/rI6cmYn3snJ9eVHA3KOaxKgIA6G.Ci52Z8DG2cbV5byN2NSgzW');

-- --------------------------------------------------------

--
-- Table structure for table `cust`
--

CREATE TABLE `cust` (
  `Cust_ID` int(30) NOT NULL,
  `Cust_Name` varchar(200) NOT NULL,
  `Cust_Email` varchar(122) NOT NULL,
  `Cust_CivID` int(15) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cust`
--

INSERT INTO `cust` (`Cust_ID`, `Cust_Name`, `Cust_Email`, `Cust_CivID`, `password`) VALUES
(1, 'AlWaleed Khalid', 'alwaleed@mec.com', 15670293, '$2y$10$zYd/PcN2WmbW57Z7El7cSubd3C/emCaBgV5VqWMc9IuGvRi065l4q'),
(3, 'lilibeth reales', 'lilibeth@mec.edu.om', 1234567, '$2y$10$W3YU54Otj38NaPqMIdu2n.KxAVF9ZLsQizC6ACWLKZUz2/QBTHcNe'),
(4, 'AlWaleed Khalid', 'testing@mec.com', 15670293, '$2y$10$ef9TMPdUR3dhr2UZu6Scv.8sOOzlkpKde20FdkWL1vn6wu8JHHwyS'),
(5, 'tester', 'tester@kera.com', 12345678, '$2y$10$ef9TMPdUR3dhr2UZu6Scv.8sOOzlkpKde20FdkWL1vn6wu8JHHwyS');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(20) NOT NULL,
  `event_name` varchar(30) NOT NULL,
  `event_desc` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `event_price` decimal(10,0) NOT NULL,
  `event_created` datetime NOT NULL,
  `event_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_desc`, `event_price`, `event_created`, `event_modified`) VALUES
(1, 'OA: Unplugged 2024', 'Omani Archive presents to you UNPLUGGED 2024, an event where the community comes together and share interest in music, arts and building connections.', 2, '2024-01-17 09:15:33', '2024-01-17 08:17:27'),
(2, 'Snow Oman | Ticket', 'Snow Oman One Day Ticket. This Ticket includes the full-day access only, does not include any events. Ticket will be available to be used all year.', 12, '2024-01-22 21:58:23', '2024-01-24 00:22:59');

-- --------------------------------------------------------

--
-- Table structure for table `event_approval`
--

CREATE TABLE `event_approval` (
  `app_id` int(20) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_price` double NOT NULL,
  `event_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_approval`
--

INSERT INTO `event_approval` (`app_id`, `event_name`, `event_price`, `event_desc`) VALUES
(1, 'Muscat Eats', 1, 'Muscat Eats is a multi-weekend event that will start on the beginning of February and end in the third weekend.'),
(5, 'Test Event Number 3', 15, 'Test Event Number 3 Description and Information');

-- --------------------------------------------------------

--
-- Table structure for table `event_images`
--

CREATE TABLE `event_images` (
  `img_id` int(20) NOT NULL,
  `event_id` int(20) NOT NULL,
  `img_name` varchar(512) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `img_created` datetime NOT NULL,
  `img_modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_images`
--

INSERT INTO `event_images` (`img_id`, `event_id`, `img_name`, `img_created`, `img_modified`) VALUES
(1, 1, 'v5.png', '2024-01-22 22:54:21', '2024-01-22 21:55:50'),
(2, 2, 'v3.png', '2024-01-22 23:11:52', '2024-01-22 22:12:56'),
(3, 3, 'v4.png', '2024-01-22 23:11:52', '2024-01-22 22:12:56');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(20) NOT NULL,
  `fb_name` varchar(120) NOT NULL,
  `fb_email` varchar(150) NOT NULL,
  `fb_subject` varchar(50) NOT NULL,
  `fb_message` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `fb_name`, `fb_email`, `fb_subject`, `fb_message`) VALUES
(1, 'Test', 'testing@mec.edu.om', 'Prices Test', 'TestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTest');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indexes for table `cust`
--
ALTER TABLE `cust`
  ADD PRIMARY KEY (`Cust_ID`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `event_approval`
--
ALTER TABLE `event_approval`
  ADD PRIMARY KEY (`app_id`);

--
-- Indexes for table `event_images`
--
ALTER TABLE `event_images`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `cart_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `comp_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cust`
--
ALTER TABLE `cust`
  MODIFY `Cust_ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `event_approval`
--
ALTER TABLE `event_approval`
  MODIFY `app_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `event_images`
--
ALTER TABLE `event_images`
  MODIFY `img_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
