-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
-- Server version: 10.3.27
-- PHP Version: 7.2.22
-- Student number: 100566816 

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `epiz_31582739_ABXTeam`
--

-- Table structure for table `HAS_ACCEPTED`
CREATE TABLE `HAS_ACCEPTED` (
  `Username` varchar(50) NOT NULL,
  `Request_ID` int(11) NOT NULL,
  `Acceptance_Status` char(9) NOT NULL,
  `Phials_Committed_To_Donate` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Table structure for table `HOSPITAL`
CREATE TABLE `HOSPITAL` (
  `Hospital_ID` int(11) NOT NULL,
  `Hospital_Name` varchar(80) NOT NULL,
  `Hospital_Address` varchar(80) NOT NULL,
  `Hospital_City` varchar(50) NOT NULL,
  `Hospital_Prefecture` varchar(50) NOT NULL,
  `Donation_Service_Phone` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Table structure for table `REQUEST`
CREATE TABLE `REQUEST` (
  `Request_ID` int(11) NOT NULL,
  `Request_Creation_Date` date NOT NULL,
  `Requested_Blood_Bags` int(11) NOT NULL,
  `Blood_Bags_Committed_To_Be_Donated` int(11) DEFAULT NULL,
  `Request_Status` char(9) NOT NULL,
  `Request_Is_Urgent` char(3) NOT NULL,
  `Request_Created_By` varchar(40) NOT NULL,
  `Patient_NINo` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Table structure for table `USERS`
CREATE TABLE `USERS` (
  `Username` varchar(50) NOT NULL,
  `User_Password` varchar(100) NOT NULL,
  `User_Email_Address` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Table structure for table `PATIENT`
CREATE TABLE `PATIENT` (
  `Patient_NINo` varchar(20) NOT NULL,
  `Patient_First_Name` varchar(40) NOT NULL,
  `Patient_Surname` varchar(40) NOT NULL,
  `Patient_Father_Name` varchar(40) DEFAULT NULL,
  `Patient_Hospitalised_In` varchar(60) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Indexes for dumped tables
--

--
-- Indexes for table `HAS_ACCEPTED`
--
ALTER TABLE `HAS_ACCEPTED`
  ADD PRIMARY KEY (`Username`,`Request_ID`),
  ADD KEY `Request_ID` (`Request_ID`);

--
-- Indexes for table `HOSPITAL`
--
ALTER TABLE `HOSPITAL`
  ADD PRIMARY KEY (`Hospital_ID`),
  ADD UNIQUE KEY `Hospital_Name` (`Hospital_Name`),
  ADD UNIQUE KEY `Hospital_Address` (`Hospital_Address`),
  ADD UNIQUE KEY `Donation_Service_Phone` (`Donation_Service_Phone`);

--
-- Indexes for table `PATIENT`
--
ALTER TABLE `PATIENT`
  ADD PRIMARY KEY (`Patient_NINo`);

--
-- Indexes for table `REQUEST`
--
ALTER TABLE `REQUEST`
  ADD PRIMARY KEY (`Request_ID`),
  ADD KEY `Patient_NINo` (`Patient_NINo`);

--
-- Indexes for table `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `REQUEST`
--
ALTER TABLE `REQUEST`
  MODIFY `Request_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2080;
COMMIT;

