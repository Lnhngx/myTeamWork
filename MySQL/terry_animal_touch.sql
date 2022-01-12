-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-01-12 05:00:41
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
-- 資料庫: `wildjungle`
--

-- --------------------------------------------------------

--
-- 資料表結構 `admins`
--

CREATE TABLE `admins` (
  `sid` int(11) NOT NULL,
  `account` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `admins`
--

INSERT INTO `admins` (`sid`, `account`, `password`, `nickname`) VALUES
(1, 'terryterry', '$2y$10$fkLR60zUr1lVFIywSPk6JelSlFxKhjoXXiXVi5eOlPIy8H1lpoeiC', 'littleterry');

-- --------------------------------------------------------

--
-- 資料表結構 `animal_touch`
--

CREATE TABLE `animal_touch` (
  `sid` int(11) NOT NULL,
  `actName` varchar(255) NOT NULL,
  `actTime_start` datetime NOT NULL,
  `actTime_end` datetime NOT NULL,
  `reserPeop` int(11) NOT NULL,
  `introduce` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `animal_touch`
--

INSERT INTO `animal_touch` (`sid`, `actName`, `actTime_start`, `actTime_end`, `reserPeop`, `introduce`, `location`) VALUES
(1, '擠羊奶囉', '2022-01-27 14:20:00', '2022-01-28 14:20:00', 22, '羊咩咩超可愛的！快點來體驗擠羊奶的樂趣！！！！！！', '樂活Ｚ館'),
(3, '馬術GOGO', '2022-01-06 09:00:00', '2022-01-06 10:00:00', 31, '要馬兒好就要讓馬兒吃草！快來體驗馬術活動！', '悠活Ｂ館'),
(6, '河馬碎西瓜', '2022-01-19 16:00:00', '2022-01-19 17:00:00', 28, '你能夠順利的將西瓜丟入河馬口中嗎？快來挑戰！', '大廣場Ｃ區'),
(7, '水豚君好餓', '2022-01-25 08:00:00', '2022-01-25 09:00:00', 14, '萌萌水豚君好餓喔！期待有緣人可以餵食～', '河畔Ａ區'),
(8, '騎大象', '2022-01-13 13:00:00', '2022-01-13 14:00:00', 11, '大象長長的鼻子正昂揚～不能站在巨人的肩膀至少可以坐在大象上！', '大廣場Ｂ區'),
(11, '我終於完成啦', '2022-02-20 15:38:00', '2022-02-21 15:38:00', 100000, '來看我自己寫好的insert！！！！！！', '310教室'),
(38, '牛奶補給站', '2022-01-12 09:27:00', '2022-01-12 00:27:00', 19, '好喝的牛奶在這裡！新鮮現擠，不好喝免錢！', '農村Ａ區'),
(39, '孤僻草泥馬', '2022-01-01 09:00:00', '2022-01-01 10:00:00', 1, '我...害羞......內向......沒事...不要...來......', '(不告訴你)');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `animal_touch`
--
ALTER TABLE `animal_touch`
  ADD PRIMARY KEY (`sid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `admins`
--
ALTER TABLE `admins`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `animal_touch`
--
ALTER TABLE `animal_touch`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
