-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2021 at 11:18 AM
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
('8fc7588ff7765403e96d3f4acc5d1dd22a223717', '::1', 1640509080, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634303530393038303b),
('8c6e817d32b88a873dd44ef78c8f729e14024a1a', '::1', 1640509381, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634303530393338313b),
('d055fbd4c77764ab1e2206835f82385e08efc824', '::1', 1640509682, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634303530393638323b),
('89ad9e1374554bae865bc251c23b7a3fe68cec01', '::1', 1640509983, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634303530393938333b),
('b750c669b59d23a7ee283beec65abc3422425382', '::1', 1640510284, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634303531303238343b),
('9a4fe64d62eeba0899e817e58ee5b26963fb9b4e', '::1', 1640510585, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634303531303538353b),
('8cb6e1a7026ca73f43073f9366ee2873cec1f9da', '::1', 1640510886, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634303531303838363b),
('16eadb5a551dd35c47f51dcac4d6a4e01b363d13', '::1', 1640511187, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634303531313138373b),
('a214e671d10c6eeb9c700243d19626a455bee25e', '::1', 1640511488, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634303531313438383b),
('5d81dc8163689cd263188352fafe5cbeba6ae555', '::1', 1640511789, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634303531313738393b),
('aabeafae3f27cfbc29a27c42da79074f2008a9ef', '::1', 1640512090, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634303531323039303b),
('815ced3477829aae626dc3d7b0f3e074dffba192', '::1', 1640512391, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634303531323339313b),
('3de4c1c9ddf98ce43db159a7163a3f92513c554e', '::1', 1640512692, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634303531323639323b),
('9261de853129a7b48cff072ea7b277893dbf5bbd', '::1', 1640512993, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634303531323939333b),
('f08028a8f3d00dc34fe65771bb231aae595d0279', '::1', 1640513294, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634303531333239343b),
('e617ba87dc9fd7172f19eca99e0a9d7f35d8580c', '::1', 1640513595, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634303531333539353b),
('4745caf889cedf8d208df104fc311a694668b895', '::1', 1640513595, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634303531333539353b);

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
('BI_LINK', 'BI Link', 'https://app.powerbi.com/view?r=eyJrIjoiMWMyNGZkYjMtMmNhNy00OTRhLWI5ZmQtOThlYWM3YTg5YWY1IiwidCI6IjFjZDRkYjVmLTNkYWMtNDZkZS04YzNjLTVkOTZkMjZlYjBiZSIsImMiOjEwfQ%3D%3D&pageName=ReportSection', 'System', '', '2021-11-29 02:47:25'),
('CLOSE_SYSTEM', 'ปิดปรับปรุงระบบ', '0', 'System', '1 = close, 0 = open', '2021-12-08 09:59:59'),
('COMPANY_ADDRESS1', 'ที่อยู่', 'เลขที่ 98 ซอย สุขุมวิท 62 แยก 1 แขวงพระโขนงใต้', 'Company', '', '2021-11-29 03:38:28'),
('COMPANY_ADDRESS2', NULL, 'เขตพระโขนง กรุงเทพฯ', 'Company', '', '2021-11-29 03:38:28'),
('COMPANY_CODE', 'รหัสบริษัท', '0001', 'Company', '', '2019-08-31 11:49:52'),
('COMPANY_EMAIL', 'อีเมล์', 'info@tpdrug.com', 'Company', '', '2021-11-29 03:38:28'),
('COMPANY_FACEBOOK', 'facebook', '', 'Company', '', '2021-11-29 03:38:28'),
('COMPANY_FAX', 'แฟกซ์', '02 020 8581', 'Company', '', '2021-11-29 03:38:28'),
('COMPANY_FULL_NAME', 'ชื่อเต็ม', 'บริษัท ที.พี. ดรัก แลบบอราทอรี่ส์ (1969) จำกัด (สำนักงานใหญ่)', 'Company', '', '2021-11-29 03:38:28'),
('COMPANY_LINE', 'Line', '', 'Company', '', '2021-11-29 03:38:28'),
('COMPANY_NAME', 'ชื่อย่อ', 'T.P. Drug', 'Company', '', '2021-11-04 14:10:59'),
('COMPANY_PHONE', 'โทรศัพท์', '02 020 8585', 'Company', '', '2021-11-29 03:38:28'),
('COMPANY_POST_CODE', 'รหัสไปรษณีย์', '10260', 'Company', '', '2021-11-29 03:38:28'),
('COMPANY_TAX_ID', 'เลขที่ผู้เสียภาษี', '', 'Company', '', '2021-11-29 03:38:28'),
('COMPANY_WEBSITE', 'website', 'http://www.tpdrug.com', 'Company', '', '2021-11-29 03:38:28'),
('COUNTRY', 'รหัสประเทศ', 'TH', 'SAP', '', '2019-08-31 13:14:37'),
('CURRENCY', 'สกุลเงินหลัก', 'THB', 'SAP', '', '2021-12-11 04:29:08'),
('KEEP_SYNC_LOGS', 'เก็บ logs ไว้ไม่เกินวันที่กำหนด', '7', 'System', '', '2021-12-07 11:06:34'),
('PREFIX_ORDER', NULL, 'SO', 'Document', '', '2021-11-15 06:32:31'),
('PURCHASE_VAT_CODE', 'รหัสภาษีซื้อ(ต้องตรงกับ SAP)', 'P07', 'SAP', '', '2019-09-03 07:48:53'),
('PURCHASE_VAT_RATE', 'ภาษีซื้อ', '7.00', 'SAP', '', '2019-09-03 07:53:14'),
('RUN_DIGIT_ORDER', NULL, '4', 'Document', '', '2021-11-15 06:34:00'),
('SALE_VAT_CODE', 'รหัสภาษีขาย(ต้องตรงกับ SAP)', 'S07', 'SAP', '', '2019-08-31 11:56:33'),
('SALE_VAT_RATE', 'ภาษีขาย', '7.00', 'SAP', '', '2020-12-20 14:10:03'),
('USE_STRONG_PWD', 'บังคับใช้การตั้งรหัสผ่านแบบเข้มงวด', '0', 'System', '', '2021-11-29 03:34:44');

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
(1, 'Retail', '2021-11-27 15:28:59', 1, '2021-12-03 21:04:44', 1),
(3, 'Export', '2021-11-27 15:34:08', 1, '2021-12-03 21:04:57', 1),
(4, 'BKK', '2021-11-27 15:34:28', 1, '2021-12-03 21:03:40', 1),
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
('CLOSE_SYSTEM', 'Close system', NULL, 'SPM', NULL, 1, 3, 1),
('CUSTOMER_TEAM', 'Customer Team', 'customer_team', 'ADMIN', NULL, 1, 1, 1),
('ORDERPRO', 'Order Promotion', 'order_promotion', 'ORDER', NULL, 1, 2, 1),
('ORDERS', 'Order', 'orders', 'ORDER', NULL, 1, 1, 1),
('PERMISSION', 'Permission', NULL, 'SPM', NULL, 1, 3, 1),
('PROMOTION', 'Promotions', 'promotion', 'ADMIN', NULL, 1, 6, 1),
('PWDRESET', 'Reset User Password', NULL, 'SPM', NULL, 1, 1, 1),
('SALE_PERSON', 'Sales Person', 'sale_person', 'ADMIN', NULL, 1, 1, 1),
('SALE_TEAM', 'Sales Team', 'sale_team', 'ADMIN', NULL, 1, 1, 1),
('SETTING', 'Setting', 'setting', 'ADMIN', NULL, 1, 7, 1),
('SYNC_LOGS', 'Sync Logs', 'sync_data', 'ADMIN', NULL, 1, 8, 1),
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
  `Status` int(1) NOT NULL DEFAULT '0' COMMENT '-1 = Cancelled, 0 = not export, 1 = อยู่ใน Temp,  2 = เข้า SAP แล้ว, 3 = Error',
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
  `SO_Status` varchar(1) DEFAULT NULL COMMENT 'NULL = no so, O = open, C = closed, D = Cancled',
  `DeliveryNo` varchar(100) DEFAULT NULL,
  `DO_Status` varchar(1) DEFAULT NULL COMMENT 'P = Partial, F = Full',
  `InvoiceNo` varchar(100) DEFAULT NULL,
  `INV_Status` varchar(1) DEFAULT NULL COMMENT 'P = Partial, F = Full',
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

