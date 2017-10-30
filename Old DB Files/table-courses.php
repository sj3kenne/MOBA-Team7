<?php

// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include('./my_connect.php');
$mysqli = get_mysqli_conn();
$ID = $_GET['ID'];

//sql code (Done by Chris)

$sql_CreateCourses = "CREATE TABLE Courses(courseName VARCHAR(40), courseTerm VARCHAR(6), courseYear INT(4), courseDept CHAR(4), courseNumber INT(3), courseType VARCHAR(20), PRIMARY KEY(courseName,courseTerm,courseYear,courseNumber))";

$sql_InsertInfo = "INSERT INTO Courses(courseName, courseTerm, courseYear, courseDept, courseNumber, courseType) VALUES ('TestCourse', 'Spring', 2016, 'MSCI', 271, 'Optional')";

$stmt1= $mysqli-> prepare ($sql_CreateCourses);
$stmt1->execute (); 
$stmt2= $mysqli-> prepare ($sql_InsertInfo);
$stmt2->execute ();
 
 ?>