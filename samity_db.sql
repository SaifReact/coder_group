-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2025 at 08:51 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `samity_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `banner_name_bn` varchar(255) NOT NULL,
  `banner_name_en` varchar(255) NOT NULL,
  `banner_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `banner_name_bn`, `banner_name_en`, `banner_image`, `created_at`) VALUES
(3, 'khgdgfdfyi8gk', 'hvdrghbhgdf', 'banner_1757953180_8834.jpg', '2025-09-06 02:07:54'),
(4, 'htrgefsdgnfdf', 'gfgsdgndsfdfs', 'banner_1757953172_3635.jpg', '2025-09-06 03:25:04'),
(6, 'jghgfhgfhg', 'vghfhgfhg', 'banner_1757953162_8655.jpg', '2025-09-06 03:30:27');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `company_name_bn` varchar(255) NOT NULL,
  `company_name_en` varchar(255) NOT NULL,
  `company_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_name_bn`, `company_name_en`, `company_image`, `created_at`) VALUES
(1, 'কোডার মার্ট ', 'Coder Mart', '1757955251_project-6.jpg', '2025-09-15 14:13:27'),
(2, 'কোডার স্টেশন', 'Coder Station', '1757955243_project-4.jpg', '2025-09-15 14:22:47'),
(3, 'কোডার ফিন্যান্স ', 'Coder Finance', '1757955233_project-5.jpg', '2025-09-15 14:23:33'),
(4, 'কোডার হজ & ওমরাহ', 'Coder Hajj & Umrah', '1757955217_project-3.jpg', '2025-09-15 14:24:31'),
(5, 'কোডার বিল্ডার্স ', 'Coder Builders', '1757955209_project-2.jpg', '2025-09-15 14:25:54'),
(6, 'কোডার ফাউন্ডেশন', 'Coder Foundation', '1757955200_project-1.jpg', '2025-09-15 14:27:27');

-- --------------------------------------------------------

--
-- Table structure for table `members_info`
--

