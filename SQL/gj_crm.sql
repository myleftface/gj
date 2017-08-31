CREATE TABLE `gj_user` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
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


CREATE TABLE `gj_customer` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `entry_date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `contract_date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `cus_phone` varchar(20) NOT NULL DEFAULT '',
  `cell_address` varchar(255) NOT NULL DEFAULT '',
  `brand` varchar(50) NOT NULL DEFAULT '',
  `floor_space` varchar(50) NOT NULL DEFAULT '',
  `handover_date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `total_value` varchar(50)  NOT NULL DEFAULT '0',
  `desigin_fee` varchar(50)  NOT NULL DEFAULT '0',
  `source` varchar(50) NOT NULL DEFAULT '',
  `designer` varchar(50) NOT NULL DEFAULT '',
  `submitter` varchar(50) NOT NULL DEFAULT '',
  `cus_level` varchar(50) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `gj_performance` (
  `id` int(11) UNSIGNED NOT NULL,
  `contract_id` varchar(50)  NOT NULL DEFAULT '',
  `payment_status` varchar(50) NOT NULL DEFAULT '0',
  `entry_date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `contract_date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `cus_name` varchar(50) NOT NULL DEFAULT '',
  `cus_phone` varchar(20) NOT NULL DEFAULT '',
  `cell_address` varchar(255) NOT NULL DEFAULT '',
  `brand` varchar(50) NOT NULL DEFAULT '',
  `floor_space` varchar(50) NOT NULL DEFAULT '',
  `start_date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `total_value` varchar(50)  NOT NULL DEFAULT '0',
  `desigin_fee` varchar(50)  NOT NULL DEFAULT '0',
  `source` varchar(50) NOT NULL DEFAULT '',
  `designer` varchar(50) NOT NULL DEFAULT '',
  `submitter` varchar(50) NOT NULL DEFAULT '',
  `auditor` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;