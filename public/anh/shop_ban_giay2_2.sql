-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 02, 2023 lúc 06:30 AM
-- Phiên bản máy phục vụ: 10.4.25-MariaDB
-- Phiên bản PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shop_ban_giay`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `brand`) VALUES
(1, 'Nike'),
(2, 'Adidas'),
(3, 'Puma');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `imgprds`
--

CREATE TABLE `imgprds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prd_id` bigint(20) UNSIGNED NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `imgprds`
--

INSERT INTO `imgprds` (`id`, `prd_id`, `img`) VALUES
(1, 1, 'Basket-Classic-XXI-Men\'s-Sneakers.png'),
(2, 1, 'Clyde-Core-Foil-Men\'s-Sneakers.png'),
(3, 1, 'FORUM LOW SHOES.png'),
(4, 1, 'Jordan_1_Retro_High_OG.png'),
(5, 1, 'Jordan_1_Retro_High_OG_yellow.png'),
(6, 1, 'Nike Air Force 1 \'07.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
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
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','processing','completed','cancel') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `grand_total` decimal(20,3) NOT NULL,
  `item_count` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `user_id`, `status`, `grand_total`, `item_count`, `name`, `address`, `phone_number`, `created_at`, `updated_at`, `email`, `note`, `city`) VALUES
(6, 'ORD-63BD1BA714062', 3, 'pending', '500.000', 3, 'Tu', 'so 1 duong A 2', '0956498654', '2023-01-10 01:02:47', '2023-01-10 01:02:47', '', '', ''),
(36, 'ORD-63C9F064E801F', 16, 'processing', '750.000', 3, 'Admin', 'so 1 duong A 2', '0999999999', '2023-01-19 18:37:40', '2023-01-19 18:37:40', '', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
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
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(4, 6, 4, 2, '200000', '2023-01-10 01:02:47', '2023-01-10 01:02:47'),
(5, 6, 7, 1, '300000', '2023-01-10 01:02:47', '2023-01-10 01:02:47'),
(28, 36, 13, 3, '750000', '2023-01-19 18:37:40', '2023-01-19 18:37:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('ngoctu@gmail.com', '$2y$10$erZpJoGewYezTWSL0V6YGuglaxBAtDbJoMbelofSz5SZ7syKTVSDW', '2023-01-09 10:10:30'),
('ngoctu152k2@gmail.com', '$2y$10$vHDL46MAIYibBUFOfNsQBe2KSI1lfVoEFTa87tj2O/JRiKrBShYgy', '2023-01-15 09:35:02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `prd_detail`
--

CREATE TABLE `prd_detail` (
  `prd_detail_id` bigint(20) UNSIGNED NOT NULL,
  `prd_id` bigint(20) UNSIGNED NOT NULL,
  `prd_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prd_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prd_size` int(11) NOT NULL,
  `prd_price` int(11) NOT NULL,
  `prd_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `prd_detail`
--

