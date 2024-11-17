-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2024 at 04:40 PM
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
-- Database: `shivay`
--

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `imgname` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `rating` decimal(3,1) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`imgname`, `name`, `description`, `price`, `rating`, `role`) VALUES
('cjjjj.png', 'Modern Interior\r\nDesign Studio', 'large objects such as tables, chairs, or beds that are used in a room for sitting or lying on or for putting things on or in', 0.00, 0.0, 'mainimg'),
('sofa.png', 'Sofa', ' it is a central hub for relaxation and socializing in many living spaces.', 1000.00, 0.0, 'product'),
('1.jpg', 'jakie chan', 'A good rating on a sofa set often indicates that it meets or exceeds the expectations of users in several key areas', 0.00, 3.0, 'rating'),
('2.jpg', 'rajesh khanna', ' the sofa set comfortable for extended periods of sitting or lounging.', 0.00, 4.0, 'rating'),
('3.jpg', 'unknown1234', 'A good sofa set is built to last, with sturdy construction and high-quality materials that can withstand regular use without showing signs of wear and tear.', 0.00, 5.0, 'rating'),
('post-2.jpg', 'sofaset', 'the sofa set comfortable for extended periods of sitting or lounging.', 3500.00, 0.0, 'product'),
('img-grid-3.jpg', 'stool', 'Find stools for your home, kitchen, bathroom, garden and more at Shivay furniture', 3500.00, 0.0, 'product'),
('1.jpg', 'CEO of company', ' Chief Executive Officer, is the highest-ranking executive in a company whose primary responsibilities include making major corporate decisions', 0.00, 0.0, 'team'),
('founder1.jpeg', 'Manager of company', ' managing the overall operations and resources of a company, and acting as the main point of communication between the board', 0.00, 0.0, 'team'),
('2.jpg', 'Employees', ' vision to the organization, guiding the direction, culture, and overarching goals of the company. ', 0.00, 0.0, 'team');

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `OfferID` int(11) NOT NULL,
  `RedeemCode` varchar(50) NOT NULL,
  `DiscountValue` decimal(5,2) NOT NULL,
  `MaxUsage` int(11) DEFAULT NULL,
  `IsActive` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`OfferID`, `RedeemCode`, `DiscountValue`, `MaxUsage`, `IsActive`) VALUES
(4, 'ABCDEFGHIJKL', 12.00, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `product_ids` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment` tinyint(1) NOT NULL DEFAULT 0,
  `placed` varchar(255) DEFAULT 'not sended'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `username`, `total_amount`, `product_ids`, `created_at`, `payment`, `placed`) VALUES
('662d086e5de7e', 'mbavaliya621@rku.ac.in', 7500.00, '1', '2024-04-27 14:15:10', 1, 'not sended');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `imagname` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `searchkey` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`imagname`, `name`, `searchkey`, `description`, `price`, `product_id`) VALUES
('sofa.png', 'sofa', 'sofa', 'Shop for sofa sets of various types, materials, and prices at Wooden Street, a leading online furniture store in India. Find sofa sets with sofa cum bed, L shape, velvet, cotton, and more options', 7500, '1'),
('img-grid-3.jpg', 'stool', 'stool', 'table for sit', 1200, '2');

-- --------------------------------------------------------

--
-- Table structure for table `user_dynamic`
--

CREATE TABLE `user_dynamic` (
  `imgname` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_dynamic`
--

INSERT INTO `user_dynamic` (`imgname`, `name`, `description`, `role`) VALUES
('cjjjj.png', 'Modern Interior\r\nDesign Studio', 'A sofa, often referred to as a couch, is more than just a piece of furniture; it is a central hub for relaxation and socializing in many living spaces.', 'mainimg'),
('1.jpg', 'CEO of company', ' Chief Executive Officer, is the highest-ranking executive in a company whose primary responsibilities include making major corporate decisions', '\r\nteam'),
('2.jpg', 'manager of company', 'managing the overall operations and resources of a company, and acting as the main point of communication between the board', ' team'),
('3.jpg', 'employees', 'vision to the organization, guiding the direction, culture, and overarching goals of the company.', ' team');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `fname` char(50) DEFAULT NULL,
  `lname` char(50) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `mobilenumber` varchar(15) DEFAULT NULL,
  `password` varchar(18) DEFAULT NULL,
  `imgname` varchar(255) DEFAULT '1.jpg',
  `role` varchar(255) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`fname`, `lname`, `username`, `mobilenumber`, `password`, `imgname`, `role`) VALUES
('maulik', 'kanzariya', 'maulik5050', '8787878787', 'maulik', '1.jpg', 'admin'),
('manav', 'bavaliya', 'mbavaliya621@rku.ac.in', '9898989898', 'manav', '1.jpg', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_ratings`
--

CREATE TABLE `user_ratings` (
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_ratings`
--

INSERT INTO `user_ratings` (`name`, `description`, `rating`, `username`) VALUES
('maulik', 'good', 5, ''),
('AK', 'LLLLLL', 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`OfferID`),
  ADD UNIQUE KEY `RedeemCode` (`RedeemCode`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `OfferID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user_info` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
