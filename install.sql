-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2021-08-02 11:50:34
-- 服务器版本： 5.6.32-log
-- PHP 版本： 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `zsctf`
--

-- --------------------------------------------------------

--
-- 表的结构 `zsctf_admin`
--

CREATE TABLE `zsctf_admin` (
  `uid` bigint(20) UNSIGNED NOT NULL,
  `pwd` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `zsctf_admin`
--

INSERT INTO `zsctf_admin` (`uid`, `pwd`) VALUES
(12345678900, '$2y$10$fetCSoGET.3NG1bdaQf6GOu0QUYiuC75XJtm5p8ZfodXAu0IyNx4y');

-- --------------------------------------------------------

--
-- 表的结构 `zsctf_member`
--

CREATE TABLE `zsctf_member` (
  `name` text NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `zsctf_member`
--

INSERT INTO `zsctf_member` (`name`, `id`, `password`) VALUES
('测试一', 111111111111, '$2y$10$I4NSk3Cg2499OlMEYkJBe.nFLJB8pVspwzZPjgd83psGp3Vjks8hm');

-- --------------------------------------------------------

--
-- 表的结构 `zsctf_signed`
--

CREATE TABLE `zsctf_signed` (
  `status` text NOT NULL,
  `date` date NOT NULL,
  `name` text NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `zsctf_signed`
--

INSERT INTO `zsctf_signed` (`status`, `date`, `name`, `id`, `note`) VALUES
('请假', '2021-08-02', '测试一', 111111111111, '测试请假'),
('√', '2021-08-02', '测试一', 111111111111, '-');

-- --------------------------------------------------------

--
-- 表的结构 `zsctf_token`
--

CREATE TABLE `zsctf_token` (
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `zsctf_token`
--

INSERT INTO `zsctf_token` (`token`) VALUES
('djksABFHKSTZ1257');

--
-- 转储表的索引
--

--
-- 表的索引 `zsctf_admin`
--
ALTER TABLE `zsctf_admin`
  ADD PRIMARY KEY (`uid`);

--
-- 表的索引 `zsctf_member`
--
ALTER TABLE `zsctf_member`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
