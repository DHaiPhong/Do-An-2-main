-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2023 at 04:25 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_ban_giay`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `brand`) VALUES
(1, 'Nike'),
(2, 'Adidas'),
(3, 'Puma');

-- --------------------------------------------------------

--
-- Table structure for table `imgprds`
--

CREATE TABLE `imgprds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prd_id` bigint(20) UNSIGNED NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2016_01_04_173148_create_admin_tables', 1),
(3, '2022_12_30_031558_prd_detail', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(6, '2023_01_07_073711_create_category_table', 2),
(7, '2023_01_07_073939_create_product_table', 3),
(8, '2023_01_07_075725_create_prd_detail_table', 4),
(9, '2023_01_09_025225_create_users_table', 5),
(10, '2014_10_12_100000_create_password_resets_table', 6),
(11, '2023_01_09_032438_create_users_table', 7),
(12, '2023_01_09_032606_create_users_table', 8),
(13, '2023_01_09_040506_create_orders_table', 9),
(14, '2023_01_09_041141_add_colunm_phone_to_user_talbe', 9),
(15, '2023_01_09_151001_create_order_items_table', 10),
(16, '2023_01_09_151709_edit_users_table', 10),
(17, '2023_01_10_020611_add_email_ordertable', 11),
(18, '2023_01_10_022947_create_products_table', 12),
(19, '2023_01_10_023001_create_product_details_table', 12),
(20, '2023_01_10_024125_create_product_details_table', 13),
(21, '2023_01_10_024252_add_price_prd', 13),
(22, '2023_01_12_150853_create_imgprds_table', 14),
(23, '2023_01_12_152312_add_sold_colum_product', 15),
(24, '2023_01_12_153035_delete_sold_colum_product', 16),
(25, '2023_01_12_153138_add_sold_colum_prddietail', 17);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','processing','completed','cancel') NOT NULL DEFAULT 'pending',
  `grand_total` decimal(20,3) NOT NULL,
  `item_count` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `city` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `user_id`, `status`, `grand_total`, `item_count`, `name`, `address`, `phone_number`, `created_at`, `updated_at`, `email`, `note`, `city`) VALUES
(6, 'ORD-63BD1BA714062', 3, 'pending', '500.000', 3, 'Tu', 'so 1 duong A 2', '0956498654', '2023-01-10 01:02:47', '2023-01-10 01:02:47', '', '', ''),
(7, 'ORD-63BDC49FC6C7B', 4, 'completed', '100.000', 1, 'Nguyen ngoc tu', 'Nhà A17, Tầng 02, Số 17 P. Tạ Quang Bửu, Bách Khoa, Hai Bà Trưng', '09999999999 2', '2023-01-10 13:03:43', '2023-01-10 13:03:43', '', '', ''),
(24, 'ORD-63BDCF3C10138', 4, 'processing', '100.000', 1, 'Nguyen ngoc tu', 'Nhà A17, Tầng 02, Số 17 P. Tạ Quang Bửu, Bách Khoa, Hai Bà Trưng', '09999999999 2', '2023-01-10 13:49:00', '2023-01-10 13:49:00', '', '', ''),
(25, 'ORD-63BDD07B584A4', 4, 'cancel', '100.000', 1, 'Nguyen ngoc tu', 'Nhà A17, Tầng 02, Số 17 P. Tạ Quang Bửu, Bách Khoa, Hai Bà Trưng', '0956498654', '2023-01-10 13:54:19', '2023-01-10 13:54:19', '', '', ''),
(26, 'ORD-63BDD314ABA8E', 4, 'cancel', '100.000', 1, 'Nguyen ngoc tu', 'Nhà A17, Tầng 02, Số 17 P. Tạ Quang Bửu, Bách Khoa, Hai Bà Trưng', '0956498654', '2023-01-10 14:05:24', '2023-01-10 14:05:24', '', '', ''),
(27, 'ORD-63BDD35244881', 4, 'pending', '100.000', 1, 'Nguyen ngoc tu', 'Nhà A17, Tầng 02, Số 17 P. Tạ Quang Bửu, Bách Khoa, Hai Bà Trưng', '09999999999 2', '2023-01-10 14:06:26', '2023-01-10 14:06:26', '', '', ''),
(28, 'ORD-63BDD48FE1DFF', 4, 'pending', '100.000', 1, 'Nguyen ngoc tu', 'Nhà A17, Tầng 02, Số 17 P. Tạ Quang Bửu, Bách Khoa, Hai Bà Trưng', '09999999999 2', '2023-01-10 14:11:43', '2023-01-10 14:11:43', '', '', ''),
(29, 'ORD-63BDD4DE43F77', 4, 'pending', '100.000', 1, 'Nguyen ngoc tu', 'so 1 duong A 2', '09999999999 2', '2023-01-10 14:13:02', '2023-01-10 14:13:02', '', '', ''),
(30, 'ORD-63BDD57339D90', 4, 'pending', '100.000', 1, 'Nguyen ngoc tu', 'Nhà A17, Tầng 02, Số 17 P. Tạ Quang Bửu, Bách Khoa, Hai Bà Trưng', '099dk', '2023-01-10 14:15:31', '2023-01-10 14:15:31', '', '', ''),
(31, 'ORD-63BDD5C2A5CB6', 4, 'pending', '100.000', 1, 'Nguyen ngoc tu', 'Nhà A17, Tầng 02, Số 17 P. Tạ Quang Bửu, Bách Khoa, Hai Bà Trưng', '099dk', '2023-01-10 14:16:50', '2023-01-10 14:16:50', '', '', ''),
(32, 'ORD-63BDD5E973167', 4, 'completed', '500.000', 3, 'Nguyen ngoc tu', 'so 1 duong A 2', '099999999992', '2023-01-10 14:17:29', '2023-01-10 14:17:29', '', '', ''),
(33, 'ORD-63BDD6AC20740', 4, 'completed', '2.000', 16, 'Nguyen ngoc tu', 'Nhà A17, Tầng 02, Số 17 P. Tạ Quang Bửu, Bách Khoa, Hai Bà Trưng', '09999999999 2', '2023-01-10 14:20:44', '2023-01-10 14:20:44', '', '', ''),
(34, 'ORD-63BEE6B0D30FD', 7, 'cancel', '4.000', 15, 'Admin', 'test', '0956498654', '2023-01-11 09:41:20', '2023-01-11 09:41:20', '', '', ''),
(35, 'ORD-63C03BB1DCF5D', 7, 'cancel', '100.000', 1, 'Admin', 'Nhà A17, Tầng 02, Số 17 P. Tạ Quang Bửu, Bách Khoa, Hai Bà Trưng', '09999999999 2', '2023-01-12 09:56:17', '2023-01-12 09:56:17', '', '', ''),
(36, 'ORD-63C9765FE5FBF', 2, 'pending', '600.000', 6, 'ewrsefsdf', 'HP', '90809', '2023-01-19 09:57:03', '2023-01-19 09:57:03', '', '', ''),
(37, 'ORD-63DA8741730D3', 2, 'pending', '100.000', 1, 'ewrsefsdf', 'HP', '90809', '2023-02-01 08:37:37', '2023-02-01 08:37:37', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `price` decimal(20,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(4, 6, 4, 2, '200000', '2023-01-10 01:02:47', '2023-01-10 01:02:47'),
(5, 6, 7, 1, '300000', '2023-01-10 01:02:47', '2023-01-10 01:02:47'),
(6, 7, 4, 1, '100000', '2023-01-10 13:03:43', '2023-01-10 13:03:43'),
(11, 24, 4, 1, '100000', '2023-01-10 13:49:00', '2023-01-10 13:49:00'),
(12, 25, 4, 1, '100000', '2023-01-10 13:54:19', '2023-01-10 13:54:19'),
(13, 26, 4, 1, '100000', '2023-01-10 14:05:24', '2023-01-10 14:05:24'),
(14, 27, 4, 1, '100000', '2023-01-10 14:06:26', '2023-01-10 14:06:26'),
(15, 28, 4, 1, '100000', '2023-01-10 14:11:43', '2023-01-10 14:11:43'),
(16, 29, 4, 1, '100000', '2023-01-10 14:13:02', '2023-01-10 14:13:02'),
(17, 30, 1, 1, '100000', '2023-01-10 14:15:31', '2023-01-10 14:15:31'),
(18, 31, 4, 1, '100000', '2023-01-10 14:16:50', '2023-01-10 14:16:50'),
(19, 32, 4, 1, '100000', '2023-01-10 14:17:29', '2023-01-10 14:17:29'),
(20, 32, 2, 1, '100000', '2023-01-10 14:17:29', '2023-01-10 14:17:29'),
(21, 32, 7, 1, '300000', '2023-01-10 14:17:29', '2023-01-10 14:17:29'),
(22, 33, 4, 9, '900000', '2023-01-10 14:20:44', '2023-01-10 14:20:44'),
(23, 33, 2, 3, '300000', '2023-01-10 14:20:44', '2023-01-10 14:20:44'),
(24, 33, 7, 4, '1200000', '2023-01-10 14:20:44', '2023-01-10 14:20:44'),
(25, 34, 7, 5, '1500000', '2023-01-11 09:41:20', '2023-01-11 09:41:20'),
(26, 34, 9, 10, '3200000', '2023-01-11 09:41:20', '2023-01-11 09:41:20'),
(27, 35, 1, 1, '100000', '2023-01-12 09:56:17', '2023-01-12 09:56:17'),
(28, 36, 4, 5, '500000', '2023-01-19 09:57:03', '2023-01-19 09:57:03'),
(29, 36, 1, 1, '100000', '2023-01-19 09:57:03', '2023-01-19 09:57:03'),
(30, 37, 4, 1, '100000', '2023-02-01 08:37:37', '2023-02-01 08:37:37');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('ngoctu@gmail.com', '$2y$10$erZpJoGewYezTWSL0V6YGuglaxBAtDbJoMbelofSz5SZ7syKTVSDW', '2023-01-09 10:10:30');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prd_id` bigint(20) UNSIGNED NOT NULL,
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `prd_name` varchar(255) NOT NULL,
  `prd_details` text NOT NULL,
  `prd_sale` int(11) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prd_id`, `cat_id`, `prd_name`, `prd_details`, `prd_sale`, `price`) VALUES
(1, 2, 'Jordan 1 Retro High OG1', 'The original Air Jordan 1 Chicago colorway was first introduced in 1985 and has only been retroed a few times since. But 2022 is the year that the colorway returns with an added vintage look. Pre-yellowed accents and cracked leather uppers showcase a fabricated look of age and wear. The Air Jordan 1 Lost and Found Chicago released in November of 2022 for $180.', 0, 100000),
(2, 1, 'Nike Air Force 1 \'07', 'The radiance lives on with the b-ball original. Crossing hardwood comfort with off-court flair, it puts a fresh spin on what you know best: \'80s-inspired construction, bold details and nothin\'-but-net style.', 0, 300000),
(3, 1, 'Nike Dunk Low Unlocked By You', 'We are seeing volatility in global supply chains and are unable to guarantee delivery. But your Nike By You order is important to us, and we expect your custom-made product to arrive within 4 weeks.', 0, 320000),
(4, 2, 'NMD_V3 SHOES', 'COMFORTABLE PERFORATED SHOES MADE IN PART WITH PARLEY OCEAN PLASTIC.\r\nGo ahead and check all the boxes with these adidas NMD_V3 Shoes. Breathable. Comfortable. Made with recycled materials. That\'s a yes to all three. Plus there\'s the style', 0, 280000),
(5, 3, 'Clyde Core Foil Men\'s Sneakers', 'Pay tribute to a legend in this gold edition Clyde. Inspired by the legend himself, we created the PUMA Clyde back in 1973 just.', 0, 250000),
(6, 2, 'HOOPS 3.0 MID CLASSIC WORLD FRIENDSHIP DAY SHOES', 'CUSTOMIZE THESE PLAYFUL SNEAKERS MADE IN PART WITH RECYCLED CONTENT.\r\nThese mid-cut shoes combine classic basketball elements with details that are uniquely adidas. Note the detachable logo patch on the heel that can be swapped with your bestie\'s in honor', 0, 250000),
(7, 1, 'Jordan 1', 'CUSTOMIZE THESE PLAYFUL SNEAKERS MADE IN PART WITH RECYCLED CONTENT.\r\nThese mid-cut shoes combine classic basketball elements with details that are uniquely adidas. Note the detachable logo patch on the heel that can be swapped with your bestie\'s in honor', 0, 250000),
(10, 1, 'Nike Air Max 90 SE', 'Nothing as fly, nothing as comfortable, nothing as proven. The Nike Air Max 90 stays true to its roots with its iconic Waffle outsole, durable stitched overlays and classic plastic accents. A mix of navy, blue and silver adds a touch of sporty retro style to this special edition while visible Max Air keeps the comfortable cushioning you love.', 0, 200000),
(11, 1, 'Air Jordan 1 Zoom Comfort 2', 'Premium suede and Jordan Brand\'s signature Formula 23 foam come together to give you an extra-luxurious (and extra-cosy) AJ1. You don\'t need to play \"either or\" when it comes to choosing style or comfort with this one—which is nice, \'cause you deserve both.', 0, 430000),
(12, 1, 'Air Jordan 1 Mid', 'The Air Jordan 1 Mid brings full-court style and premium comfort to an iconic look. Its Air-Sole unit cushions play on the hardwood, while the padded collar gives you a supportive feel.', 0, 3669000),
(13, 1, 'Air Jordan 1 Mid SE', 'Tis the season for festive-inspired Js, and this pair takes its cues from a classic Christmas tree—the Blue Spruce. Rich-grain leather and woven fabrics will elevate any streetwear outfit, while a buttery-soft interior and Air in the heel add soft comforts.\r\n\r\n', 0, 3829000),
(14, 1, 'Suede Classic XXI Men\'s Sneakers', 'The Suede hit the scene in 1968 and has been changing the game ever since. It’s been worn by icons of every generation, and it’s stayed classic through it all. Instantly recognizable and constantly reinvented, Suede’s legacy continues to grow and be legitimized by the authentic and expressive individuals that embrace the iconic shoe. Be apart of the history of Suede, for all time.\r\n', 0, 2430000),
(15, 1, 'Nike Air Max 90 LTR', 'Lace up and feel the legacy with the Nike Air Max 90 LTR. An iconic Waffle outsole and moulded plastic accents help these kicks stay true to their roots, while Max Air cushioning adds comfort to your every step. Crisp leather and soft, textured suede bring a premium look and feel to this classic sneaker.\r\n', 0, 4109000),
(16, 1, 'Nike Alphafly 2', 'Once you take a few strides in the Nike Alphafly 2, you\'ll never look at your favourite pair of old\r\n                    racing shoes in the same way. These rocket ships are made to help shave precious time off your personal\r\n                    records without surrendering the foundation you need to go the full distance. A thick, lightweight\r\n                    support system brings comfort and speed together so you can enjoy our greatest energy return while you\r\n                    chase your personal bests.\r\n', 0, 8369000);

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `prd_detail_id` bigint(20) UNSIGNED NOT NULL,
  `prd_id` bigint(20) UNSIGNED NOT NULL,
  `prd_image` varchar(255) NOT NULL,
  `prd_color` varchar(255) NOT NULL,
  `prd_size` int(11) NOT NULL,
  `prd_amount` int(11) NOT NULL,
  `sold` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`prd_detail_id`, `prd_id`, `prd_image`, `prd_color`, `prd_size`, `prd_amount`, `sold`) VALUES
(1, 1, 'Jordan_1_Retro_High_OG.png', 'red', 40, 2, 2),
(2, 1, 'Jordan_1_Retro_High_OG.png', 'red', 41, 10, 0),
(3, 1, 'Jordan_1_Retro_High_OG.png', 'red', 42, 10, 0),
(4, 1, 'Jordan_1_Retro_High_OG_yellow.png', 'yellow', 40, 4, 6),
(5, 1, 'Jordan_1_Retro_High_OG_yellow.png', 'yellow', 41, 10, 0),
(6, 1, 'Jordan_1_Retro_High_OG_yellow.png', 'yellow', 42, 10, 0),
(7, 2, 'Nike Air Force 1 \'07.png', 'white', 40, 0, 0),
(8, 2, 'Nike Air Force 1 \'07.png', 'white', 41, 10, 0),
(9, 3, 'Nike_Dunk_Low_Unlocked_By_You.png', 'black', 40, 0, 0),
(10, 4, 'NMD_V3 SHOES.png', 'black', 40, 10, 0),
(11, 4, 'NMD_V3 SHOES.png', 'black', 41, 10, 0),
(12, 5, 'Clyde-Core-Foil-Men\'s-Sneakers.png', 'black', 41, 10, 0),
(13, 5, 'Clyde-Core-Foil-Men\'s-Sneakers.png', 'black', 42, 10, 0),
(14, 6, 'Hoops_3.0_Mid_Classic_World_Friendship_Day_Shoes_White_GX7235_01_standard.png', 'white', 40, 10, 0),
(15, 1, 'jordan1.png', 'red', 40, 10, 0),
(17, 10, 'nikeairmax90se.png', 'Blue', 40, 10, 0),
(19, 11, 'Air Jordan 1 Zoom Comfort 2.png', 'Brown', 43, 10, 0),
(20, 12, 'Air Jordan 1 Mid.png', 'RED', 42, 10, 0),
(21, 13, 'Air Jordan 1 Mid SE.png', 'GREEN', 41, 10, 0),
(22, 14, 'Suede-Classic-XXI-Men\'s-Sneakers.png', 'RED', 43, 10, 0),
(23, 15, 'nikeairmax90LTR.png', 'White Brown', 40, 10, 0),
(24, 16, 'Nike AlphaFly 2.png', 'Green', 40, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `level`, `address`, `created_at`, `updated_at`, `phone`, `status`) VALUES
(1, 'Tu', 'ngoctu@gmail.com', '$2y$10$HSZftKK9/yun/L69A4y8Wu6I3rEk9Hde/SALqEFZCZy.zfUb7VdP. ', 1, 'Nhà A17, Tầng 02, Số 17 P. Tạ Quang Bửu, Bách Khoa, Hai Bà Trưng', '2023-01-08 20:30:21', '2023-01-08 20:30:21', '0123456789', 0),
(2, 'Vu Truong Anh', 'vtra@gmail.com', '$2y$10$GIR9H.ZAqFBVNfy4.GRUken2dsDv1YdNZyl8GAeT/eSsJZevtzu2S', 0, '', '2023-01-09 07:03:11', '2023-01-09 07:03:11', '', 0),
(3, 'Tu', 'ngoctu2@gmail.com', '$2y$10$lnoQgFdqb9x93HnNgOA.eOy/b.YaCkrlHcxO1wza6tMo2kEXIXc8O ', 2, 'Nhà A17, Tầng 02, Số 17 P. Tạ Quang Bửu, Bách Khoa, Hai Bà Trưng', '2023-01-09 10:11:24', '2023-01-09 10:11:24', '0987654321', 0),
(4, 'Nguyen ngoc tu', 'ngoctu3@gmail.com', '$2y$10$5vV5Ru4pFx/43GEx0YZ8wuZ86MDWSVugkD6kqBmn.sgAcnoRKTxlq', 0, '', '2023-01-10 02:10:38', '2023-01-10 02:10:38', '', 0),
(5, 'Tu ngoc', 'ngoctu4@gmail.com', '$2y$10$9jFVQErJ8xSCyG..ydkMHuvtvcG1HFrIZlGvSbGE1qwjGDXdxswYS', 0, '', '2023-01-11 00:46:13', '2023-01-11 00:46:13', '', 0),
(7, 'Admin', 'admin@gmail.com', '$2y$10$4LGzx.3hYYn9N7uYtojTperIHv2G3q5H0nLlOGSqiNsprjesTjhA6', 1, '', '2023-01-11 01:21:56', '2023-01-11 01:21:56', '', 0),
(8, 'test1', 'test4@gmail.com', '$2y$10$ESGAJmit6D2f2ArC3Bf/D.C4itkeb0siL7tVwpa5kcn4t0wBXzhhG', 0, '', '2023-01-11 01:37:13', '2023-01-11 01:37:13', '', 0),
(9, 'Tu', 'test@gmail', '$2y$10$fLuGZithf5cpjmMEqHFrPOhx48q3QJbejy7Huw0Lw5V098dXvhJ8K', 0, '', '2023-01-11 01:39:18', '2023-01-11 01:39:18', '', 0),
(10, 'User', 'vtra10@gmail.com', '$2y$10$FgSL9u8MPULH3LsW9lqoYuIywpZbtf4YLH6vttaaY0w4.FK8fHV3K', 0, 'HP', '2023-01-18 07:27:28', '2023-01-18 07:27:28', '90809', 0),
(11, 'Admin', 'Admin1@gmail.com', '$2y$10$5U/9n7urojqO8edH7BWQx.GS7pciIbwPgwEI0NuIUzzrlavD9.fTq', 1, 'HP', '2023-01-18 07:28:25', '2023-01-18 07:28:25', '90809', 0),
(12, 'ewrsefsdf', '112233@gmail.com', '$2y$10$Y01pMjFrfmEt3G3KKhdjsu.n9TksoBE3.tbVzKcQWNA72A2m.OIw.', 0, 'HP', '2023-01-18 07:33:43', '2023-01-18 07:33:43', '90809', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imgprds`
--
ALTER TABLE `imgprds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imgprds_prd_id_foreign` (`prd_id`);

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
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_index` (`order_id`),
  ADD KEY `order_items_product_id_index` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prd_id`),
  ADD KEY `products_cat_id_foreign` (`cat_id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`prd_detail_id`),
  ADD KEY `product_details_prd_id_foreign` (`prd_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `imgprds`
--
ALTER TABLE `imgprds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prd_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `prd_detail_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `imgprds`
--
ALTER TABLE `imgprds`
  ADD CONSTRAINT `imgprds_prd_id_foreign` FOREIGN KEY (`prd_id`) REFERENCES `products` (`prd_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product_details` (`prd_detail_id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `product_details_prd_id_foreign` FOREIGN KEY (`prd_id`) REFERENCES `products` (`prd_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
