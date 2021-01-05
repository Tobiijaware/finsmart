-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2020 at 01:44 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `sn` int(11) NOT NULL,
  `bid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`sn`, `bid`, `userid`, `category`, `created_at`, `updated_at`) VALUES
(1, '59oce', 'oisrvyng', 'Loan', NULL, NULL),
(2, '59oce', 'oisrvyng', 'Savings', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `changecard`
--

CREATE TABLE `changecard` (
  `sn` int(11) NOT NULL,
  `bid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `response` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ctime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clientcat`
--

CREATE TABLE `clientcat` (
  `sn` int(11) NOT NULL,
  `bid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rep` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc`
--

CREATE TABLE `doc` (
  `sn` int(11) NOT NULL,
  `bid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rep` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doc`
--

INSERT INTO `doc` (`sn`, `bid`, `userid`, `title`, `doc`, `note`, `rep`, `created_at`, `updated_at`) VALUES
(1, '48xqcf94', '48xqcf94', 'Bank Statement', 'Capture_1602461931.PNG', 'Bank', '48xqcf94', '2020-10-12 07:18:51', '2020-10-12 07:18:51'),
(2, '57ug4m95', '57ug4m95', 'Bank Statement', 'Esther_1604513823.jpg', 'Bank', '48xqcf94', '2020-11-05 02:17:06', '2020-11-05 02:17:06'),
(3, '57ug4m95', '57ug4m95', 'Bank Statement', 'Esther_1604513942.jpg', 'Bank', '48xqcf94', '2020-11-05 02:19:02', '2020-11-05 02:19:02'),
(4, '[{\"bid\":\"3tnke\"}]', '57ug4m95', 'Bank Statement', 'partner2_1604515332.png', 'sdffs', '48xqcf94', '2020-11-05 02:42:12', '2020-11-05 02:42:12'),
(5, '3tnke', '57ug4m95', 'Bank Statement', 'Esther_1604515752.jpg', 'Bank', '48xqcf94', '2020-11-05 02:49:12', '2020-11-05 02:49:12'),
(6, '59oce', 'oisrvyng', 'Bank Statement', 'Esther_1605289808.jpg', 'Bank', 'oisrvyng', '2020-11-14 01:50:09', '2020-11-14 01:50:09');

-- --------------------------------------------------------

--
-- Table structure for table `ewallet`
--

CREATE TABLE `ewallet` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cos` double(8,2) NOT NULL,
  `ctime` int(11) NOT NULL,
  `mm` int(11) NOT NULL,
  `yy` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rep` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `mark` int(11) NOT NULL DEFAULT 0,
  `ref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ewallet`
--

INSERT INTO `ewallet` (`id`, `trno`, `bid`, `userid`, `cos`, `ctime`, `mm`, `yy`, `status`, `type`, `remark`, `rep`, `opt`, `mark`, `ref`, `ref2`, `created_at`, `updated_at`) VALUES
(1, '395929857', '59oce', '2c6mwd5x', 60000.00, 1605827982, 11, 20, 5, 18, 'Investment Deposit', '2c6mwd5x', '0', 0, '4523929968', 'c60xBrnsWGAvFlVngrViTTTEr', '2020-11-20 07:19:42', '2020-11-20 07:19:42'),
(2, '8472881329', '59oce', '2c6mwd5x', -60000.00, 1605828423, 11, 20, 5, 4, '', 'oisrvyng', '0', 0, '4523929968', '0', '2020-11-19 23:27:03', '2020-11-19 23:27:03'),
(3, '1165798525', '59oce', '2c6mwd5x', 0.00, 1605828423, 11, 20, 5, 3, '', 'oisrvyng', '0', 0, '4523929968', '0', '2020-11-19 23:27:03', '2020-11-19 23:27:03'),
(4, '837352986', '59oce', '2c6mwd5x', 100000.00, 1605829191, 11, 20, 5, 14, 'Savings Deposit', '2c6mwd5x', '0', 0, '4622776383', 'penGCZxQFaNfgnundhCTC2nJc', '2020-11-20 07:39:51', '2020-11-20 07:39:51'),
(5, '193469875', '59oce', '2c6mwd5x', 100000.00, 1605830351, 11, 20, 5, 14, 'Savings Deposit', '2c6mwd5x', '0', 0, '4622776383', 'XTXzyGLNGzOqtSHyoUIfDY94r', '2020-11-20 07:59:11', '2020-11-20 07:59:11'),
(6, '3114818629', '59oce', '2c6mwd5x', -100000.00, 1605744000, 11, 20, 5, 5, '', 'oisrvyng', '0', 0, '4622776383', '0', '2020-11-20 00:00:45', '2020-11-20 00:00:45'),
(7, '823354118', '59oce', '2c6mwd5x', 2400.00, 1605832126, 11, 20, 5, 33, 'Processing Fee', '2c6mwd5x', '0', 0, '52911488', '80AUL8EpLMUoAXkPBV9SKVwO1', '2020-11-20 08:28:46', '2020-11-20 08:28:46'),
(8, '4662863673', '59oce', '2c6mwd5x', -132000.00, 1605744000, 11, 20, 5, 10, '', 'oisrvyng', '0', 0, '52911488', '0', '2020-11-20 00:32:39', '2020-11-20 00:32:39');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `sn` int(11) NOT NULL,
  `bid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_sn` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `des` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ctime` int(11) NOT NULL,
  `mm` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flexible`
--

CREATE TABLE `flexible` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `l1` int(11) NOT NULL DEFAULT 0,
  `l2` int(11) NOT NULL DEFAULT 0,
  `l3` int(11) NOT NULL DEFAULT 0,
  `l4` int(11) NOT NULL DEFAULT 0,
  `l5` int(11) NOT NULL DEFAULT 0,
  `l6` int(11) NOT NULL DEFAULT 0,
  `s1` int(11) NOT NULL DEFAULT 0,
  `s2` int(11) NOT NULL DEFAULT 0,
  `s3` int(11) NOT NULL DEFAULT 0,
  `s4` int(11) NOT NULL DEFAULT 0,
  `i1` int(11) NOT NULL DEFAULT 0,
  `i2` int(11) NOT NULL DEFAULT 0,
  `i3` int(11) NOT NULL DEFAULT 0,
  `i4` int(11) NOT NULL DEFAULT 0,
  `i5` int(11) NOT NULL DEFAULT 0,
  `rep` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ctime` int(11) NOT NULL,
  `o1` int(11) NOT NULL DEFAULT 0,
  `o2` int(11) NOT NULL DEFAULT 0,
  `o3` int(11) NOT NULL DEFAULT 0,
  `o4` int(11) NOT NULL DEFAULT 0,
  `o5` int(11) NOT NULL DEFAULT 0,
  `o6` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flexible`
--

INSERT INTO `flexible` (`id`, `bid`, `userid`, `status`, `l1`, `l2`, `l3`, `l4`, `l5`, `l6`, `s1`, `s2`, `s3`, `s4`, `i1`, `i2`, `i3`, `i4`, `i5`, `rep`, `ctime`, `o1`, `o2`, `o3`, `o4`, `o5`, `o6`, `created_at`, `updated_at`) VALUES
(1, '59oce', 'oisrvyng', 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'oisrvyng', 1605662447, 1, 1, 1, 1, 1, 1, '2020-10-29 18:59:49', '2020-10-29 18:59:49');

-- --------------------------------------------------------

--
-- Table structure for table `guarantor`
--

CREATE TABLE `guarantor` (
  `sn` int(11) NOT NULL,
  `bid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rep` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guarantor`
--

INSERT INTO `guarantor` (`sn`, `bid`, `userid`, `name`, `phone`, `email`, `note`, `rep`, `status`, `created_at`, `updated_at`) VALUES
(1, 'xxva7', '8j8drc6n', 'Esther Cicilia', '0907653748', 'samuelesther234@gmail.com', 'My daughter is trust worthy and hard working', '8j8drc6n', 1, '2020-10-06 22:53:43', '2020-10-06 22:53:43'),
(2, 'lpuek', '48xqcf94', 'Esther Ciclia', '08167463483', 'fulani@gmail.com', 'He is trust worthy', '48xqcf94', 1, '2020-10-07 22:23:28', '2020-10-07 22:23:28'),
(3, '3tnke', '57ug4m95', 'Ajuo', '08169472570', 'samuelesther234@gmail.com', 'Good Child', '48xqcf94', 1, '2020-11-05 02:56:56', '2020-11-05 02:56:56');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `sn` int(11) NOT NULL,
  `bid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_sn` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `des` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ctime` int(11) NOT NULL,
  `mm` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invacc`
--

CREATE TABLE `invacc` (
  `id` int(11) NOT NULL,
  `bid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref` bigint(20) NOT NULL,
  `amount` float NOT NULL,
  `rate` float NOT NULL,
  `interest` float NOT NULL,
  `prorate` float NOT NULL,
  `profee` float NOT NULL,
  `tranch` int(11) NOT NULL DEFAULT 0,
  `tenure` int(11) NOT NULL,
  `start` int(11) NOT NULL DEFAULT 0,
  `stop` int(11) NOT NULL DEFAULT 0,
  `mm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `yy` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `terminate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rep` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invacc`
--

INSERT INTO `invacc` (`id`, `bid`, `userid`, `ref`, `amount`, `rate`, `interest`, `prorate`, `profee`, `tranch`, `tenure`, `start`, `stop`, `mm`, `yy`, `terminate`, `status`, `type`, `rep`, `created_at`, `updated_at`) VALUES
(1, '59oce', '2c6mwd5x', 4523929968, 60000, 2, 3600, 10, 0.2, 0, 90, 1605827982, 1605828423, '2011', '0', '0', '4', '2', 'oisrvyng', '2020-11-20 06:53:05', '2020-11-20 06:53:05');

-- --------------------------------------------------------

--
-- Table structure for table `investini`
--

CREATE TABLE `investini` (
  `sn` int(11) NOT NULL,
  `bid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invstatus`
--

CREATE TABLE `invstatus` (
  `sn` int(11) NOT NULL,
  `code` varchar(3) NOT NULL,
  `remark` varchar(100) NOT NULL,
  `color` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invstatus`
--

INSERT INTO `invstatus` (`sn`, `code`, `remark`, `color`) VALUES
(1, '0', 'Awaiting Approval', 'red'),
(2, '1', 'Awaiting Approval', 'red'),
(3, '2', 'Approved. Awaiting Payment', 'blue'),
(4, '3', 'Activated', 'green'),
(5, '4', 'Terminated', 'black'),
(6, '5', 'Suspended', 'red'),
(7, '6', 'Suspended', 'red'),
(8, '7', 'Suspended', 'red'),
(9, '8', 'Suspended', 'red'),
(10, '9', 'Suspended', 'red'),
(11, '10', 'Suspended', 'red');

-- --------------------------------------------------------

--
-- Table structure for table `kyc`
--

CREATE TABLE `kyc` (
  `sn` int(11) NOT NULL,
  `bid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ref` int(11) NOT NULL,
  `bid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `rate` double NOT NULL,
  `interest` double NOT NULL,
  `prorate` double NOT NULL,
  `profee` double NOT NULL,
  `advisory` double DEFAULT NULL,
  `insurance` double DEFAULT NULL,
  `tranch` double DEFAULT NULL,
  `tenure` int(11) DEFAULT NULL,
  `start` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `stop` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `mm` int(11) NOT NULL DEFAULT 0,
  `terminate` double DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `type` int(11) DEFAULT NULL,
  `rep` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`id`, `ref`, `bid`, `userid`, `amount`, `rate`, `interest`, `prorate`, `profee`, `advisory`, `insurance`, `tranch`, `tenure`, `start`, `stop`, `mm`, `terminate`, `status`, `type`, `rep`, `created_at`, `updated_at`) VALUES
(4, 52911488, '59oce', '2c6mwd5x', 120000, 10, 12000, 2, 2400, NULL, NULL, 132000, 30, '1605744000', '1608336000', 0, 0, 4, 3, 'oisrvyng', '2020-11-20 08:26:08', '2020-11-20 08:26:08');

-- --------------------------------------------------------

--
-- Table structure for table `loanstatus`
--

CREATE TABLE `loanstatus` (
  `sn` int(11) NOT NULL,
  `code` varchar(3) NOT NULL,
  `remark` varchar(100) NOT NULL,
  `color` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loanstatus`
--

INSERT INTO `loanstatus` (`sn`, `code`, `remark`, `color`) VALUES
(1, '0', 'Awaiting Approval', 'red'),
(2, '1', 'Awaiting Approval', 'red'),
(3, '2', 'Approved. Awaiting Processing Fee', 'blue'),
(4, '3', 'Awaiting Disbursement', 'purple'),
(5, '4', 'Loan Disbursed', 'black'),
(6, '5', 'Loan Repaid', 'green'),
(7, '6', 'Suspended', 'red'),
(8, '7', 'Suspended', 'red'),
(9, '8', 'Suspended', 'red'),
(10, '9', 'Suspended', 'red'),
(11, '10', 'Suspended', 'red');

-- --------------------------------------------------------

--
-- Table structure for table `loantranch`
--

CREATE TABLE `loantranch` (
  `id` int(11) NOT NULL,
  `ref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instal` int(11) NOT NULL,
  `loan` int(11) NOT NULL,
  `tranch` double(8,2) NOT NULL,
  `mm` int(11) NOT NULL,
  `paid` int(11) NOT NULL DEFAULT 0,
  `start` int(50) NOT NULL DEFAULT 0,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loantranch`
--

INSERT INTO `loantranch` (`id`, `ref`, `bid`, `userid`, `instal`, `loan`, `tranch`, `mm`, `paid`, `start`, `reference`, `created_at`, `updated_at`) VALUES
(1, '52911488', '59oce', '2c6mwd5x', 1, 120000, 132000.00, 2012, 0, 1608336000, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `logdraw`
--

CREATE TABLE `logdraw` (
  `sn` int(11) NOT NULL,
  `bid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inibalance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `finalbalance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ymd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ww` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logpay`
--

CREATE TABLE `logpay` (
  `sn` int(11) NOT NULL,
  `bid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `ctime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logpay`
--

INSERT INTO `logpay` (`sn`, `bid`, `userid`, `ref`, `amount`, `status`, `ctime`, `type`, `created_at`, `updated_at`) VALUES
(1, '59oce', '2c6mwd5x', 'AkltD5RbtKXeNOiVBgfbc5JSt', 2.00, 0, '1605647805', '5000', NULL, NULL),
(2, '59oce', '2c6mwd5x', '8j4YGKoPTbq1BzDklKw1Z7C6y', 2.00, 0, '1605654073', '200000', NULL, NULL),
(3, '59oce', '2c6mwd5x', 'wRogwiLM7MApzKXC4egxlfDly', 2.00, 0, '1605721605', '5000', NULL, NULL),
(4, '59oce', '2c6mwd5x', 'Kcu6OSvcRdki9ImujtprGpmfb', 2.00, 0, '1605807496', '5000', NULL, NULL);

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
(4, '2020_09_28_095448_create_category_table', 1),
(5, '2020_09_28_100157_create_guarantor_table', 1),
(6, '2020_09_28_100603_create_ewallet_table', 1),
(7, '2020_09_28_101738_create_flexible_table', 1),
(8, '2020_09_28_102301_create_productsetup_table', 1),
(9, '2020_09_28_102819_create_loan_table', 1),
(10, '2020_09_28_104031_create_savings_table', 1),
(11, '2020_09_28_192749_create_invacc_table', 1),
(12, '2020_09_30_165115_create_investini_table', 1),
(13, '2020_09_30_165546_create_loantranch_table', 1),
(14, '2020_09_30_172405_create_setup_table', 1),
(15, '2020_09_30_173234_create_income_table', 1),
(16, '2020_09_30_174139_create_expenses_table', 1),
(17, '2020_09_30_174528_create_changecard_table', 1),
(18, '2020_09_30_174831_create_clientcat_table', 1),
(19, '2020_09_30_175003_create_doc_table', 1),
(20, '2020_09_30_175158_create_kyc_table', 1),
(21, '2020_09_30_175349_create_logdraw_table', 1),
(22, '2020_09_30_175623_create_logpay_table', 1),
(23, '2020_09_30_180535_create_msg_table', 1),
(24, '2020_09_30_180745_create_robject_table', 1),
(25, '2020_09_30_181002_create_savings2_table', 1),
(26, '2020_09_30_181234_create_withdraw_table', 1),
(27, '2020_09_30_181417_create_withdrawinv_table', 1),
(28, '2020_10_02_175445_create_products_table', 2),
(29, '2020_11_11_191353_create_loantranch_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `msg`
--

CREATE TABLE `msg` (
  `sn` int(11) NOT NULL,
  `bid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `msg` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rec` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ctime` int(11) NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productsetup`
--

CREATE TABLE `productsetup` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product` varchar(55) DEFAULT NULL,
  `type` int(2) NOT NULL DEFAULT 0,
  `min` int(10) NOT NULL DEFAULT 0,
  `max` int(10) NOT NULL DEFAULT 0,
  `interest` float NOT NULL,
  `vat` float NOT NULL DEFAULT 0,
  `profee` float NOT NULL DEFAULT 0,
  `penalty` float NOT NULL DEFAULT 0,
  `collateral` varchar(5) NOT NULL DEFAULT 'NO',
  `status` int(2) NOT NULL DEFAULT 1,
  `rep` varchar(12) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productsetup`
--

INSERT INTO `productsetup` (`id`, `product`, `type`, `min`, `max`, `interest`, `vat`, `profee`, `penalty`, `collateral`, `status`, `rep`, `created_at`, `updated_at`) VALUES
(1, 'Monthly Savings', 2, 10000, 4000000, 2, 0, 3.33, 0, 'NO', 1, 'he8hf7hs9', NULL, NULL),
(2, 'Basic Investments', 3, 50000, 5000000, 2, 10, 0, 5, 'NO', 1, 'he8hf7hs9', NULL, NULL),
(3, 'Soft Loan', 1, 20000, 3000000, 10, 0, 2, 0, 'NO', 1, 'he8hf7hs9', NULL, NULL),
(4, 'Daily Savings', 2, 500, 1000000, 0, 0, 3.33, 0, 'NO', 1, 'he8hf7hs9', NULL, NULL),
(5, 'Kids Savings', 2, 200, 1000000, 0, 0, 3.33, 0, 'NO', 1, 'he8hf7hs9', NULL, NULL),
(6, 'Business Loan', 1, 20000, 2000000, 11, 0, 2, 1, 'NO', 1, '48xqcf94', '2020-10-19 23:22:02', '2020-10-19 23:22:02'),
(7, 'Rich Investment', 3, 30000, 30000000, 1, 2, 0, 1, 'NO', 1, 'oisrvyng', '2020-11-07 01:24:55', '2020-11-07 01:24:55'),
(8, 'New Savings', 2, 20000, 2000000, 2, 0, 0, 0, 'NO', 1, 'oisrvyng', '2020-11-07 01:56:05', '2020-11-07 01:56:05');

-- --------------------------------------------------------

--
-- Table structure for table `robject`
--

CREATE TABLE `robject` (
  `sn` bigint(20) UNSIGNED NOT NULL,
  `bid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expmonth` int(10) NOT NULL,
  `expyear` int(10) NOT NULL,
  `cardtype` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastfour` int(10) NOT NULL DEFAULT 0,
  `bank` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cardid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `reset` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `robject`
--

INSERT INTO `robject` (`sn`, `bid`, `userid`, `expmonth`, `expyear`, `cardtype`, `lastfour`, `bank`, `ref`, `cardid`, `status`, `reset`, `created_at`, `updated_at`) VALUES
(1, '59oce', '2c6mwd5x', 12, 2020, 'visa ', 4081, 'TEST BANK', 'AkltD5RbtKXeNOiVBgfbc5JSt', '887625508', 1, 1, '2020-11-18 05:16:45', '2020-11-18 05:16:45'),
(2, '59oce', '2c6mwd5x', 12, 2020, 'visa ', 4081, 'TEST BANK', '8j4YGKoPTbq1BzDklKw1Z7C6y', '887729853', 1, 1, '2020-11-18 07:01:13', '2020-11-18 07:01:13'),
(3, '59oce', '2c6mwd5x', 12, 2020, 'visa ', 4081, 'TEST BANK', 'wRogwiLM7MApzKXC4egxlfDly', '888603395', 1, 1, '2020-11-19 01:46:45', '2020-11-19 01:46:45'),
(4, '59oce', '2c6mwd5x', 12, 2020, 'visa ', 4081, 'TEST BANK', 'Kcu6OSvcRdki9ImujtprGpmfb', '889770434', 1, 1, '2020-11-20 01:38:16', '2020-11-20 01:38:16');

-- --------------------------------------------------------

--
-- Table structure for table `savings`
--

CREATE TABLE `savings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ref` bigint(20) NOT NULL,
  `bid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `period` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `rate` float NOT NULL DEFAULT 0,
  `rate2` float NOT NULL DEFAULT 0,
  `start` int(11) NOT NULL DEFAULT 0,
  `stop` int(11) NOT NULL DEFAULT 0,
  `mm` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `rep` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `savings`
--

INSERT INTO `savings` (`id`, `ref`, `bid`, `userid`, `amount`, `period`, `type`, `rate`, `rate2`, `start`, `stop`, `mm`, `status`, `rep`, `created_at`, `updated_at`) VALUES
(3, 4622776383, '59oce', '2c6mwd5x', 100000, '30', '4', 0, 0, 1605830351, 0, 2011, 2, '2c6mwd5x', '2020-11-20 07:38:47', '2020-11-20 07:38:47');

-- --------------------------------------------------------

--
-- Table structure for table `savings2`
--

CREATE TABLE `savings2` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `paid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `savingstatus`
--

CREATE TABLE `savingstatus` (
  `sn` int(11) NOT NULL,
  `code` varchar(3) NOT NULL,
  `remark` varchar(100) NOT NULL,
  `color` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `savingstatus`
--

INSERT INTO `savingstatus` (`sn`, `code`, `remark`, `color`) VALUES
(1, '1', 'Awaiting First Deposit', 'red'),
(2, '2', 'Active Savings', 'blue'),
(3, '3', 'Savings Liquidated', 'green'),
(4, '4', 'Complicated', 'red'),
(5, '5', 'Complicated', 'red'),
(6, '6', 'Complicated', 'red'),
(7, '7', 'Complicated', 'red'),
(8, '8', 'Complicated', 'red'),
(9, '9', 'Complicated', 'red'),
(10, '10', 'Complicated', 'red');

-- --------------------------------------------------------

--
-- Table structure for table `setup`
--

CREATE TABLE `setup` (
  `sn` int(11) NOT NULL,
  `bid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senderid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setup`
--

INSERT INTO `setup` (`sn`, `bid`, `userid`, `status`, `phone`, `phone2`, `address`, `email`, `company`, `bank`, `accno`, `accname`, `senderid`, `created_at`, `updated_at`) VALUES
(1, '59oce', 'oisrvyng', 1, '08169472570', '09078763763', 'Phase 2, No 14, molahan quarters Awule road Ondo', 'trenet@trenet.com', 'LIVEPETAL', 'GTB', '0167764837', 'Samuel Esther', '0', '2020-11-06 09:11:48', '2020-11-06 09:11:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `othername` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sponsor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accountno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bvn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rep` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` int(11) NOT NULL DEFAULT 0,
  `is_user` int(11) NOT NULL DEFAULT 0,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'user.jpg',
  `code` int(11) DEFAULT NULL,
  `ctime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cat` int(11) DEFAULT NULL,
  `keyy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `bid`, `userid`, `surname`, `othername`, `sponsor`, `active`, `email`, `sex`, `state`, `city`, `address`, `address2`, `birthday`, `accname`, `bank`, `accountno`, `bvn`, `name`, `password`, `phone`, `phone2`, `status`, `rep`, `is_admin`, `is_user`, `photo`, `code`, `ctime`, `cat`, `keyy`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'lpuek', '48xqcf94', 'Dada', 'Samuel', NULL, NULL, 'samuelesther234@gmail.com', 'Male', 'Delta', 'Ikorodu', 'No 5, Ikeja', 'Ojota', '2020-09-27', NULL, 'GTB', '0153057071', '2346541226', NULL, '$2y$10$h.xOLDGe7uAJDM0FZhu8nuKOTTpKWSlmr..y0zNUQsaafrecRMZja', '09076537480', '09087654323', NULL, NULL, 1, 0, 'user.jpg', NULL, '1601653183', NULL, NULL, NULL, '2020-10-02 22:39:44', '2020-10-12 07:08:25'),
(2, '3tnke', '57ug4m95', 'Salawu', 'Nifemi Helen', NULL, NULL, 'nifemi@gmail.com', 'Female', 'Ondo', 'Akure', 'Alaba Futa', 'Northgate Futa', '2006-02-14', NULL, NULL, NULL, NULL, NULL, '$2y$10$AiuzgUpBbMfJhyH4lLC67u2Q9o5KI0AN/z6rBMsE8O1MUQbnwV1EG', '08169472570', '08156473321', NULL, NULL, 0, 1, 'user.jpg', NULL, '1601996178', NULL, NULL, NULL, '2020-10-06 21:56:26', '2020-10-06 21:56:26'),
(3, 'xxva7', '8j8drc6n', 'Seun', 'Titilayo', NULL, NULL, 'mobo@gmail.com', 'Female', 'Gombe', 'Futa', 'No 5, Ikeja', 'Akure', '2020-09-28', NULL, 'GTB', '0153057011', '7678787911', NULL, '$2y$10$2LMgtjzrPGI5CNKDBRU7u.2BiK7WzDmut1Mbm22FudwLKbdWfflVu', '08068975640', '09076578665', NULL, NULL, 0, 1, 'Esther_1602259728.jpg', NULL, '1601998650', NULL, NULL, NULL, '2020-10-06 22:37:30', '2020-10-09 23:08:49'),
(5, 'awnb6', 'ndvb92mq', 'Ijaware', NULL, NULL, NULL, 'tobi@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$5D9RE1Kv/LIyVLrsKchT2.Yr5l0D8WeWxmH6gFS/wD9j7u80MOW.a', NULL, NULL, NULL, NULL, 1, 0, 'user.jpg', NULL, NULL, NULL, NULL, NULL, '2020-10-16 01:13:45', '2020-10-16 01:13:45'),
(6, '59oce', '981is968', 'Mobolaji', 'Iyanu', NULL, NULL, 'ogbaji@gmail.com', 'Male', 'Ondo', 'Akure', 'Alaba Futa', 'Akure', '2020-10-15', NULL, NULL, NULL, NULL, NULL, '$2y$10$06hv/Mg8Ws5P737rg2dU7eO87Crhrp0c6dQ/IuJKvZI5vkXgvuBy2', '09087654650', '07072167521', NULL, NULL, 0, 1, 'user.jpg', NULL, '1602785825', NULL, NULL, NULL, '2020-10-16 01:17:05', '2020-10-16 01:17:05'),
(7, '59oce', 'oisrvyng', 'TRENET', NULL, NULL, NULL, 'trenet@trenet.com', NULL, NULL, NULL, 'No 14, molahan quarters Awule road Akure', NULL, NULL, 'Samuel Esther', 'GTB', '0167764837', NULL, NULL, '$2y$10$uTf76e0LlBGPX6Q7SbwMfeL68yx7wy1yvET.PKAX/RghzvDp5NAWS', '08169472570', '09078763763', NULL, NULL, 1, 0, 'user.jpg', NULL, NULL, NULL, NULL, NULL, '2020-11-06 09:11:48', '2020-11-06 09:11:48'),
(8, '59oce', '2c6mwd5x', 'Uche', 'John Henry', NULL, NULL, 'uche@gmail.com', 'Male', 'Ondo', 'Akure', 'Molahan Quarters Awule road Akure Ondo state', 'Molahan Quarters Awule road Akure Ondo state', '2020-11-03', NULL, NULL, NULL, NULL, NULL, '$2y$10$AN4fqw8GEimRPqbIhmoIQOtVyf1m0zFvh4QTX2r5NbrouO.ZFuGqa', '09076537499', '08123435467', NULL, NULL, 0, 1, 'user.jpg', NULL, '1605028495', NULL, NULL, NULL, '2020-11-11 01:14:55', '2020-11-11 01:14:55');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw`
--

CREATE TABLE `withdraw` (
  `sn` int(11) NOT NULL,
  `bid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inibalance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `finalbalance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ymd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ww` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdrawinv`
--

CREATE TABLE `withdrawinv` (
  `sn` int(11) NOT NULL,
  `bid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tamt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ymd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ww` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `doc`
--
ALTER TABLE `doc`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `ewallet`
--
ALTER TABLE `ewallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flexible`
--
ALTER TABLE `flexible`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guarantor`
--
ALTER TABLE `guarantor`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `invacc`
--
ALTER TABLE `invacc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invstatus`
--
ALTER TABLE `invstatus`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loanstatus`
--
ALTER TABLE `loanstatus`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `loantranch`
--
ALTER TABLE `loantranch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logpay`
--
ALTER TABLE `logpay`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productsetup`
--
ALTER TABLE `productsetup`
  ADD UNIQUE KEY `sn` (`id`);

--
-- Indexes for table `robject`
--
ALTER TABLE `robject`
  ADD UNIQUE KEY `sn` (`sn`);

--
-- Indexes for table `savings`
--
ALTER TABLE `savings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `savings2`
--
ALTER TABLE `savings2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `savingstatus`
--
ALTER TABLE `savingstatus`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `setup`
--
ALTER TABLE `setup`
  ADD PRIMARY KEY (`sn`);

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
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doc`
--
ALTER TABLE `doc`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ewallet`
--
ALTER TABLE `ewallet`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flexible`
--
ALTER TABLE `flexible`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `guarantor`
--
ALTER TABLE `guarantor`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invacc`
--
ALTER TABLE `invacc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invstatus`
--
ALTER TABLE `invstatus`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `loanstatus`
--
ALTER TABLE `loanstatus`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `loantranch`
--
ALTER TABLE `loantranch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logpay`
--
ALTER TABLE `logpay`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productsetup`
--
ALTER TABLE `productsetup`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `robject`
--
ALTER TABLE `robject`
  MODIFY `sn` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `savings`
--
ALTER TABLE `savings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `savings2`
--
ALTER TABLE `savings2`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `savingstatus`
--
ALTER TABLE `savingstatus`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `setup`
--
ALTER TABLE `setup`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
