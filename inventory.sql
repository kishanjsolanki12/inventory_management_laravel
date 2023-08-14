-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2023 at 01:07 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `area_management`
--

CREATE TABLE `area_management` (
  `id` int(11) UNSIGNED NOT NULL,
  `state_id` int(11) UNSIGNED DEFAULT NULL COMMENT 'from state_master table id',
  `city_id` int(11) UNSIGNED DEFAULT NULL COMMENT 'from city_master table id',
  `district_id` int(11) UNSIGNED DEFAULT NULL COMMENT 'From district table',
  `area_name` varchar(40) NOT NULL,
  `area_code` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(11) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1->active,0->inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `area_management`
--

INSERT INTO `area_management` (`id`, `state_id`, `city_id`, `district_id`, `area_name`, `area_code`, `created_date`, `created_by`, `modified_date`, `modified_by`, `status`) VALUES
(1, 1, 1, 4, 'Prahlad nagar', '', '2019-09-23 12:25:50', 0, '2021-10-06 13:04:09', 247, 1),
(2, 1, 3, 0, 'Anand nagar', '', '2019-11-09 19:58:00', 1, '2020-03-16 17:21:57', 1, 1),
(3, 1, 2, 0, 'Varacha', '', '2019-11-09 20:00:37', 1, '2020-03-16 17:21:52', 1, 1),
(4, 2, 4, 0, 'Borivali', '', '2019-11-20 15:06:25', 1, '2020-03-16 17:21:46', 1, 1),
(5, 1, 1, 0, 'Usmanpura', '', '2020-03-16 17:22:53', 1, '0000-00-00 00:00:00', 0, 1),
(6, 1, 1, 0, 'Satellite', '', '2020-03-16 17:23:25', 1, '0000-00-00 00:00:00', 0, 1),
(7, 1, 1, 0, 'Gulbai Tekra', '', '2020-03-16 17:24:02', 1, '0000-00-00 00:00:00', 0, 1),
(8, 1, 1, 0, 'Vastrapur', '', '2020-03-16 17:24:47', 1, '0000-00-00 00:00:00', 0, 1),
(9, 1, 1, 0, 'Science City', '', '2020-03-16 17:25:13', 1, '0000-00-00 00:00:00', 0, 1),
(10, 1, 1, 0, 'Ambawadi', '', '2020-03-16 17:25:37', 1, '0000-00-00 00:00:00', 0, 1),
(11, 1, 1, 0, 'Paldi', '', '2020-03-16 17:25:51', 1, '0000-00-00 00:00:00', 0, 1),
(12, 1, 1, 0, 'Navrangpura', '', '2020-03-16 17:26:39', 1, '0000-00-00 00:00:00', 0, 1),
(13, 1, 1, 0, 'Nehrunagar', '', '2020-03-16 17:27:04', 1, '0000-00-00 00:00:00', 0, 1),
(14, 1, 1, 0, 'Bopal', '', '2020-03-16 17:27:25', 1, '0000-00-00 00:00:00', 0, 1),
(15, 1, 1, 0, 'Sabarmati', '', '2020-03-16 18:01:03', 1, '0000-00-00 00:00:00', 0, 1),
(16, 1, 1, 0, 'Jodhpur Tekra', '', '2020-03-16 18:01:42', 1, '0000-00-00 00:00:00', 0, 1),
(17, 1, 1, 0, 'Naranpura', '', '2020-03-16 18:02:31', 1, '0000-00-00 00:00:00', 0, 1),
(18, 1, 1, 0, 'Kankaria', '', '2020-03-16 18:03:07', 1, '0000-00-00 00:00:00', 0, 1),
(19, 1, 1, 0, 'Gurukul', '', '2020-03-16 18:05:23', 1, '0000-00-00 00:00:00', 0, 1),
(20, 1, 1, 0, 'Thaltej', '', '2020-03-16 18:06:52', 1, '0000-00-00 00:00:00', 0, 1),
(21, 1, 1, 0, 'Bodakdev', '', '2020-03-16 18:07:10', 1, '0000-00-00 00:00:00', 0, 1),
(22, 1, 1, 0, 'Ghatlodiya', '', '2020-03-16 18:07:38', 1, '0000-00-00 00:00:00', 0, 1),
(23, 1, 1, 0, 'Shilaj', '', '2020-03-16 18:08:19', 1, '0000-00-00 00:00:00', 0, 1),
(24, 1, 1, 1, 'Nikol', '382021', '2021-05-07 09:35:55', 7, '0000-00-00 00:00:00', 0, 1),
(25, 1, 1, 2, 'South Bopal', '', '2021-06-25 20:45:19', 7, '0000-00-00 00:00:00', 0, 1),
(26, 1, 1, NULL, 'Ahmedabad Airport', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(27, 1, 1, NULL, 'Ambli', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(28, 1, 1, NULL, 'Ambli Bopal', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(29, 1, 1, NULL, 'Amraiwadi', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(30, 1, 1, NULL, 'Asarwa', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(31, 1, 1, NULL, 'Aslali', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(32, 1, 1, NULL, 'Astodia', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(33, 1, 1, NULL, 'Ayojan Nagar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(34, 1, 1, NULL, 'Badarkha', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(35, 1, 1, NULL, 'Bagodara', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(36, 1, 1, NULL, 'Bahiyal', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(37, 1, 1, NULL, 'Bapunagar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(38, 1, 1, NULL, 'Bardolpura', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(39, 1, 1, NULL, 'Barejadi', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(40, 1, 1, NULL, 'Bavla', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(41, 1, 1, NULL, 'Bayad', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(42, 1, 1, NULL, 'Behrampura', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(43, 1, 1, NULL, 'Bhadaj', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(44, 1, 1, NULL, 'Bhadiyad', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(45, 1, 1, NULL, 'Bhadra', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(46, 1, 1, NULL, 'Bhat', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(47, 1, 1, NULL, 'Bhatta', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(48, 1, 1, NULL, 'Bhojva', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(49, 1, 1, NULL, 'Bholad', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(50, 1, 1, NULL, 'Calico Mills', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(51, 1, 1, NULL, 'Chaloda', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(52, 1, 1, NULL, 'Chanakyapuri', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(53, 1, 1, NULL, 'Chandkheda', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(54, 1, 1, NULL, 'Chandlodiya', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(55, 1, 1, NULL, 'Changodar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(56, 1, 1, NULL, 'Chekhla', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(57, 1, 1, NULL, 'Chharodi', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(58, 1, 1, NULL, 'Chiloda', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(59, 1, 1, NULL, 'CTM', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(60, 1, 1, NULL, 'D Colony', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(61, 1, 1, NULL, 'Dabhoda', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(62, 1, 1, NULL, 'Dahegam', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(63, 1, 1, NULL, 'Dani Limda', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(64, 1, 1, NULL, 'Dariapur', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(65, 1, 1, NULL, 'Daxini Society', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(66, 1, 1, NULL, 'Delhi Chakla', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(67, 1, 1, NULL, 'Delhi Darwaja', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(68, 1, 1, NULL, 'Detroj', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(69, 1, 1, NULL, 'Dholera', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(70, 1, 1, NULL, 'Dudheshwar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(71, 1, 1, NULL, 'Ellis Bridge', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(72, 1, 1, NULL, 'Gandhi Ashram', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(73, 1, 1, NULL, 'Geratpur', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(74, 1, 1, NULL, 'Gheekanta', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(75, 1, 1, NULL, 'Ghodasar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(76, 1, 1, NULL, 'Ghuma', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(77, 1, 1, NULL, 'Gift City', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(78, 1, 1, NULL, 'Girdhar Nagar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(79, 1, 1, NULL, 'Gita Mandir', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(80, 1, 1, NULL, 'Godhavi', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(81, 1, 1, NULL, 'Gokuldham', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(82, 1, 1, NULL, 'Gomtipur', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(83, 1, 1, NULL, 'Gota', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(84, 1, 1, NULL, 'Hansol', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(85, 1, 1, NULL, 'Hathijan', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(86, 1, 1, NULL, 'Hatkeshwar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(87, 1, 1, NULL, 'Isanpur', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(88, 1, 1, NULL, 'Jagatpur', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(89, 1, 1, NULL, 'Jalila', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(90, 1, 1, NULL, 'Jamalpur', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(91, 1, 1, NULL, 'Janta Nagar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(92, 1, 1, NULL, 'Jashoda Nagar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(93, 1, 1, NULL, 'Jawahar Chowk', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(94, 1, 1, NULL, 'Jetalpur', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(95, 1, 1, NULL, 'Jivraj Park', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(96, 1, 1, NULL, 'Jodhpur', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(97, 1, 1, NULL, 'Juhapura', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(98, 1, 1, NULL, 'Juna Wadaj', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(99, 1, 1, NULL, 'Kabir Chowk', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(100, 1, 1, NULL, 'Kadi', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(101, 1, 1, NULL, 'Kalapi Nagar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(102, 1, 1, NULL, 'Kali', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(103, 1, 1, NULL, 'Kalol', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(104, 1, 1, NULL, 'Kalupur', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(105, 1, 1, NULL, 'Kalyanpura', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(106, 1, 1, NULL, 'Kamiyala', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(107, 1, 1, NULL, 'Kathwada', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(108, 1, 1, NULL, 'Kauka', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(109, 1, 1, NULL, 'Keshav Nagar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(110, 1, 1, NULL, 'Khadia', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(111, 1, 1, NULL, 'Khamasa', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(112, 1, 1, NULL, 'Khanpur', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(113, 1, 1, NULL, 'Kharna', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(114, 1, 1, NULL, 'Kheda', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(115, 1, 1, NULL, 'Khodiar Nagar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(116, 1, 1, NULL, 'Khodiyar Nagar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(117, 1, 1, NULL, 'Khokhra', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(118, 1, 1, NULL, 'Koba', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(119, 1, 1, NULL, 'Kolat', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(120, 1, 1, NULL, 'Kotarpur', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(121, 1, 1, NULL, 'Koteshwar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(122, 1, 1, NULL, 'Kothgangad', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(123, 1, 1, NULL, 'Krishnanagar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(124, 1, 1, NULL, 'Kuber Nagar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(125, 1, 1, NULL, 'Kudasan', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(126, 1, 1, NULL, 'Kuha', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(127, 1, 1, NULL, 'Lal Darwaza', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(128, 1, 1, NULL, 'Lambha', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(129, 1, 1, NULL, 'Law Garden', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(130, 1, 1, NULL, 'Laxmanpura', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(131, 1, 1, NULL, 'Lothal Bhurhki', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(132, 1, 1, NULL, 'Madhupura', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(133, 1, 1, NULL, 'Mahadev Nagar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(134, 1, 1, NULL, 'Mahudara', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(135, 1, 1, NULL, 'Makarba', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(136, 1, 1, NULL, 'Mandal', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(137, 1, 1, NULL, 'Manek Chowk', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(138, 1, 1, NULL, 'Maninagar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(139, 1, 1, NULL, 'Maninagar East', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(140, 1, 1, NULL, 'Manipur', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(141, 1, 1, NULL, 'Mankol', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(142, 1, 1, NULL, 'Meghani Nagar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(143, 1, 1, NULL, 'Memnagar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(144, 1, 1, NULL, 'Mirzapur', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(145, 1, 1, NULL, 'Mithakhali', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(146, 1, 1, NULL, 'Moraiya', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(147, 1, 1, NULL, 'Motera', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(148, 1, 1, NULL, 'Nalsarovar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(149, 1, 1, NULL, 'Nana Chiloda', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(150, 1, 1, NULL, 'Nandej', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(151, 1, 1, NULL, 'Nandol', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(152, 1, 1, NULL, 'Narayan Nagar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(153, 1, 1, NULL, 'Naroda', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(154, 1, 1, NULL, 'Naroda GIDC', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(155, 1, 1, NULL, 'Narol', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(156, 1, 1, NULL, 'Narolgam', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(157, 1, 1, NULL, 'Nasmed', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(158, 1, 1, NULL, 'Nava Naroda', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(159, 1, 1, NULL, 'Nava Vadaj', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(160, 1, 1, NULL, 'Navarangpura Gam', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(161, 1, 1, NULL, 'Navjivan', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(162, 1, 1, NULL, 'Navrang Pura', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(163, 1, 1, NULL, 'Nehru Nagar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(164, 1, 1, NULL, 'New Maninagar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(165, 1, 1, NULL, 'New Ranip', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(166, 1, 1, NULL, 'Nirnay Nagar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(167, 1, 1, NULL, 'Noblenagar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(168, 1, 1, NULL, 'Odhav', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(169, 1, 1, NULL, 'Odhav GIDC', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(170, 1, 1, NULL, 'Ognaj', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(171, 1, 1, NULL, 'Palodia', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(172, 1, 1, NULL, 'Pankore Naka', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(173, 1, 1, NULL, 'Patthar Kuva', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(174, 1, 1, NULL, 'Pethapur', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(175, 1, 1, NULL, 'Prahlad Nagar Extension', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(176, 1, 1, NULL, 'Purshottam Nagar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(177, 1, 1, NULL, 'Raikhad', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(178, 1, 1, NULL, 'Railway Colony', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(179, 1, 1, NULL, 'Raipur', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(180, 1, 1, NULL, 'Rakanpur', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(181, 1, 1, NULL, 'Rakhial', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(182, 1, 1, NULL, 'Ramdev Nagar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(183, 1, 1, NULL, 'Rampura', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(184, 1, 1, NULL, 'Rancharda', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(185, 1, 1, NULL, 'Ranip', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(186, 1, 1, NULL, 'Ranna Park', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(187, 1, 1, NULL, 'Ranpur', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(188, 1, 1, NULL, 'Raska', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(189, 1, 1, NULL, 'Ratan Pol', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(190, 1, 1, NULL, 'Raysan', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(191, 1, 1, NULL, 'Revdi Bazar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(192, 1, 1, NULL, 'Sachana', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(193, 1, 1, NULL, 'Sadar Bazar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(194, 1, 1, NULL, 'Saffrony', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(195, 1, 1, NULL, 'Saijpur Bogha', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(196, 1, 1, NULL, 'Sanand', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(197, 1, 1, NULL, 'Sanathal', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(198, 1, 1, NULL, 'Santej', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(199, 1, 1, NULL, 'Sarangpur', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(200, 1, 1, NULL, 'Saraspur', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(201, 1, 1, NULL, 'Sardar Colony', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(202, 1, 1, NULL, 'Sardar Nagar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(203, 1, 1, NULL, 'Sargaasan', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(204, 1, 1, NULL, 'Sarkhej', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(205, 1, 1, NULL, 'Satadhar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(206, 1, 1, NULL, 'Satellite Extension', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(207, 1, 1, NULL, 'Satlasana', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(208, 1, 1, NULL, 'Shah E Alam Roja', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(209, 1, 1, NULL, 'Shahibaug', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(210, 1, 1, NULL, 'Shahpur', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(211, 1, 1, NULL, 'Shantipura', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(212, 1, 1, NULL, 'Sharda Nagar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(213, 1, 1, NULL, 'Shastri Nagar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(214, 1, 1, NULL, 'Shela', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(215, 1, 1, NULL, 'Shyamal', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(216, 1, 1, NULL, 'Sindhi Ambawadi', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(217, 1, 1, NULL, 'Sola', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(218, 1, 1, NULL, 'Subhash Bridge', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(219, 1, 1, NULL, 'Sughad', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(220, 1, 1, NULL, 'Sukhrampura', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(221, 1, 1, NULL, 'Tavdipura', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(222, 1, 1, NULL, 'Teen Darwaja', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(223, 1, 1, NULL, 'Thakkarbapa Nagar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(224, 1, 1, NULL, 'Thol', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(225, 1, 1, NULL, 'Tragad', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(226, 1, 1, NULL, 'Unali', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(227, 1, 1, NULL, 'Urjanagar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(228, 1, 1, NULL, 'Vadaj', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(229, 1, 1, NULL, 'Vadsar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(230, 1, 1, NULL, 'Vaishnodevi Circle', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(231, 1, 1, NULL, 'Vasna', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(232, 1, 1, NULL, 'Vastral', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(233, 1, 1, NULL, 'Vatva', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(234, 1, 1, NULL, 'Vatva GIDC', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(235, 1, 1, NULL, 'Vavol', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(236, 1, 1, NULL, 'Vejalpur', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(237, 1, 1, NULL, 'Vejalpur Gam', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(238, 1, 1, NULL, 'Vinchhiya', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(239, 1, 1, NULL, 'Vinzol', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(240, 1, 1, NULL, 'Virochan Nagar', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(241, 1, 1, NULL, 'Visalpur', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1),
(242, 1, 1, NULL, 'Wadaj', '', '2022-07-21 16:53:24', 1, '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `category_name` varchar(100) DEFAULT NULL,
  `category_image` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `parent_id`, `vendor_id`, `category_name`, `category_image`, `created_by`, `created_date`, `modified_by`, `modified_date`, `status`, `deleted_at`) VALUES
(1, 0, 0, 'Milk', '1689412267_1817031751.png', 0, '2023-07-15 11:11:07', 0, '0000-00-00 00:00:00', 1, NULL),
(2, 0, 33, 'Electronic', '1689759177_200355745.png', 0, '2023-07-19 11:32:57', 2, '2023-08-07 06:58:00', 1, NULL),
(3, 1, 0, 'kjhkhdgchyd', NULL, 0, '2023-07-19 12:10:29', 0, '0000-00-00 00:00:00', 1, '2023-07-19 12:10:35'),
(4, 2, 0, 'mobile', NULL, 0, '2023-07-19 12:50:43', 0, '0000-00-00 00:00:00', 1, NULL),
(5, 1, 32, 'sssss', NULL, 0, '2023-08-07 07:05:56', 0, '0000-00-00 00:00:00', 1, NULL),
(6, 1, 38, 'dsds', NULL, 0, '2023-08-09 12:04:46', 0, '0000-00-00 00:00:00', 1, NULL),
(7, 1, 42, 'demo', NULL, 0, '2023-08-10 10:32:27', 0, '0000-00-00 00:00:00', 1, NULL),
(8, 1, 42, '12', NULL, 0, '2023-08-10 10:32:49', 0, '0000-00-00 00:00:00', 1, NULL),
(9, 0, 42, 'qwe', '1691657267_527728361.png', 0, '2023-08-10 10:47:47', 0, '0000-00-00 00:00:00', 1, NULL),
(10, 9, 42, 'demo', NULL, 0, '2023-08-10 10:56:19', 0, '0000-00-00 00:00:00', 1, NULL),
(11, 0, 42, 'out', NULL, 0, '2023-08-10 11:10:55', 0, '0000-00-00 00:00:00', 1, NULL),
(12, 11, 42, 'digo', NULL, 0, '2023-08-10 11:46:11', 0, '0000-00-00 00:00:00', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `city_management`
--

CREATE TABLE `city_management` (
  `id` int(11) UNSIGNED NOT NULL,
  `state_id` int(11) UNSIGNED DEFAULT NULL COMMENT 'from state-management table id',
  `city_name` varchar(40) NOT NULL,
  `city_code` varchar(10) NOT NULL,
  `short_name` varchar(50) NOT NULL,
  `membership_rate` float(8,2) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL COMMENT 'from user',
  `modified_date` datetime NOT NULL,
  `modified_by` int(11) UNSIGNED NOT NULL COMMENT 'from user',
  `status` tinyint(1) NOT NULL COMMENT '1->active,0->inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `city_management`
--

INSERT INTO `city_management` (`id`, `state_id`, `city_name`, `city_code`, `short_name`, `membership_rate`, `created_date`, `created_by`, `modified_date`, `modified_by`, `status`) VALUES
(1, 1, 'Ahmedabad', 'ABAD', 'ahm', 0.00, '2019-09-23 12:06:08', 0, '2021-10-08 16:25:00', 247, 1),
(2, 1, 'Surat', 'SRT', 'sur', 4000.00, '2019-09-23 12:06:27', 0, '2021-10-07 23:52:28', 7, 1),
(3, 1, 'Vadodara', 'GJ', 'vad', 5400.00, '2019-09-23 12:06:46', 0, '2021-10-08 17:02:37', 247, 1),
(4, 2, 'Mumbai', 'MH', 'mum', 0.00, '2019-11-20 15:05:40', 1, '2021-10-08 17:02:47', 247, 1),
(5, 1, 'Rajkot', 'RJK', '', 5000.00, '2021-10-06 12:12:17', 247, '2021-10-08 17:00:28', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms_management`
--

CREATE TABLE `cms_management` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cms_management`
--

INSERT INTO `cms_management` (`id`, `title`, `description`, `slug`, `image_name`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'About Us', '<p>From the Desk of Founder &amp; Managing Director,</p>\r\n\r\n<p><strong><u><em>Dr. Tejendra Rajput,M.P.T.(Neurology)</em></u></strong></p>\r\n\r\n<p>&ldquo;Physiocares is committed to the delivery of quality healthcare, and our all therapists are well trained.</p>\r\n\r\n<p>The most important part of treating any injury or chronic condition starts with an accurate diagnosis and our physiotherapists are able to combine quality therapeutic exercise with manual techniques such as manipulation to provide the BEST care for many neuro- musculoskeletal problems.</p>\r\n\r\n<p>We ensure that we analyze all aspects of the patient&#39;s history and conduct all the appropriate tests to arrive at the correct diagnosis, before prescribing the appropriate course of treatment.&nbsp;</p>\r\n\r\n<p>Another important aspect that I have personally observed and subscribe to, is the importance of a positive attitude during the healing process.&nbsp;</p>\r\n\r\n<p>People with a positive attitude respond more effectively to treatment, and we work with our patients on these aspects as well.</p>\r\n\r\n<p>Knowledge and research is continuously evolving in the domain of physiotherapy. We invest in training our staff, as well as the latest modalities for healing injuries and pain. In addition, we also educate our patients on the importance of prevention of injuries by adopting some basic self-help guidelines for taking care of oneself.</p>\r\n\r\n<p>We are here to help you, and guide you to make your lifestyle pain free.</p>\r\n\r\n<p>Delivering smiles everyday!</p>\r\n\r\n<p>1.Proven Medical Expertise:</p>\r\n\r\n<p>Doctor recommended protocols, personalized plans &amp; measurable clinical outcomes that ensure timely recovery</p>\r\n\r\n<p>2.Unmatched Convenience:</p>\r\n\r\n<p>Expert medical care right at your home with no stress of transport, extra costs &amp; other hassles</p>\r\n\r\n<p>3.Personalized Care:</p>\r\n\r\n<p>Unique treatment for your specific ailment.</p>\r\n\r\n<p>4.Expert Physiotherapists:</p>\r\n\r\n<p>Our team of therapists is well trained and certified.</p>\r\n\r\n<p>5.Beyond Recovery:</p>\r\n\r\n<p>Committed to making fit and ready for life again.</p>\r\n\r\n<p>6.Unique Approach:</p>\r\n\r\n<p>We believe in involving YOU in your treatment.<br />\r\n&nbsp;</p>\r\n\r\n<h4><strong>Physiocares Mission :</strong></h4>\r\n\r\n<p>Our mission is to provide the highest quality of home health care services for our valued customers so that they can enjoy a more enriched, comfortable, and safe life in their own home.</p>\r\n\r\n<h4><strong>Physiocares Vision:</strong></h4>\r\n\r\n<p>Physiocares aims to make physiotherapy service at the fingertip for all our customers.</p>\r\n\r\n<h4><strong>Our Core Values:</strong></h4>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Quality Care, Respect for Individual, Gratitude and Compassion</p>\r\n	</li>\r\n	<li>\r\n	<p>Strength of Physiocares is Best Physio Assessment, Right Diagnosis &amp; Prevention Management to prevent diseases from reoccurrence.</p>\r\n	</li>\r\n	<li>\r\n	<p>Your health is our No.1 priority!</p>\r\n	</li>\r\n</ul>\r\n\r\n<h4><strong>Our Quality Policy:</strong></h4>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Our service differentiates us from its peers at private and public hospitals. Business processes are implemented, measured and improved consistently. Quality is observed with a view of providing service par excellence in :</p>\r\n	</li>\r\n</ul>\r\n\r\n<ol>\r\n	<li>\r\n	<p>Effectiveness: All processes, equipment, work habits and staff should be focussed on healing the patient.</p>\r\n	</li>\r\n	<li>\r\n	<p>Timeliness: We are committed to heal the patients as soon as possible and make&nbsp; them a healthy person.</p>\r\n	</li>\r\n	<li>\r\n	<p>Efficiency: Patients are served by highly skilled, qualified and courteous physiotherapists who are sensitive to patients pain and are empathetic to their troubles.</p>\r\n	</li>\r\n	<li>\r\n	<p>Patient experience: A person who steps in as a patient should step out as our life long friend.</p>\r\n	</li>\r\n	<li>\r\n	<p>&nbsp;Quality control: Constantly trying to set higher benchmarks of performance in patient satisfaction.</p>\r\n	</li>\r\n	<li>\r\n	<p>Safety: The safety of the patient as well as of the staff is the utmost importance.</p>\r\n	</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h4><strong>Teamwork Process:</strong></h4>\r\n\r\n<ul>\r\n	<li>\r\n	<p><u>Awareness &amp; Goal setting:</u></p>\r\n	</li>\r\n</ul>\r\n\r\n<p>Being educated about your condition/injury is the most important factor towards your success. When you call our company, you will be given a thorough assessment. Our experts will spend time with you to create awareness about your body mechanics, movement patterns, existing condition/injury, types of treatment, exercises and help you set specific goals. They will chart out your focused plan of therapy, ticking away each session/modality as you progress towards your goal. In case of post-surgery rehabilitation, our Physiotherapists will focus on speedy recovery as well as raising your confidence in using the affected joint on a daily basis.</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><u>Maintenance:</u></p>\r\n	</li>\r\n</ul>\r\n\r\n<p>After a few sessions of treatment, your pain may be reduced; but the key is to get back to your previous level of function. This can be achieved only through the right form of exercises. Using our extensive knowledge in exercise prescription, we will develop an exercise regime that best fits your treatment and your schedule and lifestyle. This will help you to regain your movement and maintain it on your own. For Rehab patients, our Physiotherapists at home allows the care-givers and family members to be involved in the treatment and gain a better understanding of the condition thereby enabling and training them for how they can help.</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><u>Recovery:</u></p>\r\n	</li>\r\n</ul>\r\n\r\n<p>We recognize that you are in pain and/or unable to move the way you want to. Our Physiotherapists are skilled in internationally established techniques like Mulligan&#39;s concept, McKenzie techniques and a variety of non-invasive methods including Kinesio-taping, Pilates,</p>', 'about_us', '1666287041_1358523693.jpg', '2022-10-19 19:30:41', NULL, '2022-10-20 19:43:39', NULL),
(13, 'Contact US', '<p>Welcome TO Speedi</p>', 'contact_us', '1687147444_1382199507.jpg', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `country_master`
--

CREATE TABLE `country_master` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'Primary key, Auto increment',
  `country_name` varchar(100) NOT NULL,
  `country_code` varchar(10) NOT NULL,
  `short_name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL COMMENT 'admin id',
  `modified_at` datetime NOT NULL,
  `modified_by` int(11) UNSIGNED NOT NULL COMMENT 'admin id',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1->active,0->inactive',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `country_master`
--

INSERT INTO `country_master` (`id`, `country_name`, `country_code`, `short_name`, `created_at`, `created_by`, `modified_at`, `modified_by`, `status`, `is_deleted`) VALUES
(1, 'India', 'Ind', '', '2019-09-23 12:05:30', 0, '2019-09-23 12:05:30', 0, 1, 0),
(2, 'Australia', 'Aus', '', '2019-09-23 12:05:30', 0, '2019-09-23 12:05:30', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_02_15_095032_create_permission_tables', 1),
(8, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(9, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(10, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(11, '2016_06_01_000004_create_oauth_clients_table', 2),
(12, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 8),
(1, 'App\\Models\\User', 28),
(1, 'App\\Models\\User', 30),
(1, 'App\\Models\\User', 31),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 29),
(2, 'App\\Models\\User', 43),
(3, 'App\\Models\\User', 32),
(3, 'App\\Models\\User', 33),
(3, 'App\\Models\\User', 34),
(3, 'App\\Models\\User', 35),
(3, 'App\\Models\\User', 36),
(3, 'App\\Models\\User', 37),
(3, 'App\\Models\\User', 38),
(3, 'App\\Models\\User', 39),
(3, 'App\\Models\\User', 40),
(3, 'App\\Models\\User', 42);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Displayplan Personal Access Client', 'jnoQzfoF0lOl7VZyrMWhabT5JMlSgNbZ5HK6AIS2', NULL, 'http://localhost', 1, 0, 0, '2022-04-07 04:09:55', '2022-04-07 04:09:55'),
(2, NULL, 'Displayplan Password Grant Client', 'LnBaSSnUA2RTSHPSxkBtb9uFBkhZAweA12P0lCU3', 'users', 'http://localhost', 0, 1, 0, '2022-04-07 04:09:55', '2022-04-07 04:09:55'),
(96012, NULL, 'Displayplan Personal Access Client', 'CkWrrGY6XPIrMrC3Wg2zb2inHDp3c9BuYqolRkhO', NULL, 'http://localhost', 1, 0, 0, '2022-04-07 04:16:10', '2022-04-07 04:16:10');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-04-07 04:09:55', '2022-04-07 04:09:55'),
(2, 96012, '2022-04-07 04:16:10', '2022-04-07 04:16:10');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_name`, `created_at`) VALUES
(2, 1, 'a523426cc585745318d5f6d91a9c0706.jpg', '2023-07-15 11:46:55'),
(3, 1, '4559912e7a94a9c32b09d894f2bc3c82.jpg', '2023-07-15 11:46:55'),
(4, 1, '34d94cf9ca228a78848313df32d668d1.jpg', '2023-07-15 11:46:55');

-- --------------------------------------------------------

--
-- Table structure for table `product_management`
--

CREATE TABLE `product_management` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `rack` varchar(50) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `variation_type` tinyint(1) DEFAULT NULL,
  `size` varchar(100) DEFAULT NULL,
  `color` varchar(100) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `purchase_price` float(8,2) NOT NULL,
  `sell_price` float(8,2) NOT NULL,
  `product_desc` text DEFAULT NULL,
  `product_weight` varchar(255) NOT NULL,
  `product_image` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_management`
--

INSERT INTO `product_management` (`id`, `vendor_id`, `rack`, `product_name`, `variation_type`, `size`, `color`, `category_id`, `purchase_price`, `sell_price`, `product_desc`, `product_weight`, `product_image`, `created_by`, `created_date`, `modified_by`, `modified_date`, `status`, `deleted_at`) VALUES
(1, 0, NULL, 'test', 0, NULL, '#000000', 2, 55.00, 56.00, '5', '55', '', 2, '2023-07-24 06:37:45', 0, '0000-00-00 00:00:00', 1, '2023-07-24 06:37:53'),
(2, 0, NULL, 'Mobile', 0, NULL, '#000000', 2, 10000.00, 20000.00, 'test', '500gm', '1690178815_2131511576.jpg', 2, '2023-07-24 08:06:55', 0, '0000-00-00 00:00:00', 1, NULL),
(3, 34, NULL, 'Milk Powder', 0, NULL, '#000000', 1, 20.00, 25.00, 'test', '100gm', '', 2, '2023-08-10 10:17:18', 0, '0000-00-00 00:00:00', 1, NULL),
(4, 33, NULL, 'only milk', 0, NULL, '#000000', 1, 20.00, 25.00, 'tes', '500', '', 2, '2023-08-07 08:04:32', 0, '0000-00-00 00:00:00', 1, NULL),
(5, 32, NULL, 'Chocolate', 0, NULL, '#000000', 1, 5.00, 10.00, 'test', '5gm', '', 2, '2023-08-07 07:21:16', 0, '0000-00-00 00:00:00', 1, NULL),
(6, 33, NULL, 'djdjb', 0, NULL, '#000000', 2, 50.00, 100.00, NULL, '52', '', 2, '2023-08-07 07:21:09', 0, '0000-00-00 00:00:00', 1, NULL),
(7, 0, NULL, 'dsjhkj', 2, NULL, '#000000', 1, 55.00, 55.00, '5', '5', '', 2, '2023-08-09 06:10:02', 0, '0000-00-00 00:00:00', 1, NULL),
(8, 2, NULL, 'dsfosh', 2, NULL, '#000000', 1, 55.00, 55.00, '5', '5', '', 2, '2023-08-09 06:11:17', 0, '0000-00-00 00:00:00', 1, NULL),
(9, 2, NULL, 'dsdms', 2, NULL, '#000000', 1, 55.00, 555.00, '54', '5', '', 2, '2023-08-09 06:11:35', 0, '0000-00-00 00:00:00', 1, NULL),
(10, 37, NULL, 'dddsd', 1, NULL, '#000000', 2, 55.00, 55.00, '5', '5', '', 37, '2023-08-09 06:24:45', 0, '0000-00-00 00:00:00', 1, NULL),
(11, 39, '122', 'ddcjh', 2, NULL, '#000000', 2, 66.00, 55.00, '5', '55', '', 2, '2023-08-09 09:27:04', 0, '0000-00-00 00:00:00', 1, NULL),
(12, 42, NULL, 'deco', 0, NULL, '#000000', 10, 11.00, 12.00, NULL, '100', '', 42, '2023-08-10 11:38:32', 0, '0000-00-00 00:00:00', 1, NULL),
(13, 42, NULL, 'zemo', 2, NULL, '#000000', 11, 15.00, 20.00, NULL, '100', '', 42, '2023-08-10 11:44:41', 0, '0000-00-00 00:00:00', 1, NULL),
(14, 42, NULL, 'pen', 1, '12', '#4048bf', 11, 10.00, 15.00, NULL, '12', '', 42, '2023-08-12 11:05:23', 0, '0000-00-00 00:00:00', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_purchase`
--

CREATE TABLE `product_purchase` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `purchase_date` date DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `purchase_price` float(8,2) DEFAULT NULL,
  `purchase_total_price` float(8,2) DEFAULT NULL,
  `variation_type` tinyint(1) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `color` varchar(100) DEFAULT NULL,
  `product_desc` text DEFAULT NULL,
  `product_weight` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1:Active,0:Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_purchase`
--

INSERT INTO `product_purchase` (`id`, `supplier_id`, `product_id`, `vendor_id`, `purchase_date`, `qty`, `purchase_price`, `purchase_total_price`, `variation_type`, `size`, `color`, `product_desc`, `product_weight`, `created_date`, `modified_by`, `modified_date`, `status`) VALUES
(1, 4, 2, 0, NULL, 10, 10000.00, 100000.00, 0, NULL, '#000000', 'test', '500gm', '0000-00-00 00:00:00', 2, '2023-07-24 08:07:34', 1),
(2, 4, 3, 0, NULL, 500, 20.00, 10000.00, 0, NULL, '#000000', NULL, '100gm', '0000-00-00 00:00:00', 2, '2023-07-24 08:50:21', 1),
(3, 4, 4, 32, NULL, 100, 20.00, 2000.00, NULL, NULL, '#000000', NULL, '500', '0000-00-00 00:00:00', 2, '2023-08-07 07:31:00', 1),
(4, 4, 6, 33, NULL, 10, 50.00, 500.00, 2, NULL, '#000000', NULL, '52', '0000-00-00 00:00:00', 2, '2023-08-07 07:42:02', 1),
(5, 11, 10, 39, '2023-08-23', 2, 55.00, 110.00, 2, NULL, '#000000', '5', '5', '0000-00-00 00:00:00', 2, '2023-08-10 07:03:02', 1),
(9, 17, 12, 42, '2023-08-11', 100, 11.00, 1100.00, NULL, NULL, '#000000', NULL, '100', '0000-00-00 00:00:00', 42, '2023-08-11 08:45:35', 1),
(10, 17, 14, 42, '2023-08-12', 100, 10.00, 1000.00, 1, 20, '#4048bf', NULL, '12', '0000-00-00 00:00:00', 42, '2023-08-12 11:49:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `id` int(11) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rate` tinyint(1) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_review`
--

INSERT INTO `product_review` (`id`, `product_id`, `user_id`, `rate`, `review`, `created_by`, `created_date`, `modified_by`, `modified_date`, `status`) VALUES
(1, '3', 19, 5, '4/5', 0, '2023-06-03 13:54:41', 0, '2023-06-03 13:54:41', 1),
(2, '3', 19, NULL, '4/5', 0, '2023-06-05 10:13:16', 0, '2023-06-05 10:13:16', 1),
(3, '3', 19, NULL, '4/5', 0, '2023-06-05 10:14:08', 0, '2023-06-05 10:14:08', 1),
(4, '3', 18, NULL, '4/5', 0, '2023-06-05 10:14:41', 0, '2023-06-05 10:14:41', 1),
(5, '4', 25, 3, '5', 0, '2023-06-07 13:43:25', 0, '2023-06-07 13:43:25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_sell`
--

CREATE TABLE `product_sell` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `sell_amount` float(8,2) DEFAULT NULL,
  `sell_total_amount` float(8,2) DEFAULT NULL,
  `variation_type` tinyint(1) DEFAULT NULL COMMENT '1:variation,0:not variation',
  `size` varchar(100) DEFAULT NULL,
  `color` varchar(100) DEFAULT NULL,
  `product_desc` text DEFAULT NULL,
  `product_weight` varchar(255) DEFAULT NULL,
  `modified_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1:Active,0:Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_sell`
--

INSERT INTO `product_sell` (`id`, `product_id`, `vendor_id`, `supplier_id`, `qty`, `sell_amount`, `sell_total_amount`, `variation_type`, `size`, `color`, `product_desc`, `product_weight`, `modified_date`, `status`) VALUES
(1, 2, 0, 0, 5, 20000.00, 100000.00, 0, NULL, '#000000', 'test', '500gm', '2023-07-24 08:48:22', 1),
(2, 3, 32, 0, 500, 25.00, 12500.00, 2, NULL, '#000000', 'test', '100gm', '2023-08-07 07:42:28', 1),
(3, 4, 33, 0, 100, 25.00, 2500.00, 1, NULL, '#000000', NULL, '100', '2023-08-07 07:38:05', 1),
(4, 10, 37, 0, 2, 55.00, 110.00, 2, NULL, '#000000', '22', '22', '2023-08-09 06:26:59', 1),
(5, 10, 37, 4, 2, 55.00, 110.00, 2, NULL, '#000000', '5', '5', '2023-08-09 11:36:29', 1),
(6, 11, 38, 0, 1, 55.00, 55.00, NULL, NULL, '#000000', '5', '55', '2023-08-10 07:47:12', 1),
(9, 8, 0, 0, 1, 55.00, 55.00, NULL, NULL, '#000000', '5', '5', '2023-08-10 13:05:18', 1),
(11, 12, 42, 17, 10, 12.00, 120.00, 2, NULL, '#000000', NULL, '100', '2023-08-12 09:53:35', 1),
(12, 14, 42, 0, 10, 15.00, 150.00, 1, '12', '#4048bf', NULL, '12', '2023-08-12 12:10:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'User', 'web', '2022-04-10 17:05:42', '2022-04-10 17:05:42'),
(2, 'Admin', 'web', '2022-04-10 17:05:42', '2022-04-10 17:05:42'),
(3, 'Vendor', 'web', '2022-04-10 17:06:23', '2022-04-10 17:06:23');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL COMMENT 'from patient',
  `title` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `from_time` time NOT NULL,
  `to_time` time NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `tax_percentage` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `tax_percentage`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 5, 2, '2023-06-19 06:54:07', 2, '2023-06-19 06:54:07');

-- --------------------------------------------------------

--
-- Table structure for table `state_master`
--

CREATE TABLE `state_master` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'Auto increment (Unsigned)',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'from country master',
  `state_name` varchar(100) NOT NULL,
  `state_code` varchar(10) NOT NULL,
  `short_name` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL COMMENT 'From users',
  `modified_date` datetime NOT NULL,
  `modified_by` int(11) UNSIGNED NOT NULL COMMENT 'From users',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1->active,0->inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `state_master`
--

INSERT INTO `state_master` (`id`, `country_id`, `state_name`, `state_code`, `short_name`, `created_date`, `created_by`, `modified_date`, `modified_by`, `status`) VALUES
(1, 1, 'Gujarat', 'guj', '', '2019-09-23 12:05:49', 0, '2019-09-23 12:05:49', 0, 1),
(2, 1, 'Maharashtra', '', '', '2019-11-20 15:04:58', 1, '2019-11-26 13:51:07', 70, 1),
(3, 2, 'Victoria', 'vic', '', '2019-11-20 15:04:58', 1, '2019-11-26 13:51:07', 70, 1);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` int(11) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1:Active,0:Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `vendor_id`, `first_name`, `last_name`, `email`, `mobile`, `address`, `image`, `created_by`, `created_date`, `modified_by`, `modified_date`, `status`) VALUES
(4, 0, 'dsc', 'dcd', 'dflkdjm@gmail.com', 2147483647, '577', NULL, 2, '2023-07-22 14:11:46', 0, '0000-00-00 00:00:00', 1),
(5, 39, 'dsdd', 'sdsd', 'dfbhj@gmail.com', 2147483647, '44dd', NULL, 2, '2023-08-09 12:05:58', 0, '0000-00-00 00:00:00', 1),
(6, 36, 'hk', 'kllkk', 'dsb@gmail.com', 2147483647, '555ddds', NULL, 2, '2023-08-10 06:22:41', 0, '0000-00-00 00:00:00', 1),
(7, 40, 'dsd', 'dsss', 'ndbfhd@gmail.com', 2147483647, '51dd', '1691641876_646200652.png', 2, '2023-08-10 06:30:20', 2, '2023-08-10 06:31:16', 1),
(8, 38, 'dsd', 'sss', 'dmsn@gmail.com', 65626526, 'vklcm7373', '1691642013_1848485716.jpg', 2, '2023-08-10 06:31:56', 2, '2023-08-10 06:33:33', 1),
(9, 39, 'ssd', 'ssdss', 'knjknfbf@gmail.com', 2147483647, 'nh', '1691642375_2109196888.jpg', 2, '2023-08-10 06:34:20', 2, '2023-08-10 06:39:35', 1),
(10, 36, 'dsd', 'dd', 'ndbfj@gmail.com', 2147483647, 'cjdbj', '1691642733_1126094241.jpg', 2, '2023-08-10 06:39:19', 2, '2023-08-10 06:45:33', 1),
(11, 36, 'dss', 'dss', 'jbchdhf@gmail.com', 2147483647, 'svdh', '1691643024_1121040342.jpg', 2, '2023-08-10 06:46:41', 2, '2023-08-10 06:50:30', 1),
(12, 36, 'dsdd', 'xscs', 'dfbhdb@gmail.com', 2147483647, 'cmdkcm', NULL, 2, '2023-08-10 06:53:39', 0, '0000-00-00 00:00:00', 1),
(13, 34, 'ddd', 'dsd', 'fjdnc@gmail.com', 2147483647, 'dmfdk', NULL, 2, '2023-08-10 07:10:43', 0, '0000-00-00 00:00:00', 1),
(14, 37, 'dddx', 'dds', 'dsnbd@gmail.com', 2147483647, 'dmcxn', '1691645085_385915464.jpg', 2, '2023-08-10 07:12:11', 2, '2023-08-10 07:24:45', 1),
(15, 37, 'dsd', 'dsd', 'dnbhd@gmail.com', 2147483647, 'cmdbc', '1691645123_1999180198.jpg', 2, '2023-08-10 07:25:23', 0, '0000-00-00 00:00:00', 1),
(16, 42, 'bfhgirfdabfkre', 'jddbfiudvlu', 'demo@gmail.com', 1234567890, NULL, '1691656038_1880624228.jpg', 42, '2023-08-10 10:27:18', 0, '0000-00-00 00:00:00', 1),
(17, 42, 'ukpvmvbkx', 'bckhosgs', 'demo@gmail.com', 1234567890, NULL, '1691656038_1880624228.jpg', 42, '2023-08-10 10:27:18', 0, '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `temp_user`
--

CREATE TABLE `temp_user` (
  `id` int(11) NOT NULL,
  `refferal_code` varchar(100) NOT NULL,
  `sms_code` varchar(100) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `mobilenumber` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `password` varchar(255) NOT NULL,
  `otp` varchar(20) NOT NULL,
  `user_type` tinyint(1) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temp_user`
--

INSERT INTO `temp_user` (`id`, `refferal_code`, `sms_code`, `name`, `first_name`, `last_name`, `mobilenumber`, `email`, `email_verified_at`, `password`, `otp`, `user_type`, `address`, `remember_token`, `updated_at`, `created_at`) VALUES
(1, '', '', NULL, NULL, NULL, '3564612555', 'dhdh@gmail.com', '2023-06-03 08:40:08', '$2y$10$tpOiYKFZaAnEWWepR2u0k.twYeB/LpQ2ICKFPamECx/wOLFZg0oiW', '', 0, NULL, '', '2023-06-03 10:40:08', '2023-06-03 10:13:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `refferal_code` varchar(100) NOT NULL,
  `sms_code` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `mobilenumber` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `otp` varchar(20) NOT NULL,
  `user_type` tinyint(1) NOT NULL COMMENT '1.Super Admin 2.Admin 3.Therapist 4.HR 5. Office Staff 6.Patients	',
  `address` varchar(255) DEFAULT NULL,
  `area` int(11) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `state` int(1) DEFAULT NULL,
  `country` int(1) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `google_location` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(10,8) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `refferal_code`, `sms_code`, `name`, `first_name`, `last_name`, `mobilenumber`, `email`, `email_verified_at`, `password`, `otp`, `user_type`, `address`, `area`, `city`, `state`, `country`, `pincode`, `image`, `google_location`, `latitude`, `longitude`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, '', '', 'Admin', NULL, NULL, '', 'admin@yopmail.com', NULL, '$2y$10$uui1x8sw97vWVjnK4uweOOpumL44Pa9DwFhTbnYt7jl3ipzAPJbiS', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-07 04:32:00', '2022-04-07 04:32:00'),
(8, '', '', 'Niral Patel', 'Niral', 'Patel', '324234234', 'test@gmail.com', NULL, '$2y$10$ekeGpSwkbNstVv6fQJvuSeDMyzvjQv0TnG9JBxq3MnpJo77nGnnMK', '', 0, 'test add', 4, 4, 2, 1, '382028', NULL, 'ttttttt', '14.46546540', '12.65465465', NULL, '2022-05-10 15:17:01', '2023-06-01 08:20:26'),
(13, '', '', '', 'hhdhdn', NULL, '8956896546', 'mkdn@gmail.com', NULL, '$2y$10$EZfnegJ6WtEfPcNmooyAnOgCoY8zgw2Ef0NwdVPoB.vT8WZJqV.7a', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-01 08:09:24', '2023-06-01 08:09:24'),
(14, '', '2177', '', 'njvdn', NULL, '6547432469', 'kohbemjw@gmail.com', NULL, '$2y$10$qL3jyimJLGtXFfZsrT7FfurncnqVx86pFA0tjXhe.mLXUVExqm1Zi', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-01 08:11:01', '2023-06-01 08:11:01'),
(16, '', '', '', NULL, NULL, '9662834622', NULL, NULL, '$2y$10$bYNGGBRAgriQl6YKUrKwPuEpG1PzE3a2z2VTDdAZrk7KNcnF0Xk.u', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-03 05:23:48', '2023-06-03 05:23:48'),
(18, '', '', '', 'Aftab', NULL, '966286466', 'aftab@gmail.com', NULL, '$2y$10$JlNq5O5Ak6EvtVWtA6qbmusVLn3.kWj4mM3ytLcpi/tl1MTCBOrfC', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-03 05:46:37', '2023-06-03 05:46:37'),
(19, '', '', '', 'Aftab', NULL, '966286467', 'aftab125@gmail.com', NULL, '$2y$10$6YG2zQDKCFE4o.fFlZDd6uMo/YoZzUDPEjwnVPcESYUQNI6kKUQHy', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-03 06:18:24', '2023-06-03 06:18:24'),
(20, '', '', '', 'ak', 'test', '6854785965', 'ak123@gmail.com', NULL, '$2y$10$zc3iRQDjopt.Sq2xk.gQR.pLpdZzZDl5tYeU5wGmiCiS08Me3VZOS', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-05 03:15:26', '2023-06-05 03:15:26'),
(22, '', '5566', '', 'test', 'bord', '1234567899', 'testing@gmail.com', NULL, '$2y$10$zx0g6Q8uEj2BUyvIQFY4g.Yp6uVhDM.Q5ImeGk.PSpgsdwj/c8qUK', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-06 00:27:21', '2023-06-06 00:27:21'),
(23, '', '', '', 'testing', 'bords', '9876543210', 'hjbjjxb@gmail.com', NULL, '$2y$10$cr/7UbFl9SAaygWYHmYYquLNQeF1ACEoh.hYS83IOX.EAjWL2xprW', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-06 01:06:29', '2023-06-06 01:06:29'),
(24, '', '', '', 'testing123', 'bords2222', '9662831234', 'code@gmail.com', NULL, '$2y$10$EoITeBuIjLSmB54VJAxONOwa4KozqQ6c0eV2rAQUqrsS4Oj7B9DWu', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-06 01:10:48', '2023-06-06 01:10:48'),
(25, '', '', '', '', 'Patel', '5555555555', 'neha@yopmail.com', NULL, '$2y$10$cgwFgrebtz2EnQdzuTz1MOD0ihJkIoDVC3fio/cSjz2qEFm9Q8VS6', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-06 01:17:36', '2023-06-17 08:09:38'),
(28, '', '', '', 'Aftab', 'Khan', '9685221452', 'Aftab154895@gmail.com', NULL, '$2y$10$SDDzAZgS2CIFAmhaXEL44e/4CJVnpwVJfU3fbORR4SLYL01fRiV4q', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-15 05:37:10', '2023-07-15 05:37:10'),
(29, '', '', '', 'Grishma', 'Cecil', '6461431315', 'grishma@gmail.com', NULL, '$2y$10$Wt7wDYaySzhZWVdCllF/2O8dGEeTYymBpaQqBJuuhXF73NNPkvptS', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-15 05:37:57', '2023-07-15 05:37:57'),
(30, '', '', '', 'Anjili', 'Prajapati', '5645645456', 'anjili@gmail.com', NULL, '$2y$10$NsDnBmIcBdznK8fItG83vuod1RUwxuEiMkJ1rO6pLXB.Kra0Ldp8i', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-07 00:47:34', '2023-08-07 00:47:34'),
(31, '', '', '', 'dd', 'dd', '6987987489', 'dnbhs@gmail.com', NULL, '$2y$10$ij6wApQFThbHq.KEWnx.zu2RoFjKP8kKXl7skEJ1vWRhvqHLklzzW', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-07 00:49:09', '2023-08-07 00:49:09'),
(32, '', '', '', 'Ankush', 'lal', '6685855635', 'ankl@gmail.com', NULL, '$2y$10$iLlULg2EBMgbVflpehgMm.HjASoeDf2IeJwoiDYx1yzDRuKjcQ55.', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-07 00:51:47', '2023-08-07 01:11:23'),
(33, '', '', '', 'Imaran', 'Malek', '6945646548', 'imaran@gmail.com', NULL, '$2y$10$AbidZ0TibwHvyzfJA6t0dubf0PPnowPHVsePfEiDCGNPHrbQNZal6', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-07 01:14:31', '2023-08-07 01:14:31'),
(34, '', '', '', 'Aftab', 'Khan', '6968574471', 'AftabVendor@gmail.com', NULL, '$2y$10$0OBRbScnMv0lPaaw2a446.l.h50RRggbwBYwAgDAqQZfO2HFh.1Km', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-07 06:58:36', '2023-08-07 06:58:36'),
(35, '', '', '', 'aftab', 'skxjks', '6597856414', 'aks@gmail.com', NULL, '$2y$10$sKqfrQ4bmFeo1LcTgQHujOkeRf9GQFW/mOqh/xrQcT/VSiP7NJ/Ni', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-08 06:03:07', '2023-08-08 06:03:07'),
(36, '', '', '', 'dksdhj', 'kcdn', '6546545646', 'cmnsm@gmail.com', NULL, '$2y$10$kIWNuA0mH2UX1bTlXjEnxubYPtrXmKx7nvz6Y3e2EyfbzB6BPPNg2', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-08 06:13:25', '2023-08-08 06:13:25'),
(37, '', '', '', 'mahesh', 'pk', '6564646546', 'ms@gmail.com', NULL, '$2y$10$emKgSjedzfiU64jppl.ZE.LUPIlYiKBISRwaK9NVfZ/wO0VBAlpBG', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-09 00:45:46', '2023-08-09 00:45:46'),
(38, '', '', '', 'jkdsdsjs', 'jdjd', '6566546546', 'djbfj@gmail.com', NULL, '$2y$10$OTwCYgtWsv/HzHM9kWmbvOTjiEowVlq3bzHZARMlvO3vFLGxrEkA2', '', 0, 'jkdjdhjdj', NULL, NULL, NULL, NULL, NULL, '1687157915_1329362741.jpg', NULL, NULL, NULL, NULL, '2023-08-09 02:23:10', '2023-08-09 02:23:10'),
(39, '', '', '', 'scnhjd', 'cdcn', '6565546556', 'kdlsjs@gmail.com', NULL, '$2y$10$vDPNXs0rLcG13gCC8WNzPu7HM/Ui0TB3doK/8xaF/z9HoqyiE/r.2', '', 0, 'dddd', NULL, NULL, NULL, NULL, NULL, '1691565358_928572969.jpg', NULL, NULL, NULL, NULL, '2023-08-09 03:45:43', '2023-08-09 03:45:58'),
(40, '', '', '', 'hk', 'kjh', '5464654654', 'dnjshd@gmail.com', NULL, '$2y$10$VqNRnFo1bR.A0ly1Q0ABAOm3SI/HY4fuhUHD6j9aEcxl3X6bGjjdG', '', 0, 'ddd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-09 08:46:24', '2023-08-09 08:46:24'),
(42, '', '', '', 'digo1', 'denmo', '1234567899', 'digo@yopmail.com', NULL, '$2y$10$.vEdQQ20LKUWPMtXAMGP4.4RzuvveTUFwi1CIsxXgN2KcuAl.dkxC', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, '1691828332_502003399.jpg', NULL, NULL, NULL, 'hocry6zCK4opihkO99v93Cqg60EfjwGddzPVYyLFJ3tGvoCiPwHk0HvRXtBt', '2023-08-10 04:54:34', '2023-08-12 05:15:08'),
(43, '', '', '', 'kishan', 'demo', '1234567890', 'kishan@gmail.com', NULL, '$2y$10$cgjiKy25MujdBOUyCcHKmuSdKvH9blloBmxAMVhcG0q/P.fOxMYqO', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-11 05:57:51', '2023-08-11 05:57:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area_management`
--
ALTER TABLE `area_management`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_id` (`state_id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `modified_by` (`modified_by`),
  ADD KEY `status` (`status`),
  ADD KEY `district_id` (`district_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city_management`
--
ALTER TABLE `city_management`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_id` (`state_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `modified_by` (`modified_by`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `cms_management`
--
ALTER TABLE `cms_management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country_master`
--
ALTER TABLE `country_master`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `modified_by` (`modified_by`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_management`
--
ALTER TABLE `product_management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_purchase`
--
ALTER TABLE `product_purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sell`
--
ALTER TABLE `product_sell`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state_master`
--
ALTER TABLE `state_master`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_id` (`country_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `modified_by` (`modified_by`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_user`
--
ALTER TABLE `temp_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area_management`
--
ALTER TABLE `area_management`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `city_management`
--
ALTER TABLE `city_management`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cms_management`
--
ALTER TABLE `cms_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `country_master`
--
ALTER TABLE `country_master`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary key, Auto increment', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96013;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_management`
--
ALTER TABLE `product_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_purchase`
--
ALTER TABLE `product_purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_sell`
--
ALTER TABLE `product_sell`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `state_master`
--
ALTER TABLE `state_master`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Auto increment (Unsigned)', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `temp_user`
--
ALTER TABLE `temp_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
