-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2014 at 07:55 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `social_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `be_acl_actions`
--

CREATE TABLE IF NOT EXISTS `be_acl_actions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(254) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `be_acl_groups`
--

CREATE TABLE IF NOT EXISTS `be_acl_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lft` int(10) unsigned NOT NULL DEFAULT '0',
  `rgt` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(254) NOT NULL,
  `link` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `be_acl_groups`
--

INSERT INTO `be_acl_groups` (`id`, `lft`, `rgt`, `name`, `link`) VALUES
(1, 1, 4, 'Member', NULL),
(2, 2, 3, 'Administrator', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `be_acl_permissions`
--

CREATE TABLE IF NOT EXISTS `be_acl_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) unsigned NOT NULL DEFAULT '0',
  `aco_id` int(10) unsigned NOT NULL DEFAULT '0',
  `allow` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `aro_id` (`aro_id`),
  KEY `aco_id` (`aco_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `be_acl_permissions`
--

INSERT INTO `be_acl_permissions` (`id`, `aro_id`, `aco_id`, `allow`) VALUES
(1, 2, 1, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `be_acl_permission_actions`
--

CREATE TABLE IF NOT EXISTS `be_acl_permission_actions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `access_id` int(10) unsigned NOT NULL DEFAULT '0',
  `axo_id` int(10) unsigned NOT NULL DEFAULT '0',
  `allow` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `access_id` (`access_id`),
  KEY `axo_id` (`axo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `be_acl_resources`
--

CREATE TABLE IF NOT EXISTS `be_acl_resources` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lft` int(10) unsigned NOT NULL DEFAULT '0',
  `rgt` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(254) NOT NULL,
  `link` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `be_acl_resources`
--

INSERT INTO `be_acl_resources` (`id`, `lft`, `rgt`, `name`, `link`) VALUES
(1, 1, 22, 'Site', NULL),
(2, 2, 21, 'Control Panel', NULL),
(3, 3, 20, 'System', NULL),
(4, 14, 15, 'Members', NULL),
(5, 4, 13, 'Access Control', NULL),
(6, 16, 17, 'Settings', NULL),
(7, 18, 19, 'Utilities', NULL),
(8, 11, 12, 'Permissions', NULL),
(9, 9, 10, 'Groups', NULL),
(10, 7, 8, 'Resources', NULL),
(11, 5, 6, 'Actions', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `be_backups`
--

CREATE TABLE IF NOT EXISTS `be_backups` (
  `backup_id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(100) NOT NULL,
  `backup_date` datetime NOT NULL,
  PRIMARY KEY (`backup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `be_groups`
--

CREATE TABLE IF NOT EXISTS `be_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `locked` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `be_groups`
--

INSERT INTO `be_groups` (`id`, `locked`, `disabled`) VALUES
(1, 1, 0),
(2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `be_preferences`
--

CREATE TABLE IF NOT EXISTS `be_preferences` (
  `name` varchar(254) NOT NULL,
  `value` text NOT NULL,
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `be_preferences`
--

INSERT INTO `be_preferences` (`name`, `value`) VALUES
('default_user_group', '1'),
('smtp_host', ''),
('keep_error_logs_for', '30'),
('email_protocol', 'sendmail'),
('use_registration_captcha', '0'),
('page_debug', '0'),
('automated_from_name', 'Momo Engine'),
('allow_user_registration', '1'),
('use_login_captcha', '0'),
('site_name', 'Momo Engine Rapid Web Application Development Engine'),
('automated_from_email', 'noreply@momoengine.com'),
('account_activation_time', '7'),
('allow_user_profiles', '0'),
('activation_method', 'email'),
('autologin_period', '30'),
('min_password_length', '8'),
('smtp_user', ''),
('smtp_pass', ''),
('email_mailpath', '/usr/sbin/sendmail'),
('smtp_port', '25'),
('smtp_timeout', '5'),
('email_wordwrap', '1'),
('email_wrapchars', '76'),
('email_mailtype', 'html'),
('email_charset', 'utf-8'),
('bcc_batch_mode', '0'),
('bcc_batch_size', '200'),
('login_field', 'both'),
('meta_keywords', 'Momo Engine Fastest Web Application Development Engine'),
('meta_description', 'Momo Engine Fastest Web Application Development Engine'),
('offline_message', ''),
('theme', 'default'),
('site_status', '1'),
('date_format', 'Y-m-d'),
('date_time_format', 'Y-m-d H:i:s'),
('backup_path', 'backups'),
('google_analytics_tracking_code', ''),
('activate_google_analytics', '0'),
('facebook_app_id', '388405684623369'),
('facebook_app_secret', 'f2bb6479aad98da4d210e44d724f77f0'),
('facebook_fan_page_id', ''),
('facebook_fan_page_url', ''),
('facebook_page_access_token', ''),
('activate_facebook', '1');

-- --------------------------------------------------------

--
-- Table structure for table `be_resources`
--

CREATE TABLE IF NOT EXISTS `be_resources` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `locked` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `be_resources`
--

INSERT INTO `be_resources` (`id`, `locked`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `be_shortcuts`
--

CREATE TABLE IF NOT EXISTS `be_shortcuts` (
  `shortcut_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` text NOT NULL,
  `new_window` tinyint(4) NOT NULL,
  `display_order` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`shortcut_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `be_users`
--

CREATE TABLE IF NOT EXISTS `be_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(254) NOT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `group` int(10) unsigned DEFAULT NULL,
  `activation_key` varchar(32) DEFAULT NULL,
  `last_visit` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `password` (`password`),
  KEY `group` (`group`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `be_users`
--

INSERT INTO `be_users` (`id`, `username`, `password`, `email`, `active`, `group`, `activation_key`, `last_visit`, `created`, `modified`) VALUES
(1, 'admin', '23c84a18ccc4dfda823dc4ed5bfe1eb58d99c76f', 'ruman_ranjit@yahoo.com', 1, 2, NULL, '2014-07-02 12:10:32', '2014-06-23 16:35:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `be_user_profiles`
--

CREATE TABLE IF NOT EXISTS `be_user_profiles` (
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `be_user_profiles`
--

INSERT INTO `be_user_profiles` (`user_id`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `user_data` text NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE IF NOT EXISTS `email_templates` (
  `email_template_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug_name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`email_template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `layouts`
--

CREATE TABLE IF NOT EXISTS `layouts` (
  `layout_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`layout_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `slug_id` int(11) NOT NULL,
  `slug_name` varchar(250) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `key` varchar(100) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `slugs`
--

CREATE TABLE IF NOT EXISTS `slugs` (
  `slug_id` int(11) NOT NULL AUTO_INCREMENT,
  `slug_name` varchar(250) NOT NULL,
  `route` varchar(255) NOT NULL,
  PRIMARY KEY (`slug_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_completed_tasks`
--

CREATE TABLE IF NOT EXISTS `tbl_completed_tasks` (
  `completed_task_id` int(11) NOT NULL AUTO_INCREMENT,
  `schedule_id` int(11) NOT NULL,
  `posted_date` datetime NOT NULL,
  `facebook_post_id` varchar(255) NOT NULL,
  PRIMARY KEY (`completed_task_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_completed_tasks`
--

INSERT INTO `tbl_completed_tasks` (`completed_task_id`, `schedule_id`, `posted_date`, `facebook_post_id`) VALUES
(1, 2, '2014-06-26 19:27:04', '599474270166789'),
(2, 3, '2014-06-26 19:43:43', '124350264291193_698394093553471');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contents`
--

CREATE TABLE IF NOT EXISTS `tbl_contents` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT,
  `content_title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `type` enum('Link','Photo','Post') NOT NULL,
  `added_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  `fanpage_id` int(11) NOT NULL,
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_contents`
--

INSERT INTO `tbl_contents` (`content_id`, `content_title`, `content`, `type`, `added_date`, `status`, `fanpage_id`) VALUES
(1, 'Facebook', '', 'Link', '2014-06-23 17:52:24', 1, 0),
(2, 'Facebook Automation Test', '', 'Link', '2014-06-24 10:18:44', 1, 0),
(3, 'imdb', '', 'Link', '2014-06-24 12:10:05', 1, 0),
(4, 'hello', '', 'Link', '2014-06-26 10:10:23', 1, 0),
(5, 'my post', '', 'Post', '2014-07-02 13:47:40', 1, 0),
(6, 'My link', 'www.facebook.com', 'Link', '2014-07-02 13:49:58', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_facebook_page_tokens`
--

CREATE TABLE IF NOT EXISTS `tbl_facebook_page_tokens` (
  `facebook_page_token_id` int(11) NOT NULL AUTO_INCREMENT,
  `facebook_page_id` int(11) NOT NULL,
  `facebook_page_name` varchar(255) NOT NULL,
  `access_token` text NOT NULL,
  PRIMARY KEY (`facebook_page_token_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_facebook_page_tokens`
--

INSERT INTO `tbl_facebook_page_tokens` (`facebook_page_token_id`, `facebook_page_id`, `facebook_page_name`, `access_token`) VALUES
(1, 2147483647, '0', 'CAAU3lyFkuQsBACOinsB3NNg4Enl7Czd7fh1RT3zOa9ykaluUATlG6YtyKKghi1POZBpgw0bgOYqQ7cJbhcddquTOb0yclBZAeuZCuAlxxqsZAB6A3E9JiPYHgqhYtsjoWikCtebA6K8MokCNAzZAq5zRcF9tQVRDAAfRh4IqhGtS4Tt9yUsA2'),
(2, 2147483647, '0', 'CAAU3lyFkuQsBACOinsB3NNg4Enl7Czd7fh1RT3zOa9ykaluUATlG6YtyKKghi1POZBpgw0bgOYqQ7cJbhcddquTOb0yclBZAeuZCuAlxxqsZAB6A3E9JiPYHgqhYtsjoWikCtebA6K8MokCNAzZAq5zRcF9tQVRDAAfRh4IqhGtS4Tt9yUsA2'),
(3, 2147483647, 'Shoryukane Cause', 'CAAU3lyFkuQsBAA35EjRbcd9fuO4zplQPn36ZC67maCDRIXBXwlSAuLwtvqgtTBM8pUYxB7CHBuq8KFmTzyM67X3fbW4G8Jr1XDX2alH0lHjciFJ2Uy9KwZBM5fjYkI1x50I2DjEzqHnBIsUHLsVo5r62DaBrWdembXk1nszWjnnlQs4cAkWGhbjpgx1voZD'),
(4, 2147483647, 'Shoryukane Cause', 'CAAU3lyFkuQsBAEJt5mxun6Y20o4KD9ZBKVc9zTRvScVnMZAOOq2fMZCFiQHn5WJRis9shoZBqZCD28TrL2bMqWqlPVPelqPrNa4TBUKFJ5SIZBtoXtEkdUurayZCpmDSsZAX1xInQ0HXTLt9U10gFakxvay93TVZCfG3WntErYWaZBMQO9ZCEZAJcOEp'),
(5, 2147483647, 'Shoryukane Cause', 'CAAU3lyFkuQsBAEJt5mxun6Y20o4KD9ZBKVc9zTRvScVnMZAOOq2fMZCFiQHn5WJRis9shoZBqZCD28TrL2bMqWqlPVPelqPrNa4TBUKFJ5SIZBtoXtEkdUurayZCpmDSsZAX1xInQ0HXTLt9U10gFakxvay93TVZCfG3WntErYWaZBMQO9ZCEZAJcOEp');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fanpages`
--

CREATE TABLE IF NOT EXISTS `tbl_fanpages` (
  `fanpage_id` int(11) NOT NULL AUTO_INCREMENT,
  `facebook_page_id` varchar(100) NOT NULL,
  `facebook_page_name` varchar(100) NOT NULL,
  `access_token` text NOT NULL,
  `added_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`fanpage_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_fanpages`
--

INSERT INTO `tbl_fanpages` (`fanpage_id`, `facebook_page_id`, `facebook_page_name`, `access_token`, `added_date`, `modified_date`, `status`) VALUES
(1, '689395047743834', 'Momo Engine Rapid Web Application Development Engine', 'CAADD6V9lTnQBADlq2dvlZCxsL2NEX2N3B9vlxZCkb6emZAnZCNB3SQX2dM7cA8S1s2WyhfSH7x9h0x1SVL6ZC0Ep374e0pGGpEunGtAs0zOoCTNzizQZBZBSkZBZBUp1TmDHwHq7a3VZApsk3unBfUaKdNF9ZCKPUZAYUNfjtCZAldZBACRMfecXSG63ptLzmYO6JwnGIZD', '0000-00-00 00:00:00', '2014-06-25 13:44:02', 1),
(2, '291300610984158', 'Afnobazaar.com', 'CAADD6V9lTnQBANGXFbOhE6k8Y8TV6itYsSyzWUq9lDWsGq5I6i7TgUgqIKoMLu33N2hhB6BuL73NVHMFVs6qhlPQWazCMcVlaoKxbMZCSqnEkpZCGzR86pLqQ5E6V7Uy8ERWEosOx6wZBKBGD24HBMfhLm6T7CDHWaXWnH0aIt6kapuwl8eaEXCwpkKeuAZD', '0000-00-00 00:00:00', '2014-06-25 15:58:33', 1),
(3, '305464502807286', 'No Fuel Day (Nepal)', 'CAAFhQL7cWAkBAC6eSR4kpNZA0JeclJcNeYlCGNQDsTvDZCwzqigAhHh2uj98WPBjjT9CqHQChWAZAT6fZB4DWKNZCFhipODDH4c5ZC3zc8CvqcBBopHqSMkKuaYuSxPdlFGymQOcKSJk5DxuiZBnRcX16FYklZBa6Y8sBJo2krsiVlETbRsZB44Jn', '0000-00-00 00:00:00', '2014-06-25 15:58:51', 1),
(4, '124350264291193', 'Dixanta Bahadur Shrestha', 'CAAFhQL7cWAkBANAcyHkTZBuH3SJQBdUDv6GNP7haBRqfFirGqWY8Ty5EL8f7x7SL12pv9899QzKGNVtSpYo0J1wl65IzvpjHoE9sj7DEn71MZB3F5HKS8Jp5BWiH9TSeeSamkeh8CIb2iG5ZBFms6z4O5I2uPVtqbYZBKdXoATQHij1ohK1pyelrBRMurroZD', '0000-00-00 00:00:00', '2014-06-25 15:58:38', 1),
(5, '250922101644687', 'E-space Nepal', 'CAAFhQL7cWAkBAHEMNRFf8F0LZBZBCQlT85p882bJjUxZCskITiJ3g74VCSVPgZB3lnXZAeYOIkGGZBMWPLWk8J87gdIZBDarcSQOSPLoVcv9PbCCFeRL9Im53SZAZCaX65gb7zqn6Rc0ezo06m3E7rDnkBVIgJrlIf6mKDSw4lM5bS9uMxptEvJzjp9VYgArZAQAwZD', '0000-00-00 00:00:00', '2014-06-25 15:58:44', 1),
(6, '97763327626', 'Pagoda Labs', 'CAAFhQL7cWAkBAM3I8e8qiHcwSaIdfrmzTmq1lO7RjLHKpnnEPP55P3Tqb6mYHwVLojEQrwhyTcMtAvOo12sME1JPQ44DDU1QIVqsquuzVrnbtx6t1ZAZCK4QKQONjuSLG6qOpjmni4gGkHzC2Yx6Mt2KP65hcR8X7dyGgU0TItN40R60C7', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(7, '637739106239821', 'Blue Mountain Institute of Technology', 'CAAFhQL7cWAkBAGLP6p2TwzejCPOVBPTVJJi7jzH5XKGZA2ZBPeMZB47LPp3RRh0d2lbux3CVXJggMLgW2ZBKc4PxaA4YHqfRui10jmdm4sGeq2I01I04IAhNLVoInhkZAeEFYICUn5c0mod7nVZC405qMyQiKonLBrc5QJhr65766vk7lWXxXlJXFuZAvhgMHMZD', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(8, '338053142889069', 'Nepal Inked', 'CAAFhQL7cWAkBAEzXFyaSwrJDvMDoxXmzQVdOaB3ovoSRoT1wTC8uR7B0ypjNA4oQDXvFIQGBLfF6fhXI2vMmmMsaf7PaluZAPiqrDWxMEs5RA4KomsZBDkld5nUdvypgWZAFsnER0VGm4GzRcSVUpB8cbHsj2JOLww0mRCAM1jk3OZBiCkLi', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedules`
--

CREATE TABLE IF NOT EXISTS `tbl_schedules` (
  `schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) NOT NULL,
  `fanpage_id` int(11) NOT NULL,
  `post_date` datetime NOT NULL,
  `is_repeat` tinyint(4) NOT NULL,
  `days` varchar(7) NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`schedule_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_schedules`
--

INSERT INTO `tbl_schedules` (`schedule_id`, `content_id`, `fanpage_id`, `post_date`, `is_repeat`, `days`, `time`) VALUES
(2, 2, 2, '2014-06-25 19:44:15', 1, '0000100', '19:26:40'),
(3, 2, 4, '2014-06-26 19:43:40', 0, '', '00:00:00'),
(4, 2, 5, '2014-06-25 19:44:59', 0, '', '00:00:00'),
(5, 1, 6, '2014-06-27 01:16:12', 0, '0000000', '00:00:00'),
(6, 4, 7, '2014-06-26 13:56:50', 1, '1100001', '02:00:00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `be_acl_permissions`
--
ALTER TABLE `be_acl_permissions`
  ADD CONSTRAINT `be_acl_permissions_ibfk_1` FOREIGN KEY (`aro_id`) REFERENCES `be_acl_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `be_acl_permissions_ibfk_2` FOREIGN KEY (`aco_id`) REFERENCES `be_acl_resources` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `be_acl_permission_actions`
--
ALTER TABLE `be_acl_permission_actions`
  ADD CONSTRAINT `be_acl_permission_actions_ibfk_1` FOREIGN KEY (`access_id`) REFERENCES `be_acl_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `be_acl_permission_actions_ibfk_2` FOREIGN KEY (`axo_id`) REFERENCES `be_acl_actions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `be_groups`
--
ALTER TABLE `be_groups`
  ADD CONSTRAINT `be_groups_ibfk_1` FOREIGN KEY (`id`) REFERENCES `be_acl_groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `be_resources`
--
ALTER TABLE `be_resources`
  ADD CONSTRAINT `be_resources_ibfk_1` FOREIGN KEY (`id`) REFERENCES `be_acl_resources` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `be_users`
--
ALTER TABLE `be_users`
  ADD CONSTRAINT `be_users_ibfk_1` FOREIGN KEY (`group`) REFERENCES `be_acl_groups` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `be_user_profiles`
--
ALTER TABLE `be_user_profiles`
  ADD CONSTRAINT `be_user_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `be_users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
