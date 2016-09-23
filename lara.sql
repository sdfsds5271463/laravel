-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2016-09-19 17:07:37
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
  `content` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `speaker` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '#000000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `ajaxchatroommodels`
--

INSERT INTO `ajaxchatroommodels` (`id`, `time`, `content`, `speaker`, `color`) VALUES
(2457, 1474292623, 'sdfsdf', 'werwersdfsdfdssdfsdf', '#666666'),
(2458, 1474292625, 'sdfsdf', 'werwerwersdfsdf', '#666666'),
(2459, 1474292628, 'sdfsdfsdfsdf', 'asdfdgfgasdasd', '#c4090d'),
(2460, 1474292897, '是嗎', 'dsdfsdfsdf', '#666666'),
(2461, 1474292905, '= =', 'dsdfsdfsdf', '#666666'),
(2462, 1474292918, '123', 'asdfdgfgasdasd', '#c4090d'),
(2463, 1474292925, 'sadsad', 'asdfdgfgasdasd', '#c4090d'),
(2464, 1474293188, 'sdfsdf', 'asdfdgfgasdasd', '#c4090d'),
(2465, 1474293195, 'ee', 'asdfdgfgasdasd', '#c4090d'),
(2466, 1474293197, '31232', 'asdfdgfgasdasd', '#c4090d'),
(2467, 1474293203, '323123', 'asdfdgfgasdasd', '#c4090d'),
(2468, 1474293322, 'sdas', 'asdfdgfgasdasd', '#c4090d'),
(2469, 1474293326, 's asd das', 'sdfsdfs', '#666666'),
(2470, 1474293348, 'sdasd', 'fdgdfgsewrsdf', '#666666'),
(2471, 1474293394, 'asdasdasd', 'asdfdgfgasdasd', '#c4090d'),
(2472, 1474293964, 'qweqwe', 'fdgdfgsewrsdf', '#666666'),
(2473, 1474293967, 'qweqwessdsa', 'fdgdfgsewrsdf', '#666666'),
(2474, 1474293969, 'sdfsdfsdfsdfsdf', 'asdfdgfgasdasd', '#c4090d'),
(2475, 1474294241, 'sdfsdf', 'fdgdfgsewrsdf', '#431fad'),
(2476, 1474294251, 'qweqwsdsd', 'fdgdfgsewrsdf', '#431fad'),
(2477, 1474294278, 'asdasd', 'asdfdgfgasdasd', '#c4090d'),
(2478, 1474294283, 'asdasd', 'fdgdfgsewrsdf', '#431fad'),
(2479, 1474294290, '42123', 'fdgdfgsewrsdf', '#431fad'),
(2480, 1474294294, 'asdasdsadasdsa', 'asdfdgfgasdasd', '#c4090d'),
(2481, 1474294302, '= =', 'asdfdgfgasdasd', '#c4090d'),
(2482, 1474294305, '= =', 'fdgdfgsewrsdf', '#431fad'),
(2483, 1474294324, 'asdas', 'asdfdgfgasdasd', '#c4090d'),
(2484, 1474294359, 'sdfdfssdsdf', 'fdgdfgsewrsdf', '#431fad'),
(2485, 1474294365, 'dddsddsfdsf', 'fdgdfgsewrsdf', '#431fad'),
(2486, 1474294368, 'werwerwesdfsddfs', 'fdgdfgsewrsdf', '#431fad'),
(2487, 1474294395, 'asdasdsd', 'fdgdfgsewrsdf', '#431fad'),
(2488, 1474294399, 'qweqdssdf', 'asdfdgfgasdasd', '#c4090d'),
(2489, 1474294407, '我不知道阿', 'asdfdgfgasdasd', '#c4090d'),
(2490, 1474294410, '你再說一次', 'asdfdgfgasdasd', '#c4090d'),
(2491, 1474294413, '= =', 'fdgdfgsewrsdf', '#431fad'),
(2492, 1474294416, '三小', 'fdgdfgsewrsdf', '#431fad'),
(2493, 1474294419, '我很忙欸', 'fdgdfgsewrsdf', '#431fad'),
(2494, 1474294422, '就不向你', 'fdgdfgsewrsdf', '#431fad'),
(2495, 1474294425, '搞屁', 'asdfdgfgasdasd', '#c4090d'),
(2496, 1474294427, '干我鳥是', 'asdfdgfgasdasd', '#c4090d'),
(2497, 1474294433, '好啦', 'fdgdfgsewrsdf', '#431fad'),
(2498, 1474294437, '該做隱藏了', 'fdgdfgsewrsdf', '#431fad'),
(2499, 1474294441, '也是', 'asdfdgfgasdasd', '#c4090d'),
(2500, 1474294443, '123', 'asdfdgfgasdasd', '#c4090d'),
(2501, 1474294453, 'sssdfds', 'fdgdfgsewrsdf', '#431fad'),
(2502, 1474294458, '       sdfsd', 'fdgdfgsewrsdf', '#431fad'),
(2503, 1474294462, '&lt;br&gt;sadas', 'fdgdfgsewrsdf', '#431fad'),
(2504, 1474294476, 'sdfsdf', 'fdgdfgsewrsdf', '#431fad'),
(2505, 1474294868, 'sdsfd', 'fdgdfgsewrsdf', '#431fad'),
(2506, 1474294870, 'qweqwe', 'fdgdfgsewrsdf', '#431fad'),
(2507, 1474295691, 'sadasd', '原來是我= =', '#431fad'),
(2508, 1474295795, '大家安安', '阿飛的伊芙琳', '#c4090d'),
(2509, 1474295808, '= =', '阿飛的伊芙琳', '#c4090d'),
(2510, 1474295811, '側是', '阿飛的伊芙琳', '#c4090d'),
(2511, 1474295815, '測試', '阿飛的伊芙琳', '#c4090d'),
(2512, 1474295863, '在線上', '阿飛的伊芙琳', '#c4090d'),
(2513, 1474295867, '213', '阿飛的伊芙琳', '#c4090d'),
(2514, 1474295868, '3213132', '阿飛的伊芙琳', '#c4090d'),
(2515, 1474295870, '313123', '阿飛的伊芙琳', '#c4090d'),
(2516, 1474295871, '2313', '阿飛的伊芙琳', '#c4090d'),
(2517, 1474295897, '...', '阿飛的伊芙琳', '#c4090d'),
(2518, 1474295912, '　sadasd', 'fsdfsd', '#c4090d'),
(2519, 1474295916, 'dfsdfsd', 'fsdfsd', '#c4090d'),
(2520, 1474295925, 'asdsada    ', 'fsdfsd', '#c4090d'),
(2521, 1474295936, '&lt;br&gt;asasdas', 'fsdfsd<br>', '#c4090d'),
(2522, 1474295947, 'saasdasd', 'fsdfsd<br>', '#c4090d'),
(2523, 1474295985, '&lt;br&gt;', 'fsdfsd<br>', '#c4090d'),
(2524, 1474296163, '&amp;lt;br&amp;gt;132&amp;lt;br&amp;gt;', 'fsdfsd&lt;br&gt;', '#c4090d'),
(2525, 1474296229, '31323', 'fsdfsd&lt;br&gt;', '#c4090d'),
(2526, 1474296232, '23123', 'fsdfsd&lt;br&gt;', '#c4090d'),
(2527, 1474296235, '&amp;lt;br&amp;gt;', 'fsdfsd&lt;br&gt;', '#c4090d'),
(2528, 1474296288, '&lt;br&gt;', 'fsdfsd&lt;br&gt;', '#c4090d'),
(2529, 1474296444, '&lt;br&gt;asdsda', '&lt;br&gt;fsdfsd&lt;br&gt;', '#c4090d'),
(2530, 1474296448, 'qweqwe', '&lt;br&gt;fsdfsd&lt;br&gt;', '#c4090d'),
(2531, 1474296455, 'asdasdqwe', '&lt;br&gt;fsdfsd&lt;br&gt;', '#c4090d'),
(2532, 1474296459, 'asdasdsad', '&lt;br&gt;fsdfsd&lt;br&gt;', '#c4090d'),
(2533, 1474296649, '&lt;br&gt; &lt;br&gt;', '&lt;br&gt;fsdfsd&lt;br&gt;', '#c4090d'),
(2534, 1474296728, 'sdfsdfsdf&lt;br&gt;', '&lt;br&gt;fsdfsd&lt;br&gt;', '#c4090d'),
(2535, 1474296763, '你是誰', '我不認識你', '#2e09c4'),
(2536, 1474296767, '= =', '&lt;br&gt;fsdfsd&lt;br&gt;', '#c4090d'),
(2537, 1474296771, '&lt;br&gt;', '&lt;br&gt;fsdfsd&lt;br&gt;', '#c4090d'),
(2538, 1474296809, 'asdads', '&lt;br&gt;fsdfsd&lt;br&gt;', '#c4090d'),
(2539, 1474296812, 'asdasd', '我不認識你', '#2e09c4'),
(2540, 1474296832, 'adasd', '&lt;br&gt;fsdfsd&lt;br&gt;', '#c4090d'),
(2541, 1474296843, 'ewewrwer', '我不認識你', '#2e09c4'),
(2542, 1474297283, 'sdfsdf', '&lt;br&gt;fsdfsd&lt;br&gt;', '#c4090d'),
(2543, 1474297291, '我是誰', '測試人員', '#c4090d'),
(2544, 1474297295, '...', '測試人員', '#c4090d'),
(2545, 1474297306, '21', '測試人員', '#c4090d'),
(2546, 1474297307, '332322322', '測試人員', '#c4090d'),
(2547, 1474297309, '22322', '測試人員', '#c4090d'),
(2548, 1474297311, '312321', '測試人員', '#c4090d'),
(2549, 1474297312, '123123', '測試人員', '#c4090d'),
(2550, 1474297313, '213', '測試人員', '#c4090d'),
(2551, 1474297314, '123123', '測試人員', '#c4090d'),
(2552, 1474297316, '123123123', '測試人員', '#c4090d'),
(2553, 1474297318, '123123', '測試人員', '#c4090d'),
(2554, 1474297330, '132', '測試人員', '#c4090d'),
(2555, 1474297332, '3123', '測試人員', '#c4090d'),
(2556, 1474297455, '23123', '測試人員', '#c4090d'),
(2557, 1474297587, 'dfsdfd', '測試人員', '#c4090d'),
(2558, 1474297592, '1313', '測試人員', '#c4090d'),
(2559, 1474297596, '6456456', '測試人員', '#c4090d'),
(2560, 1474297598, '78465456456', '測試人員', '#c4090d'),
(2561, 1474297610, '21231', '測試人員', '#c4090d'),
(2562, 1474297611, '3132132', '測試人員', '#c4090d'),
(2563, 1474297612, '123132123132', '測試人員', '#c4090d'),
(2564, 1474297612, '1321231', '測試人員', '#c4090d'),
(2565, 1474297613, '3213213211', '測試人員', '#c4090d'),
(2566, 1474297613, '2313', '測試人員', '#c4090d'),
(2567, 1474297614, '213213213213132', '測試人員', '#c4090d'),
(2568, 1474297614, '1321', '測試人員', '#c4090d'),
(2569, 1474297615, '321321321321', '測試人員', '#c4090d'),
(2570, 1474297615, '13', '測試人員', '#c4090d'),
(2571, 1474297616, '123132131312', '測試人員', '#c4090d'),
(2572, 1474297617, '1', '測試人員', '#c4090d'),
(2573, 1474297618, '2', '測試人員', '#c4090d'),
(2574, 1474297619, '3', '測試人員', '#c4090d'),
(2575, 1474297621, '45', '測試人員', '#c4090d'),
(2576, 1474297622, '6', '測試人員', '#c4090d'),
(2577, 1474297623, '78', '測試人員', '#c4090d'),
(2578, 1474297625, '9', '測試人員', '#c4090d'),
(2579, 1474297626, '10', '測試人員', '#c4090d'),
(2580, 1474297628, '11', '測試人員', '#c4090d'),
(2581, 1474297629, '12', '測試人員', '#c4090d'),
(2582, 1474297632, '13', '測試人員', '#c4090d');

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
(1101, 1474297655, '測試人員');

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
(1, 1474297632);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2583;
--
-- 使用資料表 AUTO_INCREMENT `onlineusers`
--
ALTER TABLE `onlineusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1102;
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
