-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2024 at 01:59 AM
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
  `Suffix` varchar(3) DEFAULT NULL,
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
(125, 'john.doe@example.com', 'TAL00-001', 'John', 'Doe', 'A.', 'Jr.', 1, '20241126015838Screenshot (16).png', '99a343809a241a46853fd225e471c727', '2024-11-25 19:13:33', 2),
(127, 'jane.smith@example.com', 'TAL00-002', 'Jane', 'Smith', 'B.', '', 2, NULL, 'e3808efd7e79fcab78d569a0844f4bba', '2024-11-25 19:14:54', 2),
(128, 'alex.johnson@example.com', 'TAL00-003', 'Alex', 'Johnson', 'C.', 'III', 1, NULL, '20b264fe03859dd8124ce5ec6bea315b', '2024-11-25 19:14:54', 3),
(129, 'mary.brown@example.com', 'TAL00-004', 'Mary', 'Brown', 'D.', '', 2, NULL, 'cb564d47c997a3365d3a2596e64d8500', '2024-11-25 19:14:54', 3),
(130, 'james.davis@example.com', 'TAL00-005', 'James', 'Davis', 'E.', 'Sr.', 1, NULL, 'c215632e78f5621af941d163c4434775', '2024-11-25 19:14:54', 2),
(131, 'emily.miller@example.com', 'TAL00-006', 'Emily', 'Miller', 'F.', '', 2, NULL, '7559a5e8ca2144e7347587cd9e1014fa', '2024-11-25 19:14:54', 3),
(132, 'robert.wilson@example.com', 'TAL00-007', 'Robert', 'Wilson', 'G.', 'Jr.', 1, NULL, 'f3b2dacfa5041b1277d154a90a28c49d', '2024-11-25 19:14:54', 1),
(133, 'linda.moore@example.com', 'TAL00-008', 'Linda', 'Moore', 'H.', '', 2, NULL, '205b70cc13bbc22e91be5590fb80ec21', '2024-11-25 19:14:54', 2),
(134, 'michael.taylor@example.com', 'TAL00-009', 'Michael', 'Taylor', 'I.', 'III', 1, '20241126023637onlyfans-logo-0 (1).png', '59dc270b582de0595941bfc008a9737b', '2024-11-25 19:14:54', 2),
(135, 'sarah.anderson@example.com', 'TAL00-010', 'Sarah', 'Anderson', 'J.', '', 2, NULL, 'c0184ed9d1bfb4c34a7b7b1ab6f306fd', '2024-11-25 19:14:54', 1),
(136, 'william.thomas@example.com', 'TAL00-011', 'William', 'Thomas', 'K.', 'Sr.', 1, NULL, 'e11d0e2ee3364fcced52551daa675d6c', '2024-11-25 19:14:54', 2),
(137, 'elizabeth.jackson@example.com', 'TAL00-012', 'Elizabeth', 'Jackson', 'L.', '', 2, NULL, '66fbc614898ef8227d17aa11ac3bb491', '2024-11-25 19:14:54', 3),
(138, 'david.white@example.com', 'TAL00-013', 'David', 'White', 'M.', 'Jr.', 1, NULL, 'f24e6b267d209a3c9f4c8ef8c0f914a5', '2024-11-25 19:14:54', 1),
(139, 'susan.harris@example.com', 'TAL00-014', 'Susan', 'Harris', 'N.', '', 2, NULL, '85d76e4fdfd4ae5812dd009ee2f32a0c', '2024-11-25 19:14:54', 2),
(140, 'joseph.martin@example.com', 'TAL00-015', 'Joseph', 'Martin', 'O.', 'III', 1, NULL, 'da95ec41de72745ae5acb725c990c4a9', '2024-11-25 19:14:54', 3),
(141, 'patricia.lee@example.com', 'TAL00-016', 'Patricia', 'Lee', 'P.', '', 2, NULL, '3435480f965ac861db000a0e816b13c9', '2024-11-25 19:14:54', 1),
(142, 'charles.young@example.com', 'TAL00-017', 'Charles', 'Young', 'Q.', 'Sr.', 1, NULL, '00b9e6144f17e013bc42881930b9e7ef', '2024-11-25 19:14:54', 2),
(143, 'karen.walker@example.com', 'TAL00-018', 'Karen', 'Walker', 'R.', '', 2, NULL, '38d483075d63404a10cc06ee438a7d08', '2024-11-25 19:14:54', 3),
(144, 'thomas.hall@example.com', 'TAL00-019', 'Thomas', 'Hall', 'S.', 'Jr.', 1, NULL, 'd2b0f31c313fc21c8ff14f5b616a2831', '2024-11-25 19:14:54', 1),
(145, 'barbara.allen@example.com', 'TAL00-020', 'Barbara', 'Allen', 'T.', '', 2, NULL, '74bdb9a16e0478ef2a382198a0831950', '2024-11-25 19:14:54', 2),
(146, 'mark.king@example.com', 'TAL00-021', 'Mark', 'King', 'U.', '', 1, NULL, '22c78a2bd9d350b0bfd7ed49070afeae', '2024-11-25 19:47:39', 2),
(147, 'nancy.wright@example.com', 'TAL00-022', 'Nancy', 'Wright', 'V.', '', 2, NULL, 'bf3fd85c7ae3e2efbe977c344585be2b', '2024-11-25 19:47:39', 3),
(148, 'paul.lopez@example.com', 'TAL00-023', 'Paul', 'Lopez', 'W.', '', 1, NULL, '4f8863d316aab45032ca950db363f2cc', '2024-11-25 19:47:39', 3),
(149, 'lisa.hill@example.com', 'TAL00-024', 'Lisa', 'Hill', 'X.', '', 2, NULL, '6989b709181f5ced18e9b1884c82ecd1', '2024-11-25 19:47:39', 2),
(150, 'kevin.scott@example.com', 'TAL00-025', 'Kevin', 'Scott', 'Y.', '', 1, NULL, '958e0736f797cecb622e619c001f82a1', '2024-11-25 19:47:39', 3),
(151, 'laura.green@example.com', 'TAL00-026', 'Laura', 'Green', 'Z.', '', 2, NULL, 'a88463b0640dfcf91de3210fd46a21e1', '2024-11-25 19:47:39', 3),
(152, 'steven.adams@example.com', 'TAL00-027', 'Steven', 'Adams', 'A.', '', 1, NULL, '53dea60825bf8fe771f47c9701b3ff72', '2024-11-25 19:47:39', 2),
(153, 'betty.baker@example.com', 'TAL00-028', 'Betty', 'Baker', 'B.', '', 2, NULL, '3e060c015d3206b7a713cc3088706a98', '2024-11-25 19:47:39', 3),
(154, 'brian.gonzalez@example.com', 'TAL00-029', 'Brian', 'Gonzalez', 'C.', '', 1, NULL, '37b62f0c418f81b2a297df82641bf8fe', '2024-11-25 19:47:39', 3),
(155, 'sandra.nelson@example.com', 'TAL00-030', 'Sandra', 'Nelson', 'D.', '', 2, NULL, '706f1bbc331eca264e29f07e2f9b6f8a', '2024-11-25 19:47:39', 2),
(156, 'andrew.carter@example.com', 'TAL00-031', 'Andrew', 'Carter', 'E.', '', 1, NULL, 'cc8e48375954f3e40cc8aa3732e8949b', '2024-11-25 19:47:39', 3),
(157, 'donna.mitchell@example.com', 'TAL00-032', 'Donna', 'Mitchell', 'F.', '', 2, NULL, '8920d3fa5250b7405fc71f21bfef6f9c', '2024-11-25 19:47:39', 3),
(158, 'eric.perez@example.com', 'TAL00-033', 'Eric', 'Perez', 'G.', '', 1, NULL, '2d2ea1ffae65da1363a79417d9bcea2e', '2024-11-25 19:47:39', 2),
(159, 'michelle.roberts@example.com', 'TAL00-034', 'Michelle', 'Roberts', 'H.', '', 2, NULL, 'a5483f3735e1e50ad4a06f9db6e7b71a', '2024-11-25 19:47:39', 3),
(160, 'patrick.turner@example.com', 'TAL00-035', 'Patrick', 'Turner', 'I.', '', 1, NULL, '838a2c5a35bdee5b1d2f9e86fa64d7ac', '2024-11-25 19:47:39', 3),
(161, 'angela.phillips@example.com', 'TAL00-036', 'Angela', 'Phillips', 'J.', '', 2, NULL, 'ec351cd93e4a7851ca52028ead02ab36', '2024-11-25 19:47:39', 2),
(162, 'george.campbell@example.com', 'TAL00-037', 'George', 'Campbell', 'K.', '', 1, NULL, '98319852d420d7b1c5d99395b465a968', '2024-11-25 19:47:39', 3),
(163, 'deborah.parker@example.com', 'TAL00-038', 'Deborah', 'Parker', 'L.', '', 2, NULL, 'bb57c0c12de54d339817b54b038554b9', '2024-11-25 19:47:39', 3),
(164, 'kyle.evans@example.com', 'TAL00-039', 'Kyle', 'Evans', 'M.', '', 1, NULL, '93cf8a52b372f4dad06e6864f18339b1', '2024-11-25 19:47:39', 2),
(165, 'amanda.edwards@example.com', 'TAL00-040', 'Amanda', 'Edwards', 'N.', '', 2, NULL, '3a49378cf203f9e5e7f8faef53b4231b', '2024-11-25 19:47:39', 3);

