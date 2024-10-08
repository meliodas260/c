-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2024 at 02:30 PM
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
  `DateCreated` date NOT NULL DEFAULT current_timestamp(),
  `Usertype` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounttbl`
--

INSERT INTO `accounttbl` (`UserID`, `Email`, `SchoolId`, `Fname`, `Lname`, `Mname`, `Suffix`, `IsMale`, `imageName`, `Password`, `DateCreated`, `Usertype`) VALUES
(1, 'gj', '', 'fname', 'lname', 'mname', 'suf', 1, NULL, 'hashed_password', '2024-08-28', 1),
(2, 'asda', '232', '23', '23s', 'as', '32', 2, NULL, 'dfgdg', '2024-08-28', 1),
(4, 'asdfa', '23442', '23', '23s', 'as', '32', 2, NULL, 'dfgdg', '2024-08-28', 1),
(9, 'trinidadrachelle53@gmail.com', '3443', 'sdf', 'sdf', 'sdf', '', 0, NULL, '$2y$10$2BRDLRECKedGP9iGAtH0K.xhAjcRo4mhpsgaC1L714OhM5xR7LQiC', '2024-08-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `coursetbl`
--

CREATE TABLE `coursetbl` (
  `CourseID` int(5) NOT NULL,
  `CourseAcronym` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `DateAdded` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coursetbl`
--

INSERT INTO `coursetbl` (`CourseID`, `CourseAcronym`, `Description`, `DateAdded`) VALUES
(1, 'BSIT', 'asasdadsa', '2024-08-29 04:26:05');

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

-- --------------------------------------------------------

--
-- Table structure for table `reasearchkeywordstbl`
--

