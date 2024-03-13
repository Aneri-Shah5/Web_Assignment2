-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2024 at 05:06 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ass2_php_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `ca_id` int(11) NOT NULL,
  `ca_user_id` int(11) DEFAULT NULL,
  `ca_product_id` int(11) DEFAULT NULL,
  `ca_quantity` int(11) DEFAULT NULL,
  `ca_created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `c_id` int(11) NOT NULL,
  `c_product_id` int(11) DEFAULT NULL,
  `c_user_id` int(11) DEFAULT NULL,
  `c_rating` int(11) DEFAULT NULL,
  `c_image` varchar(255) DEFAULT NULL,
  `c_text` text DEFAULT NULL,
  `c_created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`c_id`, `c_product_id`, `c_user_id`, `c_rating`, `c_image`, `c_text`, `c_created_date`) VALUES
(1, 1, 2, 4, '1.png, 2.png', 'Good product', '2024-03-10 16:04:55');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `o_id` int(11) NOT NULL,
  `o_user_id` int(11) DEFAULT NULL,
  `o_product_id` int(11) DEFAULT NULL,
  `o_quantity` int(11) DEFAULT NULL,
  `o_total_amount` decimal(10,2) DEFAULT NULL,
  `o_order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(11) NOT NULL,
  `p_description` text DEFAULT NULL,
  `p_image` varchar(255) DEFAULT NULL,
  `p_pricing` decimal(10,2) DEFAULT NULL,
  `p_shipping_cost` decimal(10,2) DEFAULT NULL,
  `p_created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `p_description`, `p_image`, `p_pricing`, `p_shipping_cost`, `p_created_date`) VALUES
(1, 'test description', 'image.jpg', '5000.00', '100.00', '2024-03-10 05:23:09'),
(2, 'test2', 'image1.png', '5999.00', '80.00', '2024-03-10 16:03:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `u_email` varchar(100) DEFAULT NULL,
  `u_password` varchar(255) DEFAULT NULL,
  `u_username` varchar(255) DEFAULT NULL,
  `u_purchase_history` text DEFAULT NULL,
  `u_shipping_address` text DEFAULT NULL,
  `u_created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_email`, `u_password`, `u_username`, `u_purchase_history`, `u_shipping_address`, `u_created_date`) VALUES
(2, 'test@gmail.com', '123456', 'test', 'NA', '12 main street', '2024-03-10 06:33:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`ca_id`),
  ADD KEY `ca_user_id` (`ca_user_id`),
  ADD KEY `ca_product_id` (`ca_product_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `c_product_id` (`c_product_id`),
  ADD KEY `c_user_id` (`c_user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `o_user_id` (`o_user_id`),
  ADD KEY `o_product_id` (`o_product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `ca_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD CONSTRAINT `cart_details_ibfk_1` FOREIGN KEY (`ca_user_id`) REFERENCES `users` (`u_id`),
  ADD CONSTRAINT `cart_details_ibfk_2` FOREIGN KEY (`ca_product_id`) REFERENCES `products` (`p_id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`c_product_id`) REFERENCES `products` (`p_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`c_user_id`) REFERENCES `users` (`u_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`o_user_id`) REFERENCES `users` (`u_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`o_product_id`) REFERENCES `products` (`p_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