-- --------------------------------------------------------

--
-- Table structure for table `best_research`
--

CREATE TABLE `best_research` (
  `BestResearchid` int(11) NOT NULL,
  `ResearchID` int(200) NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `best_research`
--

INSERT INTO `best_research` (`BestResearchid`, `ResearchID`, `DateCreated`) VALUES
(2, 17, '2024-11-26 09:16:25');

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
(3, 'BSIT', 'Bachelor of Science in Information Technology', 'The program emphasizes software development, database management, web and mobile app creation, cybersecurity, and IT project management.', '2024-11-25 20:04:33'),
(4, 'BSBA ', ' Bachelor of Science in Business Administration', 'The program covers marketing, finance, entrepreneurship, human resource management, and operations.', '2024-11-25 20:05:08'),
(5, 'BEED', 'Bachelor of Elementary Education', 'The program trains future educators in teaching methodologies, child psychology, curriculum development, and subject-specific instruction.', '2024-11-25 20:05:36');

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
(7, 129, 17, 1, '2024-11-27'),
(8, 129, 18, 1, '2024-11-27');

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
(11, 125, '2023-10-26 01:24:57', '2024-12-03 01:24:57'),
(12, 125, '2024-11-26 01:29:28', '2024-12-03 01:29:28'),
(13, 125, '2024-11-26 01:29:36', '2024-12-03 01:29:36'),
(14, 125, '2024-12-26 01:30:56', '2024-12-03 01:30:56'),
(15, 125, '2024-11-26 01:31:51', '2024-12-03 01:31:51'),
(16, 127, '2024-10-26 01:43:16', '2024-12-03 01:43:16'),
(17, 125, '2024-09-26 01:45:55', '2024-12-03 01:45:55'),
(18, 125, '2024-08-26 01:51:18', '2024-12-03 01:51:18'),
(19, 134, '2024-06-26 02:35:39', '2024-12-03 02:35:39'),
(20, 129, '2023-11-26 02:40:35', '2024-12-03 02:40:35'),
(21, 125, '2024-11-26 05:15:41', '2024-12-03 05:15:41'),
(22, 125, '2024-11-26 11:39:29', '2024-12-03 11:39:29'),
(23, 129, '2024-11-26 13:32:30', '2024-12-03 13:32:30'),
(24, 125, '2024-11-26 15:31:55', '2024-12-03 15:31:55'),
(25, 129, '2024-11-26 22:46:23', '2024-12-03 22:46:23'),
(26, 129, '2024-11-26 22:46:47', '2024-12-03 22:46:47'),
(27, 129, '2024-11-26 22:59:05', '2024-12-03 22:59:05'),
(28, 129, '2024-11-26 23:03:50', '2024-12-03 23:03:50'),
(29, 125, '2024-11-26 23:04:05', '2024-12-03 23:04:05'),
(30, 129, '2024-11-26 23:12:52', '2024-12-03 23:12:52'),
(31, 129, '2024-11-26 23:19:24', '2024-12-03 23:19:24'),
(32, 129, '2024-11-26 23:19:49', '2024-12-03 23:19:49'),
(33, 125, '2024-11-27 01:26:43', '2024-12-04 01:26:43');

-- --------------------------------------------------------

--
-- Table structure for table `reasearchkeywordstbl`
--

CREATE TABLE `reasearchkeywordstbl` (
  `ReasearchKeyWordsD` int(255) NOT NULL,
  `RoleConnectorKey` bigint(250) NOT NULL,
  `Keyword` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reasearchkeywordstbl`
--

INSERT INTO `reasearchkeywordstbl` (`ReasearchKeyWordsD`, `RoleConnectorKey`, `Keyword`, `date`) VALUES
(68, 20241126095534, 'UI', '2024-11-26 08:55:34'),
(69, 20241126153500, 'Cloud', '2024-11-26 14:35:00'),
(70, 20241126153500, 'online', '2024-11-26 14:35:00'),
(72, 20241127013916, 'ewan', '2024-11-27 00:39:16'),
(75, 20241127014513, 'mobile', '2024-11-27 00:45:13');

-- --------------------------------------------------------

--
-- Table structure for table `reasearchtagtbl`
--

CREATE TABLE `reasearchtagtbl` (
  `ResearchTagID` int(200) NOT NULL,
  `RoleConnectorKey` bigint(250) NOT NULL,
  `TagID` int(2) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reasearchtagtbl`
--

INSERT INTO `reasearchtagtbl` (`ResearchTagID`, `RoleConnectorKey`, `TagID`, `dateCreated`) VALUES
(58, 20241126095534, 27, '2024-11-26 08:55:34'),
(59, 20241126153500, 28, '2024-11-26 14:35:00'),
(60, 20241127013916, 29, '2024-11-27 00:39:16'),
(61, 20241127014513, 30, '2024-11-27 00:45:13');

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
(14, 17, '20241126101227.pdf', '2024-11-26 09:12:27');

-- --------------------------------------------------------

--
-- Table structure for table `researchroletbl`
--

CREATE TABLE `researchroletbl` (
  `ResearchRoleID` int(255) NOT NULL,
  `RoleConnectorKey` bigint(250) NOT NULL,
  `UID` int(50) NOT NULL,
  `Role` int(20) NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `researchroletbl`
--

INSERT INTO `researchroletbl` (`ResearchRoleID`, `RoleConnectorKey`, `UID`, `Role`, `Date`) VALUES
(22, 20241126095534, 127, 8, '2024-11-26'),
(23, 20241126095534, 128, 9, '2024-11-26'),
(24, 20241126095534, 129, 9, '2024-11-26'),
(25, 20241126095534, 142, 9, '2024-11-26'),
(26, 20241126095534, 138, 11, '2024-11-26'),
(27, 20241126153500, 130, 8, '2024-11-26'),
(28, 20241126153500, 131, 9, '2024-11-26'),
(29, 20241126153500, 128, 10, '2024-11-26'),
(30, 20241126153500, 141, 11, '2024-11-26'),
(33, 20241127013916, 132, 8, '2024-11-27');

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
(17, 26, '20241126101256ERD.png', 'Design and Implementation of a Disaster Preparedness Mobile Application', 'Natural disasters pose significant threats to communities, underscoring the need for effective preparedness tools. This study focuses on the design and implementation of a mobile application aimed at enhancing disaster preparedness among users. The application provides real-time alerts, emergency contact information, and a checklist for essential supplies. The research evaluates the usability, accessibility, and effectiveness of the app through user feedback and performance metrics. Results demonstrate that the application empowers individuals to respond proactively to potential disasters, promoting safety and resilience. This research emphasizes the role of technology in disaster management and preparedness.', '20241126101227.pdf', NULL, 3, 20241126095534, '2023-11-26 08:55:34'),
(18, 26, '', ' Cloud-Based Student Information System for Philippine Universities', 'The study investigates the development and implementation of a Cloud-Based Student Information System (SIS) tailored for Philippine universities. The research aims to streamline administrative tasks, improve data security, and facilitate better student information management. The system is designed to provide an easy-to-use interface for faculty, students, and administrators, with features such as grade tracking, attendance management, and academic history. Through a cloud-based platform, the system ensures that data is accessible, scalable, and secure. The results demonstrate the effectiveness of cloud technology in enhancing the functionality and efficiency of student information systems in the academic sector.\r\n\r\n', NULL, NULL, 3, 20241126153500, '2024-11-26 14:35:00'),
(20, 26, '', 'Development of a Web-Based Research Repository System for Efficient Data Management and Accessibilit', 'This study focuses on the development of a web-based research repository system designed to streamline the process of managing and accessing academic research papers. With the increasing volume of research output, there is a growing need for efficient systems that can categorize, store, and allow easy retrieval of research materials. The system aims to provide an intuitive interface where users can upload, search, and download research documents based on categories such as topic, author, and year of publication. The research utilizes a MySQL database for back-end storage and PHP for server-side processing, ensuring both scalability and security. The system will be evaluated based on usability, performance, and accuracy in retrieving relevant research papers. This project seeks to contribute to the growing need for effective academic resource management and improve the efficiency of research dissemination in educational institutions.', NULL, NULL, 3, 20241127013916, '2024-11-27 00:39:16');

-- --------------------------------------------------------

--
-- Table structure for table `roletbl`
--

CREATE TABLE `roletbl` (
  `RoleID` int(11) NOT NULL,
  `RoleName` varchar(20) NOT NULL,
  `Usertype` int(2) NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roletbl`
--

INSERT INTO `roletbl` (`RoleID`, `RoleName`, `Usertype`, `DateCreated`) VALUES
(8, 'Leader', 3, '2024-11-25 20:00:03'),
(9, 'Member', 3, '2024-11-25 20:00:24'),
(10, 'Adviser', 2, '2024-11-25 20:01:47'),
(11, 'Expert', 2, '2024-11-25 20:02:05');

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
(26, 'IT-101', 3, 125, '2024-11-25 21:25:29');

-- --------------------------------------------------------

--
-- Table structure for table `student&sectiontbl`
--

CREATE TABLE `student&sectiontbl` (
  `StudentNSectionID` int(100) NOT NULL,
  `UIDStudent` int(50) NOT NULL,
  `SectionId` int(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student&sectiontbl`
--

INSERT INTO `student&sectiontbl` (`StudentNSectionID`, `UIDStudent`, `SectionId`, `date`) VALUES
(47, 127, 26, '2024-11-25 21:25:29'),
(48, 128, 26, '2024-11-25 21:25:29'),
(49, 129, 26, '2024-11-25 21:25:29'),
(50, 130, 26, '2024-11-25 21:25:29'),
(51, 131, 26, '2024-11-25 21:25:29'),
(52, 132, 26, '2024-11-25 21:25:29'),
(53, 133, 26, '2024-11-25 21:25:29');

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
(37, 129, 17, 2, 5, '2024-11-27');

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
(27, 'UI/UX', '2024-11-26 04:58:59'),
(28, 'WEB', '2024-11-26 14:35:00'),
(29, 'sige', '2024-11-27 00:39:16'),
(30, 'Mobile app', '2024-11-27 00:45:13');

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

--
-- Dumping data for table `teacherratetbl`
--

INSERT INTO `teacherratetbl` (`RateID`, `UID_Student`, `UID_Teacher`, `Rate`, `Date`) VALUES
(1, 128, 137, 5, '2024-11-27'),
(2, 129, 138, 4, '2024-11-27');

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
(1, 'admin', 1, '2024-11-26'),
(2, 'Teacher', 2, '2024-11-26'),
(3, 'Student', 3, '2024-11-26');

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
  ADD KEY `accounttbl_ibfk_1` (`Usertype`);

--
-- Indexes for table `best_research`
--
ALTER TABLE `best_research`
  ADD PRIMARY KEY (`BestResearchid`);

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
  ADD KEY `ResearchID` (`ResearchID`),
  ADD KEY `favoritetbl_ibfk_1` (`UID`);

--
-- Indexes for table `logtbl`
--
ALTER TABLE `logtbl`
  ADD PRIMARY KEY (`logID`),
  ADD KEY `logtbl_ibfk_1` (`UID`);

--
-- Indexes for table `reasearchkeywordstbl`
--
ALTER TABLE `reasearchkeywordstbl`
  ADD PRIMARY KEY (`ReasearchKeyWordsD`),
  ADD KEY `KeywordConnectorKey` (`RoleConnectorKey`);

--
-- Indexes for table `reasearchtagtbl`
--
ALTER TABLE `reasearchtagtbl`
  ADD PRIMARY KEY (`ResearchTagID`),
  ADD KEY `TagConnectorKey` (`RoleConnectorKey`),
  ADD KEY `reasearchtagtbl_ibfk_1` (`TagID`);

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
  ADD KEY `RoleConnectorKey` (`RoleConnectorKey`),
  ADD KEY `researchroletbl_ibfk_1` (`UID`),
  ADD KEY `researchroletbl_ibfk_2` (`Role`);

--
-- Indexes for table `researchtbl`
--
ALTER TABLE `researchtbl`
  ADD PRIMARY KEY (`ResearchID`),
  ADD KEY `researchtbl_ibfk_1` (`CourseID`),
  ADD KEY `researchtbl_ibfk_11` (`RoleConnectorKey`),
  ADD KEY `researchtbl_ibfk_5` (`SectionID`);

--
-- Indexes for table `roletbl`
--
ALTER TABLE `roletbl`
  ADD PRIMARY KEY (`RoleID`),
  ADD KEY `roletbl_ibfk_1` (`Usertype`);

--
-- Indexes for table `sectionn&capteachertbl`
--
ALTER TABLE `sectionn&capteachertbl`
  ADD PRIMARY KEY (`SectionID`),
  ADD KEY `sectionn&capteachertbl_ibfk_2` (`CourseID`),
  ADD KEY `sectionn&capteachertbl_ibfk_3` (`UID_Teacher`);

--
-- Indexes for table `student&sectiontbl`
--
ALTER TABLE `student&sectiontbl`
  ADD PRIMARY KEY (`StudentNSectionID`),
  ADD KEY `student&sectiontbl_ibfk_2` (`SectionId`),
  ADD KEY `student&sectiontbl_ibfk_3` (`UIDStudent`);

--
-- Indexes for table `studentresearchratetbl`
--
ALTER TABLE `studentresearchratetbl`
  ADD PRIMARY KEY (`RRateID`),
  ADD KEY `studentresearchratetbl_ibfk_1` (`UID`),
  ADD KEY `studentresearchratetbl_ibfk_2` (`ResearchID`),
  ADD KEY `studentresearchratetbl_ibfk_3` (`RaterUserType`);

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
  ADD KEY `teacherratetbl_ibfk_1` (`UID_Student`),
  ADD KEY `teacherratetbl_ibfk_2` (`UID_Teacher`);

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
  MODIFY `UserID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `best_research`
--
ALTER TABLE `best_research`
  MODIFY `BestResearchid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coursetbl`
--
ALTER TABLE `coursetbl`
  MODIFY `CourseID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `favoritetbl`
--
ALTER TABLE `favoritetbl`
  MODIFY `FavoriteID` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `logtbl`
--
ALTER TABLE `logtbl`
  MODIFY `logID` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `reasearchkeywordstbl`
--
ALTER TABLE `reasearchkeywordstbl`
  MODIFY `ReasearchKeyWordsD` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `reasearchtagtbl`
--
ALTER TABLE `reasearchtagtbl`
  MODIFY `ResearchTagID` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `researchfilelogtbl`
--
ALTER TABLE `researchfilelogtbl`
  MODIFY `update` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `researchroletbl`
--
ALTER TABLE `researchroletbl`
  MODIFY `ResearchRoleID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `researchtbl`
--
ALTER TABLE `researchtbl`
  MODIFY `ResearchID` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `roletbl`
--
ALTER TABLE `roletbl`
  MODIFY `RoleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sectionn&capteachertbl`
--
ALTER TABLE `sectionn&capteachertbl`
  MODIFY `SectionID` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `student&sectiontbl`
--
ALTER TABLE `student&sectiontbl`
  MODIFY `StudentNSectionID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `studentresearchratetbl`
--
ALTER TABLE `studentresearchratetbl`
  MODIFY `RRateID` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tagtbl`
--
ALTER TABLE `tagtbl`
  MODIFY `TagId` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `teacherratetbl`
--
ALTER TABLE `teacherratetbl`
  MODIFY `RateID` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usertypetbl`
--
ALTER TABLE `usertypetbl`
  MODIFY `usertype` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  ADD CONSTRAINT `favoritetbl_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `accounttbl` (`UserID`) ON DELETE NO ACTION;

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
-- Constraints for table `researchroletbl`
--
ALTER TABLE `researchroletbl`
  ADD CONSTRAINT `researchroletbl_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `accounttbl` (`UserID`),
  ADD CONSTRAINT `researchroletbl_ibfk_2` FOREIGN KEY (`Role`) REFERENCES `roletbl` (`RoleID`);

--
-- Constraints for table `researchtbl`
--
ALTER TABLE `researchtbl`
  ADD CONSTRAINT `researchtbl_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `coursetbl` (`CourseID`),
  ADD CONSTRAINT `researchtbl_ibfk_10` FOREIGN KEY (`RoleConnectorKey`) REFERENCES `reasearchkeywordstbl` (`RoleConnectorKey`),
  ADD CONSTRAINT `researchtbl_ibfk_11` FOREIGN KEY (`RoleConnectorKey`) REFERENCES `reasearchtagtbl` (`RoleConnectorKey`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `researchtbl_ibfk_5` FOREIGN KEY (`SectionID`) REFERENCES `sectionn&capteachertbl` (`SectionID`);

--
-- Constraints for table `roletbl`
--
ALTER TABLE `roletbl`
  ADD CONSTRAINT `roletbl_ibfk_1` FOREIGN KEY (`Usertype`) REFERENCES `usertypetbl` (`usertype`);

--
-- Constraints for table `sectionn&capteachertbl`
--
ALTER TABLE `sectionn&capteachertbl`
  ADD CONSTRAINT `sectionn&capteachertbl_ibfk_2` FOREIGN KEY (`CourseID`) REFERENCES `coursetbl` (`CourseID`),
  ADD CONSTRAINT `sectionn&capteachertbl_ibfk_3` FOREIGN KEY (`UID_Teacher`) REFERENCES `accounttbl` (`UserID`);

--
-- Constraints for table `student&sectiontbl`
--
ALTER TABLE `student&sectiontbl`
  ADD CONSTRAINT `student&sectiontbl_ibfk_2` FOREIGN KEY (`SectionId`) REFERENCES `sectionn&capteachertbl` (`SectionID`),
  ADD CONSTRAINT `student&sectiontbl_ibfk_3` FOREIGN KEY (`UIDStudent`) REFERENCES `accounttbl` (`UserID`);

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
