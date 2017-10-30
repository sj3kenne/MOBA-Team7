<?php

// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include('./my_connect.php');
$mysqli = get_mysqli_conn();
$ID = $_GET['ID'];

//sql code (Done by Juana)

$sql_TakesCourse = "CREATE TABLE TakesCourse(courseName VARCHAR(40), courseTerm VARCHAR(6), courseYear INT(4), courseNumber INT(3), StudentID INT(8), PRIMARY KEY(courseName,courseTerm,courseYear,courseNumber,StudentID))";
$sql_InsertInfo = "INSERT INTO TakesCourse(courseName,courseTerm,courseYear,courseNumber,StudentID) VALUES ('TestCourse', 'Spring', 2016, 271, 598829620),
('TestCourse', 'Spring', 2016, 271,684014860),
('TestCourse', 'Spring', 2016, 271,843228181),
('TestCourse', 'Spring', 2016, 271,820549378),
('TestCourse', 'Spring', 2016, 271,533572169),
('TestCourse', 'Spring', 2016, 271,975325712),
('TestCourse', 'Spring', 2016, 271,310082419),
('TestCourse', 'Spring', 2016, 271,242132470),
('TestCourse', 'Spring', 2016, 271,208248363),
('TestCourse', 'Spring', 2016, 271,277055951),
('TestCourse', 'Spring', 2016, 271,902907559),
('TestCourse', 'Spring', 2016, 271,528297980),
('TestCourse', 'Spring', 2016, 271,112085131),
('TestCourse', 'Spring', 2016, 271,588642518),
('TestCourse', 'Spring', 2016, 271,414520736)";


$stmt1= $mysqli-> prepare ($sql_TakesCourse);
$stmt1->execute (); 
$stmt2= $mysqli-> prepare ($sql_InsertInfo);
$stmt2-> execute ();

 
 ?>