-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 30, 2017 at 10:50 AM
-- Server version: 5.6.37
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
-- Database: `mariamia_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `access_token` varchar(40) NOT NULL,
  `client_id` varchar(80) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`access_token`, `client_id`, `user_id`, `expires`, `scope`) VALUES
('023264cc12cdf16ce4f5bc011facd2fd7157b2d7', 'web', 'a', '2017-08-24 21:38:59', NULL),
('09f9b3f9c49a4e8bed5a4c55258f6627e0be5413', 'web', 'a', '2017-08-24 21:50:14', NULL),
('161e2cb5b7cd9143fbe0eb9ee905444776988fa4', 'web', 'a', '2017-08-25 16:50:45', NULL),
('1af61aa0dddb7e7a88356320b715592d27e4ff73', 'web', 'a', '2017-08-25 05:53:47', NULL),
('1c7743c6b9936c36bf4e8d1a3bd70294e9d0d58f', 'web', 'a', '2017-08-24 22:16:15', NULL),
('1da52af69e5c312845412b68b703ec1b74eefac6', 'web', 'a', '2017-08-23 02:14:26', NULL),
('1dd6aba020760110b07d31a84ebcc9ea3311f753', 'web', 'test', '2017-08-23 02:22:01', NULL),
('274b53adbbe00d446e7fa728dcba59413e60b3ca', 'web', 'a', '2017-08-24 21:52:53', NULL),
('2b3b91b652031abb2380f7de6808e213a79c0902', 'web', 'a', '2017-08-24 09:12:10', NULL),
('3075aa5e580bef88d155d34b1c3503e814597a05', 'web', 'a', '2017-08-24 22:29:18', NULL),
('3181a398be118191fac1388016ff96ac841f3bfa', 'web', 'a', '2017-08-24 21:46:13', NULL),
('33154342bed802f89eeca186dfff224b69c1c818', 'web', 'a', '2017-08-24 21:48:08', NULL),
('37e72fc715cae33670c047d0392f10e889a2a954', 'web', 'test', '2017-08-23 02:23:07', NULL),
('38f5d2ff7efec6ed70464dac2dc9a56cc036aadf', 'web', 'a', '2017-08-24 21:52:52', NULL),
('3ec645f60d6a967f9a72d102e7b55b4039c45351', 'web', 'a', '2017-08-23 02:34:44', NULL),
('43d2183d9e33b825184f3c0cabdd7997979196be', 'web', 'a', '2017-08-23 02:30:42', NULL),
('4668dea06ddcdd5ff05c44f2d1651d3a68246925', 'web', 'a', '2017-08-26 17:26:33', NULL),
('4a65f001f7365f49f02c837cffb568675ef47a1f', 'web', 'a', '2017-08-25 16:50:44', NULL),
('4cc8422b69b779326721200eba77a72ebb854e9f', 'web', 'a', '2017-08-24 21:52:44', NULL),
('5c9751bf3c1810db6b4af987828904fba98e5574', 'web', 'a', '2017-08-25 00:05:09', NULL),
('65838ed38476201ddcc112036105c6aeecbc0df5', 'web', 'a', '2017-08-24 22:07:56', NULL),
('666e42b439bd0167321b3025c7f4a7ee0f72b5e8', 'web', 'a', '2017-08-24 21:52:43', NULL),
('703f99efc0b482944c74c05216989c5e7fa7d8cd', 'web', 'a', '2017-08-28 20:25:10', NULL),
('71fe5c920d998f577eacd444b6e094a96576c85a', 'web', 'a', '2017-08-25 06:50:45', NULL),
('72ffe047f3de4968549e30e5837edd55887922ab', 'web', 'a', '2017-08-25 01:07:29', NULL),
('7658a7cf023167d3a256569392466e5cfa268799', 'web', 'a', '2017-08-24 23:57:41', NULL),
('76d753715aa011ec9d10010dd782d07eba8a9cc6', 'web', 'a', '2017-08-24 22:17:35', NULL),
('7d141f6a3b2bb69b57c84aea6bdc60d98393b8aa', 'web', 'a', '2017-08-24 21:49:55', NULL),
('a14fe53d213b3c7cc52c273d1c6bc1ee306fb497', 'web', 'a', '2017-08-24 22:20:25', NULL),
('a42c2d3f36569305bc7f19fe2d5174c6bab2e3c6', 'web', 'a', '2017-08-24 22:15:49', NULL),
('a7b68f6a75d7dac7e3eab4d4dcab7035769faa30', 'web', 'a', '2017-08-24 21:49:51', NULL),
('a9f2f94137158e0d302ce4946838a0ab64a045d1', 'web', 'a', '2017-08-24 22:23:05', NULL),
('b1b6e5885fdad66166832d47d8a7bfc4a9bbff3f', 'web', 'a', '2017-08-24 22:35:21', NULL),
('b98d135344fe010fe02d495fc64fda68ae6f7f51', 'web', 'a', '2017-08-24 22:07:49', NULL),
('befb36132d356541cea3328274d0b5178a86b876', 'web', 'a', '2017-08-25 01:08:42', NULL),
('c3835d4db70acedf5869d3c33c4047ae1f860f54', 'web', 'a', '2017-08-23 02:26:02', NULL),
('c80dd5d6893b0d0ac2940fb5393b34562d5afae2', 'web', 'a', '2017-08-24 22:33:18', NULL),
('ce87e3024a6a3766b96b43ffb5aaf827836bd9b1', 'web', 'a', '2017-08-24 21:52:45', NULL),
('d9cbe0efb238e043515fc0b0a3bf7dc11ae995e9', 'web', 'a', '2017-08-24 22:05:00', NULL),
('e567b79a51fc0e91ee81ba943375c86c0c05c530', 'web', 'a', '2017-08-28 20:25:08', NULL),
('e5d93d456e0492f085b7b7430446c132519a1bc0', 'web', 'a', '2017-08-25 00:11:28', NULL),
('e6ca515358ac5d0cbbcec05de8854f5e47ebb924', 'web', 'a', '2017-08-24 21:40:37', NULL),
('f627f809091b7325bc0cc4c8bf8895654df9dc7a', 'web', 'a', '2017-08-23 02:28:44', NULL),
('fe2829dcc1cd6a930455931bc6a6f978005df487', 'web', 'a', '2017-08-24 21:40:39', NULL),
('ff58b29d76bf8661c134f4de22fa04545070d2cf', 'web', 'a', '2017-08-23 02:20:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_authorization_codes`
--