CREATE TABLE `members_info` (
  `id` int(11) NOT NULL,
  `member_code` varchar(50) NOT NULL,
  `name_bn` varchar(100) DEFAULT NULL,
  `name_en` varchar(100) DEFAULT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `nid` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `marital_status` varchar(20) DEFAULT NULL,
  `spouse_name` varchar(100) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `education` varchar(100) DEFAULT NULL,
  `agreed_rules` tinyint(1) DEFAULT NULL,
  `profile_image` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members_info`
--

INSERT INTO `members_info` (`id`, `member_code`, `name_bn`, `name_en`, `father_name`, `mother_name`, `nid`, `dob`, `religion`, `marital_status`, `spouse_name`, `mobile`, `gender`, `education`, `agreed_rules`, `profile_image`, `created_at`) VALUES
(11, 'CPSS-00001', 'Md. Saifur Rahman', 'MD SAIFUR RAHMAN', 'MD. FAZLUL HOQUE MOLLAH', 'সেলিনা আক্তার', '2313515465465132654', '2000-01-15', 'ইসলাম', 'Single', '', '01540505646', 'Male', 'স্নাতক/সমমান', 1, 'user_images/member_CPSS-00001/profile_image_1755283690_689f80ead68f6.jpg', '2025-08-15 18:48:10'),
(18, 'CPSS-00012', 'MD. HASIBUZZAMAN', 'MD HASIBUZZAMAN', 'মোঃ ফজলুল হক মোল্লা', 'সেলিনা আক্তার', '1325116513156154614', '2000-01-01', 'ইসলাম', 'Single', '', '01540505646', 'Male', 'স্নাতক/সমমান', 1, 'user_images/member_CPSS-00012/profile_image_1755360508_68a0acfc03c4a.jpg', '2025-08-16 16:08:28'),
(19, 'CPSS-00019', 'banner_image', 'BANNER', 'dfdfsfdsdffd', 'banner_image', '2443343434324324343', '1995-09-05', 'ইসলাম', 'Single', '', '01829041699', 'Male', 'স্নাতক/সমমান', 1, 'user_images/member_CPSS-00019/profile_image_1757125258_68bb9a8aac62a.jpg', '2025-09-06 02:20:58');

-- --------------------------------------------------------

--
-- Table structure for table `member_documents`
--

CREATE TABLE `member_documents` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `member_code` varchar(32) NOT NULL,
  `doc_type` int(11) NOT NULL,
  `doc_path` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member_documents`
--

INSERT INTO `member_documents` (`id`, `member_id`, `member_code`, `doc_type`, `doc_path`, `created_at`) VALUES
(5, 11, 'CPSS-00001', 101, 'user_images/member_CPSS-00001/doc_101_1755359669_035d9087.jpg', '2025-08-16 21:54:29'),
(6, 11, 'CPSS-00001', 102, 'user_images/member_CPSS-00001/doc_102_1755359669_45d5598f.jpeg', '2025-08-16 21:54:29'),
(7, 11, 'CPSS-00001', 103, 'user_images/member_CPSS-00001/doc_103_1755359669_0ffb07b9.jpg', '2025-08-16 21:54:29'),
(9, 18, 'CPSS-00012', 101, 'user_images/member_CPSS-00012/doc_101_1755360614_786f8976.jpg', '2025-08-16 22:10:14'),
(10, 18, 'CPSS-00012', 102, 'user_images/member_CPSS-00012/doc_102_1755360614_53300a4e.jpg', '2025-08-16 22:10:14'),
(11, 18, 'CPSS-00012', 103, 'user_images/member_CPSS-00012/doc_103_1755360615_d0876e5a.jpg', '2025-08-16 22:10:15'),
(12, 18, 'CPSS-00012', 104, 'user_images/member_CPSS-00012/doc_104_1755360615_e550111b.jpg', '2025-08-16 22:10:15'),
(17, 11, 'CPSS-00001', 104, 'user_images/member_CPSS-00001/doc_104_1755957751_48d16bbf.png', '2025-08-23 07:02:31');

-- --------------------------------------------------------

--
-- Table structure for table `member_nominee`
--

CREATE TABLE `member_nominee` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `member_code` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `relation` varchar(50) NOT NULL,
  `nid` varchar(50) NOT NULL,
  `dob` datetime NOT NULL,
  `percentage` float NOT NULL,
  `nominee_image` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member_nominee`
--

INSERT INTO `member_nominee` (`id`, `member_id`, `member_code`, `name`, `relation`, `nid`, `dob`, `percentage`, `nominee_image`, `created_at`) VALUES
(11, 11, 'CPSS-00001', 'Md. Abrar Faiyaz', 'Son', '21654654546546546', '2025-08-03 00:00:00', 100, 'user_images/member_CPSS-00001/nominee_1_1755283690_689f80eaefa12.jpg', '0000-00-00 00:00:00'),
(18, 18, 'CPSS-00012', 'Md. Abrar Faiyaz', 'Son', '31565165651615615', '2022-05-18 00:00:00', 100, 'user_images/member_CPSS-00012/nominee_1_1755360508_68a0acfc5be1b.jpg', '0000-00-00 00:00:00'),
(19, 19, 'CPSS-00019', 'eeeeee', 'son', '43456464565446456', '2025-09-09 00:00:00', 50, 'user_images/member_CPSS-00019/nominee_1_1757125258_68bb9a8ab2e64.png', '0000-00-00 00:00:00'),
(20, 19, 'CPSS-00019', 'ettrytertj', 'wife', '66767866545686465', '2000-09-02 00:00:00', 50, 'user_images/member_CPSS-00019/nominee_2_1757125258_68bb9a8ab3404.jpg', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `member_office`
--

CREATE TABLE `member_office` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `member_code` varchar(50) NOT NULL,
  `office_name` varchar(100) NOT NULL,
  `office_address` text NOT NULL,
  `position` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member_office`
--

INSERT INTO `member_office` (`id`, `member_id`, `member_code`, `office_name`, `office_address`, `position`, `created_at`) VALUES
(11, 11, 'CPSS-00001', 'ইরা ইনফোটেক লিঃ', '10/A-3, BARDHAN BARI, WARD#09, DARUS SALAM THANA ROAD, MIRPUR-1', 'Senior Software Engineer', '2025-08-16 00:48:10'),
(18, 18, 'CPSS-00012', 'ইরা ইনফোটেক লিঃ', '217/1 3rd colony lalkuthi, Mirpur', 'Senior Software Engineer', '2025-08-16 22:08:28'),
(19, 19, 'CPSS-00019', 'সফল', 'fdgfgdfdfdfd', 'ffdfdfd', '2025-09-05 19:20:58');

-- --------------------------------------------------------

--
-- Table structure for table `member_payments`
--

CREATE TABLE `member_payments` (
  `id` bigint(20) NOT NULL,
  `member_id` bigint(20) NOT NULL,
  `member_code` varchar(50) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `bank_pay_date` date NOT NULL,
  `bank_trans_no` varchar(100) NOT NULL,
  `trans_no` varchar(100) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `payment_year` bigint(20) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `serial_no` int(11) DEFAULT NULL,
  `for_fees` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member_payments`
--

INSERT INTO `member_payments` (`id`, `member_id`, `member_code`, `payment_method`, `bank_pay_date`, `bank_trans_no`, `trans_no`, `amount`, `payment_year`, `created_at`, `created_by`, `serial_no`, `for_fees`) VALUES
(98, 11, 'CPSS-00001', 'admission', '2025-09-10', 'wertgh', 'TRadmission20251', '100.00', 2025, '2025-09-14 21:54:33', NULL, 1, 'idcard_fee'),
(99, 11, 'CPSS-00001', 'admission', '2025-09-10', 'wertgh', 'TRadmission20251', '100.00', 2025, '2025-09-14 21:54:33', NULL, 1, 'passbook_fee'),
(100, 11, 'CPSS-00001', 'admission', '2025-09-10', 'wertgh', 'TRadmission20251', '500.00', 2025, '2025-09-14 21:54:33', NULL, 1, 'other_fee'),
(101, 11, 'CPSS-00001', 'admission', '2025-09-10', 'wertgh', 'TRadmission20251', '300.00', 2025, '2025-09-14 21:54:33', NULL, 1, 'softuses_fee'),
(102, 11, 'CPSS-00001', 'admission', '2025-09-10', 'wertgh', 'TRadmission20251', '1500.00', 2025, '2025-09-14 21:54:33', NULL, 1, 'for_samity'),
(103, 11, 'CPSS-00001', 'admission', '2025-09-10', 'wertgh', 'TRadmission20251', '500.00', 2025, '2025-09-14 21:54:33', NULL, 1, 'cma'),
(104, 11, 'CPSS-00001', 'admission', '2025-09-10', 'wertgh', 'TRadmission20251', '500.00', 2025, '2025-09-14 21:54:33', NULL, 1, 'chb'),
(105, 11, 'CPSS-00001', 'admission', '2025-09-10', 'wertgh', 'TRadmission20251', '500.00', 2025, '2025-09-14 21:54:33', NULL, 1, 'cii'),
(106, 11, 'CPSS-00001', 'admission', '2025-09-10', 'wertgh', 'TRadmission20251', '500.00', 2025, '2025-09-14 21:54:33', NULL, 1, 'cht'),
(107, 11, 'CPSS-00001', 'admission', '2025-09-10', 'wertgh', 'TRadmission20251', '500.00', 2025, '2025-09-14 21:54:33', NULL, 1, 'cnf'),
(108, 11, 'CPSS-00001', 'january', '2025-09-11', 'TRFDERT', 'TRjanuary20251', '500.00', 2025, '2025-09-14 21:55:20', NULL, 1, 'for_install'),
(109, 11, 'CPSS-00001', 'january', '2025-09-11', 'TRFDERT', 'TRjanuary20251', '125.00', 2025, '2025-09-14 21:55:20', NULL, 1, 'other_fee'),
(110, 11, 'CPSS-00001', 'january', '2025-09-11', 'TRFDERT', 'TRjanuary20251', '750.00', 2025, '2025-09-14 21:55:20', NULL, 1, 'for_samity'),
(111, 11, 'CPSS-00001', 'january', '2025-09-11', 'TRFDERT', 'TRjanuary20251', '225.00', 2025, '2025-09-14 21:55:20', NULL, 1, 'cma'),
(112, 11, 'CPSS-00001', 'january', '2025-09-11', 'TRFDERT', 'TRjanuary20251', '225.00', 2025, '2025-09-14 21:55:20', NULL, 1, 'chb'),
(113, 11, 'CPSS-00001', 'january', '2025-09-11', 'TRFDERT', 'TRjanuary20251', '225.00', 2025, '2025-09-14 21:55:20', NULL, 1, 'cii'),
(114, 11, 'CPSS-00001', 'january', '2025-09-11', 'TRFDERT', 'TRjanuary20251', '225.00', 2025, '2025-09-14 21:55:20', NULL, 1, 'cht'),
(115, 11, 'CPSS-00001', 'january', '2025-09-11', 'TRFDERT', 'TRjanuary20251', '225.00', 2025, '2025-09-14 21:55:20', NULL, 1, 'cnf');

-- --------------------------------------------------------

--
-- Table structure for table `member_share`
--

CREATE TABLE `member_share` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `member_code` varchar(50) NOT NULL,
  `no_share` int(11) NOT NULL,
  `admission_fee` int(11) DEFAULT NULL,
  `idcard_fee` int(11) DEFAULT NULL,
  `passbook_fee` int(11) DEFAULT NULL,
  `softuses_fee` int(11) DEFAULT NULL,
  `for_samity` int(11) DEFAULT NULL,
  `cma` int(11) DEFAULT NULL,
  `chb` int(11) DEFAULT NULL,
  `cii` int(11) DEFAULT NULL,
  `cht` int(11) DEFAULT NULL,
  `cnf` int(11) DEFAULT NULL,
  `other_fee` int(11) DEFAULT NULL,
  `for_install` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member_share`
--

INSERT INTO `member_share` (`id`, `member_id`, `member_code`, `no_share`, `admission_fee`, `idcard_fee`, `passbook_fee`, `softuses_fee`, `for_samity`, `cma`, `chb`, `cii`, `cht`, `cnf`, `other_fee`, `for_install`, `created_at`) VALUES
(4, 11, 'CPSS-00001', 1, 5000, 100, 100, 300, 2250, 725, 725, 725, 725, 725, 625, 500, '2025-09-14 17:55:20'),
(9, 18, 'CPSS-00012', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 19, 'CPSS-00019', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `setup`
--

CREATE TABLE `setup` (
  `id` int(11) NOT NULL,
  `site_name_bn` varchar(255) NOT NULL,
  `site_name_en` varchar(255) NOT NULL,
  `registration_no` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone1` varchar(20) DEFAULT NULL,
  `phone2` varchar(20) DEFAULT NULL,
  `about_text` text DEFAULT NULL,
  `rules_regulation` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setup`
--

INSERT INTO `setup` (`id`, `site_name_bn`, `site_name_en`, `registration_no`, `address`, `email`, `phone1`, `phone2`, `about_text`, `rules_regulation`) VALUES
(1, 'কোডার পেশাজীবী সমবায় সমিতি লিঃ', 'Coder Peshajibi Samabay Samity Ltd.', '0000.0.00.0000.0000', '10/A-3, (7th Floor), Bardhan Bari, Darus Salam Thana, Mirpur-1, Dhaka-1216.', 'cpssl2023@gmail.com', '01540505646', '01829041699', '<p>Bangladesh</p>', '<p>Dhaka</p>');

-- --------------------------------------------------------

--
-- Table structure for table `user_access`
--

CREATE TABLE `user_access` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `member_id` int(11) NOT NULL,
  `login` datetime NOT NULL,
  `logout` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access`
--

INSERT INTO `user_access` (`id`, `user_id`, `member_id`, `login`, `logout`, `created_at`) VALUES
(1, '5', 11, '2025-08-16 01:00:27', '2025-08-16 01:01:48', '2025-08-16 01:00:27'),
(2, '5', 11, '2025-08-16 01:02:19', '2025-08-16 01:02:40', '2025-08-16 01:02:19'),
(3, '5', 11, '2025-08-16 01:16:08', '2025-08-16 01:21:12', '2025-08-16 01:16:08'),
(4, '5', 11, '2025-08-16 21:00:05', '2025-08-16 21:02:30', '2025-08-16 21:00:05'),
(5, '5', 11, '2025-08-16 21:02:36', '2025-08-16 21:33:30', '2025-08-16 21:02:36'),
(6, '5', 11, '2025-08-16 21:33:38', '2025-08-16 21:36:15', '2025-08-16 21:33:38'),
(7, '5', 11, '2025-08-16 21:36:23', '2025-08-16 21:42:06', '2025-08-16 21:36:23'),
(8, '5', 11, '2025-08-16 21:42:15', '2025-08-16 21:47:47', '2025-08-16 21:42:15'),
(9, '5', 11, '2025-08-16 21:47:54', '2025-08-16 21:48:42', '2025-08-16 21:47:54'),
(10, '5', 11, '2025-08-16 21:48:47', '2025-08-16 21:49:29', '2025-08-16 21:48:47'),
(11, '5', 11, '2025-08-16 21:49:37', '2025-08-16 21:50:46', '2025-08-16 21:49:37'),
(12, '5', 11, '2025-08-16 21:50:53', '2025-08-16 21:55:52', '2025-08-16 21:50:53'),
(13, '5', 11, '2025-08-16 21:55:59', '2025-08-16 21:58:14', '2025-08-16 21:55:59'),
(14, '10', 18, '2025-08-16 22:09:30', '2025-08-16 22:54:24', '2025-08-16 22:09:30'),
(15, '5', 11, '2025-08-16 23:12:29', '2025-08-16 23:21:24', '2025-08-16 23:12:29'),
(16, '5', 11, '2025-08-21 03:07:50', '2025-08-21 03:08:59', '2025-08-21 03:07:50'),
(17, '5', 11, '2025-08-21 03:10:58', '2025-08-21 03:11:04', '2025-08-21 03:10:58'),
(18, '5', 11, '2025-08-21 03:11:25', '2025-08-21 03:12:50', '2025-08-21 03:11:25'),
(19, '2', 0, '2025-08-21 03:13:18', '2025-08-21 03:13:38', '2025-08-21 03:13:18'),
(20, '2', 0, '2025-08-21 03:14:33', '0000-00-00 00:00:00', '2025-08-21 03:14:33'),
(21, '5', 11, '2025-08-21 03:25:52', '2025-08-21 03:27:01', '2025-08-21 03:25:52'),
(22, '5', 11, '2025-08-23 06:51:05', '2025-08-23 06:53:05', '2025-08-23 06:51:05'),
(23, '2', 0, '2025-08-23 06:53:55', '2025-08-23 06:54:11', '2025-08-23 06:53:55'),
(24, '5', 11, '2025-08-23 07:00:59', '2025-08-23 08:29:19', '2025-08-23 07:00:59'),
(25, '5', 11, '2025-08-23 08:29:27', '0000-00-00 00:00:00', '2025-08-23 08:29:27'),
(26, '5', 11, '2025-08-23 08:30:11', '2025-08-23 08:35:22', '2025-08-23 08:30:11'),
(27, '5', 11, '2025-08-23 08:35:28', '2025-08-23 08:40:14', '2025-08-23 08:35:28'),
(28, '5', 11, '2025-08-23 08:40:21', '2025-08-23 08:46:50', '2025-08-23 08:40:21'),
(29, '5', 11, '2025-08-23 08:47:01', '2025-08-23 08:51:14', '2025-08-23 08:47:01'),
(30, '2', 0, '2025-08-23 08:51:24', '2025-08-23 09:52:54', '2025-08-23 08:51:24'),
(31, '5', 11, '2025-08-23 09:53:01', '2025-08-23 09:54:27', '2025-08-23 09:53:01'),
(32, '2', 0, '2025-08-23 09:54:35', '2025-08-23 09:58:06', '2025-08-23 09:54:35'),
(33, '5', 11, '2025-08-23 09:58:14', '2025-08-23 09:59:01', '2025-08-23 09:58:14'),
(34, '5', 11, '2025-08-23 09:59:06', '2025-08-23 10:05:54', '2025-08-23 09:59:06'),
(35, '2', 0, '2025-08-23 10:06:00', '2025-08-23 10:07:25', '2025-08-23 10:06:00'),
(36, '2', 0, '2025-08-23 10:07:32', '2025-08-23 10:08:15', '2025-08-23 10:07:32'),
(37, '2', 0, '2025-08-23 10:08:22', '2025-08-23 10:08:25', '2025-08-23 10:08:22'),
(38, '2', 0, '2025-08-23 10:15:41', '0000-00-00 00:00:00', '2025-08-23 10:15:41'),
(39, '2', 0, '2025-08-23 10:17:05', '0000-00-00 00:00:00', '2025-08-23 10:17:05'),
(40, '2', 0, '2025-08-23 10:17:19', '0000-00-00 00:00:00', '2025-08-23 10:17:19'),
(41, '2', 0, '2025-08-29 19:58:19', '2025-08-29 20:04:37', '2025-08-29 19:58:19'),
(42, '2', 0, '2025-08-29 20:10:05', '2025-08-29 20:35:41', '2025-08-29 20:10:05'),
(43, '2', 0, '2025-08-29 20:35:47', '2025-08-29 20:47:42', '2025-08-29 20:35:47'),
(44, '2', 0, '2025-08-29 20:47:48', '2025-08-30 09:07:52', '2025-08-29 20:47:48'),
(45, '2', 0, '2025-09-04 02:19:46', '2025-09-04 02:23:10', '2025-09-04 02:19:46'),
(46, '5', 11, '2025-09-04 02:24:09', '2025-09-04 06:14:46', '2025-09-04 02:24:09'),
(47, '2', 0, '2025-09-04 06:14:55', '2025-09-04 06:15:50', '2025-09-04 06:14:55'),
(48, '5', 11, '2025-09-04 09:48:26', '2025-09-04 10:42:39', '2025-09-04 09:48:26'),
(49, '2', 0, '2025-09-05 18:40:02', '2025-09-05 19:18:58', '2025-09-05 18:40:02'),
(50, '2', 0, '2025-09-05 19:21:12', '2025-09-05 19:33:58', '2025-09-05 19:21:12'),
(51, '5', 11, '2025-09-05 19:34:05', '2025-09-05 19:34:09', '2025-09-05 19:34:05'),
(52, '2', 0, '2025-09-05 19:35:19', '0000-00-00 00:00:00', '2025-09-05 19:35:19'),
(53, '2', 0, '2025-09-13 21:02:04', '2025-09-13 21:18:06', '2025-09-13 21:02:04'),
(54, '5', 11, '2025-09-13 21:18:12', '0000-00-00 00:00:00', '2025-09-13 21:18:12'),
(55, '2', 0, '2025-09-14 03:50:56', '2025-09-14 03:51:04', '2025-09-14 03:50:56'),
(56, '5', 11, '2025-09-14 03:51:11', '2025-09-14 04:04:39', '2025-09-14 03:51:11'),
(57, '5', 11, '2025-09-14 20:51:12', '2025-09-14 21:07:16', '2025-09-14 20:51:12'),
(58, '2', 0, '2025-09-14 21:07:26', '2025-09-14 21:11:54', '2025-09-14 21:07:26'),
(59, '5', 11, '2025-09-14 21:12:04', '0000-00-00 00:00:00', '2025-09-14 21:12:04'),
(60, '2', 0, '2025-09-15 19:37:56', '2025-09-15 19:50:09', '2025-09-15 19:37:56'),
(61, '2', 0, '2025-09-15 19:50:19', '2025-09-15 20:28:14', '2025-09-15 19:50:19'),
(62, '2', 0, '2025-09-15 22:18:49', '0000-00-00 00:00:00', '2025-09-15 22:18:49');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `member_code` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `re_password` varchar(100) NOT NULL,
  `role` varchar(10) NOT NULL,
  `status` varchar(2) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `member_id`, `member_code`, `user_name`, `password`, `re_password`, `role`, `status`, `created_at`) VALUES
(2, 0, '', 'saifur', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'Admin', 'A', '2025-08-15 19:33:39'),
(5, 11, 'CPSS-00001', 'erasoft', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'user', 'A', '2025-08-16 00:48:10'),
(10, 18, 'CPSS-00012', '200000071938', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'user', 'I', '2025-08-16 22:08:28'),
(11, 19, 'CPSS-00019', 'maruf', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'user', 'R', '2025-09-05 19:20:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members_info`
--
ALTER TABLE `members_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_documents`
--
ALTER TABLE `member_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_nominee`
--
ALTER TABLE `member_nominee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_office`
--
ALTER TABLE `member_office`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_payments`
--
ALTER TABLE `member_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_share`
--
ALTER TABLE `member_share`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setup`
--
ALTER TABLE `setup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access`
--
ALTER TABLE `user_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `members_info`
--
ALTER TABLE `members_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `member_documents`
--
ALTER TABLE `member_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `member_nominee`
--
ALTER TABLE `member_nominee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `member_office`
--
ALTER TABLE `member_office`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `member_payments`
--
ALTER TABLE `member_payments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `member_share`
--
ALTER TABLE `member_share`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `setup`
--
ALTER TABLE `setup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_access`
--
ALTER TABLE `user_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
