-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2024 at 12:24 AM
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
-- Database: `cargo-booking-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `contact` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `re-password` varchar(100) NOT NULL,
  `datatime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fullname`, `contact`, `city`, `email`, `password`, `re-password`, `datatime`) VALUES
(1, 'Tishy Coder', 1752276521, 'Thika', 'tishy3@g.m', '123457', '123457', '2022-04-09 07:45:49'),
(2, 'Gume Mbt3', 1346583921, 'Nairobi', 'tish@gt.lp', '123456', '123456', '2022-04-09 11:40:24');

-- --------------------------------------------------------

--
-- Table structure for table `cargo`
--

CREATE TABLE `cargo` (
  `id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `driver_id` int(50) NOT NULL,
  `weight` varchar(20) NOT NULL,
  `volume` varchar(20) NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `date` varchar(50) NOT NULL,
  `sender_name` varchar(50) NOT NULL,
  `sender_email` varchar(50) NOT NULL,
  `sender_contact` varchar(50) NOT NULL,
  `sender_address` varchar(50) NOT NULL,
  `sender_city` varchar(50) NOT NULL,
  `receiver_name` varchar(50) NOT NULL,
  `receiver_email` varchar(50) NOT NULL,
  `receiver_contact` varchar(50) NOT NULL,
  `receiver_address` varchar(50) NOT NULL,
  `receiver_city` varchar(50) NOT NULL,
  `tracking_id` varchar(50) NOT NULL,
  `status` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cargo`
--

INSERT INTO `cargo` (`id`, `user_id`, `driver_id`, `weight`, `volume`, `quantity`, `date`, `sender_name`, `sender_email`, `sender_contact`, `sender_address`, `sender_city`, `receiver_name`, `receiver_email`, `receiver_contact`, `receiver_address`, `receiver_city`, `tracking_id`, `status`) VALUES
(8, 4, 0, '23', '24', '1', '2024-07-20', 'Hassan Ali', 'haste@h.g', '0712345678', 'Qasia', 'Qasia', 'Abdirahim Abdi', 'abdir@r.r', '0712345698', 'asdr@df.fd', 'Moyaleso', '53fafe70b0b54222bb22ab322e574ba3', 0),
(9, 4, 0, '2', '128', '2', '2024-07-23', 'Hassan Ali', 'haste4@h.g2', '0712345678', 'Qasia', 'Qasia', 'Abdirahim Abdi', 'abdir@r.r2', '0712345698', 'asdr@df.fd2', 'Karare', '6884eac816f45edea0b309971e6c70ec', 1);

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id` int(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `contact` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `re-password` varchar(100) NOT NULL,
  `status` int(50) NOT NULL,
  `amount` int(100) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id`, `fullname`, `contact`, `email`, `password`, `re-password`, `status`, `amount`, `datetime`) VALUES
(1, 'Kuddus Mia', 1238492101, 'kuddus@gmail.com', '123456', '123456', 0, 5000, '2022-04-10 09:39:05'),
(2, 'Rajib Ali', 1556839213, 'rajib@gmail.com', '123456', '123456', 0, 0, '2022-04-10 09:41:43'),
(3, 'Sarder Ali', 1927267431, 'sarder@gmail.com', '123456', '123456', 0, 0, '2022-04-10 09:42:54'),
(4, 'Manik Dey', 1927328134, 'manik@gmail.com', '123456', '123456', 0, 0, '2022-04-10 09:44:12'),
(5, 'Mahmud Ali', 1678210391, 'mahmud@gmail.com', '123456', '123456', 0, 0, '2022-04-10 09:46:28');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `message`) VALUES
(1, 'Maruf Hasnat', 'maruf@gmail.com', 'Service is very good :)'),
(3, 'Shakil Ahmed', 'shakil@gmail.com', 'The service is satisfying :)'),
(4, 'MD. NAYEEM MIAH', 'nayeem@gmail.com', 'The service is awesome :)'),
(6, 'Nayeem Hyder', 'nayeem@gmail.com', 'The service is very good :)');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `post_code` smallint(4) NOT NULL,
  `city` varchar(50) NOT NULL,
  `division` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `post_code`, `city`, `division`) VALUES
(1, 1230, 'Dakabaricha', 'Qasia'),
(2, 6000, 'Nanyuki', 'Kwetu'),
(3, 9000, 'Mombassa', 'Marsab'),
(4, 8200, 'Kisumu', 'Hillaut'),
(5, 3100, 'Eldoret', 'Fistus'),
(6, 4000, 'Laisamis', 'Koror'),
(7, 5402, 'Maikona', 'Sagante'),
(8, 2200, 'Turbi', 'Saku');

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `cargo_id` int(50) NOT NULL,
  `basic_price` varchar(20) NOT NULL,
  `weight_price` varchar(20) NOT NULL,
  `volume_price` varchar(20) NOT NULL,
  `total_price` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`id`, `user_id`, `cargo_id`, `basic_price`, `weight_price`, `volume_price`, `total_price`) VALUES
(1, 4, 8, '700', '931', '854', '2485'),
(3, 3, 9, '1500', '1995', '1995', '5490');

-- --------------------------------------------------------

--
-- Table structure for table `tracking`
--

CREATE TABLE `tracking` (
  `id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `tracking_id` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `contact` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `re-password` varchar(100) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `contact`, `city`, `email`, `password`, `re-password`, `datetime`) VALUES
(3, 'Hassan Ali', 712345678, 'Marsabit', 'hastee@m.m', '123457', '123457', '2022-04-08 17:58:33'),
(4, 'Tume Galgallo', 725684759, 'Isiolo', 'tumeg@g.m', '123456', '123456', '2022-04-08 18:31:38'),
(7, 'Abdi Kasia', 745638741, 'Moyale', 'abdi@qasia.mail', '123456', '123456', '2022-04-11 14:25:37'),
(8, 'Mohammed Drc', 758694358, 'Kargi', 'mhd@dre.ce', '123456', '123456', '2022-04-12 16:19:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tracking`
--
ALTER TABLE `tracking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tracking`
--
ALTER TABLE `tracking`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
