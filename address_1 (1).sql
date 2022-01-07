-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-01-07 06:30:18
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
-- 資料庫: `動物園導覽`
--

-- --------------------------------------------------------

--
-- 資料表結構 `address_1`
--

CREATE TABLE `address_1` (
  `sid` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `English_name` varchar(255) DEFAULT NULL,
  `species` varchar(255) DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `address_1`
--

INSERT INTO `address_1` (`sid`, `name`, `English_name`, `species`, `origin`, `birthday`, `remark`) VALUES
(2, 'bgdfhf', '', 'ghkmhvk', 'hjvglghj;', NULL, ''),
(3, 'fdfd', '', 'ffdfd', 'fdf', NULL, ''),
(15, '111112', '22222222222wewerw', '33333333rrewe', NULL, '2022-01-14', '11111112rerwe'),
(16, '', '', '', '', NULL, ''),
(17, 'vxcbvcxbcv', 'cvxbcbvxcb', 'vcxbcxbxcvb', NULL, '2022-01-13', 'vxcb');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `address_1`
--
ALTER TABLE `address_1`
  ADD PRIMARY KEY (`sid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `address_1`
--
ALTER TABLE `address_1`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
