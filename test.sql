-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 04, 2023 lúc 03:29 AM
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
-- Cơ sở dữ liệu: `test`
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
(3, 'Puma'),
(4, 'New Balance'),
(5, 'Converse');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `imgprds`
--

CREATE TABLE `imgprds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prd_id` bigint(20) UNSIGNED NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `grand_total` decimal(20,0) NOT NULL,
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
(40, 'ORD-63DD1F2AE7BD8', 16, 'cancel', '11', 3, 'Khách Hàng 1', 'số 1 Tạ Quang Bửu', '0956498653', '2023-02-03 07:50:18', '2023-02-03 07:50:18', '', '', ''),
(41, 'ORD-63DD1F4E9308B', 16, 'cancel', '16', 2, 'Khách Hàng 1', 'số 1 Tạ Quang Bửu', '0956498653', '2023-02-03 07:50:54', '2023-02-03 07:50:54', '', '', ''),
(42, 'ORD-63DD1FA099AE3', 16, 'cancel', '4', 3, 'Khách Hàng 1', 'số 1 Tạ Quang Bửu', '0956498653', '2023-02-03 07:52:16', '2023-02-03 07:52:16', '', '', ''),
(43, 'ORD-63DD329B172A8', 16, 'processing', '16', 2, 'Khách Hàng 1', 'số 1 Tạ Quang Bửu', '0956498653', '2023-02-03 09:13:15', '2023-02-03 09:13:15', '', '', ''),
(44, 'ORD-63DD33FB3FF44', 16, 'completed', '3669000', 1, 'Khách Hàng 1', 'số 1 Tạ Quang Bửu', '0956498653', '2023-01-10 09:19:07', '2023-02-03 09:19:07', '', '', ''),
(45, 'ORD-63DD3FE9EE819', 1, 'completed', '8369000', 1, 'Admin', 'Nhà A17, Tầng 02, Số 17 P. Tạ Quang Bửu, Bách Khoa, Hai Bà Trưng', '09999999999', '2023-02-03 10:10:02', '2023-02-03 10:10:02', '', '', ''),
(46, 'ORD-63DD4029C069B', 1, 'pending', '430000', 1, 'Admin', 'Nhà A17, Tầng 02, Số 17 P. Tạ Quang Bửu, Bách Khoa, Hai Bà Trưng', '09999999999', '2023-02-03 10:11:05', '2023-02-03 10:11:05', '', '', ''),
(47, 'ORD-63DD4064955C7', 1, 'pending', '3000000', 1, 'Admin', 'Nhà A17, Tầng 02, Số 17 P. Tạ Quang Bửu, Bách Khoa, Hai Bà Trưng', '09999999999', '2023-02-03 10:12:04', '2023-02-03 10:12:04', '', '', ''),
(48, 'ORD-63DD40D6903A9', 1, 'pending', '3000000', 1, 'Admin', 'Nhà A17, Tầng 02, Số 17 P. Tạ Quang Bửu, Bách Khoa, Hai Bà Trưng', '09999999999', '2023-02-03 10:13:58', '2023-02-03 10:13:58', 'admin@gmail.com', '', 'Hà Nội'),
(49, 'ORD-63DD40E7DEC7B', 1, 'completed', '3000000', 1, 'Admin', 'Nhà A17, Tầng 02, Số 17 P. Tạ Quang Bửu, Bách Khoa, Hai Bà Trưng', '09999999999', '2023-02-03 10:14:15', '2023-02-03 10:14:15', 'admin@gmail.com', '', 'Hà Nội'),
(50, 'ORD-63DDB2DC5A372', 16, 'completed', '860000', 2, 'Khách Hàng 1', 'số 1 Tạ Quang Bửu', '0956498653', '2023-02-03 18:20:28', '2023-02-03 18:20:28', 'kh1@gmail.com', '', 'Hà Nội'),
(51, 'ORD-63DDB738DBC2E', 16, 'cancel', '1300000', 1, 'Khách Hàng 1', 'số 1 Tạ Quang Bửu', '0956498653', '2023-02-03 18:39:04', '2023-02-03 18:39:04', 'kh1@gmail.com', '', 'Hà Nội'),
(52, 'ORD-63DDB78367494', 16, 'processing', '3669000', 1, 'Khách Hàng 1', 'số 1 Tạ Quang Bửu', '0956498653', '2023-02-03 18:40:19', '2023-02-03 18:40:19', 'kh1@gmail.com', '', 'Hà Nội'),
(53, 'ORD-63DDBC049C6C8', 16, 'completed', '280000', 1, 'Khách Hàng 1', 'số 1 Tạ Quang Bửu', '0956498653', '2023-02-03 18:59:32', '2023-02-03 18:59:32', 'kh1@gmail.com', '', 'Hà Nội'),
(54, 'ORD-63DDBD65A2757', 16, 'completed', '800000', 1, 'Khách Hàng 1', 'HCM', '0956498653', '2023-02-03 19:05:25', '2023-02-03 19:05:25', 'kh1@gmail.com', '', 'Hà Nội'),
(55, 'ORD-63DDBF2B98900', 16, 'pending', '800000', 1, 'Khách Hàng 1', 'số 1 Tạ Quang Bửu', '0956498653', '2023-02-03 19:12:59', '2023-02-03 19:12:59', 'kh1@gmail.com', '', 'Hà Nội');

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
(33, 40, 20, 3, '11007000', '2023-02-03 07:50:18', '2023-02-03 07:50:18'),
(34, 41, 24, 2, '16738000', '2023-02-03 07:50:54', '2023-02-03 07:50:54'),
(35, 42, 27, 3, '4500000', '2023-02-03 07:52:16', '2023-02-03 07:52:16'),
(36, 43, 24, 2, '16738000', '2023-02-03 09:13:15', '2023-02-03 09:13:15'),
(37, 44, 20, 1, '3669000', '2023-02-03 09:19:07', '2023-02-03 09:19:07'),
(38, 45, 24, 1, '8369000', '2023-02-03 10:10:02', '2023-02-03 10:10:02'),
(39, 46, 19, 1, '430000', '2023-02-03 10:11:05', '2023-02-03 10:11:05'),
(40, 49, 36, 1, '3000000', '2023-02-03 10:14:15', '2023-02-03 10:14:15'),
(41, 50, 19, 2, '860000', '2023-02-03 18:20:28', '2023-02-03 18:20:28'),
(42, 51, 8, 1, '1300000', '2023-02-03 18:39:04', '2023-02-03 18:39:04'),
(43, 52, 20, 1, '3669000', '2023-02-03 18:40:19', '2023-02-03 18:40:19'),
(44, 53, 11, 1, '280000', '2023-02-03 18:59:32', '2023-02-03 18:59:32'),
(45, 54, 1, 1, '800000', '2023-02-03 19:05:25', '2023-02-03 19:05:25'),
(46, 55, 5, 1, '800000', '2023-02-03 19:12:59', '2023-02-03 19:12:59');

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
('ngoctu@gmail.com', '$2y$10$erZpJoGewYezTWSL0V6YGuglaxBAtDbJoMbelofSz5SZ7syKTVSDW', '2023-01-09 10:10:30');

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
(1, 1, 'Jordan 1 Retro High OG1', 'The original Air Jordan 1 Chicago colorway was first introduced in 1985 and has only been retroed a few times since. But 2022 is the year that the colorway returns with an added vintage look. Pre-yellowed accents and cracked leather uppers showcase a fabricated look of age and wear. The Air Jordan 1 Lost and Found Chicago released in November of 2022 for $180.', 20, 1000000),
(2, 1, 'Nike Air Force 1 \'07', 'The radiance lives on with the b-ball original. Crossing hardwood comfort with off-court flair, it puts a fresh spin on what you know best: \'80s-inspired construction, bold details and nothin\'-but-net style.', 0, 1300000),
(3, 1, 'Nike Dunk Low Unlocked By You', 'We are seeing volatility in global supply chains and are unable to guarantee delivery. But your Nike By You order is important to us, and we expect your custom-made product to arrive within 4 weeks.', 0, 1320000),
(4, 2, 'NMD_V3 SHOES', 'COMFORTABLE PERFORATED SHOES MADE IN PART WITH PARLEY OCEAN PLASTIC.\r\nGo ahead and check all the boxes with these adidas NMD_V3 Shoes. Breathable. Comfortable. Made with recycled materials. That\'s a yes to all three. Plus there\'s the style', 0, 280000),
(5, 3, 'Clyde Core Foil Men\'s Sneakers', 'Pay tribute to a legend in this gold edition Clyde. Inspired by the legend himself, we created the PUMA Clyde back in 1973 just.', 0, 250000),
(6, 2, 'HOOPS 3.0 MID CLASSIC WORLD FRIENDSHIP DAY SHOES', 'CUSTOMIZE THESE PLAYFUL SNEAKERS MADE IN PART WITH RECYCLED CONTENT.\r\nThese mid-cut shoes combine classic basketball elements with details that are uniquely adidas. Note the detachable logo patch on the heel that can be swapped with your bestie\'s in honor', 0, 250000),
(7, 1, 'Jordan 1', 'CUSTOMIZE THESE PLAYFUL SNEAKERS MADE IN PART WITH RECYCLED CONTENT.\r\nThese mid-cut shoes combine classic basketball elements with details that are uniquely adidas. Note the detachable logo patch on the heel that can be swapped with your bestie\'s in honor', 0, 250000),
(10, 1, 'Nike Air Max 90 SE', 'Nothing as fly, nothing as comfortable, nothing as proven. The Nike Air Max 90 stays true to its roots with its iconic Waffle outsole, durable stitched overlays and classic plastic accents. A mix of navy, blue and silver adds a touch of sporty retro style to this special edition while visible Max Air keeps the comfortable cushioning you love.', 0, 200000),
(11, 1, 'Air Jordan 1 Zoom Comfort 2', 'Premium suede and Jordan Brand\'s signature Formula 23 foam come together to give you an extra-luxurious (and extra-cosy) AJ1. You don\'t need to play \"either or\" when it comes to choosing style or comfort with this one—which is nice, \'cause you deserve both.', 0, 430000),
(12, 1, 'Air Jordan 1 Mid', 'The Air Jordan 1 Mid brings full-court style and premium comfort to an iconic look. Its Air-Sole unit cushions play on the hardwood, while the padded collar gives you a supportive feel.', 0, 3669000),
(13, 1, 'Air Jordan 1 Mid SE', 'Tis the season for festive-inspired Js, and this pair takes its cues from a classic Christmas tree—the Blue Spruce. Rich-grain leather and woven fabrics will elevate any streetwear outfit, while a buttery-soft interior and Air in the heel add soft comforts.\r\n\r\n', 0, 3829000),
(14, 3, 'Suede Classic XXI Men\'s Sneakers', 'The Suede hit the scene in 1968 and has been changing the game ever since. It’s been worn by icons of every generation, and it’s stayed classic through it all. Instantly recognizable and constantly reinvented, Suede’s legacy continues to grow and be legitimized by the authentic and expressive individuals that embrace the iconic shoe. Be apart of the history of Suede, for all time.\r\n', 0, 2430000),
(15, 1, 'Nike Air Max 90 LTR', 'Lace up and feel the legacy with the Nike Air Max 90 LTR. An iconic Waffle outsole and moulded plastic accents help these kicks stay true to their roots, while Max Air cushioning adds comfort to your every step. Crisp leather and soft, textured suede bring a premium look and feel to this classic sneaker.\r\n', 0, 4109000),
(16, 1, 'Nike Alphafly 2', 'Once you take a few strides in the Nike Alphafly 2, you\'ll never look at your favourite pair of old\r\n                    racing shoes in the same way. These rocket ships are made to help shave precious time off your personal\r\n                    records without surrendering the foundation you need to go the full distance. A thick, lightweight\r\n                    support system brings comfort and speed together so you can enjoy our greatest energy return while you\r\n                    chase your personal bests.\r\n', 0, 8369000),
(17, 4, 'New Balance 237', 'The running shoes of the 1970s might best be described as deceptively simple. While lacking the visible technology and aggressive design of later years, the innovations of the ‘70s would lay the foundation for modern performance. The 237 is a contemporary reinterpretation of ‘70s running heritage that melds a range of heritage design inspirations into one deceptively simple, exceptionally versatile, contemporary silhouette. An EVA midsole, herringbone outsole and streamlined upper offer a classic launching point for modern flourishes like oversized N branding, extended midsole length, and gator inspired foxing and mudguard. You could call the cohesion of the 237’s familiar feel and exaggerated updates the simplest way to make a statement. ', 0, 1500000),
(18, 5, 'Converse Chuck Taylor All Star 70 Hi', 'Japanese designer Rei Kawakubo is one of the most prolific fashion designers of all time. Aside from her Comme des Garçons collections, she has had numerous sneaker collaborations over the years. One of the most outstanding of these collaborations involves her different iterations of work modifying and styling up the Converse Chuck Taylor with her sub-label Comme des Garçons PLAY. Kawakubo’s first iteration of his Converse Chuck Taylors came about in 2009 when she modified the original by stripping back its contrast stitching. Six years later, in 2015, she took the All Star Chuck 70s as her template and created a shoe so beloved that it has been re-released every year since.', 0, 3000000),
(19, 1, 'moi', 'à', 0, 100);

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
(1, 1, 'Jordan_1_Retro_High_OG.png', 'red', 40, 10, 3),
(2, 1, 'Jordan_1_Retro_High_OG.png', 'red', 41, 10, 0),
(3, 1, 'Jordan_1_Retro_High_OG.png', 'red', 42, 10, 0),
(4, 1, 'Jordan_1_Retro_High_OG_yellow.png', 'yellow', 40, 10, 0),
(5, 1, 'Jordan_1_Retro_High_OG_yellow.png', 'yellow', 41, 9, 1),
(6, 1, 'Jordan_1_Retro_High_OG_yellow.png', 'yellow', 42, 10, 0),
(7, 2, 'Nike Air Force 1 \'07.png', 'white', 40, 13, 0),
(8, 2, 'Nike Air Force 1 \'07.png', 'white', 41, 9, 1),
(9, 3, 'Nike_Dunk_Low_Unlocked_By_You.png', 'black', 40, 5, 0),
(10, 4, 'NMD_V3 SHOES.png', 'black', 40, 10, 0),
(11, 4, 'NMD_V3 SHOES.png', 'black', 41, 9, 1),
(12, 5, 'Clyde-Core-Foil-Men\'s-Sneakers.png', 'black', 41, 10, 0),
(13, 5, 'Clyde-Core-Foil-Men\'s-Sneakers.png', 'black', 42, 10, 0),
(14, 6, 'Hoops_3.0_Mid_Classic_World_Friendship_Day_Shoes_White_GX7235_01_standard.png', 'white', 40, 10, 0),
(15, 1, 'jordan1.png', 'red', 40, 10, 0),
(17, 10, 'nikeairmax90se.png', 'Blue', 40, 10, 0),
(19, 11, 'Air Jordan 1 Zoom Comfort 2.png', 'Brown', 42, 6, 4),
(20, 12, 'Air Jordan 1 Mid.png', 'RED', 42, 5, 5),
(21, 13, 'Air Jordan 1 Mid SE.png', 'GREEN', 41, 10, 0),
(22, 14, 'Suede-Classic-XXI-Men\'s-Sneakers.png', 'RED', 43, 10, 0),
(23, 15, 'nikeairmax90LTR.png', 'White Brown', 40, 10, 0),
(24, 16, 'Nike AlphaFly 2.png', 'Green', 40, 5, 5),
(26, 17, 'New Balance 237.png', 'black', 41, 10, 0),
(27, 17, 'New Balance 237.png', 'black', 42, 7, 3),
(28, 17, 'New Balance 237.png', 'black', 43, 10, 0),
(29, 18, 'Converse_Chuck_Taylor-All-Star_70_Hi.png', 'black', 41, 10, 0),
(30, 18, 'Converse_Chuck_Taylor-All-Star_70_Hi.png', 'black', 42, 10, 0),
(31, 18, 'Converse_Chuck_Taylor-All-Star_70_Hi.png', 'black', 43, 10, 0),
(32, 18, 'Converse_Chuck_Taylor-All-Star_70_Hi_blue.png', 'blue', 41, 10, 0),
(33, 18, 'Converse_Chuck_Taylor-All-Star_70_Hi_blue.png', 'blue', 42, 9, 1),
(34, 18, 'Converse_Chuck_Taylor-All-Star_70_Hi_blue.png', 'blue', 43, 10, 0),
(35, 18, 'Converse_Chuck_Taylor-All-Star_70_Hi_gray.png', 'grey', 41, 10, 0),
(36, 18, 'Converse_Chuck_Taylor-All-Star_70_Hi_gray.png', 'grey', 42, 9, 1),
(37, 18, 'Converse_Chuck_Taylor-All-Star_70_Hi_gray.png', 'grey', 43, 10, 0),
(38, 18, 'Converse_Chuck_Taylor-All-Star_70_Hi_white.png', 'white', 41, 10, 0),
(39, 18, 'Converse_Chuck_Taylor-All-Star_70_Hi_white.png', 'white', 42, 10, 0),
(40, 18, 'Converse_Chuck_Taylor-All-Star_70_Hi_white.png', 'white', 43, 10, 0),
(41, 3, 'Nike_Dunk_Low_Unlocked_By_You.png', 'black', 41, 10, 0),
(42, 11, 'Air Jordan 1 Zoom Comfort 2.png', 'Brown', 43, 9, 1),
(43, 19, '', 'green', 40, 10, 0);

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
(1, 'Admin', 'admin@gmail.com', '$2y$10$ICN18kxMH9cC5Urgw4JgSe4sZA.P2ckeavpod/XtTdXs098Ni8RLK', 1, 'Nhà A17, Tầng 02, Số 17 P. Tạ Quang Bửu, Bách Khoa, Hai Bà Trưng', '2023-02-03 07:02:37', '2023-02-03 07:02:37', '09999999999', 0),
(16, 'Khách Hàng 1', 'kh1@gmail.com', '$2y$10$rOb0puqfz4CjIRAmhYui1O2my3bDImtQS5ZuZKEgj5p3gAngmoj/y', 0, 'số 1 Tạ Quang Bửu', '2023-02-03 07:18:28', '2023-02-03 07:18:28', '0956498653', 0);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `imgprds`
--
ALTER TABLE `imgprds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `prd_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `product_details`
--
ALTER TABLE `product_details`
  MODIFY `prd_detail_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

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
