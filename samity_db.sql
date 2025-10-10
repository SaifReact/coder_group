-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2025 at 10:18 PM
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `banner_category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `banner_name_bn`, `banner_name_en`, `banner_image`, `created_at`, `banner_category`) VALUES
(1, 'ব্যানার-১', 'Banner-1', 'banner_1760121722_5628.jpg', '2025-09-20 17:33:14', 'ban'),
(2, 'ব্যানার-২', 'Banner-2', 'banner_1759411483_5300.jpg', '2025-09-06 03:30:27', 'ban'),
(3, 'ব্যানার-৩', 'Banner-3', 'banner_1759411507_3439.jpg', '2025-09-06 02:07:54', 'ban'),
(4, 'ব্যানার-৪', 'Banner-4', 'banner_1759411534_5124.png', '2025-10-02 13:25:34', 'ban');

-- --------------------------------------------------------

--
-- Table structure for table `committee_member`
--

CREATE TABLE `committee_member` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `member_code` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `li` varchar(100) NOT NULL,
  `role` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `committee_member`
--

INSERT INTO `committee_member` (`id`, `member_id`, `member_code`, `position`, `fb`, `li`, `role`, `created_at`) VALUES
(4, 20, '', 'president', 'facebook', 'linkedin', 'Entrepreneur', NULL),
(5, 11, 'CPSS-00001', 'Advisor', 'facebook', 'linkedin', 'Entrepreneur', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `company_name_bn` varchar(255) NOT NULL,
  `company_name_en` varchar(255) NOT NULL,
  `company_image` varchar(255) NOT NULL,
  `about_company` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_name_bn`, `company_name_en`, `company_image`, `about_company`, `created_at`) VALUES
