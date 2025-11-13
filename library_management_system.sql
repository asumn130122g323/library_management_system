-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2025 at 01:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
-- Database: `library_management_system`
-- --------------------------------------------------------
-- Table structure for table `admin`
CREATE TABLE `admin` (
  `AID` int(11) NOT NULL,
  `ANAME` varchar(150) NOT NULL,
  `APASS` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
-- Dumping data for table `admin`
INSERT INTO `admin` (`AID`, `ANAME`, `APASS`) VALUES
(1, 'admin', '1234');
-- --------------------------------------------------------
-- Table structure for table `book`
CREATE TABLE `book` (
  `BID` int(11) NOT NULL,
  `BTITLE` varchar(150) NOT NULL,
  `KEYWORDS` varchar(150) NOT NULL,
  `FILE` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
-- Dumping data for table `book`
INSERT INTO `book` (`BID`, `BTITLE`, `KEYWORDS`, `FILE`) VALUES
(6, 'javascript', 'java', 'books/javascript_tutorial.pdf');
-- --------------------------------------------------------
-- Table structure for table `comment`
CREATE TABLE `comment` (
  `CID` int(11) NOT NULL,
  `BID` int(11) NOT NULL,
  `SID` int(11) NOT NULL,
  `COMM` varchar(150) NOT NULL,
  `LOGS` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
-- Dumping data for table `comment`
INSERT INTO `comment` (`CID`, `BID`, `SID`, `COMM`, `LOGS`) VALUES
(1, 1, 1, 'easy understand the concept in this book', '2025-02-08 10:07:39'),
(2, 1, 1, 'good', '2025-02-09 15:10:37'),
(3, 1, 2, 'excellent', '2025-02-09 15:26:48'),
(4, 6, 1, 'super', '2025-02-09 15:58:32');
-- --------------------------------------------------------
-- Table structure for table `request`
CREATE TABLE `request` (
  `RID` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `MESS` text NOT NULL,
  `LOGS` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
-- Dumping data for table `request`
INSERT INTO `request` (`RID`, `ID`, `MESS`, `LOGS`) VALUES
(1, 1, 'need tamil story books', '2025-02-08 07:17:07'),
(2, 1, 'hi sir i need java books', '2025-02-09 13:30:31'),
(4, 1, '', '2025-02-09 13:54:19');
-- --------------------------------------------------------
-- Table structure for table `student`
CREATE TABLE `student` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(150) NOT NULL,
  `PASS` varchar(150) NOT NULL,
  `MAIL` varchar(150) NOT NULL,
  `DEP` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table `student`
INSERT INTO `student` (`ID`, `NAME`, `PASS`, `MAIL`, `DEP`) VALUES
(1, 'jai', 'jai24', 'jai@gmail.com', 'BSC'),
(2, 'sureya', '2409', 'sureya@gmail.com', 'BCA');
-- Indexes for dumped tableS
-- Indexes for table `admin
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AID`);
-- Indexes for table `book`
ALTER TABLE `book`
  ADD PRIMARY KEY (`BID`);
-- Indexes for table `comment`
ALTER TABLE `comment`
  ADD PRIMARY KEY (`CID`);
-- Indexes for table `request`
ALTER TABLE `request`
  ADD PRIMARY KEY (`RID`);
-- Indexes for table `student`
ALTER TABLE `student`
  ADD PRIMARY KEY (`ID`);
-- AUTO_INCREMENT for dumped tables
-- AUTO_INCREMENT for table `admin`
ALTER TABLE `admin`
  MODIFY `AID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
-- AUTO_INCREMENT for table `book`
ALTER TABLE `book`
  MODIFY `BID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
-- AUTO_INCREMENT for table `comment`
ALTER TABLE `comment`
  MODIFY `CID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
-- AUTO_INCREMENT for table `request`
ALTER TABLE `request`
  MODIFY `RID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
-- AUTO_INCREMENT for table `student`
ALTER TABLE `student`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;


