-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2020-10-08 05:14:29
-- 服务器版本： 10.4.14-MariaDB
-- PHP 版本： 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `laravel`
--

-- --------------------------------------------------------

--
-- 表的结构 `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '姓名',
  `age` tinyint(4) NOT NULL DEFAULT 0 COMMENT '年龄',
  `sex` tinyint(4) NOT NULL DEFAULT 0 COMMENT '性别',
  `updated_at` int(11) DEFAULT 0 COMMENT '添加时间',
  `created_at` int(11) DEFAULT 0 COMMENT '修改时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='学生表';

--
-- 转存表中的数据 `student`
--

INSERT INTO `student` (`id`, `name`, `age`, `sex`, `updated_at`, `created_at`) VALUES
(1, '小白', 24, 0, 0, 0),
(2, '小黑', 30, 0, 0, 0),
(3, '小亮', 25, 0, 0, 0),
(4, '小王', 26, 0, 0, 0),
(5, '小白', 24, 0, 0, 0),
(6, '小黑', 30, 0, 0, 0),
(7, '小亮', 25, 0, 0, 0),
(8, '小王', 26, 0, 0, 0),
(9, '小白', 24, 0, 0, 0),
(10, '小黑', 30, 0, 0, 0),
(11, '小亮', 25, 0, 0, 0),
(12, '小王', 26, 0, 0, 0);

--
-- 转储表的索引
--

--
-- 表的索引 `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