(8, 'কোডার ফিন্যান্স', 'Coder Finance', '1760107958_Finance.jpg', '<p>কোডার পেশাজীবী সমবায় সমিতি লিঃ নিজস্ব পরিচালিত প্রজেক্ট হলো কোডার সঞ্চয় ও ঋন এর ফিন্যান্স প্রজেক্টটি।</p><ul><li>সদস্যদের সঞ্চয়কৃত আমানত সমিতির নামে ইসলামিক হিসাব নম্বরে সঞ্চয় করা।&nbsp;</li><li>স্বল্প সার্ভিস চার্জে সদস্যদের ঋন সুবিধা প্রদান করা।</li><li>সঞ্চয়কৃত আমানত নির্ধারিত বিভিন্ন প্রজেক্ট এ বিনিয়োগ করে ব্যবসা পরিচালনা করা।</li></ul>', '2025-10-02 19:07:40'),
(9, 'কোডার হোমস ও বিল্ডার্স', 'Coder Homes & Builders', '1759410595_building.JPG', '<ul><li>আবাসিক ও বানিজ্যিক প্রকল্পে (ফ্ল্যাট, জমি) ক্রয় করে বিনিয়োগ করা।</li><li>সদস্যদের মাঝে স্বল্প সার্ভিস চার্জে বসতবাড়ি অথবা জায়গা ডেভেলপ করা।</li><li>নতুন বাজারে রিয়েল এস্টেট ব্যবসার আধুনিকতা সৃষ্টি করা।</li></ul>', '2025-10-02 19:09:55'),
(10, 'কোডার মার্ট ও এগ্রো', 'Coder Mart & Agro', '1759410688_ghee-honey.jpg', '<ul><li>সদস্য বা গ্রাহকদের মাসিক ও সাপ্তাহিক বাজার প্যাকেজ হোম ডেলিভারী ব্যবস্থা গ্রহন করা।</li><li>অরগানিক ও কৃষি ও খুচরা পণ্য সরবারহ চেইন সম্প্রসারন করা।</li><li>স্থানীয় চাষী ও সাপ্লায়দের সাথে অংশীদারিত্ব বৃদ্ধি করা।</li></ul>', '2025-10-02 19:11:28'),
(11, 'কোডার আইটি ও ইনস্টিটিউট', 'Coder IT & Institute', '1759410837_it.jpg', '<ul><li>সফটওয়্যার সেবা, আইটি কনসালটিং ও আউটসোসিং থেকে আয় করা।</li><li>সদস্যদের মাঝে আধুুনিক আইটি ট্রেনিং এর ব্যবস্থা করা।</li><li>সার্টিফিকেশন কোর্স চালু করা, যা সদস্য ও অনলাইন-অফলাইন শিক্ষার্থীদের আইটি নির্ভর করা।</li></ul>', '2025-10-02 19:13:57'),
(12, 'কোডার হজ্জ্ব ও ওমরাহ্', 'Coder Hajj & Umrah', '1759410941_hijaz-umrah.png', '<ul><li>সদস্যদের ইএমআই ভিত্তিতে মানসম্মত হজ্জ্ব ও ওমরাহ্ প্যাকেজ ব্যবস্থা গ্রহন করা।</li><li>সরাসরি ভ্রমন এজেন্সী ও ধর্মীয় প্রতিষ্ঠানের সাথে অংশীদারিত্ব করা।</li><li>গ্রাহক-বিস্তারিত সার্ভিস এবং ভ্রমনপূর্বক নির্দেশিকা প্রদান।</li></ul>', '2025-10-02 19:15:41'),
(13, 'কোডার ফাউন্ডেশন', 'Coder Foundation', '1759411020_foundation.jpg', '<ul><li>সমাজকল্যান মূলক কার্যক্রম (শিক্ষা, স্বাস্থ্য ও দাতব্য) চালু করা।</li><li>সম্প্রদায়ের সাথে দৃঢ় সম্পর্ক তৈরি করা।</li><li>দাতব্য অনুদান ও সামাজিক প্রকল্প থেকে টেকসই অর্থায়ন।</li></ul>', '2025-10-02 19:17:00');

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
(19, 'CPSS-00019', 'banner_image', 'BANNER', 'dfdfsfdsdffd', 'banner_image', '2443343434324324343', '1995-09-05', 'ইসলাম', 'Single', '', '01829041699', 'Male', 'স্নাতক/সমমান', 1, 'user_images/member_CPSS-00019/profile_image_1757125258_68bb9a8aac62a.jpg', '2025-09-06 02:20:58'),
(20, 'CPSS-00020', 'Dalim', 'FGDFDGFFG', 'ghjjhjh', 'jhjgjg', '3434343234354343243', '2000-09-11', 'ইসলাম', 'Single', '', '01829041699', 'Male', 'স্নাতক/সমমান', 1, 'user_images/member_CPSS-00020/profile_image_1758389895_68cee6876d017.jpg', '2025-09-20 17:38:15');

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
(17, 11, 'CPSS-00001', 104, 'user_images/member_CPSS-00001/doc_104_1755957751_48d16bbf.png', '2025-08-23 07:02:31'),
(18, 20, 'CPSS-00020', 101, 'user_images/member_CPSS-00020/doc_101_1759257825_4baeb0a3.png', '2025-10-01 00:43:45'),
(19, 20, 'CPSS-00020', 102, 'user_images/member_CPSS-00020/doc_102_1759426281_501be913.jpg', '2025-10-02 23:31:21'),
(20, 20, 'CPSS-00020', 103, 'user_images/member_CPSS-00020/doc_103_1759426755_9472d839.jpg', '2025-10-02 23:39:15');

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
(20, 19, 'CPSS-00019', 'ettrytertj', 'wife', '66767866545686465', '2000-09-02 00:00:00', 50, 'user_images/member_CPSS-00019/nominee_2_1757125258_68bb9a8ab3404.jpg', '0000-00-00 00:00:00'),
(21, 20, 'CPSS-00020', 'dauha', 'son', '32555765454774545', '2025-09-17 00:00:00', 100, 'user_images/member_CPSS-00020/nominee_1_1758389895_68cee68770e07.png', '0000-00-00 00:00:00');

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
(19, 19, 'CPSS-00019', 'সফল', 'fdgfgdfdfdfd', 'ffdfdfd', '2025-09-05 19:20:58'),
(20, 20, 'CPSS-00020', 'fghhgfhfgfhg', 'hgfhgfhgfhfhgfhgf', 'hfghffhghfg', '2025-09-20 23:38:15');

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
(115, 11, 'CPSS-00001', 'january', '2025-09-11', 'TRFDERT', 'TRjanuary20251', '225.00', 2025, '2025-09-14 21:55:20', NULL, 1, 'cnf'),
(116, 20, 'CPSS-00020', 'admission', '2025-09-29', 'tttt', 'TRadmission20251', '200.00', 2025, '2025-10-01 00:44:11', NULL, 1, 'idcard_fee'),
(117, 20, 'CPSS-00020', 'admission', '2025-09-29', 'tttt', 'TRadmission20251', '200.00', 2025, '2025-10-01 00:44:11', NULL, 1, 'passbook_fee'),
(118, 20, 'CPSS-00020', 'admission', '2025-09-29', 'tttt', 'TRadmission20251', '1000.00', 2025, '2025-10-01 00:44:11', NULL, 1, 'other_fee'),
(119, 20, 'CPSS-00020', 'admission', '2025-09-29', 'tttt', 'TRadmission20251', '600.00', 2025, '2025-10-01 00:44:11', NULL, 1, 'softuses_fee'),
(120, 20, 'CPSS-00020', 'admission', '2025-09-29', 'tttt', 'TRadmission20251', '3000.00', 2025, '2025-10-01 00:44:11', NULL, 1, 'for_samity'),
(121, 20, 'CPSS-00020', 'admission', '2025-09-29', 'tttt', 'TRadmission20251', '1000.00', 2025, '2025-10-01 00:44:11', NULL, 1, 'cma'),
(122, 20, 'CPSS-00020', 'admission', '2025-09-29', 'tttt', 'TRadmission20251', '1000.00', 2025, '2025-10-01 00:44:11', NULL, 1, 'chb'),
(123, 20, 'CPSS-00020', 'admission', '2025-09-29', 'tttt', 'TRadmission20251', '1000.00', 2025, '2025-10-01 00:44:11', NULL, 1, 'cii'),
(124, 20, 'CPSS-00020', 'admission', '2025-09-29', 'tttt', 'TRadmission20251', '1000.00', 2025, '2025-10-01 00:44:11', NULL, 1, 'cht'),
(125, 20, 'CPSS-00020', 'admission', '2025-09-29', 'tttt', 'TRadmission20251', '1000.00', 2025, '2025-10-01 00:44:11', NULL, 1, 'cnf'),
(126, 20, 'CPSS-00020', 'january', '2025-10-01', '44545434', 'TRjanuary20251', '500.00', 2025, '2025-10-01 00:44:47', NULL, 1, 'for_install'),
(127, 20, 'CPSS-00020', 'january', '2025-10-01', '44545434', 'TRjanuary20251', '125.00', 2025, '2025-10-01 00:44:47', NULL, 1, 'other_fee'),
(128, 20, 'CPSS-00020', 'january', '2025-10-01', '44545434', 'TRjanuary20251', '750.00', 2025, '2025-10-01 00:44:47', NULL, 1, 'for_samity'),
(129, 20, 'CPSS-00020', 'january', '2025-10-01', '44545434', 'TRjanuary20251', '225.00', 2025, '2025-10-01 00:44:47', NULL, 1, 'cma'),
(130, 20, 'CPSS-00020', 'january', '2025-10-01', '44545434', 'TRjanuary20251', '225.00', 2025, '2025-10-01 00:44:47', NULL, 1, 'chb'),
(131, 20, 'CPSS-00020', 'january', '2025-10-01', '44545434', 'TRjanuary20251', '225.00', 2025, '2025-10-01 00:44:47', NULL, 1, 'cii'),
(132, 20, 'CPSS-00020', 'january', '2025-10-01', '44545434', 'TRjanuary20251', '225.00', 2025, '2025-10-01 00:44:47', NULL, 1, 'cht'),
(133, 20, 'CPSS-00020', 'january', '2025-10-01', '44545434', 'TRjanuary20251', '225.00', 2025, '2025-10-01 00:44:47', NULL, 1, 'cnf'),
(134, 20, 'CPSS-00020', 'january', '2025-10-01', 'bjhghg', 'TRjanuary20251', '500.00', 2025, '2025-10-01 00:47:29', NULL, 1, 'for_install'),
(135, 20, 'CPSS-00020', 'january', '2025-10-01', 'bjhghg', 'TRjanuary20251', '125.00', 2025, '2025-10-01 00:47:29', NULL, 1, 'other_fee'),
(136, 20, 'CPSS-00020', 'january', '2025-10-01', 'bjhghg', 'TRjanuary20251', '750.00', 2025, '2025-10-01 00:47:29', NULL, 1, 'for_samity'),
(137, 20, 'CPSS-00020', 'january', '2025-10-01', 'bjhghg', 'TRjanuary20251', '225.00', 2025, '2025-10-01 00:47:29', NULL, 1, 'cma'),
(138, 20, 'CPSS-00020', 'january', '2025-10-01', 'bjhghg', 'TRjanuary20251', '225.00', 2025, '2025-10-01 00:47:29', NULL, 1, 'chb'),
(139, 20, 'CPSS-00020', 'january', '2025-10-01', 'bjhghg', 'TRjanuary20251', '225.00', 2025, '2025-10-01 00:47:29', NULL, 1, 'cii'),
(140, 20, 'CPSS-00020', 'january', '2025-10-01', 'bjhghg', 'TRjanuary20251', '225.00', 2025, '2025-10-01 00:47:29', NULL, 1, 'cht'),
(141, 20, 'CPSS-00020', 'january', '2025-10-01', 'bjhghg', 'TRjanuary20251', '225.00', 2025, '2025-10-01 00:47:29', NULL, 1, 'cnf'),
(142, 20, 'CPSS-00020', 'february', '2025-10-01', '54165965', 'TRfebruary20251', '1000.00', 2025, '2025-10-02 23:20:33', NULL, 1, 'for_install'),
(143, 20, 'CPSS-00020', 'february', '2025-10-01', '54165965', 'TRfebruary20251', '250.00', 2025, '2025-10-02 23:20:33', NULL, 1, 'other_fee'),
(144, 20, 'CPSS-00020', 'february', '2025-10-01', '54165965', 'TRfebruary20251', '1500.00', 2025, '2025-10-02 23:20:33', NULL, 1, 'for_samity'),
(145, 20, 'CPSS-00020', 'february', '2025-10-01', '54165965', 'TRfebruary20251', '450.00', 2025, '2025-10-02 23:20:33', NULL, 1, 'cma'),
(146, 20, 'CPSS-00020', 'february', '2025-10-01', '54165965', 'TRfebruary20251', '450.00', 2025, '2025-10-02 23:20:33', NULL, 1, 'chb'),
(147, 20, 'CPSS-00020', 'february', '2025-10-01', '54165965', 'TRfebruary20251', '450.00', 2025, '2025-10-02 23:20:33', NULL, 1, 'cii'),
(148, 20, 'CPSS-00020', 'february', '2025-10-01', '54165965', 'TRfebruary20251', '450.00', 2025, '2025-10-02 23:20:33', NULL, 1, 'cht'),
(149, 20, 'CPSS-00020', 'february', '2025-10-01', '54165965', 'TRfebruary20251', '450.00', 2025, '2025-10-02 23:20:33', NULL, 1, 'cnf');

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
(10, 19, 'CPSS-00019', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 20, 'CPSS-00020', 2, 10000, 200, 200, 600, 6000, 1900, 1900, 1900, 1900, 1900, 1500, 2000, '2025-10-02 19:20:33');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `service_name_bn` text NOT NULL,
  `service_name_en` text NOT NULL,
  `about_service` text NOT NULL,
  `icon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_name_bn`, `service_name_en`, `about_service`, `icon`) VALUES
