-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-03-18 09:12:23
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- 表的结构 `goods`
--

CREATE TABLE `goods` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '编号',
  `name` varchar(64) NOT NULL COMMENT '商品名称',
  `typeid` varchar(10) NOT NULL COMMENT '商品类型',
  `price` double UNSIGNED NOT NULL COMMENT '商品价格',
  `total` int(10) UNSIGNED NOT NULL COMMENT '库存量',
  `pic` varchar(32) NOT NULL COMMENT '商品图片',
  `note` text NOT NULL COMMENT '商品描述',
  `addtime` int(10) UNSIGNED NOT NULL COMMENT '发布时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `goods`
--

INSERT INTO `goods` (`id`, `name`, `typeid`, `price`, `total`, `pic`, `note`, `addtime`) VALUES
(4, '手机', '1', 1200, 30, '201803171122071088.jpg', '呀呀', 1521285607),
(3, '笔记本', '1', 4500, 20, '201803171122393513.JPG', '啊啊啊', 1521274120),
(11, '手机', '1', 2300, 10, '201803180833273442.jpg', '呀呀呀', 1521361889),
(10, '手机', '数码', 1800, 10, '201803180829281214.jpg', '呃呃呃', 1521361768);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '编号', AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
