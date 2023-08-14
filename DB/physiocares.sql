-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2022 at 01:01 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `physiocares`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_patients_to_therapiest`
--

CREATE TABLE `assign_patients_to_therapiest` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL COMMENT 'user management	',
  `therapiest_id` int(11) NOT NULL COMMENT 'user management',
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `assign_prices_to_patients`
--

CREATE TABLE `assign_prices_to_patients` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `price` float(8,2) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `assign_prices_to_therapiest`
--

CREATE TABLE `assign_prices_to_therapiest` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL COMMENT 'user management	',
  `therapiest_id` int(11) NOT NULL COMMENT 'user management',
  `price` float(8,2) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `daily_visit_attendence`
--

CREATE TABLE `daily_visit_attendence` (
  `id` int(11) NOT NULL,
  `therapist_id` int(11) NOT NULL COMMENT 'User_management',
  `patient_id` int(11) NOT NULL COMMENT 'User_management',
  `therapy_type` tinyint(1) NOT NULL,
  `is_attend` tinyint(1) NOT NULL COMMENT '1.Yes,0-no',
  `cancel_by` int(11) DEFAULT NULL COMMENT '1.Therapist,0-Client',
  `payment_collection` tinyint(1) DEFAULT NULL COMMENT '1.Yes,0-no',
  `payout_therapist` tinyint(1) DEFAULT NULL COMMENT '1.Yes,0-no',
  `reason` varchar(255) DEFAULT NULL,
  `treatment_date` date DEFAULT NULL,
  `treatment_time` time DEFAULT NULL,
  `treatment_duration` varchar(30) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `daily_visit_attendence`
--

INSERT INTO `daily_visit_attendence` (`id`, `therapist_id`, `patient_id`, `therapy_type`, `is_attend`, `cancel_by`, `payment_collection`, `payout_therapist`, `reason`, `treatment_date`, `treatment_time`, `treatment_duration`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 3, 4, 0, 1, NULL, NULL, NULL, NULL, '2022-04-07', '04:00:00', '2 hours', 1, '2022-04-07 00:00:00', NULL, '2022-04-07 10:17:15'),
(2, 3, 4, 0, 1, NULL, NULL, NULL, NULL, '2022-04-07', '04:00:00', '2 hours', 1, '2022-04-07 00:00:00', NULL, '2022-04-07 10:19:40'),
(3, 3, 4, 0, 1, NULL, NULL, NULL, NULL, '2022-04-07', '04:00:00', '2 hours', 1, '2022-04-07 00:00:00', NULL, '2022-04-07 10:20:06'),
(4, 3, 4, 0, 1, 0, NULL, NULL, '', '2022-04-07', '04:00:00', '2 hours', 1, '2022-04-07 00:00:00', NULL, '2022-04-07 10:20:43'),
(5, 3, 4, 0, 1, 0, NULL, NULL, 'NULL', '2022-04-07', '04:00:00', '2 hours', 1, '2022-04-07 00:00:00', NULL, '2022-04-07 10:25:21');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `nicename` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `phonecode` int(5) NOT NULL,
  `inco_term` varchar(10) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1-active,0-inactive'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`, `inco_term`, `status`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4, 93, NULL, 1),
