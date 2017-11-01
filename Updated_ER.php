<?php

// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);

// mysqli connection via user-defined function
include('./my_connect.php');
$mysqli = get_mysqli_conn();
$ID = $_GET['ID'];
    
$sql_students = "CREATE TABLE Students(StudentID INT(8) PRIMARY KEY, GradYear VARCHAR(4))";
$sql_InsertStudents= "INSERT INTO Students(StudentID, GradYear) VALUES (598829620, 2019), (684014860, 2019), (843228181, 2019), (820549378, 2019), (533572169, 2019), (975325712, 2019), (310082419, 2019), (242132470, 2019), (208248363, 2019), (277055951, 2019), (902907559, 2019), (528297980, 2019), (444882790, 2019), (112085131, 2019), (588642518, 2019),
(414520736, 2019),
(356558346, 2019),
(970698993, 2019),
(633537205, 2019),
(534292868, 2019),
(816787809, 2019),
(220052551, 2019),
(363436152, 2019),
(858571733, 2019)";

$stmt1= $mysqli-> prepare ($sql_students);
$stmt1->execute (); 
$stmt2= $mysqli-> prepare ($sql_InsertStudents);
$stmt2->execute (); 

$sql_CreateCourses = "CREATE TABLE Courses(courseName VARCHAR(40), courseTerm VARCHAR(6), courseYear INT(4), courseDept CHAR(4), courseNumber INT(3), courseType VARCHAR(20), PRIMARY KEY(courseName,courseTerm,courseYear,courseNumber))";

$sql_InsertInfo = "INSERT INTO Courses(courseName, courseTerm, courseYear, courseDept, courseNumber, courseType) VALUES ('TestCourse', 'Spring', 2016, 'MSCI', 271, 'Optional'), ('TestCourse2', 'Fall', 2016, 'MSCI', 342, 'Mandatory')";

$stmt3= $mysqli-> prepare ($sql_CreateCourses);
$stmt3->execute (); 
$stmt4= $mysqli-> prepare ($sql_InsertInfo);
$stmt4->execute ();

//create instructor table
$sql_CreateInstructor = 
"CREATE TABLE Instructors(FirstName VARCHAR(50), LastName VARCHAR(50), PRIMARY KEY(FirstName, LastName))";

//insert instructors into table
$sql_InsertInstructors=
"INSERT INTO Instructors(FirstName, LastName) 
VALUES ('Merhdad', 'Pirnia')";


$stmt5= $mysqli-> prepare ($sql_CreateInstructor);
$stmt5->execute (); 

$stmt6= $mysqli-> prepare ($sql_InsertInstructors);
$stmt6->execute (); 

$sql_TeachesCourse = "CREATE TABLE TeachesCourse(courseName VARCHAR(40), courseTerm VARCHAR(6), courseYear INT(4), courseNumber INT(3), FirstName VARCHAR(50), LastName VARCHAR(50), PRIMARY KEY(courseName,courseTerm,courseYear,courseNumber, FirstName, LastName))";
$sql_InsertInfo = "INSERT INTO TeachesCourse(courseName, courseTerm, courseYear, courseNumber, FirstName, LastName) VALUES ('TestCourse', 'Spring', 2016, 271, 'Merhdad', 'Pirnia')";

$stmt7= $mysqli-> prepare ($sql_TeachesCourse);
$stmt7->execute (); 
$stmt7->execute (); 
$stmt8= $mysqli-> prepare ($sql_InsertInfo);
$stmt8-> execute ();


$sql_ScoreUsedFor = "CREATE TABLE ScoreUsedFor(courseName VARCHAR(40), courseTerm VARCHAR(6), courseYear INT(4), courseNumber INT(3),StudentID INT(8), AttributeName VARCHAR(30), IndicatorName VARCHAR(70), score float(3), PRIMARY KEY(courseName,courseTerm,courseYear,courseNumber,StudentID,AttributeName,IndicatorName))";

$sql_InsertInfo = "INSERT INTO ScoreUsedFor(courseName, courseTerm, courseYear, courseNumber, StudentID, AttributeName, IndicatorName, score) 
VALUES
('TestCourse', 'Spring', 2016, 271, 356558346, 8, 12, 0.2),
('TestCourse', 'Spring', 2016, 271, 970698993, 8, 12, 0.3),
('TestCourse', 'Spring', 2016, 271, 633537205, 8, 12, 0.2),
('TestCourse', 'Spring', 2016, 271, 534292868, 8, 12, 0.7),
('TestCourse', 'Spring', 2016, 271, 816787809, 8, 12, 0.75),
('TestCourse', 'Spring', 2016, 271, 220052551, 1, 12, 0.68),
('TestCourse', 'Spring', 2016, 271, 363436152, 1, 12, 0.52),
('TestCourse', 'Spring', 2016, 271, 858571733, 1, 12, 0.62),
('TestCourse', 'Spring', 2016, 271, 684014860, 1, 12, 0.49),
('TestCourse', 'Spring', 2016, 271, 598829620, 1, 12, 0.89),
('TestCourse2', 'Winter', 2016, 342, 843228181, 8, 12, 0.9),
('TestCourse2', 'Winter', 2016, 342, 820549378, 8, 12, 0.52),
('TestCourse2', 'Winter', 2016, 342, 533572169, 8, 12, 0.28),
('TestCourse2', 'Winter', 2016, 342, 975325712, 8, 12, 0.85),
('TestCourse2', 'Winter', 2016, 342, 310082419, 1, 12, 0.69),
('TestCourse2', 'Winter', 2016, 342, 242132470, 1, 12, 0.79),
('TestCourse2', 'Winter', 2016, 342, 208248363, 1, 12, 0.56),
('TestCourse2', 'Winter', 2016, 342, 277055951, 1, 12, 0.71),
('TestCourse2', 'Winter', 2016, 342, 902907559, 1, 12, 0.63),
('TestCourse2', 'Winter', 2016, 342, 528297980, 1, 12, 0.51),
('TestCourse2', 'Winter', 2016, 342, 112085131, 1, 12, 0.34)";

$stmt9= $mysqli-> prepare ($sql_ScoreUsedFor);
$stmt9->execute (); 
$stmt10= $mysqli-> prepare ($sql_InsertInfo);
$stmt10-> execute ();


?>