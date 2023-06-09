-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2023 at 12:27 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `khizer`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `sno` int(11) NOT NULL,
  `user` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`sno`, `user`, `pass`) VALUES
(1, 'yahya', 'yahya');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `sno` int(11) NOT NULL,
  `class_name` varchar(40) NOT NULL,
  `div_name` varchar(40) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`sno`, `class_name`, `div_name`, `time`) VALUES
(25, 'Fybsc-IT', '', '2023-04-17 07:19:34'),
(26, 'Fybsc-cs', 'a', '2023-04-17 07:20:08'),
(30, 'TYIT', '', '2023-04-19 21:33:54'),
(31, 'SYIT', '', '2023-04-19 21:59:27');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `sno` int(11) NOT NULL,
  `heading` varchar(40) NOT NULL,
  `describtion` varchar(40) NOT NULL,
  `date` date NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`sno`, `heading`, `describtion`, `date`, `time`) VALUES
(19, 'Eid Festival', 'there is Eid on sataurday ', '2023-04-22', '2023-04-19 17:04:32');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `sno` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `message` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`sno`, `name`, `email`, `message`, `time`) VALUES
(22, 'Khizer', 'khizer.naik@gmail.com', 'this is a college website ', '2023-04-19 22:04:03'),
(23, 'khizer', 'khizer.naik@gmail.com', 'this is a college website ', '2023-04-19 22:04:13'),
(24, 'khizer', 'khizer.naik@gmail.com', 'this message is dummy message \r\n', '2023-04-19 22:04:52');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `sno` int(11) NOT NULL,
  `heading` varchar(40) NOT NULL,
  `description` varchar(40) NOT NULL,
  `date` date NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`sno`, `heading`, `description`, `date`, `time`) VALUES
(12, 'eid ul fitr', 'there will be eid on 22nd april 2023', '2023-04-20', '2023-04-19 22:06:22'),
(13, 'second notice ', 'this is dummy notice that do notice this', '2023-04-20', '2023-04-19 22:07:06');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `sno` int(11) NOT NULL,
  `classno` int(11) NOT NULL,
  `termname` varchar(100) NOT NULL,
  `termno` int(11) NOT NULL,
  `studentuser` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `marks` varchar(100) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`sno`, `classno`, `termname`, `termno`, `studentuser`, `subject`, `marks`, `time`) VALUES
