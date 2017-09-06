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
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `type`, `thc`, `cbd`, `description`, `image`) VALUES
(4, 'Sativa', 'Recreativa', '20', '70', 'Recreativa, es un híbrido con sativa dominante originario de California, ha alcanzado la consideración de leyenda entre las razas de la Costa Oeste. Resultado del cruce entre una Blueberry indica con la sativa Haze.\nCon un dulce aroma a bayas heredado de su ascendente Blueberry, Recreativa ofrece un alivio rápido con efectos sedantes destacables. Esto convierte a Blue Dream en un cannabis medicinal terapeutico, popular entre los pacientes con tratamientos para aliviar el dolor, depresión, náuseas y otras dolencias que requieren una raza de elevado THC.', 'sativa24492f45a80c4f6bff11fb85b946a0d0.jpg'),
(5, 'Indica', 'Medicinal', '29', '72', 'Recreativa, es un híbrido con sativa dominante originario de California, ha alcanzado la consideración de leyenda entre las razas de la Costa Oeste. Resultado del cruce entre una Blueberry indica con la sativa Haze.\nCon un dulce aroma a bayas heredado de su ascendente Blueberry, Recreativa ofrece un alivio rápido con efectos sedantes destacables. Esto convierte a Blue Dream en un cannabis medicinal terapeutico, popular entre los pacientes con tratamientos para aliviar el dolor, depresión, náuseas y otras dolencias que requieren una raza de elevado THC.', 'sativa4d62564b7f98440eb135c5b85a6c4d10.jpg');
-- --------------------------------------------------------

--
-- Table structure for table `sections`
--


CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `useful_yes` int(11) NOT NULL,
  `useful_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `title`, `content`, `useful_yes`, `useful_no`) VALUES
(15, 'Section 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut id ex eros. Vivamus lorem diam, pellentesque ut varius sit amet, mattis ut lorem. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque neque lectus, ultrices et mauris in, consectetur hendrerit tellus. Suspendisse pellentesque egestas mollis. Curabitur mollis aliquam scelerisque. Sed quis mauris sollicitudin, efficitur leo ut, laoreet diam. Donec vulputate congue libero eget tempus. Sed tincidunt diam non libero luctus lobortis. Cras tincidunt semper dui quis lacinia. Nulla semper purus in purus pulvinar, eget lobortis ligula fringilla. Nullam accumsan a felis ac hendrerit. Maecenas non arcu diam. Aliquam erat volutpat.\r\n\r\nCurabitur tincidunt consequat est, at tristique purus fermentum a. In hac habitasse platea dictumst. Proin eget mi fringilla, tristique ex sed, vulputate ipsum. Praesent risus nibh, placerat eget dapibus viverra, condimentum sit amet nibh. Vestibulum scelerisque magna nec lectus venenatis feugiat. Phasellus bibendum blandit felis, elementum rhoncus sem. Donec molestie consectetur mauris, nec dictum massa. Phasellus lacinia dui et felis rutrum suscipit. Aenean sodales tellus non libero fringilla rhoncus. Suspendisse in lorem pretium, suscipit nulla et, dictum tellus.', 3, 7),
(16, 'Section 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut id ex eros. Vivamus lorem diam, pellentesque ut varius sit amet, mattis ut lorem. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque neque lectus, ultrices et mauris in, consectetur hendrerit tellus. Suspendisse pellentesque egestas mollis. Curabitur mollis aliquam scelerisque. Sed quis mauris sollicitudin, efficitur leo ut, laoreet diam. Donec vulputate congue libero eget tempus. Sed tincidunt diam non libero luctus lobortis. Cras tincidunt semper dui quis lacinia. Nulla semper purus in purus pulvinar, eget lobortis ligula fringilla. Nullam accumsan a felis ac hendrerit. Maecenas non arcu diam. Aliquam erat volutpat.\r\n\r\nCurabitur tincidunt consequat est, at tristique purus fermentum a. In hac habitasse platea dictumst. Proin eget mi fringilla, tristique ex sed, vulputate ipsum. Praesent risus nibh, placerat eget dapibus viverra, condimentum sit amet nibh. Vestibulum scelerisque magna nec lectus venenatis feugiat. Phasellus bibendum blandit felis, elementum rhoncus sem. Donec molestie consectetur mauris, nec dictum massa. Phasellus lacinia dui et felis rutrum suscipit. Aenean sodales tellus non libero fringilla rhoncus. Suspendisse in lorem pretium, suscipit nulla et, dictum tellus.', 1, 3);

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
