-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2024 at 01:40 AM
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
  `IsMale` int(1) NOT NULL,
  `imageName` varchar(100) DEFAULT NULL,
  `Password` varchar(250) NOT NULL,
  `DateCreated` date NOT NULL DEFAULT current_timestamp(),
  `Usertype` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coursetbl`
--

CREATE TABLE `coursetbl` (
  `CourseID` int(5) NOT NULL,
  `CourseName` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `DateAdded` timestamp NOT NULL DEFAULT current_timestamp()
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
  `CourseID` varchar(10) NOT NULL,
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
-- Table structure for table `tagcountertbl`
--

CREATE TABLE `tagcountertbl` (
  `tagCounterID` int(50) NOT NULL,
  `TagId` int(2) NOT NULL,
  `datesearch` date NOT NULL DEFAULT current_timestamp()
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
  ADD PRIMARY KEY (`ResearchTagID`);

--
-- Indexes for table `requesttbl`
--
ALTER TABLE `requesttbl`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `UID` (`UID`);

--
-- Indexes for table `researchfilelogtbl`
--
ALTER TABLE `researchfilelogtbl`
  ADD PRIMARY KEY (`update`);

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
  ADD PRIMARY KEY (`ResearchID`);

--
-- Indexes for table `sectionn&capteachertbl`
--
ALTER TABLE `sectionn&capteachertbl`
  ADD PRIMARY KEY (`SectionID`);

--
-- Indexes for table `skillconnecttbl`
--
ALTER TABLE `skillconnecttbl`
  ADD PRIMARY KEY (`SkillConID`),
  ADD KEY `SkillID` (`SkillID`);

--
-- Indexes for table `skilltbl`
--
ALTER TABLE `skilltbl`
  ADD PRIMARY KEY (`SkillID`);

--
-- Indexes for table `student&sectiontbl`
--
ALTER TABLE `student&sectiontbl`
  ADD PRIMARY KEY (`StudentNSectionID`);

--
-- Indexes for table `studentresearchratetbl`
--
ALTER TABLE `studentresearchratetbl`
  ADD PRIMARY KEY (`RRateID`),
  ADD KEY `UID` (`UID`);

--
-- Indexes for table `tagcountertbl`
--
ALTER TABLE `tagcountertbl`
  ADD PRIMARY KEY (`tagCounterID`);

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
  MODIFY `UserID` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coursetbl`
--
ALTER TABLE `coursetbl`
  MODIFY `CourseID` int(5) NOT NULL AUTO_INCREMENT;

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
  MODIFY `SectionID` int(250) NOT NULL AUTO_INCREMENT;

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
  MODIFY `StudentNSectionID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studentresearchratetbl`
--
ALTER TABLE `studentresearchratetbl`
  MODIFY `RRateID` int(13) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tagcountertbl`
--
ALTER TABLE `tagcountertbl`
  MODIFY `tagCounterID` int(50) NOT NULL AUTO_INCREMENT;

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
  MODIFY `usertype` int(2) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounttbl`
--
ALTER TABLE `accounttbl`
  ADD CONSTRAINT `accounttbl_ibfk_1` FOREIGN KEY (`Usertype`) REFERENCES `usertypetbl` (`usertype`);

--
-- Constraints for table `logtbl`
--
ALTER TABLE `logtbl`
  ADD CONSTRAINT `logtbl_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `accounttbl` (`UserID`);

--
-- Constraints for table `requesttbl`
--
ALTER TABLE `requesttbl`
  ADD CONSTRAINT `requesttbl_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `accounttbl` (`UserID`);

--
-- Constraints for table `researchroletbl`
--
ALTER TABLE `researchroletbl`
  ADD CONSTRAINT `researchroletbl_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `accounttbl` (`UserID`),
  ADD CONSTRAINT `researchroletbl_ibfk_2` FOREIGN KEY (`RoleConnectorKey`) REFERENCES `skillconnecttbl` (`SkillConID`);

--
-- Constraints for table `skillconnecttbl`
--
ALTER TABLE `skillconnecttbl`
  ADD CONSTRAINT `skillconnecttbl_ibfk_1` FOREIGN KEY (`SkillID`) REFERENCES `skilltbl` (`SkillID`);

--
-- Constraints for table `studentresearchratetbl`
--
ALTER TABLE `studentresearchratetbl`
  ADD CONSTRAINT `studentresearchratetbl_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `accounttbl` (`UserID`);

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