(2, 'AL', 'ALBANIA', 'Albania', 'ALB', 8, 355, NULL, 1),
(3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 12, 213, NULL, 1),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16, 1684, NULL, 1),
(5, 'AD', 'ANDORRA', 'Andorra', 'AND', 20, 376, NULL, 1),
(6, 'AO', 'ANGOLA', 'Angola', 'AGO', 24, 244, NULL, 1),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660, 1264, NULL, 1),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, 0, NULL, 1),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28, 1268, NULL, 1),
(10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 32, 54, NULL, 1),
(11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 51, 374, NULL, 1),
(12, 'AW', 'ARUBA', 'Aruba', 'ABW', 533, 297, NULL, 1),
(13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 36, 61, 'DDP', 1),
(14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 40, 43, 'DDP', 1),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31, 994, NULL, 1),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44, 1242, NULL, 1),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48, 973, NULL, 1),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50, 880, NULL, 1),
(19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 52, 1246, NULL, 1),
(20, 'BY', 'BELARUS', 'Belarus', 'BLR', 112, 375, NULL, 1),
(21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 56, 32, 'DDP', 1),
(22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 84, 501, NULL, 1),
(23, 'BJ', 'BENIN', 'Benin', 'BEN', 204, 229, NULL, 1),
(24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 60, 1441, NULL, 1),
(25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 64, 975, NULL, 1),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68, 591, NULL, 1),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70, 387, NULL, 1),
(28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 72, 267, NULL, 1),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL, 0, NULL, 1),
(30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 76, 55, 'DAP', 1),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL, 246, NULL, 1),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96, 673, NULL, 1),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100, 359, NULL, 1),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854, 226, NULL, 1),
(35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 108, 257, NULL, 1),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116, 855, NULL, 1),
(37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 120, 237, NULL, 1),
(38, 'CA', 'CANADA', 'Canada', 'CAN', 124, 1, 'DAP', 1),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132, 238, NULL, 1),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136, 1345, NULL, 1),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140, 236, NULL, 1),
(42, 'TD', 'CHAD', 'Chad', 'TCD', 148, 235, NULL, 1),
(43, 'CL', 'CHILE', 'Chile', 'CHL', 152, 56, NULL, 1),
(44, 'CN', 'CHINA', 'China', 'CHN', 156, 86, 'DDP', 1),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL, 61, NULL, 1),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL, 672, NULL, 1),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 170, 57, NULL, 1),
(48, 'KM', 'COMOROS', 'Comoros', 'COM', 174, 269, NULL, 1),
(49, 'CG', 'CONGO', 'Congo', 'COG', 178, 242, NULL, 1),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180, 242, NULL, 1),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184, 682, NULL, 1),
(52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188, 506, NULL, 1),
(53, 'CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', 384, 225, NULL, 1),
(54, 'HR', 'CROATIA', 'Croatia', 'HRV', 191, 385, NULL, 1),
(55, 'CU', 'CUBA', 'Cuba', 'CUB', 192, 53, NULL, 1),
(56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 196, 357, NULL, 1),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203, 420, 'DDP', 1),
(58, 'DK', 'DENMARK', 'Denmark', 'DNK', 208, 45, 'DDP', 1),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262, 253, NULL, 1),
(60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 212, 1767, NULL, 1),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214, 1809, NULL, 1),
(62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 218, 593, NULL, 1),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', 818, 20, NULL, 1),
(64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222, 503, NULL, 1),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226, 240, NULL, 1),
(66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 232, 291, NULL, 1),
(67, 'EE', 'ESTONIA', 'Estonia', 'EST', 233, 372, NULL, 1),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231, 251, NULL, 1),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238, 500, NULL, 1),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234, 298, NULL, 1),
(71, 'FJ', 'FIJI', 'Fiji', 'FJI', 242, 679, NULL, 1),
(72, 'FI', 'FINLAND', 'Finland', 'FIN', 246, 358, 'DDP', 1),
(73, 'FR', 'FRANCE', 'France', 'FRA', 250, 33, 'DDP', 1),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254, 594, NULL, 1),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258, 689, NULL, 1),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL, 0, NULL, 1),
(77, 'GA', 'GABON', 'Gabon', 'GAB', 266, 241, NULL, 1),
(78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 270, 220, NULL, 1),
(79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 268, 995, NULL, 1),
(80, 'DE', 'GERMANY', 'Germany', 'DEU', 276, 49, 'DDP', 1),
(81, 'GH', 'GHANA', 'Ghana', 'GHA', 288, 233, NULL, 1),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292, 350, NULL, 1),
(83, 'GR', 'GREECE', 'Greece', 'GRC', 300, 30, 'DDP', 1),
(84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 304, 299, NULL, 1),
(85, 'GD', 'GRENADA', 'Grenada', 'GRD', 308, 1473, NULL, 1),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312, 590, NULL, 1),
(87, 'GU', 'GUAM', 'Guam', 'GUM', 316, 1671, NULL, 1),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320, 502, NULL, 1),
(89, 'GN', 'GUINEA', 'Guinea', 'GIN', 324, 224, NULL, 1),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624, 245, NULL, 1),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', 328, 592, NULL, 1),
(92, 'HT', 'HAITI', 'Haiti', 'HTI', 332, 509, NULL, 1),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL, 0, NULL, 1),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336, 39, NULL, 1),
(95, 'HN', 'HONDURAS', 'Honduras', 'HND', 340, 504, NULL, 1),
(96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', 344, 852, 'DDP', 1),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 348, 36, 'DDP', 1),
(98, 'IS', 'ICELAND', 'Iceland', 'ISL', 352, 354, NULL, 1),
(99, 'IN', 'INDIA', 'India', 'IND', 356, 91, 'DAP', 1),
(100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 360, 62, NULL, 1),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364, 98, NULL, 1),
(102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 368, 964, NULL, 1),
(103, 'IE', 'IRELAND', 'Ireland', 'IRL', 372, 353, 'DDP', 1),
(104, 'IL', 'ISRAEL', 'Israel', 'ISR', 376, 972, NULL, 1),
(105, 'IT', 'ITALY', 'Italy', 'ITA', 380, 39, 'DDP', 1),
(106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 388, 1876, NULL, 1),
(107, 'JP', 'JAPAN', 'Japan', 'JPN', 392, 81, 'DAP', 1),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', 400, 962, NULL, 1),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398, 7, NULL, 1),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', 404, 254, NULL, 1),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296, 686, NULL, 1),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', 408, 850, 'DAP', 1),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82, 'DAP', 1),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965, NULL, 1),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996, NULL, 1),
(116, 'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', 418, 856, NULL, 1),
(117, 'LV', 'LATVIA', 'Latvia', 'LVA', 428, 371, 'DDP', 1),
(118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 422, 961, NULL, 1),
(119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 426, 266, NULL, 1),
(120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 430, 231, NULL, 1),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434, 218, NULL, 1),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438, 423, 'DAP', 1),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440, 370, NULL, 1),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442, 352, 'DDP', 1),
(125, 'MO', 'MACAO', 'Macao', 'MAC', 446, 853, NULL, 1),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807, 389, NULL, 1),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450, 261, NULL, 1),
(128, 'MW', 'MALAWI', 'Malawi', 'MWI', 454, 265, NULL, 1),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458, 60, 'DAP', 1),
(130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 462, 960, NULL, 1),
(131, 'ML', 'MALI', 'Mali', 'MLI', 466, 223, NULL, 1),
(132, 'MT', 'MALTA', 'Malta', 'MLT', 470, 356, NULL, 1),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584, 692, NULL, 1),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474, 596, NULL, 1),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478, 222, NULL, 1),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480, 230, NULL, 1),
(137, 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, 269, NULL, 1),
(138, 'MX', 'MEXICO', 'Mexico', 'MEX', 484, 52, 'DAP', 1),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583, 691, NULL, 1),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498, 373, NULL, 1),
(141, 'MC', 'MONACO', 'Monaco', 'MCO', 492, 377, 'DAP', 1),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496, 976, NULL, 1),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500, 1664, NULL, 1),
(144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 504, 212, NULL, 1),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508, 258, NULL, 1),
(146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 104, 95, NULL, 1),
(147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 516, 264, NULL, 1),
(148, 'NR', 'NAURU', 'Nauru', 'NRU', 520, 674, NULL, 1),
(149, 'NP', 'NEPAL', 'Nepal', 'NPL', 524, 977, NULL, 1),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528, 31, 'DDP', 1),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530, 599, NULL, 1),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540, 687, NULL, 1),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554, 64, 'DAP', 1),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558, 505, NULL, 1),
(155, 'NE', 'NIGER', 'Niger', 'NER', 562, 227, NULL, 1),
(156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 566, 234, NULL, 1),
(157, 'NU', 'NIUE', 'Niue', 'NIU', 570, 683, NULL, 1),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574, 672, NULL, 1),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580, 1670, NULL, 1),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', 578, 47, 'DAP', 1),
(161, 'OM', 'OMAN', 'Oman', 'OMN', 512, 968, NULL, 1),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586, 92, NULL, 1),
(163, 'PW', 'PALAU', 'Palau', 'PLW', 585, 680, NULL, 1),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL, 970, NULL, 1),
(165, 'PA', 'PANAMA', 'Panama', 'PAN', 591, 507, NULL, 1),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598, 675, NULL, 1),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600, 595, NULL, 1),
(168, 'PE', 'PERU', 'Peru', 'PER', 604, 51, NULL, 1),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608, 63, NULL, 1),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612, 0, NULL, 1),
(171, 'PL', 'POLAND', 'Poland', 'POL', 616, 48, 'DDP', 1),
(172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 620, 351, 'DDP', 1),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630, 1787, NULL, 1),
(174, 'QA', 'QATAR', 'Qatar', 'QAT', 634, 974, NULL, 1),
(175, 'RE', 'REUNION', 'Reunion', 'REU', 638, 262, NULL, 1),
(176, 'RO', 'ROMANIA', 'Romania', 'ROM', 642, 40, 'DDP', 1),
(177, 'RU', 'RUSSIA', 'Russia', 'RUS', 643, 70, 'DAP', 1),
(178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 646, 250, NULL, 1),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654, 290, NULL, 1),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659, 1869, NULL, 1),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662, 1758, NULL, 1),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666, 508, NULL, 1),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670, 1784, NULL, 1),
(184, 'WS', 'SAMOA', 'Samoa', 'WSM', 882, 684, NULL, 1),
(185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', 674, 378, NULL, 1),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678, 239, NULL, 1),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682, 966, NULL, 1),
(188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 686, 221, NULL, 1),
(189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL, 381, NULL, 1),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690, 248, NULL, 1),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694, 232, NULL, 1),
(192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 702, 65, 'DAP', 1),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703, 421, NULL, 1),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705, 386, NULL, 1),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90, 677, NULL, 1),
(196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 706, 252, NULL, 1),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710, 27, 'DAP', 1),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL, 0, NULL, 1),
(199, 'ES', 'SPAIN', 'Spain', 'ESP', 724, 34, 'DDP', 1),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144, 94, NULL, 1),
(201, 'SD', 'SUDAN', 'Sudan', 'SDN', 736, 249, NULL, 1),
(202, 'SR', 'SURINAME', 'Suriname', 'SUR', 740, 597, NULL, 1),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744, 47, NULL, 1),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748, 268, NULL, 1),
(205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 752, 46, 'DDP', 1),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756, 41, 'DAP', 1),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760, 963, NULL, 1),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158, 886, 'DAP', 1),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762, 992, NULL, 1),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834, 255, NULL, 1),
(211, 'TH', 'THAILAND', 'Thailand', 'THA', 764, 66, NULL, 1),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, 670, NULL, 1),
(213, 'TG', 'TOGO', 'Togo', 'TGO', 768, 228, NULL, 1),
(214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 772, 690, NULL, 1),
(215, 'TO', 'TONGA', 'Tonga', 'TON', 776, 676, NULL, 1),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780, 1868, NULL, 1),
(217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 788, 216, NULL, 1),
(218, 'TR', 'TURKEY', 'Turkey', 'TUR', 792, 90, 'DAP', 1),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795, 7370, NULL, 1),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796, 1649, NULL, 1),
(221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 798, 688, NULL, 1),
(222, 'UG', 'UGANDA', 'Uganda', 'UGA', 800, 256, NULL, 1),
(223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 804, 380, 'DAP', 1),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784, 971, 'DAP', 1),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826, 44, 'DAP', 1),
(226, 'US', 'UNITED STATES', 'United States', 'USA', 840, 1, 'DDP', 1),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL, 1, 'DDP', 1),
(228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 858, 598, NULL, 1),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860, 998, NULL, 1),
(230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 548, 678, NULL, 1),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862, 58, NULL, 1),
(232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', 704, 84, NULL, 1),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92, 1284, NULL, 1),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850, 1340, NULL, 1),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876, 681, NULL, 1),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732, 212, NULL, 1),
(237, 'YE', 'YEMEN', 'Yemen', 'YEM', 887, 967, NULL, 1),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894, 260, NULL, 1),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 5);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payout_to_therapist`
--

CREATE TABLE `payout_to_therapist` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL COMMENT 'user management	',
  `therapiest_id` int(11) NOT NULL COMMENT 'user management',
  `price` float(8,2) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payout_to_therapist`
