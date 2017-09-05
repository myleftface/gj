-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017-09-05 11:31:18
-- 服务器版本： 5.7.17-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gj_crm`
--

-- --------------------------------------------------------

--
-- 表的结构 `gj_admin`
--

CREATE TABLE `gj_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `last_login_time` int(11) NOT NULL DEFAULT '0',
  `last_login_ip` varchar(20) NOT NULL DEFAULT '',
  `status` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `gj_admin`
--

INSERT INTO `gj_admin` (`id`, `username`, `password`, `create_time`, `update_time`, `last_login_time`, `last_login_ip`, `status`) VALUES
(1, 'admin', 'admin', 0, 0, 0, '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `gj_admin_account`
--

CREATE TABLE `gj_admin_account` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `last_login_time` int(11) NOT NULL DEFAULT '0',
  `last_login_ip` varchar(20) NOT NULL DEFAULT '',
  `status` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `gj_admin_account`
--

INSERT INTO `gj_admin_account` (`id`, `username`, `password`, `create_time`, `update_time`, `last_login_time`, `last_login_ip`, `status`) VALUES
(1, 'admin', 'admin', 0, 0, 0, '', 0),
(2, 'wayne', 'wayne', 0, 0, 0, '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `gj_customer`
--

CREATE TABLE `gj_customer` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `entry_date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `contract_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `contract_date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `cus_phone` varchar(20) NOT NULL DEFAULT '',
  `cell_address` varchar(255) NOT NULL DEFAULT '',
  `brand` varchar(50) NOT NULL DEFAULT '',
  `floor_space` varchar(50) NOT NULL DEFAULT '',
  `handover_date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `total_value` varchar(50) NOT NULL DEFAULT '',
  `design_fee` varchar(50) NOT NULL DEFAULT '',
  `source` varchar(50) NOT NULL DEFAULT '',
  `designer` varchar(50) NOT NULL DEFAULT '',
  `submitter` varchar(50) NOT NULL DEFAULT '',
  `cus_level` varchar(50) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `payment_status` varchar(50) NOT NULL DEFAULT '',
  `start_date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `gj_customer`
--

INSERT INTO `gj_customer` (`id`, `name`, `entry_date`, `contract_id`, `contract_date`, `cus_phone`, `cell_address`, `brand`, `floor_space`, `handover_date`, `total_value`, `design_fee`, `source`, `designer`, `submitter`, `cus_level`, `description`, `payment_status`, `start_date`, `status`, `create_time`, `update_time`) VALUES
(1, '张飞', 1501516800, 0, 0, '123456', '山里小区', '123456', '123456', 0, '', '', '莫晓燕', '张飞', '孙文浩', 'A', '挺好的', '', 0, 0, 1504593590, 1504593590),
(2, '关羽', 1504195200, 0, 0, '123456', '山里小区', '12346', '123456', 0, '', '', '12346', 'admin4', '孙文浩', 'B', '二爷', '', 0, 0, 1504593633, 1504593633),
(3, '刘备', 1505836800, 0, 0, '12346642', '山里小区啊', '123456', '211', 0, '', '', '1234566', '张飞', '孙文浩', 'C', '不想交钱', '', 0, 0, 1504593670, 1504593670),
(4, '张飞', 1504540800, 0, 0, '123', '', '', '', 0, '', '', '是', 'admin4', '是', 'A', '是', '', 0, 0, 1504603808, 1504603808),
(5, '', 0, 0, 1504627200, '', '', '', '', 1504627200, 'qq', 'qq', '', '', '', '', '', 'qq', 0, 0, 1504609899, 1504609899);

-- --------------------------------------------------------

--
-- 表的结构 `gj_customer_account`
--

CREATE TABLE `gj_customer_account` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `entry_date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `contract_id` int(11) UNSIGNED NOT NULL,
  `contract_date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `cus_phone` varchar(20) NOT NULL DEFAULT '',
  `cell_address` varchar(255) NOT NULL DEFAULT '',
  `brand` varchar(50) NOT NULL DEFAULT '',
  `floor_space` varchar(50) NOT NULL DEFAULT '',
  `handover_date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `total_value` varchar(50) NOT NULL DEFAULT '0',
  `desigin_fee` varchar(50) NOT NULL DEFAULT '0',
  `source` varchar(50) NOT NULL DEFAULT '',
  `designer` varchar(50) NOT NULL DEFAULT '',
  `submitter` varchar(50) NOT NULL DEFAULT '',
  `cus_level` varchar(50) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `payment_status` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `gj_deal`
--

CREATE TABLE `gj_deal` (
  `id` int(11) UNSIGNED NOT NULL,
  `contract_id` varchar(50) NOT NULL DEFAULT '',
  `payment_status` varchar(50) NOT NULL DEFAULT '0',
  `entry_date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `contract_date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `cus_name` varchar(50) NOT NULL DEFAULT '',
  `cus_phone` varchar(20) NOT NULL DEFAULT '',
  `cell_address` varchar(255) NOT NULL DEFAULT '',
  `brand` varchar(50) NOT NULL DEFAULT '',
  `floor_space` varchar(50) NOT NULL DEFAULT '',
  `start_date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `total_value` varchar(50) NOT NULL DEFAULT '0',
  `desigin_fee` varchar(50) NOT NULL DEFAULT '0',
  `source` varchar(50) NOT NULL DEFAULT '',
  `designer` varchar(50) NOT NULL DEFAULT '',
  `submitter` varchar(50) NOT NULL DEFAULT '',
  `auditor` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `gj_department`
--

CREATE TABLE `gj_department` (
  `id` int(11) NOT NULL,
  `d_name` varchar(32) NOT NULL DEFAULT '',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `gj_department`
--

INSERT INTO `gj_department` (`id`, `d_name`, `create_time`, `update_time`, `status`) VALUES
(1, '总监', 0, 0, 0),
(2, '设计部', 0, 0, 0),
(3, '市场部', 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `gj_user`
--

CREATE TABLE `gj_user` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `code` varchar(10) NOT NULL,
  `department` varchar(10) NOT NULL DEFAULT '',
  `last_login_ip` varchar(20) NOT NULL DEFAULT '',
  `last_login_time` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `email` varchar(30) NOT NULL DEFAULT '',
  `mobile` varchar(20) NOT NULL DEFAULT '',
  `listorder` int(8) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `gj_user`
--

INSERT INTO `gj_user` (`id`, `username`, `password`, `code`, `department`, `last_login_ip`, `last_login_time`, `email`, `mobile`, `listorder`, `status`, `create_time`, `update_time`) VALUES
(1, 'admin', '20767edcbc90baed50a7830c7b10858f', '1388', '1', '', 1504607120, 'sunwenhao@outlook.com', '', 0, 1, 1504315891, 1504607120),
(2, 'admin123', 'befde42f9835c43de74386f8c608ec19', '2663', '', '', 1504329293, 'admin', '', 0, -1, 1504329283, 1504490179),
(3, 'admin4', 'c9b11006185c34dd245808f8cd4e7c13', '2439', '2', '', 1504398632, 'admin4@gmail.com', '', 0, 1, 1504398504, 1504490183),
(6, 'sunwenhao', 'bf896e2cef381f4e5247a845ffbf8f02', '6372', '2', '', 1504489323, 'sss@163.com', '', 0, -1, 1504489151, 1504490186),
(7, 'zhangfei', 'efba65c8fec4399a016f14a248c46d0b', '9054', '3', '', 0, 'zhangfe@163.cm', '', 0, -1, 1504489771, 1504490190),
(10, '张飞', 'b3eba23f6078b913cdc28075d8649816', '6810', '2', '', 0, 's@164.com', '', 0, 0, 1504492376, 1504492376);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gj_customer`
--
ALTER TABLE `gj_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gj_department`
--
ALTER TABLE `gj_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gj_user`
--
ALTER TABLE `gj_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `gj_customer`
--
ALTER TABLE `gj_customer`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `gj_user`
--
ALTER TABLE `gj_user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
