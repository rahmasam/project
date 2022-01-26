-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2022 at 06:11 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `furniture`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `description`, `position`) VALUES
(3, 'Easy chairs', 'The easy chairs are furnishing accessories for the living area that are extremely versatile', 2),
(4, 'Beds', 'Beds are the main element in the furnishing of the sleeping area: in addition to their primary function related to rest', 1),
(5, 'Bedside tables', 'Bedside tables are furnishing elements for the night ', 1),
(26, 'Desks chair', 'Increase your productivity by shopping desks online that are so comfortable', 1),
(27, 'NTITEST', 'NTI CORSES NOW NOW', 1),
(28, 'testcategorytoday', 'testcategorytodaytestcategorytoday', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(255) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `product_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `product_price` decimal(15,2) NOT NULL,
  `selling_price` decimal(15,2) NOT NULL,
  `image` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `introduce` text COLLATE utf8_unicode_ci NOT NULL,
  `made_in` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `post_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `cat_id`, `product_name`, `product_price`, `selling_price`, `image`, `introduce`, `made_in`, `post_on`) VALUES
(2, 4, 'Cute trash can', '500000.00', '500000.00', 'news_19.jpeg', '<p>Good</p>\r\n', 'Dameitta', '2019-10-17 23:34:05'),
(34, 4, 'Round Clock', '4000000.00', '3800000.00', 'saleoff_03.png', '<p>Good</p>\r\n', 'Dameitta', '2019-10-17 23:35:26'),
(38, 3, 'Gray Work Chair', '3000000.00', '2900000.00', '1643161871157449449.png', 'Good', 'Dameitta', '2022-01-26 03:51:11'),
(88, 3, 'childern room', '52.00', '32.00', '16431618501743920018.png', 'mansoura      mansouramansoura', 'mansoura', '2022-01-26 03:50:50'),
(30, 3, 'Elegant Wall Clock', '8000000.00', '8000000.00', '164316210352779684.png', '                                <p>Good</p>\r\n                                ', 'Dameitta', '2022-01-26 03:55:03'),
(40, 5, 'Long Sofa', '8000000.00', '8000000.00', 'product_12.png', '<p>Product has&nbsp;Product has&nbsp;</p>\r\n', 'Dameitta', '2022-01-20 12:59:11'),
(41, 5, 'Relaxing chair', '5000000.00', '5000000.00', '16431599562001523159.png', '                                <p>Good</p>\r\n                                ', 'new yourk', '2022-01-26 03:19:16'),
(42, 5, 'White Relaxing Chair', '4500000.00', '4300000.00', 'product_22.jpeg', '<p>Good</p>\r\n', 'italy', '2019-10-17 23:42:27'),
(95, 28, 'producttoday', '8000.00', '7000.00', '74132_350_200_W.jpg', '                                           dameittadameittadameittadameitta                     ', 'dameitta', '2022-01-26 07:06:01'),
(75, 5, 'childern room', '15000.00', '14000.00', 'img_bedroom.jpg', '<p>moasdasdasdasdasdasdasd</p>\r\n', 'dameitta', '2022-01-20 01:51:22');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `permission` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role`, `permission`) VALUES
(1, 'Admin', 'login,add_category,delete_user,delete_role,edit_role,add_slide,edit_slide,edit_category'),
(2, 'supplier', 'login,add_category,delete_category,edit_product,add_slide,edit_slide,edit_category,add product'),
(3, 'shipper', 'login,add_order,delete_order,edit_order'),
(4, 'customer', 'login,add_order,delete_order,edit_order,registration ');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `slide_id` int(255) NOT NULL,
  `slide_image` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `post_on` datetime NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`slide_id`, `slide_image`, `description`, `post_on`, `position`) VALUES
(11, 'slide_03.jpeg', 'slide threee\r\n                                ', '2022-01-26 02:46:52', 1),
(10, 'slide_02.jpeg', '<p>Slide 2</p>\r\n', '2019-10-17 23:16:16', 2),
(9, 'slide_01.jpeg', '<p>Slide 1</p>\r\n', '2019-10-17 23:15:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(255) NOT NULL,
  `transaction_code` int(255) NOT NULL,
  `customer_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `customer_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `customer_phone` int(11) NOT NULL,
  `customer_address` text COLLATE utf8_unicode_ci NOT NULL,
  `product` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `time_order` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `transaction_code`, `customer_name`, `customer_email`, `customer_phone`, `customer_address`, `product`, `quantity`, `subtotal`, `time_order`) VALUES
(21, 957420, 'mostafa ebrahim ', 'mostafa.elserry1@gmail.com', 1007100490, 'Minima odit minima o', 'Iron art painting fern TS 309', 5, '22500000.00', '2022-01-19 02:33:17'),
(23, 739336, 'ebrahim ', 'zuwiluweni@mailinator.com', 1007100490, 'Dolor non consequatu', 'Cute trash can', 2, '1000000.00', '2022-01-20 12:00:04'),
(22, 871818, 'mostafa ebrahim ', 'mostafa.elserry1@gmail.com', 1007100490, 'Minima odit minima o', 'Iron art painting fern TS 309', 5, '22500000.00', '2022-01-19 02:36:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_account` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(15) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_account`, `user_password`, `image`, `phone`, `role_id`) VALUES
(28, 'mostafa ebrahim', 'mostafa.elserry1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '1643157077231443498.jpg', 1007100490, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `tu` (`role`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`slide_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `tu` (`user_account`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `slide_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