(4, 'পেশাজীবী সদস্যভুক্তি', 'Professional Membership', '<ul><li>Inclusion of professional as members in the cooperative ( পেশাজীবীদের সমবায়ে সদস্য হিসেবে অন্তর্ভুক্ত করা )</li><li>Identity card/database management for members ( সদস্যদের জন্য পরিচয়পত্র/ডাটাবেস ব্যবস্থাপনা )</li></ul>', 'fa-user'),
(5, 'প্রশিক্ষণ ও দক্ষতা উন্নয়ন', 'Training & Skill Development', '<ul><li>Training in web development, app development, graphics, cyber security etc ( ওয়েব ডেভেলপমেন্ট, অ্যাপ ডেভেলপমেন্ট, গ্রাফিক্স, সাইবার সিকিউরিটি ইত্যাদি বিষয়ে প্রশিক্ষণ )</li><li>Organizing workshops, seminars &amp; hackathons ( ওয়ার্কশপ, সেমিনার ও হ্যাকাথন আয়োজন )</li></ul>', 'fa-pencil-ruler'),
(6, 'ক্যারিয়ার সাপোর্ট', 'Career Support', '<ul><li>Creating opportunities to get work in local and international markets ( স্থানীয় ও আন্তর্জাতিক মার্কেটে কাজ পাওয়ার সুযোগ সৃষ্টি )</li><li>Freelancing and Outsourcing Guidelines ( ফ্রিল্যান্সিং ও আউটসোর্সিং গাইডলাইন )</li></ul>', 'fa-check'),
(7, 'আর্থিক সাপোর্ট', 'Financial Support', '<ul><li>Savings, loans and investment opportunities for members ( সদস্যদের জন্য সঞ্চয়, ঋণ ও বিনিয়োগ সুযোগ )</li><li>Investment or lending in technology-based startups ( প্রযুক্তিভিত্তিক স্টার্টআপে বিনিয়োগ বা ঋণ প্রদান )</li></ul>', 'fa-hand-holding-usd'),
(8, 'সমবায়ভিত্তিক প্রজেক্ট', 'Cooperative Projects', '<ul><li>Opportunity to work in teams on large projects ( বড় প্রজেক্টে টিম তৈরি করে কাজ করার সুযোগ )</li><li>Income sharing policy among members ( সদস্যদের মধ্যে আয়ের ভাগাভাগি নীতি )</li></ul>', 'fa-tasks'),
(10, 'কল্যাণমূলক কার্যক্রম', 'Welfare Activities', '<ul><li>Financial assistance to members in times of need ( সদস্যদের জরুরি সময়ে আর্থিক সাহায্য )</li><li>Health, education and social development initiatives ( স্বাস্থ্য, শিক্ষা ও সামাজিক উন্নয়নমূলক উদ্যোগ )</li></ul>', 'fa-smile');

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
  `about_text_en` text DEFAULT NULL,
  `slogan_bn` text DEFAULT NULL,
  `slogan_en` text DEFAULT NULL,
  `smart_bn` text DEFAULT NULL,
  `smart_en` text DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `objectives` text DEFAULT NULL,
  `facebook` text DEFAULT NULL,
  `youtube` text DEFAULT NULL,
  `linkedin` text DEFAULT NULL,
  `instagram` text DEFAULT NULL,
  `twitter` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setup`
--

INSERT INTO `setup` (`id`, `site_name_bn`, `site_name_en`, `registration_no`, `address`, `email`, `phone1`, `phone2`, `about_text`, `about_text_en`, `slogan_bn`, `slogan_en`, `smart_bn`, `smart_en`, `logo`, `objectives`, `facebook`, `youtube`, `linkedin`, `instagram`, `twitter`) VALUES
(1, 'কোডার পেশাজীবী সমবায় সমিতি লিঃ', 'Coder Peshajibi Samabay Samity Ltd.', '২৫৫৩৫৮', '10/A-3, (7th Floor), Bardhan Bari, Darus Salam Thana, Mirpur-1, Dhaka-1216 - ( ১০/এ-৩, ( ৮ম তলা ) বর্ধন বাড়ি, দারুস সালাম থানা, মিরপুর-১, ঢাকা )', 'codersamity@gmail.com', '01540505646', '01919787839', 'কোডার পেশাজীবী সমবায় সমিতি লিঃ একটি স্বেচ্ছাসেবী, পেশাজীবী ও অরাজনৈতিক প্রতিষ্ঠান, যাহা ২০২৩ইং সালে প্রতিষ্ঠা করা হয়েছে এবং ২০২৫ইং সালে বাংলাদেশ সমবায় অধিদপ্তরে নিবন্ধন প্রক্রিয়া চলমান আছে, যাহার ফাইল নং- ২৫৫৩৫৮। &nbsp;আমাদের লক্ষ্য হলো পেশাজীবীদের মধ্যে সহযোগিতা বৃদ্ধি করা এবং তাদের পেশাগত ও আর্থিক উন্নয়ন সাধনে কাজ &nbsp;করা। আমরা বিভিন্ন প্রশিক্ষণ, কর্মশালা ও সেমিনার আয়োজন করি যাতে সদস্যরা তাদের দক্ষতা বৃদ্ধি করতে পারে এবং পেশাগত জীবনে সফল হতে পারে। আমাদের সদস্যরা বিভিন্ন পেশাগত ক্ষেত্রে কাজ করে এবং আমরা তাদের মধ্যে জ্ঞান ও অভিজ্ঞতা বিনিময় করি। সমিতির সদস্যদের জন্য একটি শক্তিশালী আর্থিক এবং পেশাদার প্ল্যাটফর্ম তৈরি করা, যেখানে সদস্যরা যৌথভাবে বিনিয়োগ করে, ব্যবসা পরিচালনা করে এবং মুনাফা ভাগাভাগি করতে পারে। আমরা বিশ্বাস করি যে, সহযোগিতা ও সমবায় মূলক কাজের মাধ্যমে আমরা আমাদের লক্ষ্য অর্জন করতে পারব এবং আমাদের সদস্যদের জন্য একটি উন্নত ও সমৃদ্ধ ভবিষ্যত গড়ে তুলতে পারব।', 'Coder Peshajibi Samabay Samity Ltd. is a voluntary, professional and non-political organization, which was established in 2023 and is in the process of registration with the Bangladesh Cooperatives Department in 2025, whose file no. is 255358. Our goal is to increase cooperation among professionals and work towards their professional and financial development. We organize various trainings, workshops and seminars so that members can enhance their skills and be successful in their professional lives. Our members work in different professional fields and we exchange knowledge and experience among them. To create a strong financial and professional platform for the members of the association, where members can jointly invest, run businesses and share profits. We believe that through cooperation and cooperative work, we can achieve our goals and build a better and prosperous future for our members.', 'একসাথে যেতে হবে বহুদূরে...', 'We have to go far together...', 'দৃঢ়ভাবে টেকসই পথে, সৃজনশীল ভাবনায় ও সৌহার্দ্যপূর্ণ সহযোগিতায় আমরা গড়ে তুলবো একটি সুন্দর ভবিষ্যৎ', 'We will build a beautiful future through strong, sustainable approaches, creative thinking, and friendly cooperation.', 'logo.png', '<ul><li>hello</li><li>bangladesh</li></ul>', 'https://www.facebook.com/profile.php?id=61581789144846', 'youtube', 'linkedin', 'instagram', 'twitter');

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
(62, '2', 0, '2025-09-15 22:18:49', '0000-00-00 00:00:00', '2025-09-15 22:18:49'),
(63, '2', 0, '2025-09-19 20:47:44', '0000-00-00 00:00:00', '2025-09-19 20:47:44'),
(64, '2', 0, '2025-09-19 20:49:13', '0000-00-00 00:00:00', '2025-09-19 20:49:13'),
(65, '2', 0, '2025-09-19 21:01:56', '0000-00-00 00:00:00', '2025-09-19 21:01:56'),
(66, '2', 0, '2025-09-19 21:04:36', '0000-00-00 00:00:00', '2025-09-19 21:04:36'),
(67, '2', 0, '2025-09-19 21:36:29', '0000-00-00 00:00:00', '2025-09-19 21:36:29'),
(68, '2', 0, '2025-09-19 21:40:18', '0000-00-00 00:00:00', '2025-09-19 21:40:18'),
(69, '2', 0, '2025-09-19 22:12:12', '0000-00-00 00:00:00', '2025-09-19 22:12:12'),
(70, '2', 0, '2025-09-19 22:12:23', '0000-00-00 00:00:00', '2025-09-19 22:12:23'),
(71, '2', 0, '2025-09-19 22:16:01', '0000-00-00 00:00:00', '2025-09-19 22:16:01'),
(72, '2', 0, '2025-09-19 22:16:19', '0000-00-00 00:00:00', '2025-09-19 22:16:19'),
(73, '2', 0, '2025-09-19 22:17:46', '0000-00-00 00:00:00', '2025-09-19 22:17:46'),
(74, '2', 0, '2025-09-19 22:18:49', '2025-09-19 22:23:26', '2025-09-19 22:18:49'),
(75, '2', 0, '2025-09-19 22:23:46', '2025-09-19 22:23:49', '2025-09-19 22:23:46'),
(76, '2', 0, '2025-09-19 22:24:00', '2025-09-19 22:24:34', '2025-09-19 22:24:00'),
(77, '2', 0, '2025-09-19 23:13:08', '0000-00-00 00:00:00', '2025-09-19 23:13:08'),
(78, '2', 0, '2025-09-19 23:22:52', '0000-00-00 00:00:00', '2025-09-19 23:22:52'),
(79, '2', 0, '2025-09-20 18:49:47', '0000-00-00 00:00:00', '2025-09-20 18:49:47'),
(80, '2', 0, '2025-09-20 19:26:40', '0000-00-00 00:00:00', '2025-09-20 19:26:40'),
(81, '5', 11, '2025-09-20 22:30:36', '2025-09-20 23:24:55', '2025-09-20 22:30:36'),
(82, '5', 11, '2025-09-20 23:25:22', '2025-09-20 23:25:27', '2025-09-20 23:25:22'),
(83, '2', 0, '2025-09-20 23:25:44', '2025-09-20 23:26:02', '2025-09-20 23:25:44'),
(84, '2', 0, '2025-09-20 23:26:28', '2025-09-20 23:35:30', '2025-09-20 23:26:28'),
(85, '2', 0, '2025-09-20 23:38:37', '0000-00-00 00:00:00', '2025-09-20 23:38:37'),
(86, '2', 0, '2025-09-23 21:34:22', '2025-09-23 21:39:04', '2025-09-23 21:34:22'),
(87, '2', 0, '2025-09-23 21:41:05', '0000-00-00 00:00:00', '2025-09-23 21:41:05'),
(88, '2', 0, '2025-09-23 23:31:54', '2025-09-23 23:38:00', '2025-09-23 23:31:54'),
(89, '2', 0, '2025-09-24 00:15:08', '0000-00-00 00:00:00', '2025-09-24 00:15:08'),
(90, '2', 0, '2025-09-27 22:05:44', '2025-09-27 22:39:22', '2025-09-27 22:05:44'),
(91, '2', 0, '2025-09-28 19:43:43', '2025-09-28 21:42:55', '2025-09-28 19:43:43'),
(92, '2', 0, '2025-09-28 21:42:59', '2025-09-29 00:02:58', '2025-09-28 21:42:59'),
(93, '2', 0, '2025-09-30 01:25:37', '2025-10-01 00:03:51', '2025-09-30 01:25:37'),
(94, '11', 19, '2025-10-01 00:04:04', '2025-10-01 00:05:35', '2025-10-01 00:04:04'),
(95, '11', 19, '2025-10-01 00:05:46', '2025-10-01 00:07:00', '2025-10-01 00:05:46'),
(96, '2', 0, '2025-10-01 00:38:26', '2025-10-01 00:39:55', '2025-10-01 00:38:26'),
(97, '11', 19, '2025-10-01 00:41:02', '2025-10-01 00:42:26', '2025-10-01 00:41:02'),
(98, '2', 0, '2025-10-01 00:42:30', '2025-10-01 00:42:43', '2025-10-01 00:42:30'),
(99, '12', 20, '2025-10-01 00:43:03', '2025-10-01 00:52:29', '2025-10-01 00:43:03'),
(100, '12', 20, '2025-10-01 00:55:26', '2025-10-01 00:55:30', '2025-10-01 00:55:26'),
(101, '2', 0, '2025-10-01 00:55:35', '2025-10-01 00:55:43', '2025-10-01 00:55:35'),
(102, '12', 20, '2025-10-01 00:55:52', '2025-10-01 00:58:40', '2025-10-01 00:55:52'),
(103, '2', 0, '2025-10-01 01:10:18', '2025-10-01 01:14:10', '2025-10-01 01:10:18'),
(104, '11', 19, '2025-10-01 01:15:24', '2025-10-01 01:18:41', '2025-10-01 01:15:24'),
(105, '12', 20, '2025-10-01 01:18:58', '2025-10-01 01:20:09', '2025-10-01 01:18:58'),
(106, '2', 0, '2025-10-01 22:16:08', '2025-10-01 22:31:44', '2025-10-01 22:16:08'),
(107, '12', 20, '2025-10-01 22:31:53', '2025-10-02 02:16:33', '2025-10-01 22:31:53'),
(108, '2', 0, '2025-10-02 02:23:15', '2025-10-02 02:26:14', '2025-10-02 02:23:15'),
(109, '2', 0, '2025-10-02 02:32:04', '0000-00-00 00:00:00', '2025-10-02 02:32:04'),
(110, '2', 0, '2025-10-02 18:58:29', '2025-10-02 20:02:51', '2025-10-02 18:58:29'),
(111, '12', 20, '2025-10-02 20:03:02', '2025-10-02 20:10:14', '2025-10-02 20:03:02'),
(112, '2', 0, '2025-10-02 20:21:58', '2025-10-02 20:34:53', '2025-10-02 20:21:58'),
(113, '12', 20, '2025-10-02 20:35:03', '2025-10-02 21:21:27', '2025-10-02 20:35:03'),
(114, '2', 0, '2025-10-02 21:21:31', '2025-10-02 22:57:09', '2025-10-02 21:21:31'),
(115, '12', 20, '2025-10-02 22:57:19', '2025-10-02 23:02:13', '2025-10-02 22:57:19'),
(116, '2', 0, '2025-10-02 23:03:32', '2025-10-02 23:03:59', '2025-10-02 23:03:32'),
(117, '12', 20, '2025-10-02 23:04:10', '0000-00-00 00:00:00', '2025-10-02 23:04:10'),
(118, '2', 0, '2025-10-10 20:52:18', '2025-10-10 20:52:46', '2025-10-10 20:52:18'),
(119, '2', 0, '2025-10-10 22:24:41', '2025-10-10 22:26:56', '2025-10-10 22:24:41'),
(120, '2', 0, '2025-10-10 22:27:07', '2025-10-10 22:30:16', '2025-10-10 22:27:07'),
(121, '2', 0, '2025-10-10 22:30:25', '2025-10-10 22:33:13', '2025-10-10 22:30:25'),
(122, '2', 0, '2025-10-10 22:33:35', '2025-10-10 23:56:42', '2025-10-10 22:33:35'),
(123, '2', 0, '2025-10-10 23:57:39', '2025-10-11 01:38:54', '2025-10-10 23:57:39'),
(124, '12', 20, '2025-10-11 01:39:08', '2025-10-11 01:39:47', '2025-10-11 01:39:08'),
(125, '2', 0, '2025-10-11 01:39:51', '2025-10-11 01:52:04', '2025-10-11 01:39:51'),
(126, '12', 20, '2025-10-11 01:52:15', '2025-10-11 01:52:33', '2025-10-11 01:52:15'),
(127, '2', 0, '2025-10-11 01:52:39', '2025-10-11 02:15:53', '2025-10-11 01:52:39'),
(128, '12', 20, '2025-10-11 02:16:05', '2025-10-11 02:17:03', '2025-10-11 02:16:05');

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
(10, 18, 'CPSS-00012', '200000071938', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'user', 'A', '2025-08-16 22:08:28'),
(11, 19, 'CPSS-00019', 'maruf', '4b82ba17481acc7ad9fec620bd960b80', '258963', 'user', 'A', '2025-09-05 19:20:58'),
(12, 20, 'CPSS-00020', 'dalim', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'user', 'A', '2025-09-20 23:38:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `committee_member`
--
ALTER TABLE `committee_member`
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
-- Indexes for table `services`
--
ALTER TABLE `services`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `committee_member`
--
ALTER TABLE `committee_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `members_info`
--
ALTER TABLE `members_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `member_documents`
--
ALTER TABLE `member_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `member_nominee`
--
ALTER TABLE `member_nominee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `member_office`
--
ALTER TABLE `member_office`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `member_payments`
--
ALTER TABLE `member_payments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `member_share`
--
ALTER TABLE `member_share`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
