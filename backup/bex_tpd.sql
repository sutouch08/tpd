-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2021 at 07:00 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bex_tpd`
--

-- --------------------------------------------------------

--
-- Table structure for table `approver`
--

CREATE TABLE `approver` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `emp_name` varchar(100) DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `add_by` int(11) DEFAULT NULL,
  `date_upd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `approver`
--

INSERT INTO `approver` (`id`, `user_id`, `uname`, `emp_name`, `amount`, `status`, `date_add`, `add_by`, `date_upd`, `update_by`) VALUES
(1, 1, 'admin', 'วิรัญญา ตั้งอมรศิริ', '100000000.00', 1, '2021-11-21 18:59:49', -987654321, '2021-11-21 18:59:49', NULL),
(2, 2, 'admin.sup', 'รัศมี ระวังภัย', '299999.00', 1, '2021-11-21 19:00:06', -987654321, '2021-11-21 19:00:06', NULL),
(3, 6, 'manager.overseas', 'วาสินี ตั้งอมรศิริ', '299999.00', 1, '2021-11-21 19:01:57', -987654321, '2021-11-21 19:01:57', NULL),
(4, 5, 'manager.retail', 'ศักรินทร์ ปริศวงศ์', '299999.00', 1, '2021-11-21 19:02:08', -987654321, '2021-11-21 19:02:08', NULL),
(5, 31, 'manager.bangkok', 'Bangkok Bangkok', '299999.00', 1, '2021-11-22 15:13:14', 1, '2021-11-22 15:13:14', NULL),
(6, 32, 'manager.hospital', 'Hospital Hospital', '299999.00', 1, '2021-11-22 15:13:25', 1, '2021-11-22 15:13:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `approve_rule`
--

CREATE TABLE `approve_rule` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `conditions` set('Less Than','Less or Equal','Greater Than','Greater or Equal') DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `sale_team` int(11) DEFAULT NULL,
  `is_price_list` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `add_by` int(11) DEFAULT NULL,
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` int(11) DEFAULT NULL,
  `date_upd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `approve_rule`
--

INSERT INTO `approve_rule` (`id`, `code`, `conditions`, `amount`, `sale_team`, `is_price_list`, `status`, `add_by`, `date_add`, `update_by`, `date_upd`) VALUES
(13, 'RL-21001', 'Less or Equal', '299999.00', 1, 0, 1, 1, '2021-11-27 21:19:58', 1, '2021-11-27 23:08:13'),
(14, 'RL-21002', 'Less or Equal', '299999.00', 3, 0, 1, 1, '2021-11-27 21:20:30', 1, '2021-11-27 23:08:08'),
(15, 'RL-21003', 'Less or Equal', '299999.00', 4, 0, 1, 1, '2021-11-27 21:20:41', 1, '2021-11-27 23:08:03'),
(17, 'RL-21004', 'Less or Equal', '299999.00', 6, 0, 1, 1, '2021-11-27 21:21:44', 1, '2021-11-27 23:07:58');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('43415752b23b3c22e7a829035a2474956a379375', '::1', 1638015721, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383031353732313b),
('d08d346ffa613328e5c43468563ee43b88a0fa0f', '::1', 1638016035, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383031363033353b),
('319b7b83bc7f07c773cbfde71835d5582c42034a', '::1', 1638016760, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383031363736303b),
('3f9f145668ad7a2ea3729627f55cdc956c38c9de', '::1', 1638017160, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383031373136303b),
('29168b3e5faccd41f97f559cd00adfc856e8e40c', '::1', 1638017533, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383031373533333b),
('fc8f6704032aeec74c287f8b2ad8f8f6722d9d09', '::1', 1638017853, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383031373835333b),
('361ab92107d678dfb1236c0cfa702ae02ba36f8d', '::1', 1638018238, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383031383233383b),
('a3f5aa7a8f0cd137300a261ac273bb58d4545275', '::1', 1638018811, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383031383831313b),
('f10c7361c29379905fce868ee353c59b56dbe681', '::1', 1638019114, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383031393131343b),
('dcd67d5febbc2678495a044c7c95acdc93f34fa3', '::1', 1638019449, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383031393434393b),
('25a360bb3d12160f7cdb2c76ccc8220c0622b345', '::1', 1638019820, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383031393832303b),
('b6e828cd7645c350fc7f6caba8ddb8d5b2006dca', '::1', 1638020143, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383032303134333b),
('2af2a086b396c936443c576dd6067313418aeb79', '::1', 1638020450, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383032303435303b),
('406da99f91623d7f0d5f7959c5aa47b129e6fe95', '::1', 1638020759, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383032303735393b),
('1c77d7d8895dda3be50320780086695eb044dd20', '::1', 1638021076, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383032313037363b),
('0bdab814a0b1c09e7dc5018724506d69c115a22b', '::1', 1638022394, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383032323339343b),
('ec1a06bb71a17323c2f3e01609eecb20befa9bb3', '::1', 1638022779, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383032323737393b),
('a9f5a899020fa3a59a10d284f24c3e0cdc73abb5', '::1', 1638023500, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383032333530303b),
('eca1c42126d87c62709e33b636a814cf603395ff', '::1', 1638023953, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383032333935333b),
('f583b29eeae9603a2283881bf256a8c5061031c9', '::1', 1638024263, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383032343236333b),
('72aa8aa699cbe75d031813b48b119f73ff01a0e7', '::1', 1638024726, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383032343732363b),
('f63fc86d4f44bebe07221c0995b53473448fcc6e', '::1', 1638025057, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383032353035373b),
('208131b039de433a526de108f2e4884ae313f593', '::1', 1638025397, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383032353339373b),
('0f6368618e4bbdd7304c51a17f11078a083eb1af', '::1', 1638026697, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383032363639373b),
('489d585b196520f4bc66ec1c14ee5d13924c9360', '::1', 1638029153, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383032393135333b),
('51eef282c286d1bec68af08e129ac2c6308d450e', '::1', 1638029094, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383032393039343b),
('e5ef8b66db358f625a2875b4f067e9fcb2e43c2b', '::1', 1638030673, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383033303637333b),
('56fb650cb4ef8208ccd8b6fe7daf87f3b7c4d237', '::1', 1638031795, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383033313739353b),
('6b248c98d05050526c1c3d22e9e5e2bd412f7620', '::1', 1638032732, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383033323733323b),
('de7d6df6095d2ce5f366a1238b2473210151a42b', '::1', 1638033726, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383033333732363b),
('974831a0b9c1a9fa947c0c540d04b0af3cf3a4f9', '::1', 1638033224, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383033333232343b),
('824ab24f648dff581232fbfc5dab4f1f3584559b', '::1', 1638033536, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383033333533363b),
('6a9b03f3035e8d9cb94e9d7d87ef3014fad67ffe', '::1', 1638033898, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383033333839383b),
('3ade9282ab70fd7f5e6e5b7edc07dc652e81dfea', '::1', 1638034249, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383033343234393b),
('b6fa94922acf6e3542b6ba47352fbb4192228e28', '::1', 1638034370, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383033343337303b),
('0563585d9d6235779154806f85fadb5f55eecc4a', '::1', 1638034550, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383033343535303b),
('3016d84de875da362e98db85cec56cbbee537935', '::1', 1638034723, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383033343732333b),
('33f65fe3e82b201438f85b2d6ae8758f8da92520', '::1', 1638034884, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383033343838343b),
('fc9241eb04c0dae8adf902999e24f3a1b7c49113', '::1', 1638035146, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383033353134363b),
('e2d8e55578742cce71ebe5a1cf5c2f7c27e95ddc', '::1', 1638034927, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383033343838343b),
('910622689c0e9a0f390d5f58d9c5c8ea703362d0', '::1', 1638035576, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383033353537363b),
('5649e7ac9d024388552f95cdc817ca785d18f66b', '::1', 1638035968, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383033353936383b),
('c8a0987d343369b9adeddbfe60a92e418ea72c31', '::1', 1638035978, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633383033353936383b);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `code` varchar(50) NOT NULL,
  `name` varchar(254) DEFAULT NULL,
  `value` varchar(250) NOT NULL,
  `group_code` varchar(20) DEFAULT NULL,
  `description` varchar(100) NOT NULL,
  `date_upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`code`, `name`, `value`, `group_code`, `description`, `date_upd`) VALUES
('AC_MANUAL_EXPORT', 'ส่งเข้า temp เอง', '0', 'Document', '', '2021-09-07 12:30:36'),
('ALLOW_DUPLICATE_QUOTATION', 'อนุญาติให้ copy ใบเสนอราคาได้หรือไม่', '1', 'SAP', '', '2020-12-29 13:02:49'),
('BI_LINK', 'BI Link', 'https://app.powerbi.com/view?r=eyJrIjoiMWMyNGZkYjMtMmNhNy00OTRhLWI5ZmQtOThlYWM3YTg5YWY1IiwidCI6IjFjZDRkYjVmLTNkYWMtNDZkZS04YzNjLTVkOTZkMjZlYjBiZSIsImMiOjEwfQ%3D%3D&pageName=ReportSection', NULL, '', '2021-11-09 06:00:45'),
('BP_MANUAL_EXPORT', 'ส่งเข้า temp เอง', '0', 'Document', '', '2021-09-07 12:30:36'),
('CLOSE_SYSTEM', 'ปิดปรับปรุงระบบ', '0', 'System', '1 = close, 0 = open', '2020-12-24 16:41:24'),
('COMPANY_ADDRESS1', 'ที่อยู่', '2782/4-6 ถ.ลาดพร้าว แขวงคลองจั่น', 'Company', '', '2020-12-24 16:27:40'),
('COMPANY_ADDRESS2', NULL, 'เขตบางกะปิ กทม.', 'Company', '', '2020-12-24 16:28:03'),
('COMPANY_CODE', 'รหัสบริษัท', '0001', 'Company', '', '2019-08-31 11:49:52'),
('COMPANY_EMAIL', 'อีเมล์', 'sales@digitalfocus.co.th', 'Company', '', '2020-12-24 16:29:09'),
('COMPANY_FACEBOOK', 'facebook', '@thedigitalfocus', 'Company', '', '2020-12-24 16:32:39'),
('COMPANY_FAX', 'แฟกซ์', '02 733 9075', 'Company', '', '2020-12-24 16:28:57'),
('COMPANY_FULL_NAME', 'ชื่อเต็ม', 'บริษัท ดิจิตอลโฟกัส จำกัด', 'Company', '', '2020-12-24 16:27:14'),
('COMPANY_LINE', 'Line', '@digitalfocus', 'Company', '', '2020-12-24 16:33:38'),
('COMPANY_NAME', 'ชื่อย่อ', 'T.P. Drug', 'Company', '', '2021-11-04 14:10:59'),
('COMPANY_PHONE', 'โทรศัพท์', '02 136 8989', 'Company', '', '2020-12-24 16:28:47'),
('COMPANY_POST_CODE', 'รหัสไปรษณีย์', '10240', 'Company', '', '2020-12-24 16:28:33'),
('COMPANY_TAX_ID', 'เลขที่ผู้เสียภาษี', '0105545026907', 'Company', '', '2020-12-24 16:39:02'),
('COMPANY_WEBSITE', 'website', 'www.digitalfocus.co.th', 'Company', '', '2020-01-06 16:57:07'),
('COUNTRY', 'รหัสประเทศ', 'TH', 'SAP', '', '2019-08-31 13:14:37'),
('CURRENCY', 'สกุลเงิน', 'THB', 'SAP', '', '2019-08-31 13:14:37'),
('DEFAULT_CUSTOMER_CODE', 'รหัสลูกค้า Dummy เห็นได้ทุกคน', 'CL-DUM0001', 'SAP', '', '2021-02-28 03:41:36'),
('DEFAULT_DUE_DELIVERY', 'กำหนดส่งของ(วัน)', '90 - 120', 'SAP', '', '2021-06-24 13:29:34'),
('DEFAULT_DUE_PRICE', 'กำหนดยืนราคา', '30', 'SAP', '', '2021-06-24 13:29:34'),
('DEFAULT_QUOTATION_SERIES', 'Series เริ่มต้นใน Series Dropdown', 'SQOT', 'SAP', '', '2021-01-03 16:12:14'),
('DEFAULT_WAREHOUSE', NULL, 'F-Goods', 'SAP', '', '2020-12-27 10:42:42'),
('PREFIX_ORDER', NULL, 'SO', 'Document', '', '2021-11-15 06:32:31'),
('PURCHASE_VAT_CODE', 'รหัสภาษีซื้อ(ต้องตรงกับ SAP)', 'P07', 'SAP', '', '2019-09-03 07:48:53'),
('PURCHASE_VAT_RATE', 'ภาษีซื้อ', '7.00', 'SAP', '', '2019-09-03 07:53:14'),
('ROW_PER_PAGE', 'จำนวนรายการต่อหน้า', '9', 'PRINT', '', '2021-08-03 08:49:52'),
('RUN_DIGIT_ORDER', NULL, '4', 'Document', '', '2021-11-15 06:34:00'),
('SALE_VAT_CODE', 'รหัสภาษีขาย(ต้องตรงกับ SAP)', 'S07', 'SAP', '', '2019-08-31 11:56:33'),
('SALE_VAT_RATE', 'ภาษีขาย', '7.00', 'SAP', '', '2020-12-20 14:10:03'),
('SQ_MANUAL_EXPORT', 'ส่งเข้า temp เอง', '1', 'Document', '', '2021-09-07 11:31:28'),
('TEXT_PER_ROW', 'จำนวนตัวอักษรต่อบรรทัด', '39.5', 'PRINT', '', '2021-08-10 06:02:35'),
('USE_STRONG_PWD', 'บังคับใช้การตั้งรหัสผ่านแบบเข้มงวด', '0', NULL, '', '2021-11-10 05:35:56');

-- --------------------------------------------------------

--
-- Table structure for table `customer_team`
--

CREATE TABLE `customer_team` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `add_user` int(11) DEFAULT NULL,
  `date_upd` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `update_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_team`
--

INSERT INTO `customer_team` (`id`, `name`, `date_add`, `add_user`, `date_upd`, `update_user`) VALUES
(1, 'Retail Bussiness', '2021-11-27 15:28:59', 1, NULL, 0),
(3, 'Overseas', '2021-11-27 15:34:08', 1, NULL, 0),
(4, 'Bangkok', '2021-11-27 15:34:28', 1, '2021-11-27 15:43:42', 1),
(5, 'Hospital', '2021-11-27 15:41:59', 1, NULL, 0),
(6, 'Company', '2021-11-27 20:23:12', 1, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `code` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `url` varchar(250) DEFAULT NULL,
  `group_code` varchar(10) NOT NULL,
  `sub_group` varchar(50) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `position` int(3) NOT NULL DEFAULT '1',
  `valid` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = check permission'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`code`, `name`, `url`, `group_code`, `sub_group`, `active`, `position`, `valid`) VALUES
('APPROVER', 'Authorizers', 'approver', 'ADMIN', NULL, 1, 4, 1),
('APPROVE_RULE', 'Aproval Rule', 'approve_rule', 'ADMIN', NULL, 1, 5, 1),
('APPROVE_STATUS', 'Aproval Status', 'report/approval_status', 'REPORT', NULL, 1, 3, 1),
('CUSTOMER_TEAM', 'Customer Team', 'customer_team', 'ADMIN', NULL, 1, 1, 1),
('ORDERPRO', 'Order Promotion', 'order_promotion', 'ORDER', NULL, 1, 2, 1),
('ORDERS', 'Order', 'orders', 'ORDER', NULL, 1, 1, 1),
('PERMISSION', 'Permission', NULL, 'SPM', NULL, 1, 3, 1),
('PROMOTION', 'Promotions', 'promotion', 'ADMIN', NULL, 1, 6, 1),
('PWDRESET', 'Reset User Password', NULL, 'SPM', NULL, 1, 1, 1),
('SALE_PERSON', 'Sales Person', 'sale_person', 'ADMIN', NULL, 1, 1, 1),
('SALE_TEAM', 'Sales Team', 'sale_team', 'ADMIN', NULL, 1, 1, 1),
('USER', 'Users', 'users', 'ADMIN', NULL, 1, 3, 1),
('USERGROUP', 'Users Group', 'user_group', 'ADMIN', NULL, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_group`
--

CREATE TABLE `menu_group` (
  `code` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` enum('side','top') NOT NULL DEFAULT 'side',
  `position` int(3) NOT NULL DEFAULT '0',
  `icon` varchar(20) DEFAULT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_group`
--

INSERT INTO `menu_group` (`code`, `name`, `type`, `position`, `icon`, `valid`, `active`) VALUES
('ADMIN', 'Admin', 'side', 2, 'fa-user-circle-o', 1, 1),
('ORDER', 'Order', 'side', 1, 'fa-shopping-basket', 1, 1),
('REPORT', 'Report', 'side', 3, 'fa-file-excel-o', 1, 1),
('SPM', 'Special Permission', 'top', 6, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu_sub_group`
--

CREATE TABLE `menu_sub_group` (
  `code` varchar(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `group_code` varchar(10) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `position` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `code` varchar(20) NOT NULL,
  `CardCode` varchar(15) DEFAULT NULL,
  `CardName` varchar(100) DEFAULT NULL,
  `CardGroup` int(11) DEFAULT NULL COMMENT 'team customer group',
  `CardTeam` int(11) DEFAULT NULL,
  `CardType` varchar(1) NOT NULL DEFAULT 'V' COMMENT 'U_BEX_TYPE | V  or Q ',
  `VatGroup` varchar(8) DEFAULT NULL COMMENT 'OCRD.ECVatGroup',
  `SlpCode` int(11) DEFAULT NULL,
  `GroupNum` int(6) NOT NULL DEFAULT '-1' COMMENT 'payment term',
  `PriceList` int(3) DEFAULT NULL COMMENT 'OPLN',
  `NumAtCard` varchar(100) DEFAULT NULL COMMENT 'PO NO',
  `DocCur` varchar(3) DEFAULT NULL COMMENT 'Currency OCRN',
  `DocRate` decimal(19,6) NOT NULL DEFAULT '1.000000' COMMENT 'ตัวคูณ',
  `DocTotal` decimal(19,6) NOT NULL DEFAULT '0.000000' COMMENT 'มูลค่ารวมทั้งบิล',
  `VatSum` decimal(19,6) NOT NULL DEFAULT '0.000000',
  `PayToCode` varchar(50) DEFAULT NULL,
  `ShipToCode` varchar(50) DEFAULT NULL,
  `Address` varchar(254) DEFAULT NULL COMMENT 'CRD1 type=B',
  `Address2` varchar(254) DEFAULT NULL COMMENT 'CRD1 type=S',
  `Address3` varchar(254) DEFAULT NULL COMMENT 'Ex ShipTo',
  `DocNum` int(11) DEFAULT NULL COMMENT 'ORDR.DocNum',
  `Status` int(1) NOT NULL DEFAULT '0' COMMENT '0 = not export, 1 = อยู่ใน Temp,  2 = เข้า SAP แล้ว, 3 = Error',
  `Approved` varchar(1) NOT NULL DEFAULT 'P' COMMENT 'P=pending, A=approved, R=reject',
  `Approver` varchar(50) DEFAULT NULL,
  `ApproveDate` datetime DEFAULT NULL,
  `Approval_status` varchar(1) DEFAULT NULL COMMENT 'F = full, P = partial, R = Reject',
  `DocDate` date DEFAULT NULL COMMENT 'Posting Data',
  `DocDueDate` date DEFAULT NULL COMMENT 'Valid untill',
  `OwnerCode` int(11) DEFAULT NULL,
  `Comments` varchar(254) DEFAULT NULL,
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  `uname` varchar(50) DEFAULT NULL,
  `upd_user_id` int(11) DEFAULT NULL,
  `must_approve` tinyint(1) NOT NULL DEFAULT '1',
  `temp_date` datetime DEFAULT NULL COMMENT 'Date/time to temp',
  `sap_date` datetime DEFAULT NULL COMMENT 'date/time to SAP',
  `Message` text COMMENT 'Error Message From temp',
  `DeliveryNo` varchar(100) DEFAULT NULL,
  `InvoiceNo` varchar(100) DEFAULT NULL,
  `InvoiceDate` date DEFAULT NULL,
  `BillDate` tinyint(1) NOT NULL DEFAULT '1',
  `requireSQ` tinyint(1) NOT NULL DEFAULT '0',
  `priceEdit` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'มีรายการที่ราคาขายตำก่วา price list',
  `is_promotion` tinyint(1) NOT NULL DEFAULT '0',
  `promotion_id` int(11) DEFAULT NULL,
  `promotion_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`code`, `CardCode`, `CardName`, `CardGroup`, `CardTeam`, `CardType`, `VatGroup`, `SlpCode`, `GroupNum`, `PriceList`, `NumAtCard`, `DocCur`, `DocRate`, `DocTotal`, `VatSum`, `PayToCode`, `ShipToCode`, `Address`, `Address2`, `Address3`, `DocNum`, `Status`, `Approved`, `Approver`, `ApproveDate`, `Approval_status`, `DocDate`, `DocDueDate`, `OwnerCode`, `Comments`, `date_add`, `date_upd`, `user_id`, `uname`, `upd_user_id`, `must_approve`, `temp_date`, `sap_date`, `Message`, `DeliveryNo`, `InvoiceNo`, `InvoiceDate`, `BillDate`, `requireSQ`, `priceEdit`, `is_promotion`, `promotion_id`, `promotion_code`) VALUES
('SO-21110001', 'CLTV-01M008', 'บริษัท เอ็ม เอส เฮลธ์ แคร์ จำกัด', 5, 1, 'V', 'S07', 3, 3, 11, NULL, 'THB', '1.000000', '60000.000000', '3925.230000', '00000', '00000', 'เลขที่ 193/6-7 ถนนบรมไตรโลกนารถ ตำบลในเมือง อำเภอเมืองพิษณุโลก จังหวัดพิษณุโลก 65000 ', 'เลขที่ 193/6-7 ถนนบรมไตรโลกนารถ ตำบลในเมือง อำเภอเมืองพิษณุโลก จังหวัดพิษณุโลก 65000 ', NULL, NULL, 1, 'A', 'manager.retail', '2021-11-28 00:24:09', 'F', '2021-11-27', '2021-11-30', 49, NULL, '2021-11-28 00:05:31', '2021-11-27 17:24:09', 12, 'smu.komsun', NULL, 1, '2021-11-28 00:24:09', NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21110002', 'CLTV-01B006', 'นายบัญชา ตระกูล', 5, 1, 'V', 'S07', 3, 3, 11, NULL, 'THB', '1.000000', '322500.000000', '21098.130000', '00000', '00000', '48/2 หมู่ที่ 1 ตำบลบ้านกร่าง อำเภอกงไกรลาศ จังหวัดสุโขทัย 64170 ', '48/2 หมู่ที่ 1 ตำบลบ้านกร่าง อำเภอกงไกรลาศ จังหวัดสุโขทัย 64170 ', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-11-28', '2021-12-01', 49, NULL, '2021-11-28 00:25:31', '2021-11-27 17:25:31', 12, 'smu.komsun', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, NULL, NULL),
('SO-21110003', 'CLTQ-01A002', 'พลตรีอนุศร', 5, 6, 'V', 'X0', 42, 3, 11, NULL, 'THB', '1.000000', '20000.000000', '0.000000', '00000', '00000', 'เสรีไทย 71 กรุงเทพฯ ', 'เสรีไทย 71 กรุงเทพฯ ', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-11-28', '2021-12-01', 44, NULL, '2021-11-28 00:27:48', '2021-11-27 17:27:48', 3, 'admin1', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21110004', 'CLTV-04A040', 'คลินิกหมออนุชา', 8, 3, 'V', 'S07', 9, 3, 11, NULL, 'THB', '1.000000', '112000.000000', '7327.100000', '00000', '00000', '227 หมู่ 5 ตเขาพนม อำเภอเขาพนม จังหวัดกระบี่ 81140 ', '227 หมู่ 5 ตเขาพนม อำเภอเขาพนม จังหวัดกระบี่ 81140 ', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-11-28', '2021-12-01', 55, NULL, '2021-11-28 00:41:05', '2021-11-27 17:41:05', 16, 'smu.nanthawan', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21110005', 'CLTV-04B031', 'บริษัท บีกิฟท์ เมดิคอล จำกัด', 8, 3, 'V', 'S07', 9, 3, NULL, NULL, 'THB', '1.000000', '41500.000000', '2714.950000', '00000', '00000', 'เลขที่ 62/10 หมู่ที่ 7 ตำบลฉลอง อำเภอเมืองภูเก็ต จังหวัดภูเก็ต 83130 ', 'เลขที่ 62/10 หมู่ที่ 7 ตำบลฉลอง อำเภอเมืองภูเก็ต จังหวัดภูเก็ต 83130 ', NULL, NULL, 1, 'A', 'System', '2021-11-28 00:46:35', NULL, '2021-11-28', '2021-12-01', 55, NULL, '2021-11-28 00:46:35', '2021-11-27 17:54:19', 16, 'smu.nanthawan', NULL, 0, '2021-11-28 00:46:35', NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 1, 'PM-210001'),
('SO-21110006', 'CLTQ-01A046', 'อนันต์โอสถ', 5, 1, 'V', 'X0', 9, 3, NULL, NULL, 'THB', '1.000000', '12500.000000', '0.000000', '00000', '00000', '18 ถนนรักษ์นรกิจ อำเภอสวี จังหวัดชุมพร 86130 ', '18 ถนนรักษ์นรกิจ อำเภอสวี จังหวัดชุมพร 86130 ', NULL, NULL, 1, 'A', 'System', '2021-11-28 00:55:57', NULL, '2021-11-28', '2021-12-01', 55, NULL, '2021-11-28 00:55:57', '2021-11-27 17:55:57', 16, 'smu.nanthawan', NULL, 0, '2021-11-28 00:55:57', NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 2, 'PM-210002');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_code` varchar(20) NOT NULL,
  `LineNum` int(11) NOT NULL DEFAULT '1',
  `ItemCode` varchar(50) DEFAULT NULL,
  `ItemName` varchar(100) DEFAULT NULL COMMENT 'ItemName',
  `Qty` decimal(19,6) NOT NULL DEFAULT '0.000000',
  `freeQty` decimal(19,6) NOT NULL DEFAULT '0.000000',
  `UomCode` varchar(20) DEFAULT NULL,
  `stdPrice` decimal(15,2) NOT NULL DEFAULT '0.00',
  `SellPrice` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT 'specail price',
  `DiscPrcnt` decimal(5,2) NOT NULL DEFAULT '0.00',
  `VatGroup` varchar(8) DEFAULT NULL,
  `VatRate` decimal(5,2) NOT NULL DEFAULT '0.00',
  `VatAmount` decimal(19,6) NOT NULL DEFAULT '0.000000',
  `LineTotal` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT 'มูลค่ารวมหลังส่วนลดก่อนภาษี',
  `WhsCode` varchar(8) DEFAULT NULL,
  `LineText` varchar(100) DEFAULT NULL,
  `free_item` tinyint(1) NOT NULL DEFAULT '0',
  `link_id` int(11) DEFAULT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'P' COMMENT 'P=pending, A=approved, R=reject',
  `promotion_id` int(11) DEFAULT NULL,
  `promotion_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_code`, `LineNum`, `ItemCode`, `ItemName`, `Qty`, `freeQty`, `UomCode`, `stdPrice`, `SellPrice`, `DiscPrcnt`, `VatGroup`, `VatRate`, `VatAmount`, `LineTotal`, `WhsCode`, `LineText`, `free_item`, `link_id`, `status`, `promotion_id`, `promotion_code`) VALUES
(1, 'SO-21110001', 1, 'FG-HPN06-AMOX-0500-TP55-01', 'AMOXYCILLIN 500 mg CAP. 1x500 Caps', '100.000000', '0.000000', 'Bottle', '610.00', '600.00', '0.00', 'S07', '7.00', '3925.233645', '60000.00', '2-FG', NULL, 0, NULL, 'A', NULL, NULL),
(2, 'SO-21110002', 1, 'FG-HGN07-9VIT-0060-TP32-01', '9 VITAMIN SYR. 1x12x60 ml', '1500.000000', '0.000000', 'Dozen', '215.00', '215.00', '0.00', 'S07', '7.00', '21098.130841', '322500.00', '2-FG', NULL, 0, NULL, 'P', NULL, NULL),
(3, 'SO-21110003', 1, 'FG-HGN07-9VIT-0060-TP32-01', '9 VITAMIN SYR. 1x12x60 ml', '100.000000', '0.000000', 'Dozen', '215.00', '200.00', '0.00', 'X0', '0.00', '0.000000', '20000.00', '2-FG', NULL, 0, NULL, 'P', NULL, NULL),
(4, 'SO-21110004', 1, 'FG-HGN03-ADMG-0010-TP57-01', 'ADMAG-M TAB. 1x50x10 Tabs', '100.000000', '0.000000', 'Box', '325.00', '320.00', '0.00', 'S07', '7.00', '2093.457944', '32000.00', '2-FG', NULL, 0, NULL, 'P', NULL, NULL),
(5, 'SO-21110004', 2, 'FG-HGN03-FTAB-0012-TP22-01', 'FLEXY 50 mg TAB. 1x12x12 Tabs', '100.000000', '0.000000', 'Dozen', '100.00', '100.00', '0.00', 'S07', '7.00', '654.205607', '10000.00', '2-FG', NULL, 0, NULL, 'P', NULL, NULL),
(6, 'SO-21110004', 3, 'FG-HGS09-AEAR-0010-TP57-01', 'ARCHIFEN (CHLORAMPHENICOL) EAR DROP 1x50x10 ml', '100.000000', '0.000000', 'Box', '700.00', '700.00', '0.00', 'S07', '7.00', '4579.439252', '70000.00', '2-FG', NULL, 0, NULL, 'P', NULL, NULL),
(7, 'SO-21110005', 1, 'FG-HGN03-BAIN-0012-TP27-01', 'BAINTO TAB. 1x12x2x12 Tabs', '100.000000', '0.000000', 'Dozen', '400.00', '400.00', '0.00', 'S07', '7.00', '2616.822430', '40000.00', '2-FG', NULL, 0, NULL, 'A', 1, 'PM-210001'),
(8, 'SO-21110005', 2, 'FG-HGN06-BUTF-0010-TP02-01', 'BUTACINON FORT 20 mg CAP. 1x10 Caps', '100.000000', '0.000000', 'Box', '15.00', '15.00', '0.00', 'S07', '7.00', '98.130841', '1500.00', '2-FG', NULL, 0, NULL, 'A', 1, 'PM-210001'),
(9, 'SO-21110006', 1, 'FG-HGN10-FGEL-0030-TP28-01', 'FLEXY GEL 1x12x30 g', '20.000000', '0.000000', 'Dozen', '270.00', '270.00', '0.00', 'X0', '0.00', '0.000000', '5400.00', '2-FG', NULL, 0, NULL, 'A', 2, 'PM-210002'),
(10, 'SO-21110006', 2, 'FG-HGN10-FGEL-0060-TP32-01', 'FLEXY GEL 1x12x60 g', '20.000000', '0.000000', 'Dozen', '355.00', '355.00', '0.00', 'X0', '0.00', '0.000000', '7100.00', '2-FG', NULL, 0, NULL, 'A', 2, 'PM-210002');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `menu` varchar(20) NOT NULL,
  `ugroup_id` int(11) NOT NULL,
  `can_view` tinyint(1) NOT NULL DEFAULT '0',
  `can_add` tinyint(1) NOT NULL DEFAULT '0',
  `can_edit` tinyint(1) NOT NULL DEFAULT '0',
  `can_delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `menu`, `ugroup_id`, `can_view`, `can_add`, `can_edit`, `can_delete`) VALUES
(21, 'ORDERS', 3, 1, 1, 1, 1),
(22, 'ORDERPRO', 3, 1, 1, 1, 1),
(23, 'SALE_TEAM', 3, 0, 0, 0, 0),
(24, 'USERGROUP', 3, 0, 0, 0, 0),
(25, 'USER', 3, 0, 0, 0, 0),
(26, 'APPROVER', 3, 0, 0, 0, 0),
(27, 'APPROVE_RULE', 3, 0, 0, 0, 0),
(28, 'PROMOTION', 3, 0, 0, 0, 0),
(29, 'PWDRESET', 3, 0, 0, 0, 0),
(30, 'PERMISSION', 3, 0, 0, 0, 0),
(74, 'ORDERS', 2, 1, 0, 0, 0),
(75, 'ORDERPRO', 2, 1, 0, 0, 0),
(76, 'SALE_TEAM', 2, 1, 0, 0, 0),
(77, 'USERGROUP', 2, 1, 0, 0, 0),
(78, 'USER', 2, 1, 0, 0, 0),
(79, 'APPROVER', 2, 1, 0, 0, 0),
(80, 'APPROVE_RULE', 2, 1, 0, 0, 0),
(81, 'SALES_APPROVE_RULE', 2, 0, 0, 0, 0),
(82, 'PROMOTION', 2, 1, 0, 0, 0),
(83, 'APPROVE_STATUS', 2, 1, 0, 0, 0),
(84, 'PWDRESET', 2, 0, 0, 0, 0),
(85, 'PERMISSION', 2, 0, 0, 0, 0),
(146, 'ORDERS', 4, 1, 1, 1, 1),
(147, 'ORDERPRO', 4, 1, 1, 1, 1),
(148, 'SALE_TEAM', 4, 1, 0, 0, 0),
(149, 'USERGROUP', 4, 1, 0, 0, 0),
(150, 'USER', 4, 1, 0, 0, 0),
(151, 'APPROVER', 4, 1, 0, 0, 0),
(152, 'APPROVE_RULE', 4, 1, 0, 0, 0),
(153, 'SALES_APPROVE_RULE', 4, 1, 0, 0, 0),
(154, 'PROMOTION', 4, 1, 0, 0, 0),
(155, 'APPROVE_STATUS', 4, 1, 0, 0, 0),
(156, 'PWDRESET', 4, 0, 0, 0, 0),
(157, 'PERMISSION', 4, 0, 0, 0, 0),
(158, 'ORDERS', 1, 1, 1, 1, 1),
(159, 'ORDERPRO', 1, 1, 1, 1, 1),
(160, 'SALE_TEAM', 1, 1, 1, 1, 1),
(161, 'SALE_PERSON', 1, 1, 1, 1, 1),
(162, 'CUSTOMER_TEAM', 1, 1, 1, 1, 1),
(163, 'USERGROUP', 1, 1, 1, 1, 1),
(164, 'USER', 1, 1, 1, 1, 1),
(165, 'APPROVER', 1, 1, 1, 1, 1),
(166, 'APPROVE_RULE', 1, 1, 1, 1, 1),
(167, 'SALES_APPROVE_RULE', 1, 1, 1, 1, 1),
(168, 'PROMOTION', 1, 1, 1, 1, 1),
(169, 'APPROVE_STATUS', 1, 1, 0, 0, 0),
(170, 'PWDRESET', 1, 1, 1, 1, 1),
(171, 'PERMISSION', 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(254) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `add_by` int(11) DEFAULT NULL,
  `date_upd` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`id`, `code`, `name`, `start_date`, `end_date`, `status`, `date_add`, `add_by`, `date_upd`, `update_by`) VALUES
(1, 'PM-210001', 'Product Push Bainto/Butacinon Forte', '2021-11-01', '2021-12-31', 1, '2021-11-20 15:10:05', 15, '2021-11-20 15:11:39', 15),
(2, 'PM-210002', 'Promotion Push Flexy', '2021-11-01', '2021-12-31', 1, '2021-11-20 15:11:29', 15, '2021-11-22 15:26:34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `promotion_detail`
--

CREATE TABLE `promotion_detail` (
  `id` int(11) NOT NULL,
  `promotion_id` int(11) NOT NULL,
  `ItemCode` varchar(50) DEFAULT NULL,
  `ItemName` varchar(100) DEFAULT NULL,
  `Qty` decimal(19,2) NOT NULL DEFAULT '0.00',
  `SellPrice` decimal(19,2) NOT NULL DEFAULT '0.00',
  `UomCode` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `promotion_detail`
--

INSERT INTO `promotion_detail` (`id`, `promotion_id`, `ItemCode`, `ItemName`, `Qty`, `SellPrice`, `UomCode`) VALUES
(5, 1, 'FG-HGN03-BAIN-0012-TP27-01', 'BAINTO TAB. 1x12x2x12 Tabs', '10.00', '400.00', 'Dozen'),
(6, 1, 'FG-HGN06-BUTF-0010-TP02-01', 'BUTACINON FORT 20 mg CAP. 1x10 Caps', '10.00', '15.00', 'Box'),
(7, 2, 'FG-HGN10-FGEL-0030-TP28-01', 'FLEXY GEL 1x12x30 g', '20.00', '270.00', 'Dozen'),
(8, 2, 'FG-HGN10-FGEL-0060-TP32-01', 'FLEXY GEL 1x12x60 g', '20.00', '355.00', 'Dozen');

-- --------------------------------------------------------

--
-- Table structure for table `sale_person`
--

CREATE TABLE `sale_person` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `add_user` int(11) DEFAULT NULL,
  `date_upd` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `update_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sale_person`
--

INSERT INTO `sale_person` (`id`, `name`, `date_add`, `add_user`, `date_upd`, `update_user`) VALUES
(1, 'reseller', '2021-11-27 20:01:52', 1, '2021-11-27 23:50:08', 1),
(2, 'Focus', '2021-11-27 20:01:59', 1, NULL, NULL),
(3, 'T.P. Durg', '2021-11-27 20:02:09', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sale_team`
--

CREATE TABLE `sale_team` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sale_person_id` int(11) DEFAULT NULL,
  `customer_team_id` int(11) DEFAULT NULL,
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `add_by` int(11) DEFAULT NULL,
  `date_upd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sale_team`
--

INSERT INTO `sale_team` (`id`, `name`, `sale_person_id`, `customer_team_id`, `date_add`, `add_by`, `date_upd`, `update_by`) VALUES
(1, 'Retail Bussiness', 1, 1, '2021-11-27 20:02:41', 1, '2021-11-27 21:55:15', 1),
(2, 'Overseas', 1, 3, '2021-11-27 20:04:17', 1, '2021-11-27 22:06:52', 1),
(3, 'Hospital', 1, 5, '2021-11-27 20:07:12', 1, '2021-11-27 21:54:50', 1),
(4, 'Bangkok', 3, 4, '2021-11-27 20:20:24', 1, '2021-11-27 21:54:40', 1),
(6, 'Company', 2, 6, '2021-11-27 20:51:15', 1, '2021-11-27 21:54:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sync_logs`
--

CREATE TABLE `sync_logs` (
  `id` int(11) NOT NULL,
  `sync_item` varchar(10) NOT NULL,
  `get_item` int(5) NOT NULL,
  `update_item` int(5) NOT NULL,
  `date_upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `team_approver`
--

CREATE TABLE `team_approver` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `team_approver`
--

INSERT INTO `team_approver` (`id`, `team_id`, `user_id`, `date_add`) VALUES
(9, 5, 1, '2021-11-27 20:25:01'),
(23, 1, 5, '2021-11-27 22:06:20'),
(24, 2, 6, '2021-11-27 22:06:52'),
(25, 3, 32, '2021-11-27 22:07:10'),
(26, 4, 31, '2021-11-27 22:07:39'),
(27, 6, 1, '2021-11-27 22:08:01');

-- --------------------------------------------------------

--
-- Table structure for table `team_customer_group`
--

CREATE TABLE `team_customer_group` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `group_id` int(2) NOT NULL,
  `sale_person_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `team_customer_group`
--

INSERT INTO `team_customer_group` (`id`, `team_id`, `group_id`, `sale_person_id`) VALUES
(4, 1, 5, 1),
(5, 1, 6, 1),
(6, 1, 16, 1),
(7, 2, 15, 1),
(8, 3, 8, 1),
(9, 3, 9, 1),
(10, 3, 10, 1),
(11, 3, 11, 1),
(12, 3, 12, 1),
(13, 4, 5, 3),
(14, 4, 6, 3),
(15, 4, 7, 3),
(16, 4, 8, 3),
(17, 4, 9, 3),
(18, 4, 10, 3),
(19, 4, 11, 3),
(20, 4, 12, 3),
(21, 4, 13, 3),
(22, 4, 14, 3),
(23, 4, 16, 3),
(24, 6, 5, 2),
(25, 6, 6, 2),
(26, 6, 7, 2),
(27, 6, 8, 2),
(28, 6, 9, 2),
(29, 6, 10, 2),
(30, 6, 11, 2),
(31, 6, 12, 2),
(32, 6, 13, 2),
(33, 6, 14, 2),
(34, 6, 16, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `uid` varchar(32) NOT NULL COMMENT 'Unique id',
  `emp_name` varchar(250) NOT NULL COMMENT 'display name',
  `emp_id` int(11) DEFAULT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `sale_name` varchar(155) DEFAULT NULL,
  `ugroup_id` int(11) NOT NULL,
  `role` set('sales','salesAdmin','GM') NOT NULL DEFAULT 'sales',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = active, 0 = disactive	',
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_upd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `add_by` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `bi_link` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `uname`, `pwd`, `uid`, `emp_name`, `emp_id`, `sale_id`, `sale_name`, `ugroup_id`, `role`, `status`, `date_add`, `date_upd`, `add_by`, `update_by`, `bi_link`) VALUES
(-987654321, 'superadmin', '$2y$10$vZKJB2k7bAPWNcHLqizIne1b3NsjV2Vm6cwEnZ4BHMWgTauKLS0W6', '1f0b6f95139c887a30c726d7dabbed3a', 'SuperAdmin', NULL, NULL, NULL, -987654321, 'sales', 1, '2021-11-04 10:26:14', '2021-11-19 20:30:41', NULL, NULL, 1),
(1, 'admin', '$2y$10$.ZJCrE77FSwNkv6WOOZqr.lRXWwwyP5LUFN1NQw5cFqfkxbx6adnK', '01b778083deb9d926948f3f3c9545fbf', 'วิรัญญา ตั้งอมรศิริ', 30, NULL, 'Please Select', 1, 'GM', 1, '2021-11-21 17:46:01', '2021-11-27 14:46:35', -987654321, 1, 0),
(2, 'admin.sup', '$2y$10$.fhm4eyBNv.LUOwVw7mPN.etW4SJaelpbpcgIHiop3/djIq/rpr9.', '57859428a3f30eccf394c29a936813a4', 'รัศมี ระวังภัย', 75, NULL, NULL, 1, 'salesAdmin', 1, '2021-11-21 17:52:22', '2021-11-21 17:52:22', -987654321, NULL, 0),
(3, 'admin1', '$2y$10$cgsg7VJ5aBBfBkLkPgLPy.Tst0XyHu5YLtTv6AdKZ.J/6uSamXUX6', '26816cdda9bbe7dd587775e4e313c96c', 'ดารารัตน์ ใบบัว', 44, NULL, NULL, 4, 'salesAdmin', 1, '2021-11-21 18:20:09', '2021-11-27 20:30:39', -987654321, 1, 0),
(4, 'admin2', '$2y$10$zX8OBH9ItJGc91SuzHNIMuiua3i0rhz0bqKwt4TGEMvnXyAWGdz5i', '95060b7dcd51e6aaddfd50590f8234b9', 'ดรุณี ฝ่ายขันธ์', 38, NULL, NULL, 4, 'salesAdmin', 1, '2021-11-21 18:20:54', '2021-11-27 20:30:33', -987654321, 1, 0),
(5, 'manager.retail', '$2y$10$pI8vj8XR0ZH4269clbDPM.HCF2uuyi6EXu9iKkiVWfVZfG4Www9KK', 'b59f19cdbf502b0a3ffae95b889c80ee', 'ศักรินทร์ ปริศวงศ์', 279, NULL, NULL, 2, 'sales', 1, '2021-11-21 18:23:17', '2021-11-22 18:01:50', -987654321, 1, 1),
(6, 'manager.overseas', '$2y$10$.8.40yOzSKTIkQ01KJ6GZeXX.ZgqKGFOmm6V9v1HbADFljDkHRxcW', 'bb3ad1a8b038593abf569f803c7c7a89', 'วาสินี ตั้งอมรศิริ', 33, NULL, NULL, 2, 'sales', 1, '2021-11-21 18:24:55', '2021-11-27 20:39:11', -987654321, 1, 0),
(7, 'smu.juthamas', '$2y$10$/5GscpqfZzSikwPpC61LjO/EhVX5nFnRW6iy1S.THJ/xBy9yvxsKe', 'c7c0f93413cb0d01e743ebc186b0e4d4', 'จุฑามาศ วงศ์รัตน์', 51, 5, 'จุฑามาศ วงศ์รัตน์', 3, 'sales', 1, '2021-11-21 18:27:37', '2021-11-27 20:40:03', -987654321, 1, 0),
(8, 'smu.piyawat', '$2y$10$sDjsyIwEI3M5YDV2jQXPbuieDGR8t/9OHXBKNOFzEvCIslVRjKOqG', '939cb7e21adfd418c31285203485ffd7', 'ปิยวัฒน์ เทวาอนุเคราะห์', 57, 11, 'ปิยวัฒน์ เทวาอนุเคราะห์', 3, 'sales', 1, '2021-11-21 18:28:25', '2021-11-27 20:40:40', -987654321, 1, 0),
(9, 'smu.apichart', '$2y$10$U/AbKix66ZiaEWlp44dgr.aHoUIvJhLZpm0lI9u2vCbPd9uHSpnCy', '1f59c43753ddfa0534d78843cd229b39', 'อภิชาติ พิบูลย์', 70, 24, 'อภิชาติ พิบูลย์', 3, 'sales', 1, '2021-11-21 18:29:01', '2021-11-27 20:40:58', -987654321, 1, 0),
(10, 'smu.athiwat', '$2y$10$gADxVsWuT2k0y0jdj5Bpn.KU/tqNSTlrEuu3i6isw.MguN1F.evji', '077a01b79a066c7647ca26a45c030187', 'อธิวัฒน์ หิรัญแสงชยานนท์', 69, 23, 'อธิวัฒน์ หิรัญแสงชยานนท์', 3, 'sales', 1, '2021-11-21 18:29:50', '2021-11-27 20:41:31', -987654321, 1, 0),
(11, 'smu.adsawin', '$2y$10$rbT0/PVNVRd3hOODMoEAX.u4nYGOWjWwTOdFUxTt6BYyrkCqiklnm', '03d74e28b3c394109a36d1e7052f72a6', 'อัศวิน พิทักษ์พลางกูร', 72, 26, 'อัศวิน พิทักษ์พลางกูร', 3, 'sales', 1, '2021-11-21 18:30:44', '2021-11-27 20:41:39', -987654321, 1, 0),
(12, 'smu.komsun', '$2y$10$TRorIy9v9SMyCJX.7WP8MeeinpamI6nJ2WgCCDXm/amS6hJ1Kn/Km', '8c3493da41f4a85431a74c866cd36ffb', 'คมสัน ต้นจันทน์', 49, 3, 'คมสัน ต้นจันทน์', 3, 'sales', 1, '2021-11-21 18:31:22', '2021-11-27 20:42:10', -987654321, 1, 0),
(13, 'smu.supawat', '$2y$10$qc0X4VpkHFsumqMcbCmnNuz5AkZF/DGsQxoyzGF0W0YuNq8GNK3uK', '965409bf3f8238deaedce80ab5987aae', 'สุภวัฒน์ มณีรัตน์', 67, 21, 'สุภวัฒน์ มณีรัตน์', 3, 'sales', 1, '2021-11-21 18:32:13', '2021-11-27 20:42:33', -987654321, 1, 0),
(14, 'smu.woranut', '$2y$10$ZwprLm/PnK7mMEZFYYa2V.v/L3Fg6FM0JRfgha/qFhp6ruovJDXNu', '0e2680f6a4c4bafd7fe3031e9f73d23b', 'วรนุช เสนาะน้อย', 62, 16, 'วรนุช เสนาะน้อย', 3, 'sales', 1, '2021-11-21 18:32:52', '2021-11-27 20:42:52', -987654321, 1, 0),
(15, 'smu.jaturong', '$2y$10$xYfoWqQrXeBS68RzpWo5pObLNKmo5yCypolyPB2WkYWGTLPBpG7rm', '53ba92d6d9ac55ee9bccff2d5189e546', 'จตุรงค์ เกิดเพ็ชร', 284, 49, 'จตุรงค์ เกิดเพ็ชร', 3, 'sales', 1, '2021-11-21 18:33:31', '2021-11-27 20:43:11', -987654321, 1, 0),
(16, 'smu.nanthawan', '$2y$10$had/sR7Xqgajn9mliOpUs.GZrWrfl7W9dViqW9F1RtJChayFMtjCG', '288156fe2d20e4e13b9497abbfd58bde', 'นันทวัน แจ้งสนิท', 55, 9, 'นันทวัน แจ้งสนิท', 3, 'sales', 1, '2021-11-21 18:35:04', '2021-11-27 20:43:45', -987654321, 1, 0),
(17, 'smu.walaiporn', '$2y$10$sDR5jr/BKbrwU.Kee1/STuNNFAskpniw6ZYSnKQn4zlmo9J2D0.nG', '23e58c90d0a3793757360eb0d595daf8', 'วลัยพร ยับ', 64, 18, 'วลัยพร ยับ', 3, 'sales', 1, '2021-11-21 18:38:19', '2021-11-27 20:47:01', -987654321, 1, 0),
(18, 'smu.rotchana', '$2y$10$0tYyuwMpNjQIMdVDApnO9OOB/qHaaKbGNN5gWuGQwcaQ18O3veeqi', 'fc10159cd5dc797fedfcab75850c83fa', 'รจนา คำก๋อง', 61, 15, 'รจนา คำก๋อง', 3, 'sales', 1, '2021-11-21 18:43:11', '2021-11-27 20:46:50', -987654321, 1, 0),
(19, 'smu.natthapa', '$2y$10$x5.MLkq9v8OfP6L8TZlLO.erB0rVIZ/JE4BhF3D7ZWURZ1s3pl90G', 'd6a636c64225824b682409935876d219', 'ณัฐภาส์ แจ้งสนิท', 52, 6, 'ณัฐภาส์ แจ้งสนิท', 3, 'sales', 1, '2021-11-21 18:44:00', '2021-11-27 20:46:20', -987654321, 1, 0),
(20, 'smu.narunart', '$2y$10$m7mUyGjHMEzO1O.3TtlerOioAPXAhdy1E2Kl7/tJyGjIkdQsvbPDG', '2fec973261bbe84de966f7209fcf485e', 'นฤนาท เมืองสมบัติ', 53, 7, 'นฤนาท เมืองสมบัติ', 3, 'sales', 1, '2021-11-21 18:45:11', '2021-11-27 20:46:09', -987654321, 1, 0),
(21, 'smu.phairot', '$2y$10$R8PGcEJwbpXmerOl2ESu2eeVxtyYtAXRiNgC/HNxgAdw6.UE9pqx6', 'deedc540053e00d3fd74077ea827241b', 'ไพโรจน์ จันทร์หอม', 59, 13, 'ไพโรจน์ จันทร์หอม', 3, 'sales', 1, '2021-11-21 18:46:01', '2021-11-27 20:45:40', -987654321, 1, 0),
(22, 'smu.marasri', '$2y$10$TWHh6WDMNqOxZo1v0r1ODuKG7e369ckuu9I/22rshwbPGBMSTt8oO', '436942e6cc4b7f59e1afaaa4aa4dc043', 'มารศรี สุรินทร์', 60, 14, 'มารศรี สุรินทร์', 3, 'sales', 1, '2021-11-21 18:46:38', '2021-11-27 20:45:15', -987654321, 1, 0),
(23, 'smu.kumpee', '$2y$10$WHTL3R8AnhffqpyV5N.awuL8DsWUo65a.w.FzVdEnSquqFvkZqKba', 'e375568c2c423c199e26f5faaed8186c', 'คัมภีร์ แซ่อึ้ง', 50, 4, 'คัมภีร์ แซ่อึ้ง', 3, 'sales', 1, '2021-11-21 18:47:23', '2021-11-27 20:44:54', -987654321, 1, 0),
(24, 'smu.suksan', '$2y$10$SB9Fd2J6TmcJPp5rnTmvCOAHqw.RqtlSjy9HOmSp1Onk1FG8UYreC', '49de6f5ec466c2e18874e28acd5240f5', 'สุขสันติ์ นิลเทศ', 65, 19, 'สุขสันติ์ นิลเทศ', 3, 'sales', 1, '2021-11-21 18:48:01', '2021-11-27 20:44:42', -987654321, 1, 0),
(25, 'smu.paiboon', '$2y$10$lKe1GPUMsQ2hkXDuJEGEf.aj7aU3jt48Nm1voeCUfas82RwNkppBK', 'af34004448b3b88112121f1506d4e454', 'ไพบูลย์ วิลาศชัยยันต์', 58, 12, 'ไพบูลย์ วิลาศชัยยันต์', 3, 'sales', 1, '2021-11-21 18:48:35', '2021-11-27 20:44:19', -987654321, 1, 0),
(26, 'smu.apornpan', '$2y$10$FHMzEAauNHQJNtxeRWIT7OgLB.sJqVnIoboVu7hdM1wxFENOo05aa', '818b57782ba3da3ba148827dba70ccfc', 'อาภรณ์ เหล่าเอี่ยม', 226, 28, 'อาภรพรรณ สาริขา', 3, 'sales', 1, '2021-11-21 18:49:37', '2021-11-27 20:49:04', -987654321, 1, 0),
(27, 'smu.suda', '$2y$10$f.DUg1q0wGdN1hEimb6djOBzazthEf2icuzjTrdBUBLTQhReUkrjq', '6cd0cd2a3ba4772a595cc5dc1b39f142', 'สุดา กิมเรือง', 66, 20, 'สุดา กิมเรือง', 3, 'sales', 1, '2021-11-21 18:50:09', '2021-11-27 20:48:56', -987654321, 1, 0),
(28, 'smu.numthip', '$2y$10$NT3uYXZEVcEJM50gXqCcSepGIjTHtpyu99C64b1ANudMtTwPe3oV6', 'b6e8b163d1a15531d00ce4c54525a042', 'น้ำทิพย์ ศิวะพรพันธ์', 56, 10, 'น้ำทิพย์ ศิวะพรพันธ์', 3, 'sales', 1, '2021-11-21 18:52:02', '2021-11-27 20:48:38', -987654321, 1, 0),
(29, 'smu.noppadol', '$2y$10$Y4DdvwtKOlEF722tpXDo8O/HnQSbN1qDCvZb8amrbxX6gRw0DpON6', '74ecba165179dbd149c8c0c93fd3d5c5', 'นพดล จีระกิจเลิศ', 285, 50, 'นพดล จีระกิจเลิศ', 3, 'sales', 1, '2021-11-21 18:53:31', '2021-11-27 20:48:25', -987654321, 1, 0),
(30, 'smu.nattawoot', '$2y$10$NhdoFxqPwi6U6el4/3we9.fWN6KDwWdJlek6ndTU3lZLww.RWrWUK', '0426570878f59cd591c5d87d434c0b40', 'ณัฐวุฒิ อิ้งเพชร', 280, 47, 'ณัฐวุฒิ อิ้งเพชร', 3, 'sales', 1, '2021-11-21 18:54:31', '2021-11-27 20:48:16', -987654321, 1, 0),
(31, 'manager.bangkok', '$2y$10$Dw/DVFePvIo7z/h3mhirhee2OyPFIz.A0Uhf89cP9hsOWOh.h36YK', '1f84bebb7f58e1d9505dbb3b6e976432', 'Bangkok Bangkok', 299, NULL, NULL, 2, 'sales', 1, '2021-11-22 15:09:45', '2021-11-22 15:11:51', 1, 1, 0),
(32, 'manager.hospital', '$2y$10$snqgqd5v/0wVcHvsXXS.ru4K8idWaIA3JOAC3V0UHsMWgSonN8qRi', 'cd94a742b0ea48f306897cc0ba54aca5', 'Hospital Hospital', 298, NULL, NULL, 2, 'sales', 1, '2021-11-22 15:10:37', '2021-11-27 20:30:18', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `add_by` varchar(50) DEFAULT NULL,
  `date_upd` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `update_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `name`, `date_add`, `add_by`, `date_upd`, `update_by`) VALUES
(-987654321, 'SuperAdmin', '2021-11-04 13:22:19', NULL, NULL, NULL),
(1, 'Administrator', '2021-11-04 21:49:06', 'superadmin', '2021-11-06 13:02:26', 'superadmin'),
(2, 'Manager', '2021-11-04 21:50:17', 'superadmin', '2021-11-06 13:02:52', 'superadmin'),
(3, 'User', '2021-11-04 21:50:32', 'superadmin', '2021-11-06 13:02:58', NULL),
(4, 'Sales Admin', '2021-11-10 17:08:30', 'superadmin', '2021-11-17 23:02:33', 'AdminGM');

-- --------------------------------------------------------

--
-- Table structure for table `user_price_list`
--

CREATE TABLE `user_price_list` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `list_id` int(3) DEFAULT NULL,
  `list_name` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_price_list`
--

INSERT INTO `user_price_list` (`id`, `user_id`, `list_id`, `list_name`) VALUES
(16, 2, 11, 'CN (30 Days)'),
(17, 2, 12, 'ช่อง 2 (90 Days)'),
(18, 2, 13, 'Goverrnment (120 Days)'),
(19, 2, 14, 'T.P. Drug\'s Clients'),
(20, 2, 15, 'Overseas'),
(119, 1, 11, 'CN (30 Days)'),
(120, 1, 12, 'ช่อง 2 (90 Days)'),
(121, 1, 13, 'Goverrnment (120 Days)'),
(122, 1, 14, 'T.P. Drug\'s Clients'),
(123, 1, 15, 'Overseas'),
(134, 3, 11, 'CN (30 Days)'),
(135, 3, 12, 'ช่อง 2 (90 Days)'),
(136, 3, 13, 'Goverrnment (120 Days)'),
(137, 3, 14, 'T.P. Drug\'s Clients'),
(138, 3, 15, 'Overseas'),
(144, 4, 15, 'Overseas'),
(145, 5, 11, 'CN (30 Days)'),
(146, 5, 12, 'ช่อง 2 (90 Days)'),
(147, 32, 11, 'CN (30 Days)'),
(148, 32, 12, 'ช่อง 2 (90 Days)'),
(149, 32, 13, 'Goverrnment (120 Days)'),
(150, 31, 11, 'CN (30 Days)'),
(151, 31, 12, 'ช่อง 2 (90 Days)'),
(152, 31, 13, 'Goverrnment (120 Days)'),
(153, 6, 15, 'Overseas'),
(157, 7, 11, 'CN (30 Days)'),
(158, 7, 12, 'ช่อง 2 (90 Days)'),
(159, 8, 11, 'CN (30 Days)'),
(160, 8, 12, 'ช่อง 2 (90 Days)'),
(161, 9, 11, 'CN (30 Days)'),
(162, 9, 12, 'ช่อง 2 (90 Days)'),
(163, 10, 11, 'CN (30 Days)'),
(164, 10, 12, 'ช่อง 2 (90 Days)'),
(165, 11, 11, 'CN (30 Days)'),
(166, 11, 12, 'ช่อง 2 (90 Days)'),
(167, 12, 11, 'CN (30 Days)'),
(168, 12, 12, 'ช่อง 2 (90 Days)'),
(169, 13, 11, 'CN (30 Days)'),
(170, 13, 12, 'ช่อง 2 (90 Days)'),
(171, 14, 11, 'CN (30 Days)'),
(172, 14, 12, 'ช่อง 2 (90 Days)'),
(173, 15, 11, 'CN (30 Days)'),
(174, 15, 12, 'ช่อง 2 (90 Days)'),
(175, 16, 11, 'CN (30 Days)'),
(176, 16, 12, 'ช่อง 2 (90 Days)'),
(177, 16, 13, 'Goverrnment (120 Days)'),
(178, 25, 11, 'CN (30 Days)'),
(179, 25, 12, 'ช่อง 2 (90 Days)'),
(180, 25, 13, 'Goverrnment (120 Days)'),
(181, 24, 11, 'CN (30 Days)'),
(182, 24, 12, 'ช่อง 2 (90 Days)'),
(183, 24, 13, 'Goverrnment (120 Days)'),
(184, 23, 11, 'CN (30 Days)'),
(185, 23, 12, 'ช่อง 2 (90 Days)'),
(186, 23, 13, 'Goverrnment (120 Days)'),
(187, 22, 11, 'CN (30 Days)'),
(188, 22, 12, 'ช่อง 2 (90 Days)'),
(189, 22, 13, 'Goverrnment (120 Days)'),
(190, 21, 11, 'CN (30 Days)'),
(191, 21, 12, 'ช่อง 2 (90 Days)'),
(192, 21, 13, 'Goverrnment (120 Days)'),
(193, 20, 11, 'CN (30 Days)'),
(194, 20, 12, 'ช่อง 2 (90 Days)'),
(195, 20, 13, 'Goverrnment (120 Days)'),
(196, 19, 11, 'CN (30 Days)'),
(197, 19, 12, 'ช่อง 2 (90 Days)'),
(198, 19, 13, 'Goverrnment (120 Days)'),
(199, 18, 11, 'CN (30 Days)'),
(200, 18, 12, 'ช่อง 2 (90 Days)'),
(201, 18, 13, 'Goverrnment (120 Days)'),
(202, 17, 11, 'CN (30 Days)'),
(203, 17, 12, 'ช่อง 2 (90 Days)'),
(204, 17, 13, 'Goverrnment (120 Days)'),
(205, 30, 11, 'CN (30 Days)'),
(206, 30, 12, 'ช่อง 2 (90 Days)'),
(207, 30, 13, 'Goverrnment (120 Days)'),
(208, 29, 11, 'CN (30 Days)'),
(209, 29, 12, 'ช่อง 2 (90 Days)'),
(210, 29, 13, 'Goverrnment (120 Days)'),
(211, 28, 11, 'CN (30 Days)'),
(212, 28, 12, 'ช่อง 2 (90 Days)'),
(213, 28, 13, 'Goverrnment (120 Days)'),
(214, 27, 11, 'CN (30 Days)'),
(215, 27, 12, 'ช่อง 2 (90 Days)'),
(216, 27, 13, 'Goverrnment (120 Days)'),
(217, 26, 11, 'CN (30 Days)'),
(218, 26, 12, 'ช่อง 2 (90 Days)'),
(219, 26, 13, 'Goverrnment (120 Days)');

-- --------------------------------------------------------

--
-- Table structure for table `user_team`
--

CREATE TABLE `user_team` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `user_role` set('GM','Manager','Lead','Sales') NOT NULL DEFAULT 'Sales'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_team`
--

INSERT INTO `user_team` (`id`, `user_id`, `team_id`, `user_role`) VALUES
(5, 4, 2, 'Sales'),
(6, 5, 1, 'Lead'),
(7, 32, 3, 'Lead'),
(8, 31, 4, 'Lead'),
(9, 6, 2, 'Lead'),
(11, 7, 1, 'Sales'),
(12, 8, 1, 'Sales'),
(13, 9, 1, 'Sales'),
(14, 10, 1, 'Sales'),
(15, 11, 1, 'Sales'),
(16, 12, 1, 'Sales'),
(17, 13, 1, 'Sales'),
(18, 14, 1, 'Sales'),
(19, 15, 1, 'Sales'),
(20, 16, 1, 'Sales'),
(21, 16, 3, 'Sales'),
(22, 25, 3, 'Sales'),
(23, 24, 3, 'Sales'),
(24, 23, 3, 'Sales'),
(25, 22, 3, 'Sales'),
(26, 21, 3, 'Sales'),
(27, 20, 3, 'Sales'),
(28, 19, 3, 'Sales'),
(29, 18, 3, 'Sales'),
(30, 17, 3, 'Sales'),
(31, 30, 4, 'Sales'),
(32, 29, 4, 'Sales'),
(33, 28, 4, 'Sales'),
(34, 27, 4, 'Sales'),
(35, 26, 4, 'Sales');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approver`
--
ALTER TABLE `approver`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`) USING BTREE,
  ADD UNIQUE KEY `uname` (`uname`) USING BTREE,
  ADD KEY `emp_name` (`emp_name`),
  ADD KEY `amount` (`amount`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `approve_rule`
--
ALTER TABLE `approve_rule`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `conditions` (`conditions`),
  ADD KEY `is_price_list` (`is_price_list`),
  ADD KEY `status` (`status`),
  ADD KEY `sale_team` (`sale_team`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`code`),
  ADD KEY `group_code` (`group_code`);

--
-- Indexes for table `customer_team`
--
ALTER TABLE `customer_team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`code`),
  ADD KEY `groupCode` (`group_code`),
  ADD KEY `active` (`active`),
  ADD KEY `sub_group` (`sub_group`),
  ADD KEY `valid` (`valid`);

--
-- Indexes for table `menu_group`
--
ALTER TABLE `menu_group`
  ADD PRIMARY KEY (`code`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `type` (`type`),
  ADD KEY `position` (`position`),
  ADD KEY `valid` (`valid`),
  ADD KEY `active` (`active`);

--
-- Indexes for table `menu_sub_group`
--
ALTER TABLE `menu_sub_group`
  ADD PRIMARY KEY (`code`),
  ADD KEY `group_code` (`group_code`),
  ADD KEY `active` (`active`),
  ADD KEY `position` (`position`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`code`),
  ADD KEY `CardCode` (`CardCode`),
  ADD KEY `CardName` (`CardName`),
  ADD KEY `Status` (`Status`),
  ADD KEY `DocNum` (`DocNum`),
  ADD KEY `Approved` (`Approved`),
  ADD KEY `uname` (`uname`),
  ADD KEY `SlpCode` (`SlpCode`),
  ADD KEY `must_approve` (`must_approve`),
  ADD KEY `Approver` (`Approver`),
  ADD KEY `DeliveryNo` (`DeliveryNo`),
  ADD KEY `InvoiceNo` (`InvoiceNo`),
  ADD KEY `CardGroup` (`CardGroup`),
  ADD KEY `VatGroup` (`VatGroup`),
  ADD KEY `priceEdit` (`priceEdit`),
  ADD KEY `promotion_code` (`promotion_code`),
  ADD KEY `promotion_id` (`promotion_id`),
  ADD KEY `is_promotion` (`is_promotion`),
  ADD KEY `CardTeam` (`CardTeam`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `LineNum` (`LineNum`),
  ADD KEY `so_code_fk` (`order_code`),
  ADD KEY `free_item` (`free_item`),
  ADD KEY `status` (`status`),
  ADD KEY `promotion_id` (`promotion_id`),
  ADD KEY `promotion_code` (`promotion_code`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menu` (`menu`,`ugroup_id`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `name` (`name`),
  ADD KEY `status` (`status`),
  ADD KEY `start_date` (`start_date`),
  ADD KEY `end_date` (`end_date`);

--
-- Indexes for table `promotion_detail`
--
ALTER TABLE `promotion_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ItemCode` (`ItemCode`),
  ADD KEY `ItemName` (`ItemName`),
  ADD KEY `id_promotion` (`promotion_id`);

--
-- Indexes for table `sale_person`
--
ALTER TABLE `sale_person`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`) USING BTREE;

--
-- Indexes for table `sale_team`
--
ALTER TABLE `sale_team`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `sale_person_id` (`sale_person_id`),
  ADD KEY `customer_team_id` (`customer_team_id`);

--
-- Indexes for table `sync_logs`
--
ALTER TABLE `sync_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_approver`
--
ALTER TABLE `team_approver`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_id2` (`team_id`,`user_id`) USING BTREE,
  ADD KEY `rule_id` (`team_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `team_customer_group`
--
ALTER TABLE `team_customer_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id_2` (`team_id`,`group_id`),
  ADD KEY `user_id` (`team_id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `sale_person_id` (`sale_person_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uname` (`uname`),
  ADD UNIQUE KEY `uid` (`uid`),
  ADD KEY `pwd` (`pwd`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `ugroup_id` (`ugroup_id`),
  ADD KEY `status` (`status`),
  ADD KEY `emp_name` (`emp_name`),
  ADD KEY `role` (`role`),
  ADD KEY `sale_name` (`sale_name`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `user_price_list`
--
ALTER TABLE `user_price_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id_2` (`user_id`,`list_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `list_id` (`list_id`);

--
-- Indexes for table `user_team`
--
ALTER TABLE `user_team`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id_2` (`user_id`,`team_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `user_role` (`user_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approver`
--
ALTER TABLE `approver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `approve_rule`
--
ALTER TABLE `approve_rule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `customer_team`
--
ALTER TABLE `customer_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `promotion_detail`
--
ALTER TABLE `promotion_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sale_person`
--
ALTER TABLE `sale_person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sale_team`
--
ALTER TABLE `sale_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sync_logs`
--
ALTER TABLE `sync_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_approver`
--
ALTER TABLE `team_approver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `team_customer_group`
--
ALTER TABLE `team_customer_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_price_list`
--
ALTER TABLE `user_price_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT for table `user_team`
--
ALTER TABLE `user_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `approver`
--
ALTER TABLE `approver`
  ADD CONSTRAINT `fk_ap_empname` FOREIGN KEY (`emp_name`) REFERENCES `user` (`emp_name`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ap_uname` FOREIGN KEY (`uname`) REFERENCES `user` (`uname`) ON UPDATE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fk_menu_group` FOREIGN KEY (`group_code`) REFERENCES `menu_group` (`code`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_menu_sub_group` FOREIGN KEY (`sub_group`) REFERENCES `menu_sub_group` (`code`) ON UPDATE CASCADE;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `so_code_fk` FOREIGN KEY (`order_code`) REFERENCES `orders` (`code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `promotion_detail`
--
ALTER TABLE `promotion_detail`
  ADD CONSTRAINT `fk_promotion_id` FOREIGN KEY (`promotion_id`) REFERENCES `promotion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `team_customer_group`
--
ALTER TABLE `team_customer_group`
  ADD CONSTRAINT `fk_team_user_group_id` FOREIGN KEY (`team_id`) REFERENCES `sale_team` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