--

INSERT INTO `payout_to_therapist` (`id`, `patient_id`, `therapiest_id`, `price`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 4, 3, 500.00, 1, '2022-04-07 14:29:29', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `providers`
--

CREATE TABLE `providers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `providers`
--

INSERT INTO `providers` (`id`, `name`, `flag`, `sku`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'fg', NULL, NULL, 'dfg', '2022-04-30 08:19:17', '2022-04-30 08:19:17');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2022-04-10 17:05:42', '2022-04-10 17:05:42'),
(2, 'Admin', 'web', '2022-04-10 17:05:42', '2022-04-10 17:05:42'),
(3, 'Therapiest', 'web', '2022-04-10 17:06:23', '2022-04-10 17:06:23'),
(4, 'HR', 'web', '2022-04-10 17:06:23', '2022-04-10 17:06:23'),
(5, 'Office Staff', 'web', '2022-04-10 17:07:34', '2022-04-10 17:07:34');

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
-- Table structure for table `therapy_type`
--

CREATE TABLE `therapy_type` (
  `id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL,
  `price` float(8,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `therapy_type`
--

INSERT INTO `therapy_type` (`id`, `type_name`, `price`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Phisical', 200.00, 3, '2022-04-29 12:51:41', 1, '2022-04-29 12:51:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobilenumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` tinyint(1) NOT NULL COMMENT '1.Super Admin 2.Admin 3.Therapist 4.HR 5. Office Staff 6.Patients	',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobilenumber`, `email`, `email_verified_at`, `password`, `user_type`, `address`, `city`, `state`, `pincode`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', '', 'superadmin@yopmail.com', NULL, '$2y$10$Lp92v.EEdhmoOh2ESDnSiOKmCu6qo1jWic4uZO5cLsrezttwZW28y', 1, NULL, NULL, NULL, NULL, NULL, '2022-04-07 03:57:58', '2022-04-07 03:57:58'),
(2, 'Admin', '', 'admin@yopmail.com', NULL, '$2y$10$uui1x8sw97vWVjnK4uweOOpumL44Pa9DwFhTbnYt7jl3ipzAPJbiS', 2, NULL, NULL, NULL, NULL, NULL, '2022-04-07 04:32:00', '2022-04-07 04:32:00'),
(3, 'Therapiest', '', 'therapiest@yopmail.com', NULL, '$2y$10$d2CXuB7DmtzrcSFZpQuKKeA6SCSt6NmgofpuyZHCMWwdcwWP9Ph8i', 3, NULL, NULL, NULL, NULL, NULL, '2022-04-07 04:32:49', '2022-04-07 04:32:49'),
(5, 'Vyom1', '', 'vyom@yopmail.com', NULL, '$2y$10$UIyqgV7hIiVdZEPJHj6.UeeZRR3Qpbk22jyopVQryvB/wCnxXJeIK', 0, NULL, NULL, NULL, NULL, NULL, '2022-04-10 14:16:23', '2022-04-30 15:33:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_patients_to_therapiest`
--
ALTER TABLE `assign_patients_to_therapiest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_prices_to_patients`
--
ALTER TABLE `assign_prices_to_patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_prices_to_therapiest`
--
ALTER TABLE `assign_prices_to_therapiest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_visit_attendence`
--
ALTER TABLE `daily_visit_attendence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `payout_to_therapist`
--
ALTER TABLE `payout_to_therapist`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `providers`
--
ALTER TABLE `providers`
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
-- Indexes for table `therapy_type`
--
ALTER TABLE `therapy_type`
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
-- AUTO_INCREMENT for table `assign_patients_to_therapiest`
--
ALTER TABLE `assign_patients_to_therapiest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assign_prices_to_patients`
--
ALTER TABLE `assign_prices_to_patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assign_prices_to_therapiest`
--
ALTER TABLE `assign_prices_to_therapiest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `daily_visit_attendence`
--
ALTER TABLE `daily_visit_attendence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

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
-- AUTO_INCREMENT for table `payout_to_therapist`
--
ALTER TABLE `payout_to_therapist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `providers`
--
ALTER TABLE `providers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `therapy_type`
--
ALTER TABLE `therapy_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
