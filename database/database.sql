-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2024 at 07:53 AM
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
-- Database: `tech_exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barangay` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `middle_name`, `last_name`, `full_name`, `street`, `barangay`, `city`, `full_address`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Kenneth', 'Rey', 'Hontucan', 'Kenneth Rey Hontuacn', '123', 'Dummy', 'Makati', '123 Dummy Makati', 1, 1, '2024-11-04 00:45:25', '2024-11-04 00:45:25'),
(6, 'Austin', 'Wallace Eaton', 'Skinner', 'Austin Wallace Eaton Skinner', 'Do perspiciatis quo', 'Ratione Nam aliquam', 'Aperiam aut non aut', 'Do perspiciatis quo Ratione Nam aliquam Aperiam aut non aut', 1, NULL, NULL, NULL),
(7, 'Fay', 'Riley Wilson', 'Melton', 'Fay Riley Wilson Melton', 'Cillum consequat Eu', 'Vel reprehenderit fu', 'Impedit exercitatio', 'Cillum consequat Eu Vel reprehenderit fu Impedit exercitatio', 1, NULL, NULL, NULL),
(19, 'Maisie', 'Yardley Snow', 'Mejia', 'Maisie Yardley Snow Mejia', 'Voluptatum commodo n', 'Quaerat reprehenderi', 'Cumque quos ea disti', 'Voluptatum commodo n Quaerat reprehenderi Cumque quos ea disti', 2, NULL, NULL, NULL);

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
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `invoice_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_date` date NOT NULL,
  `discount` decimal(11,2) DEFAULT NULL,
  `vat` decimal(11,2) NOT NULL,
  `subtotal` decimal(11,2) NOT NULL,
  `grand_price` decimal(11,2) NOT NULL,
  `balance` decimal(11,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `customer_id`, `invoice_number`, `invoice_date`, `discount`, `vat`, `subtotal`, `grand_price`, `balance`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, '0001', '2024-11-03', '0.00', '240.00', '2000.00', '2240.00', '0.00', 1, 1, '2024-11-04 00:45:25', '2024-11-05 20:04:02'),
(2, 1, '0002', '2024-11-03', '0.00', '240.00', '2000.00', '2240.00', '2240.00', 1, 1, '2024-11-04 00:45:25', '2024-11-04 00:45:25'),
(4, 1, '0004', '2024-12-04', '100.00', '352.20', '3035.00', '3287.20', '3287.20', 1, NULL, '2024-11-06 00:34:56', '2024-11-06 00:34:56');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `base_price` decimal(11,2) NOT NULL,
  `subtotal` decimal(11,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customer_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `invoice_id`, `product_type`, `product_name`, `product_qty`, `base_price`, `subtotal`, `created_by`, `updated_by`, `created_at`, `updated_at`, `customer_id`) VALUES
(1, 1, 'Type 1', 'B', '1', '2000.00', '2000.00', 1, 1, '2024-11-04 00:45:25', '2024-11-04 00:45:25', 1),
(2, 2, 'Type 1', 'B', '1', '1000.00', '1000.00', 1, 1, '2024-11-04 00:45:25', '2024-11-04 00:45:25', 1),
(3, 2, 'Type 1', 'EWQ', '1', '1000.00', '1000.00', 1, 1, '2024-11-04 00:45:25', '2024-11-04 00:45:25', 1),
(5, 4, 'Type 1', 'Item 1', '1', '1000.00', '1000.00', 1, NULL, NULL, NULL, 1),
(6, 4, 'Type 1', 'Item 2', '1', '2035.00', '2035.00', 1, NULL, NULL, NULL, 1);

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
(85, '2014_10_12_000000_create_users_table', 1),
(86, '2014_10_12_100000_create_password_resets_table', 1),
(87, '2019_08_19_000000_create_failed_jobs_table', 1),
(88, '2024_10_23_051557_create_customers_table', 1),
(89, '2024_10_23_051904_create_invoices_table', 1),
(90, '2024_10_23_051931_create_invoice_details_table', 1),
(91, '2024_11_03_075636_create_payments_table', 1),
(92, '2024_11_06_033944_add_role_to_users_table', 2),
(93, '2024_11_06_130418_add_customer_id_to_users_table', 3);

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `or_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_paid` decimal(11,2) NOT NULL,
  `current_balance` decimal(11,2) NOT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `invoice_id`, `customer_id`, `payment_date`, `payment_number`, `or_no`, `amount_paid`, `current_balance`, `payment_type`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-11-03', '0001', '158156', '750.00', '2240.00', 'Credit Card', 1, 1, '2024-11-04 00:45:25', '2024-11-04 00:45:25'),
(2, 1, 1, '2024-11-03', '0002', '158156', '750.00', '1490.00', 'Credit Card', 1, 1, '2024-11-04 00:45:25', '2024-11-04 00:45:25'),
(3, 1, 1, '2024-11-06', '0003', '84898', '740.00', '740.00', 'Bank Transfer', 1, NULL, '2024-11-05 20:04:02', '2024-11-05 20:04:02');

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
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'ken', 'ken@test.com', NULL, '$2y$10$EiGQ2g0eQKqdBM9WCOoyle.0fFG78u8j4.nYFMGP8QP.mbA12/9KK', NULL, '2024-11-05 05:55:23', '2024-11-05 05:55:23', 'admin'),
(2, 'user', 'user@test.com', NULL, '$2y$10$.KcDBW1X6To1okZvwcicoeWYAH5ipIjpBKIk67FuiBjtKFQXCSAlO', NULL, '2024-11-06 05:58:00', '2024-11-06 05:58:00', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
