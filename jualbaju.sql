-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2021 at 07:06 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jualbaju`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_05_17_130844_products', 1),
(5, '2021_06_15_151920_add_slug_to_products_table', 2),
(7, '2021_06_18_121814_create_carts_table', 3),
(9, '2021_06_20_045826_create_orders_table', 4),
(10, '2021_06_20_085102_add_address_to_users_table', 5),
(12, '2021_06_30_023311_add_more_to_users_table', 6),
(13, '2021_07_02_120313_create_quantities_table', 7),
(15, '2021_08_03_134939_add_quantity_to_carts', 8),
(18, '2021_08_04_041811_add_total_payment_to_orders', 9);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total_payment` double(8,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `category`, `description`, `image_path`, `created_at`, `updated_at`, `user_id`, `slug`) VALUES
(1, 'Dark airism', '82.40', 't-shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, aspernatur.', '611c8dbaa4e9d-Dark airism.png', '2021-08-17 20:34:02', '2021-08-17 20:34:02', 3, 'dark-airism'),
(2, 'Fitted Swim Suit', '410.85', 'swimming suit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, aspernatur.', '611c8de9d5356-Fitted Swim Suit.jpg', '2021-08-17 20:34:49', '2021-08-17 20:34:49', 3, 'fitted-swim-suit'),
(3, '3 Layer Mask', '39.99', 'airism', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, aspernatur.', '611c8e0f63284-3 Layer Mask.jpg', '2021-08-17 20:35:27', '2021-08-17 20:35:27', 3, '3-layer-mask'),
(4, '2000 Style jeans', '599.99', 'jeans', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, aspernatur.', '611c8e3f8d379-2000 Style jeans.jpg', '2021-08-17 20:36:15', '2021-08-17 20:36:15', 3, '2000-style-jeans'),
(5, 'Suit 1', '380.20', 'suit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, aspernatur.', '611c8e54e2c0d-Suit 1.jpg', '2021-08-17 20:36:36', '2021-08-17 20:36:36', 3, 'suit-1'),
(6, 'Suit 2', '380.20', 'suit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, aspernatur.', '611c8e6d3a868-Suit 2.jpg', '2021-08-17 20:37:01', '2021-08-17 20:37:01', 3, 'suit-2'),
(7, 'Chino Light', '190.28', 'trouser', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, aspernatur.', '611c8ea4c50a5-Chino Light.jpg', '2021-08-17 20:37:56', '2021-08-17 20:37:56', 3, 'chino-light'),
(8, 'Business Slack', '242.20', 'trouser', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, aspernatur.', '611c8ed681cda-Business Slack.jpg', '2021-08-17 20:38:46', '2021-08-17 20:38:46', 3, 'business-slack'),
(9, 'Hipster Chinoe Female', '352.20', 'trouser', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, aspernatur.', '611c8f0def8a3-Hipster Chinoe Female.jpg', '2021-08-17 20:39:41', '2021-08-17 20:39:41', 3, 'hipster-chinoe-female'),
(10, 'Slim fit Slack', '199.99', 'trouser', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, aspernatur.', '611c93d45f541-Slim fit Slack.jpg', '2021-08-17 21:00:04', '2021-08-17 21:00:04', 3, 'slim-fit-slack'),
(11, 'Green Summer Female Pant', '208.10', 'trouser', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, aspernatur.', '611c940f42cb0-Green Summer Female Pant.jpg', '2021-08-17 21:01:03', '2021-08-17 21:01:03', 3, 'green-summer-female-pant'),
(12, 'Your Design Shirt', '49.99', 't-shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, aspernatur.', '611c943f98b9e-Your Design Shirt.jpg', '2021-08-17 21:01:51', '2021-08-17 21:01:51', 3, 'your-design-shirt'),
(13, 'Hipster Jeans', '380.20', 'jeans', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, aspernatur.', '611c945d7d4f8-Hipster Jeans.jpg', '2021-08-17 21:02:21', '2021-08-17 21:02:21', 3, 'hipster-jeans'),
(14, 'Pink 2020 Style Swim Suit', '399.20', 'swimming suit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, aspernatur.', '611c948d5a5c2-Pink 2020 Style Swim Suit.jpg', '2021-08-17 21:03:09', '2021-08-17 21:03:09', 3, 'pink-2020-style-swim-suit'),
(15, 'Ordinary shirt', '24.80', 't-shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, aspernatur.', '611c94a951161-Ordinary shirt.jpg', '2021-08-17 21:03:37', '2021-08-17 21:03:37', 3, 'ordinary-shirt'),
(16, 'Dark Skinny', '142.20', 'jeans', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, aspernatur.', '611c94c7e1ce1-Dark Skinny.jpg', '2021-08-17 21:04:07', '2021-08-17 21:04:07', 3, 'dark-skinny'),
(17, 'Suit 3', '380.20', 'suit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, aspernatur.', '611c94df41cb6-Suit 3.jpg', '2021-08-17 21:04:31', '2021-08-17 21:04:31', 3, 'suit-3'),
(18, 'Visual Art Shirt', '127.00', 't-shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, aspernatur.', '611c94fce7cc1-Visual Art Shirt.jpg', '2021-08-17 21:05:00', '2021-08-17 21:05:00', 3, 'visual-art-shirt'),
(19, 'Navy Blue', '60.99', 't-shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, aspernatur.', '611c952434b8d-Navy Blue.jpg', '2021-08-17 21:05:40', '2021-08-17 21:05:40', 3, 'navy-blue');

-- --------------------------------------------------------

--
-- Table structure for table `quantities`
--

CREATE TABLE `quantities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quantities`
--

INSERT INTO `quantities` (`id`, `product_id`, `size`, `quantity`) VALUES
(1, 1, 'S', 10),
(2, 2, 'M', 28),
(3, 3, 'S', 100),
(4, 4, 'L', 40),
(5, 5, 'S', 10),
(6, 6, 'M', 2),
(7, 7, 'XL', 25),
(8, 8, 'XL', 33),
(9, 9, 'M', 100),
(10, 10, 'XL', 60),
(11, 11, 'XL', 70),
(12, 12, 'L', 100),
(13, 13, 'M', 10),
(14, 14, 'L', 28),
(15, 15, 'XL', 100),
(16, 16, 'S', 66),
(17, 17, 'L', 10),
(18, 18, 'M', 4),
(19, 19, 'XL', 100);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_Path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `address`, `gender`, `contact`, `dob`, `level`, `image_Path`) VALUES
(1, 'Mohamad Luqman bin Ahmad', 'luqmanahmad5149@gmail.com', NULL, '$2y$10$7e5CR2zc2t6V8GQin24if.j8.NHJhRIVBetYTY4kuI69qW3tjtc32', 'D4U2LsCcuJSRrbkLDIi2qD2zsWhV0VX6L5JTQQ3T48R8Oct3Hsfz7vPPVifR', '2021-05-17 05:23:24', '2021-05-17 05:23:24', '', NULL, NULL, NULL, 'user', NULL),
(2, 'Luqman Ahmad', 'luqmanahmad@gmail.com', NULL, '$2y$10$r5O5y1cherclqQ5WWxlX..84cVa7e1JA.xJUNmFRIkDxsS19bpRyC', 'YnaIFl0wjw7JGuS4PSlvZbWRu64i3604uggvkNkhG5S5OYEmWLb6r1evTfLg', '2021-06-15 03:34:33', '2021-06-15 03:34:33', 'Taman bahtera, 35900 Tanjong Malim, Perak', 'Female', 194853341, '2021-07-15', 'admin', '610ff46cbebb5-Luqman Ahmad.jpg'),
(3, 'Ali Babas', 'alibaba@gmail.com', NULL, '$2y$10$vBjOs3RqPQgQis6tkKUVjOl/P23lT4KXUPVsSL0gGlejXugwPDhMC', NULL, '2021-06-18 21:20:07', '2021-06-18 21:20:07', '1/1 Jalan Setiawangsa, 20 Taman Bersama, 09000, Selangor', 'Female', 144853341, '1988-11-07', 'user', '60dc6a0234e8c-Ali Babas.jpg'),
(4, 'yusuf tayub', 'yusuftayub@yahoo.com', NULL, '$2y$10$K3f9wIjdLGMqJK2Htsx29eEGiiClrGBtLMdzn4W48HyP7CAqsBz3u', 'Z5D86wHCFaq5bOURKs3zkMQkctSEAyF242XOhDUsGHg90qa7yH4GT15kpf7s', '2021-06-29 19:20:07', '2021-06-29 19:20:07', 'Taman Bahtera, Lorong Bahtera 2/2, 35900 Tanjong Malin, Perak', 'Male', 124853341, '1998-02-13', 'user', '60dc66e9d50e3-yusuf tayub.jpg'),
(5, 'Shahron', 'shahron@gmail.com', NULL, '$2y$10$iL8hP8X0F4TudbawzqA81euUCLvQM7BOqvCZyuIwjdL59ABbsawU6', NULL, '2021-08-05 15:19:12', '2021-08-05 15:19:12', NULL, NULL, NULL, NULL, 'user', NULL),
(6, 'Shahron Adli', 'shahron123@gmail.com', NULL, '$2y$10$iKEVpD2ujtnI4L/d.TvG7.zSVeoeT5xAbldFnSZoTK.AInkhPq8AW', NULL, '2021-08-05 15:20:05', '2021-08-05 15:20:05', 'Tanjung Malim, Perak', 'Male', 194853341, '2007-01-05', 'user', '610c72b9d0b0e-Shahron Adli.jpg'),
(7, 'New User', 'newuser@gmail.com', NULL, '$2y$10$YWLE3JdwcVqchUATv.POAeJmYnRf/zRJ3vJ/Q1EHD/wZtYj4SeRmW', NULL, '2021-08-05 16:48:53', '2021-08-05 16:48:53', 'Tanjung Malim, Perak', 'Female', 194853341, '2015-01-05', 'user', '6112413a4e660-New User.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_product_id_foreign` (`product_id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_product_id_foreign` (`product_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_user_id_foreign` (`user_id`);

--
-- Indexes for table `quantities`
--
ALTER TABLE `quantities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quantities_product_id_foreign` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `quantities`
--
ALTER TABLE `quantities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quantities`
--
ALTER TABLE `quantities`
  ADD CONSTRAINT `quantities_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
