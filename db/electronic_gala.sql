-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2023 at 11:28 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `electronic_gala`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_data`
--

CREATE TABLE `admin_data` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `passwords` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_data`
--

INSERT INTO `admin_data` (`id`, `name`, `email`, `passwords`) VALUES
(1, 'admin', 'admin@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`) VALUES
(1, 'Samsung'),
(2, 'hp'),
(3, 'Apple'),
(4, 'Google'),
(5, 'Xiaomi'),
(6, 'OnePlus'),
(7, 'Infinix'),
(8, 'Oppo'),
(9, 'Dell'),
(10, 'Lenovo'),
(11, 'TCL'),
(12, 'NOBEL'),
(13, 'Haier'),
(14, 'Changhong Ruba'),
(15, 'Dawlance'),
(16, 'Super Asia'),
(17, 'Acer'),
(18, 'GALA MART'),
(19, 'PEL'),
(20, 'Mibro'),
(21, 'AUDIONIC'),
(22, 'Ronin'),
(23, 'Asus');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(200) NOT NULL,
  `cat-image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `cat-image`) VALUES
(1, 'Phones', 'smartphones.png'),
(2, 'Television', 'LEDTVS.png'),
(4, 'Laptop', 'laptops.png'),
(5, 'Kitchen', 'kitchen.png'),
(6, 'Smartwatch', 'smartwatches.png'),
(8, 'Air Conditioner', '../images/SMARTPHONES (2).png'),
(12, 'Large Appliances', '../images/AIR CONDITIONIR.png'),
(13, 'Mobile Accessories', '../images/SMARTPHONES (1).png');

-- --------------------------------------------------------

--
-- Table structure for table `chat_responses`
--

CREATE TABLE `chat_responses` (
  `id` int(11) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `response` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_responses`
--

INSERT INTO `chat_responses` (`id`, `keyword`, `response`) VALUES
(1, 'hello', 'Hello! How can I assist you today?'),
(2, 'order procedure', 'To place an order, please follow the steps: 1. Browse the products catalog, 2. Select the desired items, 3. Add them to your cart, 4. Proceed to checkout, 5. Provide your shipping information, 6. Review and confirm your order, 7. Make the payment.'),
(3, 'how place order', 'To place an order, please follow the steps: \r\n1. Browse the products catalog, \r\n2. Select the desired items, \r\n3. Add them to your cart, \r\n4. Proceed to checkout, \r\n5. Provide your shipping information, \r\n6. Review and confirm your order, \r\n7. Make the payment.'),
(4, 'need order', 'To place an order, please follow the steps: 1. Browse the products catalog, 2. Select the desired items, 3. Add them to your cart, 4. Proceed to checkout, 5. Provide your shipping information, 6. Review and confirm your order, 7. Make the payment.'),
(5, 'create account', 'To create an account, visit our website and click on the \'Sign Up\' or \'Register\' button. Fill in the required information such as your name, email address, and password. Once done, submit the form, and your account will be created.');

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `color_id` int(11) NOT NULL,
  `color_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`color_id`, `color_name`) VALUES
(1, 'red'),
(2, 'black'),
(3, '#0096FF'),
(7, '#eeeeee'),
(8, '#006a00');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` varchar(2000) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `phone`, `message`, `timestamp`) VALUES
(1, 'Ali Awan', 'asdfgh@gmail.com', '03482624672', 'i really like your website ui when using it from big screens in mobile its not that good', '2023-07-14 23:48:39'),
(2, 'Noraiz Candia', 'nora@gmail.com', '0094397943', 'I really like your shop', '2023-07-14 23:51:27');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `color_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`id`, `order_id`, `product_id`, `quantity`, `price`, `color_id`) VALUES
(1, 3, 3, 1, '50000', 2),
(2, 4, 2, 1, '12000', 2),
(3, 5, 2, 6, '12000', 1),
(4, 6, 21, 1, '83000', 2),
(5, 7, 2, 1, '12000', 1),
(6, 8, 3, 1, '50000', 2),
(7, 9, 24, 1, '45000', 1),
(8, 10, 24, 1, '45000', 2),
(9, 11, 24, 1, '45000', 1),
(10, 12, 24, 1, '45000', 2),
(11, 13, 25, 1, '57000', 1),
(12, 14, 25, 1, '57000', 2),
(13, 15, 2, 2, '12000', 2),
(14, 16, 24, 1, '45000', 2),
(15, 16, 3, 1, '50000', 1),
(16, 17, 24, 1, '45000', 2),
(17, 18, 13, 1, '60000', 2),
(18, 19, 3, 1, '50000', 2),
(19, 20, 3, 1, '50000', 2),
(20, 21, 25, 1, '57000', 2),
(21, 22, 2, 1, '12000', 1),
(22, 22, 24, 1, '45000', 1),
(23, 22, 3, 1, '50000', 1),
(24, 23, 5, 1, '590000', 2),
(25, 23, 13, 1, '60000', 1),
(26, 23, 24, 1, '45000', 2),
(27, 24, 35, 1, '60000', 1),
(28, 25, 3, 1, '50000', 2),
(29, 26, 32, 1, '21000', 1),
(30, 26, 13, 1, '60000', 2),
(31, 26, 3, 1, '50000', 1),
(32, 26, 24, 1, '45000', 2),
(33, 27, 24, 3, '45000', 1),
(34, 27, 2, 1, '12000', 2),
(35, 28, 29, 1, '45000', 2),
(36, 29, 24, 1, '45000', 2),
(37, 29, 13, 1, '60000', 2),
(38, 29, 27, 1, '76000', 2),
(39, 29, 4, 1, '3000', 2),
(40, 30, 2, 1, '12000', 2),
(41, 31, 35, 6, '60000', 1),
(42, 32, 35, 5, '60000', 1),
(43, 33, 22, 1, '27000', 1),
(44, 34, 2, 1, '12000', 2),
(45, 35, 35, 1, '60000', 1),
(46, 36, 24, 1, '45000', 1),
(47, 36, 2, 1, '12000', 2),
(48, 37, 3, 1, '50000', 1),
(49, 38, 27, 1, '76000', 2),
(50, 38, 35, 2, '60000', 2),
(51, 39, 34, 10, '1000', 1),
(52, 40, 12, 4, '45000', 2),
(53, 41, 2, 5, '12000', 2),
(54, 42, 3, 1, '50000', 1),
(55, 43, 24, 1, '45000', 1),
(56, 44, 35, 1, '60000', 2),
(57, 45, 28, 1, '41000', 1),
(58, 46, 3, 1, '50000', 2),
(59, 47, 3, 1, '50000', 1),
(60, 48, 30, 1, '35000', 2),
(61, 49, 24, 2, '45000', 1),
(62, 49, 34, 1, '1000', 2),
(63, 51, 28, 1, '41000', 1),
(64, 51, 2, 2, '12000', 2),
(65, 52, 3, 1, '50000', 1),
(66, 53, 29, 1, '45000', 1),
(67, 54, 24, 1, '45000', 1),
(68, 55, 4, 1, '3000', 1),
(69, 56, 3, 1, '50000', 1),
(70, 57, 29, 1, '45000', 2),
(71, 58, 5, 1, '590000', 3),
(72, 59, 35, 1, '60000', 1),
(74, 63, 34, 1, '1000', 2),
(75, 64, 35, 1, '60000', 2),
(76, 65, 24, 1, '45000', 1),
(77, 65, 37, 1, '48000', 3),
(78, 66, 27, 1, '76000', 1),
(79, 67, 25, 1, '57000', 1),
(80, 68, 22, 1, '27000', 1),
(81, 69, 26, 1, '110000', 1),
(82, 70, 35, 1, '60000', 1),
(83, 71, 3, 1, '50000', 1),
(84, 72, 3, 1, '50000', 2),
(85, 73, 35, 1, '60000', 2),
(86, 74, 34, 1, '1000', 2),
(87, 75, 21, 1, '83000', 2),
(88, 76, 26, 1, '110000', 2),
(89, 77, 27, 1, '76000', 2),
(90, 78, 2, 1, '12000', 2),
(91, 79, 24, 1, '45000', 2),
(92, 80, 33, 1, '27999', 1),
(93, 81, 33, 1, '27999', 1),
(94, 82, 3, 1, '50000', 1),
(95, 83, 4, 2, '3000', 1),
(96, 83, 2, 2, '12000', 1),
(97, 84, 22, 1, '27000', 2),
(98, 85, 26, 1, '110000', 2),
(99, 86, 3, 1, '50000', 1),
(100, 87, 5, 1, '590000', 2),
(101, 88, 40, 1, '10000', 2),
(102, 89, 29, 1, '45000', 1),
(103, 89, 3, 1, '50000', 1),
(104, 90, 24, 1, '45000', 2),
(105, 91, 24, 1, '45000', 2),
(106, 92, 5, 1, '590000', 2),
(107, 93, 24, 1, '45000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `totalprice` varchar(200) NOT NULL,
  `orderstatus` varchar(255) NOT NULL,
  `paymentmode` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `totalprice`, `orderstatus`, `paymentmode`, `timestamp`) VALUES
(1, 1, '50000', 'Order Placed', 'COD', '2023-07-01 21:18:53'),
(2, 3, '50000', 'Order Placed', 'COD', '2023-07-01 21:18:53'),
(3, 1, '50000', 'Order Placed', 'COD', '2023-07-01 21:18:53'),
(4, 1, '12000', 'Order Placed', 'COD', '2023-07-01 21:18:53'),
(5, 1, '72000', 'Order Placed', 'COD', '2023-07-01 21:18:53'),
(6, 1, '83000', 'Order Placed', 'COD', '2023-07-01 21:18:53'),
(7, 3, '12000', 'Order Placed', 'COD', '2023-07-01 21:18:53'),
(8, 3, '50000', 'Order Placed', 'COD', '2023-07-01 21:18:53'),
(9, 3, '45000', 'Order Placed', 'COD', '2023-07-01 21:18:53'),
(10, 3, '45000', 'Order Placed', 'COD', '2023-07-01 21:18:53'),
(11, 3, '45000', 'Order Placed', 'COD', '2023-07-01 21:18:53'),
(12, 3, '45000', 'Order Placed', 'COD', '2023-07-01 21:18:53'),
(13, 3, '57000', 'Order Placed', 'COD', '2023-07-01 21:18:53'),
(14, 3, '57000', 'Cancelled', 'COD', '2023-07-11 21:35:10'),
(15, 3, '24000', 'Order Placed', 'COD', '2023-07-01 21:18:53'),
(16, 3, '95000', 'Order Placed', 'COD', '2023-07-04 20:45:29'),
(17, 4, '45000', 'Dispatched', 'Credit/Debit', '2023-07-05 23:33:36'),
(18, 3, '60000', 'Order Placed', 'COD', '2023-07-05 16:20:19'),
(19, 3, '50000', 'Order Placed', 'COD', '2023-07-05 16:21:07'),
(20, 3, '50000', 'Order Placed', 'COD', '2023-07-05 16:29:28'),
(21, 3, '57000', 'Cancelled', 'COD', '2023-07-05 22:16:57'),
(22, 3, '107000', 'Cancelled', 'COD', '2023-07-05 22:23:15'),
(23, 3, '695000', 'In Progress', 'COD', '2023-07-05 23:34:00'),
(24, 5, '60000', 'Order Placed', 'COD', '2023-07-06 22:08:44'),
(25, 5, '50000', 'In Progress', 'Credit/Debit', '2023-07-06 22:32:04'),
(26, 3, '176000', 'Order Placed', 'Credit/Debit', '2023-07-10 23:50:46'),
(27, 2, '147000', 'Delivered', 'COD', '2023-07-15 13:13:12'),
(28, 2, '45000', 'Order Placed', 'COD', '2023-07-15 20:32:04'),
(29, 2, '184000', 'Order Placed', 'COD', '2023-07-15 21:01:55'),
(30, 3, '12000', 'Order Placed', 'COD', '2023-07-15 21:31:11'),
(31, 3, '360000', 'Order Placed', 'COD', '2023-07-16 15:35:26'),
(32, 3, '300000', 'Order Placed', 'COD', '2023-07-16 15:42:06'),
(33, 3, '27000', 'Order Placed', 'COD', '2023-07-16 15:43:26'),
(34, 3, '12000', 'Order Placed', 'COD', '2023-07-16 15:50:58'),
(35, 3, '60000', 'Order Placed', 'COD', '2023-07-16 15:53:37'),
(36, 3, '57000', 'Order Placed', 'Credit/Debit', '2023-07-16 15:56:48'),
(37, 3, '50000', 'Order Placed', 'COD', '2023-07-16 15:59:58'),
(38, 3, '196000', 'Delivered', 'COD', '2023-07-17 01:30:52'),
(39, 5, '10000', 'Order Placed', 'COD', '2023-07-16 19:04:58'),
(40, 3, '180000', 'In Progress', 'COD', '2023-07-19 21:56:42'),
(41, 3, '60000', 'Delivered', 'Credit/Debit', '2023-07-21 20:29:41'),
(42, 3, '50000', 'Order Placed', 'COD', '2023-07-22 23:19:01'),
(43, 3, '45000', 'Order Placed', 'Credit/Debit', '2023-07-23 00:57:46'),
(44, 3, '60000', 'Order Placed', 'COD', '2023-07-23 01:10:31'),
(45, 3, '41000', 'Order Placed', 'COD', '2023-07-23 01:21:54'),
(46, 3, '50000', 'Order Placed', 'Credit/Debit', '2023-07-23 01:22:11'),
(47, 3, '50000', 'Order Placed', 'COD', '2023-07-23 01:35:32'),
(48, 3, '35000', 'Cancelled', 'COD', '2023-07-23 23:34:37'),
(49, 3, '91000', 'Cancelled', 'Credit/Debit', '2023-07-23 23:33:33'),
(51, 1, '65000', 'Order Placed', 'Credit/Debit', '2023-07-25 19:30:21'),
(52, 1, '50000', 'Order Placed', 'COD', '2023-07-25 19:33:26'),
(53, 1, '45000', 'Order Placed', 'COD', '2023-07-25 19:34:10'),
(54, 3, '45000', 'Order Placed', 'COD', '2023-07-27 00:10:18'),
(55, 3, '3000', 'Order Placed', 'Credit/Debit', '2023-07-27 00:22:10'),
(56, 3, '50000', 'Delivered', 'COD', '2023-08-04 21:54:40'),
(57, 3, '45000', 'Order Placed', 'COD', '2023-08-10 23:53:02'),
(58, 3, '590000', 'Order Placed', 'COD', '2023-08-11 21:51:29'),
(59, 3, '60000', 'Order Placed', 'COD', '2023-08-11 22:29:17'),
(63, 3, '1000', 'Order Placed', 'COD', '2023-08-11 22:43:08'),
(64, 3, '60000', 'Cancelled', 'COD', '2023-08-11 23:30:42'),
(65, 3, '93000', 'Order Placed', 'COD', '2023-08-11 23:38:16'),
(66, 3, '76000', 'Order Placed', 'COD', '2023-08-12 01:44:11'),
(67, 3, '57000', 'Order Placed', 'COD', '2023-08-12 01:46:05'),
(68, 3, '27000', 'Order Placed', 'COD', '2023-08-12 01:57:22'),
(69, 3, '110000', 'Order Placed', 'COD', '2023-08-12 02:08:34'),
(70, 3, '60000', 'Order Placed', 'COD', '2023-08-12 02:11:09'),
(71, 3, '50000', 'Order Placed', 'COD', '2023-08-12 02:23:51'),
(72, 3, '50000', 'Order Placed', 'COD', '2023-08-12 02:27:13'),
(73, 3, '60000', 'Order Placed', 'COD', '2023-08-12 02:36:59'),
(74, 3, '1000', 'Order Placed', 'COD', '2023-08-12 02:37:33'),
(75, 3, '83000', 'Order Placed', 'COD', '2023-08-12 02:45:37'),
(76, 3, '110000', 'Order Placed', 'COD', '2023-08-12 02:59:21'),
(77, 3, '76000', 'Order Placed', 'COD', '2023-08-12 03:05:57'),
(78, 3, '12000', 'Cancelled', 'COD', '2023-08-12 21:11:36'),
(79, 3, '45000', 'Cancelled', 'COD', '2023-08-12 23:05:35'),
(80, 3, '27999', 'Cancelled', 'COD', '2023-08-12 23:05:29'),
(81, 3, '27999', 'Delivered', 'COD', '2023-08-13 22:53:18'),
(82, 3, '50000', 'Delivered', 'Credit/Debit', '2023-08-13 22:47:10'),
(83, 3, '30000', 'Cancelled', 'COD', '2023-08-14 15:08:54'),
(84, 10, '27000', 'Order Placed', 'Credit/Debit', '2023-08-21 22:44:31'),
(85, 3, '110000', 'Cancelled', 'COD', '2023-09-08 07:43:24'),
(86, 11, '50000', 'Order Placed', 'COD', '2023-09-23 15:12:01'),
(87, 1, '590000', 'Order Placed', 'COD', '2023-09-29 18:13:25'),
(88, 3, '10000', 'Delivered', 'COD', '2023-10-09 00:20:26'),
(89, 3, '95000', 'Cancelled', 'COD', '2023-10-10 00:39:38'),
(90, 3, '45000', 'Order Placed', 'COD', '2023-10-10 05:02:16'),
(91, 12, '45000', 'In Progress', 'COD', '2023-10-10 05:05:18'),
(92, 3, '590000', 'In Progress', 'COD', '2023-10-10 06:56:32'),
(93, 3, '45000', 'Order Placed', 'COD', '2023-10-10 08:15:59');

-- --------------------------------------------------------

--
-- Table structure for table `orderstracking`
--

CREATE TABLE `orderstracking` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderstracking`
--