CREATE TABLE `oauth_authorization_codes` (
  `authorization_code` varchar(40) NOT NULL,
  `client_id` varchar(80) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `redirect_uri` varchar(2000) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(2000) DEFAULT NULL,
  `id_token` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `client_id` varchar(80) NOT NULL,
  `client_secret` varchar(80) DEFAULT NULL,
  `redirect_uri` varchar(2000) DEFAULT NULL,
  `grant_types` varchar(80) DEFAULT NULL,
  `scope` varchar(2000) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`client_id`, `client_secret`, `redirect_uri`, `grant_types`, `scope`, `user_id`) VALUES
('web', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_jwt`
--

CREATE TABLE `oauth_jwt` (
  `client_id` varchar(80) NOT NULL,
  `subject` varchar(80) DEFAULT NULL,
  `public_key` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `refresh_token` varchar(40) NOT NULL,
  `client_id` varchar(80) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oauth_refresh_tokens`
--

INSERT INTO `oauth_refresh_tokens` (`refresh_token`, `client_id`, `user_id`, `expires`, `scope`) VALUES
('00547260da1742051c4823da98a2b9fcd427a48f', 'web', 'test', '2017-09-05 22:23:07', NULL),
('02382e6b78fb9f0e787fc3c4eecf06251cd23118', 'web', 'a', '2017-09-08 12:50:44', NULL),
('02a1f64df2f978513f481e022ac6e12f3b4028b9', 'web', 'a', '2017-09-07 18:23:05', NULL),
('0d66c31d67655919b1c33b13158290f45016be31', 'web', 'a', '2017-09-07 19:57:41', NULL),
('0ebd1cf87143df932e811bd32be0a49e37f435d3', 'web', 'a', '2017-09-09 13:26:33', NULL),
('14ebd40dedc294ff8672ca169d95e50ffa486f95', 'web', 'a', '2017-09-07 18:07:56', NULL),
('1ace6a1e73bbc282dcd1be6aa1afac03053b3dcc', 'web', 'a', '2017-09-05 22:28:44', NULL),
('1f3eb264a04b5b82f09b1f8cbf3a40ab60fb090a', 'web', 'a', '2017-09-05 22:30:42', NULL),
('24b30bb84e106e83b86d253d9d928c351071b4f2', 'web', 'a', '2017-09-07 17:52:53', NULL),
('34b2282c382076fd11581ec175ee4b2818689a37', 'web', 'a', '2017-09-07 17:40:37', NULL),
('37cfd18ce261e0686f15c9bd66bb1f37916affdc', 'web', 'a', '2017-09-08 02:50:45', NULL),
('3fc6b4fd9b33240cb1e6ece26ec7c460871321e8', 'web', 'a', '2017-09-07 20:05:09', NULL),
('4d8674408057a3875515c1518fa327523e21c543', 'web', 'a', '2017-09-07 18:20:26', NULL),
('4fe3b2b2ba63540434926fe45697a75a1810b43c', 'web', 'a', '2017-09-07 20:11:28', NULL),
('5532874408379ebffa0aaf96e01fb348a3bb49d6', 'web', 'a', '2017-09-07 17:48:08', NULL),
('5d5705c0607280e5d669fc3427f2838759a178cb', 'web', 'a', '2017-09-05 22:14:26', NULL),
('7818f3a2aa65e304d0c7fc1f9a9d60bef7c027c6', 'web', 'a', '2017-09-07 17:52:52', NULL),
('782620e40260f72d1be80102e48ce31de51c10ef', 'web', 'a', '2017-09-07 17:52:44', NULL),
('7b0eb3dc40f1ea36b2f5dbc77bd477e2114be0c2', 'web', 'a', '2017-09-05 22:34:44', NULL),
('8289e93f11a63ca74539af32e352986c1f303af2', 'web', 'a', '2017-09-07 17:38:59', NULL),
('881022d795741f311ec9d97c5010610ba6d37fd7', 'web', 'a', '2017-09-07 18:17:35', NULL),
('8862b905aca59609446829a509206ae5f543eb86', 'web', 'a', '2017-09-07 21:08:42', NULL),
('8a4e470c8b623b03e1004dfd1e2d2941c0b07566', 'web', 'a', '2017-09-07 17:52:45', NULL),
('8fe2038a21e0b125663fd67eeaf11b2e9f441652', 'web', 'a', '2017-09-08 12:50:45', NULL),
('9c644d34bfee21ffa07a3c506a47a03844df1a4b', 'web', 'a', '2017-09-07 18:07:49', NULL),
('a0cfee7626331202e34f618cbe3b119261ed1b87', 'web', 'a', '2017-09-07 21:07:29', NULL),
('a5112c0ded1a84b3e48958370d2b3e1870341ae8', 'web', 'farmashop-100', '2017-09-04 20:00:37', NULL),
('a878b62879670c2156d3051c0d08cd1ae2d471bd', 'web', 'a', '2017-09-07 20:12:10', NULL),
('ac7ca2fde84ffdc578b6769dccef1493b681f025', 'web', 'a', '2017-09-08 01:53:47', NULL),
('b133cfc4b81677910dcf5547d6c6a902a5056cd4', 'web', 'a', '2017-09-07 17:49:55', NULL),
('ba949132cd2cf6871aa082b245d10ae9f659bbbb', 'web', 'a', '2017-09-07 17:50:14', NULL),
('bd6b6fe4ef9f0dd2ba757fb6d17da56d296e78d3', 'web', 'test', '2017-09-05 22:22:01', NULL),
('bde0433a9030c00e4856a906f2a6f95ac02f046a', 'web', 'a', '2017-09-07 18:15:50', NULL),
('c37a3949b3a59bb903607974e6192e5037cbbc4c', 'web', 'a', '2017-09-05 22:20:50', NULL),
('c52345e8b200a503fc1802db75ba307364f753be', 'web', 'a', '2017-09-07 17:46:13', NULL),
('c689d77cc4bd3a356387a58fb2d3c4d10d3c84e3', 'web', 'a', '2017-09-07 17:52:43', NULL),
('d8e9eb298632542b5284e0a111d007030dea5304', 'web', 'a', '2017-09-07 17:40:39', NULL),
('dcc4d1df8054a95b34c74c1a5b9765f60d535df2', 'web', 'a', '2017-09-07 17:49:51', NULL),
('deec269082d493c8830755ccef5dfb5e07176eb2', 'web', 'a', '2017-09-11 16:25:08', NULL),
('e569077c92313d7a3d358ac1ebdcd2c5832a13c9', 'web', 'a', '2017-09-07 18:33:18', NULL),
('e68d1793a8ccf3862894d89974d348eb4ce4907c', 'web', 'a', '2017-09-07 18:05:00', NULL),
('e93ffe9045e2ef12f83c2eee760c25fd946e45e3', 'web', 'a', '2017-09-11 16:25:10', NULL),
('ea759beddcc76a976177014f166a8aa8adbd024e', 'web', 'a', '2017-09-07 18:29:18', NULL),
('f62c204f36e09a39da117313be9e2d1d2e497cc5', 'web', 'a', '2017-09-05 22:26:02', NULL),
('fd7f01e8fda0a676f749bf91c8f9c17211108c52', 'web', 'a', '2017-09-07 18:35:21', NULL),
('ffee68b3fc86fe894241a75b8a25255974c761c9', 'web', 'a', '2017-09-07 18:16:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_scopes`
--

CREATE TABLE `oauth_scopes` (
  `type` varchar(255) NOT NULL DEFAULT 'supported',
  `scope` varchar(2000) DEFAULT NULL,
  `client_id` varchar(80) DEFAULT NULL,
  `is_default` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_users`
--

CREATE TABLE `oauth_users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(2000) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `thc` varchar(255) NOT NULL,
  `cbd` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `useful_yes` int(11) NOT NULL,
  `useful_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `stock` tinyint(4) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `name`, `address`, `latitude`, `longitude`, `stock`, `username`, `password`) VALUES
(9, 'Saga', 'Manuel Oribe 476', '-30.404487', '-56.465092', 0, 'agustin.tabarez@solcre.com', '$2a$06$XIbHP.Nb1MuDrFXjgB4dyObdN24AtEycrfE8eKAdwwdExx5uH9lzW'),
(10, 'Miguel', 'Treinta y Tres Orientales 556', '-32.324229', '-58.088147', 0, 'agustin.tabarez1@solcre.com', '$2a$10$q0l38hMvFSzcDDGtBGk3nuOybkfEtqeQbr1KTlcT4ukDkuI22dQP6'),
(11, 'Carmelo', 'Zorrilla de San Martin 374', '-33.997587', '-58.28595', 1, 'agustin.tabarez2@solcre.com', '$2a$10$Dc2il5sYaisFl7mUdIlKpeEakSgW4vljG4tt2NGoRAX4wSjvtmP46'),
(12, 'Nueva Brun', 'Presidente Berro 530', '-33.518735', '-56.897503', 0, 'agustin.tabarez3@solcre.com', '$2a$10$d3LUGzV7BKjusxSpBfArnedtNIB9L5AmJL0IdoZ8DpofchhfwfLpu'),
(13, 'Gortari', 'Domingo Perez 501', '-34.376826', '-55.238303', 1, 'agustin.tabarez4@solcre.com', '$2a$10$XwfuG5IYFApkBGeo35mVsupM2mq.pLGB0OhSy.gMoDLx6H12umCYS'),
(14, 'La Cabina', 'Ruta 10 Esquina Los Magnolitas', '-34.8129379', '-55.3327932', 0, 'agustin.tabarez5@solcre.com', '$2a$10$00LQYSPPZERWh2BDEN5JC.edjp.69bdUjnmwY9EuDRSof/7BXr.fq'),
(15, 'Antartida', 'Colonia 1475 bis', '-34.9041371', '-56.1868042', 0, 'agustin.tabarez6@solcre.com', '$2a$10$1tcE4lcdOsoHpSqWefNVZuKqtyf76MtZO6i9xKrSFvIUAgXnQrfCK'),
(16, 'Caceres', 'Bulevar España 2941', '-34.9148131', '-56.1508605', 0, 'agustin.tabarez7@solcre.com', '$2a$10$BLJ5Wabf1sQgBYJ8kYPn4uore7Mv9AhlUpXJKyh3UbbkszzeLZxQa'),
(17, 'Pitagoras', 'Alberto Zum Felde 2057', '-34.8796746', '-56.1003401', 0, 'agustin.tabarez8@solcre.com', '$2a$10$nSHRQ9soYEWQw5lQT8OFj.FGDMX0UyeaTQVylnvUTYIULu25qgfoS'),
(18, 'Tapie', '25 de Mayo 315', '-34.9070535', '-56.2094158', 0, 'agustin.tabarez9@solcre.com', '$2a$10$ZgLNlMt8vMDkOhS3Yy2wwOVDRUJ/X0cfCVX8ikE/8wEILGXFx0g86'),
(19, 'Medicci |||', 'Avenida España 1549', '-34.9080509', '-56.1724353', 0, 'agustin.tabarez10@solcre.com', '$2a$10$dZRyks2VFXcQogQlymoNiux/stI/CgRn7bl8amTnYrkpcBiexnRca'),
(20, 'Termal Guaviyu', 'Ruta 3 KM. 431', '-31.8404461', '-57.8911204', 0, 'agustin.tabarez11@solcre.com', '$2a$10$KGn.JmPvoqTEPcNqE9dE4.sol7VvkAnJT7oDMLXCfgDyimhih/Bbu'),
(21, 'Albisu', 'Uruguay 554', '-31.3872926', '-57.9698998', 0, 'agustin.tabarez12@solcre.com', '$2a$10$UgG9vab1Gv2K12i9sAiXYeIaUYfZhpZ2EhbbCVCjADCBPttg/mmGy'),
(22, 'Bidegain', '25 de agosto 980', '-34.6340836', '-56.6211472', 0, 'agustin.tabarez13@solcre.com', '$2a$10$b9fOt71a5J38nIAVHDksBOIHX8ewc7HJn0rIybw1WXhd4R6yiJ55G'),
(23, 'Bengochea', 'Leandro Gomez 521', '-32.6148335', '-55.8359316', 0, 'agustin.tabarez14@solcre.com', '$2a$10$x.DPsA9N2FvudeTt61J90ebzw5RCf8iDk8T09wLu.MnHCu.tcPawG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`access_token`);

--
-- Indexes for table `oauth_authorization_codes`
--
ALTER TABLE `oauth_authorization_codes`
  ADD PRIMARY KEY (`authorization_code`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `oauth_jwt`
--
ALTER TABLE `oauth_jwt`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`refresh_token`);

--
-- Indexes for table `oauth_users`
--
ALTER TABLE `oauth_users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