(1, 25, ' term-1', 33, ' yahya', 'ppc', '53/100', '2023-04-18 21:30:01'),
(2, 25, ' term-1', 33, ' yahya', 'c++', '50/100', '2023-04-18 21:21:48'),
(3, 25, ' term-1', 33, ' yahya', 'clds', '50/100', '2023-04-18 21:21:48'),
(4, 25, ' term-1', 33, ' yahya', 'tcs', '50/100', '2023-04-18 21:21:48'),
(5, 25, ' term-1', 33, ' yahya', 'fdms', '50/100', '2023-04-18 21:21:48'),
(6, 1, ' a', 1, 'a', 'a', 'a', '2023-04-18 21:24:04'),
(7, 1, ' a', 1, 'a', 'a', 'a', '2023-04-18 21:27:22'),
(8, 1, ' a', 1, 'a', 'a', 'a', '2023-04-18 21:27:22'),
(9, 1, ' a', 1, 'a', 'a', 'a', '2023-04-18 21:27:22'),
(10, 1, ' a', 1, 'a', 'a', 'a', '2023-04-18 21:27:22'),
(11, 1, ' a', 1, 'a', 'a', 'a', '2023-04-18 21:27:22'),
(12, 25, ' term-1', 33, ' yahya', 'ppc', '50/100', '2023-04-18 21:27:49'),
(13, 25, ' term-1', 33, ' yahya', 'c++', '50/100', '2023-04-18 21:27:49'),
(14, 25, ' term-1', 33, ' yahya', 'clds', '50/100', '2023-04-18 21:27:49'),
(15, 25, ' term-1', 33, ' yahya', 'tcs', '50/100', '2023-04-18 21:27:50'),
(16, 25, ' term-1', 33, ' yahya', 'fdms', '50/100', '2023-04-18 21:27:50'),
(17, 25, ' term-1', 33, ' yahya', 'ppc', '50/100', '2023-04-18 21:27:53'),
(18, 25, ' term-1', 33, ' yahya', 'c++', '50/100', '2023-04-18 21:27:53'),
(19, 25, ' term-1', 33, ' yahya', 'clds', '50/100', '2023-04-18 21:27:53'),
(20, 25, ' term-1', 33, ' yahya', 'tcs', '50/100', '2023-04-18 21:27:53'),
(21, 25, ' term-1', 33, ' yahya', 'fdms', '50/100', '2023-04-18 21:27:53'),
(22, 25, ' term-1', 33, 'yahya', 'ppc', '100', '2023-04-19 08:12:30'),
(23, 25, ' term-1', 33, 'yahya', 'c++', '50/100', '2023-04-19 08:12:30'),
(24, 25, ' term-1', 33, 'yahya', 'clds', '50/100', '2023-04-19 08:12:30'),
(25, 25, ' term-1', 33, 'yahya', 'tcs', '50/100', '2023-04-19 08:12:30'),
(26, 25, ' term-1', 33, 'yahya', 'fdms', '50/100', '2023-04-19 08:12:30'),
(27, 25, ' term-1', 33, 'WZ9591', 'ppc', '78/100', '2023-04-19 21:58:13'),
(28, 25, ' term-1', 33, 'WZ9591', 'c++', '78/100', '2023-04-19 21:58:13'),
(29, 25, ' term-1', 33, 'WZ9591', 'clds', '78/100', '2023-04-19 21:58:13'),
(30, 25, ' term-1', 33, 'WZ9591', 'tcs', '78/100', '2023-04-19 21:58:13'),
(31, 25, ' term-1', 33, 'WZ9591', 'fdms', '78/100', '2023-04-19 21:58:13'),
(32, 25, ' term-2', 34, 'WZ9591', 'wad', '78/100', '2023-04-19 21:58:28'),
(33, 25, ' term-2', 34, 'WZ9591', 'c++', '78/100', '2023-04-19 21:58:13'),
(34, 25, ' term-2', 34, 'WZ9591', 'green-it', '78/100', '2023-04-19 21:58:28'),
(35, 25, ' term-2', 34, 'WZ9591', 'nm', '78/100', '2023-04-19 21:58:28'),
(36, 25, ' term-2', 34, 'WZ9591', 'fmm', '78/100', '2023-04-19 21:58:28'),
(37, 25, ' term-1', 33, 'FL3772', 'ppc', '78/100', '2023-04-19 21:58:44'),
(38, 25, ' term-1', 33, 'FL3772', 'c++', '78/100', '2023-04-19 21:58:44'),
(39, 25, ' term-1', 33, 'FL3772', 'clds', '78/100', '2023-04-19 21:58:44'),
(40, 25, ' term-1', 33, 'FL3772', 'tcs', '78/100', '2023-04-19 21:58:44'),
(41, 25, ' term-1', 33, 'FL3772', 'fdms', '78/100', '2023-04-19 21:58:44'),
(42, 30, ' term-1', 40, 'JX7197', 'Python', '73 /100', '2023-04-19 21:57:12'),
(43, 30, ' term-1', 40, 'JX7197', 'Java', '87/100', '2023-04-19 21:57:12'),
(44, 30, ' term-1', 40, 'JX7197', 'C#', '97 /100', '2023-04-19 21:57:12'),
(45, 30, ' term-1', 40, 'JX7197', 'PHP', '76 /100', '2023-04-19 21:57:12'),
(46, 25, ' term-2', 34, 'FL3772', 'wad', '78/100', '2023-04-19 21:58:57'),
(47, 25, ' term-2', 34, 'FL3772', 'c++', '78/100', '2023-04-19 21:58:57'),
(48, 25, ' term-2', 34, 'FL3772', 'green-it', '78/100', '2023-04-19 21:58:57'),
(49, 25, ' term-2', 34, 'FL3772', 'nm', '78/100', '2023-04-19 21:58:57'),
(50, 25, ' term-2', 34, 'FL3772', 'fmm', '78/100', '2023-04-19 21:58:57'),
(51, 31, ' term-1', 41, 'CZ9153', 'python', '87 /100', '2023-04-19 22:01:22'),
(52, 31, ' term-1', 41, 'CZ9153', 'html', '98/100', '2023-04-19 22:01:49'),
(53, 31, ' term-1', 41, 'CZ9153', 'javascript', '99/100', '2023-04-19 22:01:49'),
(54, 31, ' term-1', 41, 'CZ9153', 'php', '95/100', '2023-04-19 22:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `sno` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `classname` varchar(40) NOT NULL,
  `classno` int(11) NOT NULL,
  `img` varchar(100) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`sno`, `name`, `username`, `password`, `classname`, `classno`, `img`, `time`) VALUES
