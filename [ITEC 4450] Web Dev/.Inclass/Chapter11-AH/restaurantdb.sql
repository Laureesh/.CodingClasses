-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2025 at 11:50 AM
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
-- Database: `restaurantdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(40) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `firstName`, `lastName`, `address`, `city`, `state`, `zip`) VALUES
(1, 'Tony', 'Stark', '1000 University Center Ln', 'Lawrenceville', 'GA', '30043'),
(2, 'Steve', 'Rogers', '2000 Madison Ave', 'Richmod', 'IN', '47374'),
(3, 'Bruce', 'Banner', '5600 Buford Hwy NE', 'Doraville', 'GA', '30340'),
(4, 'Natasha', 'Romanoff', '441 John Lewis Freedom Pkwy NE', 'Atlanta', 'GA', '30307'),
(6, 'Peter', 'Parker', '2000 Madison Ave', 'Cincinnati', 'OH', '41073');

-- --------------------------------------------------------

--
-- Table structure for table `dish`
--

CREATE TABLE `dish` (
  `dish_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `ingredients` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dish`
--

INSERT INTO `dish` (`dish_id`, `name`, `price`, `ingredients`) VALUES
(1, 'Gyro', 12.45, 'lamb, greek yogurt, pita, tomato, onion'),
(2, 'Hamburger', 8.12, 'beef, bun, tomato, lettuce, cheese, ketchup'),
(3, 'Chicken Parmesan', 11.25, 'chicken breast, tomato sauce, tomato, parmesan cheese'),
(4, 'Kung Pao Chicken', 12.48, 'chicken, peanuts, leek, chili peppers'),
(5, 'Ropa Vieja', 12.45, 'flank steak, onion, tomato, cumin, paprika, pepper');

-- --------------------------------------------------------

--
-- Table structure for table `dishorder`
--

CREATE TABLE `dishorder` (
  `dishOrder_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dishorder`
--

INSERT INTO `dishorder` (`dishOrder_id`, `order_id`, `dish_id`) VALUES
(1, 1, 4),
(2, 2, 2),
(3, 3, 3),
(4, 4, 1),
(5, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `totalPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `date`, `totalPrice`) VALUES
(1, 1, '2025-10-30', 12.48),
(2, 2, '2025-10-30', 16.24),
(3, 3, '2025-10-30', 11.25),
(4, 4, '2025-10-30', 24.93);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `dish`
--
ALTER TABLE `dish`
  ADD PRIMARY KEY (`dish_id`);

--
-- Indexes for table `dishorder`
--
ALTER TABLE `dishorder`
  ADD PRIMARY KEY (`dishOrder_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `dish_id` (`dish_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dish`
--
ALTER TABLE `dish`
  MODIFY `dish_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dishorder`
--
ALTER TABLE `dishorder`
  MODIFY `dishOrder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dishorder`
--
ALTER TABLE `dishorder`
  ADD CONSTRAINT `dishorder_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `dishorder_ibfk_2` FOREIGN KEY (`dish_id`) REFERENCES `dish` (`dish_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