INSERT INTO `orderstracking` (`id`, `order_id`, `status`, `reason`) VALUES
(1, 21, 'cancelled', 'i dont want it'),
(2, 21, 'cancelled', 'i dont want it'),
(3, 22, 'cancelled', 'i dont wait it'),
(4, 17, 'Dispatched', 'order is despached'),
(5, 23, 'In Progress', 'in progress'),
(6, 25, 'In Progress', ''),
(7, 14, 'cancelled', 'i dont want it'),
(8, 27, 'Delivered', 'delivered'),
(9, 38, 'Delivered', 'deliver'),
(10, 40, 'Delivered', ''),
(11, 40, 'In Progress', ''),
(12, 41, 'Delivered', ''),
(13, 49, 'cancelled', ''),
(14, 48, 'cancelled', 'fggf'),
(15, 56, 'Delivered', ''),
(16, 64, 'Cancelled', ''),
(17, 78, 'cancelled', ''),
(18, 80, 'cancelled', ''),
(19, 79, 'cancelled', ''),
(20, 82, 'Delivered', ''),
(21, 82, 'Cancelled', ''),
(22, 82, 'Delivered', ''),
(23, 81, 'Delivered', ''),
(24, 83, 'cancelled', ''),
(25, 85, 'cancelled', 'i didnt like it'),
(26, 88, 'Delivered', ''),
(27, 89, 'cancelled', 'i didnt like it'),
(28, 91, 'In Progress', ''),
(29, 92, 'In Progress', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(200) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `price` varchar(200) NOT NULL,
  `product_image` varchar(200) NOT NULL,
  `product_description` varchar(2000) NOT NULL,
  `brand_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `cat_id`, `price`, `product_image`, `product_description`, `brand_id`) VALUES
(2, 'HP Laptop 15s', 4, '12000', 'd925beb6-8904-40df-aed8-4a24c30ebbd8.png', 'The HP Laptop 15s is a sleek and stylish computing device designed for everyday productivity. With its slim and lightweight design, it is perfect for on-the-go professionals and students. Powered by an Intel Core processor, it delivers reliable performance and smooth multitasking capabilities. The 15.6-inch Full HD display provides vibrant visuals and sharp image clarity, making it ideal for entertainment and work tasks. Equipped with ample storage space and memory options, it allows you to store and access your files with ease. Additionally, the laptop offers a range of connectivity options, including USB ports and an HDMI output, ensuring seamless integration with various devices.', 2),
(3, 'Samsung Galaxy a23', 1, '50000', 'Galaxy-S23-Ultra.png', 'Samsung Galaxy A23 6.6 Inches Display 6GB 128GB 1 year Official warranty PTA APPROVED,\r\nReleased 2022, March 25\r\n195g, 8.4mm thickness\r\nAndroid 12, up to Android 13, One UI 5\r\n64GB/128GB storage, micr', 1),
(4, 'T800 Ultra Smart Watch', 6, '3000', 'Screenshot 2023-03-29 221446.png', 'Series 8 1.99\" Bluetooth Call Smartwatch Heart Rate Sleep Monitoring IP67 Waterproof it has 1.Size:38.5*44.5*14mm\r\n2.Strap material: Silica gel\r\n3.Main screen:1.99-inch LCD 250*285\r\n4.BT 4.0 5.0 support Bluetooth call\r\n5.Charging mode: Wireless Charging\r\n', 18),
(5, 'IPHONE 14', 1, '590000', 'pngimg.com - iphone_14_PNG42.png', 'Apple iPhone 14 Pro Max - 6.7\" Inch Display - Physical Sim + ESim - PTA Approved - 1 Year Official Warranty \" mercantile\" also Display : 6.7\" Super Retina XDR display\r\nOS : iOS 16\r\nOne Physical Sim Slot & One ESim\r\nMemory : 128GB, 256GB, 512GB, 1TB\r\nProce', 3),
(6, 'Google Pixel 6', 1, '124000', 'pixel-6-header.png', 'Unlocked Smartphone with Wide and Ultrawide Lens - 128GB also 6.4 inch AMOLED\r\nOcta-core Tensor\r\n128GB Storage, 8GB Ram\r\n50MP/8MP Cameras\r\n4614 mAh battery', 4),
(7, 'OnePlus 9', 1, '300000', 'Screenshot 2023-03-29 222754.png', 'Dimensions Height: 16.00cm Width: 7.39cm Thickness: 0.81cm Weight: 183g Display Parameters Size: 16.637 centimeters (6.55 inches) (measured diagonally from corner to corner) Resolution: 2400 x 1080 pixels 402 ppi Aspect Ratio: 20:9 Type: 120 H', 6),
(8, 'Xiaomi 11', 1, '120000', 'Xiaomi-12-4.png', 'Announced Dec 2020. Features 6.81″ display, Snapdragon 888 5G chipset, 4600 mAh battery, 256 GB storage, 12 GB RAM Memory: Card slot\r\nChipset: Qualcomm SM8350 \r\nCamera: Photo / Video', 5),
(9, 'Samsung Galaxy s22 Ultra', 1, '400000', 'Samsung-Galaxy-S22-Ultra-4.png', 'Galaxy S22 Ultra boasts a 6.8-inch Edge Quad HD+ Dynamic AMOLED 2X display with Vision Booster with 12GB ram', 1),
(10, 'Redmi Note 12 Pro', 1, '60000', 'Screenshot 2023-03-29 222535.png', 'Redmi Note 12 Pro Plus 5G Specs: 200MP Ultra-High Res Camera, 120W HyperCharge, 120Hz Pro AMOLED Display, 3D Arc Design, MediaTek Dimensity 1080.', 5),
(11, 'infinix hot 10', 1, '40000', '3-51.png', 'It includes a 16-megapixel wide sensor with PDAF, a 2-megapixels macro camera, \r\nInternal: 64GB/3GB RAM, 64GB/4GB RAM, 12\r\nOS: Android 10, XOS 6.0\r\nCPU: Octa-core (2x2.0 GHz Cortex-A75 & 6x1.7\r\nSensors: Fingerprint (rear-mounted),', 7),
(12, 'Oppo Reno 6', 1, '45000', 'Oppo-Reno-6-2.png', 'Size and Weight. Height: about 159.1mm ; Memory. 8GB RAM +128GB ROM ; Display. Size: 6.4\"(16.33cm) ; Chips. CPU: Qualcomm® Snapdragon™ 720G ; Biometrics.', 8),
(13, 'HP EliteBook 820', 4, '60000', 'pngwing.com (1).png', 'Core i7 6th Generation - 8GB DDR4 RAM - 128GB SSD AND 500GB HDD- 12.5inch Screen - FREE LAPTOP BAG', 2),
(14, 'Dell Latitude 5520', 4, '30000', 'pngegg (1).png', 'Core i5 2nd generation, 8GB DDR3 Ram, 500GB Hard Drive, 15.6\" Led Display, Intel HD Graphics in very good condition', 9),
(15, 'MacBook Air 2015', 4, '60000', 'pngwing.com (2).png', 'A1466 Early 2015 With 1.6GHz Intel Core i5 (13.3 inch, 4GB RAM, 128GB) Silver Product will be in Daraz Like New Original Packaging', 3),
(16, 'HP ProBook 640', 4, '50000', 'pngegg (2).png', 'G2 Laptop, 14-inch HD Display, Intel Core i5-6th Gen Up to 3.0GHz, 8GB RAM, 256GB NVMe SSD, Display Port, Wi-Fi, Bluetooth, Windows 10 Pro', 2),
(17, 'Dell Latitude 5491', 4, '64000', 'kindpng_1066680.png', 'Laptop 14 HD Intel Core i5 8th Gen i5-8300H Quad Core 4Ghz 8GB RAM 256 GB SSD Windows 10 Pro A preinstalled operating system', 9),
(18, ' MacBook Pro 2015', 4, '130000', 'pngfind.com-macbook-pro-png-1750476.png', '(Retina, 15-inch, Mid 2015) - Core i7 processor (Turbo Boost up to 3.4GHz) - RAM 16GB DDR3L - 512GB SSD Flash Storage - MacOS Installed', 3),
(19, 'Lenovo N22 Chromebook', 4, '12500', 'PngItem_2016183.png', '11.6″ – 4 GB RAM – 16 GB ROM – With Play Store - small games Supported Storage 16 GB eMMC Flash, 16GB\r\nConnections: 2 USB 3.0 / 3.1 Gen1, 1 HDMI, Audio Connections: 3.5mm, Card Reader: SD\r\nNetworking: Intel Wireless-AC 7265 (a/b/g/n = Wi-Fi 4/ac = Wi-Fi 5', 10),
(20, 'ThinkPad Yoga ', 4, '30000', 'pngegg (3).png', '11e 11.6-inch Touch Screen 360 Convertible Laptop ( Intel® Celeron® Processor N3150 2M Cache, up to 2.25 GHz 4GB 128GB SSD Windows 10 Pro Intel HD Graphics), Black', 10),
(21, 'TCL S5200 43', 2, '83000', 'Screenshot 2023-03-29 232653.png', 'Smart Android Full HD LED TV - Black Brand Warranty\r\nScreen Size 43\r\nScreen Type Full HD\r\nScreen Resolution 1920 x 1080', 11),
(22, 'NOBEL LED 32IN', 2, '27000', 'Screenshot 2023-03-29 232327.png', 'ME7 FHD - Built-In Massive Sound Bar - 1 Year Brand Warranty A+ Grade Panel\r\nScreen Size - 32\"\r\nBuilt-In SoundBar\r\nUSB Media Player (2 Ports)\r\nHDMI (2 Port)\r\nFHD Resolution', 12),
(23, 'Nobel 32INCH', 2, '28400', 'Screenshot 2023-03-29 232357.png', ' Slim FHD LED Tv - 32 inches - 1920x1080 - Black With Free Wall Stand  Brand NOBAL\r\nScreen Size 32\r\nExcellent Picture Quality\r\nSlim Design\r\nFull HD Resolution\r\nFast Channel Shifting', 12),
(24, 'Haier 32INCH', 2, '45000', 'Screenshot 2023-03-29 232435.png', 'H-CAST series LED TV 32 Inch - H32D2M (Mobile Sharing) Aspect Ratio: 16:9\r\nResolutions: 1366*768\r\nRefresh Rate: 60Hz\r\nContrast: 3000:1\r\nResponse Time: 6.5ms\r\nViewable Angle (H/V): 178/178\r\nVideo', 13),
(25, 'TCL 40 Inch', 2, '57000', 'Screenshot 2023-03-29 232505.png', ' HD LED TV (D3000) Display 40 inches\r\nScreen Type FHD LED\r\nResolution 1920 x1080\r\n10 W Turbo Sound\r\nNatural Light Engine\r\n', 11),
(26, 'TCL 43', 2, '110000', 'Screenshot 2023-03-29 232233.png', 'P735 4K HDR Google LED TV LED UHD Smart DTV\r\n3840×2160 Screen Resolution\r\nUHD Support\r\nMicro Dimming\r\n2.4GHz/5GHz, dual-band Wi-Fi 802.11 b/g/n', 11),
(27, 'Haier 43', 2, '76000', 'Screenshot 2023-03-29 232611.png', 'Android Smart LED TV (H43K6FG)/2 Years Brand Warranty Licensed Android 11 Smart TV\r\nGoogle Assistant\r\nGoogle Chromecast\r\nGoogle Play store', 13),
(28, 'Changhong 32', 2, '41000', 'Screenshot 2023-03-29 232158.png', 'L32X6 - 32 inch LED - HD TV- Black\r\n2 Years Brand Warranty on LED TV Built-in Sound System\r\nHD TV\r\nLED TV\r\nA+ Grade Panel', 14),
(29, 'Candy 32', 2, '45000', 'Screenshot 2023-03-29 232126.png', 'Android Smart LED TV, (C32K6G)-2 Years Brand Warranty Licensed Android Certified TV 11.0\r\nDolby Digital Decoding\r\nResolution: 1366 x 768 with HDR.\r\nProcessor:ARM CA55 Quad Core with TEE\r\nWIFI and Ethernet Lan Connectivity\r\nGoogle Chromecast (Screen Mirror', 13),
(30, 'Electric Oven ', 5, '35000', 'Screenshot 2023-03-29 233917.png', ' DWMO-4215 CR Convection / Baking / 42 Liters 42L Capacity\r\n1500 W Grill\r\n6 Functions\r\nPizza Size: 15”', 15),
(31, 'Garment Steamer', 5, '13000', 'Screenshot 2023-03-29 233838.png', 'DWGS 2316 with Ceramic Heating Plate Auto Switch Off Time: 30\r\nAnti Scale\r\nDetachable Water Tank\r\nVertical Ironing\r\nAnti Drip\r\nVoltage (V):220-240\r\nFrequency (Hz): 50', 15),
(32, 'Solar Room Cooler', 5, '21000', 'Screenshot 2023-03-29 233938.png', 'Super Asia DC-12 Volt Solar Room Cooler ECM-4600 Plus DC Advance Technology Moveable Grill Turbo Fan With Ice Box (For Re-Freezable Ice Packs Working Only DC-12 Volt Solar & Battery', 16),
(33, 'Galaxy Watch 4', 6, '27999', 'Screenshot 2023-03-29 234235.png', 'SAMSUNG Galaxy Watch 4 Classic 46mm Smartwatch with ECG Monitor Tracker for Health, Fitness, Running, Sleep Cycles, GPS Fall Detection, Bluetooth | (Black 16GB + 1.5GB) | Open Box Condition', 1),
(34, 'Digital Silicon Port', 6, '1000', 'Screenshot 2023-03-29 234345.png', 'Smart Quality Square Digital Silicon SPorts Watch Smart Led Watch FOr Men&Women Girls&Boys The perfect model for those who love classic style with a personal touch. This analogue watch with quartz movement is created in stainless steel with an elegant mes', 18),
(35, 'Acer Nitro 5 AN515-58-57Y8', 4, '60000', '71ctRE34RuL._AC_SL1500_.jpg', 'Take your game to the next level with the 12th Gen Intel Core i5 processor. Get immersive and competitive performance for all your games.\r\nRTX, It\'s On: The latest NVIDIA GeForce RTX 3050 Ti (4GB dedicated GDDR6 VRAM) is powered by award-winning architecture with new Ray Tracing Cores, Tensor Cores, and streaming multiprocessors support DirectX 12 Ultimate for the ultimate gaming performance.\r\nPicture-Perfect. Furiously Fast: With the sharp visuals of a 15.6” Full HD IPS display with a lightning-quick 144Hz refresh rate, your game sessions will be fluid, unbroken, and unmatched.\r\nInternal Specifications: 16GB DDR4 3200MHz Memory (2 DDR4 Slots Total, Maximum 32GB); 512GB PCIe Gen 4 SSD (2 x PCIe M.2 Slots, 1 x 2.5\" Hard Drive Bay Available)\r\nKiller Connectivity: Get an edge on-line by taking control of your network and prioritizing your gameplay with Killer Ethernet E2600 and Killer Wi-Fi 6 AX1650.\r\nChilled to Perfection: The newly refined chassis comes with a few extra tricks up its sleeve in the form of dual-fan cooling, dual-intakes (top and bottom), and a quad-exhaust port design.\r\nPorts For All Your Accessories: USB Type-C Port USB 3.2 Gen 2 (up to 10 Gbps) DisplayPort over USB Type-C, Thunderbolt 4 & USB Charging, USB 3.2 Gen 2 Port (Featuring Power-off Charging), USB 3.2 Gen 2 port, USB 3.2 Gen 1 port, HDMI 2.1 Port with HDCP support, Headphone/Speaker/Line-out Jack, Ethernet (RJ-45), DC-in for AC adapter\r\nThe Right Fit: 14.19\" W x 10.67\" D x 1.06\" H; 5.51 lbs.; One-Year International Travelers Limited Warranty (ITW)', 17),
(36, 'Lenovo 3i Chromebook', 4, '82000', '81LYP3n5jfL._AC_SL1500_.jpg', 'The Lenovo 3i Chromebook (2023) is a sleek and versatile laptop that combines portability with powerful performance. It features a 13.3-inch Full HD IPS display with slim bezels, providing an immersive viewing experience. Under the hood, it packs an Intel Core i5 processor, 8GB of RAM, and a 256GB SSD, ensuring smooth multitasking and quick data access. What sets the Lenovo 3i Chromebook apart is its 360-degree hinge, allowing you to use it in various modes, including laptop, tablet, tent, or stand mode, to suit your needs. Running on the lightweight and secure Chrome OS, it seamlessly integrates with Google apps and provides access to a wide range of web-based applications. Connectivity options include USB Type-C ports, USB-A ports, an HDMI port, and a headphone/microphone combo jack. With Wi-Fi and Bluetooth support, you can stay connected wirelessly. The laptop also boasts a built-in HD webcam and dual speakers, making it ideal for video calls and multimedia experiences.', 10),
(37, 'SAMSUNG Galaxy Watch 4', 6, '48000', '61em2RBifsL._AC_SL1500_.jpg', 'BODY COMPOSITION ANALYSIS: Galaxy Watch4 is the first smartwatch to off body composition data right on your wrist, On your own schedule, now you can get readings on body fat, skeletal muscle, body water, basal metabolic rate, and Body Mass Index.Supported Application:Fitness Tracker,GPS,Sleep Monitor. Connectivity technology:Bluetooth. Wireless comm standard:Bluetooth BETTER SLEEP STARTS HERE: Wake up feeling refreshed and recharged with advanced sleep tracking; When you go to bed, your Galaxy Watch4 sleep tracker starts monitoring your sleep and SpO2 levels continuously BE SMART ABOUT YOUR HEART: Take care of your heart with accurate ECG monitoring and keep an eye on possible atrial fibrillation, a common form of irregular heart rhythm; Share personalized readings with your doctor using the Samsung Health Monitor app on your compatible Galaxy phone MAKE EVERY WORKOUT COUNT: Get the most out of every exercise session with advanced workout tracking that recognizes 6 popular activities, from running to rowing to swimming, automatically in just 3 minutes; Stay motivated by connecting to live coaching sessions via your smartphone or to dynamic Group Challenges with your friends.', 1),
(38, 'PEL SPLIT AC 1.5 TON', 8, '150000', '0efb86267d6240c26c0835e14942e32f.jpg_720x720.jpg', 'Introducing the PEL 1.5 Ton 18K Majestic 4D Split Air Conditioner, a powerful and efficient cooling solution designed to bring comfort to your living spaces. This model boasts advanced features and cutting-edge technology that make it an excellent choice for beating the heat during scorching summers.\r\n\r\nCapacity:\r\nThe PEL Majestic 4D Split AC comes with a cooling capacity of 1.5 tons, making it suitable for medium to large-sized rooms, offices, or living areas. It can efficiently cool a space of approximately 150 to 200 square feet.\r\n\r\n4D Air Throw:\r\nThe AC\'s innovative 4D air throw ensures uniform cooling throughout the room. It circulates cool air in multiple directions, preventing hotspots and providing a pleasant and consistent cooling experience.\r\n\r\nNon-Inverter Technology:\r\nThis model features a non-inverter compressor that delivers reliable cooling performance. Though non-inverter models have fixed cooling capacities, they are known for their durability, ease of maintenance, and cost-effectiveness.\r\n\r\nT3 Compressor:\r\nThe PEL Majestic 4D AC is equipped with a T3 compressor, which is designed to withstand extreme temperatures up to 55°C. This feature ensures the AC\'s smooth operation even during peak summers, making it an ideal choice for regions with high ambient temperatures.\r\n\r\n100% Copper Condenser:\r\nThe AC\'s condenser is made of 100% copper, which enhances its heat transfer efficiency and improves overall cooling performance. Copper is also highly durable, corrosion-resistant, and easy to maintain, making it an excellent choice for long-lasting performance.\r\n\r\nEnergy Efficiency:\r\nWhile this model doesn\'t have inverter technology, it still offers decent energy efficiency, helping you save on electricity bills compared to older non-inverter models.\r\n\r\nUser-Friendly Controls:\r\nThe PEL 1.5 Ton 18K Majestic 4D Split AC comes with an easy-to-use control panel and a user-friendly remote. It includes various modes such as Cool, Fan, and Sleep, allowing you to cust', 19),
(40, 'Mibro Lite', 6, '10000', '1141_P_1639729811142.jpg', 'The Mibro Lite Smartwatch is a stylish and affordable smartwatch that\'s perfect for fitness enthusiasts and everyday users alike. It features a 1.3-inch AMOLED display, 24/7 heart rate monitoring, SpO2 measurement, 15 sports modes, and up to 10 days of battery life. Key Features: 1.3-inch AMOLED display with a resolution of 360x360 pixels 24/7 heart rate monitoring and SpO2 measurement 15 sports modes, including outdoor running, yoga, and tennis Up to 10 days of battery life in daily mode IP68 water resistance Customizable watch faces The Mibro Lite Smartwatch is the perfect way to stay on top of your fitness goals and stay connected throughout the day.', 20),
(41, 'Mibro GS Smartwatch', 6, '17099', '8eeaa34412b8c3d24d066c77154aad33.png_750x750.jpg', 'The Mibro GS Smartwatch is a powerful and versatile smartwatch that\'s perfect for anyone who wants to stay active and connected. It features a 1.43-inch AMOLED display, dual-core processor, GPS, 70 sports modes, and up to 24 days of battery life. Key Features: 1.43-inch AMOLED display with a resolution of 466x466 pixels Dual-core processor for fast performance GPS for accurate location tracking 70 sports modes to track your workouts Up to 24 days of battery life in daily mode 5ATM water resistance Customizable watch faces The Mibro GS Smartwatch is the perfect companion for your active lifestyle. It can track your workouts, monitor your health, and keep you connected to the world around you.', 20),
(42, 'Haier HRF 246 EPR E Star', 12, '86999', 'Haier HRF 246EPR.jpg', 'Haier HRF 246EPR E-Star Refrigerator is a 9 cu. ft. This refrigerator comes with a 246L storage capacity. The refrigeration system of this unit has an R 600a refrigerant. The unit has a maximum temperature of 25?C. The refrigerator is equipped with a 1-hour ice-making technology which helps to make ice within 1 hour of the freezer being turned on. It also provides a 10-year warranty. Haier Refrigerator is a direct cooling model. It provides efficient cooling and freezing for food items. The compressor is regular in nature. It operates at a frequency of 50 Hz.', 13),
(43, 'Haier HRF 306 E Star', 12, '96000', 'product_30224_2_thumb__67760_zoom.jpg', 'The E-Star Series HRF 306 is the most energy-efficient and eco friendly refrigerator. Equipped with a 1.5L large door pocket, the HRF 306 allows for larger items such as a family of wine bottles or two large pizza boxes to be stored in the door pocket without taking up valuable freezer space. Designed with a 12 cubic foot capacity, the HRF 306 is ideal for families or small offices.', 13),
(44, 'Dawlance REF9193LF ', 12, '134000', 'WhatsApp-Image-2021-01-18-at-12.13.59-PM-600x600.jpeg.webp', 'Dawlance is a leading home appliance manufacturer in Pakistan that offers an inverter refrigerator with a mirror glass door. They are popular for delivering optimum performance and energy savings. The Dawlance Inverter Refrigerator 9193 LF Avante Plus Noir 16 Cubic Feet comes with five-day cooling retention technology. Its energy-efficient design saves electricity costs significantly. They also do not require stabilizers, which prevent the need for frequent repairs. The Hybrid Cooling Technology of Dawlance Inverter Refrigerator 9193 LF Avante Plus Noir 16 Cubic Feet helps to maintain optimum temperatures even during power outages. Food stays frozen for up to six days with this technology. The refrigerators are design to preserve the optimum vitamin levels. This helps in ensuring the health of your family. This Dawlance refrigerator has an excellent power backup, and can handle a wide variety of food types.', 15),
(45, 'Dawlance 9140 WB', 12, '80000', 'kjkkjhkjh.jpg', 'The Dawlance 9140 WB Avante Refrigerator is a top-mounted refrigerator with a capacity of 350 liters. It features a sleek and modern design with a white glass door and a silver handle. The refrigerator has a frost-free cooling system that ensures efficient cooling and prevents ice buildup. It also has a built-in water dispenser that provides chilled water on demand. The refrigerator has adjustable shelves that can be customized to fit different sizes of food items. It also has a vegetable crisper that keeps fruits and vegetables fresh for longer. The door of the refrigerator has multiple compartments for storing bottles, jars, and other small items. The 9140 WB Avante Refrigerator has a digital control panel that allows you to adjust the temperature and control the water dispenser. It also has an energy-saving mode that helps reduce electricity consumption. The refrigerator has a 10-year compressor warranty, ensuring long-lasting performance and reliability. Overall, the Dawlance 9140 Refrigerator is a stylish and functional appliance that provides efficient cooling and convenient features. It is ideal for families and households that require a large storage capacity for their food and beverages.', 15),
(46, 'Pel Ref PRGD-2350', 12, '92999', 'kjkkjhkdh.jpg', 'PEL PRGD-2350 PB Refrigerator High speed fan feature keeps your food cool all day long. Designed with material that keeps your food safe and protected. This unique feature keeps your refrigerator fresh and free from unpleasant smells. Purest Copper Inside Condenser improves refrigeration process and its life. PEL PRGD-2350 PB Refrigerator advanced feature that makes ice instantly in just 25 minutes.', 19),
(47, 'Pel Ref PRGD-21850', 12, '112999', '1c47f1434a87ef373a1a3dc75b055348.jpg_750x750.jpg', 'Pel Refrigerator PRGD 21850 The Pel Refrigerator PRGD 21850 is a spacious and stylish refrigerator that\'s perfect for large families and households. It features a total capacity of 390 liters, with a 120-liter freezer compartment and a 270-liter refrigerator compartment. It also has a number of other features that make it a great choice for your home, including: A glass door for easy viewing of your food Adjustable temperature controls A crisper tray for keeping your fruits and vegetables fresh An LED interior light A pure copper condenser for improved cooling performance A 10-year compressor warranty The Pel Refrigerator PRGD 21850 is the perfect way to keep your food fresh and organized. It\'s also energy efficient, so you can save money on your energy bills.', 19),
(48, 'TCL 1 Ton AC TAC12HEB', 8, '128500', 'xa41zh-600x600.jpg', 'The TCL 1 Ton Inverter AC TAC12HEB designed to provide optimal heat and cooling comfort in any room. It has a capacity of 12000 BTUs of air throw and equipped with a powerful twin rotary compressor. It is also extremely energy efficient. TCL ACs considered to be the best air conditioners in Pakistan. They come with a variety of features, including a high speed, low noise, efficient compressor, IoT Wi-Fi Control, and an Anti-Bacterial Filter. The brand also offers a range of budget-friendly options without compromising on quality. TCL 1 Ton Inverter AC TAC12HEB self-cleaning helps detect any accumulation of harmful bacteria and reminds users about the cleansing of the filter in order to enjoy healthy clean air. With low start function, it can even operate with 160 volts without affecting the heating and cooling. It is also free from CFCs as it using R410A refrigerant which is eco-friendly and does not produce any harmful fumes. In terms of cooling, TCL’s 1-ton inverter blows air to the ceiling with intelligent airflow, ensuring a shower-like airflow when cooling. But in terms of heating, the air blown towards the floor to achieve blanket-style heating.', 11),
(49, 'Dawlance 1 Ton AC Enercon 15', 8, '130000', 'Enercon-600x600.jpg', 'The Dawlance 1 Ton Inverter AC Enercon 15 is a high-efficiency air conditioning unit that offers several features to help you save money on electricity bills. The Enercon series is power by Gold Fin Anti-Rust Technology and reduce your electricity bills up to 30%. It also features hot and cool functions and can use as a space heater in colder weather.\r\n\r\nThe Dawlance Enercon 15 has a stylish glass design that makes it look classy. It is easy to install and comes with many benefits. The energy efficiency rating of the AC is impressive and saves you over 2500 PKR every month. Its easy maintenance will keep you cool year after year, and you will never need to worry about air conditioning repairs again!\r\n\r\nDawlance 1 Ton Inverter AC Enercon 15 is a high-quality air conditioning unit that offers high efficiency cooling, a wide voltage range, and a compact design. This air conditioner also comes with an impressive 10-year compressor warranty and a four-year PCB kit warranty. You will be happy you chose this product, and you will be happy with your new air conditioning unit.\r\n\r\nAfter placing your order, you will receive an email confirming your purchase. If you are not sure about the delivery option, simply choose the shipping option that suits you the best. Aysonline sends you an order confirmation email, so you can choose how you want it shipped. You can also select your preferred method of shipping. You will get your delivery by using a variety of delivery methods.', 15),
(50, 'Haier 1 Ton/RF Series/12RFP', 8, '122499', 'e4b66f775437ff9c4d40a78332733560.jpg_750x750.jpg', 'The Haier 1 Ton/RF Series/12RFP Smart DC Inverter Air Conditioner is a powerful and efficient air conditioner that\'s perfect for small to medium-sized rooms. It features a number of advanced features that make it a great choice for your home, including: Smart DC Inverter technology: This technology helps to save energy and reduce noise levels. Self-cleaning function: This function helps to keep the air conditioner clean and free of bacteria. UPS inverter: This feature allows the air conditioner to continue operating even during power outages. Turbo heat and cool: This feature allows the air conditioner to cool or heat your room quickly and efficiently. The Haier 1 Ton/RF Series/12RFP Smart DC Inverter Air Conditioner is also backed by a 10-year compressor warranty, so you can be sure that it\'s a reliable and durable investment for your home.', 13),
(51, 'Changhong Ruba 18SW Pro 1.5 Ton', 8, '155499', '5f499d7f0e39edbc795ed67feb269730.png_750x750.jpg', 'The Changhong Ruba 18SW Pro 1.5 Ton AC is a powerful and efficient air conditioner that\'s perfect for medium to large-sized rooms. It features a number of advanced features that make it a great choice for your home, including: Smart DC Inverter technology: This technology helps to save energy and reduce noise levels. Self-cleaning function: This function helps to keep the air conditioner clean and free of bacteria. Turbo heat and cool: This feature allows the air conditioner to cool or heat your room quickly and efficiently. 4-way swing: This feature allows you to distribute the air evenly throughout your room. 10-year compressor warranty: This warranty gives you peace of mind knowing that your air conditioner is protected. The Changhong Ruba 18SW Pro 1.5 Ton AC is also backed by a number of positive reviews from customers. It is praised for its powerful cooling performance, energy efficiency, and quiet operation.', 14),
(52, 'AUDIONIC DAMAC D-50', 13, '450', '7e5b4352b8390e99e216bfc56c1969d3.jpg_750x750.jpg', 'The AUDIONIC DAMAC D-50 WIRED EARPHONES are a popular choice for budget-minded consumers who are looking for a pair of earphones that offer good sound quality and comfort. They feature a sleek and stylish design, and they come with a built-in microphone so you can use them for hands-free calling. Features: 10mm driver units for powerful sound Frequency response of 20Hz-20KHz 32Ω impedance Built-in microphone for hands-free calling In-line remote control for volume and playback control 1.2m TPE cable Sound Quality The AUDIONIC DAMAC D-50 WIRED EARPHONES offer surprisingly good sound quality for their price. They deliver a balanced sound with clear highs, mids, and lows. The bass is not as deep or punchy as some more expensive earphones, but it is still satisfying.', 21),
(53, 'Ronin R-9', 13, '750', '9decca4b42bc37b7c68daaf083ee3d50.jpg_750x750.jpg', 'Ronin R9 Wireless Earphones Ronin R9 Wireless EarphonesOpens in a new window www.daraz.pk Ronin R9 Wireless Earphones The Ronin R9 Wireless Earphones are a pair of true wireless earphones that offer good sound quality, a comfortable fit, and a long battery life. They are also relatively affordable, making them a great value for the money. Features: 10mm dynamic drivers for powerful sound Bluetooth 5.0 connectivity for a stable and reliable connection Touch controls for easy music playback and hands-free calling Up to 10 hours of battery life on a single charge IPX5 water resistance for sweat and light rain protection Sound Quality The Ronin R9 Wireless Earphones deliver a balanced sound with clear highs, mids, and lows. The bass is not as deep or punchy as some more expensive earphones, but it is still satisfying. The overall sound quality is good for the price, and the earphones should be able to satisfy most listeners. Comfort and Fit The Ronin R9 Wireless Earphones are very comfortable to wear. They come with three different sizes of ear tips, so you can find the perfect fit for your ears. The earphones are also lightweight, so you can wear them for hours on end without any discomfort.', 22),
(54, 'EarPods (Lightning Connector)', 13, '5000', 'MMTN2.jpg', 'Unlike traditional, circular earbuds, the design of the EarPods is defined by the geometry of the ear. Which makes them more comfortable for more people than any other earbud-style headphones. The speakers inside the EarPods have been engineered to maximise sound output, which means you get high-quality audio. The EarPods (Lightning Connector) also include a built-in remote that lets you adjust the volume, control the playback of music and video, and answer or end calls with a press of the remote.', 3),
(55, 'Apple AirPods Max', 13, '190000', '71xEVEjRHWL._AC_SL1500_.jpg', 'The AirPods Max feature a sleek and stylish design, with a metal headband and mesh ear cups. They are also very comfortable to wear, with a soft memory foam headband and ear cups. Features: 40mm dynamic drivers for powerful sound Adaptive EQ for a personalized listening experience Active noise cancellation with transparency mode Spatial audio with dynamic head tracking Up to 20 hours of battery life on a single charge Sound Quality The Apple AirPods Max offer excellent sound quality. They deliver a balanced sound with clear highs, mids, and lows. The bass is deep and punchy, without being overpowering. The soundstage is also wide and immersive, making it feel like you are in the middle of the music. Noise Cancellation The Apple AirPods Max also have excellent noise cancellation. They are able to block out almost all ambient noise, making them perfect for listening to music in noisy environments. The transparency mode is also very useful, as it allows you to hear what is happening around you without having to remove the headphones. Spatial Audio The Apple AirPods Max also support spatial audio, which is a feature that creates a surround sound experience with Dolby Atmos content. The dynamic head tracking feature is also very cool, as it allows the sound to move with your head as you move.', 3),
(56, 'The ASUS ROG Cetra', 13, '30000', '61pEYR4uqLL._AC_SL1500_.jpg', 'The ASUS ROG Cetra True Wireless Earbuds are a great pair of wireless earbuds for gamers and music lovers alike. They offer excellent sound quality, a comfortable fit, and a long battery life. They also have a number of features that make them ideal for gaming, such as low latency mode and active noise cancellation. ASUS ROG Cetra True Wireless EarbudsOpens in a new window rog.asus.com ASUS ROG Cetra True Wireless Earbuds Features: 10mm ASUS Essence drivers for powerful sound Bluetooth 5.0 connectivity for a stable and reliable connection Touch controls for easy music playback and hands-free calling Low latency mode for reduced input lag Active noise cancellation to block out ambient noise Up to 5.5 hours of battery life on a single charge IPX4 water resistance for sweat and light rain protection Sound Quality The ASUS ROG Cetra True Wireless Earbuds deliver excellent sound quality. They offer a balanced sound with clear highs, mids, and lows. The bass is not as deep or punchy as some more expensive earbuds, but it is still satisfying. The overall sound quality is good for the price, and the earbuds should be able to satisfy most listeners. Comfort and Fit The ASUS ROG Cetra True Wireless Earbuds are very comfortable to wear. They come with three different sizes of ear tips, so you can find the perfect fit for your ears. The earbuds are also lightweight, so you can wear them for hours on end without any discomfort.', 23);

-- --------------------------------------------------------

--
-- Table structure for table `product_color`
--

CREATE TABLE `product_color` (
  `attribute_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_color`
--

INSERT INTO `product_color` (`attribute_id`, `product_id`, `color_id`) VALUES
(77, 2, 1),
(78, 2, 2),
(79, 3, 1),
(80, 3, 2),
(81, 4, 1),
(82, 4, 2),
(85, 6, 1),
(86, 6, 2),
(89, 8, 1),
(90, 8, 2),
(91, 9, 1),
(92, 9, 2),
(93, 10, 1),
(94, 10, 2),
(97, 12, 1),
(98, 12, 2),
(99, 13, 1),
(100, 13, 2),
(101, 14, 1),
(102, 14, 2),
(103, 15, 1),
(104, 15, 2),
(105, 16, 1),
(106, 16, 2),
(107, 17, 1),
(108, 17, 2),
(109, 18, 1),
(110, 18, 2),
(111, 19, 1),
(112, 19, 2),
(113, 20, 1),
(114, 20, 2),
(115, 21, 1),
(116, 21, 2),
(117, 22, 1),
(118, 22, 2),
(119, 23, 1),
(120, 23, 2),
(121, 24, 1),
(122, 24, 2),
(123, 25, 1),
(124, 25, 2),
(125, 26, 1),
(126, 26, 2),
(127, 27, 1),
(128, 27, 2),
(129, 28, 1),
(130, 28, 2),
(131, 29, 1),
(132, 29, 2),
(133, 30, 1),
(134, 30, 2),
(135, 31, 1),
(136, 31, 2),
(137, 32, 1),
(138, 32, 2),
(139, 33, 1),
(140, 33, 2),
(141, 34, 1),
(142, 34, 2),
(147, 35, 1),
(148, 35, 2),
(151, 36, 1),
(152, 36, 2),
(153, 11, 1),
(154, 11, 2),
(157, 7, 1),
(158, 7, 2),
(159, 5, 2),
(160, 5, 3),
(161, 37, 2),
(162, 37, 3),
(164, 38, 7),
(169, 40, 2),
(170, 41, 2),
(171, 41, 7),
(172, 42, 1),
(173, 42, 2),
(174, 43, 7),
(178, 44, 8),
(182, 45, 1),
(183, 46, 1),
(184, 46, 2),
(185, 47, 8),
(186, 48, 7),
(187, 49, 2),
(189, 50, 7),
(190, 51, 7),
(191, 52, 2),
(192, 53, 2),
(193, 54, 7),
(194, 55, 1),
(195, 55, 2),
(196, 55, 3),
(197, 55, 7),
(198, 56, 7);

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `product_id`, `user_id`, `rating`, `review`, `date_added`) VALUES
(1, 2, 3, 4, 'i liked it', '2023-07-12 22:54:25'),
(5, 2, 1, 2, 'not a good product', '2023-07-12 23:48:24'),
(6, 2, 2, 4, 'really good product will recommend to others', '2023-07-14 00:33:32'),
(7, 24, 3, 5, 'Haier 32INCH TV is a fantastic choice! With outstanding picture quality, easy setup, and great sound, it offers an immersive viewing experience. The sleek design and sturdy build add to its appeal. Highly recommended! ', '2023-07-14 15:35:51'),
(8, 34, 5, 5, 'exAMPE', '2023-07-16 19:14:40'),
(9, 35, 3, 5, 'Really good service', '2023-07-17 01:32:32'),
(10, 3, 3, 5, 'Good product', '2023-07-18 16:23:27'),
(11, 12, 3, 5, 'Good product', '2023-07-18 16:24:25'),
(12, 34, 3, 2, 'Its a good product but colors are not so good', '2023-08-10 23:57:10'),
(13, 26, 3, 5, 'good product', '2023-09-08 07:41:56');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `product_id`, `qty`) VALUES
(1, 2, 0),
(2, 3, 0),
(3, 4, 7),
(4, 5, 1),
(5, 6, 10),
(6, 7, 10),
(7, 8, 10),
(8, 9, 10),
(9, 10, 10),
(10, 11, 10),
(11, 12, 6),
(12, 13, 10),
(13, 14, 12),
(14, 15, 10),
(15, 16, 10),
(16, 17, 10),
(17, 18, 10),
(18, 19, 10),
(19, 20, 10),
(20, 21, 9),
(21, 22, 8),
(22, 23, 10),
(23, 24, 1),
(24, 25, 9),
(25, 26, 7),
(26, 27, 2),
(27, 28, 8),
(28, 29, 7),
(29, 30, 9),
(30, 31, 10),
(31, 32, 10),
(32, 33, 8),
(33, 34, 0),
(34, 35, 0),
(35, 36, 20),
(36, 37, 9),
(37, 38, 10),
(39, 40, 9),
(40, 41, 5),
(41, 42, 5),
(42, 43, 5),
(43, 44, 5),
(44, 45, 5),
(45, 46, 5),
(46, 47, 5),
(47, 48, 3),
(48, 49, 3),
(49, 50, 5),
(50, 51, 2),
(51, 52, 20),
(52, 53, 20),
(53, 54, 10),
(54, 55, 5),
(55, 56, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passwords` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `passwords`, `name`) VALUES
(1, 'customer@gmail.com', '1234', 'Ali Awan'),
(2, '1234@gmail.com', '12345', 'Noraiz Candia'),
(3, 'c2@gmail.com', '123 ', 'Ehtisham Shah'),
(4, 'hello@dkjhdhd.com', '123', 'Mooro Shah'),
(5, 'aaaaa@ggg.com', '123', 'Shanzy Nawaz'),
(6, 'hassanbaig@hotmail.com', '1234', 'Hassan Baig'),
(8, 'shami@gmail.com', 'asd', 'Shami Shah'),
(9, 'demo@gmail.com', '123', 'demo'),
(10, 'sssss@gmail.com', '123', 'sssss'),
(11, 'demo2@gmail.com', '1234', 'demo2'),
(12, 'demo3@gmail.com', '123', 'demo3'),
(13, '123n@gmail.com', '123', '123n');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `names` varchar(200) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(200) NOT NULL,
  `province` varchar(200) NOT NULL,
  `zip` int(11) NOT NULL,
  `mobile` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`id`, `user_id`, `names`, `address1`, `address2`, `city`, `province`, `zip`, `mobile`) VALUES
