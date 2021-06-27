-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2021 at 07:40 AM
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(23, 9, 2, '2021-06-22 06:49:52', '2021-06-22 06:49:52'),
(24, 13, 2, '2021-06-22 06:49:55', '2021-06-22 06:49:55'),
(25, 10, 2, '2021-06-22 06:50:00', '2021-06-22 06:50:00');

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
(10, '2021_06_20_085102_add_address_to_users_table', 5);

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `user_id`, `address`, `payment_method`, `payment_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 18, 2, '441 jalan damai', 'debit/credit card', 'Succesful', 'On Delivery', '2021-06-19 21:43:46', '2021-06-19 21:43:46'),
(2, 17, 2, '441 jalan damai', 'debit/credit card', 'Succesful', 'On Delivery', '2021-06-19 21:43:46', '2021-06-19 21:43:46'),
(3, 16, 2, '441 jalan damai', 'debit/credit card', 'Succesful', 'On Delivery', '2021-06-19 21:43:46', '2021-06-19 21:43:46'),
(4, 18, 3, 'taman damai 09400', 'banking app', 'Succesful', 'On Delivery', '2021-06-19 21:45:07', '2021-06-19 21:45:07'),
(5, 17, 3, 'taman damai 09400', 'banking app', 'Succesful', 'On Delivery', '2021-06-19 21:45:07', '2021-06-19 21:45:07'),
(6, 15, 3, 'taman damai 09400', 'banking app', 'Succesful', 'On Delivery', '2021-06-19 21:45:07', '2021-06-19 21:45:07'),
(7, 13, 2, 'Jalan damai', 'online banking', 'Succesful', 'On Delivery', '2021-06-19 22:26:35', '2021-06-19 22:26:35'),
(8, 9, 2, 'Jalan damai', 'online banking', 'Succesful', 'On Delivery', '2021-06-19 22:26:35', '2021-06-19 22:26:35'),
(9, 15, 2, 'Taman bahtera, 35900 Tanjong Malim, Perak', 'debit/credit card', 'Succesful', 'On Delivery', '2021-06-21 23:21:19', '2021-06-21 23:21:19'),
(10, 15, 2, 'Taman bahtera, 35900 Tanjong Malim, Perak', 'debit/credit card', 'Succesful', 'On Delivery', '2021-06-21 23:21:19', '2021-06-21 23:21:19'),
(11, 15, 2, 'Taman bahtera, 35900 Tanjong Malim, Perak', 'debit/credit card', 'Succesful', 'On Delivery', '2021-06-21 23:23:16', '2021-06-21 23:23:16');

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
(7, 'Grey cotton shirt', '24.80', 't-shirt', 'Ordinary shirt with nothing special about it', '60cb352433188-Grey shirt.jpg', '2021-06-17 03:42:28', '2021-06-17 04:59:14', 2, 'grey-cotton-shirt'),
(9, 'Navy Blue Polo shirt', '127.00', 't-shirt', 'Make hot weather hotter', '60cb369d8fa80-Navy Blue Polo shirt.jpg', '2021-06-17 03:48:45', '2021-06-17 03:48:45', 2, 'navy-blue-polo-shirt'),
(10, 'Blue cool swim suit', '253.40', 'swimming suit', 'Female swimsuit which is made from pure elastic hybrid that suit any ages', '60cb36ff2a6c9-Blue cool swim suit.jpg', '2021-06-17 03:50:23', '2021-06-17 03:50:23', 2, 'blue-cool-swim-suit'),
(11, 'Trekking Pant v2', '60.89', 'trouser', 'Durable trekking pant', '60cb4a46c25b6-Trekking Pant v2.jpg', '2021-06-17 05:12:38', '2021-06-17 05:12:38', 2, 'trekking-pant-v2'),
(12, 'Long sleeve shirt', '148.50', 't-shirt', 'Suitable to wear for class', '60cb4a85481d1-Long sleeve shirt.jpg', '2021-06-17 05:13:41', '2021-06-17 05:13:41', 2, 'long-sleeve-shirt'),
(13, 'Uniqlo Mask', '30.00', 'airism', 'Mask that protect from germ', '60cb4b026529f-Uniqlo Mask.jpg', '2021-06-17 05:15:46', '2021-06-17 05:15:46', 2, 'uniqlo-mask'),
(14, 'Adidas Swim Suit', '507.20', 'swimming suit', 'Sport swimsuit for women team', '60cb4d38b3258-Adidas Swim Suit.jpg', '2021-06-17 05:25:12', '2021-06-17 05:25:12', 2, 'adidas-swim-suit'),
(15, 'Barcode Shirt', '49.99', 'airism', 'Try to scan it *wink*', '60cb4d64e7127-Barcode Shirt.jpg', '2021-06-17 05:25:56', '2021-06-17 05:25:56', 2, 'barcode-shirt'),
(16, 'Black cool', '180.60', 'swimming suit', 'Swimsuit for your mom', '60cb4d8dd79f9-Black cool.jpg', '2021-06-17 05:26:37', '2021-06-17 05:26:37', 2, 'black-cool'),
(17, 'Leaves coloured shirt', '60.89', 'airism', 'Nothing beat simple green', '60cb4db7dafd6-Leaves coloured shirt.jpg', '2021-06-17 05:27:19', '2021-06-17 05:27:19', 2, 'leaves-coloured-shirt'),
(18, 'Original Lee Cooper', '380.20', 'jeans', 'Good old pant', '60cb5949a6ba3-Original Lee Cooper.jpg', '2021-06-17 06:16:41', '2021-06-17 06:16:41', 2, 'original-lee-cooper');

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
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `address`) VALUES
(1, 'Mohamad Luqman bin Ahmad', 'luqmanahmad5149@gmail.com', NULL, '$2y$10$7e5CR2zc2t6V8GQin24if.j8.NHJhRIVBetYTY4kuI69qW3tjtc32', 'D4U2LsCcuJSRrbkLDIi2qD2zsWhV0VX6L5JTQQ3T48R8Oct3Hsfz7vPPVifR', '2021-05-17 05:23:24', '2021-05-17 05:23:24', ''),
(2, 'Luqman Ahmad', 'luqmanahmad@gmail.com', NULL, '$2y$10$r5O5y1cherclqQ5WWxlX..84cVa7e1JA.xJUNmFRIkDxsS19bpRyC', 'd2TfLcZ4Ha1lzeHsjS7HU5RJnThaHDO3YN6l33F1cxJv2aDuMY7ZE2BW5ks1', '2021-06-15 03:34:33', '2021-06-15 03:34:33', 'Taman bahtera, 35900 Tanjong Malim, Perak'),
(3, 'Ali Baba', 'alibaba@gmail.com', NULL, '$2y$10$vBjOs3RqPQgQis6tkKUVjOl/P23lT4KXUPVsSL0gGlejXugwPDhMC', NULL, '2021-06-18 21:20:07', '2021-06-18 21:20:07', 'jalan damai indah, padang serai');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
