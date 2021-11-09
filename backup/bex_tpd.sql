-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2021 at 02:55 PM
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
(2, 3, 'Jutarat', 'จุฑามาศ วงศ์รัตน์', '300000.00', 1, '2021-11-08 12:45:38', -987654321, '2021-11-08 13:09:52', -987654321),
(3, 1, 'sutouch', 'มัลลิกา อยู่เกื้อ', '500000.00', 1, '2021-11-08 13:17:33', -987654321, '2021-11-08 22:07:00', -987654321);

-- --------------------------------------------------------

--
-- Table structure for table `approve_rule`
--

CREATE TABLE `approve_rule` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `conditions` set('Less Than','Less or Equal','Greater Than','Greater or Equal') DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `order_type` set('local','oversea') NOT NULL DEFAULT 'local',
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

INSERT INTO `approve_rule` (`id`, `code`, `conditions`, `amount`, `order_type`, `is_price_list`, `status`, `add_by`, `date_add`, `update_by`, `date_upd`) VALUES
(2, 'RL-21002', 'Greater or Equal', '100000.00', 'local', 1, 1, -987654321, '2021-11-09 19:02:05', -987654321, '2021-11-09 20:50:45'),
(3, 'RL-21003', 'Greater Than', '3003.00', 'oversea', 1, 1, -987654321, '2021-11-09 20:50:19', NULL, '2021-11-09 20:50:19');

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
('35bc65f2ba62cbdfae5a141d8507aa740c6607c9', '::1', 1636277547, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363237373534373b),
('a8045db7d0270273de94268fd3bc29e986e2bab6', '::1', 1636277849, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363237373834393b),
('01f142490d5a57fe4586abf66407b87644ae1204', '::1', 1636278649, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363237383634393b),
('ba4a056b8ea772d58cb5e7341089fb1958f5edf9', '::1', 1636278324, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363237383332343b),
('61acb2c1748bd18efd232d8ba80848d220d4def7', '::1', 1636278324, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363237383332343b),
('bd39cae0d14ff6a314593f8d1ac1c43d763b537e', '::1', 1636278975, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363237383937353b),
('7a7c4d9c11a190313e131c1b0ab8107b31aab93f', '::1', 1636279284, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363237393238343b),
('8e971dacd72d599e21a8bc917e2d594947c5f0ca', '::1', 1636279740, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363237393734303b),
('6212691d573594146252b13bcc6e47edf52c23ab', '::1', 1636280859, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363238303835393b),
('ece6aa2efd1de2457d6a3640ef011cfb33fbd093', '::1', 1636281202, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363238313230323b),
('7d8d62b9226ab35f22eb2279d33f7cefebc6c73a', '::1', 1636284977, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363238343937373b),
('11abc593b80780e86ced4f85e6b8b1eaee8bdb3d', '::1', 1636289852, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363238393835323b),
('3bbc6202531cdc6cf2cec8c63004f4127b3c3929', '::1', 1636290207, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363239303230373b),
('209baf14d59d3f866128849715ffaebb6bbd6488', '::1', 1636291297, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363239313239373b),
('f870005161b0fcab685bfa6e9dfee4c737e68c6e', '::1', 1636291869, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363239313836393b),
('9edce48fb4085262df437438b15e219c41e2ab7d', '::1', 1636292241, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363239323234313b),
('c40a1c2f4e424abc76efccf7a48d2f77c7947251', '::1', 1636293146, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363239333134363b),
('ebe3b3ff189eb1388e97e95327551c771d76829c', '::1', 1636294506, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363239343530363b),
('708a99aa61c3590e428d7e3745101bf163617115', '::1', 1636295645, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363239353634353b),
('5e706b08fbe106017081507cbedb2fac355b1ad1', '::1', 1636296869, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363239363836393b),
('f3520bb3470e220755923725065559412e07d2dc', '::1', 1636297196, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363239373139363b),
('b1e7da68dc48db5e11f593b436ca3ea116ceac12', '::1', 1636297606, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363239373630363b),
('957cb69d80ef8b9e3df908c71f9fae9005629365', '::1', 1636297960, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363239373936303b),
('836a6feeb6272e0c51a5bda0ddb8e791588d0557', '::1', 1636298354, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363239383335343b),
('9e9efb6f4ab0f834de75fd775549ef4562f4fccb', '::1', 1636298662, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363239383636323b),
('6d8c5d4947e540ba4fabf5103c8dac9df59bce82', '::1', 1636298979, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363239383937393b),
('1c7324a61d429def00302bcaa6a492f62c233ccb', '::1', 1636299401, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363239393430313b),
('6c99f285b6d5a6b86fc37d4ff29ffbf14bbe1da6', '::1', 1636299723, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363239393732333b),
('83ccaf700411bd9ca01697b143783ec9b72af336', '::1', 1636300526, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363330303532363b),
('a326a20bbe4da8d5e5d968e1f577315c97d73691', '::1', 1636301251, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363330313235313b),
('0e5a0a2b9aaefe9860e149dc42b88a8fd13950bb', '::1', 1636301574, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363330313537343b),
('d1cb7e9b6aebcf1fbd1612a31374741d548beee4', '::1', 1636302174, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363330323137343b),
('d929db252c8b6cffa958937a8a7bf89200e22c58', '::1', 1636302637, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363330323633373b),
('5dbc83f21babb446ca8ea3cf44cda52fee3c597a', '::1', 1636306487, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363330363438373b),
('bce3ee76148aabc7778c88d0d092cb4bba50dfbb', '::1', 1636306899, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363330363839393b),
('235bf44c2acfd6f26740f39f6cfa64ad2f1b1707', '::1', 1636306899, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363330363839393b),
('1264a022f44b9fcf53ff4edc8a0fa1c06664b422', '::1', 1636343342, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363334333334323b),
('c2280ff4ca9fa77c82925e716012e799465ea96e', '::1', 1636344195, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363334343139353b),
('cd4a31a4119369af59281092bb907a8b0680e5c2', '::1', 1636345782, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363334353738323b),
('431c34c8ef58a6d5b8b5ea34673f0a22fa48b4f3', '::1', 1636347671, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363334373637313b),
('8d8b5a85d4148e87f9b31c2f69edadd499d4f995', '::1', 1636349084, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363334393038343b),
('e524b3bb55ddbafb6ee7781985af6d5f274926ae', '::1', 1636350160, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363335303136303b),
('75d8a113a0a07f1f9829e4c5e6eb71d26a26f5c2', '::1', 1636350801, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363335303830313b),
('cecfe336ef7c949de0a1f45983465475943eb834', '::1', 1636351560, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363335313536303b),
('c257b4ce86b49d1f552b63af7ae445f97047c2a5', '::1', 1636352016, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363335323031363b),
('54fd24a1d0115aae431c0d3b50268897718c995c', '::1', 1636352288, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363335323031363b),
('8bf608b1c11459d14a603080bd0b009b5f90a98c', '::1', 1636368613, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363336383631323b),
('70b5cbfdb2e1ba6be248bdb11d59e8261da322c7', '::1', 1636383732, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363338333733323b),
('5366b6ba31a48b550d5a5333025e320028bfe76d', '::1', 1636384037, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363338343033373b),
('73bf729b90fd5880b4fc76107144ec60bfa0c6df', '::1', 1636384393, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363338343339333b),
('8a196e6ba030c83e2f52305aa9a982a0747ffe1f', '::1', 1636384707, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363338343730373b),
('74bcbda8dee05b1bc87d2b47a3b232460b427af6', '::1', 1636386640, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363338363634303b),
('ecb4a795dade3aec5c02c1bf291f199ad767a92f', '::1', 1636387008, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363338373030383b),
('3874f3568db3f6b7af2b0f3345e82d5173ecd8f6', '::1', 1636387239, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363338373030383b),
('df51c16ae8669d3f5fe9c1805232e46cf97ac51a', '::1', 1636435401, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363433353430313b),
('8b8164a0a6db8b3f6554b4a6151e75e21b0d3b1f', '::1', 1636435717, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363433353731373b),
('7757b16c0f6f10d32bb8f3e035cdc3baf62631f7', '::1', 1636436888, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363433363838383b),
('68957ba95473e8c1c896a78c52ac4712f4169b2c', '::1', 1636437501, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363433373530313b),
('7eeb4947f01a8c298fc59675806d2601382d8ec4', '::1', 1636439198, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363433393139383b),
('dafb06c80d384a42432298db8905ffe6d1d10fbc', '::1', 1636439974, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363433393937343b),
('49c119b1356304a34a6ce80c53a8dac7b7c6465e', '::1', 1636441235, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363434313233353b),
('d99b9a52915204d038e7956b74a8f2a50703aa63', '::1', 1636442087, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363434323038373b),
('fe929bc178af34cc98240c98d097eed52d177e68', '::1', 1636442409, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363434323430393b),
('7384d2a60659ec62a8edded4b80886adc4198fd0', '::1', 1636444072, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363434343037323b),
('8d9781df448aada979902e995330907f8477f056', '::1', 1636444685, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363434343638353b),
('654e92df38fd38708c1c58dbc3c4ed25fb56fe9a', '::1', 1636445055, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363434353035353b),
('5b17de8f14a8dff2af074f1dcb0ecec9eefc650c', '::1', 1636445104, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363434353035353b),
('dcf612bb44348acc39ae355edc62b00f3800c120', '::1', 1636455604, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363435353630343b),
('f3b351bbe8fad8f11c3d92ce94b92772b0180c2e', '::1', 1636456005, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363435363030353b),
('ca43ebfb14cc17d4e4466820ab1c5d0f8f549db5', '::1', 1636456331, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363435363333313b),
('efc5f3568a8c07874ff7cfb34b9c4082df3ebd6e', '::1', 1636457574, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363435373537343b),
('68b31a3faac5999e334b808518c8dc9afc63633d', '::1', 1636457894, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363435373839343b),
('8653e1a504fff41d4e95e07ff6aa12165d80c2bb', '::1', 1636458262, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363435383236323b),
('a707afa2cd37b52a4b9f0c5319e2ede2631136ed', '::1', 1636458595, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363435383539353b),
('950cd8f95b54d03b5ca522c06a3c7de5185c7e95', '::1', 1636459052, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363435393035323b),
('e09e3c3d724e84a9d9a9662c206a61ce1d21f41a', '::1', 1636459441, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363435393434313b),
('0b39e8fd9531e9f8bd13b2d0cbe831665d54ed5f', '::1', 1636460053, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363436303035333b),
('18e40e1f66ebd8790fee1e85a51addd13f48598e', '::1', 1636460356, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363436303335363b),
('d71d5174033d8ad3edd5f069cfc0a6860c0c74f7', '::1', 1636461666, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363436313636363b),
('2248c81961ec741776809bf771408c13970fa349', '::1', 1636462165, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363436323136353b),
('ff877fe43d221b74a4addbcdfe24d8514dc46e24', '::1', 1636462934, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363436323933343b),
('e59bff04bc193f36e2c2f92c2c8f9d625dc515ab', '::1', 1636463235, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363436333233353b),
('74a2c1be03c4d5a89eea76495b15a6f27faa8da3', '::1', 1636464088, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363436343038383b),
('b75932462d7cafb67de8734a633210de4c1d5717', '::1', 1636464623, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363436343632333b),
('150504caec4904b40453f36bf053f0e6d5e65e3c', '::1', 1636465102, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363436353130323b),
('765d5c06a4dcf262a8ea627c75261898a805db8f', '::1', 1636465412, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363436353431323b),
('454489e26903a8b7a92355bd16c31843860e6ebb', '::1', 1636465726, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363436353732363b),
('7a7d9c2073edc26b7c6a39a8c2c1a088ed1ad034', '::1', 1636466028, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363436363032383b),
('6a34fe1e1f43fd60426f6595506f830feae7f248', '::1', 1636466114, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633363436363032383b);

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
('PREFIX_ACTIVITY', NULL, 'AC', 'Document', '', '2020-12-23 09:56:24'),
('PREFIX_BP', NULL, 'BP', 'Document', '', '2020-12-23 09:56:24'),
('PREFIX_QUOTATION', NULL, 'SQ', 'Document', '', '2020-12-23 16:56:24'),
('PURCHASE_VAT_CODE', 'รหัสภาษีซื้อ(ต้องตรงกับ SAP)', 'P07', 'SAP', '', '2019-09-03 07:48:53'),
('PURCHASE_VAT_RATE', 'ภาษีซื้อ', '7.00', 'SAP', '', '2019-09-03 07:53:14'),
('ROW_PER_PAGE', 'จำนวนรายการต่อหน้า', '9', 'PRINT', '', '2021-08-03 08:49:52'),
('RUN_DIGIT_ACTIVITY', NULL, '4', 'Document', '', '2020-12-11 09:44:22'),
('RUN_DIGIT_BP', NULL, '4', 'Document', '', '2020-12-11 09:44:22'),
('RUN_DIGIT_QUOTATION', NULL, '4', 'Document', '', '2020-12-11 16:44:22'),
('SALE_VAT_CODE', 'รหัสภาษีขาย(ต้องตรงกับ SAP)', 'S07', 'SAP', '', '2019-08-31 11:56:33'),
('SALE_VAT_RATE', 'ภาษีขาย', '7.00', 'SAP', '', '2020-12-20 14:10:03'),
('SQ_MANUAL_EXPORT', 'ส่งเข้า temp เอง', '1', 'Document', '', '2021-09-07 11:31:28'),
('TEXT_PER_ROW', 'จำนวนตัวอักษรต่อบรรทัด', '39.5', 'PRINT', '', '2021-08-10 06:02:35'),
('USE_STRONG_PWD', 'บังคับใช้การตั้งรหัสผ่านแบบเข้มงวด', '0', NULL, '', '2021-11-07 16:31:16');

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
('ORDERPRO', 'Order Promotion', 'order_promotion', 'ORDER', NULL, 1, 2, 1),
('ORDERS', 'Order', 'orders', 'ORDER', NULL, 1, 1, 1),
('PERMISSION', 'Permission', NULL, 'SPM', NULL, 1, 3, 1),
('PROMOTION', 'Promotions', 'promotion', 'ADMIN', NULL, 1, 6, 1),
('PWDRESET', 'Reset User Password', NULL, 'SPM', NULL, 1, 1, 1),
('USER', 'Users', 'users', 'ADMIN', NULL, 1, 1, 1),
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
(1, 'ORDERS', 3, 1, 1, 1, 0),
(2, 'ORDERPRO', 3, 1, 1, 1, 0),
(3, 'USER', 3, 0, 0, 0, 0),
(4, 'USERGROUP', 3, 0, 0, 0, 0),
(5, 'APPROVER', 3, 0, 0, 0, 0),
(6, 'PROMOTION', 3, 0, 0, 0, 0),
(7, 'PWDRESET', 3, 0, 0, 0, 0),
(8, 'PERMISSION', 3, 0, 0, 0, 0),
(9, 'ORDERS', 2, 1, 1, 1, 1),
(10, 'ORDERPRO', 2, 1, 1, 1, 1),
(11, 'USER', 2, 1, 0, 0, 0),
(12, 'USERGROUP', 2, 1, 0, 0, 0),
(13, 'APPROVER', 2, 1, 0, 0, 0),
(14, 'PROMOTION', 2, 1, 0, 0, 0),
(15, 'PWDRESET', 2, 0, 0, 0, 0),
(16, 'PERMISSION', 2, 0, 0, 0, 0),
(17, 'ORDERS', 1, 1, 1, 1, 1),
(18, 'ORDERPRO', 1, 1, 1, 1, 1),
(19, 'USER', 1, 1, 1, 1, 1),
(20, 'USERGROUP', 1, 1, 1, 1, 1),
(21, 'APPROVER', 1, 1, 1, 1, 1),
(22, 'PROMOTION', 1, 1, 1, 1, 1),
(23, 'PWDRESET', 1, 1, 1, 1, 1),
(24, 'PERMISSION', 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rule_approver`
--

CREATE TABLE `rule_approver` (
  `id` int(11) NOT NULL,
  `rule_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rule_approver`
--

INSERT INTO `rule_approver` (`id`, `rule_id`, `user_id`, `date_add`) VALUES
(15, 3, 1, '2021-11-09 20:50:19'),
(18, 2, 1, '2021-11-09 20:50:45'),
(19, 2, 3, '2021-11-09 20:50:45');

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
  `ugroup_id` int(11) NOT NULL,
  `user_role` varchar(10) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = active, 0 = disactive	',
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_upd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `bi_link` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `uname`, `pwd`, `uid`, `emp_name`, `emp_id`, `sale_id`, `ugroup_id`, `user_role`, `status`, `date_add`, `date_upd`, `bi_link`) VALUES
(-987654321, 'superadmin', '$2y$10$vZKJB2k7bAPWNcHLqizIne1b3NsjV2Vm6cwEnZ4BHMWgTauKLS0W6', '1f0b6f95139c887a30c726d7dabbed3a', 'SuperAdmin', NULL, NULL, -987654321, 'AGM', 1, '2021-11-04 10:26:14', '2021-11-09 13:01:01', 1),
(1, 'sutouch', '$2y$10$IFrFIC8AtkIOi8Fo72V3W.Mi/bolpkIR5YfTqdaZZF3Z4sH.BQEkW', 'eef48b86c4fc8586682f3ccda22138d1', 'มัลลิกา อยู่เกื้อ', 29, 5, 1, 'AGM', 1, '2021-11-06 23:18:08', '2021-11-09 13:01:11', 1),
(2, 'Apichat', '$2y$10$nU6GcJUfjsVdb3mdPKIeoeFt4Xo4NNnJ7xBbR7VuBMOhUkakwsy66', 'a16aa78bb2f3b533a07d44c64537463f', 'อภิชาติ พิบูลย์', 70, 24, 3, 'SRD', 1, '2021-11-08 12:29:35', '2021-11-08 12:29:35', 0),
(3, 'Jutarat', '$2y$10$LpWQVzmmMuK0511497nHp.SQDUWvNg1FHN2WtfBzuBDy.tIHMlntC', '6a8a3e440641d7843436393b7b251c2a', 'จุฑามาศ วงศ์รัตน์', 51, 5, 2, 'SMR', 1, '2021-11-08 12:44:29', '2021-11-08 12:44:29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_customer_group`
--

CREATE TABLE `user_customer_group` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_customer_group`
--

INSERT INTO `user_customer_group` (`id`, `user_id`, `group_id`) VALUES
(11, 1, 5),
(12, 1, 6),
(13, 2, 5),
(14, 2, 6),
(15, 2, 7),
(16, 2, 8);

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
(3, 'User', '2021-11-04 21:50:32', 'superadmin', '2021-11-06 13:02:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `code` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `position` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`code`, `name`, `position`) VALUES
('AGM', 'Administrator(GM)', 6),
('SAT', 'Sales Admin Team', 2),
('SMO', 'Sales Manager - Overseas', 5),
('SMR', 'Sales Manager - Retail Bussiness', 3),
('SRD', 'Sales Representative', 1),
('SRO', 'Sales Representative - Overseas', 4);

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
  ADD KEY `order_type` (`order_type`),
  ADD KEY `is_price_list` (`is_price_list`),
  ADD KEY `status` (`status`);

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
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menu` (`menu`,`ugroup_id`);

--
-- Indexes for table `rule_approver`
--
ALTER TABLE `rule_approver`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rule_id_2` (`rule_id`,`user_id`),
  ADD KEY `rule_id` (`rule_id`),
  ADD KEY `user_id` (`user_id`);

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
  ADD KEY `user_role` (`user_role`),
  ADD KEY `emp_name` (`emp_name`);

--
-- Indexes for table `user_customer_group`
--
ALTER TABLE `user_customer_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id_2` (`user_id`,`group_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`code`),
  ADD KEY `position` (`position`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approver`
--
ALTER TABLE `approver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `approve_rule`
--
ALTER TABLE `approve_rule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `rule_approver`
--
ALTER TABLE `rule_approver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_customer_group`
--
ALTER TABLE `user_customer_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
