-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2021 at 01:02 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendancemgtsys2`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `Id` int(10) NOT NULL,
  `staffId` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `otherName` varchar(50) NOT NULL,
  `emailAddress` varchar(50) NOT NULL,
  `phoneNo` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `adminTypeId` int(10) NOT NULL,
  `isPasswordChanged` varchar(10) NOT NULL,
  `isAssigned` varchar(10) NOT NULL,
  `dateCreated` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`Id`, `staffId`, `password`, `otherName`, `emailAddress`, `phoneNo`, `firstName`, `lastName`, `adminTypeId`, `isPasswordChanged`, `isAssigned`, `dateCreated`) VALUES
(2, '12344', '11111', '', 'super@gmail.com', '', 'super', 'super', 1, '', '', ''),
(3, '11111', '11111', 'Admin1', 'Admin1@gmail.com', '09088990099', 'Admin1', 'Admin1', 2, '0', '1', '2021-09-01');

-- --------------------------------------------------------

--
-- Table structure for table `tbladmintype`
--

CREATE TABLE `tbladmintype` (
  `Id` int(10) NOT NULL,
  `adminTypeName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbladmintype`
--

INSERT INTO `tbladmintype` (`Id`, `adminTypeName`) VALUES
(1, 'SuperAdministrator'),
(2, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `tblassignedadmin`
--

CREATE TABLE `tblassignedadmin` (
  `Id` int(10) NOT NULL,
  `staffId` int(10) NOT NULL,
  `departmentId` int(10) NOT NULL,
  `facultyId` int(10) NOT NULL,
  `dateAssigned` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblassignedadmin`
--

INSERT INTO `tblassignedadmin` (`Id`, `staffId`, `departmentId`, `facultyId`, `dateAssigned`) VALUES
(1, 11111, 1, 1, '2021-09-01');

-- --------------------------------------------------------

--
-- Table structure for table `tblassignedstaff`
--