(18, 'yahya', 'WZ9591', '1339', 'Fybsc-IT', 25, 'logo1.png', '2023-04-17 07:30:13'),
(19, 'zaid', 'FL3772', '1325', 'Fybsc-IT', 25, 'logo1.png', '2023-04-17 07:31:17'),
(24, 'Khizer', 'JX7197', '4618', 'TYIT', 30, 'userimg.webp', '2023-04-19 21:50:20'),
(25, 'yahya shaikh', 'CZ9153', '1151', 'SYIT', 31, 'code.jpg', '2023-04-19 22:00:48');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sno` int(11) NOT NULL,
  `classno` int(11) NOT NULL,
  `termname` varchar(40) NOT NULL,
  `subject` varchar(40) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sno`, `classno`, `termname`, `subject`, `time`) VALUES
(64, 25, 'term-1', 'ppc', '2023-04-17 07:21:23'),
(65, 25, 'term-1', 'c++', '2023-04-17 07:21:23'),
(66, 25, 'term-1', 'clds', '2023-04-17 07:21:23'),
(67, 25, 'term-1', 'tcs', '2023-04-17 07:21:23'),
(68, 25, 'term-1', 'fdms', '2023-04-17 07:21:23'),
(69, 25, 'term-2', 'wad', '2023-04-17 07:23:41'),
(70, 25, 'term-2', 'c++', '2023-04-17 07:23:41'),
(71, 25, 'term-2', 'green-it', '2023-04-17 07:23:41'),
(72, 25, 'term-2', 'nm', '2023-04-17 07:23:41'),
(73, 25, 'term-2', 'fmm', '2023-04-17 07:23:41'),
(82, 30, 'term-1', 'Python', '2023-04-19 21:35:00'),
(83, 30, 'term-1', 'Java', '2023-04-19 21:35:00'),
(84, 30, 'term-1', 'C#', '2023-04-19 21:35:00'),
(85, 30, 'term-1', 'PHP', '2023-04-19 21:35:00'),
(86, 31, 'term-1', 'python', '2023-04-19 22:00:18'),
(87, 31, 'term-1', 'html', '2023-04-19 22:00:18'),
(88, 31, 'term-1', 'javascript', '2023-04-19 22:00:18'),
(89, 31, 'term-1', 'php', '2023-04-19 22:00:18');

-- --------------------------------------------------------

--
-- Table structure for table `term`
--

CREATE TABLE `term` (
  `sno` int(11) NOT NULL,
  `term` varchar(40) NOT NULL,
  `classno` varchar(40) NOT NULL,
  `classname` varchar(40) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `term`
--

INSERT INTO `term` (`sno`, `term`, `classno`, `classname`, `time`) VALUES
(33, 'term-1', '25', 'Fybsc-IT - ', '2023-04-17 07:21:23'),
(34, 'term-2', '25', 'Fybsc-IT - ', '2023-04-17 07:23:41'),
(40, 'term-1', '30', 'TYIT - ', '2023-04-19 21:35:00'),
(41, 'term-1', '31', 'SYIT - ', '2023-04-19 22:00:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`sno`),
  ADD UNIQUE KEY `user` (`user`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `term`
--
ALTER TABLE `term`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `term`
--
ALTER TABLE `term`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
