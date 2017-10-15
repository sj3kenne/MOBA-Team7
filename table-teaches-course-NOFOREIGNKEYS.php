<?php

// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include('./my_connect.php');
$mysqli = get_mysqli_conn();
$ID = $_GET['ID'];

//sql code (Done by Juana)

$sql_TeachesCourse = "CREATE TABLE TeachesCourse(courseName VARCHAR(40), courseTerm VARCHAR(6), courseYear INT(4), courseNumber INT(3),instructorID INT(4), PRIMARY KEY(courseName,courseTerm,courseYear,courseNumber,instructorID))";
$sql_InsertInfo = "INSERT INTO TeachesCourse(courseName, courseTerm, courseYear, courseNumber, InstructorID) VALUES ('TestCourse', 'Spring', 2016, 271, 1)";

$stmt1= $mysqli-> prepare ($sql_TeachesCourse);
$stmt1->execute (); 
$stmt2= $mysqli-> prepare ($sql_InsertInfo);
$stmt2-> execute ();

 
 ?>