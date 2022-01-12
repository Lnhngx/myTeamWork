-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-01-12 04:58:08
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
-- 資料表結構 `answer`
--

CREATE TABLE `answer` (
  `sid` int(11) NOT NULL,
  `acontent` varchar(255) NOT NULL,
  `yesno` varchar(255) NOT NULL,
  `question_sid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `answer`
--

INSERT INTO `answer` (`sid`, `acontent`, `yesno`, `question_sid`) VALUES
(5, '獵豹', 'wrong', 2),
(6, '蹬羚', 'wrong', 2),
(7, '非洲鴕鳥', 'right', 2),
(8, '會游泳，不會跑步', 'wrong', 3),
(9, '會游泳，也會跑步', 'wrong', 3),
(10, '不會游泳，也不會跑步', 'wrong', 3),
(11, '會跑步，不會游泳', 'right', 3),
(12, '企鵝是一夫一妻制', 'wrong', 4),
(13, '企鵝在赤道附近的環境中是無法生存的', 'right', 4),
(14, '企鵝的祖先原本是可以飛的', 'wrong', 4),
(15, '和鳥類相似，企鵝也靠聲音和動作求偶', 'wrong', 4),
(16, '在澳洲，袋鼠的數量與人口數相近', 'wrong', 5),
(17, '袋鼠和人一樣早上活動，晚上休息', 'wrong', 5),
(18, '袋鼠一生中不太需要喝水', 'right', 5),
(19, '袋鼠子宮只有1個，不會隨時保持懷孕的狀態', 'wrong', 5),
(20, '3倍', 'right', 6),
(21, '一樣慢', 'wrong', 6),
(22, '5倍', 'wrong', 6),
(23, '2倍', 'wrong', 6),
(24, '有潔癖，所以洗乾淨再吃', 'wrong', 7),
(25, '因為視力較差，前爪泡到水中觸摸東西可以讓牠們了解食物的外型和質地', 'right', 7),
(26, '因為鼻子十分靈敏，藉由泡到水中降低食物的氣味', 'wrong', 7),
(27, '因為牙齒不好，在水中洗過，食物吃起來會比較軟', 'wrong', 7),
(28, '基因', 'wrong', 8),
(29, '海水的鹽度', 'wrong', 8),
(30, '孵化時的溫度', 'right', 8),
(31, '產卵時眼淚流出的量', 'wrong', 8),
(32, '30,000多顆', 'right', 9),
(33, '10,000多顆', 'wrong', 9),
(34, '15,000多顆', 'wrong', 9),
(35, '50,000多顆', 'wrong', 9),
(36, '藍鯨', 'wrong', 10),
(37, '鯨鯊', 'right', 10),
(38, '大白鯊', 'wrong', 10),
(39, '公牛鯊', 'wrong', 10),
(40, '和人類相同，大象的懷孕周期為10個月', 'wrong', 11),
(41, '大象的耳朵有降溫的效果', 'right', 11),
(42, '大象和蜜蜂在大自然中是很好的朋友', 'wrong', 11),
(43, '大象只能使用鼻子或嘴巴呼吸', 'wrong', 11),
(44, '8隻腳', 'wrong', 12),
(45, '10隻腳', 'right', 12),
(46, '6隻腳', 'wrong', 12),
(47, '12隻腳', 'wrong', 12),
(54, '3顆', 'right', 32),
(55, '0顆', 'wrong', 32),
(56, '8顆', 'wrong', 32),
(57, '1顆', 'wrong', 32),
(87, '人類', 'wrong', 2),
(96, '黑色', 'right', 1),
(97, '白色', 'wrong', 1),
(98, '灰色', 'wrong', 1),
(99, '黑白相間', 'wrong', 1),
(100, '1顆', 'right', 42),
(101, '2顆', 'wrong', 42),
(102, '3顆', 'wrong', 42),
(103, '沒有頭', 'wrong', 42),
(104, '深海區', 'right', 43),
(105, '淺水區', 'wrong', 43),
(106, '陸地', 'wrong', 43),
(107, '熱帶草原', 'wrong', 43),
(108, '每一集都有', 'right', 44),
(109, '第三集', 'wrong', 44),
(110, '最後一集', 'wrong', 44),
(111, '第一集', 'wrong', 44);

-- --------------------------------------------------------

--
-- 資料表結構 `question`
--

CREATE TABLE `question` (
  `sid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `qcontent` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `question`
--

INSERT INTO `question` (`sid`, `name`, `qcontent`, `image`) VALUES
(1, '斑馬', '請問斑馬的皮膚是什麼顏色?', 'zebra.jpg'),
(2, '鴕鳥', '如果在動物界舉辦一場馬拉松，以下的參賽選手，誰會是最後的冠軍呢?', '456786'),
(3, '河馬', '河馬會游泳，還是會跑步呢?', '5464879'),
(4, '企鵝', '關於企鵝以下的敘述何者錯誤?', '54546478797.jpg'),
(5, '袋鼠', '關於袋鼠以下的敘述何者正確?', 'kangaroo001.jpg'),
(6, '樹懶', '樹懶移動的非常緩慢，在樹上時速只有每分鐘4公尺，請問當樹懶在水中，速度會是陸地上的幾倍?', 'sloth.jpg'),
(7, '浣熊', '浣熊為什麼那麼愛洗東西?', 'raccoon.jpg'),
(8, '海龜', '大多物種的性別是在受精時決定，請問海龜的性別是由何種因素決定?', 'turtle002.jpg'),
(9, '鯊魚', '當鯊魚蛀牙，牠的牙齒就會脫落，然後長新的出來，請問鯊魚的一生中會替換幾顆牙?', 'shark003.jpg'),
(10, '鯨鯊', '世界上最大的魚類為何?', '哈囉'),
(11, '大象', '以下關於大象的敘述，何者錯誤?', 'elephant001.jpg'),
(12, '龍蝦', '請問一隻龍蝦有幾隻腳?', 'lobster.jpg'),
(32, '章魚', '請問章魚有幾顆心臟?', NULL),
(42, '章魚', '請問章魚有幾顆頭?', NULL),
(43, '章魚', '請問章魚生存於哪裡?', NULL),
(44, '狐狸', '請問狐狸出現在Dora的第幾集?', NULL);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `question_sid` (`question_sid`);

--
-- 資料表索引 `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`sid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `answer`
--
ALTER TABLE `answer`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `question`
--
ALTER TABLE `question`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