INSERT INTO `orders` (`code`, `CardCode`, `CardName`, `CardGroup`, `CardTeam`, `CardType`, `VatGroup`, `SlpCode`, `GroupNum`, `PriceList`, `NumAtCard`, `DocCur`, `DocRate`, `DocTotal`, `VatSum`, `PayToCode`, `ShipToCode`, `Address`, `Address2`, `Address3`, `DocNum`, `Status`, `Approved`, `Approver`, `ApproveDate`, `Approval_status`, `DocDate`, `DocDueDate`, `OwnerCode`, `Comments`, `date_add`, `date_upd`, `user_id`, `uname`, `upd_user_id`, `must_approve`, `temp_date`, `sap_date`, `Message`, `SO_Status`, `DeliveryNo`, `DO_Status`, `InvoiceNo`, `INV_Status`, `InvoiceDate`, `BillDate`, `requireSQ`, `priceEdit`, `is_promotion`, `promotion_id`, `promotion_code`) VALUES
('SO-21110001', 'CLTV-01M008', 'บริษัท เอ็ม เอส เฮลธ์ แคร์ จำกัด', 5, 1, 'V', 'S07', 3, 3, 11, NULL, 'THB', '1.000000', '60000.000000', '3925.230000', '00000', '00000', 'เลขที่ 193/6-7 ถนนบรมไตรโลกนารถ ตำบลในเมือง อำเภอเมืองพิษณุโลก จังหวัดพิษณุโลก 65000 ', 'เลขที่ 193/6-7 ถนนบรมไตรโลกนารถ ตำบลในเมือง อำเภอเมืองพิษณุโลก จังหวัดพิษณุโลก 65000 ', NULL, NULL, 1, 'A', 'manager.retail', '2021-11-28 00:24:09', 'F', '2021-11-27', '2021-11-30', 49, NULL, '2021-11-28 00:05:31', '2021-11-27 17:24:09', 12, 'smu.komsun', NULL, 1, '2021-11-28 00:24:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21110002', 'CLTV-01B006', 'นายบัญชา ตระกูล', 5, 1, 'V', 'S07', 3, 3, 11, NULL, 'THB', '1.000000', '322500.000000', '21098.130000', '00000', '00000', '48/2 หมู่ที่ 1 ตำบลบ้านกร่าง อำเภอกงไกรลาศ จังหวัดสุโขทัย 64170 ', '48/2 หมู่ที่ 1 ตำบลบ้านกร่าง อำเภอกงไกรลาศ จังหวัดสุโขทัย 64170 ', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-11-28', '2021-12-01', 49, NULL, '2021-11-28 00:25:31', '2021-11-27 17:25:31', 12, 'smu.komsun', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, NULL, NULL),
('SO-21110003', 'CLTQ-01A002', 'พลตรีอนุศร', 5, 6, 'V', 'X0', 42, 3, 11, NULL, 'THB', '1.000000', '20000.000000', '0.000000', '00000', '00000', 'เสรีไทย 71 กรุงเทพฯ ', 'เสรีไทย 71 กรุงเทพฯ ', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-11-28', '2021-12-01', 44, NULL, '2021-11-28 00:27:48', '2021-11-27 17:27:48', 3, 'admin1', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21110004', 'CLTV-04A040', 'คลินิกหมออนุชา', 8, 3, 'V', 'S07', 9, 3, 11, NULL, 'THB', '1.000000', '112000.000000', '7327.100000', '00000', '00000', '227 หมู่ 5 ตเขาพนม อำเภอเขาพนม จังหวัดกระบี่ 81140 ', '227 หมู่ 5 ตเขาพนม อำเภอเขาพนม จังหวัดกระบี่ 81140 ', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-11-28', '2021-12-01', 55, NULL, '2021-11-28 00:41:05', '2021-11-27 17:41:05', 16, 'smu.nanthawan', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21110005', 'CLTV-04B031', 'บริษัท บีกิฟท์ เมดิคอล จำกัด', 8, 3, 'V', 'S07', 9, 3, NULL, NULL, 'THB', '1.000000', '41500.000000', '2714.950000', '00000', '00000', 'เลขที่ 62/10 หมู่ที่ 7 ตำบลฉลอง อำเภอเมืองภูเก็ต จังหวัดภูเก็ต 83130 ', 'เลขที่ 62/10 หมู่ที่ 7 ตำบลฉลอง อำเภอเมืองภูเก็ต จังหวัดภูเก็ต 83130 ', NULL, NULL, 1, 'A', 'System', '2021-11-28 00:46:35', NULL, '2021-11-28', '2021-12-01', 55, NULL, '2021-11-28 00:46:35', '2021-11-27 17:54:19', 16, 'smu.nanthawan', NULL, 0, '2021-11-28 00:46:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 1, 'PM-210001'),
('SO-21110006', 'CLTQ-01A046', 'อนันต์โอสถ', 5, 1, 'V', 'X0', 9, 3, NULL, NULL, 'THB', '1.000000', '12500.000000', '0.000000', '00000', '00000', '18 ถนนรักษ์นรกิจ อำเภอสวี จังหวัดชุมพร 86130 ', '18 ถนนรักษ์นรกิจ อำเภอสวี จังหวัดชุมพร 86130 ', NULL, NULL, 1, 'A', 'System', '2021-11-28 00:55:57', NULL, '2021-11-28', '2021-12-01', 55, NULL, '2021-11-28 00:55:57', '2021-11-27 17:55:57', 16, 'smu.nanthawan', NULL, 0, '2021-11-28 00:55:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 2, 'PM-210002'),
('SO-21120001', 'COTV-11B004', 'BORNEO PACIFIC PHARMACEUTICALS CO.,LTD.', 15, NULL, 'V', 'S00', 42, 6, 15, NULL, 'THB', '1.000000', '9999.000000', '0.000000', '00000', '00000', 'allotment 22, section 496, gordons, national capital district p.o.box 1614, port moresby Papua New Guinea', 'allotment 22, section 496, gordons, national capital district p.o.box 1614, port moresby Papua New Guinea', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-12-03', '2021-12-06', 38, NULL, '2021-12-03 22:04:31', '2021-12-03 15:04:31', 4, 'admin2', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, NULL, NULL),
('SO-21120002', 'COTV-11B004', 'BORNEO PACIFIC PHARMACEUTICALS CO.,LTD.', 15, 7, 'V', 'S00', 42, 6, 15, NULL, 'THB', '1.000000', '9999.000000', '0.000000', '00000', '00000', 'allotment 22, section 496, gordons, national capital district p.o.box 1614, port moresby Papua New Guinea', 'allotment 22, section 496, gordons, national capital district p.o.box 1614, port moresby Papua New Guinea', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-12-03', '2021-12-06', 38, NULL, '2021-12-03 22:21:35', '2021-12-03 15:21:35', 4, 'admin2', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, NULL, NULL),
('SO-21120003', 'COTV-11B004', 'BORNEO PACIFIC PHARMACEUTICALS CO.,LTD.', 15, 7, 'V', 'S00', 42, 6, 15, NULL, 'THB', '1.000000', '319968.000000', '0.000000', '00000', '00000', 'allotment 22, section 496, gordons, national capital district p.o.box 1614, port moresby Papua New Guinea', 'allotment 22, section 496, gordons, national capital district p.o.box 1614, port moresby Papua New Guinea', NULL, NULL, 1, 'A', 'admin', '2021-12-04 10:41:08', 'F', '2021-12-03', '2021-12-06', 38, NULL, '2021-12-03 22:23:04', '2021-12-11 07:16:41', 4, 'admin2', NULL, 1, '2021-12-11 14:16:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, NULL, NULL),
('SO-21120004', 'CLTV-04B031', 'บริษัท บีกิฟท์ เมดิคอล จำกัด', 8, 3, 'V', 'S07', 9, 6, 12, NULL, 'THB', '1.000000', '53000.000000', '3467.290000', '00000', '00000', 'เลขที่ 62/10 หมู่ที่ 7 ตำบลฉลอง อำเภอเมืองภูเก็ต จังหวัดภูเก็ต 83130 ', 'เลขที่ 62/10 หมู่ที่ 7 ตำบลฉลอง อำเภอเมืองภูเก็ต จังหวัดภูเก็ต 83130 ', NULL, NULL, 0, 'R', 'manager.hospital', '2021-12-08 17:45:01', 'R', '2021-12-03', '2021-12-06', 55, NULL, '2021-12-03 22:27:22', '2021-12-08 10:45:01', 16, 'smu.nanthawan', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21120005', 'CLTV-01G002', 'บริษัท จี้อันตึ๊ง หัวหิน จำกัด', 5, 1, 'V', NULL, 9, 3, 11, NULL, 'THB', '1.000000', '69000.000000', '4514.020000', '00000', '00000', 'เลขที่ 55 ถนนเพชรเกษม ตำบลหัวหิน อำเภอหัวหิน จังหวัดประจวบคีรีขันธ์ 77110 ', 'เลขที่ 55 ถนนเพชรเกษม ตำบลหัวหิน อำเภอหัวหิน จังหวัดประจวบคีรีขันธ์ 77110 ', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-12-03', '2021-12-06', 55, NULL, '2021-12-03 22:27:57', '2021-12-03 15:27:57', 16, 'smu.nanthawan', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21120006', 'CLTV-04A040', 'คลินิกหมออนุชา', 8, 3, 'V', 'S07', 9, 3, 11, NULL, 'THB', '1.000000', '840000.000000', '54953.270000', '00000', '00000', '227 หมู่ 5 ตเขาพนม อำเภอเขาพนม จังหวัดกระบี่ 81140 ', '227 หมู่ 5 ตเขาพนม อำเภอเขาพนม จังหวัดกระบี่ 81140 ', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-12-03', '2021-12-06', 55, NULL, '2021-12-03 22:28:46', '2021-12-03 15:28:46', 16, 'smu.nanthawan', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, NULL, NULL),
('SO-21120007', 'CLTQ-05L025', 'ลาดพร้าว 101 รักษาสัตว์', 9, 4, 'V', 'X0', 42, 3, 11, NULL, 'THB', '1.000000', '60000.000000', '0.000000', '00000', '00000', '1210 ซอยลาดพร้าว 101 แขวงคลองจั่น เขตบางกะปิ กรุงเทพฯ ', '1210 ซอยลาดพร้าว 101 แขวงคลองจั่น เขตบางกะปิ กรุงเทพฯ ', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-12-03', '2021-12-06', 44, NULL, '2021-12-03 22:46:49', '2021-12-03 15:46:49', 3, 'admin1', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21120008', 'COTV-11A001', 'AHMED ALI ABDULLE', 15, 7, 'V', 'S00', 42, 3, 15, NULL, 'THB', '1.000000', '99990.000000', '0.000000', '00000', '00000', 'TEL : 25224000095 SMALL HRG ROAD HARGEISA, SOMALI-LAND Somalia', 'TEL : 25224000095 SMALL HRG ROAD HARGEISA, SOMALI-LAND Somalia', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-12-04', '2021-12-07', 38, NULL, '2021-12-04 10:17:14', '2021-12-04 03:17:14', 4, 'admin2', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, NULL, NULL),
('SO-21120009', 'COTV-11A001', 'AHMED ALI ABDULLE', 15, 7, 'V', 'S00', 42, 3, 15, NULL, 'THB', '1.000000', '99990.000000', '0.000000', '00000', '00000', 'TEL : 25224000095 SMALL HRG ROAD HARGEISA, SOMALI-LAND Somalia', 'TEL : 25224000095 SMALL HRG ROAD HARGEISA, SOMALI-LAND Somalia', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-12-04', '2021-12-07', 38, NULL, '2021-12-04 10:40:11', '2021-12-04 03:40:11', 4, 'admin2', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, NULL, NULL),
('SO-21120010', 'CLTV-01A003', 'บริษัท เอเพ็กซ์ เมดิคอล เซ็นเตอร์ จำกัด', 5, 4, 'V', 'S07', 42, 3, 11, NULL, 'THB', '1.000000', '2100.000000', '137.380000', '00000', '00000', '82 ซอยสุขุมวิท2 แขวงคลองเตย เขตคลองเตย กรุงเทพฯ 10110 ', '82 ซอยสุขุมวิท2 แขวงคลองเตย เขตคลองเตย กรุงเทพฯ 10110 ', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-12-04', '2021-12-07', 44, NULL, '2021-12-04 10:42:58', '2021-12-04 03:42:58', 3, 'admin1', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21120011', 'CLTV-01A003', 'บริษัท เอเพ็กซ์ เมดิคอล เซ็นเตอร์ จำกัด', 5, NULL, 'V', 'S07', 42, 3, 11, NULL, 'THB', '1.000000', '2100.000000', '137.380000', '00000', '00000', '82 ซอยสุขุมวิท2 แขวงคลองเตย เขตคลองเตย กรุงเทพฯ 10110 ', '82 ซอยสุขุมวิท2 แขวงคลองเตย เขตคลองเตย กรุงเทพฯ 10110 ', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-12-04', '2021-12-07', 44, NULL, '2021-12-04 10:51:11', '2021-12-04 03:51:11', 3, 'admin1', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21120012', 'CLTV-01A003', 'บริษัท เอเพ็กซ์ เมดิคอล เซ็นเตอร์ จำกัด', 5, 9, 'V', 'S07', 42, 3, 11, NULL, 'THB', '1.000000', '2100.000000', '137.380000', '00000', '00000', '82 ซอยสุขุมวิท2 แขวงคลองเตย เขตคลองเตย กรุงเทพฯ 10110 ', '82 ซอยสุขุมวิท2 แขวงคลองเตย เขตคลองเตย กรุงเทพฯ 10110 ', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-12-04', '2021-12-07', 44, NULL, '2021-12-04 10:56:23', '2021-12-04 03:56:23', 3, 'admin1', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21120013', 'CLTQ-01A005', 'อรุณเภสัช', 5, 1, 'V', 'X0', 26, 3, 11, NULL, 'THB', '1.000000', '2100.000000', '0.000000', '00000', '00000', '292-293 ตลาดโพทะเล ถนนมุกดาอุทิศ อำเภอโพทะเล จังหวัดพิจิตร 66130 ', '292-293 ตลาดโพทะเล ถนนมุกดาอุทิศ อำเภอโพทะเล จังหวัดพิจิตร 66130 ', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-12-04', '2021-12-07', 44, NULL, '2021-12-04 10:58:09', '2021-12-04 03:58:09', 3, 'admin1', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21120014', 'CLTQ-02A057', 'ร้านอรรถพร', 6, 1, 'V', 'X0', 49, 3, 11, NULL, 'THB', '1.000000', '2100.000000', '0.000000', '00000', '00000', '480 ถนนทหารบก (วัดกลาง) อำเภอเมือง จังหวัดนครปฐม 73000 ', '480 ถนนทหารบก (วัดกลาง) อำเภอเมือง จังหวัดนครปฐม 73000 ', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-12-04', '2021-12-07', 44, NULL, '2021-12-04 10:59:23', '2021-12-04 03:59:23', 3, 'admin1', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21120015', 'CLTV-04K039', 'นายแพทย์กิตติศักดิ์ พนมพงศ์', 8, 3, 'V', 'S07', 11, 3, 11, NULL, 'THB', '1.000000', '2100.000000', '137.380000', '00000', '00000', '331 หมู่ 8 ตำบลขวัญเมือง อำเภอเสลภูมิ จังหวัดร้อยเอ็ด 45120 ', '331 หมู่ 8 ตำบลขวัญเมือง อำเภอเสลภูมิ จังหวัดร้อยเอ็ด 45120 ', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-12-04', '2021-12-07', 44, NULL, '2021-12-04 11:03:56', '2021-12-04 04:03:56', 3, 'admin1', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21120016', 'CLTV-04K039', 'นายแพทย์กิตติศักดิ์ พนมพงศ์', 8, 3, 'V', 'S07', 11, 3, 11, NULL, 'THB', '1.000000', '2100.000000', '137.380000', '00000', '00000', '331 หมู่ 8 ตำบลขวัญเมือง อำเภอเสลภูมิ จังหวัดร้อยเอ็ด 45120 ', '331 หมู่ 8 ตำบลขวัญเมือง อำเภอเสลภูมิ จังหวัดร้อยเอ็ด 45120 ', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-12-04', '2021-12-07', 44, NULL, '2021-12-04 11:05:32', '2021-12-04 04:05:32', 3, 'admin1', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21120017', 'CLTV-04K039', 'นายแพทย์กิตติศักดิ์ พนมพงศ์', 8, NULL, 'V', 'S07', 11, 3, 11, NULL, 'THB', '1.000000', '6000.000000', '392.520000', '00000', '00000', '331 หมู่ 8 ตำบลขวัญเมือง อำเภอเสลภูมิ จังหวัดร้อยเอ็ด 45120 ', '331 หมู่ 8 ตำบลขวัญเมือง อำเภอเสลภูมิ จังหวัดร้อยเอ็ด 45120 ', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-12-04', '2021-12-07', 44, NULL, '2021-12-04 18:34:13', '2021-12-04 11:34:13', 3, 'admin1', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21120018', 'CLTV-04K039', 'นายแพทย์กิตติศักดิ์ พนมพงศ์', 8, 1, 'V', 'S07', 11, 3, 11, NULL, 'THB', '1.000000', '2100.000000', '137.380000', '00000', '00000', '331 หมู่ 8 ตำบลขวัญเมือง อำเภอเสลภูมิ จังหวัดร้อยเอ็ด 45120 ', '331 หมู่ 8 ตำบลขวัญเมือง อำเภอเสลภูมิ จังหวัดร้อยเอ็ด 45120 ', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-12-04', '2021-12-07', 44, NULL, '2021-12-04 18:35:32', '2021-12-04 11:35:32', 3, 'admin1', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21120019', 'CLTV-04K039', 'นายแพทย์กิตติศักดิ์ พนมพงศ์', 8, 1, 'V', 'S07', 11, 6, NULL, NULL, 'THB', '1.000000', '4150.000000', '271.500000', '00000', '00000', '331 หมู่ 8 ตำบลขวัญเมือง อำเภอเสลภูมิ จังหวัดร้อยเอ็ด 45120 ', '331 หมู่ 8 ตำบลขวัญเมือง อำเภอเสลภูมิ จังหวัดร้อยเอ็ด 45120 ', NULL, NULL, 1, 'A', 'System', '2021-12-04 18:39:46', NULL, '2021-12-04', '2021-12-07', 44, NULL, '2021-12-04 18:39:46', '2021-12-04 11:39:47', 3, 'admin1', NULL, 0, '2021-12-04 18:39:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 1, 'PM-210001'),
('SO-21120020', 'CLTV-01B008', 'บ้านยากงไกรลาศ', 5, 1, 'V', 'S07', 3, 3, 11, NULL, 'THB', '1.000000', '1800.000000', '117.760000', '00000', '00000', 'เลขที่ 51/9 หมู่ที่ 2 ตำบลบ้านกร่าง อำเภอกงไกรลาศ จังหวัดสุโขทัย 64170 ', 'เลขที่ 51/9 หมู่ที่ 2 ตำบลบ้านกร่าง อำเภอกงไกรลาศ จังหวัดสุโขทัย 64170 ', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-12-04', '2021-12-07', 49, NULL, '2021-12-04 21:13:12', '2021-12-04 14:13:12', 12, 'smu.komsun', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21120021', 'CLTV-04K039', 'นายแพทย์กิตติศักดิ์ พนมพงศ์', 8, 1, 'V', 'S07', 11, 3, 11, NULL, 'THB', '1.000000', '2100.000000', '137.380000', '00000', '00000', '331 หมู่ 8 ตำบลขวัญเมือง อำเภอเสลภูมิ จังหวัดร้อยเอ็ด 45120 ', '331 หมู่ 8 ตำบลขวัญเมือง อำเภอเสลภูมิ จังหวัดร้อยเอ็ด 45120 ', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-12-08', '2021-12-11', 44, NULL, '2021-12-08 17:09:36', '2021-12-08 10:09:36', 3, 'admin1', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21120022', 'CLTQ-01N002', 'นำเจริญการแพทย์', 5, 4, 'V', 'X0', 8, 3, 11, NULL, 'THB', '1.000000', '2100.000000', '0.000000', '00000', '00000', 'หน้าโรงพยาบาลราชวิถี เลขที่ 407/13-14 ถนนราชวิถี แขวงทุ่งพญาไท เขตราชเทวี กรุงเทพมหานคร 10400 ', 'หน้าโรงพยาบาลราชวิถี เลขที่ 407/13-14 ถนนราชวิถี แขวงทุ่งพญาไท เขตราชเทวี กรุงเทพมหานคร 10400 ', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-12-08', '2021-12-11', 44, NULL, '2021-12-08 17:11:25', '2021-12-08 10:11:25', 3, 'admin1', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21120023', 'CLTV-03P033', 'ห้างหุ้นส่วนจำกัด ไพบูลย์อิมปอร์ต-เอ็กซปอร์ต (สำนักงานใหญ่)', 7, 6, 'V', 'S07', 42, 3, 11, NULL, 'THB', '1.000000', '2100.000000', '137.380000', '00000', '00000', '31 ถนนประสาทวิถี อำเภอแม่สอด จังหวัดตาก 63110 ', '31 ถนนประสาทวิถี อำเภอแม่สอด จังหวัดตาก 63110 ', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-12-08', '2021-12-11', 44, NULL, '2021-12-08 17:12:24', '2021-12-08 10:12:24', 3, 'admin1', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21120024', 'COTV-11D002', 'DELTA PHARM CO.,LTD', 15, 7, 'V', 'S00', 42, 3, 15, NULL, 'THB', '1.000000', '99900.000000', '0.000000', '00000', '00000', 'FLAT D,6/F.,MAI ON IND.BLDG., 17-21 KUNG YIP STREET, Hong Kong', 'FLAT D,6/F.,MAI ON IND.BLDG., 17-21 KUNG YIP STREET, Hong Kong', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-12-08', '2021-12-11', 38, NULL, '2021-12-08 17:13:43', '2021-12-08 10:13:43', 4, 'admin2', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21120025', 'CLTV-01K002', 'บริษัท คลังยาบางปะกอก จำกัด', 5, 9, 'V', 'S07', 42, 3, 11, NULL, 'THB', '1.000000', '6400.000000', '418.690000', '00000', '00000', '1485 ถนนสุขสวัสดิ์ แขวงบางปะกอก เขตราษฎร์บูรณะ กรุงเทพมหานคร 10140 ', '1485 ถนนสุขสวัสดิ์ แขวงบางปะกอก เขตราษฎร์บูรณะ กรุงเทพมหานคร 10140 ', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-12-08', '2021-12-11', 44, NULL, '2021-12-08 17:15:53', '2021-12-08 10:15:53', 3, 'admin1', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21120026', 'CLTV-05A046', 'บริษัท โรงพยาบาลสัตว์อานนท์ จำกัด', 9, 3, 'V', 'S07', 14, 3, 11, NULL, 'THB', '1.000000', '2000.000000', '130.840000', '00000', '00000', '370/4 หมู่ 15 ถนนสันโค้งหลวง ตำบลรอบเวียง อำเภอเมือง จังหวัดเชียงราย 57000 ', '370/4 หมู่ 15 ถนนสันโค้งหลวง ตำบลรอบเวียง อำเภอเมือง จังหวัดเชียงราย 57000 ', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-12-08', '2021-12-11', 44, NULL, '2021-12-08 17:16:40', '2021-12-08 10:16:40', 3, 'admin1', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21120027', 'CLTV-07R049', 'โรงพยาบาลระนอง', 11, 3, 'V', 'S07', 9, 7, 13, NULL, 'THB', '1.000000', '8000.000000', '523.360000', '00000', '00000', 'ฝ่ายเภสัชกรรม อำเภอเมือง จังหวัดระนอง 85000 ', 'ฝ่ายเภสัชกรรม อำเภอเมือง จังหวัดระนอง 85000 ', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-12-08', '2021-12-11', 44, NULL, '2021-12-08 17:20:24', '2021-12-08 10:20:24', 3, 'admin1', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21120028', 'CLTV-02N022', 'บริษัท เอ็นซี อาหารสัตว์ แอนด์ เฮลท์ จำกัด', 6, 1, 'V', 'S07', 9, 3, 11, NULL, 'THB', '1.000000', '2100.000000', '137.380000', '00000', '00000', '170 ถนนประจวบคีรีขันธ์ ตำบลประจวบคีรีขันธ์ อำเภอเมือง จังหวัดประจวบคีรีขันธ์ 77000 ', '170 ถนนประจวบคีรีขันธ์ ตำบลประจวบคีรีขันธ์ อำเภอเมือง จังหวัดประจวบคีรีขันธ์ 77000 ', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-12-08', '2021-12-11', 44, NULL, '2021-12-08 17:21:15', '2021-12-08 10:21:15', 3, 'admin1', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21120029', 'CLTQ-01J039', 'เจน ซูเปอร์มาร์ท', 5, NULL, 'V', 'X0', 13, 3, 11, NULL, 'THB', '1.000000', '6900.000000', '0.000000', '00000', '00000', '361/8-10 ตลาดห้วยกระบอก อำเภอบ้านโป่ง จังหวัดราชบุรี 70110 ', '361/8-10 ตลาดห้วยกระบอก อำเภอบ้านโป่ง จังหวัดราชบุรี 70110 ', NULL, NULL, 0, 'P', NULL, NULL, NULL, '2021-12-08', '2021-12-11', 44, NULL, '2021-12-08 17:22:09', '2021-12-08 10:22:09', 3, 'admin1', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21120030', 'CLTQ-01J039', 'เจน ซูเปอร์มาร์ท', 5, 10, 'V', 'X0', 13, 3, 11, NULL, 'THB', '1.000000', '2100.000000', '0.000000', '00000', '00000', '361/8-10 ตลาดห้วยกระบอก อำเภอบ้านโป่ง จังหวัดราชบุรี 70110 ', '361/8-10 ตลาดห้วยกระบอก อำเภอบ้านโป่ง จังหวัดราชบุรี 70110 ', NULL, NULL, 1, 'A', 'admin.sup', '2021-12-08 17:33:49', 'F', '2021-12-08', '2021-12-11', 44, NULL, '2021-12-08 17:27:13', '2021-12-08 10:33:50', 3, 'admin1', NULL, 1, '2021-12-08 17:33:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21120031', 'CLTV-04B042', 'บลูมมิ่ง คลินิกเวชกรรม', 8, 3, 'V', NULL, 6, 3, 11, NULL, 'THB', '1.000000', '7300.000000', '477.570000', '00000', '00000', 'เลขที่ 8/888 หมู่ที่ 4 ตำบลมาบยางพร อำเภอปลวกแดง จังหวัดระยอง 21140 ', 'บลูมมิ่ง คลินิกเวชกรรม ภายในปั้มน้ำมัน ปตท.สะพานสี่ เลขที่ 8/888 หมู่ที่ 4 ตำบลมาบยางพร อำเภอปลวกแดง จังหวัดระยอง 21140 ', NULL, NULL, 1, 'A', 'manager.hospital', '2021-12-08 17:39:23', 'P', '2021-12-08', '2021-12-11', 52, NULL, '2021-12-08 17:38:42', '2021-12-08 10:55:40', 19, 'smu.natthapa', NULL, 1, '2021-12-08 17:55:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL, NULL),
('SO-21120032', 'CLTV-01B006', 'นายบัญชา ตระกูล', 5, 1, 'V', 'S07', 3, 3, 11, NULL, 'THB', '1.000000', '4250.000000', '278.040000', '00000', '00000', '48/2 หมู่ที่ 1 ตำบลบ้านกร่าง อำเภอกงไกรลาศ จังหวัดสุโขทัย 64170 ', '48/2 หมู่ที่ 1 ตำบลบ้านกร่าง อำเภอกงไกรลาศ จังหวัดสุโขทัย 64170 ', NULL, NULL, 1, 'A', 'System', '2021-12-10 22:15:33', NULL, '2021-12-10', '2021-12-13', 49, NULL, '2021-12-10 22:15:33', '2021-12-10 15:45:25', 12, 'smu.komsun', NULL, 0, '2021-12-10 22:45:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, NULL, NULL),
('SO-21120033', 'COTV-11A001', 'AHMED ALI ABDULLE', 15, 7, 'V', 'S00', 42, 3, NULL, NULL, 'USS', '33.522600', '150.000000', '0.000000', '00000', '00000', 'TEL : 25224000095 SMALL HRG ROAD HARGEISA, SOMALI-LAND Somalia', 'TEL : 25224000095 SMALL HRG ROAD HARGEISA, SOMALI-LAND Somalia', NULL, NULL, 1, 'A', 'System', '2021-12-11 12:29:00', NULL, '2021-12-11', '2021-12-14', 38, NULL, '2021-12-11 12:29:00', '2021-12-11 07:15:09', 4, 'admin2', NULL, 0, '2021-12-11 14:15:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 1, 'PM-210001'),
('SO-21120034', 'CLTV-01A001', 'บริษัท เอเชีย คอมเมิร์ซ โซลูชั่น จำกัด', 5, 9, 'V', 'S07', 41, 6, NULL, NULL, 'THB', '1.000000', '4150.000000', '271.500000', '00000', '00000', '199/46 ถนนนวลจันทร์ แขวงนวลจันทร์ เขตบึงกุ่ม กรุงเทพฯ ', '199/46 ถนนนวลจันทร์ แขวงนวลจันทร์ เขตบึงกุ่ม กรุงเทพฯ ', NULL, NULL, 1, 'A', 'System', '2021-12-16 12:18:15', NULL, '2021-12-16', '2021-12-19', 44, NULL, '2021-12-16 12:18:15', '2021-12-16 05:18:16', 3, 'admin1', NULL, 0, '2021-12-16 12:18:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 1, 'PM-210001'),
('SO-21120035', 'CLTV-01A001', 'บริษัท เอเชีย คอมเมิร์ซ โซลูชั่น จำกัด', 5, 9, 'V', 'S07', 41, 3, 11, NULL, 'THB', '1.000000', '8625.000000', '564.250000', '00000', '00000', '199/46 ถนนนวลจันทร์ แขวงนวลจันทร์ เขตบึงกุ่ม กรุงเทพฯ ', '199/46 ถนนนวลจันทร์ แขวงนวลจันทร์ เขตบึงกุ่ม กรุงเทพฯ ', NULL, NULL, 1, 'A', 'admin', '2021-12-22 21:03:09', 'F', '2021-12-22', '2021-12-25', 44, NULL, '2021-12-22 20:58:05', '2021-12-22 14:03:10', 3, 'admin1', NULL, 1, '2021-12-22 21:03:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, NULL, NULL),
('SO-21120036', 'CLTV-01A002', 'บริษัท แอนิมัล ซัพพลีเมนท์ แอนด์ ฟาร์มาซูติคอล จำกัด', 5, 9, 'V', 'S07', 42, 6, NULL, NULL, 'THB', '1.000000', '4150.000000', '271.500000', '00000', '00000', '3300/121 ตึกช้าง อาคาร บี ชั้น 24 ถนนพหลโยธิน แขวงจอมพล เขตจตุจักร กรุงเทพมหานคร 10900 ', '3300/121 ตึกช้าง อาคาร บี ชั้น 24 ถนนพหลโยธิน แขวงจอมพล เขตจตุจักร กรุงเทพมหานคร 10900 ', NULL, NULL, 1, 'A', 'System', '2021-12-22 22:13:40', NULL, '2021-12-22', '2021-12-25', 44, NULL, '2021-12-22 22:13:40', '2021-12-22 15:13:40', 3, 'admin1', NULL, 0, '2021-12-22 22:13:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 1, 'PM-210001');

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
  `FreeText` varchar(100) DEFAULT NULL,
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

INSERT INTO `order_detail` (`id`, `order_code`, `LineNum`, `ItemCode`, `ItemName`, `Qty`, `freeQty`, `UomCode`, `stdPrice`, `SellPrice`, `DiscPrcnt`, `VatGroup`, `VatRate`, `VatAmount`, `LineTotal`, `WhsCode`, `FreeText`, `LineText`, `free_item`, `link_id`, `status`, `promotion_id`, `promotion_code`) VALUES
(1, 'SO-21110001', 1, 'FG-HPN06-AMOX-0500-TP55-01', 'AMOXYCILLIN 500 mg CAP. 1x500 Caps', '100.000000', '0.000000', 'Bottle', '610.00', '600.00', '0.00', 'S07', '7.00', '3925.233645', '60000.00', '2-FG', NULL, NULL, 0, NULL, 'A', NULL, NULL),
(2, 'SO-21110002', 1, 'FG-HGN07-9VIT-0060-TP32-01', '9 VITAMIN SYR. 1x12x60 ml', '1500.000000', '0.000000', 'Dozen', '215.00', '215.00', '0.00', 'S07', '7.00', '21098.130841', '322500.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(3, 'SO-21110003', 1, 'FG-HGN07-9VIT-0060-TP32-01', '9 VITAMIN SYR. 1x12x60 ml', '100.000000', '0.000000', 'Dozen', '215.00', '200.00', '0.00', 'X0', '0.00', '0.000000', '20000.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(4, 'SO-21110004', 1, 'FG-HGN03-ADMG-0010-TP57-01', 'ADMAG-M TAB. 1x50x10 Tabs', '100.000000', '0.000000', 'Box', '325.00', '320.00', '0.00', 'S07', '7.00', '2093.457944', '32000.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(5, 'SO-21110004', 2, 'FG-HGN03-FTAB-0012-TP22-01', 'FLEXY 50 mg TAB. 1x12x12 Tabs', '100.000000', '0.000000', 'Dozen', '100.00', '100.00', '0.00', 'S07', '7.00', '654.205607', '10000.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(6, 'SO-21110004', 3, 'FG-HGS09-AEAR-0010-TP57-01', 'ARCHIFEN (CHLORAMPHENICOL) EAR DROP 1x50x10 ml', '100.000000', '0.000000', 'Box', '700.00', '700.00', '0.00', 'S07', '7.00', '4579.439252', '70000.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(7, 'SO-21110005', 1, 'FG-HGN03-BAIN-0012-TP27-01', 'BAINTO TAB. 1x12x2x12 Tabs', '100.000000', '0.000000', 'Dozen', '400.00', '400.00', '0.00', 'S07', '7.00', '2616.822430', '40000.00', '2-FG', NULL, NULL, 0, NULL, 'A', 1, 'PM-210001'),
(8, 'SO-21110005', 2, 'FG-HGN06-BUTF-0010-TP02-01', 'BUTACINON FORT 20 mg CAP. 1x10 Caps', '100.000000', '0.000000', 'Box', '15.00', '15.00', '0.00', 'S07', '7.00', '98.130841', '1500.00', '2-FG', NULL, NULL, 0, NULL, 'A', 1, 'PM-210001'),
(9, 'SO-21110006', 1, 'FG-HGN10-FGEL-0030-TP28-01', 'FLEXY GEL 1x12x30 g', '20.000000', '0.000000', 'Dozen', '270.00', '270.00', '0.00', 'X0', '0.00', '0.000000', '5400.00', '2-FG', NULL, NULL, 0, NULL, 'A', 2, 'PM-210002'),
(10, 'SO-21110006', 2, 'FG-HGN10-FGEL-0060-TP32-01', 'FLEXY GEL 1x12x60 g', '20.000000', '0.000000', 'Dozen', '355.00', '355.00', '0.00', 'X0', '0.00', '0.000000', '7100.00', '2-FG', NULL, NULL, 0, NULL, 'A', 2, 'PM-210002'),
(11, 'SO-21120001', 1, 'FG-HGN07-9VIT-0060-CA62-01', '9 VITAMIN SYR. 1x50x60 ml (CAMBODIA)', '1.000000', '0.000000', 'Box', '9999.00', '9999.00', '0.00', 'S00', '0.00', '0.000000', '9999.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(12, 'SO-21120002', 1, 'FG-HGN03-9VIT-0050-CA31-02', '9 VITAMIN+ TAB. 1x12x50 Tabs (CAMBODIA) แพ็คโหลเปลือย ลังละ 70 โหล', '1.000000', '0.000000', 'Dozen', '9999.00', '9999.00', '0.00', 'S00', '0.00', '0.000000', '9999.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(13, 'SO-21120003', 1, 'FG-HGN07-9VIT-0060-CA62-01', '9 VITAMIN SYR. 1x50x60 ml (CAMBODIA)', '32.000000', '0.000000', 'Box', '9999.00', '9999.00', '0.00', 'S00', '0.00', '0.000000', '319968.00', '2-FG', NULL, NULL, 0, NULL, 'A', NULL, NULL),
(14, 'SO-21120004', 1, 'FG-HGS01-ASPA-0001-TP56-01', 'ANTISPA INJ. 1x50x1 ml', '100.000000', '0.000000', 'Box', '540.00', '530.00', '0.00', 'S07', '7.00', '3467.289720', '53000.00', '2-FG', NULL, NULL, 0, NULL, 'R', NULL, NULL),
(15, 'SO-21120005', 1, 'FG-HGN07-9VIT-0060-TP62-01', '9 VITAMIN SYR. 1x50x60 ml', '100.000000', '0.000000', 'Box', '700.00', '690.00', '0.00', 'S07', '7.00', '4514.018692', '69000.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(16, 'SO-21120006', 1, 'FG-HGS09-ADEX-0005-TP30-01', 'ARCHIDEX EAR/EYE DROP 1x12x5 ml', '4000.000000', '0.000000', 'Dozen', '210.00', '210.00', '0.00', 'S07', '7.00', '54953.271028', '840000.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(17, 'SO-21120007', 1, 'FG-HPN06-AMOX-0500-TP55-01', 'AMOXYCILLIN 500 mg CAP. 1x500 Caps', '100.000000', '0.000000', 'Bottle', '610.00', '600.00', '0.00', 'X0', '0.00', '0.000000', '60000.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(18, 'SO-21120008', 1, 'FG-HGN03-9VIT-0050-LA31-01', '9 VITAMIN+ TAB. 1x12x50 Tabs (LAOS) ลังละ 30 โหล', '10.000000', '0.000000', 'Dozen', '9999.00', '9999.00', '0.00', 'S00', '0.00', '0.000000', '99990.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(19, 'SO-21120009', 1, 'FG-HGN07-9VIT-0100-PA03-01', '9 VITAMIN SYR. 1x100 ml (PAPUA)', '10.000000', '0.000000', 'Bottle', '9999.00', '9999.00', '0.00', 'S00', '0.00', '0.000000', '99990.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(20, 'SO-21120010', 1, 'FG-HGN07-9VIT-0060-TP32-01', '9 VITAMIN SYR. 1x12x60 ml', '10.000000', '0.000000', 'Dozen', '215.00', '210.00', '0.00', 'S07', '7.00', '137.383178', '2100.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(21, 'SO-21120011', 1, 'FG-HGN07-9VIT-0060-TP32-01', '9 VITAMIN SYR. 1x12x60 ml', '10.000000', '0.000000', 'Dozen', '215.00', '210.00', '0.00', 'S07', '7.00', '137.383178', '2100.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(22, 'SO-21120012', 1, 'FG-HGN07-9VIT-0060-TP32-01', '9 VITAMIN SYR. 1x12x60 ml', '10.000000', '0.000000', 'Dozen', '215.00', '210.00', '0.00', 'S07', '7.00', '137.383178', '2100.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(23, 'SO-21120013', 1, 'FG-HGN07-9VIT-0060-TP32-01', '9 VITAMIN SYR. 1x12x60 ml', '10.000000', '0.000000', 'Dozen', '215.00', '210.00', '0.00', 'X0', '0.00', '0.000000', '2100.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(24, 'SO-21120014', 1, 'FG-HGN07-9VIT-0060-TP32-01', '9 VITAMIN SYR. 1x12x60 ml', '10.000000', '0.000000', 'Dozen', '215.00', '210.00', '0.00', 'X0', '0.00', '0.000000', '2100.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(25, 'SO-21120015', 1, 'FG-HGN07-9VIT-0060-TP32-01', '9 VITAMIN SYR. 1x12x60 ml', '10.000000', '0.000000', 'Dozen', '215.00', '210.00', '0.00', 'S07', '7.00', '137.383178', '2100.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(26, 'SO-21120016', 1, 'FG-HGN07-9VIT-0060-TP32-01', '9 VITAMIN SYR. 1x12x60 ml', '10.000000', '0.000000', 'Dozen', '215.00', '210.00', '0.00', 'S07', '7.00', '137.383178', '2100.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(27, 'SO-21120017', 1, 'FG-HPN06-AMOX-0500-TP55-01', 'AMOXYCILLIN 500 mg CAP. 1x500 Caps', '10.000000', '0.000000', 'Bottle', '610.00', '600.00', '0.00', 'S07', '7.00', '392.523364', '6000.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(28, 'SO-21120018', 1, 'FG-HGN07-9VIT-0060-TP32-01', '9 VITAMIN SYR. 1x12x60 ml', '10.000000', '0.000000', 'Dozen', '215.00', '210.00', '0.00', 'S07', '7.00', '137.383178', '2100.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(29, 'SO-21120019', 1, 'FG-HGN06-BUTF-0010-TP02-01', 'BUTACINON FORT 20 mg CAP. 1x10 Caps', '10.000000', '0.000000', 'Box', '15.00', '15.00', '0.00', 'S07', '7.00', '9.813084', '150.00', '2-FG', NULL, NULL, 0, NULL, 'A', 1, 'PM-210001'),
(30, 'SO-21120019', 2, 'FG-HGN03-BAIN-0012-TP27-01', 'BAINTO TAB. 1x12x2x12 Tabs', '10.000000', '0.000000', 'Dozen', '400.00', '400.00', '0.00', 'S07', '7.00', '261.682243', '4000.00', '2-FG', NULL, NULL, 0, NULL, 'A', 1, 'PM-210001'),
(31, 'SO-21120020', 1, 'FG-HGN03-ADMG-0500-TP55-01', 'ADMAG-M TAB. 1x500 Tabs', '10.000000', '0.000000', 'Bottle', '190.00', '180.00', '0.00', 'S07', '7.00', '117.757009', '1800.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(32, 'SO-21120021', 1, 'FG-HGN07-9VIT-0060-TP32-01', '9 VITAMIN SYR. 1x12x60 ml', '10.000000', '0.000000', 'Dozen', '215.00', '210.00', '0.00', 'S07', '7.00', '137.383178', '2100.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(33, 'SO-21120022', 1, 'FG-HGN07-9VIT-0060-TP32-01', '9 VITAMIN SYR. 1x12x60 ml', '10.000000', '0.000000', 'Dozen', '215.00', '210.00', '0.00', 'X0', '0.00', '0.000000', '2100.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(34, 'SO-21120023', 1, 'FG-HGN07-9VIT-0060-TP32-01', '9 VITAMIN SYR. 1x12x60 ml', '10.000000', '0.000000', 'Dozen', '215.00', '210.00', '0.00', 'S07', '7.00', '137.383178', '2100.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(35, 'SO-21120024', 1, 'FG-HGN07-9VIT-0100-SO03-01', '9 VITAMIN SYR. 1X100 ml (SOMALIA)', '10.000000', '0.000000', 'Bottle', '9999.00', '9990.00', '0.00', 'S00', '0.00', '0.000000', '99900.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(36, 'SO-21120025', 1, 'FG-HGS09-ADEX-0005-TP60-01', 'ARCHIDEX EAR/EYE DROP 1x50x5 ml', '10.000000', '0.000000', 'Box', '650.00', '640.00', '0.00', 'S07', '7.00', '418.691589', '6400.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(37, 'SO-21120026', 1, 'FG-HGS09-ADEX-0005-TP30-01', 'ARCHIDEX EAR/EYE DROP 1x12x5 ml', '10.000000', '0.000000', 'Dozen', '210.00', '200.00', '0.00', 'S07', '7.00', '130.841121', '2000.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(38, 'SO-21120027', 1, 'FG-HCS02-CEFA-0001-TP56-01', 'CEFAZILLIN 1 g INJ. 1x50x1 g', '10.000000', '0.000000', 'Box', '850.00', '800.00', '0.00', 'S07', '7.00', '523.364486', '8000.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(39, 'SO-21120028', 1, 'FG-HGN07-9VIT-0060-TP32-01', '9 VITAMIN SYR. 1x12x60 ml', '10.000000', '0.000000', 'Dozen', '215.00', '210.00', '0.00', 'S07', '7.00', '137.383178', '2100.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(40, 'SO-21120029', 1, 'FG-HGN07-9VIT-0060-TP62-01', '9 VITAMIN SYR. 1x50x60 ml', '10.000000', '0.000000', 'Box', '700.00', '690.00', '0.00', 'X0', '0.00', '0.000000', '6900.00', '2-FG', NULL, NULL, 0, NULL, 'P', NULL, NULL),
(41, 'SO-21120030', 1, 'FG-HGN07-9VIT-0060-TP32-01', '9 VITAMIN SYR. 1x12x60 ml', '10.000000', '0.000000', 'Dozen', '215.00', '210.00', '0.00', 'X0', '0.00', '0.000000', '2100.00', '2-FG', NULL, NULL, 0, NULL, 'A', NULL, NULL),
(42, 'SO-21120031', 1, 'FG-HGN07-9VIT-0060-TP32-01', '9 VITAMIN SYR. 1x12x60 ml', '10.000000', '0.000000', 'Dozen', '215.00', '210.00', '0.00', 'S07', '7.00', '137.383178', '2100.00', '2-FG', NULL, NULL, 0, NULL, 'A', NULL, NULL),
(43, 'SO-21120031', 2, 'FG-HGN03-ADMG-0010-TP57-01', 'ADMAG-M TAB. 1x50x10 Tabs', '10.000000', '0.000000', 'Box', '325.00', '320.00', '0.00', 'S07', '7.00', '209.345794', '3200.00', '2-FG', NULL, NULL, 0, NULL, 'A', NULL, NULL),
(44, 'SO-21120031', 3, 'FG-HGS09-ADEX-0005-TP30-01', 'ARCHIDEX EAR/EYE DROP 1x12x5 ml', '10.000000', '0.000000', 'Dozen', '210.00', '200.00', '0.00', 'S07', '7.00', '130.841121', '2000.00', '2-FG', NULL, NULL, 0, NULL, 'R', NULL, NULL),
(45, 'SO-21120032', 1, 'FG-HGN07-9VIT-0060-TP32-01', '9 VITAMIN SYR. 1x12x60 ml', '10.000000', '10.000000', 'Dozen', '215.00', '215.00', '0.00', 'S07', '7.00', '140.654206', '2150.00', '2-FG', NULL, NULL, 0, NULL, 'A', NULL, NULL),
(46, 'SO-21120032', 2, 'FG-HGN07-9VIT-0060-TP32-01', '9 VITAMIN SYR. 1x12x60 ml', '10.000000', '0.000000', 'Dozen', '215.00', '0.00', '100.00', 'S07', '7.00', '0.000000', '0.00', '2-FG', NULL, NULL, 1, 45, 'A', NULL, NULL),
(47, 'SO-21120032', 3, 'FG-HGS09-ADEX-0005-TP30-01', 'ARCHIDEX EAR/EYE DROP 1x12x5 ml', '10.000000', '0.000000', 'Dozen', '210.00', '210.00', '0.00', 'S07', '7.00', '137.383178', '2100.00', '2-FG', NULL, NULL, 0, NULL, 'A', NULL, NULL),
(48, 'SO-21120033', 1, 'FG-HGN06-BUTF-0010-TP02-01', 'BUTACINON FORT 20 mg CAP. 1x10 Caps', '10.000000', '0.000000', 'Box', '15.00', '15.00', '0.00', 'S00', '0.00', '0.000000', '150.00', '2-FG', NULL, NULL, 0, NULL, 'A', 1, 'PM-210001'),
(49, 'SO-21120034', 1, 'FG-HGN03-BAIN-0012-TP27-01', 'FG-HGN03-BAIN-0012-TP27-01', '10.000000', '0.000000', 'Dozen', '400.00', '400.00', '0.00', 'S07', '7.00', '261.682243', '4000.00', '2-FG', NULL, NULL, 0, NULL, 'A', 1, 'PM-210001'),
(50, 'SO-21120034', 2, 'FG-HGN06-BUTF-0010-TP02-01', 'FG-HGN06-BUTF-0010-TP02-01', '10.000000', '0.000000', 'Box', '15.00', '15.00', '0.00', 'S07', '7.00', '9.813084', '150.00', '2-FG', NULL, NULL, 0, NULL, 'A', 1, 'PM-210001'),
(51, 'SO-21120035', 1, 'FG-HGN07-9VIT-0060-TP62-01', '9 VITAMIN SYR. 1x50x60 ml', '10.000000', '1.000000', 'Box', '700.00', '700.00', '0.00', 'S07', '7.00', '457.943925', '7000.00', '2-FG', 'test1', 'xxx', 0, NULL, 'A', NULL, NULL),
(52, 'SO-21120035', 2, 'FG-HGN07-9VIT-0060-TP62-01', '9 VITAMIN SYR. 1x50x60 ml', '1.000000', '0.000000', 'Box', '700.00', '0.00', '100.00', 'S07', '7.00', '0.000000', '0.00', '2-FG', NULL, NULL, 1, 51, 'A', NULL, NULL),
(53, 'SO-21120035', 3, 'FG-HGN03-ADMG-0010-TP57-01', 'ADMAG-M TAB. 1x50x10 Tabs', '5.000000', '0.000000', 'Box', '325.00', '325.00', '0.00', 'S07', '7.00', '106.308411', '1625.00', '2-FG', 'test2', 'xxx', 0, NULL, 'A', NULL, NULL),
(54, 'SO-21120036', 1, 'FG-HGN03-BAIN-0012-TP27-01', 'FG-HGN03-BAIN-0012-TP27-01', '10.000000', '0.000000', 'Dozen', '400.00', '400.00', '0.00', 'S07', '7.00', '261.682243', '4000.00', '2-FG', 'ssssss', NULL, 0, NULL, 'A', 1, 'PM-210001'),
(55, 'SO-21120036', 2, 'FG-HGN06-BUTF-0010-TP02-01', 'FG-HGN06-BUTF-0010-TP02-01', '10.000000', '0.000000', 'Box', '15.00', '15.00', '0.00', 'S07', '7.00', '9.813084', '150.00', '2-FG', 'aaaaa', NULL, 0, NULL, 'A', 1, 'PM-210001');

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
(201, 'ORDERS', 1, 1, 1, 1, 1),
(202, 'ORDERPRO', 1, 1, 1, 1, 1),
(203, 'SALE_TEAM', 1, 1, 1, 1, 1),
(204, 'SALE_PERSON', 1, 1, 1, 1, 1),
(205, 'CUSTOMER_TEAM', 1, 1, 1, 1, 1),
(206, 'USERGROUP', 1, 1, 1, 1, 1),
(207, 'USER', 1, 1, 1, 1, 1),
(208, 'APPROVER', 1, 1, 1, 1, 1),
(209, 'APPROVE_RULE', 1, 1, 1, 1, 1),
(210, 'PROMOTION', 1, 1, 1, 1, 1),
(211, 'SETTING', 1, 1, 1, 1, 1),
(212, 'SYNC_LOGS', 1, 1, 1, 1, 1),
(213, 'APPROVE_STATUS', 1, 1, 0, 0, 0),
(214, 'PWDRESET', 1, 1, 1, 1, 1),
(215, 'PERMISSION', 1, 1, 1, 1, 1),
(216, 'CLOSE_SYSTEM', 1, 1, 1, 1, 1);

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
(1, 'Representative', '2021-11-27 20:01:52', 1, '2021-12-03 21:11:38', 1),
(2, 'Somporn', '2021-11-27 20:01:59', 1, '2021-12-03 21:13:02', 1),
(3, 'TP', '2021-11-27 20:02:09', 1, '2021-12-03 21:11:47', 1);

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
(4, 'BKK', 1, 4, '2021-11-27 20:20:24', 1, '2021-12-04 10:50:30', 1),
(6, 'Company', 2, 6, '2021-11-27 20:51:15', 1, '2021-11-27 21:54:17', 1),
(7, 'Overseas-TP', 3, 3, '2021-12-03 22:17:49', 1, '2021-12-04 18:31:22', 1),
(8, 'Overseas-Somporn', 2, 3, '2021-12-04 10:27:56', 1, '2021-12-04 18:31:16', 1),
(9, 'Company-TP', 3, 6, '2021-12-04 10:55:49', 1, '2021-12-04 18:30:59', 1),
(10, 'Company-Representative', 1, 6, '2021-12-08 17:26:14', 1, '2021-12-08 17:31:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sync_logs`
--

CREATE TABLE `sync_logs` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `sync_code` varchar(10) NOT NULL,
  `get_code` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = not found, 1 = success, 3 = error',
  `message` text,
  `date_upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sync_logs`
--

INSERT INTO `sync_logs` (`id`, `code`, `sync_code`, `get_code`, `status`, `message`, `date_upd`) VALUES
(62, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 08:04:48'),
(63, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 08:05:38'),
(64, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:05:41'),
(65, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:05:41'),
(66, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:05:41'),
(67, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 08:06:48'),
(68, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 08:07:38'),
(69, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:07:41'),
(70, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:07:41'),
(71, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:07:41'),
(72, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 08:08:48'),
(73, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 08:09:38'),
(74, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:09:41'),
(75, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:09:41'),
(76, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:09:41'),
(77, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 08:10:48'),
(78, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 08:11:38'),
(79, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:11:41'),
(80, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:11:41'),
(81, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:11:41'),
(82, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 08:12:48'),
(83, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 08:13:38'),
(84, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:13:41'),
(85, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:13:41'),
(86, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:13:41'),
(87, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 08:14:48'),
(88, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 08:15:38'),
(89, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:15:41'),
(90, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:15:41'),
(91, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:15:41'),
(92, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 08:16:48'),
(93, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 08:17:38'),
(94, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:17:41'),
(95, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:17:41'),
(96, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:17:41'),
(97, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 08:18:48'),
(98, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 08:19:38'),
(99, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:19:41'),
(100, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:19:41'),
(101, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:19:41'),
(102, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 08:20:48'),
(103, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 08:21:38'),
(104, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:21:41'),
(105, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:21:41'),
(106, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:21:41'),
(107, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 08:22:48'),
(108, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 08:23:38'),
(109, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:23:41'),
(110, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:23:41'),
(111, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:23:41'),
(112, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 08:24:48'),
(113, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 08:25:38'),
(114, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:25:41'),
(115, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:25:41'),
(116, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:25:41'),
(117, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 08:26:48'),
(118, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 08:27:38'),
(119, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:27:41'),
(120, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:27:41'),
(121, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:27:41'),
(122, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 08:28:47'),
(123, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 08:29:38'),
(124, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:29:41'),
(125, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:29:41'),
(126, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:29:41'),
(127, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 08:30:47'),
(128, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 08:31:38'),
(129, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:31:41'),
(130, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:31:41'),
(131, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:31:41'),
(132, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 08:32:47'),
(133, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 08:33:38'),
(134, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:33:41'),
(135, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:33:41'),
(136, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:33:41'),
(137, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 08:34:47'),
(138, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 08:35:38'),
(139, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:35:41'),
(140, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:35:41'),
(141, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:35:41'),
(142, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 08:36:47'),
(143, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 08:37:38'),
(144, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:37:41'),
(145, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:37:41'),
(146, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:37:41'),
(147, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 08:38:47'),
(148, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 08:39:38'),
(149, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:39:41'),
(150, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:39:41'),
(151, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:39:41'),
(152, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 08:40:47'),
(153, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 08:41:38'),
(154, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:41:41'),
(155, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:41:41'),
(156, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:41:41'),
(157, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 08:42:47'),
(158, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 08:43:38'),
(159, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:43:41'),
(160, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:43:41'),
(161, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:43:41'),
(162, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 08:44:47'),
(163, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 08:45:38'),
(164, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:45:41'),
(165, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:45:41'),
(166, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:45:41'),
(167, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 08:46:47'),
(168, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 08:47:38'),
(169, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:47:41'),
(170, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:47:41'),
(171, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:47:41'),
(172, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 08:48:47'),
(173, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 08:49:38'),
(174, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:49:41'),
(175, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:49:41'),
(176, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:49:41'),
(177, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 08:50:47'),
(178, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 08:51:38'),
(179, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:51:41'),
(180, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:51:41'),
(181, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:51:41'),
(182, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 08:52:47'),
(183, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 08:53:38'),
(184, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:53:41'),
(185, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:53:41'),
(186, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:53:41'),
(187, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 08:54:47'),
(188, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 08:55:38'),
(189, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:55:41'),
(190, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:55:41'),
(191, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:55:41'),
(192, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 08:56:47'),
(193, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 08:57:38'),
(194, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:57:41'),
(195, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:57:41'),
(196, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:57:41'),
(197, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 08:58:47'),
(198, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 08:59:38'),
(199, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:59:41'),
(200, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:59:41'),
(201, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 08:59:41'),
(202, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:00:47'),
(203, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:01:38'),
(204, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:01:41'),
(205, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:01:41'),
(206, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:01:41'),
(207, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:02:47'),
(208, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:03:38'),
(209, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:03:41'),
(210, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:03:41'),
(211, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:03:41'),
(212, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:04:47'),
(213, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:05:38'),
(214, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:05:41'),
(215, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:05:41'),
(216, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:05:41'),
(217, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:06:47'),
(218, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:07:38'),
(219, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:07:41'),
(220, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:07:41'),
(221, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:07:41'),
(222, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:08:47'),
(223, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:09:38'),
(224, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:09:41'),
(225, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:09:41'),
(226, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:09:41'),
(227, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:10:47'),
(228, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:11:38'),
(229, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:11:41'),
(230, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:11:41'),
(231, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:11:41'),
(232, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:12:47'),
(233, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:13:38'),
(234, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:13:41'),
(235, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:13:41'),
(236, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:13:41'),
(237, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:14:47'),
(238, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:15:38'),
(239, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:15:41'),
(240, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:15:41'),
(241, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:15:41'),
(242, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:16:47'),
(243, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:17:38'),
(244, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:17:41'),
(245, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:17:41'),
(246, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:17:41'),
(247, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:18:47'),
(248, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:19:38'),
(249, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:19:41'),
(250, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:19:41'),
(251, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:19:41'),
(252, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:20:47'),
(253, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:21:38'),
(254, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:21:41'),
(255, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:21:41'),
(256, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:21:41'),
(257, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:22:47'),
(258, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:23:38'),
(259, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:23:41'),
(260, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:23:41'),
(261, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:23:41'),
(262, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:24:47'),
(263, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:25:38'),
(264, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:25:41'),
(265, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:25:41'),
(266, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:25:41'),
(267, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:26:47'),
(268, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:27:38'),
(269, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:27:41'),
(270, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:27:41'),
(271, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:27:41'),
(272, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:28:47'),
(273, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:29:38'),
(274, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:29:41'),
(275, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:29:41'),
(276, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:29:41'),
(277, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:30:47'),
(278, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:31:38'),
(279, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:31:41'),
(280, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:31:41'),
(281, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:31:41'),
(282, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:32:47'),
(283, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:33:38'),
(284, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:33:41'),
(285, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:33:41'),
(286, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:33:41'),
(287, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:34:47'),
(288, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:35:38'),
(289, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:35:41'),
(290, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:35:41'),
(291, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:35:41'),
(292, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:36:47'),
(293, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:37:38'),
(294, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:37:41'),
(295, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:37:41'),
(296, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:37:41'),
(297, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:38:47'),
(298, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:39:38'),
(299, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:39:41'),
(300, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:39:41'),
(301, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:39:41'),
(302, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:40:47'),
(303, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:41:38'),
(304, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:41:41'),
(305, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:41:41'),
(306, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:41:41'),
(307, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:42:47'),
(308, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:43:38'),
(309, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:43:41'),
(310, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:43:41'),
(311, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:43:41'),
(312, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:44:47'),
(313, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:45:38'),
(314, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:45:41'),
(315, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:45:41'),
(316, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:45:41'),
(317, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:46:47'),
(318, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:47:38'),
(319, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:47:41'),
(320, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:47:41'),
(321, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:47:41'),
(322, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:48:47'),
(323, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:49:38'),
(324, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:49:41'),
(325, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:49:41'),
(326, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:49:41'),
(327, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:50:47'),
(328, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:51:38'),
(329, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:51:41'),
(330, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:51:41'),
(331, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:51:41'),
(332, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:52:47'),
(333, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:53:38'),
(334, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:53:42'),
(335, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:53:42'),
(336, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:53:42'),
(337, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:54:47'),
(338, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:55:38'),
(339, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:55:41'),
(340, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:55:41'),
(341, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:55:41'),
(342, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:56:47'),
(343, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:57:38'),
(344, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:57:41'),
(345, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:57:41'),
(346, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:57:41'),
(347, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 09:58:47'),
(348, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 09:59:38'),
(349, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:59:42'),
(350, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:59:42'),
(351, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 09:59:42'),
(352, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:00:47'),
(353, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:01:39'),
(354, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:01:42'),
(355, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:01:42'),
(356, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:01:42'),
(357, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:02:47'),
(358, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:03:39'),
(359, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:03:42'),
(360, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:03:42'),
(361, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:03:42'),
(362, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:04:47'),
(363, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:05:38'),
(364, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:05:41'),
(365, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:05:41'),
(366, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:05:41'),
(367, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:06:47'),
(368, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:07:38'),
(369, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:07:42'),
(370, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:07:42'),
(371, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:07:42'),
(372, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:08:47'),
(373, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:09:38'),
(374, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:09:42'),
(375, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:09:42'),
(376, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:09:42'),
(377, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:10:47'),
(378, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:11:38'),
(379, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:11:42'),
(380, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:11:42'),
(381, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:11:42'),
(382, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:12:47'),
(383, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:13:38'),
(384, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:13:41'),
(385, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:13:41'),
(386, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:13:41'),
(387, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:14:47'),
(388, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:15:38'),
(389, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:15:42'),
(390, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:15:42'),
(391, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:15:42'),
(392, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:16:47'),
(393, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:17:38'),
(394, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:17:42'),
(395, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:17:42'),
(396, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:17:42'),
(397, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:18:47'),
(398, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:19:39'),
(399, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:19:42'),
(400, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:19:42'),
(401, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:19:42'),
(402, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:20:47'),
(403, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:21:38'),
(404, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:21:42'),
(405, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:21:42'),
(406, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:21:42'),
(407, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:22:47'),
(408, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:23:39'),
(409, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:23:42'),
(410, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:23:42'),
(411, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:23:42'),
(412, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:24:47'),
(413, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:25:39'),
(414, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:25:42'),
(415, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:25:42'),
(416, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:25:42'),
(417, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:26:47'),
(418, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:27:39'),
(419, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:27:42'),
(420, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:27:42'),
(421, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:27:42'),
(422, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:28:47'),
(423, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:29:39'),
(424, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:29:42'),
(425, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:29:42'),
(426, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:29:42'),
(427, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:30:47'),
(428, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:31:38'),
(429, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:31:42'),
(430, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:31:42'),
(431, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:31:42'),
(432, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:32:47'),
(433, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:33:39'),
(434, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:33:42'),
(435, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:33:42'),
(436, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:33:42'),
(437, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:34:47'),
(438, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:35:39'),
(439, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:35:42'),
(440, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:35:42'),
(441, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:35:42'),
(442, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:36:47'),
(443, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:37:39'),
(444, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:37:42'),
(445, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:37:42'),
(446, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:37:42'),
(447, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:38:47'),
(448, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:39:39'),
(449, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:39:42'),
(450, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:39:42'),
(451, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:39:42'),
(452, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:40:47'),
(453, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:41:39'),
(454, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:41:42'),
(455, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:41:42'),
(456, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:41:42'),
(457, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:42:47'),
(458, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:43:39'),
(459, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:43:42'),
(460, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:43:42'),
(461, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:43:42'),
(462, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:44:47'),
(463, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:45:39'),
(464, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:45:42'),
(465, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:45:42'),
(466, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:45:42'),
(467, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:46:47'),
(468, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:47:39'),
(469, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:47:42'),
(470, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:47:42'),
(471, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:47:42'),
(472, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:48:47'),
(473, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:49:39'),
(474, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:49:42'),
(475, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:49:42'),
(476, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:49:42'),
(477, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:50:47'),
(478, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:51:39'),
(479, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:51:42'),
(480, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:51:42'),
(481, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:51:42'),
(482, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:52:47'),
(483, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:53:39'),
(484, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:53:42'),
(485, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:53:42'),
(486, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:53:42'),
(487, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:54:47'),
(488, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:55:39'),
(489, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:55:42'),
(490, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:55:42'),
(491, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:55:42'),
(492, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:56:47'),
(493, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:57:39'),
(494, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:57:42'),
(495, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:57:42'),
(496, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:57:42'),
(497, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 10:58:47'),
(498, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 10:59:39'),
(499, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:59:42'),
(500, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:59:42'),
(501, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 10:59:42'),
(502, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:00:47'),
(503, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:01:39'),
(504, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:01:42'),
(505, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:01:42'),
(506, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:01:42'),
(507, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:02:47'),
(508, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:03:39'),
(509, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:03:42'),
(510, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:03:42'),
(511, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:03:42'),
(512, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:04:47'),
(513, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:05:39'),
(514, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:05:42'),
(515, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:05:42'),
(516, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:05:42'),
(517, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:06:47'),
(518, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:07:39'),
(519, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:07:42'),
(520, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:07:42'),
(521, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:07:42'),
(522, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:08:47'),
(523, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:09:39'),
(524, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:09:42'),
(525, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:09:42'),
(526, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:09:42'),
(527, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:10:47'),
(528, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:11:39'),
(529, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:11:42'),
(530, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:11:42'),
(531, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:11:42'),
(532, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:12:47'),
(533, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:13:39'),
(534, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:13:42'),
(535, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:13:42'),
(536, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:13:42'),
(537, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:14:47'),
(538, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:15:39'),
(539, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:15:42'),
(540, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:15:42'),
(541, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:15:42'),
(542, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:16:47'),
(543, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:17:39'),
(544, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:17:42'),
(545, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:17:42'),
(546, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:17:42'),
(547, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:18:47'),
(548, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:19:39'),
(549, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:19:42'),
(550, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:19:42'),
(551, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:19:42'),
(552, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:20:47'),
(553, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:21:39'),
(554, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:21:42'),
(555, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:21:42'),
(556, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:21:42'),
(557, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:22:47'),
(558, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:23:39'),
(559, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:23:42'),
(560, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:23:42'),
(561, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:23:42'),
(562, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:24:47'),
(563, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:25:39'),
(564, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:25:42'),
(565, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:25:42'),
(566, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:25:42'),
(567, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:26:47'),
(568, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:27:39'),
(569, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:27:42'),
(570, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:27:42'),
(571, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:27:42'),
(572, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:28:47'),
(573, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:29:39'),
(574, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:29:41'),
(575, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:29:41'),
(576, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:29:41'),
(577, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:30:47'),
(578, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:31:39'),
(579, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:31:41'),
(580, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:31:41'),
(581, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:31:41'),
(582, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:32:48'),
(583, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:33:39'),
(584, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:33:41'),
(585, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:33:41'),
(586, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:33:41'),
(587, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:34:48'),
(588, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:35:39'),
(589, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:35:41'),
(590, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:35:41'),
(591, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:35:41'),
(592, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:36:48'),
(593, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:37:39'),
(594, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:37:41'),
(595, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:37:41'),
(596, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:37:41'),
(597, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:38:48'),
(598, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:39:39'),
(599, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:39:41'),
(600, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:39:41'),
(601, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:39:41'),
(602, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:40:48'),
(603, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:41:39'),
(604, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:41:41'),
(605, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:41:41'),
(606, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:41:41'),
(607, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:42:48'),
(608, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:43:39'),
(609, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:43:41'),
(610, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:43:41'),
(611, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:43:41'),
(612, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:44:48'),
(613, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:45:39'),
(614, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:45:41'),
(615, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:45:41'),
(616, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:45:41'),
(617, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:46:48'),
(618, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:47:39'),
(619, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:47:41'),
(620, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:47:41'),
(621, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:47:41'),
(622, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:48:48'),
(623, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:49:39'),
(624, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:49:41'),
(625, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:49:41'),
(626, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:49:41'),
(627, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:50:48'),
(628, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:51:38'),
(629, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:51:41'),
(630, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:51:41'),
(631, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:51:41'),
(632, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:52:48'),
(633, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:53:38'),
(634, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:53:41'),
(635, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:53:41'),
(636, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:53:41'),
(637, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:54:48'),
(638, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:55:38'),
(639, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:55:41'),
(640, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:55:41'),
(641, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:55:41'),
(642, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:56:48'),
(643, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:57:38'),
(644, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:57:41'),
(645, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:57:41'),
(646, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:57:41'),
(647, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 11:58:48'),
(648, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 11:59:38'),
(649, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:59:41'),
(650, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:59:41'),
(651, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 11:59:41'),
(652, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:00:48'),
(653, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:01:38'),
(654, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:01:41'),
(655, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:01:41'),
(656, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:01:41'),
(657, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:02:48'),
(658, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:03:38'),
(659, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:03:41'),
(660, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:03:41'),
(661, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:03:41'),
(662, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:04:48'),
(663, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:05:38'),
(664, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:05:41'),
(665, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:05:41'),
(666, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:05:41'),
(667, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:06:48'),
(668, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:07:38'),
(669, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:07:41'),
(670, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:07:41'),
(671, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:07:41'),
(672, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:08:48'),
(673, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:09:38'),
(674, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:09:41'),
(675, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:09:41'),
(676, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:09:41'),
(677, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:10:48'),
(678, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:11:38'),
(679, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:11:41'),
(680, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:11:41'),
(681, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:11:41'),
(682, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:12:48'),
(683, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:13:38'),
(684, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:13:41'),
(685, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:13:41'),
(686, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:13:41'),
(687, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:14:48'),
(688, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:15:38'),
(689, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:15:41'),
(690, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:15:41'),
(691, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:15:41'),
(692, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:16:48'),
(693, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:17:38'),
(694, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:17:41'),
(695, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:17:41'),
(696, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:17:41'),
(697, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:18:48'),
(698, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:19:38'),
(699, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:19:41'),
(700, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:19:41'),
(701, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:19:41'),
(702, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:20:48');
INSERT INTO `sync_logs` (`id`, `code`, `sync_code`, `get_code`, `status`, `message`, `date_upd`) VALUES
(703, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:21:38'),
(704, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:21:41'),
(705, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:21:41'),
(706, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:21:41'),
(707, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:22:48'),
(708, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:23:38'),
(709, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:23:41'),
(710, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:23:41'),
(711, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:23:41'),
(712, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:24:48'),
(713, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:25:38'),
(714, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:25:41'),
(715, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:25:41'),
(716, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:25:41'),
(717, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:26:48'),
(718, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:27:38'),
(719, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:27:41'),
(720, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:27:41'),
(721, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:27:41'),
(722, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:28:48'),
(723, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:29:38'),
(724, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:29:41'),
(725, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:29:41'),
(726, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:29:41'),
(727, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:30:48'),
(728, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:31:38'),
(729, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:31:41'),
(730, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:31:41'),
(731, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:31:41'),
(732, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:32:48'),
(733, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:33:38'),
(734, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:33:41'),
(735, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:33:41'),
(736, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:33:41'),
(737, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:34:48'),
(738, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:35:38'),
(739, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:35:41'),
(740, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:35:41'),
(741, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:35:41'),
(742, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:36:48'),
(743, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:37:38'),
(744, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:37:41'),
(745, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:37:41'),
(746, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:37:41'),
(747, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:38:48'),
(748, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:39:38'),
(749, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:39:41'),
(750, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:39:41'),
(751, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:39:41'),
(752, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:40:48'),
(753, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:41:38'),
(754, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:41:41'),
(755, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:41:41'),
(756, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:41:41'),
(757, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:42:48'),
(758, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:43:38'),
(759, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:43:41'),
(760, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:43:41'),
(761, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:43:41'),
(762, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:44:48'),
(763, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:45:38'),
(764, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:45:41'),
(765, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:45:41'),
(766, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:45:41'),
(767, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:46:48'),
(768, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:47:38'),
(769, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:47:41'),
(770, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:47:41'),
(771, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:47:41'),
(772, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:48:47'),
(773, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:49:38'),
(774, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:49:41'),
(775, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:49:41'),
(776, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:49:41'),
(777, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:50:47'),
(778, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:51:38'),
(779, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:51:41'),
(780, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:51:41'),
(781, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:51:41'),
(782, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:52:47'),
(783, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:53:38'),
(784, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:53:41'),
(785, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:53:41'),
(786, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:53:41'),
(787, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:54:47'),
(788, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:55:38'),
(789, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:55:41'),
(790, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:55:41'),
(791, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:55:41'),
(792, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:56:47'),
(793, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:57:38'),
(794, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:57:41'),
(795, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:57:41'),
(796, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:57:41'),
(797, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 12:58:47'),
(798, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 12:59:38'),
(799, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:59:41'),
(800, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:59:41'),
(801, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 12:59:41'),
(802, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:00:47'),
(803, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:01:38'),
(804, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:01:41'),
(805, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:01:41'),
(806, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:01:41'),
(807, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:02:47'),
(808, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:03:38'),
(809, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:03:41'),
(810, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:03:41'),
(811, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:03:41'),
(812, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:04:47'),
(813, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:05:38'),
(814, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:05:41'),
(815, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:05:41'),
(816, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:05:41'),
(817, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:06:47'),
(818, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:07:38'),
(819, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:07:41'),
(820, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:07:41'),
(821, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:07:41'),
(822, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:08:47'),
(823, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:09:38'),
(824, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:09:41'),
(825, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:09:41'),
(826, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:09:41'),
(827, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:10:47'),
(828, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:11:38'),
(829, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:11:41'),
(830, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:11:41'),
(831, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:11:41'),
(832, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:12:47'),
(833, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:13:38'),
(834, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:13:41'),
(835, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:13:41'),
(836, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:13:41'),
(837, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:14:47'),
(838, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:15:38'),
(839, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:15:41'),
(840, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:15:41'),
(841, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:15:41'),
(842, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:16:47'),
(843, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:17:38'),
(844, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:17:41'),
(845, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:17:41'),
(846, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:17:41'),
(847, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:18:47'),
(848, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:19:38'),
(849, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:19:41'),
(850, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:19:41'),
(851, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:19:41'),
(852, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:20:47'),
(853, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:21:38'),
(854, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:21:41'),
(855, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:21:41'),
(856, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:21:41'),
(857, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:22:47'),
(858, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:23:38'),
(859, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:23:41'),
(860, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:23:41'),
(861, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:23:41'),
(862, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:24:47'),
(863, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:25:38'),
(864, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:25:41'),
(865, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:25:41'),
(866, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:25:41'),
(867, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:26:47'),
(868, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:27:38'),
(869, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:27:41'),
(870, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:27:41'),
(871, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:27:41'),
(872, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:28:47'),
(873, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:29:38'),
(874, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:29:41'),
(875, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:29:41'),
(876, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:29:41'),
(877, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:30:47'),
(878, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:31:38'),
(879, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:31:41'),
(880, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:31:41'),
(881, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:31:41'),
(882, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:32:47'),
(883, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:33:38'),
(884, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:33:41'),
(885, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:33:41'),
(886, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:33:41'),
(887, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:34:47'),
(888, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:35:38'),
(889, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:35:41'),
(890, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:35:41'),
(891, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:35:41'),
(892, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:36:47'),
(893, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:37:38'),
(894, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:37:41'),
(895, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:37:41'),
(896, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:37:41'),
(897, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:38:47'),
(898, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:39:38'),
(899, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:39:41'),
(900, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:39:41'),
(901, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:39:41'),
(902, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:40:47'),
(903, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:41:38'),
(904, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:41:41'),
(905, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:41:41'),
(906, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:41:41'),
(907, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:42:47'),
(908, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:43:38'),
(909, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:43:41'),
(910, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:43:41'),
(911, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:43:41'),
(912, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:44:47'),
(913, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:45:38'),
(914, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:45:41'),
(915, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:45:41'),
(916, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:45:41'),
(917, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:46:47'),
(918, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:47:38'),
(919, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:47:41'),
(920, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:47:41'),
(921, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:47:41'),
(922, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:48:47'),
(923, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:49:38'),
(924, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:49:41'),
(925, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:49:41'),
(926, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:49:41'),
(927, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:50:47'),
(928, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:51:38'),
(929, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:51:43'),
(930, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:51:43'),
(931, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:51:43'),
(932, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:52:47'),
(933, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:53:38'),
(934, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:53:41'),
(935, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:53:41'),
(936, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:53:41'),
(937, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:54:47'),
(938, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:55:38'),
(939, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:55:41'),
(940, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:55:41'),
(941, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:55:41'),
(942, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:56:47'),
(943, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:57:38'),
(944, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:57:41'),
(945, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:57:41'),
(946, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:57:41'),
(947, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 13:58:47'),
(948, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 13:59:38'),
(949, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:59:42'),
(950, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:59:42'),
(951, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 13:59:42'),
(952, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 14:00:47'),
(953, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 14:01:38'),
(954, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 14:01:41'),
(955, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 14:01:41'),
(956, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 14:01:41'),
(957, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 14:02:47'),
(958, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 14:03:38'),
(959, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 14:03:41'),
(960, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 14:03:41'),
(961, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 14:03:41'),
(962, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 14:04:47'),
(963, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 14:05:38'),
(964, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 14:05:42'),
(965, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 14:05:42'),
(966, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 14:05:42'),
(967, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 14:06:47'),
(968, 'Sync', 'INV', NULL, 0, 'No Document to Sync', '2021-11-29 14:07:38'),
(969, 'SO-21110001', 'SO', NULL, 1, 'Document not found', '2021-11-29 14:07:42'),
(970, 'SO-21110005', 'SO', NULL, 1, 'Document not found', '2021-11-29 14:07:42'),
(971, 'SO-21110006', 'SO', NULL, 1, 'Document not found', '2021-11-29 14:07:42'),
(972, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-11-29 14:08:47'),
(973, 'Clear logs', 'Logs', NULL, 1, NULL, '2021-12-04 04:43:31'),
(974, 'Sync', 'DO', NULL, 0, 'No Document to Sync', '2021-12-10 20:11:09');

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
(37, 7, 6, '2021-12-04 18:31:22'),
(41, 2, 6, '2021-12-04 18:31:44'),
(44, 10, 1, '2021-12-08 17:31:47'),
(45, 10, 2, '2021-12-08 17:31:47'),
(46, 9, 1, '2021-12-08 17:31:56'),
(47, 9, 2, '2021-12-08 17:31:56'),
(50, 8, 6, '2021-12-08 17:32:10'),
(51, 6, 1, '2021-12-08 17:32:22'),
(52, 6, 2, '2021-12-08 17:32:22'),
(54, 4, 31, '2021-12-08 17:32:35'),
(55, 4, 2, '2021-12-08 17:32:35'),
(56, 3, 32, '2021-12-08 17:32:47'),
(57, 3, 2, '2021-12-08 17:32:47'),
(58, 1, 5, '2021-12-08 17:32:59'),
(59, 1, 2, '2021-12-08 17:32:59');

-- --------------------------------------------------------

--
-- Table structure for table `team_customer_group`
--

CREATE TABLE `team_customer_group` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `group_id` int(2) NOT NULL,
  `sale_person_id` int(11) DEFAULT NULL,
  `customer_team_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `team_customer_group`
--

INSERT INTO `team_customer_group` (`id`, `team_id`, `group_id`, `sale_person_id`, `customer_team_id`) VALUES
(88, 7, 15, 3, 3),
(116, 2, 15, 1, 3),
(133, 10, 5, 1, 6),
(134, 10, 6, 1, 6),
(135, 10, 7, 1, 6),
(136, 10, 8, 1, 6),
(137, 10, 9, 1, 6),
(138, 10, 10, 1, 6),
(139, 10, 11, 1, 6),
(140, 10, 12, 1, 6),
(141, 10, 13, 1, 6),
(142, 10, 14, 1, 6),
(143, 10, 16, 1, 6),
(144, 9, 5, 3, 6),
(145, 9, 6, 3, 6),
(146, 9, 7, 3, 6),
(147, 9, 8, 3, 6),
(148, 9, 9, 3, 6),
(149, 9, 10, 3, 6),
(150, 9, 11, 3, 6),
(151, 9, 12, 3, 6),
(152, 9, 13, 3, 6),
(153, 9, 14, 3, 6),
(154, 9, 16, 3, 6),
(156, 8, 15, 2, 3),
(157, 6, 5, 2, 6),
(158, 6, 6, 2, 6),
(159, 6, 7, 2, 6),
(160, 6, 8, 2, 6),
(161, 6, 9, 2, 6),
(162, 6, 10, 2, 6),
(163, 6, 11, 2, 6),
(164, 6, 12, 2, 6),
(165, 6, 13, 2, 6),
(166, 6, 14, 2, 6),
(167, 6, 16, 2, 6),
(179, 4, 5, 1, 4),
(180, 4, 6, 1, 4),
(181, 4, 7, 1, 4),
(182, 4, 8, 1, 4),
(183, 4, 9, 1, 4),
(184, 4, 10, 1, 4),
(185, 4, 11, 1, 4),
(186, 4, 12, 1, 4),
(187, 4, 13, 1, 4),
(188, 4, 14, 1, 4),
(189, 4, 16, 1, 4),
(190, 3, 8, 1, 5),
(191, 3, 9, 1, 5),
(192, 3, 10, 1, 5),
(193, 3, 11, 1, 5),
(194, 3, 12, 1, 5),
(195, 1, 5, 1, 1),
(196, 1, 6, 1, 1),
(197, 1, 8, 1, 1),
(198, 1, 9, 1, 1),
(199, 1, 16, 1, 1);

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
(1, 'admin', '$2y$10$.ZJCrE77FSwNkv6WOOZqr.lRXWwwyP5LUFN1NQw5cFqfkxbx6adnK', '01b778083deb9d926948f3f3c9545fbf', 'วิรัญญา ตั้งอมรศิริ', 30, 51, 'วิรัญญา ตั้งอมรศิริ', 1, 'GM', 1, '2021-11-21 17:46:01', '2021-12-07 17:55:51', -987654321, 1, 1),
(2, 'admin.sup', '$2y$10$.fhm4eyBNv.LUOwVw7mPN.etW4SJaelpbpcgIHiop3/djIq/rpr9.', '57859428a3f30eccf394c29a936813a4', 'รัศมี ระวังภัย', 75, NULL, NULL, 1, 'salesAdmin', 1, '2021-11-21 17:52:22', '2021-11-21 17:52:22', -987654321, NULL, 0),
(3, 'admin1', '$2y$10$cgsg7VJ5aBBfBkLkPgLPy.Tst0XyHu5YLtTv6AdKZ.J/6uSamXUX6', '26816cdda9bbe7dd587775e4e313c96c', 'ดารารัตน์ ใบบัว', 44, NULL, NULL, 4, 'salesAdmin', 1, '2021-11-21 18:20:09', '2021-11-27 20:30:39', -987654321, 1, 0),
(4, 'admin2', '$2y$10$zX8OBH9ItJGc91SuzHNIMuiua3i0rhz0bqKwt4TGEMvnXyAWGdz5i', '95060b7dcd51e6aaddfd50590f8234b9', 'ดรุณี ฝ่ายขันธ์', 38, 42, 'Khun SOMPORN', 4, 'sales', 1, '2021-11-21 18:20:54', '2021-12-04 10:26:22', -987654321, 1, 0),
(5, 'manager.retail', '$2y$10$pI8vj8XR0ZH4269clbDPM.HCF2uuyi6EXu9iKkiVWfVZfG4Www9KK', 'b59f19cdbf502b0a3ffae95b889c80ee', 'ศักรินทร์ ปริศวงศ์', 279, NULL, NULL, 2, 'sales', 1, '2021-11-21 18:23:17', '2021-11-22 18:01:50', -987654321, 1, 1),
(6, 'manager.overseas', '$2y$10$.8.40yOzSKTIkQ01KJ6GZeXX.ZgqKGFOmm6V9v1HbADFljDkHRxcW', 'bb3ad1a8b038593abf569f803c7c7a89', 'วาสินี ตั้งอมรศิริ', 33, NULL, NULL, 2, 'sales', 1, '2021-11-21 18:24:55', '2021-11-27 20:39:11', -987654321, 1, 0),
(7, 'smu.juthamas', '$2y$10$/5GscpqfZzSikwPpC61LjO/EhVX5nFnRW6iy1S.THJ/xBy9yvxsKe', 'c7c0f93413cb0d01e743ebc186b0e4d4', 'จุฑามาศ วงศ์รัตน์', 51, 5, 'จุฑามาศ วงศ์รัตน์', 3, 'sales', 1, '2021-11-21 18:27:37', '2021-11-27 20:40:03', -987654321, 1, 0),
(8, 'smu.piyawat', '$2y$10$sDjsyIwEI3M5YDV2jQXPbuieDGR8t/9OHXBKNOFzEvCIslVRjKOqG', '939cb7e21adfd418c31285203485ffd7', 'ปิยวัฒน์ เทวาอนุเคราะห์', 57, 11, 'ปิยวัฒน์ เทวาอนุเคราะห์', 3, 'sales', 1, '2021-11-21 18:28:25', '2021-11-27 20:40:40', -987654321, 1, 0),
(9, 'smu.apichart', '$2y$10$U/AbKix66ZiaEWlp44dgr.aHoUIvJhLZpm0lI9u2vCbPd9uHSpnCy', '1f59c43753ddfa0534d78843cd229b39', 'อภิชาติ พิบูลย์', 70, 24, 'อภิชาติ พิบูลย์', 3, 'sales', 1, '2021-11-21 18:29:01', '2021-11-27 20:40:58', -987654321, 1, 0),
(10, 'smu.athiwat', '$2y$10$gADxVsWuT2k0y0jdj5Bpn.KU/tqNSTlrEuu3i6isw.MguN1F.evji', '077a01b79a066c7647ca26a45c030187', 'อธิวัฒน์ หิรัญแสงชยานนท์', 69, 23, 'อธิวัฒน์ หิรัญแสงชยานนท์', 3, 'sales', 1, '2021-11-21 18:29:50', '2021-11-27 20:41:31', -987654321, 1, 0),
(11, 'smu.adsawin', '$2y$10$rbT0/PVNVRd3hOODMoEAX.u4nYGOWjWwTOdFUxTt6BYyrkCqiklnm', '03d74e28b3c394109a36d1e7052f72a6', 'อัศวิน พิทักษ์พลางกูร', 72, 26, 'อัศวิน พิทักษ์พลางกูร', 3, 'sales', 1, '2021-11-21 18:30:44', '2021-11-27 20:41:39', -987654321, 1, 0),
(12, 'smu.komsun', '$2y$10$TRorIy9v9SMyCJX.7WP8MeeinpamI6nJ2WgCCDXm/amS6hJ1Kn/Km', '8c3493da41f4a85431a74c866cd36ffb', 'คมสัน ต้นจันทน์', 49, 3, 'คมสัน ต้นจันทน์', 3, 'sales', 1, '2021-11-21 18:31:22', '2021-11-27 20:42:10', -987654321, 1, 0),
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
(134, 3, 11, 'CN (30 Days)'),
(135, 3, 12, 'ช่อง 2 (90 Days)'),
(136, 3, 13, 'Goverrnment (120 Days)'),
(137, 3, 14, 'T.P. Drug\'s Clients'),
(138, 3, 15, 'Overseas'),
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
(219, 26, 13, 'Goverrnment (120 Days)'),
(223, 4, 15, 'Overseas'),
(229, 1, 11, 'CN (30 Days)'),
(230, 1, 12, 'ช่อง 2 (90 Days)'),
(231, 1, 13, 'Goverrnment (120 Days)'),
(232, 1, 14, 'T.P. Drug\'s Clients'),
(233, 1, 15, 'Overseas');

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
(35, 26, 4, 'Sales'),
(40, 4, 7, 'Sales');

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
  ADD KEY `CardTeam` (`CardTeam`),
  ADD KEY `DO_Status` (`DO_Status`),
  ADD KEY `INV_Status` (`INV_Status`),
  ADD KEY `SO_Status` (`SO_Status`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`),
  ADD KEY `status` (`status`);

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
  ADD KEY `sale_person_id` (`sale_person_id`),
  ADD KEY `customer_team_id` (`customer_team_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sync_logs`
--
ALTER TABLE `sync_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=975;

--
-- AUTO_INCREMENT for table `team_approver`
--
ALTER TABLE `team_approver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `team_customer_group`
--
ALTER TABLE `team_customer_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

--
-- AUTO_INCREMENT for table `user_team`
--
ALTER TABLE `user_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
