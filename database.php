<?php

// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);

// mysqli connection via user-defined function
include('./my_connect.php');
$mysqli = get_mysqli_conn();
$ID = $_GET['ID'];
    
$sql_students = "CREATE TABLE Students(StudentID INT(8) PRIMARY KEY, GradYear VARCHAR(4))";
$sql_InsertStudents= "INSERT INTO Students(StudentID, GradYear) VALUES (310082419,2019),(242132470,2019),(208248363,2019),(277055951,2019),(902907559,2019),(528297980,2019),(444882790,2019),(112085131,2019),(588642518,2019),(414520736,2019),(356558346,2019),(970698993,2019),(633537205,2019),(534292868,2019),(816787809,2019),(220052551,2019),(858571733,2019),(363436152,2019),(393495083,2019),(769635714,2019),(373048949,2019),(357061292,2019),(837310284,2019),(815854164,2019),(315378369,2019),(564410540,2019),(126539887,2019),(563937624,2019),(684291511,2019)";

$sql_Insert_Not_Grad="INSERT INTO Students(StudentID, GradYear) VALUES (598829620, NULL),(684014860, NULL),(843228181, NULL),(820549378, NULL),(533572169, NULL),(975325712, NULL)";

$stmt1= $mysqli-> prepare ($sql_students);
$stmt1->execute (); 
$stmt2= $mysqli-> prepare ($sql_InsertStudents);
$stmt2->execute (); 
$stmtx= $mysqli-> prepare ($sql_Insert_Not_Grad);
$stmtx->execute (); 

$sql_CreateCourses = "CREATE TABLE Courses(DeptCode CHAR(5),  courseNumber INT(3), courseName VARCHAR(40), courseTerm VARCHAR(6), courseYear INT(4), courseType VARCHAR(20), PRIMARY KEY(courseName,courseTerm,courseYear,courseNumber))";

$sql_InsertInfo = "INSERT INTO Courses(courseName, courseTerm, courseYear, DeptCode, courseNumber, courseType) VALUES ('Calculus', 'Spring', 2016, 'MSCI', 271, 'Optional'), ('Intro To Software Engineering', 'Fall', 2016, 'MSCI', 342, 'Mandatory'),('Data Mining', 'Winter', 2017, 'MSCI', 446, 'Optional'), ('Algorithms and Data Structures', 'Summer', 2015, 'MSCI', 240, 'Mandatory')";

$stmt3= $mysqli-> prepare ($sql_CreateCourses);
$stmt3->execute (); 
//$stmt4= $mysqli-> prepare ($sql_InsertInfo);
//$stmt4->execute ();

//create instructor table
$sql_CreateInstructor = 
"CREATE TABLE Instructors(LastName VARCHAR(50),FirstName VARCHAR(50), PRIMARY KEY(FirstName, LastName))";

//insert instructors into table
$sql_InsertInstructors=
"INSERT INTO Instructors(FirstName, LastName) 
VALUES ('Merhdad', 'Pirnia'), ('Mark', 'Smucker'), ('Lucas', 'Golab'), ('Mark', 'Hancock')";


$stmt5= $mysqli-> prepare ($sql_CreateInstructor);
$stmt5->execute (); 

$stmt6= $mysqli-> prepare ($sql_InsertInstructors);
$stmt6->execute (); 

//Create relationship table
$sql_ScoreUsedFor = "CREATE TABLE ScoreUsedFor(courseName VARCHAR(40), StudentID INT(8),Attribute VARCHAR(30),Indicator VARCHAR(70), ProgIndicator VARCHAR(70),score float(3), DeptCode CHAR(5) , CourseNumber INT(3), LastName VARCHAR(50), FirstName VARCHAR(50), courseTerm VARCHAR(6), courseYear INT(4), Cohort VARCHAR(2), courseType VARCHAR(20), PRIMARY KEY(StudentID,Attribute,Indicator,ProgIndicator,DeptCode,courseNumber,courseName,LastName,FirstName,courseTerm,courseYear,Cohort,courseType))";


	$sql_alterscoreusedfor= "ALTER TABLE `ScoreUsedFor`
  ADD KEY `StudentID` (`StudentID`),
  ADD KEY `DeptCode` (`DeptCode`),
  ADD KEY `courseType` (`courseType`),
  ADD KEY `courseTerm` (`courseTerm`),
  ADD KEY `courseYear` (`courseYear`),
  ADD KEY `courseName` (`courseName`),
  ADD KEY `FirstName` (`FirstName`),
  ADD KEY `LastName` (`LastName`),
  ADD KEY `courseNumber` (`courseNumber`);" ;
$sql_foreignkey= "ALTER TABLE `ScoreUsedFor`
  ADD CONSTRAINT `scoreusedfor_ibfk_1` FOREIGN KEY (`courseName`) REFERENCES `Courses` (`courseName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `scoreusedfor_ibfk_2` FOREIGN KEY (`StudentID`) REFERENCES `Students` (`StudentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `scoreusedfor_ibfk_3` FOREIGN KEY (`DeptCode`) REFERENCES `Courses` (`DeptCode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `scoreusedfor_ibfk_4` FOREIGN KEY (`courseType`) REFERENCES `Courses` (`courseType`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `scoreusedfor_ibfk_3` FOREIGN KEY (`FirstName`) REFERENCES `Instructors` (`FirstName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `scoreusedfor_ibfk_4` FOREIGN KEY (`LastName`) REFERENCES `Instructors` (`LastName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `scoreusedfor_ibfk_5` FOREIGN KEY (`courseTerm`) REFERENCES `Courses` (`courseTerm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `scoreusedfor_ibfk_6` FOREIGN KEY (`courseYear`) REFERENCES `Courses` (`courseYear`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `scoreusedfor_ibfk_7` FOREIGN KEY (`courseNumber`) REFERENCES `Courses` (`courseNumber`) ON DELETE CASCADE ON UPDATE CASCADE;" ;

$stmt9= $mysqli-> prepare ($sql_ScoreUsedFor);
$stmt9->execute (); 
$stmt10= $mysqli-> prepare ($sql_InsertInfo);
$stmt10-> execute ();

?>