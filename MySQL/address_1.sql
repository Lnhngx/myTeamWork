-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2022 年 01 月 12 日 04:52
-- 伺服器版本： 10.4.21-MariaDB
-- PHP 版本： 8.1.1

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
(21, ' 灰狐', 'Urocyon cinereoargenteus', '犬科 Canidae', '為美洲的特產。分布範圍從北美南部到中美和南美北部。', '2022-01-21', '棲息於森林地帶。善於爬樹。喜獨居。'),
(22, '刺蝟', 'Erinaceinae', '真盲缺目 Eulipotyphla', '廣泛分布在歐洲、亞洲北部', '2022-01-07', '刺蝟能存活4-7年，但作為寵物的刺蝟，據記載有曾存活達16年的。'),
(23, '美洲獅', 'Puma concolor', '食肉目 Carnivora', '加拿大的育空地區', '2022-01-15', '以野生動物兔、羊、鹿為食');

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
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
