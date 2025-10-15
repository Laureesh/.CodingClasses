-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2022 at 01:20 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `books`
--

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`ISBN`, `Author`, `Title`, `Price`) VALUES
('0-672-31509-2', 'Pruitt, et al.', 'Teach Yourself GIMP in 24 Hours', 24.99),
('0-672-31697-8', 'Michael Morgan', 'Java 2 for Professional Developers', 34.99),
('0-672-31745-1', 'Thomas Down', 'Installing Debian GNU/Linux', 24.99),
('0-672-31769-9', 'Thomas Schenk', 'Caldera OpenLinux System Administration Unleashed', 49.99),
('9780132847377', 'Mark Weiss', 'Data Structures & Algorithm Analysis in C++', 55.74),
('9781789807356', 'Upom Malik', 'SQL for Data Analytics: Perform fast and efficient data analysis with the power of SQL', NULL);

--
-- Dumping data for table `book_reviews`
--

INSERT INTO `book_reviews` (`ISBN`, `Review`) VALUES
('0-672-31697-8', 'The Morgan book is clearly written and goes well beyond\r\n                     most of the basic Java books out there.');

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerID`, `Name`, `Address`, `City`) VALUES
(1, 'Julie Smith', '25 Oak Street', 'Airport West'),
(2, 'Alan Wong', '1/47 Haines Avenue', 'Box Hill'),
(3, 'Michelle Arthur', '357 North Road', 'Yarraville'),
(4, 'Antoniette Wilson', '1000 University Center Ln', 'Lawrenceville'),
(5, 'Ekaterina Kutnesova', '1420 Brickell Ave', 'Miami');

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `CustomerID`, `Amount`, `Date`) VALUES
(1, 3, 69.98, '2007-04-02'),
(2, 1, 49.99, '2007-04-15'),
(3, 2, 74.98, '2007-04-19'),
(4, 3, 24.99, '2007-05-01');

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`OrderID`, `ISBN`, `Quantity`) VALUES
(1, '0-672-31697-8', 2),
(2, '0-672-31769-9', 1),
(3, '0-672-31509-2', 1),
(3, '0-672-31769-9', 1),
(4, '0-672-31745-1', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
