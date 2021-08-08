-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 08, 2021 at 09:53 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `faraitfu_dc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `gmail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `passWithoutMD` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `phone`, `gmail`, `username`, `password`, `passWithoutMD`, `type`, `status`) VALUES
(1, 'raysa', '01234567891', 'raysa@gmail.com', 'raysa@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1234', 'Admin', ''),
(3, 'Ridoy Paul', '01627382866', 'cse.ridoypaul@gmail.com', 'cse.ridoypaul@gmail.com', '25d55ad283aa400af464c76d713c07ad', '12345678', 'CRM', 'SHOW'),
(4, 'DC', '01234567891', 'passport@gmail.com', 'passport@gmail.com', '5394410e0a114d3818390a662751b0b2', 'pass2021', 'Admin', '');

-- --------------------------------------------------------

--
-- Table structure for table `flightType`
--

CREATE TABLE `flightType` (
  `id` int(100) NOT NULL,
  `typeName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `flightType`
--

INSERT INTO `flightType` (`id`, `typeName`, `code`, `status`, `createdDate`) VALUES
(1, 'BIMAN BANGLADESH', 'BG', 'SHOW', '2021-04-04 07:08:37'),
(2, 'Emirates Airlines', 'EK', 'SHOW', '2021-04-04 08:39:35'),
(3, 'US Bangla Airlines', 'BS', 'SHOW', '2021-04-04 08:58:14'),
(4, 'NOVO Air', 'VQ', 'SHOW', '2021-04-04 08:58:34'),
(5, 'CATHAY PACIFIC', 'CX', 'SHOW', '2021-04-04 08:58:55'),
(6, 'Air India', 'AI', 'SHOW', '2021-04-04 08:59:09'),
(7, 'IndiGo', '6E', 'SHOW', '2021-04-04 08:59:28'),
(8, 'SpiceJet', 'SG', 'SHOW', '2021-04-04 08:59:47');

-- --------------------------------------------------------

--
-- Table structure for table `passportInfo`
--

CREATE TABLE `passportInfo` (
  `id` int(200) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sex` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `dateOfBirth` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nationality` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `passportNum` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `passportExpiryD` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `flightTypeCode` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `flightNum` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dateOfDeparture` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `addressInBDforF` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `visaNum` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `visaDateOfExpiry` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `typeOfVisa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `purposeOfVisit` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `print_price` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fullPassportNum` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `printBy` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `passportInfo`
--

INSERT INTO `passportInfo` (`id`, `name`, `sex`, `dateOfBirth`, `nationality`, `passportNum`, `passportExpiryD`, `flightTypeCode`, `flightNum`, `dateOfDeparture`, `addressInBDforF`, `visaNum`, `visaDateOfExpiry`, `typeOfVisa`, `purposeOfVisit`, `print_price`, `fullPassportNum`, `printBy`, `date`) VALUES
(10, 'MD AKIL AKHTAB SHAGOR', 'male', '1997-08-30', 'BGD', 'EB0873490', '2024-09-10', '0', '868686', '2021-01-19', ' no', '33333', '2021-01-26', 'fghfdgdf', 'dfgdfgdfgdf', '', '', '0', '2021-01-28'),
(21, 'RIDOY CHANDRA PAUL', 'male', '2021-01-31', 'BGD', 'Hg3442', '2021-01-31', '0', 'Df344', '2021-01-31', ' No', 'Hjh3345', '2021-01-31', 'Travel', 'Travel', '', '', '0', '2021-01-31'),
(22, 'TASLIMA AKTER LIMA', 'female', '1981-12-25', 'BGD', 'AG8148412', '2018-09-11', '0', 'bgd8876', '2021-02-01', ' no', 'GTT211', '2021-02-17', 'Traveling', 'Travel the World', '', '', '0', '2021-02-01'),
(23, 'MD AKIL AKHTAB SHAGOR', 'male', '1997-08-30', 'BGD', 'GB0873490', '2024-09-10', '0', 'BC445', '2021-02-02', ' no', 'GGbce', '2021-02-02', 'Traveling', 'Travel the World', '', '', '0', '2021-02-02'),
(24, 'RAYSA JERIN', 'female', '1995-04-29', 'BGD', 'NOTHING332', '2025-12-02', '0', 'HGRE32', '2022-07-03', ' N/A', 'GHJKY33', '2025-02-03', 'Traveling', 'Travel the World', '', '', '0', '2021-02-02'),
(25, 'MD AKIL AKHTAB SHAGOR', 'male', '1997-08-30', 'BGD', 'EB0873490', '2024-09-10', '0', 'sv803', '2021-02-27', ' N/A', '', '', '', '', '', '', '0', '2021-02-02'),
(26, 'MD SHAFI UDDIN', 'male', '1965-03-02', 'BGD', 'EF0921489', '2025-05-16', '0', 'ek406', '2021-02-04', ' N/A', 'gg56565', '2024-10-15', 'medical', 'mdical', '', '', '0', '2021-02-04'),
(27, 'Mohammed Murshed', 'male', '1946-04-20', 'BANGLADESH', 'BN0868492', '2022-04-05', '0', '6E 8296 ', '2021-02-09', ' N/A', 'VL5724217', '2021-04-19', 'MEDICAL', 'MEDICAL', '', '', '0', '2021-02-05'),
(28, 'Mst Jesmin', 'female', '1968-01-01', 'BANGLADESH', 'EF0806130', '2025-03-14', '0', '6E 8296 ', '2021-02-09', ' N/A', 'VL5765550', '2021-04-29', 'MEDICAL', 'MEDICAL', '', '', '0', '2021-02-05'),
(29, 'Salena Begum', 'female', '1955-06-05', 'BANGLADESH', 'BN0868694', '2022-04-05', '0', '6E 8296 ', '2021-02-09', ' N/A', 'VL5765325', '2021-04-29', 'MEDICAL', 'MEDICAL', '', '', '0', '2021-02-05'),
(30, 'Mohammad Mostafijur Rahman', 'female', '1980-06-02', 'BANGLADESH', 'BN0867664', '2022-04-05', '0', '6E 8296 ', '2021-02-09', '', 'VL5724218', '2021-04-19', 'MEDICAL', 'MEDICAL', '', '', '0', '2021-02-05'),
(31, 'Abul Mia ', 'male', '1997-11-12', 'BGD', 'BE4521368', '2021-02-26', '0', 'SV805', '2021-02-06', 'N/A', 'NA', '2021-02-19', 'Tour', 'Tour', '', '', '0', '2021-02-06'),
(32, 'Abul Mia ', 'male', '1997-11-12', 'BGD', 'BE4521368', '2021-02-26', '0', 'SV8050', '2021-02-06', 'N/A', 'NA253645225522255', '2021-02-19', 'Tour', 'Tour', '', '', '0', '2021-02-06'),
(33, 'Abul Mia ', 'male', '1997-11-12', 'BGD', 'BE4521368', '2021-02-26', '0', 'SV80505', '2021-02-06', '', '251425636', '2021-02-19', 'Tour', 'Tour', '', '', '0', '2021-02-06'),
(34, 'Abul Mia ', 'male', '1997-11-12', 'BGD', 'BE4521368', '2021-02-26', '0', 'QR2520x', '2021-02-06', '', '251425636', '2021-02-19', 'Tour', 'Tour', '', '', '0', '2021-02-06'),
(35, 'Abul Mia ', 'male', '1997-11-12', 'BGD', 'BE4521368', '2021-02-26', '0', 'QR25205', '2021-02-06', '', '123456789', '2021-02-19', 'Tour', 'Tour', '10', '', '0', '2021-02-06'),
(36, 'Abul Mia ', 'male', '1997-11-12', 'BGD', 'BE4521368', '2021-02-26', '0', 'QR25205', '2021-02-06', '', '123456', '2021-02-19', 'Tour', 'Tour', '10', '', '0', '2021-02-06'),
(37, 'Abul Mia ', 'male', '1997-11-12', 'BGD', 'BE4521368', '2021-02-26', '0', 'QR25205', '2021-02-06', '', '123456', '2021-02-19', 'Tour', 'Tour', '10', '', '0', '2021-02-06'),
(38, 'ZIAUL QUDDUS', 'male', '1954-12-03', 'BGD', 'B00022579', '2026-02-28', '0', 'fs52', '2021-03-31', ' ', '2155', '2021-04-07', 'Tourist visa', 'kjglg', '10', '', '0', '2021-03-31'),
(39, 'ALEKSEY                         LOMAKO', 'male', '1983-01-17', 'KGZ', 'AC1749459', '2025-10-29', 'BG', '8825577B', '2021-04-04', ' Null', '55554', '2021-04-28', 'Tourist visa', 'VISITING', '10', 'Null', 'Admin', '2021-04-04'),
(40, 'ALEKSEY                         LOMAKO', 'male', '1983-01-17', 'KGZ', 'AC1749459', '2025-10-29', 'BG', 'AB8899', '2021-04-04', ' Lotas Hotel', '454545', '2021-04-29', 'Tourist visa', 'STUDENT', '10', 'P<KGZLOMAKO<<ALEKSEY<<<<<<<<<<<<<<<<<<<<<<< AC17494593KGZ8301174M25102952170119831554749', 'Admin', '2021-04-04'),
(41, 'ALEKSEY                         LOMAKO', 'male', '1983-01-17', 'KGZ', 'AC1749459', '2025-10-29', 'EK', 'AB55344', '2021-04-04', 'werwefsdfsdfsdfsfsdfsd', '55554', '2021-04-28', 'Tourist visa', 'VISITING', '10', 'P<KGZLOMAKO<<ALEKSEY<<<<<<<<<<<<<<<<<<<<<<< AC17494593KGZ8301174M25102952170119831554749', '3', '2021-04-04'),
(42, 'ALEKSEY                         LOMAKO', 'male', '1983-01-17', 'KGZ', 'AC1749459', '2025-10-29', 'AI', '45345345', '2021-04-04', ' no', '8888', '2021-04-29', 'Medical visa', '', '10', 'P<KGZLOMAKO<<ALEKSEY<<<<<<<<<<<<<<<<<<<<<<< AC17494593KGZ8301174M25102952170119831554749', '3', '2021-04-04'),
(43, 'AL AMIN MIAH', 'male', '1989-03-01', 'BGD', 'BJ0501252', '2020-12-06', 'EK', '052', '2021-04-10', ' ', 'HGJ35435', '2021-04-21', 'Work visa', 'JOB', '10', 'P<BGDMIAH<<AL<AMIN<<<<<<<<<<<<<<<<<<<<<<<<<<BJ05012521BGD8903015M2012065<<<<<<<<<<<<<<02', 'Admin', '2021-04-10'),
(44, 'AL AMIN MIAH', 'male', '1989-03-01', 'BGD', 'BJ0501252', '2020-12-06', 'Select Flight Type', 'ak456', '2021-04-10', ' ', 'Ak-56565', '2021-04-21', 'Medical visa', 'medical', '10', 'P<BGDMIAH<<AL<AMIN<<<<<<<<<<<<<<<<<<<<<<<<<<BJ05012521BGD8903015M2012065<<<<<<<<<<<<<<02', 'Admin', '2021-04-10'),
(45, 'AL AMIN MIAH', 'male', '1989-03-01', 'BGD', 'BJ0501252', '2020-12-06', 'SG', '098', '2021-04-10', ' ', 'Ak-56565', '2021-04-13', 'Medical visa', 'medical', '10', 'P<BGDMIAH<<AL<AMIN<<<<<<<<<<<<<<<<<<<<<<<<<<BJ05012521BGD8903015M2012065<<<<<<<<<<<<<<02', 'Admin', '2021-04-10'),
(46, 'MOHAMMED MIZAN MIAH', 'male', '1991-03-02', 'BGD', 'A00575576', '2031-03-22', 'BG', '027', '2021-04-10', ' ', '', '', 'Select Visa Type', '', '10', 'P<BGDMIAH<<MOHAMMED<MIZAN<<<<<<<<<<<<<<<<<<<A005755763BGD9103029M31032235112064976<<<<34', 'Admin', '2021-04-10'),
(47, '                           SALAUDDIN', 'male', '1981-04-24', 'BGD', 'BM0730082', '2021-12-04', 'SG', '077', '2021-04-10', ' gazipur, dhaka', '', '', 'Select Visa Type', '', '10', 'P<BGDSALAUDDIN<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<BM07300827BGD8104247M21120461913621828849<68', 'Admin', '2021-04-10'),
(48, 'AL AMIN MIAH', 'male', '1989-03-01', 'BGD', 'BJ0501252', '2020-12-06', 'EK', '098', '2021-04-10', ' ', '', '', 'Select Visa Type', '', '10', 'P<BGDMIAH<<AL<AMIN<<<<<<<<<<<<<<<<<<<<<<<<<<BJ05012521BGD8903015M2012065<<<<<<<<<<<<<<02', 'Admin', '2021-04-10'),
(49, 'AL AMIN MIAH', 'male', '1989-03-01', 'BGD', 'BJ0501252', '2020-12-06', '6E', '8296', '2021-04-10', ' uttara', '', '', 'Select Visa Type', '', '10', 'P<BGDMIAH<<AL<AMIN<<<<<<<<<<<<<<<<<<<<<<<<<<BJ05012521BGD8903015M2012065<<<<<<<<<<<<<<02', 'Admin', '2021-04-10'),
(50, 'AL AMIN MIAH', 'male', '1989-03-01', 'BGD', 'BJ0501252', '2020-12-06', '6E', '8294', '2021-04-10', ' uttara', '', '', 'Select Visa Type', '', '10', 'P<BGDMIAH<<AL<AMIN<<<<<<<<<<<<<<<<<<<<<<<<<<BJ05012521BGD8903015M2012065<<<<<<<<<<<<<<02', 'Admin', '2021-04-10'),
(51, 'AL AMIN MIAH', 'male', '1989-03-01', 'BGD', 'BJ0501252', '2020-12-06', 'SG', '44', '2021-04-10', ' dhaka', '', '', 'Select Visa Type', '', '10', 'P<BGDMIAH<<AL<AMIN<<<<<<<<<<<<<<<<<<<<<<<<<<BJ05012521BGD8903015M2012065<<<<<<<<<<<<<<02', 'Admin', '2021-04-10'),
(52, 'AL AMIN MIAH', 'male', '1989-03-01', 'BGD', 'BJ0501252', '2020-12-06', '6E', '8296', '2021-04-10', ' dhaka', '', '', 'Select Visa Type', '', '10', 'P*BGDMIAH<<AL<AMIN<<<<<<<<<<<<<<<<<<<<<<<<<<BJ05012521BGD8903015M2012065<<<<<<<<<<<<<<02', 'Admin', '2021-04-10');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(100) NOT NULL,
  `cardCharge` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `cardCharge`, `date`) VALUES
(1, '10', '2021-04-03 08:58:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flightType`
--
ALTER TABLE `flightType`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `passportInfo`
--
ALTER TABLE `passportInfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `flightType`
--
ALTER TABLE `flightType`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `passportInfo`
--
ALTER TABLE `passportInfo`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
