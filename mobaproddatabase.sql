-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 13, 2017 at 05:16 PM
-- Server version: 5.6.35
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `J2attieh`
--

-- --------------------------------------------------------

--
-- Table structure for table `Courses`
--

CREATE TABLE `Courses` (
  `DeptCode` char(5) DEFAULT NULL,
  `courseNumber` int(3) NOT NULL DEFAULT '0',
  `courseName` varchar(40) NOT NULL DEFAULT '',
  `courseTerm` varchar(6) NOT NULL DEFAULT '',
  `courseYear` int(4) NOT NULL DEFAULT '0',
  `courseType` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Courses`
--

INSERT INTO `Courses` (`DeptCode`, `courseNumber`, `courseName`, `courseTerm`, `courseYear`, `courseType`) VALUES
('Msci', 261, 'TestCourse', 'Spring', 2016, 'Option');

-- --------------------------------------------------------

--
-- Table structure for table `Instructors`
--

CREATE TABLE `Instructors` (
  `LastName` varchar(50) NOT NULL DEFAULT '',
  `FirstName` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Instructors`
--

INSERT INTO `Instructors` (`LastName`, `FirstName`) VALUES
('Attieh', 'Juana'),
('Golab', 'Lucas'),
('Hancock', 'Mark'),
('Smucker', 'Mark'),
('Pirnia', 'Merhdad');

-- --------------------------------------------------------

--
-- Table structure for table `ScoreUsedFor`
--

CREATE TABLE `ScoreUsedFor` (
  `courseName` varchar(40) NOT NULL DEFAULT '',
  `StudentID` int(8) NOT NULL DEFAULT '0',
  `Attribute` varchar(30) NOT NULL DEFAULT '',
  `Indicator` varchar(70) NOT NULL DEFAULT '',
  `ProgIndicator` varchar(70) NOT NULL DEFAULT '',
  `score` float DEFAULT NULL,
  `DeptCode` char(5) NOT NULL DEFAULT '',
  `CourseNumber` int(3) NOT NULL DEFAULT '0',
  `LastName` varchar(50) NOT NULL DEFAULT '',
  `FirstName` varchar(50) NOT NULL DEFAULT '',
  `courseTerm` varchar(6) NOT NULL DEFAULT '',
  `courseYear` int(4) NOT NULL DEFAULT '0',
  `Cohort` varchar(2) NOT NULL DEFAULT '',
  `courseType` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ScoreUsedFor`
--

INSERT INTO `ScoreUsedFor` (`courseName`, `StudentID`, `Attribute`, `Indicator`, `ProgIndicator`, `score`, `DeptCode`, `CourseNumber`, `LastName`, `FirstName`, `courseTerm`, `courseYear`, `Cohort`, `courseType`) VALUES
('TestCourse', 0, 'Recognize the key elements of ', '', '0.18', 0, '261x', 0, 'Pirnia', 'Mehrdad', 'Spring', 2016, '2A', 'Option'),
('TestCourse', 0, 'Recognize the key elements of ', '', '0.2', 0, '261x', 0, 'Attieh', 'Juana', 'Spring', 2016, '2A', 'Option'),
('TestCourse', 0, 'Recognize the key elements of ', '', '0.35', 0, '261x', 0, 'Pirnia', 'Mehrdad', 'Spring', 2016, '2A', 'Option'),
('TestCourse', 0, 'Recognize the key elements of ', '', '0.4', 0, '261x', 0, 'Pirnia', 'Mehrdad', 'Spring', 2016, '2A', 'Option'),
('TestCourse', 0, 'Recognize the key elements of ', '', '0.47', 0, '261x', 0, 'Pirnia', 'Mehrdad', 'Spring', 2016, '2A', 'Option'),
('TestCourse', 0, 'Recognize the key elements of ', '', '0.54', 0, '261x', 0, 'Pirnia', 'Mehrdad', 'Spring', 2016, '2A', 'Option'),
('TestCourse', 0, 'Recognize the key elements of ', '', '0.66', 0, '261x', 0, 'Pirnia', 'Mehrdad', 'Spring', 2016, '2A', 'Option'),
('TestCourse', 310082419, 'Knowledge Base', 'Recognize the key elements of object-oriented programming using Java', '', 0.18, 'Msci', 261, 'Pirnia', 'Mehrdad', 'Spring', 2016, '2A', 'Option'),
('TestCourse', 533572169, 'Knowledge Base', 'Recognize the key elements of object-oriented programming using Java', '', 0.35, 'Msci', 261, 'Pirnia', 'Mehrdad', 'Spring', 2016, '2A', 'Option'),
('TestCourse', 598829620, 'Knowledge Base', 'Recognize the key elements of object-oriented programming using Java', '', 0.2, 'Msci', 261, 'Attieh', 'Juana', 'Spring', 2016, '2A', 'Option'),
('TestCourse', 684014860, 'Knowledge Base', 'Recognize the key elements of object-oriented programming using Java', '', 0.54, 'Msci', 261, 'Pirnia', 'Mehrdad', 'Spring', 2016, '2A', 'Option'),
('TestCourse', 820549378, 'Knowledge Base', 'Recognize the key elements of object-oriented programming using Java', '', 0.4, 'Msci', 261, 'Pirnia', 'Mehrdad', 'Spring', 2016, '2A', 'Option'),
('TestCourse', 843228181, 'Knowledge Base', 'Recognize the key elements of object-oriented programming using Java', '', 0.66, 'Msci', 261, 'Pirnia', 'Mehrdad', 'Spring', 2016, '2A', 'Option'),
('TestCourse', 975325712, 'Knowledge Base', 'Recognize the key elements of object-oriented programming using Java', '', 0.47, 'Msci', 261, 'Pirnia', 'Mehrdad', 'Spring', 2016, '2A', 'Option');

-- --------------------------------------------------------

--
-- Table structure for table `Students`
--

CREATE TABLE `Students` (
  `StudentID` int(8) NOT NULL,
  `GradYear` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Students`
--

INSERT INTO `Students` (`StudentID`, `GradYear`) VALUES
(112085131, '2019'),
(126539887, '2019'),
(208248363, '2019'),
(220052551, '2019'),
(242132470, '2019'),
(277055951, '2019'),
(310082419, '2019'),
(315378369, '2019'),
(356558346, '2019'),
(357061292, '2019'),
(363436152, '2019'),
(373048949, '2019'),
(393495083, '2019'),
(414520736, '2019'),
(444882790, '2019'),
(528297980, '2019'),
(533572169, '2019'),
(534292868, '2019'),
(563937624, '2019'),
(564410540, '2019'),
(588642518, '2019'),
(598829620, '2019'),
(633537205, '2019'),
(684014860, '2019'),
(684291511, '2019'),
(769635714, '2019'),
(815854164, '2019'),
(816787809, '2019'),
(820549378, '2019'),
(837310284, '2019'),
(843228181, '2019'),
(858571733, '2019'),
(902907559, '2019'),
(970698993, '2019'),
(975325712, '2019');

-- --------------------------------------------------------

--
-- Table structure for table `TeachesCourse`
--

CREATE TABLE `TeachesCourse` (
  `courseName` varchar(40) NOT NULL DEFAULT '',
  `courseTerm` varchar(6) NOT NULL DEFAULT '',
  `courseYear` int(4) NOT NULL DEFAULT '0',
  `courseNumber` int(3) NOT NULL DEFAULT '0',
  `FirstName` varchar(50) NOT NULL DEFAULT '',
  `LastName` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `TeachesCourse`
--

INSERT INTO `TeachesCourse` (`courseName`, `courseTerm`, `courseYear`, `courseNumber`, `FirstName`, `LastName`) VALUES
('Algorithms and Data Structures', 'Summer', 2015, 240, 'Mark', 'Hancock'),
('Calculus', 'Spring', 2016, 271, 'Merhdad', 'Pirnia'),
('Data Mining', 'Winter', 2017, 446, 'Lucas', 'Golab'),
('Intro To Software Engineering', 'Fall', 2016, 342, 'Mark', 'Smucker');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Courses`
--
ALTER TABLE `Courses`
  ADD PRIMARY KEY (`courseName`,`courseTerm`,`courseYear`,`courseNumber`);

--
-- Indexes for table `Instructors`
--
ALTER TABLE `Instructors`
  ADD PRIMARY KEY (`FirstName`,`LastName`);

--
-- Indexes for table `ScoreUsedFor`
--
ALTER TABLE `ScoreUsedFor`
  ADD PRIMARY KEY (`StudentID`,`Attribute`,`Indicator`,`ProgIndicator`,`DeptCode`,`CourseNumber`,`courseName`,`LastName`,`FirstName`,`courseTerm`,`courseYear`,`Cohort`,`courseType`);

--
-- Indexes for table `Students`
--
ALTER TABLE `Students`
  ADD PRIMARY KEY (`StudentID`);

--
-- Indexes for table `TeachesCourse`
--
ALTER TABLE `TeachesCourse`
  ADD PRIMARY KEY (`courseName`,`courseTerm`,`courseYear`,`courseNumber`,`FirstName`,`LastName`);