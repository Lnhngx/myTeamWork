-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-01-10 15:20:37
-- 伺服器版本： 10.4.22-MariaDB
-- PHP 版本： 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `stan_use`
--

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `sid` int(11) NOT NULL,
  `member_sid` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `order_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` (`sid`, `member_sid`, `amount`, `order_date`) VALUES
(104, 0, 14931, '2022-01-10 00:35:44'),
(105, 0, 11889, '2022-01-10 00:38:46'),
(106, 0, 390, '2022-01-10 00:39:42'),
(107, 0, 4890, '2022-01-10 00:53:02'),
(108, 0, 4890, '2022-01-10 00:54:53');

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
(500, 100, 25, 300, 2),
(501, 100, 26, 600, 2),
(502, 103, 9, 910, 5),
(503, 103, 5, 812, 4),
(504, 104, 5, 812, 7),
(505, 104, 8, 1321, 7),
(506, 105, 8, 1321, 9),
(507, 106, 10, 78, 5),
(508, 107, 6, 815, 6),
(509, 108, 6, 815, 6);

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
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order_details_activity`
--
ALTER TABLE `order_details_activity`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order_details_products`
--
ALTER TABLE `order_details_products`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=510;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order_details_ticket`
--
ALTER TABLE `order_details_ticket`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