(1, 1, 'Ali Awan', 'dicdiycg', 'duhcudhdu', 'iduhdiuh', 'iedciush', 437534, '34434343'),
(2, 3, 'Ehtisham Shah', '26 hello homes ', 'jgvhdxgcj', 'jsdhgshd', 'hxjcvhd', 87575, '3838468'),
(3, 4, 'Mooro Shah', 'kjhvdkjvdhjf', 'kdhdjfdkvhk', 'hrhrrh', 'dkdhfk', 387834, '34834698434'),
(4, 5, 'Shanzy Nawaz', 'hgsfdhfsdhgf', 'gjhgjhgjhghjgh', 'rrrrr', 'uytuytuy', 76675, '34637483768'),
(5, 2, 'Noraiz Candia', ' Robert Robertson, 1234 NW Bobcat Lane, St. Robert, MO 65584-5678', 'near college school', 'Kingston', 'New York', 34753, '9384568435'),
(6, 10, 'asd', '121231 hgghhhg', '324234 fghghgd', 'hffhgg', 'hgghf', 65766, '5675766'),
(7, 11, 'Johar jiger', '2njhgjhgjhgjhgjhhjggjhghj', 'yttrtrtytyyt', 'Karachi', 'Sindh', 67867, '76777656565667'),
(8, 12, 'example', 'example adress', 'example ad 2 ', 'la', 'eee', 89797, '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_data`
--
ALTER TABLE `admin_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `chat_responses`
--
ALTER TABLE `chat_responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`color_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderstracking`
--
ALTER TABLE `orderstracking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_color`
--
ALTER TABLE `product_color`
  ADD PRIMARY KEY (`attribute_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_data`
--
ALTER TABLE `admin_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `chat_responses`
--
ALTER TABLE `chat_responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `orderstracking`
--
ALTER TABLE `orderstracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `product_color`
--
ALTER TABLE `product_color`
  MODIFY `attribute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
