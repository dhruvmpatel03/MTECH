-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2024 at 09:40 PM
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
-- Database: `travel`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `location` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `guests` int(11) NOT NULL,
  `arrivals` date NOT NULL,
  `leaving` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Approved','Cancelled') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `name`, `email`, `phone`, `address`, `location`, `userid`, `guests`, `arrivals`, `leaving`, `created_at`, `status`) VALUES
(6, 'keni', 'keni@gmail.com', '06356119899', 'VADODARA', 2, 5, 2, '2024-09-10', '2024-09-21', '2024-09-12 18:45:36', 'Approved'),
(7, 'keni', 'keni@gmail.com', '06356119899', 'VADODARA', 3, 5, 3, '2024-09-14', '2024-09-16', '2024-09-12 18:46:47', 'Cancelled'),
(8, 'parth', 'parth@gmail.com', '3344552267', 'Kosad', 7, 6, 4, '2024-09-26', '2024-09-28', '2024-09-12 19:33:17', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `pack_id` int(11) NOT NULL,
  `pack_name` varchar(80) NOT NULL,
  `pack_desc` varchar(200) NOT NULL,
  `pack_img` varchar(200) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`pack_id`, `pack_name`, `pack_desc`, `pack_img`, `created_date`) VALUES
(2, 'Wildlife Safariiii', 'Experience nature like never before. Embark on guided safaris to witness exotic animals in their natural habitat.', 'safari.jpg', '2024-09-09 18:12:50'),
(3, 'Paris', 'Experience the magic of Paris with our exclusive package. Explore iconic landmarks like the Eiffel Tower and Louvre, enjoy a Seine River cruise, and savor gourmet dining. Includes guided tours, comfor', 'paris.jpg', '2024-09-10 11:13:04'),
(4, 'New York', 'Experience the excitement of New York City with our exclusive package. Explore iconic sites like Times Square, Central Park, and the Statue of Liberty. Enjoy Broadway shows, world-class museums, and d', 'nyc.jpg', '2024-09-10 11:18:58'),
(5, ' Los Angeles ', 'Discover the vibrant energy of Los Angeles with our comprehensive package. Visit Hollywood, relax on beautiful beaches, and explore renowned attractions like the Getty Center and Santa Monica Pier. En', 'la.jpg', '2024-09-10 11:19:23'),
(6, 'Greece ', 'Explore Greece with our package: visit Athens’ ancient sites, relax on Santorini’s beaches, and enjoy Mykonos’ charm. Includes guided tours, comfortable stays, and Greek cuisine.', 'Greece.jpg', '2024-09-10 11:27:33'),
(7, ' Maldives', 'Escape to the Maldives: unwind on white-sand beaches, stay in luxurious overwater bungalows, and enjoy crystal-clear waters. Includes accommodations, transfers, and island experiences.', 'maldives.jpg', '2024-09-10 11:29:01');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `username` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(100) NOT NULL,
  `usertype` varchar(20) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `email`, `password`, `usertype`, `created_date`) VALUES
(1, 'dhruv', 'dhruv@gmail.com', '1eba9614763773df08dd49049663c3e3', 'admin', '2024-08-26 08:25:53'),
(2, 'anvi', 'anvi@gmail.com', '74b67b79010657454f0f0146dd326269', 'admin', '2024-08-26 08:26:56'),
(5, 'keni', 'keni@gmail.com', '41e0d392508a52ff915af3ed6fba232b', 'customer', '2024-08-26 13:54:39'),
(6, 'parth', 'parth@gmail.com', '04788c4f5295bc48719eb9d8d3dec40d', 'customer', '2024-09-09 15:49:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`pack_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `pack_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