CREATE TABLE `tblassignedstaff` (
  `Id` int(10) NOT NULL,
  `staffId` int(10) NOT NULL,
  `departmentId` int(10) NOT NULL,
  `facultyId` int(10) NOT NULL,
  `dateAssigned` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblassignedstaff`
--

INSERT INTO `tblassignedstaff` (`Id`, `staffId`, `departmentId`, `facultyId`, `dateAssigned`) VALUES
(1, 121212, 1, 1, '2021-09-01');

-- --------------------------------------------------------

--
-- Table structure for table `tblassignments`
--

CREATE TABLE `tblassignments` (
  `Id` int(10) NOT NULL,
  `staffId` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `scoreObtainable` int(10) NOT NULL,
  `passMark` int(10) NOT NULL,
  `deadLineDate` varchar(20) NOT NULL,
  `assignment` text NOT NULL,
  `levelId` int(10) NOT NULL,
  `courseId` int(10) NOT NULL,
  `dateCreated` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblassignments`
--

INSERT INTO `tblassignments` (`Id`, `staffId`, `title`, `description`, `scoreObtainable`, `passMark`, `deadLineDate`, `assignment`, `levelId`, `courseId`, `dateCreated`) VALUES
(11, '121212', 'Programming Basics 00111', 'Understanding programming lamguage', 50, 20, '2021-10-29', '153cfb04d57f6d70c10003035370c870.docx', 1, 2, '2021-09-01'),
(13, '121212', 'Programming Basics', 'Understanding programming', 30, 20, '2021-09-10', 'd7c881752751a729b3a95c6b55675500.xls', 1, 2, '2021-09-02');

-- --------------------------------------------------------

--
-- Table structure for table `tblassignmentsubmitted`
--

CREATE TABLE `tblassignmentsubmitted` (
  `Id` int(10) NOT NULL,
  `assignmentId` int(10) NOT NULL,
  `matricNo` varchar(255) NOT NULL,
  `levelId` int(10) NOT NULL,
  `courseId` int(10) NOT NULL,
  `description` text NOT NULL,
  `assignmentSubmitted` text NOT NULL,
  `staffId` varchar(255) NOT NULL,
  `scoreObtainable` int(10) NOT NULL,
  `scoreObtained` int(10) NOT NULL,
  `scoreStatus` varchar(50) NOT NULL,
  `staffNotes` text NOT NULL,
  `dateSubmitted` varchar(20) NOT NULL,
  `isGraded` int(10) NOT NULL,
  `dateGraded` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblassignmentsubmitted`
--

INSERT INTO `tblassignmentsubmitted` (`Id`, `assignmentId`, `matricNo`, `levelId`, `courseId`, `description`, `assignmentSubmitted`, `staffId`, `scoreObtainable`, `scoreObtained`, `scoreStatus`, `staffNotes`, `dateSubmitted`, `isGraded`, `dateGraded`) VALUES
(3, 11, 'NSCF/15/0001', 1, 2, 'My first Assignment', '9e7466419f5fe111126a5563d7f48dfe.txt', '121212', 50, 10, 'Failed', 'Fair', '2021-09-01', 1, '2021-09-02'),
(5, 11, 'NCSF/15/0002', 1, 2, 'Answers', '8bb2b1a1b093ffa0a93d1472d282d452.xlsx', '121212', 50, 40, 'Passed', 'Excellent', '2021-09-02', 1, '2021-09-02'),
(10, 13, 'NSCF/15/0001', 1, 2, 'Completed', '53fb0a55f8f3a762c8231343a49f7398.xls', '121212', 30, 0, '', '', '2021-09-03', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tblcourse`
--

CREATE TABLE `tblcourse` (
  `Id` int(10) NOT NULL,
  `courseTitle` varchar(255) NOT NULL,
  `courseCode` varchar(10) NOT NULL,
  `courseUnit` varchar(10) NOT NULL,
  `levelId` int(10) NOT NULL,
  `facultyId` int(10) NOT NULL,
  `departmentId` int(10) NOT NULL,
  `staffId` varchar(255) NOT NULL,
  `dateAdded` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcourse`
--

INSERT INTO `tblcourse` (`Id`, `courseTitle`, `courseCode`, `courseUnit`, `levelId`, `facultyId`, `departmentId`, `staffId`, `dateAdded`) VALUES
(2, 'Introduction to Computing', 'COM 111', '3', 1, 1, 1, '121212', '2021-09-01'),
(3, 'Introduction to programming', 'COM113', '3', 1, 1, 1, '121212', '2021-09-01');

-- --------------------------------------------------------

--
-- Table structure for table `tbldepartment`
--

CREATE TABLE `tbldepartment` (
  `Id` int(10) NOT NULL,
  `departmentName` varchar(255) NOT NULL,
  `facultyId` int(10) NOT NULL,
  `dateCreated` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbldepartment`
--

INSERT INTO `tbldepartment` (`Id`, `departmentName`, `facultyId`, `dateCreated`) VALUES
(1, 'Computer Science', 1, '2021-09-01');

-- --------------------------------------------------------

--
-- Table structure for table `tblfaculty`
--

CREATE TABLE `tblfaculty` (
  `Id` int(10) NOT NULL,
  `facultyName` varchar(255) NOT NULL,
  `dateCreated` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblfaculty`
--

INSERT INTO `tblfaculty` (`Id`, `facultyName`, `dateCreated`) VALUES
(1, 'School of Pure and Applied Science', '2021-09-01');

-- --------------------------------------------------------

--
-- Table structure for table `tbllevel`
--

CREATE TABLE `tbllevel` (
  `Id` int(10) NOT NULL,
  `levelName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbllevel`
--

INSERT INTO `tbllevel` (`Id`, `levelName`) VALUES
(1, 'ND1'),
(2, 'ND2'),
(3, 'HND1'),
(4, 'HND2');

-- --------------------------------------------------------

--
-- Table structure for table `tblstaff`
--

CREATE TABLE `tblstaff` (
  `Id` int(10) NOT NULL,
  `staffId` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `otherName` varchar(50) NOT NULL,
  `emailAddress` varchar(50) NOT NULL,
  `phoneNo` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `adminTypeId` int(10) NOT NULL,
  `isPasswordChanged` varchar(10) NOT NULL,
  `isAssigned` varchar(10) NOT NULL,
  `dateCreated` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblstaff`
--

INSERT INTO `tblstaff` (`Id`, `staffId`, `password`, `otherName`, `emailAddress`, `phoneNo`, `firstName`, `lastName`, `adminTypeId`, `isPasswordChanged`, `isAssigned`, `dateCreated`) VALUES
(1, '121212', '12345', 'lecturer1', 'lecturer1@gmail.com', '09087765444', 'lecturer1', 'lecturer1', 0, '0', '1', '2021-09-01');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudent`
--

CREATE TABLE `tblstudent` (
  `Id` int(10) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `otherName` varchar(255) NOT NULL,
  `matricNo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `levelId` int(10) NOT NULL,
  `facultyId` int(10) NOT NULL,
  `departmentId` int(10) NOT NULL,
  `dateCreated` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblstudent`
--

INSERT INTO `tblstudent` (`Id`, `firstName`, `lastName`, `otherName`, `matricNo`, `password`, `levelId`, `facultyId`, `departmentId`, `dateCreated`) VALUES
(1, 'SAMYY', 'sam', 'sam', 'NSCF/15/0001', '11111', 1, 1, 1, '2021-09-01'),
(2, 'Kenny', 'Samuel', 'Ola', 'NCSF/15/0002', '11111', 1, 1, 1, '2021-09-01'),
(3, 'akdhajk', 'kajdfjka', 'hkajdfk', 'NCSF/15/0003', 'password', 2, 1, 1, '2021-09-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tbladmintype`
--
ALTER TABLE `tbladmintype`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblassignedadmin`
--
ALTER TABLE `tblassignedadmin`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblassignedstaff`
--
ALTER TABLE `tblassignedstaff`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblassignments`
--
ALTER TABLE `tblassignments`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblassignmentsubmitted`
--
ALTER TABLE `tblassignmentsubmitted`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblcourse`
--
ALTER TABLE `tblcourse`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tbldepartment`
--
ALTER TABLE `tbldepartment`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblfaculty`
--
ALTER TABLE `tblfaculty`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tbllevel`
--
ALTER TABLE `tbllevel`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblstaff`
--
ALTER TABLE `tblstaff`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblstudent`
--
ALTER TABLE `tblstudent`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbladmintype`
--
ALTER TABLE `tbladmintype`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblassignedadmin`
--
ALTER TABLE `tblassignedadmin`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblassignedstaff`
--
ALTER TABLE `tblassignedstaff`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblassignments`
--
ALTER TABLE `tblassignments`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tblassignmentsubmitted`
--
ALTER TABLE `tblassignmentsubmitted`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblcourse`
--
ALTER TABLE `tblcourse`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbldepartment`
--
ALTER TABLE `tbldepartment`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblfaculty`
--
ALTER TABLE `tblfaculty`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbllevel`
--
ALTER TABLE `tbllevel`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblstaff`
--
ALTER TABLE `tblstaff`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblstudent`
--
ALTER TABLE `tblstudent`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