CREATE TABLE `reasearchkeywordstbl` (
  `ReasearchKeyWordsD` int(255) NOT NULL,
  `KeywordConnectorKey` int(250) NOT NULL,
  `Keyword` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reasearchtagtbl`
--

CREATE TABLE `reasearchtagtbl` (
  `ResearchTagID` int(200) NOT NULL,
  `TagConnectorKey` int(250) NOT NULL,
  `TagID` int(2) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `pastfilename` varchar(100) NOT NULL,
  `newfilename` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `researchroletbl`
--

CREATE TABLE `researchroletbl` (
  `ResearchRoleID` int(255) NOT NULL,
  `RoleConnectorKey` int(250) NOT NULL,
  `UID` int(50) NOT NULL,
  `Role` varchar(20) NOT NULL,
  `Date` int(20) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `researchtbl`
--

CREATE TABLE `researchtbl` (
  `ResearchID` int(250) NOT NULL,
  `ImageName` varchar(100) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Abstract` text NOT NULL,
  `FileName` varchar(250) NOT NULL,
  `YRPublished` varchar(100) DEFAULT NULL,
  `CourseID` int(5) NOT NULL,
  `RoleConnectorKey` int(250) NOT NULL,
  `TagConnectorKey` int(250) NOT NULL,
  `KeywordConnectorKey` int(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sectionn&capteachertbl`
--

CREATE TABLE `sectionn&capteachertbl` (
  `SectionID` int(250) NOT NULL,
  `SectionName` varchar(13) NOT NULL,
  `CourseID` int(10) NOT NULL,
  `SchoolYR` varchar(12) NOT NULL,
  `UID_Teacher` int(50) NOT NULL,
  `DateCreacted` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `student&sectiontbl`
--

CREATE TABLE `student&sectiontbl` (
  `StudentNSectionID` int(100) NOT NULL,
  `UID` int(50) NOT NULL,
  `SectionId` int(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `tagtbl`
--

CREATE TABLE `tagtbl` (
  `TagId` int(2) NOT NULL,
  `TagName` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'admin', 1, '2024-08-28');

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
  ADD PRIMARY KEY (`ReasearchKeyWordsD`);

--
-- Indexes for table `reasearchtagtbl`
--
ALTER TABLE `reasearchtagtbl`
  ADD PRIMARY KEY (`ResearchTagID`),
  ADD KEY `TagID` (`TagID`);

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
  ADD KEY `RoleConnectorKey` (`RoleConnectorKey`),
  ADD KEY `KeywordConnectorKey` (`KeywordConnectorKey`),
  ADD KEY `TagConnectorKey` (`TagConnectorKey`);

--
-- Indexes for table `sectionn&capteachertbl`
--
ALTER TABLE `sectionn&capteachertbl`
  ADD PRIMARY KEY (`SectionID`),
  ADD KEY `UID_Teacher` (`UID_Teacher`),
  ADD KEY `CourseID` (`CourseID`);

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
-- Indexes for table `student&sectiontbl`
--
ALTER TABLE `student&sectiontbl`
  ADD PRIMARY KEY (`StudentNSectionID`),
  ADD KEY `UID` (`UID`),
  ADD KEY `SectionId` (`SectionId`);

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
  ADD PRIMARY KEY (`TagId`);

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
  MODIFY `UserID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `coursetbl`
--
ALTER TABLE `coursetbl`
  MODIFY `CourseID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `favoritetbl`
--
ALTER TABLE `favoritetbl`
  MODIFY `FavoriteID` int(13) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logtbl`
--
ALTER TABLE `logtbl`
  MODIFY `logID` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reasearchkeywordstbl`
--
ALTER TABLE `reasearchkeywordstbl`
  MODIFY `ReasearchKeyWordsD` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reasearchtagtbl`
--
ALTER TABLE `reasearchtagtbl`
  MODIFY `ResearchTagID` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requesttbl`
--
ALTER TABLE `requesttbl`
  MODIFY `RequestID` int(13) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `researchfilelogtbl`
--
ALTER TABLE `researchfilelogtbl`
  MODIFY `update` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `researchroletbl`
--
ALTER TABLE `researchroletbl`
  MODIFY `ResearchRoleID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `researchtbl`
--
ALTER TABLE `researchtbl`
  MODIFY `ResearchID` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sectionn&capteachertbl`
--
ALTER TABLE `sectionn&capteachertbl`
  MODIFY `SectionID` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT for table `student&sectiontbl`
--
ALTER TABLE `student&sectiontbl`
  MODIFY `StudentNSectionID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `studentresearchratetbl`
--
ALTER TABLE `studentresearchratetbl`
  MODIFY `RRateID` int(13) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tagtbl`
--
ALTER TABLE `tagtbl`
  MODIFY `TagId` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacherratetbl`
--
ALTER TABLE `teacherratetbl`
  MODIFY `RateID` int(13) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usertypetbl`
--
ALTER TABLE `usertypetbl`
  MODIFY `usertype` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  ADD CONSTRAINT `researchtbl_ibfk_2` FOREIGN KEY (`RoleConnectorKey`) REFERENCES `researchroletbl` (`ResearchRoleID`),
  ADD CONSTRAINT `researchtbl_ibfk_3` FOREIGN KEY (`KeywordConnectorKey`) REFERENCES `reasearchkeywordstbl` (`ReasearchKeyWordsD`),
  ADD CONSTRAINT `researchtbl_ibfk_4` FOREIGN KEY (`TagConnectorKey`) REFERENCES `reasearchtagtbl` (`ResearchTagID`);

--
-- Constraints for table `sectionn&capteachertbl`
--
ALTER TABLE `sectionn&capteachertbl`
  ADD CONSTRAINT `sectionn&capteachertbl_ibfk_1` FOREIGN KEY (`UID_Teacher`) REFERENCES `accounttbl` (`UserID`),
  ADD CONSTRAINT `sectionn&capteachertbl_ibfk_2` FOREIGN KEY (`CourseID`) REFERENCES `coursetbl` (`CourseID`);

--
-- Constraints for table `skillconnecttbl`
--
ALTER TABLE `skillconnecttbl`
  ADD CONSTRAINT `skillconnecttbl_ibfk_1` FOREIGN KEY (`SkillID`) REFERENCES `skilltbl` (`SkillID`),
  ADD CONSTRAINT `skillconnecttbl_ibfk_2` FOREIGN KEY (`ResearchRoleID`) REFERENCES `researchroletbl` (`ResearchRoleID`);

--
-- Constraints for table `student&sectiontbl`
--
ALTER TABLE `student&sectiontbl`
  ADD CONSTRAINT `student&sectiontbl_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `accounttbl` (`UserID`),
  ADD CONSTRAINT `student&sectiontbl_ibfk_2` FOREIGN KEY (`SectionId`) REFERENCES `sectionn&capteachertbl` (`SectionID`);

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
