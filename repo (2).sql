-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2024 at 06:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `repo`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounttbl`
--

CREATE TABLE `accounttbl` (
  `UserID` int(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `SchoolId` varchar(20) NOT NULL,
  `Fname` varchar(50) NOT NULL,
  `Lname` varchar(50) NOT NULL,
  `Mname` varchar(50) DEFAULT NULL,
  `Suffix` varchar(3) NOT NULL,
  `IsMale` int(1) NOT NULL,
  `imageName` varchar(100) DEFAULT NULL,
  `Password` varchar(250) NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `Usertype` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounttbl`
--

INSERT INTO `accounttbl` (`UserID`, `Email`, `SchoolId`, `Fname`, `Lname`, `Mname`, `Suffix`, `IsMale`, `imageName`, `Password`, `DateCreated`, `Usertype`) VALUES
(1, 'gj', '', 'fname', 'lname', 'mname', 'suf', 1, NULL, 'hashed_password', '2024-08-27 16:00:00', 3),
(10, 'trinidadrachelle53@gmail.com', '4324ff', 'sdf', 'sdf', 'sdf', '', 0, NULL, '6ec8ed15a3d9bd69c4d6ece1e3dfa4ef', '2024-08-29 16:00:00', 1),
(12, 'qwe', '231', 'sdsa', 'adsa', 'jrsfds', 'jr', 1, NULL, 'cddasdas', '2024-09-05 16:00:00', 3),
(13, 'asdas@aa.com', 'asdsaa', 'asda', 'asd', 'gd', 'ad', 1, NULL, 'be5ba13deb16d7335c7b748ff2b25afa', '2024-09-05 23:43:43', 3),
(15, 'asasdas@aa.com', 'asdsaassa', 'asdgd', 'asdada', 'gdsa', 'ad', 1, NULL, '82030ed3ef4387c2114de2cf60372f9e', '2024-09-06 00:15:51', 1),
(18, 'asasddsdas@aa.com', 'asdsaassaas22', 'asdgd', 'asdada', 'gdsa', 'ad', 1, NULL, 'c9a921673fed660b3c4a4a54ccec856e', '2024-09-06 00:18:13', 1),
(19, 'asasbdas@aa.com', 'asdsaassa2', 'asdgd', 'asdada', 'gdsa', 'ad', 1, NULL, 'ef76e76f88bbdcef4759127b9400d2ff', '2024-09-06 00:18:39', 1),
(20, 'asausbdas@aa.com', 'asdsa5assa2', 'asdgd', 'asdada', 'gdsa', 'ad', 1, NULL, 'e6ea7f52b7313a9218f8d398eab32139', '2024-09-06 00:19:45', 1),
(21, 'asausbedas@aa.com', 'asdsa5assaa2', 'asdgd', 'asdada', 'gdsa', 'ad', 0, NULL, 'e56d3a488e80dce9699de6766a357a60', '2024-09-06 00:22:21', 1),
(22, 'asaudsbedas@aa.com', 'asddsa5assaa2', 'asdgd', 'asdada', 'gdsa', 'ad', 1, NULL, '7b1c50316fe96454549bff610ffd752f', '2024-09-06 00:23:10', 1),
(23, 'dasad@d.com', 'dfb0', 'asdgd', 'asdada', 'gdsa', 'ad', 0, NULL, '7952f4c07e93d7aa9f845fa1bf0a41df', '2024-09-06 00:54:29', 3),
(24, 'dasad@jd.com', '22344', 'asdgd', 'asdada', 'gdsa', 'ad', 0, NULL, '139b3c81df169b91e565e7c2e9de8854', '2024-09-06 01:00:46', 2),
(25, 'das-ad@jd.com', '22344o', 'asdgd', 'asdada', 'gdsa', 'ad', 0, NULL, '2c8fd5beff0a76620da236218b06f3da', '2024-09-06 01:03:03', 2),
(26, 'das-dad@jd.com', '22344do', 'asdgd', 'asdada', 'gdsa', 'ad', 0, NULL, '753d635b74becc9b21e9f784553c4a70', '2024-09-06 01:07:21', 2),
(27, 'dfas-dad@jd.com', '223f44do', 'asdgd', 'asdada', 'gdsa', 'ad', 0, NULL, '8bc496dbd2596bc24ef71fab13a9c30f', '2024-09-06 01:07:44', 1),
(28, 'dfas-ddad@jd.com', '223f4d4do', 'asdgd', 'asdada', 'gdsa', 'ad', 0, NULL, '1af5a0144b47654a85c8da8dbc54c804', '2024-09-06 01:08:59', 1),
(30, 'dfas-xddad@jd.com', '223f4d4xxdo', 'asdgd', 'asdada', 'gdsa', 'ad', 0, NULL, '73e1ae8c8bb7efdd69e355909cd862e2', '2024-09-06 01:11:10', 1),
(32, 'dfas-ddad@2jd.com', '223f4d4do2', 'asdgd', 'asdada', 'gdsa', 'ad', 0, NULL, '7552ee9a01bc7773c46ec5cafe4b1d79', '2024-09-06 01:12:54', 2),
(34, 'dfas-sddad@2jd.com', '223f4d4sdo2', 'asdgd', 'asdada', 'gdsa', 'ad', 1, NULL, '431a84d4fbf2a46906f213464f08b632', '2024-09-06 01:42:46', 1),
(35, '-ddad@2jd.com', '24d4do2', 'asdgd', 'asdada', 'gdsa', '', 0, NULL, 'bc56ac31ac9b555dbbb22a56e9af9ff9', '2024-09-06 10:06:35', 1),
(38, 'trinidadrelle53@gmail.com', 'tal00323', 'rachelle', 'sdf', 'sdf', 'sas', 0, NULL, '6dd834d55a509947ee88b234da881fda', '2024-09-21 02:34:57', 1),
(41, 'trinidadrelle5a3@gmail.com', 'tal00323as', 'rachelle', 'sdf', 'sdf', 'sas', 0, NULL, '835c8bf93277df27c6430f5ee5e8905d', '2024-09-21 02:36:19', 1),
(42, 'trinidadarelle5a3@gmail.com', 'tal00323asaa', 'rachelle', 'sdf', 'sdf', 'sas', 0, NULL, 'd59240c36a3d1c10f6d075ee2e5c426e', '2024-09-21 02:41:12', 2),
(43, 'trinidadarlle5a3@gmail.com', 'tal0023asaa', 'rachelle', 'sdf', 'sdf', 'sas', 0, NULL, '8f4776cc9ffbbcfdf2c33af4273eaccd', '2024-09-21 02:43:57', 2),
(44, 'trinidadaraslle5a3@gmail.com', 'tal0023asaad', 'rachelle', 'sdf', 'sdf', 'sas', 0, NULL, '8807c8a24012db3b7250b63be3694206', '2024-09-27 11:21:53', 1),
(45, 'john.doe@example.com', '1', 'John', 'Doe', 'A.', '', 1, NULL, '4d0a96a0b938e2f44d1996b8b8b0826d', '2024-09-27 13:59:28', 1),
(46, 'jane.smith@example.com', '2', 'Jane', 'Smith', 'B.', 'Jr.', 2, NULL, '9742dea8c7a2bf1d8c889487919fb20b', '2024-09-27 14:10:51', 2),
(47, 'jane.ssmith@example.com', '2as', 'Jane', 'Smith', 'B.', 'Jr.', 2, NULL, '2e82c531591a31a3cf275b8a4d5d9ea1', '2024-09-27 14:16:47', 2),
(48, 'john.doe@exaample.com', '1ss', 'John', 'Doe', 'A.', '', 1, NULL, '19e7d5a08e2d930001f2693a0837fe6c', '2024-09-27 14:18:56', 1),
(49, 'john.does@exaample.com', 's', 'John', 'Doe', 'A.', '', 1, NULL, 'aed28f2cecca6262ed00205e40b49b09', '2024-09-27 14:23:34', 1),
(51, 'alice.jones@example.com', '3', 'Alice', 'Jones', 'C.', '', 1, NULL, '8e73854f617da21406d807732ed99d67', '2024-09-27 14:23:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `coursetbl`
--

CREATE TABLE `coursetbl` (
  `CourseID` int(5) NOT NULL,
  `CourseAcronym` varchar(100) NOT NULL,
  `CourseName` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `DateAdded` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coursetbl`
--

INSERT INTO `coursetbl` (`CourseID`, `CourseAcronym`, `CourseName`, `Description`, `DateAdded`) VALUES
(1, 'BSIT', '0', 'asasdadsa', '2024-08-29 04:26:05');

-- --------------------------------------------------------

--
-- Table structure for table `favoritetbl`
--

CREATE TABLE `favoritetbl` (
  `FavoriteID` int(13) NOT NULL,
  `UID` int(50) NOT NULL,
  `ResearchID` int(250) NOT NULL,
  `status` int(1) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favoritetbl`
--

INSERT INTO `favoritetbl` (`FavoriteID`, `UID`, `ResearchID`, `status`, `date`) VALUES
(1, 35, 10, 1, '2024-10-12'),
(2, 35, 10, 1, '2024-10-12'),
(3, 13, 10, 0, '2024-10-12'),
(4, 13, 9, 0, '2024-10-14'),
(5, 13, 11, 0, '2024-10-16');

-- --------------------------------------------------------

--
-- Table structure for table `logtbl`
--

CREATE TABLE `logtbl` (
  `logID` int(16) NOT NULL,
  `UID` int(50) NOT NULL,
  `datelogin` datetime NOT NULL,
  `DateExpire` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logtbl`
--

INSERT INTO `logtbl` (`logID`, `UID`, `datelogin`, `DateExpire`) VALUES
(3, 13, '2024-09-16 11:40:26', '2024-09-23 11:40:26'),
(4, 13, '2024-09-23 12:47:57', '2024-09-30 12:47:57'),
(5, 13, '2024-10-12 04:51:14', '2024-10-19 04:51:14'),
(6, 13, '2024-10-16 06:05:18', '2024-10-23 06:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `reasearchkeywordstbl`
--

CREATE TABLE `reasearchkeywordstbl` (
  `ReasearchKeyWordsD` int(255) NOT NULL,
  `KeywordConnectorKey` bigint(250) NOT NULL,
  `Keyword` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reasearchkeywordstbl`
--

INSERT INTO `reasearchkeywordstbl` (`ReasearchKeyWordsD`, `KeywordConnectorKey`, `Keyword`, `date`) VALUES
(1, 2147483647, 'oo', '2024-09-16 11:24:37'),
(2, 2147483647, 'oo', '2024-09-16 11:25:50'),
(3, 2147483647, 'oo', '2024-09-16 11:27:40'),
(4, 2147483647, 'oo', '2024-09-16 11:29:17'),
(5, 2147483647, 'oo', '2024-09-16 11:33:14'),
(6, 2147483647, 'oo', '2024-09-16 11:35:39'),
(7, 2147483647, 'oo', '2024-09-16 11:42:45'),
(8, 2147483647, 'oo', '2024-09-16 11:43:28'),
(9, 2147483647, 'oo', '2024-09-16 11:44:22'),
(10, 2147483647, 'oo', '2024-09-16 11:45:52'),
(11, 2147483647, 'oo', '2024-09-16 11:46:38'),
(12, 2147483647, 'oo', '2024-09-16 11:47:03'),
(13, 2147483647, 'oo', '2024-09-16 11:47:26'),
(14, 2147483647, 'oo', '2024-09-16 11:48:12'),
(15, 2147483647, 'oo', '2024-09-16 11:53:13'),
(16, 2147483647, 'oo', '2024-09-16 11:57:34'),
(17, 2147483647, 'oo', '2024-09-16 12:00:14'),
(18, 2147483647, 'oo', '2024-09-16 12:07:40'),
(19, 2147483647, 'oo', '2024-09-16 15:29:30'),
(20, 2147483647, 'oo', '2024-09-16 15:30:49'),
(21, 2147483647, 'oo', '2024-09-16 15:32:19'),
(22, 202409161736, 'oo', '2024-09-16 15:50:36'),
(23, 202409161753, 'oo', '2024-09-16 15:50:53'),
(24, 202409210539, 'gege', '2024-09-21 03:36:39');

-- --------------------------------------------------------

--
-- Table structure for table `reasearchtagtbl`
--

CREATE TABLE `reasearchtagtbl` (
  `ResearchTagID` int(200) NOT NULL,
  `TagConnectorKey` bigint(250) NOT NULL,
  `TagID` int(2) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reasearchtagtbl`
--

INSERT INTO `reasearchtagtbl` (`ResearchTagID`, `TagConnectorKey`, `TagID`, `dateCreated`) VALUES
(1, 2147483647, 1, '2024-09-16 11:44:22'),
(2, 2147483647, 1, '2024-09-16 11:45:52'),
(3, 2147483647, 1, '2024-09-16 11:46:38'),
(4, 2147483647, 1, '2024-09-16 11:47:04'),
(5, 2147483647, 1, '2024-09-16 11:47:26'),
(6, 2147483647, 1, '2024-09-16 11:48:12'),
(7, 2147483647, 1, '2024-09-16 11:53:13'),
(8, 2147483647, 1, '2024-09-16 11:57:34'),
(9, 2147483647, 1, '2024-09-16 12:00:14'),
(10, 2147483647, 1, '2024-09-16 12:07:40'),
(11, 2147483647, 1, '2024-09-16 15:29:30'),
(12, 2147483647, 1, '2024-09-16 15:30:49'),
(13, 2147483647, 1, '2024-09-16 15:32:19'),
(14, 202409161736, 1, '2024-09-16 15:50:36'),
(15, 202409161753, 1, '2024-09-16 15:50:53'),
(16, 202409210539, 1, '2024-09-21 03:36:39');

-- --------------------------------------------------------

--
-- Table structure for table `requesttbl`
--

CREATE TABLE `requesttbl` (
  `RequestID` int(13) NOT NULL,
  `UID` int(50) NOT NULL,
  `ResearchID` int(250) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `researchfilelogtbl`
--

CREATE TABLE `researchfilelogtbl` (
  `update` int(200) NOT NULL,
  `ResearchID` int(100) NOT NULL,
  `newfilename` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `researchfilelogtbl`
--

INSERT INTO `researchfilelogtbl` (`update`, `ResearchID`, `newfilename`, `timestamp`) VALUES
(3, 9, '20240925152159.pdf', '2024-09-25 13:21:59'),
(9, 9, '20240926052216.pdf', '2024-09-26 03:22:16'),
(10, 9, '20241014153826.pdf', '2024-10-14 13:38:26');

-- --------------------------------------------------------

--
-- Table structure for table `researchroletbl`
--

CREATE TABLE `researchroletbl` (
  `ResearchRoleID` int(255) NOT NULL,
  `RoleConnectorKey` bigint(250) NOT NULL,
  `UID` int(50) NOT NULL,
  `Role` varchar(20) NOT NULL,
  `Date` int(20) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `researchroletbl`
--

INSERT INTO `researchroletbl` (`ResearchRoleID`, `RoleConnectorKey`, `UID`, `Role`, `Date`) VALUES
(6, 2147483647, 22, 'Leader', 2147483647),
(7, 2147483647, 23, 'Adviser', 2147483647),
(8, 2147483647, 23, 'Expert', 2147483647),
(9, 2147483647, 22, 'Member', 2147483647),
(10, 2147483647, 22, 'Member', 2147483647),
(11, 2147483647, 22, 'Member', 2147483647),
(12, 2147483647, 23, 'Panel0', 2147483647),
(13, 2147483647, 23, 'Panel1', 2147483647),
(14, 2147483647, 23, 'Panel2', 2147483647),
(15, 2147483647, 22, 'Leader', 2147483647),
(16, 2147483647, 23, 'Adviser', 2147483647),
(17, 2147483647, 23, 'Expert', 2147483647),
(18, 2147483647, 22, 'Member', 2147483647),
(19, 2147483647, 22, 'Member', 2147483647),
(20, 2147483647, 22, 'Member', 2147483647),
(21, 2147483647, 23, 'Panel1', 2147483647),
(22, 2147483647, 23, 'Panel2', 2147483647),
(23, 2147483647, 23, 'Panel3', 2147483647),
(24, 2147483647, 22, 'Leader', 2147483647),
(25, 2147483647, 23, 'Adviser', 2147483647),
(26, 2147483647, 23, 'Expert', 2147483647),
(27, 2147483647, 22, 'Member', 2147483647),
(28, 2147483647, 22, 'Member', 2147483647),
(29, 2147483647, 22, 'Member', 2147483647),
(30, 2147483647, 23, 'Panel1', 2147483647),
(31, 2147483647, 23, 'Panel2', 2147483647),
(32, 2147483647, 23, 'Panel3', 2147483647),
(33, 2147483647, 22, 'Leader', 2147483647),
(34, 2147483647, 23, 'Adviser', 2147483647),
(35, 2147483647, 23, 'Expert', 2147483647),
(36, 2147483647, 22, 'Member', 2147483647),
(37, 2147483647, 22, 'Member', 2147483647),
(38, 2147483647, 22, 'Member', 2147483647),
(39, 2147483647, 23, 'Panel1', 2147483647),
(40, 2147483647, 23, 'Panel2', 2147483647),
(41, 2147483647, 23, 'Panel3', 2147483647),
(42, 2147483647, 12, 'Leader', 2147483647),
(43, 2147483647, 13, 'Adviser', 2147483647),
(44, 2147483647, 13, 'Expert', 2147483647),
(45, 2147483647, 12, 'Member', 2147483647),
(46, 2147483647, 12, 'Member', 2147483647),
(47, 2147483647, 12, 'Member', 2147483647),
(48, 2147483647, 13, 'Panel1', 2147483647),
(49, 2147483647, 13, 'Panel2', 2147483647),
(50, 2147483647, 13, 'Panel3', 2147483647),
(51, 2147483647, 12, 'Leader', 2147483647),
(52, 2147483647, 13, 'Adviser', 2147483647),
(53, 2147483647, 13, 'Expert', 2147483647),
(54, 2147483647, 12, 'Member', 2147483647),
(55, 2147483647, 12, 'Member', 2147483647),
(56, 2147483647, 12, 'Member', 2147483647),
(57, 2147483647, 13, 'Panel1', 2147483647),
(58, 2147483647, 13, 'Panel2', 2147483647),
(59, 2147483647, 13, 'Panel3', 2147483647),
(60, 2147483647, 12, 'Leader', 2147483647),
(61, 2147483647, 13, 'Adviser', 2147483647),
(62, 2147483647, 13, 'Expert', 2147483647),
(63, 2147483647, 12, 'Member', 2147483647),
(64, 2147483647, 12, 'Member', 2147483647),
(65, 2147483647, 12, 'Member', 2147483647),
(66, 2147483647, 13, 'Panel1', 2147483647),
(67, 2147483647, 13, 'Panel2', 2147483647),
(68, 2147483647, 13, 'Panel3', 2147483647),
(69, 2147483647, 12, 'Leader', 2147483647),
(70, 2147483647, 13, 'Adviser', 2147483647),
(71, 2147483647, 13, 'Expert', 2147483647),
(72, 2147483647, 12, 'Member', 2147483647),
(73, 2147483647, 12, 'Member', 2147483647),
(74, 2147483647, 12, 'Member', 2147483647),
(75, 2147483647, 13, 'Panel1', 2147483647),
(76, 2147483647, 13, 'Panel2', 2147483647),
(77, 2147483647, 13, 'Panel3', 2147483647),
(78, 2147483647, 12, 'Leader', 2147483647),
(79, 2147483647, 13, 'Adviser', 2147483647),
(80, 2147483647, 13, 'Expert', 2147483647),
(81, 2147483647, 12, 'Member', 2147483647),
(82, 2147483647, 12, 'Member', 2147483647),
(83, 2147483647, 12, 'Member', 2147483647),
(84, 2147483647, 13, 'Panel1', 2147483647),
(85, 2147483647, 13, 'Panel2', 2147483647),
(86, 2147483647, 13, 'Panel3', 2147483647),
(87, 202409161736, 12, 'Leader', 2147483647),
(88, 202409161736, 13, 'Adviser', 2147483647),
(89, 202409161736, 13, 'Expert', 2147483647),
(90, 202409161736, 12, 'Member', 2147483647),
(91, 202409161736, 12, 'Member', 2147483647),
(92, 202409161736, 12, 'Member', 2147483647),
(93, 202409161736, 13, 'Panel1', 2147483647),
(94, 202409161736, 13, 'Panel2', 2147483647),
(95, 202409161736, 13, 'Panel3', 2147483647),
(96, 202409161753, 12, 'Leader', 2147483647),
(97, 202409161753, 13, 'Adviser', 2147483647),
(98, 202409161753, 13, 'Expert', 2147483647),
(99, 202409161753, 12, 'Member', 2147483647),
(100, 202409161753, 12, 'Member', 2147483647),
(101, 202409161753, 12, 'Member', 2147483647),
(102, 202409161753, 13, 'Panel1', 2147483647),
(103, 202409161753, 13, 'Panel2', 2147483647),
(104, 202409161753, 13, 'Panel3', 2147483647),
(105, 202409210539, 43, 'Leader', 2147483647),
(106, 202409210539, 1, 'Adviser', 2147483647),
(107, 202409210539, 12, 'Expert', 2147483647),
(108, 202409210539, 42, 'Member', 2147483647),
(109, 202409210539, 22, 'Member', 2147483647),
(110, 202409210539, 42, 'Member', 2147483647),
(111, 202409210539, 23, 'Panel1', 2147483647),
(112, 202409210539, 1, 'Panel2', 2147483647),
(113, 202409210539, 1, 'Panel3', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `researchtbl`
--

CREATE TABLE `researchtbl` (
  `ResearchID` int(250) NOT NULL,
  `SectionID` int(250) NOT NULL,
  `ImageName` varchar(100) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Abstract` text NOT NULL,
  `FileName` varchar(250) DEFAULT NULL,
  `YRPublished` varchar(100) DEFAULT NULL,
  `CourseID` int(5) NOT NULL,
  `RoleConnectorKey` bigint(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `researchtbl`
--

INSERT INTO `researchtbl` (`ResearchID`, `SectionID`, `ImageName`, `Title`, `Abstract`, `FileName`, `YRPublished`, `CourseID`, `RoleConnectorKey`, `date`) VALUES
(9, 2, '20240926052245facebook-logo-0.png', 'sdsdsasdad', 'adsa', '20241014153826.pdf', NULL, 1, 202409161736, '2024-09-16 15:50:37'),
(10, 2, '', 'sdsdsasdad', '', NULL, NULL, 1, 202409161753, '2024-09-16 15:50:53'),
(11, 2, '', 'una', 'hahahaha', NULL, NULL, 1, 202409210539, '2024-09-21 03:36:39');

-- --------------------------------------------------------

--
-- Table structure for table `sectionn&capteachertbl`
--

CREATE TABLE `sectionn&capteachertbl` (
  `SectionID` int(250) NOT NULL,
  `SectionName` varchar(13) NOT NULL,
  `CourseID` int(10) NOT NULL,
  `UID_Teacher` int(200) NOT NULL,
  `DateCreacted` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sectionn&capteachertbl`
--

INSERT INTO `sectionn&capteachertbl` (`SectionID`, `SectionName`, `CourseID`, `UID_Teacher`, `DateCreacted`) VALUES
(1, '4b', 1, 23, '2024-09-08 12:48:14'),
(2, '4g', 1, 13, '2024-09-08 13:12:58'),
(3, '4h', 1, 23, '2024-09-09 00:28:04'),
(4, '4h', 1, 23, '2024-09-09 00:28:09'),
(5, '4h', 1, 23, '2024-09-09 00:28:57'),
(6, '45', 1, 23, '2024-09-09 00:30:56'),
(7, '45', 1, 23, '2024-09-09 05:23:35'),
(8, 'sdf', 1, 12, '2024-10-05 04:43:18'),
(9, 'asds', 1, 12, '2024-10-05 04:45:52');

-- --------------------------------------------------------

--
-- Table structure for table `skillconnecttbl`
--

CREATE TABLE `skillconnecttbl` (
  `SkillConID` int(200) NOT NULL,
  `SkillID` int(20) NOT NULL,
  `ResearchRoleID` int(20) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `skilltbl`
--

CREATE TABLE `skilltbl` (
  `SkillID` int(20) NOT NULL,
  `SkillNAme` varchar(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sectionn&capteachertbl`
--

CREATE TABLE `sectionn&capteachertbl` (
  `StudentNSectionID` int(100) NOT NULL,
  `UID_Teacher` int(200) NOT NULL,
  `SectionId` int(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sectionn&capteachertbl`
--

INSERT INTO `sectionn&capteachertbl` (`StudentNSectionID`, `UID_Teacher`, `SectionId`, `date`) VALUES
(13, 21, 1, '2024-09-08 12:48:14'),
(14, 22, 1, '2024-09-08 12:48:14'),
(15, 22, 2, '2024-09-08 13:12:58'),
(18, 22, 5, '2024-09-09 00:28:57'),
(19, 24, 6, '2024-09-09 00:30:56'),
(20, 24, 7, '2024-09-09 05:23:35'),
(21, 25, 6, '2024-09-09 08:31:30'),
(22, 25, 6, '2024-09-09 08:31:32'),
(23, 25, 6, '2024-09-09 08:31:34'),
(24, 25, 6, '2024-09-09 08:31:45'),
(25, 25, 6, '2024-09-09 08:31:45'),
(26, 25, 6, '2024-09-09 08:32:52'),
(27, 25, 6, '2024-09-09 08:32:53'),
(28, 25, 6, '2024-09-09 08:32:54'),
(29, 25, 6, '2024-09-09 08:32:54'),
(30, 25, 6, '2024-09-09 08:32:54'),
(31, 25, 6, '2024-09-09 08:32:54'),
(32, 25, 6, '2024-09-09 08:32:55'),
(33, 25, 6, '2024-09-09 08:32:55'),
(34, 25, 6, '2024-09-09 08:39:06'),
(35, 25, 6, '2024-09-09 08:39:07'),
(36, 25, 6, '2024-09-09 08:39:08'),
(37, 25, 6, '2024-09-09 08:39:09'),
(38, 25, 6, '2024-09-09 08:39:09'),
(39, 25, 6, '2024-09-09 08:40:42'),
(40, 42, 2, '2024-09-21 03:31:47'),
(41, 43, 2, '2024-09-21 03:34:05'),
(42, 20, 2, '2024-09-26 02:52:31'),
(43, 22, 2, '2024-09-26 02:53:11'),
(44, 23, 9, '2024-10-05 04:45:52');

-- --------------------------------------------------------

--
-- Table structure for table `studentresearchratetbl`
--

CREATE TABLE `studentresearchratetbl` (
  `RRateID` int(13) NOT NULL,
  `UID` int(50) NOT NULL,
  `ResearchID` int(250) NOT NULL,
  `RaterUserType` int(1) NOT NULL,
  `Rate` int(1) NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentresearchratetbl`
--

INSERT INTO `studentresearchratetbl` (`RRateID`, `UID`, `ResearchID`, `RaterUserType`, `Rate`, `Date`) VALUES
(8, 35, 10, 3, 4, '2024-10-16'),
(9, 13, 11, 3, 3, '2024-10-16');

-- --------------------------------------------------------

--
-- Table structure for table `tagtbl`
--

CREATE TABLE `tagtbl` (
  `TagId` int(2) NOT NULL,
  `TagName` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tagtbl`
--

INSERT INTO `tagtbl` (`TagId`, `TagName`, `date`) VALUES
(1, 'hehe', '2024-09-16 11:33:14');

-- --------------------------------------------------------

--
-- Table structure for table `teacherratetbl`
--

CREATE TABLE `teacherratetbl` (
  `RateID` int(13) NOT NULL,
  `UID_Student` int(50) NOT NULL,
  `UID_Teacher` int(50) NOT NULL,
  `Rate` int(1) NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usertypetbl`
--

CREATE TABLE `usertypetbl` (
  `usertype` int(2) NOT NULL,
  `usertypename` varchar(50) NOT NULL,
  `UserStatus` int(2) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usertypetbl`
--

INSERT INTO `usertypetbl` (`usertype`, `usertypename`, `UserStatus`, `date`) VALUES
(1, 'admin', 1, '2024-08-28'),
(2, 'User', 2, '2024-09-06'),
(3, 'Teacher', 3, '2024-09-06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounttbl`
--
ALTER TABLE `accounttbl`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `SchoolId` (`SchoolId`),
  ADD KEY `Usertype` (`Usertype`);

--
-- Indexes for table `coursetbl`
--
ALTER TABLE `coursetbl`
  ADD PRIMARY KEY (`CourseID`);

--
-- Indexes for table `favoritetbl`
--
ALTER TABLE `favoritetbl`
  ADD PRIMARY KEY (`FavoriteID`),
  ADD KEY `UID` (`UID`),
  ADD KEY `ResearchID` (`ResearchID`);

--
-- Indexes for table `logtbl`
--
ALTER TABLE `logtbl`
  ADD PRIMARY KEY (`logID`),
  ADD KEY `UID` (`UID`);

--
-- Indexes for table `reasearchkeywordstbl`
--
ALTER TABLE `reasearchkeywordstbl`
  ADD PRIMARY KEY (`ReasearchKeyWordsD`),
  ADD KEY `KeywordConnectorKey` (`KeywordConnectorKey`);

--
-- Indexes for table `reasearchtagtbl`
--
ALTER TABLE `reasearchtagtbl`
  ADD PRIMARY KEY (`ResearchTagID`),
  ADD KEY `TagID` (`TagID`),
  ADD KEY `TagConnectorKey` (`TagConnectorKey`);

--
-- Indexes for table `requesttbl`
--
ALTER TABLE `requesttbl`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `UID` (`UID`),
  ADD KEY `ResearchID` (`ResearchID`);

--
-- Indexes for table `researchfilelogtbl`
--
ALTER TABLE `researchfilelogtbl`
  ADD PRIMARY KEY (`update`),
  ADD KEY `ResearchID` (`ResearchID`);

--
-- Indexes for table `researchroletbl`
--
ALTER TABLE `researchroletbl`
  ADD PRIMARY KEY (`ResearchRoleID`),
  ADD KEY `UID` (`UID`),
  ADD KEY `RoleConnectorKey` (`RoleConnectorKey`);

--
-- Indexes for table `researchtbl`
--
ALTER TABLE `researchtbl`
  ADD PRIMARY KEY (`ResearchID`),
  ADD KEY `CourseID` (`CourseID`),
  ADD KEY `SectionID` (`SectionID`),
  ADD KEY `RoleConnectorKey` (`RoleConnectorKey`);

--
-- Indexes for table `sectionn&capteachertbl`
--
ALTER TABLE `sectionn&capteachertbl`
  ADD PRIMARY KEY (`SectionID`),
  ADD KEY `CourseID` (`CourseID`),
  ADD KEY `UID_Teacher` (`UID_Teacher`);

--
-- Indexes for table `skillconnecttbl`
--
ALTER TABLE `skillconnecttbl`
  ADD PRIMARY KEY (`SkillConID`),
  ADD KEY `SkillID` (`SkillID`),
  ADD KEY `ResearchRoleID` (`ResearchRoleID`);

--
-- Indexes for table `skilltbl`
--
ALTER TABLE `skilltbl`
  ADD PRIMARY KEY (`SkillID`);

--
-- Indexes for table `sectionn&capteachertbl`
--
ALTER TABLE `sectionn&capteachertbl`
  ADD PRIMARY KEY (`StudentNSectionID`),
  ADD KEY `SectionId` (`SectionId`),
  ADD KEY `UID_Teacher` (`UID_Teacher`);

--
-- Indexes for table `studentresearchratetbl`
--
ALTER TABLE `studentresearchratetbl`
  ADD PRIMARY KEY (`RRateID`),
  ADD KEY `UID` (`UID`),
  ADD KEY `ResearchID` (`ResearchID`),
  ADD KEY `RaterUserType` (`RaterUserType`);

--
-- Indexes for table `tagtbl`
--
ALTER TABLE `tagtbl`
  ADD PRIMARY KEY (`TagId`),
  ADD KEY `TagName` (`TagName`);

--
-- Indexes for table `teacherratetbl`
--
ALTER TABLE `teacherratetbl`
  ADD PRIMARY KEY (`RateID`),
  ADD KEY `UID_Student` (`UID_Student`),
  ADD KEY `UID_Teacher` (`UID_Teacher`);

--
-- Indexes for table `usertypetbl`
--
ALTER TABLE `usertypetbl`
  ADD PRIMARY KEY (`usertype`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounttbl`
--
ALTER TABLE `accounttbl`
  MODIFY `UserID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `coursetbl`
--
ALTER TABLE `coursetbl`
  MODIFY `CourseID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `favoritetbl`
--
ALTER TABLE `favoritetbl`
  MODIFY `FavoriteID` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `logtbl`
--
ALTER TABLE `logtbl`
  MODIFY `logID` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reasearchkeywordstbl`
--
ALTER TABLE `reasearchkeywordstbl`
  MODIFY `ReasearchKeyWordsD` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `reasearchtagtbl`
--
ALTER TABLE `reasearchtagtbl`
  MODIFY `ResearchTagID` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `requesttbl`
--
ALTER TABLE `requesttbl`
  MODIFY `RequestID` int(13) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `researchfilelogtbl`
--
ALTER TABLE `researchfilelogtbl`
  MODIFY `update` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `researchroletbl`
--
ALTER TABLE `researchroletbl`
  MODIFY `ResearchRoleID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `researchtbl`
--
ALTER TABLE `researchtbl`
  MODIFY `ResearchID` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sectionn&capteachertbl`
--
ALTER TABLE `sectionn&capteachertbl`
  MODIFY `SectionID` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `skillconnecttbl`
--
ALTER TABLE `skillconnecttbl`
  MODIFY `SkillConID` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skilltbl`
--
ALTER TABLE `skilltbl`
  MODIFY `SkillID` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sectionn&capteachertbl`
--
ALTER TABLE `sectionn&capteachertbl`
  MODIFY `StudentNSectionID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `studentresearchratetbl`
--
ALTER TABLE `studentresearchratetbl`
  MODIFY `RRateID` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tagtbl`
--
ALTER TABLE `tagtbl`
  MODIFY `TagId` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teacherratetbl`
--
ALTER TABLE `teacherratetbl`
  MODIFY `RateID` int(13) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usertypetbl`
--
ALTER TABLE `usertypetbl`
  MODIFY `usertype` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounttbl`
--
ALTER TABLE `accounttbl`
  ADD CONSTRAINT `accounttbl_ibfk_1` FOREIGN KEY (`Usertype`) REFERENCES `usertypetbl` (`usertype`);

--
-- Constraints for table `favoritetbl`
--
ALTER TABLE `favoritetbl`
  ADD CONSTRAINT `favoritetbl_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `accounttbl` (`UserID`),
  ADD CONSTRAINT `favoritetbl_ibfk_2` FOREIGN KEY (`ResearchID`) REFERENCES `researchtbl` (`ResearchID`);

--
-- Constraints for table `logtbl`
--
ALTER TABLE `logtbl`
  ADD CONSTRAINT `logtbl_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `accounttbl` (`UserID`);

--
-- Constraints for table `reasearchtagtbl`
--
ALTER TABLE `reasearchtagtbl`
  ADD CONSTRAINT `reasearchtagtbl_ibfk_1` FOREIGN KEY (`TagID`) REFERENCES `tagtbl` (`TagId`);

--
-- Constraints for table `requesttbl`
--
ALTER TABLE `requesttbl`
  ADD CONSTRAINT `requesttbl_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `accounttbl` (`UserID`),
  ADD CONSTRAINT `requesttbl_ibfk_2` FOREIGN KEY (`ResearchID`) REFERENCES `researchtbl` (`ResearchID`);

--
-- Constraints for table `researchfilelogtbl`
--
ALTER TABLE `researchfilelogtbl`
  ADD CONSTRAINT `researchfilelogtbl_ibfk_1` FOREIGN KEY (`ResearchID`) REFERENCES `researchtbl` (`ResearchID`);

--
-- Constraints for table `researchroletbl`
--
ALTER TABLE `researchroletbl`
  ADD CONSTRAINT `researchroletbl_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `accounttbl` (`UserID`);

--
-- Constraints for table `researchtbl`
--
ALTER TABLE `researchtbl`
  ADD CONSTRAINT `researchtbl_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `coursetbl` (`CourseID`),
  ADD CONSTRAINT `researchtbl_ibfk_10` FOREIGN KEY (`RoleConnectorKey`) REFERENCES `reasearchkeywordstbl` (`KeywordConnectorKey`),
  ADD CONSTRAINT `researchtbl_ibfk_11` FOREIGN KEY (`RoleConnectorKey`) REFERENCES `reasearchtagtbl` (`TagConnectorKey`),
  ADD CONSTRAINT `researchtbl_ibfk_5` FOREIGN KEY (`SectionID`) REFERENCES `sectionn&capteachertbl` (`SectionID`),
  ADD CONSTRAINT `researchtbl_ibfk_9` FOREIGN KEY (`RoleConnectorKey`) REFERENCES `researchroletbl` (`RoleConnectorKey`);

--
-- Constraints for table `sectionn&capteachertbl`
--
ALTER TABLE `sectionn&capteachertbl`
  ADD CONSTRAINT `sectionn&capteachertbl_ibfk_2` FOREIGN KEY (`CourseID`) REFERENCES `coursetbl` (`CourseID`),
  ADD CONSTRAINT `sectionn&capteachertbl_ibfk_3` FOREIGN KEY (`UID_Teacher`) REFERENCES `accounttbl` (`UserID`);

--
-- Constraints for table `skillconnecttbl`
--
ALTER TABLE `skillconnecttbl`
  ADD CONSTRAINT `skillconnecttbl_ibfk_1` FOREIGN KEY (`SkillID`) REFERENCES `skilltbl` (`SkillID`),
  ADD CONSTRAINT `skillconnecttbl_ibfk_2` FOREIGN KEY (`ResearchRoleID`) REFERENCES `researchroletbl` (`ResearchRoleID`);

--
-- Constraints for table `sectionn&capteachertbl`
--
ALTER TABLE `sectionn&capteachertbl`
  ADD CONSTRAINT `sectionn&capteachertbl_ibfk_2` FOREIGN KEY (`SectionId`) REFERENCES `sectionn&capteachertbl` (`SectionID`),
  ADD CONSTRAINT `sectionn&capteachertbl_ibfk_3` FOREIGN KEY (`UID_Teacher`) REFERENCES `accounttbl` (`UserID`);

--
-- Constraints for table `studentresearchratetbl`
--
ALTER TABLE `studentresearchratetbl`
  ADD CONSTRAINT `studentresearchratetbl_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `accounttbl` (`UserID`),
  ADD CONSTRAINT `studentresearchratetbl_ibfk_2` FOREIGN KEY (`ResearchID`) REFERENCES `researchtbl` (`ResearchID`),
  ADD CONSTRAINT `studentresearchratetbl_ibfk_3` FOREIGN KEY (`RaterUserType`) REFERENCES `usertypetbl` (`usertype`);

--
-- Constraints for table `teacherratetbl`
--
ALTER TABLE `teacherratetbl`
  ADD CONSTRAINT `teacherratetbl_ibfk_1` FOREIGN KEY (`UID_Student`) REFERENCES `accounttbl` (`UserID`),
  ADD CONSTRAINT `teacherratetbl_ibfk_2` FOREIGN KEY (`UID_Teacher`) REFERENCES `accounttbl` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