INSERT INTO `prd_detail` (`prd_detail_id`, `prd_id`, `prd_image`, `prd_color`, `prd_size`, `prd_price`, `prd_amount`) VALUES
(1, 1, 'Jordan_1_Retro_High_OG.png', 'red', 40, 1000000, 10),
(2, 1, 'Jordan_1_Retro_High_OG.png', 'red', 41, 100000, 10),
(3, 1, 'Jordan_1_Retro_High_OG.png', 'red', 42, 100000, 10),
(4, 1, 'Jordan_1_Retro_High_OG_yellow.png', 'yellow', 40, 100000, 10),
(5, 1, 'Jordan_1_Retro_High_OG_yellow.png', 'yellow', 41, 100000, 10),
(6, 1, 'Jordan_1_Retro_High_OG_yellow.png', 'yellow', 42, 100000, 10),
(10, 2, 'Nike Air Force 1 \'07.png', 'white', 42, 100000, 10),
(11, 3, 'Nike_Dunk_Low_Unlocked_By_You.png', 'Black', 42, 100000, 10),
(12, 4, 'Nike Dunk Low SE.png', 'Smoke', 41, 100000, 10),
(13, 5, 'Hoops_3.0_Mid_Classic_World_Friendship_Day_Shoes_White_GX7235_01_standard.png', 'Cloud White ', 42, 100000, 10),
(14, 6, 'GRAND COURT CLOUDFOAM LIFESTYLE COURT COMFORT SHOES.png', 'White', 41, 100000, 10),
(15, 7, 'FORUM LOW SHOES.png', 'White', 41, 100000, 10),
(16, 8, 'NMD_V3 SHOES.png', 'Black', 41, 100000, 10),
(17, 9, 'Suede-Classic-XXI-Men\'s-Sneakers.png', 'Red', 41, 100000, 10),
(18, 10, 'Clyde-Core-Foil-Men\'s-Sneakers.png', 'Black', 40, 100000, 10),
(19, 11, 'Basket-Classic-XXI-Men\'s-Sneakers.png', 'Black', 40, 100000, 10),
(20, 12, 'Roma-Basic-Sneakers.png', 'White', 40, 100000, 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `prd_id` bigint(20) UNSIGNED NOT NULL,
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `prd_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prd_details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prd_sale` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`prd_id`, `cat_id`, `prd_name`, `prd_details`, `prd_sale`) VALUES
(1, 1, 'Jordan 1 Retro High OG1', 'The original Air Jordan 1 Chicago colorway was first introduced in 1985 and has only been retroed a few times since. But 2022 is the year that the colorway returns with an added vintage look. Pre-yellowed accents and cracked leather uppers showcase a fabr', 0),
(2, 1, 'Nike Air Force 1 \'07', 'The radiance lives on with the b-ball original. Crossing hardwood comfort with off-court flair, it puts a fresh spin on what you know best: \'80s-inspired construction, bold details and nothin\'-but-net style.', 0),
(3, 1, 'Nike Dunk Low Unlocked By You', 'We are seeing volatility in global supply chains and are unable to guarantee delivery. But your Nike By You order is important to us, and we expect your custom-made product to arrive within 4 weeks.', 0),
(4, 1, 'Nike Dunk Low SE', 'Created for the hardwood but taken to the streets, our classic Dunk Low returns with crisp overlays and throwback Nike graphics. This basketball icon channels \'90s vibes with a mix of tricot and jersey in the upper that\'s soft, relaxed and durable. Modern', 0),
(5, 2, 'HOOPS 3.0 MID CLASSIC WORLD FRIENDSHIP DAY SHOES', 'CUSTOMIZE THESE PLAYFUL SNEAKERS MADE IN PART WITH RECYCLED CONTENT.\nThese mid-cut shoes combine classic basketball elements with details that are uniquely adidas. Note the detachable logo patch on the heel that can be swapped with your bestie\'s in honor', 0),
(6, 2, 'GRAND COURT CLOUDFOAM LIFESTYLE COURT COMFORT SHOES', 'ICONIC SNEAKERS YOU CAN WEAR ALL DAY, MADE IN PART WITH RECYCLED MATERIALS.\r\nThere are trends and then there are traditions. These adidas Grand Court sneakers have moved far beyond the court and the catwalk. Now, no wardrobe is complete without them. The ', 0),
(7, 2, 'FORUM LOW SHOES', 'RETRO BASKETBALL STYLE FRESH FROM THE \'80S.\r\nThere\'s no substitute for the real thing. These adidas Forum Low Shoes stay true to the original basketball sneaker that started it all. Their coated leather upper, chunky build and removable strap reflect auth', 0),
(8, 2, 'NMD_V3 SHOES', 'COMFORTABLE PERFORATED SHOES MADE IN PART WITH PARLEY OCEAN PLASTIC.\nGo ahead and check all the boxes with these adidas NMD_V3 Shoes. Breathable. Comfortable. Made with recycled materials. That\'s a yes to all three. Plus there\'s the style, like the perfo', 0),
(9, 3, 'Suede Classic XXI Men\'s Sneakers', 'The Suede hit the scene in 1968 and has been changing the game ever since. It’s been worn by icons of every generation,....', 0),
(10, 3, 'Clyde Core Foil Men\'s Sneakers', 'Pay tribute to a legend in this gold edition Clyde. Inspired by the legend himself, we created the PUMA Clyde back in 1973 just.', 0),
(11, 3, 'Basket Classic XXI Men\'s Sneakers', 'A true classic from the PUMA Archives- the Basket Classic is updated for the 21st century in this fresh iteration. The signature court-inspired style features a clean leather upper, classic PUMA Formstrip and gold metallic PUMA Basket callout at the side ', 0),
(12, 3, 'Roma Basic Sneakers', 'From the 1968 PUMA Archives, the Roma was a lightweight training shoe equipped with a thick, padded tongue and orthopedic arch supports. The Roma returns for the next generation with a smooth synthetic leather upper and clean look and feel.\r\nDETAILS\r\n- Cl', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `prd_id` bigint(20) UNSIGNED NOT NULL,
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `prd_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prd_details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `prd_sale` int(11) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`prd_id`, `cat_id`, `prd_name`, `prd_details`, `prd_sale`, `price`) VALUES
(1, 1, 'Jordan 1 Retro High OG1', 'The original Air Jordan 1 Chicago colorway was first introduced in 1985 and has only been retroed a few times since. But 2022 is the year that the colorway returns with an added vintage look. Pre-yellowed accents and cracked leather uppers showcase a fabricated look of age and wear. The Air Jordan 1 Lost and Found Chicago released in November of 2022 for $180.', 10, 100000),
(2, 1, 'Nike Air Force 1 \'07', 'The radiance lives on with the b-ball original. Crossing hardwood comfort with off-court flair, it puts a fresh spin on what you know best: \'80s-inspired construction, bold details and nothin\'-but-net style.', 0, 300000),
(3, 1, 'Nike Dunk Low Unlocked By You', 'We are seeing volatility in global supply chains and are unable to guarantee delivery. But your Nike By You order is important to us, and we expect your custom-made product to arrive within 4 weeks.', 20, 320000),
(4, 2, 'NMD_V3 SHOES', 'COMFORTABLE PERFORATED SHOES MADE IN PART WITH PARLEY OCEAN PLASTIC.\r\nGo ahead and check all the boxes with these adidas NMD_V3 Shoes. Breathable. Comfortable. Made with recycled materials. That\'s a yes to all three. Plus there\'s the style', 0, 280000),
(5, 3, 'Clyde Core Foil Men\'s Sneakers', 'Pay tribute to a legend in this gold edition Clyde. Inspired by the legend himself, we created the PUMA Clyde back in 1973 just.', 0, 250000),
(6, 2, 'HOOPS 3.0 MID CLASSIC WORLD FRIENDSHIP DAY SHOES', 'CUSTOMIZE THESE PLAYFUL SNEAKERS MADE IN PART WITH RECYCLED CONTENT.\r\nThese mid-cut shoes combine classic basketball elements with details that are uniquely adidas. Note the detachable logo patch on the heel that can be swapped with your bestie\'s in honor', 0, 250000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_details`
--

CREATE TABLE `product_details` (
  `prd_detail_id` bigint(20) UNSIGNED NOT NULL,
  `prd_id` bigint(20) UNSIGNED NOT NULL,
  `prd_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prd_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prd_size` int(11) NOT NULL,
  `prd_amount` int(11) NOT NULL,
  `sold` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_details`
--

INSERT INTO `product_details` (`prd_detail_id`, `prd_id`, `prd_image`, `prd_color`, `prd_size`, `prd_amount`, `sold`) VALUES
(1, 1, 'Jordan_1_Retro_High_OG.png', 'red', 40, 3, 1),
(2, 1, 'Jordan_1_Retro_High_OG.png', 'red', 41, 10, 0),
(3, 1, 'Jordan_1_Retro_High_OG.png', 'red', 42, 10, 0),
(4, 1, 'Jordan_1_Retro_High_OG_yellow.png', 'yellow', 40, 9, 1),
(5, 1, 'Jordan_1_Retro_High_OG_yellow.png', 'yellow', 41, 10, 0),
(6, 1, 'Jordan_1_Retro_High_OG_yellow.png', 'yellow', 42, 10, 0),
(7, 2, 'Nike Air Force 1 \'07.png', 'white', 40, 10, 0),
(8, 2, 'Nike Air Force 1 \'07.png', 'white', 41, 10, 0),
(9, 3, 'Nike_Dunk_Low_Unlocked_By_You.png', 'black', 40, 10, 0),
(10, 4, 'NMD_V3 SHOES.png', 'black', 40, 10, 0),
(11, 4, 'NMD_V3 SHOES.png', 'black', 41, 10, 0),
(12, 5, 'Clyde-Core-Foil-Men\'s-Sneakers.png', 'black', 41, 10, 0),
(13, 5, 'Clyde-Core-Foil-Men\'s-Sneakers.png', 'black', 42, 7, 3),
(14, 6, 'Hoops_3.0_Mid_Classic_World_Friendship_Day_Shoes_White_GX7235_01_standard.png', 'white', 40, 10, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `level`, `address`, `created_at`, `updated_at`, `phone`, `status`) VALUES
(1, 'Tu', 'ngoctu@gmail.com', '$2y$10$HSZftKK9/yun/L69A4y8Wu6I3rEk9Hde/SALqEFZCZy.zfUb7VdP. ', 1, 'Nhà A17, Tầng 02, Số 17 P. Tạ Quang Bửu, Bách Khoa, Hai Bà Trưng', '2023-01-08 20:30:21', '2023-01-08 20:30:21', '0123456789', 0),
(3, 'Tu', 'ngoctu2@gmail.com', '$2y$10$lnoQgFdqb9x93HnNgOA.eOy/b.YaCkrlHcxO1wza6tMo2kEXIXc8O ', 2, 'Nhà A17, Tầng 02, Số 17 P. Tạ Quang Bửu, Bách Khoa, Hai Bà Trưng', '2023-01-09 10:11:24', '2023-01-09 10:11:24', '0987654321', 0),
(14, 'user3', 'user3@gmail.com', '$2y$10$WtaTdqoTn1ieekXsu16E4ObeeJHogowmjptYi24RLDaCV1rYQxUju', 0, 'nha user3', '2023-01-15 09:29:08', '2023-01-15 09:29:08', 'so user 3', 0),
(15, 'user4', 'user4@gmail.com', '$2y$10$Q3akGHgBUFbL3isZYRShzeB3zbvugOREoSIbxYU2r.aLqCkZwJauW', 0, 'nha user4', '2023-01-15 09:30:39', '2023-01-15 09:30:39', 'so user4', 0),
(16, 'Admin', 'admin@gmail.com', '', 1, 'so 1 duong A 3', '2023-01-15 09:33:07', '2023-01-15 09:33:07', '0999999998', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `imgprds`
--
ALTER TABLE `imgprds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imgprds_prd_id_foreign` (`prd_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_index` (`order_id`),
  ADD KEY `order_items_product_id_index` (`product_id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `prd_detail`
--
ALTER TABLE `prd_detail`
  ADD PRIMARY KEY (`prd_detail_id`),
  ADD KEY `prd_detail_prd_id_foreign` (`prd_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prd_id`),
  ADD KEY `product_cat_id_foreign` (`cat_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prd_id`),
  ADD KEY `products_cat_id_foreign` (`cat_id`);

--
-- Chỉ mục cho bảng `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`prd_detail_id`),
  ADD KEY `product_details_prd_id_foreign` (`prd_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `imgprds`
--
ALTER TABLE `imgprds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `prd_detail`
--
ALTER TABLE `prd_detail`
  MODIFY `prd_detail_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `prd_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `prd_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `product_details`
--
ALTER TABLE `product_details`
  MODIFY `prd_detail_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `imgprds`
--
ALTER TABLE `imgprds`
  ADD CONSTRAINT `imgprds_prd_id_foreign` FOREIGN KEY (`prd_id`) REFERENCES `products` (`prd_id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product_details` (`prd_detail_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `prd_detail`
--
ALTER TABLE `prd_detail`
  ADD CONSTRAINT `prd_detail_prd_id_foreign` FOREIGN KEY (`prd_id`) REFERENCES `product` (`prd_id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`);

--
-- Các ràng buộc cho bảng `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `product_details_prd_id_foreign` FOREIGN KEY (`prd_id`) REFERENCES `products` (`prd_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
