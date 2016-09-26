-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2016-09-26 15:47:30
-- 伺服器版本: 10.1.13-MariaDB
-- PHP 版本： 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `lara`
--

-- --------------------------------------------------------

--
-- 資料表結構 `ajaxchatroommodels`
--

CREATE TABLE `ajaxchatroommodels` (
  `id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `content` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `speaker` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '#000000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `ajaxchatroommodels`
--

INSERT INTO `ajaxchatroommodels` (`id`, `time`, `content`, `speaker`, `color`) VALUES
(1, 1474897499, '聊天囉', '宇倫', '#2312ba'),
(2, 1474897523, '<div class="copyToDraw"><a href="#copyToDraw"> [點此將圖拷貝至下方畫版，可繼續創作。] </a><img class="img-responsive" width="398px" src="data:image/png;base64,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"></div>', '宇倫', '#2312ba');

-- --------------------------------------------------------

--
-- 資料表結構 `onlineusers`
--

CREATE TABLE `onlineusers` (
  `id` int(11) NOT NULL,
  `reportTime` int(30) NOT NULL,
  `chatSpeakerName` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `onlineusers`
--

INSERT INTO `onlineusers` (`id`, `reportTime`, `chatSpeakerName`) VALUES
(1286, 1474897648, '宇倫');

-- --------------------------------------------------------

--
-- 資料表結構 `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `students`
--

INSERT INTO `students` (`id`, `name`, `age`) VALUES
(3, 'hahahaha', 0),
(5, 'kkr', 0),
(6, 'kkr', 0),
(7, 'kkr', 0),
(8, 'kkr', 0),
(9, 'kkr', 0),
(10, 'kkr', 0),
(16, 'kkr', 0),
(17, 'kkr', 0),
(19, 'kkr', 30);

-- --------------------------------------------------------

--
-- 資料表結構 `timeflags`
--

CREATE TABLE `timeflags` (
  `id` int(11) NOT NULL,
  `chatLastTime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `timeflags`
--

INSERT INTO `timeflags` (`id`, `chatLastTime`) VALUES
(1, 1474897523);

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `ajaxchatroommodels`
--
ALTER TABLE `ajaxchatroommodels`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `onlineusers`
--
ALTER TABLE `onlineusers`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `timeflags`
--
ALTER TABLE `timeflags`
  ADD PRIMARY KEY (`id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `ajaxchatroommodels`
--
ALTER TABLE `ajaxchatroommodels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用資料表 AUTO_INCREMENT `onlineusers`
--
ALTER TABLE `onlineusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1287;
--
-- 使用資料表 AUTO_INCREMENT `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- 使用資料表 AUTO_INCREMENT `timeflags`
--
ALTER TABLE `timeflags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;