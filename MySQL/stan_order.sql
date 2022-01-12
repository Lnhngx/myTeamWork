-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-01-12 03:44:41
-- 伺服器版本： 10.4.22-MariaDB
-- PHP 版本： 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `456`
--

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `sid` int(11) NOT NULL,
  `users_sid` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `order_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` (`sid`, `users_sid`, `amount`, `order_date`) VALUES
(111, 2, 5590, '2021-09-01 15:01:02'),
(112, 2, 8443, '2021-12-01 15:01:18'),
(113, 2, 3180, '2022-01-11 15:01:32'),
(114, 2, 516, '2022-01-11 18:41:23'),
(115, 2, 3000, '2022-01-11 18:41:42'),
(116, 2, 3300, '2022-01-11 18:42:16');

-- --------------------------------------------------------

--
-- 資料表結構 `order_details_activity`
--

CREATE TABLE `order_details_activity` (
  `sid` int(11) NOT NULL,
  `order_sid` int(11) NOT NULL,
  `activity_sid` int(11) NOT NULL,
  `activity_price` int(11) NOT NULL,
  `activity_quantity` int(11) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `order_details_products`
--

CREATE TABLE `order_details_products` (
  `sid` int(11) NOT NULL,
  `order_sid` int(11) NOT NULL,
  `product_sid` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `order_details_products`
--

INSERT INTO `order_details_products` (`sid`, `order_sid`, `product_sid`, `product_price`, `product_quantity`) VALUES
(513, 111, 1, 399, 6),
(514, 111, 5, 799, 4),
(515, 112, 5, 799, 4),
(516, 112, 6, 500, 3),
(517, 112, 7, 799, 3),
(518, 112, 8, 450, 3),
(519, 113, 10, 399, 7),
(520, 113, 3, 129, 3),
(521, 114, 3, 129, 4),
(522, 115, 4, 500, 6),
(523, 116, 5, 799, 3),
(524, 116, 3, 129, 7);

-- --------------------------------------------------------

--
-- 資料表結構 `order_details_ticket`
--

CREATE TABLE `order_details_ticket` (
  `sid` int(11) NOT NULL,
  `order_sid` int(11) NOT NULL,
  `ticket_sid` int(11) NOT NULL,
  `ticket_price` int(11) NOT NULL,
  `ticket_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `order_details_activity`
--
ALTER TABLE `order_details_activity`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `order_sid` (`order_sid`);

--
-- 資料表索引 `order_details_products`
--
ALTER TABLE `order_details_products`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `order_sid` (`order_sid`);

--
-- 資料表索引 `order_details_ticket`
--
ALTER TABLE `order_details_ticket`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `order_sid` (`order_sid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order_details_activity`
--
ALTER TABLE `order_details_activity`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order_details_products`
--
ALTER TABLE `order_details_products`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=525;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order_details_ticket`
--
ALTER TABLE `order_details_ticket`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
